<?php 
session_start();
include "projectlog.php";
if(!isset($_SESSION['unique_id'])){
    header("Location: signup.html");
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
    .page-title3 {
        flex-direction: column;
    }






    .subscribed-land {
        height: 30em;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }

    .estateinfo {
        padding: 0;
    }

    .subscribed-details {
        padding-top: 1em;
    }

    .subscribed-details .sub-detail {
        display: grid;
        gap: 1em;
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
            <div class="cart">
                <div class="cart-notify"></div>
                <img src="images/cart.svg" alt="cart icon" />
            </div>
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="page-title2">
        <a href="profile.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <div style="display: flex !important; flex-direction: column !important">
            <p>All Estates</p>
        </div>
    </div>

    <div class="subscribed-lands">
        <?php 
             $land = new User;
             $landview = $land->selectLand();
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
            ?>
        <div class="subscribed-land">
            <div class="subscribed-img">
                <?php if($value['product_unit'] != 0){?>
                <a
                    href="estateinfo2.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">
                    <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="estate image" />
                </a>
                <?php } else {?>
                <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="estate image" />
                <?php }?>
            </div>

            <div class="subscribed-details">
                <div class="sub-detail">
                    <div>
                        <p class="land-name"><?php echo $value['product_name'];?></p>
                        <p class="land-location"><?php echo $value['product_location'];?></p>
                    </div>
                </div>
                <div class="sub-detail">
                    <?php if($value['product_unit'] != 0){?>
                    <?php if($value['outright_price'] != 0){
                      $outprice = $value['outright_price'];
                      $onemonthprice = $value['onemonth_price'];
                        ?>
                    <div class="price-flex">
                        <p class="land-name">Outright Price:</p>
                        <p class="land-location">&#8358;<?php if($outprice > 999 || $outprice > 9999 || $outprice > 99999 || $outprice > 999999){
                          echo number_format($outprice);
                        }?></p>
                    </div>
                    <?php } else {?>
                    <p class="land-name">No Outright Price</p>
                    <?php }?>


                    <?php if($value['onemonth_price'] != 0){
                        $onemonthprice = $value['onemonth_price'];
                        ?>
                    <div>
                        <p class="land-name">Daily Price:</p>
                        <p class="land-location">&#8358;<?php if($onemonthprice > 999 || $onemonthprice > 9999 || $onemonthprice > 99999 || $onemonthprice > 999999){
                          echo number_format($onemonthprice);
                        }?></p>
                    </div>
                    <?php } else {?>
                    <div>
                        <p class="land-name">No Daily Price</p>
                    </div>
                    <?php } } else {?>
                    <p class="land-name">Sold Out</p>
                    <?php }?>


                </div>
            </div>
        </div>
        <?php }}?>


    </div>

    <div class="price-container">
        <a href="cartreview.html">
            <div class="price">Continue</div>
        </a>
    </div>

    <script src="js/main.js"></script>
    <script>
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