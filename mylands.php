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
                <div class="price">&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }
            ?></div>
            </div>
        </div>

        <?php }} ?>
    </div>




    <script src="js/cart.js"></script>
</body>

</html>