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

// Set the heading of the page
$heading = ($this->params->get('page_heading')) ? $this->params->get('page_heading'):(isset($this->menu->title)) ? $this->menu->title:'';

if (isset($_COOKIE['filtered_items'])) {
	unset($_COOKIE['filtered_items']);
	setcookie('filtered_items', '', time() - 3600, '/');
}


?>
<form action="<?php echo JRoute::_('index.php?option=com_realestatenow'); ?>" method="post" name="adminForm" id="adminForm">
<?php echo $this->toolbar->render(); ?><!-- Single country view start -->

<div class="uk-container">
    <div class="uk-block">
        <div>
            <h3 class="uk-article-title"><?php echo $this->country->name; ?></h3>
        </div>
    </div>
    <?php if ($this->params->get('show_country_image') == '1') : ?>
        <div class="uk-grid">
            <div class="uk-width-1-3">
                <?php if (empty($this->country->image)) { ?>
                    <div><img class='uk-thumbnail'
                              src="<?php echo JURI::root() . '/media/com_realestatenow/images/No_image_available.png'; ?>">
                    </div>
                <?php } else { ?>
                    <div><img class='uk-thumbnail' src="<?php echo $this->country->image; ?>"
                              alt="<?php echo $this->country->name; ?>"></div>
                <?php } ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($this->items): ?>
        <?php if ($this->params->get('country_properties_display') == 2) : ?>
            <?php echo $this->loadTemplate('country-properties-tab'); ?>
        <?php elseif ($this->params->get('country_properties_display') == 3) : ?>
            <?php echo $this->loadTemplate('country-properties-accordion'); ?>
        <?php else: ?>
            <?php echo $this->loadTemplate('country-properties-grid'); ?>
        <?php endif; ?>
    <?php else: ?>
        <div class="uk-alert uk-alert-warning" data-uk-alert><a href="" class="uk-alert-close uk-close"></a>
            <p><?php echo JText::_('COM_REALESTATENOW_NO_COUNTRIES_WERE_FOUND'); ?></p>
        </div>
    <?php endif; ?>

<!--[INSERTED$$$$]--><!--609-->
<?php if ($this->params->get('show_footer') == 1): ?>
<div class="uk-alert uk-alert-primary uk-container uk-text-center">Powered by <a href="https://realestatesitesnow.com" target="_blank">Real Estate NOW!</a><br>Listing data processed by <a href="https://mostwantedwebhosting.com/ipals">iPALS (Internet Properties All Listings Software</a></div>
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
                lat: <?php echo ($this->country->latitude != '') ? $this->country->latitude : '47.6149942';?>,
                lng: <?php echo ($this->country->longitude != '') ? $this->country->longitude : '-122.4759886'; ?>
            };

            var zoom = <?php echo ($this->params->get('country_map_zoom') != '') ? $this->params->get('country_map_zoom') : '10';?>;

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
            var lat = <?php echo ($this->country->latitude != '') ? $this->country->latitude : '47.6149942';?>;
            var long = <?php echo ($this->country->longitude != '') ? $this->country->longitude : '-122.4759886'; ?>;
            var center = new Microsoft.Maps.Location(lat, long);

            // Initialize the map
            map = new Microsoft.Maps.Map(document.getElementById("map"), {
                credentials: "<?php echo $this->params->get('bingmapsapi'); ?>",
                center: center,
                mapTypeId: Microsoft.Maps.MapTypeId.road,//birdseye can be repalced with any one of arial,  auto, collinsBart, mercator, ordnanceSurvey, road
                zoom: <?php if ($this->params->get('country_map_zoom') != '') echo $this->params->get('country_map_zoom'); else {
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
<!-- Single country view end -->
<script>
    jQuery(document).ready(function () {
        <?php if(isset($_REQUEST['sortTable']) && ($_REQUEST['sortTable'] != NULL) ) { ?>
        jQuery('.sortTable').val("<?php echo $_REQUEST['sortTable']; ?>");
        <?php } ?>
    });
</script> 


<!--[REPLACED$$$$]--><!--411-->
<?php if (isset($this->items) && isset($this->pagination) && isset($this->pagination->pagesTotal) && $this->pagination->pagesTotal > 1): ?>
<?php if ($this->params->def('show_pagination_results', 1)) : ?>
<form name="adminForm" method="post">
	<div class="pagination_container">
        <div class="counter pull-left">
            <div class="pagination"></div>
        </div>

        <div class="counter pull-right">
                <div class="pagination_pagenumber"></div>
                <?php echo $this->pagination->getLimitBox(); ?>
            </div>

		<?php //echo $this->pagination->getPagesLinks(); ?>
	</div>
</form>
<?php endif; ?> 
<?php endif; ?> 
<!--[/REPLACED$$$$]-->
