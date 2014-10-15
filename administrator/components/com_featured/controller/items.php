<?php defined('_JEXEC') or die;

class FeaturedControllerItems extends EEControllerAdmin
{
    public function getModel($type = 'Item', $prefix = 'FeaturedModel', $config = array())
    {
        return parent::getModel($type, $prefix, $config);
    }
}
