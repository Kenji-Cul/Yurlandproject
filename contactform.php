<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include_once "enc.php";
ob_start();


if($_SERVER['REQUEST_METHOD'] == "POST"){
   
if(isset($_POST['fgtpass'])){
    $fullname = $_POST['fullname'];
    $number = $_POST['phonenum'];
    $emailFrom= $_POST['email'];
    $message = $_POST['textinput'];
    $priority = $_POST['prior'];
    $date =  date("M-d-Y");
    if(empty($fullname) || $fullname==""){
        $errormsg = "Fullname field is required";
       
    }
    elseif(empty($number) || $number==""){
        $errormsg = "Phonenumber field required";
       
    }
    elseif (!filter_var($emailFrom, FILTER_VALIDATE_EMAIL)) {
       $errormsg = "Invalid email format";
     }
    elseif(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$message)) {
       $errormsg = "Please do not input a URL"; 
     }
    elseif(empty($emailFrom) || $emailFrom==""){
    $errormsg = "Email field required";
   
    }
    elseif(empty($message) || $message==""){
    $errormsg = "Message field required";
   
    }
    elseif(empty($priority) || $priority==""){
        $errormsg = "Priority field is required";
       
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
$mail->Subject = ''.$priority.  ' New Contact Mail from ' .$fullname.'';
$mail->Body = '<p>From: '.$fullname.'</p>
<p>Text Input: '.$message.'</p>
<p>Date: '.$date.'</p>
<p>To further engage this contact,please find below details;</p>
<h3>'.$emailFrom.' '.$number.'</h3>';
$mail->AltBody = "This is the plain text version of the email content";
$mail->From = $emailFrom;
$mail->FromName = $fullname;
$mail->AddAddress($mainemail);
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
 header("Location: contactus.php?error=$errormsg&success=$successmsg");

}else{
    header("Location: index.php");
}

}

ob_end_flush();