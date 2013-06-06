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

		$table = new PartsTableImport;
		$table->truncate();

		$csv = new Quick_CSV_Import($_FILES['file_source']['tmp_name']);

		foreach($csv->getLines() as $item)
		{
			$table->save($item);
			$table->reset();
			// Reset doesn't clear the $_tbl_key
			$table->id = null;
		}

		$this->setRedirect(JRoute::_('index.php?option=com_parts&view=list'), 'Import Successful.');
	}

	public function display()
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

		parent::display();
	}

	protected function checkLogin()
	{
		$user = JFactory::getUser();

		if (strtolower($user->get('username')) !== 'admin')
		{
			$url = JRoute::_('index.php?option=com_users&view=login');

			$this->setRedirect($url);

			$this->redirect();
		}
	}
}
