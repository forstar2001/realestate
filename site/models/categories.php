<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		categories.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Realestatenow Model for Categories
 */
class RealestatenowModelCategories extends JModelList
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

		// [Interpretation 1592] Get from #__categories as a
		$query->select($db->quoteName(
			array('a.id','a.asset_id','a.parent_id','a.lft','a.rgt','a.level','a.path','a.extension','a.title','a.alias','a.note','a.description','a.published','a.checked_out','a.checked_out_time','a.access','a.params','a.metadesc','a.metakey','a.metadata','a.created_user_id','a.created_time','a.modified_user_id','a.modified_time','a.hits','a.language','a.version'),
			array('id','asset_id','parent_id','lft','rgt','level','path','extension','title','alias','note','description','published','checked_out','checked_out_time','access','params','metadesc','metakey','metadata','created_user_id','created_time','modified_user_id','modified_time','hits','language','version')));
		$query->from($db->quoteName('#__categories', 'a'));
		$query->where('a.access IN (' . implode(',', $this->levels) . ')');
		// [Interpretation 2167] Get where a.published is 1
		$query->where('a.published = 1');
		// [Interpretation 2167] Get where a.extension is "com_realestatenow.properties"
		$query->where('a.extension = "com_realestatenow.properties"');
		$query->order('a.lft ASC');

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
		if (!$user->authorise('site.categories.access', 'com_realestatenow'))
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('COM_REALESTATENOW_NOT_AUTHORISED_TO_VIEW_CATEGORIES'), 'error');
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
			foreach ($items as $nr => &$item)
			{
				// [Interpretation 3074] Always create a slug for sef URL's
				$item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
			}
		}


		if (RealestatenowHelper::checkArray($items))
		{
			foreach ($items as $nr => &$item)
			{

                         	//get category image
                                $item->image = json_decode($item->params)->image;
                                $item->image_alt = json_decode($item->params)->image_alt;
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
