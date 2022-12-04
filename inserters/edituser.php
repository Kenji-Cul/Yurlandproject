<?php 
include_once "../projectlog.php";
//session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $unique = $_POST['uniqueuser'];
    $earning = $_POST['earning'];

if(empty($firstname) || empty($lastname) || empty($email) || empty($number) || empty($unique) || empty($earning)){
    $errormsg = "Please input all fields";
}  
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errormsg = "Invalid email format";
      }

    else {
    $user = new User;
    $insertuser = $user->updateUserInfo(check_input($firstname),check_input($lastname),check_input($email),check_input($unique),check_input($number),check_input($earning));
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