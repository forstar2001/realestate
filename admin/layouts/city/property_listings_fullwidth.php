<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		property_listings_fullwidth.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// set the defaults
$items = $displayData->vwdproperty_listings;
$user = JFactory::getUser();
$id = $displayData->item->id;
// [Interpretation 8037] set the edit URL
$edit = "index.php?option=com_realestatenow&view=properties&task=property.edit";
// [Interpretation 8039] set a return value
$return = ($id) ? "index.php?option=com_realestatenow&view=city&layout=edit&id=" . $id : "";
// [Interpretation 8041] check for a return value
$jinput = JFactory::getApplication()->input;
if ($_return = $jinput->get('return', null, 'base64'))
{
	$return .= "&return=" . $_return;
}
// [Interpretation 8047] set the referral values
$ref = ($id) ? "&ref=city&refid=" . $id . "&return=" . urlencode(base64_encode($return)) : "";
// [Interpretation 8054] set the create new URL
$new = "index.php?option=com_realestatenow&view=property&layout=edit".$ref;
// [Interpretation 8063] load the action object
$can = RealestatenowHelper::getActions('property');

?>
<div class="form-vertical">
<?php if ($can->get('property.create')): ?>
	<a class="btn btn-small btn-success" href="<?php echo $new; ?>"><span class="icon-new icon-white"></span> <?php echo JText::_('COM_REALESTATENOW_NEW'); ?></a><br /><br />
<?php endif; ?>
<?php if (RealestatenowHelper::checkArray($items)): ?>
<table class="footable table data properties metro-blue" data-page-size="20" data-filter="#filter_properties">
<thead>
	<tr>
		<th data-toggle="true">
			<?php echo JText::_('COM_REALESTATENOW_PROPERTY_NAME_LABEL'); ?>
		</th>
		<th data-hide="phone">
			<?php echo JText::_('COM_REALESTATENOW_PROPERTY_CITYID_LABEL'); ?>
		</th>
		<th data-hide="phone">
			<?php echo JText::_('COM_REALESTATENOW_PROPERTY_STATEID_LABEL'); ?>
		</th>
		<th data-hide="phone,tablet">
			<?php echo JText::_('COM_REALESTATENOW_PROPERTY_PROPERTY_CATEGORY'); ?>
		</th>
		<th data-hide="phone,tablet">
			<?php echo JText::_('COM_REALESTATENOW_PROPERTY_PRICE_LABEL'); ?>
		</th>
		<th data-hide="phone,tablet">
			<?php echo JText::_('COM_REALESTATENOW_PROPERTY_FEATURED_LABEL'); ?>
		</th>
		<th data-hide="all">
			<?php echo JText::_('COM_REALESTATENOW_PROPERTY_MLS_ID_LABEL'); ?>
		</th>
		<th width="10" data-hide="phone,tablet">
			<?php echo JText::_('COM_REALESTATENOW_PROPERTY_STATUS'); ?>
		</th>
		<th width="5" data-type="numeric" data-hide="phone,tablet">
			<?php echo JText::_('COM_REALESTATENOW_PROPERTY_ID'); ?>
		</th>
	</tr>
</thead>
<tbody>
<?php foreach ($items as $i => $item): ?>
	<?php
		$canCheckin = $user->authorise('core.manage', 'com_checkin') || $item->checked_out == $user->id || $item->checked_out == 0;
		$userChkOut = JFactory::getUser($item->checked_out);
		$canDo = RealestatenowHelper::getActions('property',$item,'properties');
	?>
	<tr>
		<td>
			<?php if ($canDo->get('property.edit')): ?>
				<a href="<?php echo $edit; ?>&id=<?php echo $item->id; ?><?php echo $ref; ?>"><?php echo $displayData->escape($item->name); ?></a>
				<?php if ($item->checked_out): ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $userChkOut->name, $item->checked_out_time, 'properties.', $canCheckin); ?>
				<?php endif; ?>
			<?php else: ?>
				<?php echo $displayData->escape($item->name); ?>
			<?php endif; ?>
		</td>
		<td>
			<?php echo $displayData->escape($item->cityid_name); ?>
		</td>
		<td>
			<?php echo $displayData->escape($item->stateid_name); ?>
		</td>
		<td>
			<?php echo $displayData->escape($item->category_title); ?>
		</td>
		<td>
			<?php echo $displayData->escape($item->price); ?>
		</td>
		<td>
			<?php echo JText::_($item->featured); ?>
		</td>
		<td>
			<?php if ($canDo->get('property.edit')): ?>
				<a href="<?php echo $edit; ?>&id=<?php echo $item->id; ?><?php echo $ref; ?>"><?php echo $displayData->escape($item->mls_id); ?></a>
				<?php if ($item->checked_out): ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $userChkOut->name, $item->checked_out_time, 'properties.', $canCheckin); ?>
				<?php endif; ?>
			<?php else: ?>
				<?php echo $displayData->escape($item->mls_id); ?>
			<?php endif; ?>
		</td>
		<?php if ($item->published == 1):?>
			<td class="center"  data-value="1">
				<span class="status-metro status-published" title="<?php echo JText::_('COM_REALESTATENOW_PUBLISHED');  ?>">
					<?php echo JText::_('COM_REALESTATENOW_PUBLISHED'); ?>
				</span>
			</td>
		<?php elseif ($item->published == 0):?>
			<td class="center"  data-value="2">
				<span class="status-metro status-inactive" title="<?php echo JText::_('COM_REALESTATENOW_INACTIVE');  ?>">
					<?php echo JText::_('COM_REALESTATENOW_INACTIVE'); ?>
				</span>
			</td>
		<?php elseif ($item->published == 2):?>
			<td class="center"  data-value="3">
				<span class="status-metro status-archived" title="<?php echo JText::_('COM_REALESTATENOW_ARCHIVED');  ?>">
					<?php echo JText::_('COM_REALESTATENOW_ARCHIVED'); ?>
				</span>
			</td>
		<?php elseif ($item->published == -2):?>
			<td class="center"  data-value="4">
				<span class="status-metro status-trashed" title="<?php echo JText::_('COM_REALESTATENOW_TRASHED');  ?>">
					<?php echo JText::_('COM_REALESTATENOW_TRASHED'); ?>
				</span>
			</td>
		<?php endif; ?>
		<td class="nowrap center hidden-phone">
			<?php echo $item->id; ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
<tfoot class="hide-if-no-paging">
	<tr>
		<td colspan="9">
			<div class="pagination pagination-centered"></div>
		</td>
	</tr>
</tfoot>
</table>
<?php else: ?>
	<div class="alert alert-no-items">
		<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
	</div>
<?php endif; ?>
</div>
