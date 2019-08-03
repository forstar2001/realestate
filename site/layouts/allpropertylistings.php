<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		allpropertylistings.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('JPATH_BASE') or die('Restricted access');



?>
<!-- All Properties Listings Layout -- Updated 2018-09-15 -->

<div class="uk-grid uk-flex-middle" data-uk-grid-margin>
    <div class="uk-width-medium-1-5">
<?php if (JComponentHelper::getParams('com_realestatenow')->get('properties_thumb_type') == 1) : ?>
        <div class="uk-slidenav-position" data-uk-slideshow="{animation: 'scroll', autoplay:true,autoplayInterval: '3000'}">
            <ul class="uk-slideshow">
    <?php if( is_array($displayData->idPropidImageJ) && ( count($displayData->idPropidImageJ) > 0 ) ): ?>
        <?php foreach ($displayData->idPropidImageJ as $idPropidImageJ): ?>
                <li>
                    <a href="<?php echo $displayData->link; ?>" title="<?php echo $displayData->name;?>" rel="">
            <?php if ($idPropidImageJ->remote == 1 && empty($idPropidImageJ->type)): ?>
                        <img class="uk-thumbnail uk-thumbnail-medium"
                             src="<?php echo $idPropidImageJ->path.$idPropidImageJ->filename; ?>"
                             data-src="<?php echo $idPropidImageJ->path.$idPropidImageJ->filename; ?>"
                             alt="">
        <?php elseif ($idPropidImageJ->remote == 1 && !empty($idPropidImageJ->type)): ?>
                        <img class="uk-thumbnail uk-thumbnail-medium"
                             src="<?php echo $idPropidImageJ->path.$idPropidImageJ->filename.'.'.$idPropidImageJ->type; ?>"
                             data-src="<?php echo $idPropidImageJ->path.$idPropidImageJ->filename.'.'.$idPropidImageJ->type; ?>"
                             alt="">
            <?php else: ?>
                        <img class="uk-thumbnail uk-thumbnail-medium"
                             src="<?php echo JURI::root().$idPropidImageJ->path.$idPropidImageJ->filename.'_th.'.'.'.$idPropidImageJ->type; ?>"
                             data-src="<?php echo JURI::root().$idPropidImageJ->path.$idPropidImageJ->filename.'_th.'.'.'.$idPropidImageJ->type; ?>"
                             alt="">
            <?php endif ?>
                    </a>
                </li>
        <?php endforeach; ?>
    <?php else: ?>
                <li>
                    <a href="<?php echo $displayData->link; ?>" title="<?php echo $displayData->name;?>" rel="">
                        <img class="uk-thumbnail uk-thumbnail-medium"
                             src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>">
                    </a>
                </li>
    <?php endif; ?>
            </ul>
        </div>
    <?php else: ?>
        <div class="uk-panel">
    <?php if(!empty($displayData->idPropidImageJ) && is_array($displayData->idPropidImageJ) && ( count($displayData->idPropidImageJ) > 0 ) ): ?>
        <?php $idPropidImageJ = array_shift($displayData->idPropidImageJ); ?>
            <div>
        <?php if ($idPropidImageJ->remote == 1 && empty($idPropidImageJ->type)): ?>
                <img class="uk-thumbnail uk-thumbnail-medium"
                     src="<?php echo $idPropidImageJ->path.$idPropidImageJ->filename; ?>"
                     alt="">
        <?php elseif ($idPropidImageJ->remote == 1 && !empty($idPropidImageJ->type)): ?>
                        <img class="uk-thumbnail uk-thumbnail-medium"
                             src="<?php echo $idPropidImageJ->path.$idPropidImageJ->filename.'.'.$idPropidImageJ->type; ?>"
                             data-src="<?php echo $idPropidImageJ->path.$idPropidImageJ->filename.'.'.$idPropidImageJ->type; ?>"
                             alt="">
        <?php else: ?>
                <img class="uk-thumbnail uk-thumbnail-medium"
                     src="<?php echo JURI::root().$idPropidImageJ->path.$idPropidImageJ->filename.'_th.'.$idPropidImageJ->type; ?>"
                     alt="">
        <?php endif; ?>
            </div>
    <?php else: ?>
            <div>
                    <a href="<?php echo $displayData->link; ?>" title="<?php echo $displayData->name;?>" rel="">
                    <img class="uk-thumbnail uk-thumbnail-medium"
                         src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>"
                    >
                </a>
            </div>
    <?php endif; ?>
        </div>
<?php endif; ?>
<?php if ($displayData->featured == 1): ?>
        <div class="uk-badge uk-badge-success"><?php echo JText::_('COM_REALESTATENOW_FEATURED'); ?></div>
<?php endif; ?>
<?php if ($displayData->openhouse == 1): ?>
        <div class="uk-badge"><?php echo JText::_('COM_REALESTATENOW_OPEN_HOUSE'); ?></div>
<?php endif; ?>
        <?php foreach($displayData->catidIdCategoriesB as $catidIdCategoriesB ): ?>
        <div class="uk-badge"><?php echo $catidIdCategoriesB->title; ?></div>
        <?php endforeach; ?>
    </div>
    <div class="uk-width-medium-3-5 uk-flex-middle">
<?php if (JComponentHelper::getParams('com_realestatenow')->get('adline') == 1) : ?>
                    <a href="<?php echo $displayData->link; ?>" title="<?php echo $displayData->name;?>" rel="">
            <h3><?php echo $displayData->name; ?></h3>
        </a>
<?php endif; ?>
                    <a href="<?php echo $displayData->link; ?>" title="<?php echo $displayData->name;?>" rel="">
            <h4 class="uk-clearfix uk-text-nowrap">
                <?php echo $displayData->street; ?>
                <?php echo $displayData->city_name.', '.$displayData->state_name.' '.$displayData->postcode; ?>
            </h4>
        </a>
        <div>
            <?php if ($displayData->bedrooms > 0): ?>
                <span  data-uk-tooltip title="Bedrooms"><i class="uk-icon-bed" aria-hidden="true"></i><?php echo ' '.(int)$displayData->bedrooms.'  '; ?></span>
            <?php endif; ?>
            <?php if ($displayData->fullbaths > 0): ?>
                <span  data-uk-tooltip title="Full Bath"><i class="fa fa-bath" aria-hidden="true"></i><?php echo ' '.(int)$displayData->fullbaths.'  '; ?></span>
            <?php endif; ?>
            <?php if ($displayData->halfbaths > 0): ?>
                <span  data-uk-tooltip title="Half Bath">
                    <img src="<?php echo JURI::base() ?>/media/com_realestatenow/images/sink.png" alt="Bathroom Sink" height="16" width="16">
                    <?php echo ' '.(int)$displayData->halfbaths.'  '; ?>
                </span>
            <?php endif; ?>
            <?php if ($displayData->squarefeet > 0): ?>
                <i class="uk-icon-building" aria-hidden="true"></i><?php echo $displayData->squarefeet; ?>
                <?php if (JComponentHelper::getParams('com_realestatenow')->get('sqft_type') == 1) : ?>
                    ft<sup>2</sup>
                <?php else : ?>
                    m<sup>2</sup>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (JComponentHelper::getParams('com_realestatenow')->get('pricelocation') == 1) : ?>
                <?php if($displayData->financial_pm_price_override == 1 && (int)$displayData->financial_propmgt_price != 0 && date("Y-m-d") <= $displayData->financial_pmenddate): ?>
                    <span style='color:red;text-decoration:line-through'>
                        <span style='color:black'>
                            <?php echo '$' . number_format($displayData->price); ?>
                         </span>
                    </span>
                    <span class="uk-text-large">
                        <?php echo '$' . number_format($displayData->financial_propmgt_price); ?>
                    </span>
                    <p class="uk-badge"><?php echo $displayData->financial_propmgt_special; ?></p>
                <?php else: ?>
                    <span class="uk-text-large" style="padding-left:2em; color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('pricecolor')); ?>; font-weight:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('priceweight')); ?>;"><?php echo '$' . number_format($displayData->price); ?></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div><?php echo substr($displayData->propdesc,0,390).( (strlen($displayData->propdesc) > 390) ? '...' : '' ); ?></div>
    </div>
    <div class="uk-width-medium-1-5 uk-flex uk-flex-column">
        <?php if (JComponentHelper::getParams('com_realestatenow')->get('pricelocation') == 0) : ?>
            <div class="uk-width-1-1">
                <?php if($displayData->financial_pm_price_override == 1 && (int)$displayData->financial_propmgt_price != 0 && date("Y-m-d") <= $displayData->financial_pmenddate): ?>
                <span style='color:red;text-decoration:line-through'>
                    <span style='color:black'>
                        <?php echo '$' . number_format($displayData->price); ?>
                    </span>
                </span>
                <span class="uk-text-large">
                    <?php echo '$' . number_format($displayData->financial_propmgt_price); ?>
                </span>
                <p class="uk-badge"><?php echo $displayData->financial_propmgt_special; ?></p>
                <?php else: ?>
                <span class="uk-text-large" style="color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('pricecolor')); ?>; font-weight:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('priceweight')); ?>;">
                    <?php echo '$' . number_format($displayData->price); ?>
                </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if (JComponentHelper::getParams('com_realestatenow')->get('showlisted') == 1) : ?>
            <div class="uk-width-1-1 uk-vertical-align-bottom">
                <?php echo JText::_('COM_REALESTATENOW_PRESENTED_BY'); ?>
                <?php if ($displayData->agency_image !=''): ?>
                    <img class="uk-thumbnail uk-thumbnail-mini" src="<?php echo JURI::root().$displayData->agency_image; ?>">
                <?php else: ?>
                    <p><?php echo $displayData->agency_name; ?></p>
                <?php endif ?>
            </div>
        <?php endif; ?>
    </div>
</div>

