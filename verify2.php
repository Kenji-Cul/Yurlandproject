<?php 
session_start();
$curl = curl_init();

//Turn off SSL
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//Get the reference code from the URL
if(!empty($_GET["reference"])){
    //Clean the reference code
    $sanitize = filter_var_array($_GET, FILTER_SANITIZE_STRING);
    $reference = rawurlencode($sanitize["reference"]);
}else{
    die("No reference was supplied!");
}


// Set the configurations
curl_setopt_array($curl, array(
     CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
     CURLOPT_RETURNTRANSFER => true,
    //  Set the headers 
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
        "cache-control: no-cache"
    ]

));

// Execute CURL
$response = curl_exec($curl);

$err = curl_error($curl);
if($err){
    die("cURL returned some error:". $err);
}
// var_dump($response);

$trans = json_decode($response);
if(!$trans->status){
    die("API returned some errors:" .$trans->message);
}

if('success' == $trans->data->status){ 
    header("Location: profile.php");
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
        height: 80vh !important;
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

    <div class="success">
        <img src="images/asset_success.svg" alt="" />
        <p>Payment Successful!</p>
        <?php if(isset($_SESSION['unique_id'])){?>
        <a href="profile.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniqueagent_id'])){?>
        <a href="agentprofile.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <a href="subadmin.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
    </div>

    <script src="js/main.js"></script>
</body>

</html>