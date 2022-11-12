<?php
include_once "../projectlog.php";
session_start();





if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $uniqueid = $_POST['id'];



   
    $insertuser = $user->DeleteCartId2($uniqueid);
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