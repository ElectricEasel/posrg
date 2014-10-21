<?php defined('EE_PATH') or die;

jimport('joomla.application.component.modelitem');

abstract class EEModelItem extends JModelItem
{
	/**
	 * Holds the item as retrieved in the getItem of the child class.
	 * JModelItem uses the $_item variable. This allows us to store
	 * any changes or post-processing that occurs for output.
	 *
	 * @var  $item
	 */
	protected $item;

	/**
	 * Context string for the model type.
	 *
	 * @var  string
	 */
	protected $context;

	/**
	 * @var JApplication
	 */
	protected $app;

	/**
	 * Add support for determining context
	 *
	 * @param  array  $config
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->app = JFactory::getApplication();

		// Guess the context as Option.ModelName.
		if (empty($this->context))
		{
			$this->context = strtolower($this->option . '.' . $this->getName());
		}
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since 1.6
	 */
	protected function populateState()
	{
		$this->setState('params', $this->app->getParams());
	}

	public function getQuery()
	{
		$query = $this->buildQuery();

		// Trigger the onAfterBuildQuery event
		$this->app->triggerEvent('onAfterBuildQuery', [$this->context, $query]);

		return $query;
	}

	/**
	 * Models implmenting must override
	 *
	 * @return  JDatabaseQuery
	 */
	abstract protected function buildQuery();

	/**
	 * Get the item from the query
	 *
	 * @return  mixed  stdClass object on success, false on failure
	 */
	public function getItem()
	{
		if (empty($this->_item))
		{
			$db = $this->getDbo();
			$q = $this->getQuery();

			$item = $db->setQuery($q)->loadObject();

			// We return false to stay consistent with EEModelList
			if ($item === null)
			{
				$this->_item = false;
			}

			$this->_item = $item;
		}

		return $this->_item;
	}

}
