<?php 
include_once "../projectlog.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $referral= $_GET['refagent'];
    $personalref = $_POST['referral'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone_num = $_POST['number'];

if(empty($referral) || empty($email) || empty($firstname) || empty($lastname) || empty($phone_num)){
    $errormsg = "Please Fill in your Data";
}  

else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errormsg = "Invalid email format";
  }
    else {
    $user = new User;
    $emailuser = $user->checkEmailAddress(check_input($email));
    $emailuser2 = $user->checkAgentEmailAddress(check_input($email));
    $emailuser3 = $user->checkExecutiveEmailAddress(check_input($email));
    $emailuser4 = $user->checkSubadminEmailAddress(check_input($email));
    $emailuser5 = $user->checkSuperadminEmailAddress(check_input($email));
    if(!empty($emailuser) || !empty($emailuser2) || !empty($emailuser3) || !empty($emailuser4) || !empty($emailuser5)){
    $errormsg = "Email Address already exists";
    }else{
    $insertuser = $user->createReferralUser(check_input($referral), check_input($email),check_input($firstname), check_input($lastname),check_input($phone_num),check_input($personalref));
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