<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		basic_financial_above.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$form = $displayData->getForm();

$fields = array(
	'propid'
);
/***[INSERTED$$$$]***//*378*/
$db = JFactory::getDBO();
		$jinput = JFactory::getApplication()->input;
		$query = $db->getQuery(true);
		$propid = $jinput->getInt('refid', 0);
		$query->select($db->quoteName(array('b.id','b.name'),array('id','propid_name')));
		$query->from($db->quoteName('#__realestatenow_property', 'b'));
		$query->where($db->quoteName('b.published') . ' = 1');
	
		$query->order('b.name ASC');
		
	
			// only load these fields
			
		
		$db->setQuery((string)$query);
		$items = $db->loadObjectList();
/***[/INSERTED$$$$]***/

?>
<!--[REPLACED$$$$]--><!--385-->
<div class="form-inline form-inline-header">
	<div class="control-group">
		<div class="control-label"><label id="jform_propid-lbl" for="jform_propid" class="hasPopover required" title="" data-content="Select a Property Listing." data-original-title="Property">
	Property<span class="star">&nbsp;*</span></label>
		</div>
		<div class="controls">
			<select id="jform_propid" name="" class="list_class required" required="required" aria-required="true" disabled="disabled" style="display: none;">
			<option value="" >Select a property</option>
			<?php
				
					
			foreach($items as $item)
			{
				
				?>
				<option value="<?php echo $item->id; ?>" <?php if($_GET['refid'] == $item->id){ echo 'selected'; }?> ><?php echo $item->propid_name; ?></option>
				<?php
		
			}
				
			?>
			</select>
			<input type="hidden" name="jform[propid]" value="<?php echo $_GET['refid']; ?>">
		</div>
	</div>
	<?php /*foreach($fields as $field){
		echo $form->renderField($field);
	}*/ ?>
</div>
<!--[/REPLACED$$$$]-->
