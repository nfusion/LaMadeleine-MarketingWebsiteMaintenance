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
add_action( 'pods_meta_groups', 'lam_metaboxes', 10, 2 );

add_filter(  'gettext',  'change_post_to_story'  );
add_filter(  'ngettext',  'change_post_to_story'  );
add_filter( 'esc_html', 'change_post_to_story');

add_action( 'pods_meta_groups', 'lam_metaboxes', 10, 2 );



function lam_metaboxes() {
    // Loction
    pods_group_add('locations', 'Location Details', 'address, address_2, city, state, phone, latitude, longitude, menu_pricing');
    pods_group_add('locations', 'Store Hours', 'monday_open, monday_close, tuesday_open, tuesday_close, wednesday_open, wednesday_close, thursday_open, thursday_close, friday_open,friday_close,saturday_open, saturday_close, sunday_open, sunday_close');
}


/**
* Overwrite the lable 'Posts' with 'Stoies'
*/

function change_post_to_story( $translated ) {
  if( substr_count($translated, 'post.php')<1){
    $translated = str_ireplace(  'Post',  'Story',  $translated );  // ireplace is PHP5 only
    $translated = str_ireplace(  'Storys',  'Stories',  $translated );  // ireplace is PHP5 only
  }
  return $translated;
}


function my_admin_enqueue($hook) {
   global $post;
    //Load only on edit.php pages
    //You can use get_current_screen to check post type

    
    if(( 'post-new.php' == $hook ) or ('post.php' == $hook )){
        if($post->post_type == 'locations'){
          wp_enqueue_script( 'google_maps_api', "https://maps.googleapis.com/maps/api/js?sensor=false" );
          wp_enqueue_script( 'my_custom_script', plugins_url('/js/location-admin.js', __FILE__) );
        }
         /*** 
         we may want to move this out of this restriction (if statement) but for now I am only going to load on a
         as needed 
         */
        wp_deregister_script('jquery');
        wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js", false, null);
        wp_enqueue_script('jquery');
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


function process_menu($mypod,$daypart){

    $params = array(
                        'where' => "t.post_title = '".ucfirst($daypart)."'",
                        //'orderby' => "vinyl_capacity.meta_value ASC",
                        'limit' => '1'
                    );
    $daypart_pod = pods('daypart')->find($params);

    
    while( $daypart_pod->fetch() ) {
        $menu_categories = $daypart_pod->field('menu_categories');
         
    }
    
    //$menu = explode(',', $menu_categories);
    //$menu = array_flip(explode(',', $menu_categories));
    $menu = array_fill_keys(explode(',', $menu_categories),[]);
    
    if($mypod->total_found()){
        while( $mypod->fetch() ) {
            foreach (['featured_item','title','description', 'fma_promo', 'story', 'menu_key_relationship', 'price_max', 'price_min','daypart_relationship','menu_category'] as $key => $value) {
                 $item[$value] = $mypod->field($value);
            }
            $item['featured_img'] =  get_the_post_thumbnail( $mypod->id() ); 

            
                if(strtolower($item['daypart_relationship']['post_title']) == strtolower($daypart)){
                    $menu[$item['menu_category']['slug']]['items'][] = $item;

                    if($item['featured_item'] = 1){
                        $menu[$item['menu_category']['slug']]['featured'] = $item;
                    }
                }

        }

        return $menu;
    }
}

add_action( 'lam_process_menu', 'process_menu' );


// function my_jquery_enqueue() {
//     die('dd');
//    wp_deregister_script('jquery');
//    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js", false, null);
//    wp_enqueue_script('jquery');
// }
// add_action("admin_enqueue_scripts", "my_jquery_enqueue", 11);



