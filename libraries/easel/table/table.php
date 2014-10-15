<?php defined('EE_PATH') or die;

class EETable extends JTable
{
	/**
	 * Constructor
	 *
	 * @param JDatabase A database connector object
	 */
	public function __construct()
	{
		if (empty($this->_tbl))
		{
			throw new Exception('You must define a $_tbl name in your table class: ' . get_class($this), 500);
		}

		$db = JFactory::getDbo();

		parent::__construct($this->_tbl, 'id', $db);
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param array  Named array
	 * @return null|string null is operation was satisfactory, otherwise returns an error
	 * @see  JTable:bind
	 * @since 1.5
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params']))
		{
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = (string)$registry;
		}

		if (isset($array['metadata']) && is_array($array['metadata']))
		{
			$registry = new JRegistry();
			$registry->loadArray($array['metadata']);
			$array['metadata'] = (string)$registry;
		}

		if (isset($array['title']) && empty($array['alias']))
		{
			$array['alias'] = EEHelper::buildAlias($array['title']);
		}

		if (!isset($array['created_time']) && !empty($array['created_time']))
		{
			$array['created_time'] = date('Y-m-d H:i:s');
		}

		return parent::bind($array, $ignore);
	}

	/**
	 * Overloaded check function
	 */
	public function check()
	{
		//If there is an ordering column and this is a new row then get the next ordering value
		if (property_exists($this, 'ordering') && $this->id == 0)
		{
			$this->ordering = self::getNextOrder();
		}

		return parent::check();
	}

	/**
	 * Method to set the publishing state for a row or list of rows in the database
	 * table.  The method respects checked out rows by other users and will attempt
	 * to checkin rows that it can after adjustments are made.
	 *
	 * @param    mixed    An optional array of primary key values to update.  If not
	 *                    set the instance property value is used.
	 * @param    integer The publishing state. eg. [0 = unpublished, 1 = published]
	 * @param    integer The user id of the user performing the operation.
	 * @return    boolean    True on success.
	 * @since    1.0.4
	 */
	public function publish($pks = null, $state = 1, $userId = 0)
	{
		// Initialise variables.
		$k = $this->_tbl_key;

		// Sanitize input.
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			if ($this->$k)
			{
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else
			{
				$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}

		// Update the publishing state for rows with the given primary keys.
		$query = $this->_db->getQuery(true);
		$query->update($this->_tbl);

		// If the `published` key exists, use that.
		if (property_exists($this, 'published'))
		{
			$query->set('published = ' . (int) $state);
		}
		else
		// Othewise, use `state`
		{
			$query->set('state = ' . (int) $state);
		}

		// Determine if there is checkin support for the table.
		if (property_exists($this, 'checked_out') || property_exists($this, 'checked_out_time'))
		{
			$query->where('(checked_out = 0 OR checked_out = ' . (int) $userId . ')');
			$checkin = true;
		}
		else
		{
			$checkin = false;
		}

		// Build the WHERE clause for the primary keys.
		$query->where($k . ' = ' . implode(' OR ' . $k . ' = ', $pks));

		$this->_db->setQuery($query);

		// Check for a database error.
		if (!$this->_db->execute())
		{
			$e = new JException(JText::sprintf('JLIB_DATABASE_ERROR_PUBLISH_FAILED', get_class($this), $this->_db->getErrorMsg()));
			$this->setError($e);

			return false;
		}

		// If checkin is supported and all rows were adjusted, check them in.
		if ($checkin && (count($pks) == $this->_db->getAffectedRows()))
		{
			// Checkin the rows.
			foreach
			($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// If the JTable instance value is in the list of primary keys that were set, set the instance.
		if (in_array($this->$k, $pks))
		{
			$this->state = $state;
		}

		$this->setError('');
		return true;
	}
}
