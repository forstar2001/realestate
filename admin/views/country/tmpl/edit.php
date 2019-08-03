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

<div class="form-horizontal">

	<?php echo JHtml::_('bootstrap.startTabSet', 'countryTab', array('active' => 'details')); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'countryTab', 'details', JText::_('COM_REALESTATENOW_COUNTRY_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('country.details_left', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'countryTab', 'map_details', JText::_('COM_REALESTATENOW_COUNTRY_MAP_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('country.map_details_left', $this); ?>
			</div>
		</div>
<!--[INSERTED$$$$]--><!--100-->

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
  <div id="googleMap" style="height:<?php echo (int)$componentParams['mw_mapheight'].'px'?>; width:500px"></div>
  <input type="hidden" id="googleMapRes" value="3" />
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
  <div id="bingMap" style="height:<?php echo (int)$componentParams['mw_mapheight'].'px'?>; width:500px;  position: absolute;"></div>
  <input type="hidden" id="bingMapRes" value="<?php echo $componentParams['zoom'];?>" />
  <input type="hidden" id="bingMapApikey" value="<?php echo $componentParams['bingmapsapi'];?>" />
  <?php endif;
            // (end) Section to initiate Bing map?>
</div>
<!--[/INSERTED$$$$]-->
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php if ($this->canDo->get('property.access')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'countryTab', 'property_listings', JText::_('COM_REALESTATENOW_COUNTRY_PROPERTY_LISTINGS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('country.property_listings_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php $this->ignore_fieldsets = array('details','metadata','vdmmetadata','accesscontrol'); ?>
	<?php $this->tab_name = 'countryTab'; ?>
	<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

	<?php if ($this->canDo->get('country.delete') || $this->canDo->get('country.edit.created_by') || $this->canDo->get('country.edit.state') || $this->canDo->get('country.edit.created')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'countryTab', 'publishing', JText::_('COM_REALESTATENOW_COUNTRY_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('country.publishing', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('country.metadata', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php if ($this->canDo->get('core.admin')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'countryTab', 'permissions', JText::_('COM_REALESTATENOW_COUNTRY_PERMISSION', true)); ?>
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
		<input type="hidden" name="task" value="country.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	</div>
</div>
</form>
</div>

<script type="text/javascript">

// [Interpretation 9394] #jform_owncoords listeners for owncoords_vvvvvvv function
jQuery('#jform_owncoords').on('keyup',function()
{
	var owncoords_vvvvvvv = jQuery("#jform_owncoords input[type='radio']:checked").val();
	vvvvvvv(owncoords_vvvvvvv);

});
jQuery('#adminForm').on('change', '#jform_owncoords',function (e)
{
	e.preventDefault();
	var owncoords_vvvvvvv = jQuery("#jform_owncoords input[type='radio']:checked").val();
	vvvvvvv(owncoords_vvvvvvv);

});



    var addressChangeTimeOut = null;
    var countryControl  = jQuery( "#jform_name" );
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

        countryControl.on('keyup',function(){
            if(addressChangeTimeOut != null) clearTimeout(addressChangeTimeOut);
            addressChangeTimeOut = setTimeout(updateAddressAndReGeocode, 5000);
        });

        jQuery( "#jform_owncoords1" ).on('change',function(){
            if(jQuery(this).is(':checked')){updateAddressAndReGeocode();}
        });

        function updateAddressAndReGeocode(){
            geocodeAddress.country  = countryControl.val() != '' ? countryControl.val() : '';
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

</script>
