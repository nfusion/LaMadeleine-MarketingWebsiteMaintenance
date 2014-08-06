<?php

// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
// Set this to 0 once you go live or don't require logging.
define("DEBUG", 1);

// Set to 0 once you're ready to go live
define("USE_SANDBOX", 1);


define("LOG_FILE", __DIR__ ."/ipn.log");


// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
	$keyval = explode ('=', $keyval);
	if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
	$get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
	if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
		$value = urlencode(stripslashes($value));
	} else {
		$value = urlencode($value);
	}
	$req .= "&$key=$value";
}

// Post IPN data back to PayPal to validate the IPN data is genuine
// Without this step anyone can fake IPN data

if(USE_SANDBOX == true) {
	$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
	$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}

$ch = curl_init($paypal_url);
if ($ch == FALSE) {
	return FALSE;
}

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

if(DEBUG == true) {
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}

// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);

// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.

$cert = __DIR__ . "/cacert.pem";
curl_setopt($ch, CURLOPT_CAINFO, $cert);

$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
	{
	if(DEBUG == true) {	
		error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
	}
	curl_close($ch);
	exit;

} else {
		// Log the entire HTTP response if debug is switched on.
		if(DEBUG == true) {
			error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
			error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);

			// Split response headers and payload
			list($headers, $res) = explode("\r\n\r\n", $res, 2);
		}
		curl_close($ch);
}

// Inspect IPN validation result and act accordingly

if (strcmp ($res, "VERIFIED") == 0) {
	// check whether the payment_status is Completed
	// check that txn_id has not been previously processed
	// check that receiver_email is your PayPal email
	// check that payment_amount/payment_currency are correct
	// process payment and mark item as paid.

	// assign posted variables to local variables
	//$item_name = $_POST['item_name'];
	//$item_number = $_POST['item_number'];
	//$payment_status = $_POST['payment_status'];
	//$payment_amount = $_POST['mc_gross'];
	//$payment_currency = $_POST['mc_currency'];
	//$txn_id = $_POST['txn_id'];
	//$receiver_email = $_POST['receiver_email'];
	//$payer_email = $_POST['payer_email'];
	
	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
	}
	extract($_POST,EXTR_PREFIX_ALL,'pp');
	
	// create array of payer data 
	$payer = array(
		'first_name' => $pp_first_name,
		'last_name' => $pp_last_name,
		'payer_business_name' => $pp_payer_business_name,
		'payer_email' => $pp_payer_email,
		'contact_phone' => $pp_contact_phone,
		'payer_id' => $pp_payer_id,
		
		'address_name' => $pp_address_name,
		'address_street' => $pp_address_street,
		'address_city' => $pp_address_city,
		'address_state' => $pp_address_state,
		'address_zip' => $pp_address_zip,
		'address_country_code' => $pp_address_country_code,
		'address_country' => $pp_address_country	
	);
	
	$txn_type = $_POST['txn_type'];
	
	// perform action by transaction type.
	switch($txn_type) {
		case 'cart':
			$cart = array();
			$items = array();
			$totals = array(
				'mc_gross' => $pp_mc_gross,
				'mc_fee' => $pp_mc_fee,
				'mc_shipping'=> $pp_mc_shipping,
				'mc_currency' => $pp_mc_currency,
				'exchange_rate' => $pp_exchange_rate,
				'memo' => $pp_memo
			);
			
			$cart['num_cart_items'] = $pp_num_cart_items;
			$i = 0;
			//shopping cart transaction
			//for multiple items, traverse the post array for all item elements.
			foreach ($_POST as $key->$val) {
				if ( !strpos($key,'item_name') === false ) {
					$product_index = substr($key, 10);
					$items[$i]['item_name'] = $val;
					$items[$i]['item_number'] = $_POST['item_number'.$product_index];
					$items[$i]['quantity'] = $_POST['quantity'.$product_index];
					$items[$i]['option'] = $_POST['option_name'.$product_index];
					// match to item number and quantity
					$i++;
				}
			}
			$cart['items'] = $items;
			
			// email dev

		
		$mail_Body = print_r($payer,1)."\n\n".print_r($totals,1)."\n\n".print_r($cart,1);
		
		// Send an email announcing the IPN message is VERIFIED
			$mail_From    = "noreply@nfusion.com";
			$mail_To      = "devteam@nfusion.com";
			$mail_Subject = "PayPal Cart Transaction Notification";
			//$mail_Body    = $req;
			$header = 'From: '.$mail_From;
			mail($mail_To, $mail_Subject, $mail_Body, $header);
			
			break;
	}
	
} else if (strcmp ($res, "INVALID") == 0) {
	// log for manual investigation
	// Add business logic here which deals with invalid IPN messages
	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
		
		// Send an email announcing the IPN message is INVALID
		$mail_From    = "noreply@nfusion.com";
		$mail_To      = "devteam@nfusion.com";
		$mail_Subject = "IPN PayPal Transaction Notification - Invalid";
		$mail_Body    = $req;
		$header = 'From: '.$mail_From;
		mail($mail_To, $mail_Subject, $mail_Body, $header);
	}
}