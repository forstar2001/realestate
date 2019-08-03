/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		property.js
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// Some Global Values
jform_vvvvvwavwk_required = false;
jform_vvvvvwavwl_required = false;
jform_vvvvvwcvwm_required = false;
jform_vvvvvwdvwn_required = false;
jform_vvvvvwdvwo_required = false;
jform_vvvvvwevwp_required = false;
jform_vvvvvwfvwq_required = false;

// [Interpretation 9363] Initial Script
jQuery(document).ready(function()
{
	var owncoords_vvvvvwa = jQuery("#jform_owncoords input[type='radio']:checked").val();
	vvvvvwa(owncoords_vvvvvwa);

	var openhouse_vvvvvwb = jQuery("#jform_openhouse input[type='radio']:checked").val();
	vvvvvwb(openhouse_vvvvvwb);

	var showprice_vvvvvwc = jQuery("#jform_showprice input[type='radio']:checked").val();
	vvvvvwc(showprice_vvvvvwc);

	var showprice_vvvvvwd = jQuery("#jform_showprice input[type='radio']:checked").val();
	vvvvvwd(showprice_vvvvvwd);

	var showprice_vvvvvwe = jQuery("#jform_showprice input[type='radio']:checked").val();
	vvvvvwe(showprice_vvvvvwe);

	var sold_vvvvvwf = jQuery("#jform_sold input[type='radio']:checked").val();
	vvvvvwf(sold_vvvvvwf);
});

// [Interpretation 9430] the vvvvvwa function
function vvvvvwa(owncoords_vvvvvwa)
{
	// [Interpretation 9499] set the function logic
	if (owncoords_vvvvvwa == 1)
	{
		jQuery('#jform_latitude').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to latitude field
		if (jform_vvvvvwavwk_required)
		{
			updateFieldRequired('latitude',0);
			jQuery('#jform_latitude').prop('required','required');
			jQuery('#jform_latitude').attr('aria-required',true);
			jQuery('#jform_latitude').addClass('required');
			jform_vvvvvwavwk_required = false;
		}
		jQuery('#jform_longitude').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to longitude field
		if (jform_vvvvvwavwl_required)
		{
			updateFieldRequired('longitude',0);
			jQuery('#jform_longitude').prop('required','required');
			jQuery('#jform_longitude').attr('aria-required',true);
			jQuery('#jform_longitude').addClass('required');
			jform_vvvvvwavwl_required = false;
		}
	}
	else
	{
		jQuery('#jform_latitude').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from latitude field
		if (!jform_vvvvvwavwk_required)
		{
			updateFieldRequired('latitude',1);
			jQuery('#jform_latitude').removeAttr('required');
			jQuery('#jform_latitude').removeAttr('aria-required');
			jQuery('#jform_latitude').removeClass('required');
			jform_vvvvvwavwk_required = true;
		}
		jQuery('#jform_longitude').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from longitude field
		if (!jform_vvvvvwavwl_required)
		{
			updateFieldRequired('longitude',1);
			jQuery('#jform_longitude').removeAttr('required');
			jQuery('#jform_longitude').removeAttr('aria-required');
			jQuery('#jform_longitude').removeClass('required');
			jform_vvvvvwavwl_required = true;
		}
	}
}

// [Interpretation 9430] the vvvvvwb function
function vvvvvwb(openhouse_vvvvvwb)
{
	// [Interpretation 9499] set the function logic
	if (openhouse_vvvvvwb == 1)
	{
		jQuery('#jform_openhouseinfo-lbl').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_openhouseinfo-lbl').closest('.control-group').hide();
	}
}

// [Interpretation 9430] the vvvvvwc function
function vvvvvwc(showprice_vvvvvwc)
{
	// [Interpretation 9499] set the function logic
	if (showprice_vvvvvwc == 1)
	{
		jQuery('#jform_priceview').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from priceview field
		if (!jform_vvvvvwcvwm_required)
		{
			updateFieldRequired('priceview',1);
			jQuery('#jform_priceview').removeAttr('required');
			jQuery('#jform_priceview').removeAttr('aria-required');
			jQuery('#jform_priceview').removeClass('required');
			jform_vvvvvwcvwm_required = true;
		}
	}
	else
	{
		jQuery('#jform_priceview').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to priceview field
		if (jform_vvvvvwcvwm_required)
		{
			updateFieldRequired('priceview',0);
			jQuery('#jform_priceview').prop('required','required');
			jQuery('#jform_priceview').attr('aria-required',true);
			jQuery('#jform_priceview').addClass('required');
			jform_vvvvvwcvwm_required = false;
		}
	}
}

// [Interpretation 9430] the vvvvvwd function
function vvvvvwd(showprice_vvvvvwd)
{
	// [Interpretation 9499] set the function logic
	if (showprice_vvvvvwd == 0)
	{
		jQuery('#jform_closeprice').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from closeprice field
		if (!jform_vvvvvwdvwn_required)
		{
			updateFieldRequired('closeprice',1);
			jQuery('#jform_closeprice').removeAttr('required');
			jQuery('#jform_closeprice').removeAttr('aria-required');
			jQuery('#jform_closeprice').removeClass('required');
			jform_vvvvvwdvwn_required = true;
		}
		jQuery('#jform_price').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from price field
		if (!jform_vvvvvwdvwo_required)
		{
			updateFieldRequired('price',1);
			jQuery('#jform_price').removeAttr('required');
			jQuery('#jform_price').removeAttr('aria-required');
			jQuery('#jform_price').removeClass('required');
			jform_vvvvvwdvwo_required = true;
		}
	}
	else
	{
		jQuery('#jform_closeprice').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to closeprice field
		if (jform_vvvvvwdvwn_required)
		{
			updateFieldRequired('closeprice',0);
			jQuery('#jform_closeprice').prop('required','required');
			jQuery('#jform_closeprice').attr('aria-required',true);
			jQuery('#jform_closeprice').addClass('required');
			jform_vvvvvwdvwn_required = false;
		}
		jQuery('#jform_price').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to price field
		if (jform_vvvvvwdvwo_required)
		{
			updateFieldRequired('price',0);
			jQuery('#jform_price').prop('required','required');
			jQuery('#jform_price').attr('aria-required',true);
			jQuery('#jform_price').addClass('required');
			jform_vvvvvwdvwo_required = false;
		}
	}
}

// [Interpretation 9430] the vvvvvwe function
function vvvvvwe(showprice_vvvvvwe)
{
	// [Interpretation 9499] set the function logic
	if (showprice_vvvvvwe == 0)
	{
		jQuery('#jform_priceview').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to priceview field
		if (jform_vvvvvwevwp_required)
		{
			updateFieldRequired('priceview',0);
			jQuery('#jform_priceview').prop('required','required');
			jQuery('#jform_priceview').attr('aria-required',true);
			jQuery('#jform_priceview').addClass('required');
			jform_vvvvvwevwp_required = false;
		}
	}
	else
	{
		jQuery('#jform_priceview').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from priceview field
		if (!jform_vvvvvwevwp_required)
		{
			updateFieldRequired('priceview',1);
			jQuery('#jform_priceview').removeAttr('required');
			jQuery('#jform_priceview').removeAttr('aria-required');
			jQuery('#jform_priceview').removeClass('required');
			jform_vvvvvwevwp_required = true;
		}
	}
}

// [Interpretation 9430] the vvvvvwf function
function vvvvvwf(sold_vvvvvwf)
{
	// [Interpretation 9499] set the function logic
	if (sold_vvvvvwf == 1)
	{
		jQuery('#jform_closedate').closest('.control-group').show();
		jQuery('#jform_closeprice').closest('.control-group').show();
		// [Interpretation 9819] add required attribute to closeprice field
		if (jform_vvvvvwfvwq_required)
		{
			updateFieldRequired('closeprice',0);
			jQuery('#jform_closeprice').prop('required','required');
			jQuery('#jform_closeprice').attr('aria-required',true);
			jQuery('#jform_closeprice').addClass('required');
			jform_vvvvvwfvwq_required = false;
		}
	}
	else
	{
		jQuery('#jform_closedate').closest('.control-group').hide();
		jQuery('#jform_closeprice').closest('.control-group').hide();
		// [Interpretation 9808] remove required attribute from closeprice field
		if (!jform_vvvvvwfvwq_required)
		{
			updateFieldRequired('closeprice',1);
			jQuery('#jform_closeprice').removeAttr('required');
			jQuery('#jform_closeprice').removeAttr('aria-required');
			jQuery('#jform_closeprice').removeClass('required');
			jform_vvvvvwfvwq_required = true;
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
