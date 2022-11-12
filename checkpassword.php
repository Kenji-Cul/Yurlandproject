<?php 
 include_once "projectlog.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
   
    $uniqueid = $_POST['select'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password2'];

    if(empty($password) || empty($passwordRepeat)){
        $errormsg = "Please input all fields";
    } else if($password != $passwordRepeat){
       $errormsg = "Passwords are not the same";
    } else{

    $member = new User;
    $passwordupdate = $member->updatePassword($uniqueid,checkInput($passwordRepeat));

    }

   
    

    if(isset($errormsg)){
        echo $errormsg;
    }
}else{
    header("Location: index.php");
}

function checkInput($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}