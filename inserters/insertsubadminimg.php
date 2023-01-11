<?php 
session_start();
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $num = $_POST['num'];
    $filename = $_FILES['image']['name'];
   
     $user = new User;
     $insertdocument = $user->updateSubadminDetails($_SESSION['uniquesubadmin_id'],check_input($num));
    

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