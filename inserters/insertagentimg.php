<?php 
session_start();
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $address = $_POST['address'];
    $num = $_POST['num'];
    $filename = $_FILES['image']['name'];
    if(empty($address) || empty($num)){
        $errormsg = "Please input all fields";
    }
    else if(empty($filename)){
        $errormsg = "Please Select Your File";
    } else {
     $user = new User;
     $insertdocument = $user->updateAgentDetails($_SESSION['uniqueagent_id'],check_input($address),check_input($num));
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
?>