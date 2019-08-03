/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		submitbutton.js
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

Joomla.submitbutton = function(task)
{
/***[INSERTED$$$$]***//*25*/
 //autofill empty name field on save
	if( (jQuery('#jform_name').val() == '' )){
		var name;
		var street = jQuery('#jform_street').val() != ''
			? jQuery('#jform_street').val().replace(/\s+/g, ' ').replace(/\.+/g,'') + ' ' : '';

		var city = jQuery('#jform_cityid').val() != ''
			? jQuery("#jform_cityid option:selected").text() + ', ' : '';

		var state = jQuery('#jform_stateid').val() != ''
			?  jQuery("#jform_stateid option:selected").text() + ' ': '';

		var postcode = jQuery('#jform_postcode').val() != ''
			?  jQuery('#jform_postcode').val() : '';

		name = street + city + state + postcode;

        if (name.charAt(name.length - 1) == ' ') {
            name = name.substr(0, name.length - 1);
        }

        jQuery('#jform_name').val(name);

	} 
/***[/INSERTED$$$$]***/
	if (task == ''){
		return false;
	} else { 
		var isValid=true;
		var action = task.split('.');
		if (action[1] != 'cancel' && action[1] != 'close'){
			var forms = $$('form.form-validate');
			for (var i=0;i<forms.length;i++){
/***[INSERTED$$$$]***//*103*/
  if(jQuery("#jform_owncoords input[type='radio']:checked").val() != 1){
                 if(mapTabClicked && task !='cancel'){
                     updateAddressAndReGeocode();
                 }
             } 
/***[/INSERTED$$$$]***/
				if (!document.formvalidator.isValid(forms[i])){
					isValid = false;
					break;
				}
			}
		}
		if (isValid){
			Joomla.submitform(task);
			return true;
		} else {
			alert(Joomla.JText._('property, some values are not acceptable.','Some values are unacceptable'));
			return false;
		}
	}
}