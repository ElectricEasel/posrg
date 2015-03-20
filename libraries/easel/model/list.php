<?php defined('EE_PATH') or die;

jimport('joomla.application.component.modellist');

abstract class EEModelList extends JModelList
{
	/**
	 * @var JApplication
	 */
	protected $app;

    protected $filter_fields = array(
        'a.title', 'title',
        'a.ordering', 'ordering',
        'a.id', 'id',
        'a.state', 'state',
        'a.published', 'published'
    );

	public function __construct($config = array())
	{
		$this->app = JFactory::getApplication();

		JForm::addFormPath(JPATH_COMPONENT . '/model/forms');
		JForm::addFieldPath(JPATH_COMPONENT . '/model/fields');

		parent::__construct($config);
	}

	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 *
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 *
	 * @since   11.1
	 */
	protected function getListQuery()
	{
		$query = $this->buildListQuery();

		// Trigger the onAfterBuildQuery event
		$this->app->triggerEvent('onAfterBuildQuery', array($this->context, $query));

		return $query;
	}

	/**
	 * Abstract method for components using EEModelList
	 * to make sure they implement it.
	 *
	 */
	abstract protected function buildListQuery();

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since 1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState($ordering, $direction);

		$app = JFactory::getApplication();

		if (!$app->isAdmin())
		{
			$this->setState('params', $app->getParams());
		}
	}

	/**
	 * Method to get a store id based on the model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  An identifier string to generate the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   11.1
	 */
	protected function getStoreId($id = '')
	{
		// Add the list state to the store id.
		$id .= ':' . $this->app->input->getWord('view', 'default');
		$id .= ':' . $this->app->input->getWord('layout', 'default');
		$id .= ':' . $this->getState('list.start');
		$id .= ':' . $this->getState('list.limit');
		$id .= ':' . $this->getState('list.ordering');
		$id .= ':' . $this->getState('list.direction');

		return md5($this->context . ':' . $id);
	}
}
