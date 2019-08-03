<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_agency-properties-accordion.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- ACCORDIAN  VIEW-->

<div class="uk-accordion" data-uk-accordion>
  <h3 class="uk-accordion-title"><?php echo JText::_('COM_REALESTATENOW_ABOUT_US'); ?></h3>
  <div class="uk-accordion-content"> <?php echo JLayoutHelper::render('agencyaboutlayout', $this->agency); ?> </div>
  <h3 id="mapTab" class="uk-accordion-title"><?php echo JText::_('COM_REALESTATENOW_WHERE_ARE_WE'); ?></h3>
  <div class="uk-accordion-content">
    <div id="map-area">
      <div id="map"></div>
    </div>
    <?php if($this->params->get('map_provider') == '1'):?>
    <input type="button" value="Toggle Street View" onclick="toggleStreetView();">
    </input>
    <?php endif; ?>
  </div>
  <h3 class="uk-accordion-title"><?php echo JText::_('COM_REALESTATENOW_BROWSE_OUR_LISTINGS'); ?></h3>
  <div class="uk-accordion-content"> 
    <!-- Property listing view-->
    <h3><?php echo JText::_('COM_REALESTATENOW_BROWSE_OUR_LISTINGS'); ?></h3>
    <form name="adminForm" method="post">
      <?php echo $this->loadTemplate('agencypropertylistings'); ?>
    </form>
    <!-- End Property listing view--> 
  </div>
  <h3 class="uk-accordion-title"><?php echo JText::_('COM_REALESTATENOW_CONTACT_US'); ?></h3>
  <div class="uk-accordion-content"> 
    <!-- Agent Contact Form --> 
    <?php echo JLayoutHelper::render('agentcontact', $this->agent); ?> 
    <!-- End Agent Contact Form --> 
  </div>
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
