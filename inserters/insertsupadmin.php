<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['supadminname'];
    $email = $_POST['supadminemail'];
    $password = $_POST['password'];


if(empty($name) || empty($password) || empty($email)){
    $errormsg = "Please input all fields";
} 
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errormsg = "Invalid email format";
  }

else {
     $supadmin = new User;
     $checkagent = $supadmin->checkEmailAddress(check_input($email));
     $checkagent2 = $supadmin->checkAgentEmailAddress(check_input($email));
     $checkagent3 = $supadmin->checkExecutiveEmailAddress(check_input($email));
     $checkagent4 = $supadmin->checkSubadminEmailAddress(check_input($email));
     $checkagent5 = $supadmin->checkSuperadminEmailAddress(check_input($email));
     if(!empty( $checkagent) || !empty( $checkagent2) || !empty( $checkagent3) || !empty( $checkagent4) || !empty( $checkagent5)){
     $errormsg = "Email Address already exists";
     }else{
     $insertsupadmin = $supadmin->createSuperAdmin(check_input($name),check_input($password), check_input($email));
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