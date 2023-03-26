<?php

$user = new User;
$selectuser = $user->selectUser($_SESSION['unique_id']);
$email = $selectuser['email'];
$payee = $selectuser['first_name']." ".$selectuser['last_name'];
$customer = $selectuser['first_name']." ".$selectuser['last_name'];
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
  $initializemessage = $initialize_data->message;

  

//Getting image
$png = file_get_contents('http://localhost/Yurland/images/yurlogo.png');
$pngbase64 = base64_encode($png);


if($_GET['unit'] % 4 == 0){
  $unit_added = $_GET['unit'] / 4;
  $addedunit = $_GET['unit'] + $unit_added;
} else {
  $addedunit = $_GET['unit'];
}


$uniquename = rand();
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

  if($price > 999 || $price > 9999 || $price > 99999 || $price > 999999){
    $subprice2 = number_format(round($price));
  } else {
    $subprice2 =  round($price);
  }

$myfile = fopen("".$filename."", "w");
$txt = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">   
    <title>Offer Letter</title>
    <style>
    .body {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4em;
        position: relative;
        font-family: "Sofia Sans", sans-serif;
    }

    .naira{
        font-family: DejaVu Sans !important;
    }
    
    .watermark {
        opacity: 0.6;
        position: fixed;
        left: 0;
        top: 20%;
        width: 90%;
        height: auto;
    }

    

    .border {
        height: 100%;
        width: 100%;
        position: relative;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    .customer {
        padding-left: 1em;
    }

    .logo {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1em;
    }

    .div {
        display: flex;
        gap: 1em;
    }

    .list ul li {
        list-style-type: none;
        padding-bottom: 1em;
        font-weight: bold;
    }

    .heading {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    </style>
</head>

<body class="body">
    <div class="border">
        <div class="logo">
        <img src="data:image;base64,<?='.$pngbase64.';?>"/>
<img class="watermark" src="data:image;base64,<?='.$pngbase64.';?>" />
<h1>yurLAND</h1>
</div>
<div class="customer">
    <h4>Dear '.$customer.'</h4>
</div>
<div class="heading">
    <h2 style="text-transform: uppercase">
        ACKNOWLEDGEMENT LETTER AND TERMS OF CONDITION
    </h2>
    <p>
        Thank you for your interest in YURLAND. We write to affirm that we received your purchase request. Do
        see below details of purchase and the terms and conditions attached.
    </p>
</div>
<div class="list">
    <ul>
        <li>ESTATE NAME: '.$product_name.'</li>
        <li>LOCATION: '.$productlocation.'</li>
        <li>DOCUMENTS ATTACHED: '.$filename.'</li>
        <li>TOTAL COST:<span class="naira">&#x20A6;</span>'.$newbalance2.'</li>
        <li>ALLOCATION FEE:<span class="naira">&#x20A6;</span>'.$allocationfee2.'</li>
        <li>UNITS BOUGHT: '.$addedunit.'</li>
        <li>DAILY PAYMENT:<span class="naira">&#x20A6;</span>'.$subprice2.'</li>
        <li>PERIOD OF PAYMENT: '.$limitperiod.'</li>
        <li>START DATE: '.$paymentdate.'</li>
    </ul>
</div>
<div class="heading">
    <h2 style="text-transform: uppercase">
        Scope of Relationship Between yurLAND and her customers.
    </h2>
    <ol style="display: flex; flex-direction: column; gap: 1em" type="1">
        <li>
            You can make a purchase on our platform as long as you are a verified user with accurate database and proper
            documentation.
        </li>
        <li>
            Our lands are sold in units, a unit is therefore equivalent to half a plot of land (250 - 300spm)
        </li>
        <li>
            Users who purchase up to 4 units at a single purchase transaction, gets one free unit. This offer is valid
            for all our estates locations.
        </li>
        <li>
            With yurLAND, you would be able to buy a LAND and pay over a minimum period of 1 month to a maximum period
            of 18 months or outright.
        </li>
        <li>
            Users who do not complete their payments before deadline of their plans, would be charged a contract
            breaking fee of up to 10% on location price for every extra month(s) spent on the plan.
        </li>
        <li>
            Payments on yurLAND are processed electronically on the web app either by manual operations daily, weekly or
            monthly or by automation using our auto debit feature enabled by our partners PAYSTACK
        </li>
        <li>
            Users can also make payments offline, directly to the provided company"s account only. Users who decides to
            make such payments are expected to contact their attached agents or our customer supports.
        </li>
        <li>
            Lands are available for inspection under the following conditions; On schedule/Request and Via Feed your eye
            (details explained on our platform)
        </li>
        <li>
            A user is allowed to change their location of choice just once under the following conditions;
        </li>
    </ol>
</div>
<div class="heading" style="padding: 4em">
    <ol style="display: flex; flex-direction: column; gap: 1em" type="a">
        <li>
            <b>Upgrade</b> - A user who wants to change his current land location from a cheaper location to a more
            expensive location. This comes with no charges and can be treated within 24-72hours of notification, after a
            proper verification
            of request.
        </li>
        <li>
            <b>Downgrade</b> - A user who wants to change his current location from a more expensive location to a
            cheaper location. This comes with a 10% charge on the new location price and can be treated within
            24-72hours of notification, after
            a proper verification of request.
        </li>
    </ol>
</div>
<div class="heading">
    <h3>
        All change or location requests, should be sent via mail to
        <a style="text-decoration: underline">support@yurland.com.ng</a> with a follow up request via phone call to
        +2349124259139
    </h3>
    <ul style="display: flex; flex-direction: column; gap: 1em">
        <li style="list-style-type: none">
            Currently, all lands allocation are designed to take place after successful completion of payment within
            7-14 working days.
        </li>
        <li style="list-style-type: none">
            Allocation of land comes with a fee, an amount already stated on this document and on the product review
            page
        </li>
        <li style="list-style-type: none">
            All our estates documentation takes place immediately after allocation of land.
        </li>
    </ul>
</div>

<div class="heading">
    <h2 style="
            text-transform: capitalize;
            justify-self: left;
            padding-right: 74%;
            font-size: 18px;
          ">
        Cancellation and refund request
    </h2>
    <p>
        We operate a strict cancellation and refund policy. “See below” to read about our cancellation and refund
        policy.
    </p>
</div>
<div class="heading">
    <h2 style="
            text-transform: uppercase;
            justify-self: left;
            padding-right: 74%;
            font-size: 18px;
          ">
        REFUND POLICY
    </h2>
    <ul style="display: flex; flex-direction: column; gap: 1em">
        <li style="list-style-type: disc">
            A subscriber can completely cancel, upgrade or downgrade a payment plan without any penalty or fine if the
            cancellation is done within 24hrs after the payment or activation of the plan.
        </li>
        <li style="list-style-type: disc">
            A subscriber is eligible for a full refund IF ONLY the refund is requested for within 24hrs after payment.
        </li>
        <li style="list-style-type: disc">
            In a case of an emergency refund, a subscriber must inform YURLAND management and provide concrete evidences
            before refunds can be processed. Processing of refund may take 30-60 working days and attracts a penalty of
            30% of the subscribed plan.
        </li>
    </ul>
</div>
<div class="heading">
    <h2 style="
            text-transform: uppercase;
            justify-self: left;
            padding-right: 74%;
            font-size: 18px;
          ">
        GENERAL RULES
    </h2>
    <ul style="display: flex; flex-direction: column; gap: 1em">
        <li style="list-style-type: disc">
            Refunds must be requested in writing and given to the agent/IOC you purchased the land through or sent
            through email to the official email address of YURLAND. This request must be signed by the person who made
            the original payment.
        </li>
        <li style="list-style-type: disc">
            Refunds will be made by the same method used for payment and will be paid to the entity that made the
            original payment.
        </li>
    </ul>
</div>
<div class="heading">
    <h2 style="
            text-transform: lowercase;
            justify-self: left;
            padding-right: 40%;
            font-size: 18px;
          ">
        For your perusal, below are important communication channels you should keep
    </h2>
    <ul style="display: flex; flex-direction: column; gap: 1em">
        <li style="list-style-type: disc">
            Your assigned agents (details available on your dashboard)
        </li>
        <li style="list-style-type: disc">
            Support mail : support@yurland.com.ng
        </li>
        <li style="list-style-type: disc">
            Call center : +234 912 425 9139, +234 902 609 4011
        </li>
        <li style="list-style-type: disc">
            On escalation : put in copy of your mail hello@yurland.com.ng
        </li>
    </ul>
</div>
<div class="heading">
    <h2 style="text-transform: capitalize">
        Our physical office address: 1 Abiola Adeyemi Street, Jidsam Filling Station Plaza, Igando-Ikotun Road, LAGOS
        State.
    </h2>
    <h2 style="text-transform: capitalize">Important Websites;</h2>
    <h2>
        <span style="text-transform: capitalize">Ilu-Oba International Limited:</span>
        https://Iluobainternationallimited.com
    </h2>
    <h2>
        <span style="text-transform: capitalize">Arklips Limited</span> : https://arklips.com
    </h2>
</div>
<div class="heading">
    <h2 style="
            text-transform: capitalize;
            justify-self: left;
            padding-right: 74%;
            font-size: 18px;
          ">
        Once again, thank you for your purchase. Kind Regards.
    </h2>
</div>
<div class="heading">
    <h2 style="text-transform: capitalize">The yurLAND Team</h2>
</div>
</div>
</body>

</html>';


include_once "dom.php";
// instantiate and use the dompdf class
$dompdf->loadHtml($txt);


//Render the HTML as PDF
$dompdf->render();

// // Output the generated PDF to Browser
$output = $dompdf->output();
//$txt2 = $dompdf->stream($_GET['filename'], array("Attachment" => 0));
// $html2pdf = new Html2Pdf();
// $html2pdf->writeHTML($txt);
// $txt2 = $html2pdf->output();

file_put_contents($filename, $output);
rename("".$filename,"userdocuments/".$filename);
fclose($myfile);



header("Location: ".$initialize_url);
if($_GET['unit'] % 4 == 0){
$unit_added = $_GET['unit'] / 4;
$added_unit = $_GET['unit'] + $unit_added;


$insertpayment =
$land->insertPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($price),$image,$added_unit,$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid,$allocationfee,$limitperiod,$totalprice,$filename,$newbalance,$newpayid,$balance,round($price));

$inserthistory =
$land->insertPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($price),$image,$added_unit,$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid,$allocationfee,$limitperiod,$filename,$newpayid,$balance,round($price));

$update = $land->updateUnit($deducted_unit,$uniqueproduct,$boughtunit);
} else {


$insertpayment =
$land->insertPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($price),$image,$_GET['unit'],$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid,$allocationfee,$limitperiod,$totalprice,$filename,$newbalance,$newpayid,$balance,round($price));

$inserthistory =
$land->insertPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($price),$image,$_GET['unit'],$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid,$allocationfee,$limitperiod,$filename,$newpayid,$balance,round($price));
$update = $land->updateUnit($deducted_unit,$uniqueproduct,$boughtunit);
}







//exit;
}



}
?>