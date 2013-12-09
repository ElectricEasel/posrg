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
		if (!JSession::checkToken())
		{
			$this->setRedirect(JRoute::_('index.php?option=com_parts&view=list'), 'Token error');
		}

		$inventoryType = $this->app->input->getString('inventory_type', 'regular');

		$table = new PartsTableImport;
		$table->truncate($inventoryType); // if isBB is 1, delete only is_bb. If isBB is 0, delete only non bb

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

        $items = $db->setQuery($query)->loadObjectList();

        if ($items)
        {
            $table = new PartsTableImport;

            foreach ($items as $item)
            {
                // If the part number starts with the manufacturer, remove it.
                if (!empty($item->mfc) && strpos($item->part_number, $item->mfc) === 0)
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
}
