<?php 
include_once "../projectlog.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $bankname = $_POST['bankname'];
    $accountnum = $_POST['accountnum'];

    $user = new User;
    $insertuser = $user->insertUserAccount(check_input($bankname),check_input($accountnum),$_SESSION['unique_id']);

    

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