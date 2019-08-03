<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_property-tabbed.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<?php echo JLayoutHelper::render('propertyviewheading', $this->item); ?>

<!-- Slideshow-->

<div class="uk-width-1-1 uk-margin-top uk-marging-bottom">
  <?php
if ($this->params->get('property_slideshow') == 1):
  echo $this->loadTemplate('propertyslideshow');
endif;
?>
</div>
<!-- End Slideshow --> 

<!-- TABBED VIEW-->

<div class="uk-margin"> 
  <!-- This is the tabbed navigation containing the toggling elements -->
  <ul class="uk-tab" data-uk-tab="{connect:'#property-id'}">
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_QUICK_DETAILS'); ?></a></li>
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_FINANCIAL'); ?></a></li>
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_OVERVIEW'); ?></a></li>
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_FEATURES'); ?></a></li>
    <li><a href="" id="mapTab"><?php echo JText::_('COM_REALESTATENOW_MAP'); ?></a></li>
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_CONTACT_AGENT'); ?></a></li>
  </ul>
  
  <!-- This is the container of the content items -->
  <ul id="property-id" class="uk-switcher uk-margin">
    <li><?php echo JLayoutHelper::render('propertyquickdetails', $this->item); ?></li>
    <li><?php echo JLayoutHelper::render('propertypricingdetails', $this->item); ?></li>
    <li><?php echo JLayoutHelper::render('propertyoverview', $this->item); ?></li>
    <li><?php echo JLayoutHelper::render('propertyfeatures', $this->item); ?></li>
    <li>
      <div id="map-area">
        <div id="map"></div>
      </div>
      <?php if($this->params->get('map_provider') == '1'):?>
      <input type="button" value="Toggle Street View" onclick="toggleStreetView();">
      </input>
      <?php endif; ?>
    </li>
    <li><?php echo JLayoutHelper::render('propertyagentcontactform', $this->item); ?></li>
  </ul>
</div>
<script type="text/javascript">
    jQuery(function(){
        jQuery('#mapTab').on('click',function(){
            console.log(map);
            if(typeof map == 'undefined'){
                initMap();
            }
            
        })
    })
</script>
