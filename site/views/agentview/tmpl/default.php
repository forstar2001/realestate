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

// Load JQuery Framework
JHtml::_('jquery.framework');

// Set Global Parameters
$globalParams = JComponentHelper::getParams('com_realestatenow');

// Set the heading of the page
$heading = ($this->params->get('page_heading')) ? $this->params->get('page_heading'):(isset($this->menu->title)) ? $this->menu->title:'';

if (isset($_COOKIE['filtered_items'])) {
	unset($_COOKIE['filtered_items']);
	setcookie('filtered_items', '', time() - 3600, '/');
}


?>
<form action="<?php echo JRoute::_('index.php?option=com_realestatenow'); ?>" method="post" name="adminForm" id="adminForm">
<?php echo $this->toolbar->render(); ?><!-- Single agent view start -->

<div class="uk-container">
    <div class="uk-block">
        <div>
            <h3 class="uk-article-title"><?php echo $this->agent->name; ?></h3>
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-3">
            <?php if (empty($this->agent->image)) { ?>
                <div><img class='uk-thumbnail'
                          src="<?php echo JURI::root() . '/media/com_realestatenow/images/No_image_available.png'; ?>">
                </div>
            <?php } else { ?>
                <div><img class='uk-thumbnail' src="<?php echo $this->agent->image; ?>"
                          alt="<?php echo $this->agent->name; ?>"></div>
            <?php } ?>
        </div>
        <div class="uk-width-2-3">
            <?php if (!empty($this->agent->phone)) { ?>
                <div><i class="uk-icon-justify uk-icon-phone"></i> <?php echo JText::_('COM_REALESTATENOW_PHONE'); ?>
                    <span><?php echo ' ' . $this->agent->phone; ?></span></div>
            <?php }
            if (!empty($this->agent->mobile)) { ?>
                <div><i class="uk-icon-justify uk-icon-mobile"></i> <?php echo JText::_('COM_REALESTATENOW_MOBILE'); ?>
                    <span><?php echo ' ' . $this->agent->mobile; ?></span></div>
            <?php }
            if (!empty($this->agent->fax)) { ?>
                <div><i class="uk-icon-justify uk-icon-fax"></i> <?php echo JText::_('COM_REALESTATENOW_FAX'); ?>
                    <span><?php echo ' ' . $this->agent->fax; ?></span></div>
            <?php }
            if (!empty($this->agent->website)) { ?>
                <div><i class="uk-icon-justify uk-icon-globe"></i> <?php echo JText::_('COM_REALESTATENOW_WEBSITE'); ?><span><a
                                href="<?php $this->agent->website; ?>"
                                target="_blank"><?php echo ' ' . $this->agent->website; ?></a></span></div>
            <?php }
            if (!empty($this->agent->blog)) { ?>
                <div><i class="uk-icon-justify uk-icon-newspaper-o"></i> <?php echo JText::_('COM_REALESTATENOW_BLOG'); ?><span><a
                                href="<?php $this->agent->blog; ?>"
                                target="_blank"><?php echo ' ' . $this->agent->blog; ?></a></span></div>
            <?php }
            if (!empty($this->agent->skype)) { ?>
                <a class="uk-icon-button uk-icon-skype" data-uk-tooltip="{pos:'top'}" title="Skype Me"
                   href="skype:<?php $this->agent->skype; ?>.'?chat'"></a>
            <?php } ?>
            <?php if (!empty($this->agent->fbook)) { ?>
                <a class="uk-icon-button uk-icon-facebook" data-uk-tooltip="{pos:'top'}" title="Facebook"
                   href="//facebook.com/<?php echo $this->agent->fbook; ?>" target="_blank"></a>
            <?php }
            if (!empty($this->agent->pinterest)) { ?>
                <a class="uk-icon-button uk-icon-pinterest" data-uk-tooltip="{pos:'top'}" title="Pinterest"
                   href="//pinterest.com/<?php echo $this->agent->pinterest; ?>" target="_blank"></a>
            <?php }
            if (!empty($this->agent->gplus)) { ?>
                <a class="uk-icon-button uk-icon-google-plus" data-uk-tooltip="{pos:'top'}" title="Google+"
                   href="//google.com/+<?php echo $this->agent->gplus; ?>" target="_blank"></a>
            <?php }
            if (!empty($this->agent->twitter)) { ?>
                <a class="uk-icon-button uk-icon-twitter" data-uk-tooltip="{pos:'top'}" title="Twitter"
                   href="//twitter.com/<?php echo $this->agent->twitter; ?>" target="_blank"></a>
            <?php }
            if (!empty($this->agent->youtube)) { ?>
                <a class="uk-icon-button uk-icon-youtube" data-uk-tooltip="{pos:'top'}" title="YouTube"
                   href="//youtube.com/<?php echo $this->agent->youtube; ?>" target="_blank"></a>
            <?php }
            if (!empty($this->agent->linkedin)) { ?>
                <a class="uk-icon-button uk-icon-linkedin-square" data-uk-tooltip="{pos:'top'}" title="LinkedIn"
                   href="//linkedin.com/<?php echo $this->agent->linkedin; ?>" target="_blank"></a>
            <?php } ?>
        </div>
        <div></div>
    </div>
    <?php if ($this->items): ?>
        <?php if ($globalParams->get('agent_properties_display') == 2) : ?>
            <?php echo $this->loadTemplate('agent-properties-tab'); ?>
        <?php elseif ($globalParams->get('agent_properties_display') == 3) : ?>
            <?php echo $this->loadTemplate('agent-properties-accordion'); ?>
        <?php else: ?>
            <?php echo $this->loadTemplate('agent-properties-grid'); ?>
        <?php endif; ?>
    <?php else: ?>
        <div class="uk-alert uk-alert-warning" data-uk-alert><a href="" class="uk-alert-close uk-close"></a>
            <p><?php echo JText::_('COM_REALESTATENOW_NO_PROPERTIES_WERE_FOUND_FOR_THIS_AGENT'); ?></p>
        </div>
    <?php endif; ?>

<!--[INSERTED$$$$]--><!--609-->
<?php if ($this->params->get('show_footer') == 1): ?>
<div class="uk-alert uk-alert-primary uk-container uk-text-center">Powered by <a href="https://realestatesitesnow.com" target="_blank">Real Estate NOW!</a><br>Listing data processed by <a href="https://mostwantedwebhosting.com/ipals">iPALS (Internet Properties All Listings Software</a></div>
<?php endif; ?>
<!--[/INSERTED$$$$]-->
</div>
<!-- Single agent view end -->
<?php if ($globalParams->get('map_provider') == '1') { ?>
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
                lat: <?php echo ($this->agent->latitude != '') ? $this->agent->latitude : '47.6149942';?>,
                lng: <?php echo ($this->agent->longitude != '') ? $this->agent->longitude : '-122.4759886'; ?>
            };

            var zoom = <?php echo ($globalParams->get('agent_map_zoom') != '') ? $globalParams->get('agent_map_zoom') : '10';?>;

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
            src="https://maps.googleapis.com/maps/api/js?key=<?php echo $globalParams->get('gmapsapi'); ?>">
    </script>
<?php }
if ($globalParams->get('map_provider') == '2') {
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
            var lat = <?php echo ($this->agent->latitude != '') ? $this->agent->latitude : '47.6149942';?>;
            var long = <?php echo ($this->agent->longitude != '') ? $this->agent->longitude : '-122.4759886'; ?>;
            var center = new Microsoft.Maps.Location(lat, long);

            // Initialize the map
            map = new Microsoft.Maps.Map(document.getElementById("map"), {
                credentials: "<?php echo $globalParams->get('bingmapsapi'); ?>",
                center: center,
                mapTypeId: Microsoft.Maps.MapTypeId.road,//birdseye can be repalced with any one of arial,  auto, collinsBart, mercator, ordnanceSurvey, road
                zoom: <?php if ($globalParams->get('agent_map_zoom') != '') echo $globalParams->get('agent_map_zoom'); else {
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
<!-- Single city view end -->
<script>
    jQuery(document).ready(function () {
        <?php if(isset($_REQUEST['sortTable']) && ($_REQUEST['sortTable'] != NULL) ) { ?>
        jQuery('.sortTable').val("<?php echo $_REQUEST['sortTable']; ?>");
        <?php } ?>
    });
</script> 


<?php if (isset($this->items) && isset($this->pagination) && isset($this->pagination->pagesTotal) && $this->pagination->pagesTotal > 1): ?>
	<div class="pagination">
		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> <?php echo $this->pagination->getLimitBox(); ?></p>
		<?php endif; ?>
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>
