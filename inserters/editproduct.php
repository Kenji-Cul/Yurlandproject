<?php 
include_once "../projectlog.php";
//session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $landname = $_POST['landname'];
    $location = $_POST['location'];
    $purpose = $_POST['purpose'];
    $price = $_POST['unitprice'];
    $unitnum = $_POST['unitnum'];
    $uniqueland = $_POST['uniqueland'];

if(empty($landname) || empty($location) || empty($purpose) || empty($price) || empty($unitnum)){
    $errormsg = "Please input all fields";
}  
    else {
    $user = new User;
    $insertuser = $user->updateLandInfo(check_input($landname),check_input($purpose),check_input($location),check_input($unitnum),check_input($price),$uniqueland);
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