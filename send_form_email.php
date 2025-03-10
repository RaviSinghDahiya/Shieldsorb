<?php
if(isset($_POST['email'])) {

// EDIT THE 2 LINES BELOW AS REQUIRED
$email_to = "shieldsorb@gmail.com";
$email_subject = "Query from Website | Shieldsorb";

function died($error) {
	// your error code can go here
	echo "We are very sorry, but there were error(s) found with the form you submitted. ";
	echo "These errors appear below.<br /><br />";
	echo $error."<br /><br />";
	echo "Please go back and fix these errors.<br /><br />";
	die();
}

    // validation expected data exists
	if(!isset($_POST['txt_name']) ||
	!isset($_POST['txt_email']) ||
	!isset($_POST['txt_phone']) ||
	!isset($_POST['comments'])) {
		died('We are sorry, but there appears to be a problem with the form you submitted.');
	}


    $txt_name = $_POST['txt_name']; // required
    $txt_email = $_POST['txt_email']; // required
    $txt_phone = $_POST['txt_phone']; // not required
    $comments = $_POST['comments']; // required
    
    
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';


    if(!preg_match($email_exp,$txt_email)) {
    	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

	$string_exp = "/^[A-Za-z .'-]+$/";

	if(!preg_match($string_exp,$txt_name)) {
		$error_message .= 'The  Name you entered does not appear to be valid.<br />';
	}
	
	if(!preg_match($string_exp,$txt_company)) {
		$error_message .= 'The Company Name you entered does not appear to be valid.<br />';
	}

	if(strlen($comments) < 2) {
		$error_message .= 'The Comments you entered do not appear to be valid.<br />';
	}

	if(strlen($error_message) > 0) {
		died($error_message);
	}

	$email_message = "Form details below.\n\n";


	function clean_string($string) {
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad,"",$string);
	}

	$email_message .= " Name: ".clean_string($txt_name)."\n";
	$email_message .= "Email: ".clean_string($txt_email)."\n";
	$email_message .= "Phone No: ".clean_string($txt_phone)."\n";
	$email_message .= "Message: ".clean_string($comments)."\n";

// create email headers
$headers = 'From: '.$txt_email."\r\n".
'Reply-To: '.$txt_email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 
?>

<!-- include your own success html here -->

Thank you for contacting us. We will be in touch with you very soon.

<?php

}
?>