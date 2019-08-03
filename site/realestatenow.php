<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		realestatenow.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tabstate');

// Set the component css/js
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_realestatenow/assets/css/site.css');
$document->addScript('components/com_realestatenow/assets/js/site.js');

// Require helper files
/***[INSERTED$$$$]***//*670*/
JLoader::register('RealestatenowImageHelper', dirname(__FILE__) . '/helpers/image.php');
JLoader::register('RealestatenowCategoryHelper', dirname(__FILE__) . '/helpers/category.php');
/***[/INSERTED$$$$]***/
JLoader::register('RealestatenowHelper', __DIR__ . '/helpers/realestatenow.php'); 
JLoader::register('RealestatenowEmail', JPATH_COMPONENT_ADMINISTRATOR . '/helpers/realestatenowemail.php'); 
JLoader::register('RealestatenowHelperRoute', __DIR__ . '/helpers/route.php'); 

// Get an instance of the controller prefixed by Realestatenow
$controller = JControllerLegacy::getInstance('Realestatenow');

// Perform the request task
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();
