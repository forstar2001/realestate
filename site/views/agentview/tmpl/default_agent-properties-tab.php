<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_agent-properties-tab.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Load JQuery Framework
JHtml::_('jquery.framework');

// Set Global Parameters
$globalParams = JComponentHelper::getParams('com_realestatenow');


?>
<!-- TABBED VIEW-->

<div>
  <ul class="uk-tab" data-uk-tab="{connect:'#agt-id'}">
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_ABOUT_ME'); ?></a></li>
<?php if (!empty($item->street)) { ?>
    <li><a href="" id="mapTab"><?php echo JText::_('COM_REALESTATENOW_WHERE_AM_I'); ?></a></li>
<?php } ?>
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_BROWSE_MY_LISTINGS'); ?></a></li>
    <li><a href=""><?php echo JText::_('COM_REALESTATENOW_CONTACT_ME'); ?></a></li>
  </ul>
  <ul id="agt-id" class="uk-switcher uk-margin">
    <li class="uk-active"> <?php echo JLayoutHelper::render('agentaboutlayout', $this->agent); ?></li>
<?php if (!empty($item->street)) { ?>
    <li>
      <div id="map-area">
        <div id="map"></div>
      </div>
      <?php if($globalParams->get('map_provider') == '1'):?>
      <input type="button" value="Toggle Street View" onclick="toggleStreetView();">
      </input>
      <?php endif; ?>
    </li>
<?php } ?>
    <li> 
      <!-- Property listing view-->
      <h3><?php echo JText::_('COM_REALESTATENOW_BROWSE_MY_LISTINGS'); ?></h3>
      <div>
        <?php echo $this->loadTemplate('agentpropertylistings'); ?> </div>
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
