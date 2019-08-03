<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		agentaboutlayout.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('JPATH_BASE') or die('Restricted access');



?>
<?php if (!empty($displayData->street)) { ?>
<h4><?php echo $displayData->street; ?></h4>
<h4><?php echo $displayData->city_name.', '.$displayData->state_name.' '.$displayData->postcode; ?></h4>
<?php } ?>
<h4><?php echo $displayData->agency_name; ?></h4>
<hr>
<?php if(!empty($displayData->bio)){ ?>
<h4><?php echo JText::_('COM_REALESTATENOW_ABOUT_ME'); ?></h4>
<p><?php echo $displayData->bio; ?></p>
<?php } ?>

