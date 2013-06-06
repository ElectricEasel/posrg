<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Shortcode.RSForm
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php';

/**
 * YouTube Shortcode Plugin.
 *
 * @package     Joomla.Plugin
 * @subpackage  Shortcode.YouTube
 * @since       3.1
 */
class PlgShortcodeRsform extends JPlugin
{
	/**
	 * Method to catch the onAfterDispatch event.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.1
	 */
	public function onShortcodePrepare()
	{
		// Check that we are in the site application.
		if (JFactory::getApplication()->isAdmin())
		{
			return true;
		}

		Shortcodes::addShortcode('rsform', array($this, 'rsform'));

		return true;
	}

	/**
	 * Method to create YouTube shortcode.
	 *
	 * @param   string  $atts  User defined attributes in shortcode tag.
	 *
	 * @return  string
	 *
	 * @since   3.1
	 */
	public function rsform($atts)
	{
		$id = $atts['id'];

		if (empty($id))
		{
			return;
		}

		// We don't want to set the ID as a global var.
		unset($atts['id']);

		foreach ($atts as $name => $value)
		{
			JRequest::setVar('form_field.' . $name, $value);
		}

		return RSFormProHelper::displayForm($id);
	}
}
