<?php 
include_once "../projectlog.php";
//session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $agentname = $_POST['agentname'];
    $agentnum = $_POST['agentnum'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $filename = $_FILES['image']['name'];
    $earning = $_POST['earning'];
    $unique = $_POST['uniqueuser'];
    $groupid = $_GET['groupid'];

if(empty($agentname) || empty($agentnum) || empty($email)   || empty($address)   || empty($unique) || empty($earning)){
    $errormsg = "Please input all fields";
}  
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errormsg = "Invalid email format";
      }
       
      else if(empty($filename)){
        $errormsg = "Please Select Your File";
    }

    else {
    $user = new User;
    $emailuser = $user->checkEmailAddress(check_input($email));
    $emailuser2 = $user->checkAgentEmailAddress(check_input($email));
    $emailuser3 = $user->checkExecutiveEmailAddress(check_input($email));
    $emailuser4 = $user->checkSubadminEmailAddress(check_input($email));
    $emailuser5 = $user->checkSuperadminEmailAddress(check_input($email));
    $emailuser6 = $user->selectAgentEmail($unique);
    if(!empty($emailuser) || !empty($emailuser3) || !empty($emailuser4) || !empty($emailuser5)){
    $errormsg = "Email Address already exists";
    }else if($emailuser6['agent_email'] != $email && !empty($emailuser2)){
      $errormsg = "Email Address already exists";
    } else {
     $insertuser = $user->updateAgentInfo(check_input($agentname),check_input($agentnum),check_input($email),check_input($unique),check_input($address),check_input($earning),$groupid);
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