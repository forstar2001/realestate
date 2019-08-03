<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		category.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Realestatenow Component Category Tree
 */

// [Interpretation 10777]Insure this view category file is loaded.
$classname = 'realestatenowAgentsCategories';
if (!class_exists($classname))
{
	$path = JPATH_SITE . '/components/com_realestatenow/helpers/categoryagents.php';
	if (is_file($path))
	{
		include_once $path;
	}
}
// [Interpretation 10777]Insure this view category file is loaded.
$classname = 'realestatenowPropertiesCategories';
if (!class_exists($classname))
{
	$path = JPATH_SITE . '/components/com_realestatenow/helpers/categoryproperties.php';
	if (is_file($path))
	{
		include_once $path;
	}
}
/***[INSERTED$$$$]***//*690*/
// [Interpretation 10439]Insure this view category file is loaded.
$classname = 'realestatenowCategoryCategories';
if (!class_exists($classname))
{
    $path = JPATH_SITE . '/components/com_realestatenow/helpers/categorycategory.php';
    if (is_file($path))
    {
        include_once $path;
    }
}


/**
 * Realestatenow Agent Component Category Tree
 */
class RealestatenowCategoryHelper extends RealestatenowHelper
{
    /**
     * Class constructor
     *
     * @param   array  $options  Array of options
     *
     */
    public function __construct($options = array())
    {
        $options['table'] = '#__realestatenow_agent';
        $options['extension'] = 'com_realestatenow.agents';

        parent::__construct($options);
    }

    public static function getCategoryById( $id , $getPropertiesByCategoryId = false )
    {
        $checkValue = $id;

        // [Interpretation 2273] Get a db connection.
        $db = JFactory::getDbo();

        // [Interpretation 2275] Create a new query object.
        $query = $db->getQuery(true);

        // [Interpretation 1583] Get from #__categories as a
        $query->select($db->quoteName(
            array('a.id','a.parent_id','a.lft','a.rgt','a.level','a.title','a.alias','a.note','a.description','a.params','a.metadesc','a.metakey','a.metadata','a.hits','a.language','a.version'),
            array('id','parent_id','lft','rgt','level','title','alias','note','description','params','metadesc','metakey','metadata','hits','language','version')));
        $query->from($db->quoteName('#__categories', 'a'));
        // [Interpretation 1985] Check if JRequest::getInt('id') is a string or numeric value.

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
        // [Interpretation 2131] Get where a.published is 1
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
        {
            return [];
        }


        //set idCatidPropertyB to the $data object.
        if($getPropertiesByCategoryId)
            $data->idCatidPropertyB = self::getPropertiesByCategoryId($data->id);

        // [Interpretation 2407] return data object.
        return $data;
    }

    /**
     * Method to get an array of Property Objects.
     *
     * @return mixed  An array of Property Objects on success, false on failure.
     *
     */
    public static function getPropertiesByCategoryId($id)
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
}
/***[/INSERTED$$$$]***/
