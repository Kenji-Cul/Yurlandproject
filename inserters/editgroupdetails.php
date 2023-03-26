<?php 
include_once "../projectlog.php";
//session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $groupname = $_POST['groupname'];
    $grouphead = $_POST['grouphead'];
    $grouplocation = $_POST['grouplocation'];
    $filename = $_FILES['image']['name'];
    $unique = $_POST['uniqueuser'];



    $user = new User;
    $group = $user->selectGroupName($groupname);
    if(!empty($group) && $group['uniquegroup_id'] != $unique){
    $errormsg = "Group already exists";
    } else {
     $insertuser = $user->updateGroupInfo(check_input($groupname),check_input($grouphead),check_input($grouplocation),check_input($unique));
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