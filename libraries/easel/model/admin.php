<?php defined('EE_PATH') or die;

jimport('joomla.application.component.modeladmin');

abstract class EEModelAdmin extends JModelAdmin
{
	/**
	 * @var JApplication
	 */
	protected $app;

	public function __construct($config = array())
	{
		$this->app = JFactory::getApplication();

		JForm::addFormPath(JPATH_COMPONENT_ADMINISTRATOR . '/model/forms');
		JForm::addFieldPath(JPATH_COMPONENT_ADMINISTRATOR . '/model/fields');

		parent::__construct($config);
	}
}
