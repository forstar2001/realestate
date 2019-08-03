<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		script.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.modal');

/**
 * Script File of Realestatenow Component
 */
class com_realestatenowInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent)
	{

	}

	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent)
	{
		// [Interpretation 4847] Get Application object
		$app = JFactory::getApplication();

		// [Interpretation 4849] Get The Database object
		$db = JFactory::getDbo();

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Country alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.country') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$country_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($country_found)
		{
			// [Interpretation 4960] Since there are load the needed  country type ids
			$country_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Country from the content type table
			$country_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.country') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($country_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Country items
			$country_done = $db->execute();
			if ($country_done)
			{
				// [Interpretation 4975] If succesfully remove Country add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.country) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Country items from the contentitem tag map table
			$country_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.country') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($country_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Country items
			$country_done = $db->execute();
			if ($country_done)
			{
				// [Interpretation 4992] If succesfully remove Country add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.country) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Country items from the ucm content table
			$country_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.country') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($country_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Country items
			$country_done = $db->execute();
			if ($country_done)
			{
				// [Interpretation 5009] If succesfully remove Country add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.country) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Country items are cleared from DB
			foreach ($country_ids as $country_id)
			{
				// [Interpretation 5020] Remove Country items from the ucm base table
				$country_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $country_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($country_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Country items
				$db->execute();

				// [Interpretation 5031] Remove Country items from the ucm history table
				$country_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $country_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($country_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Country items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where State alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.state') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$state_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($state_found)
		{
			// [Interpretation 4960] Since there are load the needed  state type ids
			$state_ids = $db->loadColumn();
			// [Interpretation 4964] Remove State from the content type table
			$state_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.state') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($state_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove State items
			$state_done = $db->execute();
			if ($state_done)
			{
				// [Interpretation 4975] If succesfully remove State add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.state) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove State items from the contentitem tag map table
			$state_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.state') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($state_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove State items
			$state_done = $db->execute();
			if ($state_done)
			{
				// [Interpretation 4992] If succesfully remove State add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.state) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove State items from the ucm content table
			$state_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.state') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($state_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove State items
			$state_done = $db->execute();
			if ($state_done)
			{
				// [Interpretation 5009] If succesfully remove State add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.state) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the State items are cleared from DB
			foreach ($state_ids as $state_id)
			{
				// [Interpretation 5020] Remove State items from the ucm base table
				$state_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $state_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($state_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove State items
				$db->execute();

				// [Interpretation 5031] Remove State items from the ucm history table
				$state_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $state_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($state_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove State items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where City alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.city') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$city_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($city_found)
		{
			// [Interpretation 4960] Since there are load the needed  city type ids
			$city_ids = $db->loadColumn();
			// [Interpretation 4964] Remove City from the content type table
			$city_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.city') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($city_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove City items
			$city_done = $db->execute();
			if ($city_done)
			{
				// [Interpretation 4975] If succesfully remove City add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.city) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove City items from the contentitem tag map table
			$city_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.city') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($city_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove City items
			$city_done = $db->execute();
			if ($city_done)
			{
				// [Interpretation 4992] If succesfully remove City add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.city) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove City items from the ucm content table
			$city_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.city') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($city_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove City items
			$city_done = $db->execute();
			if ($city_done)
			{
				// [Interpretation 5009] If succesfully remove City add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.city) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the City items are cleared from DB
			foreach ($city_ids as $city_id)
			{
				// [Interpretation 5020] Remove City items from the ucm base table
				$city_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $city_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($city_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove City items
				$db->execute();

				// [Interpretation 5031] Remove City items from the ucm history table
				$city_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $city_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($city_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove City items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Agency alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.agency') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$agency_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($agency_found)
		{
			// [Interpretation 4960] Since there are load the needed  agency type ids
			$agency_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Agency from the content type table
			$agency_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.agency') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($agency_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Agency items
			$agency_done = $db->execute();
			if ($agency_done)
			{
				// [Interpretation 4975] If succesfully remove Agency add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.agency) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Agency items from the contentitem tag map table
			$agency_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.agency') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($agency_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Agency items
			$agency_done = $db->execute();
			if ($agency_done)
			{
				// [Interpretation 4992] If succesfully remove Agency add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.agency) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Agency items from the ucm content table
			$agency_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.agency') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($agency_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Agency items
			$agency_done = $db->execute();
			if ($agency_done)
			{
				// [Interpretation 5009] If succesfully remove Agency add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.agency) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Agency items are cleared from DB
			foreach ($agency_ids as $agency_id)
			{
				// [Interpretation 5020] Remove Agency items from the ucm base table
				$agency_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $agency_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($agency_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Agency items
				$db->execute();

				// [Interpretation 5031] Remove Agency items from the ucm history table
				$agency_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $agency_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($agency_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Agency items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Agent alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.agent') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$agent_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($agent_found)
		{
			// [Interpretation 4960] Since there are load the needed  agent type ids
			$agent_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Agent from the content type table
			$agent_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.agent') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($agent_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Agent items
			$agent_done = $db->execute();
			if ($agent_done)
			{
				// [Interpretation 4975] If succesfully remove Agent add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.agent) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Agent items from the contentitem tag map table
			$agent_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.agent') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($agent_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Agent items
			$agent_done = $db->execute();
			if ($agent_done)
			{
				// [Interpretation 4992] If succesfully remove Agent add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.agent) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Agent items from the ucm content table
			$agent_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.agent') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($agent_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Agent items
			$agent_done = $db->execute();
			if ($agent_done)
			{
				// [Interpretation 5009] If succesfully remove Agent add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.agent) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Agent items are cleared from DB
			foreach ($agent_ids as $agent_id)
			{
				// [Interpretation 5020] Remove Agent items from the ucm base table
				$agent_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $agent_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($agent_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Agent items
				$db->execute();

				// [Interpretation 5031] Remove Agent items from the ucm history table
				$agent_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $agent_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($agent_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Agent items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Agent catid alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.agents.category') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$agent_catid_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($agent_catid_found)
		{
			// [Interpretation 4960] Since there are load the needed  agent_catid type ids
			$agent_catid_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Agent catid from the content type table
			$agent_catid_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.agents.category') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($agent_catid_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Agent catid items
			$agent_catid_done = $db->execute();
			if ($agent_catid_done)
			{
				// [Interpretation 4975] If succesfully remove Agent catid add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.agents.category) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Agent catid items from the contentitem tag map table
			$agent_catid_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.agents.category') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($agent_catid_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Agent catid items
			$agent_catid_done = $db->execute();
			if ($agent_catid_done)
			{
				// [Interpretation 4992] If succesfully remove Agent catid add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.agents.category) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Agent catid items from the ucm content table
			$agent_catid_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.agents.category') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($agent_catid_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Agent catid items
			$agent_catid_done = $db->execute();
			if ($agent_catid_done)
			{
				// [Interpretation 5009] If succesfully remove Agent catid add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.agents.category) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Agent catid items are cleared from DB
			foreach ($agent_catid_ids as $agent_catid_id)
			{
				// [Interpretation 5020] Remove Agent catid items from the ucm base table
				$agent_catid_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $agent_catid_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($agent_catid_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Agent catid items
				$db->execute();

				// [Interpretation 5031] Remove Agent catid items from the ucm history table
				$agent_catid_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $agent_catid_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($agent_catid_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Agent catid items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Property alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.property') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$property_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($property_found)
		{
			// [Interpretation 4960] Since there are load the needed  property type ids
			$property_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Property from the content type table
			$property_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.property') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($property_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Property items
			$property_done = $db->execute();
			if ($property_done)
			{
				// [Interpretation 4975] If succesfully remove Property add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.property) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Property items from the contentitem tag map table
			$property_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.property') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($property_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Property items
			$property_done = $db->execute();
			if ($property_done)
			{
				// [Interpretation 4992] If succesfully remove Property add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.property) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Property items from the ucm content table
			$property_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.property') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($property_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Property items
			$property_done = $db->execute();
			if ($property_done)
			{
				// [Interpretation 5009] If succesfully remove Property add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.property) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Property items are cleared from DB
			foreach ($property_ids as $property_id)
			{
				// [Interpretation 5020] Remove Property items from the ucm base table
				$property_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $property_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($property_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Property items
				$db->execute();

				// [Interpretation 5031] Remove Property items from the ucm history table
				$property_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $property_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($property_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Property items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Property catid alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.properties.category') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$property_catid_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($property_catid_found)
		{
			// [Interpretation 4960] Since there are load the needed  property_catid type ids
			$property_catid_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Property catid from the content type table
			$property_catid_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.properties.category') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($property_catid_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Property catid items
			$property_catid_done = $db->execute();
			if ($property_catid_done)
			{
				// [Interpretation 4975] If succesfully remove Property catid add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.properties.category) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Property catid items from the contentitem tag map table
			$property_catid_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.properties.category') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($property_catid_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Property catid items
			$property_catid_done = $db->execute();
			if ($property_catid_done)
			{
				// [Interpretation 4992] If succesfully remove Property catid add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.properties.category) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Property catid items from the ucm content table
			$property_catid_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.properties.category') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($property_catid_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Property catid items
			$property_catid_done = $db->execute();
			if ($property_catid_done)
			{
				// [Interpretation 5009] If succesfully remove Property catid add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.properties.category) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Property catid items are cleared from DB
			foreach ($property_catid_ids as $property_catid_id)
			{
				// [Interpretation 5020] Remove Property catid items from the ucm base table
				$property_catid_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $property_catid_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($property_catid_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Property catid items
				$db->execute();

				// [Interpretation 5031] Remove Property catid items from the ucm history table
				$property_catid_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $property_catid_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($property_catid_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Property catid items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Residential alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.residential') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$residential_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($residential_found)
		{
			// [Interpretation 4960] Since there are load the needed  residential type ids
			$residential_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Residential from the content type table
			$residential_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.residential') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($residential_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Residential items
			$residential_done = $db->execute();
			if ($residential_done)
			{
				// [Interpretation 4975] If succesfully remove Residential add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.residential) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Residential items from the contentitem tag map table
			$residential_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.residential') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($residential_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Residential items
			$residential_done = $db->execute();
			if ($residential_done)
			{
				// [Interpretation 4992] If succesfully remove Residential add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.residential) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Residential items from the ucm content table
			$residential_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.residential') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($residential_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Residential items
			$residential_done = $db->execute();
			if ($residential_done)
			{
				// [Interpretation 5009] If succesfully remove Residential add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.residential) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Residential items are cleared from DB
			foreach ($residential_ids as $residential_id)
			{
				// [Interpretation 5020] Remove Residential items from the ucm base table
				$residential_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $residential_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($residential_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Residential items
				$db->execute();

				// [Interpretation 5031] Remove Residential items from the ucm history table
				$residential_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $residential_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($residential_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Residential items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Land alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.land') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$land_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($land_found)
		{
			// [Interpretation 4960] Since there are load the needed  land type ids
			$land_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Land from the content type table
			$land_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.land') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($land_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Land items
			$land_done = $db->execute();
			if ($land_done)
			{
				// [Interpretation 4975] If succesfully remove Land add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.land) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Land items from the contentitem tag map table
			$land_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.land') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($land_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Land items
			$land_done = $db->execute();
			if ($land_done)
			{
				// [Interpretation 4992] If succesfully remove Land add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.land) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Land items from the ucm content table
			$land_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.land') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($land_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Land items
			$land_done = $db->execute();
			if ($land_done)
			{
				// [Interpretation 5009] If succesfully remove Land add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.land) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Land items are cleared from DB
			foreach ($land_ids as $land_id)
			{
				// [Interpretation 5020] Remove Land items from the ucm base table
				$land_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $land_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($land_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Land items
				$db->execute();

				// [Interpretation 5031] Remove Land items from the ucm history table
				$land_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $land_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($land_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Land items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Commercial alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.commercial') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$commercial_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($commercial_found)
		{
			// [Interpretation 4960] Since there are load the needed  commercial type ids
			$commercial_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Commercial from the content type table
			$commercial_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.commercial') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($commercial_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Commercial items
			$commercial_done = $db->execute();
			if ($commercial_done)
			{
				// [Interpretation 4975] If succesfully remove Commercial add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.commercial) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Commercial items from the contentitem tag map table
			$commercial_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.commercial') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($commercial_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Commercial items
			$commercial_done = $db->execute();
			if ($commercial_done)
			{
				// [Interpretation 4992] If succesfully remove Commercial add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.commercial) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Commercial items from the ucm content table
			$commercial_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.commercial') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($commercial_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Commercial items
			$commercial_done = $db->execute();
			if ($commercial_done)
			{
				// [Interpretation 5009] If succesfully remove Commercial add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.commercial) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Commercial items are cleared from DB
			foreach ($commercial_ids as $commercial_id)
			{
				// [Interpretation 5020] Remove Commercial items from the ucm base table
				$commercial_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $commercial_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($commercial_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Commercial items
				$db->execute();

				// [Interpretation 5031] Remove Commercial items from the ucm history table
				$commercial_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $commercial_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($commercial_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Commercial items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Multifamily alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.multifamily') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$multifamily_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($multifamily_found)
		{
			// [Interpretation 4960] Since there are load the needed  multifamily type ids
			$multifamily_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Multifamily from the content type table
			$multifamily_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.multifamily') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($multifamily_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Multifamily items
			$multifamily_done = $db->execute();
			if ($multifamily_done)
			{
				// [Interpretation 4975] If succesfully remove Multifamily add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.multifamily) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Multifamily items from the contentitem tag map table
			$multifamily_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.multifamily') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($multifamily_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Multifamily items
			$multifamily_done = $db->execute();
			if ($multifamily_done)
			{
				// [Interpretation 4992] If succesfully remove Multifamily add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.multifamily) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Multifamily items from the ucm content table
			$multifamily_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.multifamily') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($multifamily_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Multifamily items
			$multifamily_done = $db->execute();
			if ($multifamily_done)
			{
				// [Interpretation 5009] If succesfully remove Multifamily add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.multifamily) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Multifamily items are cleared from DB
			foreach ($multifamily_ids as $multifamily_id)
			{
				// [Interpretation 5020] Remove Multifamily items from the ucm base table
				$multifamily_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $multifamily_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($multifamily_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Multifamily items
				$db->execute();

				// [Interpretation 5031] Remove Multifamily items from the ucm history table
				$multifamily_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $multifamily_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($multifamily_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Multifamily items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Area alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.area') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$area_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($area_found)
		{
			// [Interpretation 4960] Since there are load the needed  area type ids
			$area_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Area from the content type table
			$area_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.area') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($area_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Area items
			$area_done = $db->execute();
			if ($area_done)
			{
				// [Interpretation 4975] If succesfully remove Area add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.area) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Area items from the contentitem tag map table
			$area_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.area') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($area_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Area items
			$area_done = $db->execute();
			if ($area_done)
			{
				// [Interpretation 4992] If succesfully remove Area add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.area) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Area items from the ucm content table
			$area_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.area') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($area_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Area items
			$area_done = $db->execute();
			if ($area_done)
			{
				// [Interpretation 5009] If succesfully remove Area add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.area) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Area items are cleared from DB
			foreach ($area_ids as $area_id)
			{
				// [Interpretation 5020] Remove Area items from the ucm base table
				$area_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $area_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($area_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Area items
				$db->execute();

				// [Interpretation 5031] Remove Area items from the ucm history table
				$area_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $area_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($area_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Area items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Feature alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.feature') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$feature_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($feature_found)
		{
			// [Interpretation 4960] Since there are load the needed  feature type ids
			$feature_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Feature from the content type table
			$feature_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.feature') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($feature_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Feature items
			$feature_done = $db->execute();
			if ($feature_done)
			{
				// [Interpretation 4975] If succesfully remove Feature add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.feature) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Feature items from the contentitem tag map table
			$feature_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.feature') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($feature_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Feature items
			$feature_done = $db->execute();
			if ($feature_done)
			{
				// [Interpretation 4992] If succesfully remove Feature add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.feature) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Feature items from the ucm content table
			$feature_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.feature') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($feature_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Feature items
			$feature_done = $db->execute();
			if ($feature_done)
			{
				// [Interpretation 5009] If succesfully remove Feature add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.feature) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Feature items are cleared from DB
			foreach ($feature_ids as $feature_id)
			{
				// [Interpretation 5020] Remove Feature items from the ucm base table
				$feature_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $feature_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($feature_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Feature items
				$db->execute();

				// [Interpretation 5031] Remove Feature items from the ucm history table
				$feature_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $feature_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($feature_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Feature items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Financial alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.financial') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$financial_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($financial_found)
		{
			// [Interpretation 4960] Since there are load the needed  financial type ids
			$financial_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Financial from the content type table
			$financial_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.financial') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($financial_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Financial items
			$financial_done = $db->execute();
			if ($financial_done)
			{
				// [Interpretation 4975] If succesfully remove Financial add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.financial) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Financial items from the contentitem tag map table
			$financial_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.financial') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($financial_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Financial items
			$financial_done = $db->execute();
			if ($financial_done)
			{
				// [Interpretation 4992] If succesfully remove Financial add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.financial) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Financial items from the ucm content table
			$financial_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.financial') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($financial_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Financial items
			$financial_done = $db->execute();
			if ($financial_done)
			{
				// [Interpretation 5009] If succesfully remove Financial add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.financial) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Financial items are cleared from DB
			foreach ($financial_ids as $financial_id)
			{
				// [Interpretation 5020] Remove Financial items from the ucm base table
				$financial_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $financial_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($financial_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Financial items
				$db->execute();

				// [Interpretation 5031] Remove Financial items from the ucm history table
				$financial_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $financial_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($financial_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Financial items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Rental alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.rental') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$rental_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($rental_found)
		{
			// [Interpretation 4960] Since there are load the needed  rental type ids
			$rental_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Rental from the content type table
			$rental_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.rental') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($rental_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Rental items
			$rental_done = $db->execute();
			if ($rental_done)
			{
				// [Interpretation 4975] If succesfully remove Rental add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.rental) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Rental items from the contentitem tag map table
			$rental_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.rental') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($rental_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Rental items
			$rental_done = $db->execute();
			if ($rental_done)
			{
				// [Interpretation 4992] If succesfully remove Rental add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.rental) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Rental items from the ucm content table
			$rental_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.rental') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($rental_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Rental items
			$rental_done = $db->execute();
			if ($rental_done)
			{
				// [Interpretation 5009] If succesfully remove Rental add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.rental) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Rental items are cleared from DB
			foreach ($rental_ids as $rental_id)
			{
				// [Interpretation 5020] Remove Rental items from the ucm base table
				$rental_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $rental_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($rental_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Rental items
				$db->execute();

				// [Interpretation 5031] Remove Rental items from the ucm history table
				$rental_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $rental_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($rental_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Rental items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Market_status alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.market_status') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$market_status_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($market_status_found)
		{
			// [Interpretation 4960] Since there are load the needed  market_status type ids
			$market_status_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Market_status from the content type table
			$market_status_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.market_status') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($market_status_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Market_status items
			$market_status_done = $db->execute();
			if ($market_status_done)
			{
				// [Interpretation 4975] If succesfully remove Market_status add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.market_status) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Market_status items from the contentitem tag map table
			$market_status_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.market_status') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($market_status_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Market_status items
			$market_status_done = $db->execute();
			if ($market_status_done)
			{
				// [Interpretation 4992] If succesfully remove Market_status add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.market_status) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Market_status items from the ucm content table
			$market_status_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.market_status') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($market_status_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Market_status items
			$market_status_done = $db->execute();
			if ($market_status_done)
			{
				// [Interpretation 5009] If succesfully remove Market_status add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.market_status) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Market_status items are cleared from DB
			foreach ($market_status_ids as $market_status_id)
			{
				// [Interpretation 5020] Remove Market_status items from the ucm base table
				$market_status_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $market_status_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($market_status_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Market_status items
				$db->execute();

				// [Interpretation 5031] Remove Market_status items from the ucm history table
				$market_status_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $market_status_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($market_status_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Market_status items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Transaction_type alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.transaction_type') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$transaction_type_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($transaction_type_found)
		{
			// [Interpretation 4960] Since there are load the needed  transaction_type type ids
			$transaction_type_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Transaction_type from the content type table
			$transaction_type_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.transaction_type') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($transaction_type_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Transaction_type items
			$transaction_type_done = $db->execute();
			if ($transaction_type_done)
			{
				// [Interpretation 4975] If succesfully remove Transaction_type add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.transaction_type) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Transaction_type items from the contentitem tag map table
			$transaction_type_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.transaction_type') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($transaction_type_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Transaction_type items
			$transaction_type_done = $db->execute();
			if ($transaction_type_done)
			{
				// [Interpretation 4992] If succesfully remove Transaction_type add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.transaction_type) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Transaction_type items from the ucm content table
			$transaction_type_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.transaction_type') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($transaction_type_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Transaction_type items
			$transaction_type_done = $db->execute();
			if ($transaction_type_done)
			{
				// [Interpretation 5009] If succesfully remove Transaction_type add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.transaction_type) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Transaction_type items are cleared from DB
			foreach ($transaction_type_ids as $transaction_type_id)
			{
				// [Interpretation 5020] Remove Transaction_type items from the ucm base table
				$transaction_type_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $transaction_type_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($transaction_type_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Transaction_type items
				$db->execute();

				// [Interpretation 5031] Remove Transaction_type items from the ucm history table
				$transaction_type_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $transaction_type_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($transaction_type_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Transaction_type items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Rental_frequency alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.rental_frequency') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$rental_frequency_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($rental_frequency_found)
		{
			// [Interpretation 4960] Since there are load the needed  rental_frequency type ids
			$rental_frequency_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Rental_frequency from the content type table
			$rental_frequency_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.rental_frequency') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($rental_frequency_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Rental_frequency items
			$rental_frequency_done = $db->execute();
			if ($rental_frequency_done)
			{
				// [Interpretation 4975] If succesfully remove Rental_frequency add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.rental_frequency) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Rental_frequency items from the contentitem tag map table
			$rental_frequency_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.rental_frequency') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($rental_frequency_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Rental_frequency items
			$rental_frequency_done = $db->execute();
			if ($rental_frequency_done)
			{
				// [Interpretation 4992] If succesfully remove Rental_frequency add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.rental_frequency) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Rental_frequency items from the ucm content table
			$rental_frequency_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.rental_frequency') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($rental_frequency_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Rental_frequency items
			$rental_frequency_done = $db->execute();
			if ($rental_frequency_done)
			{
				// [Interpretation 5009] If succesfully remove Rental_frequency add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.rental_frequency) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Rental_frequency items are cleared from DB
			foreach ($rental_frequency_ids as $rental_frequency_id)
			{
				// [Interpretation 5020] Remove Rental_frequency items from the ucm base table
				$rental_frequency_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $rental_frequency_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($rental_frequency_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Rental_frequency items
				$db->execute();

				// [Interpretation 5031] Remove Rental_frequency items from the ucm history table
				$rental_frequency_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $rental_frequency_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($rental_frequency_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Rental_frequency items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Rent_type alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.rent_type') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$rent_type_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($rent_type_found)
		{
			// [Interpretation 4960] Since there are load the needed  rent_type type ids
			$rent_type_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Rent_type from the content type table
			$rent_type_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.rent_type') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($rent_type_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Rent_type items
			$rent_type_done = $db->execute();
			if ($rent_type_done)
			{
				// [Interpretation 4975] If succesfully remove Rent_type add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.rent_type) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Rent_type items from the contentitem tag map table
			$rent_type_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.rent_type') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($rent_type_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Rent_type items
			$rent_type_done = $db->execute();
			if ($rent_type_done)
			{
				// [Interpretation 4992] If succesfully remove Rent_type add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.rent_type) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Rent_type items from the ucm content table
			$rent_type_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.rent_type') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($rent_type_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Rent_type items
			$rent_type_done = $db->execute();
			if ($rent_type_done)
			{
				// [Interpretation 5009] If succesfully remove Rent_type add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.rent_type) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Rent_type items are cleared from DB
			foreach ($rent_type_ids as $rent_type_id)
			{
				// [Interpretation 5020] Remove Rent_type items from the ucm base table
				$rent_type_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $rent_type_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($rent_type_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Rent_type items
				$db->execute();

				// [Interpretation 5031] Remove Rent_type items from the ucm history table
				$rent_type_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $rent_type_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($rent_type_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Rent_type items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Feature_type alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.feature_type') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$feature_type_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($feature_type_found)
		{
			// [Interpretation 4960] Since there are load the needed  feature_type type ids
			$feature_type_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Feature_type from the content type table
			$feature_type_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.feature_type') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($feature_type_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Feature_type items
			$feature_type_done = $db->execute();
			if ($feature_type_done)
			{
				// [Interpretation 4975] If succesfully remove Feature_type add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.feature_type) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Feature_type items from the contentitem tag map table
			$feature_type_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.feature_type') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($feature_type_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Feature_type items
			$feature_type_done = $db->execute();
			if ($feature_type_done)
			{
				// [Interpretation 4992] If succesfully remove Feature_type add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.feature_type) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Feature_type items from the ucm content table
			$feature_type_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.feature_type') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($feature_type_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Feature_type items
			$feature_type_done = $db->execute();
			if ($feature_type_done)
			{
				// [Interpretation 5009] If succesfully remove Feature_type add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.feature_type) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Feature_type items are cleared from DB
			foreach ($feature_type_ids as $feature_type_id)
			{
				// [Interpretation 5020] Remove Feature_type items from the ucm base table
				$feature_type_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $feature_type_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($feature_type_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Feature_type items
				$db->execute();

				// [Interpretation 5031] Remove Feature_type items from the ucm history table
				$feature_type_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $feature_type_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($feature_type_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Feature_type items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Mls alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.mls') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$mls_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($mls_found)
		{
			// [Interpretation 4960] Since there are load the needed  mls type ids
			$mls_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Mls from the content type table
			$mls_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.mls') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($mls_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Mls items
			$mls_done = $db->execute();
			if ($mls_done)
			{
				// [Interpretation 4975] If succesfully remove Mls add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.mls) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Mls items from the contentitem tag map table
			$mls_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.mls') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($mls_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Mls items
			$mls_done = $db->execute();
			if ($mls_done)
			{
				// [Interpretation 4992] If succesfully remove Mls add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.mls) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Mls items from the ucm content table
			$mls_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.mls') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($mls_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Mls items
			$mls_done = $db->execute();
			if ($mls_done)
			{
				// [Interpretation 5009] If succesfully remove Mls add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.mls) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Mls items are cleared from DB
			foreach ($mls_ids as $mls_id)
			{
				// [Interpretation 5020] Remove Mls items from the ucm base table
				$mls_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $mls_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($mls_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Mls items
				$db->execute();

				// [Interpretation 5031] Remove Mls items from the ucm history table
				$mls_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $mls_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($mls_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Mls items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Favorite_listing alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.favorite_listing') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$favorite_listing_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($favorite_listing_found)
		{
			// [Interpretation 4960] Since there are load the needed  favorite_listing type ids
			$favorite_listing_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Favorite_listing from the content type table
			$favorite_listing_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.favorite_listing') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($favorite_listing_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Favorite_listing items
			$favorite_listing_done = $db->execute();
			if ($favorite_listing_done)
			{
				// [Interpretation 4975] If succesfully remove Favorite_listing add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.favorite_listing) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Favorite_listing items from the contentitem tag map table
			$favorite_listing_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.favorite_listing') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($favorite_listing_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Favorite_listing items
			$favorite_listing_done = $db->execute();
			if ($favorite_listing_done)
			{
				// [Interpretation 4992] If succesfully remove Favorite_listing add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.favorite_listing) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Favorite_listing items from the ucm content table
			$favorite_listing_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.favorite_listing') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($favorite_listing_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Favorite_listing items
			$favorite_listing_done = $db->execute();
			if ($favorite_listing_done)
			{
				// [Interpretation 5009] If succesfully remove Favorite_listing add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.favorite_listing) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Favorite_listing items are cleared from DB
			foreach ($favorite_listing_ids as $favorite_listing_id)
			{
				// [Interpretation 5020] Remove Favorite_listing items from the ucm base table
				$favorite_listing_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $favorite_listing_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($favorite_listing_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Favorite_listing items
				$db->execute();

				// [Interpretation 5031] Remove Favorite_listing items from the ucm history table
				$favorite_listing_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $favorite_listing_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($favorite_listing_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Favorite_listing items
				$db->execute();
			}
		}

		// [Interpretation 4946] Create a new query object.
		$query = $db->getQuery(true);
		// [Interpretation 4948] Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// [Interpretation 4951] Where Image alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.image') );
		$db->setQuery($query);
		// [Interpretation 4954] Execute query to see if alias is found
		$db->execute();
		$image_found = $db->getNumRows();
		// [Interpretation 4957] Now check if there were any rows
		if ($image_found)
		{
			// [Interpretation 4960] Since there are load the needed  image type ids
			$image_ids = $db->loadColumn();
			// [Interpretation 4964] Remove Image from the content type table
			$image_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.image') );
			// [Interpretation 4966] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($image_condition);
			$db->setQuery($query);
			// [Interpretation 4971] Execute the query to remove Image items
			$image_done = $db->execute();
			if ($image_done)
			{
				// [Interpretation 4975] If succesfully remove Image add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.image) type alias was removed from the <b>#__content_type</b> table'));
			}

			// [Interpretation 4981] Remove Image items from the contentitem tag map table
			$image_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_realestatenow.image') );
			// [Interpretation 4983] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($image_condition);
			$db->setQuery($query);
			// [Interpretation 4988] Execute the query to remove Image items
			$image_done = $db->execute();
			if ($image_done)
			{
				// [Interpretation 4992] If succesfully remove Image add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.image) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// [Interpretation 4998] Remove Image items from the ucm content table
			$image_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_realestatenow.image') );
			// [Interpretation 5000] Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($image_condition);
			$db->setQuery($query);
			// [Interpretation 5005] Execute the query to remove Image items
			$image_done = $db->execute();
			if ($image_done)
			{
				// [Interpretation 5009] If succesfully remove Image add queued success message.
				$app->enqueueMessage(JText::_('The (com_realestatenow.image) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// [Interpretation 5015] Make sure that all the Image items are cleared from DB
			foreach ($image_ids as $image_id)
			{
				// [Interpretation 5020] Remove Image items from the ucm base table
				$image_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $image_id);
				// [Interpretation 5022] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($image_condition);
				$db->setQuery($query);
				// [Interpretation 5027] Execute the query to remove Image items
				$db->execute();

				// [Interpretation 5031] Remove Image items from the ucm history table
				$image_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $image_id);
				// [Interpretation 5033] Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($image_condition);
				$db->setQuery($query);
				// [Interpretation 5038] Execute the query to remove Image items
				$db->execute();
			}
		}

		// [Interpretation 5046] If All related items was removed queued success message.
		$app->enqueueMessage(JText::_('All related items was removed from the <b>#__ucm_base</b> table'));
		$app->enqueueMessage(JText::_('All related items was removed from the <b>#__ucm_history</b> table'));

		// [Interpretation 5051] Remove realestatenow assets from the assets table
		$realestatenow_condition = array( $db->quoteName('name') . ' LIKE ' . $db->quote('com_realestatenow%') );

		// [Interpretation 5053] Create a new query object.
		$query = $db->getQuery(true);
		$query->delete($db->quoteName('#__assets'));
		$query->where($realestatenow_condition);
		$db->setQuery($query);
		$image_done = $db->execute();
		if ($image_done)
		{
			// [Interpretation 5061] If succesfully remove realestatenow add queued success message.
			$app->enqueueMessage(JText::_('All related items was removed from the <b>#__assets</b> table'));
		}
//Delete realestatenow folder from images folder
JFolder::delete(JPATH_SITE . '/images/realestatenow');
$app = JFactory::getApplication();
$app->enqueueMessage('realestatenow folder successfully removed from images folder.', 'Info');


		// little notice as after service, in case of bad experience with component.
		echo '<h2>Did something go wrong? Are you disappointed?</h2>
		<p>Please let me know at <a href="mailto:sales@mwweb.host">sales@mwweb.host</a>.
		<br />We at Most Wanted Web Services, Inc. are committed to building extensions that performs proficiently! You can help us, really!
		<br />Send me your thoughts on improvements that is needed, trust me, I will be very grateful!
		<br />Visit us at <a href="https://mostwantedrealestatesites.com" target="_blank">https://mostwantedrealestatesites.com</a> today!</p>';
	}

	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent)
	{
		
	}

	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent)
	{
		// get application
		$app = JFactory::getApplication();
		// is redundant ...hmmm
		if ($type == 'uninstall')
		{
			return true;
		}
		// the default for both install and update
		$jversion = new JVersion();
		if (!$jversion->isCompatible('3.6.0'))
		{
			$app->enqueueMessage('Please upgrade to at least Joomla! 3.6.0 before continuing!', 'error');
			return false;
		}
		// do any updates needed
		if ($type == 'update')
		{
		}
		// do any install needed
		if ($type == 'install')
		{
		}
	}

	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent)
	{
		// get application
		$app = JFactory::getApplication();
		// set the default component settings
		if ($type == 'install')
		{

			// [Interpretation 4697] Get The Database object
			$db = JFactory::getDbo();

			// [Interpretation 4704] Create the country content type object.
			$country = new stdClass();
			$country->type_title = 'Realestatenow Country';
			$country->type_alias = 'com_realestatenow.country';
			$country->table = '{"special": {"dbtable": "#__realestatenow_country","key": "id","type": "Country","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$country->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "description","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias","longitude":"longitude","latitude":"latitude","owncoords":"owncoords","description":"description","image":"image"}}';
			$country->router = 'RealestatenowHelperRoute::getCountryRoute';
			$country->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/country.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","owncoords"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$country_Inserted = $db->insertObject('#__content_types', $country);

			// [Interpretation 4704] Create the state content type object.
			$state = new stdClass();
			$state->type_title = 'Realestatenow State';
			$state->type_alias = 'com_realestatenow.state';
			$state->table = '{"special": {"dbtable": "#__realestatenow_state","key": "id","type": "State","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$state->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "description","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias","longitude":"longitude","latitude":"latitude","owncoords":"owncoords","countryid":"countryid","description":"description","image":"image"}}';
			$state->router = 'RealestatenowHelperRoute::getStateRoute';
			$state->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/state.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","owncoords","countryid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "countryid","targetTable": "#__realestatenow_country","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$state_Inserted = $db->insertObject('#__content_types', $state);

			// [Interpretation 4704] Create the city content type object.
			$city = new stdClass();
			$city->type_title = 'Realestatenow City';
			$city->type_alias = 'com_realestatenow.city';
			$city->table = '{"special": {"dbtable": "#__realestatenow_city","key": "id","type": "City","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$city->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "description","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias","stateid":"stateid","longitude":"longitude","latitude":"latitude","owncoords":"owncoords","description":"description","image":"image"}}';
			$city->router = 'RealestatenowHelperRoute::getCityRoute';
			$city->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/city.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","stateid","owncoords"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "stateid","targetTable": "#__realestatenow_state","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$city_Inserted = $db->insertObject('#__content_types', $city);

			// [Interpretation 4704] Create the agency content type object.
			$agency = new stdClass();
			$agency->type_title = 'Realestatenow Agency';
			$agency->type_alias = 'com_realestatenow.agency';
			$agency->table = '{"special": {"dbtable": "#__realestatenow_agency","key": "id","type": "Agency","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$agency->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "description","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","street":"street","cityid":"cityid","stateid":"stateid","postcode":"postcode","alias":"alias","description":"description","streettwo":"streettwo","latitude":"latitude","rets_source":"rets_source","website":"website","email":"email","countryid":"countryid","featured":"featured","default_agency_yn":"default_agency_yn","license":"license","owncoords":"owncoords","phone":"phone","longitude":"longitude","fax":"fax","settings_id":"settings_id","image":"image"}}';
			$agency->router = 'RealestatenowHelperRoute::getAgencyRoute';
			$agency->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/agency.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","cityid","stateid","countryid","featured","default_agency_yn","owncoords","settings_id"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "cityid","targetTable": "#__realestatenow_city","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "stateid","targetTable": "#__realestatenow_state","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "countryid","targetTable": "#__realestatenow_country","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$agency_Inserted = $db->insertObject('#__content_types', $agency);

			// [Interpretation 4704] Create the agent content type object.
			$agent = new stdClass();
			$agent->type_title = 'Realestatenow Agent';
			$agent->type_alias = 'com_realestatenow.agent';
			$agent->table = '{"special": {"dbtable": "#__realestatenow_agent","key": "id","type": "Agent","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$agent->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "bio","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "catid","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","street":"street","cityid":"cityid","stateid":"stateid","agencyid":"agencyid","uid":"uid","owncoords":"owncoords","rets_source":"rets_source","email":"email","gplus":"gplus","linkedin":"linkedin","twitter":"twitter","alias":"alias","postcode":"postcode","bio":"bio","image":"image","fax":"fax","mobile":"mobile","phone":"phone","latitude":"latitude","longitude":"longitude","countryid":"countryid","fbook":"fbook","instagram":"instagram","pinterest":"pinterest","blog":"blog","youtube":"youtube","streettwo":"streettwo","skype":"skype","viewad":"viewad","website":"website","featured":"featured","settings_id":"settings_id","default_agent_yn":"default_agent_yn"}}';
			$agent->router = 'RealestatenowHelperRoute::getAgentRoute';
			$agent->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/agent.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","cityid","stateid","catid","agencyid","uid","owncoords","countryid","viewad","featured","settings_id","default_agent_yn"],"displayLookup": [{"sourceColumn": "catid","targetTable": "#__categories","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "cityid","targetTable": "#__realestatenow_city","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "stateid","targetTable": "#__realestatenow_state","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "agencyid","targetTable": "#__realestatenow_agency","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "countryid","targetTable": "#__realestatenow_country","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$agent_Inserted = $db->insertObject('#__content_types', $agent);

			// [Interpretation 4704] Create the agent category content type object.
			$agent_category = new stdClass();
			$agent_category->type_title = 'Realestatenow Agent Catid';
			$agent_category->type_alias = 'com_realestatenow.agents.category';
			$agent_category->table = '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}';
			$agent_category->field_mappings = '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}';
			$agent_category->router = 'RealestatenowHelperRoute::getCategoryRoute';
			$agent_category->content_history_options = '{"formFile":"administrator\/components\/com_categories\/models\/forms\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$agent_category_Inserted = $db->insertObject('#__content_types', $agent_category);

			// [Interpretation 4704] Create the property content type object.
			$property = new stdClass();
			$property->type_title = 'Realestatenow Property';
			$property->type_alias = 'com_realestatenow.property';
			$property->table = '{"special": {"dbtable": "#__realestatenow_property","key": "id","type": "Property","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$property->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "propdesc","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "catid","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","cityid":"cityid","stateid":"stateid","price":"price","featured":"featured","mls_id":"mls_id","qtrbaths":"qtrbaths","thqtrbaths":"thqtrbaths","bathrooms":"bathrooms","settings_id":"settings_id","county":"county","mediaurl":"mediaurl","showprice":"showprice","colistagent":"colistagent","agent":"agent","listoffice":"listoffice","soleagency":"soleagency","viewad":"viewad","sqftlower":"sqftlower","sqftupper":"sqftupper","sold":"sold","closeprice":"closeprice","pdfinfoone":"pdfinfoone","closedate":"closedate","rets_source":"rets_source","priceview":"priceview","streettwo":"streettwo","mlslookup":"mlslookup","fullbaths":"fullbaths","trans_type":"trans_type","halfbaths":"halfbaths","mkt_stats":"mkt_stats","squarefeet":"squarefeet","countryid":"countryid","sqftmainlevel":"sqftmainlevel","alias":"alias","style":"style","flplone":"flplone","covenantsyn":"covenantsyn","openhouse":"openhouse","owncoords":"owncoords","mediatype":"mediatype","longitude":"longitude","pdfinfotwo":"pdfinfotwo","postcode":"postcode","flpltwo":"flpltwo","propdesc":"propdesc","landareasqft":"landareasqft","latitude":"latitude","acrestotal":"acrestotal","lotdimensions":"lotdimensions","fbposted":"fbposted","bedrooms":"bedrooms","ghost":"ghost","street":"street"}}';
			$property->router = 'RealestatenowHelperRoute::getPropertyRoute';
			$property->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/property.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","cityid","stateid","catid","featured","qtrbaths","thqtrbaths","bathrooms","settings_id","showprice","colistagent","agent","listoffice","soleagency","viewad","sold","mlslookup","fullbaths","trans_type","halfbaths","mkt_stats","countryid","covenantsyn","openhouse","owncoords","mediatype","bedrooms","ghost"],"displayLookup": [{"sourceColumn": "catid","targetTable": "#__categories","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "cityid","targetTable": "#__realestatenow_city","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "stateid","targetTable": "#__realestatenow_state","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "colistagent","targetTable": "#__realestatenow_agent","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "agent","targetTable": "#__realestatenow_agent","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "listoffice","targetTable": "#__realestatenow_agency","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "mlslookup","targetTable": "#__realestatenow_mls","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "trans_type","targetTable": "#__realestatenow_transaction_type","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "mkt_stats","targetTable": "#__realestatenow_market_status","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "countryid","targetTable": "#__realestatenow_country","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "style","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$property_Inserted = $db->insertObject('#__content_types', $property);

			// [Interpretation 4704] Create the property category content type object.
			$property_category = new stdClass();
			$property_category->type_title = 'Realestatenow Property Catid';
			$property_category->type_alias = 'com_realestatenow.properties.category';
			$property_category->table = '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}';
			$property_category->field_mappings = '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}';
			$property_category->router = 'RealestatenowHelperRoute::getCategoryRoute';
			$property_category->content_history_options = '{"formFile":"administrator\/components\/com_categories\/models\/forms\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$property_category_Inserted = $db->insertObject('#__content_types', $property_category);

			// [Interpretation 4704] Create the residential content type object.
			$residential = new stdClass();
			$residential->type_title = 'Realestatenow Residential';
			$residential->type_alias = 'com_realestatenow.residential';
			$residential->table = '{"special": {"dbtable": "#__realestatenow_residential","key": "id","type": "Residential","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$residential->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","houseconstruction":"houseconstruction","yearremodeled":"yearremodeled","storage":"storage","customthree":"customthree","customone":"customone","kitchenpresent":"kitchenpresent","familyroompresent":"familyroompresent","totalrooms":"totalrooms","subdivision":"subdivision","welldepth":"welldepth","waterfronttype":"waterfronttype","waterfront":"waterfront","flooring":"flooring","phoneavailableyn":"phoneavailableyn","garbagedisposalyn":"garbagedisposalyn","otherrooms":"otherrooms","laundryroompresent":"laundryroompresent","livingarea":"livingarea","livingroompresent":"livingroompresent","ensuite":"ensuite","customtwo":"customtwo","stories":"stories","basementsize":"basementsize","basementpctfinished":"basementpctfinished","year":"year"}}';
			$residential->router = 'RealestatenowHelperRoute::getResidentialRoute';
			$residential->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/residential.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid","kitchenpresent","familyroompresent","waterfront","phoneavailableyn","garbagedisposalyn","laundryroompresent","livingroompresent","ensuite","stories"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$residential_Inserted = $db->insertObject('#__content_types', $residential);

			// [Interpretation 4704] Create the land content type object.
			$land = new stdClass();
			$land->type_title = 'Realestatenow Land';
			$land->type_alias = 'com_realestatenow.land';
			$land->table = '{"special": {"dbtable": "#__realestatenow_land","key": "id","type": "Land","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$land->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","cropping":"cropping","irrigation":"irrigation","soiltype":"soiltype","grazing":"grazing","rainfall":"rainfall","fittings":"fittings","fixtures":"fixtures","stock":"stock","landtype":"landtype"}}';
			$land->router = 'RealestatenowHelperRoute::getLandRoute';
			$land->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/land.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$land_Inserted = $db->insertObject('#__content_types', $land);

			// [Interpretation 4704] Create the commercial content type object.
			$commercial = new stdClass();
			$commercial->type_title = 'Realestatenow Commercial';
			$commercial->type_alias = 'com_realestatenow.commercial';
			$commercial->table = '{"special": {"dbtable": "#__realestatenow_commercial","key": "id","type": "Commercial","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$commercial->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","currentuse":"currentuse","carryingcap":"carryingcap","percentwarehouse":"percentwarehouse","loadingfac":"loadingfac","bussubtype":"bussubtype","percentoffice":"percentoffice","bustype":"bustype","netprofit":"netprofit","returns":"returns","takings":"takings","bldg_name":"bldg_name"}}';
			$commercial->router = 'RealestatenowHelperRoute::getCommercialRoute';
			$commercial->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/commercial.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$commercial_Inserted = $db->insertObject('#__content_types', $commercial);

			// [Interpretation 4704] Create the multifamily content type object.
			$multifamily = new stdClass();
			$multifamily->type_title = 'Realestatenow Multifamily';
			$multifamily->type_alias = 'com_realestatenow.multifamily';
			$multifamily->table = '{"special": {"dbtable": "#__realestatenow_multifamily","key": "id","type": "Multifamily","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$multifamily->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","tenantpdutilities":"tenantpdutilities","tenancytype":"tenancytype","numunits":"numunits","totalrents":"totalrents","bldgsqft":"bldgsqft"}}';
			$multifamily->router = 'RealestatenowHelperRoute::getMultifamilyRoute';
			$multifamily->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/multifamily.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$multifamily_Inserted = $db->insertObject('#__content_types', $multifamily);

			// [Interpretation 4704] Create the area content type object.
			$area = new stdClass();
			$area->type_title = 'Realestatenow Area';
			$area->type_alias = 'com_realestatenow.area';
			$area->table = '{"special": {"dbtable": "#__realestatenow_area","key": "id","type": "Area","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$area->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","highschool":"highschool","university":"university","midschool":"midschool","elementary":"elementary","schooldist":"schooldist","ctport":"ctport","ctown":"ctown"}}';
			$area->router = 'RealestatenowHelperRoute::getAreaRoute';
			$area->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/area.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$area_Inserted = $db->insertObject('#__content_types', $area);

			// [Interpretation 4704] Create the feature content type object.
			$feature = new stdClass();
			$feature->type_title = 'Realestatenow Feature';
			$feature->type_alias = 'com_realestatenow.feature';
			$feature->table = '{"special": {"dbtable": "#__realestatenow_feature","key": "id","type": "Feature","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$feature->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","sewer":"sewer","zoning":"zoning","porchpatio":"porchpatio","waterresources":"waterresources","basementandfoundation":"basementandfoundation","roof":"roof","parkingspaceyn":"parkingspaceyn","parkingspaces":"parkingspaces","parkingdesc":"parkingdesc","garagetype":"garagetype","frontage":"frontage","heating":"heating","cooling":"cooling","fencing":"fencing","exteriorfinish":"exteriorfinish"}}';
			$feature->router = 'RealestatenowHelperRoute::getFeatureRoute';
			$feature->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/feature.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid","parkingspaceyn"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "sewer","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "zoning","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "porchpatio","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "waterresources","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "basementandfoundation","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "roof","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "garagetype","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "frontage","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "heating","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "cooling","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "fencing","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "exteriorfinish","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$feature_Inserted = $db->insertObject('#__content_types', $feature);

			// [Interpretation 4704] Create the financial content type object.
			$financial = new stdClass();
			$financial->type_title = 'Realestatenow Financial';
			$financial->type_alias = 'com_realestatenow.financial';
			$financial->table = '{"special": {"dbtable": "#__realestatenow_financial","key": "id","type": "Financial","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$financial->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","viewbooking":"viewbooking","propmgt_description":"propmgt_description","propmgt_price":"propmgt_price","pmenddate":"pmenddate","pmstartdate":"pmstartdate","pm_price_override":"pm_price_override","annualinsurance":"annualinsurance","terms":"terms","averageutilgas":"averageutilgas","averageutilelec":"averageutilelec","electricservice":"electricservice","utilities":"utilities","taxyear":"taxyear","taxannual":"taxannual","availdate":"availdate","private":"private","hofees":"hofees"}}';
			$financial->router = 'RealestatenowHelperRoute::getFinancialRoute';
			$financial->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/financial.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid","viewbooking"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "terms","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$financial_Inserted = $db->insertObject('#__content_types', $financial);

			// [Interpretation 4704] Create the rental content type object.
			$rental = new stdClass();
			$rental->type_title = 'Realestatenow Rental';
			$rental->type_alias = 'com_realestatenow.rental';
			$rental->table = '{"special": {"dbtable": "#__realestatenow_rental","key": "id","type": "Rental","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$rental->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","sleeps":"sleeps","deposit":"deposit","freq":"freq","offpeak":"offpeak","rent_type":"rent_type"}}';
			$rental->router = 'RealestatenowHelperRoute::getRentalRoute';
			$rental->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/rental.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid","sleeps","freq","rent_type"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "freq","targetTable": "#__realestatenow_rental_frequency","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "rent_type","targetTable": "#__realestatenow_rent_type","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$rental_Inserted = $db->insertObject('#__content_types', $rental);

			// [Interpretation 4704] Create the market_status content type object.
			$market_status = new stdClass();
			$market_status->type_title = 'Realestatenow Market_status';
			$market_status->type_alias = 'com_realestatenow.market_status';
			$market_status->table = '{"special": {"dbtable": "#__realestatenow_market_status","key": "id","type": "Market_status","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$market_status->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias"}}';
			$market_status->router = 'RealestatenowHelperRoute::getMarket_statusRoute';
			$market_status->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/market_status.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$market_status_Inserted = $db->insertObject('#__content_types', $market_status);

			// [Interpretation 4704] Create the transaction_type content type object.
			$transaction_type = new stdClass();
			$transaction_type->type_title = 'Realestatenow Transaction_type';
			$transaction_type->type_alias = 'com_realestatenow.transaction_type';
			$transaction_type->table = '{"special": {"dbtable": "#__realestatenow_transaction_type","key": "id","type": "Transaction_type","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$transaction_type->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias"}}';
			$transaction_type->router = 'RealestatenowHelperRoute::getTransaction_typeRoute';
			$transaction_type->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/transaction_type.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$transaction_type_Inserted = $db->insertObject('#__content_types', $transaction_type);

			// [Interpretation 4704] Create the rental_frequency content type object.
			$rental_frequency = new stdClass();
			$rental_frequency->type_title = 'Realestatenow Rental_frequency';
			$rental_frequency->type_alias = 'com_realestatenow.rental_frequency';
			$rental_frequency->table = '{"special": {"dbtable": "#__realestatenow_rental_frequency","key": "id","type": "Rental_frequency","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$rental_frequency->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias"}}';
			$rental_frequency->router = 'RealestatenowHelperRoute::getRental_frequencyRoute';
			$rental_frequency->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/rental_frequency.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$rental_frequency_Inserted = $db->insertObject('#__content_types', $rental_frequency);

			// [Interpretation 4704] Create the rent_type content type object.
			$rent_type = new stdClass();
			$rent_type->type_title = 'Realestatenow Rent_type';
			$rent_type->type_alias = 'com_realestatenow.rent_type';
			$rent_type->table = '{"special": {"dbtable": "#__realestatenow_rent_type","key": "id","type": "Rent_type","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$rent_type->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias"}}';
			$rent_type->router = 'RealestatenowHelperRoute::getRent_typeRoute';
			$rent_type->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/rent_type.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$rent_type_Inserted = $db->insertObject('#__content_types', $rent_type);

			// [Interpretation 4704] Create the feature_type content type object.
			$feature_type = new stdClass();
			$feature_type->type_title = 'Realestatenow Feature_type';
			$feature_type->type_alias = 'com_realestatenow.feature_type';
			$feature_type->table = '{"special": {"dbtable": "#__realestatenow_feature_type","key": "id","type": "Feature_type","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$feature_type->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "featurename","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"featurename":"featurename","featuretype":"featuretype","alias":"alias"}}';
			$feature_type->router = 'RealestatenowHelperRoute::getFeature_typeRoute';
			$feature_type->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/feature_type.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","featuretype"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$feature_type_Inserted = $db->insertObject('#__content_types', $feature_type);

			// [Interpretation 4704] Create the mls content type object.
			$mls = new stdClass();
			$mls->type_title = 'Realestatenow Mls';
			$mls->type_alias = 'com_realestatenow.mls';
			$mls->table = '{"special": {"dbtable": "#__realestatenow_mls","key": "id","type": "Mls","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$mls->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","mls_disclaimer":"mls_disclaimer","mls_image":"mls_image","alias":"alias"}}';
			$mls->router = 'RealestatenowHelperRoute::getMlsRoute';
			$mls->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/mls.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$mls_Inserted = $db->insertObject('#__content_types', $mls);

			// [Interpretation 4704] Create the favorite_listing content type object.
			$favorite_listing = new stdClass();
			$favorite_listing->type_title = 'Realestatenow Favorite_listing';
			$favorite_listing->type_alias = 'com_realestatenow.favorite_listing';
			$favorite_listing->table = '{"special": {"dbtable": "#__realestatenow_favorite_listing","key": "id","type": "Favorite_listing","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$favorite_listing->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"uid":"uid","propertyid":"propertyid"}}';
			$favorite_listing->router = 'RealestatenowHelperRoute::getFavorite_listingRoute';
			$favorite_listing->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/favorite_listing.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","uid","propertyid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propertyid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$favorite_listing_Inserted = $db->insertObject('#__content_types', $favorite_listing);

			// [Interpretation 4704] Create the image content type object.
			$image = new stdClass();
			$image->type_title = 'Realestatenow Image';
			$image->type_alias = 'com_realestatenow.image';
			$image->table = '{"special": {"dbtable": "#__realestatenow_image","key": "id","type": "Image","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$image->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","path":"path","filename":"filename","type":"type","rets_source":"rets_source","settings_id":"settings_id","description":"description","title":"title","remote":"remote"}}';
			$image->router = 'RealestatenowHelperRoute::getImageRoute';
			$image->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/image.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid","settings_id"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4722] Set the object into the content types table.
			$image_Inserted = $db->insertObject('#__content_types', $image);


			// [Interpretation 4759] Install the global extenstion assets permission.
			$query = $db->getQuery(true);
			// [Interpretation 4767] Field to update.
			$fields = array(
				$db->quoteName('rules') . ' = ' . $db->quote('{"site.categories.access":{"1":1},"site.category.access":{"1":1},"site.cities.access":{"1":1},"site.states.access":{"1":1},"site.countries.access":{"1":1},"site.agencies.access":{"1":1},"site.agents.access":{"1":1},"site.properties.access":{"1":1},"site.featured.access":{"1":1},"site.agency.access":{"1":1},"site.agencyagents.access":{"1":1},"site.agentview.access":{"1":1},"site.agentprofile.access":{"1":1},"site.country.access":{"1":1},"site.state.access":{"1":1},"site.city.access":{"1":1},"site.property.access":{"1":1},"site.featuredcategory.access":{"1":1},"site.hotsheet.access":{"1":1},"site.favorites.access":{"1":1},"site.openhouses.access":{"1":1},"site.transactiontype.access":{"1":1}}'),
			);
			// [Interpretation 4771] Condition.
			$conditions = array(
				$db->quoteName('name') . ' = ' . $db->quote('com_realestatenow')
			);
			$query->update($db->quoteName('#__assets'))->set($fields)->where($conditions);
			$db->setQuery($query);
			$allDone = $db->execute();

			// [Interpretation 4784] Install the global extenstion params.
			$query = $db->getQuery(true);
			// [Interpretation 4792] Field to update.
			$fields = array(
				$db->quoteName('params') . ' = ' . $db->quote('{"autorName":"Most Wanted Web Services, Inc.","autorEmail":"sales@mwweb.host","listlimit":"25","listsort":"price_asc","show_footer":"1","linksize":"h2","linkweight":"normal","linkcolor":"#000000","pricelocation":"0","priceweight":"normal","pricecolor":"#000000","mw_uselistmap":"1","map_provider":"1","gmapsapi":"AIzaSyChXT8NSEK1_LELbTmlWa5m4rf5pAiKYg8","bingmapsapi":"AtiX-jfTaf1r_GbbiU2yZwk6z_-JBTg5wWY43Y7DDBxH4Ope9P1Zw4IKyV0woSCa","mw_mapheight":"600","mw_mapwidth":"1000","latitude":"47.6149942","longitude":"-122.4759886","fbintegration":"0","fbposttype":"0","category_properties_display":"1","cities_display":"1","states_display":"1","countries_display":"1","agents_display":"1","showagtaddylist":"0","showagtcontactist":"0","agencies_display":"1","transactiontype_request_id":"0","adline":"0","showlisted":"0","properties_display":"1","properties_thumb_type":"0","map_type":"1","zoom":"8","sqft_type":"1","keyword_filter":"1","category_filter":"1","transtype_filter":"1","mktstatus_filter":"1","agent_filter":"1","state_filter":"1","city_filter":"1","beds_filter":"1","baths_filter":"1","area_filter":"1","price_filter":"1","land_filter":"1","waterfront_filter":"0","openhouse_display":"1","oh_thumb_type":"0","oh_map_type":"1","oh_keyword_filter":"1","oh_category_filter":"1","oh_transtype_filter":"1","oh_mktstatus_filter":"1","oh_agent_filter":"1","oh_state_filter":"1","oh_city_filter":"1","oh_beds_filter":"1","oh_baths_filter":"1","oh_area_filter":"1","oh_price_filter":"1","oh_land_filter":"1","oh_waterfront_filter":"0","featured_display":"1","allfeatured_thumb_type":"0","featured_map_type":"1","featured_keyword_filter":"1","featured_category_filter":"1","featured_transtype_filter":"1","featured_mktstatus_filter":"1","featured_agent_filter":"1","featured_state_filter":"1","featured_city_filter":"1","featured_beds_filter":"1","featured_baths_filter":"1","featured_area_filter":"1","featured_price_filter":"1","featured_land_filter":"1","featured_waterfront_filter":"0","featcatshowfilter":"1","featuredcat_display":"1","featuredcat_map_type":"1","featuredcat_thumb_type":"1","featuredcat_keyword_filter":"1","featuredcat_category_filter":"1","featuredcat_transtype_filter":"1","featuredcat_mktstatus_filter":"1","featuredcat_agent_filter":"1","featuredcat_state_filter":"1","featuredcat_city_filter":"1","featuredcat_baths_filter":"1","featuredcat_area_filter":"1","featuredcat_price_filter":"1","featuredcat_land_filter":"1","featuredcat_beds_filter":"1","featuredcat_waterfront_filter":"0","category_display":"1","category_map_zoom":"1","cat_thumb_type":"0","catshowfilter":"1","catkeyword_filter":"1","catcategory_filter":"1","cattranstype_filter":"1","catmktstatus_filter":"1","catagent_filter":"1","catstate_filter":"1","catcity_filter":"1","catbeds_filter":"1","catbaths_filter":"1","catarea_filter":"1","catprice_filter":"1","catland_filter":"1","catwaterfront_filter":"0","city_request_id":"1","city_properties_display":"1","city_map_zoom":"12","show_city_image":"1","city_thumb_type":"0","state_request_id":"0","state_properties_display":"1","state_map_zoom":"12","show_state_image":"1","state_thumb_type":"0","country_request_id":"0","country_properties_display":"1","country_map_zoom":"12","show_country_image":"1","country_thumb_type":"0","ctryshowfilter":"1","ctrykeyword_filter":"1","ctrycategory_filter":"1","ctrytranstype_filter":"1","ctrymktstatus_filter":"1","ctryagent_filter":"1","ctrystate_filter":"1","ctrycity_filter":"1","ctrybeds_filter":"1","ctrybaths_filter":"1","ctryarea_filter":"1","ctryprice_filter":"1","ctryland_filter":"1","ctrywaterfront_filter":"0","agentview_request_id":"0","agent_properties_display":"1","agent_map_zoom":"12","agent_thumb_type":"0","agency_request_id":"0","agency_properties_display":"1","agency_map_zoom":"12","agency_thumb_type":"0","agencyagents_request_id":"0","property_request_id":"0","property_layout":"1","propheaderbtncolor":"#FFFFFF","property_map_zoom":"12","property_data_layout":"0","property_slideshow":"1","slideshow_transtype":"1","slider_autoplay_duration":"3000","mw_areameasure":"1","mw_usesimilar":"2","mw_simnum":"1","mw_usesecondary":"0","presentedby":"0","mw_country":"0","transtype_display":"1","transtype_thumb_type":"0","transtype_keyword_filter":"1","transtype_category_filter":"1","transtype_mktstatus_filter":"1","transtype_agent_filter":"1","transtype_state_filter":"1","transtype_city_filter":"1","transtype_beds_filter":"1","transtype_baths_filter":"1","transtype_area_filter":"1","transtype_price_filter":"1","transtype_land_filter":"1","waterfront_land_filter":"0","hotsheet_display":"1","hotsheet_thumb_type":"0","hotsheet_map_type":"1","hotsheet_keyword_filter":"1","hotsheet_category_filter":"1","hotsheet_mktstatus_filter":"1","hotsheet_transtype_filter":"1","hotsheet_price_filter":"1","hotsheet_land_filter":"1","hotsheet_beds_filter":"1","hotsheet_baths_filter":"1","hotsheet_agent_filter":"1","hotsheet_city_filter":"1","hotsheet_state_filter":"1","hotsheet_area_filter":"1","hotsheet_waterfront_filter":"0","check_in":"-1 day","save_history":"1","history_limit":"10","uikit_load":"1","uikit_min":"","uikit_style":""}'),
			);
			// [Interpretation 4796] Condition.
			$conditions = array(
				$db->quoteName('element') . ' = ' . $db->quote('com_realestatenow')
			);
			$query->update($db->quoteName('#__extensions'))->set($fields)->where($conditions);
			$db->setQuery($query);
			$allDone = $db->execute();


// Check the minimum PHP version
if (!version_compare(PHP_VERSION, '7.0.0', 'ge'))
{
     $msg = "<p>You need PHP 7.0.0 or later to install iPALS</p>";
     JLog::add($msg, JLog::ALERT, 'jerror');

     return false;
}

//Move library file to Joomla libraries and delete it from plugin
JFolder::move(JPATH_SITE . '/media/com_realestatenow/realestatenow', JPATH_SITE . '/images/realestatenow');
$app = JFactory::getApplication();
$app->enqueueMessage('realestatenow folder successfully added to images folder.', 'Info');

		// Get Application object
		$app = JFactory::getApplication();
		$app->enqueueMessage('Real Estate NOW! has been successfully installed. First set the components global settings and permissions in the <b>Options</b> area, or the front-end of the component will not work as expected. <br />Please note that each view on the front-end has access and permissions, so if you would like the public to access those views they must be given the access and permission.', 'Info');

			echo '<a target="_blank" href="https://mostwantedrealestatesites.com" title="Real Estate NOW!">
				<img src="components/com_realestatenow/assets/images/vdm-component.jpg"/>
				</a>';
		}
		// do any updates needed
		if ($type == 'update')
		{

			// [Interpretation 4697] Get The Database object
			$db = JFactory::getDbo();

			// [Interpretation 4704] Create the country content type object.
			$country = new stdClass();
			$country->type_title = 'Realestatenow Country';
			$country->type_alias = 'com_realestatenow.country';
			$country->table = '{"special": {"dbtable": "#__realestatenow_country","key": "id","type": "Country","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$country->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "description","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias","longitude":"longitude","latitude":"latitude","owncoords":"owncoords","description":"description","image":"image"}}';
			$country->router = 'RealestatenowHelperRoute::getCountryRoute';
			$country->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/country.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","owncoords"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if country type is already in content_type DB.
			$country_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($country->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$country->type_id = $db->loadResult();
				$country_Updated = $db->updateObject('#__content_types', $country, 'type_id');
			}
			else
			{
				$country_Inserted = $db->insertObject('#__content_types', $country);
			}

			// [Interpretation 4704] Create the state content type object.
			$state = new stdClass();
			$state->type_title = 'Realestatenow State';
			$state->type_alias = 'com_realestatenow.state';
			$state->table = '{"special": {"dbtable": "#__realestatenow_state","key": "id","type": "State","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$state->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "description","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias","longitude":"longitude","latitude":"latitude","owncoords":"owncoords","countryid":"countryid","description":"description","image":"image"}}';
			$state->router = 'RealestatenowHelperRoute::getStateRoute';
			$state->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/state.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","owncoords","countryid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "countryid","targetTable": "#__realestatenow_country","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if state type is already in content_type DB.
			$state_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($state->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$state->type_id = $db->loadResult();
				$state_Updated = $db->updateObject('#__content_types', $state, 'type_id');
			}
			else
			{
				$state_Inserted = $db->insertObject('#__content_types', $state);
			}

			// [Interpretation 4704] Create the city content type object.
			$city = new stdClass();
			$city->type_title = 'Realestatenow City';
			$city->type_alias = 'com_realestatenow.city';
			$city->table = '{"special": {"dbtable": "#__realestatenow_city","key": "id","type": "City","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$city->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "description","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias","stateid":"stateid","longitude":"longitude","latitude":"latitude","owncoords":"owncoords","description":"description","image":"image"}}';
			$city->router = 'RealestatenowHelperRoute::getCityRoute';
			$city->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/city.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","stateid","owncoords"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "stateid","targetTable": "#__realestatenow_state","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if city type is already in content_type DB.
			$city_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($city->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$city->type_id = $db->loadResult();
				$city_Updated = $db->updateObject('#__content_types', $city, 'type_id');
			}
			else
			{
				$city_Inserted = $db->insertObject('#__content_types', $city);
			}

			// [Interpretation 4704] Create the agency content type object.
			$agency = new stdClass();
			$agency->type_title = 'Realestatenow Agency';
			$agency->type_alias = 'com_realestatenow.agency';
			$agency->table = '{"special": {"dbtable": "#__realestatenow_agency","key": "id","type": "Agency","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$agency->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "description","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","street":"street","cityid":"cityid","stateid":"stateid","postcode":"postcode","alias":"alias","description":"description","streettwo":"streettwo","latitude":"latitude","rets_source":"rets_source","website":"website","email":"email","countryid":"countryid","featured":"featured","default_agency_yn":"default_agency_yn","license":"license","owncoords":"owncoords","phone":"phone","longitude":"longitude","fax":"fax","settings_id":"settings_id","image":"image"}}';
			$agency->router = 'RealestatenowHelperRoute::getAgencyRoute';
			$agency->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/agency.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","cityid","stateid","countryid","featured","default_agency_yn","owncoords","settings_id"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "cityid","targetTable": "#__realestatenow_city","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "stateid","targetTable": "#__realestatenow_state","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "countryid","targetTable": "#__realestatenow_country","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if agency type is already in content_type DB.
			$agency_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($agency->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$agency->type_id = $db->loadResult();
				$agency_Updated = $db->updateObject('#__content_types', $agency, 'type_id');
			}
			else
			{
				$agency_Inserted = $db->insertObject('#__content_types', $agency);
			}

			// [Interpretation 4704] Create the agent content type object.
			$agent = new stdClass();
			$agent->type_title = 'Realestatenow Agent';
			$agent->type_alias = 'com_realestatenow.agent';
			$agent->table = '{"special": {"dbtable": "#__realestatenow_agent","key": "id","type": "Agent","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$agent->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "bio","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "catid","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","street":"street","cityid":"cityid","stateid":"stateid","agencyid":"agencyid","uid":"uid","owncoords":"owncoords","rets_source":"rets_source","email":"email","gplus":"gplus","linkedin":"linkedin","twitter":"twitter","alias":"alias","postcode":"postcode","bio":"bio","image":"image","fax":"fax","mobile":"mobile","phone":"phone","latitude":"latitude","longitude":"longitude","countryid":"countryid","fbook":"fbook","instagram":"instagram","pinterest":"pinterest","blog":"blog","youtube":"youtube","streettwo":"streettwo","skype":"skype","viewad":"viewad","website":"website","featured":"featured","settings_id":"settings_id","default_agent_yn":"default_agent_yn"}}';
			$agent->router = 'RealestatenowHelperRoute::getAgentRoute';
			$agent->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/agent.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","cityid","stateid","catid","agencyid","uid","owncoords","countryid","viewad","featured","settings_id","default_agent_yn"],"displayLookup": [{"sourceColumn": "catid","targetTable": "#__categories","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "cityid","targetTable": "#__realestatenow_city","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "stateid","targetTable": "#__realestatenow_state","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "agencyid","targetTable": "#__realestatenow_agency","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "countryid","targetTable": "#__realestatenow_country","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if agent type is already in content_type DB.
			$agent_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($agent->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$agent->type_id = $db->loadResult();
				$agent_Updated = $db->updateObject('#__content_types', $agent, 'type_id');
			}
			else
			{
				$agent_Inserted = $db->insertObject('#__content_types', $agent);
			}

			// [Interpretation 4704] Create the agent category content type object.
			$agent_category = new stdClass();
			$agent_category->type_title = 'Realestatenow Agent Catid';
			$agent_category->type_alias = 'com_realestatenow.agents.category';
			$agent_category->table = '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}';
			$agent_category->field_mappings = '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}';
			$agent_category->router = 'RealestatenowHelperRoute::getCategoryRoute';
			$agent_category->content_history_options = '{"formFile":"administrator\/components\/com_categories\/models\/forms\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}';

			// [Interpretation 4713] Check if agent category type is already in content_type DB.
			$agent_category_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($agent_category->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$agent_category->type_id = $db->loadResult();
				$agent_category_Updated = $db->updateObject('#__content_types', $agent_category, 'type_id');
			}
			else
			{
				$agent_category_Inserted = $db->insertObject('#__content_types', $agent_category);
			}

			// [Interpretation 4704] Create the property content type object.
			$property = new stdClass();
			$property->type_title = 'Realestatenow Property';
			$property->type_alias = 'com_realestatenow.property';
			$property->table = '{"special": {"dbtable": "#__realestatenow_property","key": "id","type": "Property","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$property->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "propdesc","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "catid","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","cityid":"cityid","stateid":"stateid","price":"price","featured":"featured","mls_id":"mls_id","qtrbaths":"qtrbaths","thqtrbaths":"thqtrbaths","bathrooms":"bathrooms","settings_id":"settings_id","county":"county","mediaurl":"mediaurl","showprice":"showprice","colistagent":"colistagent","agent":"agent","listoffice":"listoffice","soleagency":"soleagency","viewad":"viewad","sqftlower":"sqftlower","sqftupper":"sqftupper","sold":"sold","closeprice":"closeprice","pdfinfoone":"pdfinfoone","closedate":"closedate","rets_source":"rets_source","priceview":"priceview","streettwo":"streettwo","mlslookup":"mlslookup","fullbaths":"fullbaths","trans_type":"trans_type","halfbaths":"halfbaths","mkt_stats":"mkt_stats","squarefeet":"squarefeet","countryid":"countryid","sqftmainlevel":"sqftmainlevel","alias":"alias","style":"style","flplone":"flplone","covenantsyn":"covenantsyn","openhouse":"openhouse","owncoords":"owncoords","mediatype":"mediatype","longitude":"longitude","pdfinfotwo":"pdfinfotwo","postcode":"postcode","flpltwo":"flpltwo","propdesc":"propdesc","landareasqft":"landareasqft","latitude":"latitude","acrestotal":"acrestotal","lotdimensions":"lotdimensions","fbposted":"fbposted","bedrooms":"bedrooms","ghost":"ghost","street":"street"}}';
			$property->router = 'RealestatenowHelperRoute::getPropertyRoute';
			$property->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/property.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","cityid","stateid","catid","featured","qtrbaths","thqtrbaths","bathrooms","settings_id","showprice","colistagent","agent","listoffice","soleagency","viewad","sold","mlslookup","fullbaths","trans_type","halfbaths","mkt_stats","countryid","covenantsyn","openhouse","owncoords","mediatype","bedrooms","ghost"],"displayLookup": [{"sourceColumn": "catid","targetTable": "#__categories","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "cityid","targetTable": "#__realestatenow_city","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "stateid","targetTable": "#__realestatenow_state","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "colistagent","targetTable": "#__realestatenow_agent","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "agent","targetTable": "#__realestatenow_agent","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "listoffice","targetTable": "#__realestatenow_agency","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "mlslookup","targetTable": "#__realestatenow_mls","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "trans_type","targetTable": "#__realestatenow_transaction_type","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "mkt_stats","targetTable": "#__realestatenow_market_status","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "countryid","targetTable": "#__realestatenow_country","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "style","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"}]}';

			// [Interpretation 4713] Check if property type is already in content_type DB.
			$property_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($property->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$property->type_id = $db->loadResult();
				$property_Updated = $db->updateObject('#__content_types', $property, 'type_id');
			}
			else
			{
				$property_Inserted = $db->insertObject('#__content_types', $property);
			}

			// [Interpretation 4704] Create the property category content type object.
			$property_category = new stdClass();
			$property_category->type_title = 'Realestatenow Property Catid';
			$property_category->type_alias = 'com_realestatenow.properties.category';
			$property_category->table = '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}';
			$property_category->field_mappings = '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null", "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc", "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id","lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}';
			$property_category->router = 'RealestatenowHelperRoute::getCategoryRoute';
			$property_category->content_history_options = '{"formFile":"administrator\/components\/com_categories\/models\/forms\/category.xml", "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}';

			// [Interpretation 4713] Check if property category type is already in content_type DB.
			$property_category_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($property_category->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$property_category->type_id = $db->loadResult();
				$property_category_Updated = $db->updateObject('#__content_types', $property_category, 'type_id');
			}
			else
			{
				$property_category_Inserted = $db->insertObject('#__content_types', $property_category);
			}

			// [Interpretation 4704] Create the residential content type object.
			$residential = new stdClass();
			$residential->type_title = 'Realestatenow Residential';
			$residential->type_alias = 'com_realestatenow.residential';
			$residential->table = '{"special": {"dbtable": "#__realestatenow_residential","key": "id","type": "Residential","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$residential->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","houseconstruction":"houseconstruction","yearremodeled":"yearremodeled","storage":"storage","customthree":"customthree","customone":"customone","kitchenpresent":"kitchenpresent","familyroompresent":"familyroompresent","totalrooms":"totalrooms","subdivision":"subdivision","welldepth":"welldepth","waterfronttype":"waterfronttype","waterfront":"waterfront","flooring":"flooring","phoneavailableyn":"phoneavailableyn","garbagedisposalyn":"garbagedisposalyn","otherrooms":"otherrooms","laundryroompresent":"laundryroompresent","livingarea":"livingarea","livingroompresent":"livingroompresent","ensuite":"ensuite","customtwo":"customtwo","stories":"stories","basementsize":"basementsize","basementpctfinished":"basementpctfinished","year":"year"}}';
			$residential->router = 'RealestatenowHelperRoute::getResidentialRoute';
			$residential->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/residential.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid","kitchenpresent","familyroompresent","waterfront","phoneavailableyn","garbagedisposalyn","laundryroompresent","livingroompresent","ensuite","stories"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if residential type is already in content_type DB.
			$residential_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($residential->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$residential->type_id = $db->loadResult();
				$residential_Updated = $db->updateObject('#__content_types', $residential, 'type_id');
			}
			else
			{
				$residential_Inserted = $db->insertObject('#__content_types', $residential);
			}

			// [Interpretation 4704] Create the land content type object.
			$land = new stdClass();
			$land->type_title = 'Realestatenow Land';
			$land->type_alias = 'com_realestatenow.land';
			$land->table = '{"special": {"dbtable": "#__realestatenow_land","key": "id","type": "Land","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$land->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","cropping":"cropping","irrigation":"irrigation","soiltype":"soiltype","grazing":"grazing","rainfall":"rainfall","fittings":"fittings","fixtures":"fixtures","stock":"stock","landtype":"landtype"}}';
			$land->router = 'RealestatenowHelperRoute::getLandRoute';
			$land->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/land.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if land type is already in content_type DB.
			$land_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($land->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$land->type_id = $db->loadResult();
				$land_Updated = $db->updateObject('#__content_types', $land, 'type_id');
			}
			else
			{
				$land_Inserted = $db->insertObject('#__content_types', $land);
			}

			// [Interpretation 4704] Create the commercial content type object.
			$commercial = new stdClass();
			$commercial->type_title = 'Realestatenow Commercial';
			$commercial->type_alias = 'com_realestatenow.commercial';
			$commercial->table = '{"special": {"dbtable": "#__realestatenow_commercial","key": "id","type": "Commercial","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$commercial->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","currentuse":"currentuse","carryingcap":"carryingcap","percentwarehouse":"percentwarehouse","loadingfac":"loadingfac","bussubtype":"bussubtype","percentoffice":"percentoffice","bustype":"bustype","netprofit":"netprofit","returns":"returns","takings":"takings","bldg_name":"bldg_name"}}';
			$commercial->router = 'RealestatenowHelperRoute::getCommercialRoute';
			$commercial->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/commercial.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if commercial type is already in content_type DB.
			$commercial_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($commercial->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$commercial->type_id = $db->loadResult();
				$commercial_Updated = $db->updateObject('#__content_types', $commercial, 'type_id');
			}
			else
			{
				$commercial_Inserted = $db->insertObject('#__content_types', $commercial);
			}

			// [Interpretation 4704] Create the multifamily content type object.
			$multifamily = new stdClass();
			$multifamily->type_title = 'Realestatenow Multifamily';
			$multifamily->type_alias = 'com_realestatenow.multifamily';
			$multifamily->table = '{"special": {"dbtable": "#__realestatenow_multifamily","key": "id","type": "Multifamily","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$multifamily->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","tenantpdutilities":"tenantpdutilities","tenancytype":"tenancytype","numunits":"numunits","totalrents":"totalrents","bldgsqft":"bldgsqft"}}';
			$multifamily->router = 'RealestatenowHelperRoute::getMultifamilyRoute';
			$multifamily->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/multifamily.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if multifamily type is already in content_type DB.
			$multifamily_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($multifamily->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$multifamily->type_id = $db->loadResult();
				$multifamily_Updated = $db->updateObject('#__content_types', $multifamily, 'type_id');
			}
			else
			{
				$multifamily_Inserted = $db->insertObject('#__content_types', $multifamily);
			}

			// [Interpretation 4704] Create the area content type object.
			$area = new stdClass();
			$area->type_title = 'Realestatenow Area';
			$area->type_alias = 'com_realestatenow.area';
			$area->table = '{"special": {"dbtable": "#__realestatenow_area","key": "id","type": "Area","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$area->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","highschool":"highschool","university":"university","midschool":"midschool","elementary":"elementary","schooldist":"schooldist","ctport":"ctport","ctown":"ctown"}}';
			$area->router = 'RealestatenowHelperRoute::getAreaRoute';
			$area->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/area.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if area type is already in content_type DB.
			$area_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($area->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$area->type_id = $db->loadResult();
				$area_Updated = $db->updateObject('#__content_types', $area, 'type_id');
			}
			else
			{
				$area_Inserted = $db->insertObject('#__content_types', $area);
			}

			// [Interpretation 4704] Create the feature content type object.
			$feature = new stdClass();
			$feature->type_title = 'Realestatenow Feature';
			$feature->type_alias = 'com_realestatenow.feature';
			$feature->table = '{"special": {"dbtable": "#__realestatenow_feature","key": "id","type": "Feature","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$feature->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","sewer":"sewer","zoning":"zoning","porchpatio":"porchpatio","waterresources":"waterresources","basementandfoundation":"basementandfoundation","roof":"roof","parkingspaceyn":"parkingspaceyn","parkingspaces":"parkingspaces","parkingdesc":"parkingdesc","garagetype":"garagetype","frontage":"frontage","heating":"heating","cooling":"cooling","fencing":"fencing","exteriorfinish":"exteriorfinish"}}';
			$feature->router = 'RealestatenowHelperRoute::getFeatureRoute';
			$feature->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/feature.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid","parkingspaceyn"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "sewer","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "zoning","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "porchpatio","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "waterresources","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "basementandfoundation","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "roof","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "garagetype","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "frontage","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "heating","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "cooling","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "fencing","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"},{"sourceColumn": "exteriorfinish","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"}]}';

			// [Interpretation 4713] Check if feature type is already in content_type DB.
			$feature_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($feature->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$feature->type_id = $db->loadResult();
				$feature_Updated = $db->updateObject('#__content_types', $feature, 'type_id');
			}
			else
			{
				$feature_Inserted = $db->insertObject('#__content_types', $feature);
			}

			// [Interpretation 4704] Create the financial content type object.
			$financial = new stdClass();
			$financial->type_title = 'Realestatenow Financial';
			$financial->type_alias = 'com_realestatenow.financial';
			$financial->table = '{"special": {"dbtable": "#__realestatenow_financial","key": "id","type": "Financial","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$financial->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","viewbooking":"viewbooking","propmgt_description":"propmgt_description","propmgt_price":"propmgt_price","pmenddate":"pmenddate","pmstartdate":"pmstartdate","pm_price_override":"pm_price_override","annualinsurance":"annualinsurance","terms":"terms","averageutilgas":"averageutilgas","averageutilelec":"averageutilelec","electricservice":"electricservice","utilities":"utilities","taxyear":"taxyear","taxannual":"taxannual","availdate":"availdate","private":"private","hofees":"hofees"}}';
			$financial->router = 'RealestatenowHelperRoute::getFinancialRoute';
			$financial->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/financial.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid","viewbooking"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "terms","targetTable": "#__realestatenow_feature_type","targetColumn": "id","displayColumn": "featurename"}]}';

			// [Interpretation 4713] Check if financial type is already in content_type DB.
			$financial_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($financial->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$financial->type_id = $db->loadResult();
				$financial_Updated = $db->updateObject('#__content_types', $financial, 'type_id');
			}
			else
			{
				$financial_Inserted = $db->insertObject('#__content_types', $financial);
			}

			// [Interpretation 4704] Create the rental content type object.
			$rental = new stdClass();
			$rental->type_title = 'Realestatenow Rental';
			$rental->type_alias = 'com_realestatenow.rental';
			$rental->table = '{"special": {"dbtable": "#__realestatenow_rental","key": "id","type": "Rental","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$rental->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","sleeps":"sleeps","deposit":"deposit","freq":"freq","offpeak":"offpeak","rent_type":"rent_type"}}';
			$rental->router = 'RealestatenowHelperRoute::getRentalRoute';
			$rental->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/rental.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid","sleeps","freq","rent_type"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "freq","targetTable": "#__realestatenow_rental_frequency","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "rent_type","targetTable": "#__realestatenow_rent_type","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if rental type is already in content_type DB.
			$rental_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($rental->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$rental->type_id = $db->loadResult();
				$rental_Updated = $db->updateObject('#__content_types', $rental, 'type_id');
			}
			else
			{
				$rental_Inserted = $db->insertObject('#__content_types', $rental);
			}

			// [Interpretation 4704] Create the market_status content type object.
			$market_status = new stdClass();
			$market_status->type_title = 'Realestatenow Market_status';
			$market_status->type_alias = 'com_realestatenow.market_status';
			$market_status->table = '{"special": {"dbtable": "#__realestatenow_market_status","key": "id","type": "Market_status","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$market_status->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias"}}';
			$market_status->router = 'RealestatenowHelperRoute::getMarket_statusRoute';
			$market_status->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/market_status.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if market_status type is already in content_type DB.
			$market_status_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($market_status->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$market_status->type_id = $db->loadResult();
				$market_status_Updated = $db->updateObject('#__content_types', $market_status, 'type_id');
			}
			else
			{
				$market_status_Inserted = $db->insertObject('#__content_types', $market_status);
			}

			// [Interpretation 4704] Create the transaction_type content type object.
			$transaction_type = new stdClass();
			$transaction_type->type_title = 'Realestatenow Transaction_type';
			$transaction_type->type_alias = 'com_realestatenow.transaction_type';
			$transaction_type->table = '{"special": {"dbtable": "#__realestatenow_transaction_type","key": "id","type": "Transaction_type","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$transaction_type->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias"}}';
			$transaction_type->router = 'RealestatenowHelperRoute::getTransaction_typeRoute';
			$transaction_type->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/transaction_type.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if transaction_type type is already in content_type DB.
			$transaction_type_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($transaction_type->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$transaction_type->type_id = $db->loadResult();
				$transaction_type_Updated = $db->updateObject('#__content_types', $transaction_type, 'type_id');
			}
			else
			{
				$transaction_type_Inserted = $db->insertObject('#__content_types', $transaction_type);
			}

			// [Interpretation 4704] Create the rental_frequency content type object.
			$rental_frequency = new stdClass();
			$rental_frequency->type_title = 'Realestatenow Rental_frequency';
			$rental_frequency->type_alias = 'com_realestatenow.rental_frequency';
			$rental_frequency->table = '{"special": {"dbtable": "#__realestatenow_rental_frequency","key": "id","type": "Rental_frequency","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$rental_frequency->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias"}}';
			$rental_frequency->router = 'RealestatenowHelperRoute::getRental_frequencyRoute';
			$rental_frequency->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/rental_frequency.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if rental_frequency type is already in content_type DB.
			$rental_frequency_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($rental_frequency->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$rental_frequency->type_id = $db->loadResult();
				$rental_frequency_Updated = $db->updateObject('#__content_types', $rental_frequency, 'type_id');
			}
			else
			{
				$rental_frequency_Inserted = $db->insertObject('#__content_types', $rental_frequency);
			}

			// [Interpretation 4704] Create the rent_type content type object.
			$rent_type = new stdClass();
			$rent_type->type_title = 'Realestatenow Rent_type';
			$rent_type->type_alias = 'com_realestatenow.rent_type';
			$rent_type->table = '{"special": {"dbtable": "#__realestatenow_rent_type","key": "id","type": "Rent_type","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$rent_type->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","alias":"alias"}}';
			$rent_type->router = 'RealestatenowHelperRoute::getRent_typeRoute';
			$rent_type->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/rent_type.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if rent_type type is already in content_type DB.
			$rent_type_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($rent_type->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$rent_type->type_id = $db->loadResult();
				$rent_type_Updated = $db->updateObject('#__content_types', $rent_type, 'type_id');
			}
			else
			{
				$rent_type_Inserted = $db->insertObject('#__content_types', $rent_type);
			}

			// [Interpretation 4704] Create the feature_type content type object.
			$feature_type = new stdClass();
			$feature_type->type_title = 'Realestatenow Feature_type';
			$feature_type->type_alias = 'com_realestatenow.feature_type';
			$feature_type->table = '{"special": {"dbtable": "#__realestatenow_feature_type","key": "id","type": "Feature_type","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$feature_type->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "featurename","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"featurename":"featurename","featuretype":"featuretype","alias":"alias"}}';
			$feature_type->router = 'RealestatenowHelperRoute::getFeature_typeRoute';
			$feature_type->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/feature_type.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","featuretype"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if feature_type type is already in content_type DB.
			$feature_type_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($feature_type->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$feature_type->type_id = $db->loadResult();
				$feature_type_Updated = $db->updateObject('#__content_types', $feature_type, 'type_id');
			}
			else
			{
				$feature_type_Inserted = $db->insertObject('#__content_types', $feature_type);
			}

			// [Interpretation 4704] Create the mls content type object.
			$mls = new stdClass();
			$mls->type_title = 'Realestatenow Mls';
			$mls->type_alias = 'com_realestatenow.mls';
			$mls->table = '{"special": {"dbtable": "#__realestatenow_mls","key": "id","type": "Mls","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$mls->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","mls_disclaimer":"mls_disclaimer","mls_image":"mls_image","alias":"alias"}}';
			$mls->router = 'RealestatenowHelperRoute::getMlsRoute';
			$mls->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/mls.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if mls type is already in content_type DB.
			$mls_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($mls->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$mls->type_id = $db->loadResult();
				$mls_Updated = $db->updateObject('#__content_types', $mls, 'type_id');
			}
			else
			{
				$mls_Inserted = $db->insertObject('#__content_types', $mls);
			}

			// [Interpretation 4704] Create the favorite_listing content type object.
			$favorite_listing = new stdClass();
			$favorite_listing->type_title = 'Realestatenow Favorite_listing';
			$favorite_listing->type_alias = 'com_realestatenow.favorite_listing';
			$favorite_listing->table = '{"special": {"dbtable": "#__realestatenow_favorite_listing","key": "id","type": "Favorite_listing","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$favorite_listing->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"uid":"uid","propertyid":"propertyid"}}';
			$favorite_listing->router = 'RealestatenowHelperRoute::getFavorite_listingRoute';
			$favorite_listing->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/favorite_listing.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","uid","propertyid"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "propertyid","targetTable": "#__realestatenow_property","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if favorite_listing type is already in content_type DB.
			$favorite_listing_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($favorite_listing->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$favorite_listing->type_id = $db->loadResult();
				$favorite_listing_Updated = $db->updateObject('#__content_types', $favorite_listing, 'type_id');
			}
			else
			{
				$favorite_listing_Inserted = $db->insertObject('#__content_types', $favorite_listing);
			}

			// [Interpretation 4704] Create the image content type object.
			$image = new stdClass();
			$image->type_title = 'Realestatenow Image';
			$image->type_alias = 'com_realestatenow.image';
			$image->table = '{"special": {"dbtable": "#__realestatenow_image","key": "id","type": "Image","prefix": "realestatenowTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$image->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "null","core_state": "published","core_alias": "null","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"propid":"propid","path":"path","filename":"filename","type":"type","rets_source":"rets_source","settings_id":"settings_id","description":"description","title":"title","remote":"remote"}}';
			$image->router = 'RealestatenowHelperRoute::getImageRoute';
			$image->content_history_options = '{"formFile": "administrator/components/com_realestatenow/models/forms/image.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","propid","settings_id"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// [Interpretation 4713] Check if image type is already in content_type DB.
			$image_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($image->type_alias));
			$db->setQuery($query);
			$db->execute();

			// [Interpretation 4722] Set the object into the content types table.
			if ($db->getNumRows())
			{
				$image->type_id = $db->loadResult();
				$image_Updated = $db->updateObject('#__content_types', $image, 'type_id');
			}
			else
			{
				$image_Inserted = $db->insertObject('#__content_types', $image);
			}



		// Get Application object
		$app = JFactory::getApplication();
		$app->enqueueMessage('Real Estate NOW! has been successfully updated.', 'Info');

			echo '<a target="_blank" href="https://mostwantedrealestatesites.com" title="Real Estate NOW!">
				<img src="components/com_realestatenow/assets/images/vdm-component.jpg"/>
				</a>
				<h3>Upgrade to Version 3.1.18 Was Successful! Let us know if anything is not working as expected.</h3>';
		}
	}
}
