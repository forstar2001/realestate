<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.11
	@build			11th August, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		property.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
/***[INSERTED$$$$]***//*365*/
    use Joomla\CMS\MVC\Model\ItemModel as JModelItem;
/***[/INSERTED$$$$]***/

/**
 * Realestatenow Property Model
 */
class RealestatenowModelProperty extends JModelItem
{
	/**
	 * Model context string.
	 *
	 * @var        string
	 */
	protected $_context = 'com_realestatenow.property';

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
		$this->setState('property.id', $id);

		
		if( ( false !== $this->input->getInt('shownav',false) ) && ( false !== $this->input->getInt('offset',false) ) && false!== $this->input->getWord('context',false) )
        {
           $this->setState('offset', $this->input->getInt('offset',false));
           $this->setState('getnavitems',true );
           $this->setState( 'context', $this->input->getWord('context'));
        }
		
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
		// [Interpretation 2227] check if this user has permission to access item
		if (!$this->user->authorise('site.property.access', 'com_realestatenow'))
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('COM_REALESTATENOW_NOT_AUTHORISED_TO_VIEW_PROPERTY'), 'error');
			// [Interpretation 2219] redirect away to the default view if no access allowed.
			$app->redirect(JRoute::_('index.php?option=com_realestatenow&view=properties'));
			return false;
		}
		$this->userId = $this->user->get('id');
		$this->guest = $this->user->get('guest');
		$this->groups = $this->user->get('groups');
		$this->authorisedGroups = $this->user->getAuthorisedGroups();
		$this->levels = $this->user->getAuthorisedViewLevels();
		$this->initSet = true;

		$pk = (!empty($pk)) ? $pk : (int) $this->getState('property.id');
		
		if ($this->_item === null)
		{
			$this->_item = array();
		}

		if (!isset($this->_item[$pk]))
		{
			try
			{
				// [Interpretation 2273] Get a db connection.
				$db = JFactory::getDbo();

				// [Interpretation 2275] Create a new query object.
				$query = $db->getQuery(true);

				// [Interpretation 1583] Get from #__realestatenow_property as a
				$query->select($db->quoteName(
			array('a.id','a.asset_id','a.street','a.streettwo','a.countryid','a.cityid','a.stateid','a.postcode','a.county','a.viewad','a.soleagency','a.listoffice','a.agent','a.colistagent','a.showprice','a.featured','a.sold','a.closeprice','a.closedate','a.priceview','a.mlslookup','a.mls_id','a.trans_type','a.mkt_stats','a.name','a.alias','a.catid','a.price','a.propdesc','a.landareasqft','a.acrestotal','a.lotdimensions','a.bedrooms','a.bathrooms','a.fullbaths','a.thqtrbaths','a.halfbaths','a.qtrbaths','a.squarefeet','a.sqftlower','a.sqftmainlevel','a.sqftupper','a.style','a.openhouseinfo','a.openhouse','a.mediaurl','a.mediatype','a.pdfinfoone','a.pdfinfotwo','a.flplone','a.flpltwo','a.covenantsyn','a.owncoords','a.latitude','a.longitude','a.rets_source','a.fbposted','a.settings_id','a.ghost','a.published','a.created_by','a.modified_by','a.created','a.modified','a.version','a.hits','a.ordering'),
			array('id','asset_id','street','streettwo','countryid','cityid','stateid','postcode','county','viewad','soleagency','listoffice','agent','colistagent','showprice','featured','sold','closeprice','closedate','priceview','mlslookup','mls_id','trans_type','mkt_stats','name','alias','catid','price','propdesc','landareasqft','acrestotal','lotdimensions','bedrooms','bathrooms','fullbaths','thqtrbaths','halfbaths','qtrbaths','squarefeet','sqftlower','sqftmainlevel','sqftupper','style','openhouseinfo','openhouse','mediaurl','mediatype','pdfinfoone','pdfinfotwo','flplone','flpltwo','covenantsyn','owncoords','latitude','longitude','rets_source','fbposted','settings_id','ghost','published','created_by','modified_by','created','modified','version','hits','ordering')));
				$query->from($db->quoteName('#__realestatenow_property', 'a'));

				// [Interpretation 1583] Get from #__realestatenow_country as c
				$query->select($db->quoteName(
			array('c.name'),
			array('country_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_country', 'c')) . ' ON (' . $db->quoteName('a.countryid') . ' = ' . $db->quoteName('c.id') . ')');

				// [Interpretation 1583] Get from #__realestatenow_state as d
				$query->select($db->quoteName(
			array('d.name'),
			array('state_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_state', 'd')) . ' ON (' . $db->quoteName('a.stateid') . ' = ' . $db->quoteName('d.id') . ')');

				// [Interpretation 1583] Get from #__realestatenow_city as e
				$query->select($db->quoteName(
			array('e.name'),
			array('city_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_city', 'e')) . ' ON (' . $db->quoteName('a.cityid') . ' = ' . $db->quoteName('e.id') . ')');

				// [Interpretation 1583] Get from #__realestatenow_agent as f
				$query->select($db->quoteName(
			array('f.email','f.name'),
			array('agent_email','agent_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_agent', 'f')) . ' ON (' . $db->quoteName('a.agent') . ' = ' . $db->quoteName('f.id') . ')');

				// [Interpretation 1583] Get from #__realestatenow_agency as g
				$query->select($db->quoteName(
			array('g.name'),
			array('agency_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_agency', 'g')) . ' ON (' . $db->quoteName('a.listoffice') . ' = ' . $db->quoteName('g.id') . ')');

				// [Interpretation 1583] Get from #__realestatenow_market_status as h
				$query->select($db->quoteName(
			array('h.name'),
			array('market_status_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_market_status', 'h')) . ' ON (' . $db->quoteName('a.mkt_stats') . ' = ' . $db->quoteName('h.id') . ')');

				// [Interpretation 1583] Get from #__realestatenow_transaction_type as k
				$query->select($db->quoteName(
			array('k.name'),
			array('transaction_type_name')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_transaction_type', 'k')) . ' ON (' . $db->quoteName('a.trans_type') . ' = ' . $db->quoteName('k.id') . ')');

				// [Interpretation 1583] Get from #__realestatenow_feature_type as s
				$query->select($db->quoteName(
			array('s.featurename'),
			array('feature_type_style')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_feature_type', 's')) . ' ON (' . $db->quoteName('a.style') . ' = ' . $db->quoteName('s.id') . ')');

				// [Interpretation 1583] Get from #__realestatenow_mls as z
				$query->select($db->quoteName(
			array('z.name','z.mls_image','z.mls_disclaimer'),
			array('mls_name','mls_mls_image','mls_mls_disclaimer')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_mls', 'z')) . ' ON (' . $db->quoteName('a.mlslookup') . ' = ' . $db->quoteName('z.id') . ')');

				// [Interpretation 1583] Get from #__realestatenow_residential as aa
				$query->select($db->quoteName(
			array('aa.year','aa.yearremodeled','aa.flooring','aa.waterfront','aa.waterfronttype','aa.welldepth','aa.subdivision','aa.totalrooms','aa.otherrooms','aa.livingarea','aa.ensuite','aa.stories','aa.basementsize','aa.basementpctfinished','aa.houseconstruction','aa.phoneavailableyn','aa.garbagedisposalyn','aa.familyroompresent','aa.laundryroompresent','aa.kitchenpresent','aa.livingroompresent','aa.customone','aa.customtwo','aa.customthree','aa.addcustom','aa.storage'),
			array('residential_year','residential_yearremodeled','residential_flooring','residential_waterfront','residential_waterfronttype','residential_welldepth','residential_subdivision','residential_totalrooms','residential_otherrooms','residential_livingarea','residential_ensuite','residential_stories','residential_basementsize','residential_basementpctfinished','residential_houseconstruction','residential_phoneavailableyn','residential_garbagedisposalyn','residential_familyroompresent','residential_laundryroompresent','residential_kitchenpresent','residential_livingroompresent','residential_customone','residential_customtwo','residential_customthree','residential_addcustom','residential_storage')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_residential', 'aa')) . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('aa.propid') . ')');

				// [Interpretation 1583] Get from #__realestatenow_land as bb
				$query->select($db->quoteName(
			array('bb.landtype','bb.stock','bb.fixtures','bb.fittings','bb.rainfall','bb.soiltype','bb.grazing','bb.cropping','bb.irrigation'),
			array('land_landtype','land_stock','land_fixtures','land_fittings','land_rainfall','land_soiltype','land_grazing','land_cropping','land_irrigation')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_land', 'bb')) . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('bb.propid') . ')');

				// [Interpretation 1583] Get from #__realestatenow_commercial as cc
				$query->select($db->quoteName(
			array('cc.bldg_name','cc.takings','cc.returns','cc.netprofit','cc.bustype','cc.bussubtype','cc.percentoffice','cc.percentwarehouse','cc.loadingfac','cc.currentuse','cc.carryingcap'),
			array('commercial_bldg_name','commercial_takings','commercial_returns','commercial_netprofit','commercial_bustype','commercial_bussubtype','commercial_percentoffice','commercial_percentwarehouse','commercial_loadingfac','commercial_currentuse','commercial_carryingcap')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_commercial', 'cc')) . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('cc.propid') . ')');

				// [Interpretation 1583] Get from #__realestatenow_multifamily as dd
				$query->select($db->quoteName(
			array('dd.bldgsqft','dd.totalrents','dd.numunits','dd.tenancytype','dd.tenantpdutilities','dd.commonareas','dd.unitdetails','dd.unitfeatures'),
			array('multifamily_bldgsqft','multifamily_totalrents','multifamily_numunits','multifamily_tenancytype','multifamily_tenantpdutilities','multifamily_commonareas','multifamily_unitdetails','multifamily_unitfeatures')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_multifamily', 'dd')) . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('dd.propid') . ')');

				// [Interpretation 1583] Get from #__realestatenow_area as ee
				$query->select($db->quoteName(
			array('ee.ctown','ee.ctport','ee.schooldist','ee.elementary','ee.midschool','ee.highschool','ee.university'),
			array('area_ctown','area_ctport','area_schooldist','area_elementary','area_midschool','area_highschool','area_university')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_area', 'ee')) . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('ee.propid') . ')');

				// [Interpretation 1583] Get from #__realestatenow_feature as ff
				$query->select($db->quoteName(
			array('ff.exteriorfinish','ff.porchpatio','ff.frontage','ff.garagetype','ff.parkingdesc','ff.parkingspaceyn','ff.parkingspaces','ff.basementandfoundation','ff.roof','ff.heating','ff.cooling','ff.fencing','ff.waterresources','ff.sewer','ff.zoning','ff.appliances','ff.indoorfeatures','ff.outdoorfeatures','ff.communityfeatures','ff.otherfeatures','ff.buildingfeatures'),
			array('feature_exteriorfinish','feature_porchpatio','feature_frontage','feature_garagetype','feature_parkingdesc','feature_parkingspaceyn','feature_parkingspaces','feature_basementandfoundation','feature_roof','feature_heating','feature_cooling','feature_fencing','feature_waterresources','feature_sewer','feature_zoning','feature_appliances','feature_indoorfeatures','feature_outdoorfeatures','feature_communityfeatures','feature_otherfeatures','feature_buildingfeatures')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_feature', 'ff')) . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('ff.propid') . ')');

				// [Interpretation 1583] Get from #__realestatenow_financial as gg
				$query->select($db->quoteName(
			array('gg.hofees','gg.annualinsurance','gg.taxannual','gg.taxyear','gg.utilities','gg.electricservice','gg.averageutilelec','gg.averageutilgas','gg.terms','gg.pm_price_override','gg.pmstartdate','gg.pmenddate','gg.propmgt_price','gg.propmgt_description','gg.viewbooking','gg.availdate','gg.private'),
			array('financial_hofees','financial_annualinsurance','financial_taxannual','financial_taxyear','financial_utilities','financial_electricservice','financial_averageutilelec','financial_averageutilgas','financial_terms','financial_pm_price_override','financial_pmstartdate','financial_pmenddate','financial_propmgt_price','financial_propmgt_description','financial_viewbooking','financial_availdate','financial_private')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_financial', 'gg')) . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('gg.propid') . ')');

				// [Interpretation 1583] Get from #__realestatenow_rental as hh
				$query->select($db->quoteName(
			array('hh.rent_type','hh.offpeak','hh.freq','hh.deposit','hh.sleeps'),
			array('rental_rent_type','rental_offpeak','rental_freq','rental_deposit','rental_sleeps')));
				$query->join('LEFT', ($db->quoteName('#__realestatenow_rental', 'hh')) . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('hh.propid') . ')');

				// [Interpretation 1583] Get from #__categories as b
				$query->select($db->quoteName(
			array('b.title'),
			array('title')));
				$query->join('LEFT', ($db->quoteName('#__categories', 'b')) . ' ON (' . $db->quoteName('a.catid') . ' = ' . $db->quoteName('b.id') . ')');
				// [Interpretation 1985] Check if JRequest::getInt('id') is a string or numeric value.
/***[REPLACED$$$$]***//*522*/
     

                     if(!JFactory::getUser()->guest){
                         $query->select($db->quoteName(
                             array('favorite_listing.propertyid'),
                             array('favorited')));
                         $query->join('LEFT', ($db->quoteName('#__realestatenow_favorite_listing', 'favorite_listing')) . ' ON ( (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('favorite_listing.propertyid') . ') ) AND ('. $db->quoteName('favorite_listing.uid')  . ' = ' . JFactory::getUser()->id  .')');
     
                     }
                     
 				$checkValue = $pk;

/***[/REPLACED$$$$]***/
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
				$query->where('a.access IN (' . implode(',', $this->levels) . ')');

				// [Interpretation 2286] Reset the query using our newly populated query object.
				$db->setQuery($query);
				// [Interpretation 2288] Load the results as a stdClass object.
				$data = $db->loadObject();

				if (empty($data))
				{
					$app = JFactory::getApplication();
					// [Interpretation 2305] If no data is found redirect to default page and show warning.
					$app->enqueueMessage(JText::_('COM_REALESTATENOW_NOT_FOUND_OR_ACCESS_DENIED'), 'warning');
					$app->redirect(JRoute::_('index.php?option=com_realestatenow&view=properties'));
					return false;
				}
			// [Interpretation 1822] Load the JEvent Dispatcher
			JPluginHelper::importPlugin('content');
			$this->_dispatcher = JEventDispatcher::getInstance();
/***[INSERTED$$$$]***//*524*/
 				

 				// Custom insert to pull feature type names for cross reference
 				$feature_types = $this->_db->setQuery(
                     $this->_db

                         ->getQuery (true)
                         ->select('*')
                         ->from('#__realestatenow_feature_type'))
                         ->loadObjectList ('id');
 				
 



/***[/INSERTED$$$$]***/
				// [Interpretation 1797] Check if we can decode openhouseinfo
				if (RealestatenowHelper::checkJson($data->openhouseinfo))
				{
					// [Interpretation 1797] Decode openhouseinfo
					$data->openhouseinfo = json_decode($data->openhouseinfo, true);
				}
				// [Interpretation 1797] Check if we can decode style
				if (RealestatenowHelper::checkJson($data->style))
				{
					// [Interpretation 1797] Decode style
/***[REPLACED$$$$]***//*523*/
   			$this->setFeatureFromJson($data,'style',$feature_types);
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1826] Make sure the content prepare plugins fire on propdesc
				$_propdesc = new stdClass();
				$_propdesc->text =& $data->propdesc; // [Interpretation 1828] value must be in text
				// [Interpretation 1829] Since all values are now in text (Joomla Limitation), we also add the field name (propdesc) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.property.propdesc', &$_propdesc, &$this->params, 0));
				// [Interpretation 1857] Checking if propdesc has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($data->propdesc,$this->uikitComp);
				// [Interpretation 1826] Make sure the content prepare plugins fire on mls_mls_disclaimer
				$_mls_mls_disclaimer = new stdClass();
				$_mls_mls_disclaimer->text =& $data->mls_mls_disclaimer; // [Interpretation 1828] value must be in text
				// [Interpretation 1829] Since all values are now in text (Joomla Limitation), we also add the field name (mls_mls_disclaimer) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.property.mls_mls_disclaimer', &$_mls_mls_disclaimer, &$this->params, 0));
				// [Interpretation 1857] Checking if mls_mls_disclaimer has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($data->mls_mls_disclaimer,$this->uikitComp);
				// [Interpretation 1797] Check if we can decode residential_addcustom
				if (RealestatenowHelper::checkJson($data->residential_addcustom))
				{
					// [Interpretation 1797] Decode residential_addcustom
					$data->residential_addcustom = json_decode($data->residential_addcustom, true);
				}
				// [Interpretation 1797] Check if we can decode multifamily_unitfeatures
				if (RealestatenowHelper::checkJson($data->multifamily_unitfeatures))
				{
					// [Interpretation 1797] Decode multifamily_unitfeatures
					$data->multifamily_unitfeatures = json_decode($data->multifamily_unitfeatures, true);
				}
				// [Interpretation 1797] Check if we can decode multifamily_commonareas
				if (RealestatenowHelper::checkJson($data->multifamily_commonareas))
				{
					// [Interpretation 1797] Decode multifamily_commonareas
					$data->multifamily_commonareas = json_decode($data->multifamily_commonareas, true);
				}
				// [Interpretation 1797] Check if we can decode multifamily_unitdetails
				if (RealestatenowHelper::checkJson($data->multifamily_unitdetails))
				{
					// [Interpretation 1797] Decode multifamily_unitdetails
					$data->multifamily_unitdetails = json_decode($data->multifamily_unitdetails, true);
				}
				// [Interpretation 1797] Check if we can decode feature_sewer
				if (RealestatenowHelper::checkJson($data->feature_sewer))
				{
					// [Interpretation 1797] Decode feature_sewer
/***[REPLACED$$$$]***//*589*/
   					$this->setFeatureFromJson($data,'feature_sewer',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_zoning
				if (RealestatenowHelper::checkJson($data->feature_zoning))
				{
					// [Interpretation 1797] Decode feature_zoning
/***[REPLACED$$$$]***//*590*/
      					$this->setFeatureFromJson($data,'feature_zoning',$feature_types);  
  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_porchpatio
				if (RealestatenowHelper::checkJson($data->feature_porchpatio))
				{
					// [Interpretation 1797] Decode feature_porchpatio
/***[REPLACED$$$$]***//*591*/
     					$this->setFeatureFromJson($data,'feature_porchpatio',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_waterresources
				if (RealestatenowHelper::checkJson($data->feature_waterresources))
				{
					// [Interpretation 1797] Decode feature_waterresources
/***[REPLACED$$$$]***//*592*/
     					$this->setFeatureFromJson($data,'feature_waterresources',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_outdoorfeatures
				if (RealestatenowHelper::checkJson($data->feature_outdoorfeatures))
				{
					// [Interpretation 1797] Decode feature_outdoorfeatures
					$data->feature_outdoorfeatures = json_decode($data->feature_outdoorfeatures, true);
				}
				// [Interpretation 1797] Check if we can decode feature_otherfeatures
				if (RealestatenowHelper::checkJson($data->feature_otherfeatures))
				{
					// [Interpretation 1797] Decode feature_otherfeatures
					$data->feature_otherfeatures = json_decode($data->feature_otherfeatures, true);
				}
				// [Interpretation 1797] Check if we can decode feature_basementandfoundation
				if (RealestatenowHelper::checkJson($data->feature_basementandfoundation))
				{
					// [Interpretation 1797] Decode feature_basementandfoundation
/***[REPLACED$$$$]***//*593*/
   					$this->setFeatureFromJson($data,'feature_basementandfoundation',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_roof
				if (RealestatenowHelper::checkJson($data->feature_roof))
				{
					// [Interpretation 1797] Decode feature_roof
/***[REPLACED$$$$]***//*594*/
     					$this->setFeatureFromJson($data,'feature_roof',$feature_types);  
  
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_garagetype
				if (RealestatenowHelper::checkJson($data->feature_garagetype))
				{
					// [Interpretation 1797] Decode feature_garagetype
/***[REPLACED$$$$]***//*595*/
      					$this->setFeatureFromJson($data,'feature_garagetype',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_frontage
				if (RealestatenowHelper::checkJson($data->feature_frontage))
				{
					// [Interpretation 1797] Decode feature_frontage
/***[REPLACED$$$$]***//*596*/
      					$this->setFeatureFromJson($data,'feature_frontage',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_appliances
				if (RealestatenowHelper::checkJson($data->feature_appliances))
				{
					// [Interpretation 1797] Decode feature_appliances
					$data->feature_appliances = json_decode($data->feature_appliances, true);
				}
				// [Interpretation 1797] Check if we can decode feature_heating
				if (RealestatenowHelper::checkJson($data->feature_heating))
				{
					// [Interpretation 1797] Decode feature_heating
/***[REPLACED$$$$]***//*597*/
   					$this->setFeatureFromJson($data,'feature_heating',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_indoorfeatures
				if (RealestatenowHelper::checkJson($data->feature_indoorfeatures))
				{
					// [Interpretation 1797] Decode feature_indoorfeatures
					$data->feature_indoorfeatures = json_decode($data->feature_indoorfeatures, true);
				}
				// [Interpretation 1797] Check if we can decode feature_cooling
				if (RealestatenowHelper::checkJson($data->feature_cooling))
				{
					// [Interpretation 1797] Decode feature_cooling
/***[REPLACED$$$$]***//*598*/
   					$this->setFeatureFromJson($data,'feature_cooling',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_communityfeatures
				if (RealestatenowHelper::checkJson($data->feature_communityfeatures))
				{
					// [Interpretation 1797] Decode feature_communityfeatures
					$data->feature_communityfeatures = json_decode($data->feature_communityfeatures, true);
				}
				// [Interpretation 1797] Check if we can decode feature_fencing
				if (RealestatenowHelper::checkJson($data->feature_fencing))
				{
					// [Interpretation 1797] Decode feature_fencing
/***[REPLACED$$$$]***//*599*/
   					$this->setFeatureFromJson($data,'feature_fencing',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode feature_buildingfeatures
				if (RealestatenowHelper::checkJson($data->feature_buildingfeatures))
				{
					// [Interpretation 1797] Decode feature_buildingfeatures
					$data->feature_buildingfeatures = json_decode($data->feature_buildingfeatures, true);
				}
				// [Interpretation 1797] Check if we can decode feature_exteriorfinish
				if (RealestatenowHelper::checkJson($data->feature_exteriorfinish))
				{
					// [Interpretation 1797] Decode feature_exteriorfinish
/***[REPLACED$$$$]***//*600*/
   					$this->setFeatureFromJson($data,'feature_exteriorfinish',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1797] Check if we can decode financial_terms
				if (RealestatenowHelper::checkJson($data->financial_terms))
				{
					// [Interpretation 1797] Decode financial_terms
/***[REPLACED$$$$]***//*601*/
    					$this->setFeatureFromJson($data,'financial_terms',$feature_types);  
 
/***[/REPLACED$$$$]***/
				}
				// [Interpretation 1826] Make sure the content prepare plugins fire on financial_private
				$_financial_private = new stdClass();
				$_financial_private->text =& $data->financial_private; // [Interpretation 1828] value must be in text
				// [Interpretation 1829] Since all values are now in text (Joomla Limitation), we also add the field name (financial_private) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.property.financial_private', &$_financial_private, &$this->params, 0));
				// [Interpretation 1857] Checking if financial_private has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($data->financial_private,$this->uikitComp);

				// [Interpretation 2413] set data object to item.
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
/***[INSERTED$$$$]***//*538*/
// Custom script to properly decode JSON for property features.

function setFeatureFromJson(&$data,$feature_name,$feature_types){
	$temp_features = $data->$feature_name;
	unset($data->$feature_name);

	//initialize the variable as an array
	$data->$feature_name = [];

	//interate through the features and assign featurename to the variable.
	if(($features = json_decode ($temp_features, TRUE)) && is_array($features)) {
		foreach ($features as $value){
			if (array_key_exists ($value, $feature_types)) {
			$data->$feature_name[] = $feature_types[$value]->featurename;
			}
		}	
	}
}

/***[/INSERTED$$$$]***/


	/**
	 * Custom Method
	 *
	 * @return mixed  An array of objects on success, false on failure.
	 *
	 */
	public function similarProperties()
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

		// [Interpretation 2473] Get the global params
		$globalParams = JComponentHelper::getParams('com_realestatenow', true);
		// [Interpretation 2965] Get a db connection.
		$db = JFactory::getDbo();

		// [Interpretation 2974] Create a new query object.
		$query = $db->getQuery(true);

		// [Interpretation 1583] Get from #__realestatenow_property as a
		$query->select($db->quoteName(
			array('a.id','a.asset_id','a.featured','a.viewad','a.street','a.streettwo','a.countryid','a.cityid','a.stateid','a.postcode','a.county','a.soleagency','a.listoffice','a.agent','a.colistagent','a.showprice','a.closeprice','a.closedate','a.priceview','a.mlslookup','a.mls_id','a.trans_type','a.mkt_stats','a.name','a.alias','a.catid','a.price','a.propdesc','a.bedrooms','a.bathrooms','a.fullbaths','a.thqtrbaths','a.halfbaths','a.qtrbaths','a.squarefeet','a.sqftlower','a.sqftmainlevel','a.sqftupper','a.style','a.openhouse','a.openhouseinfo','a.mediaurl','a.mediatype','a.pdfinfoone','a.pdfinfotwo','a.flplone','a.flpltwo','a.covenantsyn','a.owncoords','a.latitude','a.longitude','a.rets_source','a.fbposted','a.settings_id','a.ghost','a.published','a.created_by','a.modified_by','a.created','a.modified','a.version','a.hits','a.ordering'),
			array('id','asset_id','featured','viewad','street','streettwo','countryid','cityid','stateid','postcode','county','soleagency','listoffice','agent','colistagent','showprice','closeprice','closedate','priceview','mlslookup','mls_id','trans_type','mkt_stats','name','alias','catid','price','propdesc','bedrooms','bathrooms','fullbaths','thqtrbaths','halfbaths','qtrbaths','squarefeet','sqftlower','sqftmainlevel','sqftupper','style','openhouse','openhouseinfo','mediaurl','mediatype','pdfinfoone','pdfinfotwo','flplone','flpltwo','covenantsyn','owncoords','latitude','longitude','rets_source','fbposted','settings_id','ghost','published','created_by','modified_by','created','modified','version','hits','ordering')));
		$query->from($db->quoteName('#__realestatenow_property', 'a'));

		// [Interpretation 1583] Get from #__realestatenow_state as b
		$query->select($db->quoteName(
			array('b.name'),
			array('state_name')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_state', 'b')) . ' ON (' . $db->quoteName('a.stateid') . ' = ' . $db->quoteName('b.id') . ')');

		// [Interpretation 1583] Get from #__realestatenow_city as c
		$query->select($db->quoteName(
			array('c.name'),
			array('city_name')));
		$query->join('LEFT', ($db->quoteName('#__realestatenow_city', 'c')) . ' ON (' . $db->quoteName('a.cityid') . ' = ' . $db->quoteName('c.id') . ')');
		// [Interpretation 2131] Get where a.id is $id
		$query->where('a.id != ' . $db->quote($id));
		// [Interpretation 2131] Get where a.cityid is $cityid
		$query->where('a.cityid = ' . $db->quote($cityid));
		// [Interpretation 2131] Get where a.bedrooms is $bedrooms
		$query->where('a.bedrooms = ' . $db->quote($bedrooms));
		// [Interpretation 2131] Get where a.published is 1
		$query->where('a.published = 1');
		$query->order('a.id ASC');

		// [Interpretation 2488] Reset the query using our newly populated query object.
		$db->setQuery($query);
		$items = $db->loadObjectList();

		if (empty($items))
		{
			return false;
		}

		// [Interpretation 3015] Insure all item fields are adapted where needed.
		if (RealestatenowHelper::checkArray($items))
		{
			// [Interpretation 1822] Load the JEvent Dispatcher
			JPluginHelper::importPlugin('content');
			$this->_dispatcher = JEventDispatcher::getInstance();
			foreach ($items as $nr => &$item)
			{
				// [Interpretation 3021] Always create a slug for sef URL's
				$item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
				// [Interpretation 1797] Check if we can decode openhouseinfo
				if (RealestatenowHelper::checkJson($item->openhouseinfo))
				{
					// [Interpretation 1797] Decode openhouseinfo
					$item->openhouseinfo = json_decode($item->openhouseinfo, true);
				}
				// [Interpretation 1797] Check if we can decode style
				if (RealestatenowHelper::checkJson($item->style))
				{
					// [Interpretation 1797] Decode style
					$item->style = json_decode($item->style, true);
				}
				// [Interpretation 1826] Make sure the content prepare plugins fire on propdesc
				$_propdesc = new stdClass();
				$_propdesc->text =& $item->propdesc; // [Interpretation 1828] value must be in text
				// [Interpretation 1829] Since all values are now in text (Joomla Limitation), we also add the field name (propdesc) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.property.propdesc', &$_propdesc, &$this->params, 0));
				// [Interpretation 1857] Checking if propdesc has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->propdesc,$this->uikitComp);
				// [Interpretation 2173] set the global propid value.
				$this->a_propid = $item->id;
			}
		}
		// [Interpretation 2502] return items
		return $items;
	}


	/**
	 * Custom Method
	 *
	 * @return mixed  An array of objects on success, false on failure.
	 *
	 */
	public function getAllImages()
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

		// [Interpretation 2473] Get the global params
		$globalParams = JComponentHelper::getParams('com_realestatenow', true);
		// [Interpretation 2965] Get a db connection.
		$db = JFactory::getDbo();

		// [Interpretation 2974] Create a new query object.
		$query = $db->getQuery(true);

		// [Interpretation 1583] Get from #__realestatenow_image as a
		$query->select($db->quoteName(
			array('a.id','a.asset_id','a.propid','a.path','a.filename','a.type','a.remote','a.title','a.description','a.rets_source','a.published','a.created_by','a.modified_by','a.created','a.modified','a.version','a.hits','a.ordering'),
			array('id','asset_id','propid','path','filename','type','remote','title','description','rets_source','published','created_by','modified_by','created','modified','version','hits','ordering')));
		$query->from($db->quoteName('#__realestatenow_image', 'a'));
		// [Interpretation 1985] Check if JRequest::getInt('id') is a string or numeric value.
		$checkValue = JRequest::getInt('id');
		if (isset($checkValue) && RealestatenowHelper::checkString($checkValue))
		{
			$query->where('a.propid = ' . $db->quote($checkValue));
		}
		elseif (is_numeric($checkValue))
		{
			$query->where('a.propid = ' . $checkValue);
		}
		else
		{
			return false;
		}
		// [Interpretation 2131] Get where a.published is 1
		$query->where('a.published = 1');

		// [Interpretation 2488] Reset the query using our newly populated query object.
		$db->setQuery($query);
		$items = $db->loadObjectList();

		if (empty($items))
		{
			return false;
		}

		// [Interpretation 3015] Insure all item fields are adapted where needed.
		if (RealestatenowHelper::checkArray($items))
		{
			// [Interpretation 1822] Load the JEvent Dispatcher
			JPluginHelper::importPlugin('content');
			$this->_dispatcher = JEventDispatcher::getInstance();
			foreach ($items as $nr => &$item)
			{
				// [Interpretation 3021] Always create a slug for sef URL's
				$item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
				// [Interpretation 1826] Make sure the content prepare plugins fire on description
				$_description = new stdClass();
				$_description->text =& $item->description; // [Interpretation 1828] value must be in text
				// [Interpretation 1829] Since all values are now in text (Joomla Limitation), we also add the field name (description) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.property.description', &$_description, &$this->params, 0));
				// [Interpretation 1857] Checking if description has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->description,$this->uikitComp);
			}
		}
		// [Interpretation 2502] return items
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
