<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		agentview.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Realestatenow Model for Agentview
 */
class RealestatenowModelAgentview extends JModelList
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

		// [Interpretation 1592] Get from #__realestatenow_property as a
		$query->select($db->quoteName(
			array('a.id','a.asset_id','a.street','a.streettwo','a.countryid','a.cityid','a.stateid','a.postcode','a.county','a.viewad','a.soleagency','a.listoffice','a.agent','a.colistagent','a.showprice','a.featured','a.sold','a.closeprice','a.closedate','a.priceview','a.mlslookup','a.mls_id','a.trans_type','a.mkt_stats','a.name','a.alias','a.catid','a.price','a.propdesc','a.landareasqft','a.acrestotal','a.lotdimensions','a.bedrooms','a.bathrooms','a.fullbaths','a.thqtrbaths','a.halfbaths','a.qtrbaths','a.squarefeet','a.sqftlower','a.sqftmainlevel','a.sqftupper','a.style','a.openhouseinfo','a.openhouse','a.mediaurl','a.mediatype','a.pdfinfoone','a.pdfinfotwo','a.flplone','a.flpltwo','a.covenantsyn','a.owncoords','a.latitude','a.longitude','a.rets_source','a.fbposted','a.settings_id','a.ghost','a.published','a.created_by','a.modified_by','a.created','a.modified','a.version','a.hits','a.ordering'),
			array('id','asset_id','street','streettwo','countryid','cityid','stateid','postcode','county','viewad','soleagency','listoffice','agent','colistagent','showprice','featured','sold','closeprice','closedate','priceview','mlslookup','mls_id','trans_type','mkt_stats','name','alias','catid','price','propdesc','landareasqft','acrestotal','lotdimensions','bedrooms','bathrooms','fullbaths','thqtrbaths','halfbaths','qtrbaths','squarefeet','sqftlower','sqftmainlevel','sqftupper','style','openhouseinfo','openhouse','mediaurl','mediatype','pdfinfoone','pdfinfotwo','flplone','flpltwo','covenantsyn','owncoords','latitude','longitude','rets_source','fbposted','settings_id','ghost','published','created_by','modified_by','created','modified','version','hits','ordering')));
		$query->from($db->quoteName('#__realestatenow_property', 'a'));

		// [Interpretation 1592] Get from #__realestatenow_agency as c
		$query->select($db->quoteName(
			array('c.image','c.name'),
			array('agency_image','agency_name')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_agency', 'c')) . ' ON (' . $db->quoteName('a.listoffice') . ' = ' . $db->quoteName('c.id') . ')');

		// [Interpretation 1592] Get from #__realestatenow_agent as d
		$query->select($db->quoteName(
			array('d.name'),
			array('agent_name')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_agent', 'd')) . ' ON (' . $db->quoteName('a.agent') . ' = ' . $db->quoteName('d.id') . ')');

		// [Interpretation 1592] Get from #__realestatenow_country as e
		$query->select($db->quoteName(
			array('e.name'),
			array('country_name')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_country', 'e')) . ' ON (' . $db->quoteName('a.countryid') . ' = ' . $db->quoteName('e.id') . ')');

		// [Interpretation 1592] Get from #__realestatenow_state as f
		$query->select($db->quoteName(
			array('f.name'),
			array('state_name')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_state', 'f')) . ' ON (' . $db->quoteName('a.stateid') . ' = ' . $db->quoteName('f.id') . ')');

		// [Interpretation 1592] Get from #__realestatenow_city as g
		$query->select($db->quoteName(
			array('g.name'),
			array('city_name')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_city', 'g')) . ' ON (' . $db->quoteName('a.cityid') . ' = ' . $db->quoteName('g.id') . ')');

		// [Interpretation 1592] Get from #__realestatenow_financial as i
		$query->select($db->quoteName(
			array('i.id','i.asset_id','i.hofees','i.annualinsurance','i.taxannual','i.taxyear','i.utilities','i.electricservice','i.averageutilelec','i.averageutilgas','i.terms','i.propid','i.pm_price_override','i.pmstartdate','i.pmenddate','i.propmgt_price','i.propmgt_description','i.viewbooking','i.availdate','i.private','i.published','i.created_by','i.modified_by','i.created','i.modified','i.version','i.hits','i.ordering'),
			array('financial_id','financial_asset_id','financial_hofees','financial_annualinsurance','financial_taxannual','financial_taxyear','financial_utilities','financial_electricservice','financial_averageutilelec','financial_averageutilgas','financial_terms','financial_propid','financial_pm_price_override','financial_pmstartdate','financial_pmenddate','financial_propmgt_price','financial_propmgt_description','financial_viewbooking','financial_availdate','financial_private','financial_published','financial_created_by','financial_modified_by','financial_created','financial_modified','financial_version','financial_hits','financial_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_financial', 'i')) . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('i.propid') . ')');

		// [Interpretation 1592] Get from #__categories as b
		$query->select($db->quoteName(
			array('b.title','b.alias'),
			array('title','alias')));
		$query->join('LEFT', ($db->quoteName('#__categories', 'b')) . ' ON (' . $db->quoteName('a.catid') . ' = ' . $db->quoteName('b.id') . ')');
		// [Interpretation 2013] Check if JRequest::getInt('id') is a string or numeric value.
		$checkValue = JRequest::getInt('id');
		if (isset($checkValue) && RealestatenowHelper::checkString($checkValue))
		{
			$query->where('a.agent = ' . $db->quote($checkValue));
		}
		elseif (is_numeric($checkValue))
		{
			$query->where('a.agent = ' . $checkValue);
		}
		else
		{
			return false;
		}
		$query->where('a.access IN (' . implode(',', $this->levels) . ')');
		// [Interpretation 2167] Get where a.published is 1
		$query->where('a.published = 1');
		$query->order('a.ordering ASC');

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
		if (!$user->authorise('site.agentview.access', 'com_realestatenow'))
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('COM_REALESTATENOW_NOT_AUTHORISED_TO_VIEW_AGENTVIEW'), 'error');
			// [Interpretation 2255] redirect away to the default view if no access allowed.
			$app->redirect(JRoute::_('index.php?option=com_realestatenow&view=properties'));
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
				// [Interpretation 1811] Check if we can decode openhouseinfo
				if (RealestatenowHelper::checkJson($item->openhouseinfo))
				{
					// [Interpretation 1811] Decode openhouseinfo
					$item->openhouseinfo = json_decode($item->openhouseinfo, true);
				}
				// [Interpretation 1811] Check if we can decode style
				if (RealestatenowHelper::checkJson($item->style))
				{
					// [Interpretation 1811] Decode style
					$item->style = json_decode($item->style, true);
				}
				// [Interpretation 1848] Check if item has params, or pass whole item.
				$params = (isset($item->params) && RealestatenowHelper::checkJson($item->params)) ? json_decode($item->params) : $item;
				// [Interpretation 1852] Make sure the content prepare plugins fire on propdesc
				$_propdesc = new stdClass();
				$_propdesc->text =& $item->propdesc; // [Interpretation 1854] value must be in text
				// [Interpretation 1855] Since all values are now in text (Joomla Limitation), we also add the field name (propdesc) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.agentview.propdesc', &$_propdesc, &$params, 0));
				// [Interpretation 1883] Checking if propdesc has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->propdesc,$this->uikitComp);
				// [Interpretation 1811] Check if we can decode financial_terms
				if (RealestatenowHelper::checkJson($item->financial_terms))
				{
					// [Interpretation 1811] Decode financial_terms
					$item->financial_terms = json_decode($item->financial_terms, true);
				}
				// [Interpretation 1848] Check if item has params, or pass whole item.
				$params = (isset($item->params) && RealestatenowHelper::checkJson($item->params)) ? json_decode($item->params) : $item;
				// [Interpretation 1852] Make sure the content prepare plugins fire on financial_private
				$_financial_private = new stdClass();
				$_financial_private->text =& $item->financial_private; // [Interpretation 1854] value must be in text
				// [Interpretation 1855] Since all values are now in text (Joomla Limitation), we also add the field name (financial_private) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.agentview.financial_private', &$_financial_private, &$params, 0));
				// [Interpretation 1883] Checking if financial_private has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->financial_private,$this->uikitComp);
				// [Interpretation 1917] set idPropidImageH to the $item object.
				$item->idPropidImageH = $this->getIdPropidImageCabe_H($item->id);
			}
		}

		// return items
		return $items;
	}

	/**
	 * Method to get an array of Image Objects.
	 *
	 * @return mixed  An array of Image Objects on success, false on failure.
	 *
	 */
	public function getIdPropidImageCabe_H($id)
	{
		// [Interpretation 2743] Get a db connection.
		$db = JFactory::getDbo();

		// [Interpretation 2745] Create a new query object.
		$query = $db->getQuery(true);

		// [Interpretation 2747] Get from #__realestatenow_image as h
		$query->select($db->quoteName(
			array('h.path','h.filename','h.type','h.remote','h.title','h.description'),
			array('path','filename','type','remote','title','description')));
		$query->from($db->quoteName('#__realestatenow_image', 'h'));
		$query->where('h.propid = ' . $db->quote($id));

		// [Interpretation 2801] Reset the query using our newly populated query object.
		$db->setQuery($query);
		$db->execute();

		// [Interpretation 2804] check if there was data returned
		if ($db->getNumRows())
		{
			// [Interpretation 1842] Load the JEvent Dispatcher
			JPluginHelper::importPlugin('content');
			$this->_dispatcher = JEventDispatcher::getInstance();
			$items = $db->loadObjectList();

			// [Interpretation 2870] Convert the parameter fields into objects.
			foreach ($items as $nr => &$item)
			{
				// [Interpretation 1848] Check if item has params, or pass whole item.
				$params = (isset($item->params) && RealestatenowHelper::checkJson($item->params)) ? json_decode($item->params) : $item;
				// [Interpretation 1852] Make sure the content prepare plugins fire on description
				$_description = new stdClass();
				$_description->text =& $item->description; // [Interpretation 1854] value must be in text
				// [Interpretation 1855] Since all values are now in text (Joomla Limitation), we also add the field name (description) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.agentview.description', &$_description, &$params, 0));
				// [Interpretation 1883] Checking if description has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->description,$this->uikitComp);
			}
			return $items;
		}
		return false;
	}


	/**
	 * Custom Method
	 *
	 * @return mixed  item data object on success, false on failure.
	 *
	 */
	public function getAgent()
	{

		if (!isset($this->initSet) || !$this->initSet)
		{
			$this->user = JFactory::getUser();
			$this->userId = $this->user->get('id');
			$this->guest = $this->user->get('guest');
			$this->groups = $this->user->get('groups');
			$this->authorisedGroups = $this->user->getAuthorisedGroups();
			$this->levels = $this->user->getAuthorisedViewLevels();
			$this->initSet = true;
		}
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
		// [Interpretation 2013] Check if JRequest::getInt('id') is a string or numeric value.
		$checkValue = JRequest::getInt('id');
		if (isset($checkValue) && RealestatenowHelper::checkString($checkValue))
		{
			$query->where('a.id = ' . $db->quote($checkValue));
		}
		elseif (is_numeric($checkValue))
		{
			$query->where('a.id = ' . $checkValue);
		}
		else
		{
			return false;
		}
		// [Interpretation 2167] Get where a.published is 1
		$query->where('a.published = 1');
		$query->order('a.ordering ASC');

		// [Interpretation 2322] Reset the query using our newly populated query object.
		$db->setQuery($query);
		// [Interpretation 2324] Load the results as a stdClass object.
		$data = $db->loadObject();

		if (empty($data))
		{
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
		$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.agentview.bio', &$_bio, &$params, 0));
		// [Interpretation 1883] Checking if bio has uikit components that must be loaded.
		$this->uikitComp = RealestatenowHelper::getUikitComp($data->bio,$this->uikitComp);

		// [Interpretation 2446] return data object.
		return $data;
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
