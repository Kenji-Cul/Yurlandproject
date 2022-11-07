<?php 
session_start();
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $filename = $_FILES['license']['name'];
    if(empty($filename)){
        $errormsg = "Please Select Your File";
    } else {
     $user = new User;
     $insertdocument = $user->insertLicense($_SESSION['unique_id']);
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