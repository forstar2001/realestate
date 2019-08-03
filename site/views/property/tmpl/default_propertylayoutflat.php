<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_propertylayoutflat.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- Remove when done. Template based on http://www.realtor.com/realestateandhomes-detail/1015-Hauser-Blvd_Helena_MT_59601_M83583-39817 -->

<!-- Slideshow-->

<div class="uk-grid uk-flex-middle" data-uk-grid-margin>
<div class="uk-width-medium-2-3"> <?php echo 'Presented by'.' '.'<b>'.$this->item->agent_name.'</b>'.' '.'with'.' '.'<b>'.$this->item->agency_name.'</b>'; ?> <?php echo $this->loadTemplate('propertyslideshow'); ?> </div>
<!-- End Slideshow --> 
<!-- Agent Contact Form -->
<div class="uk-width-medium-1-3 uk-flex-middle"> <?php echo JLayoutHelper::render('propertyagentcontactformcondensed', $this->item); ?> </div>
<!-- End Agent Contact Form --> 

<!-- Property View -->
<div class="uk-grid uk-flex-middle" data-uk-grid-margin>
  <div class="uk-width-medium-1-2">
    <ul class="uk-grid uk-grid-width-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-5">
      <li> <img class="uk-thumbnail uk-thumbnail-mini" src="<?php echo JURI::root().'components/com_realestatenow/assets/images/Google-Maps-icon.png'; ?>"alt=""> </li>
      <li><?php echo '<b>'.$this->item->bedrooms.'</b> '.JText::_('COM_REALESTATENOW_BEDS'); ?></li>
      <li><?php echo '<b>'.$this->item->fullbaths.'</b> '.JText::_('COM_REALESTATENOW_FULL').', <b>'.$this->item->qtrbaths.'</b> '.JText::_('COM_REALESTATENOW_ONEFOUR_BATHS').', <b>'.$this->item->halfbaths.'</b> '.JText::_('COM_REALESTATENOW_ONETWO_BATHS').', <b>'.$this->item->thqtrbaths.'</b> '.JText::_('COM_REALESTATENOW_THREEFOUR_BATHS'); ?></li>
      <li><?php echo '<b>'.$this->item->squarefeet.'</b> '.JText::_('COM_REALESTATENOW_SQFT'); ?></li>
      <li><?php echo '<b>'.$this->item->landareasqft.'</b> '.'sq ft lot'.', <b>'.$this->item->acrestotal.'</b> '.'acres'.', <b>'.$this->item->lotdimensions.'</b> '.'lot dimensions'; ?></li>
    </ul>
    <div><?php echo '<b>'.$this->item->street.'</b> '.$this->item->city_name.', '.$this->item->state_name.' '.$this->item->postcode; ?></div>
  </div>
  <div class="uk-width-medium-1-3">
    <div class="uk-flex uk-flex-column">
      <?php if($this->item->pm_price_override == 1 && (int)$this->item->propmgt_price != 0){?>
      <div class="uk-width-1-2 uk-panel uk-panel-box"> <span style='color:red;text-decoration:line-through'> <span style='color:black'> <?php echo '$' . number_format($this->item->price); ?> </span> </span> <span class="uk-text-large"> <?php echo '$' . number_format($this->item->propmgt_price); ?> </span>
        <div class="uk-badge"><?php echo $this->item->propmgt_special; ?></div>
      </div>
      <?php } else {?>
      <div class="uk-width-1-2 uk-panel uk-panel-box uk-margin-bottom"> <span class="uk-text-large"><?php echo '$' . number_format($this->item->price); ?></span> </div>
      <?php } ?>
    </div>
  </div>
</div>
<hr>
<div class="uk-grid uk-flex-middle" data-uk-grid-margin>
  <div class="uk-width-1-1">
    <h3>Open House</h3>
    <hr>
    <?php if($this->item->openhouse != '1'): ?>
    <h4><?php echo JText::_('COM_REALESTATENOW_THERE_ARE_NO_OPEN_HOUSES_AT_THIS_TIME'); ?></h4>
    <?php else: ?>
    <table class="uk-table uk-table-hover uk-table-striped">
      <thead>
        <tr>
          <th class="uk-width-1-10" data-hide="phone,tablet"><?php echo JText::_('COM_REALESTATENOW_START_DATE'); ?></th>
          <th class="uk-width-1-10" data-hide="phone,tablet"><?php echo JText::_('COM_REALESTATENOW_END_DATE'); ?></th>
          <th class="uk-width-1-10" data-hide="phone,tablet"><?php echo JText::_('COM_REALESTATENOW_DESCRIPTION'); ?></th>
        </tr>
      </thead>
      <?php $openhouseinfo = json_decode($this->item->openhouseinfo); 
                            $count = count($openhouseinfo->oh_id);
                            if($count >=1){ 
                                for($i=0;$i<$count;$i++){
                                ?>
      <tbody>
        <tr>
          <?php if($openhouseinfo->ohstart[$i] != ''){?>
          <td><?php echo $openhouseinfo->ohstart[$i]; ?></td>
          <?php }?>
          <?php if($openhouseinfo->ohstarttime[$i] != ''){?>
          <td><?php echo $openhouseinfo->ohstarttime[$i]; ?></td>
          <?php }?>
          <?php if($openhouseinfo->ohend[$i] != ''){?>
          <td><?php echo $openhouseinfo->ohend[$i]; ?></td>
          <?php }?>
          <?php if($openhouseinfo->ohendtime[$i] != ''){?>
          <td><?php echo $openhouseinfo->ohendtime[$i]; ?></td>
          <?php }?>
          <?php if($openhouseinfo->ohouse_desc[$i] != ''){?>
          <td><?php echo $openhouseinfo->ohouse_desc[$i]; ?></td>
          <?php }?>
        </tr>
        <?php if($displayData->openhouse != '0'){ ?>
      <div> </div>
      <?php } ?>
        </tbody>
      
      <?php } } ?>
    </table>
    <?php endif; ?>
  </div>
</div>
<div class="uk-grid uk-flex-middle" data-uk-grid-margin>
  <h3><?php echo 'Property Details for'.' '.$this->item->street; ?></h3>
</div>
<div class="tm-main uk-width-medium-1-1">
  <article class="uk-article">
    <hr class="uk-article-divider">
    <div class="uk-grid" data-uk-grid-margin>
      <div class="uk-width-medium-1-5">
        <div class="uk-panel uk-panel-box">
          <h3 class="uk-panel-title uk-text-center"><i class="uk-icon-large uk-icon-bookmark"></i><?php echo JText::_('COM_REALESTATENOW_STATUS'); ?></h3>
          <h4><?php echo $this->item->market_status_name; ?></h4>
        </div>
      </div>
      <div class="uk-width-medium-1-5">
        <div class="uk-panel uk-panel-box">
          <h3 class="uk-panel-title uk-text-center"><i class="uk-icon-large uk-icon-bookmark"></i><?php echo JText::_('COM_REALESTATENOW_PRICESQ_FT'); ?></h3>
          <?php
										 $x = $this->item->price;
										 $y = $this->item->squarefeet;
										 
										echo '<b>$' . number_format($x / $y).'</b>';
										?>
        </div>
      </div>
      <div class="uk-width-medium-1-5">
        <div class="uk-panel uk-panel-box">
          <h3 class="uk-panel-title uk-text-center"><i class="uk-icon-large uk-icon-bookmark"></i><?php echo JText::_('COM_REALESTATENOW_LISTED'); ?></h3>
          <h4><?php echo $this->item->created; ?></h4>
        </div>
      </div>
      <div class="uk-width-medium-1-5">
        <div class="uk-panel uk-panel-box">
          <h3 class="uk-panel-title uk-text-center"><i class="uk-icon-large uk-icon-bookmark"></i><?php echo JText::_('COM_REALESTATENOW_BUILT'); ?></h3>
          <?php if (empty($this->item->year)): ?>
          <h4><?php echo JText::_('COM_REALESTATENOW_UNKNOWN'); ?></h4>
          <?php else: ?>
          <h4><?php echo $this->item->year; ?></h4>
          <?php endif; ?>
        </div>
      </div>
      <div class="uk-width-medium-1-5">
        <div class="uk-panel uk-panel-box">
          <h3 class="uk-panel-title uk-text-center"><i class="uk-icon-large uk-icon-bookmark"></i> Type</h3>
          <h4><?php echo $this->item->title; ?></h4>
        </div>
      </div>
    </div>
  </article>
</div>

<!-- End Property View --> 

