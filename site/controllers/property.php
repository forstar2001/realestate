<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		property.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Realestatenow Property Controller
 */
/***[REPLACED$$$$]***//*699*/
class RealestatenowControllerProperty extends RealestatenowController
/***[/REPLACED$$$$]***/
{
	/**
	 * Current or most recently performed task.
	 *
	 * @var    string
	 * @since  12.2
	 * @note   Replaces _task.
	 */
	protected $task;

	public function __construct($config = array())
	{
		$this->view_list = 'properties'; // safeguard for setting the return view listing to the default site view.
		parent::__construct($config);
	}

// Site View -- Custom Buttons -- PHP (controller methods) ** Start **
        public function &getModel($name = 'Property', $prefix = 'RealestatenowModel', $config = array())
        {
            $model = parent::getModel($name, $prefix, array('ignore_request' => true));
            
            return $model;
        }
        
        /**
         * Function that allows user to save listing to favorites
         *
         * @param   JModel  &$model     The data model object.
         * @param   array   $validData  The validated data.
         *
         * @return  void
         *
         * @since   11.1
         */
        public function addToFavorites()
        {
            $app = JFactory::getApplication();
            $jinput = $app->input;
            
            //get all variables
            $propertyId =$jinput->get('propertyId', '', 'STR');
            $userId = JFactory::getUser()->id;
    
            
            if($userId == 0){
                echo "Please login to add to favorites";
                die;
            }else{
                
                // Include plugins
                JPluginHelper::importPlugin('realestatenow');
                $pluginResult = (array) $app->triggerEvent('onAddListingToFavorites', array($propertyId,$userId));
    
                 if( !( count($pluginResult) > 0) )
                     ( $pluginResult[0] = 'Unknown error occurred. Please contact your system administrator');
                JFactory::getDocument()->setMimeEncoding( 'application/json' );
                JResponse::setHeader('Content-Disposition','attachment;filename="progress-report-results.json"');
                echo $pluginResult[0];
                JFactory::getApplication()->close(); // or jexit();
            }
        }
        
        public function deleteFromFavorites(){
            $app = JFactory::getApplication();
            $jinput = $app->input;
    
            //get all variables
            $propertyId =$jinput->get('propertyId', '', 'STR');
            $userId = JFactory::getUser()->id;
    
    
            if($userId == 0){
    
                JFactory::getDocument()->setMimeEncoding( 'application/json' );
                JResponse::setHeader('Content-Disposition','attachment;filename="progress-report-results.json"');
                echo "Please login to manage favorites";
                JFactory::getApplication()->close();
                
                
            }else{
        
                // Include component plugins
                JPluginHelper::importPlugin('realestatenow');
                $pluginResult = (array) $app->triggerEvent('onDeleteListingFromFavorites', array($propertyId,$userId));
    
                JFactory::getDocument()->setMimeEncoding( 'application/json' );
                JResponse::setHeader('Content-Disposition','attachment;filename="progress-report-results.json"');
                echo $pluginResult[0]->message;
                JFactory::getApplication()->close();
                
            }
        }

// Site View -- Custom Buttons -- PHP (controller methods) ** End**

	/**
	 * Method to check if you can edit an existing record.
	 *
	 * Extended classes can override this if necessary.
	 *
	 * @param   array   $data  An array of input data.
	 * @param   string  $key   The name of the key for the primary key; default is id.
	 *
	 * @return  boolean
	 *
	 * @since   12.2
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		// to insure no other tampering
		return false;
	}

        /**
	 * Method override to check if you can add a new record.
	 *
	 * @param   array  $data  An array of input data.
	 *
	 * @return  boolean
	 *
	 * @since   1.6
	 */
	protected function allowAdd($data = array())
	{
		// to insure no other tampering
		return false;
	}

	/**
	 * Method to check if you can save a new or existing record.
	 *
	 * Extended classes can override this if necessary.
	 *
	 * @param   array   $data  An array of input data.
	 * @param   string  $key   The name of the key for the primary key.
	 *
	 * @return  boolean
	 *
	 * @since   12.2
	 */
	protected function allowSave($data, $key = 'id')
	{
		// to insure no other tampering
		return false;
	}

	/**
	 * Function that allows child controller access to model data
	 * after the data has been saved.
	 *
	 * @param   JModelLegacy  $model      The data model object.
	 * @param   array         $validData  The validated data.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	protected function postSaveHook(JModelLegacy $model, $validData = array())
	{
	}
}
