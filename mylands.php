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

    .balance span {
        font-size: 15px;
    }

    @media only screen and (max-width: 700px) {
        .price {
            min-width: 90px;
            height: 30px;
        }

        .subscribed-img {
            width: 100%;
        }

        .subscribed-land {
            min-height: 30em;
        }


    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['unique_id'])){?>
            <a href="profile.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
            <?php }?>
        </div>

        <div class="nav">
            <a href="cartreview.php">
                <div class="cart">
                    <div class="cart-notify"></div>
                    <img src="images/cart.svg" alt="cart icon" />
                </div>
            </a>
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
                $nums2 = $user->selectNewPaymentNum($_SESSION['unique_id']);
               $nums3 =  $nums + $nums2;
               echo $nums3;
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

        <?php if($value['payment_status'] == "Deleted"){?>
        <div class="subscribed-land" style="display:none;">

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

                <?php } else if($value['balance'] == "0" && $value['payment_method'] == "NewPayment" || $value['period_num'] == "0"){ ?>
                <div class="price">&#8358;<?php 
             $unitprice = $value['sub_payment'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?> &nbsp;<span>daily</span></div>

                <?php    }
                else {?>
                <div class="price"><?php 
            if($value['balance'] != "0" && $value['payment_method'] == "NewPayment"){ ?>
                    <a href="estateinfo.php?id=<?php echo $value['product_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=newpayment&keyref=09123454954848kdksuuejwej&remprice=<?php echo $value['balance'];?>"
                        style="color: #7e252b;">Pay Up</a>
                    <input type="hidden" id="date" value="<?php echo $value['sub_period'];?>" />
                    <input type="hidden" value="<?php echo $value['balance'];?>" id="check">
                    <form id="priceform">
                        <input type="hidden" value="<?php 
                        $increase = 2 / 100 * $value['sub_payment'];
                        $priceincrement = $increase + $value['sub_payment'];
                        echo $priceincrement;
                        ?>" id="increase" name="increase">
                        <input type="hidden" name="customer" value="<?php echo $value['customer_id'];?>" />
                        <input type="hidden" value="<?php echo $value['product_id'];?>" name="product">
                    </form>
                    <script>
                    let dateInput = document.querySelector('#date');
                    let checkBal = document.querySelector('#check');
                    var countDownDate = new Date(dateInput.value).getTime();
                    var now = new Date().getTime();
                    var timeleft = countDownDate - now;

                    var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
                    //console.log(timeleft);
                    if (timeleft < 0 && checkBal.value != 0) {
                        let priceform = document.querySelector('#priceform');


                        function increasePrice() {
                            let xhr = new XMLHttpRequest(); //creating XML Object
                            xhr.open("POST", "increase.php", true);
                            xhr.onload = () => {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        let data = xhr.response;
                                        console.log(data);
                                    }
                                }
                            }
                            // we have to send the information through ajax to php
                            let formData = new FormData(priceform); //creating new formData Object

                            xhr.send(formData);
                        }
                        // 2592000

                        setInterval(() => {
                            increasePrice();
                        }, 2592000000);
                    }
                    </script>
                    <?php    } else {
            ?>


                    &#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
                            }?> &nbsp;
                </div>
                <?php }?>

            </div>
            <div class="subscribed-details"
                style="flex-direction: column; align-items: center; justify-content: center; gap: 1em;">
                <div class="balance" style="display: flex;
                align-items: center; justify-content center; gap: 3em; text-align: center; width: 100%; ">
                    <p class="amountpaid"><span>Amount
                            Paid:</span>&nbsp;&#8358;<span><?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?></span></p>
                    <p class="balance"><span>Balance:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $value['balance'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        } 
                                        if($unprice == "0"){
                                            echo "0";
                                        }
                    ?></span></p>
                </div>
                <div class="balance" style="display: flex;
                align-items: center; justify-content center; gap: 3em; text-align: center; width: 100%;">
                    <p class="amountpaid"><span>Start
                            Date:</span>&nbsp;<span><?php echo $value['payment_day'];?></span>-<span><?php echo $value['payment_month'];?></span>-<span><?php echo $value['payment_year'];?></span>
                    </p>
                    <?php if($value['payment_method'] == "Subscription" || $value['payment_status'] == "Payed"){  ?>
                    <p class="balance"><span>Expected End
                            Date:</span>&nbsp;<span><?php echo $value['sub_period'];?></span></p>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php } else {?>

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
                <?php if($value['payment_method'] == "Subscription"){?>
                <div class="price">&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?> &nbsp;<span>daily</span></div>

                <?php } else if($value['balance'] == "0" && $value['payment_method'] == "NewPayment" || $value['period_num'] == "0"){ ?>
                <div class="price">&#8358;<?php 
             $unitprice = $value['sub_payment'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?> &nbsp;<span>daily</span></div>

                <?php    }
                else {?>
                <div class="price"><?php 
            if($value['balance'] != "0" && $value['payment_method'] == "NewPayment"){ ?>
                    <a href="estateinfo.php?id=<?php echo $value['product_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=newpayment&keyref=09123454954848kdksuuejwej&remprice=<?php echo $value['balance'];?>"
                        style="color: #7e252b;">Pay Up</a>
                    <input type="hidden" id="date" value="<?php echo $value['sub_period'];?>" />
                    <input type="hidden" value="<?php echo $value['balance'];?>" id="check">
                    <form id="priceform">
                        <input type="hidden" value="<?php 
                        $increase = 2 / 100 * $value['sub_payment'];
                        $priceincrement = $increase + $value['sub_payment'];
                        echo $priceincrement;
                        ?>" id="increase" name="increase">
                        <input type="hidden" name="customer" value="<?php echo $value['customer_id'];?>" />
                        <input type="hidden" value="<?php echo $value['product_id'];?>" name="product">
                    </form>
                    <script>
                    let dateInput = document.querySelector('#date');
                    let checkBal = document.querySelector('#check');
                    var countDownDate = new Date(dateInput.value).getTime();
                    var now = new Date().getTime();
                    var timeleft = countDownDate - now;

                    var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
                    //console.log(timeleft);
                    if (timeleft < 0 && checkBal.value != 0) {
                        let priceform = document.querySelector('#priceform');


                        function increasePrice() {
                            let xhr = new XMLHttpRequest(); //creating XML Object
                            xhr.open("POST", "increase.php", true);
                            xhr.onload = () => {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        let data = xhr.response;
                                        console.log(data);
                                    }
                                }
                            }
                            // we have to send the information through ajax to php
                            let formData = new FormData(priceform); //creating new formData Object

                            xhr.send(formData);
                        }
                        // 2592000

                        setInterval(() => {
                            increasePrice();
                        }, 2592000000);
                    }
                    </script>
                    <?php    } else {
            ?>


                    &#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
                            }?> &nbsp;
                </div>
                <?php }?>

            </div>
            <div class="subscribed-details"
                style="flex-direction: column; align-items: center; justify-content: center; gap: 1em;">
                <div class="balance" style="display: flex;
                align-items: center; justify-content center; gap: 3em; text-align: center; width: 100%; ">
                    <p class="amountpaid"><span>Amount
                            Paid:</span>&nbsp;&#8358;<span><?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?></span></p>
                    <p class="balance"><span>Balance:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $value['balance'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        } 
                                        if($unprice == "0"){
                                            echo "0";
                                        }
                    ?></span></p>
                </div>
                <div class="balance" style="display: flex;
                align-items: center; justify-content center; gap: 3em; text-align: center; width: 100%;">
                    <p class="amountpaid"><span>Start
                            Date:</span>&nbsp;<span><?php echo $value['payment_day'];?></span>-<span><?php echo $value['payment_month'];?></span>-<span><?php echo $value['payment_year'];?></span>
                    </p>
                    <?php if($value['payment_method'] == "Subscription" || $value['payment_status'] == "Payed"){  ?>
                    <p class="balance"><span>Expected End
                            Date:</span>&nbsp;<span><?php echo $value['sub_period'];?></span></p>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php }?>
        <?php  } ?>
        <?php }?>



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