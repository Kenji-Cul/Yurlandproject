<?php 
include_once "../projectlog.php";
//session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $agentname = $_POST['execname'];
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];
    $bankname = $_POST['bankname'];
    $accountnum = $_POST['accountnum'];
    $earning = $_POST['earning'];
    $filename = $_FILES['image']['name'];
    $unique = $_POST['uniqueuser'];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errormsg = "Invalid email format";
      }
       

    else {
    $user = new User;
    $emailuser = $user->checkEmailAddress(check_input($email));
    $emailuser2 = $user->checkAgentEmailAddress(check_input($email));
    $emailuser3 = $user->checkExecutiveEmailAddress(check_input($email));
    $emailuser4 = $user->checkSubadminEmailAddress(check_input($email));
    $emailuser5 = $user->checkSuperadminEmailAddress(check_input($email));
    $emailuser6 = $user->selectExecutiveEmail($unique);
    if(!empty($emailuser) || !empty($emailuser4) || !empty($emailuser2) || !empty($emailuser5)){
    $errormsg = "Email Address already exists";
    }else if($emailuser6['executive_email'] != $email && !empty($emailuser3)){
      $errormsg = "Email Address already exists";
    } else {
     $insertuser = $user->updateExecInfo(check_input($agentname),check_input($email),check_input($unique),check_input($phonenum),check_input($earning),check_input($bankname),check_input($accountnum));
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