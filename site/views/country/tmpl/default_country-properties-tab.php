<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_country-properties-tab.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- TABBED VIEW-->

<div>
  <ul class="uk-tab" data-uk-tab="{connect:'#country-id'}">
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_ABOUT'); ?></a></li>
    <li><a href="" id="mapTab"><?php echo JText::_('COM_REALESTATENOW_MAP'); ?></a></li>
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_BROWSE_LISTINGS'); ?></a></li>
  </ul>
  <ul id="country-id" class="uk-switcher uk-margin">
    <li class="uk-active"><?php echo JLayoutHelper::render('countryaboutlayout', $this->country); ?></li>
    <li>
      <div id="map-area">
        <div id="map"></div>
      </div>
      <?php if($this->params->get('map_provider') == '1'):?>
      <input type="button" value="Toggle Street View" onclick="toggleStreetView();">
      </input>
      <?php endif; ?>
    </li>
    <li> 
      <!-- Property listing view-->
      <h3><?php echo JText::_('COM_REALESTATENOW_BROWSE_LISTINGS'); ?></h3>
      <div>
        <div class='uk-form-row'>
          <div><?php echo $this->loadTemplate('country-filters'); ?></div>
          <div> </div>
        </div>
        <?php echo $this->loadTemplate('countrypropertylistings'); ?> </div>
      
      <!-- End Property listing view--> 
    </li>
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
