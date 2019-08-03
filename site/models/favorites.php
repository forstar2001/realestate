<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		favorites.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Realestatenow Model for Favorites
 */
class RealestatenowModelFavorites extends JModelList
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

		// [Interpretation 1592] Get from #__realestatenow_favorite_listing as a
		$query->select($db->quoteName(
			array('a.id','a.asset_id','a.uid','a.propertyid','a.published','a.created_by','a.modified_by','a.created','a.modified','a.version','a.hits','a.ordering'),
			array('id','asset_id','uid','propertyid','published','created_by','modified_by','created','modified','version','hits','ordering')));
		$query->from($db->quoteName('#__realestatenow_favorite_listing', 'a'));

		// [Interpretation 1592] Get from #__realestatenow_property as b
		$query->select($db->quoteName(
			array('b.id','b.asset_id','b.street','b.streettwo','b.countryid','b.cityid','b.stateid','b.postcode','b.county','b.viewad','b.soleagency','b.listoffice','b.agent','b.colistagent','b.showprice','b.featured','b.sold','b.closeprice','b.closedate','b.priceview','b.mlslookup','b.mls_id','b.trans_type','b.mkt_stats','b.name','b.alias','b.catid','b.price','b.propdesc','b.bedrooms','b.bathrooms','b.fullbaths','b.thqtrbaths','b.halfbaths','b.qtrbaths','b.squarefeet','b.sqftlower','b.sqftmainlevel','b.sqftupper','b.style','b.openhouseinfo','b.openhouse','b.mediaurl','b.mediatype','b.pdfinfoone','b.pdfinfotwo','b.flplone','b.flpltwo','b.covenantsyn','b.owncoords','b.latitude','b.longitude','b.rets_source','b.fbposted','b.settings_id','b.ghost','b.published','b.created_by','b.modified_by','b.created','b.modified','b.version','b.hits','b.ordering'),
			array('property_id','property_asset_id','property_street','property_streettwo','property_countryid','property_cityid','property_stateid','property_postcode','property_county','property_viewad','property_soleagency','property_listoffice','property_agent','property_colistagent','property_showprice','property_featured','property_sold','property_closeprice','property_closedate','property_priceview','property_mlslookup','property_mls_id','property_trans_type','property_mkt_stats','property_name','property_alias','property_catid','property_price','property_propdesc','property_bedrooms','property_bathrooms','property_fullbaths','property_thqtrbaths','property_halfbaths','property_qtrbaths','property_squarefeet','property_sqftlower','property_sqftmainlevel','property_sqftupper','property_style','property_openhouseinfo','property_openhouse','property_mediaurl','property_mediatype','property_pdfinfoone','property_pdfinfotwo','property_flplone','property_flpltwo','property_covenantsyn','property_owncoords','property_latitude','property_longitude','property_rets_source','property_fbposted','property_settings_id','property_ghost','property_published','property_created_by','property_modified_by','property_created','property_modified','property_version','property_hits','property_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_property', 'b')) . ' ON (' . $db->quoteName('a.propertyid') . ' = ' . $db->quoteName('b.id') . ')');

		// [Interpretation 1592] Get from #__realestatenow_city as c
		$query->select($db->quoteName(
			array('c.id','c.asset_id','c.image','c.description','c.name','c.stateid','c.alias','c.owncoords','c.latitude','c.longitude','c.published','c.created_by','c.modified_by','c.created','c.modified','c.version','c.hits','c.ordering'),
			array('city_id','city_asset_id','city_image','city_description','city_name','city_stateid','city_alias','city_owncoords','city_latitude','city_longitude','city_published','city_created_by','city_modified_by','city_created','city_modified','city_version','city_hits','city_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_city', 'c')) . ' ON (' . $db->quoteName('b.cityid') . ' = ' . $db->quoteName('c.id') . ')');

		// [Interpretation 1592] Get from #__realestatenow_state as d
		$query->select($db->quoteName(
			array('d.id','d.asset_id','d.image','d.description','d.name','d.alias','d.countryid','d.owncoords','d.latitude','d.longitude','d.published','d.created_by','d.modified_by','d.created','d.modified','d.version','d.hits','d.ordering'),
			array('state_id','state_asset_id','state_image','state_description','state_name','state_alias','state_countryid','state_owncoords','state_latitude','state_longitude','state_published','state_created_by','state_modified_by','state_created','state_modified','state_version','state_hits','state_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_state', 'd')) . ' ON (' . $db->quoteName('b.stateid') . ' = ' . $db->quoteName('d.id') . ')');

		// [Interpretation 1592] Get from #__realestatenow_area as i
		$query->select($db->quoteName(
			array('i.id','i.asset_id','i.ctown','i.ctport','i.schooldist','i.elementary','i.midschool','i.highschool','i.university','i.propid','i.published','i.created_by','i.modified_by','i.created','i.modified','i.version','i.hits','i.ordering'),
			array('area_id','area_asset_id','area_ctown','area_ctport','area_schooldist','area_elementary','area_midschool','area_highschool','area_university','area_propid','area_published','area_created_by','area_modified_by','area_created','area_modified','area_version','area_hits','area_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_area', 'i')) . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('i.propid') . ')');

		// [Interpretation 1592] Get from #__realestatenow_commercial as j
		$query->select($db->quoteName(
			array('j.id','j.asset_id','j.bldg_name','j.takings','j.returns','j.netprofit','j.bustype','j.bussubtype','j.percentoffice','j.percentwarehouse','j.loadingfac','j.currentuse','j.carryingcap','j.propid','j.published','j.created_by','j.modified_by','j.created','j.modified','j.version','j.hits','j.ordering'),
			array('commercial_id','commercial_asset_id','commercial_bldg_name','commercial_takings','commercial_returns','commercial_netprofit','commercial_bustype','commercial_bussubtype','commercial_percentoffice','commercial_percentwarehouse','commercial_loadingfac','commercial_currentuse','commercial_carryingcap','commercial_propid','commercial_published','commercial_created_by','commercial_modified_by','commercial_created','commercial_modified','commercial_version','commercial_hits','commercial_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_commercial', 'j')) . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('j.propid') . ')');

		// [Interpretation 1592] Get from #__realestatenow_feature as k
		$query->select($db->quoteName(
			array('k.id','k.asset_id','k.exteriorfinish','k.porchpatio','k.frontage','k.garagetype','k.parkingdesc','k.parkingspaceyn','k.parkingspaces','k.basementandfoundation','k.roof','k.heating','k.cooling','k.fencing','k.waterresources','k.sewer','k.zoning','k.propid','k.appliances','k.indoorfeatures','k.outdoorfeatures','k.communityfeatures','k.otherfeatures','k.published','k.created_by','k.modified_by','k.created','k.modified','k.version','k.hits','k.ordering'),
			array('feature_id','feature_asset_id','feature_exteriorfinish','feature_porchpatio','feature_frontage','feature_garagetype','feature_parkingdesc','feature_parkingspaceyn','feature_parkingspaces','feature_basementandfoundation','feature_roof','feature_heating','feature_cooling','feature_fencing','feature_waterresources','feature_sewer','feature_zoning','feature_propid','feature_appliances','feature_indoorfeatures','feature_outdoorfeatures','feature_communityfeatures','feature_otherfeatures','feature_published','feature_created_by','feature_modified_by','feature_created','feature_modified','feature_version','feature_hits','feature_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_feature', 'k')) . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('k.propid') . ')');

		// [Interpretation 1592] Get from #__realestatenow_financial as l
		$query->select($db->quoteName(
			array('l.id','l.asset_id','l.hofees','l.annualinsurance','l.taxannual','l.taxyear','l.utilities','l.electricservice','l.averageutilelec','l.averageutilgas','l.terms','l.propid','l.pm_price_override','l.pmstartdate','l.pmenddate','l.propmgt_price','l.propmgt_description','l.viewbooking','l.availdate','l.private','l.published','l.created_by','l.modified_by','l.created','l.modified','l.version','l.hits','l.ordering'),
			array('financial_id','financial_asset_id','financial_hofees','financial_annualinsurance','financial_taxannual','financial_taxyear','financial_utilities','financial_electricservice','financial_averageutilelec','financial_averageutilgas','financial_terms','financial_propid','financial_pm_price_override','financial_pmstartdate','financial_pmenddate','financial_propmgt_price','financial_propmgt_description','financial_viewbooking','financial_availdate','financial_private','financial_published','financial_created_by','financial_modified_by','financial_created','financial_modified','financial_version','financial_hits','financial_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_financial', 'l')) . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('l.propid') . ')');

		// [Interpretation 1592] Get from #__realestatenow_rental as m
		$query->select($db->quoteName(
			array('m.id','m.asset_id','m.rent_type','m.offpeak','m.freq','m.deposit','m.sleeps','m.propid','m.published','m.created_by','m.modified_by','m.created','m.modified','m.version','m.hits','m.ordering'),
			array('rental_id','rental_asset_id','rental_rent_type','rental_offpeak','rental_freq','rental_deposit','rental_sleeps','rental_propid','rental_published','rental_created_by','rental_modified_by','rental_created','rental_modified','rental_version','rental_hits','rental_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_rental', 'm')) . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('m.propid') . ')');

		// [Interpretation 1592] Get from #__realestatenow_residential as n
		$query->select($db->quoteName(
			array('n.id','n.asset_id','n.year','n.yearremodeled','n.flooring','n.waterfront','n.waterfronttype','n.welldepth','n.subdivision','n.totalrooms','n.otherrooms','n.livingarea','n.ensuite','n.stories','n.basementsize','n.basementpctfinished','n.houseconstruction','n.phoneavailableyn','n.garbagedisposalyn','n.familyroompresent','n.laundryroompresent','n.kitchenpresent','n.livingroompresent','n.customone','n.customtwo','n.customthree','n.addcustom','n.storage','n.propid','n.published','n.created_by','n.modified_by','n.created','n.modified','n.version','n.hits','n.ordering'),
			array('residential_id','residential_asset_id','residential_year','residential_yearremodeled','residential_flooring','residential_waterfront','residential_waterfronttype','residential_welldepth','residential_subdivision','residential_totalrooms','residential_otherrooms','residential_livingarea','residential_ensuite','residential_stories','residential_basementsize','residential_basementpctfinished','residential_houseconstruction','residential_phoneavailableyn','residential_garbagedisposalyn','residential_familyroompresent','residential_laundryroompresent','residential_kitchenpresent','residential_livingroompresent','residential_customone','residential_customtwo','residential_customthree','residential_addcustom','residential_storage','residential_propid','residential_published','residential_created_by','residential_modified_by','residential_created','residential_modified','residential_version','residential_hits','residential_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_residential', 'n')) . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('n.propid') . ')');

		// [Interpretation 1592] Get from #__realestatenow_land as o
		$query->select($db->quoteName(
			array('o.id','o.asset_id','o.landtype','o.stock','o.fixtures','o.fittings','o.rainfall','o.soiltype','o.grazing','o.cropping','o.irrigation','o.propid','o.published','o.created_by','o.modified_by','o.created','o.modified','o.version','o.hits','o.ordering'),
			array('land_id','land_asset_id','land_landtype','land_stock','land_fixtures','land_fittings','land_rainfall','land_soiltype','land_grazing','land_cropping','land_irrigation','land_propid','land_published','land_created_by','land_modified_by','land_created','land_modified','land_version','land_hits','land_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_land', 'o')) . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('o.propid') . ')');

		// [Interpretation 1592] Get from #__realestatenow_multifamily as p
		$query->select($db->quoteName(
			array('p.id','p.asset_id','p.bldgsqft','p.totalrents','p.numunits','p.tenancytype','p.tenantpdutilities','p.commonareas','p.unitdetails','p.unitfeatures','p.propid','p.published','p.created_by','p.modified_by','p.created','p.modified','p.version','p.hits','p.ordering'),
			array('multifamily_id','multifamily_asset_id','multifamily_bldgsqft','multifamily_totalrents','multifamily_numunits','multifamily_tenancytype','multifamily_tenantpdutilities','multifamily_commonareas','multifamily_unitdetails','multifamily_unitfeatures','multifamily_propid','multifamily_published','multifamily_created_by','multifamily_modified_by','multifamily_created','multifamily_modified','multifamily_version','multifamily_hits','multifamily_ordering')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_multifamily', 'p')) . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('p.propid') . ')');
		$query->where('a.access IN (' . implode(',', $this->levels) . ')');
		$query->where('a.uid = ' . (int) $this->userId);
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
		if (!$user->authorise('site.favorites.access', 'com_realestatenow'))
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('COM_REALESTATENOW_NOT_AUTHORISED_TO_VIEW_FAVORITES'), 'error');
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
				// [Interpretation 1811] Check if we can decode property_openhouseinfo
				if (RealestatenowHelper::checkJson($item->property_openhouseinfo))
				{
					// [Interpretation 1811] Decode property_openhouseinfo
					$item->property_openhouseinfo = json_decode($item->property_openhouseinfo, true);
				}
				// [Interpretation 1811] Check if we can decode property_style
				if (RealestatenowHelper::checkJson($item->property_style))
				{
					// [Interpretation 1811] Decode property_style
					$item->property_style = json_decode($item->property_style, true);
				}
				// [Interpretation 1848] Check if item has params, or pass whole item.
				$params = (isset($item->params) && RealestatenowHelper::checkJson($item->params)) ? json_decode($item->params) : $item;
				// [Interpretation 1852] Make sure the content prepare plugins fire on property_propdesc
				$_property_propdesc = new stdClass();
				$_property_propdesc->text =& $item->property_propdesc; // [Interpretation 1854] value must be in text
				// [Interpretation 1855] Since all values are now in text (Joomla Limitation), we also add the field name (property_propdesc) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.favorites.property_propdesc', &$_property_propdesc, &$params, 0));
				// [Interpretation 1883] Checking if property_propdesc has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->property_propdesc,$this->uikitComp);
				// [Interpretation 1848] Check if item has params, or pass whole item.
				$params = (isset($item->params) && RealestatenowHelper::checkJson($item->params)) ? json_decode($item->params) : $item;
				// [Interpretation 1852] Make sure the content prepare plugins fire on city_description
				$_city_description = new stdClass();
				$_city_description->text =& $item->city_description; // [Interpretation 1854] value must be in text
				// [Interpretation 1855] Since all values are now in text (Joomla Limitation), we also add the field name (city_description) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.favorites.city_description', &$_city_description, &$params, 0));
				// [Interpretation 1883] Checking if city_description has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->city_description,$this->uikitComp);
				// [Interpretation 1848] Check if item has params, or pass whole item.
				$params = (isset($item->params) && RealestatenowHelper::checkJson($item->params)) ? json_decode($item->params) : $item;
				// [Interpretation 1852] Make sure the content prepare plugins fire on state_description
				$_state_description = new stdClass();
				$_state_description->text =& $item->state_description; // [Interpretation 1854] value must be in text
				// [Interpretation 1855] Since all values are now in text (Joomla Limitation), we also add the field name (state_description) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.favorites.state_description', &$_state_description, &$params, 0));
				// [Interpretation 1883] Checking if state_description has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->state_description,$this->uikitComp);
				// [Interpretation 1811] Check if we can decode feature_sewer
				if (RealestatenowHelper::checkJson($item->feature_sewer))
				{
					// [Interpretation 1811] Decode feature_sewer
					$item->feature_sewer = json_decode($item->feature_sewer, true);
				}
				// [Interpretation 1811] Check if we can decode feature_zoning
				if (RealestatenowHelper::checkJson($item->feature_zoning))
				{
					// [Interpretation 1811] Decode feature_zoning
					$item->feature_zoning = json_decode($item->feature_zoning, true);
				}
				// [Interpretation 1811] Check if we can decode feature_porchpatio
				if (RealestatenowHelper::checkJson($item->feature_porchpatio))
				{
					// [Interpretation 1811] Decode feature_porchpatio
					$item->feature_porchpatio = json_decode($item->feature_porchpatio, true);
				}
				// [Interpretation 1811] Check if we can decode feature_waterresources
				if (RealestatenowHelper::checkJson($item->feature_waterresources))
				{
					// [Interpretation 1811] Decode feature_waterresources
					$item->feature_waterresources = json_decode($item->feature_waterresources, true);
				}
				// [Interpretation 1811] Check if we can decode feature_outdoorfeatures
				if (RealestatenowHelper::checkJson($item->feature_outdoorfeatures))
				{
					// [Interpretation 1811] Decode feature_outdoorfeatures
					$item->feature_outdoorfeatures = json_decode($item->feature_outdoorfeatures, true);
				}
				// [Interpretation 1811] Check if we can decode feature_otherfeatures
				if (RealestatenowHelper::checkJson($item->feature_otherfeatures))
				{
					// [Interpretation 1811] Decode feature_otherfeatures
					$item->feature_otherfeatures = json_decode($item->feature_otherfeatures, true);
				}
				// [Interpretation 1811] Check if we can decode feature_basementandfoundation
				if (RealestatenowHelper::checkJson($item->feature_basementandfoundation))
				{
					// [Interpretation 1811] Decode feature_basementandfoundation
					$item->feature_basementandfoundation = json_decode($item->feature_basementandfoundation, true);
				}
				// [Interpretation 1811] Check if we can decode feature_roof
				if (RealestatenowHelper::checkJson($item->feature_roof))
				{
					// [Interpretation 1811] Decode feature_roof
					$item->feature_roof = json_decode($item->feature_roof, true);
				}
				// [Interpretation 1811] Check if we can decode feature_garagetype
				if (RealestatenowHelper::checkJson($item->feature_garagetype))
				{
					// [Interpretation 1811] Decode feature_garagetype
					$item->feature_garagetype = json_decode($item->feature_garagetype, true);
				}
				// [Interpretation 1811] Check if we can decode feature_frontage
				if (RealestatenowHelper::checkJson($item->feature_frontage))
				{
					// [Interpretation 1811] Decode feature_frontage
					$item->feature_frontage = json_decode($item->feature_frontage, true);
				}
				// [Interpretation 1811] Check if we can decode feature_appliances
				if (RealestatenowHelper::checkJson($item->feature_appliances))
				{
					// [Interpretation 1811] Decode feature_appliances
					$item->feature_appliances = json_decode($item->feature_appliances, true);
				}
				// [Interpretation 1811] Check if we can decode feature_heating
				if (RealestatenowHelper::checkJson($item->feature_heating))
				{
					// [Interpretation 1811] Decode feature_heating
					$item->feature_heating = json_decode($item->feature_heating, true);
				}
				// [Interpretation 1811] Check if we can decode feature_indoorfeatures
				if (RealestatenowHelper::checkJson($item->feature_indoorfeatures))
				{
					// [Interpretation 1811] Decode feature_indoorfeatures
					$item->feature_indoorfeatures = json_decode($item->feature_indoorfeatures, true);
				}
				// [Interpretation 1811] Check if we can decode feature_cooling
				if (RealestatenowHelper::checkJson($item->feature_cooling))
				{
					// [Interpretation 1811] Decode feature_cooling
					$item->feature_cooling = json_decode($item->feature_cooling, true);
				}
				// [Interpretation 1811] Check if we can decode feature_communityfeatures
				if (RealestatenowHelper::checkJson($item->feature_communityfeatures))
				{
					// [Interpretation 1811] Decode feature_communityfeatures
					$item->feature_communityfeatures = json_decode($item->feature_communityfeatures, true);
				}
				// [Interpretation 1811] Check if we can decode feature_fencing
				if (RealestatenowHelper::checkJson($item->feature_fencing))
				{
					// [Interpretation 1811] Decode feature_fencing
					$item->feature_fencing = json_decode($item->feature_fencing, true);
				}
				// [Interpretation 1811] Check if we can decode feature_exteriorfinish
				if (RealestatenowHelper::checkJson($item->feature_exteriorfinish))
				{
					// [Interpretation 1811] Decode feature_exteriorfinish
					$item->feature_exteriorfinish = json_decode($item->feature_exteriorfinish, true);
				}
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
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.favorites.financial_private', &$_financial_private, &$params, 0));
				// [Interpretation 1883] Checking if financial_private has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->financial_private,$this->uikitComp);
				// [Interpretation 1811] Check if we can decode residential_addcustom
				if (RealestatenowHelper::checkJson($item->residential_addcustom))
				{
					// [Interpretation 1811] Decode residential_addcustom
					$item->residential_addcustom = json_decode($item->residential_addcustom, true);
				}
				// [Interpretation 1811] Check if we can decode multifamily_unitfeatures
				if (RealestatenowHelper::checkJson($item->multifamily_unitfeatures))
				{
					// [Interpretation 1811] Decode multifamily_unitfeatures
					$item->multifamily_unitfeatures = json_decode($item->multifamily_unitfeatures, true);
				}
				// [Interpretation 1811] Check if we can decode multifamily_commonareas
				if (RealestatenowHelper::checkJson($item->multifamily_commonareas))
				{
					// [Interpretation 1811] Decode multifamily_commonareas
					$item->multifamily_commonareas = json_decode($item->multifamily_commonareas, true);
				}
				// [Interpretation 1811] Check if we can decode multifamily_unitdetails
				if (RealestatenowHelper::checkJson($item->multifamily_unitdetails))
				{
					// [Interpretation 1811] Decode multifamily_unitdetails
					$item->multifamily_unitdetails = json_decode($item->multifamily_unitdetails, true);
				}
				// [Interpretation 1917] set idPropidImageH to the $item object.
				$item->idPropidImageH = $this->getIdPropidImageCbdd_H($item->property_id);
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
	public function getIdPropidImageCbdd_H($id)
	{
		// [Interpretation 2743] Get a db connection.
		$db = JFactory::getDbo();

		// [Interpretation 2745] Create a new query object.
		$query = $db->getQuery(true);

		// [Interpretation 2747] Get from #__realestatenow_image as h
		$query->select($db->quoteName(
			array('h.id','h.asset_id','h.propid','h.path','h.filename','h.type','h.title','h.description','h.rets_source','h.published','h.created_by','h.modified_by','h.created','h.modified','h.version','h.hits','h.ordering'),
			array('id','asset_id','propid','path','filename','type','title','description','rets_source','published','created_by','modified_by','created','modified','version','hits','ordering')));
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
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.favorites.description', &$_description, &$params, 0));
				// [Interpretation 1883] Checking if description has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->description,$this->uikitComp);
			}
			return $items;
		}
		return false;
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
