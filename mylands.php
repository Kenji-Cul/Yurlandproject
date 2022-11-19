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
    .no-lands {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: top;
        flex-direction: column;
    }

    .success {
        position: absolute;
        top: 8em;
    }

    .no-lands p {
        font-style: normal;
        font-weight: 600;
        font-size: 24px;
        color: #1a0709;
    }

    .deleted-div {
        position: absolute;
        top: 0;
        height: 100%;
        width: 100%;
        border-radius: 8px;
        background-color: #808080;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 1.5em;
    }

    .subscribed-land {
        height: 26em;
        gap: 2em;
        position: relative;
    }

    .subscribed-img {
        height: 19em;
    }


    .subscribed-details {
        margin-top: 0;
    }

    .no-lands img {
        margin-top: 8em;
        width: 30em;
        height: 30em;
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

    <div class="lands-notification">
        <div class="flex">
            <a href="profile.php"><img src="images/arrowleft.svg" alt="" /></a>
            <p>Lands</p>
        </div>
        <div class="subscribe-div">
            <p>No of Subscribed Lands</p>
            <div class="lands-count"><?php 
              $user = new User;
                $nums = $user->selectSubNum($_SESSION['unique_id']);
               foreach ($nums as $key => $value) {
                echo $value;
               }
                ?></div>
        </div>
    </div>

    <!-- <div class="no-lands">
        <img src="images/asset_success.svg" alt="success image" />
        <p>You don't have any subscribed lands yet!!</p>
    </div> -->

    <div class="subscribed-lands">
        <?php 
             $land = new User;
             $landview = $land->selectPayment($_SESSION['unique_id']);
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
              
            ?>
        <div class="subscribed-land">
            <?php if($value['payment_status'] == "Deleted"){?>
            <div class="deleted-div">
                <div class="price">Deleted</div>
            </div>
            <?php }?>
            <div class="subscribed-img">
                <img src="landimage/<?php echo $value['product_image'];?>" alt="estate image" />
                <div class="ellipse">
                    <i class="ri-heart-fill"></i>
                </div>
            </div>
            <div class="subscribed-details">
                <div>
                    <p class="land-name"><?php echo $value['product_name'];?></p>
                    <p class="land-location"><?php echo $value['product_location'];?></p>
                </div>
                <?php if($value['payment_method'] == "Subscription"){?>
                <div class="price">&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?> &nbsp;<span>daily</span></div>
                <?php }else {?>
                <div class="price">&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?></div>
                <?php }?>
            </div>
            <div class="subscribed-details"
                style="flex-direction: column; align-items: center; justify-content: center; gap: 1em;">
                <div class="balance" style="display: flex;
                align-items: center; justify-content center; gap: 3em; text-align: center; width: 100%; ">
                    <p class="amountpaid"><span>Amount
                            Paid:</span>&nbsp;<span><?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?></span></p>
                    <p class="balance"><span>Balance:</span>&nbsp;<span><?php if($value['payment_method'] == "Outright"){
                        echo 0;
                    }?></span></p>
                </div>
                <div class="balance" style="display: flex;
                align-items: center; justify-content center; gap: 3em; text-align: center; width: 100%;">
                    <p class="amountpaid"><span>Start
                            Date:</span>&nbsp;<span><?php echo $value['payment_day'];?></span>-<span><?php echo $value['payment_month'];?></span>-<span><?php echo $value['payment_year'];?></span>
                    </p>
                    <?php if($value['payment_method'] == "Subscription"){  ?>
                    <p class="balance"><span>Expected End Date:</span>&nbsp;<span>1-10-2023</span></p>
                    <?php }?>
                </div>
            </div>
        </div>

        <?php }} ?>


    </div>

    <?php if(empty($landview)){?>
    <div class="success">
        <img src="images/asset_success.svg" alt="" />
        <p>You currently have no lands!</p>
    </div>
    <?php }?>

    <script src="js/cart.js"></script>
</body>

</html>