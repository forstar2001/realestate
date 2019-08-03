
         var map = null;
         function GetMap()
         {
             var lat = document.getElementById("jform_latitude").value;
             var long = document.getElementById("jform_longitude").value;
             var key = document.getElementById("bingMapApikey").value;
             
             //set default latitude and longitude if null
             if(lat == ''){
                 lat = 47.60897649185687;
                 document.getElementById("jform_latitude").value = lat;
             }
             if(long == ''){
              long = -122.3304197523438;
              document.getElementById("jform_longitude").value = long;
             }
             
            // Initialize the map
            map = new Microsoft.Maps.Map(document.getElementById("bingMap"),{
                            credentials: key,
                            center: new Microsoft.Maps.Location(lat, long),
                            mapTypeId: Microsoft.Maps.MapTypeId.road,//birdseye can be repalced with any one of arial,  auto, collinsBart, mercator, ordnanceSurvey, road
                            zoom: document.getElementById("bingMapRes").value
                        }); 

            // Retrieve the location of the map center 
            var center = map.getCenter();

            // Add a pin to the center of the map
            var pin = new Microsoft.Maps.Pushpin(center, {icon:"components/com_realestatenow/assets/images/pinImage.png", height:50, width:50, anchor:new 
            Microsoft.Maps.Point(0,50), draggable: true}); 
            map.entities.push(pin);
            
            //Add handler for the map drop event.
            Microsoft.Maps.Events.addHandler(pin, 'dragend', endDragDetails);


         }

          endDragDetails = function (e) {
                        lastLocation = e.entity.getLocation();
                        currentLatitude = e.entity._location.latitude;
                        currentLongitude = e.entity._location.longitude;
                        e.entity.setLocation(new Microsoft.Maps.Location(currentLatitude, currentLongitude)); //update pin: move back to old position
                        document.getElementById("jform_latitude").value= currentLatitude;
                        document.getElementById("jform_longitude").value= currentLongitude;
                         };

         function reGeocode(){
             if(jQuery( "#jform_owncoords0" ).is(':checked')) return;

             //var street = jQuery( "#jform_street" ).val() != ''
             //    ? jQuery( "#jform_street" ).val() : null ;
//
             //var country = jQuery( "#jform_countryid option:selected" ).val() != ''
             //    ? jQuery( "#jform_countryid option:selected" ).text() : null ;
//
             //var state = jQuery( "#jform_stateid option:selected" ).val() != ''
             //    ? jQuery( "#jform_stateid option:selected" ).text() : null ;
//
             //var zipcode =  jQuery( "#jform_postcode" ).val() != ''
             //    ? jQuery( "#jform_postcode" ).val() : null ;
//
             //var city =  jQuery( "#jform_cityid option:selected" ).val() != ''
             //    ? jQuery( "#jform_cityid option:selected" ).text() : null ;


             var url =
                 '//dev.virtualearth.net/REST/v1/Locations/' +
                 geocodeAddress.country + '/' +
                 geocodeAddress.state + '/' +
                 geocodeAddress.postcode + '/' +
                 geocodeAddress.city + '/' +
                 geocodeAddress.street +
                 '?key='+document.getElementById("bingMapApikey").value;

             jQuery.ajax({
                 url: url,
                 dataType: "jsonp",
                 jsonp: "jsonp",
                 success: function (data) {
                     var resourceSet = data.resourceSets.pop();
                     var resource =  resourceSet.resources.pop();
                     var geocodePoint = resource.geocodePoints.pop();

                     jQuery("#jform_latitude").val(geocodePoint.coordinates[0]);
                     jQuery("#jform_longitude").val(geocodePoint.coordinates[1]);
                     GetMap();
                 },
                 error: function (e) {
                     alert(e.statusText);
                 }
             });
         }
                         
        