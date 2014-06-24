var LaMadLocations = {
        sideMap: null,
        currentLocationObj: {'latitude':null,'longitude':null},
        
        nearestLocationObj: {'latitude':null,'longitude':null},
       
        $locationCta: $('#location-cta'),
        $frontWrapper: function(){
            return this.$locationCta.find('.front-wrapper');
        },

    initializeMap:  function(lat, lng, mapContainer) {
            var $mapContainer = $('#' + mapContainer);

            if($mapContainer.length){

                /** do to map size (too small) we actually need to offset the center toward the bottom of the map 
                to allow marker to fit
                */
                newLat=parseFloat(lat)+0.007;
                myCenter = new google.maps.LatLng(newLat,lng);

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
                    zoom: 12
                };

                var map = new google.maps.Map(document.getElementById(mapContainer),
                    mapOptions);

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

            LaMadLocations.nearestLocationObj = location;
            
            // Full size location widget
            $('#location-info').html('<h4 class="location-title">' + location.title + '</h4>' + '<div class="info-wrapper"><div class="address"><strong>Address:</strong><br>' + location.address + ' ' + location.address_2 + '<br>' + location.city + ', ' + location.state + ' ' + location.zip_code + '</div><div class="phone"><strong>Phone:</strong><br>' + location.phone + '</div></div><div class="hours"><strong>Today\'s Hours: ' + todayHours.open + ' - ' + todayHours.close);
            
            // Mobile location widget
            $('#widget-location-mobile').html('<h4 class="location-title">' + location.title + '</h4><hr class="dashed">' + '<div class="info-wrapper"><div class="address"><strong>Address:</strong><br>' + location.address + ' ' + location.address_2 + '<br>' + location.city + ', ' + location.state + ' ' + location.zip_code + '</div><div class="hours"><div><strong>Today\'s Hours:</strong></div> ' + todayHours.open + ' - ' + todayHours.close + '</div><div class="btn-wrapper"><a class="btn" href="#">Directions</a><a class="btn call" href="tel:' + location.phone + '"><span class="icon icon-phone"></span> Call</a>');

            if( (typeof(skipCookie) == 'undefined') || (skipCookie == false) ){
                LaMadLocations.setLocationCookie(location);
            }

            if(typeof(reloadmap)!= 'undefined'){
                LaMadLocations.initializeMap(location.latitude, location.longitude, mapContainer);
            }

            // Update body classes
            $('body').removeClass('no-location');
            $('body').addClass('has-location');
        },

        setLocationCookie: function (location){
            this.nearestLocationObj = location;
            $.cookie("LAM-location", JSON.stringify(location), {
               expires : 10,          //expires in 10 days
               path: '/'
            });
        },  

         setNearestLocationsCookie: function (html){
            
            $.cookie("LAM-near-locations",html, {
               expires : 10,          //expires in 10 days
               path: '/'
            });
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
                    navigator.geolocation.getCurrentPosition(this.geoFoundObjOnly);
                } else {
                    navigator.geolocation.getCurrentPosition(this.geoFound);
                }
            }
            else {
                $('#map').innerHTML = "Geolocation is not supported by this browser.";
            }
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
                    
                    
                    $('#location-list').html('');
                    nearLocationHtmlList = '';
                    $.each(data, function( idx, location){
                        add_li = true;
                        var Latlng = new google.maps.LatLng(location.latitude,location.longitude);
                        if(idx == 0 ){
                            
                            //initializeMap(Latlng);
                            LaMadLocations.setLocation(location, true, false);
                            add_li= false;
                        }

                        var marker = new google.maps.Marker({
                            position: Latlng,
                            map: this.map,
                            title: 'Closest Location'
                        });
                         markers.push(marker);

                         if(add_li === true){
                            locationItem = "<li class='other_location clickable'  data-id='"+location.id+"' data-latitude='"+location.latitude+"' data-longitude='"+location.longitude+"'>"+location.title+'</li>';
                            $('#location-list').append(locationItem);  

                            nearLocationHtmlList += locationItem;
                         }  
                    });
                    
                    if (nearLocationHtmlList){
                        LaMadLocations.setNearestLocationsCookie(nearLocationHtmlList);
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

        getImage: function(postID){
            $.ajax({
                url:"/wp_api/v1/locations/image/"+postID,
                success: function(data){
                    LaMadLocations.changeSideImage(data);
                    return data;
                }
            })
        
        }
};