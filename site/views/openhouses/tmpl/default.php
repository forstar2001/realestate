<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Set the heading of the page
$heading = ($this->params->get('page_heading')) ? $this->params->get('page_heading'):(isset($this->menu->title)) ? $this->menu->title:'';


?>
<?php echo $this->toolbar->render(); ?>
<?php if ($this->params->get('show_page_heading')): ?>
    <h1 class="uk-text-primary"><?php echo $heading; ?></h1>
<?php endif; ?>

<style>
    .uk-thumbnail-mini-box {
        width: 125px;
    }
</style>

<?php if ($this->params->get('openhouse_display') == 2) : ?>
    <?php echo $this->loadTemplate('panel-layout'); ?>
<?php elseif ($this->params->get('openhouse_display') == 3) : ?>
    <?php echo $this->loadTemplate('landing-page'); ?>
<?php else: ?>
    <?php echo $this->loadTemplate('openhousesgridlayout'); ?>
<?php endif; ?>

<?php echo $this->loadTemplate('footer'); ?>

<?php echo $this->loadTemplate('openhousesscripts'); ?>
