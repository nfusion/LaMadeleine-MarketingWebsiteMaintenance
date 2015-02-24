<?php
/*
Template Name: Checkout
*/

if($_POST['buy_button']) {
	$amounts = calcuate_amounts();
}
elseif($_POST['confirm']) {
	$amounts = calcuate_amounts();
	$secure_token = create_secure_token($amounts);
}

function calcuate_amounts() {
	$weight = array(
		'soup' => 88,
		'dressing' => 56
	);
	$price = array(
		'soup' => 12.99,
		'dressing' => 9.99
	);
	$shipping_rates = array(5.68, 6.54, 7.25, 7.73, 8.18, 7.99, 8.27, 8.79, 9.36, 9.99, 10.12, 10.86, 11.60, 12.34, 13.08, 13.70, 14.38, 15.10, 15.83, 16.57, 16.30, 17.00, 17.69, 18.38, 19.07, 19.75, 20.44, 21.15, 21.87, 22.57, 23.25, 23.95, 24.63, 25.31, 25.97, 26.59, 27.10, 27.61, 28.12, 28.63, 29.14, 29.65, 30.16, 30.66, 31.17, 31.69, 32.20, 32.71, 33.22, 33.73);

	$weight_total = 0;
	$price_total = 0;

	$soup_count = (int) $_POST['soup_count'];
	$dressing_count = (int) $_POST['dressing_count'];
	
	if( $soup_count > 0) {
		$weight_total += $soup_count * $weight['soup'];
		$price_total += $soup_count * $price['soup'];
	}
	
	if( $dressing_count > 0) {
		$weight_total += $dressing_count * $weight['dressing'];
		$price_total += $dressing_count * $price['dressing'];
	}

	if(ceil($weight_total / 16) > 50) {
		$shipping_total = 35.73;
	}
	else {
		$shipping_total = $shipping_rates[ceil($weight_total / 16) - 1] + 2.00;
	}

	if($_POST['state']) {
		switch($_POST['state']) {
			case "VA":
				$tax_total = round($price_total * 0.05, 2);
				break;
			case "MD":
				$tax_total = round($price_total * 0.06, 2);
				break;
			case "LA":
				$tax_total = round($price_total * 0.08, 2);
				break;
			default:
				$tax_total = 0;
				break;
		}

		return array(number_format($price_total, 2), number_format($shipping_total, 2), number_format($price_total + $shipping_total + $tax_total, 2), number_format($tax_total, 2));
	}
	else {
		return array(number_format($price_total, 2), number_format($shipping_total, 2), number_format($price_total + $shipping_total, 2));
	}
}

function create_secure_token($amts) {
	$PF_USER      = '1amad3l3in3';
	$PF_VENDOR    = '1amad3l3in3';
	$PF_PARTNER   = 'verisign';
	$PF_PWD       = 'cr01ssant';
	$PF_MODE      = 'LIVE';
//	$PF_HOST_ADDR = 'https://pilot-payflowpro.paypal.com';
	$PF_HOST_ADDR = 'https://payflowpro.paypal.com';

	$secure_token_id = uniqid('', true);

	$soup_count = (int) $_POST['soup_count'];
	$dressing_count = (int) $_POST['dressing_count'];

	$comment =  $soup_count . ' Tomato Basil Soupe Trio; ' . $dressing_count . ' Salade Dressing Duet - ' . $_POST['dressing1'] . ', ' . $_POST['dressing2'];

	$post_data = "USER=" . $PF_USER . 
	             "&VENDOR=" . $PF_VENDOR . 
	             "&PARTNER=" . $PF_PARTNER . 
	             "&PWD=" . $PF_PWD . 

	             "&SHIPTOFIRSTNAME=" . $_POST['first_name'] . 
	             "&SHIPTOLASTNAME=" . $_POST['last_name'] . 
	             "&SHIPTOSTREET=" . $_POST['address'] . 
	             "&SHIPTOCITY=" . $_POST['city'] . 
	             "&SHIPTOSTATE=" . $_POST['state'] . 
	             "&SHIPTOZIP=" . $_POST['zip'] . 

	             "&USER1=" . $soup_count . 
	             "&USER2=" . $dressing_count . 
	             "&USER3=" . $_POST['dressing1'] . 
	             "&USER4=" . $_POST['dressing2'] . 
	             "&USER5=" . $_POST['personal'] . 
	             "&COMMENT1=" . $comment . 
	             "&COMMENT2=" . $_POST['personal'] . 

	             "&CREATESECURETOKEN=Y" . 
	             "&SECURETOKENID=" . $secure_token_id . 
	             "&TRXTYPE=S" . 
	             "&AMT=" . $amts[2] . 
	             "&TAXAMT=" . $amts[3] . 
	             "&FREIGHTAMT=" . $amts[1];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $PF_HOST_ADDR);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

	$resp = curl_exec($ch);

	if(!$resp) {
		return "ERROR";
	}

	parse_str($resp, $arr);

	if($arr['RESULT'] != 0) {
		return "ERROR";
	}

	return array($arr['SECURETOKEN'],$secure_token_id);
}
?>
<?php get_header(); ?>

	<?php roots_content_before(); ?>

	<div id="content" role="main">

		<?php roots_loop_before(); ?>

		<?php while (have_posts()) { /* Start loop */
			the_post(); ?>

			<?php roots_post_before(); ?>
			<?php roots_post_inside_before(); ?>

			<?php $page_info = get_post_custom(); ?>

			<div class="page-content">
				<?php the_content(); ?>
				<?php
				if(isset($amounts)) {
					echo '<p><strong>Sub-total:</strong> ' . $amounts[0] . '<br />' . 
						'<strong>Shipping:</strong> ' . $amounts[1] . '<br />' . 
						'<strong>Tax:</strong> ' . (isset($amounts[3]) ? $amounts[3] : 'calculated on confirmation page') . '<br />' . 
						'<strong>Total:</strong> ' . $amounts[2] . '</p>' . 
						'<p>' . (int) $_POST['soup_count'] . ' Tomato Basil Soupe Trio<br />' . 
						(int) $_POST['dressing_count'] . ' Salade Dressing Duet - ' . $_POST['dressing1'] . ', ' . $_POST['dressing2'] . '</p>';
				}
				if(isset($secure_token) && $secure_token == 'ERROR') {
					echo '<p>An error has occurred placing the order.</p>';
				}
				if(isset($secure_token) && $secure_token != 'ERROR') {
					echo '<form action="https://payflowlink.paypal.com/" method="POST">
						<input type="hidden" name="MODE" value="LIVE" />
						<input type="hidden" name="SECURETOKEN" value="' . $secure_token[0] . '" />
						<input type="hidden" name="SECURETOKENID" value="' . $secure_token[1] . '" />
						<input type="submit" value="Proceed to Checkout" />
						</form>';
				}
				else {
					echo '<form action="http://lamadeleine.com/store/shipping/" method="POST">
					<input type="hidden" name="soup_count" value="' . (int) $_POST['soup_count'] . '" />
					<input type="hidden" name="dressing_count" value="' . (int) $_POST['dressing_count'] . '" />
					<input type="hidden" name="dressing1" value="' . $_POST['dressing1'] . '" />
					<input type="hidden" name="dressing2" value="' . $_POST['dressing2'] . '" />
					<strong>First Name:</strong> <input type="text" name="first_name" /><br />
					<strong>Last Name:</strong> <input type="text" name="last_name" /><br />
					<strong>Shipping Address:</strong> <input type="text" name="address" /><br />
					<strong>City:</strong> <input type="text" name="city" /><br />
					<strong>State:</strong> <select name="state"><option value="">--- Select ---</option><option value="AK">Alaska</option><option value="AL">Alabama</option><option value="AR">Arkansas</option><option value="AZ">Arizona</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DC">District of Columbia</option><option value="DE">Delaware</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="IA">Iowa</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="MA">Massachusetts</option><option value="MD">Maryland</option><option value="ME">Maine</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MO">Missouri</option><option value="MS">Mississippi</option><option value="MT">Montana</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="NE">Nebraska</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NV">Nevada</option><option value="NY">New York</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VA">Virginia</option><option value="VT">Vermont</option><option value="WA">Washington</option><option value="WI">Wisconsin</option><option value="WV">West Virginia</option><option value="WY">Wyoming</option></select><br />
					<strong>Zip:</strong> <input type="text" name="zip" /><br /><br />
					<strong>Personal Message:</strong> <input type="text" name="personal" /><br />
					<input type="submit" name="confirm" value="Proceed to Confirmation" />
					</form>';
				}
				?>
			</div>

			<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>

			<?php roots_post_inside_after(); ?>
			<?php roots_post_after(); ?>

		<?php } /* End loop */ ?>

		<?php roots_loop_after(); ?>

		<div class="clear"></div>
	</div><!-- /#content -->
	
	<?php roots_content_after(); ?>

<?php get_footer(); ?>