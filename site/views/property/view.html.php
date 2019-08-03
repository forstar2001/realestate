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

/**
 * Realestatenow View class for the Property
 */
class RealestatenowViewProperty extends JViewLegacy
{
	// Overwriting JView display method
	function display($tpl = null)
	{		
		// get combined params of both component and menu
		$this->app = JFactory::getApplication();
		$this->params = $this->app->getParams();
		$this->menu = $this->app->getMenu()->getActive();
		// get the user object
		$this->user = JFactory::getUser();
		// [Interpretation 3184] Initialise variables.
		$this->item = $this->get('Item');
		$this->similarproperties = $this->get('similarProperties');
		$this->allimages = $this->get('AllImages');
		// Site View -- Custom Script (JViewLegacy display) ** Start **
		
		$this->context = $this->item->context = $this->getModel()->getState('context');
		
		            $property_name = $this->item->name ? $this->item->name : '';
		            $property_desc = $this->item->propdesc ? $this->item->propdesc : '';
		            $property_caption = JURI::base();
		            $property_link = JURI::root().'index.php?option=com_realestatenow&view=property&id='.$this->item->id;
		            
		            if(!empty($this->allimages)){
		                $img_name = $this->allimages[0]->filename;
		                $img_ext = $this->allimages[0]->type;
		                $img_path = $this->allimages[0]->path;
		                $remote = $this->allimages[0]->remote;
		                if($remote == 0) {
		                    $property_image = JURI::root().$img_path.$img_name.'.'.$img_ext;
		                } else {
		                    $property_image = $img_path.$img_name;
		                }
		            }else{
		                $property_image = JURI::root()."media/com_realestatenow/images/No_image_available.png";
		            }
		            
		            /////////////////******************** Start Add meta for social **********************////////////
		            
		            $document =    JFactory::getDocument();
		            $config = JFactory::getConfig();
		            
		            set_error_handler (function($errno, $errstr, $errfile, $errline){
		                throw new Exception($errstr);
		            });
		            
		            try{
		                $prop_image = getimagesize($property_image);
		            }catch(Exception $exception){
		                $prop_image = false;
		            }
		    
		            restore_error_handler();
		            
		            if($prop_image)
		            {
		                $opengraph  = '<meta property="og:title" content="'.$property_name.'"/>' ."\n";
		                $opengraph .= '<meta property="og:url" content="'.$property_link.'"/>' ."\n";
		                $opengraph .= '<meta name="image" content="'. $property_image .'"/>' ."\n";
		                $opengraph .= '<meta property="og:image" content="'. $property_image .'"/>' ."\n";
		                $opengraph .= '<meta property="og:image:width" content="'.$prop_image[0].'"/>' ."\n";;
		                $opengraph .= '<meta property="og:image:height" content="'.$prop_image[1].'"/>' ."\n";;
		                $opengraph .= '<meta property="og:image:type" content="'.$prop_image['mime'].'"/>' ."\n";;
		                $opengraph .= '<meta itemprop="image" content="'. $property_image .'"/>' ."\n";
		                $opengraph .= '<meta property="og:description" content="'. $property_desc .'"/>' ."\n";
		                $opengraph .= '<meta property="og:type" content="article"/>' ."\n";
		                $opengraph .= '<meta property="og:site_name" content="'.$config->get( 'sitename' ).'"/>' ."\n";
		                
		                $document->addCustomTag($opengraph);
		            }
		            
		            
		            /////////////////******************** End Add meta for social **********************////////////
		            
		            // add a hit to the property
		            
		            if ($this->hit($this->item->id))
		                $this->item->hits++;
		            
		            if( $this->getModel()->getState('getnavitems',false) ){
		                
		                $this->offset = $this->get('State')->get( 'offset' );
		    
		                $nav_source_id = $this->app->input->get('source', false, 'INT');
		                $item = JFactory::getApplication()->getMenu()->getItem( $nav_source_id );
		                $url = JRoute::_($item->link . '&Itemid=' . $item->id);
		                $this->item->return_to_search_link = $url;
		                //$this->item->return_to_search_link = JRoute::_("index.php&Itemid=".$nav_source_id);
		                
		                /** @var RealestatenowModelSearchproperties $propertiesModel */
		                $propertiesModel = Joomla\CMS\MVC\Model\ListModel::getInstance ( ucfirst($this->context ), 'RealestatenowModel');
		                
		                $propertiesModel->getState();//populate the state
		                $propertiesModel->setState('offset', $this->offset );
		                $propertiesModel->setState('limit', 3 );
		                
		                $this->item->navigation_range = $propertiesModel->getNavigationIds ();
		    
		    
		                //$property_menu_item_id = JFactory::getApplication()->getMenu()->getActive ()->id;
		                //$current_page_base_url = JRoute::_($item->link . '&Itemid=' . $property_menu_item_id);
		                $nav_item_base_route = 'index.php?option=com_realestatenow&view=property';//JRoute::_('index.php?option=com_realestatenow&task=property.display');
		                $nav_item_base_url = $nav_item_base_route."&shownav=true&source=".$nav_source_id."&context=" . $this->context;
		                
		                
		                if(!empty($this->item->navigation_range) ){
		                    if(  $this->item->id == $this->item->navigation_range[0] ){
		                        if( count($this->item->navigation_range) == 1 )//only 1 filter result, disable back and next
		                            $this->item->navigation_dictionary = [
		                                'back'=>false,
		                                'current'=>[
		                                    'item_id'=>$this->item->navigation_range[0],
		                                    'item_offset'=>$this->offset
		                                ],
		                                'next'=>false
		                            ];
		                        else//1st item, disable back button
		                            $this->item->navigation_dictionary = [
		                                'back'=>false,
		                                'current'=>[
		                                    'item_id'=>$this->item->navigation_range[0],
		                                    'item_offset'=>$this->offset
		                                ],
		                                'next'=>[
		                                    //'item_link'=>"index.php?option=com_realestatenow&view=property&source=".$nav_source_id."&context=" . $this->context . "&id=" . $this->item->navigation_range[1] . "&shownav=true&offset=".($this->offset + 1),
		                                    'item_link'=>JRoute::_( $nav_item_base_url."&id=" . $this->item->navigation_range[1] . "&offset=".($this->offset + 1) ),
		                                    'item_id'=>$this->item->navigation_range[1],
		                                    'item_offset'=>$this->offset + 1
		                                ]
		                            ];
		                    }
		                    elseif( count( $this->item->navigation_range ) == 2 ){//last item, disable next button
		                        $this->item->navigation_dictionary = [
		                            'back'=>[
		                                'item_link'=>JRoute::_($nav_item_base_url."&id=" . $this->item->navigation_range[0] . "&offset=".($this->offset - 1) ),
		                                'item_id'=>$this->item->navigation_range[0],
		                                'item_offset'=> $this->offset - 1
		                            ],
		                            'current'=>[
		                                'item_id'=>$this->item->navigation_range[1],
		                                'item_offset'=>$this->offset
		                            ],
		                            'next'=>false
		                        ];
		                    }
		                    else{
		                        $this->item->navigation_dictionary = [
		                            'back'=>[
		                                'item_link'=>JRoute::_($nav_item_base_url."&id=" . $this->item->navigation_range[0] . "&offset=".($this->offset - 1)),
		                                'item_id'=>$this->item->navigation_range[0],
		                                'item_offset'=> $this->offset - 1
		                            ],
		                            'current'=>[
		                                'item_id'=>$this->item->navigation_range[1],
		                                'item_offset'=>$this->offset
		                            ],
		                            'next'=>[
		                                'item_link'=>JRoute::_($nav_item_base_url."&id=" . $this->item->navigation_range[1] . "&offset=".($this->offset + 1)),
		                                'item_id'=>$this->item->navigation_range[2],
		                                'item_offset'=> $this->offset - 1
		                            ],
		                        ];
		                    }
		                }
		                else{
		                    $this->item->navigation_dictionary = false;
		                }
		            }
		            else{
		                $this->item->navigation_dictionary  = false;
		            }
		
		// Site View -- Custom Script (JViewLegacy display) ** End**
		

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

        protected $offset;
        protected $item;

	 /**
	 * Increment the hit counter for the property.
	 *
	 * @param   integer  $pk  Primary key of the property to increment.
	 *
	 * @return  boolean  True if successful;
	 */
	public function hit($pk = 0)
	{
		if ($pk)
		{
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);

			// Fields to update.
			$fields = array(
			    $db->quoteName('hits') . ' = '.$db->quoteName('hits').' + 1'
			);

			// Conditions for which records should be updated.
			$conditions = array(
			    $db->quoteName('id') . ' = ' . $pk
			);

			$query->update($db->quoteName('#__realestatenow_property'))->set($fields)->where($conditions);

			$db->setQuery($query);
			return $db->execute();
		}
		return false;
	}

// Site View -- Custom Methods(JViewLegacy) ** End**

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
			$uikitComp[] = 'uk-form';
			$uikitComp[] = 'data-uk-grid';
			$uikitComp[] = 'uk-slideshow';
			$uikitComp[] = 'uk-slidenav';
			$uikitComp[] = 'uk-accordion';

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

		// [Interpretation 8131] Add the CSS for Footable.
		$this->document->addStyleSheet(JURI::root() .'media/com_realestatenow/footable-v2/css/footable.core.min.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');

		// [Interpretation 8133] Use the Metro Style
		if (!isset($this->fooTableStyle) || 0 == $this->fooTableStyle)
		{
			$this->document->addStyleSheet(JURI::root() .'media/com_realestatenow/footable-v2/css/footable.metro.min.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
		}
		// [Interpretation 8138] Use the Legacy Style.
		elseif (isset($this->fooTableStyle) && 1 == $this->fooTableStyle)
		{
			$this->document->addStyleSheet(JURI::root() .'media/com_realestatenow/footable-v2/css/footable.standalone.min.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
		}

		// [Interpretation 8143] Add the JavaScript for Footable
		$this->document->addScript(JURI::root() .'media/com_realestatenow/footable-v2/js/footable.js', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		$this->document->addScript(JURI::root() .'media/com_realestatenow/footable-v2/js/footable.sort.js', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		$this->document->addScript(JURI::root() .'media/com_realestatenow/footable-v2/js/footable.filter.js', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		$this->document->addScript(JURI::root() .'media/com_realestatenow/footable-v2/js/footable.paginate.js', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		// [Interpretation 3754] load the meta description
		if (isset($this->item->metadesc) && $this->item->metadesc)
		{
			$this->document->setDescription($this->item->metadesc);
		}
		elseif ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}
		// [Interpretation 3763] load the key words if set
		if (isset($this->item->metakey) && $this->item->metakey)
		{
			$this->document->setMetadata('keywords', $this->item->metakey);
		}
		elseif ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}
		// [Interpretation 3772] check the robot params
		if (isset($this->item->robots) && $this->item->robots)
		{
			$this->document->setMetadata('robots', $this->item->robots);
		}
		elseif ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
		// [Interpretation 3781] check if autor is to be set
		if (isset($this->item->created_by) && $this->params->get('MetaAuthor') == '1')
		{
			$this->document->setMetaData('author', $this->item->created_by);
		}
		// [Interpretation 3786] check if metadata is available
		if (isset($this->item->metadata) && $this->item->metadata)
		{
			$mdata = json_decode($this->item->metadata,true);
			foreach ($mdata as $k => $v)
			{
				if ($v)
				{
					$this->document->setMetadata($k, $v);
				}
			}
		} 
		// add the document default css file
		$this->document->addStyleSheet(JURI::root(true) .'/components/com_realestatenow/assets/css/property.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		// adding the joomla toolbar to the front
		JLoader::register('JToolbarHelper', JPATH_ADMINISTRATOR.'/includes/toolbar.php');

		// set help url for this view if found
		$help_url = RealestatenowHelper::getHelpUrl('property');
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
