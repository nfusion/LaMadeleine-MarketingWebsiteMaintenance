<?php
/*
Template Name: Menu Redirect
*/
// date_default_timezone_set('America/Chicago');

// while (have_posts()) { /* Start loop */
// 	the_post();

// 	$page_info = get_post_custom();

// 	$redirects = explode("\n", $page_info['wpcf-redirects'][0]);

// 	$now = date('G');

// 	foreach($redirects as $redirect) {
// 		if($redirect) {
// 			$redirect_parts = explode("|", $redirect);
// 			if(isset($redirect_parts[2])) {
// 				if($now >= $redirect_parts[1] && $now < $redirect_parts[2]) {
// 					header("Location: " . $redirect_parts[0] . (is_numeric($_GET['price_tier']) ? '?price_tier=' . $_GET['price_tier'] : ''));
// 					die;
// 				}
// 			} else {
// 				header("Location: " . $redirect_parts[0] . (is_numeric($_GET['price_tier']) ? '?price_tier=' . $_GET['price_tier'] : ''));
// 				die;
// 			}
// 		}
// 	}

// } /* End loop */


while (have_posts()) { /* Start loop */
	the_post();

	$page_info = get_post_custom();
	$redirects = explode("\n", $page_info['wpcf-redirects'][0]);
	$firstRedirect = true;
	$jsOutput = '';

	foreach($redirects as $redirect) {
		if($redirect) {
			$redirect_parts = explode("|", $redirect);
			if(isset($redirect_parts[2])) {
				if($firstRedirect) {
					$jsOutput .= "if (hours >= " . $redirect_parts[1] . " && hours < " . $redirect_parts[2] . "){" . "\n" .
						"loc = '" . $redirect_parts[0] . ( is_numeric($_GET['price_tier']) ? '?price_tier=' . $_GET['price_tier'] : '' ) . "';" . "\n" .
					"}" . "\n";
					$firstRedirect = false;
				}
				else {
					$jsOutput .= "else if (hours >= " . $redirect_parts[1] . " && hours < " . $redirect_parts[2] . "){" . "\n" .
						"loc = '" . $redirect_parts[0] . ( is_numeric($_GET['price_tier']) ? '?price_tier=' . $_GET['price_tier'] : '' ) . "';" . "\n" .
					"}" . "\n";
				}
			} else {
				if($firstRedirect) {
					$jsOutput .= "loc = '" . $redirect_parts[0] . ( is_numeric($_GET['price_tier']) ? '?price_tier=' . $_GET['price_tier'] : '' ) . "';" . "\n";
					$firstRedirect = false;
				}
				else {
					$jsOutput .= "else {" . "\n" .
						"loc = '" . $redirect_parts[0] . ( is_numeric($_GET['price_tier']) ? '?price_tier=' . $_GET['price_tier'] : '' ) . "';" . "\n" .
					"}" . "\n";
				}
			}
		}
	}

} /* End loop */

?>
<script type="text/javascript">
var now = new Date();
var hours = now.getHours();
<?php echo $jsOutput; ?>
window.location = loc;
</script>