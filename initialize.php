<?php

$user = new User;
$selectuser = $user->selectUser($_SESSION['unique_id']);
$email = $selectuser['email'];
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
$realprice = round($price * 100);

if($message == "Plan created"){
  $url = "https://api.paystack.co/transaction/initialize";
  

  $fields = [
    'email' => $email,
    'amount' => $realprice,
    'plan' => $plan_code
  ];

  $fields_string = http_build_query($fields);

  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
    "Cache-Control: no-cache",
  ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $result = curl_exec($ch);
  $err = curl_error($ch);
  
  if($err){
    $error = "You are not connected to the internet";
    header("Location: verify3.php?error=".$error."");
  } else{
  //echo $result;
  $initialize_data = json_decode($result);
  $initialize_url = $initialize_data->data->authorization_url;
  
    header("Location: ".$initialize_url);
     if($_GET['unit'] % 4 == 0){
      $unit_added = $_GET['unit'] / 4;
    $added_unit = $_GET['unit'] + $unit_added;
 
 $insertpayment = $land->insertPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($price),$image,$added_unit,$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid);

 $inserthistory = $land->insertPayHistory($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($price),$image,$added_unit,$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid);
 
 $update = $land->updateUnit($deducted_unit,$uniqueproduct,$boughtunit);
 } else {
     $insertpayment = $land->insertPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($price),$image,$_GET['unit'],$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid);

     $inserthistory = $land->insertPayHistory($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($price),$image,$_GET['unit'],$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid);
     $update = $land->updateUnit($deducted_unit,$uniqueproduct,$boughtunit);
 }

 
 
 
 
   //exit;
  } 
   

  //include "receiver.php";
}
?>