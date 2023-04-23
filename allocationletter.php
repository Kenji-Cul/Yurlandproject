<?php
namespace Dompdf;
require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
ob_start();
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

    .logo img{
        width: 50px; 
        height: 50px;
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
        Once again, we appreciate your interest in <b>yurLAND</b> and are sending you this document to formerly affirm
        that you
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
    <p>Regards</p>
    <h2 style="
                    text-transform: capitalize;
                    justify-self: left;
                    padding-right: 74%;
                    font-size: 18px;
                  ">
        <b>The yurLAND Team</b>
    </h2>
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
ob_end_flush();