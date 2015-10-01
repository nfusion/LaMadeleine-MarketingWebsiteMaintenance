<?php

global $wpsf_settings;

// Statuses
	$statuses = get_post_stati();

// Users
	$blogusers = get_users(array('fields' => 'all'));
	$authors_array = array();
	foreach($blogusers as $user){	
		$authors_array[$user->ID] = $user->user_nicename.' ('.$user->user_email.')';
	}


// Map styles

	$map_styles = $map_styles_array = array();
	
	if(file_exists(plugin_dir_path( __FILE__ ).'map-styles.php')){
		
		include_once(plugin_dir_path( __FILE__ ).'map-styles.php');
		
		array_multisort($map_styles);
		
		foreach($map_styles as $key => $value){
			$value_output  = '';
			$value_output .= empty($value['new']) ? '' : ' <sup class="cspm_new_tag" style="margin:0 5px 0 -2px;">New</sup>';		
			$value_output .= $value['title'];				
			$value_output .= empty($value['demo']) ? '' : ' <sup class="cspm_demo_tag"><a href="'.$value['demo'].'" target="_blank"><small>Demo</small></a></sup>';
			$map_styles_array[$key] = $value_output;
		}
		
	}

// General Settings section

$wpsf_settings[] = array(
    'section_id' => 'generalsettings',
    'section_title' => 'Query Settings',
    'section_description' => 'Filter your posts by controlling the parameters below to your needs. You can always get the information you want without actually dealing with any parameter.',
    'section_order' => 1,
    'fields' => array(
        array(
            'id' => 'post_type',
            'title' => 'Main content type name',
            'desc' => 'Enter for which content types Progress Map should be available during post creation/editing. (Default:post)',
            'type' => 'text',
            'std' => 'post',
        ),	
        array(
            'id' => 'secondary_post_type',
            'title' => 'Secondary content types names',
            'desc' => 'Enter the other content types names (separated by comma) Progress Map should be available during post creation/editing. Those entred here wont be used in the main query, you can call them later in the other instances of the map.',
            'type' => 'text',
            'std' => '',
        ),					
        array(
            'id' => 'number_of_items',
            'title' => 'Number of items', 
            'desc' => 'Enter the number of items to show on the map. Leave this field empty to get all items.',
            'type' => 'text',
            'std' => '',
        ),		
		array(
            'id' => 'taxonomies_section',
            'title' => '<span class="section_sub_title">Taxonomy Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
			'id' => 'taxonomy_relation_param',
			'title' => '"Relation" parameter', 
			'desc' => 'Select the relationship between taxonomy queries. Default is "AND". <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters" target="_blank">More</a>',
			'type' => 'radio',
			'std' => 'AND',
			'choices' => array(
				'AND' => 'AND',
				'OR' => 'OR',
			)
		),	
		array(
            'id' => 'status_section',
            'title' => '<span class="section_sub_title">Status Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
        array(
            'id' => 'items_status',
            'title' => 'Status', 
            'desc' => 'Show posts associated with certain status. Default is "publish". <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Status_Parameters" target="_blank">More</a>',
            'type' => 'checkboxes',
            'std' => '',
			'choices' => $statuses
        ),	
		array(
            'id' => 'custom_fields_section',
            'title' => '<span class="section_sub_title">Custom Fields Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),
        array(
            'id' => 'custom_fields',
            'title' => 'Custom fields', 
            'desc' => 'Show posts associated with a certain custom field.
					   <strong>Syntax:</strong> [key:meta_key | value:meta_value | type:meta_type | compare:meta_compare], ...<br />
					   <strong>*key: </strong>(string) - Custom field name.<br />
					   <strong>*value: </strong>(string|array) - Custom field value. (Note: Array support is limited to a compare value of "IN", "NOT IN", "BETWEEN", or "NOT BETWEEN")<br />
					   <strong>*type: </strong>(string) - Custom field type. Possible values are "NUMERIC", "BINARY", "CHAR", "DATE", "DATETIME", "DECIMAL", "SIGNED", "TIME", "UNSIGNED". Default value is "CHAR".<br />
					   <strong>*compare: </strong>Operator to test. Possible values are "=", "!=", ">", ">=", "<", "<=", "LIKE", "NOT LIKE", "IN", "NOT IN", "BETWEEN", "NOT BETWEEN", "EXISTS" (only in WP >= 3.5), and "NOT EXISTS" (also only in WP >= 3.5). Default value is "=".<br />
 					   <strong>1. Example of use:</strong> [key:price | value:5000 | type:numeric | compare:=], [key:bedrooms | value:2 | type:numeric | compare:<=]<br />
   					   <strong>2. Example of use:</strong> [key:price | value:(5000,7000) | type:numeric | compare:BETWEEN]<br />
					   <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters" target="_blank">More</a>',
            'type' => 'textarea',
            'std' => '',
        ),		
		array(
            'id' => 'custom_field_relation_param',
            'title' => '"Relation" parameter', 
            'desc' => 'Select the relationship between the custom fields. Default is "AND". <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'AND',
            'choices' => array(
				'AND' => 'AND',
				'OR' => 'OR'
            )
        ),		
		array(
            'id' => 'post_section',
            'title' => '<span class="section_sub_title">Post Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
        array(
            'id' => 'post_in',
            'title' => 'Post to retrieve', 
            'desc' => 'Use post ids (separated by comma). Specify posts to retrieve. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Post_.26_Page_Parameters" target="_blank">More</a>',
            'type' => 'textarea',
            'std' => '',
        ),
        array(
            'id' => 'post_not_in',
            'title' => 'Post not to retreive', 
            'desc' => 'Use post ids (separated by comma). Specify posts not to retrieve. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Post_.26_Page_Parameters" target="_blank">More</a>',
            'type' => 'textarea',
            'std' => '',
        ),		
		array(
            'id' => 'caching_section',
            'title' => '<span class="section_sub_title">Caching parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),											
        array(
            'id' => 'cache_results',
            'title' => 'Post information cache', 
            'desc' => 'Show Posts without adding post information to the cache. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Caching_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),			
        array(
            'id' => 'update_post_meta_cache',
            'title' => 'Post meta information cache', 
            'desc' => 'Show Posts without adding post meta information to the cache. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Caching_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),							
        array(
            'id' => 'update_post_term_cache',
            'title' => 'Post term information cache', 
            'desc' => 'Show Posts without adding post term information to the cache. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Caching_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
            'id' => 'author_section',
            'title' => '<span class="section_sub_title">Author Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),
        array(
            'id' => 'authors_prefixing',
            'title' => 'Authors condition', 
            'desc' => 'Select "Yes" if you want to display all posts except those from selected authors.<br />
					   Select "No" if you want to display all posts of selected authors.<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),		
        array(
            'id' => 'authors',
            'title' => 'Authors', 
            'desc' => 'Show/Hide posts associated with certain authors. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters" target="_blank">More</a>',
            'type' => 'checkboxes',
            'std' => '',
			'choices' => $authors_array
        ),			
		array(
            'id' => 'order_section',
            'title' => '<span class="section_sub_title">Order & Orderby Parameters</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
        array(
            'id' => 'orderby_param',
            'title' => 'Orderby parameters', 
            'desc' => 'Sort retrieved posts by parameter. Defaults to "date". <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">More</a>',
            'type' => 'select',
            'std' => 'date',
            'choices' => array(
				'none' => 'No order',
				'ID' => 'Order by post id',
				'author' => 'Order by author',
				'title' => 'Order by title',
				'name' => 'Order by post name (post slug)',
				'date' => 'Order by date',
				'modified' => 'Order by last modified date',
				'parent' => 'Order by post/page parent id',
				'rand' => 'Random order',
				'comment_count' => 'Order by number of comments',
				'menu_order' => 'Order by Page Order',
				'meta_value' => 'Order by string meta value',
				'meta_value_num' => 'Order by numeric meta value ',
				'post__in' => 'Preserve post ID order given in the post__in array',
            )
        ),	
        array(
            'id' => 'orderby_meta_key',
            'title' => 'Custom field name', 
            'desc' => 'This field is used only for "Order by string meta value" & "Order by numeric meta value" in "Orderby parameters".',
            'type' => 'text',
            'std' => '',
        ),															
        array(
            'id' => 'order_param',
            'title' => 'Order parameters', 
            'desc' => 'Designates the ascending or descending order of the "orderby" parameter. Defaults to "DESC". <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">More</a>',
            'type' => 'radio',
            'std' => 'DESC',
            'choices' => array(
				'ASC' => 'Ascending order from lowest to highest values',
				'DESC' => 'Descending order from highest to lowest values'
            )
        ),							
	)
		
);

// Layout Settings section

$wpsf_settings[] = array(
    'section_id' => 'layoutsettings',
    'section_title' => 'Layout Settings',
    'section_description' => '',
    'section_order' => 2,
    'fields' => array(
        array(
            'id' => 'main_layout',
            'title' => 'Main layout',
            'desc' => 'Select main layout alignment.',
            'type' => 'radio',
            'std' => 'mu-cd',
            'choices' => array(
				'mu-cd' => 'Map-Up, Carousel-Down',
				'md-cu' => 'Map-Down, Carousel-Up',
				'mr-cl' => 'Map-Right, Carousel-Left',
				'ml-cr' => 'Map-Left, Carousel-Right',
				'fit-in-map' => 'Fit in the box (Map only)',
				'fullscreen-map' => 'Full screen Map (Map only)',
				'm-con' => 'Map with carousel on top',
				'fit-in-map-top-carousel' => 'Fit in the box with carousel on top',
				'fullscreen-map-top-carousel' => 'Full screen Map with carousel on top',
				'map-tglc-top' => 'Map, toggle carousel from top',
				'map-tglc-bottom' => 'Map, toggle carousel from bottom',
				//'map-tglc-left' => 'Map, toggle carousel from left <sup class="cspm_new_tag">New</sup>',
				//'map-tglc-right' => 'Map, toggle carousel from right <sup class="cspm_new_tag">New</sup>',	
            )
        ),		
        array(
            'id' => 'layout_type',
            'title' => 'Layout type',
            'desc' => 'Select main layout type.',
            'type' => 'radio',
            'std' => 'full_width',
            'choices' => array(
                'fixed' => 'Fixed width &amp; Fixed height',
                'full_width' => 'Full width &amp; Fixed height',
				'responsive' => 'Responsive layout <sup>(Hide the carousel on mobile browsers)</sup>'
            )
        ),
        array(
            'id' => 'layout_fixed_width',
            'title' => 'Layout width',
            'desc' => 'Select the width (in pixels) of the layout. (Works only for the fixed layout)',
            'type' => 'text',
            'std' => '700'		
        ),	
        array(
            'id' => 'layout_fixed_height',
            'title' => 'Layout height',
            'desc' => 'Select the height (in pixels) of the layout.',
            'type' => 'text',
            'std' => '600'		
        ),	
	)
		
);


// Map Settings section

$wpsf_settings[] = array(
    'section_id' => 'mapsettings',
    'section_title' => 'Map Settings <sup class="cspm_plus_tag">Plus+</sup>',
    'section_description' => 'The maps displayed through the Google Maps API contain UI elements to allow user interaction with the map. These elements are known as controls and you can include variations of these controls in your Google Maps API application.',
    'section_order' => 3,
    'fields' => array(
		array(
            'id' => 'map_language',
            'title' => 'Map language',
            'desc' => 'Localize your Maps API application by altering default language settings. See also the <a href="https://spreadsheets.google.com/pub?key=p9pdwsai2hDMsLkXsoM05KQ&gid=1" target="_blank">supported list of languages</a>.',
            'type' => 'text',
            'std' => 'en'		
        ),
        array(
            'id' => 'map_center',
            'title' => 'Map center',
            'desc' => 'Enter a center point for the map. (Latitude then Longitude separated by comma). Refer to <a href="https://maps.google.com/" target="_blank">https://maps.google.com/</a> to get you center point.',
            'type' => 'text',
            'std' => '51.53096,-0.121064'		
        ),
        array(
            'id' => 'initial_map_style',
            'title' => 'Initial style',
            'desc' => 'Select the initial map style. If you select "Custom style" you must choose one of the available styles in the section "Map style settings".',
            'type' => 'radio',
            'std' => 'ROADMAP',
            'choices' => array(
				'ROADMAP' => 'Map',
				'SATELLITE' => 'Satellite',
				'TERRAIN' => 'Terrain',
				'HYBRID' => 'Hybrid',
				'custom_style' => 'Custom style'
            )
        ),		
		array(
            'id' => 'map_zoom',
            'title' => 'Map zoom',
            'desc' => 'Select the map zoom.',
            'type' => 'select',
            'std' => '12',
            'choices' => array(
				'0' => '0',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19'
            )
        ),
        array(
            'id' => 'useClustring',
            'title' => 'Clustering',
            'desc' => 'Clustering simplifies your data visualization by consolidating data that are nearby each other on the map in an aggregate form.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
		array(
            'id' => 'gridSize',
            'title' => 'Grid size',
            'desc' => 'Grid size or Grid-based clustering works by dividing the map into squares of a certain size (the size changes at each zoom) and then grouping the markers into each grid square.',
            'type' => 'text',
            'std' => '60'		
        ),			
        array(
            'id' => 'geoIpControl',
            'title' => 'Geo targeting',
            'desc' => 'The Geo targeting is the method of determining the geolocation of a website visitor.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),									
		array(
            'id' => 'ui_elements_section',
            'title' => '<span class="section_sub_title">UI elements</span>',
            'desc' => '',
            'type' => 'custom',
        ),	
        array(
            'id' => 'mapTypeControl',
            'title' => 'Show map type control',
            'desc' => 'The MapType control lets the user toggle between map types (such as ROADMAP and SATELLITE). This control appears by default in the top right corner of the map.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'streetViewControl',
            'title' => 'Show street view control',
            'desc' => 'The Street View control contains a Pegman icon which can be dragged onto the map to enable Street View. This control appears by default in the right top corner of the map.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'scrollwheel',
            'title' => 'Scroll wheel',
            'desc' => 'Allow/Disallow the zoom-in and zoom-out of the map using the scroll wheel.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'panControl',
            'title' => 'Show pan control',
            'desc' => 'The Pan control displays buttons for panning the map. This control appears by default in the right top corner of the map.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'zoomControl',
            'title' => 'Show zoom control',
            'desc' => 'The Zoom control displays a small "+/-" buttons to control the zoom level of the map. This control appears by default in the top left corner of the map on non-touch devices or in the bottom left corner on touch devices.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'zoomControlType',
            'title' => 'Zoom control Type',
            'desc' => 'Select the zoom control type.',
            'type' => 'radio',
            'std' => 'customize',
            'choices' => array(
				'customize' => 'Customized type',
				'default' => 'Default type'
            )
        ),
		array(
            'id' => 'customizations_section',
            'title' => '<span class="section_sub_title">Customizations</span>',
            'desc' => '',
            'type' => 'custom',
        ),		
        array(
            'id' => 'retinaSupport',
            'title' => 'Retina support',
            'desc' => 'Enable retina support for custom markers & Clusters images. When enabled, make sure the uploaded image is twice the size you want it to be displayed in the map. 
			           For example, if you want the marker/cluster image in the map to be displayed at 20x30 pixels, upload an image with 40x60 pixels.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Enable',
				'false' => 'Disable'
            )
        ),																
        array(
            'id' => 'defaultMarker',
            'title' => 'Marker type',
            'desc' => 'Select the marker type.',
            'type' => 'radio',
            'std' => 'customize',
            'choices' => array(
				'customize' => 'Customized type',
				'default' => 'Default type'
            )
        ),	
		array(
            'id' => 'markerAnimation',
            'title' => 'Marker animation <sup class="cspm_new_tag">New</sup>',
            'desc' => 'You can animate a marker so that it exhibit a dynamic movement when it\'s been fired. To specify the way a marker is animated, select
					   one of the supported animations above.',
            'type' => 'radio',
            'std' => 'pulsating_circle',
            'choices' => array(
				'pulsating_circle' => 'Pulsating circle',
				'bouncing_marker' => 'Bouncing marker',
				'flushing_infobox' => 'Flushing infobox <sup>Use only when <strong>Show infobox</strong> is set to <strong>Yes</strong></sup>'				
            )
        ),						
        array(
            'id' => 'marker_icon',
            'title' => 'Marker image',
            'desc' => 'Upload a new marker image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'big_cluster_icon',
            'title' => 'Large cluster image',
            'desc' => 'Upload a new large cluster image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'medium_cluster_icon',
            'title' => 'Medium cluster image',
            'desc' => 'Upload a new medium cluster image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'small_cluster_icon',
            'title' => 'Small cluster image',
            'desc' => 'Upload a new small cluster image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
		array(
            'id' => 'cluster_text_color',
            'title' => 'Clusters text color',
            'desc' => 'Change the text color of all your clusters.',
            'type' => 'color',
            'std' => ''
        ),
        array(
            'id' => 'zoom_in_icon',
            'title' => 'Zoom-in image',
            'desc' => 'Upload a new zoom-in button image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
		array(
            'id' => 'zoom_in_css',
            'title' => 'Zoom-in CSS',
            'desc' => 'Enter your custom CSS to customize the zoom-in button.<br /><strong>e.g.</strong> border:1px solid; ...',
            'type' => 'textarea',
            'std' => ''
        ),					
        array(
            'id' => 'zoom_out_icon',
            'title' => 'Zoom-out image',
            'desc' => 'Upload a new zoom-out button image. You can always find the original marker at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),		
		array(
            'id' => 'zoom_out_css',
            'title' => 'Zoom-out CSS',
            'desc' => 'Enter your custom CSS to customize the zoom-out button.<br /><strong>e.g.</strong> border:1px solid; ...',
            'type' => 'textarea',
            'std' => ''
        ),			
        array(
            'id' => 'show_infowindow',
            'title' => '<del>Show Infobox</del> <sup class="cspm_deprecated_tag">Deprecated</sup>',
            'desc' => 'Show/Hide the Infobox.<br /><span class="cspacing_alert"><small>Use <strong>"Infobox settings" &rarr; "Show infobox"</strong> instead.</small></span>',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
        array(
            'id' => 'infowindow_type',
            'title' => '<del>Infobox type</del> <sup class="cspm_deprecated_tag">Deprecated</sup>',
            'desc' => 'Select the Infobox type. Switch between the two options to see the difference.<br /><span class="cspacing_alert"><small>Use <strong>"Infobox settings" &rarr; "Infobox type"</strong> instead.</small></span>',
            'type' => 'radio',
            'std' => 'bubble_style',
            'choices' => array(
				'content_style' => 'Content style',
				'bubble_style' => 'Bubble style'
            )
        ),													
    )
);
	
// map styles section

$wpsf_settings[] = array(
    'section_id' => 'mapstylesettings',
    'section_title' => 'Map Style Settings <sup class="cspm_plus_tag">Plus+</sup>',
    'section_description' => 'Styled maps allow you to customize the presentation of the standard Google base maps, changing the visual display of such elements as roads, parks, and built-up areas. The lovely styles below are provided by <a href="http://snazzymaps.com" target="_blank">Snazzy Maps</a>',
    'section_order' => 4,
    'fields' => array(
        array(
            'id' => 'style_option',
            'title' => 'Style option', 
            'desc' => 'Select the style option of the map. If you select <strong>Progress map styles</strong>, choose on the available styles bellow.
			           If you select <strong>My custom style</strong>, enter you custom style code in the field <strong>Javascript Style Array</strong>.',
            'type' => 'radio',
            'std' => 'progress-map',
            'choices' => array(
				'progress-map' => 'Progress Map styles',
				'custom-style' => 'My custom style'
            )
        ),			
        array(
            'id' => 'map_style',
            'title' => 'Map style',
            'desc' => 'Select your map style.',
            'type' => 'radio',
            'std' => 'google-map',
            'choices' => $map_styles_array
        ),
		array(
            'id' => 'js_style_array',
            'title' => 'Javascript Style Array',
            'desc' => 'If you don\'t like any of the styles above, fell free to add your own style. Please include just the array definition. No extra variables or code.<br />
					  Make use of the following services to create your style:<br />
					  . <a href="http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html" target="_blank">Styled Maps Wizard by Google</a><br />
					  . <a href="http://www.evoluted.net/thinktank/web-design/custom-google-maps-style-tool" target="_blank">Custom Google Maps Style Tool by Evoluted</a><br />
					  . <a href="http://software.stadtwerk.org/google_maps_colorizr/" target="_blank">Google Maps Colorizr by stadt werk</a><br />			  					  
			          You may also like to <a href="http://snazzymaps.com/submit" target="_blank">submit</a> your style for the world to see :)',
            'type' => 'textarea',
            'std' => '',
        ),	
	)
);

// Infowindow settings

$wpsf_settings[] = array(
    'section_id' => 'infoboxsettings',
    'section_title' => 'Infobox Settings <sup class="cspm_new_tag">New</sup>',
    'section_description' => 'The infobox, also called infowindow is an overlay that looks like a bubble and is often connected to a marker.',
    'section_order' => 5,
    'fields' => array(
		array(
            'id' => 'show_infobox',
            'title' => 'Show Infobox',
            'desc' => 'Show/Hide the Infobox.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
        array(
            'id' => 'infobox_type',
            'title' => 'Infobox type',
            'desc' => 'Select the Infobox type. <strong>Hover over the options to see an image of the infobox style</strong>.',
            'type' => 'radio',
            'std' => 'rounded_bubble',
            'choices' => array(				
				'square_bubble' => 'Square bubble',
				'rounded_bubble' => 'Rounded bubble',				
				'cspm_type1' => 'Infobox 1',
				'cspm_type2' => 'Infobox 2',
				'cspm_type3' => 'Infobox 3',
				'cspm_type4' => 'Infobox 4',												
            )
        ),		
		array(
            'id' => 'infobox_display_event',
            'title' => 'Display event',
            'desc' => 'Select from the options above when the infoboxes should be displayed in the map.',
            'type' => 'radio',
            'std' => 'onload',
            'choices' => array(
				'onload' => 'On map load <sup>(Load all infoboxes)</sup>',
				'onclick' => 'On marker click',
				'onhover' => 'On marker hover'
            )
        ),
		array(
            'id' => 'infobox_external_link',
            'title' => 'Post URL',
            'desc' => 'Select a way to open the single post page.',
            'type' => 'radio',
            'std' => 'same_window',
            'choices' => array(
				'new_window' => 'Open in a new window',
				'same_window' => 'Open in the same window'
            )
        ),		
	)
);

// Marker cetgories section

$wpsf_settings[] = array(
    'section_id' => 'markercategoriessettings',
    'section_title' => 'Marker Categories Settings',
    'section_description' => 'Choose from the available taxonomies the one that represent the category of your posts, upload a new image for each category of markers, 
							  set the marker categories option to "on" and your map will be ready to communicate with multiple category of markers.',
    'section_order' => 6,
    'fields' => array(	
        array(
            'id' => 'marker_cats_settings',
            'title' => 'Marker categories option',
            'desc' => 'Select "Yes" to enable this option in the plugin. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
		array(
            'id' => 'marker_categories_section',
            'title' => '<span class="section_sub_title">Marker categories</span>',
            'desc' => '',
            'type' => 'custom',
        ),								
		array(
            'id' => 'marker_categories_desc_section',
            'title' => '<span class="section_sub_title cspacing_info">Upload your custom marker image for each category.<br />If one of the categories doesn\'t have a marker image  
			            or you don\'t want to use the custom markers at all, the default marker will be used instead.<br />If a post have more than one category, the plugin will call 
						the marker image of the first category in the list.</span>',
            'desc' => '',
            'type' => 'custom',
        ),									
	)
);

	
// Marker overlay section

$wpsf_settings[] = array(
    'section_id' => 'markeroverlaysettings',
    'section_title' => '<span class="cspm_deprecated">Marker Overlay Settings</span>',
    'section_description' => '',
    'section_order' => 7,
    'fields' => array(	
		array(
            'id' => 'deprication_msg',
            'title' => '<span class="section_sub_title cspacing_alert">This feature has been deprecated since 2.5. It has been replaced by the feature "Infobox settings" and may be removed from future versions.</span>',
            'desc' => '',
            'type' => 'custom',
        ),												
		array(
            'id' => 'content_style_section',
            'title' => '<span class="section_sub_title">Content style</span>',
            'desc' => '',
            'type' => 'custom',
        ),								
		array(
            'id' => 'content_overlay_horizontal_pos',
            'title' => 'Horizontal position',
            'desc' => 'Specify the horizontal position of the content type overlay of a marker. Default is -125',
            'type' => 'text',
            'std' => '-125'
        ),			
		array(
            'id' => 'content_overlay_vertical_pos',
            'title' => 'Vertical position',
            'desc' => 'Specify the vertical position of the content type overlay of a marker. Default is -168',
            'type' => 'text',
            'std' => '-168'
        ),											
		array(
            'id' => 'bubble_style_section',
            'title' => '<span class="section_sub_title">Bubble style</span>',
            'desc' => '',
            'type' => 'custom',
        ),	
		array(
            'id' => 'bubble_horizontal_pos',
            'title' => 'Horizontal position',
            'desc' => 'Specify the horizontal position of the bubble type overlay of a marker. Default is 4',
            'type' => 'text',
            'std' => '4'
        ),			
		array(
            'id' => 'bubble_vertical_pos',
            'title' => 'Vertical position',
            'desc' => 'Specify the vertical position of the bubble type overlay of a marker. Default is -80',
            'type' => 'text',
            'std' => '-80'
        ),		
		array(
            'id' => 'bubble_link_text',
            'title' => '"More" Link text',
            'desc' => 'Enter the text that will replace the default text "More". If you don\'t want to show the link just leave this field empty.',
            'type' => 'text',
            'std' => 'More'
        ),	
		array(
            'id' => 'bubble_link_css',
            'title' => '"More" Link CSS',
            'desc' => 'Add your custom CSS to customize the "More" link style.',
            'type' => 'textarea',
            'std' => ''
        ),																							
        array(
            'id' => 'bubble_external_link',
            'title' => 'External link',
            'desc' => 'Will the link inside the bubble open a new page?',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
	)
	
);


// Carousel Settings section

$wpsf_settings[] = array(
    'section_id' => 'carouselsettings',
    'section_title' => 'Carousel Settings',
    'section_description' => 'Use this interface to control the carousel settings.',
    'section_order' => 8,
    'fields' => array(
        array(
            'id' => 'show_carousel',
            'title' => 'Show carousel',
            'desc' => 'Show/Hide the map\'s carousel.',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'carousel_mode',
            'title' => 'Mode',
            'desc' => 'Specifies wether the carousel appears in RTL mode or LTR mode.',
            'type' => 'select',
            'std' => 'false',
            'choices' => array(
				'true' => 'Right-to-left',
				'false' => 'Left-to-right'
            )
        ),
        array(
            'id' => 'carousel_scroll',
            'title' => 'Scroll',
            'desc' => 'The number of items to scroll by.',
            'type' => 'text',
            'std' => '1',
        ),
        array(
            'id' => 'carousel_animation',
            'title' => 'Animation',
            'desc' => 'The speed of the scroll animation ("slow" or "fast").',
            'type' => 'select',
            'std' => 'fast',
            'choices' => array(
				'slow' => 'slow',
				'fast' => 'Fast'
            )
        ),
        array(
            'id' => 'carousel_easing',
            'title' => 'Easing',
            'desc' => 'The name of the easing effect that you want to use. <a href="http://jqueryui.com/resources/demos/effect/easing.html" target="_blank">(See jQuery Demo)</a>',
            'type' => 'select',
            'std' => 'linear',
            'choices' => array(
				'linear' => 'linear',
				'swing' => 'swing',
				'easeInQuad' => 'easeInQuad',
				'easeOutQuad' => 'easeOutQuad',
				'easeInOutQuad' => 'easeInOutQuad',
				'easeInCubic' => 'easeInCubic',
				'easeOutCubic' => 'easeOutCubic',
				'easeInOutCubic' => 'easeInOutCubic',
				'easeInQuart' => 'easeInQuart',
				'easeOutQuart' => 'easeOutQuart',
				'easeInOutQuart' => 'easeInOutQuart',
				'easeInQuint' => 'easeInQuint',
				'easeOutQuint' => 'easeOutQuint',
				'easeInOutQuint' => 'easeInOutQuint',
				'easeInExpo' => 'easeInExpo',
				'easeOutExpo' => 'easeOutExpo',
				'easeInOutExpo' => 'easeInOutExpo',
				'easeInSine' => 'easeInSine',
				'easeOutSine' => 'easeOutSine',
				'easeInOutSine' => 'easeInOutSine',
				'easeInCirc' => 'easeInCirc',
				'easeOutCirc' => 'easeOutCirc',
				'easeInOutCirc' => 'easeInOutCirc',
				'easeInElastic' => 'easeInElastic',
				'easeOutElastic' => 'easeOutElastic',
				'easeInOutElastic' => 'easeInOutElastic',
				'easeInBack' => 'easeInBack',
				'easeOutBack' => 'easeOutBack',
				'easeInOutBack' => 'easeInOutBack',
				'easeInBounce' => 'easeInBounce',
				'easeOutBounce' => 'easeOutBounce',
				'easeInOutBounce' => 'easeInOutBounce',
            )
        ),		
        array(
            'id' => 'carousel_auto',
            'title' => 'Auto',
            'desc' => 'Specifies how many seconds to periodically autoscroll the content. If set to 0 (default) then autoscrolling is turned off.',
            'type' => 'text',
            'std' => '0',
        ),
        array(
            'id' => 'carousel_wrap',
            'title' => 'Wrap',
            'desc' => 'Specifies whether to wrap at the first/last item (or both) and jump back to the start/end. If set to null, wrapping is turned off.',
            'type' => 'select',
            'std' => 'circular',
            'choices' => array(
				'first' => 'First',
				'last' => 'Last',
				'both' => 'Both',
				'circular' => 'Circular',
				'null' => 'Null'
            )
        ),
        array(
            'id' => 'scrollwheel_carousel',
            'title' => 'Scroll wheel',
            'desc' => 'Move the carousel with scroll wheel.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
        array(
            'id' => 'touchswipe_carousel',
            'title' => 'Touch swipe',
            'desc' => 'Move the carousel with touch swipe.',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),					
		array(
            'id' => 'carousel_map_zoom',
            'title' => 'Map zoom',
            'desc' => 'Select the map zoom when an item is selected in the carousel.',
            'type' => 'select',
            'std' => '12',
            'choices' => array(
				'0' => '0',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19'
            )
        ),		
	)

);	


// Carousel Style section

$wpsf_settings[] = array(
    'section_id' => 'carouselstyle',
    'section_title' => 'Carousel Style',
    'section_description' => 'Use this interface to customize the carousel style.',
    'section_order' => 9,
    'fields' => array(
        array(
            'id' => 'carousel_css',
            'title' => 'Carousel CSS',
            'desc' => 'Add your custom CSS to customize the carousel style.<br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => ''
        ),
        array(
            'id' => 'arrows_background',
            'title' => 'Arrows background color',
            'desc' => 'Use this field to change the default background color of the arrows. Leave this field empty or add # for transparent background.',
            'type' => 'color',
            'std' => '#f1f1f1'
        ),		
        array(
            'id' => 'horizontal_left_arrow_icon',
            'title' => 'Horizontal left arrow image',
            'desc' => 'Upload a new left arrow image. You can always find the original arrow at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'horizontal_right_arrow_icon',
            'title' => 'Horizontal right arrow image',
            'desc' => 'Upload a new right arrow image. You can always find the original arrow at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'vertical_top_arrow_icon',
            'title' => 'Vertical top arrow image',
            'desc' => 'Upload a new top arrow image. You can always find the original arrow at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
        array(
            'id' => 'vertical_bottom_arrow_icon',
            'title' => 'Vertical bottom arrow image',
            'desc' => 'Upload a new bottom arrow image. You can always find the original arrow at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),	
        array(
            'id' => 'items_background',
            'title' => 'Carousel items background color',
            'desc' => 'Use this field to change the default background color of the carousel items.',
            'type' => 'color',
            'std' => '#f9f9f9'
        ),
		array(
            'id' => 'items_hover_background',
            'title' => 'Active carousel items background color',
            'desc' => 'Use this field to change the default background color of the carousel items when one of them is selected.',
            'type' => 'color',
            'std' => '#f3f3f3'
        ),		
	)
);


// Items settings

$wpsf_settings[] = array(
    'section_id' => 'itemssettings',
    'section_title' => 'Carousel Items Settings <sup class="cspm_plus_tag">Plus+</sup>',
    'section_description' => 'Use this interface to customize the carousel items style &amp; content.',
    'section_order' => 10,
    'fields' => array(
        array(
            'id' => 'items_view',
            'title' => 'Items view',
            'desc' => 'Select main view of carousel items.',
            'type' => 'radio',
            'std' => 'listview',
            'choices' => array(
				'listview' => 'Horizontal',
				'gridview' => 'Vertical',
            )
        ),
		array(
            'id' => 'horizontal_item_section',
            'title' => '<span class="section_sub_title">Horizontal view</span>',
            'desc' => '',
            'type' => 'custom',
        ),			
        array(
            'id' => 'horizontal_item_size',
            'title' => 'Items size <sup>(Horizontal view)</sup>',
            'desc' => 'Enter the size (in pixels) of the carousel items. This field is related to the items within the horizontal view. (Width then height separated by comma. Default: 414,120)',
            'type' => 'text',
            'std' => '414,120',
        ),	
        array(
            'id' => 'horizontal_item_css',
            'title' => 'Items CSS <sup>(Horizontal view)</sup>',
            'desc' => 'Enter yout custom CSS for the carousel items. This field is related to the items within the horizontal view.<br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),									
        array(
            'id' => 'horizontal_image_size',
            'title' => 'Image size <sup>(Horizontal view)</sup>',
            'desc' => 'Enter the image size (in pixels) of the carousel items. This field is related to the items within the horizontal view. (Width then height separated by comma. Default: 174,120)',
            'type' => 'text',
            'std' => '174,120',
        ),		
        array(
            'id' => 'horizontal_details_size',
            'title' => 'Description area size <sup>(Horizontal view)</sup>',
            'desc' => 'Enter the size (in pixels) of the items description area. This field is related to the items within the horizontal view. (Width then height separated by comma. Default: 240,120)',
            'type' => 'text',
            'std' => '240,120',
        ),
        array(
            'id' => 'horizontal_title_css',
            'title' => 'Title CSS <sup>(Horizontal view)</sup>',
            'desc' => 'Customize the items title area and text by entring your CSS. This field is related to the items within the horizontal view.
			           <br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),	
        array(
            'id' => 'horizontal_details_css',
            'title' => 'Description CSS <sup>(Horizontal view)</sup>',
            'desc' => 'Customize the items description area and text by entring your CSS. This field is related to the items within the horizontal view.
			           <br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),			
		array(
            'id' => 'vertical_item_section',
            'title' => '<span class="section_sub_title">Vertical view</span>',
            'desc' => '',
            'type' => 'custom',
        ),			
        array(
            'id' => 'vertical_item_size',
            'title' => 'Items size <sup>(Vertical view)</sup>',
            'desc' => 'Enter the size (in pixels) of the carousel items. This field is related to the items within the vertical view. (Width then height separated by comma. Default: 174,240)',
            'type' => 'text',
            'std' => '174,240',
        ),	
        array(
            'id' => 'vertical_item_css',
            'title' => 'Items CSS <sup>(Vertical view)</sup>',
            'desc' => 'Enter yout custom CSS for the carousel items. This field is related to the items within the vertical view.
			           <br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),															
        array(
            'id' => 'vertical_image_size',
            'title' => 'Image size <sup>(Vertical view)</sup>',
            'desc' => 'Enter the image size (in pixels) of the carousel items. This field is related to the items within the vertical view. (Width then height separated by comma. Default: 174,90)',
            'type' => 'text',
            'std' => '174,90',
        ),												
        array(
            'id' => 'vertical_details_size',
            'title' => 'Description area size <sup>(Vertical view)</sup>',
            'desc' => 'Enter the size (in pixels) of the items description area. This field is related to the items within the vertical view. (Width then height separated by comma. Default: 174,150)',
            'type' => 'text',
            'std' => '174,150',
        ),		
        array(
            'id' => 'vertical_title_css',
            'title' => 'Title CSS <sup>(Vertical view)</sup>',
            'desc' => 'Customize the items title area and text by entring your CSS. This field is related to the items within the vertical view.
			           <br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),	
        array(
            'id' => 'vertical_details_css',
            'title' => 'Description CSS <sup>(Vertical view)</sup>',
            'desc' => 'Customize the items description area and text by entring your CSS. This field is related to the items within the vertical view.
			           <br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),		
		array(
            'id' => 'more_item_section',
            'title' => '<span class="section_sub_title">Content settings</span>',
            'desc' => '',
            'type' => 'custom',
        ),										
        array(
            'id' => 'show_details_btn',
            'title' => '"More" button',
            'desc' => 'Show/Hide "More" button',
            'type' => 'radio',
            'std' => 'yes',
            'choices' => array(
				'yes' => 'Show',
				'no' => 'Hide',
            )
        ),
        array(
            'id' => 'details_btn_text',
            'title' => '"More" Button text',
            'desc' => 'Enter your customize text to show on the "More" Button.',
            'type' => 'text',
            'std' => 'More',
        ),				
        array(
            'id' => 'details_btn_css',
            'title' => '"More" Button CSS',
            'desc' => 'Enter your CSS to customize the "More" Button\'s look.<br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),			
        array(
            'id' => 'items_title',
            'title' => 'Items title',
            'desc' => 'Create your customized items title by entering the name of your custom fields. You can use as many you want. Leave this field empty to use the default title.
					<br /><strong>Syntax:</strong> [meta_key<sup>1</sup>][separator<sup>1</sup>][meta_key<sup>2</sup>][separator<sup>2</sup>][meta_key<sup>n</sup>]...[title lenght].
					<br /><strong>Example of use:</strong> [post_category][s=,][post_address][l=50]
					<br /><strong>*</strong> To insert empty an space enter [-]
					<br /><strong>* Make sure there\'s no empty spaces between ][</strong>',
            'type' => 'textarea',
            'std' => '',
        ),
		array(
            'id' => 'click_on_title',
            'title' => 'Title as link <sup class="cspm_new_tag">New</sup>',
            'desc' => 'Select "Yes" to use the title as a link to the post page.',
            'type' => 'radio',
            'std' => 'no',
			'choices' => array(
				'yes' => 'Yes',
				'no' => 'No',
            )
        ),
		array(
            'id' => 'external_link',
            'title' => 'Post URL <sup class="cspm_new_tag">New</sup>',
            'desc' => 'If you choosed to use the title as link, you may want to select a way to open the post page.',
            'type' => 'radio',
            'std' => 'same_window',
            'choices' => array(
				'new_window' => 'Open in a new window',
				'same_window' => 'Open in the same window'
            )
        ),			
        array(
            'id' => 'items_details',
            'title' => 'Items description',
            'desc' => 'Create your customized description content. You can combine the content with your custom fields & taxonomies. Leave this field empty to use the default description.
					<br /><strong>Syntax:</strong> [content;content_length][separator][t=label:][meta_key][separator][t=Category:][tax=taxonomy_slug][separator]...[description lenght]
					<br /><strong>Example of use:</strong> [content;80][s=br][t=Category:][-][tax=category][s=br][t=Address:][-][post_address]
					<br /><strong>*</strong> To specify a description lenght, use <strong>[l=LENGHT]</strong>. Change LENGHT to a number (e.g. 100).
					<br /><strong>*</strong> To add a label, use <strong>[t=YOUR_LABEL]</strong>
					<br /><strong>*</strong> To add a custom field, use <strong>[CUSTOM_FIELD_NAME]	</strong>				
					<br /><strong>*</strong> To insert a taxonomy, use <strong>[tax=TAXONOMY_SLUG]</strong>
					<br /><strong>*</strong> To insert new line enter <strong>[s=br]</strong>
					<br /><strong>*</strong> To insert an empty space enter <strong>[-]</strong>
					<br /><strong>*</strong> To insert the content/excerpt, use <strong>[content;LENGHT]</strong>. Change LENGHT to a number (e.g. 100).
					<br /><strong>* Make sure there\'s no empty spaces between ][</strong>',
            'type' => 'textarea',
            'std' => '[l=100]',
        ),	
	)
);


// Post count settings

$wpsf_settings[] = array(
    'section_id' => 'postscountsettings',
    'section_title' => 'Posts Count Settings',
    'section_description' => 'This feature allow to show the number of your posts on the top of the map. Use the settings bellow to change the default clause & style.',
    'section_order' => 11,
    'fields' => array(
        array(
            'id' => 'show_posts_count',
            'title' => 'Show posts count',
            'desc' => 'Show/Hide the posts count clause',
            'type' => 'radio',
            'std' => 'no',
            'choices' => array(
				'yes' => 'Show',
				'no' => 'Hide',
            )
        ),	
        array(
            'id' => 'posts_count_clause',
            'title' => 'Posts count clause',
            'desc' => 'Use this field to write your custom clause.<br /><strong>Syntaxe:</strong> YOUR CLAUSE [posts_count] YOUR CLAUSE',
            'type' => 'textarea',
            'std' => '[posts_count] Posts',
        ),
        array(
            'id' => 'posts_count_color',
            'title' => 'Clause color',
            'desc' => 'Choose the color of the clause.',
            'type' => 'color',
            'std' => '#333333',
        ),
        array(
            'id' => 'posts_count_style',
            'title' => 'Clause style',
            'desc' => 'Add your CSS code to customize the caluse style.<br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),						
	)
);											


// Faceted navigation settings

$wpsf_settings[] = array(
    'section_id' => 'facetedsearchsettings',
    'section_title' => 'Faceted Search Settings',
    'section_description' => 'Faceted search, also called faceted navigation or faceted browsing, is a technique for accessing information organized according to a faceted classification system, allowing users to explore a collection of information by applying multiple filters. A faceted classification system classifies each information element along multiple explicit dimensions, enabling the classifications to be accessed and ordered in multiple ways rather than in a single, pre-determined, taxonomic order.',
    'section_order' => 12,
    'fields' => array(
		array(
            'id' => 'faceted_search_alert_msg',
            'title' => '<span class="section_sub_title cspacing_notice">! The faceted search can not be operated without activating the "Marker categories option" at "Marker categories settings"</span>',
            'desc' => '',
            'type' => 'custom',
        ),	
        array(
            'id' => 'faceted_search_option',
            'title' => 'Faceted search option',
            'desc' => 'Select "Yes" to enable this option in the plugin. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),	
		array(
			'id' => 'faceted_search_multi_taxonomy_option',
			'title' => 'Multiple taxonomy option', 
			'desc' => 'Select "Yes" if you want to filter the posts by selecting multiple taxonomy in the faceted search form.',
			'type' => 'radio',
			'std' => 'true',
			'choices' => array(
				'true' => 'Yes',
				'false' => 'No',
			)
		),			
		array(
            'id' => 'faceted_search_customizing_section',
            'title' => '<span class="section_sub_title">Customization</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
			'id' => 'faceted_search_input_skin',
			'title' => 'Checkbox/Radio skin', 
			'desc' => 'Select the skin of the checkbox/radio input. <a target="_blank" href="http://damirfoy.com/iCheck/">See all skins</a>',
			'type' => 'radio',
			'std' => 'polaris',
			'choices' => array(
				'minimal' => 'Minimal skin',
				'square' => 'Square skin',
				'flat' => 'Flat skin',
				'line' => 'Line skin',
				'polaris' => 'Polaris skin',
				'futurico' => 'Futurico skin',
			)
		),
		array(
			'id' => 'faceted_search_input_color',
			'title' => 'Checkbox/Radio skin color', 
			'desc' => 'Select the skin color of the checkbox/radio input. (Polaris & Futurico skins doesn\'t use colors). <a target="_blank" href="http://damirfoy.com/iCheck/">See all colors</a>',
			'type' => 'radio',
			'std' => 'blue',
			'choices' => array(
				'black' => 'Black',
				'red' => 'Red',
				'green' => 'Green',
				'blue' => 'Blue',
				'aero' => 'Aero',
				'grey' => 'Grey',
				'orange' => 'Orange',
				'yellow' => 'Yellow',
				'pink' => 'Pink',
				'purple' => 'Purple',
			)
		),			
        array(
            'id' => 'faceted_search_icon',
            'title' => 'Faceted search button image',
            'desc' => 'Upload a new image for the faceted search button. You can always find the original image at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),											
        array(
            'id' => 'faceted_search_css',
            'title' => 'Category list style',
            'desc' => 'Add your CSS code to customize the style of the category list.<br /><strong>e.g.</strong> background-color:#ededed; border:1px solid; ...',
            'type' => 'textarea',
            'std' => '',
        ),						
	)
);	


// Search form settings

$wpsf_settings[] = array(
    'section_id' => 'searchformsettings',
    'section_title' => 'Search Form Settings <sup class="cspm_plus_tag">Plus+</sup>',
    'section_description' => 'The search form is a technique that lets a user enter their address and see markers on a map for the locations nearest to them within a chosen distance restriction. Use this interface to control the search form settings.',
    'section_order' => 13,
    'fields' => array(
        array(
            'id' => 'search_form_option',
            'title' => 'Search form option',
            'desc' => 'Select "Yes" to enable this option in the plugin. Default "No".',
            'type' => 'radio',
            'std' => 'false',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),
        array(
            'id' => 'sf_search_distances',
            'title' => 'Min & Max distances of search',
            'desc' => 'Enter the minimum distance and the maximum distance to use as a distance search between the origin address and the destinations in the map.',
            'type' => 'text',
            'std' => '3,50'
        ),	
        array(
            'id' => 'sf_distance_unit',
            'title' => 'Distance unit',
            'desc' => 'Select the distance unit.',
            'type' => 'radio',
            'std' => 'metric',
            'choices' => array(
				'metric' => 'Km',
				'imperial' => 'Miles'
            )
        ),	
		array(
            'id' => 'form_customization_section',
            'title' => '<span class="section_sub_title">Search form customization</span>',
            'desc' => '',
            'type' => 'custom',
        ),																        
		array(
            'id' => 'address_placeholder',
            'title' => 'Address field placeholder',
            'desc' => 'Update the text to show as a placeholder for the address field',
            'type' => 'text',
            'std' => 'Enter City & Province, or Postal code',
        ),	
		array(
            'id' => 'slider_label',
            'title' => 'Slider label',
            'desc' => 'Update the text to show as a label for the slider',
            'type' => 'text',
            'std' => 'Expand the search area up to',
        ),
        array(
            'id' => 'submit_text',
            'title' => 'Submission button text',
            'desc' => 'Update the text to show in the submission button.',
            'type' => 'text',
            'std' => 'Search',
        ),	
		array(
            'id' => 'search_form_icon',
            'title' => 'Search form button image',
            'desc' => 'Upload a new image for the search form button. You can always find the original image at the plugin\'s images directory.',
            'type' => 'file',
            'std' => ''
        ),
		array(
            'id' => 'search_form_bg_color',
            'title' => 'Background color',
            'desc' => 'Change the background color of the search form container.',
            'type' => 'color',
            'std' => '#ffffff',
        ),	
		array(
            'id' => 'warning_msg_section',
            'title' => '<span class="section_sub_title">Warning messages</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'no_location_msg',
            'title' => 'No locations message',
            'desc' => 'Update the text to show when the search form has no locations to display.',
            'type' => 'text',
            'std' => 'We could not find any location',
        ),	
		array(
            'id' => 'bad_address_msg',
            'title' => 'Bad address message',
            'desc' => 'Update the text to show when the search form did not uderstand the provided address.',
            'type' => 'text',
            'std' => 'We could not understand the location',
        ),	
		array(
            'id' => 'bad_address_sug_1',
            'title' => '"Bad address" first suggestion',
            'desc' => 'Update the text to show as a first suggestion for the bad address\'s message.',
            'type' => 'text',
            'std' => '- Make sure all street and city names are spelled correctly.',
        ),	
		array(
            'id' => 'bad_address_sug_2',
            'title' => '"Bad address" Second suggestion',
            'desc' => 'Update the text to show as a second suggestion for the bad address\'s message.',
            'type' => 'text',
            'std' => '- Make sure your address includes a city and state.',
        ),	
		array(
            'id' => 'bad_address_sug_3',
            'title' => '"Bad address" Third suggestion',
            'desc' => 'Update the text to show as a third suggestion for the bad address\'s message.',
            'type' => 'text',
            'std' => '- Try entering a zip code.',
        ),		
		array(
            'id' => 'circle_customization_section',
            'title' => '<span class="section_sub_title">Circle customization</span>',
            'desc' => '',
            'type' => 'custom',
        ),
        array(
            'id' => 'circle_option',
            'title' => 'Circle option',
            'desc' => 'The circle option is a technique of drawing a circle of a given radius of the search address. Select "Yes" to enable this option. Default "Yes".',
            'type' => 'radio',
            'std' => 'true',
            'choices' => array(
				'true' => 'Yes',
				'false' => 'No'
            )
        ),		
		array(
            'id' => 'fillColor',
            'title' => 'Fill color',
            'desc' => 'The fill color.',
            'type' => 'color',
            'std' => '#189AC9',
        ),		
		array(
            'id' => 'fillOpacity',
            'title' => 'Fill opacity',
            'desc' => 'The fill opacity between 0.0 and 1.0.',
            'type' => 'select',
            'std' => '0.1',
            'choices' => array(
				'0.0' => '0.0',
				'0.1' => '0.1',
				'0.2' => '0.2',
				'0.3' => '0.3',
				'0.4' => '0.4',
				'0.5' => '0.5',
				'0.6' => '0.6',
				'0.7' => '0.7',
				'0.8' => '0.8',
				'0.9' => '0.9',
				'1' => '1',
            )			
        ),																						
		array(
            'id' => 'strokeColor',
            'title' => 'Stroke color',
            'desc' => 'The stroke color.',
            'type' => 'color',
            'std' => '#189AC9',
        ),		
		array(
            'id' => 'strokeOpacity',
            'title' => 'Stroke opacity',
            'desc' => 'The stroke opacity between 0.0 and 1.',
            'type' => 'select',
            'std' => '1',
            'choices' => array(
				'0.0' => '0.0',
				'0.1' => '0.1',
				'0.2' => '0.2',
				'0.3' => '0.3',
				'0.4' => '0.4',
				'0.5' => '0.5',
				'0.6' => '0.6',
				'0.7' => '0.7',
				'0.8' => '0.8',
				'0.9' => '0.9',
				'1' => '1',
            )			
        ),	
		array(
            'id' => 'strokeWeight',
            'title' => 'Stroke weight',
            'desc' => 'The stroke width in pixels.',
            'type' => 'text',
            'std' => '1',
        )	
																							
	)
);
	
// troubleshooting

$wpsf_settings[] = array(
    'section_id' => 'troubleshooting',
    'section_title' => 'Troubleshooting & Configs <sup class="cspm_new_tag">New</sup>',
    'section_description' => '',
    'section_order' => 15,
    'fields' => array(
		array(
            'id' => 'regenerate_markers_link',
            'title' => 'Regenerate markers',
            'desc' => '<span class="cspm_blink_text">Regenerating markers is under process...<br /></span>
					   This option is for regenerating all your markers. In most cases, <strong>you wont need to use this option at all</strong> because markers 
					   are automatically created and each time you add or edit a post, the marker(s) related to this post will be regenerated automatically. 
					   Use this options <strong>only when need to</strong>.
					   <span style="color:red">This may take a while when you have too many markers (500+) to regenerate. Please be patient.</span>',
            'type' => 'link',
			'std' => '#'
        ),
		array(
            'id' => 'use_ssl',
            'title' => 'Use the map on SSL environement',
            'desc' => 'By default, the map is configured for an HTTP environement. To configure the map for an SSL environment select the option <strong>https</strong>.',
            'type' => 'radio',
            'std' => 'http',
			'choices' => array(
				'http' => 'http',
				'https' => 'https'
			)
        ),
		array(
            'id' => 'outer_links_field_name',
            'title' => '"Outer links" custom field name',
            'desc' => 'By default, the plugin uses the function get_permalink() of wordpress to get the posts links. <strong>In some cases, users wants to use their locations
			           in the map as links to other pages in outer websites.</strong> To use this option, you MUST have your external <strong>links stored in a custom field</strong>. Enter the name of that
					   custom field or leave this field empty if you don\'t need this option.',
            'type' => 'text',
            'std' => '',
        ),
		array(
            'id' => 'loading_scripts_section',
            'title' => '<span class="section_sub_title">Loading scripts & styles</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'combine_files',
            'title' => 'Collecting scripts & styles into one file',
            'desc' => 'Collecting all JS & CSS files into one file will reduce the amount of time it takes to 
			           load your map because you are reducing the number of files or HTTP requests the web browser has to request before displaying the map.
					   By default, the plugin combine all files into one, but you can still be able to seperate them by selecting the option "<strong>Seperate files</strong>".',
            'type' => 'radio',
            'std' => 'combine',
			'choices' => array(
				'combine' => 'Combine files',
				'seperate' => 'Seperate files'
			)
        ),
		array(
            'id' => 'loading_scripts',
            'title' => 'Method of loading scripts & styles',
            'desc' => 'By default, the plugin loads all the JS & CSS files on the entire site. In some cases where you use several other plugins, 
			           this can bog down your site with loads of requests for these files.<br />Progress Map gives you the ability to load the necessary 
					   files only in the pages/posts that uses the map. To use this feature, select the option "<strong>Load files only on specific pages/posts</strong>" 
					   then enter the page/post IDs in the 
					   fields "<strong>Page IDs</strong>" and "<strong>Post IDs</strong>".<br />
					   <strong class="cspm_blue">To complete this option, copy the code bellow in the <u>function.php</u> file of your theme.</strong>
<pre class="cspm_pre">
&lt;?php // You don\'t need this line
			   
function cspm_remove_style_files(){	

  if (!class_exists("CodespacingProgressMap"))
    return; 
	
  global $post;
	
  $ProgressMapClass = CodespacingProgressMap::this();
	
  if($ProgressMapClass->loading_scripts == "only_pages"){
		
    $IDs = array_merge(
            explode(",", str_replace(" ", "", $ProgressMapClass->load_on_page_ids)),
            explode(",", str_replace(" ", "", $ProgressMapClass->load_on_post_ids))
           );

    if(!in_array($post->ID, $IDs))		
      $ProgressMapClass->cspm_deregister_styles();
		
  }	
	
}

add_action("wp_print_styles", "cspm_remove_style_files", 100);

function cspm_remove_script_files(){	
	
  if (!class_exists("CodespacingProgressMap"))
    return; 
	
  global $post;
	
  $ProgressMapClass = CodespacingProgressMap::this();
	
  if($ProgressMapClass->loading_scripts == "only_pages"){
		
    $IDs = array_merge(
            explode(",", str_replace(" ", "", $ProgressMapClass->load_on_page_ids)),
            explode(",", str_replace(" ", "", $ProgressMapClass->load_on_post_ids))
           );

    if(!in_array($post->ID, $IDs))		
      $ProgressMapClass->cspm_deregister_scripts();
		
  }	
	
}

add_action("wp_print_scripts", "cspm_remove_script_files", 100);

?&gt; // You don\'t need this line
</pre>',
            'type' => 'radio',
            'std' => 'entire_site',
			'choices' => array(
				'entire_site' => 'Load files on entire site',
				'only_pages' => 'Load files only on specific pages/posts'
			)
        ),
		array(
            'id' => 'load_on_page_ids',
            'title' => 'Page IDs',
            'desc' => 'If you\'re using the map on specific pages, enter the page IDs you\'re using to display the map. Seperate IDs by comma.',
            'type' => 'text',
            'std' => '',
        ),
		array(
            'id' => 'load_on_post_ids',
            'title' => 'Post IDs',
            'desc' => 'If you\'re using the map on specific posts, enter the post IDs you\'re using to display the map. Seperate IDs by comma.',
            'type' => 'text',
            'std' => '',
        ),
		array(
            'id' => 'form_fields_section',
            'title' => '<span class="section_sub_title">"Add location" Form fields</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'form_fields_msg',
            'title' => '<span class="section_sub_title cspacing_info">IMPORTANT NOTE!<br /><br />This feature is dedicated ONLY for users that want to use the plugin with their already created cutsom fields.
			            You don\'t have any interest to change the name of the form fields bellow if you will use the plugin with a new post type/website. Just leave them as they are!
						<br />The "Add location" form is located in the "Add/Edit post" page of your post type.<br /><br />*After CHANGING the Latitude & Longitude fields names, 
						SAVE your settings, then use the "Regenerate markers" option bellow to recreate your markers.</span>',
            'desc' => '',
            'type' => 'custom',
        ),
		array(
            'id' => 'latitude_field_name',
            'title' => '"Latitude" field name',
            'desc' => 'Enter the name of your latitude custom field. Empty spaces are not allowed!',
            'type' => 'text',
            'std' => 'codespacing_progress_map_lat',
        ),
		array(
            'id' => 'longitude_field_name',
            'title' => '"Longitude" field name',
            'desc' => 'Enter the name of your longitude custom field. Empty spaces are not allowed!',
            'type' => 'text',
            'std' => 'codespacing_progress_map_lng',
        )										
	)
);


// Hidden Settings
$wpsf_settings[] = array(
    'section_id' => 'hiddensettings',
    'section_title' => '',
    'section_description' => '',
    'section_order' => 100,
    'fields' => array(	
		array(
            'id' => 'json_markers_method',
            'title' => '',
            'desc' => '',
            'type' => 'hidden',
            'std' => 'false',
        ),
	)
);

?>