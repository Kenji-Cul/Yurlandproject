<?php 
include_once "../projectlog.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $referral= $_POST['referral'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone_num = $_POST['number'];

if(empty($referral) || empty($email) || empty($firstname) || empty($lastname) || empty($phone_num)){
    $errormsg = "Please Fill in your Data";
}  
    else {
    $user = new User;
    $emailuser = $user->checkEmailAddress(check_input($email));
    if(!empty($emailuser)){
    $errormsg = "Email Address already exists";
    }else{
    $insertuser = $user->createReferralUser(check_input($referral), check_input($email),check_input($firstname), check_input($lastname),check_input($phone_num));
    }

}

    if(isset($errormsg)){
    echo $errormsg;
    }
    }

    function check_input($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    ?>