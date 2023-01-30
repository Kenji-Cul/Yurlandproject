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
} 

if(isset($_SESSION['uniquesubadmin_id'])){
  $payee = $subadmin['subadmin_name'];
  $agentid = $suabadmin['unique_id'];
}

if(isset($_SESSION['uniquesupadmin_id'])){
  $payee = $subadmin['super_adminname'];
  $agentid = $suabadmin['unique_id'];
}
$email = $selectuser['email'];
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
  } else {
  //echo $result;
  $initialize_data = json_decode($result);
  $initialize_url = $initialize_data->data->authorization_url;

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
    $subprice2 = number_format($price);
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
    <h2 style="text-transform: uppercase">YurLAND TERMS AND CONDITIONS</h2>
    <p>
        These terms and conditions will serve as a basis of your customer relationship with us, yurLAND .By
        choosing to buy a LAND with us, you agree to the terms and conditions contained herein.You also confirm
        that you have provided us with the accurate and
        complete information required to create your account and that you have supplied all
        documentation,photographs and information that allow us to comply with our regulatory obligations. If
        you do not agree to these terms and conditions, please
        do not proceed and exit the application immediately.Also,please be informed that we can terminate your
        relationship with us if we believe that you have violated any of these terms.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        ABOUT US
    </h2>
    <p>
        YurLAND, a Real Estate Product developed by Ilu-Oba International Limited “Real Estate company in
        Nigeria”, in partnership with Arklips Limited a tech base company into the development of tech related
        software to aid access into Logistics, Investments
        and Properties.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Objectives of relationship
    </h2>
    <p>
        YurLAND, a Real Estate Product developed by Ilu-Oba International Limited “Real Estate company in
        Nigeria”, in partnership with Arklips Limited a tech base company into the development of tech related
        software to aid access into Logistics, Investments
        and Properties.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        When are these terms applicable?
    </h2>
    <p>
        These terms are applicable when you choose to buy a land on yurLAND and yurLAND prepares a customer
        database for you. We may, at any time, modify the terms and conditions of our relationship but we will
        not do this without first informing you of such
        modification. All updates will be detailed on our website and our web app. You will be able to access
        the latest version of our terms at any given time.
    </p>
</div>
<div class="heading">
    <h2 style="text-transform: uppercase">
        Scope of Relationship Between yurLAND and her customers.
    </h2>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Making a purchase
    </h2>
    <p>
        You can make a purchase on our platform as long as you are a verified user with accurate database and
        proper documentation, own or have access to internet or be willing to work closely with any of our field
        sales agents who can help create and manage
        your account. We do not intentionally engage with users who do not meet these requirements Our lands are
        sold in units, a unit is therefore equivalent to half a plot of land (250 - 300spm)
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Special Offer
    </h2>
    <p>
        Users who purchase up to 4 units at a single purchase transaction, gets one free unit. This offer is
        valid for all our estates locations.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Identity Verification
    </h2>
    <p>
        As much as we have developed an easy path to owning a LAND, with flexible payment plan, we are obligated
        by regulatory bodies to carry out proper KYC on all users. At the very least, there needs to be an
        active phone number, email, picture, BVN or any
        other means of identification.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Notification
    </h2>
    <p>
        By starting a relationship with us, you consent to receiving text (SMS), email and push notifications
        from us. These notifications are meant for your consumption only and we will not be held liable if you
        suffer any loss, or damage as a result of unauthorized
        access to the information sent. If you decide to opt out of receiving notifications from us, we would
        grant you such request. You agree to indemnify yurLAND and its owners against all losses, damages,
        claims, demands and expenses whatsoever
        which may be incurred, imposed or suffered by the firm as well as against all actions, proceedings or
        claims (including attorney"s fees) whether civil or criminal, which may be brought against yurLAND by
        reason of such notifications.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Purchase Duration
    </h2>
    <p>
        With yurLAND, you would be able to buy a LAND and pay over a minimum period of 1 month to a maximum
        period of 18 months or outright. Users who do not pay up after the maximum period would be charged with
        a 10% on Location price as a contract breaking
        fee and continue payment for their location of choice at the NEW SELLING PRICE, should the location
        prices be increased.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: uppercase;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        AVAILABLE PLANS AND DURATION
    </h2>
    <table>
        <thead>
            <tr>
                <th>S/N</th>
                <th>PLAN TITLE</th>
                <th>DURATION</th>
                <th>PRICE INCREAE(%)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Outright Purchase</td>
                <td>Instant</td>
                <td>0</td>
            </tr>
            <tr>
                <td>2</td>
                <td>1 month plan</td>
                <td>1 month</td>
                <td>0</td>
            </tr>
            <tr>
                <td>3</td>
                <td>3 months plan</td>
                <td>3 months</td>
                <td>0</td>
            </tr>
            <tr>
                <td>4</td>
                <td>6 months plan</td>
                <td>6 months</td>
                <td>10</td>
            </tr>
            <tr>
                <td>5</td>
                <td>12 months plan</td>
                <td>12 months</td>
                <td>20</td>
            </tr>
            <tr>
                <td>6</td>
                <td>18 months plan</td>
                <td>18 months</td>
                <td>30</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Default
    </h2>
    <p>
        Users who do not complete their payments before deadline of their plans, would be charged a contract
        breaking for every extra month(s) spent on the plan.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Means of Payment
    </h2>
    <p>
        Payments on yurLAND are processed electronically on the web app either by manual operations daily,
        weekly or monthly or by automation using our auto debit feature enabled by our partners PAYSTACK to help
        process either daily, weekly or monthly payments
        without a need to visit the platform regularly. Users can also make payments offline, directly to the
        provided company"s account only. Users who decides to make such payments are expected to contact their
        attached agents or our customer
        supports within a maximum period of 30 minutes to help confirm payments and update on the platform as
        supposed. Failure to do this may result in loss of fund and/or lag on updating payment.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Land Inspection
    </h2>
    <p>
        Lands are available for inspection under the following conditions;
    </p>
    <ul>
        <li class="div">
            <p>a</p>
            <p>
                On schedule - We organize regular visitation to our estate locations using our prepared calendar
                and send out an invite to all customers. Interested customers are then expected to pay the sum
                of #5,000 (Five thousand naira) only, to participate in this
                inspection. The amount paid covers for two persons, on exception please contact our support
                lines.
            </p>
        </li>
        <li class="div">
            <p>b</p>
            <p>
                On Request - Users are also allowed to request for an inspection either while paying for their
                lands or before starting their payment. This inspection comes with an inspection fee of #10,000
                (Ten Thousand Naira) only. The amount paid covers for two persons,
                on exception please contact our support lines..
            </p>
        </li>
        <li class="div">
            <p>c</p>
            <p>
                Feed your eye - This inspection is 100% free and happens quarterly. We send out a public notice
                inviting both existing, new and prospective customers to join us as we visit any of our Estate
                locations. Users who intend to benefit from this offer are expected
                to prepare to cover all their personal expenses (feeding, transportation etc.). There is no
                maximum number of persons that can visit.
            </p>
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
        Change of Location
    </h2>
    <p>
        A user is allowed to change their location of choice just once under the following conditions;
    </p>
    <ul>
        <li class="div">
            <p>a</p>
            <p>
                Upgrade - A user who wants to change his current land location from a cheaper location to a more
                expensive location. This comes with no charges and can be treated within 24-72hours of
                notification, after a proper verification of request.
            </p>
        </li>
        <li class="div">
            <p>b</p>
            <p>
                Downgrade - A user who wants to change his current location from a more expensive location to a
                cheaper location. This comes with a 10% charge on the new location price and can be treated
                within 24-72hours of notification, after a proper verification
                of request.
            </p>
        </li>
    </ul>
</div>
<div class="heading">
    <h3 style="text-transform: lowercase">
        All change or location requests, should be sent via mail to support@yurland.com.ng with a follow up
        request via phone call to +2349124259139
    </h3>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Transfer of Ownership
    </h2>
    <p>
        Users are allowed to transfer the ownership of their land location to a new owner by simply using the
        “REQUEST CHANGE OWNERSHIP” button on their dashboard or send a request via mail to the email provided
        above with a follow up call, only after completion
        of payment. The transfer of ownership comes with a 10% charge on the current location price, can be
        treated within 24-120hours of notification, after a proper verification of request and ownership can
        only be transferred ONCE. Should you
        and the existing user fail to meet our user verification for change of ownership request, this request
        would be rejected and can only be treated again after 30 days of consistent payment. This verification
        is done to prevent theft.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Allocation of LAND
    </h2>
    <p>
        Currently, all lands allocation are designed to take place after successful completion of payment within
        7-14 working days. Although we are working to make this happen before completion, we would communicate
        if that is to be initiated. Note: Allocation
        of land comes with a fee, an amount already stated on this document and on the product review page
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Land Documentation
    </h2>
    <p>
        All our estates comes with different documents, ranging from registered survey, Individual C of O to a
        Global C of O or both. We advise that you read and confirm the documents attached to your location of
        choice before commencing payment. Also, documentation
        takes place immediately after allocation of land.
    </p>
</div>
<div class="heading">
    <h2 style="
                text-transform: capitalize;
                justify-self: left;
                padding-right: 74%;
                font-size: 18px;
              ">
        Proof of Payment
    </h2>
    <p>
        Our payments processing partners are responsible and promises to provide you with regular payment
        receipts of every payments processed on our platform. You can also view and download your transaction
        history from your dashboard. On occasions where there
        seems to be a delay or cases where alerts are not sent , please reach out to our support lines directly
        for assistance.
    </p>
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
        We operate a strict cancellation and refund policy. “See below” to read about our cancellation and
        refund policy.
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
            A subscriber can completely cancel, upgrade or downgrade a payment plan without any penalty or fine
            if the cancellation is done within 24hrs after the payment or activation of the plan.
        </li>
        <li style="list-style-type: disc">
            A subscriber is eligible for a full refund IF ONLY the refund is requested for within 24hrs after
            payment.
        </li>
        <li style="list-style-type: disc">
            In a case of an emergency refund, a subscriber must inform YURLAND management and provide concrete
            evidences before refunds can be processed. Processing of refund may take 30-60 working days and
            attracts a penalty of 30% of the subscribed plan.
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
            Refunds must be requested in writing and given to the agent/IOC you purchased the land through or
            sent through email to the official email address of YURLAND. This request must be signed by the
            person who made the original payment.
        </li>
        <li style="list-style-type: disc">
            Refunds will be made by the same method used for payment and will be paid to the entity that made
            the original payment.
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
    <h2 style="text-transform: lowercase">
        Our physical office address: 1 Abiola Adeyemi Street, Jidsam Filling Station Plaza, Igando-Ikotun Road,
        LAGOS State.
    </h2>
    <h2 style="text-transform: lowercase">Partners Website;</h2>
    <h2 style="text-transform: lowercase">
        Ilu-Oba International Limited: https://Iluobainternationallimited.com
    </h2>
    <h2 style="text-transform: lowercase">
        Arklips Limited : https://arklips.com
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
    <h2 style="text-transform: capitalize">Ahunanya, Ifeanyi Richard</h2>
    <h2 style="text-transform: capitalize">
        Founder/Chief Technology Office Arklips
    </h2>
    <h2 style="text-transform: capitalize">For: yurLAND</h2>
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
$land->insertPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$added_unit,$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid,$allocationfee,$limitperiod,$totalprice,$filename,$newbalance);

$inserthistory =
$land->insertPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$added_unit,$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid,$allocationfee,$limitperiod,$filename);


$update = $land->updateUnit($deducted_unit,$uniqueproduct);
} else {
$insertpayment =
$land->insertPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$_GET['unit'],$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid,$allocationfee,$limitperiod,$totalprice,$filename,$newbalance);

$inserthistory =
$land->insertPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$_GET['unit'],$paymentmethod,$paymentdate,$_GET['data'],$intervalinput,round($price),$payee,$agentid,$allocationfee,$limitperiod,$filename);
$update = $land->updateUnit($deducted_unit,$uniqueproduct);
}



//exit;
}


}
?>