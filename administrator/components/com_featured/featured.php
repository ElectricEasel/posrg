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

JLoader::registerPrefix('Featured', __DIR__);

FeaturedHelper::createFolder();

JFactory::getDocument()->addStyleDeclaration('fieldset.fieldset_hidden{display:none}');

JHtml::addIncludePath(__DIR__ . '/helper/html');

EEController::getInstance('Featured')->run();
