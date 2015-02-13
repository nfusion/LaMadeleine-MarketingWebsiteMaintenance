
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie10 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie10 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />

	<title><?php wp_title(); ?> </title>

	<meta name="author" content="" />

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico">
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/modernizr-2.5.3.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Lobster' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	
	<!--jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/jquery-1.7.2.min.js"><\/script>')</script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/script.js"></script>

	<?php wp_head(); ?> 
</head>

<body <?php body_class(); ?>> 
	<header id="header" class="navbar" role="banner">
		<div class="container">
			<div class="brand"><a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="Catering by La Madeleine" /></a></div>
			<div id="mobile_nav">
				<div id="mobile_open"></div>
				<div id="mobile_close">Close</div>
			</div>
			<nav id="nav_main" role="navigation">
			<?php echo wp_nav_menu( array( 
				'theme_location' => 'left-menu', 
				'container_class' => 'left_nav',
				'walker' => new Walker_Left_Menu 
			) ); ?>
			<?php echo wp_nav_menu( array( 'theme_location' => 'right-menu', 'container_class' => 'right_nav' ) ); ?>
			</nav>
		</div>
	</header>
