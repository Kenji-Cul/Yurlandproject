<?php 
session_start();
include_once "projectlog.php";
$curl = curl_init();

//Turn off SSL
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//Get the reference code from the URL
if(!empty($_GET["reference"])){
    //Clean the reference code
    $sanitize = filter_var_array($_GET, FILTER_SANITIZE_STRING);
    $reference = rawurlencode($sanitize["reference"]);
}else{
    die("No reference was supplied!");
}


// Set the configurations
curl_setopt_array($curl, array(
     CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
     CURLOPT_RETURNTRANSFER => true,
    //  Set the headers 
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
        "cache-control: no-cache"
    ]

));

// Execute CURL
$response = curl_exec($curl);

$err = curl_error($curl);
if($err){
    die("cURL returned some error:". $err);
}
// var_dump($response);

$trans = json_decode($response);
if(!$trans->status){
    die("API returned some errors:" .$trans->message);
}

if('success' == $trans->data->status){ 

    $filename = $trans->data->metadata->custom_fields[0]->value;

    $name = $trans->data->metadata->custom_fields[1]->value;
    $uniqueperson = $trans->data->metadata->custom_fields[2]->value;
    $uniqueproduct = $trans->data->metadata->custom_fields[3]->value;
    $product_name = $trans->data->metadata->custom_fields[4]->value;
    $paymentmonth = $trans->data->metadata->custom_fields[5]->value;
    $paymentday = $trans->data->metadata->custom_fields[6]->value;
    $paymentyear = $trans->data->metadata->custom_fields[7]->value;
    $paymenttime = $trans->data->metadata->custom_fields[8]->value;
    $productlocation = $trans->data->metadata->custom_fields[9]->value;
    $price = $trans->data->metadata->custom_fields[10]->value;
    $image = $trans->data->metadata->custom_fields[11]->value;
    $paymentmethod = $trans->data->metadata->custom_fields[12]->value;
    $unit = $trans->data->metadata->custom_fields[13]->value;
    $data = $trans->data->metadata->custom_fields[14]->value;
    $intervalinput = $trans->data->metadata->custom_fields[15]->value;
    $paymentdate = $trans->data->metadata->custom_fields[16]->value;
    $payee = $trans->data->metadata->custom_fields[17]->value;
    $agentid = $trans->data->metadata->custom_fields[18]->value;
    $allocationfee = $trans->data->metadata->custom_fields[19]->value;
    $limitperiod = $trans->data->metadata->custom_fields[20]->value;
    $totalprice = $trans->data->metadata->custom_fields[21]->value;
    $newbalance = $trans->data->metadata->custom_fields[22]->value;
    $newbalance2 = $trans->data->metadata->custom_fields[23]->value;
    $newpayid = $trans->data->metadata->custom_fields[24]->value;
    $balance = $trans->data->metadata->custom_fields[25]->value;
    $subprice2 = $trans->data->metadata->custom_fields[26]->value;
    $allocationfee2 = $trans->data->metadata->custom_fields[27]->value;
    $deducted_unit = $trans->data->metadata->custom_fields[28]->value;
    $boughtunit = $trans->data->metadata->custom_fields[29]->value;
    $firstdate = $trans->data->metadata->custom_fields[30]->value;
    $increaserate = $trans->data->metadata->custom_fields[31]->value;
    $adminid  = $trans->data->metadata->custom_fields[32]->value;
  
if($unit % 4 == 0){
  $unit_added = $unit / 4;
  $addedunit = $unit + $unit_added;
} else {
  $addedunit = $unit;
}

$land = new User;



if($unit % 4 == 0){
$unit_added = $unit / 4;
$added_unit = $unit + $unit_added;

if($balance < 1){
    $selectuser = $land->selectUser($uniqueperson);
    header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".$price."&balance=".$balance."&payer=".$payee."&email=".$selectuser['email']."");
} else {
    $selectuser = $land->selectUser($uniqueperson);
    header("Location: offer2.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&totalcost=".$newbalance2."&allocationfee=".$allocationfee2."&units=".$added_unit."&subprice=".$subprice2."&paydate=".$paymentdate."&period=".$limitperiod."&customer=".$name."&amount=".$price."&balance=".$balance."&payer=".$payee."&email=".$selectuser['email']."");
}

$insertpayment =
$land->insertPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$added_unit,$paymentmethod,$paymentdate,$data,$intervalinput,$price,$payee,$agentid,$allocationfee,$limitperiod,$totalprice,$filename,$newbalance,$newpayid,$balance,$price,$firstdate,$increaserate,$adminid);

$executives = $land->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $price;
      $insertearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }
  }

$agentearnee = $land->selectAgent($agentid);
$userearnee = $land->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $price;
$insertearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * $price;
  $insertearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);

  $referredusers = $land->selectReferredCustomer($userearnee['personal_ref']);
  if(!empty($referredusers) && $userearnee['referral_id'] != 'Yurland'){
        $refagent = $land->selectReferralAgent($userearnee['referral_id']);
        $earnerid2 = $refagent['uniqueagent_id'];
        $earnee2 = $refagent['agent_name'];
        $earnedamount2 = $refagent['downliner_percentage'] / 100 * $price;
        $selectuser = $land->selectUser($uniqueperson);
        $name2 = $selectuser['first_name'].' '.$selectuser['last_name'];
        $insertagentearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid2,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount2,$earnee2,$name2,$product_name,$newpayid);
  }

  if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee3 = $value['full_name'];
$earnedamount = $value['downliner_earning'] / 100 * $price;
$selectuser = $land->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee3,$name,$product_name,$newpayid);
    }
  }
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $land->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * $price;
    $insertearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }


$inserthistory =
$land->insertPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$added_unit,$paymentmethod,$paymentdate,$data,$intervalinput,$price,$payee,$agentid,$allocationfee,$limitperiod,$filename,$newpayid,$balance,$price,$adminid);

$update = $land->updateUnit($deducted_unit,$uniqueproduct,$boughtunit);
} else {

    if($balance < 1){
        $selectuser = $land->selectUser($uniqueperson);
        header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".$price."&balance=".$balance."&payer=".$payee."&email=".$selectuser['email']."");
    }else {
        $selectuser = $land->selectUser($uniqueperson);
        header("Location: offer2.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&totalcost=".$newbalance2."&allocationfee=".$allocationfee2."&units=".$unit."&subprice=".$subprice2."&paydate=".$paymentdate."&period=".$limitperiod."&customer=".$name."&amount=".$price."&balance=".$balance."&payer=".$payee."&email=".$selectuser['email']."");
    }

$insertpayment =
$land->insertPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$unit,$paymentmethod,$paymentdate,$data,$intervalinput,$price,$payee,$agentid,$allocationfee,$limitperiod,$totalprice,$filename,$newbalance,$newpayid,$balance,$price,$firstdate,$increaserate,$adminid);

$executives = $land->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $price;
      $insertearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }
  }

$agentearnee = $land->selectAgent($agentid);
$userearnee = $land->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $price;
$insertearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * $price;
  $insertearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
  
  $referredusers = $land->selectReferredCustomer($userearnee['personal_ref']);
  if(!empty($referredusers) && $userearnee['referral_id'] != 'Yurland'){
        $refagent = $land->selectReferralAgent($userearnee['referral_id']);
        $earnerid2 = $refagent['uniqueagent_id'];
        $earnee2 = $refagent['agent_name'];
        $earnedamount2 = $refagent['downliner_percentage'] / 100 * $price;
        $selectuser = $land->selectUser($uniqueperson);
        $name2 = $selectuser['first_name'].' '.$selectuser['last_name'];
        $insertagentearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid2,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount2,$earnee2,$name2,$product_name,$newpayid);
  }

  if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee3 = $value['full_name'];
$earnedamount = $value['downliner_earning'] / 100 * $price;
$selectuser = $land->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee3,$name,$product_name,$newpayid);
    }
  }
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $land->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * $price;
    $insertearning = $land->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }


$inserthistory =
$land->insertPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$unit,$paymentmethod,$paymentdate,$data,$intervalinput,$price,$payee,$agentid,$allocationfee,$limitperiod,$filename,$newpayid,$balance,$price,$adminid);
$update = $land->updateUnit($deducted_unit,$uniqueproduct,$boughtunit);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        height: 80vh !important;
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>

        <div class="nav">
            <img src="images/cart.svg" alt="cart icon" />
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="success">
        <img src="images/asset_success.svg" alt="" />
        <p>Payment Successful!</p>
        <?php if(isset($_SESSION['unique_id'])){?>
        <a href="profile.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniqueagent_id'])){?>
        <a href="agentprofile.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <a href="subadmin.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <a href="superadmin.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
    </div>

    <script src="js/main.js"></script>
</body>

</html>

<?php 
} else { 
    die("Transaction not found!");
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
    <title>Yurland</title>
    <style>
    body {
        height: 80vh !important;
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
        </div>

        <div class="nav">
            <img src="images/cart.svg" alt="cart icon" />
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="success">
        <img src="images/asset_success.svg" alt="" />
        <p>Payment Unsuccessful!</p>
        <?php if(isset($_SESSION['unique_id'])){?>
        <a href="profile.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniqueagent_id'])){?>
        <a href="agentprofile.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <a href="subadmin.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <a href="superadmin.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
    </div>

    <script src="js/main.js"></script>
</body>

</html>


<?php
}
?>