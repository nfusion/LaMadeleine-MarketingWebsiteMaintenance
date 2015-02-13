<?php
add_filter('widget_text', 'do_shortcode');


/* Custom shortcode */
add_shortcode( 'buildnav', 'buildnav_shortcode' );

function buildnav_shortcode($attr) {

	extract(shortcode_atts(array(
		'nav'        => null
	), $attr));

    // Do some cool stuff here
	$ret = '
<div id="franchiseNav">
  <ul>
    <li><a href="/franchise/company-overview">Company Overview</a></li>
    <li><a href="/franchise/get-started">Get Started</a></li>
    <li><a href="/franchise/support">Support</a></li>
    <li><a href="/franchise/real-estate">Real Estate</a></li>
    <li><a href="/franchise/request-information">Request Information</a></li>
  </ul>
</div>';

	return $ret;
}




/* Custom Taxonomy Meta Fields */
$tax_custom_prefix = 'tax_';
$tax_custom_config = array(
    'id' => 'custom_id',
    'title' => 'Custom Information',
    'pages' => array('custom-tax'),
    'context' => 'normal',
    'fields' => array(),
    'local_images' => false,
    'use_with_theme' => false
);
$tax_custom_meta = new Tax_Meta_Class($tax_custom_config);
$tax_custom_meta->addText($tax_custom_prefix.'custom_tax_field',array('name'=> __('Custom Tax Field','tax-meta')));
$tax_custom_meta->Finish();