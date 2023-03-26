<?php 
session_start();
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $phonenum = $_POST['phonenum'];
    $bankname = $_POST['bankname'];
    $accountnum = $_POST['accountnum'];
    $filename = $_FILES['image']['name'];
    
  
    $user = new User;
    $insertdocument = $user->updateExecutiveDetails($_SESSION['uniqueexec_id'],$phonenum,$bankname,$accountnum);
   
    
    

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