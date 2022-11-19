<?php 
session_start();
include_once "projectlog.php";
if(!isset($_GET['unique'])){
    header("Location: subadmin.php");
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
        min-height: 100vh;
    }

    .radius {
        position: relative;
    }

    .radius img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .empty-img {
        width: 100%;
        height: 100%;
        border-radius: 8px;
    }


    .success {
        position: absolute;
        left: 50%;
        top: 90%;
        transform: translate(-50%, -50%);
        height: 10em;
    }

    .success img {
        width: 36em;
        height: 36em;
    }


    .account-detail2 {
        position: relative;
    }

    .account-detail2 .flex {
        position: absolute;
        left: 90px;
    }

    .account-detail3 {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 3em;
    }

    .account-detail3 p {
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 22px;
        text-align: center;
        color: #eb5757;
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

    <div class="page-title2">
        <a href="allagents.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <?php 
    $user = new User;
    $agent = $user->selectAgent($_GET['unique']);
    
   
    ?>
        <p><?php echo $agent['agent_name'];?> Earnings</p>
    </div>


    <div class="details-container">


        <?php 
    $user = new User;
    $agent = $user->selectAgent($_GET['unique']);
    $customer = $user ->selectAgentCustomer($agent['referral_id']);
    if(!empty($customer)){
        foreach($customer as $key => $value){
            $earning = $user->selectPayment($value['unique_id']);
            if(!empty($earning)){
                foreach($earning as $key => $value){
    ?>
        <div class="account-detail2"
            style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
            <div class="flex">
                <p style="text-transform: uppercase;">
                    <span style="color: #000000!important; font-size: 16px;"><?php echo $agent['agent_name'];?> has
                        earned &#8358;<?php $percent = $agent['earning_percentage'];
                    $earnedprice = $percent / 100 * $value['product_price'];
                    echo $earnedprice;
                    ?>
                    </span>
                </p>
            </div>
        </div>

        <?php }} }}?>

        <?php if(empty($customer)){?>
        <div class="success">
            <img src="images/asset_success.svg" alt="" />
            <p>You have no earnings yet!</p>
        </div>
        <?php }?>

        <div class="account-detail3">
            <a href="logout.php">
                <p>Sign Out</p>
            </a>
        </div>
    </div>

    <script src="js/main.js"></script>
</body>

</html>