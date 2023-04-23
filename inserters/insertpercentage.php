<?php 
include_once "../projectlog.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $percent = $_POST['customerpercent'];

if(empty($percent)){
    $errormsg = "Please Fill in your Data";
}  
    else {
    $user = new User;
    $insertuser = $user->editUserPercentage(check_input($percent));

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