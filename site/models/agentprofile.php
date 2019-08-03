<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		agentprofile.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Realestatenow Agentprofile Model
 */
class RealestatenowModelAgentprofile extends JModelItem
{
	/**
	 * Model context string.
	 *
	 * @var        string
	 */
	protected $_context = 'com_realestatenow.agentprofile';

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
	 * @var object item
	 */
	protected $item;

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since   1.6
	 *
	 * @return void
	 */
	protected function populateState()
	{
		$this->app = JFactory::getApplication();
		$this->input = $this->app->input;
		// Get the itme main id
		$id = $this->input->getInt('id', null);
		$this->setState('agentprofile.id', $id);

		// Load the parameters.
		$params = $this->app->getParams();
		$this->setState('params', $params);
		parent::populateState();
	}

	/**
	 * Method to get article data.
	 *
	 * @param   integer  $pk  The id of the article.
	 *
	 * @return  mixed  Menu item data object on success, false on failure.
	 */
	public function getItem($pk = null)
	{
		$this->user = JFactory::getUser();
		// [Interpretation 2263] check if this user has permission to access item
		if (!$this->user->authorise('site.agentprofile.access', 'com_realestatenow'))
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('COM_REALESTATENOW_NOT_AUTHORISED_TO_VIEW_AGENTPROFILE'), 'error');
			// [Interpretation 2255] redirect away to the default view if no access allowed.
			$app->redirect(JRoute::_('index.php?option=com_realestatenow&view=properties'));
			return false;
		}
		$this->userId = $this->user->get('id');
		$this->guest = $this->user->get('guest');
		$this->groups = $this->user->get('groups');
		$this->authorisedGroups = $this->user->getAuthorisedGroups();
		$this->levels = $this->user->getAuthorisedViewLevels();
		$this->initSet = true;

		$pk = (!empty($pk)) ? $pk : (int) $this->getState('agentprofile.id');
		
		if ($this->_item === null)
		{
			$this->_item = array();
		}

		if (!isset($this->_item[$pk]))
		{
			try
			{
				// [Interpretation 2309] Get a db connection.
				$db = JFactory::getDbo();

				// [Interpretation 2311] Create a new query object.
				$query = $db->getQuery(true);

				// [Interpretation 1592] Get from #__realestatenow_agent as a
				$query->select($db->quoteName(
			array('a.id','a.asset_id','a.street','a.streettwo','a.countryid','a.cityid','a.stateid','a.postcode','a.uid','a.email','a.phone','a.mobile','a.fax','a.image','a.bio','a.name','a.alias','a.catid','a.agencyid','a.featured','a.default_agent_yn','a.viewad','a.rets_source','a.owncoords','a.latitude','a.longitude','a.fbook','a.twitter','a.pinterest','a.linkedin','a.youtube','a.gplus','a.skype','a.instagram','a.website','a.blog','a.settings_id','a.published','a.created_by','a.modified_by','a.created','a.modified','a.version','a.hits','a.ordering'),
			array('id','asset_id','street','streettwo','countryid','cityid','stateid','postcode','uid','email','phone','mobile','fax','image','bio','name','alias','catid','agencyid','featured','default_agent_yn','viewad','rets_source','owncoords','latitude','longitude','fbook','twitter','pinterest','linkedin','youtube','gplus','skype','instagram','website','blog','settings_id','published','created_by','modified_by','created','modified','version','hits','ordering')));
				$query->from($db->quoteName('#__realestatenow_agent', 'a'));

				// [Interpretation 1592] Get from #__realestatenow_agency as b
				$query->select($db->quoteName(
			array('b.name'),
			array('agency_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_agency', 'b')) . ' ON (' . $db->quoteName('a.agencyid') . ' = ' . $db->quoteName('b.id') . ')');

				// [Interpretation 1592] Get from #__realestatenow_country as c
				$query->select($db->quoteName(
			array('c.name'),
			array('country_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_country', 'c')) . ' ON (' . $db->quoteName('a.countryid') . ' = ' . $db->quoteName('c.id') . ')');

				// [Interpretation 1592] Get from #__realestatenow_state as d
				$query->select($db->quoteName(
			array('d.name'),
			array('state_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_state', 'd')) . ' ON (' . $db->quoteName('a.stateid') . ' = ' . $db->quoteName('d.id') . ')');

				// [Interpretation 1592] Get from #__realestatenow_city as e
				$query->select($db->quoteName(
			array('e.name'),
			array('city_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_city', 'e')) . ' ON (' . $db->quoteName('a.cityid') . ' = ' . $db->quoteName('e.id') . ')');
				$query->where('a.access IN (' . implode(',', $this->levels) . ')');
				$query->where('a.created_by = ' . (int) $this->userId);
				// [Interpretation 2167] Get where a.published is 1
				$query->where('a.published = 1');

				// [Interpretation 2322] Reset the query using our newly populated query object.
				$db->setQuery($query);
				// [Interpretation 2324] Load the results as a stdClass object.
				$data = $db->loadObject();

				if (empty($data))
				{
					$app = JFactory::getApplication();
					// [Interpretation 2341] If no data is found redirect to default page and show warning.
					$app->enqueueMessage(JText::_('COM_REALESTATENOW_NOT_FOUND_OR_ACCESS_DENIED'), 'warning');
					$app->redirect(JRoute::_('index.php?option=com_realestatenow&view=properties'));
					return false;
				}
			// [Interpretation 1842] Load the JEvent Dispatcher
			JPluginHelper::importPlugin('content');
			$this->_dispatcher = JEventDispatcher::getInstance();
				// [Interpretation 1848] Check if item has params, or pass whole item.
				$params = (isset($data->params) && RealestatenowHelper::checkJson($data->params)) ? json_decode($data->params) : $data;
				// [Interpretation 1852] Make sure the content prepare plugins fire on bio
				$_bio = new stdClass();
				$_bio->text =& $data->bio; // [Interpretation 1854] value must be in text
				// [Interpretation 1855] Since all values are now in text (Joomla Limitation), we also add the field name (bio) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.agentprofile.bio', &$_bio, &$params, 0));
				// [Interpretation 1883] Checking if bio has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($data->bio,$this->uikitComp);

				// [Interpretation 2452] set data object to item.
				$this->_item[$pk] = $data;
			}
			catch (Exception $e)
			{
				if ($e->getCode() == 404)
				{
					// Need to go thru the error handler to allow Redirect to work.
					JError::raiseWaring(404, $e->getMessage());
				}
				else
				{
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}
		}

		return $this->_item[$pk];
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
