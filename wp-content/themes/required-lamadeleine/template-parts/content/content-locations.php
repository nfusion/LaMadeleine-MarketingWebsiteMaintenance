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
        var myLatlng = new google.maps.LatLng(32.2997,-90.5783);
        var mapOptions = {
              mapTypeControl: false,
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
        

        var markers = [];
        <?php 
             while( $mypod->fetch() ) {
                foreach (array(  
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

                            ) as $key => $value) {

                                $item[$value] = $mypod->field($value);
                            }
                $item['featured_img'] =  get_the_post_thumbnail( $mypod->id(), 'fma-full');
                ?>
                var Latlng = new google.maps.LatLng( <?php echo $item['latitude'] .','.  $item['longitude'] ?>);
                var marker_<?php echo $item['id'] ?> = new google.maps.Marker({
                        position: Latlng,
                        map: largeMap,
                        title: 'Closest Location'
                    });
                    marker_<?php echo $item['id'] ?>.info = new google.maps.InfoWindow({ content: '<b>'+ <?php echo $items['title']; ?>+':</b>' });
                    
                    google.maps.event.addListener(marker_<?php echo $item['id'] ?>, 'click', function() {
                        
                        var img =  <?php echo '"'.wp_get_attachment_url( get_post_thumbnail_id( $item['id'] ) ) . '"' ?>;

                        LaMadLocations.changeSideImage(img);

                        LaMadLocations.showPosition(<?php echo $item['latitude'].',' .$item['longitude']?> );
                        largeMap.setZoom(12);
                        largeMap.setCenter(marker_<?php echo $item['id'] ?>.getPosition());
   
                    });


                    markers.push(marker_<?php echo $item['id'] ?>);
                   
        <?php } ?>

                 var markerclusterer = new MarkerClusterer(largeMap, markers);

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
                LaMadLocations.getImage(jsonCookie.id);
                LaMadLocations.loadNearest();
                
            }
            else{
                //console.log("No Center cookie for you!");
                
            };
        },
     LaMadLocations.loadNearest = function(){

        cookieNear = $.cookie('LAM-near-locations');

            if(typeof(cookieNear) != 'undefined'){
                $('#location-list').append(cookieNear);
            }

     }

    $(document).ready(function(){

        LaMadLocations.initializeLargeMap();

        
        //getLocationCookie(map-full);
        
    });
});

</script>  

<div id="mobile-nav" class="three">
    <a href="/locations" <?php if($pageDetails['title'] === 'locations'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-nearby"></div>
            Closest
        </div>
    </a>
    <a href="/locations?map=true" <?php if($pageDetails['title'] === 'lunch'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-map"></div>
            Map
        </div>
    </a>
    <a href="/locations?list=true" <?php if($pageDetails['title'] === 'dinner'){echo 'class="active"';}; ?>>
        <div class="nav-item">
            <div class="icon icon-menu-dots"></div>
            See All
        </div>
    </a>
</div>

<div id='map-full'>

</div>
<?php
//print_r($mypod);
	 

    
