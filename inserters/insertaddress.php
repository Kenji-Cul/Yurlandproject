<?php 
include_once "../projectlog.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $address= $_POST['houseaddress'];

if(empty($address)){
    $errormsg = "Please Fill in your Data";
}  
    else {
    $user = new User;
    $insertuser = $user->insertUserAddress(check_input($address),$_SESSION['unique_id']);

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