<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_featuredcategorypropertiesgrid.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- Single Featured GRID VIEW-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<h3 class="uk-article-title">
    <?php echo JText::_('COM_REALESTATENOW_FEATURED_PROPERTIES'); ?>
</h3>
<!-- Property listing view-->
<h3><?php echo JText::_('COM_REALESTATENOW_BROWSE_FEATURED_CATEGORY_LISTINGS'); ?>
    <?php echo $this->category->title; ?></h3>

<div><?php echo $this->category->description; ?> </div>

<?php if ($this->params->get('map_provider') == 2) : ?>
    <?php echo $this->loadTemplate('bingmap'); ?>
<?php elseif ($this->params->get('map_type') == 2) : ?>
    <?php echo $this->loadTemplate('gmapcluster'); ?>
<?php else: ?>
    <?php echo $this->loadTemplate('gmap'); ?>
<?php endif; ?>

<?php echo $this->loadTemplate('filters'); ?>
<?php echo $this->loadTemplate('sort-filters'); ?>

<div>
    <ul class="uk-list" id="ajaxresultdiv">
        <?php if(!empty($this->items)): ?>
            <?php foreach($this->items as $items): ?>
                <?php echo $items->html; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <li>
                <h3 class="uk-text-center"><?php echo JText::_('COM_REALESTATENOW_THERE_ARE_NO_LISTINGS_IN_THIS_CATEGORY_AT_THIS_TIME_PLEASE_CHECK_BACK'); ?></h3>
            </li>
        <?php endif; ?>
    </ul>
</div>
<div class='uk-grid'>
    <div id="wait" class="loading-overlay" style="margin: auto;width: 50%; text-align: center;">
        <div class="overlay-content">Loading.....</div>
        <p><img src="<?php echo JURI::root().'components/com_realestatenow/assets/images/loader.gif'; ?>"></p>
    </div>
</div>
<div class="uk-alert uk-alert-warning" data-uk-alert style="display:none;">
    <a href="" class="uk-alert-close uk-close" uk-close></a>
    <p><?php echo JText::_('COM_REALESTATENOW_NO_PROPERTIES_WERE_FOUND'); ?></p>
</div>

<?php echo $this->loadTemplate('pagination'); ?>
<!-- End Property listing view-->
