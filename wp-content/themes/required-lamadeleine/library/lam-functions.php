<?php

/**
*
* La Madeleine custom theme functions
*
**/

function required_lam_widgets_init() {
	// unregister parent theme sidebars
	unregister_sidebar( 'sidebar-main' );
	unregister_sidebar( 'sidebar-footer-1' );
	unregister_sidebar( 'sidebar-footer-2' );
	unregister_sidebar( 'sidebar-footer-3' );
	
	// reregister and insert ours in the desired order.

	register_sidebar( array(
		'name' => __( 'Home Sidebar', 'requiredfoundation' ),
		'id' => 'sidebar-home',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title"><span>',
		'after_title' => '</span></h4>',
	) );

	register_sidebar( array(
		'name' => __( 'Stories Sidebar', 'requiredfoundation' ),
		'id' => 'sidebar-stories',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title"><span>',
		'after_title' => '</span></h4>',
	) );

	register_sidebar( array(
		'name' => __( 'Menu Sidebar', 'requiredfoundation' ),
		'id' => 'sidebar-menu',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title"><span>',
		'after_title' => '</span></h4>',
	) );

	register_sidebar( array(
		'name' => __( 'Locations Sidebar', 'requiredfoundation' ),
		'id' => 'sidebar-location',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title"><span>',
		'after_title' => '</span></h4>',
	) );

	register_sidebar( array(
		'name' => __( 'Story Sidebar', 'requiredfoundation' ),
		'id' => 'sidebar-story',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title"><span>',
		'after_title' => '</span></h4>',
	) );
}

function required_lam_enqueue() {
    global $wp_styles;

	// Global stylesheet
	wp_enqueue_style( 'importer', get_stylesheet_directory_uri().'/library/styles/css/importer.css', array('foundation-css') );

	/*** IE Fixes ***/
	//wp_enqueue_style( 'IE-fixes', get_stylesheet_directory_uri().'/ie-fixes.css', false, false );
	//$wp_styles->add_data( 'IE-fixes', 'conditional', 'lt IE 9' );
	
	// change jQuery to Google Code version and move to footer.
	wp_dequeue_script('jquery');
	wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js',array(),false,true);
	// latest jQuery UI
	// wp_enqueue_script('jquery_ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js', array('jquery'), false, true);
	// our plugins scripts for the theme
	wp_enqueue_script( 'required_lam_plugin', get_stylesheet_directory_uri().'/library/js/plugins.js', array('jquery'), false, true);
	// our primary scripts for the theme
	wp_enqueue_script( 'required_lam_main', get_stylesheet_directory_uri().'/library/js/main.js', array('jquery'), false, true);

    wp_enqueue_script( 'required_lam_location', get_stylesheet_directory_uri().'/library/js/la_mad_locations.js', array('jquery'), false, true);
}

/**
*
* Actions
*
**/
add_action( 'widgets_init', 'required_lam_widgets_init', 15 );
add_action( 'wp_enqueue_scripts', 'required_lam_enqueue' );

/** Meta info for blog posts **/
// function required_posted_on() {
// 	printf( __( '<p>Posted by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span> on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a></p>', 'requiredfoundation' ),
// 		esc_url( get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')) ),
// 		esc_attr( get_the_time() ),
// 		esc_attr( get_the_date( 'c' ) ),
// 		esc_html( get_the_date() ),
// 		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
// 		sprintf( esc_attr__( 'View all posts by %s', 'requiredfoundation' ), get_the_author() ),
// 		esc_html( get_the_author() )
// 	);
// }

/**
*
* Font Awesome Shortcodes
*
**/ 
function addscFontAwesome($atts) {
    extract(shortcode_atts(array(
    'type'  => '',
    'size' => '',
    'rotate' => '',
    'flip' => '',
    'pull' => '',
    'animated' => '',
 
    ), $atts));
     
    $type = ($type) ? 'fa-'.$type. '' : 'fa-star';
    $size = ($size) ? 'fa-'.$size. '' : '';
    $rotate = ($rotate) ? 'fa-rotate-'.$rotate. '' : '';
    $flip = ($flip) ? 'fa-flip-'.$flip. '' : '';
    $pull = ($pull) ? 'pull-'.$pull. '' : '';
    $animated = ($animated) ? 'fa-spin' : '';
 
    $theAwesomeFont = '<i class="fa '.sanitize_html_class($type).' '.sanitize_html_class($size).' '.sanitize_html_class($rotate).' '.sanitize_html_class($flip).' '.sanitize_html_class($pull).' '.sanitize_html_class($animated).'"></i>';
     
    return $theAwesomeFont;
}
 
add_shortcode('icon', 'addscFontAwesome');


/**
*
* Custom Image Sizes
*
**/
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'fma-full', 820, 750, true ); // 820 pixels wide by 750 pixels tall, hard crop mode
	add_image_size( 'daypart', 265, 95, true ); // 265 pixels wide by 95 pixels tall, hard crop mode
}

/**
*
* Strip out img height & width attribute
*
**/

add_filter( 'get_image_tag', 'remove_width_and_height_attribute', 10 );
add_filter( 'post_thumbnail_html', 'remove_width_and_height_attribute', 10 );

function remove_width_and_height_attribute( $html ) {
   return preg_replace( '/(height|width)="\d*"\s/', "", $html );
}

/**
*
* Add class to excerpts
*
**/
add_filter( "the_excerpt", "add_class_to_excerpt" );
function add_class_to_excerpt( $excerpt ) {
    return str_replace('<p', '<p class="excerpt"', $excerpt);
}

function custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

