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
$checklastsub= $land->selectLastSub($_SESSION['unique_id'],$_GET['uniqueid'],$_GET['newpayid']);
$checklatestpayment = $land->selectLatestPay($_SESSION['unique_id'],$_GET['uniqueid']);
$checklastpaid = $land->selectSubPay($_SESSION['unique_id']);
if(!empty($landview)){
    foreach($landview as $key => $value){ 

if(isset($_POST['submit']) && $_POST['intervalinput'] != ""){
    if($checklatestpayment['product_id'] == $_GET['uniqueid'] && $checklatestpayment['newpay_id'] != $_GET['newpayid'] && $checklatestpayment['balance'] > "2"){
        $error = "You have an ongoing subscription on this estate, please complete payment";
        header("Location: verify3.php?error=".$error."");
    } else {
    if(empty($checklastsub)){
        $landsub = $land->selectSubProduct($checklastpaid['product_id']);
   
        if($checklastpaid['product_plan'] == "onemonth"){
            $totalsubprice = $landsub['onemonth_percent'] / 100 * $landsub['onemonth_price'];
          } else if($checklastpaid['product_plan'] == "threemonths"){
            $totalsubprice = $landsub['threemonth_percent'] / 100 * $landsub['onemonth_price'];
          }  else if($checklastpaid['product_plan'] == "sixmonths"){
            $totalsubprice = $landsub['sixmonth_percent'] / 100 * $landsub['onemonth_price'];
          } else if($checklastpaid['product_plan'] == "twelvemonths"){
            $totalsubprice = $landsub['twelvemonth_percent'] / 100 * $landsub['onemonth_price'];
          } 
    
          else if($checklastpaid['product_plan'] == "eighteenmonths"){
            $totalsubprice = $landsub['eighteen_percent'] / 100 * $landsub['onemonth_price'];
          }
    
          $totprice = $checklastpaid['product_unit'] * $landsub['onemonth_price'];
            $price = $totprice + $totalsubprice;
            $pricepercent = 70 / 100 * $price;
            if($checklastpaid['product_price'] < $pricepercent){ 
                $error = "Current plan is below 70% payment,please payup to qualify for another location on Subscription";
                header("Location: verify3.php?error=".$error."");
            } else {
                if($_POST['intervalinput'] == 'daily'){
                    $intervalprice = $price;
                 } else if ($_POST['intervalinput'] == 'weekly'){
                    $intervalprice =  $price * 7;
                 } else if($_POST['intervalinput'] == 'monthly'){
                     $intervalprice = $price * 30;
                 }

                 
    if($_GET['data'] == "onemonth"){
        $totalprice = $_GET['tot'];
        $price = $_GET['tot'] / $value['onemonth_period'];
        $limit = $value['onemonth_period'];
        $increaserate = $value['onemonth_increaserate'];
        if($_POST['intervalinput'] == 'daily'){
            $intervalprice = $price;
         } else if ($_POST['intervalinput'] == 'weekly'){
            $intervalprice =  $price * 7;
         } else if($_POST['intervalinput'] == 'monthly'){
             $intervalprice = $price * 30;
         }
        $balance = $totalprice - $intervalprice;
        } else if($_GET['data'] == "threemonths"){
            $totalprice = $_GET['tot'];
            $price = $_GET['tot'] / $value['threemonth_period'];
        $limit = $value['threemonth_period'];
        $increaserate = $value['threemonth_increaserate'];
        if($_POST['intervalinput'] == 'daily'){
            $intervalprice = $price;
         } else if ($_POST['intervalinput'] == 'weekly'){
            $intervalprice =  $price * 7;
         } else if($_POST['intervalinput'] == 'monthly'){
             $intervalprice = $price * 30;
         }
        $balance = $totalprice - $intervalprice;
        } else if($_GET['data'] == "sixmonths"){
            $totalprice = $_GET['tot'];
        $price = $_GET['tot'] / $value['sixmonth_period'];
        $limit = $value['sixmonth_period'];
        $increaserate = $value['sixmonth_increaserate'];
        if($_POST['intervalinput'] == 'daily'){
            $intervalprice = $price;
         } else if ($_POST['intervalinput'] == 'weekly'){
            $intervalprice =  $price * 7;
         } else if($_POST['intervalinput'] == 'monthly'){
             $intervalprice = $price * 30;
         }
        $balance = $totalprice - $intervalprice;
        } else if($_GET['data'] == "twelvemonths"){
            $totalprice = $_GET['tot'];
        $price = $_GET['tot'] / $value['twelvemonth_period'];
        $limit = $value['twelvemonth_period'];
        $increaserate = $value['twelvemonth_increaserate'];
        if($_POST['intervalinput'] == 'daily'){
            $intervalprice = $price;
         } else if ($_POST['intervalinput'] == 'weekly'){
            $intervalprice =  $price * 7;
         } else if($_POST['intervalinput'] == 'monthly'){
             $intervalprice = $price * 30;
         }
        $balance = $totalprice - $intervalprice;
        } else if($_GET['data'] == "eighteenmonths"){
            $totalprice = $_GET['tot'];
        $price = $_GET['tot'] / $value['eighteen_period'];
        $limit = $value['eighteen_period'];
        $increaserate = $value['eighteen_increaserate'];
        if($_POST['intervalinput'] == 'daily'){
            $intervalprice = $price;
         } else if ($_POST['intervalinput'] == 'weekly'){
            $intervalprice =  $price * 7;
         } else if($_POST['intervalinput'] == 'monthly'){
             $intervalprice = $price * 30;
         }
        $balance = $totalprice - $intervalprice;
        }

       
    $uniqueperson = $_SESSION['unique_id'];
    $uniqueproduct = $_GET['uniqueid'];
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
    $allocationfee = $value['allocation_fee'];
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
    $firstDate = $_POST['planindicator'];

    $newpayid = rand();

    if($_POST['intervalinput'] == 'daily'){
        $intervalprice = $price;
     } else if ($_POST['intervalinput'] == 'weekly'){
        $intervalprice =  $price * 7;
     } else if($_POST['intervalinput'] == 'monthly'){
         $intervalprice = $price * 30;
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
"name" => "Subscription".$newpayid,
"interval" => $_POST['intervalinput'],
"amount" => round($intervalprice * 100),
"invoice_limit" => $limit,
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
var_dump($result);
$data = json_decode($result);



$plan_code = $data->data->plan_code;
$message = $data->message;
$delete = $land->DeleteCartId($uniqueproduct,$_SESSION['unique_id']);
if (isset($uniqueproduct) && is_numeric($uniqueproduct) && isset($uniqueproduct) && isset($_SESSION['cart'][$uniqueproduct])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$uniqueproduct]);}
include_once "initialize.php";

} 
            }
    } 
}
    //else {
    //     $error = "You have an ongoing subscription on this estate, please complete payment";
    //     header("Location: verify3.php?error=".$error."");
    // }



  

} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        height: 120vh !important;
    }

    header {
        background: #fee1e3;
    }

    @media only screen and (max-width: 1300px) {

        .user,
        #openicon {
            display: none;
        }

        .menu {
            display: none;
        }

        .links img {
            display: none;
        }

        .detail3 {
            display: none;
        }

        .dropdown-links {
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
            transform: translateX(100%);
            transition: all 1s;
            width: 40%;
            position: fixed;
            bottom: 0;
            border-radius: 8px 0px 0px 8px;
        }

        .dropdown-links li {
            height: 1em;
            grid-gap: 0;
        }
    }

    @media only screen and (min-width: 1300px) {
        .page-title2 a {
            display: none;
        }

        .page-title2 {
            justify-content: left;
        }

        .page-title2 p {
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            color: #1A0709;
        }

        .center {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .menu {
            display: none;
        }

        .profile-image2 {
            display: none !important;
        }

        .user {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1em;
        }

        .user p {
            font-weight: 600;
            font-size: 20px;
            color: #1A0709;
        }

        .user .profile-image {
            width: 45px;
            height: 45px;
        }



        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
        }

        .details2 {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6em;
        }

        .details2 p {
            color: #808080;
        }

        .details2 p,
        .details2 h3 {
            font-size: 22px;
        }

        .land-btn-container {
            padding-left: 1em;
        }

        .land-btn-container .btn {
            width: 500px;
        }

        .menu {
            display: none;
        }

        .estate2 {
            display: block !important;
        }

        .land-estate {
            background: #FFFFFF;
            border-radius: 8px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            width: 290px;
            height: 270px;
            padding-top: 0;
            padding-bottom: 10px;
            display: flex;
            justify-content: top;
            align-items: center;
            gap: 1em;
            flex-direction: column;
            border-radius: 8px;
            margin-bottom: 1.6em;
        }

        .dropdown-links {
            width: 6%;
            height: 90vh;
            border-radius: 0px !important;
            padding: 1em 0;
            display: flex;
            flex-direction: column;
            justify-content: top;
            align-items: top;
            gap: 1.3em;
            background: #7e252b;
            filter: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999999 !important;
            transition: all 0.7s;
        }

        .dropdown-links li {
            height: 1em;
            width: 95%;
            text-transform: capitalize;
            font-size: 14px;
        }

        .dropdown-links .select-link {
            background-color: #1a0709;
        }

        .dropdown-links .links {
            width: 100%;
            display: flex !important;
            align-items: center;
            justify-content: center;
            padding: 1em 0;
            transition: 1s;
        }

        .dropdown-links .links:hover {
            background-color: #1a0709;
        }

        .dropdown-links .links img {
            width: 20px;
            height: 20px;
            margin-right: 6px;
            cursor: pointer;
        }

        .dropdown-links .links .link {
            visibility: hidden;
            display: none;
        }


        .dropdown-links li a {
            color: #fff;

        }

        .transaction-details {
            width: 80%;
            transition: all 1.5s;
        }


        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
        }

        .trans-container {
            width: 90%;
            padding-left: 5em;
        }


        .close {
            display: none;
        }


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

    @media only screen and (max-width: 1300px) {
        .footerdiv {
            display: none;
        }
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['unique_id'])){?>
            <a href="profile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php 
             $user = new User;
             if(isset($_SESSION['unique_id'])){
             $newuser = $user->selectUser($_SESSION['unique_id']);
             }
             if(isset($_SESSION['uniqueagent_id'])){
             $newuser = $user->selectAgent($_SESSION['uniqueagent_id']);
             }
             if(isset($_SESSION['uniquesubadmin_id'])){
                $newuser = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
                }
            ?>
        <div class="nav">
            <?php if(!isset($_SESSION['uniqueagent_id']) || !isset($_SESSION['uniquesubadmin_id'])){?>
            <a href="cartreview.php">
                <div class="cart">
                    <div class="cart-notify"></div>
                    <img src="images/cart.svg" alt="cart icon" />
                </div>
            </a>
            <?php }?>
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <?php if(isset($_SESSION['unique_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['photo'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>
            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['agent_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['agent_img'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['agent_img'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['agent_img'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>
            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['subadmin_name'])){  ?>
                    <span><?php echo $newuser['subdamin_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['subadmin_image'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['subadmin_image'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['subadmin_image'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>
        </div>
    </header>

    <div class="page-title4">
        <div>
            <img src="images/orange-cart-icon.svg" alt="" />
        </div>
        <p>Review Sub Payment</p>
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
                            <input type="hidden" name="planindicator" value="" id="plan">

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
    const params = new URLSearchParams(window.location.search)

    let planindicator = document.querySelector('#plan');

    var date = new Date();

    const plan = params.get('data')
    if (plan == "onemonth") {
        var firstDay = new Date(date.getFullYear(), date.getMonth() + 1, 1);
        let firstDate = `${firstDay.toLocaleString('default', {
                            month: 'short'
                        })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
        planindicator.value = firstDate;
    } else if (plan == "threemonths") {
        var firstDay = new Date(date.getFullYear(), date.getMonth() + 3, 1);
        let firstDate = `${firstDay.toLocaleString('default', {
                            month: 'short'
                        })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
        planindicator.value = firstDate;
    } else if (plan == "sixmonths") {
        var firstDay = new Date(date.getFullYear(), date.getMonth() + 6, 1);
        let firstDate = `${firstDay.toLocaleString('default', {
                            month: 'short'
                        })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
        planindicator.value = firstDate;
    } else if (plan == "twelvemonths") {
        var firstDay = new Date(date.getFullYear(), date.getMonth() + 12, 1);
        let firstDate = `${firstDay.toLocaleString('default', {
                            month: 'short'
                        })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
        planindicator.value = firstDate;
    } else if (plan == "eighteenmonths") {
        var firstDay = new Date(date.getFullYear(), date.getMonth() + 18, 1);
        let firstDate = `${firstDay.toLocaleString('default', {
                            month: 'short'
                        })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
        planindicator.value = firstDate;
    }


    let purpose = document.getElementsByName("interval");
    purpose.forEach((element) => {
        element.onclick = () => {
            document.querySelector('#input').value = element.value;
            console.log(document.querySelector('#input').value)
        };
    });


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