<?php 
include "projectlog.php";
session_start();
if(!isset($_SESSION['unique_id'])){
    header("Location: signup.html");
}
if(!isset($_GET['data'])){
    header("Location :index.php");
}

if(!isset($_GET['tot']) || !isset($_GET['uniqueid'])){
    header('Location: index.php');
}



$land = new User;
$landview = $land->selectLandImage($_GET['uniqueid']);
if(!empty($landview)){
    foreach($landview as $key => $value){ 

       

if(isset($_POST['submit'])){

    if($_GET['data'] == "onemonth"){
        $percent = $value['onemonth_percent'] / 100 * $value['outright_price'];
        $totprice = $_GET['tot'] + $percent ;
        $price = $totprice / $value['onemonth_period'];
        $limit = $value['onemonth_period'];
        } else if($_GET['data'] == "threemonths"){
            $percent = $value['threemonth_percent'] / 100 * $value['outright_price'];
        $totprice = $_GET['tot'] + $percent ;
        $price =$totprice / $value['threemonth_period'];
        $limit = $value['threemonth_period'];
        } else if($_GET['data'] == "sixmonths"){
            $percent = $value['sixmonth_percent'] / 100 * $value['outright_price'];
            $totprice = $_GET['tot'] + $percent ;
        $price = $totprice / $value['sixmonth_period'];
        $limit = $value['sixmonth_period'];
        } else if($_GET['data'] == "twelvemonths"){
            $percent = $value['twelvemonth_percent'] / 100 * $value['outright_price'];
            $totprice = $_GET['tot'] + $percent ;
        $price = $totprice / $value['twelvemonth_period'];
        $limit = $value['twelvemonth_period'];
        } else if($_GET['data'] == "eighteenmonths"){
            $percent = $value['eighteen_percent'] / 100 * $value['outright_price'];
            $totprice = $_GET['tot'] + $percent ;
        $price = $totprice / $value['eighteen_period'];
        $limit = $value['eighteen_period'];
        }

    
    $uniqueperson = $_SESSION['unique_id'];
    $uniqueproduct = $_GET['uniqueid'];
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
    $deducted_unit = $value['product_unit'] - $_GET['unit'];
    $productlocation = $value['product_location'];
    $image = $value['product_image'];
    $paymentmonth = date("M");
    $paymentday = date("d");
    $paymentyear = date("Y");
    $paymenttime = date("h:i a");;
    $uniquesub = rand();
    $paymentmethod = "Subscription";
    

   

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.paystack.co/plan",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => [
"name" => "Subscription".$uniquesub,
"interval" => "daily",
"amount" => $price * 100,
"invoice_limit" => $limit

],
CURLOPT_HTTPHEADER => array(
"Authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
"Cache-Control: no-cache"
),
));

$result = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    $error = "You are not connected to the internet";
    header("Location: verify3.php?error=".$error."");
} else {
//echo $response;
$data = json_decode($result);

$plan_code = $data->data->plan_code;
$message = $data->message;

include_once "initialize.php";
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        height: 120vh !important;
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>

        <div class="nav">
            <a href="cartreview.php">
                <div class="cart">
                    <div class="cart-notify"></div>
                    <img src="images/cart.svg" alt="cart icon" />
                </div>
            </a>
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="page-title4">
        <div>
            <img src="images/orange-cart-icon.svg" alt="" />
        </div>
        <p>Subscription Payment</p>
    </div>

    <div class="image-desc">
        <img src="landimage/<?php echo $value['product_image']; ?>" alt="" />
    </div>

    <div class="price-desc">
        <div>
            <div class="land-name">
                <p><?php echo $value['product_name'];?></p>
            </div>
            <div class="land-location">
                <p><?php echo $value['product_location'];?></p>
            </div>
        </div>

        <form action="" method="POST">
            <?php if($_GET['data'] == "onemonth"){?>
            <div class="input-div">
                <label for="day">Daily Cost: &#8358;<?php 
                $percent = $value['onemonth_percent'] / 100 * $value['outright_price'];
                $totprice = $_GET['tot'] + $percent ;
                $dailycost = $totprice / $value['onemonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                }
                ?></label>
                <!-- <input type="number" id="day" value="" /> -->
            </div>
            <?php }?>


            <?php if($_GET['data'] == "threemonths"){?>
            <div class="input-div">
                <div class="input-div">
                    <label for="day">Daily Cost: &#8358;<?php 
                     $percent = $value['threemonth_percent'] / 100 * $value['outright_price'];
                     $totprice = $_GET['tot'] + $percent ;
                $dailycost = $totprice / $value['threemonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                }
                ?></label>
                </div>
                <?php }?>

                <?php if($_GET['data'] == "sixmonths"){?>
                <div class="input-div">
                    <div class="input-div">
                        <label for="day">Daily Cost: &#8358;<?php
                         $percent = $value['sixmonth_percent'] / 100 * $value['outright_price'];
                         $totprice = $_GET['tot'] + $percent ; 
                $dailycost = $totprice / $value['sixmonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                }
                ?></label>
                    </div>
                    <?php }?>

                    <?php if($_GET['data'] == "twelvemonths"){?>
                    <div class="input-div">
                        <div class="input-div">
                            <label for="day">Daily Cost: &#8358;<?php 
                             $percent = $value['twelvemonth_percent'] / 100 * $value['outright_price'];
                             $totprice = $_GET['tot'] + $percent ;
                $dailycost = $totprice / $value['twelvemonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                }
                ?></label>
                        </div>
                        <?php }?>

                        <?php if($_GET['data'] == "eighteenmonths"){?>
                        <div class="input-div">
                            <div class="input-div">
                                <label for="day">Daily Cost: &#8358;<?php
                                 $percent = $value['eighteen_percent'] / 100 * $value['outright_price'];
                                 $totprice = $_GET['tot'] + $percent ; 
                $dailycost = $totprice / $value['eighteen_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                }
                ?></label>
                            </div>
                            <?php }?>


                            <div class="btn-container">
                                <a href=""><button class="estate_page_button" type="submit"
                                        name="submit">Pay</button></a>
                            </div>
        </form>
        <?php }}?>

        <script src="js/main.js"></script>
        <script>
        setInterval(() => {
            let xls = new XMLHttpRequest();
            xls.open("GET", "getcart.php", true);
            xls.onload = () => {
                if (xls.readyState === XMLHttpRequest.DONE) {
                    if (xls.status === 200) {
                        let data = xls.response;
                        let notify = document.querySelector('.cart-notify');
                        if (data == 0) {
                            notify.style.display = "none";
                        }

                        notify.innerHTML = data;
                        //console.log(data);
                    }
                }
            }
            xls.send();
        }, 100);
        </script>
</body>

</html>