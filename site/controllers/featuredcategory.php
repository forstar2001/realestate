<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		featuredcategory.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/***[INSERTED$$$$]***//*650*/
USE Joomla\CMS\MVC\Controller\BaseController;
/***[/INSERTED$$$$]***/
/**
 * Realestatenow Featuredcategory Controller
 */
/***[REPLACED$$$$]***//*651*/
 class RealestatenowControllerFeaturedcategory extends BaseController
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

	    private $defaultModelName = 'Featuredcategory';
	    
		public function getModel($name = 'Featuredcategory', $prefix = 'RealestatenowModel', $config = array())
		{
			$model = parent::getModel($name, $prefix, $config);
			return $model;
		}
		
		public function display($cachable = false, $urlparams = false)
        {
            $document = \JFactory::getDocument();
            $viewType = $document->getType();
            $viewName = $this->input->get('view', "Featuredcategory");
            $viewLayout = $this->input->get('layout', 'default', 'string');
    
            $view = $this->getView($viewName, $viewType, '', array('base_path' => $this->basePath, 'layout' => $viewLayout));
    
            $view = $this->populateViewModels ( $view );
            
            $view->document = $document;
    
            // Display the view
            if ($cachable && $viewType !== 'feed' && \JFactory::getConfig()->get('caching') >= 1)
            {
                $option = $this->input->get('option');
        
                if (is_array($urlparams))
                {
                    $app = \JFactory::getApplication();
            
                    if (!empty($app->registeredurlparams))
                    {
                        $registeredurlparams = $app->registeredurlparams;
                    }
                    else
                    {
                        $registeredurlparams = new \stdClass;
                    }
            
                    foreach ($urlparams as $key => $value)
                    {
                        // Add your safe URL parameters with variable type as value {@see \JFilterInput::clean()}.
                        $registeredurlparams->$key = $value;
                    }
            
                    $app->registeredurlparams = $registeredurlparams;
                }
        
                try
                {
                    /** @var \JCacheControllerView $cache */
                    $cache = \JFactory::getCache($option, 'view');
                    $cache->get($view, 'display');
                }
                catch (\JCacheException $exception)
                {
                    $view->display();
                }
            }
            else
            {
                $view->display();
            }
    
            return $this;
        }
		
        /*
         * Populate the view models.
         */
        private function populateViewModels( $viewObject )
        {
            
            $viewObject = $this->populateViewModel($viewObject, $this->defaultModelName, true );
            $viewObject = $this->populateViewModel($viewObject,'Category',false);
            $viewObject = $this->populateViewModel($viewObject,'Categories',false);
            $viewObject = $this->populateViewModel($viewObject,'Transactiontype', false);
            $viewObject = $this->populateViewModel($viewObject,'Agents', false);
            $viewObject = $this->populateViewModel($viewObject,'Cities', false);
            $viewObject = $this->populateViewModel($viewObject,'States', false);
            
            return $viewObject;
      
        }
        
        private function populateViewModel( $viewObject, $modelNameString, $default = false, $config = [] )
        {
            if($modelObject = $this->getModel( $modelNameString, 'RealestatenowModel', $config ))
            {
                $viewObject->setModel( $modelObject, $default );
            }
            
            return $viewObject;
        }

// Site View -- Custom Buttons -- PHP (controller methods) ** End **

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
