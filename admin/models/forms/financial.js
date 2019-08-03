/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		financial.js
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// Some Global Values
jform_vvvvvwgvwr_required = false;
jform_vvvvvwgvws_required = false;

// [Interpretation 9363] Initial Script
jQuery(document).ready(function()
{
	var pm_price_override_vvvvvwg = jQuery("#jform_pm_price_override input[type='radio']:checked").val();
	vvvvvwg(pm_price_override_vvvvvwg);
});

// [Interpretation 9430] the vvvvvwg function
function vvvvvwg(pm_price_override_vvvvvwg)
{
	// [Interpretation 9499] set the function logic
	if (pm_price_override_vvvvvwg == 1)
	{
		jQuery('#jform_pmenddate').closest('.control-group').show();
		jQuery('#jform_propmgt_price').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to propmgt_price field
		if (jform_vvvvvwgvwr_required)
		{
			updateFieldRequired('propmgt_price',0);
			jQuery('#jform_propmgt_price').prop('required','required');
			jQuery('#jform_propmgt_price').attr('aria-required',true);
			jQuery('#jform_propmgt_price').addClass('required');
			jform_vvvvvwgvwr_required = false;
		}
		jQuery('#jform_pmstartdate').closest('.control-group').show();
		jQuery('#jform_propmgt_description').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to propmgt_description field
		if (jform_vvvvvwgvws_required)
		{
			updateFieldRequired('propmgt_description',0);
			jQuery('#jform_propmgt_description').prop('required','required');
			jQuery('#jform_propmgt_description').attr('aria-required',true);
			jQuery('#jform_propmgt_description').addClass('required');
			jform_vvvvvwgvws_required = false;
		}
	}
	else
	{
		jQuery('#jform_pmenddate').closest('.control-group').hide();
		jQuery('#jform_propmgt_price').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from propmgt_price field
		if (!jform_vvvvvwgvwr_required)
		{
			updateFieldRequired('propmgt_price',1);
			jQuery('#jform_propmgt_price').removeAttr('required');
			jQuery('#jform_propmgt_price').removeAttr('aria-required');
			jQuery('#jform_propmgt_price').removeClass('required');
			jform_vvvvvwgvwr_required = true;
		}
		jQuery('#jform_pmstartdate').closest('.control-group').hide();
		jQuery('#jform_propmgt_description').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from propmgt_description field
		if (!jform_vvvvvwgvws_required)
		{
			updateFieldRequired('propmgt_description',1);
			jQuery('#jform_propmgt_description').removeAttr('required');
			jQuery('#jform_propmgt_description').removeAttr('aria-required');
			jQuery('#jform_propmgt_description').removeClass('required');
			jform_vvvvvwgvws_required = true;
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
