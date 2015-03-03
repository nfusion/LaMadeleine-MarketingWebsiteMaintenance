var LaMadLocations = {
        sideMap: null,
        currentLocationObj: {'latitude':null,'longitude':null},
        
        nearestLocationObj: {'latitude':null,'longitude':null},
       
        $locationCta: $('#location-cta'),
        $directionsLink: "",
        $toGoLink: "https://online.lamadeleine.com",
        clickEvent: "",
        setClickEvent: function(Modernizr){
            if($('html').hasClass('touch')){
                this.clickEvent = 'touchend';
            }
            else{
                this.clickEvent = 'click';
            }
        },
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
                    "featureType": "poi",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#ddc692" }
                    ]
                  },{
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                      { "color": "#9fc8b1" }
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
                  },
                  {
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
                newLng=parseFloat(lng);//-0.01;
                myCenter = new google.maps.LatLng(newLat,newLng);

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
                    displayIcon = {
                        url: '/wp-content/themes/required-lamadeleine/img/map/custom-pin-drop.png',
                        // size: new google.maps.Size(96, 104), // Actual size, @2x for retina
                        scaledSize: new google.maps.Size(48, 52) // Size on map
                    }
                }
                var marker = new google.maps.Marker({ 
                                                    position: myLatlng, 
                                                    map: map, 
                                                    title: 'La Madeleine Location', 
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
            ucaseDayofWeek = dayOfWeek.charAt(0).toUpperCase() + dayOfWeek.slice(1)


            closed_today = false;
           
            if(( location.days_closed !=null )){
                if(location.days_closed.indexOf(ucaseDayofWeek) >=0){
                        var closed_today = 'Closed on '+ucaseDayofWeek;
                    }   
             }

            var today_open = dayOfWeek+'_open';
            var today_close = dayOfWeek+'_close';
            /*************************************/

            var todayHours = {
                closed_today: closed_today,
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

            loadingIndicator = '<div class="loading"><div class="floatingCirclesG"><div class="f_circleG frotateG_01"></div><div class="f_circleG frotateG_02"></div><div class="f_circleG frotateG_03"></div><div class="f_circleG frotateG_04"></div><div class="f_circleG frotateG_05"></div><div class="f_circleG frotateG_06"></div><div class="f_circleG frotateG_07"></div><div class="f_circleG frotateG_08"></div></div></div>';

            // Full size location widget
            if(todayHours.closed_today == false){
                $('#location-info').html('<h4 class="location-title">' + location.title + '</h4>' + '<div class="info-wrapper"><div class="address"><strong>Address:</strong><br>' + address + '<br>' + location.city + ', ' + location.state + ' ' + location.zip_code + '</div><div class="phone"><strong>Phone:</strong><br>' + location.phone + '</div></div><div class="hours"><strong>Today\'s Hours:</strong> ' + todayHours.open + ' - ' + todayHours.close + '</div>');
            } else {
                $('#location-info').html('<h4 class="location-title">' + location.title + '</h4>' + '<div class="info-wrapper"><div class="address"><strong>Address:</strong><br>' + address + '<br>' + location.city + ', ' + location.state + ' ' + location.zip_code + '</div><div class="phone"><strong>Phone:</strong><br>' + location.phone + '</div></div><div class="hours"><strong>Today\'s Hours:</strong> Closed</div>');
            }
            // Mobile location widget
            if(todayHours.closed_today == false){
                $('#widget-location-mobile').html('<h4 class="location-title">' + location.title + '</h4><hr class="dashed">' + '<div class="info-wrapper"><div class="address"><strong>Address:</strong><br>' + location.address + ' ' + location.address_2 + '<br>' + location.city + ', ' + location.state + ' ' + location.zip_code + '</div><div class="hours"><div><strong>Today\'s Hours:</strong></div> ' + todayHours.open + ' - ' + todayHours.close + '</div><div class="btn-wrapper"><a class="btn get-directions" href="#"><span>Directions</span>' + loadingIndicator + '</a><a class="btn daypart-menu" href="#">Menu</a><a class="btn call" href="tel:' + location.phone + '"><span class="icon icon-phone"></span> Call</a><div class="other-locations"><hr class="dashed"><h2>Other Nearby Locations</h2><div id="location-list-mobile"></div></div>');
            } else {
                $('#widget-location-mobile').html('<h4 class="location-title">' + location.title + '</h4><hr class="dashed">' + '<div class="info-wrapper"><div class="address"><strong>Address:</strong><br>' + location.address + ' ' + location.address_2 + '<br>' + location.city + ', ' + location.state + ' ' + location.zip_code + '</div><div class="hours"><div><strong>Today\'s Hours:</strong></div>Closed</div><div class="btn-wrapper"><a class="btn get-directions" href="#"><span>Directions</span>' + loadingIndicator + '</a><a class="btn daypart-menu" href="#">Menu</a><a class="btn call" href="tel:' + location.phone + '"><span class="icon icon-phone"></span> Call</a><div class="other-locations"><hr class="dashed"><h2>Other Nearby Locations</h2><div id="location-list-mobile"></div></div>');
            }

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
            $('#content').find('a.get-directions').on(this.clickEvent, function(e){
                e.preventDefault();
                LaMadLocations.getDirections(this);
            });

            $('#content').find('a.order-online').on(this.clickEvent, function(e) {
                e.preventDefault();
                LaMadLocations.getToGoLink(this);
            });

            // If any .btn.locate links exist, fire refreshLocation() method when clicked.
            $('#content').find('.btn.locate').on(this.clickEvent, function(e){
                e.preventDefault();
                LaMadLocations.refreshLocation(this);
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
                $('#content').find('a.daypart-menu').attr('href', myDaypart.link.guid);
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
                //LaMadLocations.getLocation(true);
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

        getLocation: function(objOnly, el){
         
                if(objOnly == 'linkOut'){

                    // Set to passed in link element
                    $directionsLink = $(el);

                    // Add temporary .loading-directions class for loading indicator purposes
                    $directionsLink.addClass('loading-directions');

                    navigator.geolocation.getCurrentPosition(this.geoLinkDir, this.geoErr, {timeout:10000});
                }else if(navigator.geolocation){
                    if(typeof(objOnly) != 'undefined'){
                        navigator.geolocation.getCurrentPosition(this.geoFoundObjOnly, this.geoErr, {timeout:10000});
                    } else {
                        navigator.geolocation.getCurrentPosition(this.geoFound, this.geoErr, {timeout:10000});
                    }

                    if(el){
                        $(el).addClass('geolocate-loading');
                    }
                }
                else {
                    $('#map').innerHTML = "Geolocation is not supported by this browser.";
                }
             
        },

        geoErr: function(error){
            alert('Pardon, we were unable to determine your location.\nPlease check your network connection and browser settings.\nMerci.');   
            setTimeout(function(){
                $('body').addClass('location-error');
                // Remove any loading states, reset UI
                $('#location-cta').removeClass('map-loading');
                $('#location-cta').find('.front-wrapper').show();
                $('#header').find('.icon-pin').show();
                $('#header').find('.loading').hide();
                $('#content').find('.geolocate-loading').removeClass('geolocate-loading');
            }, 500);
        },

        geoFoundObjOnly: function(position){
            LaMadLocations.currentLocationObj.latitude = position.coords.latitude;
            LaMadLocations.currentLocationObj.longitude = position.coords.longitude;
        },

        geoFound: function(position){

            LaMadLocations.currentLocationObj.latitude = position.coords.latitude;
            LaMadLocations.currentLocationObj.longitude = position.coords.longitude;
            if(typeof(LaMadLocations.setLargLocation) != 'undefined'){
               // LaMadLocations.setLargLocation(position.coords.latitude, position.coords.longitude);
                LaMadLocations.loadNearest();
            }

            LaMadLocations.showPosition(position.coords.latitude, position.coords.longitude)

            // Remove any loading states
            $('#content').find('.geolocate-loading').removeClass('geolocate-loading');
        },

        geoLinkDir: function(position){
            $directionsLink.removeClass('loading-directions');
            $directionsLink = "";
            LaMadLocations.currentLocationObj.latitude = position.coords.latitude;
            LaMadLocations.currentLocationObj.longitude = position.coords.longitude;

             if( (navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPod") != -1)){
                var protocol='maps';
             } else {
                var protocol='http';
             }

            directionsLink= protocol+'://maps.google.com/?saddr='+LaMadLocations.currentLocationObj.latitude+','+LaMadLocations.currentLocationObj.longitude+'&daddr='+LaMadLocations.nearestLocationObj.latitude+','+LaMadLocations.nearestLocationObj.longitude+'&directionsmode=driving';          
            
            LaMadLocations.sendWindow(directionsLink);
            return true;
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

                    $('body').removeClass('no-locations-found');
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

                    // Frisco market to go link refresh
                    LaMadLocations.refreshToGoLink('.widget_lam_orderlinks a[href^="https://online"]');

                    // Done loading
                    LaMadLocations.$locationCta.removeClass('map-loading').addClass('map-loaded');
                    return data;
                },
                error : function(data, error){
                    // No locations found UI handling

                    // Add body utility class
                    $('body').addClass('no-locations-found');

                    // Remove map-loading class from location CTA
                    LaMadLocations.$locationCta.removeClass('map-loading');

                    // Fade in no locations error message
                    LaMadLocations.$locationCta.find('.no-locations').fadeIn('fast');

                    // Wait 5 seconds before fading out error
                    setTimeout(function(){
                        LaMadLocations.$locationCta.find('.no-locations').fadeOut('fast');
                        LaMadLocations.$frontWrapper().fadeIn('fast');
                    }, 5000);

                    // Handle touch devices, fire window alert
                    if($('html').hasClass('touch')){

                        if($('#content').hasClass('locations')){
                            alertMsg = "Pardon, there are no locations within 100 miles.";
                        }
                        else{
                            alertMsg = "Pardon, there are no locations within 100 miles. Please access our Locations page to view all La Madeleine locations.";
                        }

                        window.alert(alertMsg);
                    };

                    // If other locations list is present, update HTML
                    $('#location-list, #widget-location-mobile').html('<p class="no-locations-list">There are no locations within 100 miles of your search.</p>');
                }
            });
        },


        sendWindow: function(directionsLink){
            
            var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
                if(isSafari){
                    link = '<a href="'+directionsLink+'" target="_new" class="mapit" onClick="">';
                    window.location = directionsLink;
                } else {
                    window.open(directionsLink);
                }

        },

        getDirections: function(el){
            if(LaMadLocations.currentLocationObj.latitude == null){
                this.getLocation('linkOut', el);
            } else {

                if( (navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPod") != -1)){
                    var protocol='maps';
                 } else {
                    var protocol='http';
                    //var protocol='maps';
                 }

                directionsLink= protocol+'://maps.google.com/maps/?saddr='+LaMadLocations.currentLocationObj.latitude+','+LaMadLocations.currentLocationObj.longitude+'&daddr='+LaMadLocations.nearestLocationObj.latitude+','+LaMadLocations.nearestLocationObj.longitude+'&directionsmode=driving';          
                this.sendWindow(directionsLink);
            }
        },

        getToGoLink: function(el){
            var toGoLink = LaMadLocations.$toGoLink;
            if ( $.cookie('LAM-location') ) {
                var loc =  JSON.parse( $.cookie('LAM-location') );
                if (loc.title == 'Frisco') {
                    toGoLink = 'https://order.lamadeleine.com/index.cfm?fuseaction=order&action=preorder&isToGo=1';
                }
            }
            this.sendWindow(toGoLink);
        },

        refreshToGoLink: function(el) {

            var link = $(el);
            var toGoLink = LaMadLocations.$toGoLink;
            if ( $.cookie('LAM-location') ) {
                var loc =  JSON.parse( $.cookie('LAM-location') );
                if (loc.title == 'Frisco') {
                    toGoLink = 'https://order.lamadeleine.com/index.cfm?fuseaction=order&action=preorder&isToGo=1';
                }
                link.attr('href',toGoLink);
            }
        },

        refreshLocation: function(el){
            LaMadLocations.getLocation(undefined, el);
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

LaMadLocations.setClickEvent();