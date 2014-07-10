<?php
namespace Voce\Thermal\v1\Models;

class Locations {


	public function findbyCord($lat, $lng){
		global $wpdb;
		$sql = <<<query

		SELECT  lwp_posts.post_title as title ,

		lwp_pods_locations.id,
		lwp_pods_locations.address,
		lwp_pods_locations.address_2,
		lwp_pods_locations.city,
		lwp_pods_locations.state,
		lwp_pods_locations.phone,
		lwp_pods_locations.zip_code,
		lwp_pods_locations.menu_pricing,
		lwp_pods_locations.latitude,
		lwp_pods_locations.longitude,

		lwp_pods_locations.days_closed,
		 
		DATE_FORMAT(lwp_pods_locations.sunday_open, '%l:%i %p') as sunday_open, 
		DATE_FORMAT(lwp_pods_locations.sunday_close, '%l:%i %p') as sunday_close,
		DATE_FORMAT(lwp_pods_locations.monday_open, '%l:%i %p') as monday_open, 
		DATE_FORMAT(lwp_pods_locations.monday_close, '%l:%i %p') as monday_close,
		DATE_FORMAT(lwp_pods_locations.tuesday_open, '%l:%i %p') as tuesday_open,
		DATE_FORMAT(lwp_pods_locations.tuesday_close, '%l:%i %p') as tuesday_close,

		DATE_FORMAT(lwp_pods_locations.wednesday_open, '%l:%i %p') as wednesday_open,
		DATE_FORMAT(lwp_pods_locations.wednesday_close, '%l:%i %p') as wednesday_close,

		DATE_FORMAT(lwp_pods_locations.thursday_open, '%l:%i %p') as thursday_open,
		DATE_FORMAT(lwp_pods_locations.thursday_close, '%l:%i %p') as thursday_close,

		DATE_FORMAT(lwp_pods_locations.friday_open, '%l:%i %p') as friday_open,
		DATE_FORMAT(lwp_pods_locations.friday_close, '%l:%i %p') as friday_close,

		DATE_FORMAT(lwp_pods_locations.saturday_open, '%l:%i %p') as saturday_open,
		DATE_FORMAT(lwp_pods_locations.saturday_close, '%l:%i %p') as saturday_close,


		SQRT(
			POW(69.1 * (lwp_pods_locations.latitude - {$lat}), 2) +
		    POW(69.1 * ({$lng} - lwp_pods_locations.longitude) * COS(lwp_pods_locations.latitude / 57.3), 2)) 
		AS distance

		FROM lwp_pods_locations 

		LEFT JOIN lwp_posts ON lwp_pods_locations.id=lwp_posts.id

		HAVING distance < 100  
		
		ORDER BY distance

query;
	

		
		return $wpdb->get_results( $sql, OBJECT );


	}


	public function find( $args = array( ), &$found = null ) {
		
		//add filter for before/after handling, hopefully more complex date querying
		//will exist by wp3.7
		if ( isset( $args['before'] ) || isset( $args['after'] ) ) {
			add_filter( 'posts_where', array( $this, '_filter_posts_where_handleDateRange' ), 10, 2 );
		}

		if( isset( $args['post_type'] ) && in_array('attachment', (array) $args['post_type'])) {
			if(empty($args['post_status'])) {
				$args['post_status'] = array('inherit');
			} else {
				$args['post_status'] = array_merge((array) $args['post_status'], array('inherit'));
			}
		}
		
		if( empty( $args['post_status'] ) ) {
			//a post_status is required
			return array();
		}
		
		if(isset($args['per_page'])) {
			$args['posts_per_page'] = $args['per_page'];
			unset($args['per_page']);
		}
		$wp_posts = new \WP_Query( $args );

		if ( $wp_posts->have_posts() ) {
			$found = ( int ) $wp_posts->found_posts;
			return $wp_posts->posts;
		}
		return array();
		
	}
	
	public function findById($id) {
		return get_post($id);
	}
	
	public function _filter_posts_where_handleDateRange( $where, $wp_query ) {
		if ( ($before = $wp_query->get( 'before' ) ) && $beforets = strtotime( $before ) ) {
			if ( preg_match( '$:[0-9]{2}\s[+-][0-9]{2}$', $before ) || strpos( $before, 'GMT' ) !== false ) {
				//adjust to site time if a timezone was set in the timestamp
				$beforets += ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
			}

			$where .= sprintf( " AND post_date < '%s'", gmdate( 'Y-m-d H:i:s', $beforets ) );
		}
		if ( ($after = $wp_query->get( 'after' ) ) && $afterts = strtotime( $after ) ) {
			if ( preg_match( '$:[0-9]{2}\s[+-][0-9]{2}$', $after ) || strpos( $after, 'GMT' ) !== false ) {
				//adjust to site time if a timezone was set in the timestamp
				$afterts += ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
			}

			$where .= sprintf( " AND post_date > '%s'", gmdate( 'Y-m-d H:i:s', $afterts ) );
		}
		remove_filter('posts_search', array($this, __METHOD__));
		return $where;
	}
	
}