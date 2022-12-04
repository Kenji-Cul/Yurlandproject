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
     $checksupadmin = $supadmin->checkSuperadminEmailAddress($email);
     if(!empty($checksupadmin)){
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