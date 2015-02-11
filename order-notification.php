<?php
// Send an empty HTTP 200 OK response to acknowledge receipt of the notification 
header('HTTP/1.1 200 OK'); 

// for local testing we're faking an array
if (!$_POST) {
	$_POST = array(
    'residence_country' => 'US',
    'invoice' => 'abc1234',
    'address_city' => 'San Jose',
    'first_name' => 'John',
    'payer_id' => 'TESTBUYERID01',
    'mc_fee' => '0.44',
    'txn_id' => '898506186',
    'receiver_email' => 'seller@paypalsandbox.com',
    'custom' => 'xyz123',
    'payment_date' => '07:58:31 6 Aug 2014 PDT',
    'address_country_code' => 'US',
    'address_zip' => '95131',
    'item_name1' => 'something',
    'mc_handling' => '2.06',
    'mc_handling1' => '1.67',
    'tax' => '2.02',
    'address_name' => 'John Smith',
    'last_name' => 'Smith',
    'receiver_id' => 'seller@paypalsandbox.com',
    'verify_sign' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31A6W2smMXXPx.0xbQMm3PcxVz8GSK',
    'address_country' => 'United States',
    'payment_status' => 'Completed',
    'address_status' => 'confirmed',
    'business' => 'seller@paypalsandbox.com',
    'payer_email' => 'buyer@paypalsandbox.com',
    'notify_version' => '2.4',
    'txn_type' => 'cart',
    'test_ipn' => '1',
    'payer_status' => 'verified',
    'mc_currency' => 'USD',
    'mc_gross' => '15.34',
    'mc_shipping' => '3.02',
    'mc_shipping1' => '1.02',
    'item_number1' => 'AK-1234',
    'address_state' => 'CA',
    'mc_gross1' => '12.34',
    'payment_type' => 'instant',
    'address_street' => '123, any street'
	);
}
/*
// Send an email announcing the IPN message is VERIFIED
$mail_From    = "noreply@nfusion.com";
$mail_To      = "devteam@nfusion.com";
$mail_Subject = "IPN PayPal Transaction Raw Data";
$mail_Body    = print_r($_POST,1);
$header = 'From: '.$mail_From;
mail($mail_To, $mail_Subject, $mail_Body, $header);
*/
$use_sandbox = 1;

if ($use_sandbox) {
	$paypal_url = "ssl://www.sandbox.paypal.com";
} else {
	$paypal_url = "ssl://www.paypal.com";
}

// Assign payment notification values to local variables
  $item_name        = $_POST['item_name'];
  $item_number      = $_POST['item_number'];
  $payment_status   = $_POST['payment_status'];
  $payment_amount   = $_POST['mc_gross'];
  $payment_currency = $_POST['mc_currency'];
  $txn_id           = $_POST['txn_id'];
  $receiver_email   = $_POST['receiver_email'];
  $payer_email      = $_POST['payer_email'];
  
// Build the required acknowledgement message out of the notification just received
$req = 'cmd=_notify-validate';               // Add 'cmd=_notify-validate' to beginning of the acknowledgement

foreach ($_POST as $key => $value) {         // Loop through the notification NV pairs
	$value = urlencode(stripslashes($value));  // Encode these values
	$req  .= "&$key=$value";                   // Add the NV pairs to the acknowledgement
}

// Set up the acknowledgement request headers
$header  = "POST /cgi-bin/webscr HTTP/1.1\r\n";                    // HTTP POST request
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req);
$header .= "Connection: Close" . "\r\n\r\n";

// Open a socket for the acknowledgement request
$fp = fsockopen($paypal_url, 443, $errno, $errstr, 30);

if ($fp) {
	echo $req;
	// Send the HTTP POST request back to PayPal for validation
	fputs($fp, $header . $req);

	//while (!feof($fp)) {                     // While not EOF
		//$res = fgets($fp, 1024);               // Get the acknowledgement response
		$res = stream_get_contents($fp, 1024);
		echo $res;
		die;
		if (strcmp ($res, "VERIFIED") == 0) {  // Response contains VERIFIED - process notification
	
			// Send an email announcing the IPN message is VERIFIED
			$mail_From    = "noreply@nfusion.com";
			$mail_To      = "devteam@nfusion.com";
			$mail_Subject = "IPN PayPal Transaction Notification - Verified";
			$mail_Body    = $req;
			$header = 'From: '.$mail_From;
			mail($mail_To, $mail_Subject, $mail_Body, $header);

			// Authentication protocol is complete - OK to process notification contents

			// Possible processing steps for a payment include the following:

			// Check that the payment_status is Completed
			// Check that txn_id has not been previously processed
			// Check that receiver_email is your Primary PayPal email
			// Check that payment_amount/payment_currency are correct
			// Process payment

		} 
		else if (strcmp ($res, "INVALID") == 0) { //Response contains INVALID - reject notification

			// Authentication protocol is complete - begin error handling
		
			// Send an email announcing the IPN message is INVALID
			$mail_From    = "noreply@nfusion.com";
			$mail_To      = "devteam@nfusion.com";
			$mail_Subject = "IPN PayPal Transaction Notification - Rejected";
			$mail_Body    = $req;
			$header = 'From: '.$mail_From;

			mail($mail_To, $mail_Subject, $mail_Body, $header);
		}
	//}

fclose($fp);  // Close the file
} else {
	// Send an email announcing socket connection failed.
	$mail_From    = "noreply@nfusion.com";
	$mail_To      = "devteam@nfusion.com";
	$mail_Subject = "IPN - Socket connection failed.";
	$mail_Body    = "connection to ssl://www.sandbox.paypal.com failed.";
	$header = 'From: '.$mail_From;
	mail($mail_To, $mail_Subject, $mail_Body, $header);

}