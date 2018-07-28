<?php
session_start();

error_reporting(E_ALL);


require "PHPMailer-master/PHPMailerAutoload.php";


$_POST = $_GET; //djrc added this to get all the other variables

if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    // $email_to = "ericchaffey@gmail.com";
    // $email_to = "derik@stressslesscompany.com";
    //$email_subject = "Your email subject line";

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


//-------------------------------------------------- mail ----------------------------------------------------------------------------------------
	// store some variables

	$allowedExtensions = array("pdf","doc","docx","gif","jpeg","jpg","png","rtf","txt");
	
	$mailBody['FullName'] = $full_name;
	$mailBody['PhoneNumber'] = $phone;
	$mailBody['Email'] = $email_from;
	$mailBody['Description'] = $comments;
	$counter = 0;
	
	$files = array();
	foreach($_FILES as $name=>$file) {
		$counter++;
		$file_name = $file['name']; 
		$temp_name = $file['tmp_name'];
		$file_type = $file['type'];
		$path_parts = pathinfo($file_name);
		$ext = $path_parts['extension'];
		$mailBody["Attachement".$counter] = $file_name;
		if(!in_array($ext,$allowedExtensions)) {
			die("File $file_name has the extensions $ext which is not allowed");
		}
		array_push($files,$file);
	}
	$message = json_encode($mailBody);
	

	
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
// $mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';  // Specify main and backup server
$mail->Port = "587";
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'gastestacct@gmail.com';                            // SMTP username
$mail->Password = 'tqxknjkfmjwndnoi';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = $email_from;
$mail->FromName = $full_name;
//$mail->addAddress('rderik@gmail.com', 'Derik Ramirez');  // Add a recipient
$mail->addAddress('ericchaffey@gmail.com', 'Eric');  // Add a recipient

// preparing attachments
for($x=0;$x<count($files);$x++){
	$mail->addAttachment($files[$x]['tmp_name'],$files[$x]['name']);         // Add attachments
}


$mail->Subject = 'Test Attachement';
$mail->Body    = $message;
$mail->AltBody = $message;

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';

//------------------------------------------------------------- end mail ----------------------------------------------------------------------------
}
?>
