<?php defined('_JEXEC') or die;

class PartsController extends JController
{
	protected $app;

	public function __construct($config = array())
	{
		$config['model_path'] = JPATH_COMPONENT . '/model';

		parent::__construct($config);

		$this->app = JFactory::getApplication();
	}

	public function save()
	{
		ini_set('max_execution_time', 300);
		
		if (!JSession::checkToken())
		{
			$this->setRedirect(JRoute::_('index.php?option=com_parts&view=list'), 'Token error');
		}

        if (!$this->backupParts())
        {
            echo "Error, backup failed. Import will not proceed. Please contact webmaster.";
            return;
        }

		$inventoryType = $this->app->input->getString('inventory_type', 'regular');

		$table = new PartsTableImport;
		$table->truncate();

		$csv = new Quick_CSV_Import($_FILES['file_source']['tmp_name']);

		foreach($csv->getLines() as $item)
		{
			$item['inventory_type'] = $table->getDbo()->escape($inventoryType);

            // Trim extra whitespace
            $item = array_map(function ($val) {
                return trim($val);
            }, $item);

			$table->save($item);
			$table->reset();
			// Reset doesn't clear the $_tbl_key
			$table->id = null;
		}

        $this->removeMfgFromPartNumber();

		$this->setRedirect(JRoute::_('index.php?option=com_parts&view=list'), 'Import Successful.');
	}

	public function display($cachable = false, $urlparams = false)
	{
		$view = $this->app->input->get('view');
		$task = $this->app->input->get('task');

		if(!$task && !$view)
		{
			$view = 'list';
			JRequest::setVar('view', $view);
			$this->app->input->set('view', $view);
		}

		if ($view === 'imp' || $view === 'manager' || $task === 'save')
		{
			$this->checkLogin();
		}

		parent::display($cachable, $urlparams);
	}

	protected function checkLogin()
	{
		$user = JFactory::getUser();

		$username = strtolower($user->get('username'));

		$allowed = array('posrg', 'admin');

		if (!in_array($username, $allowed))
		{
			$url = JRoute::_('index.php?option=com_users&view=login');

			$this->setRedirect($url);

			$this->redirect();
		}
	}

    public function removeMfgFromPartNumber()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__parts');

        $query2 = $db->getQuery(true)
            ->select('COUNT(id)')
            ->from('#__parts');

        $count = $db->setQuery($query2)->loadResult();
        $offset = 0;

        while ($offset < $count)
        {
            $items = $db->setQuery($query, $offset, 2500)->loadObjectList();
            $offset += 2500;

            if ($items)
            {
                $table = new PartsTableImport;

                foreach ($items as $item)
                {
                    // If the part number starts with the manufacturer, remove it.
                    if (!empty($item->mfc) && strpos(strtolower($item->part_number), strtolower($item->mfc)) === 0)
                    {
                        $item->part_number = preg_replace('#' . $item->mfc . '#i', '', $item->part_number, 1);
                    }

                    // Clean up all other whitespace from part_number
                    $item->part_number = trim($item->part_number);
                    $item->part_number = ltrim($item->part_number, '-');
                    $item->part_number = trim($item->part_number);

                    $table->save($item);
                    $table->reset();
                    // Reset doesn't clear the $_tbl_key
                    $table->id = null;
                }
            }
        }

	    $this->setRedirect(JRoute::_('index.php?option=com_parts&view=list'), 'Cleanup Successful.');
    }

    public function backupParts()
    {
        $db = JFactory::getDbo();

        $sql = "DROP TABLE IF EXISTS #__parts_backup;";
        $db->setQuery($sql);
        $result1 = $db->execute();

        $sql = "CREATE TABLE #__parts_backup LIKE #__parts;";
        $db->setQuery($sql);
        $result2 = $db->execute();

        $sql = "INSERT #__parts_backup SELECT * FROM #__parts;";
        $db->setQuery($sql);
        $result3 = $db->execute();

        return $result1 && $result2 && $result3;
    }

    public function clearCurrentParts()
    {
        $db = JFactory::getDbo();
        $sql = "DELETE FROM #__parts;";
        $db->setQuery($sql);
        return $db->execute();
    }
}
