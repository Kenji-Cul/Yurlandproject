<?php 
include_once "../projectlog.php";
//session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $agentname = $_POST['subadminname'];
    $agentnum = $_POST['subadminnum'];
    $email = $_POST['email'];
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
    $emailuser6 = $user->selectSubadminEmail($unique);
    if(!empty($emailuser) || !empty($emailuser3) || !empty($emailuser2) || !empty($emailuser5)){
    $errormsg = "Email Address already exists";
    }else if($emailuser6['subadmin_email'] != $email && !empty($emailuser4)){
      $errormsg = "Email Address already exists";
    } else {
     $insertuser = $user->updateSubadminInfo(check_input($agentname),check_input($agentnum),check_input($email),check_input($unique));
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