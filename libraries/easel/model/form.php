<?php defined('EE_PATH') or die;

jimport('joomla.application.component.modelform');

abstract class EEModelForm extends JModelForm
{
	/**
	 * @var JApplication
	 */
	protected $app;

	public function __construct($config = array())
	{
		$this->app = JFactory::getApplication();

		JForm::addFormPath(JPATH_COMPONENT . '/model/forms');
		JForm::addFieldPath(JPATH_COMPONENT . '/model/fields');

		parent::__construct($config);
	}

	/**
	 * Handle frontend submissions.
	 *
	 * @return  integer  Success or failure level
	 */
	public function submitForm($data = array())
	{
		$table	= $this->getTable();

		if ($this->validate($this->getForm(), $data))
		{
			$table->bind($data);

			if ($table->store(false))
			{
				return EE_NO_ERROR;
			}

			return EE_TABLE_ERROR;
		}

		return EE_FORM_VALIDATION_FAILED;
	}
}
