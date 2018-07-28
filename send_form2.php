<?php


if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "ericchaffey@gmail.com";
    //$email_to = "gtmoffice7@gmail.com";
    $email_subject = "Your email subject line";

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

        // validation expected data exists
    if( !empty($_POST['biz_email'])) {
        died('We are sorry, but this appears to be a spam submission.');       
    }

    // validation expected data exists
    if(!isset($_POST['full_name']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['email']) ||        
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }

    $full_name = $_POST['full_name']; // required
    $phone = $_POST['phone']; // required
    $email_from = $_POST['email']; // required    
    $comments = $_POST['comments']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $full_name_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($full_name_exp,$full_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
    $phone_exp = '/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/';
  if(!preg_match($phone_exp,$phone)) {
    $error_message .= 'The Phone Number you entered does not appear to be valid.<br />';
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

    $email_message .= "Full Name: ".clean_string($full_name)."\n";
    $email_message .= "Phone #: ".clean_string($phone)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";   
    $email_message .= "Description: ".clean_string($comments)."\n";

 //create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
echo "Full Name: ".$full_name."</br>"; 
echo "Phone #: ".$phone."</br>"; 
echo "Your Email: ".$email_from."</br>";  
echo "Description: ".$comments."</br>";  
echo "<span class=\"label label-info\" >Your message has been submitted .. Thank you</span><br>";
    
    
}






?>
