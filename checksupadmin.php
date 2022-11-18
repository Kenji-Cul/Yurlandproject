<?php 
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['supadminemail'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

if(empty($email) || empty($password)){
    $errormsg = "Please input all fields";
} else {
     $user = new User;
     $insertuser = $user->superAdminLogin($email);
     if(isset($insertuser['super_adminpassword'])){
        if(password_verify($password,$insertuser['super_adminpassword'])){
            session_start();
            session_unset();
            $_SESSION['uniquesupadmin_id'] = $insertuser['unique_id'];
            if(!empty($remember)){
                setcookie("superadmin_login",$email,time() + (10 * 365 * 24 * 60 * 60));
                setcookie("superadmin_password",$password,time() + (10 * 365 * 24 * 60 * 60));
            } else {
                if(!isset($_COOKIE['superadmin_login'])){
                    setcookie('superadmin_login',"");
                }
    
                if(!isset($_COOKIE['superadmin_password'])){
                    setcookie('superadmin_password',"");
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