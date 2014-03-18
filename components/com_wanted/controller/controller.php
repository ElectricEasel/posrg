<?php defined('_JEXEC') or die;

class WantedController extends JController
{
	protected $app;

	public function __construct($config = array())
	{
		$config['model_path'] = JPATH_COMPONENT . '/model';
		parent::__construct($config);

		$this->app = JFactory::getApplication();
        $task = $this->app->input->get('task');

        // Check login state & token for tasks
        $checkTask = array(
            'block',
            'save',
            'saveorder',
            'delete'
        );

        if (in_array($task, $checkTask))
        {
            $this->checkLogin();
            $this->checkTK();
        }
	}

	public function display($cachable = false, $urlparams = false)
	{
		$view = $this->app->input->get('view');

		if (!$task && !$view)
		{
			JRequest::setVar('view', 'list');
			$this->app->input->set('view', 'list');
		}

        // Check login state for views
		$checkView = array(
			'form',
			'manager'
		);

		if (in_array($view, $checkView))
		{
			$this->checkLogin();
		}

		parent::display($cachable, $urlparams);
	}

	public function save()
	{
		$post  = JRequest::get('post');
		$table = new WantedTableEntry;
		$id    = $this->app->input->getInt('id');

		if ($id)
		{
			$table->load($id);
		}

		if ($table->save($post))
		{
			$this->setMessage('Product Saved Successfully.');
		}
		else
		{
			$this->setError('There was an error saving.');
		}

		$this->setRedirect(JRoute::_('index.php?option=com_wanted&view=manager'));
	}

	public function delete()
	{
		$table = new WantedTableEntry;
		$id = $this->app->input->getInt('id');

		if ($table->delete($id))
		{
			$this->setMessage('Product successfully deleted.');
		}
		else
		{
			$this->setError('There was an error deleting the item.');
		}

		$this->setRedirect(JRoute::_('index.php?option=com_wanted&view=manager'));
	}

	protected function checkTK()
	{
        $method = JRequest::getMethod();

		JSession::checkToken($method) or die('Invalid Token');
	}

	protected function checkLogin()
	{
		$user = JFactory::getUser();

		if (strtolower($user->get('username')) !== 'admin')
		{
			$this->setRedirect('index.php?option=com_users&view=login');
			$this->redirect();
		}
	}

}
