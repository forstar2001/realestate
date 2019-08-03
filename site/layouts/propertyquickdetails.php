<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		propertyquickdetails.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('JPATH_BASE') or die('Restricted access');



?>
<div class="uk-container uk-container-center">
<div class="uk-grid" data-uk-grid-margin>
  <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
    <h3><?php echo JText::_('COM_REALESTATENOW_KEY_DETAILS'); ?></h3>
    <?php if($displayData->mls_id != ''): ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_MLS_ID'); ?>:</dt>
    <dd><?php echo $displayData->mls_id; ?></dd>
    <?php endif; ?>
<?php if (JComponentHelper::getParams('com_realestatenow')->get('adline') == 1) : ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_PROPERTY_ADLINE'); ?>:</dt>
    <dd><?php echo $displayData->name; ?></dd>
<?php endif; ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_ADDRESS'); ?>:</dt>
    <dd><?php echo $displayData->street; ?><br/>
<?php if(!empty($displayData->streettwo) ): ?>
<?php echo $displayData->streettwo; ?><br/>
<?php endif; ?>
    <?php echo $displayData->city_name.', '.$displayData->state_name.' '.$displayData->postcode; ?></h4></h4></dd>
    <?php if((int)$displayData->price != 0): ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_PRICE'); ?>:</dt>
    <dd>
      <?php if($displayData->financial_pm_price_override == 1 && (int)$displayData->financial_propmgt_price != 0 && date("Y-m-d") <= $displayData->financial_pmenddate): ?>
      <span style="color:red;text-decoration:line-through"> <span style="color:black"><?php echo '$' . number_format($displayData->price); ?></span> </span><span><?php echo '$' . number_format($displayData->financial_propmgt_price); ?></span>
      <?php else: ?>
      <span><?php echo '$' . number_format($displayData->price); ?></span>
      <?php endif; ?>
    </dd>
    <?php endif; ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_LISTING_TYPE'); ?></dt>
    <dd><?php echo $displayData->transaction_type_name; ?></dd>
<dd><?php echo $displayData->title; ?></dd>
<dd><?php echo $displayData->market_status_name; ?></dd>
    <?php if( !empty($displayData->feature_garagetype) ): ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_GARAGE_DESCRIPTION'); ?>:</dt>
    <dd><?php echo implode(',',$displayData->feature_garagetype); ?></dd>
    <?php endif; ?>
  </dl>
  <?php if((int)$displayData->bedrooms != 0 || (int)$displayData->bathrooms != 0): ?>
  <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
    <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_BASE_PROPERTY_DETAILS'); ?></h3>
    <dt><?php echo JText::_('COM_REALESTATENOW_BEDROOMS'); ?>:</dt>
    <dd><?php echo (int)$displayData->bedrooms; ?></dd>
<?php if ($displayData->bathrooms > 0) { ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_BATHROOMS'); ?>:</dt>
    <dd><?php echo (int)$displayData->bathrooms; ?></dd>
<?php } ?>
<?php if ($displayData->fullbaths > 0) { ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_FULL_BATHS'); ?>:</dt>
    <dd><?php echo (int)$displayData->fullbaths; ?></dd>
<?php } ?>
<?php if ($displayData->thqtrbaths > 0) { ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_THREEFOUR_BATHS'); ?>:</dt>
    <dd><?php echo (int)$displayData->thqtrbaths; ?></dd>
<?php } ?>
<?php if ($displayData->halfbaths > 0) { ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_ONETWO_BATHS'); ?>:</dt>
    <dd><?php echo (int)$displayData->halfbaths; ?></dd>
<?php } ?>
<?php if ($displayData->qtrbaths > 0) { ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_ONEFOUR_BATHS'); ?>:</dt>
    <dd><?php echo (int)$displayData->qtrbaths; ?></dd>
<?php } ?>
  </dl>
  <?php endif; ?>
  <?php if(!empty($displayData->feature_basementandfoundation) || !empty($displayData->residential_acrestotal) || !empty($displayData->residential_landareasqft) || !empty($displayData->feature_zoning) ): ?>
  <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
    <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_BASEMENT_AND_FOUNDATION'); ?></h3>
    <?php echo implode(',',$displayData->feature_basementandfoundation); ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_BASEMENT'); ?>:</dt>
    <dd><?php echo $displayData->feature_type_basement; ?></dd>
    <?php if($displayData->acrestotal !=''): ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_ACRES'); ?>:</dt>
    <dd><?php echo $displayData->acrestotal; ?></dd>
    <?php endif; ?>
    <?php if($displayData->landareasqft !=''): ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_LAND_SQFT'); ?>:</dt>
    <dd><?php echo $displayData->landareasqft; ?></dd>
    <?php endif; ?>
    <?php if($displayData->feature_zoning!=''): ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_ZONING'); ?>:</dt>
    <dd><<?php echo implode(',',$displayData->feature_zoning); ?></dd>
    <?php endif; ?>
  </dl>
  <?php endif; ?>
  <?php if($displayData->residential_year !='' || $displayData->feature_porchpatio !='' || $displayData->squarefeet !=''): ?>
  <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
    <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_BUILDING_INFORMATION'); ?></h3>
    <?php if($displayData->residential_year !=''): ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_YEAR_BUILT'); ?>:</dt>
    <dd><?php echo (int)$displayData->residential_year; ?></dd>
    <?php endif; ?>
    <?php if($displayData->feature_porchpatio !=''): ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_PORCHPATIO'); ?>:</dt>
    <dd><<?php echo implode(',',$displayData->feature_porchpatio); ?></dd>
    <?php endif; ?>
    <?php if($displayData->squarefeet !=''): ?>
    <dt><?php echo JText::_('COM_REALESTATENOW_FLOOR_AREA'); ?>:</dt>
    <dd><?php echo $displayData->squarefeet; ?>
      <?php if (JComponentHelper::getParams('com_realestatenow')->get('sqft_type') == 1) : ?>
      ft<sup>2</sup>
      <?php else : ?>
      m<sup>2</sup>
      <?php endif; ?>
    </dd>
    <?php endif; ?>
  </dl>
  <?php endif; ?>
  <?php if($displayData->openhouse != '0'): ?>
  <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-1">
    <?php $ohouses = $displayData->openhouseinfo; ?>
    <?php

	echo '<h3 class="tm-article-subtitle">' . JText::_('COM_REALESTATENOW_OPEN_HOUSE_DETAILS') . '</h3>';
echo '<table class="footable metro-blue" data-filter="#filter" data-page-size="5">';
echo '<thead>';
echo '<tr>';
      echo '<th data-toggle="true">' . JText::_('COM_REALESTATENOW_OPEN_HOUSE_ID') . '</th>';
      echo '<th data-hide="phone,tablet">' . JText::_('COM_REALESTATENOW_OPEN_HOUSE_START_DATE') . '</th>';
      echo '<th data-hide="phone,tablet">' . JText::_('COM_REALESTATENOW_OPEN_HOUSE_END_DATE') . '</th>';
      echo '<th data-hide="all">' . JText::_('COM_REALESTATENOW_OPEN_HOUSE_DESCRIPTION') . '</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
			foreach ($ohouses as $key => $value) {
			$d1 = date_parse(date("Y-m-d"));
			$d2 = date_parse ($value["ohend"]);
echo '<tr>';
if($d1 < $d2){
      echo '<td>' . $value["oh_id"] . '</td>';
      echo '<td>' . $value["ohstart"] . '</td>';
      echo '<td>' . $value["ohstarttime"] . '</td>';
      echo '<td>' . $value["ohend"] . '</td>';
      echo '<td>' . $value["ohendtime"] . '</td>';
      echo '<td>' . $value["ohouse_desc"] . '</td>';
}
echo '</tr>';
			}
echo '</tbody>';
echo '</table>';
			?>
  </dl>
  <?php endif; ?>
  <?php if($displayData->propdesc !=''): ?>
  <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-1">
    <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_PROPERTY_DESCRIPTION'); ?></h3>
    <dt><?php echo JText::_('COM_REALESTATENOW_ABOUT_THIS_LISTING'); ?></dt>
    <dd><?php echo $displayData->propdesc; ?></dd>
  </dl>
  <?php endif; ?>
</div>

