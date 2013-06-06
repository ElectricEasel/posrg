<?php defined('_JEXEC') or die;

class ProductTableProduct extends JTable
{
	public function __construct()
	{
		$db = JFactory::getDbo();

		parent::construct('#__product', 'id', $db);
	}
}