<?php 
include_once "../projectlog.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $userdata = $_GET['userdata'];
    $useremail = $_POST['email'];
    $userpassword = $_POST['password'];
    $user = new User;
    if(empty($useremail) || empty($userpassword) || empty($userdata)){
        $errormsg = "Please input all fields";
    } else {
        if($userdata == "agent"){
            $insertuser = $user->agentLogin(check_input($useremail));
            if(isset($insertuser['agent_password'])){
               if(password_verify($userpassword,$insertuser['agent_password'])){
                   session_start();
                   session_unset();
                   $_SESSION['uniqueagent_id'] = $insertuser['uniqueagent_id'];
                   echo "agentsuccess";
               } else {
                   $errormsg = "Invalid Details Try Again";
               }
            } else {
               $errormsg = "User Not Found";
            }
        } else if($userdata == "subadmin"){
            $insertuser = $user->subAdminLogin(check_input($useremail));
            if(isset($insertuser['subadmin_password'])){
               if(password_verify($userpassword,$insertuser['subadmin_password'])){
                   session_start();
                   session_unset();
                   $_SESSION['uniquesubadmin_id'] = $insertuser['unique_id'];
                   echo "subadminsuccess";
               } else {
                   $errormsg = "Invalid Details Try Again";
               }
            } else {
               $errormsg = "User Not Found";
            }
        } else if($userdata == "superadmin"){
            $insertuser = $user->superAdminLogin(check_input($useremail));
            if(isset($insertuser['super_adminpassword'])){
               if(password_verify($userpassword,$insertuser['super_adminpassword'])){
                   session_start();
                   session_unset();
                   $_SESSION['uniquesupadmin_id'] = $insertuser['unique_id'];
                   echo "superadminsuccess";
               } else {
                   $errormsg = "Invalid Details Try Again";
               }
            } else {
               $errormsg = "User Not Found";
            }
       
        }
    }
}

if(isset($errormsg)){
    echo $errormsg;
}

function check_input($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
