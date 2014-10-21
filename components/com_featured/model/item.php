<?php defined('_JEXEC') or die;

class FeaturedModelItem extends EEModelAdmin
{
    /**
     * @var  string The prefix to use with controller messages.
     * @since 1.6
     */
    protected $text_prefix = 'COM_FEATURED';

    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param type The table type to instantiate
     * @param string A prefix for the table class name. Optional.
     * @param array Configuration array for model. Optional.
     * @return JTable A database object
     * @since 1.6
     */
    public function getTable($type = '', $prefix = '', $config = array())
    {
        // Instead of searching for the table via JTable, just use it from autoloading. :)
        return new FeaturedTableItem;
    }

    /**
     * Method to get the record form.
     *
     * @param array $data  An optional array of data for the form to interogate.
     * @param boolean $loadData True if the form is to load its own data (default case), false if not.
     * @return JForm A JForm object on success, false on failure
     * @since 1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        $app = JFactory::getApplication();

        $form = $this->loadForm('com_featured.item', 'item', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return mixed The data for the form.
     * @since 1.6
     */
    protected function loadFormData()
    {
        $app = JFactory::getApplication();
        // Check the session for previously entered form data.
        $data = $app->getUserState('com_featured.edit.item.data', array());

        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }

    /**
     * Prepare and sanitise the table prior to saving.
     *
     * @since 1.6
     */
    protected function prepareTable(&$table)
    {
        if (empty($table->id))
        {
            // Set ordering to the last item if not set
            if (isset($table->ordering) && $table->ordering === '')
            {
                $table->ordering = $this->getDbo()->setQuery('SELECT (MAX(ordering) + 1) FROM #__featured_items')->loadResult();
            }

        }
    }

}
