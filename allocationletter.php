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
    <title>Allocation Letter</title>
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
        color: red;
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
<div class="list">
    <ul>
        <li>ESTATE NAME: '.$_GET['estatename'].'</li>
        <li>LOCATION: '.$_GET['estatelocal'].'</li>
    </ul>
</div>
<div class="heading">
    <h2 style="text-transform: uppercase">INVITE FOR ALLOCATION</h2>
    <p>
        Once again, we appreciate your interest in yurLAND and are sending you this document to formerly affirm that you
        have made and we have received the complete payment for our estate project which you subscribed to. In
        accordance to our terms and promise
        for instant allocation, we are setting the ground by inviting you to the next phase of your purchase which is
        the allocation of the estate you subscribed to and have completed payment for. Details of allocation would be
        communicated to
        you via mail and a follow up text via SMS, so we advise that you reconfirm your submitted email and phone
        number. Also, as stated in our product description, you are to pay in the sum of <span
            class="naira">&#x20A6;'.$_GET['allocationfee'].'</span> either by cash or direct bank transfer to the
        account number provided
        below and send proof of payment to our support staff via Whatsapp. You can also walk into our office, having
        this document as a proof to make your allocation fee payment.
        We expect that you respond to this document within 14days of receipt, to allow us properly plan for your
        allocation, ensuring that all your documents attached are prepared and ready to be handed over to you on the day
        of allocation. Thank
        you for trusting us, we are glad we could be part of making your dream to own a LAND come true.
    </p>
</div>

<div class="heading">
    <h2 style="
            text-transform: capitalize;
            justify-self: left;
            padding-right: 74%;
            font-size: 18px;
          ">
        Once again, thank you for your purchase. Kind Regards.
        <b>The yurLAND Team</b>
    </h2>
</div>
<div class="heading">
    <h2 style="text-transform: capitalize">Regards</h2>
    <h2 style="text-transform: capitalize">Ahunanya, Ifeanyi Richard</h2>
    <h2 style="text-transform: capitalize">Founder/ CTO Arklips Limited</h2>
    <h2 style="text-transform: capitalize">For: yurLAND</h2>
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

header("Location: verify5.php");