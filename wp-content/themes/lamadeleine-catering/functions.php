<?php
/** La Madeleine Catering - functions.php
* 	Author: nFusion
*/

function header_menus() {
  register_nav_menus(
    array(
      'left-menu' => __( 'Left Header' ),
      'right-menu' => __( 'Right Header ' )
    )
  );
}
add_action( 'init', 'header_menus' );