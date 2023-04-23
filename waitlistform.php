<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
define("PASSWORD","cvofrbjulwvkkccb");
define("EMAIL","yurland.ng@gmail.com");
ob_start();


if($_SERVER['REQUEST_METHOD'] == "POST"){
   
if(isset($_POST['fgtpass'])){
    $fullname = $_POST['fullname'];
    $refcode = $_POST['refcode'];
    $emailFrom= $_POST['email'];
    $date =  date("M-d-Y");
    if(empty($fullname) || $fullname==""){
        $errormsg = "Fullname field is required";
       
    }
    elseif (!filter_var($emailFrom, FILTER_VALIDATE_EMAIL)) {
       $errormsg = "Invalid email format";
     }
    elseif(empty($emailFrom) || $emailFrom==""){
    $errormsg = "Email field required";
   
    }
 else {
        $mail = new PHPMailer(true);
$mail->SMTPDebug = 3;   
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->isHTML(true);
$mail->Username = EMAIL;
$mail->Password = PASSWORD;
// $mail->SetFrom('simpletech.notify@gmail.com', 'notification');
$mail->Subject = ''.$priority.  ' New Waitlist Mail from ' .$fullname.'';
$mail->Body = '<p>From: '.$fullname.'</p>
<p>Referral Code: '.$refcode.'</p>
<p>Date: '.$date.'</p>
<p>To further engage this contact,please find below details;</p>
<h3>'.$emailFrom.'</h3>';
$mail->AltBody = "This is the plain text version of the email content";
$mail->From = $emailFrom;
$mail->FromName = $fullname;
$mail->AddAddress("yurland.ng@gmail.com");
// $mail->addReplyTo('info@simpletech.com.ng');
try {
    $mail->send();
    echo "Your message has been sent";
   $successmsg = "Your message has been sent";
} catch (Exception $e) {  
    echo "Mailer Error: " . $mail->ErrorInfo;
    $errormsg = "Sorry,failed to send your message";
}


 }
 header("Location: waitlist.php?error=$errormsg&success=$successmsg");

}else{
    header("Location: index.php");
}

}

ob_end_flush();