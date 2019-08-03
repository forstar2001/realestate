<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		listing_details_right.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$form = $displayData->getForm();

$fields = $displayData->get('fields') ?: array(
	'propmisctypenote'
);

$hiddenFields = $displayData->get('hidden_fields') ?: array();

foreach ($fields as $field)
{
	$field = is_array($field) ? $field : array($field);
	foreach ($field as $f)
	{
		if ($form->getField($f))
		{
			if (in_array($f, $hiddenFields))
			{
				$form->setFieldAttribute($f, 'type', 'hidden');
			}

			echo $form->renderField($f);
			break;
		}
	}
}
/***[INSERTED$$$$]***//*350*/
if(isset($_GET['id'])){
	$ids = $_GET['id'];
}
include_once JPATH_ADMINISTRATOR . '/components/com_realestatenow/models/property.php';
$usersMdl = new RealestatenowModelProperty();
 $feature=$usersMdl->getlistingids('feature',$ids);
 $rental=$usersMdl->getlistingids('rental',$ids);
 $financial=$usersMdl->getlistingids('financial',$ids);
 $area=$usersMdl->getlistingids('area',$ids);
$Featurelink = JRoute::_('index.php?option=com_realestatenow&task=feature.edit&ref=property&refid='.$ids.$feature);

$Rentallink = JRoute::_('index.php?option=com_realestatenow&task=rental.edit&ref=property&refid='.$ids.$rental);


$Financiallink = JRoute::_('index.php?option=com_realestatenow&task=financial.edit&ref=property&refid='.$ids.$financial);
$arealink = JRoute::_('index.php?option=com_realestatenow&task=area.edit&ref=property&refid='.$ids.$area);
?>
<!--[REPLACED$$$$]--><!--358-->
<!--[/INSERTED$$$$]-->
<!--[/REPLACED$$$$]-->
<!--[INSERTED$$$$]--><!--362-->
<!-- Property Feature Data Tab -->
    <div class="control-group">
		<div class="control">
			<a  class="btn btn-success vdm-button-new" href="<?php echo $Featurelink; ?>" ><?php echo JText::_('COM_REALESTATENOW_PROPERTY_FEATURE_DATA', true);?></a>
		</div>
	</div>
	<!-- /Property Feature Data Tab -->

    <!-- Rental Tab -->
	  <div class="control-group">
		<div class="control">
			<a  class="btn btn-success vdm-button-new" href="<?php echo $Rentallink; ?>" ><?php echo JText::_('COM_REALESTATENOW_PROPERTY_RENTAL_DATA', true);?></a>
		</div>
	</div>
	 <!-- /Rental Tab -->

	 
	  <!-- Financial Tab -->
   <div class="control-group">
		<div class="control">
			<a  class="btn btn-success vdm-button-new" href="<?php echo $Financiallink; ?>" ><?php echo JText::_('COM_REALESTATENOW_PROPERTY_FINANCIAL_DATA', true);?></a>
		</div>
	</div>
	<!-- /Financial Tab -->
	<!-- Area Tab -->
   <div class="control-group">
		<div class="control">
		<a  class="btn btn-success vdm-button-new" href="<?php echo $arealink; ?>" ><?php echo JText::_('COM_REALESTATENOW_PROPERTY_AREA_INFO', true);?></a>
	</div>
	</div>
	<!-- /Area Tab -->
<!--[/INSERTED$$$$]-->
