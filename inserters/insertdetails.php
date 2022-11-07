<?php 
session_start();
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $occupation= $_POST['occupation'];
    $gender = $_POST['gender'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $filename = $_FILES['image']['name'];
    if(empty($occupation) || empty($gender) || empty($day) || empty($month) || empty($year)){
        $errormsg = "Please input all fields";
    }
    else if(empty($filename)){
        $errormsg = "Please Select Your File";
    } else {
     $user = new User;
     $insertdocument = $user->updateUserDetails($_SESSION['unique_id'],check_input($gender),check_input($occupation),check_input($day), check_input($month), check_input($year));
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