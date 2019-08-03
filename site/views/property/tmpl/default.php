<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/* JHTML::_('behavior.modal'); */
require_once( JPATH_BASE.'/components/com_mailto/helpers/mailto.php' );


?>
<?php echo $this->toolbar->render(); ?>
<div class="uk-container">
    <?php if ($this->params->get('property_layout') == 2) : ?>
        <?php echo $this->loadTemplate('propertylayoutflat'); ?>
    <?php elseif ($this->params->get('property_layout') == 3) : ?>
        <?php echo $this->loadTemplate('property-tabbed'); ?>
    <?php elseif ($this->params->get('property_layout') == 4) : ?>
        <?php echo $this->loadTemplate('property-accordion'); ?>
    <?php elseif ($this->params->get('property_layout') == 5) : ?>
        <?php echo $this->loadTemplate('property-quickgrid'); ?>
    <?php else: ?>
        <?php echo $this->loadTemplate('property-grid'); ?>
    <?php endif; ?>

<!-- Disclaimer -->
<div class="uk-panel uk-panel-box uk-panel-box-primary uk-width-medium-1-1">
  <?php if($this->item->mlslookup!=''): ?>
  <h6 class="uk-margin"><?php echo JText::_('COM_REALESTATENOW_DISCLAIMER'); ?></h6>
  <div class="uk-grid">
    <div class="uk-width-2-3">
      <p class="uk-text-small"><?php echo $this->item->mls_mls_disclaimer; ?></p>
    </div>
    <div class="uk-width-1-3"> <img class="uk-thumbnail uk-thumbnail-mini" src="<?php echo JURI::root().$this->item->mls_mls_image; ?>" width="800" height="280" alt="MLS Image"> </div>
  </div>
  <?php endif; ?>
  <div>Last updated on <?php echo $this->item->modified; ?></div>
    <div class="uk-text-small"><?php echo JText::_('COM_REALESTATENOW_LISTING_COURTESY_OF'); ?> <?php if (JComponentHelper::getParams('com_realestatenow')->get('presentedby') == 1): ?>
    <?php echo '<b>'.$this->item->agent_name.' with '.$this->item->agency_name.'</b>'; ?>
    <?php else: ?>
    <?php echo '<b>'.$this->item->agency_name.'</b>'; ?>
    <?php endif; ?>
</div>
  </div>
<!-- End Disclaimer -->

<!--[INSERTED$$$$]--><!--609-->
<?php if ($this->params->get('show_footer') == 1): ?>
<div class="uk-alert uk-container uk-text-center">Powered by <a href="https://realestatesitesnow.com" target="_blank">Real Estate NOW!</a><br>Listing data processed by <a href="https://mostwantedwebhosting.com/ipals">iPALS (Internet Properties All Listings Software</a></div>
<?php endif; ?>
<!--[/INSERTED$$$$]-->
</div>
<?php if ($this->params->get('map_provider') == '1') { ?>
    <script>
        var map;

        function initMap() {
            if (typeof google == "undefined") {
                setTimeout(function () {
                    initMap();
                    return;
                }, 1000)
            }
            var place = {
                lat: <?php echo ($this->item->latitude != '') ? $this->item->latitude : '47.6149942';?>,
                lng: <?php echo ($this->item->longitude != '') ? $this->item->longitude : '-122.4759886'; ?>
            };

            var zoom = <?php echo ($this->params->get('zoom') != '') ? $this->params->get('zoom') : '10';?>;

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: zoom,
                center: place
            });

            var marker = new google.maps.Marker({
                position: place,
                map: map
            });

            // We get the map's default panorama and set up some defaults.
            // Note that we don't yet set it visible.
            panorama = map.getStreetView();
            panorama.setPosition(place);
            panorama.setPov(/** @type {google.maps.StreetViewPov} */({
                heading: 265,
                pitch: 0
            }));
        }

        function toggleStreetView() {
            var toggle = panorama.getVisible();
            if (toggle == false) {
                panorama.setVisible(true);
            } else {
                panorama.setVisible(false);
            }
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->params->get('gmapsapi'); ?>">
    </script>
<?php }
if ($this->params->get('map_provider') == '2') {
    $doc = JFactory::getDocument();
    //$doc->addScript(JURI::root()."components/com_realestatenow/assets/js/bingmap.min.js");
    $doc->addScript("https://www.bing.com/api/maps/mapcontrol");
    ?>
    <!--<script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"  charset="UTF-8"></script>-->

    <script>
        //jQuery(function(){
        //    jQuery('<script>')
        //        .attr('type', 'text/javascript')
        //        .attr('src', 'https://www.bing.com/api/maps/mapcontrol')
        //        //.attr('async', 'true')
        //        //.attr('defer', 'true')
        //        .appendTo('body');
        //
        //    ////initMap(mapOptions);
        //});


        var map;

        function initMap() {
            if (typeof Microsoft.Maps.Location != "function") {
                setTimeout(function () {
                    initMap();
                    return;
                }, 1000)
            }
            var lat = <?php echo ($this->item->latitude != '') ? $this->item->latitude : '47.6149942';?>;
            var long = <?php echo ($this->item->longitude != '') ? $this->item->longitude : '-122.4759886'; ?>;
            var center = new Microsoft.Maps.Location(lat, long);

            // Initialize the map
            map = new Microsoft.Maps.Map(document.getElementById("map"), {
                credentials: "<?php echo $this->params->get('bingmapsapi'); ?>",
                center: center,
                mapTypeId: Microsoft.Maps.MapTypeId.road,//birdseye can be repalced with any one of arial,  auto, collinsBart, mercator, ordnanceSurvey, road
                zoom: <?php if ($this->params->get('property_map_zoom') != '') echo $this->params->get('property_map_zoom'); else {
                    echo '10';
                }?>
            });

            // Retrieve the location of the map center


            // Add a pin to the center of the map
            var pin = new Microsoft.Maps.Pushpin(center,
                {
                    //icon:"components/com_realestatenow/assets/images/BluePushpin.png",
                    icon: 'https://ecn.dev.virtualearth.net/mapcontrol/v7.0/7.0.20150902134620.61/i/poi_search.png',
                    height: 50,
                    width: 50,
                    anchor: new Microsoft.Maps.Point(0, 50),
                    draggable: false
                });
            map.entities.push(pin);
        }

    </script>
    <?php
}
?>
<!-- Single item view end -->
<script>
    jQuery(document).ready(function () {
        <?php if(isset($_REQUEST['sortTable']) && ($_REQUEST['sortTable'] != NULL) ) { ?>
        jQuery('.sortTable').val("<?php echo $_REQUEST['sortTable']; ?>");
        <?php } ?>
    });
</script>
<?php
$this->item->print = JRequest::getVar('print');
if ($this->item->print == 1) {
    ?>
<?php } ?>
  

