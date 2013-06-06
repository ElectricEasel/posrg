<?php defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php';

JRequest::setVar('manufacturer', $this->item->mfc);
JRequest::setVar('part_number', $this->item->part_number);
JRequest::setVar('form_name', 'Quick Quote: Inventory');

echo RSFormProHelper::displayForm(3);
