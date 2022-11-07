<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['supadminname'];
    $email = $_POST['supadminemail'];
    $password = $_POST['password'];


if(empty($name) || empty($password) || empty($email)){
    $errormsg = "Please input all fields";
} else {
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