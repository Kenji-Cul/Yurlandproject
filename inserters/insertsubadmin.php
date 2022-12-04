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
     $checksubadmin = $agent->checkSubadminEmailAddress($email);
     if(!empty($checksubadmin)){
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