<?php defined('_JEXEC') or die;

class PartsViewForm extends JView
{
	protected $item;

	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->document = JFactory::getDocument();
	}

	public function display($tpl = null)
	{
		$this->item = $this->get('Item');

		$this->prepareDocument();

		parent::display($tpl);
	}

	protected function prepareDocument()
	{
		$this->document
			->setTitle(
				$this->item->mfc . ' ' .
				$this->item->part_number . ' | ' .
				$this->document->getTitle()
			)
			->setDescription(htmlspecialchars(
				$this->item->mfc . ' ' .
				$this->item->part_number . ' ' .
				$this->item->des
			));
	}
}
