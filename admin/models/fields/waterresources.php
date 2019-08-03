<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		waterresources.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Waterresources Form Field class for the Realestatenow component
 */
class JFormFieldWaterresources extends JFormFieldList
{
	/**
	 * The waterresources field type.
	 *
	 * @var		string
	 */
	public $type = 'waterresources';

	/**
	 * Override to add new button
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   3.2
	 */
	protected function getInput()
	{
		// [Fields 3008] see if we should add buttons
		$setButton = $this->getAttribute('button');
		// [Fields 3010] get html
		$html = parent::getInput();
		// [Fields 3012] if true set button
		if ($setButton === 'true')
		{
			$button = array();
			$script = array();
			$buttonName = $this->getAttribute('name');
			// [Fields 3018] get the input from url
			$app = JFactory::getApplication();
			$jinput = $app->input;
			// [Fields 3021] get the view name & id
			$values = $jinput->getArray(array(
				'id' => 'int',
				'view' => 'word'
			));
			// [Fields 3026] check if new item
			$ref = '';
			$refJ = '';
			if (!is_null($values['id']) && strlen($values['view']))
			{
				// [Fields 3033] only load referral if not new item.
				$ref = '&amp;ref=' . $values['view'] . '&amp;refid=' . $values['id'];
				$refJ = '&ref=' . $values['view'] . '&refid=' . $values['id'];
				// [Fields 3036] get the return value.
				$_uri = (string) JUri::getInstance();
				$_return = urlencode(base64_encode($_uri));
				// [Fields 3039] load return value.
				$ref .= '&amp;return=' . $_return;
				$refJ .= '&return=' . $_return;
			}
			$user = JFactory::getUser();
			// [Fields 3060] only add if user allowed to create feature_type
			if ($user->authorise('core.create', 'com_realestatenow') && $app->isAdmin()) // TODO for now only in admin area.
			{
				// [Fields 3071] build Create button
				$buttonNamee = trim($buttonName);
				$buttonNamee = preg_replace('/_+/', ' ', $buttonNamee);
				$buttonNamee = preg_replace('/\s+/', ' ', $buttonNamee);
				$buttonNamee = preg_replace("/[^A-Za-z ]/", '', $buttonNamee);
				$buttonNamee = ucfirst(strtolower($buttonNamee));
				$button[] = '<a id="'.$buttonName.'Create" class="btn btn-small btn-success hasTooltip" title="'.JText::sprintf('COM_REALESTATENOW_CREATE_NEW_S', $buttonNamee).'" style="border-radius: 0px 4px 4px 0px; padding: 4px 4px 4px 7px;"
					href="index.php?option=com_realestatenow&amp;view=feature_type&amp;layout=edit'.$ref.'" >
					<span class="icon-new icon-white"></span></a>';
			}
			// [Fields 3081] only add if user allowed to edit feature_type
			if (($buttonName === 'feature_type' || $buttonName === 'feature_types')  && $user->authorise('core.edit', 'com_realestatenow') && $app->isAdmin()) // TODO for now only in admin area.
			{
				// [Fields 3092] build edit button
				$buttonNamee = trim($buttonName);
				$buttonNamee = preg_replace('/_+/', ' ', $buttonNamee);
				$buttonNamee = preg_replace('/\s+/', ' ', $buttonNamee);
				$buttonNamee = preg_replace("/[^A-Za-z ]/", '', $buttonNamee);
				$buttonNamee = ucfirst(strtolower($buttonNamee));
				$button[] = '<a id="'.$buttonName.'Edit" class="btn btn-small hasTooltip" title="'.JText::sprintf('COM_REALESTATENOW_EDIT_S', $buttonNamee).'" style="display: none; padding: 4px 4px 4px 7px;" href="#" >
					<span class="icon-edit"></span></a>';
				// [Fields 3100] build script
				$script[] = "
					jQuery(document).ready(function() {
						jQuery('#adminForm').on('change', '#jform_".$buttonName."',function (e) {
							e.preventDefault();
							var ".$buttonName."Value = jQuery('#jform_".$buttonName."').val();
							".$buttonName."Button(".$buttonName."Value);
						});
						var ".$buttonName."Value = jQuery('#jform_".$buttonName."').val();
						".$buttonName."Button(".$buttonName."Value);
					});
					function ".$buttonName."Button(value) {
						if (value > 0) {
							// hide the create button
							jQuery('#".$buttonName."Create').hide();
							// show edit button
							jQuery('#".$buttonName."Edit').show();
							var url = 'index.php?option=com_realestatenow&view=feature_types&task=feature_type.edit&id='+value+'".$refJ."';
							jQuery('#".$buttonName."Edit').attr('href', url);
						} else {
							// show the create button
							jQuery('#".$buttonName."Create').show();
							// hide edit button
							jQuery('#".$buttonName."Edit').hide();
						}
					}";
			}
			// [Fields 3127] check if button was created for feature_type field.
			if (is_array($button) && count($button) > 0)
			{
				// [Fields 3130] Load the needed script.
				$document = JFactory::getDocument();
				$document->addScriptDeclaration(implode(' ',$script));
				// [Fields 3133] return the button attached to input field.
				return '<div class="input-append">' .$html . implode('',$button).'</div>';
			}
		}
		return $html;
	}

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array    An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db = JFactory::getDBO();
$query = $db->getQuery(true);
$query->select($db->quoteName(array('a.id','a.featurename'),array('id','waterresources_featurename')));
$query->from($db->quoteName('#__realestatenow_feature_type', 'a'));
$query->where($db->quoteName('a.featuretype').'=9')->andWhere($db->quoteName('a.published').'=1');
$query->order('a.featurename ASC');
$db->setQuery((string)$query);
$items = $db->loadObjectList();
$options = array();
if ($items)
{
	$options[] = JHtml::_('select.option', '', 'Select an option');
	foreach($items as $item)
	{
		$options[] = JHtml::_('select.option', $item->id, $item->waterresources_featurename);
	}
}

return $options;
	}
}
