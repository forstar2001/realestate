<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		route.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Realestatenow Route Helper
 **/
abstract class RealestatenowHelperRoute
{
	protected static $lookup;

	/**
	 * @param int The route of the Categories
	 */
	public static function getCategoriesRoute($id = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'categories'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=categories&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=categories';
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Category
	 */
	public static function getCategoryRoute($id = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'category'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=category&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=category';
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Cities
	 */
	public static function getCitiesRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'cities'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=cities&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=cities';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.cities');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the States
	 */
	public static function getStatesRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'states'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=states&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=states';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.states');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Countries
	 */
	public static function getCountriesRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'countries'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=countries&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=countries';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.countries');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Agencies
	 */
	public static function getAgenciesRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'agencies'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=agencies&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=agencies';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.agencies');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Agents
	 */
	public static function getAgentsRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'agents'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=agents&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=agents';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.agents');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Properties
	 */
	public static function getPropertiesRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'properties'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=properties&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=properties';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.properties');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Featured
	 */
	public static function getFeaturedRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'featured'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=featured&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=featured';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.featured');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Agency
	 */
	public static function getAgencyRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'agency'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=agency&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=agency';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.agency');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Agencyagents
	 */
	public static function getAgencyagentsRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'agencyagents'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=agencyagents&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=agencyagents';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.agencyagents');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Agentview
	 */
	public static function getAgentviewRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'agentview'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=agentview&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=agentview';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.agentview');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Agentprofile
	 */
	public static function getAgentprofileRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'agentprofile'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=agentprofile&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=agentprofile';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.agentprofile');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Country
	 */
	public static function getCountryRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'country'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=country&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=country';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.country');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the State
	 */
	public static function getStateRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'state'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=state&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=state';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.state');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the City
	 */
	public static function getCityRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'city'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=city&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=city';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.city');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Property
	 */
	public static function getPropertyRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'property'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=property&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=property';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.property');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Featuredcategory
	 */
	public static function getFeaturedcategoryRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'featuredcategory'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=featuredcategory&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=featuredcategory';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.featuredcategory');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Hotsheet
	 */
	public static function getHotsheetRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'hotsheet'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=hotsheet&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=hotsheet';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.hotsheet');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Favorites
	 */
	public static function getFavoritesRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'favorites'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=favorites&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=favorites';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.favorites');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Openhouses
	 */
	public static function getOpenhousesRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'openhouses'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=openhouses&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=openhouses';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.openhouses');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * @param int The route of the Transactiontype
	 */
	public static function getTransactiontypeRoute($id = 0, $catid = 0)
	{
		if ($id > 0)
		{
			// [Interpretation 5246] Initialize the needel array.
			$needles = array(
				'transactiontype'  => array((int) $id)
			);
			// [Interpretation 5250] Create the link
			$link = 'index.php?option=com_realestatenow&view=transactiontype&id='. $id;
		}
		else
		{
			// [Interpretation 5255] Initialize the needel array.
			$needles = array();
			// [Interpretation 5257]Create the link but don't add the id.
			$link = 'index.php?option=com_realestatenow&view=transactiontype';
		}
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('realestatenow.transactiontype');
			$category = $categories->get($catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid='.$item;
		}

		return $link;
	}

	/**
	 * Get the URL route for realestatenow category from a category ID and language
	 *
	 * @param   mixed    $catid     The id of the items's category either an integer id or a instance of JCategoryNode
	 * @param   mixed    $language  The id of the language being used.
	 *
	 * @return  string  The link to the contact
	 *
	 * @since   1.5
	 */
	public static function getCategoryRoute_keep_for_later($catid, $language = 0)
	{
		if ($catid instanceof JCategoryNode)
		{
			$id = $catid->id;			
			$category = $catid;			 
		}
		else
		{			
			throw new Exception('First parameter must be JCategoryNode');			
		}
	
		$views = array(
			"com_realestatenow.agents" => "agent",
			"com_realestatenow.properties" => "property");
		$view = $views[$category->extension];
       
		if ($id < 1 || !($category instanceof JCategoryNode))
		{
			$link = '';
		}
		else
		{
			//Create the link
			$link = 'index.php?option=com_realestatenow&view='.$view.'&category='.$category->slug;
			
			$needles = array(
					$view => array($id),
					'category' => array($id)
			);
	
			if ($language && $language != "*" && JLanguageMultilang::isEnabled())
			{
				$db		= JFactory::getDbo();
				$query	= $db->getQuery(true)
					->select('a.sef AS sef')
					->select('a.lang_code AS lang_code')
					->from('#__languages AS a');
	
				$db->setQuery($query);
				$langs = $db->loadObjectList();
				foreach ($langs as $lang)
				{
					if ($language == $lang->lang_code)
					{
						$link .= '&lang='.$lang->sef;
						$needles['language'] = $language;
					}
				}
			}
	
			if ($item = self::_findItem($needles,'category'))
			{

				$link .= '&Itemid='.$item;				
			}
			else
			{
				if ($category)
				{
					$catids = array_reverse($category->getPath());
					$needles = array(
							'category' => $catids
					);
					if ($item = self::_findItem($needles,'category'))
					{
						$link .= '&Itemid='.$item;
					}
					elseif ($item = self::_findItem(null, 'category'))
					{
						$link .= '&Itemid='.$item;
					}
				}
			}
		}
		return $link;
	}	
	
	protected static function _findItem($needles = null,$type = null)
	{
		$app      = JFactory::getApplication();
		$menus    = $app->getMenu('site');
		$language = isset($needles['language']) ? $needles['language'] : '*';

		// Prepare the reverse lookup array.
		if (!isset(self::$lookup[$language]))
		{
			self::$lookup[$language] = array();

			$component  = JComponentHelper::getComponent('com_realestatenow');

			$attributes = array('component_id');
			$values     = array($component->id);

			if ($language != '*')
			{
				$attributes[] = 'language';
				$values[]     = array($needles['language'], '*');
			}

			$items = $menus->getItems($attributes, $values);

			foreach ($items as $item)
			{
				if (isset($item->query) && isset($item->query['view']))
				{
					$view = $item->query['view'];

					if (!isset(self::$lookup[$language][$view]))
					{
						self::$lookup[$language][$view] = array();
					}

					if (isset($item->query['id']))
					{
						/**
						 * Here it will become a bit tricky
						 * language != * can override existing entries
						 * language == * cannot override existing entries
						 */
						if (!isset(self::$lookup[$language][$view][$item->query['id']]) || $item->language != '*')
						{
							self::$lookup[$language][$view][$item->query['id']] = $item->id;
						}
					}
				}
			}
		}

		if ($needles)
		{
			foreach ($needles as $view => $ids)
			{
				if (isset(self::$lookup[$language][$view]))
				{
					foreach ($ids as $id)
					{
						if (isset(self::$lookup[$language][$view][(int) $id]))
						{
							return self::$lookup[$language][$view][(int) $id];
						}
					}
				}
			}
		}
		
		if ($type)
		{
			// Check if the global menu item has been set.
			$params = JComponentHelper::getParams('com_realestatenow');
			if ($item = $params->get($type.'_menu', 0))
			{
				return $item;
			}
		}

		// Check if the active menuitem matches the requested language
		$active = $menus->getActive();

		if ($active
			&& $active->component == 'com_realestatenow'
			&& ($language == '*' || in_array($active->language, array('*', $language)) || !JLanguageMultilang::isEnabled()))
		{
			return $active->id;
		}

		// If not found, return language specific home link
		$default = $menus->getDefault($language);

		return !empty($default->id) ? $default->id : null;
	}
}
