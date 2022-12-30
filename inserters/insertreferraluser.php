<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['useremail'];
    $password = $_POST['password'];
    $referralID = $_GET['refuser'];
    

if(empty($email) || empty($password) || empty($referralID)){
    $errormsg = "Please input all fields";
}  
else if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$password)){
    $errormsg = "Password must contain a special character";
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errormsg = "Invalid email format";
    }

    else {
    $user = new User;
    $emailuser = $user->checkReferral(check_input($referralID), check_input($email));
    if(empty($emailuser)){
    $errormsg = "You have not being Referred";
    }else{
    $insertuser =
    $user->updateUser(check_input($email),check_input($password),check_input($referralID),$emailuser['unique_id']);
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