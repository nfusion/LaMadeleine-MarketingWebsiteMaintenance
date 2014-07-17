<?php 
if ($_POST) {
$ppl = '/apache/hosts/lamadeleine.nfusion.com/legacy-main/prod/ppl.log'; // Pay Pal Log File
/*
	$req = '';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$req .= "&$key=$value";
	}
	$fileData = $req;

	$orderData = '';
	if($_POST['USER1'] > 0) {
		$orderData .= 'Tomato Basil Soupe Trio ' . $_POST['USER1'] . ' $12.99 each $' . ($_POST['USER1'] * 12.99) . "\n";
	}
	if($_POST['USER2'] > 0) {
		$orderData .= 'Salade Dressing Duet ' . $_POST['USER2'] . ' $9.99 each $' . ($_POST['USER2'] * 9.99) . "\n";
		$orderData .= '  ' . $_POST['USER3'] . "\n";
		$orderData .= '  ' . $_POST['USER4'] . "\n";
	}

	if($_POST['RESPMSG'] == "Approved") { // Successful transaction
		$fileData = "APPROVED: " . $fileData;
	}
	else { // Failed transaction
		$fileData = "ERROR: " . $fileData;
	}
	
	// Log data into file
	$fileData = date("Y-m-d H:i:s") . " :: " . $fileData;
	
	$ppl = '/apache/hosts/lamadeleine.nfusion.com/legacy-main/prod/ppl.log'; // Pay Pal Log File
	
	$fh = fopen($ppl, 'a') or die("can't open file");
	fwrite($fh, $fileData . "\n");
	fclose($fh);

	// Log data into database
	function prepare_value($value, $mysqli) {
		return $mysqli->real_escape_string(trim($value));
	}

	$con = new mysqli("localhost","LAM-main","Chees3Cr0issant","lam_main_legacy");

	$dbData = array(
		'response_time' => date("Y-m-d H:i:s"),
		'payment_time' => date("Y-m-d H:i:s", strtotime($_POST['TRANSTIME'])),
		'status' => prepare_value($_POST['RESPMSG'], $con),
		'transaction' => prepare_value($_POST['PNREF'], $con),
		'bill_email' => prepare_value($_POST['EMAIL'], $con),
		'bill_phone' => prepare_value($_POST['PHONE'], $con),
		'bill_first_name' => prepare_value($_POST['FIRSTNAME'], $con),
		'bill_last_name' => prepare_value($_POST['LASTNAME'], $con),
		'bill_full_name' => prepare_value($_POST['NAME'], $con),
		'bill_address' => prepare_value($_POST['ADDRESS'], $con),
		'bill_city' => prepare_value($_POST['CITY'], $con),
		'bill_state' => prepare_value($_POST['STATE'], $con),
		'bill_zipcode' => prepare_value($_POST['ZIP'], $con),
		'bill_country' => prepare_value($_POST['COUNTRY'], $con),
		'ship_full_name' => prepare_value($_POST['NAMETOSHIP'], $con),
		'ship_address' => prepare_value($_POST['ADDRESSTOSHIP'], $con),
		'ship_city' => prepare_value($_POST['CITYTOSHIP'], $con),
		'ship_state' => prepare_value($_POST['SHIPTOSTATE'], $con),
		'ship_zipcode' => prepare_value($_POST['ZIPTOSHIP'], $con),
		'ship_country' => prepare_value($_POST['COUNTRYTOSHIP'], $con),
		'amount' => prepare_value($_POST['AMT'], $con),
		'tax' => prepare_value($_POST['TAX'], $con),
		'order' => prepare_value($orderData, $con),
		'transaction_string' => prepare_value($fileData, $con),
	);

	$keyFields = "`" . implode("`, `", array_keys($dbData)) . "`";
	$valueFields = "'" . implode("', '", $dbData) . "'";

	$query = "INSERT INTO `wp_order_history` (" . $keyFields . ") VALUES (" . $valueFields . ")";
	$con->query($query);
*/


	// Send fulfillment emails
	if($_POST['RESPMSG'] == "Approved") {
		$subtotal = ($_POST['USER1'] * 12.99) + ($_POST['USER2'] * 9.99);
		$shiptotal = $_POST['AMT'] - ($subtotal + $_POST['TAX']);

		$mailSubject = 'La Madeleine Order Summary';
		$mailBody    = '
Order Summary

Transaction ID: ' . $_POST['PNREF'] . '

' . $orderData . '

Subtotal: $' . number_format($subtotal, 2) . '
Shipping and Handling: $' . number_format($shiptotal, 2) . '
Tax: $' . number_format($_POST['TAX'], 2) . '
Total: $' . number_format($_POST['AMT'], 2) . '

Information
  ' . $_POST['FIRSTNAME'] . '
  ' . $_POST['LASTNAME'] . '
  ' . $_POST['EMAIL'] . '
  ' . $_POST['PHONE'] . '

Personal Note
  ' . $_POST['USER5'] . '
    

Billing Address
  ' . $_POST['ADDRESS'] . '
  ' . $_POST['CITY'] . ', ' . $_POST['STATE'] . ' ' . $_POST['ZIP'] . '

Shipping Address
  Recipient: ' . $_POST['NAMETOSHIP'] . '

  ' . $_POST['ADDRESSTOSHIP'] . '
  ' . $_POST['CITYTOSHIP'] . ', ' . $_POST['STATETOSHIP'] . ' ' . $_POST['ZIPTOSHIP'] . '
';

		require_once('/apache/hosts/lamadeleine.nfusion.com/2014-main/prod/phpmailer/PHPMailerAutoload.php');

		$mail = new PHPMailer;

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'localhost';              		      // Specify main and backup server
#		$mail->Host = 'smtp.sendgrid.net';                    // Specify main and backup server
#		$mail->SMTPAuth = true;                               // Enable SMTP authentication
#		$mail->Username = 'lamadeleine';                      // SMTP username
#		$mail->Password = 'Br33z3s12';                        // SMTP password
#		$mail->Port = '465';                                  // SMTP port
#		$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

		$mail->From = 'noreply@lamadeleine.com';
		$mail->FromName = 'La Madeleine';
		$mail->addAddress('rthomas@gourmet-cuisine.com');
		$mail->addAddress('homekitchen@gourment-cuisine.com');
		$mail->addAddress('customerservice@gourmet-cuisine.com');
		$mail->addAddress('lamadeleineorders@lamadeleine.com');
		// $mail->AddBCC('devteam@nfusion.com');
		// $mail->addAddress('kyle.jordan@gddinteractive.com', 'Kyle Jordan');  // Add a recipient
		// $mail->addAddress('melissa.temling@gddinteractive.com', 'Melissa Temling');  // Add a recipient
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		// $mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $mailSubject;
		$mail->Body = $mailBody;
		// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


		if(!$mail->send()) {
			$fh = fopen($ppl, 'a') or die("can't open file");
			fwrite($fh, 'FULFILLMENT MAIL ERROR!' . "\n");
			fclose($fh);
			die;
		}

		// Send email confirmation to customer
		$mail2 = new PHPMailer;

		$mail2->isSMTP();                                      // Set mailer to use SMTP
		$mail2->Host = 'localhost'; 		                   // Specify main and backup server
#		$mail2->Host = 'smtp.sendgrid.net';                    // Specify main and backup server
#		$mail2->SMTPAuth = true;                               // Enable SMTP authentication
#		$mail2->Username = 'lamadeleine';                      // SMTP username
#		$mail2->Password = 'Br33z3s12';                        // SMTP password
#		$mail2->Port = '465';                                  // SMTP port
#		$mail2->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

		$mail2->From = 'noreply@lamadeleine.com';
		$mail2->FromName = 'La Madeleine';
		$mail2->addAddress($_POST['EMAIL'], $_POST['NAME']);  // Add a recipient
		// $mail2->AddBCC('devteam@nfusion.com');

		$mail2->Subject = $mailSubject;
		$mail2->Body = $mailBody;

		if(!$mail2->send()) {
			$fh = fopen($ppl, 'a') or die("can't open file");
			fwrite($fh, 'CUSTOMER MAIL ERROR!' . "\n");
			fclose($fh);
			die;
		}

		// Send email confirmation to GDD
		$mail3 = new PHPMailer;

		$mail3->isSMTP();                                      // Set mailer to use SMTP
		$mail3->Host = 'localhost';         		           // Specify main and backup server
#		$mail3->Host = 'smtp.sendgrid.net';                    // Specify main and backup server
#		$mail3->SMTPAuth = true;                               // Enable SMTP authentication
#		$mail3->Username = 'lamadeleine';                      // SMTP username
#		$mail3->Password = 'Br33z3s12';                        // SMTP password
#		$mail3->Port = '465';                                  // SMTP port
#		$mail3->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

		$mail3->From = 'noreply@lamadeleine.com';
		$mail3->FromName = 'La Madeleine';
		$mail3->addAddress('lamadorders@lamadeleine.com');  // Add a recipient
		$mail3->AddBCC('rfrace@nfusion.com');
		// $mail3->addAddress('kyle.jordan@gddinteractive.com', 'Kyle Jordan');  // Add a recipient
		// $mail3->addAddress('melissa.temling@gddinteractive.com', 'Melissa Temling');  // Add a recipient

		$mail3->Subject = $mailSubject;
		$mail3->Body = $mailBody;

		if(!$mail3->send()) {
			$fh = fopen($ppl, 'a') or die("can't open file");
			fwrite($fh, 'GDD MAIL ERROR!' . "\n");
			fclose($fh);
			die;
		}
	}
}
die;