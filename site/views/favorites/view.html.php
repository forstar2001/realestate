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
 * Realestatenow View class for the Favorites
 */
class RealestatenowViewFavorites extends JViewLegacy
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
		// [Interpretation 3190] Initialise variables.
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		if ($this->params->get('properties_display') == 2) : 
			foreach($this->items as &$item){
				$item->html = JLayoutHelper::render('allpropertypanellistings',$item);
				$item->infohtml = JLayoutHelper::render('allpropertyinfobox',$item);
			}
		elseif ($this->params->get('properties_display') == 3) :
			foreach($this->items as &$item){
				$item->html = JLayoutHelper::render('allpropertylandingpage',$item);
				$item->infohtml = JLayoutHelper::render('allpropertyinfobox',$item);
			}
		else: 
			foreach($this->items as &$item){
				$item->html = JLayoutHelper::render('allpropertylistings',$item);
				$item->infohtml = JLayoutHelper::render('allpropertyinfobox',$item);
			}
		endif;
		

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
		$this->document->addStyleSheet(JURI::root(true) .'/components/com_realestatenow/assets/css/favorites.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		// adding the joomla toolbar to the front
		JLoader::register('JToolbarHelper', JPATH_ADMINISTRATOR.'/includes/toolbar.php');
		
		// set help url for this view if found
		$help_url = RealestatenowHelper::getHelpUrl('favorites');
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
