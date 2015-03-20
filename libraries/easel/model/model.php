<?php defined('EE_PATH') or die;

class EEModel extends JModelLegacy
{
	/**
	 * @var JApplication
	 */
	protected $app;

	public function __construct($config = array())
	{
		$this->app = JFactory::getApplication();

		parent::__construct($config);
	}
}
