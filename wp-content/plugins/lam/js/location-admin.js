$(document).ready(function(){
     /*** 
     This is Hacking the UI to fit our needs 
     TODO :: Work with CSS
     ***/
    var tr = '<tr><td><input id="locateStore" type="button" class="button tagadd button-large locateStore" id="codespacing_search_address" value="Map" style="float:left;"></td></tr>'
     $('div#pods-meta-location-details > div.inside > table.form-table.pods-metabox.pods-admin.pods-dependency > tbody').append(tr);


    var mapContainer = "<tr><td colspan='2'><div id='mapArea' class='adminMap'>No Address Found</div></td></tr>";
    $('div#pods-meta-location-details > div.inside > table.form-table.pods-metabox.pods-admin.pods-dependency > tbody').append(mapContainer);
     

     $('#locateStore').click(function(){
        addAddress();
     });

     if($('#pods-form-ui-pods-meta-zip-code').val()  != 0){
        addAddress();
     }

});

    


function copyLatLong(){

    $('#codespacing_progress_map_lat').val($('#pods-form-ui-pods-meta-latitude').val());
    $('#codespacing_progress_map_lng').val($('#pods-form-ui-pods-meta-longitude').val());
}


function addAddress(){
    var address1     = $('#pods-form-ui-pods-meta-address').val();
    var address2     = $('#pods-form-ui-pods-meta-address-2').val();
    var addressCity  = $('#pods-form-ui-pods-meta-city').val();
    var addressState = $('#pods-form-ui-pods-meta-state').val();
    var addressZip   = $('#pods-form-ui-pods-meta-zip-code').val();
    var addressStr  = address1 + '+' + address2 + '+' + addressCity + '+' + addressState + '+' + addressZip;

    getLatLong(addressStr);
 
}


function getLatLong(address){

    var address = encodeURIComponent(address);
     $.ajax({
        url:'http://maps.googleapis.com/maps/api/geocode/json?address='+address,
        success: function(data){
            $('#pods-form-ui-pods-meta-latitude').val(data.results[0].geometry.location.lat);
            $('#pods-form-ui-pods-meta-longitude').val(data.results[0].geometry.location.lng);
            initializeMap(data.results[0].geometry.location.lat, data.results[0].geometry.location.lng, 'pin');
            $('#mapArea').css('height','400px');
             $('#mapArea').css('width','400px');
               
        }

    });
}


function initializeMap(lat, lng) {
        
        var cssDir = "/wp-content/themes/required-lamadeleine";

        var myLatlng = new google.maps.LatLng(lat,lng);
        var mapOptions = {
            panControl: true,
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            streetViewControl: true,
            overviewMapControl: true,  
            center: myLatlng,
            zoom: 12
        };

        var map = new google.maps.Map(document.getElementById("mapArea"), mapOptions);

        

        displayIcon = cssDir+'/img/map/custom-pin-drop.png';
        var marker = new google.maps.Marker({ 
                                            position: myLatlng, 
                                            map: map, 
                                            title: 'Location', 
                                            icon: displayIcon
                                            });

        sideMap = map;
        //return map;
    }





