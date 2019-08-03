<?php
    /*----------------------------------------------------------------------------------|  www.vdm.io  |----/
                    Most Wanted Web Services, Inc.
    /-------------------------------------------------------------------------------------------------------/
    
        @version		3.1.11
        @build			11th August, 2018
        @created		1st May, 2016
        @package		Real Estate NOW!
        @subpackage		image.php
        @author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>
        @copyright		Copyright (C) 2015-2018. All Rights Reserved
        @license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
        
        Real Estate NOW! Component
        
        Image Helper Class
    /------------------------------------------------------------------------------------------------------*/

// No direct access to this file
    defined('_JEXEC') or die('Restricted access');
    
    /**
     * Realestatenow Image Helper
     */
    class RealestatenowImageHelper extends RealestatenowHelper
    {
        /**
         * Class constructor
         *
         * @param   array  $options  Array of options
         *
         */
        public function __construct($options = array())
        {
        }
    
        /**
         * Method to get an array of Image Objects.
         * @param $id  The Property Id for the images to retrieve.
         * @param $events  And Array Content Plugin event signatures to run on loaded items
         * @return mixed  An array of Image Objects on success, false on failure.
         *
         */
        public static function getGetPropertyImagesByPropertyId($id, $events = [], $params = null)
        {
            //Get a db connection.
            $db = JFactory::getDbo();
        
            //Create a new query object.
            $query = $db->getQuery(true);
        
            //Get from #__realestatenow_image as j
            $query->select($db->quoteName(
                array('j.path','j.filename','j.type','j.remote','j.title','j.description'),
                array('path','filename','type','remote','title','description')));
            $query->from($db->quoteName('#__realestatenow_image', 'j'));
            $query->where('j.propid = ' . $db->quote($id));
            $query->order('j.ordering ASC');

            //Reset the query using our newly populated query object.
            $db->setQuery($query);
            $db->execute();
        
            //Check if there was data returned
            if ($db->getNumRows())
            {
                if(count($events)>0){
                    //Load the JEvent Dispatcher
                    JPluginHelper::importPlugin('content');
    
                    $items = $db->loadObjectList();
    
    
                    // [Interpretation 2830] Convert the parameter fields into objects.
                    foreach ($items as &$item)
                    {
                        // [Interpretation 1826] Make sure the content prepare plugins fire on description
                        $_description = new stdClass();
                        $_description->text =& $item->description; // [Interpretation 1828] value must be in text
        
                        foreach($events as $event){
                            JEventDispatcher::getInstance()->trigger($event['event'],$event['params']);
                        }
        
                    }
    
                    
                }
                return $items;
            }
            return false;
        }
    }
