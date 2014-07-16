<?php

/*
  Plugin Name: LAM API  --- Thermal API Fork
  Version:     0.0.1   = forked from Thermal API Fork 0.12.0
  Plugin URI:  lamadeline.com
  Description: The power of WP_Query in a RESTful API.
  Author:     Christian Serna  -- Original Concept Voce Platforms
  Author URI:  http://nfussion.com/
 */




define( "THERMAL_API_MIN_PHP_VER", '5.3.0' );

register_activation_hook( __FILE__, 'thermal_activation' );

function thermal_activation() {
	if ( version_compare( phpversion(), THERMAL_API_MIN_PHP_VER, '<' ) ) {
		die( sprintf( "The minimum PHP version required for Thermal API is %s", THERMAL_API_MIN_PHP_VER ) );
	}
}

if ( version_compare( phpversion(), THERMAL_API_MIN_PHP_VER, '>=' ) ) {
  @include(__DIR__ . '/vendor/autoload.php');
	require(__DIR__ . '/dispatcher.php');
	new Voce\Thermal\API_Dispatcher();
}
