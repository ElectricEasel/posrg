<?php
/**
 * @copyright	Copyright (C) 2014 Electric Easel, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_featured'))
{
    throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

JHtml::addIncludePath(__DIR__ . '/helper/html');
JLoader::registerPrefix('Featured', __DIR__);

EEController::getInstance('Featured')->run();
