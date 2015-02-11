<?php
/**
 * Plugin Name: La Mdeleine Custom: Base
 * Plugin URI: http://lamadeleine.com/.com/
 * Description: Base custom functionality for La Mdeleine's 2014 site redesign.
 * Version: 1.0
 * Author: Christian Serna, nFusion Group, LLC
 * Author URI: http://nfusion.com
 */

/* Actions & Filters */




function my_admin_enqueue($hook) {
   global $post;
    //Load only on edit.php pages
    //You can use get_current_screen to check post type

    
    if(( 'post-new.php' == $hook ) or ('post.php' == $hook )){
        if($post->post_type == 'locations'){
          wp_enqueue_script( 'google_maps_api', "https://maps.googleapis.com/maps/api/js?sensor=false" );
          wp_enqueue_script( 'my_custom_script', plugins_url('/js/location-admin.js', __FILE__) );
        }


        if($post->post_type == 'daypart'){
         
          wp_enqueue_script( 'my_custom_script', plugins_url('/js/daypart-admin.js', __FILE__) );
        }
         /*** 
         we may want to move this out of this restriction (if statement) but for now I am only going to load on a
         as needed 
         */
        wp_deregister_script('jquery');
        wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js", false, null);
        wp_enqueue_script('jquery');


        wp_deregister_script('jquery-ui');
        wp_register_script('jquery-ui', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.js", false, null);
        wp_enqueue_script('jquery-ui');
    }
   
}
add_action( 'admin_enqueue_scripts', 'my_admin_enqueue' );

function my_wp_enqueue() {
    //Load only on edit.php pages
    //You can use get_current_screen to check post type

         /*** 
         we may want to move this out of this restriction (if statement) but for now I am only going to load on a
         as needed 
         */
        wp_deregister_script('jquery');
        wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js", false, null);
        wp_enqueue_script('jquery');
    
   
}

add_action( 'wp_enqueue_scripts', 'my_wp_enqueue' );





// function my_jquery_enqueue() {
//     die('dd');
//    wp_deregister_script('jquery');
//    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js", false, null);
//    wp_enqueue_script('jquery');
// }
// add_action("admin_enqueue_scripts", "my_jquery_enqueue", 11);



