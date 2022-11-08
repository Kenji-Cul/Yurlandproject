<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['useremail'];
    $phone_num = $_POST['number'];
    $personalref = $_POST['referral'];
    $password = $_POST['password'];
    $referralID = $_POST['referralID'];

if(empty($firstname) || empty($lastname) || empty($email) || empty($phone_num) || empty($password) || empty($referralID)){
    $errormsg = "Please input all fields";
}  
else if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$password)){
    $errormsg = "Password must contain a special character";
    }

    else {
    $user = new User;
    $insertuser =
    $user->updateUserForReferral(check_input($firstname),check_input($lastname),check_input($email),check_input($phone_num),check_input($password),check_input($referralID),check_input($personalref));

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