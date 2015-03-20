<?php defined('EE_PATH') or die;

class EEController extends JControllerLegacy
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
	 * Override the getInstance method.
	 *
	 * @param   string  $prefix  Prefix for the main component controller
	 * @param   array   $config  Configuration array
	 *
	 * @return  EEController
	 */
	public static function getInstance($prefix, $config = array())
	{
		if (!array_key_exists('model_path', $config))
		{
			$config['model_path'] = JPATH_COMPONENT . '/model';
		}

		return parent::getInstance($prefix, $config);
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
