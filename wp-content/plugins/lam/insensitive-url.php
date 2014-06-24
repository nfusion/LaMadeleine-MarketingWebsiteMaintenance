<?php
  /*
  Plugin Name: insensitive-url
 * Plugin URI: http://lamadeleine.com/.com/
 * Description: Base custom functionality for La Mdeleine's 2014 site redesign.
 * Version: 1.0
 * Author: Christian Serna, nFusion Group, LLC
 * Author URI: http://nfusion.com
 */
  function insensitive() {
   if (preg_match('/[A-Z]/', $_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = strtolower($_SERVER['REQUEST_URI']);
    $_SERVER['PATH_INFO']   = strtolower($_SERVER['PATH_INFO']);
   }
  }
  add_action('init', 'insensitive');
 