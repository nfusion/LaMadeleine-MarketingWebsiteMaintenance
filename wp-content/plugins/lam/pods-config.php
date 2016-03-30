<?php

/*
Plugin Name: la Madeleine Pods Configuration
Depends: Pods - Custom Content Types and Fields
Plugin URI: http://lamadeleine.com
Description: Custom Pods functionality for site administration.
Author: Katherine White <kwhite@nfusion.com>
Version: 1.0
Author URI: http://nfusion.com
*/

function lam_metaboxes() {
	
	
	// Pod: Location
	$pod = 'locations';
	$metaboxes = array(
		// location metadata
		array(
			'label' => 'Location Details',
			'fields' => array(
				'address',
				'address_2',
				'city',
				'state',
				'zip_code',
				'phone',
				'latitude',
				'longitude'
			)
		),
		// menu customizations
		array(
			'label' => 'Menu Details',
			'fields' => array(
				'menu_pricing',
				'catering_available'
			),
			'context' => 'side'
		),
		// Post Meta/System Information
		array(
			'label' => 'Store Hours',
			'fields' => array(
				'days_closed',
				'sunday_open',
				'sunday_close',
				'monday_open',
				'monday_close',
				'tuesday_open',
				'tuesday_close',
				'wednesday_open',
				'wednesday_close',
				'thursday_open',
				'thursday_close',
				'friday_open',
				'friday_close',
				'saturday_open',
				'saturday_close'
			)
		)
	);
	
	pods_hook_metaboxes($pod,$metaboxes);

	// Pod: Menu Item
	$pod = 'menu_item';
	$metaboxes = array(
		array(
			'label' => 'Menu Item Details',
			'fields' => array(
				'description' ,  
				'menu_key_relationship', 
				'story', 
				'fma_promo', 
				'daypart_relationship', 
				'menu_category', 
				'featured_item', 
				'order_weight'
			)
		),
		array (
			'label' => 'Menu Item Pricing',
			'fields' => array(
				'price_min', 
				'price_tier_2',
				'price_tier_3',
				'price_max',
			)
		),
		array(
			'label' => 'First Option',
			'fields' => array(
				'description_1', 
				'optional_min_price_1', 
				'optional_price_1_tier_2', 
				'optional_price_1_tier_3', 
				'optional_max_price_1'
			)
		),
		array(
			'label' => 'Second Option',
			'fields' => array(
				'description_2', 
				'optional_min_price_2',
				'optional_price_2_tier_2',  
				'optional_price_2_tier_3', 
				'optional_max_price_2'
			)
		),
		array(
			'label' => 'Third Option',
			'fields' => array(
				'description_3', 
				'optional_min_price_3', 
				'optional_price_3_tier_2',  
				'optional_price_3_tier_3', 
				'optional_max_price_3'
			)
		),
		array(
			'label' => 'Fourth Option',
			'fields' => array(
				'description_4', 
				'optional_min_price_4', 
				'optional_price_4_tier_2',  
				'optional_price_4_tier_3', 
				'optional_max_price_4'
			)
		),
		array(
			'label' => 'Fifth Option',
			'fields' => array(
				'description_5', 
				'optional_min_price_5', 
				'optional_price_5_tier_2',  
				'optional_price_5_tier_3', 
				'optional_max_price_5'
			)
		)
	);

	pods_hook_metaboxes($pod,$metaboxes);
}

function pods_hook_metaboxes($pod,$metaboxes) {
	$defaults = array(
		'context' => 'normal',
		'priority' => 'default',
		'type' => null
	);
	foreach ($metaboxes as $metabox) {
		$metabox = wp_parse_args( $metabox, $defaults );
		pods_group_add ( $pod, $metabox['label'], $metabox['fields'], $metabox['context'], $metabox['priority'], $metabox['type'] );
	}
}
// Hook into Pods Metaboxes 
add_action( 'pods_meta_groups', 'lam_metaboxes', 10, 2 );

function lam_locations_taxonomy() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'La G&eacute;ographie', 'taxonomy general name' ),
		'singular_name'     => _x( 'Geo Area', 'taxonomy singular name' ),
		'search_items'      => __( 'Search La G&eacute;ographie' ),
		'all_items'         => __( 'All Geo Areas' ),
		'parent_item'       => __( 'Parent Area' ),
		'parent_item_colon' => __( 'Parent Area:' ),
		'edit_item'         => __( 'Edit Area' ),
		'update_item'       => __( 'Update Area' ),
		'add_new_item'      => __( 'Add New Area' ),
		'new_item_name'     => __( 'New Area Name' ),
		'menu_name'         => __( 'La G&eacute;ographie' )
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'public'			=> false
		//'rewrite'           => array( 'slug' => 'geographie' ),
	);

	register_taxonomy( 'geographie', array( 'locations' ), $args );
}
add_action( 'init', 'lam_locations_taxonomy', 0 );

add_action( 'plugins_loaded', 'lam_admin_disable_cache', 9 );
function lam_admin_disable_cache() {
	if (is_admin()) {
		define( 'PODS_ALT_CACHE', false );
	}
}