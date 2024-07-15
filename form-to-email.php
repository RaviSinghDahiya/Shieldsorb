<?php
if(!isset($_POST['submit'])){
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['txt_name'];
$visitor_email = $_POST['txt_email'];
$phone= $_POST['txt_phone'];
$message = $_POST['message'];

//Validate first
if(empty($name)||empty($visitor_email)){
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email)){
    echo "Bad email value!";
    exit;
}

$email_from = 'shieldsorb@gmail.com';//<== update the email address
$email_subject = "Query From Website Shieldsorb";
$email_body = "You have received a new Query from Website Shieldsorb \n \n".
                "Name: $name \n".
                "Email: $visitor_email \n".
                "Phone No: $phone \n".
               " Message: $message \n".
    
$to = "shieldsorb@gmail.com";//<== update the email address
$headers = "From: $email_from \r\ns";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str){
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 