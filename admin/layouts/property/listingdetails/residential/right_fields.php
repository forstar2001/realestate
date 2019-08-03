<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.0
	@build			20th November, 2017
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		residential_right.php
	@author			Most Wanted Web Services, Inc. <http://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2017. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file

defined('_JEXEC') or die('Restricted access');

$form = $displayData->getForm('residential');

$fields = array(
	'phoneavailableyn',
	'garbagedisposalyn',
	'familyroompresent',
	'laundryroompresent',
	'kitchenpresent',
	'livingroompresent',
	'parkingspaceyn',
	'customone',
	'customtwo',
	'customthree',
	'addcustom',
	'storage'
);

$hiddenFields = array();

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
