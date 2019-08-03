<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		propertypricingdetails.php
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
    <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-1">
      <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_PRICING_DETAILS'); ?></h3>
      <?php if($displayData->financial_pm_price_override =='0' || date("Y-m-d") >= $displayData->financial_pmenddate): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_LISTING_PRICE'); ?></dt>
      <dd><?php echo '$' . number_format($displayData->price); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->financial_annualinsurance !='0.00'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_ANNUAL_INSURANCE'); ?></dt>
      <dd><?php echo '$' . number_format($displayData->financial_annualinsurance); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->financial_taxannual !='0.00'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_ANNUAL_TAX'); ?></dt>
      <dd><?php echo '$' . number_format($displayData->financial_taxannual); ?></dd>
      <?php endif; ?>
      <?php if($displayData->financial_taxyear !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_TAX_YEAR'); ?></dt>
      <dd><?php echo $displayData->financial_taxyear; ?></dd>
      <?php endif; ?>
      <?php if($displayData->financial_utilities !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_UTILITIES'); ?></dt>
      <dd><?php echo '$' . number_format($displayData->financial_utilities); ?></dd>
      <?php endif; ?>
      <?php if($displayData->financial_electricservice !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_ELECTRIC_SERVICE'); ?></dt>
      <dd><?php echo '$' . number_format($displayData->financial_electricservice); ?></dd>
      <?php endif; ?>
      <?php if($displayData->financial_averageutilelec !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_AVERAGE_ELECTRIC'); ?></dt>
      <dd><?php echo '$' . number_format($displayData->financial_averageutilelec); ?></dd>
      <?php endif; ?>
      <?php if($displayData->financial_averageutilgas !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_AVERAGE_GAS'); ?></dt>
      <dd><?php echo '$' . number_format($displayData->financial_averageutilelec); ?></dd>
      <?php endif; ?>
      <?php if($displayData->financial_terms !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_TERMS'); ?></dt>
      <dd><?php echo $displayData->financial_terms; ?></dd>
      <?php endif; ?>
      <?php if($displayData->financial_pm_price_override !='0' && (int)$displayData->financial_propmgt_price != 0 && date("Y-m-d") <= $displayData->financial_pmenddate): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_OVERRIDE_START_DATE'); ?></dt>
      <dd><?php echo $displayData->financial_pmstartdate; ?></dd>
      <dt><?php echo JText::_('COM_REALESTATENOW_OVERRIDE_END_DATE'); ?></dt>
      <dd><?php echo $displayData->financial_pmenddate; ?></dd>
      <dt><?php echo JText::_('COM_REALESTATENOW_SPECIAL_PRICE'); ?></dt>
      <dd><?php echo '$' . number_format($displayData->financial_propmgt_price); ?></dd>
      <dt><?php echo JText::_('COM_REALESTATENOW_SPECIAL_DESCRIPTION'); ?></dt>
      <dd><?php echo $displayData->financial_propmgt_description; ?></dd>
      <?php endif; ?>
      <?php if($displayData->financial_viewbooking =='1'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_VIEW_BOOKING_AVAILABLE_DATE'); ?></dt>
      <dd><?php echo $displayData->financial_availdate; ?></dd>
      <?php endif; ?>
    </dl>
  </div>
</div>

