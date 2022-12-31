<?php 
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['agentemail'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

if(empty($email) || empty($password)){
    $errormsg = "Please input all fields";
} else {
     $user = new User;
     $insertuser = $user->agentLogin($email);
     if(isset($insertuser['agent_password'])){
        if($insertuser['agent_status'] == "Disabled"){
            echo "disabled";
        } 

     else {
            if(password_verify($password,$insertuser['agent_password'])){
                session_start();
                session_unset();
                $_SESSION['uniqueagent_id'] = $insertuser['uniqueagent_id'];
                if(!empty($remember)){
                    setcookie("agent_login",$email,time() + (10 * 365 * 24 * 60 * 60));
                    setcookie("agent_password",$password,time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    if(!isset($_COOKIE['agent_login'])){
                        setcookie('agent_login',"");
                    }
        
                    if(!isset($_COOKIE['agent_password'])){
                        setcookie('agent_password',"");
                    }
                }
                echo "success";
            } 
            else {
                $errormsg = "Invalid Details Try Again";
            }
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