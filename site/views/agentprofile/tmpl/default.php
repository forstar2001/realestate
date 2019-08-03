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

// Load JQuery Framework
JHtml::_('jquery.framework');

// Set Global Parameters
$globalParams = JComponentHelper::getParams('com_realestatenow');

// Set the heading of the page
$heading = ($this->params->get('page_heading')) ? $this->params->get('page_heading'):(isset($this->menu->title)) ? $this->menu->title:'';


?>
<?php echo $this->toolbar->render(); ?>
<!-- Single agent view start -->

<div class="uk-container">
    <div class="uk-block">
        <div>
            <a class="uk-button uk-width-1-1" href="<?php echo JUri::root() . 'index.php?option=com_realestatenow&view=agent&task=agent.edit&id=' . $this->item->id; ?>"><?php echo 'Edit Profile for' . ' ' . $this->item->name; ?></a>
            <h3 class="uk-article-title"><?php echo $this->item->name; ?></h3>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-3">
            <?php if (empty($this->item->image)) { ?>
                <div><img class='uk-thumbnail'
                          src="<?php echo JURI::root() . '/media/com_realestatenow/images/No_image_available.png'; ?>">
                </div>
            <?php } else { ?>
                <div><img class='uk-thumbnail' src="<?php echo $this->item->image; ?>"
                          alt="<?php echo $this->item->name; ?>"></div>
            <?php } ?>
        </div>
        <div class="uk-width-2-3">
            <?php if (!empty($this->item->phone)) { ?>
                <div><i class="uk-icon-justify uk-icon-phone"></i> <?php echo JText::_('COM_REALESTATENOW_PHONE'); ?>
                    <span><?php echo ' ' . $this->item->phone; ?></span></div>
            <?php }
            if (!empty($this->item->mobile)) { ?>
                <div><i class="uk-icon-justify uk-icon-mobile"></i> <?php echo JText::_('COM_REALESTATENOW_MOBILE'); ?>
                    <span><?php echo ' ' . $this->item->mobile; ?></span></div>
            <?php }
            if (!empty($this->item->fax)) { ?>
                <div><i class="uk-icon-justify uk-icon-fax"></i> <?php echo JText::_('COM_REALESTATENOW_FAX'); ?>
                    <span><?php echo ' ' . $this->item->fax; ?></span></div>
            <?php }
            if (!empty($this->item->website)) { ?>
                <div><i class="uk-icon-justify uk-icon-globe"></i> <?php echo JText::_('COM_REALESTATENOW_WEBSITE'); ?><span><a
                                href="<?php $this->item->website; ?>"
                                target="_blank"><?php echo ' ' . $this->item->website; ?></a></span></div>
            <?php }
            if (!empty($this->item->blog)) { ?>
                <div><i class="uk-icon-justify uk-icon-newspaper-o"></i> <?php echo JText::_('COM_REALESTATENOW_BLOG'); ?><span><a
                                href="<?php $this->item->blog; ?>"
                                target="_blank"><?php echo ' ' . $this->item->blog; ?></a></span></div>
            <?php }
            if (!empty($this->item->skype)) { ?>
                <a class="uk-icon-button uk-icon-skype" data-uk-tooltip="{pos:'top'}" title="Skype Me"
                   href="skype:<?php $this->item->skype; ?>.'?chat'"></a>
            <?php } ?>
            <?php if (!empty($this->item->fbook)) { ?>
                <a class="uk-icon-button uk-icon-facebook" data-uk-tooltip="{pos:'top'}" title="Facebook"
                   href="//facebook.com/<?php echo $this->item->fbook; ?>" target="_blank"></a>
            <?php }
            if (!empty($this->item->pinterest)) { ?>
                <a class="uk-icon-button uk-icon-pinterest" data-uk-tooltip="{pos:'top'}" title="Pinterest"
                   href="//pinterest.com/<?php echo $this->item->pinterest; ?>" target="_blank"></a>
            <?php }
            if (!empty($this->item->gplus)) { ?>
                <a class="uk-icon-button uk-icon-google-plus" data-uk-tooltip="{pos:'top'}" title="Google+"
                   href="//google.com/+<?php echo $this->item->gplus; ?>" target="_blank"></a>
            <?php }
            if (!empty($this->item->twitter)) { ?>
                <a class="uk-icon-button uk-icon-twitter" data-uk-tooltip="{pos:'top'}" title="Twitter"
                   href="//twitter.com/<?php echo $this->item->twitter; ?>" target="_blank"></a>
            <?php }
            if (!empty($this->item->youtube)) { ?>
                <a class="uk-icon-button uk-icon-youtube" data-uk-tooltip="{pos:'top'}" title="YouTube"
                   href="//youtube.com/<?php echo $this->item->youtube; ?>" target="_blank"></a>
            <?php }
            if (!empty($this->item->linkedin)) { ?>
                <a class="uk-icon-button uk-icon-linkedin-square" data-uk-tooltip="{pos:'top'}" title="LinkedIn"
                   href="//linkedin.com/<?php echo $this->item->linkedin; ?>" target="_blank"></a>
            <?php } ?>
        </div>
        <div></div>
    </div>

<!--[INSERTED$$$$]--><!--609-->
<?php if ($this->params->get('show_footer') == 1): ?>
<div class="uk-alert uk-alert-primary uk-container uk-text-center">Powered by <a href="https://realestatesitesnow.com" target="_blank">Real Estate NOW!</a><br>Listing data processed by <a href="https://mostwantedwebhosting.com/ipals">iPALS (Internet Properties All Listings Software</a></div>
<?php endif; ?>
<!--[/INSERTED$$$$]-->
</div>
<!-- Single agent view end -->

