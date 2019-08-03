<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		countries.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Realestatenow Model for Countries
 */
class RealestatenowModelCountries extends JModelList
{
	/**
	 * Model user data.
	 *
	 * @var        strings
	 */
	protected $user;
	protected $userId;
	protected $guest;
	protected $groups;
	protected $levels;
	protected $app;
	protected $input;
	protected $uikitComp;

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// Get the current user for authorisation checks
		$this->user = JFactory::getUser();
		$this->userId = $this->user->get('id');
		$this->guest = $this->user->get('guest');
		$this->groups = $this->user->get('groups');
		$this->authorisedGroups = $this->user->getAuthorisedGroups();
		$this->levels = $this->user->getAuthorisedViewLevels();
		$this->app = JFactory::getApplication();
		$this->input = $this->app->input;
		$this->initSet = true; 
		// [Interpretation 3018] Get a db connection.
		$db = JFactory::getDbo();

		// [Interpretation 3027] Create a new query object.
		$query = $db->getQuery(true);

		// [Interpretation 1592] Get from #__realestatenow_country as a
		$query->select($db->quoteName(
			array('a.id','a.asset_id','a.name','a.alias','a.image','a.description','a.owncoords','a.latitude','a.longitude','a.published','a.created_by','a.modified_by','a.created','a.modified','a.version','a.hits','a.ordering'),
			array('id','asset_id','name','alias','image','description','owncoords','latitude','longitude','published','created_by','modified_by','created','modified','version','hits','ordering')));
		$query->from($db->quoteName('#__realestatenow_country', 'a'));
		$query->where('a.access IN (' . implode(',', $this->levels) . ')');
		// [Interpretation 2167] Get where a.published is 1
		$query->where('a.published = 1');
		$query->order('a.name ASC');

		// [Interpretation 3042] return the query object
		return $query;
	}

	/**
	 * Method to get an array of data items.
	 *
	 * @return  mixed  An array of data items on success, false on failure.
	 */
	public function getItems()
	{
		$user = JFactory::getUser();
		// [Interpretation 2263] check if this user has permission to access item
		if (!$user->authorise('site.countries.access', 'com_realestatenow'))
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('COM_REALESTATENOW_NOT_AUTHORISED_TO_VIEW_COUNTRIES'), 'error');
			// [Interpretation 2260] redirect away to the home page if no access allowed.
			$app->redirect(JURI::root());
			return false;
		}
		// load parent items
		$items = parent::getItems();

		// Get the global params
		$globalParams = JComponentHelper::getParams('com_realestatenow', true);

		// [Interpretation 3068] Insure all item fields are adapted where needed.
		if (RealestatenowHelper::checkArray($items))
		{
			// [Interpretation 1842] Load the JEvent Dispatcher
			JPluginHelper::importPlugin('content');
			$this->_dispatcher = JEventDispatcher::getInstance();
			foreach ($items as $nr => &$item)
			{
				// [Interpretation 3074] Always create a slug for sef URL's
				$item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
				// [Interpretation 1848] Check if item has params, or pass whole item.
				$params = (isset($item->params) && RealestatenowHelper::checkJson($item->params)) ? json_decode($item->params) : $item;
				// [Interpretation 1852] Make sure the content prepare plugins fire on description
				$_description = new stdClass();
				$_description->text =& $item->description; // [Interpretation 1854] value must be in text
				// [Interpretation 1855] Since all values are now in text (Joomla Limitation), we also add the field name (description) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.countries.description', &$_description, &$params, 0));
				// [Interpretation 1883] Checking if description has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->description,$this->uikitComp);
			}
		}

		// return items
		return $items;
	}

	/**
	 * Get the uikit needed components
	 *
	 * @return mixed  An array of objects on success.
	 *
	 */
	public function getUikitComp()
	{
		if (isset($this->uikitComp) && RealestatenowHelper::checkArray($this->uikitComp))
		{
			return $this->uikitComp;
		}
		return false;
	}
}
