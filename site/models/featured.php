<?php
    /*----------------------------------------------------------------------------------|  www.vdm.io  |----/
                    Most Wanted Web Services, Inc.
    /-------------------------------------------------------------------------------------------------------/
    
        @version		3.1.15
        @build			8th September, 2018
        @created		1st May, 2016
        @package		Real Estate NOW!
        @subpackage		featured.php
        @author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>
        @copyright		Copyright (C) 2015-2018. All Rights Reserved
        @license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
        
        Real Estate NOW! Component
        
    /------------------------------------------------------------------------------------------------------*/

// No direct access to this file
    defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
    jimport('joomla.application.component.modellist');
    
    use Joomla\CMS\MVC\Model\ListModel;
    use Joomla\CMS\Table\Category;
    
    /**
     * Realestatenow Model for Featured
     */
    class RealestatenowModelFeatured extends ListModel
    {
        
        protected $user;
        protected $userId;
        protected $guest;
        protected $groups;
        protected $levels;
        protected $app;
        protected $input;
        protected $uikitComp;
    
        /**
         * Constructor.
         *
         * @param   array  $config  An optional associative array of configuration settings.
         *
         * @see     JController
         * @since   1.6
         */
        public function __construct($config = array())
        {
            if (empty($config['filter_fields']))
            {
                $config['filter_fields'] = array(
                    'keywords',
                    'categoryids',
                    'transactiontype',
                    'marketstatus',
                    'featured',
                    'agent',
                    'city',
                    'openhouses',
                    'minbeds',
                    'minbath',
                    'min_areas',
                    'max_areas',
                    'minpricerange',
                    'maxpricerange',
                    'minlandrange',
                    'maxlandrange'
                );
            }
        
            parent::__construct($config);
        }
    
        /**
         * Method to auto-populate the model state.
         *
         * This method should only be called once per instantiation and is designed
         * to be called on the first call to the getState() method unless the model
         * configuration flag to ignore the request is set.
         *
         * Note. Calling getState in this method will result in recursion.
         *
         * @param   string  $ordering   An optional ordering field.
         * @param   string  $direction  An optional direction (asc|desc).
         *
         * @return  void
         *
         * @since   12.2
         */
        protected function populateState($ordering = null, $direction = null)
        {
            $app = JFactory::getApplication();
        
        
            // get combined params of both component and menu
            $this->params = $app->getParams();
            $this->menu = $app->getMenu()->getActive();
    
            /**
             * Set componentparams
             */
            $componentparams = $app->getUserStateFromRequest(
                $this->context . '.componentparams',
                'componentparams',
                [//default array
                    'latitude'=>'',
                    'longitude'=>'',
                    'zoom'=>'8'
                ],
                'array');
            
            $this->setState('componentparams', $componentparams);
        
            /**
             * Set List variables.
             
            $list = $app->getUserStateFromRequest(
                $this->context . '.list',
                'list',
                [
                    'limit'=>$this->params->get('listlimit'),
                    'page'=>1,
                    'sort'=>$this->params->get('listsort')
                ],
                'array'
            );*/
        
            /**
             * Set List variables. w/   default failsafe.
             */
            $list = $app->getUserStateFromRequest(
                $this->context . '.list',
                'list',
                [
                    'limit'=>20,
                    'page'=>1,
                    'sort'=>'price_asc'
                ], 'array');
        
            // Set default failsafe.
            $list_sort = !empty($list['sort']) ? $list['sort'] : 'price_asc';
        
            // Set Ordering column and direction
            $OrderingColumnDirection = $this->getOrderingColumnDirection($list_sort);
        
            $list['direction'] = $OrderingColumnDirection['order_direction'];
            $list['ordering'] = $OrderingColumnDirection['order_column'];
        
            $this->setState('list', $list);
        
            $filter = $app->getUserStateFromRequest ($this->context . '.filter', 'filter', array_fill_keys ($this->filter_fields, ''), 'array');
        
            //check the request to see if the category id is set
            if($categoryids = $app->input->get('categoryids',false,'INT'))
                $filter['categoryids'] = $categoryids;
        
            //set to show only featured items.
            $filter['featured'] = 1;
        
            $this->setState('filter', $filter);
    
            $this->setState( 'active_menu_item_id',
                $app->getUserStateFromRequest( $this->context . '.active_menu_item_id',
                    'active_menu_item_id', isset($app->getMenu()->getActive()->id) ? $app->getMenu()->getActive()->id : null ));
             
        }
        
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
            
            //Get a db connection.
            $db = JFactory::getDbo();
            
            //Create a new query object.
            $query = $db->getQuery(true);
            
            //Get from #__realestatenow_property as a
            $query->select($db->quoteName(
                array('a.id','a.asset_id','a.street','a.streettwo','a.countryid','a.cityid','a.stateid','a.postcode','a.county','a.viewad','a.soleagency','a.listoffice','a.agent','a.colistagent','a.showprice','a.featured','a.sold','a.closeprice','a.closedate','a.priceview','a.mlslookup','a.mls_id','a.trans_type','a.mkt_stats','a.name','a.alias','a.catid','a.price','a.propdesc','a.landareasqft','a.acrestotal','a.lotdimensions','a.bedrooms','a.bathrooms','a.fullbaths','a.thqtrbaths','a.halfbaths','a.qtrbaths','a.squarefeet','a.sqftlower','a.sqftmainlevel','a.sqftupper','a.style','a.openhouseinfo','a.openhouse','a.mediaurl','a.mediatype','a.pdfinfoone','a.pdfinfotwo','a.flplone','a.flpltwo','a.covenantsyn','a.owncoords','a.latitude','a.longitude','a.rets_source','a.fbposted','a.settings_id','a.ghost','a.published','a.created_by','a.modified_by','a.created','a.modified','a.version','a.hits','a.ordering'),
                array('id','asset_id','street','streettwo','countryid','cityid','stateid','postcode','county','viewad','soleagency','listoffice','agent','colistagent','showprice','featured','sold','closeprice','closedate','priceview','mlslookup','mls_id','trans_type','mkt_stats','name','alias','catid','price','propdesc','landareasqft','acrestotal','lotdimensions','bedrooms','bathrooms','fullbaths','thqtrbaths','halfbaths','qtrbaths','squarefeet','sqftlower','sqftmainlevel','sqftupper','style','openhouseinfo','openhouse','mediaurl','mediatype','pdfinfoone','pdfinfotwo','flplone','flpltwo','covenantsyn','owncoords','latitude','longitude','rets_source','fbposted','settings_id','ghost','published','created_by','modified_by','created','modified','version','hits','ordering')));
            $query->from($db->quoteName('#__realestatenow_property', 'a'));
            
            
            //Get from #__categories as b
            $query->select($db->quoteName(
                array('b.title'),
                array('category')));
            $query->join('LEFT', ($db->quoteName('#__categories', 'b')) . ' ON (' . $db->quoteName('a.catid') . ' = ' . $db->quoteName('b.id') . ')');
            
            
            //Get from #__realestatenow_city as c
            $query->select($db->quoteName(
                array('c.name'),
                array('city_name')));
            $query->join('LEFT', ($db->quoteName('#__realestatenow_city', 'c')) . ' ON (' . $db->quoteName('a.cityid') . ' = ' . $db->quoteName('c.id') . ')');
            
            
            //Get from #__realestatenow_state as d
            $query->select($db->quoteName(
                array('d.name'),
                array('state_name')));
            $query->join('LEFT', ($db->quoteName('#__realestatenow_state', 'd')) . ' ON (' . $db->quoteName('a.stateid') . ' = ' . $db->quoteName('d.id') . ')');
            
            
            //Get from #__realestatenow_country as e
            $query->select($db->quoteName(
                array('e.name'),
                array('country_name')));
            $query->join('LEFT', ($db->quoteName('#__realestatenow_country', 'e')) . ' ON (' . $db->quoteName('a.countryid') . ' = ' . $db->quoteName('e.id') . ')');
            
            
            //Get from #__realestatenow_agency as f
            $query->select($db->quoteName(
                array('f.name','f.image'),
                array('agency_name','agency_image')));
            $query->join('LEFT', ($db->quoteName('#__realestatenow_agency', 'f')) . ' ON (' . $db->quoteName('a.listoffice') . ' = ' . $db->quoteName('f.id') . ')');
            
            
            //Get from #__realestatenow_agent as g
            $query->select($db->quoteName(
                array('g.id','g.asset_id','g.street','g.streettwo','g.countryid','g.cityid','g.stateid','g.postcode','g.uid','g.email','g.phone','g.mobile','g.fax','g.image','g.bio','g.name','g.alias','g.catid','g.agencyid','g.featured','g.default_agent_yn','g.viewad','g.rets_source','g.owncoords','g.latitude','g.longitude','g.fbook','g.twitter','g.pinterest','g.linkedin','g.youtube','g.gplus','g.skype','g.instagram','g.website','g.blog','g.settings_id','g.published','g.created_by','g.modified_by','g.created','g.modified','g.version','g.hits','g.ordering'),
                array('agent_id','agent_asset_id','agent_street','agent_streettwo','agent_countryid','agent_cityid','agent_stateid','agent_postcode','agent_uid','agent_email','agent_phone','agent_mobile','agent_fax','agent_image','agent_bio','agent_name','agent_alias','agent_catid','agent_agencyid','agent_featured','agent_default_agent_yn','agent_viewad','agent_rets_source','agent_owncoords','agent_latitude','agent_longitude','agent_fbook','agent_twitter','agent_pinterest','agent_linkedin','agent_youtube','agent_gplus','agent_skype','agent_instagram','agent_website','agent_blog','agent_settings_id','agent_published','agent_created_by','agent_modified_by','agent_created','agent_modified','agent_version','agent_hits','agent_ordering')));
            $query->join('LEFT', ($db->quoteName('#__realestatenow_agent', 'g')) . ' ON (' . $db->quoteName('a.agent') . ' = ' . $db->quoteName('g.id') . ')');
            
            
            //Get from #__realestatenow_market_status as h
            $query->select($db->quoteName(
                array('h.name'),
                array('market_status_name')));
            $query->join('LEFT', ($db->quoteName('#__realestatenow_market_status', 'h')) . ' ON (' . $db->quoteName('a.mkt_stats') . ' = ' . $db->quoteName('h.id') . ')');
            
            
            //Get from #__realestatenow_transaction_type as i
            $query->select($db->quoteName(
                array('i.name'),
                array('transaction_type_name')));
            $query->join('LEFT', ($db->quoteName('#__realestatenow_transaction_type', 'i')) . ' ON (' . $db->quoteName('a.trans_type') . ' = ' . $db->quoteName('i.id') . ')');
            
            
            //Get from #__realestatenow_financial as j
            $query->select($db->quoteName(
                array('j.pm_price_override','j.pmstartdate','j.pmenddate','j.propmgt_price','j.propmgt_description'),
                array('financial_pm_price_override','financial_pmstartdate','financial_pmenddate','financial_propmgt_price','financial_propmgt_description')));
            $query->join('LEFT', ($db->quoteName('#__realestatenow_financial', 'j')) . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('j.propid') . ')');
            
            
            // Filtering.
            $filters = $this->getState('filter','');
            
            if( ( $keywords = $this->getState('filter','')['keywords'] ) && !empty( $keywords ) )
                $query->where("a.name like '%".$keywords."%' or a.propdesc like '%".$keywords."%'");
            
            
            if( !empty( $filters['featured'] ) )
                $query->where('a.featured = '.$filters['featured']);
            
            
            if( ( $minpricerange = $this->getState('filter','')['minpricerange'] ) && !empty( $minpricerange ) )
                $query
                    ->where("a.price != ''")
                    ->where("a.price >= '$minpricerange'");
            
            if( ( $maxpricerange = $this->getState('filter','')['maxpricerange'] ) && !empty( $maxpricerange ) )
                $query
                    ->where("a.price != ''")
                    ->where("a.price <= '$maxpricerange'");
            
            if( ( $minlandrange = $this->getState('filter','')['minlandrange'] ) && !empty( $minlandrange ) )
                $query
                    ->where ( 'a.landareasqft != ""')
                    ->where("a.landareasqft >= '$minlandrange'");
            
            if( ( $maxlandrange = $this->getState('filter','')['maxlandrange'] ) && !empty( $maxlandrange ) )
                $query
                    ->where ( 'a.landareasqft != ""')
                    ->where("a.landareasqft <= '$maxlandrange'");
            
            if( ( $category = $this->getState('filter','')['categoryids'] ) && !empty( $category )  ){
                
                /**
                 * get subcategory items, can add parameter
                 */
                $categoryTable = JTable::getInstance('Category','Joomla\\CMS\\Table\\' );
    
                $category_leaf_object_list = $categoryTable->getTree($category);
    
                if( count( $category_leaf_object_list ) > 0 ){
                    $category_leaf_id_array = array_map(function($object){
                        return $object->id;
                    },$category_leaf_object_list);
                    
                    $category_leaf_id_string = implode(",",$category_leaf_id_array);
                    
                    //$query->orWhere ('a.catid in (' . $category_leaf_id_string . ') ');
                $query->where(  '( a.catid = '.$category.' OR a.catid in (' . $category_leaf_id_string . ') )');
                
                }else{
                    
                    $query->where(  'a.catid = '.$category );
                    
                }
            }
            
            if( ( $transactiontype = $this->getState('filter','')['transactiontype'] ) && !empty( $transactiontype )  )
                $query->where("a.trans_type = '$transactiontype'");
            
            if( ( $marketstatus = $this->getState('filter','')['marketstatus'] ) && !empty( $marketstatus ) )
                $query->where("a.mkt_stats = '$marketstatus'");
            
            if( ( $agent = $this->getState('filter','')['agent'] )  		&& !empty( $agent ) )
                $query->where("a.agent = '$agent'");
            
            if( ( $city = $this->getState('filter','')['city'] )  		&& !empty( $city ) )
                $query->where("a.cityid = '$city'");
            
            if( ( $openhouses = $this->getState('filter','')['openhouses'] )  && !empty( $openhouses ) )
                $query->where("a.openhouse = '$openhouses'");
            
            if( ( $minbeds = $this->getState('filter','')['minbeds'] )  && !empty( $minbeds ) )
                $query->where("a.bedrooms >= '$minbeds'");
            
            if( ( $minbath = $this->getState('filter','')['minbath'] )  && !empty( $minbath ) )
                $query->where("a.fullbaths >= '$minbath'");
            
            if( ( $min_areas = $this->getState('filter','')['min_areas'] )  && !empty( $min_areas ) )
                $query->where("a.squarefeet >= '$min_areas'" )
                    ->where( "a.squarefeet != ''" );
            
            if( ( $max_areas = $this->getState('filter','')['max_areas'] )  && !empty( $max_areas ) )
                $query->where("a.squarefeet <= '$max_areas'")
                    ->where("a.squarefeet != ''");
            
    
            //Get where a.published is 1
            $query->where('a.published = 1');
    
            $query->where('a.access IN (' . implode(',', $this->levels) . ')');
            
            $query->order($this->getState('list' ,['ordering'=>'a.name'] )['ordering'].' '.
                $this->getState('list', ['direction'=>'ASC'] )['direction']
            );
            
            $limit = $this->getState('list', [ 'limit'=>20 ]  )['limit'];
            $page = $this->getState('list', [ 'page'=>0 ] )['page'];
            $limit_start = $limit * ( $page - 1 );
            
            $query->setLimit($limit,$limit_start);
            
            //return the query object
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
            // [Interpretation 2227] check if this user has permission to access item
            if (!$user->authorise('site.featured.access', 'com_realestatenow'))
            {
                $app = JFactory::getApplication();
                $app->enqueueMessage(JText::_('COM_REALESTATENOW_NOT_AUTHORISED_TO_VIEW_FEATURED'), 'error');
                // [Interpretation 2219] redirect away to the default view if no access allowed.
                $app->redirect(JRoute::_('index.php?option=com_realestatenow&view=properties'));
                return false;
            }
            
            // load parent items
            $items = parent::getItems();
            
            // Get the global params
            $globalParams = JComponentHelper::getParams('com_realestatenow', true);
            
            // [Interpretation 3015] Insure all item fields are adapted where needed.
            if (RealestatenowHelper::checkArray($items)) {
                
                // [Interpretation 1822] Load the JEvent Dispatcher
                JPluginHelper::importPlugin('content');
                $this->_dispatcher = JEventDispatcher::getInstance();
                
                foreach ($items as &$item) {
                    // [Interpretation 3021] Always create a slug for sef URL's
                    $item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
                    // Check if we can decode openhouseinfo
                    if (RealestatenowHelper::checkJson ($item->openhouseinfo)) {
                        // Decode openhouseinfo
                        $item->openhouseinfo = json_decode ($item->openhouseinfo, TRUE);
                    }
                    
                    // [Interpretation 1797] Check if we can decode style
                    if (RealestatenowHelper::checkJson ($item->style)) {
                        // [Interpretation 1797] Decode style
                        $item->style = json_decode($item->style, true);
                    }
                    
                    // Make sure the content prepare plugins fire on propdesc
                    $_propdesc = new stdClass();
                    $_propdesc->text =& $item->propdesc; // [Interpretation 1828] value must be in text
                    
                    // Since all values are now in text (Joomla Limitation), we also add the field name (propdesc) to context
                    $this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.featured.propdesc', &$_propdesc, &$this->params, 0));
    
                    // Checking if propdesc has uikit components that must be loaded.
                    $this->uikitComp = RealestatenowHelper::getUikitComp($item->propdesc,$this->uikitComp);
                    
                    // Make sure the content prepare plugins fire on agent_bio
                    $_agent_bio = new stdClass();
                    $_agent_bio->text =& $item->agent_bio; // [Interpretation 1828] value must be in text
    
                    // [Interpretation 1829] Since all values are now in text (Joomla Limitation), we also add the field name (agent_bio) to context
                    $this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.featured.agent_bio', &$_agent_bio, &$this->params, 0));
    
                    // [Interpretation 1857] Checking if agent_bio has uikit components that must be loaded.
                    $this->uikitComp = RealestatenowHelper::getUikitComp($item->agent_bio,$this->uikitComp);
    
                    // set idPropidImageJ to the $item object.
                    $item->idPropidImageJ = $this->getIdPropidImageFcba_J($item->id);
                    
                    // [Interpretation 1890] set catidIdCategoriesB to the $item object.
                    $item->catidIdCategoriesB = $this->getCatidIdCategoriesFcba_B($item->catid);
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
        public function getIdPropidImageFcba_J($id)
        {
            // [Interpretation 2703] Get a db connection.
            $db = JFactory::getDbo();
            
            // [Interpretation 2705] Create a new query object.
            $query = $db->getQuery(true);
            
            // [Interpretation 2707] Get from #__realestatenow_image as j
            $query->select($db->quoteName(
                array('j.path','j.filename','j.type','j.remote','j.title','j.description','j.ordering'),
                array('path','filename','type','remote','title','description','ordering')
            ));
            
            $query->from($db->quoteName('#__realestatenow_image', 'j'));
            $query->where('j.propid = ' . $db->quote($id));
            $query->order('j.ordering  ASC');

            // [Interpretation 2761] Reset the query using our newly populated query object.
            $db->setQuery($query);
            $db->execute();
            
            // [Interpretation 2764] check if there was data returned
            if ($db->getNumRows())
            {
                // [Interpretation 1822] Load the JEvent Dispatcher
                JPluginHelper::importPlugin('content');
                $this->_dispatcher = JEventDispatcher::getInstance();
                $items = $db->loadObjectList();
                
                // [Interpretation 2830] Convert the parameter fields into objects.
                foreach ($items as $nr => &$item)
                {
                    // [Interpretation 1826] Make sure the content prepare plugins fire on description
                    $_description = new stdClass();
                    $_description->text =& $item->description; // [Interpretation 1828] value must be in text
                    
                    // [Interpretation 1829] Since all values are now in text (Joomla Limitation), we also add the field name (description) to context
                    $this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.featured.description', &$_description, &$this->params, 0));
                    
                    // [Interpretation 1857] Checking if description has uikit components that must be loaded.
                    $this->uikitComp = RealestatenowHelper::getUikitComp($item->description,$this->uikitComp);
                }
                
                return $items;
            }
            
            return false;
        }
        
        /**
         *
         * @getCategoryByCategoryId
         *
         * Method to get an array of Published Category Objects by Catigoryy IDs.
         *
         * todo This just gets catgory by id.
         *
         * @return mixed  An array of Categories Objects on success, false on failure.
         *
         */
        public function getCatidIdCategoriesFcba_B($catid)
        {
            // [Interpretation 2703] Get a db connection.
            $db = JFactory::getDbo();
            
            // [Interpretation 2705] Create a new query object.
            $query = $db->getQuery(true);
            
            // [Interpretation 2707] Get from #__categories as b
            $query->select($db->quoteName(
                array('b.title'),
                array('title')));
            $query->from($db->quoteName('#__categories', 'b'));
            
            $query->where('b.id = ' . $db->quote($catid));
            
            // [Interpretation 2131] Get where b.published is 1
            $query->where('b.published = 1');
            
            $query->order('b.title ASC');
            
            // [Interpretation 2761] Reset the query using our newly populated query object.
            $db->setQuery($query);
            $db->execute();
            
            // [Interpretation 2764] check if there was data returned
            if ($db->getNumRows())
                return $db->loadObjectList();
            
            return false;
        }
        
        /**
         * Custom Method
         *
         * @return mixed  An array of objects on success, false on failure.
         *
         */
        public function getCategoryList()
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
            
            // [Interpretation 1583] Get from #__categories as a
            $query->select($db->quoteName(
                array('a.id','a.title','a.alias','a.description','a.hits','a.language','a.params'),
                array('id','title','alias','description','hits','language','params')
            ));
            
            $query->from($db->quoteName('#__categories', 'a'));
            
            // [Interpretation 2131] Get where a.published is 1
            $query->where('a.published = 1');
            
            // [Interpretation 2131] Get where a.extension is "com_realestatenow.properties"
            $query->where('a.extension = "com_realestatenow.properties"');
            
            // [Interpretation 2131] Get where a.parent_id is 1
            $query->where('a.parent_id = 1');
            
            $query->order('a.title ASC');
            
            // Reset the query using our newly populated query object.
            $db->setQuery($query);
            
            $items = $db->loadObjectList();
            
            if (empty($items)) {
                return false;
            }
            
            // [Interpretation 3015] Insure all item fields are adapted where needed.
            if (RealestatenowHelper::checkArray($items)) {
                foreach ($items as &$item) {
                    // [Interpretation 3021] Always create a slug for sef URL's
                    $item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
                }
            }
            
            // return items
            return $items;
        }
        
        
        /**
         * Custom Method
         *
         * @return mixed  An array of objects on success, false on failure.
         *
         */
        public function getStateList()
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
            
            // [Interpretation 1583] Get from #__realestatenow_state as a
            $query->select($db->quoteName(
                array('a.id','a.asset_id','a.image','a.description','a.name','a.alias','a.countryid','a.owncoords','a.latitude','a.longitude','a.published','a.created_by','a.modified_by','a.created','a.modified','a.version','a.hits','a.ordering'),
                array('id','asset_id','image','description','name','alias','countryid','owncoords','latitude','longitude','published','created_by','modified_by','created','modified','version','hits','ordering')));
            $query->from($db->quoteName('#__realestatenow_state', 'a'));
            $query->where('a.access IN (' . implode(',', $this->levels) . ')');
            // [Interpretation 2131] Get where a.published is 1
            $query->where('a.published = 1');
            
            // [Interpretation 2488] Reset the query using our newly populated query object.
            $db->setQuery($query);
            $items = $db->loadObjectList();
            
            if (empty($items))
                return false;
            
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
                    $this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.featured.description', &$_description, &$this->params, 0));
                    // [Interpretation 1857] Checking if description has uikit components that must be loaded.
                    $this->uikitComp = RealestatenowHelper::getUikitComp($item->description,$this->uikitComp);
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
        public function getTransactiontypesList()
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
            
            // [Interpretation 1583] Get from #__realestatenow_transaction_type as a
            $query->select($db->quoteName(
                array('a.id','a.name'),
                array('id','name')
            ));
            
            $query->from($db->quoteName('#__realestatenow_transaction_type', 'a'));
            // [Interpretation 2131] Get where a.published is 1
            $query->where('a.published = 1');
            $query->order('a.name ASC');
            
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
                foreach ($items as $nr => &$item)
                {
                    // [Interpretation 3021] Always create a slug for sef URL's
                    $item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
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
        public function getMarketstatusList()
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
            
            // [Interpretation 1583] Get from #__realestatenow_market_status as a
            $query->select($db->quoteName(
                array('a.id','a.name'),
                array('id','name')
            ));
            
            $query->from($db->quoteName('#__realestatenow_market_status', 'a'));
            // [Interpretation 2131] Get where a.published is 1
            $query->where('a.published = 1');
            $query->order('a.name ASC');
            
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
                foreach ($items as $nr => &$item)
                {
                    // [Interpretation 3021] Always create a slug for sef URL's
                    $item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
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
        public function getAgentList()
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
            
            // [Interpretation 1583] Get from #__realestatenow_agent as a
            $query->select($db->quoteName(
                array('a.id','a.name'),
                array('id','name')
            ));
            
            $query->from($db->quoteName('#__realestatenow_agent', 'a'));
            // [Interpretation 2131] Get where a.published is 1
            $query->where('a.published = 1');
            $query->order('a.name ASC');
            
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
                foreach ($items as $nr => &$item)
                {
                    // [Interpretation 3021] Always create a slug for sef URL's
                    $item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
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
        public function getCityList()
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
            
            // [Interpretation 1583] Get from #__realestatenow_city as a
            $query->select($db->quoteName(
                array('a.id','a.name'),
                array('id','name')
            ));
            
            $query->from($db->quoteName('#__realestatenow_city', 'a'));
            // [Interpretation 2131] Get where a.published is 1
            $query->where('a.published = 1');
            $query->order('a.name ASC');
            
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
                foreach ($items as $nr => &$item)
                {
                    // [Interpretation 3021] Always create a slug for sef URL's
                    $item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
                }
            }
            // [Interpretation 2502] return items
            return $items;
        }
        
        /**
         * Custom Method
         *
         * @return mixed  item data object on success, false on failure.
         *
         */
        public function getCategory()
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
            // [Interpretation 2273] Get a db connection.
            $db = JFactory::getDbo();
            
            // [Interpretation 2275] Create a new query object.
            $query = $db->getQuery(true);
            
            // [Interpretation 1583] Get from #__categories as a
            $query->select($db->quoteName(
                array('a.id','a.parent_id','a.lft','a.rgt','a.level','a.title','a.alias','a.note','a.description','a.params','a.metadesc','a.metakey','a.metadata','a.hits','a.language','a.version'),
                array('id','parent_id','lft','rgt','level','title','alias','note','description','params','metadesc','metakey','metadata','hits','language','version')));
            $query->from($db->quoteName('#__categories', 'a'));
        
        
            /**
             *
             * todo roll into filters series
             * todo $checkValue is to allow the display of a single property in the searach view.
             * todo This can be connected to the api to allow fetching property templates.
             * todo these templates can be allpropertylistings or just a single property layout
             * todo this would be while showing one property,using this id variable below.
             *
             */
            // [Interpretation 1985] Check if JRequest::getInt('id') is a string or numeric value.
            $checkValue = JRequest::getInt('categoryids');
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
            
            // Get where a.published is 1
            $query->where('a.published = 1');
            
            // if (isset($_GET['categoryDds'])) {
            // 	if ($_GET['categoryDds'] != '') {
            // 		$wherecatname = $_GET['categoryDds'];
            // 		$query->where('a.title = '.$wherecatname);
            // 	}
            // }
            
            $query->order('a.title ASC');
            
            // [Interpretation 2286] Reset the query using our newly populated query object.
            $db->setQuery($query);
            // [Interpretation 2288] Load the results as a stdClass object.
            $data = $db->loadObject();
            
            if (empty($data))
                return false;
        
            //  set idCatidPropertyB to the $data object.
            $data->idCatidPropertyB = $this->getPropertiesByCategoryId($data->id        );
            
            // [Interpretation 2407] return data object.
            return $data;
        }
    
        /**
         *
         * @getPropertiesByCategoryId(){
         *
         * }
         * Method to get an array of getProperty Objects by catid.
         *
         * @return mixed  An array of Property Objects on success@, false on failure.
         *
         */
        public function getPropertiesByCategoryId($id)
        {
            // [Interpretation 2703] Get a db connection.
            $db = JFactory::getDbo();
            
            // [Interpretation 2705] Create a new query object.
            $query = $db->getQuery(true);
            
            // [Interpretation 2707] Get from #__realestatenow_property as b
            $query->select($db->quoteName(
                array('b.id'),
                array('id')));
            $query->from($db->quoteName('#__realestatenow_property', 'b'));
            $query->where('b.catid = ' . $db->quote($id));
            
            // [Interpretation 2761] Reset the query using our newly populated query object.
            $db->setQuery($query);
            $db->execute();
            
            // [Interpretation 2764] check if there was data returned
            if ($db->getNumRows())
            {
                return $db->loadObjectList();
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
  
        public function getTotal()
        {
            return parent::getTotal (); // TODO: Change the autogenerated stub
        }
        
        public function getMaxprice()
        {
            $db = JFactory::getDBO();
            $select = "select max(price) as pricemaximum from ".$db->quoteName('#__realestatenow_property')."";
            $db->setQuery($select);
            $result = $db->loadAssoc();
            return $result['pricemaximum'];
        }
        
        public function getMaxland()
        {
            $db = JFactory::getDBO();
            $select = "select max(landareasqft) as landareasqftmaximum from ".$db->quoteName('#__realestatenow_property')."";
            $db->setQuery($select);
            $result = $db->loadAssoc();
            return $result['landareasqftmaximum'];
        }
        
        private function getOrderingColumnDirection($list_sort){
            $OrderingColumnDirection = [];
            
            if($list_sort == 'name_asc' || $list_sort == 'price_asc') {
                $OrderingColumnDirection['order_direction'] = 'ASC';
            } else{
                $OrderingColumnDirection['order_direction'] = 'DESC';
            }
            
            
            if(strpos( $list_sort,'name' ) === 0)
                $OrderingColumnDirection['order_column'] = 'a.name';
            else{
                $OrderingColumnDirection['order_column'] = 'a.price';
            }
            
            return $OrderingColumnDirection;
        }
    
        /**
         * Returns a range of property Ids to navigating in context of session search vars.
         *         *
         * @return  array  Id's for items in the page navigation context
         *
         * @since   now
         */
        public function getNavigationIds()
        {
            $query = $this->getListQuery();
            // Use fast COUNT(*) on \JDatabaseQuery objects if there is no GROUP BY or HAVING clause:
            if ($query instanceof \JDatabaseQuery
                && $query->type == 'select'
                && $query->group === null
                && $query->union === null
                && $query->unionAll === null
                && $query->having === null)
            {
                $query = clone $query;
            
                //if this is the first item then special case
                if ( 0 === $this->getState('offset',0) ){
                    $limit = 2;
                    $limit_start = 0;
                }
                else{
                    $limit = 3;
                    $base_offset = $this->getState('offset',0);
                    $limit_start = $base_offset - 1;
                }
            
                $query->clear('select' )->clear('limit' )->clear('offset')->select('a.id' )->setLimit($limit,$limit_start);
            
                $this->getDbo()->setQuery($query);
            
                return $this->getDbo()->loadColumn(0);
            }
        
            // Otherwise fall back to inefficient way of counting all results.
        
            // Remove the limit and offset part if it's a \JDatabaseQuery object
            if ($query instanceof \JDatabaseQuery)
            {
                $query = clone $query;
                $query->clear('limit')->clear('offset');
            }
        
            $this->getDbo()->setQuery($query);
            $this->getDbo()->execute();
        
            return (int) $this->getDbo()->getNumRows();
        }
    }