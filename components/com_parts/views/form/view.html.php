<?php defined('_JEXEC') or die;

class PartsViewForm extends JView
{
	public function display($tpl = null)
	{
		$this->item = $this->get('Item');

		parent::display($tpl);
	}
}
