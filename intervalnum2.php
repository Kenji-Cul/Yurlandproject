<?php 
include "projectlog.php";
session_start();

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
        $price = $_GET['tot'] / $value['onemonth_period'];
        $limit = $value['onemonth_period'];
        } else if($_GET['data'] == "threemonths"){
            $price = $_GET['tot'] / $value['threemonth_period'];
        $limit = $value['threemonth_period'];
        } else if($_GET['data'] == "sixmonths"){
        $price = $_GET['tot'] / $value['sixmonth_period'];
        $limit = $value['sixmonth_period'];
        } else if($_GET['data'] == "twelvemonths"){
        $price = $_GET['tot'] / $value['twelvemonth_period'];
        $limit = $value['twelvemonth_period'];
        } else if($_GET['data'] == "eighteenmonths"){
        $price = $_GET['tot'] / $value['eighteen_period'];
        $limit = $value['eighteen_period'];
        }

    
    $uniqueperson = $_GET['user'];
    $uniqueproduct = $_GET['uniqueid'];
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
    $deducted_unit = $value['product_unit'] - $_GET['unit'];
    $boughtunit = $_GET['unit']  + $value['bought_units'];
    $productlocation = $value['product_location'];
    $image = $value['product_image'];
    $paymentmonth = date("M");
    $paymentday = date("d");
    $paymentyear = date("Y");
    $paymenttime = date("h:i a");
    $paymentdate = date("M-d-Y");
    $uniquesub = rand();
    $paymentmethod = "Subscription";
    $intervalinput = $_POST['intervalinput'];
    

    
    if($_POST['intervalinput'] == 'daily'){
        $limitperiod = $limit;
     } else if ($_POST['intervalinput'] == 'weekly'){
        $limitperiod =  $limit * 7;
     } else if($_POST['intervalinput'] == 'monthly'){
         $limitperiod = $limit * 30;
     }
 

   
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
"invoice_limit" => $limitperiod

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
// echo "cURL Error #:" . $err;
$error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
} else {
//echo $response;
$data = json_decode($result);

$plan_code = $data->data->plan_code;
$message = $data->message;

if(isset($_SESSION['unique_id'])){
    $delete = $land->DeleteCartId($uniqueproduct,$_SESSION['unique_id']);
  
    if (isset($uniqueproduct) && is_numeric($uniqueproduct) && isset($uniqueproduct) && isset($_SESSION['cart'][$uniqueproduct])) {
        // Remove the product from the shopping cart
        unset($_SESSION['cart'][$uniqueproduct]);}
    }
  
    if(isset($_SESSION['uniqueagent_id']) || $_SESSION['uniquesubadmin_id']){
        $delete = $land->DeleteCartId($uniqueproduct,$uniqueperson);
    
        if (isset($uniqueproduct) && is_numeric($uniqueproduct) && isset($uniqueproduct) && isset($_SESSION['cart'][$uniqueproduct])) {
            // Remove the product from the shopping cart
            unset($_SESSION['cart'][$uniqueproduct]);}
        }

include_once "initialize2.php";
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
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="page-title4">
        <div>
            <img src="images/orange-cart-icon.svg" alt="" />
        </div>
        <p>Review Subscription Payment</p>
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
            <div class="land-location">
                <p style="text-transform: capitalize;"><span>Chosen Plan:&nbsp;</span><?php echo $_GET['data'];?></p>
            </div>
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

        <form action="" method="POST" id="paymentform">
            <?php if($_GET['data'] == "onemonth"){?>
            <div class="input-div">
                <label for="day">Daily Cost: &#8358;<?php 
                 $dailycost = $_GET['tot'] / $value['onemonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                <!-- <input type="number" id="day" value="" /> -->
            </div>
            <?php }?>


            <?php if($_GET['data'] == "threemonths"){?>
            <div class="input-div">
                <div class="input-div">
                    <label for="day">Daily Cost: &#8358;<?php 
                     $dailycost = $_GET['tot'] / $value['threemonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                </div>
                <?php }?>

                <?php if($_GET['data'] == "sixmonths"){?>
                <div class="input-div">
                    <div class="input-div">
                        <label for="day">Daily Cost: &#8358;<?php
                         $dailycost = $_GET['tot'] / $value['sixmonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                    </div>
                    <?php }?>

                    <?php if($_GET['data'] == "twelvemonths"){?>
                    <div class="input-div">
                        <div class="input-div">
                            <label for="day">Daily Cost: &#8358;<?php 
                             $dailycost = $_GET['tot'] / $value['twelvemonth_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                        </div>
                        <?php }?>

                        <?php if($_GET['data'] == "eighteenmonths"){?>
                        <div class="input-div">
                            <div class="input-div">
                                <label for="day">Daily Cost: &#8358;<?php
                                  $dailycost = $_GET['tot'] / $value['eighteen_period'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                            </div>
                            <?php }?>

                            <div class="select-box">
                                <div class="options-container">
                                    <div class="option">
                                        <input type="radio" class="radio" id="daily" name="interval" value="daily" />
                                        <label for="daily">Daily</label>
                                    </div>

                                    <div class="option">
                                        <input type="radio" class="radio" id="weekly" name="interval" value="weekly" />
                                        <label for="weekly">Weekly</label>
                                    </div>

                                    <div class="option">
                                        <input type="radio" class="radio" id="monthly" name="interval"
                                            value="monthly" />
                                        <label for="monthly">Monthly</label>
                                    </div>

                                </div>
                                <div class="selected">Payment Interval</div>
                            </div>

                            <input type="text" style="display: none;" name="intervalinput" value="" id="input">



                            <div class="btn-container">
                                <a href=""><button class="estate_page_button" type="submit"
                                        name="submit">Pay</button></a>
                            </div>
        </form>
        <?php }}?>
    </div>
    </div>

    <footer class="footerdiv">
        <p>YurLAND &#169; 2022 | All Right Reserved</p>
        <p>A product of Ilu-oba International Limited and Arklips Limited</p>
        <p>Connect with us Facebook, Twitter, Instagram</p>
        <p style="font-size: 30px">
            <i class="ri-instagram-line"></i><i class="ri-facebook-fill"></i><i class="ri-twitter-line"></i>
        </p>
    </footer>

    <script src="js/main.js"></script>
    <script>
    let purpose = document.getElementsByName("interval");
    purpose.forEach((element) => {
        element.onclick = () => {
            document.querySelector('#input').value = element.value;
            console.log(document.querySelector('#input').value)
        };
    });
    </script>

</body>

</html>