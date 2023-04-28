<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// define("PASSWORD","cvofrbjulwvkkccb");
// define("EMAIL","yurland.ng@gmail.com");

include_once "enc.php";




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
$mail->Subject = 'Failed Transaction';
$url = "http://localhost/Yurland/login.php";
$mail->Body = '<div style="width:100%; height: 100%; background: #7e252b;
padding:8em; padding-left: 3em;">
    <p style="color: white; font-size: 24px;">Hi '.$_GET['name'].',</p>
    <p style="color: white; font-size: 14px;">
        Your autodebit payment on your subscribed land was unsuccessful today.
        You can log-in to your dashboard and use the <b>PayUp</b> button
        available on the <b>My Land</b> page to pay manually.
    </p>
    <p style="color: white; font-size: 14px;">Amount: &#8358;'.$_GET['amount'].'</p>
    <p style="color: white; font-size: 14px;">Status: <span style="color:red;">Failed</span></p>
    <a href="'.$url.'" style="text-decoration: none!important;"><button style="margin-top: 2em!important; padding: 0 1em; width: 370px!important; height: 44px!important; background: #7e252b!important; border-radius: 45px!important; border: none!important; color: #ffffff!important; font-size: 16px!important; cursor: pointer!important;">Login</button></a>
    <p style="color: white; font-size: 14px;">If you have any issues please contact our support team.</p>
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
?>