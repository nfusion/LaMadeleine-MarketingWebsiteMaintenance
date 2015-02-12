<?php
// rebuild cache file if it hasn't been done today
if ( !file_exists('locations.cache') || filemtime('locations.cache') < strtotime( date("Y-m-d") ) ) {
	if (substr($_SERVER['HTTP_HOST'],0,5) == "local") {
		$con=mysqli_connect("chiang.office.nfusion","LAM-main","Chees3Cr0issant","lam_main_legacy");
	} else {
		$con=mysqli_connect("localhost","LAM-main","Chees3Cr0issant","lam_main_legacy");
	}
	
	$result = mysqli_query($con,"SELECT * FROM wp_store_locator WHERE sl_catering = 1 ORDER BY sl_state ASC, sl_city ASC");

	$state_list = array('AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming', 'DC' => 'District of Columbia');
	$current_state = '';
	$location_links = '';
	$location_items = '';
	$states_menu = '';
	$count = 0;
	$all_locations = array();

	while($row = mysqli_fetch_array($result)) {
		if(!$row['sl_region']) $row['sl_region'] = $row['sl_city'];

		$all_locations[strtoupper($row['sl_state'])][$row['sl_region']][] = $row;
	}

	mysqli_close($con);

	foreach ($all_locations as $state => $regions) {
		$states_menu .= '<li><a href="/#' . $state . '">' . $state_list[$state] . '</a></li>';
		$location_links .= ($location_links == '') ? '<a href="#' . $state . '">' . $state_list[$state] . '</a>' : '&emsp;|&emsp;<a href="#' . str_replace(" ", "_", $state) . '">' . $state_list[$state] . '</a>';
		
		$location_items .= '<div id="' . $state . '" class="state_group">' . "\n" .
			'<h3>' . $state_list[$state] . '</h3>' . "\n";

		foreach ($regions as $region => $region_locations) {
			$count = 0;

			$location_items .= '<div class="region_group">' . "\n" .
				'<h4>' . $region . '</h4>' . "\n";

			foreach ($region_locations as $location) {
				$location_items .= '<div class="location_item item' . ($count + 1) . '">' . "\n" .
					'<span class="location_name">' . $location['sl_store'] . '</span>' . "\n" .
					'<span class="location_street">' . $location['sl_address'] . '</span>' . "\n" .
					'<span class="location_street2">' . $location['sl_address2'] . '</span>' . "\n" .
					'<span class="location_citystatezip">' . $location['sl_city'] . ', ' . strtoupper($location['sl_state']) . ' ' . $location['sl_zip'] . '</span>' . "\n" .
					'<span class="location_phone">' . $location['sl_phone'] . '</span>' . "\n" .
					'<span class="location_menu"><a href="http://order.cateringbylamadeleine.com/" title="Click to Order" target="_blank">Click to Order</a></span>' . "\n" .
					'</div>' . "\n";

				$count = 1 - $count;
			}

			$location_items .= '</div>' . "\n";
		}

		$location_items .= '</div>' . "\n";
	}

	$locations = '<div id="jump_links">' . "\n" . $location_links . "\n" . '</div>' . $location_items;

	$fp = fopen('locations.cache', 'w');
	fwrite($fp, $locations);
	fclose($fp);

	$fp = fopen('states.cache', 'w');
	fwrite($fp, $states_menu);
	fclose($fp);
}
else {
	// Cache has been created for today
	$locations = file_get_contents('locations.cache');
	$states_menu = file_get_contents('states.cache');
}
?><!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie10 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie10 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />

	<title>Catering by La Madeleine</title>

	<meta name="author" content="" />

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="shortcut icon" href="/img/favicon.ico">
	<link rel="apple-touch-icon" sizes="57x57" href="/img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/img/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/img/apple-touch-icon-114x114.png">

	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/modernizr-2.5.3.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Lobster' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	
	<!--jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/jquery-1.7.2.min.js"><\/script>')</script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/script.js"></script>

	<?php wp_head(); ?> 
</head>

<body <?php body_class( $class ); ?>> 
	<header id="header" class="navbar" role="banner">
		<div class="container">
			<div class="brand"><a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="Catering by La Madeleine" /></a></div>
			<div id="mobile_nav">
				<div id="mobile_open"></div>
				<div id="mobile_close">Close</div>
			</div>
			<nav id="nav_main" role="navigation">
			<?php echo wp_nav_menu( array( 'theme_location' => 'left-menu', 'container_class' => 'left_nav' ) ); ?>
			<?php echo wp_nav_menu( array( 'theme_location' => 'right-menu', 'container_class' => 'right_nav' ) ); ?>
			</nav>
		</div>
	</header>
