<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_hotsheetscripts.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- Begin REN AJAX Scripts -->


<script>
    let listhtml = [];

    jQuery(document).ready(function(){
        initPagination();
    });

    jQuery(function() {
        let script = document.createElement('script');
        script.src = "//maps.googleapis.com/maps/api/js?callback=initMap&key=<?php echo $this->params->get('gmapsapi'); ?>";
        document.body.appendChild(script);
    });

    jQuery(function() {
        jQuery('.lazy').Lazy();
    });

    jQuery(document).ready(function(){

        jQuery("#wait").css("display", "none");
        jQuery("#filters").hide();
        jQuery("#toggle_filters").click(function(){
            jQuery("#filters").slideToggle();
        });

        jQuery(document).ajaxStart(function(){
            jQuery("#wait").css("display", "block");
            jQuery("#ajaxresultdiv").css("display", "none");
        });
        jQuery(document).ajaxComplete(function(){
            jQuery("#wait").css("display", "none");
            jQuery("#ajaxresultdiv").css("display", "block");
        });

        jQuery("#perpagelimit").change(function(){
            SearchPropertiesFilter();
        });

        jQuery("#sortTables").change(function(){
            SearchPropertiesFilter();
        });

        jQuery("#keywords").keyup(debounce(function(){
            if(this.value.length >= 3)
                SearchPropertiesFilter();
            else if( this.value.length === 0 )
                SearchPropertiesFilter('','clear');
        }));

        jQuery("#minpricerange").keyup(debounce(function(){
            if(this.value.length >= 3)
                SearchPropertiesFilter();
        }));

        jQuery("#maxpricerange").keyup(debounce(function(){
            if(this.value.length >= 3)
                SearchPropertiesFilter();
        }));

        jQuery("#minlandrange").keyup(debounce(function(){
            if(this.value.length >= 3)
                SearchPropertiesFilter();
        }));

        jQuery("#maxlandrange").keyup(debounce(function(){
            if(this.value.length >= 3)
                SearchPropertiesFilter();
        }));
        
        jQuery("#categoryIds").change(function(){
            SearchPropertiesFilter();
        });
        jQuery("#transactiontype").change(function(){
            SearchPropertiesFilter();
        });
        jQuery("#marketstatus").change(function(){
            SearchPropertiesFilter();
        });
        jQuery("#agent").change(function(){
            SearchPropertiesFilter();
        });
        jQuery("#city").change(function(){
            SearchPropertiesFilter();
        });
        jQuery("#openhouses").change(function(){
            SearchPropertiesFilter();
        });
        jQuery("#minbeds").change(function(){
            SearchPropertiesFilter();
        });
        jQuery("#minbath").change(function(){
            SearchPropertiesFilter();
        });
        jQuery("#min_areas").change(function(){
            SearchPropertiesFilter();
        });
        jQuery("#max_areas").change(function(){
            SearchPropertiesFilter();
        });

    });

    function initMap(options = false)
    {
        let initConfig = {};
        if(options){
            initConfig = options;
        }else{
            initConfig = {
                zoom: <?php echo $this->params->get('zoom'); ?>,
                center:{
                    lat:  <?php echo $this->params->get('latitude'); ?>,
                    lng: <?php echo $this->params->get('longitude'); ?>
                },
                markers: <?php echo json_encode($this->infomarker); ?>,
                infoWindowContent: <?php echo json_encode($this->infohtml); ?>
            }
        }

        let map;
        let bounds = new google.maps.LatLngBounds();
        let mapOptions = {
            mapTypeId: 'roadmap',
            zoom: initConfig.zoom,
            center: initConfig.center
        };

        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        map.setTilt(50);

        let
            marker,i,
            markers = initConfig.markers,
            infoWindowContent = initConfig.infoWindowContent,
            infoWindow = new google.maps.InfoWindow();

        for( i = 0; i < markers.length; i++ )
        {
            if(markers[i][1] != "" && markers[i][2] != "")
            {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            }

            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0]
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));
            map.fitBounds(bounds);
        }
    }

    function SearchPropertiesFilter(page,clear)
    {
        let keywords = jQuery("#keywords").val();
        let minpricerange =  jQuery("#minpricerange").val();
        let maxpricerange =  jQuery("#maxpricerange").val();
        let minlandrange =  jQuery("#minlandrange").val();
        let maxlandrange =  jQuery("#maxlandrange").val();
        let categoryids = jQuery("#categoryIds option:selected").val();
        let transactiontype = jQuery("#transactiontype option:selected").val();
        let marketstatus = jQuery("#marketstatus option:selected").val();
        let agent = jQuery("#agent option:selected").val();
        let city = jQuery("#city option:selected").val();
        let openhouses = jQuery("#openhouses option:selected").val();
        let minbeds = jQuery("#minbeds option:selected").val();
        let minbath = jQuery("#minbath option:selected").val();
        let min_areas = jQuery("#min_areas option:selected").val();
        let max_areas = jQuery("#max_areas option:selected").val();
        let sorttable = jQuery("#sortTables option:selected").val();
        let perpagelimit = jQuery("#perpagelimit option:selected").val();

        page = (page && page != "") ? page : 0;
        clear = (clear && clear != "") ? clear : '';

        jQuery("#ajaxresultdiv").empty().show("#wait");

        if(clear == 'clear') {
            jQuery.ajax({
                type: "POST",
                data: {
                    'filter': {
                        "keywords":"","minpricerange":minpricerange,"maxpricerange":maxpricerange,
                        "minlandrange":minlandrange,"maxlandrange":maxlandrange,"categoryids":categoryids,
                        "transactiontype":transactiontype,"marketstatus":marketstatus,
                        "agent":agent,"city":city,"openhouses":openhouses,"minbeds":minbeds,
                        "minbath":minbath,"min_areas":min_areas,"max_areas":max_areas
                    },
                    'list':{
                        "page":page,
                        "limit":perpagelimit,
                        "sort":sorttable,
                    },
                    'componentparams':{
                        "zoom":<?php echo $this->params->get('zoom'); ?>,
                        "latitude":<?php echo $this->params->get('latitude'); ?>,
                        "longitude":<?php echo $this->params->get('longitude'); ?>
                    },
                    'active_menu_item_id': <?php echo $this->activeMenuItemId;?>
                },
                url: "<?php echo JUri::base();?>index.php?option=com_realestatenow&task=hotsheet.display&format=json",
                success: function(data)
                {
                    initMap(data.data.mapOptions);
                    listhtml = data.data.listhtml;

                    removeHash();
                    jQuery('#pagination').pagination('selectPage', 1);
                    jQuery('#pagination').pagination('updateItems', data.data.pagination.totalItems);
                    jQuery('#pagination').pagination('updateItemsOnPage', data.data.pagination.limit);

                    jQuery("#wait").hide();
                    jQuery("#ajaxresultdiv").empty().append(listhtml.join(''));
                }
            });
        } else {
            jQuery.ajax({
                type: "POST",
                data: {
                    'filter': {
                        "keywords":keywords,"minpricerange":minpricerange,"maxpricerange":maxpricerange,
                        "minlandrange":minlandrange,"maxlandrange":maxlandrange,"categoryids":categoryids,
                        "transactiontype":transactiontype,"marketstatus":marketstatus,
                        "agent":agent,"city":city,"openhouses":openhouses,"minbeds":minbeds,
                        "minbath":minbath,"min_areas":min_areas,"max_areas":max_areas
                    },
                    'list':{
                        "page":page,
                        "limit":perpagelimit,
                        "sort":sorttable,
                    },
                    'componentparams':{
                        "zoom":<?php echo $this->params->get('zoom'); ?>,
                        "latitude":<?php echo $this->params->get('latitude'); ?>,
                        "longitude":<?php echo $this->params->get('longitude'); ?>
                    },
                    'active_menu_item_id': <?php echo $this->activeMenuItemId;?>
                },
                url: "<?php echo JUri::base();?>index.php?option=com_realestatenow&task=hotsheet.display&format=json",
                success: function(data)
                {
                    initMap(data.data.mapOptions);
                    listhtml = data.data.listhtml;

                    removeHash();
                    jQuery('#pagination').pagination('selectPage', 1);
                    jQuery('#pagination').pagination('updateItems', data.data.pagination.totalItems);
                    jQuery('#pagination').pagination('updateItemsOnPage', data.data.pagination.limit);

                    jQuery("#wait").hide();
                    jQuery("#ajaxresultdiv").empty().append(listhtml.join(''));
                }
            });
        }
    }

    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            let context = this, args = arguments;
            let later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            let callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    function changePage( pageNumber, event )
    {
        let keywords = jQuery("#keywords").val();
        let minpricerange =  jQuery("#minpricerange").val();
        let maxpricerange =  jQuery("#maxpricerange").val();
        let minlandrange =  jQuery("#minlandrange").val();
        let maxlandrange =  jQuery("#maxlandrange").val();
        let categoryids = jQuery("#categoryIds option:selected").val();
        let transactiontype = jQuery("#transactiontype option:selected").val();
        let marketstatus = jQuery("#marketstatus option:selected").val();
        let agent = jQuery("#agent option:selected").val();
        let city = jQuery("#city option:selected").val();
        let openhouses = jQuery("#openhouses option:selected").val();
        let minbeds = jQuery("#minbeds option:selected").val();
        let minbath = jQuery("#minbath option:selected").val();
        let min_areas = jQuery("#min_areas option:selected").val();
        let max_areas = jQuery("#max_areas option:selected").val();
        let sorttable = jQuery("#sortTables option:selected").val();
        let perpagelimit = jQuery("#perpagelimit option:selected").val();

        jQuery.ajax({
            type: "POST",
            data: {
                'filter': {
                    "keywords":keywords,"minpricerange":minpricerange,"maxpricerange":maxpricerange,
                    "minlandrange":minlandrange,"maxlandrange":maxlandrange,"categoryids":categoryids,
                    "transactiontype":transactiontype,"marketstatus":marketstatus,
                    "agent":agent,"city":city,"openhouses":openhouses,"minbeds":minbeds,
                    "minbath":minbath,"min_areas":min_areas,"max_areas":max_areas
                },
                'list':{
                    "page":pageNumber,
                    "limit":perpagelimit,
                    "sort":sorttable,
                },
                'componentparams':{
                    "zoom":<?php echo $this->params->get('zoom'); ?>,
                    "latitude":<?php echo $this->params->get('latitude'); ?>,
                    "longitude":<?php echo $this->params->get('longitude'); ?>
                },
                'active_menu_item_id': <?php echo $this->activeMenuItemId;?>
            },
            url: "<?php echo JUri::base();?>index.php?option=com_realestatenow&task=hotsheet.display&format=json",
            success: function(data)
            {
                initMap(data.data.mapOptions);
                listhtml = data.data.listhtml;
                jQuery("#wait").hide();
                jQuery("#ajaxresultdiv").empty().append(listhtml.join());
            }
        });
    }

    function initPagination(options = false) {
        let paginationOptions;

        if (options) {
            paginationOptions = options;
        }
        else {
            paginationOptions = {
                totalItems: <?php echo $this->totalproperties;?>,
                totalPages: <?php echo intval( ceil($this->totalproperties / ( $this->active_state_vars['list']['limit'] ?$this->active_state_vars['list']['limit'] : 1 ) ) );?>,
                limit: <?php echo $this->active_state_vars['list']['limit'];?>,
                currentPage: <?php echo $this->active_state_vars['list']['page'];?>
            }
        }

        jQuery('#pagination').pagination({
            items: paginationOptions.totalItems,
            //pages: paginationOptions.totalPages,
            itemsOnPage: paginationOptions.limit,
            currentPage: paginationOptions.currentPage,
            cssStyle: 'light-theme',
            onPageClick: changePage
        });
    }

    function removeHash () {
        let scrollV, scrollH, loc = window.location;
        if ("pushState" in history)
            history.pushState("", document.title, loc.pathname + loc.search);
        else {
            // Prevent scrolling by storing the page's current scroll offset
            scrollV = document.body.scrollTop;
            scrollH = document.body.scrollLeft;

            loc.hash = "";

            // Restore the scroll offset, should be flicker free
            document.body.scrollTop = scrollV;
            document.body.scrollLeft = scrollH;
        }
    }
</script>

<!-- End REN AJAX Scripts -->
