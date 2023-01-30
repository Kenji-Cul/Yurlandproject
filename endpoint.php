<?php

$user = new User;
$selectuser = $user->selectUser($_SESSION['unique_id']);
$email = $selectuser['email'];


if($initializemessage == "Authorization URL created"){
  $url = "https://api.paystack.co/subscription";
  
  $fields = [
    'customer' => $email,
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
  $enddata = json_decode($result);
  $endmessage = $enddata->message;
 if($endmessage == "Subscription successfully created"){
    header("Location: verify5.php");
 }
  
  } 
   

 
}
?>