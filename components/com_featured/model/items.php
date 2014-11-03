<?php defined('_JEXEC') or die;

class FeaturedModelItems extends EEModelList
{
    protected function populateState($ordering = null, $direction = null)
    {
        $ordering OR $ordering = 'a.ordering';
        $direction OR $direction = 'ASC';

        parent::populateState($ordering, $direction);
    }

    public function buildListQuery()
    {
        $query = $this->getDbo()->getQuery(true)
            ->select('a.*')
            ->from('#__featured_items AS a');

        $ordering = $this->getState('list.ordering', 'a.ordering');
        $orderDir = strtoupper($this->getState('list.direction', 'ASC'));

        if ($ordering && in_array($orderDir, array('ASC', 'DESC')))
        {
            $query->order($this->getDbo()->escape($ordering) . ' ' . $orderDir);
        }

        $published = $this->getState('filter.published', false);

        if ($published)
        {
            $query->where('a.published = 1');
        }

        return $query;
    }

    public function getForm()
    {
        return JForm::getInstance('com_featured.item', 'item');
    }

    public function getItems()
    {
        if ($items = parent::getItems())
        {
            return $items;
        }

        return array();
    }
}
