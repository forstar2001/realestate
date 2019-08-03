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

	<?php echo JLayoutHelper::render('property.main_details_above', $this); ?>
<div class="form-horizontal">

	<?php echo JHtml::_('bootstrap.startTabSet', 'propertyTab', array('active' => 'main_details')); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'propertyTab', 'main_details', JText::_('COM_REALESTATENOW_PROPERTY_MAIN_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('property.main_details_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('property.main_details_right', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'propertyTab', 'description', JText::_('COM_REALESTATENOW_PROPERTY_DESCRIPTION', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('property.description_left', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'propertyTab', 'general', JText::_('COM_REALESTATENOW_PROPERTY_GENERAL', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('property.general_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('property.general_right', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'propertyTab', 'listing_details', JText::_('COM_REALESTATENOW_PROPERTY_LISTING_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
<!--[REPLACED$$$$]--><!--335-->
		</div>
		<!--<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php //echo JLayoutHelper::render('property.listing_details_fullwidth', $this); ?>
			</div>
		</div>-->
		<div class="row-fluid form-horizontal-desktop">
		<?php
			if(isset($_GET['id'])){
				$ids = $_GET['id'];
		?>
			<div class="span6">
				<?php echo JLayoutHelper::render('property.listing_details_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('property.listing_details_right', $this); ?>
			</div>
			<?php }else{
				?>
				<div class="span12">
				<?php echo JLayoutHelper::render('property.listing_details_fullwidth', $this); ?>
				</div>
				<?php
			} ?>
<!--[/REPLACED$$$$]-->
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'propertyTab', 'open_houses', JText::_('COM_REALESTATENOW_PROPERTY_OPEN_HOUSES', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('property.open_houses_left', $this); ?>
			</div>
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('property.open_houses_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'propertyTab', 'media', JText::_('COM_REALESTATENOW_PROPERTY_MEDIA', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('property.media_left', $this); ?>
			</div>
		</div>
<!--[INSERTED$$$$]--><!--6-->
<?php if((int) $this->item->id) : ?>

<div class="span11"> 
  <!-- (start) Section to add images using fileinput -->
  <div id="actions" class="row">
    <div class="control-group"> Upload Property Images or Drop here </div>
    <div class="col-lg-12">
      <div class="form-group">
        <input id="images"  name='file[]' type="file" multiple >
      </div>
    </div>
  </div>
  <!-- (end) Section to add images using fileinput --> 
  
</div>
<?php //var_dump($this->item->images);?>
<script>

                        jQuery("#images").fileinput({
                            uploadAsync: false,
                            overwriteInitial: false,
                            allowedFileExtensions: ['jpg','jpeg','png','gif'],
                            uploadUrl: "<?php echo JURI::root().'administrator/index.php?option=com_realestatenow&task=property.uploadImage&propertyId='.(int) $this->item->id; ?>", // your upload server url
                            initialPreview: [
                                <?php
                                foreach($this->item->images as $image):
                                    if(strpos($image->path,'http') === 0){
                                        if( strrpos($image->original_filename,'.' ) ==  ( strlen($image->original_filename) - 1) )
                                            $image_path = $image->path.rtrim( $image->original_filename,'.');
                                        else
                                            $image_path = $image->path;
                                    }else{
                                        $image_path = JURI::root().$image->path.$image->filename;
                                    }
                                ?>
                                '<img src="<?php echo $image_path; ?>" class="file-preview-image" title="<?php echo $image->title ?>" alt="<?php echo $image->title ?>" >',
                                <?php
                                endforeach;
                                ?>
                            ],
                            initialPreviewConfig: [
                                <?php
                                    foreach($this->item->images as $image):
                                        if(strpos($image->path,'http')===0){
                                            $head = array_change_key_case( get_headers($image->path.$image->original_filename , TRUE) );
                                            $filesize = $head['content-length'];
                                        }else{
                                            $filesize = filesize(JPATH_ROOT.$image->path.$image->original_filename);
                                        }
                                ?>
                                {
                                    size: <?php echo $filesize;?>,
                                    key: <?php echo $image->id; ?>,
                                    caption: '<?php echo $image->title ?>',
                                    width: '160px',
                                    url: "<?php echo JURI::root().'administrator/index.php?option=com_realestatenow&task=property.deleteImage&propertyId='.(int) $this->item->id; ?>"
                                },
                                <?php
                                    endforeach;
                                ?>
                            ]


                        });

                        /*function fireFileSorted(){
                         jQuery(document).on("filesorted", '#images',function(event, params){
                         console.log('file sorted');
                         });
                         }

                         jQuery(document).ready(fireFileSorted);*/

                        jQuery(function(){
                            jQuery(document).on("filesorted", '#images',function(event, params){
                                data = params.stack.map(function(value,index){
                                    var obj = {
                                        key: value.key,
                                        index: index
                                    };
                                    return obj;
                                });
                                console.log(data);
                                jQuery.ajax({
                                    url: "<?php echo JURI::root().'administrator/index.php?option=com_realestatenow&task=property.orderImages&propertyId='.(int) $this->item->id; ?>",
                                    data: {ordering:JSON.stringify(data)},
                                    method: 'POST',
                                    
                                    success: function (data) {
                                    
                                    }
                                });
                            });
                        });
                    </script>
<?php endif; ?>
<!--[/INSERTED$$$$]-->
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'propertyTab', 'map_details', JText::_('COM_REALESTATENOW_PROPERTY_MAP_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('property.map_details_left', $this); ?>
			</div>
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('property.map_details_fullwidth', $this); ?>
			</div>
		</div>
<!--[INSERTED$$$$]--><!--5-->

<div class="span12">
  <?php if($componentParams['map_provider'] == '1'): ?>
  <div id="googleMap" style="height:<?php echo (int)$componentParams['mw_mapheight'].'px'?>; width:<?php echo (int)$componentParams['mw_mapwidth'].'px'?>;"></div>
  <input type="hidden" id="googleMapRes" value="<?php echo $componentParams['zoom'];?>" />
  <!--<input type="hidden" id="googleMapApikey" value="<?php echo $componentParams['gmapsapi'];?>" />-->
  <?php endif; ?>
  <?php if($componentParams['map_provider'] == '2'): ?>
  <div id="bingMap" style="height:<?php echo (int)$componentParams['mw_mapheight'].'px'?>; width:<?php echo (int)$componentParams['mw_mapwidth'].'px'?>;;  position: absolute;"></div>
  <input type="hidden" id="bingMapRes" value="<?php echo $componentParams['zoom'];?>" />
  <input type="hidden" id="bingMapApikey" value="<?php echo $componentParams['bingmapsapi'];?>" />
  <?php endif; ?>
  <?php if($componentParams['map_provider'] == '3'): ?>
	<!-- HERE.COM Code Goes Here --> 
  <?php endif; ?>
</div>
<!--[/INSERTED$$$$]-->
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php $this->ignore_fieldsets = array('details','metadata','vdmmetadata','accesscontrol'); ?>
	<?php $this->tab_name = 'propertyTab'; ?>
	<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

	<?php if ($this->canDo->get('property.delete') || $this->canDo->get('property.edit.created_by') || $this->canDo->get('property.edit.state') || $this->canDo->get('property.edit.created')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'propertyTab', 'publishing', JText::_('COM_REALESTATENOW_PROPERTY_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('property.publishing', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('property.metadata', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php if ($this->canDo->get('core.admin')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'propertyTab', 'permissions', JText::_('COM_REALESTATENOW_PROPERTY_PERMISSION', true)); ?>
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
		<input type="hidden" name="task" value="property.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	</div>
</div>
</form>
</div>

<script type="text/javascript">

// [Interpretation 9394] #jform_owncoords listeners for owncoords_vvvvvwa function
jQuery('#jform_owncoords').on('keyup',function()
{
	var owncoords_vvvvvwa = jQuery("#jform_owncoords input[type='radio']:checked").val();
	vvvvvwa(owncoords_vvvvvwa);

});
jQuery('#adminForm').on('change', '#jform_owncoords',function (e)
{
	e.preventDefault();
	var owncoords_vvvvvwa = jQuery("#jform_owncoords input[type='radio']:checked").val();
	vvvvvwa(owncoords_vvvvvwa);

});

// [Interpretation 9394] #jform_openhouse listeners for openhouse_vvvvvwb function
jQuery('#jform_openhouse').on('keyup',function()
{
	var openhouse_vvvvvwb = jQuery("#jform_openhouse input[type='radio']:checked").val();
	vvvvvwb(openhouse_vvvvvwb);

});
jQuery('#adminForm').on('change', '#jform_openhouse',function (e)
{
	e.preventDefault();
	var openhouse_vvvvvwb = jQuery("#jform_openhouse input[type='radio']:checked").val();
	vvvvvwb(openhouse_vvvvvwb);

});

// [Interpretation 9394] #jform_showprice listeners for showprice_vvvvvwc function
jQuery('#jform_showprice').on('keyup',function()
{
	var showprice_vvvvvwc = jQuery("#jform_showprice input[type='radio']:checked").val();
	vvvvvwc(showprice_vvvvvwc);

});
jQuery('#adminForm').on('change', '#jform_showprice',function (e)
{
	e.preventDefault();
	var showprice_vvvvvwc = jQuery("#jform_showprice input[type='radio']:checked").val();
	vvvvvwc(showprice_vvvvvwc);

});

// [Interpretation 9394] #jform_showprice listeners for showprice_vvvvvwd function
jQuery('#jform_showprice').on('keyup',function()
{
	var showprice_vvvvvwd = jQuery("#jform_showprice input[type='radio']:checked").val();
	vvvvvwd(showprice_vvvvvwd);

});
jQuery('#adminForm').on('change', '#jform_showprice',function (e)
{
	e.preventDefault();
	var showprice_vvvvvwd = jQuery("#jform_showprice input[type='radio']:checked").val();
	vvvvvwd(showprice_vvvvvwd);

});

// [Interpretation 9394] #jform_showprice listeners for showprice_vvvvvwe function
jQuery('#jform_showprice').on('keyup',function()
{
	var showprice_vvvvvwe = jQuery("#jform_showprice input[type='radio']:checked").val();
	vvvvvwe(showprice_vvvvvwe);

});
jQuery('#adminForm').on('change', '#jform_showprice',function (e)
{
	e.preventDefault();
	var showprice_vvvvvwe = jQuery("#jform_showprice input[type='radio']:checked").val();
	vvvvvwe(showprice_vvvvvwe);

});

// [Interpretation 9394] #jform_sold listeners for sold_vvvvvwf function
jQuery('#jform_sold').on('keyup',function()
{
	var sold_vvvvvwf = jQuery("#jform_sold input[type='radio']:checked").val();
	vvvvvwf(sold_vvvvvwf);

});
jQuery('#adminForm').on('change', '#jform_sold',function (e)
{
	e.preventDefault();
	var sold_vvvvvwf = jQuery("#jform_sold input[type='radio']:checked").val();
	vvvvvwf(sold_vvvvvwf);

});



	//autofill empty name field on save
	if( (jQuery('#jform_name').val() == '' )){
		var name;
		var street = jQuery('#jform_street').val() != ''
			? jQuery('#jform_street').val().replace(/\s+/g, '-').replace(/\.+/g,'').toLowerCase() + '-' : '';

		var city = jQuery('#jform_cityid').val() != ''
			? jQuery("#jform_cityid option:selected").text().toLowerCase() + '-' : '';

		var state = jQuery('#jform_stateid').val() != ''
			?  jQuery("#jform_stateid option:selected").text().toLowerCase() + '-': '';

		var postcode = jQuery('#jform_postcode').val() != ''
			?  jQuery('#jform_postcode').val() : '';

		name = street + city + state + postcode;

        if (name.charAt(name.length - 1) == '-') {
            name = name.substr(0, name.length - 1);
        }

        jQuery('#jform_name').val(name);

	}

    // Image Code
     <?php
    // make sure these frameworks also load.
    JHtml::_('jquery.framework');
    JHtml::_('jquery.ui');
    $doc = JFactory::getDocument();
    //loaded from the code.jquery.com site
    $doc->addStylesheet('//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
    $doc->addStylesheet('//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.1/jquery-ui-timepicker-addon.min.css');
    $doc->addScript('//code.jquery.com/ui/1.10.3/jquery-ui.min.js');
    $doc->addScript('//cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.1/jquery-ui-timepicker-addon.min.js');
    $doc->addScript(JURI::base().'components/com_realestatenow/assets/js/sortable.js');
    $doc->addScript(JURI::base().'components/com_realestatenow/assets/js/fileinput.js');
//    $doc->addStylesheet('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css');
    $doc->addStylesheet('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    $doc->addStylesheet(JURI::base().'components/com_realestatenow/assets/css/fileinput.css');
    $doc->addStylesheet(JURI::base().'components/com_realestatenow/assets/css/fileinput2.css');
    ?>
    <?php $fieldNrs = range(1,50,1); $fieldType = array('ohend'=>'openhouseinfo','ohstart'=>'openhouseinfo');?>

    jQuery('input.form-field-repeatable').on('row-add',function(e){
        <?php foreach($fieldType as $type=>$field):?>
        <?php foreach($fieldNrs as $nr):?>
        jQuery('#jform_<?php echo $field; ?>_fields_<?php echo $type; ?>-<?php echo $nr;?>').datetimepicker(
            {
                minDate:-1,
                prevText:'',
                nextText:'',
                maxDate:'+36M',
                firstDay:1,
                dateFormat:'yy-mm-dd',
                onSelect: function(dateText, inst){
                    jQuery('#jform_<?php echo $field; ?>_fields_<?php echo $type; ?>-<?php echo $nr; ?>').val(dateText);
                }
            });
        <?php endforeach; ?>
        <?php endforeach; ?>
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

// (start) Section to initiate HERE.COM map
// (end) Section to initiate HERE.COM map
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
            addressChangeTimeOut = setTimeout(updateAddressAndReGeocode, 5000);
        });

        jQuery(cityControl).on('change',function(){
            updateAddressAndReGeocode();
        });

        jQuery(stateControl).on('change',function()   {
            updateAddressAndReGeocode();
        });

        jQuery(postcodeControl).on('keyup',function(){
            if(addressChangeTimeOut != null) clearTimeout(addressChangeTimeOut);
            addressChangeTimeOut = setTimeout(updateAddressAndReGeocode, 5000);
        });

        jQuery(countryControl).on('change',function(){
            updateAddressAndReGeocode();
        });

        jQuery( "#jform_owncoords1" ).on('change',function(){
            if(jQuery(this).is(':checked')){updateAddressAndReGeocode();}
        });
        
    });

</script>
