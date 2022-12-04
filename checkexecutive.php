<?php 
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['executiveemail'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

if(empty($email) || empty($password)){
    $errormsg = "Please input all fields";
} else {
     $user = new User;
     $insertuser = $user->executiveLogin($email);
     if(isset($insertuser['executive_password'])){
        if(password_verify($password,$insertuser['executive_password'])){
            session_start();
            session_unset();
            $_SESSION['uniqueexec_id'] = $insertuser['unique_id'];
            if(!empty($remember)){
                setcookie("executive_login",$email,time() + (10 * 365 * 24 * 60 * 60));
                setcookie("executive_password",$password,time() + (10 * 365 * 24 * 60 * 60));
            } else {
                if(!isset($_COOKIE['executive_login'])){
                    setcookie('executive_login',"");
                }
    
                if(!isset($_COOKIE['executive_password'])){
                    setcookie('executive_password',"");
                }
            }
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