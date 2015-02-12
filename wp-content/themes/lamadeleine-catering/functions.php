<?php
/** La Madeleine Catering - functions.php
* 	Author: nFusion
*/

/*** Header Navigation ***/
function header_menus() {
  register_nav_menus(
    array(
      'left-menu' => __( 'Left Header' ),
      'right-menu' => __( 'Right Header ' )
    )
  );
}
add_action( 'init', 'header_menus' );

/*** Custom Taxonomies ***/
// function add_custom_taxonomies() {
// 	register_taxonomy('Menu Categories','page', array(
// 		),)
// }

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