<?php 
include_once "projectlog.php";
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $address = $_POST['houseaddress'];
    $phone = $_POST['phonenum'];
    $relationship = $_GET['relation'];




     $user = new User;
     $insertnextofkin = $user->insertNextOfKin(check_input($firstname), check_input($lastname), check_input($email), check_input($address), check_input($phone), check_input($relationship),$_SESSION['unique_id']);


  

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