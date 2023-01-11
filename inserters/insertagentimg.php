<?php 
session_start();
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $address = $_POST['address'];
    $num = $_POST['num'];
    $bankname = $_POST['bankname'];
    $accountnum = $_POST['accountnum'];
    $accountname = $_POST['accountname'];
    $filename = $_FILES['image']['name'];
  
     $user = new User;
     $insertdocument = $user->updateAgentDetails($_SESSION['uniqueagent_id'],check_input($address),check_input($num),check_input($bankname),check_input($accountnum),check_input($accountname));
    

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