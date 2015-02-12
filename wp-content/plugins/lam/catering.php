<?php

/*
Plugin Name: la Madeleine Catering Support
Plugin URI: http://lamadeleine.com
Description: JSON generation and additional location support for the catering site.
Author: Katherine White <kwhite@nfusion.com>
Version: 1.0
Author URI: http://nfusion.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once('logger.class.php');
new Catering_Locations();


/**
 * Catering_Locations
 *
 * @class Catering_Locations
 * @version	1.0.0
 * @since   1.0.0
 * @package	lamadeleine
 * @author  Kat
 */
class Catering_Locations {
	/**
	 * The single instance of Catering_Locations.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;
	
	// set class constants.
	//const CRON_LENGTH = '60 days ago';

	/**
	 * Main Catering_Locations Instance
	 *
	 * Ensures only one instance of Catering_Locations is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @return Main Catering_Locations instance
	 */
	public static function instance () {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct () {
	
		// Register the custom field settings with WordPress.
		//add_action( 'init', array( $this, 'ebd_load_alchemy' ) );
		
		// add gating maintenance to cron.
		if ( ! wp_next_scheduled( 'lam_process_locations' ) ) {
			wp_schedule_event( time(), 'daily', 'lam_process_locations' );
		}
		add_action( 'lam_process_locations', array( $this, 'lam_build_location_json' ) );

	} // End __construct()

	/**
	 * Adds an is_gated flag to all posts matching the archival parameters.
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function lam_build_location_json () {
		global $wpdb;
		global $table_prefix;

		// create cron logger
		$filepath = __DIR__ . "/logs/cron.txt";
		$logger = new Logger($filepath);

		// stashing this for later use.
		$catering = $wpdb->get_results( 
			'SELECT * FROM ' . $table_prefix . 'pods_locations l ' . 
			'WHERE l.catering_available = 1', OBJECT );
		
		// build an array that is keyed off of the post ID.
		foreach ($catering as $location) {
			$locations[$location->id] = $location;
		}

		// get all terms with assigned posts
		$args = array(
			'orderby'=>'name',
			'order' => 'ASC',
			'hide_empty' => false
		);
		$terms = get_terms('geographie', $args);
		$termsById = array();

		foreach ($terms as $term) {
			$termsById['t'.$term->term_id] = $term;
		}
		$terms = $termsById;

		// build array of posts nested under terms.
		foreach ( $terms as $key=>$term ) {
			
			$children = get_term_children( $term->term_id, 'geographie' );
			$args = array(
				'post_type' => 'locations',
				'tax_query' => array(
					array(
						'taxonomy' => 'geographie',
						'terms'    => $term->term_id
					),
					array(
						'taxonomy' => 'geographie',
						'terms' => $children,
						'operator' => 'NOT IN'
					)
				),
				'post__in' => array_keys($locations),
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order'   => 'ASC'
			);
			$term_posts = get_posts($args);

			foreach ($term_posts as $post) {
				// build array of post data from pods.
				$terms[$key]->places[] = $locations[$post->ID]; 
			}

			if ( !empty($term->parent) ) {

				$terms['t'.$term->parent]->places[] = $term;
				unset($terms[$key]);
			} 
		}

		$this->writeJSON(array_values($terms));
		//$logger->AddRow( print_r($terms,1) );

		//$logger->Commit();
		return true;
	}
	/**
	 * File write for static JSON locations file.
	 * @access private
	 * @since  1.0.0
	 * @return void
	 */
	private function writeJSON($build) {
		$upload_dir = wp_upload_dir();
    	$path = $upload_dir['basedir'] . '/json';
    	$url = $upload_dir['baseurl'] . '/json';
    	if ( ! file_exists($path) ) mkdir($path, 0775);

		$fp = fopen(trailingslashit($path).'locations.json', 'w');
		fwrite($fp, json_encode($build));
		fclose($fp);
	}
	/**
	 * Alphabetical sort utility for aggregated posts/terms.
	 * @access private
	 * @since  1.0.0
	 * @return void
	 */
	private function alphaSort($a, $b) {
	// posts come through as arrays
	if (is_array($a)) {
		return strcasecmp($a['name'], $b['name']);
	}
	// terms come through as objects
	if (is_object($a)) {
		return strcasecmp($a->name, $b->name);
	}
	
}
} // End Class