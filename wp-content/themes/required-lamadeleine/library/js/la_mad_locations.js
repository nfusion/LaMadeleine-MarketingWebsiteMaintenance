var LaMadLocations = {
        sideMap: null,
        currentLocationObj: {'latitude':null,'longitude':null},
        
        nearestLocationObj: {'latitude':null,'longitude':null},
       
        $locationCta: $('#location-cta'),
        $frontWrapper: function(){
            return this.$locationCta.find('.front-wrapper');
        },
        mapStyles: [{
                    "featureType": "landscape.natural",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#e0d5ab" }
                    ]
                  },
                  {
                    "featureType": "road",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "visibility": "on" },
                      { "color": "#fff6da" }
                    ]
                  },{
                    "featureType": "landscape.man_made",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#e4dbb9" }
                    ]
                  },{
                    "featureType": "poi.business",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#eee4c6" }
                    ]
                  },{
                    "featureType": "poi.attraction",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#eee4c6" }
                    ]
                  },{
                    "featureType": "poi.government",
                    "stylers": [
                      { "color": "#eee4c6" }
                    ]
                  },{
                    "featureType": "poi.medical",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#eee4c6" }
                    ]
                  },{
                    "featureType": "poi.park",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#c0e4ba" }
                    ]
                  },{
                    "featureType": "poi.place_of_worship",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#efe5c6" }
                    ]
                  },{
                    "featureType": "poi.school",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#efe5c6" }
                    ]
                  },{
                    "featureType": "poi.sports_complex",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#efe5c6" }
                    ]
                  },{
                    "featureType": "road.highway.controlled_access",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#ffa93d" }
                    ]
                  },{
                    "featureType": "road.local",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#f1e6c6" }
                    ]
                  },{
                    "featureType": "poi.government",
                    "elementType": "geometry.fill"  }
                ],

    initializeMap:  function(lat, lng, mapContainer) {
        
        var $mapContainer = $('#' + mapContainer);

            if($mapContainer.length){

                /** due to map size (too small) we actually need to offset the center toward the bottom of the map 
                to allow marker to fit
                */
                newLat=parseFloat(lat)+0.007;
                myCenter = new google.maps.LatLng(newLat,lng);

                var styledMap = new google.maps.StyledMapType(LaMadLocations.mapStyles, {name: "La Madeleine"});

                var myLatlng = new google.maps.LatLng(lat,lng),
                    mapOptions = {
                    panControl: false,
                    scrollwheel: false,
                    draggable: false,
                    zoomControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    overviewMapControl: false,  
                    center: myCenter,
                    zoom: 12,
                    mapTypeControlOptions: {
                        mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                    }
                };

                var map = new google.maps.Map(document.getElementById(mapContainer),
                    mapOptions);

                //Associate the styled map with the MapTypeId and set it to display.
                map.mapTypes.set('map_style', styledMap);
                map.setMapTypeId('map_style');

                if(typeof(icon)!='undefined'){
                    displayIcon = '/wp-content/themes/required-lamadeleine/img/map/blue-dot.png';
                } else {
                    displayIcon = '/wp-content/themes/required-lamadeleine/img/map/custom-pin-drop.png';
                }
                var marker = new google.maps.Marker({ 
                                                    position: myLatlng, 
                                                    map: map, 
                                                    title: 'Nearest Location', 
                                                    icon: displayIcon
                                                    });
                this.sideMap = map;
                $('#directionsLinkButton').show();
            } 
        },

        // Accepts location object, returns current day open/close hours as object
        getTodayHours: function (location){
            /** 
                client side date time 
                We could use a lib like moment.js here , but this works well and is low overhead 
            **/
            var weekday=new Array(7);
            weekday[0]="sunday";
            weekday[1]="monday";
            weekday[2]="tuesday";
            weekday[3]="wednesday";
            weekday[4]="thursday";
            weekday[5]="friday";
            weekday[6]="saturday";
            var d=new Date();
            dayIndex = d.getDay();
            dayOfWeek = weekday[dayIndex];
            var today_open = dayOfWeek+'_open';
            var today_close = dayOfWeek+'_close';
            /*************************************/

            var todayHours = {
                open: location[today_open],
                close: location[today_close]
            };

            return todayHours;
        },

        setLocation: function(location, reloadmap, skipCookie){
            
            var mapContainer = 'map',
                todayHours = LaMadLocations.getTodayHours(location);

            if(location.address_2.length > 0){
                var address = location.address + '<br>' + location.address_2;
            }
            else{
                var address = location.address;
            };

            LaMadLocations.nearestLocationObj = location;

            // Full size location widget
            $('#location-info').html('<h4 class="location-title">' + location.title + '</h4>' + '<div class="info-wrapper"><div class="address"><strong>Address:</strong><br>' + address + '<br>' + location.city + ', ' + location.state + ' ' + location.zip_code + '</div><div class="phone"><strong>Phone:</strong><br>' + location.phone + '</div></div><div class="hours"><strong>Today\'s Hours:</strong> ' + todayHours.open + ' - ' + todayHours.close + '</div>');
            
            // Mobile location widget
            $('#widget-location-mobile').html('<h4 class="location-title">' + location.title + '</h4><hr class="dashed">' + '<div class="info-wrapper"><div class="address"><strong>Address:</strong><br>' + location.address + ' ' + location.address_2 + '<br>' + location.city + ', ' + location.state + ' ' + location.zip_code + '</div><div class="hours"><div><strong>Today\'s Hours:</strong></div> ' + todayHours.open + ' - ' + todayHours.close + '</div><div class="btn-wrapper"><a class="btn get-directions" href="#">Directions</a><a class="btn call" href="tel:' + location.phone + '"><span class="icon icon-phone"></span> Call</a><div class="other-locations"><hr class="dashed"><h2>Other Nearby Locations</h2><div id="location-list-mobile"></div></div>');

            if( (typeof(skipCookie) == 'undefined') || (skipCookie == false) ){
                LaMadLocations.setLocationCookie(location);
            }

            if(typeof(reloadmap)!= 'undefined'){
                LaMadLocations.initializeMap(location.latitude, location.longitude, mapContainer);
            }

            // Update body classes
            $('body').removeClass('no-location');
            $('body').addClass('has-location');

            // If any .get-directions links exist, fire getDirections() method when clicked.
            $('#content').find('a.get-directions').on('click touchend', function(e){
                e.preventDefault();
                LaMadLocations.getDirections();
            });

            // Find any .lam-call links and set href attribute to current location phone number
            $('#content').find('.lam-call a').attr('href', 'tel:' + location.phone);

            // Get daypart cookie
            var cookieDaypart = $.cookie('LAM-daypart');

            // Parse as JSON
            if(typeof(cookieDaypart) != 'undefined'){
                var myDaypart = $.parseJSON(cookieDaypart),
                    hasDaypart = true;
            };

            // If we have a daypart, find any .daypart-menu links and set href to current daypart menu
            if(hasDaypart){
                $content.find('a.daypart-menu').attr('href', myDaypart.link.guid);
            };
        },

        setLocationCookie: function (location){
            this.nearestLocationObj = location;
            $.cookie("LAM-location", JSON.stringify(location), {
               expires : 10,          //expires in 10 days
               path: '/'
            });
        }, 

        setNearbyLocationsStorage: function (nearby){
            localStorage.setItem("LAM-nearby", JSON.stringify(nearby));

            if(typeof(LaMadLocations.loadNearest ) != 'undefined'){
                 LaMadLocations.loadNearest();
            }
           
        },

        getLocationCookie: function(){
            
            cookieLoc = $.cookie('LAM-location');

            if(typeof(cookieLoc) != 'undefined'){
              
                jsonCookie = $.parseJSON(cookieLoc);
                LaMadLocations.getLocation(true);
                LaMadLocations.nearestLocationObj.latitude = jsonCookie.latitude;
                LaMadLocations.nearestLocationObj.longitude = jsonCookie.longitude;
                LaMadLocations.setLocation(jsonCookie, true, true);

                // We have a map, no need to show location CTA
                LaMadLocations.$locationCta.addClass('map-loaded no-cta');
                
            }
            else{
                // Add CSS transitions to prepare for flip
                LaMadLocations.$locationCta.find('.flipper').addClass('transition');
            };
        },

        getLocation: function(objOnly){
            if(navigator.geolocation){
                if(typeof(objOnly) != 'undefined'){
                    navigator.geolocation.getCurrentPosition(this.geoFoundObjOnly, this.geoErr);
                } else {
                    navigator.geolocation.getCurrentPosition(this.geoFound, this.geoErr);
                }
            }
            else {
                $('#map').innerHTML = "Geolocation is not supported by this browser.";
            }
        },

        geoErr: function(error){
            alert('Pardon, we were not able to determine your location.\nPlease feel free to continue browsing.\nMerci');   
            $('body').addClass('location-error');  
        },

        geoFoundObjOnly: function(position){
            LaMadLocations.currentLocationObj.latitude = position.coords.latitude;
            LaMadLocations.currentLocationObj.longitude = position.coords.longitude;
        },

        geoFound: function(position){

            LaMadLocations.currentLocationObj.latitude = position.coords.latitude;
            LaMadLocations.currentLocationObj.longitude = position.coords.longitude;
            if(typeof(LaMadLocations.setLargLocation) != 'undefined'){
                LaMadLocations.setLargLocation(position.coords.latitude, position.coords.longitude);
            }

            LaMadLocations.showPosition(position.coords.latitude, position.coords.longitude)
        },

        /*Get User Current location via zipcode geocode*/
        geoCodeZip: function(zipcode){
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({address: zipcode},
                function(results_array, status) { 
                    if(status == 'OK'){

                        LaMadLocations.currentLocationObj = results_array[0].geometry.location;
                        LaMadLocations.showPosition(results_array[0].geometry.location.lat(), results_array[0].geometry.location.lng());

                        if(typeof(LaMadLocations.setLargLocation) != 'undefined'){
                            LaMadLocations.setLargLocation(results_array[0].geometry.location.lat(), results_array[0].geometry.location.lng());
                        };
                    };
            });
        },

        showPosition: function(lat, lng){
            
            markers = [];
            $.ajax({
                url:'/wp_api/v1/locations/?lat='+lat+'&lng='+lng,
                    
                success: function(data){

                    var nearbyLocations = [];
                    
                    $.each(data, function( idx, location){

                        if(idx == 0 ){
                            LaMadLocations.setLocation(location, true, false);
                            add_li= false;
                        }

                        var Latlng = new google.maps.LatLng(location.latitude,location.longitude);

                        var marker = new google.maps.Marker({
                            position: Latlng,
                            map: this.map,
                            title: 'Selected Location'
                        });

                        markers.push(marker);

                        nearbyLocations[idx] = location;

                    });
                    
                    if (nearbyLocations){
                        LaMadLocations.setNearbyLocationsStorage(nearbyLocations);
                    }

                    // Done loading
                    LaMadLocations.$locationCta.removeClass('map-loading').addClass('map-loaded');
                    return data;
                },
                error : function(data){
                    $('#map').html('No Locations Found');
                }
            });
        },

        getDirections: function(){
            directionsLink='http://www.google.com/maps/?saddr='+LaMadLocations.currentLocationObj.latitude+','+LaMadLocations.currentLocationObj.longitude+'&daddr='+LaMadLocations.nearestLocationObj.latitude+','+LaMadLocations.nearestLocationObj.longitude+'&directionsmode=driving';          
            window.open(directionsLink);
        },

        changeSideImage: function(url){

            img = "<img src='"+url+"' >";

            $('#location-image').html( img );
        },

        getImage: function(postID, skipImg){
            if(typeof(skipImg) == 'undefined'){skipImg = false};
            $.ajax({
                url:"/wp_api/v1/locations/image/"+postID,
                success: function(data){
                    if(skipImg == false) {
                        LaMadLocations.changeSideImage(data);
                    }
                    return data;
                }
            })
        
        }
};