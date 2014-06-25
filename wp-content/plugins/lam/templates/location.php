<?php wp_enqueue_script('myscript', '/wp-content/plugins/lam/js/jQuery.cookie.js'); ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"> </script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerclustererplus/2.0.3/src/markerclusterer.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $(document).on('click', '.other_location', function(){

            var img = LaMadLocations.getImage($(this).attr('data-id'));

            LaMadLocations.setLargLocation($(this).attr('data-latitude'),$(this).attr('data-longitude'));
            LaMadLocations.showPosition($(this).attr('data-latitude'),$(this).attr('data-longitude'), img);

        }); 

        // Do we have a location stored in client cookie?
        LaMadLocations.getLocationCookie();

        /* Location CTA click handling */

        // Use my location (geolocate)
        $('#use-location').on('click', function(e){
            e.preventDefault();

            // Fade out UI elements and hide
            LaMadLocations.$frontWrapper().fadeOut('fast');

            // Show loading indicator
            LaMadLocations.$locationCta.addClass('map-loading');

            LaMadLocations.getLocation();
        });


        $('#use-zip').on('click', function(e){
            e.preventDefault();

            // Fade out UI elements and hide
             LaMadLocations.$frontWrapper().fadeOut('fast');

            // Show loading indicator
            LaMadLocations.$locationCta.addClass('map-loading');

            // Use zipcode for location
            LaMadLocations.geoCodeZip($('#zip-input').val());
        });

    });
    

</script>

<?php 
    if($onLocationPage == 'false') :
        $locationClass = "map-view";
    else:
        $locationClass = "location-view";
    endif;
?>

<div class="widget widget-location <?php echo $locationClass; ?>">

    <div id="widget-location-mobile">
        
    </div>
    
    <div id="widget-location-full">

        <div class='widget-title'>
            <h3><?php echo $title ?></h3> <?php if($onLocationPage == 'false'){ echo '<a href="/locations/">See&nbsp;All</a>';}; ?><br>
        </div>

        <div id="location-cta">
            <div class="flipper">
                <div class="front">
                    <div class="front-wrapper">
                        <div class="geo">
                            <div class="icon icon-pin"></div>
                            <p><a id="use-location" class="btn" href="#">Use My Location</a></p>
                        </div>
                        <div class="location-cta-divider"></div>
                        <div class="zip">
                            <div class="icon icon-magnify"></div>
                            <input id="zip-input" maxlength="5" placeholder='Enter Zip Code'> <a id="use-zip" class="btn" href="#">Go</a>
                        </div>
                    </div>
                </div>

                <?php 

                $map = '<div id="map"></div>';
                $locationImage = '<div id="location-image"></div>';
                $locationInfo = '<div id="location-info"></div>';
                $locationsList = '<div id="location-list"></div>';
                $btnWrapper = '<div class="btn-wrapper"><a class="btn" target="_blank" href="https://online.lamadeleine.com/">To Go</a><a class="btn" target="_blank" href="http://cateringbylamadeleine.com">Catering</a></div>';
                $btnWrapperLocations = '<div class="btn-wrapper"><a class="btn-light" href="/menu">Menu</a><a class="btn-light get-directions" href="#">Directions</a><a class="btn-light" href="#">Order</a></div>';

                if($onLocationPage == 'true') { 
                    $locationMarkup = '<div class="back location-view">' . $locationImage . $locationInfo . $btnWrapperLocations . '</div></div></div><div class="other-locations"><hr class="dashed"><h3>Other Nearby Locations</h3>' . $locationsList . '</div>';
                } else {
                    $locationMarkup = '<div class="back map-view"><div id="returned_map">' . $map . $locationInfo . $btnWrapper . '</div></div></div>';
                }

                echo $locationMarkup;

                ?>

            <div class="loading">
                <div id="floatingCirclesG">
                <div class="f_circleG" id="frotateG_01">
                </div>
                <div class="f_circleG" id="frotateG_02">
                </div>
                <div class="f_circleG" id="frotateG_03">
                </div>
                <div class="f_circleG" id="frotateG_04">
                </div>
                <div class="f_circleG" id="frotateG_05">
                </div>
                <div class="f_circleG" id="frotateG_06">
                </div>
                <div class="f_circleG" id="frotateG_07">
                </div>
                <div class="f_circleG" id="frotateG_08">
                </div>
                </div>
            </div>
        </div>

    </div>

</div>

