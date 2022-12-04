<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
$role = $_POST['rolediv'];
$earningpercent = $_POST['percent'];

if(empty($name) || empty($email) || empty($earningpercent) || empty($password) || empty($role)){
    $errormsg = "Please input all fields";
}

else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errormsg = "Invalid email format";
  }

else {
     $agent = new User;
     $checkagent = $agent->checkExecutiveEmailAddress($email);
     if(!empty($checkagent)){
        $errormsg = "Email Address already exists";
        }else{
     $insertagent = $agent->createExecutive(check_input($name),check_input($password),check_input($role),check_input($earningpercent), check_input($email));
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