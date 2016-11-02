<?php
/**
 * @version 1.0
 * @package RSform!Pro CRM Plugin 1.0
 * @copyright (C) 2014 www.electriceasel.com
 * @license GPL, http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class plgSystemRsfpcrmInstallerScript
{
	public function preflight($type, $parent)
	{
		if ($type == 'uninstall')
		{
			return true;
		}

		$app = JFactory::getApplication();

		if (!file_exists(JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/rsform.php'))
		{
			$app->enqueueMessage('Please install the RSForm! Pro component before continuing.', 'error');
			return false;
		}

		if (!file_exists(JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/version.php'))
		{
			$app->enqueueMessage('Please upgrade RSForm! Pro to at least R45 before continuing!', 'error');
			return false;
		}

		$jversion = new JVersion();

		if (!$jversion->isCompatible('2.5.5'))
		{
			$app->enqueueMessage('Please upgrade to at least Joomla! 2.5.5 before continuing!', 'error');
			return false;
		}

		return true;
	}
}