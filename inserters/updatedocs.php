<?php 
session_start();
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $nin = $_POST['nin'];
   $filename = $_FILES['passport']['name'];
   $file_error = $_FILES['passport']['error'];
   $deter = $_POST['docsinput'];
   $unique = $_POST['uniqueuser'];
  
if(empty($nin) || empty($filename)){
    $errormsg = "Please input all fields";
}  else if(strlen($nin) !== 11){
    $errormsg = "Please input your NIN correctly";
}  


else {
     $user = new User;
     if($deter == "Passport"){
     $insertdocument = $user->insertDocuments($unique,$nin);
     }  if($deter == "License"){
        $insertdocs = $user->insertLicense($unique);
     }

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