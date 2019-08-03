<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_agency-properties-tab.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Load JQuery Framework
JHtml::_('jquery.framework');


?>
<!-- TABBED VIEW-->

<div>
  <ul class="uk-tab" data-uk-tab="{connect:'#agency-id'}">
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_ABOUT_US'); ?></a></li>
    <li><a href="" id="mapTab"><?php echo JText::_('COM_REALESTATENOW_WHERE_ARE_WE'); ?></a></li>
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_BROWSE_OUR_LISTINGS'); ?></a></li>
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_CONTACT_US'); ?></a></li>
  </ul>
  <ul id="agency-id" class="uk-switcher uk-margin">
    <li class="uk-active"> <?php echo JLayoutHelper::render('agencyaboutlayout', $this->agent); ?></li>
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
      <h3><?php echo JText::_('COM_REALESTATENOW_BROWSE_OUR_LISTINGS'); ?></h3>
        <?php echo $this->loadTemplate('agencypropertylistings'); ?> </div>
      
      <!-- End Property listing view--> 
    </li>
    <li> 
      <!-- Agent Contact Form --> 
      <?php echo JLayoutHelper::render('agentcontact', $this->agent); ?> 
      <!-- End Agent Contact Form --> 
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
