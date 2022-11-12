<?php 

include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $eighteenperiod = $_POST['eighteen'];
    $twelveperiod = $_POST['twelve'];
    $sixperiod = $_POST['six'];
    $threeperiod = $_POST['three'];
    $oneperiod = $_POST['one'];

    if(empty( $eighteenperiod) || empty($twelveperiod) || empty($sixperiod) || empty($threeperiod) || empty($oneperiod)){
        $errormsg = "Please input all fields";
    }
   else {
     $user = new User;
     $insertdocument = $user->insertPeriod(check_input($oneperiod),check_input($threeperiod),check_input($sixperiod),check_input($twelveperiod),check_input($eighteenperiod));
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