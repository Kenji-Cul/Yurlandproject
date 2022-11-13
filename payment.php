<?php 
session_start();
include "projectlog.php";
if(!isset($_SESSION['unique_id'])){
    header("Location: index.php");
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

    .no-lands {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: top;
        flex-direction: column;
    }

    .no-lands p {
        font-style: normal;
        font-weight: 600;
        font-size: 24px;
        color: #1a0709;
    }

    .no-lands img {
        margin-top: 8em;
        width: 30em;
        height: 30em;
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

    @media only screen and (max-width: 500px) {
        .transaction-details {
            flex-direction: column;
            gap: 2em !important;
        }
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
            <img src="images/menu.svg" alt="menu icon" class="menu" />
        </div>
    </header>

    <div class="page-title2">
        <a href="profile.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Payment</p>
    </div>

    <div class="payment-image-div">
        <div>
            <img src="images/image1.svg" alt="payment image" />
            <div class="payment-desc">
                <p>Amount Paid</p>
                <div class="price-div">&#8358;<?php 
                $user = new User;
                $total = $user->selectTotal($_SESSION['unique_id']);
               foreach ($total as $key => $value) {
                $unitprice = $value;
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }
               }
                ?></div>
            </div>
        </div>

        <div>
            <img src="images/image2.svg" alt="payment image" />
            <div class="payment-desc">
                <p>Payment Count</p>
                <div class="payment-count"><?php 
                $nums = $user->selectNums($_SESSION['unique_id']);
               foreach ($nums as $key => $value) {
                echo $value;
               }
                ?></div>
            </div>
        </div>
    </div>

    <!-- <div class="no-lands">
        <img src="images/asset_success.svg" alt="success image" />
        <p>You have not done any transaction yet!!</p>
    </div> -->

    <div class="transactions">
        <p>Transactions</p>
        <a href="transactions.php">
            <p class="more">See more</p>
        </a>
    </div>

    <?php 
             $land = new User;
             $landview = $land->selectPayment($_SESSION['unique_id']);
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
              
            ?>
    <div class="transaction-details">
        <div class="radius">
            <img src="landimage/<?php echo $value['product_image'];?>" alt="">
        </div>
        <div class="details">
            <p>Transaction</p>
            <div class="inner-detail">
                <div class="location"><?php echo $value['product_name'];?></div>
                <p></p>
                <div class="date">
                    <span><?php echo $value['payment_month'];?></span>&nbsp;<span><?php echo $value['payment_day'];?></span>,<span><?php echo $value['payment_year'];?>
                </div>
                <p></p>
                <div class="time"><?php echo $value['payment_time'];?></div>
            </div>
        </div>
        <div class="price-detail"><?php 
            echo $value['product_unit'];
            ?>&nbsp;<span>Units</span></div>
        <div class="price-detail"><?php 
            echo $value['payment_method'];
            ?></div>
        <div class="price-detail">&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }
            ?></div>
    </div>



    <?php }}?>

    <script src="js/cart.js"></script>
</body>

</html>