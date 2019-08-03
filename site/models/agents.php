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

/***[INSERTED$$$$]***//*711*/
// import the Joomla modellist library
jimport('joomla.application.component.modellist');

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Table\Category;

/***[/INSERTED$$$$]***/
/**
 * Realestatenow Model for Agents
 */
/***[REPLACED$$$$]***//*712*/
class RealestatenowModelAgents extends ListModel
/***[/REPLACED$$$$]***/
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
		// [Interpretation 3022] Make sure all records load, since no pagination allowed.
		$this->setState('list.limit', 0);
		// [Interpretation 3024] Get a db connection.
		$db = JFactory::getDbo();

		// [Interpretation 3027] Create a new query object.
		$query = $db->getQuery(true);

		// [Interpretation 3030] Filtering.

// Start - Add PHP (getListQuery - JModelList) -- PHP getlistquery Method

            // Filtering.
            $filters = $this->getState('filter','');
            
            if( ( $keywords = $this->getState('filter','')['keywords'] ) && !empty( $keywords ) )
                $query->where("a.name like '%".$keywords."%' or a.propdesc like '%".$keywords."%'");
            
            if( ( $city = $this->getState('filter','')['city'] ) && !empty( $city ) )
            $query->where("a.cityid = '$city'");
            
            if( !empty( $filters['featured'] )  )
                $query->where('a.featured = '.$filters['featured']);

// Start - Add PHP (getListQuery - JModelList) -- PHP getlistquery Method

		// [Interpretation 1592] Get from #__realestatenow_agent as a
		$query->select($db->quoteName(
			array('a.id','a.asset_id','a.street','a.streettwo','a.countryid','a.cityid','a.stateid','a.postcode','a.uid','a.email','a.phone','a.mobile','a.fax','a.image','a.bio','a.name','a.alias','a.catid','a.agencyid','a.featured','a.default_agent_yn','a.viewad','a.rets_source','a.owncoords','a.latitude','a.longitude','a.fbook','a.twitter','a.pinterest','a.linkedin','a.youtube','a.gplus','a.skype','a.instagram','a.website','a.blog','a.published','a.created_by','a.modified_by','a.created','a.modified','a.version','a.hits','a.ordering'),
			array('id','asset_id','street','streettwo','countryid','cityid','stateid','postcode','uid','email','phone','mobile','fax','image','bio','name','alias','catid','agencyid','featured','default_agent_yn','viewad','rets_source','owncoords','latitude','longitude','fbook','twitter','pinterest','linkedin','youtube','gplus','skype','instagram','website','blog','published','created_by','modified_by','created','modified','version','hits','ordering')));
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

		// [Interpretation 1592] Get from #__categories as f
		$query->select($db->quoteName(
			array('f.title'),
			array('title')));
		$query->join('LEFT', ($db->quoteName('#__categories', 'f')) . ' ON (' . $db->quoteName('a.catid') . ' = ' . $db->quoteName('f.id') . ')');
		// [Interpretation 2167] Get where a.published is 1
		$query->where('a.published = 1');
		// [Interpretation 2167] Get where b.published is 1
		$query->where('b.published = 1');
/***[REPLACED$$$$]***//*697*/
        $query->order('RAND(' . rand ( 10 , 500 ) . ')');
/***[/REPLACED$$$$]***/

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
		if (!$user->authorise('site.agents.access', 'com_realestatenow'))
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('COM_REALESTATENOW_NOT_AUTHORISED_TO_VIEW_AGENTS'), 'error');
			// [Interpretation 2260] redirect away to the home page if no access allowed.
			$app->redirect(JURI::root());
			return false;
		}


// Add PHP (before getting the Items)
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
				// [Interpretation 1852] Make sure the content prepare plugins fire on bio
				$_bio = new stdClass();
				$_bio->text =& $item->bio; // [Interpretation 1854] value must be in text
				// [Interpretation 1855] Since all values are now in text (Joomla Limitation), we also add the field name (bio) to context
				$this->_dispatcher->trigger("onContentPrepare", array('com_realestatenow.agents.bio', &$_bio, &$params, 0));
				// [Interpretation 1883] Checking if bio has uikit components that must be loaded.
				$this->uikitComp = RealestatenowHelper::getUikitComp($item->bio,$this->uikitComp);
			}
		}


// Start PHP getItems Method

		// do a quick build of all edit links links
		if (isset($items) && $items)
		{
			foreach ($items as $nr => &$item)
			{
				$canDo = RealestatenowHelper::getActions('agent',$item,'agents');
				if ($canDo->get('agent.edit'))
				{
					$item->editLink = '<br /><br /><a class="uk-button uk-button-primary uk-width-1-1" href="';
					$item->editLink .= JRoute::_('index.php?option=com_realestatenow&view=agent&task=agent.edit&id=' . $item->id);
					$item->editLink .= '"><i class="uk-icon-pencil"></i><span class="uk-hidden-small">';
					$item->editLink .= JText::_('COM_REALESTATENOW_EDIT_AGENT');
					$item->editLink .= '</span></a>';
				}
				else
				{
					$item->editLink = '';
				}
			}
		}

/**
* Truncates text.
*
* Cuts a string to the length of $length and replaces the last characters
* with the ending if the text is longer than length.
*
* ### Options:
*
* - `ending` Will be used as Ending and appended to the trimmed string
* - `exact` If false, $text will not be cut mid-word
* - `html` If true, HTML tags would be handled correctly
*
* @param string  $text String to truncate.
* @param integer $length Length of returned string, including ellipsis.
* @param array $options An array of html attributes and options.
* @return string Trimmed string.
* @access public
* @link http://book.cakephp.org/view/1469/Text#truncate-1625
*/
function truncate($text, $length = 100, $options = array()) {
    $default = array(
        'ending' => '...', 'exact' => true, 'html' => false
    );
    $options = array_merge($default, $options);
    extract($options);

    if ($html) {
        if (mb_strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }
        $totalLength = mb_strlen(strip_tags($ending));
        $openTags = array();
        $truncate = '';

        preg_match_all('/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER);
        foreach ($tags as $tag) {
            if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2])) {
                if (preg_match('/<[\w]+[^>]*>/s', $tag[0])) {
                    array_unshift($openTags, $tag[2]);
                } else if (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag)) {
                    $pos = array_search($closeTag[1], $openTags);
                    if ($pos !== false) {
                        array_splice($openTags, $pos, 1);
                    }
                }
            }
            $truncate .= $tag[1];

            $contentLength = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3]));
            if ($contentLength + $totalLength > $length) {
                $left = $length - $totalLength;
                $entitiesLength = 0;
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE)) {
                    foreach ($entities[0] as $entity) {
                        if ($entity[1] + 1 - $entitiesLength <= $left) {
                            $left--;
                            $entitiesLength += mb_strlen($entity[0]);
                        } else {
                            break;
                        }
                    }
                }

                $truncate .= mb_substr($tag[3], 0 , $left + $entitiesLength);
                break;
            } else {
                $truncate .= $tag[3];
                $totalLength += $contentLength;
            }
            if ($totalLength >= $length) {
                break;
            }
        }
    } else {
        if (mb_strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = mb_substr($text, 0, $length - mb_strlen($ending));
        }
    }
    if (!$exact) {
        $spacepos = mb_strrpos($truncate, ' ');
        if (isset($spacepos)) {
            if ($html) {
                $bits = mb_substr($truncate, $spacepos);
                preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);
                if (!empty($droppedTags)) {
                    foreach ($droppedTags as $closingTag) {
                        if (!in_array($closingTag[1], $openTags)) {
                            array_unshift($openTags, $closingTag[1]);
                        }
                    }
                }
            }
            $truncate = mb_substr($truncate, 0, $spacepos);
        }
    }
    $truncate .= $ending;

    if ($html) {
        foreach ($openTags as $tag) {
            $truncate .= '</'.$tag.'>';
        }
    }

    return $truncate;
}

// End PHP getItems Method

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

// Site View -- Custom Buttons -- PHP (model methods) ** Start **
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
        $componentparams =$app->getUserStateFromRequest(
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
        $list_sort = !empty($list['sort']) ? $list['sort'] : 'name_asc';

        // Set Ordering column and direction
        $OrderingColumnDirection = $this->getOrderingColumnDirection($list_sort);

        $list['direction'] = $OrderingColumnDirection['order_direction'];
        $list['ordering'] = $OrderingColumnDirection['order_column'];

        $this->setState('list', $list);

        $filter = $app->getUserStateFromRequest ($this->context . '.filter', 'filter', array_fill_keys ($this->filter_fields, ''), 'array');

        //check the request to see if the category id is set
        if($categoryids = $app->input->get('categoryids',false,'INT'))
            $filter['categoryids'] = $categoryids;

        $this->setState('filter', $filter);

        $this->setState( 'active_menu_item_id',
            $app->getUserStateFromRequest( $this->context . '.active_menu_item_id',
                'active_menu_item_id', isset($app->getMenu()->getActive()->id) ? $app->getMenu()->getActive()->id : null ));

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
            $select = "select max(landareasqft) as landareasqftmaximum from ".$db->quoteName('#__realestatenow_property');
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

// Site View -- Custom Buttons -- PHP (model methods) ** End**

}
