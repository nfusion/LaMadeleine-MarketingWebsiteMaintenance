<?php

function roots_get_stylesheets()
{
	// $less = new lessc;
	// $less->checkedCompile(locate_template('/app.less.css'), locate_template('/css/app.css'));

	$styles = '';

	// $styles .= stylesheet_link_tag(CSS_FRAMEWORK . '.css', 1, true);
	$styles .= stylesheet_link_tag('lamad-app.css', 1, true);

	if (is_child_theme()) {
		$styles .= "\t<link rel=\"stylesheet\" href=\"" . get_stylesheet_uri() . "\">\n";
	}

	echo $styles;
}

function stylesheet_link_tag($file, $tabs = 0, $newline = true, $rel = 'stylesheet')
{
	$indent = str_repeat("\t", $tabs);
	return $indent . '<link rel="' . $rel . '" href="' . get_template_directory_uri() . '/css/' . $file . '">' . ($newline ? "\n" : "");
}

add_action('roots_stylesheets', 'roots_get_stylesheets');

function roots_scripts()
{
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', '', '', '', false);
	}

	if (is_single() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	wp_register_script('roots_script', get_template_directory_uri() . '/js/script.js', null, null, true);
	wp_enqueue_script('roots_script');
}

add_action('wp_enqueue_scripts', 'roots_scripts', 100);

function roots_google_analytics()
{
	if (GOOGLE_ANALYTICS_ID !== '') {
		echo "\n\t<script>\n";
		echo "\t\tvar _gaq=[['_setAccount','" . GOOGLE_ANALYTICS_ID . "'],['_trackPageview'],['_trackPageLoadTime']];\n";
		echo "\t\t(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];\n";
		echo "\t\tg.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';\n";
		echo "\t\ts.parentNode.insertBefore(g,s)}(document,'script'));\n";
		echo "\t</script>\n";
	}
}

add_action('roots_footer', 'roots_google_analytics');