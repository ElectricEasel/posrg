<?php defined('_JEXEC') or die;

class CareersViewList extends JView
{
	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		$this->prepareDocument();

		parent::display($tpl);
	}

	protected function prepareDocument()
	{
		JFactory::getDocument()
			->addScript('components/com_careers/assets/js/jquery.lightbox.js')
			->addStyleSheet('components/com_careers/assets/css/jquery.lightbox.css');
	}
}
