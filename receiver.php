<?php
session_start();
include "projectlog.php";
    // Retrieve the request's body and parse it as JSON
    $input = @file_get_contents("php://input");
    http_response_code(200);

     
    // Do something with $event
    $event = json_decode($input);
    $status = $event->data->status;
    $paydate = $event->data->paid_at;
    $paidat = date('M-d-Y', strtotime($paydate));
    $customer_code = $event->data->customer->customer_code;
    $plan = $event->data->plan->plan_code;
    $name = $event->data->plan->name;
    $amount = $event->data->plan->amount;
    $amount2 = $amount / 100;
     $product = substr($name, 12, 22);
    $email = $event->data->customer->email;
    $check = $event->event;
    $paymentmethod = "Subscription";
    $user = new User;
    $land = $user->selectEmail($email);

    if($status == "complete"){
        $landuse = $user->selectProductPayment2($land['unique_id'],$product);
        if(!empty($landuse)){
        $paymentmonth = date("M");
        $paymentday = date("d");
        $paymentyear = date("Y");
        $paymenttime = date("h:i a");
        $paymentdate = date("M-d-Y");
        
        foreach($landuse as $key => $value){
        $balance = $value['balance'] - $amount2;
        $prodprice = $value['product_price'];
            $uniquename = rand();
            $filename = "allocationletter".$uniquename.".pdf";
            $selectuser = $user->selectUser($land['unique_id']);
            $name = $selectuser['first_name'].' '.$selectuser['last_name'];
            $allocationfee = $value['allocation_fee'];
            
            
            if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
            $allocationfee2 = number_format($allocationfee);
            } else {
            $allocationfee2 = round($allocationfee);
            }
            
            //Getting image
            $png = file_get_contents('http://localhost/Yurland/images/yurlogo.png');
            $pngbase64 = base64_encode($png);
            
            
            
            
            $myfile = fopen("".$filename, "w");
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
            
                .naira {
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
                        <img src="data:image;base64,<?='.$pngbase64.';?>" />
<h1>yurLAND</h1>
</div>
<div class="customer">
    <h4>Dear '.$name.'</h4>
</div>
<div class="list">
    <ul>
        <li>ESTATE NAME: '.$value['product_name'].'</li>
        <li>LOCATION: '.$value['product_location'].'</li>
    </ul>
</div>
<div class="heading">
    <h2 style="text-transform: uppercase">INVITE FOR ALLOCATION</h2>
    <p>
        Once again, we appreciate your interest in <b>yurLAND</b> and are sending you this document to formerly affirm
        that you
        have made and we have received the complete payment for our estate project which you subscribed to. In
        accordance to our terms and promise
        for instant allocation, we are setting the ground by inviting you to the next phase of your purchase
        which is
        the allocation of the estate you subscribed to and have completed payment for. Details of allocation
        would be
        communicated to
        you via mail and a follow up text via SMS, so we advise that you reconfirm your submitted email and
        phone
        number. Also, as stated in our product description, you are to pay in the sum of <span
            class="naira">&#x20A6;'.$value['allocation_fee'].'</span> either by cash or direct bank transfer to
        the
        account number provided
        below and send proof of payment to our support staff via Whatsapp. You can also walk into our office,
        having
        this document as a proof to make your allocation fee payment.
        We expect that you respond to this document within 14days of receipt, to allow us properly plan for your
        allocation, ensuring that all your documents attached are prepared and ready to be handed over to you on
        the day
        of allocation. Thank
        you for trusting us, we are glad we could be part of making your dream to own a LAND come true.
    </p>
    <div style="
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    ">
        <p>Acct Number: 1017004706</p>
        <p>Bank Name: Zenith Bank</p>
        <p>Account Name: Ilu-Oba International Limited</p>
        <p>
            Office Address: 1 Abiola Adeyemi Street, Off Ologunfe B/Stop, NNPC
            Filling Station Plaza, Ikotun-Igando Road, Ikotun, Lagos.
        </p>
    </div>
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

file_put_contents($filename, $output);
rename("".$filename,"userdocuments/".$filename);
fclose($myfile);

}
}
}

if($check == "charge.success"){

$insertautodebit = $user->insertautodebit($check,$name,$amount2,$product,$email);

$landuse = $user->selectProductPayment2($land['unique_id'],$product);
if(!empty($landuse)){
$paymentmonth = date("M");
$paymentday = date("d");
$paymentyear = date("Y");
$paymenttime = date("h:i a");
$paymentdate = date("M-d-Y");

foreach($landuse as $key => $value){
$balance = $value['balance'] - $amount2;
$prodprice = $value['product_price'];



if($value['payment_date'] != $paymentdate ){
$balance = $value['balance'] - $amount2;
$prodprice = $value['product_price'];
$periodnum = $value['period_num'] - 1;
$substatus = "Success";
$sub =
$user->insertPayment2($land['unique_id'],$product,$balance,$prodprice,$value['allocation_fee'],$amount2,$periodnum);

$inserthistory =
$user->insertPayHistory($land['unique_id'],$value['product_id'],$value['product_name'],$paymentmonth,$paymentday,$paymentyear,$paymenttime,$value['product_location'],$value['sub_payment'],$value['product_image'],$value['product_unit'],$paymentmethod,$paymentdate,$value['product_plan'],$value['sub_period'],$amount2,$value['payee'],$value['agent_id'],$value['allocation_fee'],$value['period_num'],$balance,$product,$substatus,$value['admin_id']);

$name = $land['first_name'].' '.$land['last_name'];
$agentid = $value['agent_id'];
$payee = $value['payee'];
$productname = $value['product_name'];
$newpayid = $value['newpay_id'];
$executives = $user->selectAllExecutive();
if(!empty($executives)){
foreach($executives as $key => $value){
$earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * $amount2;
$insertearning =
$user->insertEarningHistory($land['unique_id'],$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$amount2,$payee,$earnedamount,$earnee,$name,$productname,$newpayid);
}
}

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * $amount2;
$insertearning =
$user->insertEarningHistory($land['unique_id'],$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$amount2,$payee,$earnedamount,$earnee,$name,$productname,$newpayid);
}

if(!empty($userearnee)){
$earnerid = $userearnee['unique_id'];

$earnee = $userearnee['first_name']." ".$userearnee['last_name'];
$earnedamount = $userearnee['earning_percentage'] / 100 * $amount2;
$insertearning =
$user->insertEarningHistory($land['unique_id'],$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$amount2,$payee,$earnedamount,$earnee,$name,$productname,$newpayid);

$referredusers = $user->selectReferredCustomer($userearnee['personal_ref']);
if(!empty($referredusers) && $userearnee['referral_id'] != 'Yurland'){
$refagent = $user->selectReferralAgent($userearnee['referral_id']);
$earnerid2 = $refagent['uniqueagent_id'];
$earnee2 = $refagent['agent_name'];
$earnedamount2 = $refagent['downliner_percentage'] / 100 * $price;
$selectuser = $user->selectUser($uniqueperson);
$name2 = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertagentearning =
$user->insertEarningHistory($uniqueperson,$agentid,$earnerid2,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount2,$earnee2,$name2,$product_name,$newpayid);
}

if(!empty($executives)){
foreach($executives as $key => $value){
$earnerid = $value['unique_id'];
$earnee3 = $value['full_name'];
$earnedamount = $value['downliner_earning'] / 100 * $price;
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning =
$user->insertEarningHistory($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee3,$name,$product_name,$newpayid);
}
}
}

if($agentid == "noagent"){
$earnerid = "Yurland";
$earnee = "Yurland";
$userearnee = $user->selectUser($uniqueperson);
$earnedamount = $userearnee['yurland_percentage'] / 100 * $amount2;
$insertearning =
$user->insertEarningHistory($land['unique_id'],$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$amount2,$payee,$earnedamount,$earnee,$name,$productname,$newpayid);
}

}

}

}
}

if($check == "invoice.payment_failed"){

if($value['payment_date'] != $paymentdate){
$balance = $value['balance'];
$prodprice = $value['product_price'];
$periodnum = $value['period_num'];
$substatus = "Failed";
$failedcharge = $value['failed_charges'] + $amount2;
$sub =
$user->insertPayment4($land['unique_id'],$product,$balance,$prodprice,$value['allocation_fee'],$amount2,$periodnum,$failedcharge);

$inserthistory =
$user->insertPayHistory($land['unique_id'],$value['product_id'],$value['product_name'],$paymentmonth,$paymentday,$paymentyear,$paymenttime,$value['product_location'],$value['sub_payment'],$value['product_image'],$value['product_unit'],$paymentmethod,$paymentdate,$value['product_plan'],$value['sub_period'],$amount2,$value['payee'],$value['agent_id'],$value['allocation_fee'],$value['period_num'],$balance,$product,$substatus,$value['admin_id']);

$name = $land['first_name'].' '.$land['last_name'];
$unitprice = $amount2;
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount3 = number_format($unitprice);
} else {
$amount3 = round($unitprice);
}

include_once "failemail.php";

$mail = new PHPMailer(true);
$mail->SMTPDebug = 3;
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->isHTML(true);
$mail->Username = EMAIL;
$mail->Password = PASSWORD;
// $mail->SetFrom('simpletech.notify@gmail.com', 'notification');
$mail->Subject = 'Failed Transaction';
$url = "http://localhost/Yurland/login.php";
$mail->Body = '<div style="width:100%; height: 100%; background: #7e252b;
padding:8em; padding-left: 3em;">
    <p style="color: white; font-size: 24px;">Hi '.$name.',</p>
    <p style="color: white; font-size: 14px;">
        Your autodebit payment on your subscribed land was unsuccessful today.
        You can log-in to your dashboard and use the <b>PayUp</b> button
        available on the <b>My Land</b> page to pay manually.
    </p>
    <p style="color: white; font-size: 14px;">Amount: &#8358;'.$amount3.'</p>
    <p style="color: white; font-size: 14px;">Status: <span style="color:red;">Failed</span></p>
    <a href="'.$url.'" style="text-decoration: none!important;"><button
            style="margin-top: 2em!important; padding: 0 1em; width: 370px!important; height: 44px!important; background: #7e252b!important; border-radius: 45px!important; border: none!important; color: #ffffff!important; font-size: 16px!important; cursor: pointer!important;">Login</button></a>
    <p style="color: white; font-size: 14px;">If you have any issues please contact our support team.</p>
    <h2 style="color: white;">yurLAND Team</h2>
</div>';
$mail->AltBody = "This is the plain text version of the email content";
$mail->From = "$mainemail";
$mail->FromName = "Yurland";
$mail->AddAddress($email);
$mail->AddReplyTo('no-reply@example.com');
// $mail->addReplyTo('info@simpletech.com.ng');

try {
$mail->send();
echo "success";
} catch (Exception $e) {
echo "Mailer Error: " . $mail->ErrorInfo;
}

}

}
?>