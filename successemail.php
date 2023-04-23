<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// define("PASSWORD","cvofrbjulwvkkccb");
// define("EMAIL","yurland.ng@gmail.com");

define("PASSWORD","gecxolzcdhjfeilm");
define("EMAIL","gideonteibo@gmail.com");
ob_start();

if($_GET['name'] == $_GET['payer']){
    $payer = "You";
} else {
    $payer = $_GET['payer'];
}

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
$mail->Subject = 'Transaction Successful';
$mail->Body = '<div style="width:100%; height: 100%; background: #7e252b;
 padding:8em; padding-left: 3em;">
    <p style="color: white; font-size: 24px;">Hi '.$_GET['name'].',</p>
    <p style="color: white; font-size: 14px;">
        Your payment was successful!.
    </p>
    <p style="color: white; font-size: 14px;">Date: '.$_GET['date'].'</p>
    <p style="color: white; font-size: 14px;">Estate: '.$_GET['estate'].'</p>
    <p style="color: white; font-size: 14px;">Amount Paid: &#8358;'.$_GET['amount'].'</p>
    <p style="color: white; font-size: 14px;">Balance: &#8358;'.$_GET['balance'].'</p>
    <p style="color: white; font-size: 14px;">Payer: '.$payer.'</p>
    <p style="color: white; font-size: 14px;">Thank you for your purchase!</p>
    <h2 style="color: white;">yurLAND Team</h2>
</div>';
$mail->AltBody = "This is the plain text version of the email content";
$mail->From = "gideonteibo@gmail.com";
$mail->FromName = "Yurland";
$mail->AddAddress($_GET['email']);
$mail->AddReplyTo('no-reply@example.com');
// $mail->addReplyTo('info@simpletech.com.ng');

try {
$mail->send();
echo "success";
} catch (Exception $e) {
echo "Mailer Error: " . $mail->ErrorInfo;
}

header("Location: verify5.php");
ob_end_flush();
?>