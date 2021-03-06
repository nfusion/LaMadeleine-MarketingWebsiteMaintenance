<?php wp_enqueue_script('myscript', '/wp-content/plugins/lam/js/jQuery.cookie.js'); ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAItXxPNPzrIbkyON8OBGVNZX1ctAojfc8"> </script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/markerclusterer.js"></script>

<script type="text/javascript">

    $(document).ready(function(){

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

        $('#use-zip-secondary').on('click', function(e){
            e.preventDefault();

            // Use zipcode for location
            LaMadLocations.geoCodeZip($('#zip-input-secondary').val());
        });

        // Submit zip form on enter
        $('#zip-input').keypress(function(event){
          if(event.keyCode == 13){
            $('#use-zip').click();
          }
        });

        // Submit zip form on enter
        $('#zip-input-secondary').keypress(function(event){
          if(event.keyCode == 13){
            $('#use-zip-secondary').click();
          }
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
            <div class="no-locations">
                <p>D&eacute;sol&eacute;, there are no locations within 100 miles of your search. Please visit our Locations page to view all locations.</p>
            </div>
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

                /** Home view only **/

                // Home view - Small map container
                $map = '<div id="map"></div>';

                $btnWrapper = '';

                /** Location view only **/

                // Loading indicator
                $loading = '
                <div class="loading">
                    <div class="floatingCirclesG">
                        <div class="f_circleG frotateG_01"></div>
                        <div class="f_circleG frotateG_02"></div>
                        <div class="f_circleG frotateG_03"></div>
                        <div class="f_circleG frotateG_04"></div>
                        <div class="f_circleG frotateG_05"></div>
                        <div class="f_circleG frotateG_06"></div>
                        <div class="f_circleG frotateG_07"></div>
                        <div class="f_circleG frotateG_08"></div>
                    </div>
                </div>';

                // Locations view - Button wrapper and buttons
                $btnWrapperLocations = '
                <div class="btn-wrapper">
                    <a class="btn-light daypart-menu" href="#">Menu</a>
                    <a class="btn-light get-directions" href="#"><span class="text">Directions</span>' . $loading . '</a>
                    <a class="btn-light order-online" target="_blank" href="#"><span class="text">Order</span>'  . $loading . '</a>
                </div>'; //https://order.lamadeleine.com

                // Locations view - Locations list container
                $locationsList = '<div id="location-list"></div>';

                /** Both home and location views **/

                // Selected location image container
                $locationImage = '<div id="location-image"></div>';

                // Selected location info container
                $locationInfo = '<div id="location-info"></div>';

                // If this is the location view
                if($onLocationPage == 'true') { 
                    $locationMarkup = '<div class="back location-view">' . $locationImage . $locationInfo . $btnWrapperLocations . '</div>' . $loading . '<div class="other-locations"><hr class="dashed"><h3>Other Nearby Locations</h3>' . $locationsList . '</div>';
                } 
                // Else home view
                else {
                    $locationMarkup = '<div class="back map-view"><a class="map-link" href="/locations"></a><div id="returned_map">' . $map . $locationInfo . $btnWrapper . '</div></div>' . $loading;
                }

                echo $locationMarkup;

                ?>

            </div>

        </div>

    </div>

</div>

