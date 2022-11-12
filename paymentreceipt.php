<?php 
include "projectlog.php";
session_start();
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

    .navigation-div .payment {
        background: #ffffff;
        box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.12);
        border-radius: 8px;
        text-align: center;
        color: var(--secondary-color);
        width: 150px;
        padding: 0.3em 0.3em;
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
        .transaction-details2 {
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
            <img src="images/cart.svg" alt="cart icon" />
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="page-title2">
        <a href="profile.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Documents</p>
    </div>

    <!-- <div class="no-lands">
        <img src="images/asset_success.svg" alt="success image" />
        <p>You have not uploaded any document yet!!</p>
    </div> -->

    <div class="navigation-div">
        <div class="navig">
            <div class="offer">Offer letter</div>
            <div class="payment">Payment Receipt</div>
            <div class="allocation">Allocation letter</div>
        </div>
    </div>

    <?php 
             $land = new User;
             $landview = $land->selectPayment($_SESSION['unique_id']);
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
            ?>

    <div class="transaction-details2">
        <div class="radius">
            <img src="landimage/<?php echo $value['product_image'];?>" alt="">
        </div>
        <div class="price-detail"><?php 
            echo $value['product_unit'];
            ?></div>
        <div class="details">
            <p><?php echo $value['product_name'];?></p>
            <div class="inner-detail">
                <div class="location"><?php echo $value['product_location'];?></div>
                <p></p>
                <div class="date">
                    <span><?php echo $value['payment_month'];?></span>&nbsp;<span><?php echo $value['payment_day'];?></span>,<span><?php echo $value['payment_year'];?></span>
                </div>
                <p></p>
                <div class="time"><?php echo $value['payment_time'];?></div>
            </div>
        </div>
        <div class="cover2"></div>
    </div>

    <?php }}?>
    <script src="js/main.js"></script>
</body>

</html>