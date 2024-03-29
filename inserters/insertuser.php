<?php 
session_start();
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $referral = $_POST['referral'];
    $inforeferral = $_GET['refuser'];
    $phone_num = $_POST['number'];
    $password = $_POST['password'];

if(empty($firstname) || empty($lastname) || empty($email) || empty($phone_num) || empty($password)){
    $errormsg = "Please input all fields";
}  







else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errormsg = "Invalid email format";
  }
  
else if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$password)){
    $errormsg = "Password must contain a special character";
    }

    else {
    $user = new User;
    $newuser = $user->selectOneUser();
    $emailuser = $user->checkEmailAddress(check_input($email));
    $emailuser2 = $user->checkAgentEmailAddress(check_input($email));
    $emailuser3 = $user->checkExecutiveEmailAddress(check_input($email));
    $emailuser4 = $user->checkSubadminEmailAddress(check_input($email));
    $emailuser5 = $user->checkSuperadminEmailAddress(check_input($email));
    $yurlandpercentage = $newuser['yurland_percentage'];
    $earningpercentage = $newuser['earning_percentage'];
    if(!empty($emailuser) || !empty($emailuser2) || !empty($emailuser3) || !empty($emailuser4) || !empty($emailuser5)){
    $errormsg = "Email Address already exists";
    }else{
    if(isset($_GET['creator'])){
    if(isset($_SESSION['uniquesubadmin_id'])){
    $creatorid = $_SESSION['uniquesubadmin_id'];
    }

    if(isset($_SESSION['uniquesupadmin_id'])){
    $creatorid = $_SESSION['uniquesupadmin_id'];
    }
    $insertuser =
    $user->createUser2(check_input($firstname),check_input($lastname),check_input($email),check_input($phone_num),check_input($password),check_input($referral),check_input($inforeferral),$creatorid,$yurlandpercentage,$earningpercentage);
    } else {
    $insertuser =
    $user->createUser(check_input($firstname),check_input($lastname),check_input($email),check_input($phone_num),check_input($password),check_input($referral),check_input($inforeferral),$yurlandpercentage,$earningpercentage);
    }


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