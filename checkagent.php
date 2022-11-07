<?php 
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['agentemail'];
    $password = $_POST['password'];

if(empty($email) || empty($password)){
    $errormsg = "Please input all fields";
} else {
     $user = new User;
     $insertuser = $user->agentLogin($email);
     if(isset($insertuser['agent_password'])){
        if(password_verify($password,$insertuser['agent_password'])){
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