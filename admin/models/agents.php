<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		agents.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Agents Model
 */
class RealestatenowModelAgents extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
        {
			$config['filter_fields'] = array(
				'a.id','id',
				'a.published','published',
				'a.ordering','ordering',
				'a.created_by','created_by',
				'a.modified_by','modified_by',
				'a.name','name',
				'a.cityid','cityid',
				'a.stateid','stateid',
				'c.title','category_title',
				'c.id', 'category_id',
				'a.catid', 'catid',
				'a.agencyid','agencyid'
			);
		}

		parent::__construct($config);
	}
	
	/**
	 * Method to auto-populate the model state.
	 *
	 * @return  void
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();

		// Adjust the context to support modal layouts.
		if ($layout = $app->input->get('layout'))
		{
			$this->context .= '.' . $layout;
		}
		$name = $this->getUserStateFromRequest($this->context . '.filter.name', 'filter_name');
		$this->setState('filter.name', $name);

		$cityid = $this->getUserStateFromRequest($this->context . '.filter.cityid', 'filter_cityid');
		$this->setState('filter.cityid', $cityid);

		$stateid = $this->getUserStateFromRequest($this->context . '.filter.stateid', 'filter_stateid');
		$this->setState('filter.stateid', $stateid);

		$category = $app->getUserStateFromRequest($this->context . '.filter.category', 'filter_category');
		$this->setState('filter.category', $category);

		$categoryId = $this->getUserStateFromRequest($this->context . '.filter.category_id', 'filter_category_id');
		$this->setState('filter.category_id', $categoryId);

		$catid = $app->getUserStateFromRequest($this->context . '.filter.catid', 'filter_catid');
		$this->setState('filter.catid', $catid);

		$agencyid = $this->getUserStateFromRequest($this->context . '.filter.agencyid', 'filter_agencyid');
		$this->setState('filter.agencyid', $agencyid);
        
		$sorting = $this->getUserStateFromRequest($this->context . '.filter.sorting', 'filter_sorting', 0, 'int');
		$this->setState('filter.sorting', $sorting);
        
		$access = $this->getUserStateFromRequest($this->context . '.filter.access', 'filter_access', 0, 'int');
		$this->setState('filter.access', $access);
        
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);
        
		$created_by = $this->getUserStateFromRequest($this->context . '.filter.created_by', 'filter_created_by', '');
		$this->setState('filter.created_by', $created_by);

		$created = $this->getUserStateFromRequest($this->context . '.filter.created', 'filter_created');
		$this->setState('filter.created', $created);

		// List state information.
		parent::populateState($ordering, $direction);
	}
	
	/**
	 * Method to get an array of data items.
	 *
	 * @return  mixed  An array of data items on success, false on failure.
	 */
	public function getItems()
	{
		// [Interpretation 12194] check in items
		$this->checkInNow();

		// load parent items
		$items = parent::getItems();

		// [Interpretation 12525] set values to display correctly.
		if (RealestatenowHelper::checkArray($items))
		{
			foreach ($items as $nr => &$item)
			{
				$access = (JFactory::getUser()->authorise('agent.access', 'com_realestatenow.agent.' . (int) $item->id) && JFactory::getUser()->authorise('agent.access', 'com_realestatenow'));
				if (!$access)
				{
					unset($items[$nr]);
					continue;
				}

			}
		}
        
		// return items
		return $items;
	}
	
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{
		// [Interpretation 9076] Get the user object.
		$user = JFactory::getUser();
		// [Interpretation 9078] Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// [Interpretation 9081] Select some fields
		$query->select('a.*');
		$query->select($db->quoteName('c.title','category_title'));

		// [Interpretation 9088] From the realestatenow_item table
		$query->from($db->quoteName('#__realestatenow_agent', 'a'));
		$query->join('LEFT', $db->quoteName('#__categories', 'c') . ' ON (' . $db->quoteName('a.catid') . ' = ' . $db->quoteName('c.id') . ')');

		// [Interpretation 9227] From the realestatenow_city table.
		$query->select($db->quoteName('g.name','cityid_name'));
		$query->join('LEFT', $db->quoteName('#__realestatenow_city', 'g') . ' ON (' . $db->quoteName('a.cityid') . ' = ' . $db->quoteName('g.id') . ')');

		// [Interpretation 9227] From the realestatenow_state table.
		$query->select($db->quoteName('h.name','stateid_name'));
		$query->join('LEFT', $db->quoteName('#__realestatenow_state', 'h') . ' ON (' . $db->quoteName('a.stateid') . ' = ' . $db->quoteName('h.id') . ')');

		// [Interpretation 9227] From the realestatenow_agency table.
		$query->select($db->quoteName('i.name','agencyid_name'));
		$query->join('LEFT', $db->quoteName('#__realestatenow_agency', 'i') . ' ON (' . $db->quoteName('a.agencyid') . ' = ' . $db->quoteName('i.id') . ')');

		// [Interpretation 9099] Filter by published state
		$published = $this->getState('filter.published');
		if (is_numeric($published))
		{
			$query->where('a.published = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.published = 0 OR a.published = 1)');
		}

		// [Interpretation 9111] Join over the asset groups.
		$query->select('ag.title AS access_level');
		$query->join('LEFT', '#__viewlevels AS ag ON ag.id = a.access');
		// [Interpretation 9114] Filter by access level.
		if ($access = $this->getState('filter.access'))
		{
			$query->where('a.access = ' . (int) $access);
		}
		// [Interpretation 9119] Implement View Level Access
		if (!$user->authorise('core.options', 'com_realestatenow'))
		{
			$groups = implode(',', $user->getAuthorisedViewLevels());
			$query->where('a.access IN (' . $groups . ')');
		}
		// [Interpretation 9196] Filter by search.
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->quote('%' . $db->escape($search) . '%');
				$query->where('(a.name LIKE '.$search.' OR a.street LIKE '.$search.' OR a.cityid LIKE '.$search.' OR g.name LIKE '.$search.' OR a.stateid LIKE '.$search.' OR h.name LIKE '.$search.' OR a.email LIKE '.$search.' OR a.postcode LIKE '.$search.' OR a.bio LIKE '.$search.' OR a.fax LIKE '.$search.' OR a.mobile LIKE '.$search.' OR a.phone LIKE '.$search.' OR a.countryid LIKE '.$search.' OR a.streettwo LIKE '.$search.')');
			}
		}

		// [Interpretation 9247] Filter by cityid.
		if ($cityid = $this->getState('filter.cityid'))
		{
			$query->where('a.cityid = ' . $db->quote($db->escape($cityid)));
		}
		// [Interpretation 9247] Filter by stateid.
		if ($stateid = $this->getState('filter.stateid'))
		{
			$query->where('a.stateid = ' . $db->quote($db->escape($stateid)));
		}
		// [Interpretation 9247] Filter by agencyid.
		if ($agencyid = $this->getState('filter.agencyid'))
		{
			$query->where('a.agencyid = ' . $db->quote($db->escape($agencyid)));
		}

		// [Interpretation 9133] Filter by a single or group of categories.
		$baselevel = 1;
		$categoryId = $this->getState('filter.category_id');

		if (is_numeric($categoryId))
		{
			$cat_tbl = JTable::getInstance('Category', 'JTable');
			$cat_tbl->load($categoryId);
			$rgt = $cat_tbl->rgt;
			$lft = $cat_tbl->lft;
			$baselevel = (int) $cat_tbl->level;
			$query->where('c.lft >= ' . (int) $lft)
				->where('c.rgt <= ' . (int) $rgt);
		}
		elseif (is_array($categoryId))
		{
			JArrayHelper::toInteger($categoryId);
			$categoryId = implode(',', $categoryId);
			$query->where('a.category IN (' . $categoryId . ')');
		}


		// [Interpretation 9155] Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'a.id');
		$orderDirn = $this->state->get('list.direction', 'asc');	
		if ($orderCol != '')
		{
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}

		return $query;
	}

	/**
	 * Method to get list export data.
	 *
	 * @return mixed  An array of data items on success, false on failure.
	 */
	public function getExportData($pks)
	{
		// [Interpretation 8847] setup the query
		if (RealestatenowHelper::checkArray($pks))
		{
			// [Interpretation 8850] Set a value to know this is exporting method.
			$_export = true;
			// [Interpretation 8852] Get the user object.
			$user = JFactory::getUser();
			// [Interpretation 8854] Create a new query object.
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);

			// [Interpretation 8857] Select some fields
			$query->select('a.*');

			// [Interpretation 8859] From the realestatenow_agent table
			$query->from($db->quoteName('#__realestatenow_agent', 'a'));
			$query->where('a.id IN (' . implode(',',$pks) . ')');
			// [Interpretation 8867] Implement View Level Access
			if (!$user->authorise('core.options', 'com_realestatenow'))
			{
				$groups = implode(',', $user->getAuthorisedViewLevels());
				$query->where('a.access IN (' . $groups . ')');
			}

			// [Interpretation 8874] Order the results by ordering
			$query->order('a.ordering  ASC');

			// [Interpretation 8876] Load the items
			$db->setQuery($query);
			$db->execute();
			if ($db->getNumRows())
			{
				$items = $db->loadObjectList();

				// [Interpretation 12525] set values to display correctly.
				if (RealestatenowHelper::checkArray($items))
				{
					foreach ($items as $nr => &$item)
					{
						$access = (JFactory::getUser()->authorise('agent.access', 'com_realestatenow.agent.' . (int) $item->id) && JFactory::getUser()->authorise('agent.access', 'com_realestatenow'));
						if (!$access)
						{
							unset($items[$nr]);
							continue;
						}

						// [Interpretation 12533] unset the values we don't want exported.
						unset($item->asset_id);
						unset($item->checked_out);
						unset($item->checked_out_time);
					}
				}
				// [Interpretation 12542] Add headers to items array.
				$headers = $this->getExImPortHeaders();
				if (RealestatenowHelper::checkObject($headers))
				{
					array_unshift($items,$headers);
				}
				return $items;
			}
		}
		return false;
	}

	/**
	* Method to get header.
	*
	* @return mixed  An array of data items on success, false on failure.
	*/
	public function getExImPortHeaders()
	{
		// Get a db connection.
		$db = JFactory::getDbo();
		// get the columns
		$columns = $db->getTableColumns("#__realestatenow_agent");
		if (RealestatenowHelper::checkArray($columns))
		{
			// remove the headers you don't import/export.
			unset($columns['asset_id']);
			unset($columns['checked_out']);
			unset($columns['checked_out_time']);
			$headers = new stdClass();
			foreach ($columns as $column => $type)
			{
				$headers->{$column} = $column;
			}
			return $headers;
		}
		return false;
	}
	
	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * @return  string  A store id.
	 *
	 */
	protected function getStoreId($id = '')
	{
		// [Interpretation 11796] Compile the store id.
		$id .= ':' . $this->getState('filter.id');
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.published');
		$id .= ':' . $this->getState('filter.ordering');
		$id .= ':' . $this->getState('filter.created_by');
		$id .= ':' . $this->getState('filter.modified_by');
		$id .= ':' . $this->getState('filter.name');
		$id .= ':' . $this->getState('filter.cityid');
		$id .= ':' . $this->getState('filter.stateid');
		$id .= ':' . $this->getState('filter.category');
		$id .= ':' . $this->getState('filter.category_id');
		$id .= ':' . $this->getState('filter.catid');
		$id .= ':' . $this->getState('filter.agencyid');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to checkin all items left checked out longer then a set time.
	 *
	 * @return  a bool
	 *
	 */
	protected function checkInNow()
	{
		// [Interpretation 12210] Get set check in time
		$time = JComponentHelper::getParams('com_realestatenow')->get('check_in');

		if ($time)
		{

			// [Interpretation 12214] Get a db connection.
			$db = JFactory::getDbo();
			// [Interpretation 12216] reset query
			$query = $db->getQuery(true);
			$query->select('*');
			$query->from($db->quoteName('#__realestatenow_agent'));
			$db->setQuery($query);
			$db->execute();
			if ($db->getNumRows())
			{
				// [Interpretation 12224] Get Yesterdays date
				$date = JFactory::getDate()->modify($time)->toSql();
				// [Interpretation 12226] reset query
				$query = $db->getQuery(true);

				// [Interpretation 12228] Fields to update.
				$fields = array(
					$db->quoteName('checked_out_time') . '=\'0000-00-00 00:00:00\'',
					$db->quoteName('checked_out') . '=0'
				);

				// [Interpretation 12233] Conditions for which records should be updated.
				$conditions = array(
					$db->quoteName('checked_out') . '!=0', 
					$db->quoteName('checked_out_time') . '<\''.$date.'\''
				);

				// [Interpretation 12238] Check table
				$query->update($db->quoteName('#__realestatenow_agent'))->set($fields)->where($conditions); 

				$db->setQuery($query);

				$db->execute();
			}
		}

		return false;
	}
}
