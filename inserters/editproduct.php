<?php 
include_once "../projectlog.php";
//session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $landname = $_POST['landname'];
    $description = $_POST['description'];
    $budget = $_GET['budget'];
    $state = $_GET['state'];
    $purpose = $_GET['purpose'];
    $size = $_POST['size'];
    $feature = $_POST['feature'];
    $allocationfee = $_POST['allocationfee'];
    $unitnum = $_POST['unitnum'];
    $uniqueland = $_POST['uniqueland'];
    $filename = $_FILES['image']['name'];



    $user = new User;
    $landmode = $user->selectLandImage($uniqueland);
    foreach($landmode as $key => $value){
    if($value['outright_price'] == "0"){
        $subscriptionprice = $_POST['eighteenmonth'];
        $insertuser = $user->updateLandInfo1(check_input($landname),check_input($description),check_input($budget),check_input($state),check_input($size),check_input($feature),check_input($allocationfee),check_input($subscriptionprice),check_input($purpose),check_input($unitnum),$uniqueland);
    }

    if($value['onemonth_price'] == "0"){
        $outrightprice = $_POST['outrightprice'];
        $insertuser = $user->updateLandInfo2(check_input($landname),check_input($description),check_input($budget),check_input($state),check_input($size),check_input($feature),check_input($allocationfee),check_input($outrightprice),check_input($purpose),check_input($unitnum),$uniqueland);
    }

    if($value['onemonth_price'] != "0" && $value['outright_price'] != "0"){
        $outrightprice = $_POST['outrightprice'];
        $subscriptionprice = $_POST['eighteenmonth'];
        $insertuser = $user->updateLandInfo3(check_input($landname),check_input($description),check_input($budget),check_input($state),check_input($size),check_input($feature),check_input($allocationfee),check_input($outrightprice),check_input($subscriptionprice),check_input($purpose),check_input($unitnum),$uniqueland);
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