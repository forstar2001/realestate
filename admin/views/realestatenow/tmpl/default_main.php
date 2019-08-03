<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_main.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<?php if(isset($this->icons['main']) && is_array($this->icons['main'])) :?>
	<?php foreach($this->icons['main'] as $icon): ?>
		<div class="dashboard-wraper">
			<div class="dashboard-content"> 
				<a class="icon" href="<?php echo $icon->url; ?>">
					<img alt="<?php echo $icon->alt; ?>" src="components/com_realestatenow/assets/images/icons/<?php  echo $icon->image; ?>">
					<span class="dashboard-title"><?php echo JText::_($icon->name); ?></span>
				</a>
			 </div>
		</div>
	<?php endforeach; ?>
	<div class="clearfix"></div>
<?php else: ?>
	<div class="alert alert-error"><h4 class="alert-heading"><?php echo JText::_("Permission denied, or not correctly set"); ?></h4><div class="alert-message"><?php echo JText::_("Please notify your System Administrator if result is unexpected."); ?></div></div>
<?php endif; ?>