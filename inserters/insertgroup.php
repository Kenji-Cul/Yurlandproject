<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['groupname'];
    $grouphead = $_POST['grouphead'];
    $grouplocation = $_POST['grouplocation'];
    $filename = $_FILES['image']['name'];
    

if(empty($name) || empty($grouphead) || empty($grouplocation)){
    $errormsg = "Please input all fields";
}
else if(empty($filename)){
    $errormsg = "Please Select Your File";
}

else {
    $user = new User;
    $checkname = $user->checkGroupName($name);
    if(!empty($checkname)){
       $errormsg = "Group Name already exists";
    } else {
    $insertagent = $user->createGroup(check_input($name),check_input($grouphead),check_input($grouplocation));
    echo $insertagent;
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