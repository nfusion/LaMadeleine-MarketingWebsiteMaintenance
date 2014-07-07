<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package required+ Starter
 * @since required+ Starter 0.1.0
 */
?><!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="shortcut icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- SHARETHIS  - REPLACE WITH ACTUAL ACCOUNT BEFORE LAUNCH -->
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "42ef3a71-5884-478e-a992-145b8a54c3c7", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
<?php
	wp_head();
?>
</head>
<body <?php body_class(); ?>>

	<?php include_once ('nav.php'); ?>

	<header id="header" role="banner">
		<div class="header-wrapper">
			<div class="icon-menu"><span>More</span></div>
			<div class="logo-wrapper">
				<a href="<?php echo get_site_url();?>">
					<img class="logo" alt="La Madeleine Logo" src="<?php echo get_stylesheet_directory_uri();?>/img/header/logo.png">
				</a>
				<img class="tagline" alt="Country French Cafe" src="<?php echo get_stylesheet_directory_uri();?>/img/header/tagline.png">
			</div>
			<div class="icon-wrapper">
				<div class="icon icon-phone lam-call"><a href="#"></a></div>
				<div class="icon icon-pin lam-geolocate"></div>
				<div class="loading">
          <div class="floatingCirclesG">
	          <div class="f_circleG frotateG_01">
	          </div>
	          <div class="f_circleG frotateG_02">
	          </div>
	          <div class="f_circleG frotateG_03">
	          </div>
	          <div class="f_circleG frotateG_04">
	          </div>
	          <div class="f_circleG frotateG_05">
	          </div>
	          <div class="f_circleG frotateG_06">
	          </div>
	          <div class="f_circleG frotateG_07">
	          </div>
	          <div class="f_circleG frotateG_08">
	          </div>
          </div>
      </div>
			</div>
		</div>
	</header>
	
	<div id="container" class="container" role="document">