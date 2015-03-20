<?php
/**
 * @version     2.0.0
 * @package     com_rv
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Don Gilbert <don@electriceasel.com> - http://www.electriceasel.com
 */
defined('_JEXEC') or die;

class FeaturedController extends EEController
{
    /**
     * Method to display a view.
     *
     * @param	boolean			$cachable	If true, the view output will be cached
     * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
     *
     * @return	JController		This object to support chaining.
     * @since	1.5
     */
    public function display($cachable = false, $urlparams = false)
    {
        $this->app->input->def('view', 'items');

        parent::display($cachable, $urlparams);

        return $this;
    }

    public function updateAlias()
    {
        $db = JFactory::getDbo();
        $table = '#__featured_items';

        $q = 'SELECT id, title' .
            ' FROM ' . $table .
            ' WHERE alias = ""';

        foreach ($db->setQuery($q)->loadObjectList() as $r)
        {
            $a = EEHelper::buildAlias($r->title);
            $q = 'UPDATE ' . $table .
                ' SET alias = ' . $db->quote($a) .
                ' WHERE id = ' . $r->id;

            $db->setQuery($q)->execute();
        }

        JFactory::getApplication()->close('Done for ' . $table);
    }
}
