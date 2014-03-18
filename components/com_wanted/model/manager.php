<?php defined('_JEXEC') or die;

class WantedModelManager extends JModelList
{
	protected $app;
	protected $context = 'com_wanted.manager';

	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->app = JFactory::getApplication();
	}

	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState($ordering, $direction);

		$search = $this->app->getUserStateFromRequest("com_wanted.search", 'search', '', 'string');
		$search = strtolower($search);
		$this->setState('filter.search', $search);

		$params = $this->app->getParams();
		$this->setState('params', $params);

	}

	public function getListQuery()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true)
			->select('*')
			->from('#__wanted');

		$search = $this->getState('filter.search');
		if ($search)
		{
			$search = $db->escape($search);
			$query->where("item_name LIKE '%{$search}%'");
		}

		return $query;
	}
}
