<?php
    
    use Joomla\CMS\MVC\Controller\BaseController;
    
    defined('_JEXEC') or die;
	require_once JPATH_COMPONENT.'/controller.php';
	
	use Joomla\CMS\Response\JsonResponse;
	
	class RealestatenowControllerCategory extends BaseController
	{
		public function getModel($name = 'Category', $prefix = 'RealestatenowModel', $config = array())
		{
			$model = parent::getModel($name, $prefix, $config);
			return $model;
		}
		
		public function display($cachable = false, $urlparams = false)
        {
            $document = \JFactory::getDocument();
            $viewType = $document->getType();
            $viewName = $this->input->get('view', "Category");
            $viewLayout = $this->input->get('layout', 'default', 'string');
    
            $view = $this->getView($viewName, $viewType, '', array('base_path' => $this->basePath, 'layout' => $viewLayout));
    
            // Get/Create the model
            if ($model = $this->getModel($viewName))
            {
                // Push the model into the view (as default)
                $view->setModel($model, true);
            }
            
            if ($categoriesModel = $this->getModel('Categories')){
                // Push the model into the view (as default)
                $view->setModel($categoriesModel, false);
            }
    
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
                    $viewResponse = $view->display();
                    $jsonResponse = new JsonResponse($viewResponse);
                    echo $jsonResponse;
                }
            }
            else
            {
                $viewResponse = $view->display();
                $jsonResponse = new JsonResponse($viewResponse);
                echo $jsonResponse;
            }
    
            return $this;
        }
		
		public function paginate()
        {
        
        }
	}
?>