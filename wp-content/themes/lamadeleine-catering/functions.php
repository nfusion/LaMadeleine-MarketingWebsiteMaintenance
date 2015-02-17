<?php
/** La Madeleine Catering - functions.php
* 	Author: nFusion
*/
// include custom walker.
include_once('Walker_Left_Menu.class.php');

/*** Header Navigation ***/
function header_menus() {
  register_nav_menus(
    array(
      'left-menu' => __( 'Left Header' ),
      'right-menu' => __( 'Right Header ' ),
      'footer-menu' => __( 'Footer' )
    )
  );
}
add_action( 'init', 'header_menus' );

/*** Custom Taxonomies ***/
// register the taxonomy
function custom_menu_taxonomies() {
    $labels = array(
    'name' => _x( 'Menu Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Menu Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Menu Categories' ),
    'all_items' => __( 'All Menu Categories' ),
    'parent_item' => __( 'Parent Menu Categories' ),
    'parent_item_colon' => __( 'Parent Menu Category:' ),
    'edit_item' => __( 'Edit Menu Category' ), 
    'update_item' => __( 'Update Menu Category' ),
    'add_new_item' => __( 'Add New Menu Category' ),
    'new_item_name' => __( 'New Menu Category' ),
    'menu_name' => __( 'Menu Categories' ),
  );  
	register_taxonomy('menu_categories','menu_items', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'menu-categories' ),
  ));
}
add_action( 'init', 'custom_menu_taxonomies', 0 );

/*** Custom Post Types ***/
function menu_post_type() {
  $labels = array(
    'name'               => _x( 'Menu Items', 'post type general name' ),
    'singular_name'      => _x( 'Menu Item', 'post type singular name' ),
    'add_new'            => _x( 'Add New', '' ),
    'add_new_item'       => __( 'Add New Menu Item' ),
    'edit_item'          => __( 'Edit Menu Item' ),
    'new_item'           => __( 'New Menu Item' ),
    'all_items'          => __( 'All Menu Items' ),
    'view_item'          => __( 'View Menu Item' ),
    'search_items'       => __( 'Search Menu' ),
    'not_found'          => __( 'No menu item found' ),
    'not_found_in_trash' => __( 'No menu item found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Menu Items'
  );
  $args = array(
    'labels'        => $labels,
    'public'        => true,
    'supports'      => array( 'title','editor','custom-fields' ),
    'has_archive'   => true,
  );
  register_post_type( 'menu_items', $args ); 
  flush_rewrite_rules();
}
add_action( 'init', 'menu_post_type' );

function getCateringLocations() {
  $upload_dir = wp_upload_dir();
  $file = network_site_url('/wp-content/uploads/json/catering-locations.json?t='.mktime());
  $json = file_get_contents($file);
  return json_decode($json);
}

//Home Title hack
add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );
function baw_hack_wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return __( 'catering by la Madeleine', 'theme_domain' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}