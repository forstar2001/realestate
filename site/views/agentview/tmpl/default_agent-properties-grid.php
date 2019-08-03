<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_agent-properties-grid.php
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
<!-- GRID VIEW-->

<div > <?php echo JLayoutHelper::render('agentaboutlayout', $this->agent); ?>

<?php if (!empty($item->street)) { ?>
<h3><?php echo JText::_('COM_REALESTATENOW_WHERE_AM_I'); ?></h3>
<?php } ?>

  <!-- Google/Bing Maps -->
  <div id="map-area">
    <div id="map"></div>
  </div>
  <?php if($globalParams->get('map_provider') == '1'):?>
  <input type="button" value="Toggle Street View" onclick="toggleStreetView();">
  </input>
  <?php endif; ?>
  <!-- End Google/Bing Maps --> 
  
  <!-- Property listing view-->
  <h3><?php echo JText::_('COM_REALESTATENOW_BROWSE_MY_LISTINGS'); ?></h3>
  <div>
    <?php echo $this->loadTemplate('agentpropertylistings'); ?> </div>
  <!-- End Property listing view-->
  <hr/>
  <div> 
    <!-- Contact Form --> 
<?php echo $this->loadTemplate('agentcontactform'); ?>
    <!-- End Contact Form --> 
  </div>
</div>
<script type="text/javascript">
    jQuery(function(){
        initMap();
    })
</script> 

