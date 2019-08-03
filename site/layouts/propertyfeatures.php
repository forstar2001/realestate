<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		propertyfeatures.php
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
    <?php if($displayData->commercial_bldg_name !='' || $displayData->feature_buildingfeatures !='' || $displayData->commercial_takings !='' || $displayData->commercial_returns !='' || $displayData->commercial_netprofit !='' || $displayData->commercial_bustype !='' || $displayData->commercial_bussubtype !='' || $displayData->commercial_percentoffice !='' || $displayData->commercial_percentwarehouse !='' || $displayData->commercial_loadingfac !='' || $displayData->commercial_currentuse !='' || $displayData->commercial_carryingcap !='' || $displayData->feature_parkingdesc !=''): ?>
    <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
      <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_COMMERCIAL_FEATURES'); ?></h3>
      <?php if($displayData->commercial_bldg_name !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_BUILDING_NAME'); ?></dt>
      <dd><?php echo $displayData->commercial_bldg_name; ?></dd>
      <?php endif; ?>
      <?php if($displayData->feature_buildingfeatures !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_BUILDING_FEATURES'); ?></dt>
      <dd>
        <?php $bldgfeat = json_decode($displayData->feature_buildingfeatures, true);
			for($i=0; $i<count($bldgfeat['bldgfeattype']); $i++) {
				echo $bldgfeat['bldgfeattype'][$i] . "<BR>";
			}		
		?>
      </dd>
      <?php endif; ?>
      <?php if($displayData->commercial_takings !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_TAKINGS'); ?></dt>
      <dd><?php echo $displayData->commercial_takings; ?></dd>
      <?php endif; ?>
      <?php if($displayData->commercial_returns !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_RETURNS'); ?></dt>
      <dd><?php echo $displayData->commercial_returns; ?></dd>
      <?php endif; ?>
      <?php if($displayData->commercial_netprofit !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_NET_PROFIT'); ?></dt>
      <dd><?php echo $displayData->commercial_netprofit; ?></dd>
      <?php endif; ?>
      <?php if($displayData->commercial_bustype !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_BUSINESS_TYPE'); ?></dt>
      <dd><?php echo $displayData->commercial_bustype; ?></dd>
      <?php endif; ?>
      <?php if($displayData->commercial_bussubtype !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_BUSINESS_SUB_TYPE'); ?></dt>
      <dd><?php echo $displayData->commercial_bussubtype; ?></dd>
      <?php endif; ?>
      <?php if($displayData->commercial_percentoffice !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_PERCENT_OFFICE'); ?></dt>
      <dd><?php echo $displayData->commercial_percentoffice; ?></dd>
      <?php endif; ?>
      <?php if($displayData->commercial_percentwarehouse !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_PERCENT_WAREHOUSE'); ?></dt>
      <dd><?php echo $displayData->commercial_percentwarehouse; ?></dd>
      <?php endif; ?>
      <?php if($displayData->commercial_loadingfac !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_LOADING_FACILITY'); ?></dt>
      <dd><?php echo $displayData->commercial_loadingfac; ?></dd>
      <?php endif; ?>
      <?php if($displayData->commercial_currentuse !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_CURRENT_USE'); ?></dt>
      <dd><?php echo $displayData->commercial_currentuse; ?></dd>
      <?php endif; ?>
      <?php if($displayData->commercial_carryingcap !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_CARRYING_CAP'); ?></dt>
      <dd><?php echo $displayData->commercial_carryingcap; ?></dd>
      <?php endif; ?>
      <?php if($displayData->feature_parkingdesc !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_PARKING_DESCRIPTION'); ?></dt>
      <dd><?php echo $displayData->feature_parkingdesc; ?></dd>
      <?php endif; ?>
    </dl>
    <?php endif; ?>
    <?php if($displayData->multifamily_bldgsqft !='' || $displayData->multifamily_numunits !='' || $displayData->multifamily_unitfeatures !='' || $displayData->multifamily_commonareas !='' || $displayData->multifamily_tenancytype !='' || $displayData->multifamily_tenantpdutilities !='' || $displayData->multifamily_unitdetails !=''): ?>
    <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
      <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_MULTIFAMILY_FEATURES'); ?></h3>
      <?php if($displayData->multifamily_bldgsqft !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_BUILDING_SQFT'); ?></dt>
      <dd><?php echo $displayData->multifamily_bldgsqft; ?></dd>
      <?php endif; ?>
      <?php if($displayData->multifamily_numunits !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_NUMBER_OF_UNITS'); ?></dt>
      <dd><?php echo $displayData->multifamily_numunits; ?></dd>
      <?php endif; ?>
      <?php if($displayData->multifamily_unitfeatures !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_UNIT_FEATURES'); ?></dt>
      <dd>
        <?php $unitfeat = json_decode($displayData->multifamily_unitfeatures, true);
			for($i=0; $i<count($unitfeat['unitfeattype']); $i++) {
				echo $unitfeat['unitfeattype'][$i] . "<BR>";
			}		
		?>
      </dd>
      <?php endif; ?>
      <?php if($displayData->multifamily_commonareas !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_COMMON_AREAS'); ?></dt>
      <dd>
        <?php $commarea = json_decode($displayData->multifamily_commonareas, true);
			for($i=0; $i<count($commarea['commonareastype']); $i++) {
				echo $commarea['commonareastype'][$i] . "<BR>";
			}		
		?>
      </dd>
<?php endif; ?>
      <?php if($displayData->multifamily_tenancytype !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_TYPE_OF_TENANCY'); ?></dt>
      <dd><?php echo $displayData->multifamily_tenancytype; ?></dd>
      <?php endif; ?>
      <?php if($displayData->multifamily_tenantpdutilities !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_TENANT_PAID_UTILITIES') ?></dt>
      <dd><?php echo $displayData->multifamily_tenantpdutilities;; ?></dd>
      <?php endif; ?>
      <?php if($displayData->multifamily_commonareas !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_COMMON_AREAS'); ?></dt>
      <dd><?php echo $displayData->multifamily_commonareas; ?></dd>
      <?php endif; ?>
</dl>
    <?php endif; ?>
    <?php if($displayData->land_landtype !='' || $displayData->land_stock !='' || $displayData->land_fixtures !='' || $displayData->land_fittings !='' || $displayData->land_rainfall !='' || $displayData->land_soiltype !='' || $displayData->land_grazing !='' || $displayData->land_cropping !='' || $displayData->land_irrigation !=''): ?>
    <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
      <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_FARMRANCH_FEATURES'); ?></h3>
      <?php if($displayData->land_landtype !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_LAND_TYPE'); ?></dt>
      <dd><?php echo $displayData->land_landtype; ?></dd>
      <?php endif; ?>
      <?php if($displayData->land_stock !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_STOCK'); ?></dt>
      <dd><?php echo $displayData->land_stock; ?></dd>
      <?php endif; ?>
      <?php if($displayData->land_fixtures !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_FIXTURES'); ?></dt>
      <dd><?php echo $displayData->land_fixtures; ?></dd>
      <?php endif; ?>
      <?php if($displayData->land_fittings !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_FITTINGS'); ?></dt>
      <dd><?php echo $displayData->land_fittings; ?></dd>
      <?php endif; ?>
      <?php if($displayData->land_rainfall !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_RAINFALL'); ?></dt>
      <dd><?php echo $displayData->land_rainfall; ?></dd>
      <?php endif; ?>
      <?php if($displayData->land_soiltype !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_SOIL_TYPE'); ?></dt>
      <dd><?php echo $displayData->land_soiltype; ?></dd>
      <?php endif; ?>
      <?php if($displayData->land_grazing !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_GRAZING'); ?></dt>
      <dd><?php echo $displayData->land_grazing; ?></dd>
      <?php endif; ?>
      <?php if($displayData->land_cropping !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_CROPPING'); ?></dt>
      <dd><?php echo $displayData->land_cropping; ?></dd>
      <?php endif; ?>
      <?php if($displayData->land_irrigation !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_IRRIGATION'); ?></dt>
      <dd><?php echo $displayData->land_irrigation; ?></dd>
      <?php endif; ?>
    </dl>
    <?php endif; ?>
    <?php if($displayData->rental_rent_type !='' || $displayData->rental_offpeak !='' || $displayData->rental_freq !='' || $displayData->rental_deposit !='' || $displayData->rental_sleeps !=''): ?>
    <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
      <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_RENTAL_FEATURES'); ?></h3>
      <?php if($displayData->rental_rent_type !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_RENT_TYPE'); ?></dt>
      <dd><?php echo $displayData->rental_rent_type; ?></dd>
      <?php endif; ?>
      <?php if($displayData->rental_offpeak !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_OFF_PEAK'); ?></dt>
      <dd><?php echo $displayData->rental_offpeak; ?></dd>
      <?php endif; ?>
      <?php if($displayData->rental_freq !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_FREQUENCY'); ?></dt>
      <dd><?php echo $displayData->rental_freq; ?></dd>
      <?php endif; ?>
      <?php if($displayData->rental_deposit !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_DEPOSIT'); ?></dt>
      <dd><?php echo $displayData->rental_deposit; ?></dd>
      <?php endif; ?>
      <?php if($displayData->rental_sleeps !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_SLEEPS'); ?></dt>
      <dd><?php echo $displayData->rental_sleeps; ?></dd>
      <?php endif; ?>
    </dl>
    <?php endif; ?>
  </div>
</div>

