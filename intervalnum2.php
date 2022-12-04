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
        $price =$_GET['tot'] / $value['threemonth_period'];
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
echo "cURL Error #:" . $err;
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
                $dailycost = $_GET['tot'] / $value['onemonth_period'];
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
                $dailycost = $_GET['tot'] / $value['threemonth_period'];
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
                $dailycost = $_GET['tot'] / $value['sixmonth_period'];
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
                $dailycost = $_GET['tot'] / $value['twelvemonth_period'];
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
                $dailycost = $_GET['tot'] / $value['eighteen_period'];
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

</body>

</html>