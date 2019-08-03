<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_statepropertylistings.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="uk-grid">
  <?php foreach ($this->items as $item): ?>
	<div class="uk-width-1-5"><div class="uk-panel uk-panel-box">
  <a href="<?php echo 'index.php?option=com_realestatenow&view=property&id='.$item->id;?>">
    <?php if ($this->params->get('agent_thumb_type') == 1) : ?>
    <div class="uk-slidenav-position" data-uk-slideshow="{animation: 'scroll', autoplay:true,autoplayInterval: '3000'}">
      <ul class="uk-slideshow">
        <?php
                     if( is_array($item->idPropidImageH) && ( count($item->idPropidImageH) > 0 ) ):
                        foreach ($item->idPropidImageH as $idPropidImageH):
                ?>
        <li>
          <?php if ($idPropidImageH->remote == 1): ?>
          <img class="uk-thumbnail uk-thumbnail-medium"
                                   src="<?php echo $idPropidImageH->path.$idPropidImageH->filename; ?>"
                                   alt="">
          <?php else: ?>
          <img class="uk-thumbnail uk-thumbnail-medium"
                             src="<?php echo JURI::root().$idPropidImageH->path.$idPropidImageH->filename.'_th.'.'.'.$idPropidImageH->type; ?>"
                             alt="">
          <?php endif ?>
        </li>
        <?php
                        endforeach;
                    else:
                ?>
        <div> <a href="<?php echo 'index.php?option=com_realestatenow&view=property&id='.$item->id;?>" title="<?php echo $item->name;?>" rel=""> <img class="uk-thumbnail uk-thumbnail-medium" src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>"> </a> </div>
        <?php
                     endif;
                ?>
      </ul>
    </div>
    <?php else: ?>
    <div class="uk-panel">
      <?php
                    if( is_array($item->idPropidImageH) && ( count($item->idPropidImageH) > 0 ) ):
                        $idPropidImageH = array_shift($item->idPropidImageH)
                        ?>
      <div>
        <?php if ($idPropidImageH->remote == 1): ?>
        <img class="uk-thumbnail uk-thumbnail-medium"
                                   src="<?php echo $idPropidImageH->path.$idPropidImageH->filename; ?>"
                                   alt="">
        <?php else: ?>
        <img class="uk-thumbnail uk-thumbnail-medium"
                                   src="<?php echo JURI::root().$idPropidImageH->path.$idPropidImageH->filename.'.'.$idPropidImageH->type; ?>"
                                   alt="">
        <?php endif ?>
      </div>
      <?php
                    else:
                        ?>
      <div> <a href="<?php echo 'index.php?option=com_realestatenow&view=property&id='.$item->id;?>" title="<?php echo $item->name;?>" rel=""> <img class="uk-thumbnail uk-thumbnail-medium" src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>"> </a> </div>
      <?php
                    endif;
                ?>
    </div>
    <?php endif; ?>
    </a>
    <?php if ($item->featured == 1): ?>
    <div class="uk-badge uk-badge-success"><?php echo JText::_('COM_REALESTATENOW_FEATURED'); ?></div>
    <?php endif; ?>
    <?php if ($item->openhouse == 1): ?>
    <div class="uk-badge"><?php echo JText::_('COM_REALESTATENOW_OPEN_HOUSE'); ?></div>
    <?php endif; ?>
	</div></div>

	<div class="uk-width-3-5"><div class="uk-panel uk-panel-box">
<?php if ($this->params->get('adline') == 1) : ?>
<a href="<?php echo 'index.php?option=com_realestatenow&view=property&id='.$item->id;?>" title="<?php echo $item->name;?>" rel="" >
    <h3><?php echo $item->name; ?></h3>
    </a>
<?php endif; ?>
<a href="<?php echo 'index.php?option=com_realestatenow&view=property&id='.$item->id;?>" title="<?php echo $item->name;?>" rel="" >
    <h5 class="uk-clearfix"><?php echo $item->street; ?> <?php echo $item->city_name.', '.$item->state_name.' '.$item->postcode; ?></h5>
</a>
    <div>
<?php if ($item->bedrooms > 0) { ?>
<span  data-uk-tooltip title="Bedrooms"><i class="uk-icon-bed" aria-hidden="true"></i><?php echo ' '.(int)$item->bedrooms.'  '; ?></span>
<?php } ?>
<?php if ($item->fullbaths > 0) { ?>
<span data-uk-tooltip title="Full Baths></i><?php echo ' '.(int)$item->fullbaths.'  '; ?></span>
<?php } ?>
<?php if ($item->halfbaths > 0) { ?>
<span  data-uk-tooltip title="Half Bath"><img src="./media/com_realestatenow/images/sink.png" alt="Bathroom Sink" height="16" width="16"> <?php echo ' '.(int)$item->halfbaths.'  '; ?></span>
<?php } ?>
<?php if ($item->squarefeet > 0) { ?>
<i class="uk-icon-building" aria-hidden="true"></i><?php echo $item->squarefeet; ?>
      <?php if ($this->params->get('sqft_type') == 1) : ?>
      ft<sup>2</sup>
      <?php else : ?>
      m<sup>2</sup>
      <?php endif; ?>
<?php } ?>
    </div>
    <div><?php echo substr($item->propdesc,0,390); if(strlen($item->propdesc) > 390)echo '...'; ?></div>
</div>
</div>
  <div class="uk-width-medium-1-5">
    <?php if($item->financial_pm_price_override == 1 && (int)$item->financial_propmgt_price != 0 && date("Y-m-d") <= $item->financial_pmenddate){?>
    <span style='color:red;text-decoration:line-through'> <span style='color:black'> <?php echo '$' . number_format($item->price); ?> </span> </span> <span class="uk-text-large"> <?php echo '$' . number_format($item->financial_propmgt_price); ?> </span>
    <p class="uk-badge"><?php echo $item->financial_propmgt_special; ?></p>
    <?php } else {?>
    <span class="uk-text-large"><?php echo '$' . number_format($item->price); ?></span>
    <?php } ?>
    <div class="uk-width-1-1 uk-vertical-align-bottom"> <?php echo JText::_('COM_REALESTATENOW_PRESENTED_BY'); ?>
      <?php if ($item->agency_image !=''): ?>
      <img class="uk-thumbnail uk-thumbnail-mini" src="<?php echo JURI::root().$item->agency_image; ?>">
      <?php else: ?>
      <p><?php echo $item->agency_name; ?></p>
      <?php endif ?>
    </div>
  </div>

	<?php endforeach; ?>
</div>

