<?php 

include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $eighteenperiod = $_POST['eighteen'];
    $eighteenpercentage = $_POST['eighteenpercent'];
    $twelveperiod = $_POST['twelve'];
    $twelvepercentage = $_POST['twelvepercent'];
    $sixperiod = $_POST['six'];
    $sixpercentage = $_POST['sixpercent'];
    $threeperiod = $_POST['three'];
    $threepercentage = $_POST['threepercent'];
    $oneperiod = $_POST['one'];
    $onepercentage = $_POST['onepercent'];


    if(empty( $eighteenperiod) || empty($twelveperiod) || empty($sixperiod) || empty($threeperiod) || empty($oneperiod) || empty($eighteenpercentage) || empty($twelvepercentage) || empty($sixpercentage) || empty($threepercentage) || empty($onepercentage)){
        $errormsg = "Please input all fields";
    }
   else {
     $user = new User;
     $insertdocument = $user->insertPeriod(check_input($oneperiod),check_input($threeperiod),check_input($sixperiod),check_input($twelveperiod),check_input($eighteenperiod),check_input($eighteenpercentage),check_input($twelvepercentage),check_input($sixpercentage),check_input($threepercentage),check_input($onepercentage));
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