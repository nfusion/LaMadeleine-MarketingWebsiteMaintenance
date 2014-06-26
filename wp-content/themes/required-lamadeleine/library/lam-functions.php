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
* Custom Image Sizes
*
**/
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'fma-full', 820, 750, true ); // 820 pixels wide by 750 pixels tall, hard crop true
	add_image_size( 'daypart', 265, 95, true ); // 265 pixels wide by 95 pixels tall, hard crop true
	add_image_size( 'menu-featured', 820, 360, true ); // 820 pixels wide by 360 pixels tall, hard crop true
	add_image_size( 'menu-item-featured', 365, 200, true ); // 365 pixels wide by 200 pixels tall, hard crop true
	add_image_size( 'menu-item-featured-story', 365, 300, true ); // 365 pixels wide by 300 pixels tall, hard crop true
	add_image_size( 'location-featured', 270, 150, true ); // 270 pixels wide by 150 pixels tall, hard crop true
	add_image_size( 'featured-top', 820, 390, true ); // 820 pixels wide by 360 pixels tall, hard crop true
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

/**
* Create Teaser
* Accepts string and length value, returns teaser
*/
function create_teaser($content,$length,$hellip=TRUE) {
	$i=0; // array units
	$c=0; // character counter
	$para = explode(" ", $content);

	if ($length >= (strlen($content) - strlen(end($para)))) { // desired length is longer than the content minus the last word
		$teaser = $content;
		$hellip = FALSE;
	} else { // trim this puppy
		while ($c <= $length) {
			$teaser .= ($i==0 ? "" : " ") . $para[$i];
			$c = $c + strlen($para[$i]) + 1; // extra +1 is for the space we're appending
			$i++;
		}
	}

	// prettify -- if the last character just happens to be a period, remove it before appending the ellipsis
	$teaser = (substr($teaser,-1) == "." && $hellip==TRUE) ? substr($teaser,0,-1) : $teaser ;

	// add ellipsis if requested or necessary
	$teaser .= ($hellip==TRUE ? "&hellip;" : "");

	return $teaser;
}

/**
*
* Display featured menu item
* Accept featured menu item object, returns markup
*
**/
function display_featured_item($featuredObj){
	// This featured item object
  $featured = $featuredObj;

  // If the featured item object is populated
  if(count($featured) > 0) :

  		// Does this featured item have a story related? 
  		if(count($featured['story']) > 1) :
  			$hasStory = true;
  		endif;

      // Start featured item element
      $str = '<div class="featured-menu-item">';

      if($hasStory) :
	      // This featured item has a story. Use a larger image size to make room for story teaser. 
	      $str .= $featured['featured_img_story'];
	    	$featuredItemClass = "has-story";
	   	else :
	   		// No story, use standard image size
	   		$str .= $featured['featured_img'];
	   		$featuredItemClass = "no-story";
	   	endif;

      // Start text wrapper
      $str .= '<div class="text-wrapper ' . $featuredItemClass . '">';

      // Include featured item title
      $str .= '<p class="title">' . $featured['title'] . '</p>';

      // If there is a story associated with this featured item
      if($hasStory) :

          // This story
          $story = $featured['story'];

          // Story wrapper
          $str .= '<div class="story-wrapper">';

          // Add story icon
          $str .= '<div class="icon icon-stories"></div>';

          // Generate and include story teaser
          $str .= '<div class="story-teaser">' . create_teaser($story['post_content'], 75) . ' <a href="' . $story['guid'] . '">' . $story['call_to_action'] . ' <span class="icon icon-arrow-right"></span></a></div>';

          // Close .story-wrapper
          $str .= '</div>';

      endif;

      // Close .text-wrapper and .featured-menu-item
      $str .= "</div></div>";

      return $str;

  endif;
}

/**
*
* Display menu item
* Accepts menu item object and featured item obj, returns markup
*
**/
function display_menu_item($menuItemObj, $featuredItemObj){

	// Does this menu item  have a story related? 
	if(count($menuItemObj['story']) > 1) :
		$hasStory = true;
		// This story
		$story = $menuItemObj['story'];
	endif;

  // Count menu item keys
  $keyLength = count($menuItemObj['menu_key_relationship']);

  // Echo menu item wrapper
  $str .= '<div class="menu-item">';

  // Echo menu item title
  $str .= '<div class="title-wrapper"><p class="title">' . $menuItemObj['title'] . '</p>';

  // If there are menu keys assigned with this item display associated icons
  if($keyLength > 0) :
      $str .= '<div class="menu-keys">';
      // Iterate through menu item keys
        if((isset($menuItemObj['menu_key_relationship']))&& is_array($menuItemObj['menu_key_relationship'])){
          foreach($menuItemObj['menu_key_relationship'] as $menuKey){
              // Echo this menu item key
              $str .= '<span class="icon icon-legend-' . $menuKey['slug'] . '"></span>';
          }
        }
      $str .= '</div>';
  endif;

  // Closing .title-wrapper
  $str .= '</div>';

  // Echo menu item description
  $str .= '<p class="desc">' . $menuItemObj['description'] . '<span class="pricing"><span class="min">$' . $menuItemObj['price_min'] . '</span><span class="max">$' . $menuItemObj['price_max'] . '</span></span></p>';

  if($hasStory) :
  	// If this menu item is not also the featured item, display the story CTA under the menu item in the category
  	if($menuItemObj['title'] != $featuredItemObj['title']) :
  		// Generate and include story teaser
  		$str .= '<div class="story-teaser"><div class="icon icon-stories"></div><p>' . create_teaser($story['post_content'], 75) . ' <a href="' . $story['guid'] . '">' . $story['call_to_action'] . ' <span class="icon icon-arrow-right"></span></a></p></div>';
  	endif;
  endif;

  // Closing .menu-item
  $str .= '</div>';

  return $str;

}

/**
*
* Display menu category by item
* Accepts menu object, returns markup containing menu category and all menu items
*
**/
function display_menu_category($menuObj,$layout){

	if(count($menuObj > 0)) : 

		// If no layout is defined, default to left layout
		if(!$layout){
			$layout = 'left';
		}

		// This category's name
	  $menuCategory = $menuObj['items'][0]['menu_category'];

	  // Is there a featured menu item? 
	  if(count($menuObj['featured'])) :
	  	// Yes! 
	  	$isFeatured = true;
	  	$featured = $menuObj['featured'];
	  endif; 

	  // This category's total number of menu items
	  $totalMenuItems = count($menuObj['items']);

	  // Determine where to split columns
	  if($isFeatured && $totalMenuItems > 2) :
	  	// Featured item and more than two items, stop one item short to better balance column against featured item image
			if($layout === 'left') :
	  		$splitItems = (($totalMenuItems / 2) - 1);
	  	else :
	  		$splitItems = (($totalMenuItems / 2) + 1);
	  	endif;
	  else : 
	  	// Less than two items or no featured item, split evenly in half
	  	$splitItems = $totalMenuItems / 2;
	  endif; 

	  // String to return containing markup
	  $str = "";

	  // Start new menu category row
	  $str .= '<div class="row menu-category">';

	  // Wrap in category title & description
	  $str .= '<div class="category-wrapper">';

	  // Include menu category name
	  $str .= '<h2 class="category-title">' . $menuCategory['name'] . '</h2>';

	  // Add menu category subhead if exists
	  if(count($menuCategory['description']) > 0) :
	  	$str .= '<p class="category-desc">' . $menuCategory['description'] . '</p>';
	  endif;

	  // Close category wrapper
	  $str .= '</div>';

	  // Start first column
	  $str .= '<div class="six columns">';

	  // If 'left' layout, include featured menu item at top of left column
	  if($isFeatured && $layout === 'left') :
	  	// Display featured menu item
	  	$str .= display_featured_item($featured);
	  endif; 
	      
	  // Iterate through first half of total menu items and populate first column
	  for($i = 0; $i < $splitItems; $i++){ 

	    // Display menu item, pass menu item object and featured item object
	    $str .= display_menu_item($menuObj['items'][$i],$featured);

	  };
	          
	  $str .= '</div>';

	  if($totalMenuItems > 1) :

		  // Start second column
		  $str .= '<div class="six columns">';

			// If 'right' layout, include featured menu item at top of right column
		  if($isFeatured && $layout === 'right') :
		  	// Display featured menu item
		  	$str .= display_featured_item($featured);
		  endif; 
		          
		  // Iterate through second half of total menu items and populate second column
		  // Starting 1 item before half to better balance against featured item image
		  for($i = $splitItems; $i < $totalMenuItems; $i++){

		  	$str .= display_menu_item($menuObj['items'][$i],$featured);
		    
		  };
		          
			// Closing second column
			$str .= '</div>';

		endif;
	  
	  // Closing menu category row
	  $str .= '</div>';

	  return $str;

	endif;
}