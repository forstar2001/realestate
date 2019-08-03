<?php
    /**
     * Created by PhpStorm.
     * User: Radd, Norrin
     * Date: 12/5/2017
     * Time: 10:08 PM
     */

    // No direct access to this file
    defined('_JEXEC') or die('Restricted access');
    
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'residentials.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'residential.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'land.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'lands.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'commercial.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'commercials.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'multifamily.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'multifamilies.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'feature.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'features.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'financial.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'financials.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'rental.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'rentals.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'area.php';
    require_once JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'areas.php';
    
    use Joomla\CMS\MVC\Model\ListModel;
    use Joomla\Registry\Registry;
    use Joomla\CMS\MVC\Model\BaseDatabaseModel;
    
    //use Realestatenow\Models\Property\Listingdetails\RealestatenowModelPropertyListingdetailsResidential;
    
    class RealestatenowModelPropertyListingdetails extends JModelBase
    {
        public $residential;
        public $land;
        public $commercial;
        public $multifamily;
        public $feature;
        public $financial;
        public $rental;
        public $area;
        
        private $typeCast = false;
    
        private $typeMap =[
            "residential"=> ["model"=>"residential", "collection"=>"residentials"],
            "land"  => ["model"=>"land" , "collection"=>"lands"],
            "commercial"  => ["model"=>"commercial" , "collection"=>"commercials"],
            "multifamilie"  => ["model"=>"multifamily" , "collection"=>"multifamilies"],
            "feature"  => ["model"=>"feature" , "collection"=>"features"],
            "financial"  => ["model"=>"financial" , "collection"=>"financials"],
            "rental"  => ["model"=>"rental" , "collection"=>"rentals"],
            "area"  => ["model"=>"area" , "collection"=>"areas"]
        ];
    
        public function __construct(Registry $state = NULL)
        {
            parent::__construct($state);
            $this->loadItems();
        }
    
        public function getTypeCasted($type){
            $this->typeCast = $type;
            return $this;
        }
    
        public function getForm( $type = false){
            $type = $type ? $type : $this->typeCast;
            $form = isset( $this->$type ) ? $this->$type : false;
            return $form;
            
        }
        
        private function loadItems(){
            
            foreach($this->typeMap as $type){
                
                /** @var RealestatenowModelMultifamily $Model */
                $Model =  $this->getModelInstance( $type );
            
                $this->$type['model'] = $Model->getForm();
            }
            
            return $this;
        }
    
    
        private function getModelInstance( $type ){
    
            $CollectionState = new Registry([
                "ignore_request"=>TRUE,
                'filter'=>[
                    'search'=> $this->state->get('property.id')
                ]
            ]);
    
            $typeCollection = 'Model'.ucfirst($type['collection']);
            
            /** @var ListModel $Collection */
            $CollectionModel = BaseDatabaseModel::getInstance(
                $typeCollection,'Realestatenow', $CollectionState );
            
            $Collection = $CollectionModel->getItems();
        
            $ItemId =  count($Collection) > 0 ?  array_shift($Collection)->id : 0;
            
            $typeModel = 'Model'.ucfirst($type['model']);
            
            /** @var BaseDatabaseModel $Model */
            $Model = BaseDatabaseModel::getInstance(
                $typeModel,
                'Realestatenow',
                [
                    "ignore_request"=>TRUE,
                    'state'=>new Registry([
                        $type['model']=>[
                            'id'=>$ItemId
                        ]
                    ])
                ]
            );
            
            
            return $Model;
        }
    }