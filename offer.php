<?php
namespace Dompdf;
require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
//Getting image
$png = file_get_contents('http://localhost/Yurland/images/yurlogo.png');
$pngbase64 = base64_encode($png);




$myfile = fopen("".$_GET['filename']."", "w");
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
    <h4>Dear '.$_GET['customer'].'</h4>
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
        <li>ESTATE NAME: '.$_GET['estatename'].'</li>
        <li>LOCATION: '.$_GET['estatelocal'].'</li>
        <li>DOCUMENTS ATTACHED: '.$_GET['filename'].'</li>
        <li>TOTAL COST:<span class="naira">&#x20A6;</span>'.$_GET['totalcost'].'</li>
        <li>ALLOCATION FEE:<span class="naira">&#x20A6;</span>'.$_GET['allocationfee'].'</li>
        <li>UNITS BOUGHT: '.$_GET['units'].'</li>
        <li>DAILY PAYMENT:<span class="naira">&#x20A6;</span>'.$_GET['subprice'].'</li>
        <li>PERIOD OF PAYMENT: '.$_GET['period'].'</li>
        <li>START DATE: '.$_GET['paydate'].'</li>
        <li>EXPECTED PAYMENT COMPLETION DATE: '.$_GET['enddate'].'</li>
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
    <h2><span style="text-transform: capitalize">Portal:</span> https://yurland.com.ng</h2>
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


// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($txt);


//Render the HTML as PDF
$dompdf->render();

// // Output the generated PDF to Browser
$output = $dompdf->output();
//$txt2 = $dompdf->stream($_GET['filename'], array("Attachment" => 0));
// $html2pdf = new Html2Pdf();
// $html2pdf->writeHTML($txt);
// $txt2 = $html2pdf->output();

file_put_contents($_GET['filename'], $output);
rename("".$_GET['filename']."","userdocuments/".$_GET['filename']."");
fclose($myfile);

$paymentdate = date("M-d-Y");

$unitprice = $_GET['amount'];
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount3 = number_format($unitprice);
} else {
$amount3 = round($unitprice);
}

$unitprice2 = $_GET['balance'];
if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
$amount4 = number_format($unitprice2);
} else {
$amount4 = round($unitprice2);
}
header("Location:successemail.php?name=".$_GET['customer']."&date=".$paymentdate."&amount=".$amount3."&estate=".$_GET['estatename']."&balance=".$amount4."&payer=".$_GET['payer']."&email=".$_GET['email']."");