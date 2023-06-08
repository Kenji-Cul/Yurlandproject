<?php

$user = new User;
$selectuser = $user->selectUser($_GET['user']);
$customer = $selectuser['first_name']." ".$selectuser['last_name'];
if(isset($_SESSION['uniqueagent_id'])){
$selectagent = $user->selectAgent($_SESSION['uniqueagent_id']);
}
if(isset($_SESSION['uniquesubadmin_id'])){
$subadmin = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
}

if(isset($_SESSION['uniquesupadmin_id'])){
  $subadmin = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
  }
if(isset($_SESSION['uniqueagent_id'])){
  $payee = $selectagent['agent_name'];
  $agentid = $selectagent['uniqueagent_id'];
  $adminid = "";
} 

if(isset($_SESSION['uniquesubadmin_id'])){
  $payee = $subadmin['subadmin_name'];
  $agentid = "noagent";
  $adminid = $subadmin['unique_id'];
}

if(isset($_SESSION['uniquesupadmin_id'])){
  $payee = $subadmin['super_adminname'];
  $agentid = "noagent";
  $adminid = $subadmin['unique_id'];
}
$email = $selectuser['email'];
$realprice = round($intervalprice * 100);

$callurl = "http://localhost/Yurland/verify2.php";

$uniquename = rand();
$limit2 = $limit - 1;
$filename = "offerletter".$uniquename.".pdf";
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$newbalance = $totalprice;
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

  if($intervalprice > 999 || $intervalprice > 9999 || $intervalprice > 99999 ||$intervalprice > 999999){
    $subprice2 = number_format(round($intervalprice));
  } else {
    $subprice2 =  round($intervalprice);
  }

$myfile = fopen("".$filename."", "w");

if($message == "Plan created"){
  $url = "https://api.paystack.co/transaction/initialize";
  

  $fields = [
    'email' => $email,
    'amount' => $realprice,
    'plan' => $plan_code,
    "callback_url" => $callurl,
    "metadata" => [
        "custom_fields" => [
        [
            "display_name" => "File Name",
            "variable_name" => "filename",
            "value" => $filename
        ],

        [
            "display_name" => "User Name",
            "variable_name" => "username",
            "value" => $name
        ],

        [
            "display_name" => "Unique Person",
            "variable_name" => "person",
            "value" => $uniqueperson
        ],

        [
            "display_name" => "Unique Product",
            "variable_name" => "uniqueproduct",
            "value" => $uniqueproduct
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
            "value" => round($intervalprice)
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
            "display_name" => "PayData",
            "variable_name" => "paydata",
            "value" => $_GET['data']
        ],

        [
            "display_name" => "Intervalinput",
            "variable_name" => "intervalinput",
            "value" => $intervalinput
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
            "display_name" => "Limit Period",
            "variable_name" => "limit period",
            "value" =>  $limit2
        ],

        
        [
            "display_name" => "Total price",
            "variable_name" => "totalprice",
            "value" =>  $totalprice
        ],

        [
            "display_name" => "New balance",
            "variable_name" => "newbalance",
            "value" =>  $newbalance
        ],

        [
            "display_name" => "New balancetwo",
            "variable_name" => "newbalancetwo",
            "value" =>  $newbalance2
        ],

        [
            "display_name" => "New balance",
            "variable_name" => "newbalance",
            "value" =>  $newpayid
        ],

        
        [
            "display_name" => "balance",
            "variable_name" => "balance",
            "value" =>  $balance
        ],

        [
            "display_name" => "subprice",
            "variable_name" => "subprice",
            "value" =>  $subprice2
        ],

        [
            "display_name" => "Allocation Feetwo",
            "variable_name" => "allocation feetwo",
            "value" =>  $allocationfee2
        ],

        [
            "display_name" => "Deducted Unit",
            "variable_name" => "Deducted unit",
            "value" =>  $deducted_unit
        ],

        [
            "display_name" => "Bought Unit",
            "variable_name" => "Boughtunit",
            "value" =>  $boughtunit
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

        [
            "display_name" => "Adminid",
            "variable_name" => "Adminid",
            "value" => $adminid
        ],
        

      ]
    ]
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
  } else {
  //echo $result;
  $initialize_data = json_decode($result);
  $initialize_url = $initialize_data->data->authorization_url;

 

header("Location: ".$initialize_url);

//exit;
}


}
?>