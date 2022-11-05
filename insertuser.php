<?php 
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_num = $_POST['number'];
    $password = $_POST['password'];

if(empty($firstname) || empty($lastname) || empty($email) || empty($phone_num) || empty($password)){
    $errormsg = "Please input all fields";
} else {
     $user = new User;
     $emailuser = $user->checkEmailAddress(check_input($email));
     if(!empty($emailuser)){
       $errormsg = "Email Address already exists";
     }else{
     $insertuser = $user->createUser(check_input($firstname),check_input($lastname),check_input($email),check_input($phone_num),check_input($password));
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