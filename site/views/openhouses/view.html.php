<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		view.html.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/***[INSERTED$$$$]***//*698*/
use Joomla\CMS\MVC\View\HtmlView;

/***[/INSERTED$$$$]***/
/**
 * Realestatenow View class for the Openhouses
 */
/***[REPLACED$$$$]***//*678*/
class RealestatenowViewOpenhouses extends HtmlView
{

     /** @var CMSApplication $app */
     protected $app;
     protected $response;
     protected $totalproperties;
     protected $active_state_vars;
     protected $infomarker = [];
     protected $infohtml = [];
     protected $items = [];
     protected $activeMenuItemId;

/***[/REPLACED$$$$]***/
	// Overwriting JView display method
	function display($tpl = null)
	{		
		// get combined params of both component and menu
		$this->app = JFactory::getApplication();
		$this->params = $this->app->getParams();
		$this->menu = $this->app->getMenu()->getActive();
		// get the user object
		$this->user = JFactory::getUser();
		// [Interpretation 3190] Initialise variables.
		$this->items = $this->get('Items');
		$this->categorylist = $this->get('CategoryList');
		$this->statelist = $this->get('StateList');
		$this->transactiontypeslist = $this->get('TransactiontypesList');
		$this->marketstatuslist = $this->get('MarketstatusList');
		$this->agentlist = $this->get('AgentList');
		$this->citylist = $this->get('CityList');
		// Site View -- Custom Script (JViewLegacy display) ** Start **
		            
		            if(!empty($this->menu))
		                $this->activeMenuItemId =  $this->menu->id;
		            else
		                $this->activeMenuItemId = false;
		
		//get the default model context to access the user session filter store
		$this->context = explode( '.', $this->getModel('Openhouses')->get('context'))[1];
		
		$this->category = $this->get('Category');
		
		$this->totalproperties = $this->get('Total');
		
		$this->setActiveFilterListVars ();
		$this->setPaginationObject();
		
		            if (is_array ($this->items) && (count ($this->items) > 0)):
		                foreach($this->items as $key=>&$item):
		                    $item->context = $this->context;
		                    $item->offset = ( ( $this->active_state_vars['list']['page'] - 1 ) * $this->active_state_vars['list']['limit'] ) + $key;
		                    $item->link = $this->getItemLink ( $item );
		                    if (!empty($item->latitude) && !empty($item->longitude)):
		                        $this->infomarker[] = array($item->name,$item->latitude,$item->longitude);
		                    endif;
		                    if ($this->params->get('properties_display') == 2) :
		                            $item->html = JLayoutHelper::render('openhousespanellistings',$item);
		                        if (!empty($item->latitude) && !empty($item->longitude)):
		                            $this->infohtml[] = [JLayoutHelper::render('openhousesinfobox',$item)];
		                        endif;
		                    elseif ($this->params->get('properties_display') == 3) :
		                        $item->html = JLayoutHelper::render('openhouseslandingpage',$item);
		                        if (!empty($item->latitude) && !empty($item->longitude)):
		                            $this->infohtml[] = [JLayoutHelper::render('openhousesinfobox',$item)];
		                        endif;
		                    else:
		                        $item->html = JLayoutHelper::render('openhouseslistings',$item);
		                        if (!empty($item->latitude) && !empty($item->longitude)):
		                            $this->infohtml[] = [JLayoutHelper::render('openhousesinfobox',$item)];
		                        endif;
		                    endif;
		                endforeach;
		            endif;
		            
		// Site View -- Custom Script (JViewLegacy display) ** End **

		// [Interpretation 3230] Set the toolbar
		$this->addToolBar();

		// [Interpretation 3232] set the document
		$this->_prepareDocument();

		// [Interpretation 3247] Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		parent::display($tpl);
	}

// Site View -- Custom Methods (JViewLegacy) ** Start **

        public function setActiveFilterListVars()
        {
            $this->active_state_vars = ['list'=>[],'filter'=>[]];
            $state = $this->getModel('Openhouses')->getState();
            $this->active_state_vars['list'] = $state->get('list');
            $this->active_state_vars['filter'] = $state->get('filter');
            $this->active_state_vars['componentparams'] = $state->get('componentparams');
        }
        
        private function setPaginationObject()
        {
            JHtml::_('jquery.framework');
            $this->document->addScript(JURI::root(true) .'/components/com_realestatenow/assets/js/jquery.simplePagination.js',['async'=>true]);
            $this->document->addScript('https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js',['async'=>true]);
            $this->document->addStyleSheet(JURI::root(true) .'/components/com_realestatenow/assets/css/simplePagination.css',['async'=>true]);
        }
        
	/*Logic Function for Child Categories*/
	function getChildCategoryList($parentid)
		{
			if (!isset($this->initSet) || !$this->initSet)
		{
			$this->user		= JFactory::getUser();
			$this->userId		= $this->user->get('id');
			$this->guest		= $this->user->get('guest');
			$this->groups		= $this->user->get('groups');
			$this->authorisedGroups	= $this->user->getAuthorisedGroups();
			$this->levels		= $this->user->getAuthorisedViewLevels();
			$this->initSet		= true;
		}

		// [Interpretation 2253] Get the global params
		$globalParams = JComponentHelper::getParams('com_realestatenow', true);
		// [Interpretation 2689] Get a db connection.
		$db = JFactory::getDbo();

		// [Interpretation 2698] Create a new query object.
		$query = $db->getQuery(true);

		// [Interpretation 1444] Get from #__categories as a
		$query->select($db->quoteName(
			array('a.id','a.title','a.alias','a.description','a.hits','a.language','a.params'),
			array('id','title','alias','description','hits','language','params')));
		$query->from($db->quoteName('#__categories', 'a'));
		// [Interpretation 1941] Get where a.published is 1
		$query->where('a.published = 1');
		// [Interpretation 1941] Get where a.extension is "com_realestatenow.properties"
		$query->where('a.extension = "com_realestatenow.properties"');
		$query->where("a.parent_id = '$parentid'");
		$query->order('a.title ASC');

		// [Interpretation 2258] Reset the query using our newly populated query object.
		$db->setQuery($query);
		$items = $db->loadObjectList();

		if (empty($items))
		{
			return false;
		}

		// [Interpretation 2734] Convert the parameter fields into objects.
		if (RealestatenowHelper::checkArray($items))
		{
			foreach ($items as $nr => &$item)
			{
				// [Interpretation 2739] Always create a slug for sef URL's
				$item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
			}
		}
		// [Interpretation 2267] return items
		return $items;
		}

        protected function getItemLink($item)
        {
            $item_link_base_url  = JUri::base ().'index.php?option=com_realestatenow&view=property';
            $item_link_vars  =
                '&shownav=1' .
                '&context=' .   $item -> context .
                '&offset='  .   $item -> offset .
                '&id='      .   $item -> id;
            
            return $item_link_base_url.$item_link_vars;
        }

// Site View -- Custom Methods (JViewLegacy) ** End **

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{

		// [Interpretation 3845] always make sure jquery is loaded.
		JHtml::_('jquery.framework');
		// [Interpretation 3847] Load the header checker class.
		require_once( JPATH_COMPONENT_SITE.'/helpers/headercheck.php' );
		// [Interpretation 3856] Initialize the header checker.
		$HeaderCheck = new realestatenowHeaderCheck;

		// [Interpretation 4080] Load uikit options.
		$uikit = $this->params->get('uikit_load');
		// [Interpretation 4082] Set script size.
		$size = $this->params->get('uikit_min');
		// [Interpretation 4099] Set css style.
		$style = $this->params->get('uikit_style');

		// [Interpretation 4102] The uikit css.
		if ((!$HeaderCheck->css_loaded('uikit.min') || $uikit == 1) && $uikit != 2 && $uikit != 3)
		{
			$this->document->addStyleSheet(JURI::root(true) .'/media/com_realestatenow/uikit-v2/css/uikit'.$style.$size.'.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
		}
		// [Interpretation 4107] The uikit js.
		if ((!$HeaderCheck->js_loaded('uikit.min') || $uikit == 1) && $uikit != 2 && $uikit != 3)
		{
			$this->document->addScript(JURI::root(true) .'/media/com_realestatenow/uikit-v2/js/uikit'.$size.'.js', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		}

		// [Interpretation 4116] Load the script to find all uikit components needed.
		if ($uikit != 2)
		{
			// [Interpretation 4119] Set the default uikit components in this view.
			$uikitComp = array();
			$uikitComp[] = 'data-uk-grid';
			$uikitComp[] = 'uk-slideshow';
			$uikitComp[] = 'data-uk-tooltip';
			$uikitComp[] = 'uk-slidenav';
			$uikitComp[] = 'uk-form-select';
			$uikitComp[] = 'uk-form';

			// [Interpretation 4128] Get field uikit components needed in this view.
			$uikitFieldComp = $this->get('UikitComp');
			if (isset($uikitFieldComp) && RealestatenowHelper::checkArray($uikitFieldComp))
			{
				if (isset($uikitComp) && RealestatenowHelper::checkArray($uikitComp))
				{
					$uikitComp = array_merge($uikitComp, $uikitFieldComp);
					$uikitComp = array_unique($uikitComp);
				}
				else
				{
					$uikitComp = $uikitFieldComp;
				}
			}
		}

		// [Interpretation 4144] Load the needed uikit components in this view.
		if ($uikit != 2 && isset($uikitComp) && RealestatenowHelper::checkArray($uikitComp))
		{
			// [Interpretation 4147] load just in case.
			jimport('joomla.filesystem.file');
			// [Interpretation 4149] loading...
			foreach ($uikitComp as $class)
			{
				foreach (RealestatenowHelper::$uk_components[$class] as $name)
				{
					// [Interpretation 4154] check if the CSS file exists.
					if (JFile::exists(JPATH_ROOT.'/media/com_realestatenow/uikit-v2/css/components/'.$name.$style.$size.'.css'))
					{
						// [Interpretation 4157] load the css.
						$this->document->addStyleSheet(JURI::root(true) .'/media/com_realestatenow/uikit-v2/css/components/'.$name.$style.$size.'.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
					}
					// [Interpretation 4160] check if the JavaScript file exists.
					if (JFile::exists(JPATH_ROOT.'/media/com_realestatenow/uikit-v2/js/components/'.$name.$size.'.js'))
					{
						// [Interpretation 4163] load the js.
						$this->document->addScript(JURI::root(true) .'/media/com_realestatenow/uikit-v2/js/components/'.$name.$size.'.js', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('type' => 'text/javascript', 'async' => 'async') : true);
					}
				}
			}
		}
		// [Interpretation 3805] load the meta description
		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}
		// [Interpretation 3810] load the key words if set
		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}
		// [Interpretation 3815] check the robot params
		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
		// add the document default css file
		$this->document->addStyleSheet(JURI::root(true) .'/components/com_realestatenow/assets/css/openhouses.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
/***[INSERTED$$$$]***//*686*/
         //load images lazily.
         JFactory::getDocument()->addScript(JURI::root().'components/com_realestatenow/assets/js/jquery.lazy.min.js');
/***[/INSERTED$$$$]***/
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		// adding the joomla toolbar to the front
		JLoader::register('JToolbarHelper', JPATH_ADMINISTRATOR.'/includes/toolbar.php');
		
		// set help url for this view if found
		$help_url = RealestatenowHelper::getHelpUrl('openhouses');
		if (RealestatenowHelper::checkString($help_url))
		{
			JToolbarHelper::help('COM_REALESTATENOW_HELP_MANAGER', false, $help_url);
		}
		// now initiate the toolbar
		$this->toolbar = JToolbar::getInstance();
	}

	/**
	 * Escapes a value for output in a view script.
	 *
	 * @param   mixed  $var  The output to escape.
	 *
	 * @return  mixed  The escaped value.
	 */
	public function escape($var, $sorten = false, $length = 40)
	{
		// use the helper htmlEscape method instead.
		return RealestatenowHelper::htmlEscape($var, $this->_charset, $sorten, $length);
	}
}
