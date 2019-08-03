<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_property-quickgrid.php
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

<!-- GRID VIEW-->

<div class="uk-margin-bottom">
  <h3><?php echo $this->item->street.' '.$this->item->streettwo.' '.$this->item->city_name.' '.$this->item->state_name.' '.$this->item->country_name; ?></h3>
  <div></div>
  <!-- Google/Bing Maps -->
  <div id="map-area">
    <div id="map"></div>
  </div>
  <?php if($this->params->get('map_provider') == '1'):?>
  <input type="button" value="Toggle Street View" onclick="toggleStreetView();">
  </input>
  <?php endif; ?>
  <!-- End Google/Bing Maps --> 
  
</div>
<!-- Key Details --> 
<?php echo JLayoutHelper::render('propertyquickdetails', $this->item); ?> 
<!-- End Key Details --> 

<!-- Property Agent Contact Form -->
<?php echo JLayoutHelper::render('propertyagentcontactform', $this->item); ?>
<!-- End Propery Agent Contact Form -->

<script type="text/javascript">
    jQuery(function(){
        initMap();
    })
</script> 

