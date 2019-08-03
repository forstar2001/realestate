<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		listing_details_left.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$form = $displayData->getForm();

$fields = $displayData->get('fields') ?: array(
	'proptypenote'
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
/***[INSERTED$$$$]***//*348*/
if(isset($_GET['id'])){
	$ids = $_GET['id'];
}
include_once JPATH_ADMINISTRATOR . '/components/com_realestatenow/models/property.php';
$usersMdl = new RealestatenowModelProperty();
 $on_frontpage=$usersMdl->getlistingids('residential',$ids);
 $multifamily=$usersMdl->getlistingids('multifamily',$ids);
 $commercial=$usersMdl->getlistingids('commercial',$ids);
 $land=$usersMdl->getlistingids('land',$ids);


$Residentiallink = JRoute::_('index.php?option=com_realestatenow&ref=property&refid='.$ids.'&task=residential.edit'.$on_frontpage);


$Multifamilylink = JRoute::_('index.php?option=com_realestatenow&task=multifamily.edit&ref=property&refid='.$ids.$multifamily);



$Commerciallink = JRoute::_('index.php?option=com_realestatenow&task=commercial.edit&ref=property&refid='.$ids.$commercial);


$Landlink = JRoute::_('index.php?option=com_realestatenow&task=land.edit&ref=property&refid='.$ids.$land);
?>
<!--[REPLACED$$$$]--><!--360-->
<!--[/INSERTED$$$$]-->
<!--[/REPLACED$$$$]-->
<!--[INSERTED$$$$]--><!--361-->
<!-- Residential Tab -->
    <div class="control-group">
		<div class="control">
			<a  class="btn btn-success vdm-button-new" href="<?php echo $Residentiallink; ?>" ><?php echo JText::_('COM_REALESTATENOW_RESIDENTIAL_PROPERTY_DATA', true);?></a>
		</div>
	</div>
	<!-- /Residential Tab -->

    <!-- Multifamily Tab -->
	 <div class="control-group">
		<div class="control">
			<a  class="btn btn-success vdm-button-new" href="<?php echo $Multifamilylink; ?>" ><?php echo JText::_('COM_REALESTATENOW_MULTIFAMILY_PROPERTY_DATA', true);?></a>
		</div>
	</div>
	 <!-- /Multifamily Tab -->
	 
	  <!-- Commercial Tab -->
	  <div class="control-group">
		<div class="control">
			<a  class="btn btn-success vdm-button-new" href="<?php echo $Commerciallink; ?>" ><?php echo JText::_('COM_REALESTATENOW_COMMERCIAL_PROPERTY_DATA', true);?></a>
		</div>
	</div>
	<!-- /Commercial Tab -->
	<!-- Land Tab -->
	 <div class="control-group">
		<div class="control">
			<a  class="btn btn-success vdm-button-new" href="<?php echo $Landlink; ?>" ><?php echo JText::_('COM_REALESTATENOW_LAND_PROPERTY_DATA', true);?></a>
		</div>
	</div>
	<!-- /Land Tab -->
<!--[/INSERTED$$$$]-->
