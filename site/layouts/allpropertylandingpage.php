<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		allpropertylandingpage.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('JPATH_BASE') or die('Restricted access');



?>
<div class="uk-grid uk-flex-middle" data-uk-grid-margin>
  <div class="uk-width-medium-1-3"> <a href="<?php echo 'index.php?option=com_realestatenow&view=property&id='.$displayData->id;?>">
    <?php if (JComponentHelper::getParams('com_realestatenow')->get('properties_thumb_type') == 1) : ?>
    <div class="uk-slidenav-position" data-uk-slideshow="{animation: 'scroll', autoplay:true,autoplayInterval: '3000'}">
      <ul class="uk-slideshow">
        <?php
                     if( is_array($displayData->idPropidImageJ) && ( count($displayData->idPropidImageJ) > 0 ) ):
                        foreach ($displayData->idPropidImageJ as $idPropidImageJ):
                ?>
        <li> <img class="uk-thumbnail uk-thumbnail-mini-box"
                             src="<?php echo JURI::root().$idPropidImageJ->path.$idPropidImageJ->filename.'_th.'.$idPropidImageJ->type; ?>"
                             alt=""> </li>
        <?php
                        endforeach;
                    else:
                ?>
        <div> <a href="<?php echo 'index.php?option=com_realestatenow&view=property&id='.$displayData->id;?>" title="<?php echo $displayData->name;?>" rel=""> <img class="uk-thumbnail uk-thumbnail-mini-box" src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>"> </a> </div>
        <?php
                     endif;
                ?>
      </ul>
    </div>
    <?php else: ?>
    <div class="uk-panel">
      <?php
                    if( is_array($displayData->idPropidImageJ) && ( count($displayData->idPropidImageJ) > 0 ) ):
                        $idPropidImageJ = array_shift($displayData->idPropidImageJ)
                        ?>
      <div> <img class="uk-thumbnail uk-thumbnail-mini-box"
                                   src="<?php echo JURI::root().$idPropidImageJ->path.$idPropidImageJ->filename.'_th.'.$idPropidImageJ->type; ?>"
                                   alt=""> </div>
      <?php
                    else:
                        ?>
      <div> <a href="<?php echo 'index.php?option=com_realestatenow&view=property&id='.$displayData->id;?>" title="<?php echo $displayData->name;?>" rel=""> <img class="uk-thumbnail uk-thumbnail-mini-box" src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>"> </a> </div>
      <?php
                    endif;
                ?>
    </div>
    <?php endif; ?>
    </a>
    <?php if ($displayData->featured == 1): ?>
    <div class="uk-badge uk-badge-success"><?php echo JText::_('COM_REALESTATENOW_FEATURED'); ?></div>
    <?php endif; ?>
    <?php if ($displayData->openhouse == 1): ?>
    <div class="uk-badge"><?php echo JText::_('COM_REALESTATENOW_OPEN_HOUSE'); ?></div>
    <?php endif; ?>
  </div>
  <div class="uk-width-medium-2-3 uk-flex-middle"> <a href="<?php echo 'index.php?option=com_realestatenow&view=property&id='.$displayData->id;?>" title="<?php echo $displayData->name;?>" rel="" >
    <div class="uk-clearfix\"><?php echo $displayData->street; ?> <?php echo $displayData->city_name.', '.$displayData->state_name.' '.$displayData->postcode; ?></div>
    </a>
    <div class="uk-text-small">
<?php if ($displayData->bedrooms > 0) { ?>
<span  data-uk-tooltip title="Bedrooms"><i class="uk-icon-bed" aria-hidden="true"></i><?php echo ' '.(int)$displayData->bedrooms.'  '; ?></span>
<?php } ?>
<?php if ($displayData->fullbaths > 0) { ?>
<span  data-uk-tooltip title="Full Bath"><i class="fa fa-bath" aria-hidden="true"></i><?php echo ' '.(int)$displayData->fullbaths.'  '; ?></span>
<?php } ?>
<?php if ($displayData->halfbaths > 0) { ?>
<span  data-uk-tooltip title="Half Bath"><img src="./media/com_realestatenow/images/sink.png" alt="Bathroom Sink" height="16" width="16"> <?php echo ' '.(int)$displayData->halfbaths.'  '; ?></span>
<?php } ?>
<?php if ($displayData->squarefeet > 0) { ?>
<i class="uk-icon-building" aria-hidden="true"></i><?php echo $displayData->squarefeet; ?>
    <?php if (JComponentHelper::getParams('com_realestatenow')->get('sqft_type') == 1) : ?>
    ft<sup>2</sup>
    <?php else : ?>
    m<sup>2</sup>
    <?php endif; ?>
<?php } ?>
  </div>
    <div><?php echo substr($displayData->propdesc,0,390); if(strlen($displayData->propdesc) > 390)echo '...'; ?></div>
    <div class="uk-width-1-1\">
      <?php if($displayData->pm_price_override == 1 && (int)$displayData->propmgt_price != 0 && date("Y-m-d") <= $displayData->pmenddate){?>
      <span style="color:red;text-decoration:line-through uk-text-small"> <span style='color:black'> <?php echo '$' . number_format($displayData->price); ?> </span> </span> <span class="uk-text-small"> <?php echo '$' . number_format($displayData->propmgt_price); ?> </span>
      <p class="uk-badge"><?php echo $displayData->propmgt_special; ?></p>
      <?php } else {?>
      <span class="uk-text-small" style="padding-left:2em; color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('pricecolor')); ?>; font-weight:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('priceweight')); ?>;"><?php echo '$' . number_format($displayData->price); ?></span>
      <?php } ?>
    </div>
    <div class="uk-width-1-1 uk-text-small"><?php echo JText::_('COM_REALESTATENOW_PRESENTED_BY'); ?></div>
    <div><img class="uk-thumbnail uk-thumbnail-mini-box" src="<?php echo JURI::root().$displayData->agency_image; ?>"</div>
  </div>
</div>
<style>
    .uk-thumbnail-mini-box {
        width: 75px;
    }
</style>

