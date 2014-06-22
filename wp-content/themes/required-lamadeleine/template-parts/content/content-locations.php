<?php
/**
*/

?>
<style>
    #map_div_large{
        height: 500px;
        /*width: 800px;*/
        max-width: none;
    }

    .gmnoprint > div > * {
        max-width: none;
    }


</style>

<script type="text/javascript">

$(document).ready(function(){

var largeMap = [];

var markerclusterer = null;

LaMadLocations.initializeLargeMap = function() {
        var myLatlng = new google.maps.LatLng(32.2997,-90.5783);
        var mapOptions = {
              streetViewControl: false,
              scrollwheel: false,
              panControl:false,
              zoomControl: true,
              zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                 position: google.maps.ControlPosition.RIGHT_BOTTOM
              },
             
            center: myLatlng,
            zoom: 5
        };

        largeMap = new google.maps.Map(document.getElementById("map_div_large"),mapOptions);
        

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
            }
            else{
                //console.log("No Center cookie for you!");
                
            };
        },


    $(document).ready(function(){

        LaMadLocations.initializeLargeMap();

        
        //getLocationCookie(map_div_large);
        
    });
});

</script>    


<H2><?php echo $pageDetails['title'] ?></H2>

<div id='map_div_large'>

</div>
<?php
//print_r($mypod);
	 

    
