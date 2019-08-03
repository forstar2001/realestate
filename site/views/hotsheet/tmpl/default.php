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
<form action="<?php echo JRoute::_('index.php?option=com_realestatenow'); ?>" method="post" name="adminForm" id="adminForm">
<?php echo $this->toolbar->render(); ?><?php if ($this->params->get('show_page_heading')): ?>
    <h1 class="uk-text-primary"><?php echo $heading; ?></h1>
<?php endif; ?>

<style>
    .uk-thumbnail-mini-box {
        width: 125px;
    }
</style>

<?php if ($this->params->get('hotsheet_display') == 2) : ?>
    <?php echo $this->loadTemplate('panel-layout'); ?>
<?php elseif ($this->params->get('hotsheet_display') == 3) : ?>
    <?php echo $this->loadTemplate('landing-page'); ?>
<?php else: ?>
    <?php echo $this->loadTemplate('hotsheetgridlayout'); ?>
<?php endif; ?>

<?php echo $this->loadTemplate('footer'); ?>

<?php echo $this->loadTemplate('hotsheetscripts'); ?>

<?php if (isset($this->items) && isset($this->pagination) && isset($this->pagination->pagesTotal) && $this->pagination->pagesTotal > 1): ?>
	<div class="pagination">
		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> <?php echo $this->pagination->getLimitBox(); ?></p>
		<?php endif; ?>
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>
