<?php
/**
 * @version 1.0
 * @package RSform!Pro CRM Notifications
 * @copyright (C) 2016 www.electriceasel.com
 * @license GPL, http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

/**
 * CRM Integration Plugin for RSForm! Pro: Table class
 */
class CrmTable extends JTable
{
	public $id;
	public $form_id;
	public $published = 0;

	/**
	 * Constructor
	 *
	 * @param object JDatabase connector object
	 */
	public function __construct()
	{
		$db = JFactory::getDbo();

		parent::__construct('#__rsform_crm', 'id', $db);
	}
}