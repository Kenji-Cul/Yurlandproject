<?php 
session_start();
if(!isset($_GET['user'])){
    header("Location: agentprofile.php");
}
include "projectlog.php";
if(!isset($_GET['tot']) || !isset($_GET['uniqueid'])){
    header('Location: index.php');
}
?>
<?php

$user = new User;
$selectuser = $user->selectUser($_GET['user']);

   
    $landview = $user->selectLandImage($_GET['uniqueid']);
   
    if(!empty($landview)){
        foreach($landview as $key => $value){ 



// Integrate Paystack
if(isset($_POST["submit"])){
    if($_POST['period'] > $_POST['dayno']){
        $error = "Limit Reached";
        header("Location: verify3.php?error=".$error."");
    } else {
    $email = htmlspecialchars($selectuser['email']);
    if(!isset($_GET['remprice'])){
        if($_GET['data'] == "onemonth"){
            $realprice = $_GET['tot'] * $_POST['period'] / $value['onemonth_period'];
            $subprice = $_GET['tot'] / $value['onemonth_period'];
            $limit = $value['onemonth_period'];
            } else if($_GET['data'] == "threemonths"){
            $realprice =$_GET['tot'] * $_POST['period'] / $value['threemonth_period'];
            $subprice = $_GET['tot'] / $value['threemonth_period'];
            $limit = $value['threemonth_period'];
            } else if($_GET['data'] == "sixmonths"){
            $realprice = $_GET['tot'] * $_POST['period'] / $value['sixmonth_period'];
            $subprice = $_GET['tot'] / $value['sixmonth_period'];
            $limit = $value['sixmonth_period'];
            } else if($_GET['data'] == "twelvemonths"){
            $realprice = $_GET['tot'] * $_POST['period'] / $value['twelvemonth_period'];
            $subprice = $_GET['tot'] / $ $value['twelvemonth_period'];
            $limit = $value['twelvemonth_period'];
            } else if($_GET['data'] == "eighteenmonths"){
            $realprice = $_GET['tot'] * $_POST['period'] / $value['eighteen_period'];
            $subprice = $_GET['tot'] / $value['eighteen_period'];
            $limit = $value['eighteen_period'];
            }
        }

    $price = $_GET['tot'];
    if(isset($_GET['newpay'])){
        $newpay = $_GET['newpay'];
        $realprice = round($newpay);
    } else {
        $newpay = $realprice;
    }
   
    $newprice = $price - $realprice;
    if($newprice < 0){
        $newprice = 0;
    }
    $uniqueperson = $_GET['user'];
    $uniqueproduct = $_GET['uniqueid'];
    if(isset($_GET['remprice'])){
       $period = $_GET['period'];
       $landuse = $user->selectProductOldPayment($_GET['uniqueid'],$_GET['user']);
       $subperiod = $landuse['period_num'] - $_GET['subperiod'];
    } else {
        $time = $limit;
    $date = date("y-m-d");
    $date2 = date_create($date);
    $time2 = date_add($date2, date_interval_create_from_date_string("".$time." days"));
    $period = date_format($time2, "M-d-Y");
    $subperiod = $limit - $_GET['unit'];
    $chosenplan = $_GET['data'];
    }
    
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
   

    if(isset($_GET['remunit'])){
        $deducted_unit = $value['product_unit'];
    }else {
        $deducted_unit = $value['product_unit'] - $_GET['unit'];
    }
       
    if(isset($_GET['remunit'])){
        $boughtunit = $value['bought_units'];
    }else {
        $boughtunit = $_GET['unit']  + $value['bought_units'];
    }

   
    $productlocation = $value['product_location'];
    $image = $value['product_image'];
    $paymentmonth = date("M");
    $paymentday = date("d");
    $paymentyear = date("Y");
    $paymenttime = date("h:i a");
    $paymentdate = date("M-d-Y");
    $paymentmethod = "NewPayment";
   


    //Initiate Paystack
    $url = "https://api.paystack.co/transaction/initialize";
    

    //Gather the body params
    $transaction_data = [
       "email" => $email,
       "amount" => round($realprice * 100),
       "callback_url" => "http://localhost/Yurland/verify.php",
       "metadata" => [
          "custom_fields" => [
            [
                "display_name" => "Unique Product",
                "variable_name" => "product",
                "value" => $uniqueproduct
            ],

            [
                "display_name" => "Deducted Unit",
                "variable_name" => "unit",
                "value" => $deducted_unit
            ],

            [
                "display_name" => "Bought Units",
                "variable_name" => "boughtunit",
                "value" => $boughtunit
            ],

            [
                "display_name" => "Unique Person",
                "variable_name" => "person",
                "value" => $uniqueperson
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
                "value" => $price
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
                "display_name" => "Payment Type",
                "variable_name" => "payunit",
                "value" => "newpayment"
            ],

            [
                "display_name" => "New Price",
                "variable_name" => "newprice",
                "value" => $newprice
            ],

            [
                "display_name" => "New Price",
                "variable_name" => "newprice",
                "value" => $newpay
            ],

            [
                "display_name" => "Period",
                "variable_name" => "period",
                "value" => $period
            ],

            [
                "display_name" => "Sub Period",
                "variable_name" => "subperiod",
                "value" => $subperiod
            ],

            [
                "display_name" => "Payment Date",
                "variable_name" => "paydate",
                "value" => $paymentdate
            ],

            [
                "display_name" => "Chosen Plan",
                "variable_name" => "chosenplan",
                "value" => $chosenplan
            ],

            [
                "display_name" => "Sub Price",
                "variable_name" => "subprice",
                "value" => $subprice
            ],
          
           

          ]
       ]
    ];

    // Generate a URL-encoded string
    $encode_transaction_data = http_build_query($transaction_data);

    // Open Connection to cURL
    $ch = curl_init();

    // Turn off Mandatory SSL checking
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //Set the url
    curl_setopt($ch, CURLOPT_URL, $url);

    // Enable data to be sent in POST arrays
    curl_setopt($ch, CURLOPT_POST, true);

    // Collect the posted data from above
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encode_transaction_data);
    
    //Set the headers from the endpoint
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
        "cache-Control: no-cache"
    ));

    // Make curl return the data instead of echoing
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL
    $result = curl_exec($ch);
    
    // Check for errors
    $errors = curl_error($ch);
    if($errors){
        $error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
    }

    if($result){
    
        //echo $result;
        $transaction = json_decode($result);
      //Automatically redirect customers to the payment page
        header("Location: ".$transaction->data->authorization_url);
    }
    
    
    else {
        $error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
    }
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
        height: 70vh !important;
    }

    .input-div {

        width: 100%;
    }

    #paymentform {
        width: 70em;

    }

    .price-desc {
        justify-content: center;
    }

    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
        width: 60%;
        margin-bottom: 1em;
    }

    @media only screen and (max-width: 1000px) {
        .select-box {
            border: 1px solid #808080;
            border-radius: 8px;
            width: 90%;
            margin-bottom: 1em;
        }
    }

    .input-div input {
        width: 20em !important;
    }

    .land-location p {
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        color: var(--inactive-grey);
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
            <img src="images/cart.svg" alt="cart icon" />
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="page-title4">
        <div>
            <img src="images/orange-cart-icon.svg" alt="" />
        </div>
        <p>New Payment</p>
    </div>



    <div class="image-desc">
        <img src="landimage/<?php echo $value['product_image']; ?>" alt="" />
    </div>

    <div class="price-desc">
        <div>
            <div class="land-name">
                <p><span>Estate Name:&nbsp;</span><?php echo $value['product_name'];?></p>
            </div>
            <div class="land-location">
                <p><span>Estate Location:&nbsp;</span><?php echo $value['product_location'];?></p>
            </div>
            <?php if(!isset($_GET['remprice'])){?>
            <div class="land-location">
                <p style="text-transform: capitalize;"><span>Chosen Plan:&nbsp;</span><?php echo $_GET['data'];?></p>
            </div>
            <?php }?>
            <div class="land-location">
                <p style="text-transform: capitalize;"><span>Unit:&nbsp;</span><?php echo $_GET['unit'];?></p>
            </div>
            <div class="land-location">
                <p><span>Total Cost: &#8358;</span><?php 
                $totalcost =  $_GET['tot'];
                if($totalcost > 999 || $totalcost > 9999 || $totalcost > 99999 || $totalcost > 999999){
                    echo number_format(round($totalcost));
                    } else {
                        echo round($totalcost);
                    }
                ?></p>
            </div>
        </div>


        <form action="" method="POST">
            <?php if(isset($_GET['remprice'])){  ?>
            <div class="input-div">
                <label for="day" style="width: 20em; padding-bottom: 3em;">Amount Due Today: &#8358;<?php if(isset($_GET['newpay'])){
                            $cost = round($_GET['newpay']);
                            if($cost > 999 || $cost > 9999 || $cost > 99999 || $cost > 999999){
                                echo number_format(round($cost));
                                }
                        }?></label>
            </div>
            <?php   } else {?>
            <?php if($_GET['data'] == "onemonth"){?>
            <div class="input-div">
                <label for="day" style="width: 20em; padding-bottom: 3em;">Amount Due Today: &#8358;<?php 
                $dailycost = $_GET['tot'] / $value['onemonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                <input type="number" id="dayno" name="dayno" value="<?php echo $value['onemonth_period'];?>"
                    style="display: none;" />
                <!-- <input type="number" id="day" value="" /> -->
            </div>
            <?php }?>


            <?php if($_GET['data'] == "threemonths"){?>
            <div class="input-div">
                <div class="input-div">
                    <label for="day" style="width: 20em; padding-bottom: 3em;">Amount Due Today: &#8358;<?php 
                      $dailycost = $_GET['tot'] / $value['threemonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                    <input type="number" id="dayno" name="dayno" value="<?php echo $value['threemonth_period'];?>"
                        style="display: none;" />
                </div>
                <?php }?>

                <?php if($_GET['data'] == "sixmonths"){?>
                <div class="input-div">
                    <div class="input-div">
                        <label for="day" style="width: 20em; padding-bottom: 3em;">Amount Due Today: &#8358;<?php
                          $dailycost = $_GET['tot'] / $value['sixmonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                        <input type="number" id="dayno" name="dayno" value="<?php echo $value['sixmonth_period'];?>"
                            style="display: none;" />
                    </div>
                    <?php }?>

                    <?php if($_GET['data'] == "twelvemonths"){?>
                    <div class="input-div">
                        <div class="input-div">
                            <label for="day" style="width: 20em; padding-bottom: 3em;">Amount Due Today: &#8358;<?php 
                             $dailycost = $_GET['tot'] / $value['twelvemonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                }  else {
                    echo round($dailycost);
                }
                ?></label>
                            <input type="number" id="dayno" name="dayno"
                                value="<?php echo $value['twelvemonth_period'];?>" style="display: none;" />
                        </div>
                        <?php }?>

                        <?php if($_GET['data'] == "eighteenmonths"){?>
                        <div class="input-div">
                            <div class="input-div" style="width: 20em; padding-bottom: 3em;">
                                <label for="day">Amount Due Today: &#8358;<?php
                                 $percent = $value['eighteen_percent'] / 100 * $value['onemonth_price'];
                                 $totprice = $_GET['tot'] + $percent ; 
                $dailycost = $totprice / $value['eighteen_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                                <input type="number" id="dayno" name="dayno"
                                    value="<?php echo $value['eighteen_period'];?>" style="display: none;" />
                            </div>
                            <?php } }?>

                            <?php if(!isset($_GET['remprice'])){?>
                            <div class="input-div">
                                <input type="number" style="margin-bottom: 2em;"
                                    placeholder="Input number of days you want to pay for" value="1" id="period"
                                    name="period" />

                            </div>
                            <?php }?>


                            <div class="btn-container">
                                <a href=""><button class="estate_page_button" type="submit"
                                        name="submit">Pay</button></a>
                            </div>
        </form>

        <?php }}?>

        <script src="js/main.js"></script>
</body>

</html>