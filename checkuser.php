<?php 
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

if(empty($email) || empty($password)){
    $errormsg = "Please input all fields";
} else {
     $user = new User;
     $insertuser = $user->login($email);
     if(isset($insertuser['user_password'])){
        if(password_verify($password,$insertuser['user_password'])){
            session_start();
            session_unset();
            $_SESSION['unique_id'] = $insertuser['unique_id'];
            echo "success";
        } else {
            $errormsg = "Invalid Details Try Again";
        }
     } else {
        $errormsg = "User Not Found";
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