<?php 
session_start();
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $nin = $_POST['nin'];
   $filename = $_FILES['passport']['name'];
   $file_error = $_FILES['passport']['error'];
   $deter = $_GET['docsinput'];
  

     $user = new User;
     if($deter == "Passport"){
     $insertdocument = $user->insertDocuments($_SESSION['unique_id'],$nin);
     }  if($deter == "License"){
        $insertdocs = $user->insertLicense($_SESSION['unique_id']);
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