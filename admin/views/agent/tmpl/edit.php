<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		edit.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
$componentParams = $this->params; // will be removed just use $this->params instead
?>
<script type="text/javascript">
	// waiting spinner
	var outerDiv = jQuery('body');
	jQuery('<div id="loading"></div>')
		.css("background", "rgba(255, 255, 255, .8) url('components/com_realestatenow/assets/images/import.gif') 50% 15% no-repeat")
		.css("top", outerDiv.position().top - jQuery(window).scrollTop())
		.css("left", outerDiv.position().left - jQuery(window).scrollLeft())
		.css("width", outerDiv.width())
		.css("height", outerDiv.height())
		.css("position", "fixed")
		.css("opacity", "0.80")
		.css("-ms-filter", "progid:DXImageTransform.Microsoft.Alpha(Opacity = 80)")
		.css("filter", "alpha(opacity = 80)")
		.css("display", "none")
		.appendTo(outerDiv);
	jQuery('#loading').show();
	// when page is ready remove and show
	jQuery(window).load(function() {
		jQuery('#realestatenow_loader').fadeIn('fast');
		jQuery('#loading').hide();
	});
</script>
<div id="realestatenow_loader" style="display: none;">
<form action="<?php echo JRoute::_('index.php?option=com_realestatenow&layout=edit&id='. (int) $this->item->id . $this->referral); ?>" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">

	<?php echo JLayoutHelper::render('agent.details_above', $this); ?>
<div class="form-horizontal">
	<div class="span9">

	<?php echo JHtml::_('bootstrap.startTabSet', 'agentTab', array('active' => 'details')); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'agentTab', 'details', JText::_('COM_REALESTATENOW_AGENT_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('agent.details_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('agent.details_right', $this); ?>
			</div>
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('agent.details_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'agentTab', 'map_details', JText::_('COM_REALESTATENOW_AGENT_MAP_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('agent.map_details_left', $this); ?>
			</div>
		</div>
<!--[INSERTED$$$$]--><!--97-->

<div class="span12">
  <?php // (start) Section to initiate google map
        if($componentParams['map_provider'] == '1'):
		    $doc = JFactory::getDocument();
            $doc->addScript('https://maps.googleapis.com/maps/api/js?key=' . $componentParams['gmapsapi'] );
            $doc->addScript(JURI::base().'components/com_realestatenow/assets/js/googlemap.js');
            ?>
  <p>
    <input type='button' id='getlatlong' class="btn btn-primary" value='Submit' onclick="newCoordinates();">
  </p>
  <div id="googleMap" style="height:<?php echo (int)$componentParams['mw_mapheight'].'px'?>; width:<?php echo (int)$componentParams['mw_mapwidth'].'px'?>;"></div>
  <input type="hidden" id="googleMapRes" value="<?php echo $componentParams['zoom'];?>" />
  <?php  endif;
    // (end) Section to initiate google map ?>
  <?php // (start) Section to initiate Bing map
        if($componentParams['map_provider'] == '2'):
			$doc = JFactory::getDocument();
            $doc->addScript('http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0');
            $doc->addScript(JURI::base().'components/com_realestatenow/assets/js/bingmap.js');
            ?>
  <p>
    <input type='button' id='getlatlong' class="btn btn-primary" value='Submit' onclick="GetMap();">
  </p>
  <div id="bingMap" style="height:<?php echo (int)$componentParams['mw_mapheight'].'px'?>; width:<?php echo (int)$componentParams['mw_mapwidth'].'px'?>;;  position: absolute;"></div>
  <input type="hidden" id="bingMapRes" value="<?php echo $componentParams['zoom'];?>" />
  <input type="hidden" id="bingMapApikey" value="<?php echo $componentParams['bingmapsapi'];?>" />
  <?php endif;
    // (end) Section to initiate Bing map?>
</div>
<!--[/INSERTED$$$$]-->
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'agentTab', 'social_details', JText::_('COM_REALESTATENOW_AGENT_SOCIAL_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('agent.social_details_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('agent.social_details_right', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php if ($this->canDo->get('property.access')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'agentTab', 'property_listings', JText::_('COM_REALESTATENOW_AGENT_PROPERTY_LISTINGS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('agent.property_listings_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php $this->ignore_fieldsets = array('details','metadata','vdmmetadata','accesscontrol'); ?>
	<?php $this->tab_name = 'agentTab'; ?>
	<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

	<?php if ($this->canDo->get('agent.delete') || $this->canDo->get('agent.edit.created_by') || $this->canDo->get('agent.edit.state') || $this->canDo->get('agent.edit.created')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'agentTab', 'publishing', JText::_('COM_REALESTATENOW_AGENT_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('agent.publishing', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('agent.metadata', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php if ($this->canDo->get('core.admin')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'agentTab', 'permissions', JText::_('COM_REALESTATENOW_AGENT_PERMISSION', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<fieldset class="adminform">
					<div class="adminformlist">
					<?php foreach ($this->form->getFieldset('accesscontrol') as $field): ?>
						<div>
							<?php echo $field->label; echo $field->input;?>
						</div>
						<div class="clearfix"></div>
					<?php endforeach; ?>
					</div>
				</fieldset>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php echo JHtml::_('bootstrap.endTabSet'); ?>

	<div>
		<input type="hidden" name="task" value="agent.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	</div>
</div><div class="span3">
	<?php echo JLayoutHelper::render('agent.details_rightside', $this); ?>
</div>
</form>
</div>

<script type="text/javascript">

// [Interpretation 9394] #jform_owncoords listeners for owncoords_vvvvvvz function
jQuery('#jform_owncoords').on('keyup',function()
{
	var owncoords_vvvvvvz = jQuery("#jform_owncoords input[type='radio']:checked").val();
	vvvvvvz(owncoords_vvvvvvz);

});
jQuery('#adminForm').on('change', '#jform_owncoords',function (e)
{
	e.preventDefault();
	var owncoords_vvvvvvz = jQuery("#jform_owncoords input[type='radio']:checked").val();
	vvvvvvz(owncoords_vvvvvvz);

});



    var addressChangeTimeOut = null;
    var streetControl   = jQuery( "#jform_street" );
    var cityControl     = jQuery( "#jform_cityid" );
    var stateControl    = jQuery( "#jform_stateid" );
    var postcodeControl = jQuery( "#jform_postcode" );
    var countryControl  = jQuery( "#jform_countryid" );

    var geocodeAddress = {
        street: "",
        city: "",
        state: "",
        postcode: "",
        country: ""
    };

    jQuery(function(){
        jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var liText = jQuery(this).text();
            if(liText == 'Map Details')
            {
                updateAddressAndReGeocode();
            }
        });


        streetControl.on('keyup',function(){
            if(addressChangeTimeOut != null) clearTimeout(addressChangeTimeOut);
            addressChangeTimeOut = setTimeout(updateAddressAndReGeocode, 1000);
        });

        cityControl.on('change',function(){
            updateAddressAndReGeocode();
        });

        stateControl.on('change',function()   {
            updateAddressAndReGeocode();
        });

        postcodeControl.on('keyup',function(){
            if(addressChangeTimeOut != null) clearTimeout(addressChangeTimeOut);
            addressChangeTimeOut = setTimeout(updateAddressAndReGeocode, 1000);
        });

        countryControl.on('change',function(){
            updateAddressAndReGeocode();
        });

        jQuery( "#jform_owncoords1" ).on('change',function(){
            if(jQuery(this).is(':checked')){updateAddressAndReGeocode();}
        });

        function updateAddressAndReGeocode(){
            geocodeAddress.street   = streetControl.val() != '' ? streetControl.val() : '';
            geocodeAddress.city     = cityControl.find('option:selected').val() != '' ? cityControl.find('option:selected').text() : '';
            geocodeAddress.state    = stateControl.find('option:selected').val() != '' ? stateControl.find('option:selected').text() : '';
            geocodeAddress.postcode = postcodeControl.val() != '' ? postcodeControl.val() : '';
            geocodeAddress.country  = countryControl.find('option:selected').val() != '' ? countryControl.find('option:selected').text() : '';
            reGeocode();
        }
    });

// (start) Section to initiate google map
<?php if($componentParams['map_provider'] == '1'): 
$doc->addScript('//maps.googleapis.com/maps/api/js?key=' . $componentParams['gmapsapi'] );
$doc->addScript(JURI::base().'components/com_realestatenow/assets/js/googlemap.js');
?>
var mapTabClicked = false;
jQuery(document).ready(function (){
    jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                mapTabClicked = true;
		var liText = jQuery(this).text();
		if(liText == 'Map Details')
		{
                     var lat = document.getElementById("jform_latitude").value;
                     var long = document.getElementById("jform_longitude").value;
                    initialize(lat, long);
                    var center = map.getCenter();
                   google.maps.event.trigger(map, 'resize');
		map.setCenter(center);        
                }
             
    });
	
});
<?php endif; ?>
// (end) Section to initiate google map


// (start) Section to initiate Bing map
<?php if($componentParams['map_provider'] == '2'): 
    $doc->addScript('//ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0');
    $doc->addScript(JURI::base().'components/com_realestatenow/assets/js/bingmap.js');
?>
        var mapTabClicked = false;
jQuery(function (){
    jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var liText = jQuery(this).text();
		if(liText == 'Map Details')
		{
            mapTabClicked = true;
            GetMap();
        }
    });
});
<?php endif; ?>
// (end) Section to initiate Bing map

jQuery(function (){
    
    jQuery('#jform_owncoords .btn').click(function(){
            var mapOption = jQuery("#jform_owncoords input[type='radio']:checked").val();
            if(mapOption == '0') jQuery('#getlatlong').hide();
            else jQuery('#getlatlong').show();
    });
            
    jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    
        var liText = jQuery(this).text();
        if(liText == 'Map Details'){
            mapTabClicked = true;
            var mapOption = jQuery("#jform_owncoords input[type='radio']:checked").val();
            if(mapOption == '0') jQuery('#getlatlong').hide();
        }
        
        if(liText == 'Media'){
            jQuery('.file-zoom-content').hide();
        }
    
    });

});

    var addressChangeTimeOut = null;
    var streetControl   = jQuery( "#jform_street" );
    var cityControl     = jQuery( "#jform_cityid" );
    var stateControl    = jQuery( "#jform_stateid" );
    var postcodeControl = jQuery( "#jform_postcode" );
    var countryControl  = jQuery( "#jform_countryid" );

        function updateAddressAndReGeocode(){
            geocodeAddress.street   = streetControl.val()   != '' ? streetControl.val() : '';

            geocodeAddress.city     = cityControl.find('option:selected').val()      != '' ? cityControl.find('option:selected').text() : '';

            geocodeAddress.state    = stateControl.find('option:selected').val()     != '' ? stateControl.find('option:selected').text() : '';

            geocodeAddress.postcode = postcodeControl.val()  != '' ? postcodeControl.val() : '';

            geocodeAddress.country  = countryControl.find('option:selected').val()   != '' ? countryControl.find('option:selected').text() : '';
            
            reGeocode();
        }

    var geocodeAddress = {
        street: "",
        city: "",
        state: "",
        postcode: "",
        country: ""
    };
    
    jQuery(function(){

        jQuery(streetControl).on('keyup',function(){
            if(addressChangeTimeOut != null) clearTimeout(addressChangeTimeOut);
            addressChangeTimeOut = setTimeout(updateAddressAndReGeocode, 1000);
        });

        jQuery(cityControl).on('change',function(){
            updateAddressAndReGeocode();
        });

        jQuery(stateControl).on('change',function()   {
            updateAddressAndReGeocode();
        });

        jQuery(postcodeControl).on('keyup',function(){
            if(addressChangeTimeOut != null) clearTimeout(addressChangeTimeOut);
            addressChangeTimeOut = setTimeout(updateAddressAndReGeocode, 1000);
        });

        jQuery(countryControl).on('change',function(){
            updateAddressAndReGeocode();
        });

        jQuery( "#jform_owncoords1" ).on('change',function(){
            if(jQuery(this).is(':checked')){updateAddressAndReGeocode();}
        });
        
    });

</script>
