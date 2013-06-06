<?php defined('_JEXEC') or die;

class PartsTableImport extends JTable
{
	public function __construct()
	{
		$db = JFactory::getDbo();

		parent::__construct( '#__parts', 'id', $db );
	}

	public function truncate()
	{
		$this->getDbo()->setQuery('TRUNCATE ' . $this->getTableName())->execute();
	}
}
