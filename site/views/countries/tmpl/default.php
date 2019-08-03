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
<?php echo $this->toolbar->render(); ?><!-- UIKit 3 Code -->

<?php if ($this->params->get('show_page_heading')): ?>

    <h1 class="uk-text-primary"><?php echo $heading; ?></h1>
<?php endif; ?>
<?php if ($this->items): ?>
    <?php if ($this->params->get('countries_display') == 2) : ?>
        <?php echo $this->loadTemplate('countries-panel'); ?>
    <?php else: ?>
        <?php echo $this->loadTemplate('countries-grid'); ?>
    <?php endif; ?>
<?php else: ?>
    <div class="uk-alert-warning" uk-alert><a href="" class="uk-alert-close" uk-close></a>
        <p><?php echo JText::_('COM_REALESTATENOW_NO_COUNTRIES_WERE_FOUND'); ?></p>
    </div>
<?php endif; ?>

<!--[INSERTED$$$$]--><!--609-->
<?php if ($this->params->get('show_footer') == 1): ?>
<div class="uk-alert uk-alert-primary uk-container uk-text-center">Powered by <a href="https://realestatesitesnow.com" target="_blank">Real Estate NOW!</a><br>Listing data processed by <a href="https://mostwantedwebhosting.com/ipals">iPALS (Internet Properties All Listings Software</a></div>
<?php endif; ?>
<!--[/INSERTED$$$$]-->


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
