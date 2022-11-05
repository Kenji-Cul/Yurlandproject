<?php 
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['subadminname'];
    $password = $_POST['password'];


if(empty($name) || empty($password)){
    $errormsg = "Please input all fields";
} else {
     $subadmin = new User;
     $insertsubadmin = $subadmin->createSubAdmin($name,$password);

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