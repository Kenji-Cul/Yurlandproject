<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $landname = $_POST['landname'];
    $location = $_GET['state'];
    $budget = $_GET['budget'];
    $unique= $_POST['unique'];
    $landsize = $_POST['size'];
    $outrightprice = $_POST['outrightprice'];
    $eighteenmonthprice = $_POST['eighteenmonth'];
    $twelvemonthprice = $eighteenmonthprice / 2;
    $sixmonthprice = $twelvemonthprice / 2;
    $threemonthprice = $sixmonthprice / 2;
    $onemonthprice = $threemonthprice / 2;
    $desc = $_POST['productdesc'];
    $feature = $_POST['estatefeature'];
    $filename = $_FILES['image']['name'];
    $purpose = $_POST['purpose'];
    $unitprice = $_POST['unitprice'];
    $unitnumber = $_POST['noofunit'];
if(empty($landname) || ($location == "") || ($budget == "") || empty($landsize) || empty($desc) || empty($feature) || empty($outrightprice)  || empty($eighteenmonthprice) || empty($unitprice) || empty($unitnumber)){
    $errormsg = "Please input all fields";
}  else if(empty($filename)){
    $errormsg = "Please Select Your File";
}


else {
     $superadmin = new User;
        $insertland = $superadmin->uploadProduct(check_input($landname),check_input($outrightprice),check_input($desc),check_input($feature),check_input($landsize),check_input($location),check_input($onemonthprice),check_input($threemonthprice),check_input($sixmonthprice),check_input($twelvemonthprice),check_input($eighteenmonthprice),$unique,$purpose,check_input($unitprice),check_input($unitnumber),check_input($budget));
     
    

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