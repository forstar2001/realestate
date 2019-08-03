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

/**
 * Realestatenow Model
 */
class RealestatenowModelRealestatenow extends JModelList
{
	public function getIcons()
	{
		// load user for access menus
		$user = JFactory::getUser();
		// reset icon array
		$icons  = array();
		// view groups array
		$viewGroups = array(
			'main' => array('jpg.countries', 'jpg.states', 'jpg.cities', 'jpg.agencies', 'jpg.agent.add', 'jpg.agents', 'jpg.agents.catid', 'jpg.property.add', 'jpg.properties', 'jpg.properties.catid')
		);
		// [Interpretation 12722] view access array
		$viewAccess = array(
			'country.create' => 'country.create',
			'countries.access' => 'country.access',
			'country.access' => 'country.access',
			'countries.submenu' => 'country.submenu',
			'countries.dashboard_list' => 'country.dashboard_list',
			'state.create' => 'state.create',
			'states.access' => 'state.access',
			'state.access' => 'state.access',
			'states.submenu' => 'state.submenu',
			'states.dashboard_list' => 'state.dashboard_list',
			'city.create' => 'city.create',
			'cities.access' => 'city.access',
			'city.access' => 'city.access',
			'cities.submenu' => 'city.submenu',
			'cities.dashboard_list' => 'city.dashboard_list',
			'agency.create' => 'agency.create',
			'agencies.access' => 'agency.access',
			'agency.access' => 'agency.access',
			'agencies.submenu' => 'agency.submenu',
			'agencies.dashboard_list' => 'agency.dashboard_list',
			'agent.create' => 'agent.create',
			'agents.access' => 'agent.access',
			'agent.access' => 'agent.access',
			'agents.submenu' => 'agent.submenu',
			'agents.dashboard_list' => 'agent.dashboard_list',
			'agent.dashboard_add' => 'agent.dashboard_add',
			'property.create' => 'property.create',
			'properties.access' => 'property.access',
			'property.access' => 'property.access',
			'properties.submenu' => 'property.submenu',
			'properties.dashboard_list' => 'property.dashboard_list',
			'property.dashboard_add' => 'property.dashboard_add',
			'residentials.access' => 'residential.access',
			'residential.access' => 'residential.access',
			'lands.access' => 'land.access',
			'land.access' => 'land.access',
			'commercials.access' => 'commercial.access',
			'commercial.access' => 'commercial.access',
			'multifamilies.access' => 'multifamily.access',
			'multifamily.access' => 'multifamily.access',
			'areas.access' => 'area.access',
			'area.access' => 'area.access',
			'features.access' => 'feature.access',
			'feature.access' => 'feature.access',
			'financials.access' => 'financial.access',
			'financial.access' => 'financial.access',
			'rentals.access' => 'rental.access',
			'rental.access' => 'rental.access',
			'market_statuses.access' => 'market_status.access',
			'market_status.access' => 'market_status.access',
			'market_statuses.submenu' => 'market_status.submenu',
			'transaction_types.access' => 'transaction_type.access',
			'transaction_type.access' => 'transaction_type.access',
			'transaction_types.submenu' => 'transaction_type.submenu',
			'rental_frequencies.access' => 'rental_frequency.access',
			'rental_frequency.access' => 'rental_frequency.access',
			'rental_frequencies.submenu' => 'rental_frequency.submenu',
			'rent_types.access' => 'rent_type.access',
			'rent_type.access' => 'rent_type.access',
			'rent_types.submenu' => 'rent_type.submenu',
			'feature_types.access' => 'feature_type.access',
			'feature_type.access' => 'feature_type.access',
			'feature_types.submenu' => 'feature_type.submenu',
			'mls_records.access' => 'mls.access',
			'mls.access' => 'mls.access',
			'mls_records.submenu' => 'mls.submenu',
			'favorite_listings.access' => 'favorite_listing.access',
			'favorite_listing.access' => 'favorite_listing.access',
			'favorite_listings.submenu' => 'favorite_listing.submenu',
			'images.access' => 'image.access',
			'image.access' => 'image.access');
		// loop over the $views
		foreach($viewGroups as $group => $views)
		{
			$i = 0;
			if (RealestatenowHelper::checkArray($views))
			{
				foreach($views as $view)
				{
					$add = false;
					// external views (links)
					if (strpos($view,'||') !== false)
					{
						$dwd = explode('||', $view);
						if (count($dwd) == 3)
						{
							list($type, $name, $url) = $dwd;
							$viewName 	= $name;
							$alt 		= $name;
							$url 		= $url;
							$image 		= $name.'.'.$type;
							$name 		= 'COM_REALESTATENOW_DASHBOARD_'.RealestatenowHelper::safeString($name,'U');
						}
					}
					// internal views
					elseif (strpos($view,'.') !== false)
					{
						$dwd = explode('.', $view);
						if (count($dwd) == 3)
						{
							list($type, $name, $action) = $dwd;
						}
						elseif (count($dwd) == 2)
						{
							list($type, $name) = $dwd;
							$action = false;
						}
						if ($action)
						{
							$viewName = $name;
							switch($action)
							{
								case 'add':
									$url 	= 'index.php?option=com_realestatenow&view='.$name.'&layout=edit';
									$image 	= $name.'_'.$action.'.'.$type;
									$alt 	= $name.'&nbsp;'.$action;
									$name	= 'COM_REALESTATENOW_DASHBOARD_'.RealestatenowHelper::safeString($name,'U').'_ADD';
									$add	= true;
								break;
								default:
									$url 	= 'index.php?option=com_categories&view=categories&extension=com_realestatenow.'.$name;
									$image 	= $name.'_'.$action.'.'.$type;
									$alt 	= $name.'&nbsp;'.$action;
									$name	= 'COM_REALESTATENOW_DASHBOARD_'.RealestatenowHelper::safeString($name,'U').'_'.RealestatenowHelper::safeString($action,'U');
								break;
							}
						}
						else
						{
							$viewName 	= $name;
							$alt 		= $name;
							$url 		= 'index.php?option=com_realestatenow&view='.$name;
							$image 		= $name.'.'.$type;
							$name 		= 'COM_REALESTATENOW_DASHBOARD_'.RealestatenowHelper::safeString($name,'U');
							$hover		= false;
						}
					}
					else
					{
						$viewName 	= $view;
						$alt 		= $view;
						$url 		= 'index.php?option=com_realestatenow&view='.$view;
						$image 		= $view.'.png';
						$name 		= ucwords($view).'<br /><br />';
						$hover		= false;
					}
					// first make sure the view access is set
					if (RealestatenowHelper::checkArray($viewAccess))
					{
						// setup some defaults
						$dashboard_add = false;
						$dashboard_list = false;
						$accessTo = '';
						$accessAdd = '';
						// acces checking start
						$accessCreate = (isset($viewAccess[$viewName.'.create'])) ? RealestatenowHelper::checkString($viewAccess[$viewName.'.create']):false;
						$accessAccess = (isset($viewAccess[$viewName.'.access'])) ? RealestatenowHelper::checkString($viewAccess[$viewName.'.access']):false;
						// set main controllers
						$accessDashboard_add = (isset($viewAccess[$viewName.'.dashboard_add'])) ? RealestatenowHelper::checkString($viewAccess[$viewName.'.dashboard_add']):false;
						$accessDashboard_list = (isset($viewAccess[$viewName.'.dashboard_list'])) ? RealestatenowHelper::checkString($viewAccess[$viewName.'.dashboard_list']):false;
						// check for adding access
						if ($add && $accessCreate)
						{
							$accessAdd = $viewAccess[$viewName.'.create'];
						}
						elseif ($add)
						{
							$accessAdd = 'core.create';
						}
						// check if acces to view is set
						if ($accessAccess)
						{
							$accessTo = $viewAccess[$viewName.'.access'];
						}
						// set main access controllers
						if ($accessDashboard_add)
						{
							$dashboard_add	= $user->authorise($viewAccess[$viewName.'.dashboard_add'], 'com_realestatenow');
						}
						if ($accessDashboard_list)
						{
							$dashboard_list = $user->authorise($viewAccess[$viewName.'.dashboard_list'], 'com_realestatenow');
						}
						if (RealestatenowHelper::checkString($accessAdd) && RealestatenowHelper::checkString($accessTo))
						{
							// check access
							if($user->authorise($accessAdd, 'com_realestatenow') && $user->authorise($accessTo, 'com_realestatenow') && $dashboard_add)
							{
								$icons[$group][$i]			= new StdClass;
								$icons[$group][$i]->url 	= $url;
								$icons[$group][$i]->name 	= $name;
								$icons[$group][$i]->image 	= $image;
								$icons[$group][$i]->alt 	= $alt;
							}
						}
						elseif (RealestatenowHelper::checkString($accessTo))
						{
							// check access
							if($user->authorise($accessTo, 'com_realestatenow') && $dashboard_list)
							{
								$icons[$group][$i]			= new StdClass;
								$icons[$group][$i]->url 	= $url;
								$icons[$group][$i]->name 	= $name;
								$icons[$group][$i]->image 	= $image;
								$icons[$group][$i]->alt 	= $alt;
							}
						}
						elseif (RealestatenowHelper::checkString($accessAdd))
						{
							// check access
							if($user->authorise($accessAdd, 'com_realestatenow') && $dashboard_add)
							{
								$icons[$group][$i]			= new StdClass;
								$icons[$group][$i]->url 	= $url;
								$icons[$group][$i]->name 	= $name;
								$icons[$group][$i]->image 	= $image;
								$icons[$group][$i]->alt 	= $alt;
							}
						}
						else
						{
							$icons[$group][$i]			= new StdClass;
							$icons[$group][$i]->url 	= $url;
							$icons[$group][$i]->name 	= $name;
							$icons[$group][$i]->image 	= $image;
							$icons[$group][$i]->alt 	= $alt;
						}
					}
					else
					{
						$icons[$group][$i]			= new StdClass;
						$icons[$group][$i]->url 	= $url;
						$icons[$group][$i]->name 	= $name;
						$icons[$group][$i]->image 	= $image;
						$icons[$group][$i]->alt 	= $alt;
					}
					$i++;
				}
			}
			else
			{
					$icons[$group][$i] = false;
			}
		}
		return $icons;
	}

/***[INSERTED$$$$]***//*115*/
	public function getReadme()
	{
		$document = JFactory::getDocument();
		$document->addScriptDeclaration('
		var getreadme = "'. JURI::root() . 'administrator/components/com_realestatenow/README.txt";
		jQuery(document).ready(function () {
			jQuery.get(getreadme)
			.success(function(readme) { 
				jQuery("#readme-md").html(marked(readme));
			})
			.error(function(jqXHR, textStatus, errorThrown) { 
				jQuery("#readme-md").html("'.JText::_('COM_REALESTATENOW_PLEASE_CHECK_AGAIN_LATER').'");
			});
		});');

		return '<div id="readme-md"><small>'.JText::_('COM_REALESTATENOW_THE_README_IS_LOADING').'.<span class="loading-dots">.</span></small></div>';
	}/***[/INSERTED$$$$]***/
}
