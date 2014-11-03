<?php
/**
 * @copyright	Copyright (C) 2014 Electric Easel, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

class plgSystemEasel extends JPlugin
{
    public function __construct(&$subject, $config = array())
    {
        include_once JPATH_LIBRARIES . '/easel/setup.php';

        parent::__construct($subject, $config);
    }
}
