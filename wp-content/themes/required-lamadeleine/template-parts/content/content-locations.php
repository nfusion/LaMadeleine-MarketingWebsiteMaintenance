<?php
/**
 * The template for displaying the locations page
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 */

?>

<script type="text/javascript">

$(document).ready(function(){

    var largeMap = [];

    var markerclusterer = null;

    LaMadLocations.initializeLargeMap = function() {
        var styledMap = new google.maps.StyledMapType(LaMadLocations.mapStyles, {name: "La Madeleine"});
        var myLatlng = new google.maps.LatLng(32.2997,-90.5783);
        var mapOptions = {
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
            },
            streetViewControl: false,
            scrollwheel: false,
            panControl:false,
            zoomControl: true,
            zoomControlOptions: {
            style: google.maps.ZoomControlStyle.MEDIUM,
            position: google.maps.ControlPosition.RIGHT_BOTTOM
            },
             
            center: myLatlng,
            zoom: 5
        };

        largeMap = new google.maps.Map(document.getElementById("map-full"),mapOptions);

        //Associate the styled map with the MapTypeId and set it to display.
        largeMap.mapTypes.set('map_style', styledMap);
        largeMap.setMapTypeId('map_style');
        
        var markers = [];
        <?php 
        while($mypod->fetch()) {
            $cacheKey =' location_'.$mypod->id();
            //pods_cache_clear();
            $item = pods_cache_get( $cacheKey, '', function($cacheKey,$mypod) use($mypod){
                $item_fields = array(  
                    'id',
                    'latitude',
                    'longitude',
                    'title', 
                    'address', 
                    'address_2', 
                    'city', 
                    'state',
                    'zip',
                    'phone',
                    'sunday_open',
                    'monday_open',
                    'tuesday_open',
                    'wednesday_open',
                    'thursday_open',
                    'friday_open',
                    'saturday_open',
                    'sunday_close',
                    'monday_close',
                    'tuesday_close',
                    'wednesday_close',
                    'thursday_close',
                    'friday_close',
                    'saturday_close'
                );

                foreach ($item_fields as $key => $value) {
                    $item[$value] = $mypod->field($value);
                }

                $item['featured_img'] = get_the_post_thumbnail( $mypod->id(), 'location-featured');
                
                pods_cache_set($cacheKey,$item,'',300);
                return $item;
            });
            //end pod fetch
            ?>
            <?php if ( !empty($item) && !empty($item['latitude']) && !empty($item['longitude']) ) : ?>

                var Latlng = new google.maps.LatLng( <?php echo $item['latitude'] .','.  $item['longitude'] ?>);

                var displayIcon = {
                    url: '/wp-content/themes/required-lamadeleine/img/map/custom-pin-drop.png',
                    size: new google.maps.Size(48, 52),
                    scaledSize: new google.maps.Size(48, 52)
                }

                var marker_<?php echo $item['id'] ?> = new google.maps.Marker({
                        position: Latlng,
                        map: largeMap,
                        //title: 'Closest Location',
                        title: '<?php echo addslashes($item['title']); ?>',
                        icon: displayIcon,
                    });
                    marker_<?php echo $item['id'] ?>.info = new google.maps.InfoWindow({ content: '<b>'+ '<?php echo addslashes($item['title']); ?>'+':</b>'});
                    
                    google.maps.event.addListener(marker_<?php echo $item['id'] ?>, 'click', function() {
                        //console.log('click listener fired');
                        
                        <?php
                            $featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($item['id']), 'location-featured');
                        ?>

                        var img = '<?php echo $featuredImg[0]; ?>';
												
						//setTimeout(function(){LaMadLocations.changeSideImage(img);}, 1000);
                        // LaMadLocations.changeSideImage(img);

                        LaMadLocations.showPosition(<?php echo $item['latitude'].',' .$item['longitude']?> );
                        largeMap.setZoom(12);
                        //largeMap.setCenter(marker_<?php echo $item['id'] ?>.getPosition());
                        LaMadLocations.loadNearest();
   
                    });
                    
                    // if((setCenterToFirst)&&(markers.length <1 )){
                    //     largeMap.setZoom(12);
                    //     largeMap.setCenter(marker_<?php echo $item['id'] ?>.getPosition());
                    //     LaMadLocations.loadNearest();
                    // }
                    markers.push(marker_<?php echo $item['id'] ?>);
            <?php endif; ?>
                   
        <?php } // end while ?>
                <?php if(empty($base)) $base = ''; ?>

                mcOptions = {styles: [{
                    height: 53,
                    url: "<?php echo $base; ?>/wp-content/uploads/2014/07/m1.png",
                    width: 53,
                    textColor: '#fff9e5'
                },
                {
                    height: 55,
                    url: "<?php echo $base; ?>/wp-content/uploads/2014/07/m2.png",
                    width: 56,
                    textColor: '#fff9e5'
                },
                {
                    height: 65,
                    url: "<?php echo $base; ?>/wp-content/uploads/2014/07/m3.png",
                    width: 66,
                    textColor: '#fff9e5'
                }
                ]};
                 var markerclusterer = new MarkerClusterer(largeMap, markers,  mcOptions);

                 //getLocationCookieLg(largeMap);
                 LaMadLocations.setCenterToCookie();
        
    }

    LaMadLocations.setLargLocation = function( latitude, longitude){
        //console.log(map);
             var Latlng = new google.maps.LatLng( latitude, longitude);
            largeMap.setCenter(Latlng);
            largeMap.setZoom(12);
    }

    LaMadLocations.setCenterToCookie = function(){
        cookieLoc = $.cookie('LAM-location');
        if(typeof(cookieLoc) != 'undefined'){
            jsonCookie = $.parseJSON(cookieLoc);
            if(typeof(largeMap) != 'undefined'){
                LaMadLocations.setLargLocation(jsonCookie.latitude, jsonCookie.longitude) ;   
            }
            //LaMadLocations.getImage(jsonCookie.id);
            LaMadLocations.loadNearest();
            
        }
        else{
            //console.log("No Center cookie for you!");
            
        };
    },

    /**
    *
    * Gets list of nearby locations from local storage and populates location list
    *
    **/
    LaMadLocations.loadNearest = function(){
        
        // Ensure this runs after local storage is set
        setTimeout(function(){

            // Get data from local storage
            var nearbyList = localStorage.getItem("LAM-nearby");

            // If there are results 
            if(nearbyList){

                var locationList = "";

                // Parse list as JSON
                nearbyList = $.parseJSON(nearbyList);
                
                // Iterate through JSON and build HTML for location list
                $.each(nearbyList, function(key, location){

                    if(key == 0){
                        LaMadLocations.getImage(location.id, false);

                        var Latlng = new google.maps.LatLng( location.latitude, location.longitude);
                         largeMap.setZoom(12);
                         largeMap.setCenter(Latlng);
                       


                    }  else if ((key > 0)&&(key<4)){
                        locationItem = "<li class='location-item'  data-id='"+location.id+"' data-latitude='"+location.latitude+"' data-longitude='"+location.longitude+"'><div class='location-thumb'><img alt='Photo of La Madeleine Location' src='" + location.images.thumbnail + "'></div><div class='location-info'><div class='location-name'>" + location.title + "</div><div class='location-city'>" + location.city + ", " + location.state + "</div></div></li>";
                        locationList += locationItem;
                    } 
                });

                // Set location list HTML to element
                $('#location-list').html(locationList);

                 // Set location list HTML to mobile element
                $('#location-list-mobile').html(locationList);

                // Click event for location list items
                $('#location-list .location-item, #location-list-mobile .location-item').on('click', function(){

                    // Update selected destination image
                    var img = LaMadLocations.getImage($(this).attr('data-id'), true);

                    LaMadLocations.setLargLocation($(this).attr('data-latitude'),$(this).attr('data-longitude'));
                    LaMadLocations.showPosition($(this).attr('data-latitude'),$(this).attr('data-longitude'), img);

                    // Update locations list
                    LaMadLocations.loadNearest();
                });

                // Click event for mobile location list
                $('#widget-location-mobile').find('.other-locations .location-item').on('click', function(){
                    // Scroll to top to show result
                    $("html, body").animate({ scrollTop: 0 }, 500);
                });
            }
        }, 250);
    }

    /*** we need to extend this functionality ***/

    $(document).ready(function(){

        LaMadLocations.initializeLargeMap();
        
    });
});

</script>  

<div id='map-full'></div>