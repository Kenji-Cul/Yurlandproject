<?php
session_start();
include "projectlog.php";
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
    // $status = $trans->data->status;
    $unique = $trans->data->metadata->custom_fields[0]->value;

    $deductedunit = $trans->data->metadata->custom_fields[1]->value;
    $boughtunit = $trans->data->metadata->custom_fields[2]->value;
    $uniqueperson = $trans->data->metadata->custom_fields[3]->value;
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
    $paymenttype = $trans->data->metadata->custom_fields[14]->value;
    $paymentdate = $trans->data->metadata->custom_fields[15]->value;
    $payee = $trans->data->metadata->custom_fields[16]->value;
    $agentid = $trans->data->metadata->custom_fields[17]->value;
    $allocationfee = $trans->data->metadata->custom_fields[18]->value;
    $newpayid = $trans->data->metadata->custom_fields[19]->value;

    

   
   $user = new User;

   if($paymenttype == "failedpayment"){ 
    $failedcharge = $trans->data->metadata->custom_fields[20]->value;
    $balance = $trans->data->metadata->custom_fields[21]->value;
    $prodprice = $trans->data->metadata->custom_fields[22]->value;
    $updatepayment = $user->updateFailedPayment($newpayid,$uniqueperson,$unique,$failedcharge,$balance,$prodprice);
    $executives = $user->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $price;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }
  }

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $price;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * $price;
  $selectuser = $user->selectUser($uniqueperson);
  $name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $user->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * $price;
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
    $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }

    if($balance < "2"){
      $uniquename = rand();
      $filename = "allocationletter".$uniquename.".pdf";
      $selectuser = $user->selectUser($uniqueperson);
      $name = $selectuser['first_name'].' '.$selectuser['last_name'];
     
      
        if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
          $allocationfee2 = number_format($allocationfee);
        } else {
          $allocationfee2 =  round($allocationfee);
        }
  
        $selectuser = $user->selectUser($uniqueperson);
      header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".$price."&balance=".$balance."&payer=".$payee."&email=".$selectuser['email']."");

      
      $inserthistory = $user->insertFailedHistory($uniqueperson,$unique,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$image,$boughtunit,$paymentmethod,$paymentdate,$product_name,$payee,$agentid,$allocationfee,$newpayid,$price,$filename,$balance);
    } else {
      $inserthistory = $user->insertFailedHistory2($uniqueperson,$unique,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$image,$boughtunit,$paymentmethod,$paymentdate,$product_name,$payee,$agentid,$allocationfee,$newpayid,$price,$balance);

      $username = $user->selectUser($uniqueperson);
$customername = $username['first_name']." ".$username['last_name'];
$paymentdate = date("M-d-Y");
$unitprice = $price;
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount3 = number_format($unitprice);
} else {
$amount3 = round($unitprice);
}

$unitprice2 = $balance;
if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
$amount4 = number_format($unitprice2);
} else {
$amount4 = round($unitprice2);
}
header("Location: successemail.php?name=".$customername."&date=".$paymentdate."&amount=".$amount3."&estate=".$product_name."&payer=".$payee."&balance=".$amount4."&email=".$username['email']."");
    }

    
   }

   if($paymenttype == "outrightpayment"){
   if($unit % 4 == 0){
    $unit_added = $unit / 4;
    $added_unit = $unit + $unit_added;

    $uniquename = rand();
    $filename = "allocationletter".$uniquename.".pdf";
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
   
    
      if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
        $allocationfee2 = number_format($allocationfee);
      } else {
        $allocationfee2 =  round($allocationfee);
      }

      $balance = 0;
      $selectuser = $user->selectUser($uniqueperson);
    header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".$price."&balance=".$balance."&payer=".$payee."&email=".$selectuser['email']."");

$insertpayment = $user->insertOutPayment($uniqueperson,$unique,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$added_unit,$paymentmethod,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid);

$executives = $user->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $price;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }
  }

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $price;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * $price;
  $selectuser = $user->selectUser($uniqueperson);
  $name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $user->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * $price;
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
    $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }




$inserthistory = $user->insertOutPayHistory($uniqueperson,$unique,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$added_unit,$paymentmethod,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid);




} else {
    $uniquename = rand();
    $filename = "allocationletter".$uniquename.".pdf";
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
   
    
      if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
        $allocationfee2 = number_format($allocationfee);
      } else {
        $allocationfee2 =  round($allocationfee);
      }

     $balance = 0;
     $selectuser = $user->selectUser($uniqueperson);
    header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".$price."&balance=".$balance."&payer=".$payee."&email=".$selectuser['email']."");
   $insertpayment = $user->insertOutPayment($uniqueperson,$unique,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$unit,$paymentmethod,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid);

   $executives = $user->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $price;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }
  }

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $price;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * $price;
  $selectuser = $user->selectUser($uniqueperson);
  $name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $user->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * $price;
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
    $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }


   $inserthistory = $user->insertOutPayHistory($uniqueperson,$unique,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$unit,$paymentmethod,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid);

   
}
   }

   if($paymenttype == "newpayment"){
    $newprice = $trans->data->metadata->custom_fields[15]->value;
    $newpay = $trans->data->metadata->custom_fields[16]->value;
    $period = $trans->data->metadata->custom_fields[17]->value;
    $subperiod = $trans->data->metadata->custom_fields[18]->value;
    $paymentdate = $trans->data->metadata->custom_fields[19]->value;
    $payee = $trans->data->metadata->custom_fields[20]->value;
    $agentid = $trans->data->metadata->custom_fields[21]->value;
    $allocationfee = $trans->data->metadata->custom_fields[22]->value;
    $newpayid = $trans->data->metadata->custom_fields[23]->value;
    $firstdate = $trans->data->metadata->custom_fields[26]->value;
    $increaserate = $trans->data->metadata->custom_fields[27]->value;
    
   
    
  
if($unit % 4 == 0){
    $unit_added = $unit / 4;
    $added_unit = $unit + $unit_added;

$checklastpayment = $user->selectLastPay($uniqueperson,$unique,$newpayid);
if(empty($checklastpayment)){
    $chosenplan = $trans->data->metadata->custom_fields[24]->value;
    $subprice = $trans->data->metadata->custom_fields[25]->value;
    $firstdate = $trans->data->metadata->custom_fields[26]->value;
    $increaserate = $trans->data->metadata->custom_fields[27]->value;


    $uniquename = rand();
    $filename = "offerletter".$uniquename.".pdf";
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
    $newbalance = $newpay + $newprice;
    if($newbalance > 999 || $newbalance > 9999 || $balance > 99999 || $balance > 999999){
        $newbalance2 = number_format($newbalance);
      } else {
          $newbalance2 =  $newbalance;
      }
      if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
        $allocationfee2 = number_format($allocationfee);
      } else {
        $allocationfee2 =  round($allocationfee);
      }

      if($subprice > 999 || $subprice > 9999 || $subprice > 99999 || $subprice > 999999){
        $subprice2 = number_format(ceil($subprice));
      } else {
        $subprice2 =  ceil($subprice);
      }
    header("Location: offer.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&totalcost=".$newbalance2."&allocationfee=".$allocationfee2."&units=".$added_unit."&subprice=".$subprice2."&paydate=".$paymentdate."&period=".$subperiod."&enddate=".$period."&customer=".$name."&amount=".$newpay."&balance=".$newprice."&payer=".$payee."&email=".$selectuser['email']."");
    $insertpayment = $user->insertNewPayment($uniqueperson,$unique,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$newpay,$image,$added_unit,$paymentmethod,$newprice,$period,$subperiod,$newpay,$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee,$filename,$newbalance,$newpayid,$firstdate,$increaserate);

    $executives = $user->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $newpay;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }
  }

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $newpay;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * $newpay;
  $selectuser = $user->selectUser($uniqueperson);
  $name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $user->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * $newpay;
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
    $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }


    
    $inserthistory = $user->insertNewPayHistory($uniqueperson,$unique,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$newpay,$image,$added_unit,$paymentmethod,$newpay,$period,$subperiod,$newpay,$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee,$filename,$newpayid);

  
} else {
    $addedprice = $checklastpayment['product_price'] + $newpay;
    if($newprice < 1){
        $uniquename = rand();
        $filename = "allocationletter".$uniquename.".pdf";
        $selectuser = $user->selectUser($uniqueperson);
        $name = $selectuser['first_name'].' '.$selectuser['last_name'];
       
        
          if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
            $allocationfee2 = number_format($allocationfee);
          } else {
            $allocationfee2 =  round($allocationfee);
          }
    
          $selectuser = $user->selectUser($uniqueperson);
        header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".$newpay."&balance=".$newprice."&payer=".$payee."&email=".$selectuser['email']."");
    }
$updatepay = $user->updateNewPayment($uniqueperson,$unique,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$addedprice,$image,$added_unit,$payment_method,$paymentdate,$newprice,$period,$subperiod,$payee,$agentid,$allocationfee,$newpayid,$firstdate,$increaserate);

$executives = $user->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $newpay;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }
  }

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $newpay;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * $newpay;
  $selectuser = $user->selectUser($uniqueperson);
  $name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $user->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * $newpay;
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
    $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }


$inserthistory = $user->insertUpdateHistory($uniqueperson,$unique,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$newpay,$image,$added_unit,$payment_method,$paymentdate,$newprice,$period,$subperiod,$product_name,$payee,$agentid,$allocationfee,$newpayid);

$username = $user->selectUser($uniqueperson);
$customername = $username['first_name']." ".$username['last_name'];
$paymentdate = date("M-d-Y");
$unitprice = $newpay;
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount3 = number_format($unitprice);
} else {
$amount3 = round($unitprice);
}

$unitprice2 = $newprice;
if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
$amount4 = number_format($unitprice2);
} else {
$amount4 = round($unitprice2);
}
header("Location: successemail.php?name=".$customername."&date=".$paymentdate."&amount=".$amount3."&estate=".$product_name."&payer=".$payee."&balance=".$amount4."&email=".$username['email']."");

      
}

$updatenewpayment = $user->updatePayment($unique,$uniqueperson,$newpayid);
} else {
    $checklastpayment = $user->selectLastPay($uniqueperson,$unique,$newpayid);
    if(empty($checklastpayment)){
        $chosenplan = $trans->data->metadata->custom_fields[24]->value;
        $subprice = $trans->data->metadata->custom_fields[25]->value;
        $firstdate = $trans->data->metadata->custom_fields[26]->value;
        $increaserate = $trans->data->metadata->custom_fields[27]->value;

        $uniquename = rand();
        $filename = "offerletter".$uniquename.".pdf";
        $selectuser = $user->selectUser($uniqueperson);
        $name = $selectuser['first_name'].' '.$selectuser['last_name'];
        $newbalance = $newpay + $newprice;
        if($newbalance > 999 || $newbalance > 9999 || $balance > 99999 || $balance > 999999){
            $newbalance2 = number_format($newbalance);
          } else {
              $newbalance2 =  $newbalance;
          }
          if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
            $allocationfee2 = number_format($allocationfee);
          } else {
            $allocationfee2 =  round($allocationfee);
          }
    
          if($subprice > 999 || $subprice > 9999 || $subprice > 99999 || $subprice > 999999){
            $subprice2 = number_format(ceil($subprice));
          } else {
            $subprice2 =  ceil($subprice);
          }
        header("Location: offer.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&totalcost=".$newbalance2."&allocationfee=".$allocationfee2."&units=".$unit."&subprice=".$subprice2."&paydate=".$paymentdate."&period=".$subperiod."&enddate=".$period."&customer=".$name."&amount=".$newpay."&balance=".$newprice."&payer=".$payee."&email=".$selectuser['email']."");
   $insertpayment = $user->insertNewPayment($uniqueperson,$unique,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$newpay,$image,$unit,$paymentmethod,$newprice,$period,$subperiod,$newpay,$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee,$filename,$newbalance,$newpayid,$firstdate,$increaserate);

   $executives = $user->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $newpay;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }
  }

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $newpay;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * $newpay;
  $selectuser = $user->selectUser($uniqueperson);
  $name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $user->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * $newpay;
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
    $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }



   $inserthistory = $user->insertNewPayHistory($uniqueperson,$unique,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$newpay,$image,$unit,$paymentmethod,$newprice,$period,$subperiod,$newpay,$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee,$filename,$newpayid);
  
   

    } else {
        $addedprice = $checklastpayment['product_price'] + $newpay;
        if($newprice < 1){
            $uniquename = rand();
            $filename = "allocationletter".$uniquename.".pdf";
            $selectuser = $user->selectUser($uniqueperson);
            $name = $selectuser['first_name'].' '.$selectuser['last_name'];
           
            
              if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
                $allocationfee2 = number_format($allocationfee);
              } else {
                $allocationfee2 =  round($allocationfee);
              }
        
              $selectuser = $user->selectUser($uniqueperson);
            header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".$newpay."&balance=".$newprice."&payer=".$payee."&email=".$selectuser['email']."");

            $updatepay = $user->updateNewPayment2($uniqueperson,$unique,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$addedprice,$image,$unit,$paymentmethod,$paymentdate,$newprice,$period,$subperiod,$payee,$agentid,$allocationfee,$filename,$newpayid);

            $executives = $user->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $newpay;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }
  }

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $newpay;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * $newpay;
  $selectuser = $user->selectUser($uniqueperson);
  $name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $user->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * $newpay;
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
    $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }


            $inserthistory = $user->insertUpdateHistory2($uniqueperson,$unique,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$newpay,$image,$unit,$paymentmethod,$paymentdate,$newprice,$period,$subperiod,$product_name,$payee,$agentid,$allocationfee,$filename,$newpayid);
        } else {
            $updatepay = $user->updateNewPayment($uniqueperson,$unique,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$addedprice,$image,$unit,$paymentmethod,$paymentdate,$newprice,$period,$subperiod,$payee,$agentid,$allocationfee,$newpayid,$firstdate,$increaserate);

            $executives = $user->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $newpay;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }
  }

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $newpay;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * $newpay;
  $selectuser = $user->selectUser($uniqueperson);
  $name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $user->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * $newpay;
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
    $insertearning = $user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$newpay,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid);
    }


            $inserthistory = $user->insertUpdateHistory($uniqueperson,$unique,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$newpay,$image,$unit,$paymentmethod,$paymentdate,$newprice,$period,$subperiod,$product_name,$payee,$agentid,$allocationfee,$newpayid);

            $username = $user->selectUser($uniqueperson);
            $customername = $username['first_name']." ".$username['last_name'];
            $paymentdate = date("M-d-Y");
            $unitprice = $newpay;
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount3 = number_format($unitprice);
} else {
$amount3 = round($unitprice);
}

$unitprice2 = $newprice;
if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
$amount4 = number_format($unitprice2);
} else {
$amount4 = round($unitprice2);
}
            header("Location: successemail.php?name=".$customername."&date=".$paymentdate."&amount=".$amount3."&estate=".$product_name."&payer=".$payee."&balance=".$amount4."&email=".$username['email']."");
        }
   

   
    
    }
    
   $updatenewpayment = $user->updatePayment($unique,$uniqueperson,$newpayid);
}
   }

   $update = $user->updateUnit($deductedunit,$unique,$boughtunit);
   if(isset($_SESSION['unique_id'])){
   $delete = $user->DeleteCartId($unique,$_SESSION['unique_id']);
   if (isset($unique) && is_numeric($unique) && isset($unique) && isset($_SESSION['cart'][$unique])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$unique]);
    
}
   }

if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){
    $delete = $user->DeleteCartId($unique,$uniqueperson);
    if (isset($unique) && is_numeric($unique) && isset($unique) && isset($_SESSION['cart'][$unique])) {
     // Remove the product from the shopping cart
     unset($_SESSION['cart'][$unique]);
}
}



    // $email = $trans->data->customer->email;
    // $ref = $trans->data->reference;
    

    // date_default_timezone_set('Africa/Lagos');
    //      $date_time = date('m/d/Y h:i:s a',time());
    
    //      include('database/mydb.php');
    //      $stat = $con->prepare("INSERT INTO customer_details(status, reference, date_purchased, email)  VALUES(?,?,?,?)");
    //      $stat->bind_param("ssss", $status, $ref, $date_time, $email);
    //      $stat->execute();


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
        height: 80vh !important;
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['unique_id'])){?>
            <a href="profile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else if(isset($_SESSION['uniqueagent_id'])){?>
            <a href="agentprofile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else if(isset($_SESSION['uniquesubadmin_id'])){?>
            <a href="subadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else if(isset($_SESSION['uniquesupadmin_id'])){?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>


    </header>

    <div class="success">
        <img src="images/asset_success.svg" alt="" />
        <p>Payment Successful!</p>
        <?php if(isset($_SESSION['unique_id'])){?>
        <a href="profile.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniqueagent_id'])){?>
        <a href="mycustomers.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
        <a href="allcustomers.php"><button class="landing_page_button2">Back to Dashboard</button></a>
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
        <a href="mycustomers.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
        <a href="allcustomers.php"><button class="landing_page_button2">Back to Dashboard</button></a>
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

</html>