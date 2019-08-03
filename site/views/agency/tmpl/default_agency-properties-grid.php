<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_agency-properties-grid.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- UIKit 3 - GRID VIEW-->

<div > <?php echo JLayoutHelper::render('agencyaboutlayout', $this->agency); ?>
  <h3><?php echo JText::_('COM_REALESTATENOW_WHERE_ARE_WE'); ?></h3>
  <!-- Google/Bing Maps -->
  <div id="map-area">
    <div id="map"></div>
  </div>
  <?php if($this->params->get('map_provider') == '1'):?>
  <input type="button" value="Toggle Street View" onclick="toggleStreetView();">
  </input>
  <?php endif; ?>
  <!-- End Google/Bing Maps --> 
  <!-- Property listing view-->
  <h3><?php echo JText::_('COM_REALESTATENOW_BROWSE_OUR_LISTINGS'); ?></h3>
  <?php echo $this->loadTemplate('agencypropertylistings'); ?> 
  <!-- End Property listing view--> 
</div>
<script type="text/javascript">
    jQuery(function(){
        initMap();
    })
</script> 

