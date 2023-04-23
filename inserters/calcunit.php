<?php
include_once "../projectlog.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $unit = $_POST['unit'];
    $unique = $_GET['uniqueid'];

 
    
if(empty($unit)){
    $errormsg = "Please Fill in your Data";
}   else if($unique < 10){
    $errormsg = "There was an error";
}  
    else {
    $user = new User;
    $insertuser = $user->selectUnit($unique);
    echo "success";
    

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