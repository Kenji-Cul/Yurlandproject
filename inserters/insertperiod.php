<?php 

include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $eighteenperiod = $_POST['eighteen'];
    $eighteenpercentage = $_POST['eighteenpercent'];
    $eighteenupdate = $_POST['eighteenupdate'];
    $twelveperiod = $_POST['twelve'];
    $twelvepercentage = $_POST['twelvepercent'];
    $twelveupdate = $_POST['twelveupdate'];
    $sixperiod = $_POST['six'];
    $sixpercentage = $_POST['sixpercent'];
    $sixupdate = $_POST['sixupdate'];
    $threeperiod = $_POST['three'];
    $threepercentage = $_POST['threepercent'];
    $threeupdate = $_POST['threeupdate'];
    $oneperiod = $_POST['one'];
    $onepercentage = $_POST['onepercent'];
    $oneupdate = $_POST['oneupdate'];


    if(empty( $eighteenperiod) || empty($twelveperiod) || empty($sixperiod) || empty($threeperiod) || empty($oneperiod)){
        $errormsg = "Please input all fields";
    } 
   else {
     $user = new User;
     $insertdocument = $user->insertPeriod(check_input($oneperiod),check_input($threeperiod),check_input($sixperiod),check_input($twelveperiod),check_input($eighteenperiod),check_input($eighteenpercentage),check_input($twelvepercentage),check_input($sixpercentage),check_input($threepercentage),check_input($onepercentage),check_input($eighteenupdate),check_input($twelveupdate),check_input($sixupdate),check_input($threeupdate),check_input($oneupdate));
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