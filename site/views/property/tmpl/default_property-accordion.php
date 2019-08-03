<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_property-accordion.php
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

<div class="uk-width-1-1 uk-margin-top uk-margin-bottom">
  <?php
if ($this->params->get('property_slideshow') == 1):
  echo $this->loadTemplate('propertyslideshow');
endif;
?>
</div>
<!-- End Slideshow -->

<div class="uk-accordion" data-uk-accordion>
  <h3 class="uk-accordion-title"><?php echo JText::_('COM_REALESTATENOW_QUICK_DETAILS'); ?></h3>
  <div class="uk-accordion-content"><?php echo JLayoutHelper::render('propertyquickdetails', $this->item); ?></div>
  <h3 class="uk-accordion-title"><?php echo JText::_('COM_REALESTATENOW_FINANCIAL'); ?></h3>
  <div class="uk-accordion-content"><?php echo JLayoutHelper::render('propertypricingdetails', $this->item); ?></div>
  <h3 class="uk-accordion-title"><?php echo JText::_('COM_REALESTATENOW_OVERVIEW'); ?></h3>
  <div class="uk-accordion-content"><?php echo JLayoutHelper::render('propertyoverview', $this->item); ?></div>
  <h3 class="uk-accordion-title"><?php echo JText::_('COM_REALESTATENOW_FEATURES'); ?></h3>
  <div class="uk-accordion-content"><?php echo JLayoutHelper::render('propertyfeatures', $this->item); ?></div>
  <h3 id="mapTab" class="uk-accordion-title"><?php echo JText::_('COM_REALESTATENOW_MAP'); ?></h3>
  <div class="uk-accordion-content">
    <div id="map-area">
      <div id="map"></div>
    </div>
    <?php if($this->params->get('map_provider') == '1'):?>
    <input type="button" value="Toggle Street View" onclick="toggleStreetView();">
    </input>
    <?php endif; ?>
  </div>
  <h3 class="uk-accordion-title"><?php echo JText::_('COM_REALESTATENOW_CONTACT_AGENT'); ?></h3>
  <div class="uk-accordion-content"><?php echo JLayoutHelper::render('propertyagentcontactform', $this->items); ?></div>
</div>
<!-- END ACCORDION VIEW --> 

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
