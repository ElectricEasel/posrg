<?php defined('EE_PATH') or die;

jimport('joomla.application.component.controllerform');

class EEControllerForm extends JControllerForm
{
	/**
	 * @var JApplication
	 */
	protected $app;

	/**
	 * @inheritdoc
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->app = JFactory::getApplication();
	}

	/**
	 * Run the component. This is syntactic sugar for the
	 * execute and redirect methods.
	 *
	 * @return  void
	 *
	 */
	public function run()
	{
		self::$instance->execute($this->app->input->get('task'));
		self::$instance->redirect();
	}
}
