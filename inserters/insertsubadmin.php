<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['subadminname'];
    $email = $_POST['subadminemail'];
    $number = $_POST['subadmin_number'];
    $password = $_POST['password'];


if(empty($name) || empty($password) || empty($number) || empty($email)){
    $errormsg = "Please input all fields";
}  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errormsg = "Invalid email format";
  }

else {
    $agent = new User;
    $checkagent = $agent->checkEmailAddress(check_input($email));
    $checkagent2 = $agent->checkAgentEmailAddress(check_input($email));
    $checkagent3 = $agent->checkExecutiveEmailAddress(check_input($email));
    $checkagent4 = $agent->checkSubadminEmailAddress(check_input($email));
    $checkagent5 = $agent->checkSuperadminEmailAddress(check_input($email));
    if(!empty( $checkagent) || !empty( $checkagent2) || !empty( $checkagent3) || !empty( $checkagent4) || !empty( $checkagent5)){
    $errormsg = "Email Address already exists";
    }else{
     $subadmin = new User;
     $insertsubadmin = $subadmin->createSubAdmin(check_input($name),check_input($password),check_input($email), check_input($number));
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