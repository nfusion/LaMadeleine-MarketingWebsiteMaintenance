<?php // https://github.com/retlehs/roots/wiki

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

function wp_base_dir() {
		preg_match('!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches);
		if (count($matches) === 3) {
				return end($matches);
		} else {
				return '';
		}
}
function add_filters($tags, $function) {
		foreach($tags as $tag) {
				add_filter($tag, $function);
		}
}
define('WP_BASE', wp_base_dir());
define('THEME_NAME', next(explode('/themes/', get_template_directory())));
define('RELATIVE_PLUGIN_PATH', str_replace(site_url() . '/', '', plugins_url()));
define('FULL_RELATIVE_PLUGIN_PATH', WP_BASE . '/' . RELATIVE_PLUGIN_PATH);
define('RELATIVE_CONTENT_PATH', str_replace(site_url() . '/', '', content_url()));
define('THEME_PATH', RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);
// define('CSS_FRAMEWORK',  'skeleton');
define('POST_EXCERPT_LENGTH',  40);
define('GOOGLE_ANALYTICS_ID',  '');
define('INCLUDE_JQUERY',  true);

require_once locate_template('/Tax-meta-class/Tax-meta-class.php');
// require_once locate_template('/inc/lessc.inc.php');         // LESS CSS PHP Compiler
require_once locate_template('/inc/roots-activation.php');  // activation
require_once locate_template('/inc/roots-cleanup.php');     // cleanup
require_once locate_template('/inc/roots-htaccess.php');    // rewrites for assets, h5bp htaccess
require_once locate_template('/inc/roots-hooks.php');       // hooks
require_once locate_template('/inc/roots-actions.php');     // actions
require_once locate_template('/inc/roots-custom.php');      // custom functions
require_once locate_template('/inc/roots-plugins.php');     // Useful handy plugins included by default

// set the maximum 'Large' image width to the maximum grid width
// http://wordpress.stackexchange.com/q/11766
if (!isset($content_width)) { $content_width = 940; }


function roots_setup() {
	load_theme_textdomain('roots', get_template_directory() . '/lang');

	// tell the TinyMCE editor to use editor-style.css
	// if you have issues with getting the editor to show your changes then
	// use this instead: add_editor_style('editor-style.css?' . time());
	add_editor_style('editor-style.css');

	// http://codex.wordpress.org/Post_Thumbnails
	add_theme_support('post-thumbnails');
	// set_post_thumbnail_size(150, 150, false);

	// http://codex.wordpress.org/Post_Formats
	// add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus(array(
		'primary_navigation' => __('Primary Navigation', 'roots'),
		'footer_navigation' => __('Footer Navigation', 'roots'),
		'social_navigation' => __('Social Navigation', 'roots')
	));
}
add_action('after_setup_theme', 'roots_setup');

function roots_register_sidebars() {
	$sidebars = array( 'Footer', 'Sidebar' );

	foreach($sidebars as $sidebar) {
		register_sidebar(
			array(
				'id'            => 'roots-' . sanitize_title($sidebar),
				'name'          => __($sidebar, 'roots'),
				'description'   => __($sidebar, 'roots'),
				'before_widget' => '<article id="%1$s" class="widget %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></article>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
			)
		);
	}
}
add_action('widgets_init', 'roots_register_sidebars');

function load_jquery() {

		// only use this method is we're not in wp-admin
		if (!is_admin())
		{

				// deregister the original version of jQuery
				wp_deregister_script('jquery');

				// register it again, this time with no file path
				wp_register_script('jquery', '', FALSE, '1.7.2', FALSE, TRUE);

				// add it back into the queue
				wp_enqueue_script('jquery');

		}

}

add_action('template_redirect', 'load_jquery');