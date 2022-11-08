<?php 
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['supadminemail'];
    $password = $_POST['password'];

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