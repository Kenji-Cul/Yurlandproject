<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
define("PASSWORD","cvofrbjulwvkkccb");
define("EMAIL","yurland.ng@gmail.com");
ob_start();


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $userEmail = $_POST['email'];
    if(empty($userEmail)){
       header("Location: subadminpassword.php?user=Please input your email");
    } 

   



if(isset($_POST['fgtpass'])){
       $random = mt_rand(100000,999999);
    //    session_start();
    //    $_SESSION['random'] = $random;
    $selector = bin2hex(random_bytes(8));
    // $token = random_bytes(32);
    

    $url = "http://localhost/Yurland/subadminrandom.php?selector=". $selector. "&rand=". $random;;

    // $expires = date("U") + 1800;

    require "db.php";

   
  

   
    



        // $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
        // $conn = mysqli_stmt_init($dbcon);

        // if(mysqli_stmt_prepare($conn,$sql)){
        //      mysqli_stmt_bind_param($conn, "s", $userEmail);
        //      mysqli_stmt_execute($conn);
        // }else{
        //     echo "There was an error";
        //     exit();
        // }

        // $sql = "INSERT INTO pwdreset(pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES(?,?,?,?)";

        // $conn = mysqli_stmt_init($dbcon);

        // if(mysqli_stmt_prepare($conn,$sql)){
        //     $hashedToken = password_hash($token,PASSWORD_DEFAULT);
        //      mysqli_stmt_bind_param($conn, "ssss", $userEmail,$selector,$hashedToken,$expires);
        //      mysqli_stmt_execute($conn);
        // }else{
        //     echo "There was an error";
        //     exit();
        // }


        $sql2 = "UPDATE sub_admin SET token='{$selector}' WHERE subadmin_email = '{$userEmail}'";
        $conn = mysqli_stmt_init($dbcon);

        if(mysqli_stmt_prepare($conn,$sql2)){
             mysqli_stmt_execute($conn);
        }else{
            echo "Please this is an invalid User";
            exit();
        }

        
      

      
        // mysqli_stmt_close($conn);

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
$mail->Subject = 'Reset your password for Yurland';
$mail->Body = '<p>We received a password reset request. The link to reset your password is below 
to make this request, you can ignore this email</p><br><p>Here is your 6 digit code: '.$random.'<br>
This is your reset link '.$url.'
</p>';
$mail->AltBody = "This is the plain text version of the email content";
$mail->From = "gideonboy012@gmail.com";
$mail->FromName = "Yurland";
$mail->AddAddress($userEmail);
// $mail->addReplyTo('info@simpletech.com.ng');
try {
    $mail->send();
    echo "success";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

header("Location: subadminpassword.php?reset=success");


}else{
    header("Location: index.php");
}
}

ob_end_flush();