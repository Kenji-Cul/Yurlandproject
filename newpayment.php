<?php 

session_start();
if(!isset($_SESSION['unique_id'])){
    header("Location: signup.php");
}
include "projectlog.php";
if(!isset($_GET['tot']) || !isset($_GET['uniqueid'])){
    header('Location: index.php');
}
?>
<?php

$user = new User;
$selectuser = $user->selectUser($_SESSION['unique_id']);

   
    $landview = $user->selectLandImage($_GET['uniqueid']);
    $checklastpayment = $user->selectLastPay($_SESSION['unique_id'],$_GET['uniqueid'],$_GET['newpayid']);
    $checklatestpayment = $user->selectLatestPay($_SESSION['unique_id'],$_GET['uniqueid']);
    $checklastpaid = $user->selectSubPay($_SESSION['unique_id']);
   
    if(!empty($landview)){
        foreach($landview as $key => $value){ 

// Integrate Paystack
if(isset($_POST["submit"])){

    if($_POST['period'] > $_POST['dayno']){
        $error = "Limit Reached";
        header("Location: verify3.php?error=".$error."");
    } else {
        
        if($checklatestpayment['product_id'] == $_GET['uniqueid'] && $checklatestpayment['newpay_id'] != $_GET['newpayid'] && $checklatestpayment['balance'] > "2"){
            $error = "You have an ongoing subscription on this estate, please complete payment";
            header("Location: verify3.php?error=".$error."");
        } else {
        if($checklastpayment['balance'] > "2" && isset($_GET['remprice'])){
    $email = htmlspecialchars($selectuser['email']);
    if(!isset($_GET['remprice'])){
        
    if($_GET['data'] == "onemonth"){
        $realprice = $_GET['subpayment'] * $_POST['period'];
        $subprice = $_GET['subpayment'];
        $limit = $value['onemonth_period'];
        $increaserate = $value['onemonth_increaserate'];
        } else if($_GET['data'] == "threemonths"){
            $realprice = $_GET['subpayment'] * $_POST['period'];
            $subprice = $_GET['subpayment'];
        $limit = $value['threemonth_period'];
        $increaserate = $value['threemonth_increaserate'];
        } else if($_GET['data'] == "sixmonths"){
            $realprice = $_GET['subpayment'] * $_POST['period'];
            $subprice = $_GET['subpayment'];
        $limit = $value['sixmonth_period'];
        $increaserate = $value['sixmonth_increaserate'];
        } else if($_GET['data'] == "twelvemonths"){
            $realprice = $_GET['subpayment'] * $_POST['period'];
            $subprice = $_GET['subpayment'];
        $limit = $value['twelvemonth_period'];
        $increaserate = $value['twelvemonth_increaserate'];
        } else if($_GET['data'] == "eighteenmonths"){
            $realprice = $_GET['subpayment'] * $_POST['period'];
            $subprice = $_GET['subpayment'];
        $limit = $value['eighteen_period'];
        $increaserate = $value['eighteen_increaserate'];
        }
    }

    $price = $_GET['tot'];
    if(isset($_GET['newpay'])){
        $newpay = $_GET['newpay'];
        $realprice = round($newpay);
    } else {
        $newpay = $realprice;
    }
   
    $newprice = $price - $realprice;
    if($newprice < 0){
        $newprice = 0;
    }
    $uniqueperson = $_SESSION['unique_id'];
    $uniqueproduct = $_GET['uniqueid'];
    $newpayid = $_GET['newpayid'];
    if(isset($_GET['remprice'])){
       $period = $_GET['period'];
       $landuse = $user->selectProductOldPayment($_GET['uniqueid'],$_SESSION['unique_id'],$_GET['newpayid']);
       $subperiod = $landuse['period_num'] - $_GET['subperiod'];
       $firstDate = $landuse['increase_date'];
       if($landuse['product_plan'] == "onemonth"){
        $increaserate = $value['onemonth_increaserate'];
        } else if($landuse['product_plan'] == "threemonths"){
        $increaserate = $value['threemonth_increaserate'];
        } else if($landuse['product_plan'] == "sixmonths"){
        $increaserate = $value['sixmonth_increaserate'];
        } else if($landuse['product_plan'] == "twelvemonths"){
        $increaserate = $value['twelvemonth_increaserate'];
        } else if($landuse['product_plan'] == "eighteenmonths"){
        $increaserate = $value['eighteen_increaserate'];
        }
    } else {
        $time = $limit - intval($_POST['period']);
    $date = date("y-m-d");
    $date2 = date_create($date);
    $time2 = date_add($date2, date_interval_create_from_date_string("".$time." days"));
    $period = date_format($time2, "M-d-Y");
    $subperiod = $limit - intval($_POST['period']);
    $chosenplan = $_GET['data'];
    $firstDate = $_POST['planindicator'];
    }
    
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
    $allocationfee = $value['allocation_fee'];
   

    if(isset($_GET['remunit'])){
        $deducted_unit = $value['product_unit'];
    }else {
        $deducted_unit = $value['product_unit'] - $_GET['unit'];
    }
       
    if(isset($_GET['remunit'])){
        $boughtunit = $value['bought_units'];
    }else {
        $boughtunit = $_GET['unit']  + $value['bought_units'];
    }

   
    $productlocation = $value['product_location'];
    $image = $value['product_image'];
    $paymentmonth = date("M");
    $paymentday = date("d");
    $paymentyear = date("Y");
    $paymenttime = date("h:i a");
    $paymentdate = date("M-d-Y");
    $paymentmethod = "NewPayment";
    $payee = $selectuser['first_name']." ".$selectuser['last_name'];
    if($selectuser['referral_id'] != "Yurland"){
        $agent = $user->selectAgentRef($selectuser['referral_id']);
        $userperson = $user->selectUserRef($selectuser['referral_id']);
        if(!empty($agent)){
            $agentid= $agent['uniqueagent_id'];
        } 
        
        if(!empty($userperson)){
            $agentid = $userperson['unique_id'];
        }
       
    } else {
        $agentid = "noagent";
    }

   
   
   
   


    //Initiate Paystack
    $url = "https://api.paystack.co/transaction/initialize";
    

    //Gather the body params
    $transaction_data = [
       "email" => $email,
       "amount" => round($realprice * 100),
       "callback_url" => "http://localhost/Yurland/verify.php",
       "metadata" => [
          "custom_fields" => [
            [
                "display_name" => "Unique Product",
                "variable_name" => "product",
                "value" => $uniqueproduct
            ],

            [
                "display_name" => "Deducted Unit",
                "variable_name" => "unit",
                "value" => $deducted_unit
            ],

            [
                "display_name" => "Bought Units",
                "variable_name" => "boughtunit",
                "value" => $boughtunit
            ],

            [
                "display_name" => "Unique Person",
                "variable_name" => "person",
                "value" => $uniqueperson
            ],

            [
                "display_name" => "Product Name",
                "variable_name" => "productname",
                "value" => $product_name
            ],

            [
                "display_name" => "Payment Month",
                "variable_name" => "paymonth",
                "value" => $paymentmonth
            ],

            [
                "display_name" => "Payment Day",
                "variable_name" => "payday",
                "value" => $paymentday
            ],

            [
                "display_name" => "Payment Year",
                "variable_name" => "payyear",
                "value" => $paymentyear
            ],

            [
                "display_name" => "Payment Time",
                "variable_name" => "paytime",
                "value" => $paymenttime
            ],

            [
                "display_name" => "Product Location",
                "variable_name" => "productlocation",
                "value" => $productlocation
            ],

            [
                "display_name" => "Price",
                "variable_name" => "price",
                "value" => round($price)
            ],

            [
                "display_name" => "Product Image",
                "variable_name" => "prodimage",
                "value" => $image
            ],
            [
                "display_name" => "Payment Method",
                "variable_name" => "paymethod",
                "value" => $paymentmethod
            ],

            [
                "display_name" => "Payment Unit",
                "variable_name" => "payunit",
                "value" => $_GET['unit']
            ],

            [
                "display_name" => "Payment Type",
                "variable_name" => "payunit",
                "value" => "newpayment"
            ],

            [
                "display_name" => "New Price",
                "variable_name" => "newprice",
                "value" => round($newprice)
            ],

            [
                "display_name" => "New Price",
                "variable_name" => "newprice",
                "value" => round($newpay)
            ],

            [
                "display_name" => "Period",
                "variable_name" => "period",
                "value" => $period
            ],

            [
                "display_name" => "Sub Period",
                "variable_name" => "subperiod",
                "value" => $subperiod
            ],

            [
                "display_name" => "Payment Date",
                "variable_name" => "paydate",
                "value" => $paymentdate
            ],

            [
                "display_name" => "Payee",
                "variable_name" => "payee",
                "value" => $payee
            ],

            [
                "display_name" => "Agentid",
                "variable_name" => "Agentid",
                "value" => $agentid
            ],

            [
                "display_name" => "Allocation Fee",
                "variable_name" => "allocation fee",
                "value" =>  $allocationfee
            ],

            [
                "display_name" => "NewPay Id",
                "variable_name" => "newpayid",
                "value" => $newpayid
            ],

            [
                "display_name" => "Chosen Plan",
                "variable_name" => "chosenplan",
                "value" => $chosenplan
            ],

            [
                "display_name" => "Sub Price",
                "variable_name" => "subprice",
                "value" => $subprice
            ],

            
            [
                "display_name" => "First Date",
                "variable_name" => "First Date",
                "value" => $firstDate
            ],

            [
                "display_name" => "Increase Rate",
                "variable_name" => "Increase Rate",
                "value" => $increaserate
            ],

            

         
           

          ]
       ]
    ];

    // Generate a URL-encoded string
    $encode_transaction_data = http_build_query($transaction_data);

    // Open Connection to cURL
    $ch = curl_init();

    // Turn off Mandatory SSL checking
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //Set the url
    curl_setopt($ch, CURLOPT_URL, $url);

    // Enable data to be sent in POST arrays
    curl_setopt($ch, CURLOPT_POST, true);

    // Collect the posted data from above
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encode_transaction_data);
    
    //Set the headers from the endpoint
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
        "cache-Control: no-cache"
    ));

    // Make curl return the data instead of echoing
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL
    $result = curl_exec($ch);
    
    // Check for errors
    $errors = curl_error($ch);
    if($errors){
        $error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
    }

    if($result){
    
        echo $result;
        $transaction = json_decode($result);
      //Automatically redirect customers to the payment page
        header("Location: ".$transaction->data->authorization_url);
    }
    
    
    else {
        $error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
    }
   
} 



//


if(empty($checklastpayment)){
    $checklastpaid = $user->selectSubPay($_SESSION['unique_id']);
    $landsub = $user->selectSubProduct($checklastpaid['product_id']);
   
    
    if($checklastpaid['product_plan'] == "onemonth"){
        $totalsubprice = $landsub['onemonth_percent'] / 100 * $landsub['onemonth_price'];
      } else if($checklastpaid['product_plan'] == "threemonths"){
        $totalsubprice = $landsub['threemonth_percent'] / 100 * $landsub['onemonth_price'];
      }  else if($checklastpaid['product_plan'] == "sixmonths"){
        $totalsubprice = $landsub['sixmonth_percent'] / 100 * $landsub['onemonth_price'];
      } else if($checklastpaid['product_plan'] == "twelvemonths"){
        $totalsubprice = $landsub['twelvemonth_percent'] / 100 * $landsub['onemonth_price'];
      } 

      else if($checklastpaid['product_plan'] == "eighteenmonths"){
        $totalsubprice = $landsub['eighteen_percent'] / 100 * $landsub['onemonth_price'];
      }

      $totprice = $checklastpaid['product_unit'] * $landsub['onemonth_price'];
        $price = $totprice + $totalsubprice;
        $pricepercent = 70 / 100 * $price;
      
     
    if($checklastpaid['product_price'] < $pricepercent && !isset($_GET['remprice'])){
        $error = "Current plan is below 70% payment,please payup to qualify for another location on Subscription";
        header("Location: verify3.php?error=".$error."");
    } else { 
    $email = htmlspecialchars($selectuser['email']);
    if(!isset($_GET['remprice'])){
        
    if($_GET['data'] == "onemonth"){
        $realprice = $_GET['subpayment'] * $_POST['period'];
        $subprice = $_GET['subpayment'];
        $limit = $value['onemonth_period'];
        $increaserate = $value['onemonth_increaserate'];
        } else if($_GET['data'] == "threemonths"){
            $realprice = $_GET['subpayment'] * $_POST['period'];
            $subprice = $_GET['subpayment'];
        $limit = $value['threemonth_period'];
        $increaserate = $value['threemonth_increaserate'];
        } else if($_GET['data'] == "sixmonths"){
            $realprice = $_GET['subpayment'] * $_POST['period'];
            $subprice = $_GET['subpayment'];
        $limit = $value['sixmonth_period'];
        $increaserate = $value['sixmonth_increaserate'];
        } else if($_GET['data'] == "twelvemonths"){
            $realprice = $_GET['subpayment'] * $_POST['period'];
            $subprice = $_GET['subpayment'];
        $limit = $value['twelvemonth_period'];
        $increaserate = $value['twelvemonth_increaserate'];
        } else if($_GET['data'] == "eighteenmonths"){
            $realprice = $_GET['subpayment'] * $_POST['period'];
            $subprice = $_GET['subpayment'];
        $limit = $value['eighteen_period'];
        $increaserate = $value['eighteen_increaserate'];
        }
    }

    $price = $_GET['tot'];
    if(isset($_GET['newpay'])){
        $newpay = $_GET['newpay'];
        $realprice = round($newpay);
    } else {
        $newpay = round($realprice);
    }
   
    $newprice = $price - $realprice;
    if($newprice < 0){
        $newprice = 0;
    }
    $uniqueperson = $_SESSION['unique_id'];
    $uniqueproduct = $_GET['uniqueid'];
    if(isset($_GET['remprice'])){
       $period = $_GET['period'];
       $landuse = $user->selectProductOldPayment($_GET['uniqueid'],$_SESSION['unique_id'],$_GET['newpayid']);
       
       $subperiod = $landuse['period_num'] - $_GET['subperiod'];
       $firstDate = $landuse['increase_date'];
       if($landuse['product_plan'] == "onemonth"){
        $increaserate = $value['onemonth_increaserate'];
        } else if($landuse['product_plan'] == "threemonths"){
        $increaserate = $value['threemonth_increaserate'];
        } else if($landuse['product_plan'] == "sixmonths"){
        $increaserate = $value['sixmonth_increaserate'];
        } else if($landuse['product_plan'] == "twelvemonths"){
        $increaserate = $value['twelvemonth_increaserate'];
        } else if($landuse['product_plan'] == "eighteenmonths"){
        $increaserate = $value['eighteen_increaserate'];
        }
    } else {
        $time = $limit - intval($_POST['period']);
    $date = date("y-m-d");
    $date2 = date_create($date);
    $time2 = date_add($date2, date_interval_create_from_date_string("".$time." days"));
    $period = date_format($time2, "M-d-Y");
    $subperiod = $limit - intval($_POST['period']);
    $chosenplan = $_GET['data'];
    $firstDate = $_POST['planindicator'];
    }
    
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
    $allocationfee = $value['allocation_fee'];

    if(isset($_GET['remunit'])){
        $deducted_unit = $value['product_unit'];
    }else {
        $deducted_unit = $value['product_unit'] - $_GET['unit'];
    }
       
    if(isset($_GET['remunit'])){
        $boughtunit = $value['bought_units'];
    }else {
        $boughtunit = $_GET['unit']  + $value['bought_units'];
    }

   
    $productlocation = $value['product_location'];
    $image = $value['product_image'];
    $paymentmonth = date("M");
    $paymentday = date("d");
    $paymentyear = date("Y");
    $paymenttime = date("h:i a");
    $paymentdate = date("M-d-Y");
    $paymentmethod = "NewPayment";
    $payee = $selectuser['first_name']." ".$selectuser['last_name'];
    if($selectuser['referral_id'] != "Yurland"){
        $agent = $user->selectAgentRef($selectuser['referral_id']);
        $userperson = $user->selectUserRef($selectuser['referral_id']);
        if(!empty($agent)){
            $agentid= $agent['uniqueagent_id'];
        } else {
            $agentid = $userperson['unique_id'];
        }
       
    } else {
        $agentid = "noagent";
    }

    $newpayid = rand();
    
   
   
   


    //Initiate Paystack
    $url = "https://api.paystack.co/transaction/initialize";
    

    //Gather the body params
    $transaction_data = [
       "email" => $email,
       "amount" => round($realprice * 100),
       "callback_url" => "http://localhost/Yurland/verify.php",
       "metadata" => [
          "custom_fields" => [
            [
                "display_name" => "Unique Product",
                "variable_name" => "product",
                "value" => $uniqueproduct
            ],

            [
                "display_name" => "Deducted Unit",
                "variable_name" => "unit",
                "value" => $deducted_unit
            ],

            [
                "display_name" => "Bought Units",
                "variable_name" => "boughtunit",
                "value" => $boughtunit
            ],

            [
                "display_name" => "Unique Person",
                "variable_name" => "person",
                "value" => $uniqueperson
            ],

            [
                "display_name" => "Product Name",
                "variable_name" => "productname",
                "value" => $product_name
            ],

            [
                "display_name" => "Payment Month",
                "variable_name" => "paymonth",
                "value" => $paymentmonth
            ],

            [
                "display_name" => "Payment Day",
                "variable_name" => "payday",
                "value" => $paymentday
            ],

            [
                "display_name" => "Payment Year",
                "variable_name" => "payyear",
                "value" => $paymentyear
            ],

            [
                "display_name" => "Payment Time",
                "variable_name" => "paytime",
                "value" => $paymenttime
            ],

            [
                "display_name" => "Product Location",
                "variable_name" => "productlocation",
                "value" => $productlocation
            ],

            [
                "display_name" => "Price",
                "variable_name" => "price",
                "value" => round($price)
            ],

            [
                "display_name" => "Product Image",
                "variable_name" => "prodimage",
                "value" => $image
            ],
            [
                "display_name" => "Payment Method",
                "variable_name" => "paymethod",
                "value" => $paymentmethod
            ],

            [
                "display_name" => "Payment Unit",
                "variable_name" => "payunit",
                "value" => $_GET['unit']
            ],

            [
                "display_name" => "Payment Type",
                "variable_name" => "payunit",
                "value" => "newpayment"
            ],

            [
                "display_name" => "New Price",
                "variable_name" => "newprice",
                "value" => round($newprice)
            ],

            [
                "display_name" => "New Price",
                "variable_name" => "newprice",
                "value" => round($newpay)
            ],

            [
                "display_name" => "Period",
                "variable_name" => "period",
                "value" => $period
            ],

            [
                "display_name" => "Sub Period",
                "variable_name" => "subperiod",
                "value" => $subperiod
            ],

            [
                "display_name" => "Payment Date",
                "variable_name" => "paydate",
                "value" => $paymentdate
            ],

            [
                "display_name" => "Payee",
                "variable_name" => "payee",
                "value" => $payee
            ],

            [
                "display_name" => "Agentid",
                "variable_name" => "Agentid",
                "value" => $agentid
            ],

            [
                "display_name" => "Allocation Fee",
                "variable_name" => "allocation fee",
                "value" =>  $allocationfee
            ],

            [
                "display_name" => "NewPay Id",
                "variable_name" => "newpayid",
                "value" => $newpayid
            ],

            [
                "display_name" => "Chosen Plan",
                "variable_name" => "chosenplan",
                "value" => $chosenplan
            ],

            [
                "display_name" => "Sub Price",
                "variable_name" => "subprice",
                "value" => $subprice
            ],

            [
                "display_name" => "First Date",
                "variable_name" => "First Date",
                "value" => $firstDate
            ],

            [
                "display_name" => "Increase Rate",
                "variable_name" => "Increase Rate",
                "value" => $increaserate
            ],
          ]
       ]
    ];

    // Generate a URL-encoded string
    $encode_transaction_data = http_build_query($transaction_data);

    // Open Connection to cURL
    $ch = curl_init();

    // Turn off Mandatory SSL checking
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //Set the url
    curl_setopt($ch, CURLOPT_URL, $url);

    // Enable data to be sent in POST arrays
    curl_setopt($ch, CURLOPT_POST, true);

    // Collect the posted data from above
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encode_transaction_data);
    
    //Set the headers from the endpoint
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
        "cache-Control: no-cache"
    ));

    // Make curl return the data instead of echoing
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL
    $result = curl_exec($ch);
    
    // Check for errors
    $errors = curl_error($ch);
    if($errors){
        $error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
    }

    if($result){
    
        echo $result;
        $transaction = json_decode($result);
      //Automatically redirect customers to the payment page
        header("Location: ".$transaction->data->authorization_url);
    }

    else {
        $error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
    }
}
    
}  
        } 
//  else{
//     $error = "You have an ongoing subscription on this estate, please complete payment";
//     header("Location: verify3.php?error=".$error."");
// } 

        
}

    

} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        height: 70vh !important;
    }



    header {
        background: #fee1e3;
    }

    @media only screen and (max-width: 1300px) {

        .btn-container .estate_page_button {
            width: 300px;
        }

        .user,
        #openicon {
            display: none;
        }

        .links img {
            display: none;
        }

        .detail3 {
            display: none;
        }

        .dropdown-links {
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
            transform: translateX(100%);
            transition: all 1s;
            width: 40%;
            position: fixed;
            bottom: 0;
            border-radius: 8px 0px 0px 8px;
        }

        .dropdown-links li {
            height: 1em;
            grid-gap: 0;
        }
    }

    @media only screen and (min-width: 1300px) {
        .page-title2 a {
            display: none;
        }

        .page-title2 {
            justify-content: left;
        }

        .page-title2 p {
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            color: #1A0709;
        }

        .center {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .menu {
            display: none;
        }

        .profile-image2 {
            display: none !important;
        }

        .user {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1em;
        }

        .user p {
            font-weight: 600;
            font-size: 20px;
            color: #1A0709;
        }

        .user .profile-image {
            width: 45px;
            height: 45px;
        }



        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
        }

        .details2 {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6em;
        }

        .details2 p {
            color: #808080;
        }

        .details2 p,
        .details2 h3 {
            font-size: 22px;
        }

        .land-btn-container {
            padding-left: 1em;
        }

        .land-btn-container .btn {
            width: 500px;
        }

        .menu {
            display: none;
        }

        .estate2 {
            display: block !important;
        }

        .land-estate {
            background: #FFFFFF;
            border-radius: 8px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            width: 290px;
            height: 270px;
            padding-top: 0;
            padding-bottom: 10px;
            display: flex;
            justify-content: top;
            align-items: center;
            gap: 1em;
            flex-direction: column;
            border-radius: 8px;
            margin-bottom: 1.6em;
        }

        .dropdown-links {
            width: 6%;
            height: 90vh;
            border-radius: 0px !important;
            padding: 1em 0;
            display: flex;
            flex-direction: column;
            justify-content: top;
            align-items: top;
            gap: 1.3em;
            background: #7e252b;
            filter: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999999 !important;
            transition: all 0.7s;
        }

        .dropdown-links li {
            height: 1em;
            width: 95%;
            text-transform: capitalize;
            font-size: 14px;
        }

        .dropdown-links .select-link {
            background-color: #1a0709;
        }

        .dropdown-links .links {
            width: 100%;
            display: flex !important;
            align-items: center;
            justify-content: center;
            padding: 1em 0;
            transition: 1s;
        }

        .dropdown-links .links:hover {
            background-color: #1a0709;
        }

        .dropdown-links .links img {
            width: 20px;
            height: 20px;
            margin-right: 6px;
            cursor: pointer;
        }

        .dropdown-links .links .link {
            visibility: hidden;
            display: none;
        }


        .dropdown-links li a {
            color: #fff;
        }

        .transaction-details {
            width: 80%;
            transition: all 1.5s;
        }


        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
        }

        .trans-container {
            width: 90%;
            padding-left: 5em;
        }


        .close {
            display: none;
        }


    }






    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
        width: 60%;
        margin-bottom: 1em;
    }

    @media only screen and (max-width: 1000px) {
        .select-box {
            border: 1px solid #808080;
            border-radius: 8px;
            width: 90%;
            margin-bottom: 1em;
        }
    }

    .error {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Space Grotesk";
        font-style: normal;
        font-weight: 600;
        font-size: 18px;
        line-height: 31px;
        text-align: center;
        color: #e11900;
        border: 1px solid #e11900;
        width: 30%;
        padding: 10px 10px;
        background-color: #e1dede;
        display: none;
    }

    .input-div input {
        width: 20em !important;
    }


    .land-location p {
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        color: var(--inactive-grey);
    }

    @media only screen and (max-width: 1300px) {
        .footerdiv {
            display: none;
        }
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['unique_id'])){?>
            <a href="profile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php 
             $user = new User;
             if(isset($_SESSION['unique_id'])){
             $newuser = $user->selectUser($_SESSION['unique_id']);
             }
             if(isset($_SESSION['uniqueagent_id'])){
             $newuser = $user->selectAgent($_SESSION['uniqueagent_id']);
             }
             if(isset($_SESSION['uniquesubadmin_id'])){
                $newuser = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
                }
            ?>
        <div class="nav">
            <?php if(!isset($_SESSION['uniqueagent_id']) || !isset($_SESSION['uniquesubadmin_id'])){?>
            <a href="cartreview.php">
                <div class="cart">
                    <div class="cart-notify"></div>
                    <img src="images/cart.svg" alt="cart icon" />
                </div>
            </a>
            <?php }?>
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <?php if(isset($_SESSION['unique_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['photo'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>
            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['agent_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['agent_img'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['agent_img'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['agent_img'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>
            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['subadmin_name'])){  ?>
                    <span><?php echo $newuser['subdamin_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['subadmin_image'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['subadmin_image'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['subadmin_image'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>
        </div>
    </header>

    <div class="page-title4">
        <div>
            <img src="images/orange-cart-icon.svg" alt="" />
        </div>
        <p>New Payment</p>
    </div>



    <div class="image-desc">
        <img src="landimage/<?php echo $value['product_image']; ?>" alt="" />
    </div>

    <div class="price-desc">
        <div>
            <div class="land-name">
                <p><span>Estate Name:&nbsp;</span><?php echo $value['product_name'];?></p>
            </div>
            <div class="land-location">
                <p><span>Estate Location:&nbsp;</span><?php echo $value['product_location'];?></p>
            </div>
            <?php if(!isset($_GET['remprice'])){?>
            <div class="land-location">
                <p style="text-transform: capitalize;"><span>Chosen Plan:&nbsp;</span><?php echo $_GET['data'];?></p>
            </div>
            <?php }?>
            <div class="land-location">
                <p style="text-transform: capitalize;"><span>Unit:&nbsp;</span><?php echo $_GET['unit'];?></p>
            </div>
            <div class="land-location">
                <p><span>Total Cost: &#8358;</span><?php 
                $totalcost =  $_GET['tot'];
                if($totalcost > 999 || $totalcost > 9999 || $totalcost > 99999 || $totalcost > 999999){
                    echo number_format(round($totalcost));
                    } else {
                        echo round($totalcost);
                    }
                ?></p>
            </div>
        </div>


        <form action="" method="POST" id="paymentform">
            <?php if(isset($_GET['remprice'])){  ?>
            <div class="input-div">
                <label for="day" style="width: 20em; padding-bottom: 3em;">Amount Due Today: &#8358;<?php if(isset($_GET['newpay'])){
                            $cost = round($_GET['newpay']);
                            if($cost > 999 || $cost > 9999 || $cost > 99999 || $cost > 999999){
                                echo number_format(round($cost));
                                } else {
                                    echo round($cost);
                                }
                        }
                        ?>

                </label>
            </div>
            <?php   } else {?>
            <?php if($_GET['data'] == "onemonth"){?>
            <div class="input-div">
                <label for="day" style="width: 20em; padding-bottom: 3em;">Daily Amount: &#8358;<?php 
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                <input type="hidden" id="dailyprice" value=<?php echo $dailycost;?> style="display: none;">
                <label style="width: 15em;">Amount Due Today: &#8358;<span id="totalprice"><?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></span></label>
                <input type="number" id="dayno" name="dayno" value="<?php echo $value['onemonth_period'];?>"
                    style="display: none;" />
            </div>
            <?php }?>


            <?php if($_GET['data'] == "threemonths"){?>
            <div class="input-div">
                <div class="input-div">
                    <label for="day" style="width: 20em; padding-bottom: 3em;">Daily Amount: &#8358;<?php 
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                    <input type="hidden" id="dailyprice" value=<?php echo $dailycost;?> style="display: none;">
                    <label style="width: 15em;">Amount Due Today: &#8358;<span id="totalprice"><?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></span></label>
                    <input type="number" id="dayno" name="dayno" value="<?php echo $value['threemonth_period'];?>"
                        style="display: none;" />
                </div>
                <?php }?>

                <?php if($_GET['data'] == "sixmonths"){?>
                <div class="input-div">
                    <div class="input-div">
                        <label for="day" style="width: 20em; padding-bottom: 3em;">Daily Amount: &#8358;<?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                        <input type="hidden" id="dailyprice" value=<?php echo $dailycost;?> style="display: none;">
                        <label style="width: 15em;">Amount Due Today: &#8358;<span id="totalprice"><?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></span></label>
                        <input type="number" id="dayno" name="dayno" value="<?php echo $value['sixmonth_period'];?>"
                            style="display: none;" />
                    </div>
                    <?php }?>

                    <?php if($_GET['data'] == "twelvemonths"){?>
                    <div class="input-div">
                        <div class="input-div">
                            <label for="day" style="width: 20em; padding-bottom: 3em;">Daily Amount: &#8358;<?php 
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                            <input type="hidden" id="dailyprice" value=<?php echo $dailycost;?> style="display: none;">
                            <label style="width: 15em;">Amount Due Today: &#8358;<span id="totalprice"><?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></span></label>
                            <input type="number" id="dayno" name="dayno"
                                value="<?php echo $value['twelvemonth_period'];?>" style="display: none;" />
                        </div>
                        <?php }?>

                        <?php if($_GET['data'] == "eighteenmonths"){?>
                        <div class="input-div">
                            <div class="input-div" style="width: 20em; padding-bottom: 3em;">
                                <label for="day">Daily Amount: &#8358;<?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                } 
                ?></label>
                                <input type="hidden" id="dailyprice" value=<?php echo $dailycost;?>
                                    style="display: none;">
                                <label style="width: 15em;">Amount Due Today: &#8358;<span id="totalprice"><?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></span></label>
                                <input type="number" id="dayno" name="dayno"
                                    value="<?php echo $value['eighteen_period'];?>" style="display: none;" />
                            </div>
                            <?php } }?>


                            <?php if(!isset($_GET['remprice'])){?>
                            <div class="input-div">
                                <input type="number" style="margin-bottom: 2em;"
                                    placeholder="Input number of days you want to pay for" value="1" id="period"
                                    name="period" pattern="[0-9]"
                                    onkeydown="if(event.key==='.'){event.preventDefault();}"
                                    onpaste="let pasteData = event.clipboardData.getData('text'); if(pasteData){pasteData.replace(/[^0-9]*/g,'');} "
                                    oninput="this.value=(parseInt(this.value)||'')" />

                            </div>
                            <?php }?>
                            <input type="hidden" name="planindicator" value="" id="plan">


                            <div class="btn-container">
                                <a href=""><button class="estate_page_button" type="submit"
                                        name="submit">Pay</button></a>
                            </div>
        </form>

        <?php }}?>
    </div>
    </div>
    <footer class="footerdiv">
        <p>YurLAND &#169; 2022 | All Right Reserved</p>
        <p>A product of Ilu-oba International Limited and Arklips Limited</p>
        <p>Connect with us Facebook, Twitter, Instagram</p>
        <p style="font-size: 30px">
            <i class="ri-instagram-line"></i><i class="ri-facebook-fill"></i><i class="ri-twitter-line"></i>
        </p>
    </footer>

    <script src="js/main.js"></script>
    <script>
    const params = new URLSearchParams(window.location.search)

    let planindicator = document.querySelector('#plan');

    var date = new Date();

    const plan = params.get('data')
    if (plan == "onemonth") {
        var firstDay = new Date(date.getFullYear(), date.getMonth() + 1, 1);
        let firstDate = `${firstDay.toLocaleString('default', {
                                month: 'short'
                            })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
        planindicator.value = firstDate;
    } else if (plan == "threemonths") {
        var firstDay = new Date(date.getFullYear(), date.getMonth() + 3, 1);
        let firstDate = `${firstDay.toLocaleString('default', {
                                month: 'short'
                            })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
        planindicator.value = firstDate;
    } else if (plan == "sixmonths") {
        var firstDay = new Date(date.getFullYear(), date.getMonth() + 6, 1);
        let firstDate = `${firstDay.toLocaleString('default', {
                                month: 'short'
                            })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
        planindicator.value = firstDate;
    } else if (plan == "twelvemonths") {
        var firstDay = new Date(date.getFullYear(), date.getMonth() + 12, 1);
        let firstDate = `${firstDay.toLocaleString('default', {
                                month: 'short'
                            })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
        planindicator.value = firstDate;
    } else if (plan == "eighteenmonths") {
        var firstDay = new Date(date.getFullYear(), date.getMonth() + 18, 1);
        let firstDate = `${firstDay.toLocaleString('default', {
                                month: 'short'
                            })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
        planindicator.value = firstDate;
    }

    <?php if(!isset($_GET['remprice'])){  ?>
    let inputprice = document.querySelector('#period');
    let dailyprice = document.querySelector('#dailyprice');

    inputprice.oninput = () => {
        if (inputprice.value != "") {
            document.querySelector('#totalprice').innerHTML = new Intl.NumberFormat().format(parseInt(inputprice
                .value) * Math.round(dailyprice.value));
        } else {
            document.querySelector('#totalprice').innerHTML = new Intl.NumberFormat().format(Math.round(dailyprice
                .value));
        }

    }

    <?php }?>

    setInterval(() => {
        let xls = new XMLHttpRequest();
        xls.open("GET", "getcart.php", true);
        xls.onload = () => {
            if (xls.readyState === XMLHttpRequest.DONE) {
                if (xls.status === 200) {
                    let data = xls.response;
                    let notify = document.querySelector('.cart-notify');
                    if (data == 0) {
                        notify.style.display = "none";
                    }

                    notify.innerHTML = data;
                    //console.log(data);
                }
            }
        }
        xls.send();
    }, 100);
    </script>
</body>

</html>