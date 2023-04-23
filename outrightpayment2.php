<?php 
session_start();


include "projectlog.php";
if(!isset($_GET['tot']) || !isset($_GET['uniqueid'])){
    header('Location: index.php');
}
?>
<?php

$user = new User;
$selectuser = $user-> selectUser($_GET['user']);
if(isset($_SESSION['uniqueagent_id'])){
    $selectagent = $user->selectAgent($_SESSION['uniqueagent_id']);
    }
    if(isset($_SESSION['uniquesubadmin_id'])){
    $subadmin = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
    }

    if(isset($_SESSION['uniquesupadmin_id'])){
        $subadmin = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
        }

   
    $landview = $user->selectLandImage($_GET['uniqueid']);
    if(!empty($landview)){
        foreach($landview as $key => $value){ 



// Integrate Paystack
if(isset($_POST["submit"])){
    $email = htmlspecialchars($selectuser['email']);
    $price = $_GET['tot'];
    $realprice = round($price * 100);
    $uniqueperson = $_GET['user'];
    $uniqueproduct = $_GET['uniqueid'];
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
    $allocationfee = $value['allocation_fee'];
    $deducted_unit = $value['product_unit'] - $_GET['unit'];
    $boughtunit = $_GET['unit'] + $value['bought_units'];
    $productlocation = $value['product_location'];
    $image = $value['product_image'];
    $paymentmonth = date("M");
    $paymentday = date("d");
    $paymentyear = date("Y");
    $paymenttime = date("h:i a");
    $paymentdate = date("M-d-Y");
    $paymentmethod = "Outright";
    $newpayid = rand();
    if(isset($_SESSION['uniqueagent_id'])){
        $payee = $selectagent['agent_name'];
        $agentid = $selectagent['uniqueagent_id'];
    } 

    if(isset($_SESSION['uniquesubadmin_id'])){
        $payee = $subadmin['subadmin_name'];
        $agentid = "noagent";
    }

    if(isset($_SESSION['uniquesupadmin_id'])){
        $payee = $subadmin['super_adminname'];
        $agentid = "noagent";
    }

   
   


    //Initiate Paystack
    $url = "https://api.paystack.co/transaction/initialize";
    

    //Gather the body params
    $transaction_data = [
       "email" => $email,
       "amount" => $realprice,
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
                "value" => "outrightpayment"
            ],

            [
                "display_name" => "Payment Date",
                "variable_name" => "paydate",
                "value" => $paymentdate
            ],

             
            [
                "display_name" => "Payee",
                "variable_name" => "payee",
                "value" => $payee
            ],

            [
                "display_name" => "Agentid",
                "variable_name" => "Agentid",
                "value" => $agentid
            ],

            [
                "display_name" => "Allocation Fee",
                "variable_name" => "allocation fee",
                "value" =>  $allocationfee
            ],

            [
                "display_name" => "NewPay Id",
                "variable_name" => "NewPay Id",
                "value" =>  $newpayid
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
        // var_dump($result);
    $transaction = json_decode($result);
    //Automatically redirect customers to the payment page
    header("Location: ".$transaction->data->authorization_url);
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
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        height: 70vh !important;
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
        <?php if(isset($_SESSION['uniqueagent_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <a href="agentprofile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>

        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
            <a href="subadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>

        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>


    </header>

    <div class="page-title4">
        <div>
            <img src="images/orange-cart-icon.svg" alt="" />
        </div>
        <p>Outright Payment</p>
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
                <p style="text-transform: capitalize;"><span>Unit:&nbsp;</span><?php echo $_GET['unit'];?></p>
            </div>
        </div>


        <form action="" method="POST">
            <div class="cost">
                <p>Total Cost:&nbsp;&nbsp;&nbsp;<span>&#8358;<?php 
             $unitprice = $_GET['tot'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }
            ?></span></p>
                <p><?php 
            
            ?></p>
            </div>

            <input type="hidden" name="deduct" id="unit-deduct" value="">


            <div class="btn-container">
                <button class="estate_page_button" type="submit" name="submit">Pay</button>
            </div>
        </form>

        <?php }}?>

        <script src="js/main.js"></script>
</body>

</html>