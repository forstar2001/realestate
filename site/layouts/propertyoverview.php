<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		propertyoverview.php
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
    <?php if($displayData->residential_yearremodeled !='' || $displayData->style !='' || $displayData->residential_houseconstruction !='' || $displayData->feature_exteriorfinish !='' || $displayData->feature_roof !='' || $displayData->residential_flooring !='' || $displayData->feature_frontage !='' || (int)$displayData->residential_waterfront !='0'): ?>
    <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
      <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_PROPERTY_FEATURES'); ?></h3>
      <?php if($displayData->residential_yearremodeled !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_YEAR_REMODELED'); ?></dt>
      <dd><?php echo $displayData->residential_yearremodeled; ?></dd>
      <?php endif; ?>
      <?php if($displayData->style!=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_STYLE'); ?></dt>
      <dd><?php echo $displayData->feature_type_style; ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_houseconstruction !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_HOUSE_CONSTRUCTION'); ?></dt>
      <dd><?php echo $displayData->residential_houseconstruction; ?></dd>
      <?php endif; ?>
      <?php if($displayData->feature_exteriorfinish !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_EXTERIOR_FINISH'); ?></dt>
      <dd><?php echo implode(',',$displayData->feature_exteriorfinish); ?></dd>
      <?php endif; ?>
      <?php if($displayData->feature_roof !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_ROOF'); ?></dt>
      <dd><?php echo implode(',',$displayData->feature_roof); ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_flooring !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_FLOORING'); ?></dt>
      <dd><?php echo $displayData->residential_flooring; ?></dd>
      <?php endif; ?>
      <?php if($displayData->feature_frontage !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_ROAD_FRONTAGE'); ?></dt>
      <dd><?php echo implode(',',$displayData->feature_frontage); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->residential_waterfront !='0'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_WATERFRONTLAKERIVER'); ?></dt>
<?php echo $displayData->residential_waterfronttype; ?>
      <?php endif; ?>
    </dl>
    <?php endif; ?>
    <?php if($displayData->residential_welldepth !='' || $displayData->residential_subdivision !='' || $displayData->residential_totalrooms !='' || $displayData->residential_otherrooms !='' || $displayData->residential_livingarea !='' || (int)$displayData->residential_ensuite !='0' || $displayData->feature_parkingspaces !='' || (int)$displayData->residential_stories !='0'): ?>
    <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
      <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_PROPERTY_FEATURES'); ?></h3>
      <?php if($displayData->residential_welldepth !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_WELL_DEPTH'); ?></dt>
      <dd><?php echo $displayData->residential_welldepth; ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_subdivision !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_SUBDIVISION'); ?></dt>
      <dd><?php echo $displayData->residential_subdivision; ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_totalrooms !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_TOTAL_ROOMS'); ?></dt>
      <dd><?php echo $displayData->residential_totalrooms; ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_otherrooms !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_OTHER_ROOMS'); ?></dt>
      <dd><?php echo $displayData->residential_otherrooms; ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_livingarea !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_LIVING_AREA'); ?></dt>
      <dd><?php echo $displayData->residential_livingarea; ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->residential_ensuite !='0'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_ENSUITE'); ?></dt>
      <dd><?php echo JText::_('COM_REALESTATENOW_YES'); ?></dd>
      <?php endif; ?>
      <?php if($displayData->feature_parkingspaces !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_CARPORT'); ?></dt>
      <dd><?php echo $displayData->feature_parkingspaces; ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->residential_stories !='0'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_STORIES'); ?></dt>
      <dd><?php echo $displayData->residential_stories; ?></dd>
      <?php endif; ?>
    </dl>
    <?php endif; ?>
    <?php if($displayData->feature_appliances !='' || $displayData->feature_indoorfeatures !='' || $displayData->feature_outdoorfeatures !='' || $displayData->feature_communityfeatures !='' || $displayData->feature_otherfeatures !='' || (int)$displayData->residential_phoneavailableyn !='0' || $displayData->residential_garbagedisposalyn !='' || (int)$displayData->residential_familyroompresent !='0' || (int)$displayData->residential_laundryroompresent !='0' || (int)$displayData->residential_kitchenpresent !='0' || (int)$displayData->residential_livingroompresent !='0'): ?>
    <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
      <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_PROPERTY_FEATURES'); ?></h3>
      <?php if($displayData->feature_appliances !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_APPLIANCES'); ?></dt>
      <dd>
        <?php $feature_appliances = $displayData->feature_appliances; ?>
        <?php foreach ($feature_appliances as $key => $value) {
				echo $value["appliance_type"] ."<br>";
			}
			?>
      </dd>
      <?php endif; ?>
      <?php if($displayData->feature_indoorfeatures !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_INDOOR_FEATURES'); ?></dt>
      <dd>
        <?php $feature_indoorfeatures = $displayData->feature_indoorfeatures; ?>
        <?php foreach ($feature_indoordeatures as $key => $value) {
				echo $value["indoorfeattype"] ."<br>";
			}
			?>
      </dd>
      <?php endif; ?>
      <?php if($displayData->feature_outdoorfeatures !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_OUTDOOR_FEATURES'); ?></dt>
      <dd>
        <?php $feature_outdoorfeatures = $displayData->feature_outdoorfeatures; ?>
        <?php foreach ($feature_outdoorfeatures as $key => $value) {
				echo $value["outdoorfeattype"] ."<br>";
			}
			?>
      </dd>
      <?php endif; ?>
      <?php if($displayData->feature_communityfeatures !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_COMMUNITY_FEATURES'); ?></dt>
      <dd>
        <?php $feature_communityfeatures = $displayData->feature_communityfeatures; ?>
        <?php foreach ($feature_communityfeatures as $key => $value) {
				echo $value["commfeattype"] ."<br>";
			}
			?>
      </dd>
      <?php endif; ?>
      <?php if($displayData->feature_otherfeatures !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_OTHER_FEATURES'); ?></dt>
      <dd>
        <?php $feature_otherfeatures = $displayData->feature_otherfeatures; ?>
        <?php foreach ($feature_otherfeatures as $key => $value) {
				echo $value["otherfeattype"] ."<br>";
			}
			?>
      </dd>
      <?php endif; ?>
      <?php if((int)$displayData->residential_phoneavailableyn !='0'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_PHONE_AVAILABLE'); ?></dt>
      <dd><?php echo JText::_('COM_REALESTATENOW_YES'); ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_garbagedisposalyn !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_GARBAGE_DISPOSAL'); ?></dt>
      <dd><?php echo JText::_('COM_REALESTATENOW_YES'); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->residential_familyroompresent !='0'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_FAMILY_ROOM_PRESENT'); ?></dt>
      <dd><?php echo JText::_('COM_REALESTATENOW_YES'); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->residential_laundryroompresent !='0'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_LAUNDRY_ROOM_PRESENT'); ?></dt>
      <dd><?php echo JText::_('COM_REALESTATENOW_YES'); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->residential_kitchenpresent !='0'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_KITCHEN_PRESENT'); ?></dt>
      <dd><?php echo JText::_('COM_REALESTATENOW_YES'); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->residential_livingroompresent !='0'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_LIVING_ROOM_PRESENT'); ?></dt>
      <dd><?php echo JText::_('COM_REALESTATENOW_YES'); ?></dd>
      <?php endif; ?>
    </dl>
    <?php endif; ?>
    <?php if((int)$displayData->feature_parkingspaceyn !='0' || $displayData->residential_customone !='' || $displayData->residential_customtwo !='' || $displayData->residential_customthree !='' || $displayData->residential_addcustom !='' || $displayData->residential_storage !='' || $displayData->feature_waterresources !='' || $displayData->feature_fencing !='' || $displayData->feature_heating !='' || $displayData->feature_cooling !='' || $displayData->feature_sewer !=''): ?>
    <dl class="uk-description-list uk-description-list-horizontal uk-width-medium-1-2">
      <h3 class="tm-article-subtitle"><?php echo JText::_('COM_REALESTATENOW_PROPERTY_FEATURES'); ?></h3>
      <?php if((int)$displayData->feature_fencing !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_FENCING'); ?></dt>
      <dd><?php echo implode(',',$displayData->feature_fencing); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->feature_heating !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_HEATING'); ?></dt>
      <dd><?php echo implode(',',$displayData->feature_heating); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->feature_cooling !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_COOLING'); ?></dt>
      <dd><?php echo implode(',',$displayData->feature_cooling); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->feature_sewer !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_SEWER'); ?></dt>
      <dd><?php echo implode(',',$displayData->feature_sewer); ?></dd>
      <?php endif; ?>
      <?php if((int)$displayData->feature_parkingspaceyn !='0'): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_PARKING_SPACE'); ?></dt>
      <dd><?php echo $displayData->feature_parkingspaceyn; ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_customone !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_CUSTOM_ONE'); ?></dt>
      <dd><?php echo $displayData->residential_customone; ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_customtwo !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_CUSTOM_TWO'); ?></dt>
      <dd><?php echo $displayData->residential_customtwo; ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_customthree !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_CUSTOM_THREE'); ?></dt>
      <dd><?php echo $displayData->residential_customthree; ?></dd>
      <?php endif; ?>
      <?php if($displayData->residential_addcustom !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_ADDITIONAL_CUSTOM_FIELDS'); ?></dt>
      <dd>
        <?php $addcustom = $displayData->residential_addcustom; ?>
        <?php foreach ($residential_addcustom as $key => $value) {
				echo $value["customname"] .  ' ' . $value["customdata"] ."<br>";
			}
			?>
      </dd>
      <?php endif; ?>
      <?php if($displayData->residential_storage !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_STORAGE'); ?></dt>
      <dd><?php echo $displayData->residential_storage; ?></dd>
      <?php endif; ?>
      <?php if($displayData->feature_waterresources !=''): ?>
      <dt><?php echo JText::_('COM_REALESTATENOW_WATER_RESOURCES'); ?></dt>
      <dd><?php echo implode(',',$displayData->feature_waterresources); ?></dd>
      <?php endif; ?>
    </dl>
    <?php endif; ?>
  </div>
</div>

