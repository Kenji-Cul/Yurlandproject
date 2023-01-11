<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $landname = $_POST['landname'];
    $location = $_GET['state'];
    $budget = $_GET['budget'];
    $landsize = $_POST['size'];
    $unique= $_POST['unique'];
    $onemonthprice = $_POST['eighteenmonth'];
    $desc = $_POST['productdesc'];
    $feature = $_POST['estatefeature'];
    $allocationfee = $_POST['allocationfee'];
    $filename = $_FILES['image']['name'];
    $purpose = $_POST['purpose'];
    $unitnumber = $_POST['noofunit'];
if(empty($landname) || ($location == "") || ($budget == "") || empty($landsize) || empty($desc) || empty($feature)  || empty($onemonthprice)  || empty($unitnumber) || empty($allocationfee)){
    $errormsg = "Please input all fields";
}  else if(empty($filename)){
    $errormsg = "Please Select Your File";
}


else {
     $superadmin = new User;
        $insertland = $superadmin->uploadSubProduct(check_input($landname),check_input($desc),check_input($feature),check_input($landsize),check_input($location),check_input($onemonthprice),$unique,$purpose,check_input($unitnumber),check_input($budget),check_input($allocationfee));
     
    

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