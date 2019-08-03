/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		city.js
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// Some Global Values
jform_vvvvvvxvwb_required = false;
jform_vvvvvvxvwc_required = false;

// [Interpretation 9363] Initial Script
jQuery(document).ready(function()
{
	var owncoords_vvvvvvx = jQuery("#jform_owncoords input[type='radio']:checked").val();
	vvvvvvx(owncoords_vvvvvvx);
});

// [Interpretation 9430] the vvvvvvx function
function vvvvvvx(owncoords_vvvvvvx)
{
	// [Interpretation 9499] set the function logic
	if (owncoords_vvvvvvx == 1)
	{
		jQuery('#jform_latitude').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to latitude field
		if (jform_vvvvvvxvwb_required)
		{
			updateFieldRequired('latitude',0);
			jQuery('#jform_latitude').prop('required','required');
			jQuery('#jform_latitude').attr('aria-required',true);
			jQuery('#jform_latitude').addClass('required');
			jform_vvvvvvxvwb_required = false;
		}
		jQuery('#jform_longitude').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to longitude field
		if (jform_vvvvvvxvwc_required)
		{
			updateFieldRequired('longitude',0);
			jQuery('#jform_longitude').prop('required','required');
			jQuery('#jform_longitude').attr('aria-required',true);
			jQuery('#jform_longitude').addClass('required');
			jform_vvvvvvxvwc_required = false;
		}
	}
	else
	{
		jQuery('#jform_latitude').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from latitude field
		if (!jform_vvvvvvxvwb_required)
		{
			updateFieldRequired('latitude',1);
			jQuery('#jform_latitude').removeAttr('required');
			jQuery('#jform_latitude').removeAttr('aria-required');
			jQuery('#jform_latitude').removeClass('required');
			jform_vvvvvvxvwb_required = true;
		}
		jQuery('#jform_longitude').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from longitude field
		if (!jform_vvvvvvxvwc_required)
		{
			updateFieldRequired('longitude',1);
			jQuery('#jform_longitude').removeAttr('required');
			jQuery('#jform_longitude').removeAttr('aria-required');
			jQuery('#jform_longitude').removeClass('required');
			jform_vvvvvvxvwc_required = true;
		}
	}
}

// update required fields
function updateFieldRequired(name,status)
{
	var not_required = jQuery('#jform_not_required').val();

	if(status == 1)
	{
		if (isSet(not_required) && not_required != 0)
		{
			not_required = not_required+','+name;
		}
		else
		{
			not_required = ','+name;
		}
	}
	else
	{
		if (isSet(not_required) && not_required != 0)
		{
			not_required = not_required.replace(','+name,'');
		}
	}

	jQuery('#jform_not_required').val(not_required);
}

// the isSet function
function isSet(val)
{
	if ((val != undefined) && (val != null) && 0 !== val.length){
		return true;
	}
	return false;
} 
