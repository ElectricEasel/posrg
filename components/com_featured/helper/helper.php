<?php
/**
 * @version     2.0.0
 * @package     com_featured
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Don Gilbert <don@electriceasel.com> - http://www.electriceasel.com
 */
defined('_JEXEC') or die;

class FeaturedHelper extends EEHelper
{
    protected static $component = 'com_featured';

    public static function addSubmenu($vName = '')
    {
//        JSubMenuHelper::addEntry(
//            JText::_('COM_RV_TITLE_RESORTS'),
//            'index.php?option=com_rv&view=resorts',
//            $vName == 'resorts'
//        );
    }

}
