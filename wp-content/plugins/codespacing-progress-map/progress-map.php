<?php
/* 
Plugin Name: Progress Map by Codespacing
Description: <strong>Progress Map</strong> is a Wordpress plugin for location listings. With this plugin, your locations will be listed on both Google map (as markers) and a carousel (as locations details), this last will be related to the map, which means that the selected item in the carousel will target its location in the map and vice versa.
Version: 2.6.0
Author: Codespacing
Author URI: http://www.codespacing.com/
*/

if( !class_exists( 'CodespacingProgressMap' ) )
{
	
	class CodespacingProgressMap
	{
		
		private static $_this;	
		private $plugin_path;
		public $cspm_plugin_path;
		private $plugin_url;
		public $cspm_plugin_url;
		private $l10n;
		private $cspm_wpsf;
		private $plugin_get_var = 'cs_progress_map_plugin';
		public $settings = array();
		public $post_type = 'post';
		public $secondary_post_type = '';
		public $horizontal_item_size = '414,120';
		public $horizontal_item_width = '414';
		public $horizontal_item_height = '120';
		public $horizontal_image_size = '174,120';
		public $horizontal_img_width = '174';
		public $horizontal_img_height = '120';
		public $vertical_item_size = '174,240';
		public $vertical_item_width = '174';
		public $vertical_item_height =  '240';
		public $vertical_image_size = '174,90';			
		public $vertical_img_width = '174';
		public $vertical_img_height = '90';
		public $show_details_btn = 'yes';
		public $items_title = '';
		public $click_on_title = 'no'; //@since 2.5	
		public $external_link = 'same_window'; //@since 2.5
		public $items_details = '';
		public $details_btn_css = '';
		public $details_btn_text = '';
		public $carousel_mode = 'false';
		public $number_of_items = '';		
		public $custom_fields = '';		
		public $custom_field_relation_param = '';		
		public $post_in = '';		
		public $post_not_in = '';		
		public $cache_results = '';
		public $update_post_meta_cache = '';
		public $update_post_term_cache = '';
		public $orderby_param = '';
		public $orderby_meta_key = '';
		public $order_param = '';
		public $main_layout = 'mu-cd';	
		public $layout_type = 'full_width';
		public $layout_fixed_width = '700';
		public $layout_fixed_height = '600';
		public $map_language = 'en';
		public $center = '51.53096,-0.121064';			
		public $wrong_center_point = false;
		public $initial_map_style = 'ROADMAP';
		public $zoom = '12';
		public $useClustring = 'true';
		public $gridSize = '60';
		public $mapTypeControl = 'true';
		public $streetViewControl = 'false';
		public $scrollwheel = 'false';
		public $panControl = 'false';					
		public $zoomControl = 'false';
		public $zoomControlType = 'true';
		/**
		 * @Deprecated since 2.5
		 ***********************/
		 public $show_infowindow = 'true'; 
		 public $infowindow_type = 'bubble_style';
		 /***********************
		 */
		public $marker_icon = '';			
		public $big_cluster_icon = '';
		public $medium_cluster_icon = '';
		public $small_cluster_icon = ''; 
		public $cluster_text_color = '#ffffff';			
		public $zoom_in_icon = '';	
		public $zoom_in_css = '';
		public $zoom_out_icon = '';
		public $zoom_out_css = '';
		public $defaultMarker = '';
		public $retinaSupport = 'false';
		public $geoIpControl = 'false';	
		public $pulsating_circle = 'pulsating_circle'; // @since 2.5		
		public $content_overlay_horizontal_pos = '-125';
		public $content_overlay_vertical_pos = '-168';
		public $bubble_horizontal_pos = '4';
		public $bubble_vertical_pos = '-80';
		public $bubble_link_text = 'More';
		public $bubble_link_css = '';
		public $bubble_external_link = 'false';
		public $show_carousel = 'true';
		public $carousel_scroll = '1';
		public $carousel_animation = 'fast';
		public $carousel_easing = 'linear';
		public $carousel_auto = '0';
		public $carousel_wrap = 'circular';	
		public $scrollwheel_carousel = 'false';	
		public $touchswipe_carousel = 'false';	
		public $carousel_map_zoom = '12';
		public $carousel_css = '';	
		public $arrows_background = '#f1f1f1';	
		public $horizontal_left_arrow_icon = '';
		public $horizontal_right_arrow_icon = '';	
		public $vertical_top_arrow_icon = '';
		public $vertical_bottom_arrow_icon = '';
		public $items_background = '#f9f9f9';	
		public $items_hover_background = '#f3f3f3';	
		public $items_view = 'listview';
		public $horizontal_item_css = '';
		public $horizontal_title_css = '';
		public $horizontal_details_css = '';
		public $vertical_item_css = '';
		public $vertical_title_css = '';
		public $vertical_details_css = '';
		public $horizontal_details_size = '240,120';
		public $horizontal_details_width = '240';
		public $horizontal_details_height = '120';
		public $vertical_details_size = '174,150';
		public $vertical_details_width = '174';
		public $vertical_details_height = '150';
		public $show_posts_count = 'no';
		public $posts_count_clause = '[posts_count] Posts';
		public $posts_count_color = '#000000';
		public $posts_count_style = '';
		public $show_overlay = 'no';
		public $overlay_path = '';
		public $overlay_draggable = 'yes';
		public $overlay_width = '400';
		public $overlay_height = '250';
		public $overlay_top = '10';
		public $overlay_left = '30';
		public $overlay_color = '#ffffff';
		public $overlay_opacity = '0.8';
		public $overlay_css = '';
		public $marker_cats_settings = 'false';
		public $marker_taxonomies = '';
		public $faceted_search_option = 'false';
		public $faceted_search_multi_taxonomy_option = 'true';
		public $faceted_search_input_skin = 'polaris';
		public $faceted_search_input_color = 'blue';
		public $faceted_search_icon = '';
		public $faceted_search_css = '';
		public $search_form_option = 'false';
		public $sf_search_distances = '3,5,10,30,50';
		public $sf_distance_unit = 'metric';
		public $address_placeholder = 'Enter City & Province, or Postal code';
		public $slider_label = 'Expand the search area up to'; // @since 2.5				
		public $no_location_msg = 'We could not find any location'; // @since 2.5		
		public $bad_address_msg = 'We could not understand the location'; // @since 2.5		
		public $bad_address_sug_1 = '- Make sure all street and city names are spelled correctly.'; // @since 2.5		
		public $bad_address_sug_2 = '- Make sure your address includes a city and state.'; // @since 2.5		
		public $bad_address_sug_3 = '- Try entering a zip code.'; // @since 2.5			
		public $submit_text = 'Search';
		public $search_form_icon = '';		
		public $search_form_bg_color = 'rgba(255,255,255,0.95)';
		public $circle_option = 'true';
		public $fillColor = '#189AC9';
		public $fillOpacity = '0.1';
		public $strokeColor = '#189AC9';				
		public $strokeOpacity = '1';
		public $strokeWeight = '1';						
		public $style_option = 'progress-map';
		public $map_style = 'google-map';	
		public $js_style_array = '';
		public $show_infobox = 'true'; // @since 2.5		
		public $infobox_type = 'rounded_bubble'; // @since 2.5		
		public $infobox_display_event = 'onload'; // @since 2.5		
		public $infobox_external_link = 'same_window'; // @since 2.5		
		public $use_ssl = 'http'; // @since 2.5		
		public $combine_files = 'combine'; // @since 2.5		
		public $loading_scripts = 'entire_site'; // @since 2.5		
		public $load_on_page_ids = ''; // @since 2.5		
		public $load_on_post_ids = ''; // @since 2.5		
		public $latitude_field_name = 'codespacing_progress_map_lat'; // @since 2.5		
		public $longitude_field_name = 'codespacing_progress_map_lng'; // @since 2.5
		public $outer_links_field_name = ''; //@since 2.5	
		
			
		function __construct() 
		{	
			
			self::$_this = $this;       
			$this->plugin_path = $this->cspm_plugin_path = plugin_dir_path( __FILE__ );
			$this->plugin_url = $this->cspm_plugin_url  = plugin_dir_url( __FILE__ );
			$this->l10n = 'wp-settings-framework';
			
			// Include and create a new WordPressSettingsFramework
			require_once( $this->plugin_path .'wp-settings-framework.php' );
			$this->cspm_wpsf = new CsPm_WordPressSettingsFramework( $this->plugin_path .'settings/codespacing-progress-map.php' );
			
			// Call plugin settings
			$this->settings = cspm_wpsf_get_settings( $this->plugin_path .'settings/codespacing-progress-map.php' );
				
				// "Add location" Form fields
				
				$this->latitude_field_name = str_replace(' ', '', $this->cspm_get_setting('troubleshooting', 'latitude_field_name', 'codespacing_progress_map_lat'));
				$this->longitude_field_name = str_replace(' ', '', $this->cspm_get_setting('troubleshooting', 'longitude_field_name', 'codespacing_progress_map_lng'));
				
				define('CSPM_ADDRESS_FIELD', 'codespacing_progress_map_address');
				define('CSPM_LATITUDE_FIELD', $this->latitude_field_name);
				define('CSPM_LONGITUDE_FIELD', $this->longitude_field_name);	
				define('CSPM_SECONDARY_LAT_LNG_FIELD', 'codespacing_progress_map_secondary_lat_lng');				
				
				// Other settings 
				$this->post_type = str_replace(' ', '', $this->cspm_get_setting('generalsettings', 'post_type', 'post'));
				$this->secondary_post_type = str_replace(' ', '', $this->cspm_get_setting('generalsettings', 'secondary_post_type'));
				
				$this->horizontal_item_size = $this->cspm_get_setting('itemssettings', 'horizontal_item_size', '414,120');
					
					if($explode_horizontal_item_size = explode(',', $this->horizontal_item_size)){
						$this->horizontal_item_width = $this->cspm_setting_exists(0, $explode_horizontal_item_size, '414');
						$this->horizontal_item_height = $this->cspm_setting_exists(1, $explode_horizontal_item_size, '120');
					}else{
						$this->horizontal_item_width = '414';
						$this->horizontal_item_height = '120';
					}
				
					$this->horizontal_image_size = $this->cspm_get_setting('itemssettings', 'horizontal_image_size', '174,120');
						
						if($explode_horizontal_img_size = explode(',', $this->horizontal_image_size)){
							$this->horizontal_img_width = $this->cspm_setting_exists(0, $explode_horizontal_img_size, '174');
							$this->horizontal_img_height = $this->cspm_setting_exists(1, $explode_horizontal_img_size, '120');
						}else{
							$this->horizontal_img_width = '174';
							$this->horizontal_img_height = '120';
						}
					
				$this->vertical_item_size = $this->cspm_get_setting('itemssettings', 'vertical_item_size', '174,240');
					
					if($explode_vertical_item_size = explode(',', $this->vertical_item_size)){
						$this->vertical_item_width = $this->cspm_setting_exists(0, $explode_vertical_item_size, '174');
						$this->vertical_item_height =  $this->cspm_setting_exists(1, $explode_vertical_item_size, '240');
					}else{
						$this->vertica_item_width = '174';
						$this->vertica_item_height = '240';
					}
					
					$this->vertical_image_size = $this->cspm_get_setting('itemssettings', 'vertical_image_size', '174,90');			
						
						if($explode_vertical_img_size = explode(',', $this->vertical_image_size)){
							$this->vertical_img_width = $this->cspm_setting_exists(0, $explode_vertical_img_size, '174');
							$this->vertical_img_height = $this->cspm_setting_exists(1, $explode_vertical_img_size, '90');
						}else{
							$this->vertical_img_width = '174';
							$this->vertical_img_height = '90';
						}
				
				// Add Images Size
				if(function_exists('add_image_size')){
					add_image_size( 'cspacing-horizontal-thumbnail', $this->horizontal_img_width, $this->horizontal_img_height, true );
					add_image_size( 'cspacing-vertical-thumbnail', $this->vertical_img_width, $this->vertical_img_height, true );
					add_image_size( 'cspacing-marker-thumbnail', 100, 100, true );
				}
			
			$this->show_details_btn = $this->cspm_get_setting('itemssettings', 'show_details_btn', 'yes');
			$this->items_title = $this->cspm_get_setting('itemssettings', 'items_title');
			$this->click_on_title = $this->cspm_get_setting('itemssettings', 'click_on_title');
			$this->external_link = $this->cspm_get_setting('itemssettings', 'external_link');
			$this->items_details = $this->cspm_get_setting('itemssettings', 'items_details');
			$this->details_btn_css = $this->cspm_get_setting('itemssettings', 'details_btn_css');
			$this->details_btn_text = $this->cspm_get_setting('itemssettings', 'details_btn_text');
			$this->carousel_mode = $this->cspm_get_setting('carouselsettings', 'carousel_mode', 'false');
			$this->outer_links_field_name = str_replace(' ', '', $this->cspm_get_setting('troubleshooting', 'outer_links_field_name', ''));
			
			// Ajax functions
			add_action('wp_ajax_cspm_load_carousel_item', array(&$this, 'cspm_load_carousel_item'));
			add_action('wp_ajax_nopriv_cspm_load_carousel_item', array(&$this, 'cspm_load_carousel_item'));
			
			add_action('wp_ajax_cspm_infobox_content', array(&$this, 'cspm_infobox_content'));
			add_action('wp_ajax_nopriv_cspm_infobox_content', array(&$this, 'cspm_infobox_content'));
			
			add_action('wp_ajax_cspm_load_clustred_markers_list', array(&$this, 'cspm_load_clustred_markers_list'));
			add_action('wp_ajax_nopriv_cspm_load_clustred_markers_list', array(&$this, 'cspm_load_clustred_markers_list'));
			
			add_action('wp_ajax_cspm_create_markers_array_for_latest_version', array(&$this, 'cspm_create_markers_array_for_latest_version'));
			
			if(is_admin()){
				
				// Add plugin menu
				add_action( 'admin_menu', array(&$this, 'cspm_admin_menu'), 99 );
			
				// Add custom links to plugin instalation area
				add_filter( 'plugin_row_meta', array(&$this, 'cspm_plugin_meta_links'), 10, 2 );
				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array(&$this, 'cspm_add_plugin_action_links') );
			
				// Add "Location" meta box to "Add" custom post type area
				add_action('admin_init', array(&$this, 'cspm_meta_box'));
				add_action('save_post', array(&$this, 'cspm_insert_meta_box_fields'));
			
				// Get out if the loaded page is not our plguin settings page
				if (isset($_GET['page']) && $_GET['page'] == $this->plugin_get_var ){
		
					// Call custom functions
					add_action( 'wpsf_before_settings', array(&$this, 'cspm_before_settings') );
					add_action( 'wpsf_after_settings', array(&$this, 'cspm_after_settings') );
			
					// Add an optional settings validation filter (recommended)
					add_filter( $this->cspm_wpsf->cspm_get_option_group() .'_settings_validate', array(&$this, 'cspm_validate_settings') );		
			
				}
				
				// @since 2.4
				register_activation_hook( __FILE__, array(&$this, 'cspm_sync_settings_for_latest_version' ));
				
			}else{
				
				// Query settings
				$this->number_of_items = $this->cspm_get_setting('generalsettings', 'number_of_items');		
				$this->custom_fields = $this->cspm_get_setting('generalsettings', 'custom_fields');
				$this->custom_field_relation_param = $this->cspm_get_setting('generalsettings', 'custom_field_relation_param');
				$this->post_in = $this->cspm_get_setting('generalsettings', 'post_in');
				$this->post_not_in = $this->cspm_get_setting('generalsettings', 'post_not_in');
				$this->cache_results = $this->cspm_get_setting('generalsettings', 'cache_results');
				$this->update_post_meta_cache = $this->cspm_get_setting('generalsettings', 'update_post_meta_cache');
				$this->update_post_term_cache = $this->cspm_get_setting('generalsettings', 'update_post_term_cache');
				$this->orderby_param = $this->cspm_get_setting('generalsettings', 'orderby_param');
				$this->orderby_meta_key = $this->cspm_get_setting('generalsettings', 'orderby_meta_key');
				$this->order_param = $this->cspm_get_setting('generalsettings', 'order_param');
									
				// Layout settings			
				$this->main_layout = $this->cspm_get_setting('layoutsettings', 'main_layout', 'mu-cd');	
				$this->layout_type = $this->cspm_get_setting('layoutsettings', 'layout_type', 'full_width');
				$this->layout_fixed_width = $this->cspm_get_setting('layoutsettings', 'layout_fixed_width', '700');
				$this->layout_fixed_height = $this->cspm_get_setting('layoutsettings', 'layout_fixed_height', '600');
					
				// Map settings
				$this->map_language = str_replace(' ', '', $this->cspm_get_setting('mapsettings', 'map_language', 'en'));
				$this->center = $this->cspm_get_setting('mapsettings', 'map_center', '51.53096,-0.121064');			
					$this->wrong_center_point = (strpos($this->center, ',') !== false) ? false : true;
									
				$this->initial_map_style = $this->cspm_get_setting('mapsettings', 'initial_map_style', 'ROADMAP');
				$this->zoom = $this->cspm_get_setting('mapsettings', 'map_zoom', '12');
				$this->useClustring = $this->cspm_get_setting('mapsettings', 'useClustring', 'true');
				$this->gridSize = $this->cspm_get_setting('mapsettings', 'gridSize', '60');
				$this->mapTypeControl = $this->cspm_get_setting('mapsettings', 'mapTypeControl', 'true');
				$this->streetViewControl = $this->cspm_get_setting('mapsettings', 'streetViewControl', 'false');
				$this->scrollwheel = $this->cspm_get_setting('mapsettings', 'scrollwheel', 'false');
				$this->panControl = $this->cspm_get_setting('mapsettings', 'panControl', 'false');					
				$this->zoomControl = $this->cspm_get_setting('mapsettings', 'zoomControl', 'false');
				$this->zoomControlType = $this->cspm_get_setting('mapsettings', 'zoomControlType', 'true');
				/**
				 * @Deprecated since 2.5
				 ***********************/
				 $this->show_infowindow = $this->cspm_get_setting('mapsettings', 'show_infowindow', 'true');
				 $this->infowindow_type = $this->cspm_get_setting('mapsettings', 'infowindow_type', 'bubble_style');
				 /**********************
				 */
				$this->marker_icon = $this->cspm_get_setting('mapsettings', 'marker_icon', $this->plugin_url.'img/pin-blue.png');			
				$this->big_cluster_icon = $this->cspm_get_setting('mapsettings', 'big_cluster_icon', $this->plugin_url.'img/big-cluster.png');
				$this->medium_cluster_icon = $this->cspm_get_setting('mapsettings', 'medium_cluster_icon', $this->plugin_url.'img/medium-cluster.png');
				$this->small_cluster_icon = $this->cspm_get_setting('mapsettings', 'small_cluster_icon', $this->plugin_url.'img/small-cluster.png'); 
				$this->cluster_text_color = $this->cspm_get_setting('mapsettings', 'cluster_text_color', '#ffffff');			
				$this->zoom_in_icon = $this->cspm_get_setting('mapsettings', 'zoom_in_icon');	
				$this->zoom_in_css = $this->cspm_get_setting('mapsettings', 'zoom_in_css');	
				$this->zoom_out_icon = $this->cspm_get_setting('mapsettings', 'zoom_out_icon');	
				$this->zoom_out_css = $this->cspm_get_setting('mapsettings', 'zoom_out_css');
				$this->defaultMarker = $this->cspm_get_setting('mapsettings', 'defaultMarker');
				$this->retinaSupport = $this->cspm_get_setting('mapsettings', 'retinaSupport', 'false');
				$this->geoIpControl = $this->cspm_get_setting('mapsettings', 'geoIpControl', 'false');			
				$this->markerAnimation = $this->cspm_get_setting('mapsettings', 'markerAnimation', 'pulsating_circle'); // @since 2.5
				
				// Infobox settings
				/**
				 * @since 2.5
				 */
				$this->show_infobox = $this->cspm_get_setting('infoboxsettings', 'show_infobox', 'true');
				$this->infobox_type = $this->cspm_get_setting('infoboxsettings', 'infobox_type', 'rounded_bubble');
				$this->infobox_display_event = $this->cspm_get_setting('infoboxsettings', 'infobox_display_event', 'onload');
				$this->infobox_external_link = $this->cspm_get_setting('infoboxsettings', 'infobox_external_link', 'same_window');
	
				// Marker overlay settings
				/**
				 * @Deprecated since 2.4.2
				 * @Use "Infobox settings" instead
				 */
				$this->content_overlay_horizontal_pos = $this->cspm_get_setting('markeroverlaysettings', 'content_overlay_horizontal_pos', '-125');
				$this->content_overlay_vertical_pos = $this->cspm_get_setting('markeroverlaysettings', 'content_overlay_vertical_pos', '-168');
				$this->bubble_horizontal_pos = $this->cspm_get_setting('markeroverlaysettings', 'bubble_horizontal_pos', '4');
				$this->bubble_vertical_pos = $this->cspm_get_setting('markeroverlaysettings', 'bubble_vertical_pos', '-80');
				$this->bubble_link_text = $this->cspm_get_setting('markeroverlaysettings', 'bubble_link_text', 'More');
				$this->bubble_link_css = $this->cspm_get_setting('markeroverlaysettings', 'bubble_link_css');
				$this->bubble_external_link = $this->cspm_get_setting('markeroverlaysettings', 'bubble_external_link', 'false');
			
				// Carousel settings
				$this->show_carousel = $this->cspm_get_setting('carouselsettings', 'show_carousel', 'true');
				$this->carousel_scroll = $this->cspm_get_setting('carouselsettings', 'carousel_scroll', '1');
				$this->carousel_animation = $this->cspm_get_setting('carouselsettings', 'carousel_animation', 'fast');
				$this->carousel_easing = $this->cspm_get_setting('carouselsettings', 'carousel_easing', 'linear');
				$this->carousel_auto = $this->cspm_get_setting('carouselsettings', 'carousel_auto', '0');
				$this->carousel_wrap = $this->cspm_get_setting('carouselsettings', 'carousel_wrap', 'circular');	
				$this->scrollwheel_carousel = $this->cspm_get_setting('carouselsettings', 'scrollwheel_carousel', 'false');	
				$this->touchswipe_carousel = $this->cspm_get_setting('carouselsettings', 'touchswipe_carousel', 'false');	
				$this->carousel_map_zoom = $this->cspm_get_setting('carouselsettings', 'carousel_map_zoom', '12');
					
				// Carousel style
				$this->carousel_css = $this->cspm_get_setting('carouselstyle', 'carousel_css');	
				$this->arrows_background = $this->cspm_get_setting('carouselstyle', 'arrows_background', '#f1f1f1');	
				$this->horizontal_left_arrow_icon = $this->cspm_get_setting('carouselstyle', 'horizontal_left_arrow_icon');	
				$this->horizontal_right_arrow_icon = $this->cspm_get_setting('carouselstyle', 'horizontal_right_arrow_icon');	
				$this->vertical_top_arrow_icon = $this->cspm_get_setting('carouselstyle', 'vertical_top_arrow_icon');	
				$this->vertical_bottom_arrow_icon = $this->cspm_get_setting('carouselstyle', 'vertical_bottom_arrow_icon');	
				$this->items_background = $this->cspm_get_setting('carouselstyle', 'items_background', '#f9f9f9');	
				$this->items_hover_background = $this->cspm_get_setting('carouselstyle', 'items_hover_background', '#f3f3f3');	
					
				// Items Settings
				$this->items_view = $this->cspm_get_setting('itemssettings', 'items_view', 'listview');
				$this->horizontal_item_css = $this->cspm_get_setting('itemssettings', 'horizontal_item_css');
				$this->horizontal_title_css = $this->cspm_get_setting('itemssettings', 'horizontal_title_css');
				$this->horizontal_details_css = $this->cspm_get_setting('itemssettings', 'horizontal_details_css');
				$this->vertical_item_css = $this->cspm_get_setting('itemssettings', 'vertical_item_css');
				$this->vertical_title_css = $this->cspm_get_setting('itemssettings', 'vertical_title_css');
				$this->vertical_details_css = $this->cspm_get_setting('itemssettings', 'vertical_details_css');
					
				$this->horizontal_details_size = $this->cspm_get_setting('itemssettings', 'horizontal_details_size', '240,120');
					
					if($explode_horizontal_details_size = explode(',', $this->horizontal_details_size)){
						$this->horizontal_details_width = $this->cspm_setting_exists(0, $explode_horizontal_details_size, '240');
						$this->horizontal_details_height = $this->cspm_setting_exists(1, $explode_horizontal_details_size, '120');
					}else{
						$this->horizontal_details_width = '240';
						$this->horizontal_details_height = '120';
					}
				
				$this->vertical_details_size = $this->cspm_get_setting('itemssettings', 'vertical_details_size', '174,150');
					
					if($explode_vertical_details_size = explode(',', $this->vertical_details_size)){
						$this->vertical_details_width = $this->cspm_setting_exists(0, $explode_vertical_details_size, '174');
						$this->vertical_details_height = $this->cspm_setting_exists(1, $explode_vertical_details_size, '150');
					}else{
						$this->vertical_details_width = '174';
						$this->vertical_details_height = '150';
					}
	
				// Posts count settings
				$this->show_posts_count = $this->cspm_get_setting('postscountsettings', 'show_posts_count', 'no');
				$this->posts_count_clause = $this->cspm_get_setting('postscountsettings', 'posts_count_clause', '[posts_count] Posts');
				$this->posts_count_color = $this->cspm_get_setting('postscountsettings', 'posts_count_color', '#000000');
				$this->posts_count_style = $this->cspm_get_setting('postscountsettings', 'posts_count_style');
	
				// Marker categories settings
				$this->marker_cats_settings = $this->cspm_get_setting('markercategoriessettings', 'marker_cats_settings', 'false');
				$this->marker_taxonomies = $this->cspm_get_setting('markercategoriessettings', 'marker_taxonomies');
		
				// Faceted search settings
				$this->faceted_search_option = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_option', 'false');
				$this->faceted_search_multi_taxonomy_option = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_multi_taxonomy_option', 'true');
				$this->faceted_search_input_skin = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_input_skin', 'polaris');
				$this->faceted_search_input_color = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_input_color', 'blue');
				$this->faceted_search_icon = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_icon');
				$this->faceted_search_css = $this->cspm_get_setting('facetedsearchsettings', 'faceted_search_css');
	
				// Search form settings			
				$this->search_form_option = $this->cspm_get_setting('searchformsettings', 'search_form_option', 'false');
				$this->sf_search_distances = $this->cspm_get_setting('searchformsettings', 'sf_search_distances', '3,5,10,30,50');
				$this->sf_distance_unit = $this->cspm_get_setting('searchformsettings', 'sf_distance_unit', 'metric');
				$this->address_placeholder = $this->cspm_get_setting('searchformsettings', 'address_placeholder', 'Enter City & Province, or Postal code');
				$this->slider_label = $this->cspm_get_setting('searchformsettings', 'slider_label', 'Expand the search area up to');
				$this->no_location_msg = $this->cspm_get_setting('searchformsettings', 'no_location_msg', 'We could not find any location');
				$this->bad_address_msg = $this->cspm_get_setting('searchformsettings', 'bad_address_msg', 'We could not understand the location');
				$this->bad_address_sug_1 = $this->cspm_get_setting('searchformsettings', 'bad_address_sug_1', '- Make sure all street and city names are spelled correctly.');
				$this->bad_address_sug_2 = $this->cspm_get_setting('searchformsettings', 'bad_address_sug_2', '- Make sure your address includes a city and state.');
				$this->bad_address_sug_3 = $this->cspm_get_setting('searchformsettings', 'bad_address_sug_3', '- Try entering a zip code.');
				$this->submit_text = $this->cspm_get_setting('searchformsettings', 'submit_text', 'Find it');
				$this->search_form_icon = $this->cspm_get_setting('searchformsettings', 'search_form_icon');
				$this->search_form_bg_color = $this->cspm_get_setting('searchformsettings', 'search_form_bg_color', 'rgba(255,255,255,1)');
				$this->circle_option = $this->cspm_get_setting('searchformsettings', 'circle_option', 'true');
				$this->fillColor = $this->cspm_get_setting('searchformsettings', 'fillColor', '#189AC9');
				$this->fillOpacity = $this->cspm_get_setting('searchformsettings', 'fillOpacity', '0.1');
				$this->strokeColor = $this->cspm_get_setting('searchformsettings', 'strokeColor', '#189AC9');				
				$this->strokeOpacity = $this->cspm_get_setting('searchformsettings', 'strokeOpacity', '1');
				$this->strokeWeight = $this->cspm_get_setting('searchformsettings', 'strokeWeight', '1');						
				
				// map styles section
				$this->style_option = $this->cspm_get_setting('mapstylesettings', 'style_option', 'progress-map');
				$this->map_style = $this->cspm_get_setting('mapstylesettings', 'map_style', 'google-map');
				$this->js_style_array = $this->cspm_get_setting('mapstylesettings', 'js_style_array', '');
				
				// Troubleshooting & Configs
				/**
				 * @since 2.5
				 */
				$this->use_ssl = $this->cspm_get_setting('troubleshooting', 'use_ssl', 'http');
				$this->combine_files = $this->cspm_get_setting('troubleshooting', 'combine_files', 'combine');
				$this->loading_scripts = $this->cspm_get_setting('troubleshooting', 'loading_scripts', 'entire_site');
				$this->load_on_page_ids = $this->cspm_get_setting('troubleshooting', 'load_on_page_ids', '');
				$this->load_on_post_ids = $this->cspm_get_setting('troubleshooting', 'load_on_post_ids', '');			
						
				// Call .js and .css files
				add_action('wp_enqueue_scripts', array(&$this, 'cspm_styles'));
				add_action('wp_enqueue_scripts', array(&$this, 'cspm_scripts'));
		
				// Add custom header script
				add_filter('wp_head', array(&$this, 'cspm_header_script'));
					
				// Create plugin shortcode
				add_shortcode('codespacing_progress_map', array(&$this, 'cspm_main_map_shortcode'));
				add_shortcode('codespacing_light_map', array(&$this, 'cspm_light_map_shortcode'));
				add_shortcode('codespacing_static_map', array(&$this, 'cspm_static_map_shortcode'));
			 
			}
			
		}
	
		static function this()
		{
			return self::$_this;
		}
		
		function cspm_admin_menu()
		{	
			add_menu_page( __( 'Progress map', $this->l10n ), __( 'Progress map', $this->l10n ), 'manage_options', 'cs_progress_map_plugin', array(&$this, 'cspm_settings_page'), $this->plugin_url.'/img/menu-icon.png' );
		}		
						
		function cspm_settings_page()
		{
			// Your settings page
			?>
			<div class="wrap">
				<?php 
				// Output your settings form
				$this->cspm_wpsf->cspm_settings(); 
				?>
			</div>
			<?php
				
			// Save string for WPML
			// @since 2.5 ====
			$this->cspm_wpml_register_string('"More" Button text', $this->details_btn_text);					
			$this->cspm_wpml_register_string('Posts count clause', $this->posts_count_clause);					
			$this->cspm_wpml_register_string('Address field placeholder', $this->address_placeholder);
			$this->cspm_wpml_register_string('Expand the search area up to', $this->slider_label);
			$this->cspm_wpml_register_string('We could not find any location', $this->no_location_msg);
			$this->cspm_wpml_register_string('We could not understand the location', $this->bad_address_msg);
			$this->cspm_wpml_register_string('- Make sure all street and city names are spelled correctly.', $this->bad_address_sug_1);
			$this->cspm_wpml_register_string('- Make sure your address includes a city and state.', $this->bad_address_sug_2);
			$this->cspm_wpml_register_string('- Try entering a zip code.', $this->bad_address_sug_3);
			$this->cspm_wpml_register_string('Find it', $this->submit_text);
			// ===============		
		}
		
		// Add settings link to plugin instalation area
		function cspm_add_plugin_action_links( $links ) {
		 
			return array_merge(
				array(
					'settings' => '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/admin.php?page=cs_progress_map_plugin">Settings</a>'
				),
				$links
			);
		 
		}	
	
		// Add plugin site link to plugin instalation area
		function cspm_plugin_meta_links( $links, $file ) {
		 
			$plugin = plugin_basename(__FILE__);
		 
			// create link
			if ( $file == $plugin ) {
				return array_merge(
					$links,
					array(
						'get_start' => '<a target="_blank" href="http://www.codespacing.com/progress-map-get-strat/">Get start</a>',
						'documentation' => '<a target="_blank" href="http://www.codespacing.com/progress-map-shortcodes/">Documentation</a>'
					)
				);
			}
			return $links;
		 
		}
		
		// Get the value of a setting
		// @since 2.4
		function cspm_get_setting($section_id, $setting_id, $default_value = ''){
			
			return $this->cspm_setting_exists('codespacingprogressmap_'.$section_id.'_'.$setting_id.'', $this->settings, $default_value);
			
		}
		
		// Check if array_key_exists and if empty() doesn't return false
		// Replace the empty value with the default value if available 
		// @empty() return false when the value is (null, 0, "0", "", 0.0, false, array())
		// @since 2.4
		function cspm_setting_exists($key, $array, $default = ''){
			
			$array_value = isset($array[$key]) ? $array[$key] : $default;
			
			$setting_value = empty($array_value) ? $default : $array_value;
			
			return $setting_value;
			
		}
		
		function cspm_validate_settings( $input )
		{	    
			// Do your settings validation here
			// Same as $sanitize_callback from http://codex.wordpress.org/Function_Reference/register_setting
			return $input;
		}	
		
		// Register & Enqueue CSS files
		function cspm_styles() 
		{
			
			if($this->combine_files == "combine"){
					
				wp_register_style('cspm_font', ''.$this->use_ssl.'://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700&subset=latin,latin-ext,cyrillic-ext,cyrillic,greek-ext,greek,vietnamese');				
				wp_register_style('cspm_icheck_css', $this->plugin_url .'css/icheck/all.css?v=0.9.1');
				wp_register_style('cspm_frontend_styles', $this->plugin_url .'css/cspm_frontend_styles.css');
				
				wp_enqueue_style('cspm_font');
				wp_enqueue_style('cspm_icheck_css');
				wp_enqueue_style('cspm_frontend_styles');
				
			}else{
					
				wp_register_style('cspm_bootstrap_css', $this->plugin_url .'css/bootstrap.css');
				wp_register_style('cspm_carousel_css', $this->plugin_url .'css/carousel/default.css');
				wp_register_style('cspm_map_css', $this->plugin_url .'css/style.css');
				wp_register_style('cspm_loading_css', $this->plugin_url .'css/loading.css');
				wp_register_style('cspm_mCustomScrollbar_css', $this->plugin_url .'css/jquery.mCustomScrollbar.css');
				wp_register_style('cspm_icheck_css', $this->plugin_url .'css/icheck/all.css?v=0.9.1');
				wp_register_style('cspm_nprogress_css', $this->plugin_url .'css/nprogress.css');
				wp_register_style('cspm_animate_css', $this->plugin_url .'css/min/animate.min.css');
				wp_register_style('cspm_rangeSlider_css', $this->plugin_url .'css/rangeSlider/ion.rangeSlider.css');
				wp_register_style('cspm_rangeSlider_skin_css', $this->plugin_url .'css/rangeSlider/ion.rangeSlider.skinNice.css');
				wp_register_style('cspm_font', ''.$this->use_ssl.'://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700&subset=latin,latin-ext,cyrillic-ext,cyrillic,greek-ext,greek,vietnamese');
			
				wp_enqueue_style('cspm_bootstrap_css');
				wp_enqueue_style('cspm_carousel_css');
				wp_enqueue_style('cspm_map_css');
				wp_enqueue_style('cspm_loading_css');
				wp_enqueue_style('cspm_mCustomScrollbar_css');
				wp_enqueue_style('cspm_icheck_css');
				wp_enqueue_style('cspm_nprogress_css');
				wp_enqueue_style('cspm_animate_css');
				wp_enqueue_style('cspm_rangeSlider_css');
				wp_enqueue_style('cspm_rangeSlider_skin_css');
				wp_enqueue_style('cspm_font');
				
			}
			 
		}	
		
		// Deregister styles
		// @since 2.5
		function cspm_deregister_styles() 
		{		
		
			if($this->combine_files == "combine"){
	
				wp_dequeue_style('cspm_font');
				wp_dequeue_style('cspm_icheck_css');
				wp_dequeue_style('cspm_frontend_styles');
				
			}else{
					
				wp_dequeue_style('cspm_bootstrap_css');
				wp_dequeue_style('cspm_carousel_css');
				wp_dequeue_style('cspm_map_css');
				wp_dequeue_style('cspm_loading_css');
				wp_dequeue_style('cspm_mCustomScrollbar_css');
				wp_dequeue_style('cspm_icheck_css');
				wp_dequeue_style('cspm_nprogress_css');
				wp_dequeue_style('cspm_animate_css');
				wp_dequeue_style('cspm_rangeSlider_css');
				wp_dequeue_style('cspm_rangeSlider_skin_css');
				wp_dequeue_style('cspm_font');
			
			}
			
		}	
		
		// Register & Enqueue JS files
		function cspm_scripts()
		{		
			
			$wp_localize_script_args = array(
											'ajax_url' => admin_url('admin-ajax.php'),//get_bloginfo('url') . '/wp-admin/admin-ajax.php',
											'plugin_url' => $this->plugin_url,
											'number_of_items' => $this->number_of_items,
											'center' => $this->center,
											'zoom' => $this->zoom,
											'scrollwheel' => $this->scrollwheel,
											'panControl' => $this->panControl,
											'mapTypeControl' => $this->mapTypeControl,
											'streetViewControl' => $this->streetViewControl,
											'zoomControl' => $this->zoomControl,
											'zoomControlType' => $this->zoomControlType,
											'defaultMarker' => $this->defaultMarker,
											'marker_icon' => $this->marker_icon,
											'big_cluster_icon' => $this->big_cluster_icon,
											'big_cluster_size' => $this->cspm_get_image_size($this->cspm_get_image_path_from_url($this->big_cluster_icon), $this->retinaSupport),
											'medium_cluster_icon' => $this->medium_cluster_icon,
											'medium_cluster_size' => $this->cspm_get_image_size($this->cspm_get_image_path_from_url($this->medium_cluster_icon), $this->retinaSupport),
											'small_cluster_icon' => $this->small_cluster_icon,
											'small_cluster_size' => $this->cspm_get_image_size($this->cspm_get_image_path_from_url($this->small_cluster_icon), $this->retinaSupport),
											'cluster_text_color' => $this->cluster_text_color,
											'items_view' => $this->items_view,
											'show_carousel' => $this->show_carousel,
											'carousel_scroll' => $this->carousel_scroll,
											'carousel_wrap' => $this->carousel_wrap,
											'carousel_auto' => $this->carousel_auto,
											'carousel_mode' => $this->carousel_mode,
											'carousel_animation' => $this->carousel_animation,
											'carousel_easing' => $this->carousel_easing,
											'carousel_map_zoom' => $this->carousel_map_zoom,
											'main_layout' => $this->main_layout,
											'layout_type' => $this->layout_type,
											'horizontal_item_css' => $this->horizontal_item_css,
											'horizontal_item_width' => $this->horizontal_item_width,
											'horizontal_item_height' => $this->horizontal_item_height,
											'horizontal_img_width' => $this->horizontal_img_width,
											'horizontal_details_width' => $this->horizontal_details_width,
											'horizontal_img_height' => $this->horizontal_img_height,
											'vertical_item_css' => $this->vertical_item_css,
											'vertical_item_width' => $this->vertical_item_width,
											'vertical_item_height' => $this->vertical_item_height,			
											'vertical_img_width' => $this->vertical_img_width,
											'vertical_img_height' => $this->vertical_img_height,	
											'vertical_details_height' => $this->vertical_details_height,
											/**
											 * @Deprecated since 2.5
											 ***********************/
											 'show_infowindow' => $this->show_infowindow,
											 'infowindow_type' => $this->infowindow_type,
											 /**********************
											 */
											'overlay_draggable' => $this->overlay_draggable,				
											'carousel_css' => $this->carousel_css,
											'horizontal_left_arrow_icon' => $this->horizontal_left_arrow_icon,
											'horizontal_right_arrow_icon' => $this->horizontal_right_arrow_icon,
											'vertical_top_arrow_icon' => $this->vertical_top_arrow_icon,
											'vertical_bottom_arrow_icon' => $this->vertical_bottom_arrow_icon,
											'items_background' => $this->items_background,
											'items_hover_background' => $this->items_hover_background,
											'details_btn_css' => $this->details_btn_css,
											'scrollwheel_carousel' => $this->scrollwheel_carousel,
											'touchswipe_carousel' => $this->touchswipe_carousel,
											'layout_fixed_height' => $this->layout_fixed_height,
											'layout_fixed_width' => $this->layout_fixed_width,
											'grid_size' => $this->gridSize,
											'content_overlay_horizontal_pos' => $this->content_overlay_horizontal_pos,
											'content_overlay_vertical_pos' => $this->content_overlay_vertical_pos,
											'bubble_horizontal_pos' => $this->bubble_horizontal_pos,
											'bubble_vertical_pos' => $this->bubble_vertical_pos,
											'bubble_link_text' => $this->bubble_link_text,
											'bubble_external_link' => $this->bubble_external_link,
											'marker_cats_settings' => $this->marker_cats_settings,
											'marker_taxonomies' => $this->marker_taxonomies,
											'faceted_search_option' => $this->faceted_search_option,
											'faceted_search_multi_taxonomy_option' => $this->faceted_search_multi_taxonomy_option,
											'faceted_search_input_skin' => $this->faceted_search_input_skin,
											'faceted_search_input_color' => $this->faceted_search_input_color,
											'faceted_search_css' => $this->faceted_search_css,										
											'show_posts_count' => $this->show_posts_count,
											'retinaSupport' => $this->retinaSupport,
											'fillColor' => $this->fillColor,
											'fillOpacity' => $this->fillOpacity,
											'strokeColor' => $this->strokeColor,
											'strokeOpacity' => $this->strokeOpacity,
											'strokeWeight' => $this->strokeWeight,
											'search_form_option' => $this->search_form_option,
											'initial_map_style' => $this->initial_map_style,
											'markerAnimation' => $this->markerAnimation, // @since 2.5
										);
			
			$wp_localize_script_args = $wp_localize_script_args + $this->cspm_marker_categories();
			
			wp_enqueue_script('jquery');				 			
	
			if($this->combine_files == "combine"){
			
				wp_register_script('cspm_google_maps_api', ''.$this->use_ssl.'://maps.google.com/maps/api/js?v=3.exp&sensor=true&language='.$this->map_language.'&libraries=geometry,places', array( 'jquery' ));
				wp_register_script('cspm_frontend_scripts_js', $this->plugin_url .'js/cspm_frontend_scripts.js', array( 'jquery' ));
				
				wp_enqueue_script('cspm_google_maps_api');
				wp_enqueue_script('cspm_frontend_scripts_js');	
	
				wp_localize_script('cspm_frontend_scripts_js', 'progress_map_vars', $wp_localize_script_args);
	
			}else{			
			
				wp_register_script('cspm_jqueryui_js', $this->plugin_url .'js/min/jquery-ui-1.10.3.custom.min.js', array( 'jquery' ));
				wp_register_script('cspm_jqueryui_effect_js', $this->plugin_url .'js/min/jquery.ui.effect.min.js', array( 'jquery' ));
				wp_register_script('cspm_jqueryui_effect_drop_js', $this->plugin_url .'js/min/jquery.ui.effect-drop.min.js', array( 'jquery' ));
				wp_register_script('cspm_jqueryui_effect_slide_js', $this->plugin_url .'js/min/jquery.ui.effect-slide.min.js', array( 'jquery' ));
				wp_register_script('cspm_livequery_js', $this->plugin_url .'js/min/jquery.livequery.min.js', array( 'jquery' ));
				wp_register_script('cspm_easing', $this->plugin_url .'js/min/jquery.easing.1.3.min.js', array( 'jquery' ));
				wp_register_script('cspm_google_maps_api', ''.$this->use_ssl.'://maps.google.com/maps/api/js?v=3.exp&sensor=true&language='.$this->map_language.'&libraries=geometry,places', array( 'jquery' ));
				wp_register_script('cspm_gmap3_js', $this->plugin_url .'js/min/gmap3.min.js', array( 'jquery' ));		
				wp_register_script('cspm_markerclusterer_js', $this->plugin_url .'js/min/MarkerClustererPlus.min.js');
				wp_register_script('cspm_touchSwipe_js', $this->plugin_url .'js/min/jquery.touchSwipe.min.js', array( 'jquery' ));		
				wp_register_script('cspm_jcarousel_js', $this->plugin_url .'js/min/jquery.jcarousel.min.js', array( 'jquery' ));
				wp_register_script('cspm_mCustomScrollbar_js', $this->plugin_url .'js/min/jquery.mCustomScrollbar.min.js', array( 'jquery' ));		
				wp_register_script('cspm_icheck_js', $this->plugin_url .'js/min/jquery.icheck.min.js?v=0.9.1', array( 'jquery' ));
				wp_register_script('cspm_nprogress_js', $this->plugin_url .'js/min/nprogress.min.js', array( 'jquery' ));
				wp_register_script('cspm_rangeSlider_js', $this->plugin_url .'js/ion.rangeSlider.js', array( 'jquery' ));
				wp_register_script('cspm_progress_map_js', $this->plugin_url .'js/progress_map.js', array( 'jquery' ));					
					 
				wp_enqueue_script('cspm_jqueryui_js');
				wp_enqueue_script('cspm_jqueryui_effect_js');
				wp_enqueue_script('cspm_jqueryui_effect_drop_js');
				wp_enqueue_script('cspm_jqueryui_effect_slide_js');
				wp_enqueue_script('cspm_livequery_js');
				wp_enqueue_script('cspm_easing');
				wp_enqueue_script('cspm_google_maps_api');
				wp_enqueue_script('cspm_gmap3_js');
				wp_enqueue_script('cspm_markerclusterer_js');
				wp_enqueue_script('cspm_touchSwipe_js');	
				wp_enqueue_script('cspm_jcarousel_js');
				wp_enqueue_script('cspm_mCustomScrollbar_js');		
				wp_enqueue_script('cspm_icheck_js');
				wp_enqueue_script('cspm_nprogress_js');
				wp_enqueue_script('cspm_rangeSlider_js');	
				wp_enqueue_script('cspm_progress_map_js');
	
				wp_localize_script('cspm_progress_map_js', 'progress_map_vars', $wp_localize_script_args);
	
			}
			
		}
		
		// Deregister scripts
		// @since 2.5
		function cspm_deregister_scripts()
		{				 
		
			if($this->combine_files == "combine"){
				
				wp_dequeue_script('cspm_google_maps_api');
				wp_dequeue_script('cspm_frontend_scripts_js');	
	
			}else{
				
				wp_dequeue_script('cspm_jqueryui_js');
				wp_dequeue_script('cspm_jqueryui_effect_js');
				wp_dequeue_script('cspm_jqueryui_effect_drop_js');
				wp_dequeue_script('cspm_jqueryui_effect_slide_js');
				wp_dequeue_script('cspm_livequery_js');
				wp_dequeue_script('cspm_easing');
				wp_dequeue_script('cspm_google_maps_api');
				wp_dequeue_script('cspm_gmap3_js');
				wp_dequeue_script('cspm_markerclusterer_js');
				wp_dequeue_script('cspm_touchSwipe_js');	
				wp_dequeue_script('cspm_jcarousel_js');
				wp_dequeue_script('cspm_mCustomScrollbar_js');		
				wp_dequeue_script('cspm_icheck_js');
				wp_dequeue_script('cspm_nprogress_js');
				wp_dequeue_script('cspm_rangeSlider_js');
				wp_dequeue_script('cspm_progress_map_js');
				
			}
			
		}
		
		// Create "Location" meta box 
		function cspm_meta_box()
		{ 
			
			// Attachment
			add_meta_box(
				'cspm_meta_box_form',
				'Progress Map: Add Locations',
				array(&$this, 'cspm_meta_box_form'),
				''.$this->post_type.'',
				'advanced'
			);
			
			if(!empty($this->secondary_post_type)){
				
				$secondary_post_type_array = explode(',', str_replace(' ', '', $this->secondary_post_type));
				
				foreach($secondary_post_type_array as $post_type){
						
					// Attachment
					add_meta_box(
						'cspm_meta_box_form',
						'Location',
						array(&$this, 'cspm_meta_box_form'),
						''.$post_type.'',
						'advanced'
					);
					
				}
				
			}
		
		}
		
		// Create "Location" form
		function cspm_meta_box_form()
		{
	
			global $post;
	
			wp_nonce_field($this->plugin_path, 'cspm_meta_box_form_nonce');
			
			$cspml_output = '';
			
			$cspml_output .= '<style>';
			
				$cspml_output .= 'div.cspm_latLng_container{width:48%; float:left;}';
				$cspml_output .= 'div.cspm_latLng_container:nth-child(odd){border-right:1px solid #ededed; margin-right:10px;}';
				$cspml_output .= '@media (max-width: 768px) {div.cspm_latLng_container{width:100%;}}';
				
			$cspml_output .= '</style>';		
			
			$cspml_output .= '<div style="padding:5px 0 10px 0; margin:5px 0;">';
				
				// Address
				$cspml_output .= '<div class="cspm_latLng_container">';
				
					$cspml_output .= '<div class="no_address_found"></div>';
					
					$cspml_output .= '<label for="'.CSPM_ADDRESS_FIELD.'" style="font-weight:bold; padding:5px 50px 0 0; width:97%; display:block; box-sizing:border-box;">Enter an address</label>';
						
						$cspml_output .= '<input type="text" name="'.CSPM_ADDRESS_FIELD.'" id="'.CSPM_ADDRESS_FIELD.'" value="'.get_post_meta($post->ID, CSPM_ADDRESS_FIELD, true).'" style="width:79%; margin:0 5px 5px 0; float:left; height:30px;" />';
						
						$cspml_output .= '<input type="button" class="button tagadd button-large" id="codespacing_search_address" value="Search" style="float:left;" />';
						
						$cspml_output .= '<div style="clear:both"></div>';
						
						// Map
						
						$cspml_output .= '<div id="location_container" style="width:97%; margin-top:5px;">'; 
							
							$cspml_output .= '<div id="codespacing_widget_map_container" style="display:block; height:502px; margin:0 auto; border:1px solid #d9d9d9;"></div>';
							
						$cspml_output .= '</div>';
			
				$cspml_output .= '</div>';
				
				$cspml_output .= '<div id="codespacing_locations_latLng_container" class="cspm_latLng_container">';
					
					// Main Lat&Lng
					$cspml_output .= '<div id="codespacing_latLng_fields" style="border-bottom:1px solid #ededed; padding-bottom:10px; margin-bottom:10px;">';
						
						// Latitude	
						$cspml_output .= '<div id="codespacing_lat_field" style="float:left; margin-right:16px; width:30%;">';
						
							$cspml_output .= '<label for="'.CSPM_LATITUDE_FIELD.'" style="font-weight:bold; padding:5px 50px 0 0; width:130px; display:block; float:left; box-sizing:border-box;">Latitude*</label>';
					
								$cspml_output .= '<input type="text" name="'.CSPM_LATITUDE_FIELD.'" id="'.CSPM_LATITUDE_FIELD.'" value="'.get_post_meta($post->ID, CSPM_LATITUDE_FIELD, true).'" style="width:100%; height:31px; margin:0;" />';
						
						$cspml_output .= '</div>';
					
						// Longitude
						$cspml_output .= '<div id="codespacing_lng_field" style="float:left; width:30%;">';
						
							$cspml_output .= '<label for='.CSPM_LONGITUDE_FIELD.' style="font-weight:bold; padding:5px 50px 0 0; width:130px; display:block; float:left; box-sizing:border-box;">Longitude*</label>';
				
								$cspml_output .= '<input type="text" name="'.CSPM_LONGITUDE_FIELD.'" id="'.CSPM_LONGITUDE_FIELD.'" value="'.get_post_meta($post->ID, CSPM_LONGITUDE_FIELD, true).'" style="width:100%; height:31px; margin:0;" />';
						
						$cspml_output .= '</div>';
						
						$cspml_output .= '<div style="width:30%; float:left;"><input type="button" value="Get Pinpoint" id="codespacing_copypinpoint" class="button button-primary button-large" style="width:100%; margin:23px 0 0 10px;" /></div>';
						
						$cspml_output .= '<div style="clear:both"></div>';
						
						$cspml_output .= '<small style="color:red">(*) Mandatory fields</small>';
						
						$cspml_output .= '<div style="clear:both"></div>';
						
					$cspml_output .= '</div>';								
					
					// Secondary Lat&Lng
					$cspml_output .= '<div>';
						
						// Latitudes & Longitudes
						$cspml_output .= '<label for="'.CSPM_SECONDARY_LAT_LNG_FIELD.'" style="font-weight:bold;">Add more locations</label>';
			
						$cspml_output .= '<textarea name="'.CSPM_SECONDARY_LAT_LNG_FIELD.'" id="'.CSPM_SECONDARY_LAT_LNG_FIELD.'" style="margin:0 0 5px 0; height:100px; width:100%;">'.get_post_meta($post->ID, CSPM_SECONDARY_LAT_LNG_FIELD, true).'</textarea>';
					
						$cspml_output .= '<div style="margin-bottom:10px; color:#666;"><small>The field <strong>"Add more locations"</strong> allows you to add more than 1 location 
						 						for a post. Use it <strong>ONLY</strong> if a post will appear in multiple locations in the map.<br /> 
												<em>For example</em>, lets say that this post is about <em>McDonald\'s</em> and you want to use it to show to your website visitors all the locations <em>(10 e.g) </em> in your country/city/town...
												where they can find <em>McDonal\'s</em>, so instead of creating 10 posts where each of them have the same content 
												and then add them to the map, the <strong>"Add more locations"</strong> field allows you to share one post with the 10 locations.<br />
												<strong><em>- How to use it?</em></strong><br />
												Again, lets say you have 10 locations. In the <strong>Mandatory fields</strong> on the top, insert the coordinates of one location, then in the <strong>"Add more locations"</strong> 
												field, enter the coordinates of the 9 remaining locations.<br /> 
												<strong><em>- Note:</em></strong> All the lcoations will share the same title, content, link and featured image, so don\'t say WHAT!! when you see an item 
												repeated 10+ times in the carousel. The answer is that you have one post with more than one location :)</small></div>';
						
						$cspml_output .= '<input type="button" value="Add more locations" id="codespacing_secondary_copypinpoint" class="button button-primary button-large" />';
						
						$cspml_output .= '<div style="clear:both"></div>';
						
					$cspml_output .= '</div>';
					
				$cspml_output .= '</div>';
				
				$cspml_output .= '<div style="clear:both"></div>';
					
			$cspml_output .= '</div>';
	
			$post_lat = get_post_meta($post->ID, CSPM_LATITUDE_FIELD, true);
			$post_lng = get_post_meta($post->ID, CSPM_LONGITUDE_FIELD, true);
	
			if(empty($post_lat) && empty($post_lng)){
				$post_lat = 37.09024;
				$post_lng = -95.71289100000001;
			}
								
			?>
				
			<script>
			
			jQuery(document).ready(function($){
											
				var map;
				
				var error_address1 = 'We could not understand the location ';
				var error_address2 = '<br /><u>Suggestions</u>:';
					error_address2 += '<ul>'
						error_address2 += '<li>- Make sure all street and city names are spelled correctly.</li>';
						error_address2 += '<li>- Make sure your address includes a city and state.</li>';
						error_address2 += '<li>- Try entering a zip code.</li>';
					error_address2 += '</ul>';
	
				google.maps.visualRefresh = true;
				
				map = new GMaps({
					el: '#codespacing_widget_map_container',
					lat: <?php echo $post_lat; ?>,
					lng: <?php echo $post_lng; ?>,
					zoom: 9,
				});
	
				map.addMarker({
					lat: <?php echo $post_lat; ?>,
					lng: <?php echo $post_lng; ?>,
					infoWindow: {
						content : '<p style="height:50px; width:150px">Main: <?php echo $post_lat; ?>,<?php echo $post_lng; ?></p>'
					},				
					draggable: true,
					title: 'Main: <?php echo $post_lat; ?>,<?php echo $post_lng; ?>',
				});
										
				<?php 
													
				// Get lat and lng data
				$secondary_latlng = str_replace(' ', '', get_post_meta($post->ID, CSPM_SECONDARY_LAT_LNG_FIELD, true));
				
				// Add secondary coordinates
				if(!empty($secondary_latlng)){
					
					$lats_lngs = explode(']', $secondary_latlng);
					
					foreach($lats_lngs as $single_coordinate){
					
						$strip_coordinates = str_replace(array('[', ']', ' '), '', $single_coordinate);
						
						$coordinates = explode(',', $strip_coordinates);
						
						if(isset($coordinates[0]) && !empty($coordinates[0]) && isset($coordinates[1]) && !empty($coordinates[1])){
							
							$lat = $coordinates[0];
							$lng = $coordinates[1];
						
							?>
	
							map.addMarker({
								lat: <?php echo $lat; ?>,
								lng: <?php echo $lng; ?>,
								infoWindow: {
									content : '<p style="height:50px; width:150px">Secondary: <?php echo $lat; ?>,<?php echo $lng; ?></p>'
								},
								draggable: false,
								title: 'Secondary: <?php echo $lat; ?>,<?php echo $lng; ?>',
							});
							
							<?php
							
						}
						
					}
					
				}
				
				?>
	
				$('input#codespacing_search_address').livequery('click', function(e){
					e.preventDefault();
					GMaps.geocode({
					  address: $('input#<?php echo CSPM_ADDRESS_FIELD ?>').val().trim(),
					  callback: function(results, status){
						if(status=='OK'){						
						  $('.no_address_found').empty();						 
						  var latlng = results[0].geometry.location;
						  map.removeMarkers();
						  map.setCenter(latlng.lat(), latlng.lng());
						  map.addMarker({
							lat: latlng.lat(),
							lng: latlng.lng(),
							draggable: true,
						  });
						}else $('.no_address_found').html(error_address1 + '<strong>' + $('input#<?php echo CSPM_ADDRESS_FIELD ?>').val().trim() + '</strong>' + error_address2);
					  }
					});
					return false;
				});
							  
				$('input#<?php echo CSPM_ADDRESS_FIELD ?>').keypress(function(e){
					if (e.keyCode == 13) {
						e.preventDefault();
						GMaps.geocode({
						  address: $(this).val().trim(),
						  callback: function(results, status){
							if(status=='OK'){	
							  $('.no_address_found').empty();
							  var latlng = results[0].geometry.location;
							  map.removeMarkers();
							  map.setCenter(latlng.lat(), latlng.lng());
							  map.addMarker({
								lat: latlng.lat(),
								lng: latlng.lng(),
								draggable: true,
							  });
							}else $('.no_address_found').html(error_address1 + '<strong>' + $('input#<?php echo CSPM_ADDRESS_FIELD ?>').val().trim() + '</strong>' + error_address2);
						  }
						});
						return false;
					}		
				});
				  
				$('input#codespacing_copypinpoint').livequery('click', function(e){
					e.preventDefault();
					$("input#<?php echo CSPM_LATITUDE_FIELD ?>").val(map.markers[0].getPosition().lat());
					$("input#<?php echo CSPM_LONGITUDE_FIELD ?>").val(map.markers[0].getPosition().lng());
				});
				
				$('#codespacing_secondary_copypinpoint').livequery('click', function(e){
					e.preventDefault();
					var old_value = $("#<?php echo CSPM_SECONDARY_LAT_LNG_FIELD ?>").val();
					$("#<?php echo CSPM_SECONDARY_LAT_LNG_FIELD ?>").val(old_value + '[' + map.markers[0].getPosition().lat() + ',' + map.markers[0].getPosition().lng() + ']');
				});
				
			});
			</script>
				
			<?php 
			
			echo $cspml_output;
				
		}
		
		// Save "Location" data (lat, lng)
		function cspm_insert_meta_box_fields()
		{
			
			global $post;			
							
			/* --- security verification --- */
			if(!isset($_POST['cspm_meta_box_form_nonce']) || !wp_verify_nonce($_POST['cspm_meta_box_form_nonce'], $this->plugin_path)) {
			  return;
			} // end if
			
			$post_type = $post->post_type;
			$markers_object = get_option('cspm_markers_array');
			$post_markers_object = array();
			
			if(isset($_POST[CSPM_ADDRESS_FIELD]))
				update_post_meta($post->ID, CSPM_ADDRESS_FIELD, $_POST[CSPM_ADDRESS_FIELD]);	
				
			if(isset($_POST[CSPM_LATITUDE_FIELD]) && isset($_POST[CSPM_LONGITUDE_FIELD])){								  
				
				update_post_meta($post->ID, CSPM_LATITUDE_FIELD, $_POST[CSPM_LATITUDE_FIELD]);
				update_post_meta($post->ID, CSPM_LONGITUDE_FIELD, $_POST[CSPM_LONGITUDE_FIELD]);
				
				$post_taxonomy_terms = array();
				
				$post_taxonomies = get_object_taxonomies($post, 'names');	
				
				foreach($post_taxonomies as $taxonomy_name){
					$post_taxonomy_terms[$taxonomy_name] = wp_get_post_terms($post->ID, $taxonomy_name, array("fields" => "ids"));
				}
	
				$post_markers_object = array('lat' => $_POST[CSPM_LATITUDE_FIELD],
											 'lng' => $_POST[CSPM_LONGITUDE_FIELD],
											 'post_id' => $post->ID,
											 'post_tax_terms' => $post_taxonomy_terms,
											 'is_child' => 'no',
											 'children_markers' => array()
											 );																	 
				
				// Secondary latLng
				if(isset($_POST[CSPM_SECONDARY_LAT_LNG_FIELD])){
					
					$children_markers = array();
														
					update_post_meta($post->ID, CSPM_SECONDARY_LAT_LNG_FIELD, $_POST[CSPM_SECONDARY_LAT_LNG_FIELD]); 
	
					$j = 0;
									
					$lats_lngs = explode(']', $_POST[CSPM_SECONDARY_LAT_LNG_FIELD]);	
							
					foreach($lats_lngs as $single_coordinate){
					
						$strip_coordinates = str_replace(array('[', ']', ' '), '', $single_coordinate);
						
						$coordinates = explode(',', $strip_coordinates);
						
						if(isset($coordinates[0]) && isset($coordinates[1]) && !empty($coordinates[0]) && !empty($coordinates[1])){
							
							$lat = $coordinates[0];
							$lng = $coordinates[1];
							
							$children_markers[] = array('lat' => $lat,
														'lng' => $lng,
														'post_id' => $post->ID,
														'post_tax_terms' => $post_taxonomy_terms,
														'is_child' => 'yes_'.$j.''
														);
							
							$lat = '';
							$lng = '';
							$j++;
						
						} 
						
						$post_markers_object['children_markers'] = $children_markers;
						
					}
				
				}
				
				$markers_object[$post_type]['post_id_'.$post->ID] = $post_markers_object;
						
				update_option('cspm_markers_array', $markers_object);
				
			}
			
		}
		
		// Get the link of the post either with the get_permalink() function ...
		// ... or the custom field defined by the user
		// @since 2.5
		function cspm_get_permalink($post_id){
	
			if(!empty($this->outer_links_field_name))
				$the_permalink = get_post_meta($post_id, $this->outer_links_field_name, true);
			
			else $the_permalink = get_permalink($post_id);
			
			return $the_permalink;
			
		}
		
		// Parse item custom title
		function cspm_items_title($post_id, $title, $click_title = false)
		{
			// Custom title structure
			$post_meta = esc_attr($title);
	
			$the_permalink = ($click_title && $this->click_on_title == 'yes') ? ' href="'.$this->cspm_get_permalink($post_id).'"' : '';
			$target = ($this->external_link == "same_window") ? '' : ' target="_blank"';
			
			// Init vars
			$items_title = '';		
			$items_title_lenght = 0;
			
			// If no custom title is set ...
			// ... Call item original title
			if(empty($post_meta)){						
				
				$items_title = get_the_title($post_id);
				
			// If custom title is set ...	
			}else{
				
				// ... Get post metas from custom title structure
				$explode_post_meta = explode('][', $post_meta);
				
				// Loop throught post metas
				foreach($explode_post_meta as $single_post_meta){
					
					// Clean post meta name 
					$single_post_meta = str_replace(array('[', ']'), '', $single_post_meta);
					
					// Get the first two letters from post meta name
					$check_string = substr($single_post_meta, 0, 2);
					
					if(!empty($check_string)){
						
						// Separator case
						if($check_string === 's='){
							
							// Add separator to title
							$items_title .= str_replace('s=', '', $single_post_meta);
						
						// Lenght case	
						}elseif($check_string === 'l='){
							
							// Define title lenght
							$items_title_lenght = str_replace('l=', '', $single_post_meta);
						
						// Empty space case
						}elseif($single_post_meta == '-'){
							
							// Add space to title
							$items_title .= ' ';
						
						// Post metas case		
						}else{
							
							// Add post meta value to title
							$items_title .= get_post_meta($post_id, $single_post_meta, true);
								
						}
					
					}
					
				}
				
				// If custom title is empty (Maybe someone will type something by error), call original title
				if(empty($items_title)) $items_title = get_the_title($post_id);
				
			}
			
			// Show title as title lenght is defined	
			if($items_title_lenght > 0) $items_title = substr($items_title, 0, $items_title_lenght);
			
			return ($click_title) ? '<a'.$the_permalink.''.$target.'>'.addslashes_gpc($items_title).'</a>' : addslashes_gpc($items_title);
			
		}
		
		// Parse item custom details
		function cspm_items_details($post_id, $details)
		{
			
			// Custom details structure
			$post_meta = esc_attr($details);		
			
			// Init vars
			$items_details = '';
			$items_title_lenght = 0;
			
			// If new structure is set ...
			if(!empty($post_meta)){
				
				// ... Get post metas from custom details structure
				$explode_post_meta = explode('][', $post_meta);
				
				// Loop throught post metas
				foreach($explode_post_meta as $single_post_meta){
					
					// Clean post meta name
					$single_post_meta = str_replace(array('[', ']'), '', $single_post_meta);
					
					// Get the first two letters from post meta name
					$check_string = substr($single_post_meta, 0, 2);
					$check_taxonomy = substr($single_post_meta, 0, 4);
					$check_content = substr($single_post_meta, 0, 7);
					
					// Taxonomy case
					if(!empty($check_taxonomy) && $check_taxonomy == 'tax='){
						
						// Add taxonomy term(s)
						$taxonomy = str_replace('tax=', '', $single_post_meta);
						$items_details .= implode(', ', wp_get_post_terms($post_id, $taxonomy, array("fields" => "names")));
						
					// The content				
					}elseif(!empty($check_content) && $check_content == 'content'){
						
						$explode_content = explode(';', str_replace(' ', '', $single_post_meta));
						
						// Get original post details
						$post_record = get_post($post_id, ARRAY_A);
						
						// Post content
						$post_content = trim(preg_replace('/\s+/', ' ', $post_record['post_content']));
						
						// Post excerpt
						$post_excerpt = trim(preg_replace('/\s+/', ' ', $post_record['post_excerpt']));
						
						// Excerpt is recommended
						$the_content = (!empty($post_excerpt)) ? $post_excerpt : $post_content;
				
						// Show excerpt/content as details lenght is defined	
						if(isset($explode_content[1]) && $explode_content[1] > 0) $items_details .= substr($the_content, 0, $explode_content[1]).'&hellip;';
									
					// Separator case
					}elseif(!empty($check_string) && $check_string == 's='){
						
						// Add separator to details
						$separator = str_replace('s=', '', $single_post_meta);
						
						$separator == 'br' ? $items_details .= '<br />' : $items_details .= $separator;
						
					// Meta post title OR Label case	
					}elseif(!empty($check_string) && $check_string == 't='){
						
						// Add label to details
						$items_details .= str_replace('t=', '', $single_post_meta);
						
					// Lenght case		
					}elseif(!empty($check_string) && $check_string == 'l='){
						
						// Define details lenght
						$items_details_lenght = str_replace('l=', '', $single_post_meta);
						
					// Empty space case
					}elseif($single_post_meta == '-'){
						
						// Add space to details
						$items_details .= ' ';
						
					// Post metas case			
					}else{
	
						// Add post metas to details
						$items_details .= get_post_meta($post_id, $single_post_meta, true);
							
					}
					
				}						
				
			}
			
			// If no custom detils structure is set ...
			if(empty($post_meta) || empty($items_details)){
				
				// Get original post details
				$post_record = get_post($post_id, ARRAY_A, 'display');
				
				// Post content
				$post_content = trim(preg_replace('/\s+/', ' ', $post_record['post_content']));
				
				// Post excerpt
				$post_excerpt = trim(preg_replace('/\s+/', ' ', $post_record['post_excerpt']));
				
				// Excerpt is recommended
				$items_details = (!empty($post_excerpt)) ? $post_excerpt : $post_content;
				
				// Show excerpt/content as details lenght is defined	
				if($items_details_lenght > 0){
					
					// Remove the last word from the content/excerpt ...
					// ... as a proof against foreign characters encoded ...
					// ... when the last word of the content is cut off
					$items_details = substr($items_details, 0, $items_details_lenght);
					$items_details = explode(' ', $items_details);
					$last_word = array_pop($items_details);
					$items_details = implode(' ', $items_details).'&hellip;';
					
				}
				
			}
			
			return addslashes_gpc($items_details);
			
		}
		
		// Ajax function: Get Item details 
		function cspm_load_carousel_item()
		{
	
			global $wpdb;
			
			// Items ID
			$post_id = esc_attr($_POST['post_id']);
			
			// View style (horizontal/vertical)
			$items_view = esc_attr($_POST['items_view']);
					
			// Get items title or custom title		
			$item_title = stripslashes_deep($this->cspm_items_title($post_id, $this->items_title, true)); 
			$item_description = stripslashes_deep($this->cspm_items_details($post_id, $this->items_details));
			
			// Create items single page link
			$the_permalink = $this->cspm_get_permalink($post_id);
			
			$more_button_text = $this->cspm_wpml_get_string('"More" Button text', $this->details_btn_text);
			
			$output = '';
			
			/* ========================= */
			/* ==== Horizontal view ==== */
			/* ========================= */
					
			if($items_view == "listview"){
				
				$parameter = array(
					'style' => "width:".$this->horizontal_img_width."px; height:".$this->horizontal_img_height."px;"
				);
				
				// Item thumb
				$post_thumbnail = get_the_post_thumbnail($post_id, 'cspacing-horizontal-thumbnail', $parameter);
								
				$output .= '<div class="item_infos">';
								
									
					/* =========================== */
					/* ==== LTR carousel mode ==== */
					/* =========================== */
					
					if($this->carousel_mode == 'false'){
						
						// Image or Thumb area			
						$output .= '<div class="item_img">';
								
							$output .= $post_thumbnail;
				
						$output .= '</div>';
						
						// Details area
						$output .= '<div class="details_container">';
							
							// "More" Button						
							if($this->show_details_btn == 'yes')
								$output .= '<div><a class="details_btn" href="'.$the_permalink.'" style="'.$this->details_btn_css.'">'.$more_button_text.'</a></div>';
							
							// Item title
							$output .= '<div class="details_title">'.$item_title.'</div>';
							
							// Items details
							$output .= '<div class="details_infos">'.$item_description.'</div>';
							
						$output .= '</div>';
									
									
					/* =========================== */
					/* ==== RTL carousel mode ==== */
					/* =========================== */
					
					}else{
					
						// Details area
						$output .= '<div class="details_container">';
							
							// "More" Button						
							if($this->show_details_btn == 'yes')
								$output .= '<div><a class="details_btn" href="'.$the_permalink.'" style="'.$this->details_btn_css.'">'.$more_button_text.'</a></div>';
							
							// Item title
							$output .= '<div class="details_title">'.$item_title.'</div>';
							
							// Items details
							$output .= '<div class="details_infos">'.$item_description.'</div>';
							
						$output .= '</div>';
						
						// Image or Thumb area			
						$output .= '<div class="item_img">';
								
							$output .= $post_thumbnail;
				
						$output .= '</div>';
					
					}
					
					$output .= '<div style="clear:both"></div>';				
					
				$output .= '</div>';
			
			
			/* ======================= */
			/* ==== Vertical view ==== */
			/* ======================= */
					
			}elseif($items_view == "gridview"){					
			
				$parameter = array(
					"width:".$this->vertical_img_width."px; height:".$this->vertical_img_height."px;"
				);
				
				// Item thumb
				$post_thumbnail = get_the_post_thumbnail($post_id, 'cspacing-vertical-thumbnail', $parameter);
				
						
				$output .= '<div class="item_infos">';
					
					// Image or Thumb area								
					$output .= '<div class="item_img">';
							
						$output .= $post_thumbnail;
			
					$output .= '</div>';
					
					// Details area		
					$output .= '<div class="details_container">';
						
						// "More" Button								
						if($this->show_details_btn == 'yes')
							$output .= '<div><a class="details_btn" href="'.$the_permalink.'" style="'.$this->details_btn_css.'">'.$more_button_text.'</a></div>';
						
						// Item title
						$output .= '<div class="details_title">'.$item_title.'</div>';
						
						// Items details
						$output .= '<div class="details_infos">'.$item_description.'</div>';
						
					$output .= '</div>';
					
					$output .= '<div style="clear:both"></div>';
					
				$output .= '</div>';
				
			}
		   
			die($output);
					
		}
		
		// Add items to the header!
		function cspm_header_script() {
			
			$header_script = '';
			
			// Prevent $(document).ready from being fired twice
			$header_script .= '<script>var _CSPM_DONE = {};</script>';
			
			$header_script .= '<style type="text/css">';
			
			// Carousel Style
			
			if(!empty($this->carousel_css))
				$header_script .= '.jcarousel-skin-default .jcarousel-container{ '. $this->carousel_css. ' }';
			
			
			// Carousel Items Style
			if($this->items_view == "listview"){
				
				$header_script .= '.details_container{ width:'.$this->horizontal_details_width.'px; height:'.$this->horizontal_details_height.'px; }';
				$header_script .= '.item_img{ width:'.$this->horizontal_img_width.'px; height:'.$this->horizontal_img_height.'px; float:left; }';
				
				$margin = ($this->carousel_mode == 'false') ? 'left' : 'right';
				
				$header_script .= '.details_btn{ margin-'.$margin.':'.($this->horizontal_details_width-80).'px; margin-top:'.($this->horizontal_details_height-40).'px; }';
				$header_script .= '.details_title{ width:'.$this->horizontal_details_width.'px; '.$this->horizontal_title_css.' }';
				$header_script .= '.details_infos{ width:'.$this->horizontal_details_width.'px; '.$this->horizontal_details_css.' }';
				
			}else{
				
				$header_script .= '.details_container{ width:'.$this->vertical_details_width.'px; height:'.$this->vertical_details_height.'px; }';
				$header_script .= '.item_img{ width:'.$this->vertical_img_width.'px; height:'.$this->vertical_img_height.'px; }';
				
				$margin = ($this->carousel_mode == 'false') ? 'left' : 'right';
				
				$header_script .= '.details_btn{ margin-'.$margin.':'.($this->vertical_details_width-80).'px; margin-top:'.($this->vertical_details_height-40).'px; }';
				$header_script .= '.details_title{ width:'.$this->vertical_details_width.'px; '.$this->vertical_title_css.' }';
				$header_script .= '.details_infos{ width:'.$this->vertical_details_width.'px; '.$this->vertical_details_css.' }';
				
			}
			
			
			// Horizontal Right Arrow CSS Style
			
			if(!empty($this->horizontal_right_arrow_icon)){
				
				$header_script .= '		
					.jcarousel-skin-default .jcarousel-next-horizontal:hover,
					.jcarousel-skin-default .jcarousel-next-horizontal:focus {
						background-image: url('.$this->horizontal_right_arrow_icon.') !important;
					}';
			
			}
			
			
			// Horizontal Left Arrow CSS Style
			
			if(!empty($this->horizontal_left_arrow_icon)){
			
				$header_script .= '	
					.jcarousel-skin-default .jcarousel-prev-horizontal:hover, 
					.jcarousel-skin-default .jcarousel-prev-horizontal:focus {
					   background-image: url('.$this->horizontal_left_arrow_icon.') !important;
					}';
				
			}
			
			
			// Vertical Top Arrow CSS Style		
			
			if(!empty($this->vertical_top_arrow_icon)){
						
				$header_script .= '	
					.jcarousel-skin-default .jcarousel-prev-vertical:hover,
					.jcarousel-skin-default .jcarousel-prev-vertical:focus,
					.jcarousel-skin-default .jcarousel-prev-vertical:active {
						background-image: url('.$this->vertical_top_arrow_icon.') !important;
					}';
			
			}
	
	
			// Vertical Bottom Arrow CSS Style		
			
			if(!empty($this->vertical_bottom_arrow_icon)){ 
				
				$header_script .= '	
					.jcarousel-skin-default .jcarousel-next-vertical:hover,
					.jcarousel-skin-default .jcarousel-next-vertical:focus,
					.jcarousel-skin-default .jcarousel-next-vertical:active {
					   background-image: url('.$this->vertical_bottom_arrow_icon.') !important;
					}';
					
			}
			
			
			// Zoom-In & Zoom-out CSS Style			
					
			$zoom_in_background  = !empty($this->zoom_in_icon) ? 'background-image:url('.$this->zoom_in_icon.') !important' : '';
			$zoom_out_background = !empty($this->zoom_out_icon) ? 'background-image:url('.$this->zoom_out_icon.') !important' : '';
			
				$header_script .= 'div[class^=codespacing_map_zoom_in], div[class^=codespacing_light_map_zoom_in]{'.$this->zoom_in_css.' '.$zoom_in_background.'}';
				$header_script .= 'div[class^=codespacing_map_zoom_out], div[class^=codespacing_light_map_zoom_out]{'.$this->zoom_out_css.' '.$zoom_out_background.'}';
			
					
			// Custom Vertical Carousel CSS
			
			//if(($this->main_layout == "mr-cl" || $this->main_layout == "ml-cr") && $this->show_carousel == 'true')
				$header_script .= '.jcarousel-skin-default .jcarousel-container-vertical { height:'.$this->layout_fixed_height.'px !important; }';
							
	
			// Extra CSS for the bubble link text
			if(!empty($this->bubble_link_css)){
			
				$header_script .= '
					.pin_overlay_content a {
						'.$this->bubble_link_css.'
					}';
			
			}
			
			// Arrows background color			
			$background_color = (empty($this->arrows_background) || ($this->arrows_background == '#')) ? 'transparent' : $this->arrows_background;
			$header_script .= '
				.jcarousel-skin-default .jcarousel-direction-rtl .jcarousel-next-horizontal,
				.jcarousel-skin-default .jcarousel-next-horizontal:hover,
				.jcarousel-skin-default .jcarousel-next-horizontal:focus,
				
				.jcarousel-skin-default .jcarousel-direction-rtl .jcarousel-prev-horizontal,
				.jcarousel-skin-default .jcarousel-prev-horizontal:hover,
				.jcarousel-skin-default .jcarousel-prev-horizontal:focus,
	
				.jcarousel-skin-default .jcarousel-direction-rtl .jcarousel-next-vertical,
				.jcarousel-skin-default .jcarousel-next-vertical:hover,
				.jcarousel-skin-default .jcarousel-next-vertical:focus,
				
				.jcarousel-skin-default .jcarousel-direction-rtl .jcarousel-prev-vertical,
				.jcarousel-skin-default .jcarousel-prev-vertical:hover,
				.jcarousel-skin-default .jcarousel-prev-vertical:focus{			
				
					background-color:'.$background_color.';
					
				}';
			
			// Posts count clause
			$header_script .= '
				div.number_of_posts_widget{
					color:'.$this->posts_count_color.';
					'.$this->posts_count_style.'
				}';
			
			// Faceted search CSS
			if(!empty($this->faceted_search_icon)){
				
				$header_script .= '
					div.faceted_search_btn{
						background-image:url('.$this->faceted_search_icon.') !important;
					}';
					
			}
								
			if(!empty($this->faceted_search_css)){
				
				$header_script .= '
					div[class^=faceted_search_container] form.faceted_search_form ul li{
						'.$this->faceted_search_css.'
					}';
					
			}
			
			// Search form CSS
			if(!empty($this->search_form_bg_color))
				$header_script .= 'div[class^=search_form_container_]{ background:'.$this->search_form_bg_color.'; }';
			
			if(!empty($this->search_form_icon))
				$header_script .= 'div.search_form_btn{ background-image:url('.$this->search_form_icon.') !important; }';
				
			$header_script .= '</style>';
			
			echo $header_script;
			
		}
		
	   /**
		* Build the main query
		*
		* @since 2.0
		*
		*/
		function cspm_main_query($post_type = "", 
								 $post_status = "",
								 $number_of_posts = "", 
								 $tax_query = "",
								 $tax_query_relation = "", 
								 $cache_results = "", 
								 $update_post_meta_cache = "",
								 $update_post_term_cache = "",
								 $post_in = "",
								 $post_not_in = "",
								 $custom_fields = "",
								 $custom_field_relation = "",
								 $authors = "",
								 $orderby = "",
								 $orderby_meta_key = "",
								 $order = ""){
			
			/**
			 * Post type
			 */
			if(empty($post_type)) $post_type = (empty($this->post_type)) ? 'post' : $this->post_type;		
			$post_type_array = explode(',', esc_attr($post_type));
					
			/**
			 * Query limit
			 */
			if(empty($number_of_posts)) 
				$nbr_items = (empty($this->number_of_items)) ? -1 : $this->number_of_items;
			else $nbr_items = esc_attr($number_of_posts);
			
			/**
			 * Status
			 */
			if(empty($post_status)){ 
				$statuses = get_post_stati();
				$items_status = array();
				foreach($statuses as $status){
					if(isset($this->settings['codespacingprogressmap_generalsettings_items_status_'.$status.''])){						
						$status_name = $this->settings['codespacingprogressmap_generalsettings_items_status_'.$status.''];
						if($status_name != '0') $items_status[] = $status;
					}
				}
				$status = (count($items_status) == 0) ? 'publish' : $items_status;
			}else $status = explode(',', esc_attr($post_status));
			
			/**
			 * Caching
			 */		 
			if(empty($cache_results)) 
				$cache_results = ($this->cache_results == 'true') ? true : false;
			else $cache_results = (esc_attr($cache_results) == 'true') ? true : false;
			
			if(empty($update_post_meta_cache))
				$update_post_meta_cache = ($this->update_post_meta_cache == 'true') ? true : false;
			else $update_post_meta_cache = (esc_attr($update_post_meta_cache) == 'true') ? true : false;
			
			if(empty($update_post_term_cache))
				$update_post_term_cache = ($this->update_post_term_cache == 'true') ? true : false;					
			else $update_post_term_cache = (esc_attr($update_post_term_cache) == 'true') ? true : false;		
			
			/**
			 * Post parameters
			 */
			if(empty($post_in))
				$post_in = (empty($this->post_in)) ? array() : explode(',', $this->post_in);
			else $post_in = explode(',', esc_attr($post_in));
			
			if(empty($post_not_in))
				$post_not_in = (empty($this->post_not_in)) ? array() : explode(',', $this->post_not_in);		
			else $post_not_in = explode(',', esc_attr($post_not_in));
			
			
			/**
			 * OrderBy meta key
			 */
			if(empty($orderby)){ 
				$orderby_param = $this->orderby_param;
				$orderby_meta_key = ($orderby_param != 'meta_value' && $orderby_param != 'meta_value_num') ? '' : $orderby_meta_key;
				$order_param = $this->order_param;
			}else{
				$orderby_param = esc_attr($orderby);
				$orderby_meta_key = esc_attr($orderby_meta_key);
				$order_param = strtoupper(esc_attr($order));
			}
			
			
			/**
			 * Custom fields
			 */
			if(empty($custom_fields)) 
				$custom_fields = $this->cspm_parse_query_meta_fields($this->custom_fields, $this->custom_field_relation_param);
			else $custom_fields = $this->cspm_parse_query_meta_fields(esc_attr($custom_fields), strtoupper(esc_attr($custom_field_relation)), '{');
		
					
			/**
			 * Taxonomies
			 */
			if(empty($tax_query)){
							
				$post_taxonomies = (array) get_object_taxonomies($this->post_type, 'objects');
				$taxonomies_array = array();
				
				// Loop throught taxonomies		
				foreach($post_taxonomies as $single_taxonomie){
					
					// Get Taxonomy Name
					$tax_name = $single_taxonomie->name;
					
					// Make sure the taxonomy operator exists
					if(isset($this->settings['codespacingprogressmap_generalsettings_'.$tax_name.'_operator_param'])){	
						
						// The operator
						$taxonomy_operator_param = $this->settings['codespacingprogressmap_generalsettings_'.$tax_name.'_operator_param'];
						
						// Get all terms related to this taxonomy
						if(isset($this->settings['codespacingprogressmap_generalsettings_taxonomie_'.$tax_name.''])){
							
							$terms = $this->settings['codespacingprogressmap_generalsettings_taxonomie_'.$tax_name.''];
							
							if(count($terms) > 0){
							
								// For WPML =====
								$WPML_terms = array();
								foreach($terms as $term)
									$WPML_terms[] = $this->cspm_wpml_object_id($term, $tax_name, false);
								// @For WPML ====
								
								$taxonomies_array[] = array('taxonomy' => $tax_name,
															'field' => 'id',
															'terms' => $WPML_terms,
															'operator' => $taxonomy_operator_param,
														   );
							
							}
						
						}
						
					}
					
				}
				
				$taxonomy_relation_param = $this->cspm_get_setting('generalsettings', 'taxonomy_relation_param', 'AND');	
				$tax_query = (count($taxonomies_array) == 0) ? array('tax_query' => '') : array('tax_query' => array_merge(array('relation' => $taxonomy_relation_param), $taxonomies_array));
	
			}else{
				
				// tax_query = "cat_1{1.2.3|IN},cat_2{2.3|NOT IN}"
				// tax_query_relation = "AND"
				
				$taxonomies_array = array();
				
				$taxonomy_term_names_and_term_ids = explode(',',  str_replace(' ', '', esc_attr($tax_query))); // array(cat_1{1.2.3|IN}, cat_2{2.3|NOT IN})
				
				if(count($taxonomy_term_names_and_term_ids) > 0){
					
					foreach($taxonomy_term_names_and_term_ids as $single_term_name_and_term_ids){
						
						$term_name = $term_relation = '';
						$term_ids = array();
						
						$term_name_and_term_ids = explode('{', $single_term_name_and_term_ids); // array(cat_1, 1.2.3|IN})
				
						if(isset($term_name_and_term_ids[0])) $term_name = $term_name_and_term_ids[0]; // cat_1
						
						if(isset($term_name_and_term_ids[0])){
							
							$term_ids_and_relation = explode('|', $term_name_and_term_ids[1]); // array(1.2.3, IN})
						
							if(isset($term_ids_and_relation[0])) $term_ids = explode('.', $term_ids_and_relation[0]); // array(1, 2, 3)
							
							if(isset($term_ids_and_relation[0])) $term_relation = str_replace('}', '', $term_ids_and_relation[1]); // IN;
							
						}
						
						if(count($term_ids) > 0){
													
							// For WPML =====
							$WPML_terms = array();
							foreach($term_ids as $term)
								$WPML_terms[] = $this->cspm_wpml_object_id($term, $term_name, false);
							// @For WPML ====							
	
							$taxonomies_array[] = array('taxonomy' => $term_name,
															'field' => 'id',
															'terms' => $WPML_terms,
															'operator' => strtoupper($term_relation),
														   );
													   
						}
													   
					}
					
				}
				
				$tax_query = (count($taxonomies_array) == 0) ? array('tax_query' => '') : array('tax_query' => array_merge(array('relation' => strtoupper(esc_attr($tax_query_relation))), $taxonomies_array));
				
			}
				
			/**
			 * Authors
			 */
			if(empty($authors)){
				
				$blogusers = get_users(array('fields' => 'all'));
				$authors_condition = $this->cspm_get_setting('generalsettings', 'authors_prefixing', 'false');
				$authors_prefixing = ($authors_condition == 'false') ? '' : '-';
				$authors_array = array();
				foreach($blogusers as $user){	
					if(isset($this->settings['codespacingprogressmap_generalsettings_authors_'.$user->ID.''])){
						$author = $this->settings['codespacingprogressmap_generalsettings_authors_'.$user->ID.''];			
						if($author != '0') $authors_array[] = $authors_prefixing.$user->ID;
					}
				}
				$authors = (count($authors_array) == 0) ? '' : implode(',', $authors_array);
	
			}else{
							
				$authors_array = explode(',', esc_attr($authors));
				$authors = (count($authors_array) == 0) ? '' : implode(',', $authors_array);
				
			}
			
			/**
			 * Call items ids
			 */
			$query_args = array( 'post_type' => $post_type_array,							
								 'post_status' => $status, 
	
								 'posts_per_page' => $nbr_items, 
								 
								 'tax_query' => $tax_query['tax_query'],
								 
								 'cache_results' => $cache_results,
								 'update_post_meta_cache' => $update_post_meta_cache,
								 'update_post_term_cache' => $update_post_term_cache,
								 
								 'post__in' => $post_in,
								 'post__not_in' => $post_not_in,
								 
								 'meta_query' => $custom_fields['meta_query'],
								 
								 'author' => $authors,
								 
								 'orderby' => $orderby_param,
								 'meta_key' => $orderby_meta_key,
								 'order' => $order_param,
								 'fields' => 'ids');
										 
			$query_args = (isset($query_args['fields']) && $query_args['fields'] == 'ids') ? $query_args : $query_args + array('fields' => 'ids');
			
			$query_args = apply_filters( 'cs_progress_map_main_query', $query_args );
			
			// Execute query
			$post_ids = query_posts( $query_args );
			
			// Reset query
			wp_reset_query();
			
			return $post_ids;
			
		}
	   
	   /**
		* Parse custom fields to use in the main query
		*
		* @since 2.0
		*
		*/
		function cspm_parse_query_meta_fields($meta_fields, $relation, $field_holder = '['){
			
			if(!empty($meta_fields)){
				
				// Explode custom fields [...],[...],...
				if($field_holder == '[') $parse_meta_fields = explode('],[', str_replace(array(' '), '', $meta_fields));
				else $parse_meta_fields = explode('},{', str_replace(array(' '), '', $meta_fields));
				
				// Init meta_query array
				$meta_query_array = array();
	
				// Loop through the custom fields
				foreach($parse_meta_fields as $single_meta_fields_vars){
	
					// Remove brackets
					if($field_holder == '[') $custom_field_parameters_str = str_replace(array('[', ']', ' '), '', $single_meta_fields_vars);
					else $custom_field_parameters_str = str_replace(array('{', '}', ' '), '', $single_meta_fields_vars);
					
					// Explode custom field parameters
					$custom_field_parameters_array = explode('|', $custom_field_parameters_str);
				
					// Init parameters array.
					// On each turn of the loop, $parameters_array must be empty
					$parameters_array = array();
					
					// Loop through each parameter
					foreach($custom_field_parameters_array as $single_param){
	
						// Explode parameter key & value
						$param_composer = explode(':', $single_param);
	
						// Key case
						if(ltrim(rtrim($param_composer[0])) == 'key') $parameters_array['key'] = $param_composer[1];
						
						// Value case
						elseif(ltrim(rtrim($param_composer[0])) == 'value'){
							
							$value_values = str_replace(array('(', ')', ' '), '', $param_composer[1]);
							
							$values_array = explode(',', $value_values);
							
							if(count($values_array) == 1) $parameters_array['value'] = $values_array[0];
							else $parameters_array['value'] = $values_array;
							
						}
						
						// Type case
						elseif(ltrim(rtrim($param_composer[0])) == 'type') $parameters_array['type'] = $param_composer[1];
						
						// Compare case
						elseif(ltrim(rtrim($param_composer[0])) == 'compare'){
							
							// When "value" is an array, the operator must be one of the following types (IN, NOT IN, BETWEEN, NOT BETWEEN)
							if(isset($parameters_array['value']) && is_array($parameters_array['value'])){
								
								if(in_array(strtoupper($param_composer[1]), array('IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN')))							
									$parameters_array['compare'] = strtoupper($param_composer[1]);
								
							}else $parameters_array['compare'] = $param_composer[1];
	
						}
						
					}
					
					// Associate them to meta_query[]
					$meta_query_array[] = $parameters_array;								
					
				}
				
				$custom_fields = array('meta_query' => array_merge(array('relation' => $relation), $meta_query_array));
		
			}else $custom_fields = array('meta_query' => array(
															'relation' => 'AND',
															array(
																'key' => CSPM_LATITUDE_FIELD,
																'value' => '',
																'compare' => '!='
															),
															array(
																'key' => CSPM_LONGITUDE_FIELD,
																'value' => '',
																'compare' => '!='
															)
														 )
										);
		
			return $custom_fields;
			
		}
		
	   /**
		* Display a static map that show's one or more locations
		* No carousel used
		*
		* @since 2.0
		*
		*/
		function cspm_static_map_shortcode($atts){
			
			extract( shortcode_atts( array(
			  'post_ids' => '',
			  'center_at' => '',
			  'height' => '100%',
			  'width' => '100%',
			  'zoom' => 13,
			  'show_overlay' => 'yes',
			  'show_secondary' => 'yes',
			  'map_style' => '',
			  'infobox_type' => $this->infobox_type
			), $atts ) ); 
			
			$post_ids = esc_attr($post_ids);
			
			$post_ids_array = array();
					
			// Get the given post id
			if(!empty($post_ids)){
				
				$post_ids_array = explode(',', $post_ids);			
			
			// Get the current post id	
			}else{
			
				global $post;
				
				$post_ids_array[] = $post->ID;
				
			}
			
			$map_id = implode('', $post_ids_array);
			
			// Get the center point
			if(!empty($center_at)){
				
				$center_point = esc_attr($center_at);
			
				if(strpos($center_point, ',') !== false){
						
					$center_latlng = explode(',', str_replace(' ', '', $center_point));
					
					// Get lat and lng data
					$centerLat = isset($center_latlng[0]) ? $center_latlng[0] : '';
					$centerLng = isset($center_latlng[1]) ? $center_latlng[1] : '';
					
				}else{
						
					// Get lat and lng data
					$centerLat = get_post_meta($center_point, CSPM_LATITUDE_FIELD, true);
					$centerLng = get_post_meta($center_point, CSPM_LONGITUDE_FIELD, true);
			
				}
				
			}else{
					
				// Get lat and lng data
				$centerLat = get_post_meta($post_ids_array[0], CSPM_LATITUDE_FIELD, true);
				$centerLng = get_post_meta($post_ids_array[0], CSPM_LONGITUDE_FIELD, true);
			
			}
			
			$latLng = '"'.$centerLat.','.$centerLng.'"';	
			
			// Map Styling
			$this_map_style = empty($map_style) ? $this->map_style : esc_attr($map_style);
							
			$map_styles = array();
			
			if($this->style_option == 'progress-map'){
					
				// Include the map styles array	
		
				if(file_exists($this->plugin_path.'settings/map-styles.php'))
					include($this->plugin_path.'settings/map-styles.php');
						
			}elseif($this->style_option == 'custom-style' && !empty($this->js_style_array)){
				
				$this_map_style = 'custom-style';
				$map_styles = array('custom-style' => array('style' => $this->js_style_array));
				
			}
			
			?>
			
			<script>
			
				jQuery(document).ready(function($) { 
					
					// init plugin map
					var plugin_map = $('div#codespacing_progress_map_static_<?php echo $map_id; ?>');
					
					// Activate the new google map visual	
					google.maps.visualRefresh = true;
					
					var map_options = { center:[<?php echo $centerLat; ?>, <?php echo $centerLng; ?>],
										zoom: <?php echo esc_attr($zoom); ?>,
										scrollwheel: false,
										disableDoubleClickZoom: true,
										zoomControl: false,
										panControl: false,
										mapTypeControl: false,
										streetViewControl: false,
										draggable: false,							
									  };
					
					// The initial map style;
					var initial_map_style = "<?php echo $this->initial_map_style; ?>";
					
					<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?> 
											
						// The initial style
						var map_type_id = cspm_initial_map_style(initial_map_style, true);
													
						var map_options = jQuery.extend({}, map_options, map_type_id);
						
					<?php }else{ ?>
											
						// The initial style
						var map_type_id = cspm_initial_map_style(initial_map_style, false);
													
						var map_options = jQuery.extend({}, map_options, map_type_id);
						
					<?php } ?>
					
					<?php $show_infobox = (esc_attr($show_overlay) == 'yes') ? 'true' : 'false'; ?>
					
					var json_markers_data = [];
					
					var map_id = 'static_<?php echo $map_id ?>';
					
					var infobox_div = jQuery('div.cspm_infobox_container.cspm_infobox_'+map_id+'');				
					
					var show_infobox = '<?php echo $show_infobox; ?>';
					var infobox_type = '<?php echo esc_attr($infobox_type); ?>';
					var infobox_display_event = '<?php echo $this->infobox_display_event; ?>';
					
					post_ids_and_categories[map_id] = {};
					post_lat_lng_coords[map_id] = {};
					post_ids_and_child_status[map_id] = {}
					
					cspm_bubbles[map_id] = [];
					cspm_child_markers[map_id] = [];
					cspm_requests[map_id] = [];
					
					<?php 
			
					// Count items
					$count_post = count($post_ids_array);
					
					if($count_post > 0){
			
						$i = 1;
						
						$secondary_latlng_array = array();
						
						// Loop throught items
						foreach($post_ids_array as $post_id){
							
							// Get lat and lng data
							$lat = get_post_meta($post_id, CSPM_LATITUDE_FIELD, true);
							$lng = get_post_meta($post_id, CSPM_LONGITUDE_FIELD, true);
						
							// Show items only if lat and lng are not empty
							if(!empty($lat) && !empty($lng)){
										
								$marker_img_array = apply_filters('cspm_bubble_img', wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'cspacing-marker-thumbnail' ), $post_id);
								$marker_img = isset($marker_img_array[0]) ? $marker_img_array[0] : '';
	
								// 1. Get marker category
								$post_categories = wp_get_post_terms($post_id, $this->marker_taxonomies, array("fields" => "ids"));
								$implode_post_categories = (count($post_categories) == 0) ? 0 : implode(',', $post_categories);
								
								// 2. Get marker image
								$marker_img_by_cat = (isset($post_categories[0]) && $this->marker_cats_settings == 'true') ? $this->cspm_get_marker_img($this->marker_taxonomies, $post_categories[0]) : $this->marker_icon;
								
								// 3. Get marker image size for Retina display
								$marker_img_size = $this->cspm_get_image_size($this->cspm_get_image_path_from_url($marker_img_by_cat));
								
								$secondary_latlng = get_post_meta($post_id, CSPM_SECONDARY_LAT_LNG_FIELD, true);
									
								if(!empty($secondary_latlng) && esc_attr($show_secondary) == "yes")
									$secondary_latlng_array[$post_id] = array('latlng' => $secondary_latlng,
																			  'marker_img' => $marker_img,
																			  'post_categories' => $implode_post_categories,
																			  'map_id' => $map_id,
																			  'marker_img_size' => $marker_img_size
																			 ); ?>
																
								// Create the pin object
								var marker_object = cspm_new_pin_object(<?php echo $i; ?>, '<?php echo $post_id; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $implode_post_categories; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $marker_img_size; ?>', 'no');
								json_markers_data.push(marker_object); <?php 
								
								$i++;			
								
							}
									
						} 
						
						
						// Secondary Lats & longs
						
						if(count($secondary_latlng_array) > 0){
							
							$i = 0;
							
							foreach($secondary_latlng_array as $key => $single_latlng){
								
								$post_id = $key;
								$lats_lngs = explode(']', $single_latlng['latlng']);	
								
								foreach($lats_lngs as $single_coordinate){
								
									$strip_coordinates = str_replace(array('[', ']', ' '), '', $single_coordinate);
									$coordinates = explode(',', $strip_coordinates);
									
									if(isset($coordinates[0]) && isset($coordinates[1]) && !empty($coordinates[0]) && !empty($coordinates[1])){
										
										$lat = $coordinates[0];
										$lng = $coordinates[1]; ?>
																
										// Create the pin object
										var marker_object = cspm_new_pin_object(<?php echo $i; ?>, '<?php echo $post_id; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $single_latlng['post_categories']; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $single_latlng['marker_img_size']; ?>', 'yes_<?php echo $i; ?>');
										json_markers_data.push(marker_object); <?php 
										
										$lat = $lng = '';
										
										$i++;
									
									} 
									
								}
								
							}
								
						}
						
					}
					
					?>
					
					// Create the map
					plugin_map.gmap3({	
							  
						map:{
							options: map_options,
							onces: {
								tilesloaded: function(){
									plugin_map.gmap3({ 
										marker:{
											values: json_markers_data
										}
									});
													
									// Show the bubbles after the map load				
									setTimeout(function(){
										if(json_markers_data.length > 0 && show_infobox == 'true')
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'static_'.$map_id); ?>', infobox_type);
									}, 1000);					
	
								}
							}
						},
						
						<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?>
							styledmaptype:{
								id: "custom_style",
								styles: <?php echo $map_styles[$this_map_style]['style']; ?>
							}
						<?php } ?>
																
					});	
												
					<?php if(!empty($centerLat) && !empty($centerLng)){ ?>						
					jQuery(window).resize(function(){
						var latLng = new google.maps.LatLng (<?php echo $centerLat; ?>, <?php echo $centerLng; ?>);																														
						var map = plugin_map.gmap3("get");
						map.panTo(latLng);
						map.setCenter(latLng);
					});
					<?php } ?>
					
				});
			
			</script> 
			
			<?php
			
			$output = '<div style="width:'.esc_attr($width).'; height:'.esc_attr($height).';">';
	
				// Map
				$output .= '<div id="codespacing_progress_map_static_'.$map_id.'" style="width:100%; height:100%"></div>';
			
			$output .= '</div>';
			
			return $output;
			
		}
		
	   /**
		* Display a light map that show's one or more locations
		* No carousel used
		*
		* @since 2.0
		*
		*/
		function cspm_light_map_shortcode($atts){
			
			extract( shortcode_atts( array(
			  'post_ids' => '',
			  'center_at' => '',
			  'height' => '100%',
			  'width' => '100%',
			  'zoom' => 13,
			  'show_overlay' => 'yes',
			  'show_secondary' => 'yes',
			  'map_style' => '',
			  'infobox_type' => $this->infobox_type
			), $atts ) ); 
			
			$post_ids = esc_attr($post_ids);
			
			$post_ids_array = array();
			
			// Get the given post id
			if(!empty($post_ids)){
				
				$post_ids_array = explode(',', $post_ids);			
			
			// Get the current post id	
			}else{
			
				global $post;
				
				$post_ids_array[] = $post->ID;
				
			}
			
			$map_id = implode('', $post_ids_array);
			
			// Get the center point
			if(!empty($center_at)){
				
				$center_point = esc_attr($center_at);
				
				// If the center point is Lat&Lng coordinates
				if(strpos($center_point, ',') !== false){
						
					$center_latlng = explode(',', str_replace(' ', '', $center_point));
					
					// Get lat and lng data
					$centerLat = isset($center_latlng[0]) ? $center_latlng[0] : '';
					$centerLng = isset($center_latlng[1]) ? $center_latlng[1] : '';
				
				// If the center point is a post id
				}else{
						
					// Get lat and lng data
					$centerLat = get_post_meta($center_point, CSPM_LATITUDE_FIELD, true);
					$centerLng = get_post_meta($center_point, CSPM_LONGITUDE_FIELD, true);
			
				}
				
			}else{
					
				// Get lat and lng data
				$centerLat = get_post_meta($post_ids_array[0], CSPM_LATITUDE_FIELD, true);
				$centerLng = get_post_meta($post_ids_array[0], CSPM_LONGITUDE_FIELD, true);
			
			}
			
			$latLng = '"'.$centerLat.','.$centerLng.'"';										
									
			// Map Styling
			$this_map_style = empty($map_style) ? $this->map_style : esc_attr($map_style);
							
			$map_styles = array();
			
			if($this->style_option == 'progress-map'){
					
				// Include the map styles array	
		
				if(file_exists($this->plugin_path.'settings/map-styles.php'))
					include($this->plugin_path.'settings/map-styles.php');
						
			}elseif($this->style_option == 'custom-style' && !empty($this->js_style_array)){
				
				$this_map_style = 'custom-style';
				$map_styles = array('custom-style' => array('style' => $this->js_style_array));
				
			}
			
			?>
			
			<script>
			
				jQuery(document).ready(function($) { 
					
					// init plugin map
					var plugin_map = $('div#codespacing_progress_map_light_<?php echo $map_id; ?>');
					
					// Load Map options	
					var map_options = cspm_load_map_options(true, <?php echo $latLng; ?>, <?php echo esc_attr($zoom); ?>);
					
					// Activate the new google map visual	
					google.maps.visualRefresh = true;
					
					// The initial map style;
					var initial_map_style = "<?php echo $this->initial_map_style; ?>";
					
					// Enhance the map option with the map types id of the style
					<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?> 
											
						// The initial style
						var map_type_id = cspm_initial_map_style(initial_map_style, true);
						
						// Map type control option
						var mapTypeControlOptions = {mapTypeControlOptions: {
														position: google.maps.ControlPosition.TOP_RIGHT,
														mapTypeIds: [google.maps.MapTypeId.ROADMAP,
																	 google.maps.MapTypeId.SATELLITE,
																	 google.maps.MapTypeId.TERRAIN,
																	 google.maps.MapTypeId.HYBRID,
																	 "custom_style"]				
													}};
													
						var map_options = jQuery.extend({}, map_options, map_type_id, mapTypeControlOptions);
						
					<?php }else{ ?>
											
						// The initial style
						var map_type_id = cspm_initial_map_style(initial_map_style, false);
													
						var map_options = jQuery.extend({}, map_options, map_type_id);
						
					<?php } ?>
					
					<?php $show_infobox = (esc_attr($show_overlay) == 'yes') ? 'true' : 'false'; ?>
					
					var json_markers_data = [];
					
					var map_id = 'light_<?php echo $map_id ?>';
					
					var infobox_div = jQuery('div.cspm_infobox_container.cspm_infobox_'+map_id+'');				
					
					var show_infobox = '<?php echo $show_infobox; ?>';
					var infobox_type = '<?php echo esc_attr($infobox_type); ?>';
					var infobox_display_event = '<?php echo $this->infobox_display_event; ?>';
					
					post_ids_and_categories[map_id] = {};
					post_lat_lng_coords[map_id] = {};
					post_ids_and_child_status[map_id] = {}
					
					cspm_bubbles[map_id] = [];
					cspm_child_markers[map_id] = [];
					cspm_requests[map_id] = [];
					
					<?php 
			
					// Count items
					$count_post = count($post_ids_array);
					
					if($count_post > 0){
			
						$i = 1;
						
						$secondary_latlng_array = array();
						
						// Loop throught items
						foreach($post_ids_array as $post_id){
							
							// Get lat and lng data
							$lat = get_post_meta($post_id, CSPM_LATITUDE_FIELD, true);
							$lng = get_post_meta($post_id, CSPM_LONGITUDE_FIELD, true);
						
							// Show items only if lat and lng are not empty
							if(!empty($lat) && !empty($lng)){
										
								$marker_img_array = apply_filters('cspm_bubble_img', wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'cspacing-marker-thumbnail' ), $post_id);
								$marker_img = isset($marker_img_array[0]) ? $marker_img_array[0] : '';
	
								// 1. Get marker category
								$post_categories = wp_get_post_terms($post_id, $this->marker_taxonomies, array("fields" => "ids"));
								$implode_post_categories = (count($post_categories) == 0) ? 0 : implode(',', $post_categories);
								
								// 2. Get marker image
								$marker_img_by_cat = (isset($post_categories[0]) && $this->marker_cats_settings == 'true') ? $this->cspm_get_marker_img($this->marker_taxonomies, $post_categories[0]) : $this->marker_icon;
								
								// 3. Get marker image size for Retina display
								$marker_img_size = $this->cspm_get_image_size($this->cspm_get_image_path_from_url($marker_img_by_cat));
								
								$secondary_latlng = get_post_meta($post_id, CSPM_SECONDARY_LAT_LNG_FIELD, true);
									
								if(!empty($secondary_latlng) && esc_attr($show_secondary) == "yes")
									$secondary_latlng_array[$post_id] = array('latlng' => $secondary_latlng,
																			  'marker_img' => $marker_img,
																			  'post_categories' => $implode_post_categories,
																			  'map_id' => $map_id,
																			  'marker_img_size' => $marker_img_size
																			 ); ?>
																
								// Create the pin object
								var marker_object = cspm_new_pin_object(<?php echo $i; ?>, '<?php echo $post_id; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $implode_post_categories; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $marker_img_size; ?>', 'no');
								json_markers_data.push(marker_object); <?php 
								
								$i++;			
								
							}
									
						} 
						
						// Secondary Lats & longs
						
						if(count($secondary_latlng_array) > 0){
							
							$i = 0;
							
							foreach($secondary_latlng_array as $key => $single_latlng){
								
								$post_id = $key;
								$lats_lngs = explode(']', $single_latlng['latlng']);	
								
								foreach($lats_lngs as $single_coordinate){
								
									$strip_coordinates = str_replace(array('[', ']', ' '), '', $single_coordinate);
									$coordinates = explode(',', $strip_coordinates);
									
									if(isset($coordinates[0]) && isset($coordinates[1]) && !empty($coordinates[0]) && !empty($coordinates[1])){
										
										$lat = $coordinates[0];
										$lng = $coordinates[1]; ?>
																
										// Create the pin object
										var marker_object = cspm_new_pin_object(<?php echo $i; ?>, '<?php echo $post_id; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $single_latlng['post_categories']; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $single_latlng['marker_img_size']; ?>', 'yes_<?php echo $i; ?>');
										json_markers_data.push(marker_object); <?php 
										
										$lat = $lng = '';
										
										$i++;
									
									} 
									
								}
								
							}
								
						}
						
					}
					
					?>
					
					// Create the map
					plugin_map.gmap3({	
							  
						map:{
							options: map_options,
							onces: {
								tilesloaded: function(){
									
									plugin_map.gmap3({ 
										marker:{
											values: json_markers_data,																			
										}
									});
									
									<?php
									// Show the Zoom control after the map load		
									if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
										jQuery('div.codespacing_light_map_zoom_in_<?php echo $map_id ?>, div.codespacing_light_map_zoom_out_<?php echo $map_id ?>').show(); <?php 
									}
									?>
									
									if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onload'){
										setTimeout(function(){
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type);
										}, 1000);																
									}
									
								}
								
							},
							events:{
								zoom_changed: function(){
									setTimeout(function(){
										if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onload'){								
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type);
										}
									}, 1000);
								},
								idle: function(){
									setTimeout(function(){
										if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onload'){								
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type);
										}
									}, 1000);
								},				
								bounds_changed: function(){
									if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event != 'onload'){
										cspm_set_single_infobox_position(plugin_map, infobox_div);
									}else if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onload'){
										cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type);														
									}
								},
								drag: function(){
									if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event != 'onload'){
										cspm_set_single_infobox_position(plugin_map, infobox_div);
									}else if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onload'){							
										cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox(esc_attr($infobox_type), 'multiple', 'light_'.$map_id); ?>', infobox_type);														
									}
								}
							}						
						},
						
						<?php if(count($map_styles) > 0 && $this_map_style != 'google-map' && isset($map_styles[$this_map_style])){ ?> 
							<?php $style_title = isset($map_styles[$this_map_style]['title']) ? $map_styles[$this_map_style]['title'] : 'Custom style'; ?>
							styledmaptype:{
								id: "custom_style",
								options:{
									name: "<?php echo $style_title; ?>",
									alt: "Show <?php echo $style_title; ?>"
								},
								styles: <?php echo $map_styles[$this_map_style]['style']; ?>
							}
						<?php } ?>
						
					});								
						
					// Call zoom-in function
					cspm_zoom_in($('div.codespacing_light_map_zoom_in_<?php echo $map_id; ?>'), plugin_map);
				
					// Call zoom-out function
					cspm_zoom_out($('div.codespacing_light_map_zoom_out_<?php echo $map_id; ?>'), plugin_map);
					
					<?php if(!empty($centerLat) && !empty($centerLng)){ ?>
					// Center the Map on screen resize															
					jQuery(window).resize(function(){
						var latLng = new google.maps.LatLng (<?php echo $centerLat; ?>, <?php echo $centerLng; ?>);							
						var map = plugin_map.gmap3("get");														
						map.panTo(latLng);
						map.setCenter(latLng);
					});
					<?php } ?>
						
				});
			
			</script> 
			
			<?php
			
			$output = '<div style="width:'.esc_attr($width).'; height:'.esc_attr($height).'; border-radius:50%">';
			
				// Zoom Control
							
				if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){
				
					$output .= '<div class="codespacing_zoom_container">';
						$output .= '<div class="codespacing_light_map_zoom_in_'.$map_id.'"></div>';
						$output .= '<div class="codespacing_light_map_zoom_out_'.$map_id.'"></div>';
					$output .= '</div>';
				
				}
				
				// Map
							
				$output .= '<div id="codespacing_progress_map_light_'.$map_id.'" style="width:100%; height:100%;"></div>';
			
			$output .= '</div>';
			
			return $output;
			
		}
			
		// Plugin's main map	
		// @Last update, since 2.5
		function cspm_main_map_shortcode($atts)
		{
			
			// Overide the default post_ids array by the shortcode atts post_ids	
			extract( shortcode_atts( array(	
				'map_id' => 'initial',		
				'post_ids' => '',
				'post_type' => '',
				'post_status' => '', 
				'number_of_posts' => '',
				'tax_query' => '',
				'tax_query_relation' => '',
				'cache_results' => '',
				'update_post_meta_cache' => '',
				'update_post_term_cache' => '',
				'post_in' => '',
				'post_not_in' => '',
				'custom_fields' => '',
				'custom_field_relation' => '',
				'authors' => '',
				'orderby' => '',
				'orderby_meta_key' => '',
				'order' => '',
				'center_at' => '',	
				'zoom' => $this->zoom,
				'carousel' => 'yes',
				'faceted_search' => 'yes',
				'search_form' => 'yes',
				'map_style' => '',
				'faceted_search_tax_slug' => esc_attr($this->marker_taxonomies),
				'faceted_search_tax_terms' => '',
				'show_post_count' => 'yes',
				'show_secondary' => 'yes',
				'show_overlay' => 'yes'
			), $atts ) ); 
			
			// Get the terms to use in the faceted saerch
			// This will overide the default settings
			$faceted_search_tax_terms = (empty($faceted_search_tax_terms)) ? array() : explode(',', $faceted_search_tax_terms);
			
			// Map Styling
			$this->map_style = empty($map_style) ? $this->map_style : esc_attr($map_style);
							
			$map_styles = array();
			
			if($this->style_option == 'progress-map'){
					
				// Include the map styles array	
		
				if(file_exists($this->plugin_path.'settings/map-styles.php'))
					include($this->plugin_path.'settings/map-styles.php');
						
			}elseif($this->style_option == 'custom-style' && !empty($this->js_style_array)){
				
				$this->map_style = 'custom-style';
				$map_styles = array('custom-style' => array('style' => $this->js_style_array));
				
			}
			
			// If post ids being pased from the shortcode parameter @post_ids
			// Check the format of the @post_ids value		
			if(!empty($post_ids)){
				
				$query_post_ids = explode(',', $post_ids);	
					
			}else{
				
				// The main query
				if(!empty($post_type))				
					$query_post_ids = $this->cspm_main_query($post_type, 
															 $post_status,
															 $number_of_posts, 
															 $tax_query,
															 $tax_query_relation, 
															 $cache_results, 
															 $update_post_meta_cache,
															 $update_post_term_cache,
															 $post_in,
															 $post_not_in,
															 $custom_fields,
															 $custom_field_relation,
															 $authors,
															 $orderby,
															 $orderby_meta_key,
															 $order
															 );
																				 
				else $query_post_ids = $this->cspm_main_query();
	
			}
			
			$post_type = !empty($post_type) ? esc_attr($post_type) : $this->post_type;
			$post_ids = $query_post_ids;
	
			// Get the center point
			if(!empty($center_at)){
				
				$center_point = esc_attr($center_at);
				
				// If the center point is Lat&Lng coordinates
				if(strpos($center_point, ',') !== false){
						
					$center_latlng = explode(',', str_replace(' ', '', $center_point));
					
					// Get lat and lng data
					$centerLat = isset($center_latlng[0]) ? $center_latlng[0] : '';
					$centerLng = isset($center_latlng[1]) ? $center_latlng[1] : '';
					
				// If the center point is a post id
				}else{
						
					// Get lat and lng data
					$centerLat = get_post_meta($center_point, CSPM_LATITUDE_FIELD, true);
					$centerLng = get_post_meta($center_point, CSPM_LONGITUDE_FIELD, true);
			
				}
				
				$latLng = '"'.$centerLat.','.$centerLng.'"';
				
				// The center point
				$center_point = array($centerLat, $centerLng);
			
			}else{
				
				// The center point
				$center_point = explode(',', $this->center);
				
			}
			
			$map_id = esc_attr($map_id);
			$zoom = esc_attr($zoom);
			$carousel = esc_attr($carousel);
			$faceted_search = esc_attr($faceted_search);
			$search_form = esc_attr($search_form);
			
			?>

			<script>
	
				jQuery(document).ready(function($) { 		
				
					var map_id = "<?php echo $map_id ?>";
	
					if(_CSPM_DONE[map_id] === true) return;
					
					_CSPM_DONE[map_id] = false;
					
					NProgress.configure({
					  parent: 'div#codespacing_progress_map_div_'+map_id+'',
					  showSpinner: true
					});				
					
					NProgress.start();
					
					var infobox_xhr; // Will store the ajax requests in order to test if an ajax request will overide "an already sent and non finished" request
					
					cspm_bubbles[map_id] = []; // Will store the marker bubbles (post_ids) in the viewport of the map
					cspm_child_markers[map_id] = []; // Will store the status of markers in order to define secondary markers from parent markers
					cspm_requests[map_id] = []; // Will store all the current ajax request in order to execute them when they all finish
									
					post_ids_and_categories[map_id] = {}; // Will store the markers categories in order to use with faceted search and to define the marker icon
					post_lat_lng_coords[map_id] = {}; // Will store the markers coordinates in order to use when rewriting the map & the carousel
					post_ids_and_child_status[map_id] = {} // Will store the markers and their child status in order to use when rewriting the carousel
					
					var json_markers_data = []; // Will store the markers
	
					// init plugin map
					var plugin_map = jQuery('div#codespacing_progress_map_div_'+map_id+'');
					
					// Load Map options
					<?php if(!empty($center_at)){ ?>
						var map_options = cspm_load_map_options(false, <?php echo $latLng; ?>, <?php echo $zoom; ?>);
					<?php }else{ ?>
						var map_options = cspm_load_map_options(false, null, <?php echo $zoom; ?>);
					<?php } ?>
					
					// Activate the new google map visual	
					google.maps.visualRefresh = true;				

					// The initial map style;
					var initial_map_style = "<?php echo $this->initial_map_style; ?>";
					
					// Enhance the map option with the map type id of the style
					<?php if(count($map_styles) > 0 && $this->map_style != 'google-map' && isset($map_styles[$this->map_style])){ ?> 
											
						// The initial style
						var map_type_id = cspm_initial_map_style(initial_map_style, true);
			
						// Map type control option
						var mapTypeControlOptions = {mapTypeControlOptions: {
														position: google.maps.ControlPosition.TOP_RIGHT,
														mapTypeIds: [google.maps.MapTypeId.ROADMAP,
																	 google.maps.MapTypeId.SATELLITE,
																	 google.maps.MapTypeId.TERRAIN,
																	 google.maps.MapTypeId.HYBRID,
																	 "custom_style"]				
													}};
													
						var map_options = jQuery.extend({}, map_options, map_type_id, mapTypeControlOptions);
						
					<?php }else{ ?>
											
						// The initial style
						var map_type_id = cspm_initial_map_style(initial_map_style, false);
						var map_options = jQuery.extend({}, map_options, map_type_id);
						
					<?php } ?>				
	
					<?php $light_map = ($this->main_layout == 'fullscreen-map' || $this->main_layout == 'fit-in-map' || $this->show_carousel == 'false' || $carousel == 'no') ? true : false; ?>
					
					// The carousel dimensions & style
					<?php if(!$light_map && $this->items_view == "listview"){ ?>
					
						var item_width = parseInt(<?php echo $this->horizontal_item_width; ?>);										
						var item_height = parseInt(<?php echo $this->horizontal_item_height; ?>);
						var item_css = "<?php echo $this->horizontal_item_css; ?>";
						var items_background  = "<?php echo $this->items_background; ?>";
						
					<?php }elseif(!$light_map && $this->items_view == "gridview"){ ?>
					
						var item_width = parseInt(<?php echo $this->vertical_item_width; ?>);
						var item_height = parseInt(<?php echo $this->vertical_item_height; ?>);
						var item_css = "<?php echo $this->vertical_item_css; ?>";
						var items_background  = "<?php echo $this->items_background; ?>";
					
					<?php } ?>
					
					<?php 
					
					$markers_array = get_option('cspm_markers_array');
					$markers_object = isset($markers_array[$post_type]) ? $markers_array[$post_type] : array();
	
					if($light_map){ ?> var light_map = true; <?php }else{ ?> var light_map = false; <?php } 
						
					// Count items
					$count_post = count($post_ids);
					
					if($count_post > 0){
						
						$m = $l = 0;
						
						while($m < $count_post){
							
							$post_id = isset($markers_object['post_id_'.$post_ids[$m]]['post_id']) ? $markers_object['post_id_'.$post_ids[$m]]['post_id'] : '';
									
							// Get the default language used by WPML
							//$default_lang = $this->cspm_wpml_default_lang();
							//$post_id = $this->cspm_wpml_object_id($post_id, $post_type, true);
						
							$lat = isset($markers_object['post_id_'.$post_ids[$m]]['lat']) ? $markers_object['post_id_'.$post_ids[$m]]['lat'] : '';
							$lng = isset($markers_object['post_id_'.$post_ids[$m]]['lng']) ? $markers_object['post_id_'.$post_ids[$m]]['lng'] : '';						
							$is_child = 'no';
							$children_markers  = isset($markers_object['post_id_'.$post_ids[$m]]['children_markers']) ? $markers_object['post_id_'.$post_ids[$m]]['children_markers'] : array();
							
							if(!empty($post_id) && !empty($lat) && !empty($lng)){
								
								if($this->marker_cats_settings == 'true'){
									
									// 1. Get marker category
									$post_categories = isset($markers_object['post_id_'.$post_ids[$m]]['post_tax_terms'][$faceted_search_tax_slug]) ? $markers_object['post_id_'.$post_ids[$m]]['post_tax_terms'][$faceted_search_tax_slug] : array();
									$implode_post_categories = (count($post_categories) == 0) ? '' : implode(',', $post_categories);
									
									// 2. Get marker image
									$marker_img_by_cat = (isset($post_categories[0]) && $this->marker_cats_settings == 'true') ? $this->cspm_get_marker_img($this->marker_taxonomies, $post_categories[0]) : $this->marker_icon;
									
									// 3. Get marker image size for Retina display
									$marker_img_size = ($this->retinaSupport == "true") ? $this->cspm_get_image_size($this->cspm_get_image_path_from_url($marker_img_by_cat)) : '';
								
								}else{
									
									// 1. Get marker category
									$post_categories = array();
									$implode_post_categories = '';
									
									// 2. Get marker image
									$marker_img_by_cat = $this->marker_icon;
									
									// 3. Get marker image size for Retina display
									$marker_img_size = ($this->retinaSupport == "true") ? $this->cspm_get_image_size($this->cspm_get_image_path_from_url($marker_img_by_cat)) : '';
								
								}
								
								?>
								
								// Create the pin object
							    var marker_object = cspm_new_pin_object(<?php echo $l; ?>, '<?php echo $post_id; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $implode_post_categories; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $marker_img_size; ?>', '<?php echo $is_child; ?>');
								json_markers_data.push(marker_object);
											
								<?php				
								
								$l++;
								
								if(count($children_markers) > 0 && esc_attr($show_secondary) == 'yes'){
									
									for($c=0; $c<count($children_markers); $c++){
										
										$post_id = isset($children_markers[$c]['post_id']) ? $children_markers[$c]['post_id'] : '';
										$lat = isset($children_markers[$c]['lat']) ? $children_markers[$c]['lat'] : '';
										$lng = isset($children_markers[$c]['lng']) ? $children_markers[$c]['lng'] : '';						
										$is_child = isset($children_markers[$c]['is_child']) ? $children_markers[$c]['is_child'] : '';									
							
										if(!empty($post_id) && !empty($lat) && !empty($lng)){ ?>

											// Create the pin object
											var marker_object = cspm_new_pin_object(<?php echo $l; ?>, '<?php echo $post_id.'-'.$c; ?>', <?php echo $lat; ?>, <?php echo $lng; ?>, '<?php echo $implode_post_categories; ?>', map_id, '<?php echo $marker_img_by_cat; ?>', '<?php echo $marker_img_size; ?>', '<?php echo $is_child; ?>');
											json_markers_data.push(marker_object);
											
											<?php
																
											$l++;	
																			
										}									
							
									}
									
								}
								 
							}
							
							$m++;
	
						}
						
					}
					
					$show_infoboxes = ($show_overlay == 'yes' && $this->show_infobox == 'true') ? 'true' : 'false';
					
					?>
	
					var infobox_div = jQuery('div.cspm_infobox_container.cspm_infobox_'+map_id+'');				
					var show_infobox = '<?php echo $show_infoboxes; ?>';
					var infobox_type = '<?php echo $this->infobox_type; ?>';
					var infobox_display_event = '<?php echo $this->infobox_display_event; ?>';
					var useragent = navigator.userAgent;
					var infobox_loaded = false;
					var clustering_method = false;
					
					// Create the map
					plugin_map.gmap3({	
						map:{
							options: map_options,
							onces: {
								tilesloaded: function(map){
																		
									var carousel_output = []; 

									plugin_map.gmap3({ 
										marker:{
											values: json_markers_data,
											callback: function(markers){
												
												if(!light_map){
													
													for(var i = 0; i < markers.length; i++){	

														var post_id = markers[i].post_id;
														var is_child = markers[i].is_child;
	
														// Convert the LatLng object to array
														var marker_position = jQuery.map(markers[i].position, function(value, index) {
															return [value];
														});
														var lat = marker_position[0];
														var lng = marker_position[1];											
													
														// Create carousel items											
														carousel_output.push('<li id="'+map_id+'_list_items_'+post_id+'" class="'+post_id+' carousel_item_'+(i+1)+'_'+map_id+'" data-is-child="'+is_child+'" name="'+lat+'_'+lng+'" value="'+(i+1)+'" style="width:'+item_width+'px; height:'+item_height+'px; background-color:'+items_background+'; margin:4px 3px; '+item_css+'">');
															carousel_output.push('<div class="cspm_spinner"></div>');							
														carousel_output.push('</li>');
														
														if(i == markers.length-1){
															jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').append(carousel_output.join(''));	
															cspm_init_carousel(null, map_id);
														}
														
													}																						
																																					
												}												
												
											},											
											events:{
												mouseover: function(marker, event, elements){

													// Display the single infobox		
													if(show_infobox == 'true' && infobox_display_event == 'onhover')
														infobox_xhr = cspm_draw_single_infobox(plugin_map, map_id, infobox_div, infobox_type, marker, infobox_xhr);
													
													// Call carousel item active style
													if(!light_map){	
														
														var post_id = marker.post_id;
														var is_child = marker.is_child;	
														var i = jQuery('li[id='+map_id+'_list_items_'+post_id+'][data-is-child="'+is_child+'"]').attr('value');	
														
														cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel'), i);
														cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id+'', map_id);
													
													}
													
												},
												// Click event is used only for content infowindow style
												click: function(marker, event, elements){
													
													var latLng = marker.position;											
													
													// Center the map on that marker
													map.panTo(latLng);
													
													// Display the single infobox
													if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onclick'){
														setTimeout(function(){																										
															infobox_xhr = cspm_draw_single_infobox(plugin_map, map_id, infobox_div, infobox_type, marker, infobox_xhr);
														}, 400);
													}
						
													// Call carousel item active style
													if(!light_map){	
														
														var post_id = marker.post_id;
														var is_child = marker.is_child;
														var i = jQuery('li[id='+map_id+'_list_items_'+post_id+'][data-is-child="'+is_child+'"]').attr('value');
													
														cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel'), i);
														cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id+'', map_id);
													
													}
													
												}
											}
										}
									});									
									
									<?php
									
									// Clustring markers
									if($this->useClustring == 'true'){ ?>
										clustering_method = true;
										var clusterer = cspm_clustering(plugin_map, map_id, light_map);<?php
									}
									
									// Show the Zoom control after the map load		
									if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
										jQuery('div.codespacing_map_zoom_in_'+map_id+', div.codespacing_map_zoom_out_'+map_id+'').show(); <?php 
									}
									
									// Show the faceted search after the map load		
									if($faceted_search == "yes" && $this->faceted_search_option == "true" && $this->marker_cats_settings == "true"){ ?>
										jQuery('div.faceted_search_btn#'+map_id+'').show(); <?php 
									}
								
									// Show the search form after the map load				
									if($search_form == "yes" && $this->search_form_option == "true"){ ?> jQuery('div.search_form_btn#'+map_id+'').show(); <?php }
									
									if($this->main_layout == "map-tglc-bottom"){ ?> jQuery('div.toggle-carousel-bottom').show(); <?php } 
									
									if($this->main_layout == "map-tglc-top"){ ?> jQuery('div.toggle-carousel-top').show(); <?php }
									
									?>
									
									// Draw infoboxes (onload event)
									if(json_markers_data.length > 0 && clustering_method == true && show_infobox == 'true' && infobox_display_event == 'onload'){			
										google.maps.event.addListenerOnce(clusterer, 'clusteringend', function(cluster) {																				
											setTimeout(function(){
												cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox($this->infobox_type, 'multiple', $map_id); ?>', infobox_type);
												infobox_loaded = true;
											}, 1000);																
										});	
									}else if(json_markers_data.length > 0 && clustering_method == false && show_infobox == 'true' && infobox_display_event == 'onload'){
										setTimeout(function(){
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox($this->infobox_type, 'multiple', $map_id); ?>', infobox_type);
											infobox_loaded = true;
										}, 1000);
									}else if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event != 'onload'){infobox_loaded = true;}
										
									NProgress.done();
									
								}
								
							},
							events:{
								click: function(){
									// Remove single infobox on map click (onclick, onhover events)
									if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event != 'onload'){										
										infobox_div.addClass('cspm_animated fadeOutUp');					
										infobox_div.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
											infobox_div.hide().removeClass('cspm_animated fadeOutUp');
										});
									}
								},
								idle: function(){
									if(infobox_loaded){
										setTimeout(function(){
											if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event == 'onload'){								
												cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox($this->infobox_type, 'multiple', $map_id); ?>', infobox_type);
											}
										}, 200);
									}
								},				
								bounds_changed: function(){
									if(json_markers_data.length > 0){
										if(json_markers_data.length > 0 && show_infobox == 'true' && infobox_display_event != 'onload'){
											cspm_set_single_infobox_position(plugin_map, infobox_div);
										}else jQuery('div.cspm_infobox_container').hide();
									}
								},
								drag: function(){
									if(json_markers_data.length > 0){
										if(show_infobox == 'true' && infobox_display_event != 'onload'){
											cspm_set_single_infobox_position(plugin_map, infobox_div);
										}else jQuery('div.cspm_infobox_container').hide();
									}
								},
								center_changed: function(){
									setTimeout(function() {
										jQuery('div[class^=cluster_posts_widget]').removeClass('flipInX');
										jQuery('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');
									}, 1000);
								}
							}
						},					
						
						<?php if($this->geoIpControl == "true"){ ?>
							getgeoloc:{
								callback : function(latLng){
								  if (latLng){						
									plugin_map.gmap3({						  
									  map:{
										options:{
										  center:latLng,
										}
									  }
									});
								  }
								}
							},
						<?php } ?>
						
						<?php if(count($map_styles) > 0 && $this->map_style != 'google-map' && isset($map_styles[$this->map_style])){ ?> 
							<?php $style_title = isset($map_styles[$this->map_style]['title']) ? $map_styles[$this->map_style]['title'] : 'Custom style'; ?>
							styledmaptype:{
								id: "custom_style",
								options:{
									name: "<?php echo $style_title; ?>",
									alt: "Show <?php echo $style_title; ?>"
								},
								styles: <?php echo $map_styles[$this->map_style]['style']; ?>
							},
						<?php } ?>
						
						<?php if(esc_attr($show_post_count) == 'yes' && $this->show_posts_count == 'yes'){ ?>
							// Show posts count
							<?php $widget_top = ($this->main_layout == "fullscreen-map-top-carousel" || $this->main_layout == "fit-in-map-top-carousel" || $this->main_layout == "m-con") ? '10%' : '80%'  ?>
							panel:{
								options:{
									content: '<div class="number_of_posts_widget"><?php echo $this->cspm_posts_count_clause($l, $map_id); ?></div>',
									middle: true,
									center: true,
									top:'<?php echo $widget_top; ?>',
									right: false,
									bottom: false,
									left:'70%',								
								}
							},
						<?php } ?>	
										
					});		
		
					var mapObject = plugin_map.gmap3('get');
					
					if(typeof mapObject.getStreetView === 'function'){
						
						// Hide/Show UI Controls depending on the streetview visibility
						var streetView = mapObject.getStreetView();
					
						google.maps.event.addListener(streetView, "visible_changed", function(){
							
							if(this.getVisible()){
								// Hide the Zoom cotrol before the map load	
								<?php if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
									jQuery('div.codespacing_map_zoom_in_'+map_id+', div.codespacing_map_zoom_out_'+map_id+'').hide();
								<?php } ?>
								
								// Hide the faceted search before the map load				
								<?php if($faceted_search == "yes" && $this->faceted_search_option == "true" && $this->marker_cats_settings == "true"){ ?>
									jQuery('div.faceted_search_btn#'+map_id+'').hide();
								<?php } ?>
								
								// Hide the search form before the map load				
								<?php if($search_form == "yes" && $this->search_form_option == "true"){ ?>
									jQuery('div.search_form_btn#'+map_id+'').hide();
								<?php } ?>
								
								<?php if($this->show_posts_count == 'yes'){ ?>
									jQuery('div.number_of_posts_widget').hide();
								<?php } ?>
								
								jQuery('div.cspm_infobox_container').hide();
								
							}else{
								// Show the Zoom cotrol after the map load	
								<?php if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
									jQuery('div.codespacing_map_zoom_in_'+map_id+', div.codespacing_map_zoom_out_'+map_id+'').show();
								<?php } ?>
								
								// Show the faceted search after the map load				
								<?php if($faceted_search == "yes" && $this->faceted_search_option == "true" && $this->marker_cats_settings == "true"){ ?>
									jQuery('div.faceted_search_btn#'+map_id+'').show();
								<?php } ?>
								
								// Show the search form after the map load				
								<?php if($search_form == "yes" && $this->search_form_option == "true"){ ?>
									jQuery('div.search_form_btn#'+map_id+'').show();
								<?php } ?>
								
								<?php if($this->show_posts_count == 'yes'){ ?>
									jQuery('div.number_of_posts_widget').show();
								<?php } ?>
								
								if(json_markers_data.length > 0 && infobox_loaded){
									setTimeout(function(){
										if(show_infobox == 'true' && infobox_display_event == 'onload'){								
											cspm_draw_multiple_infoboxes(plugin_map, map_id, '<?php echo $this->cspm_infobox($this->infobox_type, 'multiple', $map_id); ?>', infobox_type);
										}
									}, 200);
								}
							}
								
						});
						
					}
								
					<?php if($this->wrong_center_point){ ?>
						
						// Show error msg when center point is not correct					
						plugin_map.gmap3({
							panel:{
								options:{
									content: '<div class="error_widget">The center point provided is not correct. Please make sure that the Latitude & the Longitude in the "Map center" is separated by comma.</div>',
									top: '40%',
									left: '20%',								
								}
							}
						});	
					
					<?php } ?>
					
					<?php if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){ ?>
										
						// Call zoom-in function
						cspm_zoom_in($('div.codespacing_map_zoom_in_'+map_id+''), plugin_map);
					
						// Call zoom-out function
						cspm_zoom_out($('div.codespacing_map_zoom_out_'+map_id+''), plugin_map);
						
					<?php } ?>
					
					<?php if(isset($center_point[0]) && !empty($center_point[0]) && isset($center_point[1]) && !empty($center_point[1])){ ?>
					// Center the Map on screen resize															
					jQuery(window).resize(function(){
						var latLng = new google.maps.LatLng (<?php echo $center_point[0]; ?>, <?php echo $center_point[1]; ?>);							
						var map = plugin_map.gmap3("get");	
						map.panTo(latLng);
						map.setCenter(latLng);
					});
					<?php } ?> 
					
					_CSPM_DONE[map_id] = true;
	
				});
			
			</script> 
			
			<?php
				
			$layout_style = "";
			
			// Define fixed/fullwidth layout height and width	
			if($this->main_layout != 'fullscreen-map' && $this->main_layout != 'fit-in-map'){
	
				if($this->layout_type == 'fixed')
					$layout_style = "width:".$this->layout_fixed_width."px; height:".$this->layout_fixed_height."px;";
				else ($this->main_layout == "mu-cd" || $this->main_layout == "md-cu") ? $layout_style = "width:100%; height:".($this->layout_fixed_height+20)."px;" 
																				  : $layout_style = "width:100%; height:".$this->layout_fixed_height."px;";
	
			}elseif($this->main_layout == 'fit-in-map'){ 
				
				$layout_style = "width:100%;";
				
			}elseif($this->main_layout == 'fullscreen-map'){
				
				$layout_style = "display:block; margin:0; padding:0; position:absolute; top:0; right:0; bottom:0; left:0; z-index:9999"; 
			
			}	
						
			$output = '';
			
			// Plugin Container
				
			$output .= '<div class="codespacing_progress_map_area" role="bar" style="'.$layout_style.'">';
				
				// Plugin Map					
											
				/* =============================== */
				/* ==== Map-Up, Carousel-Down ==== */
				/* =============================== */
				
				if($this->main_layout == "mu-cd"){
									
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
					
					// Detect Mobile browsers and adjust the map height depending on the result	
					if(!$this->cspm_detect_mobile_browser()){
						
						$map_height = ($this->show_carousel == 'true' && $carousel == "yes") ? $this->layout_fixed_height - $carousel_height . 'px' : $this->layout_fixed_height . 'px';
						
					}else $map_height = $this->layout_fixed_height . 'px';
					
					// Layout function
					$output .= $this->cspm_map_up_carousel_down_layout($map_height, $carousel_height, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
								
									
				/* =============================== */
				/* ==== Map-Down, Carousel-Up ==== */
				/* =============================== */
				
				}elseif($this->main_layout == "md-cu"){
					
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
					
					// Detect Mobile browsers and adjust the map height depending on the result		
					if(!$this->cspm_detect_mobile_browser()){
						
						$map_height = ($this->show_carousel == 'true' && $carousel == "yes") ? $this->layout_fixed_height - $carousel_height . 'px' : $this->layout_fixed_height . 'px';
						
					}else $map_height = $this->layout_fixed_height . 'px';
					
					// Layout function
					$output .= $this->cspm_map_down_carousel_up_layout($carousel_height, $map_height, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
									
									
				/* ================================== */
				/* ==== Map-Right, Carousel-Left ==== */
				/* ================================== */
				
				}elseif($this->main_layout == "mr-cl"){
					
					if($this->items_view == "listview"){
						
						$carousel_width = $this->horizontal_item_width + 8;
						
					}elseif($this->items_view == "gridview"){
						
						$carousel_width = $this->vertical_item_width + 8;
						
					}
					
					// Layout function
					$output .= $this->cspm_map_right_carousel_left_layout($carousel_width, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
	
									
				/* ================================== */
				/* ==== Map-Left, Carousel-Right ==== */
				/* ================================== */
				
				}elseif($this->main_layout == "ml-cr"){
					
					if($this->items_view == "listview"){
						
						$carousel_width = $this->horizontal_item_width + 8;
						
					}elseif($this->items_view == "gridview"){
						
						$carousel_width = $this->vertical_item_width + 8;
						
					}
					
					// Layout function
					$output .= $this->cspm_map_left_carousel_right_layout($carousel_width, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
									
				
				/* ====================== */
				/* ==== Only The Map ==== */
				/* ====================== */
				
				}elseif($this->main_layout == "fullscreen-map" || $this->main_layout == "fit-in-map"){
												
					$output .= $this->cspm_only_map_layout($map_id, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
									
				
				/* ============================================== */
				/* ==== Fullscreen Map/Fit in map & Carousel ==== */
				/* ============================================== */
				
				}elseif($this->main_layout == "fullscreen-map-top-carousel" || $this->main_layout == "fit-in-map-top-carousel"){
					
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
					
					$output .= $this->cspm_full_map_carousel_over_layout($map_id, $carousel, $faceted_search, $carousel_height, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
					
	
				/* ============================ */
				/* ==== Map, Carousel over ==== */
				/* ============================ */
				
				}elseif($this->main_layout == "m-con"){
					
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
					
					$map_height = $this->layout_fixed_height . 'px';
					
					// Layout function
					$output .= $this->cspm_map_up_carousel_over_layout($map_height, $carousel_height, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
					
	
				/* ======================================== */
				/* ==== Map, Carousel toggled from top ==== */
				/* ======================================== */
				
				}elseif($this->main_layout == "map-tglc-top"){
					
					$map_height = $this->layout_fixed_height . 'px';
					
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
						
					$output .= $this->cspm_map_toggle_carousel_top_layout($map_height, $carousel_height, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);                
					
	
				/* =========================================== */
				/* ==== Map, Carousel toggled from bottom ==== */
				/* =========================================== */
				
				}elseif($this->main_layout == "map-tglc-bottom"){
					
					$map_height = $this->layout_fixed_height . 'px';
					
					if($this->items_view == "listview")
						$carousel_height = $this->horizontal_item_height + 8;
						
					elseif($this->items_view == "gridview")
						$carousel_height = $this->vertical_item_height + 8;
						
					$output .= $this->cspm_map_toggle_carousel_bottom_layout($map_height, $carousel_height, $map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);                
						
				}
				
			$output .= '</div>';
			
			return $output;
			
		} 
		
		// Create the infobox of the marker
		// @since 2.5
		function cspm_infobox($infobox_type, $status, $map_id){
			
			$output = '';
			
			if($infobox_type == 'square_bubble' || $infobox_type == 'rounded_bubble')
				$style = 'style="width:60px; height:60px;"';
			elseif($infobox_type == 'cspm_type1')
				$style = 'style="width:290px; height:100px;"';
			elseif($infobox_type == 'cspm_type2')
				$style = 'style="width:184px; height:160px;"';
			elseif($infobox_type == 'cspm_type3')
				$style = 'style="width:220px; height:50px;"';
			elseif($infobox_type == 'cspm_type4')
				$style = 'style="width:200px; height:30px;"';
				
			$output .= '<div class="cspm_infobox_container cspm_infobox_'.$status.' cspm_infobox_'.$map_id.' '.$infobox_type.'" '.$style.'>';
				$output .= '<div class="blue_cloud"></div>';
				$output .= '<div class="cspm_arrow_down '.$infobox_type.'"></div>';
			$output .= '</div>';
			
			return $output;
			
		}
		
		// Draw the infobox content
		// @since 2.5
		function cspm_infobox_content(){
	
			$post_id = esc_attr($_POST['post_id']);
			$infobox_type = esc_attr($_POST['infobox_type']);
			$map_id = esc_attr($_POST['map_id']);
			$status = esc_attr($_POST['status']);
			
			$no_title = array(); // Infoboxes to display with no title
			$no_link = array(); // Infobox to display whit no link
			$no_description = array('square_bubble', 'rounded_bubble', 'cspm_type2', 'cspm_type3', 'cspm_type4'); // Infoboxes to display with no description
			$no_image = array('cspm_type4'); // Infoboxes to display with no image
			
			if(!in_array($infobox_type, $no_title)) $item_title = stripslashes_deep($this->cspm_items_title($post_id, $this->items_title)); 
			if(!in_array($infobox_type, $no_description)) $item_description = stripslashes_deep($this->cspm_items_details($post_id, $this->items_details));
			if(!in_array($infobox_type, $no_link)) $the_permalink = $this->cspm_get_permalink($post_id);
			
			if(!in_array($infobox_type, $no_image)){
				
				if($infobox_type == 'square_bubble' || $infobox_type == 'rounded_bubble')
					$parameter = array( 'style' => "width:50px; height:50px;" );
				elseif($infobox_type == 'cspm_type1')
					$parameter = array( 'style' => "width:100px; height:80px;" );
				elseif($infobox_type == 'cspm_type2')
					$parameter = array();
				elseif($infobox_type == 'cspm_type3')
					$parameter = array( 'style' => "width:60px; height:40px;" );
				elseif($infobox_type == 'cspm_type4')
					$parameter = array();
						
				if($infobox_type == 'square_bubble' || $infobox_type == 'rounded_bubble'){
					$post_thumbnail = get_the_post_thumbnail($post_id, 'cspacing-marker-thumbnail', $parameter);
					if(empty($post_thumbnail))
				    	$post_thumbnail = get_the_post_thumbnail($post_id, 'cspacing-horizontal-thumbnail', $parameter);
				}else $post_thumbnail = get_the_post_thumbnail($post_id, 'cspacing-horizontal-thumbnail', $parameter);
	
			}
			
			$this->infobox_external_link = $this->cspm_get_setting('infoboxsettings', 'infobox_external_link', 'same_window');
			
			$target = ($this->infobox_external_link == 'new_window') ? ' target="_blank"' : ''; 
			
			$output = '';
			
			$output .= '<div class="cspm_infobox_content_container '.$status.' infobox_'.$map_id.' '.$infobox_type.'">';
				
				if($infobox_type == 'square_bubble' || $infobox_type == 'rounded_bubble'){
					
					$output .= '<div class="cspm_infobox_img"><a href="'.$the_permalink.'" title="'.$item_title.'"'.$target.'>'.$post_thumbnail.'</a></div>';
					$output .= '<div class="cspm_arrow_down '.$infobox_type.'"></div>';
					
				}elseif($infobox_type == 'cspm_type1'){
					
					$output .= '<div class="cspm_infobox_img">'.$post_thumbnail.'</div>';
					$output .= '<div class="cspm_infobox_content">';
						$output .= '<div class="title"><a href="'.$the_permalink.'" title="'.$item_title.'"'.$target.'>'.$item_title.'</a></div>';
						$output .= '<div class="description">'.$item_description.'</div>';
					$output .= '</div>';
					$output .= '<div style="clear:both"></div>';
					$output .= '<div class="cspm_arrow_down"></div>';
					
				}elseif($infobox_type == 'cspm_type2'){
									
					$output .= '<div class="cspm_infobox_img">'.$post_thumbnail.'</div>';
					$output .= '<div class="cspm_infobox_content">';
						$output .= '<div class="title"><a href="'.$the_permalink.'" title="'.$item_title.'"'.$target.'>'.$item_title.'</a></div>';
					$output .= '</div>';
					$output .= '<div class="cspm_arrow_down"></div>';
					
				}elseif($infobox_type == 'cspm_type3'){
									
					$output .= '<div class="cspm_infobox_img">'.$post_thumbnail.'</div>';
					$output .= '<div class="cspm_infobox_content">';
						$output .= '<div class="title"><a href="'.$the_permalink.'" title="'.$item_title.'"'.$target.'>'.$item_title.'</a></div>';
					$output .= '</div>';
					$output .= '<div class="cspm_arrow_down"></div>';
					
				}elseif($infobox_type == 'cspm_type4'){
									
					$output .= '<div class="cspm_infobox_content">';
						$output .= '<div class="title"><a href="'.$the_permalink.'" title="'.$item_title.'"'.$target.'>'.$item_title.'</a></div>';
					$output .= '</div>';
					$output .= '<div class="cspm_arrow_down"></div>';
					
				}
			
			$output .= '</div>';
			
			die($output);
			
		}
		
		function cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug = '', $faceted_search_tax_terms = array()){
			
			$output = '';
				
			// This dot appears when the pin is fired
			$output .= '<div id="pulsating_holder" class="'.$map_id.'_pulsating"><div class="dot"></div></div>';
	
			// Infobox
			if($this->show_infobox == 'true' && $this->infobox_display_event != 'onload')
				$output .= $this->cspm_infobox($this->infobox_type, 'single', $map_id);
			
			// Zoom Control
			if($this->zoomControl == 'true' && $this->zoomControlType == 'customize'){
															
				$output .= '<div class="codespacing_zoom_container">';
					$output .= '<div class="codespacing_map_zoom_in_'.$map_id.'"></div>';
					$output .= '<div class="codespacing_map_zoom_out_'.$map_id.'"></div>';
				$output .= '</div>';
			
			}
			
			// Faceted search
			if($faceted_search == "yes" && $this->faceted_search_option == "true" && $this->marker_cats_settings == "true")
				$output .= $this->cspm_faceted_search($map_id, $carousel, $faceted_search_tax_slug, $faceted_search_tax_terms);
			
			// Search form
			if($search_form == "yes" && $this->search_form_option == "true")
				$output .= $this->cspm_search_form($map_id, $carousel);
			
			// Cluster Posts widget	
			$output .= '<div class="cluster_posts_widget_'.$map_id.'"></div>';
			
			return $output;
							
		}
		
		// Map-up, Carousel-down layout
		function cspm_map_up_carousel_down_layout($map_height, $carousel_height, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array()){
			
			$output = '<div class="row" style="margin:0; padding:0;">';
										
				// Map
				$output .= '<div style="position:relative; overflow:hidden;">';
				
					// Interface elements
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
					
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="col col-lg-12 col-xs-12 col-sm-12 col-md-12" style="height:'.$map_height.';"></div>';
				
				$output .= '</div>';
									
				// Carousel
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
					
					$output .= '<div id="codespacing_progress_map_carousel_container" class="col col-lg-12 col-xs-12 col-sm-12 col-md-12" style="margin:0; padding:0; height:auto;">';
					
						$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
					
					$output .= '</div>';
				
				}
				
			$output .= '</div>';
			
			return $output;
			
		}
		
		// Map-down, Carousel-up layout
		function cspm_map_down_carousel_up_layout($carousel_height, $map_height, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array()){
			
			$output = '<div class="row" style="margin:0; padding:0">';
				
				// Carousel
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
					
					$output .= '<div id="codespacing_progress_map_carousel_container" class="col col-lg-12 col-xs-12 col-sm-12 col-md-12" style="margin:0; padding:0; height:auto;">';
						
						$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
					
					$output .= '</div>';
					
				}
														
				// Map
				$output .= '<div style="position:relative; overflow:hidden;">';
		
					// Interface elements
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
					
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="col col-lg-12 col-xs-12 col-sm-12 col-md-12" style="height:'.$map_height.';"></div>';
				
				$output .= '</div>';
								
			$output .= '</div>';
			
			return $output;
			
		}
		
		// Map-right, Carousel-left layout	
		function cspm_map_right_carousel_left_layout($carousel_width, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array()){
			
			$output = '<div style="width:100%; height:100%; margin:0; padding:0;">';
				
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
					
					$map_width = 'auto';
					$margin_left = 'margin-left:'.($carousel_width+20).'px;';
					
				}else{
					
					$map_width = '100%';
					$margin_left = '';
					
				}
				
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){ 
					
					// Carousel
					$output .= '<div id="codespacing_progress_map_carousel_container" style="position:absolute; width:auto; height:auto;">';
						
						$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="width:'.$carousel_width.'px; height:'.$this->layout_fixed_height.'px"></ul>';
					
					$output .= '</div>';
					
				}
				
				// Map
				$output .= '<div style="height:'.$this->layout_fixed_height.'px; width:'.$map_width.'; position:relative; overflow:hidden; '.$margin_left.'">';
				
					// Interface elements
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
					
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="gmap3" style="width:100%; height:100%"></div>';
				
				$output .= '</div>';
								
			$output .= '</div>';
			
			return $output;
			
		}
		
		// Map-left, Carousel-right layout	
		function cspm_map_left_carousel_right_layout($carousel_width, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array()){
			
			$output = '<div style="width:100%; height:100%; margin:0; padding:0;">';
				
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
					
					$map_width = 'auto';
					$margin_right = 'margin-right:'.($carousel_width+20).'px;';
					
				}else{
					
					$map_width = '100%';
					$margin_right = '';
					
				}
				
				if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
					
					// Carousel
					$output .= '<div id="codespacing_progress_map_carousel_container" style="float:right; width:auto; height:auto;">';
						
						$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="width:'.$carousel_width.'px; height:'.$this->layout_fixed_height.'px"></ul>';
					
					$output .= '</div>';
					
				}
				
				// Map
				$output .= '<div style="height:'.$this->layout_fixed_height.'px; width:'.$map_width.'; position:relative; overflow:hidden; '.$margin_right.'">';
				
					// Interface elements
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
					
					// Map
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="gmap3" style="width:100%; height:100%"></div>';
				
				$output .= '</div>';
				
			$output .= '</div>';
			
			return $output;
			
		}
		
		// Fullscreen & Fit in map
		// @since 2.0
		function cspm_only_map_layout($map_id, $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array()){
			
			$output = '';
			
			// Interface elements
			$output .= $this->cspm_map_interface_element($map_id, "no", $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
			
			// Map		
			$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="gmap3" style="width:100%; height:100%"></div>';
			
			return $output;
			
		}
		
		// Map-up, Carousel-over layout
		// @since 2.3
		function cspm_map_up_carousel_over_layout($map_height, $carousel_height, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array()){
			
			$output = '<div class="row" style="margin:0; padding:0">';
				
				// Map Container
				$output .= '<div style="position:relative">';
										
					// Interface elements
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
				
					// Carousel
					if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
						
						$output .= '<div id="codespacing_progress_map_carousel_container" class="codespacing_progress_map_carousel_on_top col col-lg-12 col-xs-12 col-sm-12 col-md-12">';
						
							$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
						
						$output .= '</div>';
					
					}
					
					// Map
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="col col-lg-12 col-xs-12 col-sm-12 col-md-12" style="height:'.$map_height.'"></div>';
				
				$output .= '</div>';
				
			$output .= '</div>';
			
			return $output;
			
		}
		
		// Fullscreen & Fit in map with carousel
		// @since 2.3
		function cspm_full_map_carousel_over_layout($map_id, $carousel = "yes", $faceted_search = "yes", $carousel_height, $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array()){
			
			$output = '';
			
			// Interface elements
			$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
					
			// Carousel
			if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
				
				$output .= '<div id="codespacing_progress_map_carousel_container" class="codespacing_progress_map_carousel_on_top col col-lg-12 col-xs-12 col-sm-12 col-md-12">';
				
					$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
				
				$output .= '</div>';
			
			}
			
			// Map
			$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="gmap3" style="width:100%; height:100%"></div>';
					
			return $output;
			
		}
		
		// Map, Toggle-Carousel-bottom layout
		// @since 2.4
		function cspm_map_toggle_carousel_bottom_layout($map_height, $carousel_height, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array()){
			
			$output = '<div class="row" style="margin:0; padding:0">';
				
				// Map Container
				$output .= '<div style="position:relative">';
										
					// Interface elements
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
				
					// Carousel
					if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
						
						$output .= '<div class="cspm_toggle_carousel_horizontal_bottom col col-lg-12 col-xs-12 col-sm-12 col-md-12">';
								
							$output .= '<div class="toggle-carousel-bottom" data-map-id="'.$map_id.'">Toggle carousel</div>';
							
							$output .= '<div id="codespacing_progress_map_carousel_container" style="display:none;">';
								
								$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
								 
							$output .= '</div>';
						
						$output .= '</div>';
					
					}
				
					// Map
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="col col-lg-12 col-xs-12 col-sm-12 col-md-12" style="height:'.$map_height.'"></div>';
				
				$output .= '</div>';
				
			$output .= '</div>';
			
			return $output;
			
		}
		
		// Map, Toggle-Carousel-top layout
		// @since 2.4
		function cspm_map_toggle_carousel_top_layout($map_height, $carousel_height, $map_id, $carousel = "yes", $faceted_search = "yes", $search_form = "yes", $faceted_search_tax_slug = '', $faceted_search_tax_terms = array()){
			
			$output = '<div class="row" style="margin:0; padding:0">';
				
				// Map Container
				$output .= '<div style="position:relative">';
											
					// Interface elements
					$output .= $this->cspm_map_interface_element($map_id, $carousel, $faceted_search, $search_form, $faceted_search_tax_slug, $faceted_search_tax_terms);
				
					// Carousel
					if($this->show_carousel == 'true' && $carousel == "yes" && !$this->cspm_detect_mobile_browser()){
						
						$output .= '<div class="cspm_toggle_carousel_horizontal_top col col-lg-12 col-xs-12 col-sm-12 col-md-12">';
							
							$output .= '<div id="codespacing_progress_map_carousel_container" style="display:none;">';
								
								$output .= '<ul id="codespacing_progress_map_carousel_'.$map_id.'" class="jcarousel-skin-default" style="height:'.$carousel_height.'px;"></ul>';
								 
							$output .= '</div>';
								
							$output .= '<div class="toggle-carousel-top" data-map-id="'.$map_id.'">Toggle carousel</div>';
							
						$output .= '</div>';
					
					}
					
					// Map
					$output .= '<div id="codespacing_progress_map_div_'.$map_id.'" class="col col-lg-12 col-xs-12 col-sm-12 col-md-12" style="height:'.$map_height.'"></div>';
				
				$output .= '</div>';
				
			$output .= '</div>';
			
			return $output;
			
		}
		
		// @since 2.1
		function cspm_posts_count_clause($count, $map_id){
			
			$posts_count_clause = $this->cspm_wpml_get_string('Posts count clause', $this->posts_count_clause);
			
			return str_replace('[posts_count]', '<span class="the_count_'.$map_id.'">'.$count.'</span>', esc_attr($posts_count_clause));
			
		}
		
		// Get Images for marker by category
		// @since 2.1
		function cspm_marker_categories(){
							
			$marker_taxonomy = $this->marker_taxonomies;		
			
			$taxonomies_fields = array();
			
			if(!empty($marker_taxonomy)){
				
				$terms = get_terms($marker_taxonomy, "hide_empty=0");
				
				if(count($terms) > 0){			  
					foreach($terms as $term){			   											
						if(isset($this->settings['codespacingprogressmap_markercategoriessettings_marker_category_'.$term->term_id.'']))
							$taxonomies_fields['marker_categories']['marker_category_'.$term->term_id.''] = $this->settings['codespacingprogressmap_markercategoriessettings_marker_category_'.$term->term_id.''];
					}
				}	
				
			}
			
			if(array_key_exists('marker_categories', $taxonomies_fields))
				$taxonomies_fields = $taxonomies_fields + array('count_marker_categories' => count($taxonomies_fields['marker_categories']));	
			else $taxonomies_fields = $taxonomies_fields + array('count_marker_categories' => 0);	
			
			return $taxonomies_fields;
			
		}
		
		// Get marker image when markers are displayed by category
		// @since 2.4
		// Depricated @since 2.5
		function cspm_get_marker_img($tax_name, $term_id){
			
			$marker_image = $this->marker_icon;

			$markers_images_object = json_decode($this->cspm_get_setting('markercategoriessettings', 'marker_category_'.$tax_name.'', ''));
			
			if(is_object($markers_images_object) && count($markers_images_object) > 0){
				
				if(isset($markers_images_object->$term_id)){
					$marker_object = $markers_images_object->$term_id;
					if(isset($marker_object->tag_marker_img_path))
						$marker_image = $marker_object->tag_marker_img_path;
				}
				
			}
			
			return $marker_image;
			
		}
		
		// Get image path from its URL
		// @since 2.4
		function cspm_get_image_path_from_url($url){
			
			if(!empty($url)){
				
				$exploded_url = explode('wp-content', $url);
				
				if(isset($exploded_url[1]))
					return WP_CONTENT_DIR.$exploded_url[1];
				
				else return false;		
				
			}else return false;
				
		}
		
		// Get image size by image URL
		// @since 2.4
		function cspm_get_image_size($url, $retina = "false"){
			
			if(!empty($url)){
				
				$img_size = getimagesize($url);
				
				if(isset($img_size[0]) && isset($img_size[1])){
					
					return $retina == "false" ? $img_size[0].'x'.$img_size[1] : ($img_size[0]/2).'x'.($img_size[1]/2);
					
				}else return '';
	
			}else return '';
			
		}
		
		// Load the markers clustred inside a small area on the map
		// @since 2.5
		function cspm_load_clustred_markers_list(){
			
			$post_ids = $_POST['post_ids'];
			$light_map = esc_attr($_POST['light_map']);
	
			$this->items_title = $this->cspm_get_setting('itemssettings', 'items_title');
			$this->infobox_external_link = $this->cspm_get_setting('infoboxsettings', 'infobox_external_link', 'same_window');
					
			$output = '<ul class="cluster_posts_widget_arrow">';
			
				foreach($post_ids as $post_id){
					
					$item_title = stripslashes_deep($this->cspm_items_title($post_id, $this->items_title)); 
					
					$parameter = array(
						'style' => "width:55px; height:55px;"
					);
					
					$post_thumbnail = get_the_post_thumbnail($post_id, 'cspacing-marker-thumbnail', $parameter);
					$the_permalink  = ($light_map == 'true') ? ' href="'.$this->cspm_get_permalink($post_id).'"' : '';
					$the_permalink .= ($light_map == 'true' && $this->infobox_external_link == 'new_window') ? ' target="_blank"' : '';
					
					$output .= '<li id="'.$post_id.'">';
						$output .= $post_thumbnail;
						$output .= '<a'.$the_permalink.'>'.$item_title.'</a>';
						$output .= '<div style="clear:both"></div>';
					$output .= '</li>';
		
				}
			
			$output .= '</ul>';
			
			die($output);
			
		}
		
		// Create the faceted search form to filter markers and posts
		// @since 2.1
		function cspm_faceted_search($map_id, $carousel = "yes", $faceted_search_tax_slug, $faceted_search_tax_terms){
		
			$output = '';
			
			$output .= '<div class="faceted_search_btn" id="'.$map_id.'"></div>';
			
			$output .= '<div class="reset_map_list_'.$map_id.'" id="'.$map_id.'"></div>';
			
			$output .= '<div class="faceted_search_container_'.$map_id.'">';
				
				$output .= '<form action="" method="post" class="faceted_search_form'.apply_filters('faceted_search_form_class', '').'" id="faceted_search_form_'.$map_id.'">';
					
					$output .= '<input type="hidden" name="map_id" value="'.$map_id.'" />';
					$output .= '<input type="hidden" name="show_carousel" value="'.$carousel.'" />';
					
					$output .= '<ul>';
	
						// Get the taxonomy name from the marker categories settings				
						if(isset($faceted_search_tax_slug)){
								
							// Get Taxonomy Name
							$tax_name = $faceted_search_tax_slug;
							
							if($tax_name == $this->marker_taxonomies){
								
								if(isset($this->settings['codespacingprogressmap_facetedsearchsettings_faceted_search_taxonomy_'.$tax_name.'']))
									$terms = $this->settings['codespacingprogressmap_facetedsearchsettings_faceted_search_taxonomy_'.$tax_name.''];
								else $terms = array();							
								
							}else $terms = $faceted_search_tax_terms;
								
							if(is_array($terms) && count($terms) > 0){
								
								foreach($terms as $term_id){
									
									// For WPML =====
									$term_id = $this->cspm_wpml_object_id($term_id, $tax_name, false);
									// @For WPML ====
								
									$term = get_term($term_id, $tax_name);
									
									if($this->faceted_search_multi_taxonomy_option == 'true'){
										
										$output .= '<li>';				
											$output .= '<input type="checkbox" name="'.$tax_name.'___'.$term_id.'[]" id="'.$map_id.'_'.$tax_name.'___'.$term_id.'" value="'.$term_id.'" class="faceted_input '.$map_id.' '.$carousel.'">';
											$output .= '<label for="'.$map_id.'_'.$tax_name.'___'.$term_id.'">'.$term->name.'</label>';
											$output .= '<div style="clear:both"></div>';												
										$output .= '</li>';
										
									}else{
										
										$output .= '<li>';				
											$output .= '<input type="radio" name="'.$tax_name.'" id="'.$map_id.'_'.$tax_name.'_'.$term_id.'" value="'.$term_id.'" class="faceted_input '.$map_id.' '.$carousel.'">';
											$output .= '<label for="'.$map_id.'_'.$tax_name.'_'.$term_id.'">'.$term->name.'</label>';
											$output .= '<div style="clear:both"></div>';												
										$output .= '</li>';
										
									}
									
								}
								
							}
							
						}
											
					$output .= '</ul>';
								
				$output .= '</form>';			
			
			$output .= '</div>';
			
			return $output;
			
		}
		
		// Create the search form
		// @since 2.4
		function cspm_search_form($map_id, $carousel = "yes"){
	
			$distance_unit = ($this->sf_distance_unit == 'metric') ? "Km" : "Miles";
			$search_distances = explode(',', $this->sf_search_distances);
			$default_distance = (isset($search_distances[0])) ? $search_distances[0] : "3";
			
			// @WPML String translate
			$address_placeholder = $this->cspm_wpml_get_string('Address field placeholder', $this->address_placeholder);
			$slider_label = $this->cspm_wpml_get_string('Expand the search area up to', $this->slider_label);
			$no_location_msg = $this->cspm_wpml_get_string('We could not find any location', $this->no_location_msg);
			$bad_address_msg = $this->cspm_wpml_get_string('We could not understand the location', $this->bad_address_msg);
			$bad_address_sug_1 = $this->cspm_wpml_get_string('- Make sure all street and city names are spelled correctly.', $this->bad_address_sug_1);
			$bad_address_sug_2 = $this->cspm_wpml_get_string('- Make sure your address includes a city and state.', $this->bad_address_sug_2);
			$bad_address_sug_3 = $this->cspm_wpml_get_string('- Try entering a zip code.', $this->bad_address_sug_3);			
			$submit_text = $this->cspm_wpml_get_string('Find it', $this->submit_text);
			
			$output = '';
			
			$output .= '<div class="search_form_btn" id="'.$map_id.'"></div>';
			
			$output .= '<div class="search_form_container_'.$map_id.'">';
			
				$output .= '<div class="cspm_search_form_notice">'.$no_location_msg.'</div>';
				
				$output .= '<div class="cspm_search_form_error"><strong>'.$bad_address_msg.'</strong><ul><li>'.$bad_address_sug_1.'</li><li>'.$bad_address_sug_2.'</li><li>'.$bad_address_sug_3.'</li></ul></div>';
				
				$output .= '<form action="" method="post" class="search_form'.apply_filters('search_form_class', '').'" id="search_form_'.$map_id.'" onsubmit="return false;">';
					
					$output .= '<input type="text" name="cspm_address" id="cspm_address" value="" placeholder="'.$address_placeholder.'" />';
					
					$output .= '<div class="" style="width:auto; border:1px solid #f1f1f1; box-sizing:border-box; margin-top:5px;">';
						$output .= '<div style="background:#f1f1f1; padding:0 5px 3px 5px;">';
							$output .= '<label>'.$slider_label.'</label>';
						$output .= '</div>';
						$output .= '<div style="width:auto; margin-top:5px; padding:5px;">';
							$output .= '<input type="text" name="cspm_distance" class="cspm_sf_slider_range" data-min="'.min($search_distances).'" data-max="'.max($search_distances).'" data-postfix=" '.$distance_unit.'" />';
							$output .= '<input type="hidden" name="cspm_distance_unit" value="'.$this->sf_distance_unit.'" />';
						$output .= '</div>';
					$output .= '</div>';
									
					$output .= '<div class="cspm_submit_search_form_'.$map_id.'" data-map-id="'.$map_id.'" data-show-carousel="'.$carousel.'">'.$submit_text.'</div>';
					$output .= '<div class="cspm_reset_search_form_'.$map_id.'" data-map-id="'.$map_id.'" data-show-carousel="'.$carousel.'">Reset</div>';
					$output .= '<div class="cspm_loader_search_form_'.$map_id.'" style="display:none"><div class="cloud"></div></div>';
	
				$output .= '</form>';	
			
			$output .= '</div>';
			
			return $output;
			
		}
		
		// Detect mobile browser
		// @since 2.4
		function cspm_detect_mobile_browser(){
			
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			
			if($this->layout_type == 'responsive'){
					
				if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
					
					return true;
					
				}else return false;
			
			}else return false;
			
		}
		
		// Run some settings updates to sync. with the lateset version
		// @since 2.4
		function cspm_sync_settings_for_latest_version(){
			
			$new_settings = $this->settings;

			/**
			 * Update the taxonomy terms settings
			 * Store all terms in one setting row instead of seperated rows	 
			 * @since 2.4
			*/
			
			$post_taxonomies = (array) get_object_taxonomies($this->post_type, 'objects');
			
			// Loop throught taxonomies		
			foreach($post_taxonomies as $single_taxonomie){
				
				// Get Taxonomy Name
				$tax_name = $single_taxonomie->name;
				
				// Get all terms related to this taxonomy
				$terms = get_terms($tax_name, "hide_empty=0");
					
				// Loop throught terms
				if(count($terms) > 0){			  								  
					
					$taxonomy_term_ids = $fs_taxonomy_term_ids = array();
					
					foreach($terms as $term){
						
						$term_id = $term->term_id;
						
						// Taxonomies
						if(isset($this->settings['codespacingprogressmap_generalsettings_taxonomie_'.$tax_name.'_'.$term_id])){
							$term_name = $this->settings['codespacingprogressmap_generalsettings_taxonomie_'.$tax_name.'_'.$term_id];
							if($term_name != '0') $taxonomy_term_ids[] = $term_id;
						}
						
						// Faceted search terms
						if(isset($this->settings['codespacingprogressmap_facetedsearchsettings_faceted_search_taxonomy_'.$tax_name.'_'.$term_id])){
							$term_name = $this->settings['codespacingprogressmap_facetedsearchsettings_faceted_search_taxonomy_'.$tax_name.'_'.$term_id];					
							if($term_name != '0') $fs_taxonomy_term_ids[] = $term_id;
						}
									
					}		
				
					if(count($taxonomy_term_ids) > 0)
						$new_settings['codespacingprogressmap_generalsettings_taxonomie_'.$tax_name.''] = $taxonomy_term_ids;
					
					if(count($fs_taxonomy_term_ids) > 0)
						$new_settings['codespacingprogressmap_facetedsearchsettings_faceted_search_taxonomy_'.$tax_name.''] = $fs_taxonomy_term_ids;
											
				}
				
			}
			
			
			/**
			 * Update the marker categories settings
			 * Store all marker images in one setting row instead of seperated rows	 
			 * @since 2.5
			*/
				
			// Get Taxonomy Name
			if(isset($new_settings['codespacingprogressmap_markercategoriessettings_marker_taxonomies'])){

				$marker_tax_name = $new_settings['codespacingprogressmap_markercategoriessettings_marker_taxonomies'];
				
				if(!empty($marker_tax_name)){
					
					// Get all terms related to this taxonomy
					$terms = get_terms($marker_tax_name, "hide_empty=0");
						
					// Loop throught terms
					if(count($terms) > 0){			  								  
						
						$taxonomy_term_ids = array();
	
						foreach($terms as $term){
							
							$term_id = $term->term_id;
							
							// Marker categories
							if(isset($this->settings['codespacingprogressmap_markercategoriessettings_marker_category_'.$term_id])){
								$term_name = $this->settings['codespacingprogressmap_markercategoriessettings_marker_category_'.$term_id];
								if(!empty($term_name) && $term_name != '0') $taxonomy_term_ids[$term_id] = array('tag_marker_img_label' => $term->name,
																						   'tag_marker_img_name' => $term_id,
																						   'tag_marker_img_category' => $term_id,
																						   'tag_marker_img_path' => $this->cspm_get_setting('markercategoriessettings', 'marker_category_'.$term_id.'', $this->marker_icon)
																						   );
							}						
										
						}		
					
						if(count($taxonomy_term_ids) > 0)
							$new_settings['codespacingprogressmap_markercategoriessettings_marker_category_'.$marker_tax_name.''] = json_encode($taxonomy_term_ids);
	
					}
					
				}

			}
			
			// Update settings
			if(count($new_settings) > 0){

				$new_settings_array = $new_settings;
				
				$opt_group = preg_replace("/[^a-z0-9]+/i", "", basename($this->plugin_path .'settings/codespacing-progress-map.php', '.php'));
				
				update_option($opt_group.'_settings', $new_settings_array);	
				
			}
			
		}
		
		// AJAX function
		// Get all posts and create a JSON array of markers base on the ...
		// ... custom fields latitude & longitude + Secondary lat & lng
		// @since 2.5
		function cspm_create_markers_array_for_latest_version(){
			
			$post_types = (!empty($this->secondary_post_type)) ? array_merge(array($this->post_type), explode(',', str_replace(' ', '', $this->secondary_post_type)))
															   : array($this->post_type);
												   
			$meta_values = array(CSPM_LATITUDE_FIELD, CSPM_LONGITUDE_FIELD, CSPM_SECONDARY_LAT_LNG_FIELD);
			
			if(count($post_types) > 0){

				$post_types_markers = array();
				
				// Loop throught the post types
				foreach($post_types as $post_type){
					
					$post_types_markers[$post_type] = array();
					
					// Get all the value of the Latitude/Longitude/Secondary coordinates ...
					// ... where each row in the array contains the value of the custom field and ...
					// ... the post id related to
					foreach($meta_values as $meta_value)
						$post_types_markers[$post_type][$meta_value] = $this->cspm_get_meta_values($meta_value, $post_type);
									
					$post_types_markers[$post_type] = array_merge_recursive($post_types_markers[$post_type][CSPM_LATITUDE_FIELD], 
																			$post_types_markers[$post_type][CSPM_LONGITUDE_FIELD],
																			$post_types_markers[$post_type][CSPM_SECONDARY_LAT_LNG_FIELD]);								
																	   
				}
			
				global $wpdb;
				
				$markers_object = $post_taxonomy_terms = array();
				
				// Create the map markers object
				foreach($post_types_markers as $post_type => $posts_and_coordinates){
					
					$i = $j = 0;						
					
					// Get post type taxonomies
					$post_taxonomies = (array) get_object_taxonomies($post_type, 'names');
					
					// Implode taxonomies to use them in the Mysql IN clause	
					$taxonomies = "'" . implode("', '", $post_taxonomies) . "'";
					
					// Directly querying the database is normally frowned upon, but all ...
					// ... of the API functions will return the full post objects which will
					// ... suck up lots of memory. This is best, just not as future proof.				
					$query = "SELECT t.term_id, tt.taxonomy, tr.object_id FROM $wpdb->terms AS t 
								INNER JOIN $wpdb->term_taxonomy AS tt 
									ON tt.term_id = t.term_id 
								INNER JOIN $wpdb->term_relationships AS tr 
									ON tr.term_taxonomy_id = tt.term_taxonomy_id 
								WHERE tt.taxonomy IN ($taxonomies)";
					
					// Run the query. This will get an array of all terms where each term ...
					// ... is listed with the taxonomy name and the post id
					$taxonomy_terms_and_posts = $wpdb->get_results( $query, ARRAY_A );
					
					// Loop through the terms and order them in a way, the array will have the post_id as key ...
					// ... inside that array, there will be another array with the key == taxonomy name ...
					// ... inside that last array, there will be all the terms of a post
					foreach($taxonomy_terms_and_posts as $term)							
						$post_taxonomy_terms[$term['object_id']][$term['taxonomy']][] = $term['term_id'];
					
					foreach($posts_and_coordinates as $post_id => $post_coordinates){						
						
						if(isset($post_coordinates[CSPM_LATITUDE_FIELD]) && isset($post_coordinates[CSPM_LONGITUDE_FIELD])){
							
							$post_id = str_replace('post_id_', '', $post_id);							
							
							// If a taxonomy is not set in the $post_taxonomy_terms array ...
							// ... it means that the post has no terms available for that taxonomy ...
							// ... but we still need to create an empty array for that taxonomy in order ...
							// ... to use it with faceted search
							foreach($post_taxonomies as $taxonomy_name){
								// Extend the $post_taxonomy_terms array with an empty array of the not existing taxonomy
								if(!isset($post_taxonomy_terms[$post_id][$taxonomy_name]))
									$post_taxonomy_terms[$post_id][$taxonomy_name] = array(); 
							}
							
							$markers_object[$post_type]['post_id_'.$post_id] = array('lat' => $post_coordinates[CSPM_LATITUDE_FIELD],
																					 'lng' => $post_coordinates[CSPM_LONGITUDE_FIELD],
																					 'post_id' => $post_id,
																					 'post_tax_terms' => $post_taxonomy_terms[$post_id],
																					 'is_child' => 'no',
																					 'children_markers' => array()
																					 );
							
							$i++;
							
							// Sencondary latLng
							if(isset($post_coordinates[CSPM_SECONDARY_LAT_LNG_FIELD]) && !empty($post_coordinates[CSPM_SECONDARY_LAT_LNG_FIELD])){
								
								$children_markers = array();
								
								$lats_lngs = explode(']', $post_coordinates[CSPM_SECONDARY_LAT_LNG_FIELD]);	
										
								foreach($lats_lngs as $single_coordinate){
								
									$strip_coordinates = str_replace(array('[', ']', ' '), '', $single_coordinate);
									
									$coordinates = explode(',', $strip_coordinates);
									
									if(isset($coordinates[0]) && isset($coordinates[1]) && !empty($coordinates[0]) && !empty($coordinates[1])){
										
										$lat = $coordinates[0];
										$lng = $coordinates[1];
										
										$children_markers[] = array('lat' => $lat,
																	'lng' => $lng,
																	'post_id' => $post_id,
																	'post_tax_terms' => $post_taxonomy_terms,
																	'is_child' => 'yes_'.$j.''
																	);
																														
										$lat = '';
										$lng = '';
										$j++;
									
									} 
									
									$i++;
									
								}
								
								$markers_object[$post_type]['post_id_'.$post_id]['children_markers'] = $children_markers;
							
							}								
																																					
						}
						
					}
					
				}
														
				// Update settings
				if(count($markers_object) > 0){
					delete_option('cspm_markers_array');					
					update_option('cspm_markers_array', $markers_object);
				}
			
			}

			die();
			
		}
		
		// Get All Values For A Custom Field Key 
		// @key: The meta_key of the post meta
		// @type: The name of the custom post type
		// @since 2.5 
		function cspm_get_meta_values( $key = '', $post_type = 'post' ) {
			
			global $wpdb;
			
			if( empty( $key ) )
				return;
			
			$rows = $wpdb->get_results( $wpdb->prepare( "
				SELECT pm.meta_value, p.ID FROM {$wpdb->postmeta} pm
				LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
				WHERE pm.meta_key = '%s' 
				AND pm.meta_value != '' 
				AND p.post_type = '%s'
			", $key, $post_type ), ARRAY_A );
			
			$results = array();
			
			foreach($rows as $row)
				$results['post_id_'.$row['ID']] = array($key => $row['meta_value']);
			
			return $results;
			
		}
		
		function cspm_wpml_object_id($ID, $post_tag, $orginal_val = true, $lang_code = ""){
			
			/*if(function_exists('icl_object_id')){
				
				if(empty($lang_code)) $lang_code = ICL_LANGUAGE_CODE;
				$object_id = icl_object_id($ID, $post_tag, $orginal_val, $lang_code);
				
			}else $object_id = $ID;
					
			return $object_id;*/return $ID;
			
		}
			
		function cspm_wpml_default_lang(){
				
			/*if(function_exists('icl_object_id')){
			
				global $sitepress;
			
				return $sitepress->get_default_language();
			
			}else*/ return '';
			
		}
		
		// Register strings for WPML 
		// @since 2.5
		function cspm_wpml_register_string($name, $value){
					
			//if(function_exists('icl_register_string')) icl_register_string('Progress map by Codespacing', $name, $value);
			
		}
		
		// Get registred string from WPML DBB
		// @since 2.5
		function cspm_wpml_get_string($name, $value){
				
			/*if(function_exists('icl_t')){
				
				return icl_t('Progress map by Codespacing', $name, $value);
			
			}else */return $value;
			
		}
		
		function cspm_before_settings(){	
	
			global $wpsf_settings;
								
			$sections = array();
	
			echo '<div class="codespacing_container" style="padding:0px; margin-top:30px; height:auto; width:761px; position:relative;">';
				
				echo '<div class="cspm_admin_square_loader"></div>';
				
				echo '<div class="codespacing_header"><img src="'.$this->plugin_url.'img/progress-map.png" /></a></div>';
				
				echo '<div class="codespacing_menu_container" style="width:auto; float:left; height:auto;">';
					
					echo '<ul class="codespacing_menu">';
						
						if(!empty($wpsf_settings)){
							
							usort($wpsf_settings, array(&$this->cspm_wpsf, 'cspm_sort_array'));
							
							$first_section = $wpsf_settings[0]['section_id'];
							
							foreach($wpsf_settings as $section){
								
								if(isset($section['section_id']) && isset($section['section_title'])){
									
									echo '<li class="codespacing_li" id='.$section['section_id'].'>'.$section['section_title'].'</li>';
									
									$sections[$section['section_id']] = $section['section_title'];								
									
								}
								
							}
								
						}
					
					echo '</ul>';
					
				echo '</div>';
				 
				echo '<div style="width:500px; height:auto; min-height:570px; padding:10px 30px; float:left; border-left: 1px solid #e8ebec; border-top:0px solid #097faa; background:#f7f8f8 url('.$this->plugin_url.'img/bg.png) repeat;">';	
				
		}
		
		function cspm_after_settings(){
				
				echo '<div class="cspm_admin_btm_square_loader"></div>';
				
				echo '</div>';
				
				echo '<div style="clear:both"></div>';
				
			echo '</div>';	
			
			echo '<div class="codespacing_rates_fotter"><a target="_blank" href="http://codecanyon.net/item/progress-map-wordpress-plugin/5581719"><img src="'.$this->plugin_url.'img/rates.jpg" /></a></div>';
			
			echo '<div class="codespacing_copyright">&copy; All rights reserved Codespacing. Progress Map 2.6.0</div>';
			
			echo '<div class="codespacing_copyright">&copy; <a target="_blank" href="https://www.freevectormaps.com/world-maps/WRLD-EPS-01-0002?ref=atr">Map of World with Regions - Single Color</a> by <a target="_blank" href="https://www.freevectormaps.com/?ref=atr">FreeVectorMaps.com</a></div>';

		}
		
	}

}	

if( class_exists( 'CodespacingProgressMap' ) )
	new CodespacingProgressMap();
	
