<?php 
session_start();
include "projectlog.php";
if(!isset($_SESSION['unique_id'])){
    header("Location: login.php");
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
        background-image: none;
        overflow-x: hidden;
    }

    header {
        background: #fee1e3;
    }

    .subscribed-lands {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-around;
        min-height: 30vh;
    }

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

    .subscribed-land {
        height: 30em;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }

    .inputs {
        display: none;
    }

    .inputs i {
        font-size: 22px;
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



    .updated-land {
        position: relative;
        width: 350px;
        min-height: 700px !important;
        background: #FFFFFF;
        border-radius: 8px;
        filter: drop-shadow(0px 4px 16px rgba(128, 128, 128, 0.76));
        display: flex;
        flex-direction: column;

    }

    .updated-img {
        width: 350px;
        height: 241px !important;
        border-radius: 8px 8px 0px 0px;
    }

    .updated-img img {
        height: 241px !important;
    }

    .updated-details {
        display: flex;
        flex-direction: column;
        padding: 1em 1.5em;
    }

    .detail-one,
    .detail-two {
        display: flex;
        flex-direction: column;
    }

    .detail-three {
        display: flex;
        gap: 12px;
        padding-top: 2em;
    }

    .detail-three p {
        color: #808080;
        font-weight: 500;
    }

    .detail-four {
        display: flex;
        flex-direction: column;
        padding-top: 1.5em;
        gap: 1em;
    }

    .detail-four p {
        color: #808080;
        font-size: 15px;
    }

    .detail-five {
        display: flex;
        justify-content: right;
        padding-top: 1em;
    }

    .detail-five .cartbutton {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6em;
        width: 160px;
        height: 37.91px;
        color: #7E252B;
        border: 1px solid #7E252B;
        border-radius: 45px;
        cursor: pointer;
    }

    .detail-four .detail {
        display: flex;
        gap: 6px;
    }

    .unit-detail {
        display: flex;
        gap: 10px;
    }

    .unit-detail2 {
        display: flex;
        flex-direction: column;
        gap: 5px;
        padding-top: 1em;
    }

    .detail-name p {
        font-style: normal;
        font-weight: 600;
        font-size: 32px;
        color: #1A0709;
    }

    .detail-location {
        display: flex;
        gap: 15px;
    }

    .detail-location a {
        color: #ff6600;
        text-decoration: underline;
    }

    .detail-btn {
        width: 9em;
        height: 26px;
        background: #7E252B;
        border-radius: 8px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-btn p {
        font-size: 12px;
        text-transform: capitalize;
    }

    .updated-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px 8px 0px 0px;
    }

    @media only screen and (min-width: 1300px) {
        .center {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .menu {
            display: none;
        }

        .profile-image2 {
            display: none !important;
        }

        .user {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1em;
        }

        .user p {
            font-weight: 600;
            font-size: 20px;
            color: #1A0709;
        }

        .user .profile-image {
            width: 45px;
            height: 45px;
        }





        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
        }
    }



    @media only screen and (max-width: 500px) {

        .detail-btn p {
            font-size: 9px;
            text-transform: capitalize;
        }

        .updated-land {
            width: 80%;
        }

        .updated-img {
            width: 100%;
        }
    }

    @media only screen and (min-width: 1300px) {
        .flex a {
            display: none;
        }

        .flex {
            justify-content: left;
        }

        .flex p {
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            color: #1A0709;
        }

        .dropdown-links {
            width: 6%;
            height: 90vh;
            border-radius: 0px !important;
            padding: 1em 0;
            display: flex;
            flex-direction: column;
            justify-content: top;
            align-items: top;
            gap: 1.3em;
            background: #7e252b;
            filter: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999999 !important;
            transition: all 0.7s;
        }

        .dropdown-links li {
            height: 1em;
            width: 95%;
            text-transform: capitalize;
            font-size: 14px;
        }

        .dropdown-links .select-link {
            background-color: #1a0709;
        }

        .dropdown-links .links {
            width: 100%;
        }

        .dropdown-links .links img {
            width: 20px;
            height: 20px;
            margin-right: 6px;
            cursor: pointer;
        }

        .dropdown-links .links {
            width: 100%;
            display: flex !important;
            align-items: center;
            justify-content: center;
            padding: 1em 0;
            transition: 1s;
        }

        .dropdown-links .links:hover {
            background-color: #1a0709;
        }

        .dropdown-links .links .link {
            visibility: hidden;
            display: none;
        }


        .dropdown-links li a {
            color: #fff;

        }

        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
        }

        .estates {
            padding-top: 6em;
            position: absolute;
            right: 0;
            width: 20%;
            background: #fee1e3;
            min-height: 150vh;
        }

        .profile-container {
            position: absolute;
            left: 5em;
            padding: 0;
            width: 93%;
            transition: all 0.5s;
        }

        .close {
            display: none;
        }


        .land_estate_container {
            display: flex;
            flex-direction: column;
            gap: 1em;
        }
    }


    @media only screen and (max-width: 1300px) {

        .updated-land {
            height: 620px !important;

        }

        .detail-name p {
            font-style: normal;
            font-weight: 600;
            font-size: 25px;
            color: #1A0709;
        }

        .updated-img {
            height: 241px !important;
            border-radius: 8px 8px 0px 0px;
        }

        .updated-img img {
            height: 241px !important;
        }

        .user,
        #openicon {
            display: none;
        }

        .links img {
            display: none;
        }

        .dropdown-links {
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
            background: #7e252b;
            transform: translateX(100%);
            transition: all 1s;
            width: 40%;
            position: fixed;
            bottom: 0;
            border-radius: 8px 0px 0px 8px;
        }

        .dropdown-links li {
            height: 1em;
            grid-gap: 0;
        }
    }





    @media only screen and (max-width: 800px) {
        .success img {
            width: 20em;
            height: 20em;
        }

        .subscribed-land {
            height: 35em;
        }


        .subscribed-details {
            padding-top: 4em;
        }

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
            <a href="profile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>
        <div class="nav">
            <a href="cartreview.php">
                <div class="cart">
                    <div class="cart-notify"></div>
                    <img src="images/cart.svg" alt="cart icon" />
                </div>
            </a>
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <div class="user">
                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['photo'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
        </div>
    </header>

    <div class="flex-container">
        <ul class="dropdown-links">
            <div class="center">
                <li id="openicon" style="cursor: pointer;">
                    <img src="images/openmenu.svg" />
                </li>

                <li id="closeicon" style="display: none; cursor: pointer; font-size:14px;">
                    <img src="images/openmenu.svg" />
                </li>
            </div>
            <li class="close">
                <img src="images/close2.svg" style="width: 30px; height: 30px; position: absolute; right: 2em;" />
            </li>
            <li class="links">
                <a href="profile.php"><img src="images/home3.svg" /></a>
                <a href="profile.php" class="link">Home</a>
            </li>
            <li class="links">
                <a href="allestates.php"><img src="images/land2.svg" /></a>
                <a href="allestates.php" class="link">New Land</a>
            </li>
            <li class="links">
                <a href="transactions.php"><img src="images/updown.svg" /> </a>
                <a href="transactions.php" class="link">Transaction History</a>
            </li>
            <li class="links select-link">
                <a href="mylands.php"><img src="images/land2.svg" /></a>
                <a href="mylands.php" class="link">My Land</a>
            </li>
            <li class="links">
                <a href="mylands.php"><img src="images/chart2.svg" /> </a>
                <a href="mylands.php" class="link">New Payment</a>
            </li>
            <li class="links">
                <a href="userreferral.php"><img src="images/referral.svg" /></a>
                <a href="userreferral.php" class="link">Referral</a>
            </li>
            <li class="links">
                <a href="documents.php"><img src="images/folder.svg" /></a>
                <a href="documents.php" class="link">Documentation</a>
            </li>
            <li class="links">
                <a href="profiledetails.php"><img src="images/settings.svg" /></a>
                <div>
                    <a href="profiledetails.php" class="link">Profile&nbsp;<span style="color: #808080;">and</span></a>
                    <a href="settings.php" class="link">Settings</a>
                </div>
            </li>
            <li class="links">
                <a href="logout.php"><img src="images/exit.svg" /></a>
                <a href="logout.php" class="link">Logout</a>
            </li>
        </ul>


        <div class="profile-container">
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

                <?php if($value['delete_status'] == "Deleted"){?>
                <div class="updated-land" style="display:none;">

                    <div class="updated-img">
                        <img src="landimage/<?php echo $value['product_image'];?>" alt="estate image" />
                        <div class="ellipse">
                            <i class="ri-heart-fill"></i>
                        </div>
                    </div>
                    <div class="updated-details">
                        <div class="detail-one">
                            <div class="unit-detail">
                                <div class="detail-btn">
                                    <p>Limited Units Available</p>
                                </div>
                                <div class="detail-btn" style="background: #9B51E0;">
                                    <p>Half plot per Unit</p>
                                </div>
                            </div>
                        </div>
                        <div class="detail-two">
                            <div class="unit-detail2">
                                <div class="detail-name">
                                    <p><?php echo $value['product_name'];?></p>
                                </div>
                                <div class="detail-location">
                                    <p style="color: #808080;"><?php echo $value['product_location'];?></p>
                                    <p><a
                                            href="estateinfo.php?id=<?php echo $value['unique_id'];?>&idtwo=<?php echo $value['newpay_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">click
                                            here to view</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="detail-four">

                        </div>
                        <?php if($value['payment_method'] == "Subscription"){?>
                        <div class="cartbutton">&#8358;<?php 
                    $unitprice = $value['sub_price'];
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } else {
                                 echo $unitprice;
                             }
                      ?> &nbsp;<span>daily</span></div>

                        <?php } else if($value['balance'] < "2" && $value['payment_method'] == "NewPayment" || $value['period_num'] == "0"){ ?>
                        <div class="cartbutton">&#8358;<?php 
                   $unitprice = $value['sub_payment'];
                   if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }  else {
                                 echo $unitprice;
                             }
                    ?> &nbsp;<span>daily</span></div>

                        <?php    }
                  else {?>
                        <div class="cartbutton"><?php 
                  if($value['balance'] != "0" && $value['payment_method'] == "NewPayment"){ ?>
                            <a href="estateinfo.php?id=<?php echo $value['product_id'];?>&idtwo=<?php echo $value['newpay_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=newpayment&keyref=09123454954848kdksuuejwej&remprice=<?php echo $value['balance'];?>"
                                style="color: #7e252b;">Pay Up</a>
                            <input type="hidden" id="date" value="<?php echo $value['sub_period'];?>" />
                            <input type="hidden" value="<?php echo $value['balance'];?>" id="check">
                            <form id="priceform">
                                <input type="hidden" value="<?php 
                        $increase = 2 / 100 * $value['sub_price'];
                        $priceincrement = ($increase + $value['sub_price']) * $value['period_num'];
                        echo $priceincrement;
                        ?>" id="increase" name="increase">
                                <input type="hidden" value="<?php 
                          $increase = 2 / 100 * $value['sub_price'];
                          $newsubprice = $increase + $value['sub_price'];
                        echo $newsubprice;
                        ?>" id="increase2" name="newsubprice">
                                <input type="hidden" name="customer" value="<?php echo $value['customer_id'];?>" />
                                <input type="hidden" value="<?php echo $value['product_id'];?>" name="product">
                                <input type="hidden" value="<?php echo $value['newpay_id'];?>" name="newpayid">
                            </form>
                            <script>
                            let dateInput = document.querySelector('#date');
                            let checkBal = document.querySelector('#check');
                            var countDownDate = new Date(dateInput.value).getTime();
                            var now = new Date().getTime();
                            var timeleft = countDownDate - now;
                            console.log(timeleft);

                            //var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
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
                                }, 2592000);
                            }
                            </script>
                            <?php    } else {
             ?>


                            &#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }  else {
                                 echo $unitprice;
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
                             } else {
                                 echo round($unitprice);
                             }
             ?></span></p>
                            <p class="balance"><span>Balance:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $value['balance'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        } else {
                                            if($unprice < "2"){
                                                echo "0";
                                            }else {
                                                echo number_format($unprice);
                                            }
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

                <div class="updated-land">

                    <div class="updated-img" style="height: 241px;">
                        <img src="landimage/<?php echo $value['product_image'];?>" alt="estate image" />
                    </div>
                    <div class="updated-details">
                        <div class="detail-one">
                            <div class="unit-detail">
                                <div class="detail-btn">
                                    <p>Limited Units Available</p>
                                </div>
                                <div class="detail-btn" style="background: #9B51E0;">
                                    <p>Half plot per Unit</p>
                                </div>
                            </div>
                        </div>
                        <div class="detail-two">
                            <div class="unit-detail2">
                                <div class="detail-name">
                                    <p><?php echo $value['product_name'];?></p>
                                </div>
                                <div class="detail-location">
                                    <p style="color: #808080;"><?php echo $value['product_location'];?></p>
                                </div>
                            </div>
                        </div>
                        <div class="detail-five">
                            <?php if($value['balance'] > "2" && $value['payment_method'] == "Subscription"){?>
                            <?php if($value['failed_charges'] > "2"){?>
                            <div class="cartbutton">
                                <a href="estateinfo.php?id=<?php echo $value['product_id'];?>&idtwo=<?php echo $value['newpay_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=failedpayment&keyref=09123454954848kdksuuejwej&remprice=<?php echo $value['failed_charges'];?>"
                                    style="color: #7e252b;">Pay Up</a>
                            </div>

                            <input type="hidden" value="<?php echo $value['failed_charges'];?>" id="check2">
                            <input type="hidden" value="<?php echo $value['increase_date'];?>" id="increasedate2">

                            <form id="priceform2">
                                <input type="hidden" value="<?php 
                          $increasetwo = $value['increase_rate'] / 100 * $value['failed_charges'];
                          $priceincrementtwo = $increasetwo + $value['failed_charges'];
                        echo $priceincrementtwo;
                        ?>" id="increase3" name="increase">
                                <input type="hidden" name="customer" value="<?php echo $value['customer_id'];?>" />
                                <input type="hidden" value="<?php echo $value['product_id'];?>" name="product">
                                <input type="hidden" value="<?php echo $value['newpay_id'];?>" name="newpayid">
                                <input type="hidden" value="<?php 
                                        $dt = strtotime($value['increase_date']); 
                                        echo date("M-d-Y", strtotime("+1 month", $dt))
                                        ?>" name="increasedate">
                            </form>
                            <script>
                            let checkBaltwo<?php echo $value['newpay_id'];?> = document.querySelector('#check2')
                                .value;
                            let increaseDatetwo<?php echo $value['newpay_id'];?> = document.querySelector(
                                    '#increasedate2')
                                .value;

                            var now<?php echo $value['newpay_id'];?> = new Date().getTime();

                            // var date = new Date();
                            // var firstDay = new Date(date.getFullYear(), date.getMonth() + 1, 1);
                            // let firstDate = `${firstDay.toLocaleString('default', {
                            //         month: 'short'
                            //     })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
                            // let firstDate = "Apr-8-2023";
                            //console.log(firstDate);
                            var date = new Date();
                            let daytwo<?php echo $value['newpay_id'];?> = date.getDate();
                            let Monthnametwo<?php echo $value['newpay_id'];?> = date.toLocaleString('default', {
                                month: 'short'
                            });
                            let yeartwo<?php echo $value['newpay_id'];?> = date.getFullYear();
                            let shortdatetwo<?php echo $value['newpay_id'];?> =
                                `${Monthnametwo<?php echo $value['newpay_id'];?>}-${daytwo<?php echo $value['newpay_id'];?>}-${yeartwo<?php echo $value['newpay_id'];?>}`;
                            // let shortdate = "Apr-8-2023";
                            // console.log(shortdate);
                            //let month = date.getMonth();


                            // This arrangement can be altered based on how we want the date's format to appear.
                            let currentDatetwo<?php echo $value['newpay_id'];?> =
                                `${Monthnametwo<?php echo $value['newpay_id'];?>}-${daytwo<?php echo $value['newpay_id'];?>}-${yeartwo<?php echo $value['newpay_id'];?>}`;
                            let checkBalValuetwo<?php echo $value['newpay_id'];?> =
                                checkBaltwo<?php echo $value['newpay_id'];?>;
                            //console.log(currentDate);





                            if (checkBalValuetwo<?php echo $value['newpay_id'];?> > 2 &&
                                currentDatetwo<?php echo $value['newpay_id'];?> >=
                                increaseDatetwo<?php echo $value['newpay_id'];?>
                            ) {
                                let priceformtwo<?php echo $value['newpay_id'];?> = document.querySelector(
                                    '#priceform2');

                                function increasePricetwo<?php echo $value['newpay_id'];?>() {
                                    let xhr = new XMLHttpRequest(); //creating XML Object
                                    xhr.open("POST", "increase2.php", true);
                                    xhr.onload = () => {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                let data = xhr.response;
                                                console.log(data);
                                            }
                                        }
                                    }
                                    // we have to send the information through ajax to php
                                    let formData = new FormData(
                                        priceformtwo<?php echo $value['newpay_id'];?>
                                    ); //creating new formData Object

                                    xhr.send(formData);
                                }


                                setTimeout(() => {
                                    increasePricetwo<?php echo $value['newpay_id'];?>();
                                }, 3000);


                            }

                            //console.log(timeleft);
                            </script>
                            <?php } else {?>
                            <div class="cartbutton">&#8358;<?php 
                    $unitprice = $value['sub_price'];
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } else {
                                 echo $unitprice;
                             }
                      ?> &nbsp;<span><?php echo $value['sub_period']?></span></div>
                            <?php }?>

                            <?php } else if($value['balance'] < "2" && $value['payment_method'] == "Subscription" && $value['failed_charges'] < "2"){ ?>
                            <div class="cartbutton" style="font-size: 12px;"><?php 
                      echo "Payment Completed";
             ?> &nbsp;</div>
                            <?php } else if($value['allocation_status'] == "unapproved" && $value['balance'] < "2"){?>
                            <div class="cartbutton" style="font-size: 12px;"><?php 
                      echo "Pending Allocation";
             ?> &nbsp;</div>
                            <?php  }
                            else if($value['balance'] < "2" && $value['payment_method'] == "NewPayment" && $value['period_num'] == "0"){ ?>
                            <div class="cartbutton" style="font-size: 12px;"><?php 
                      echo "Payment Completed";
             ?> &nbsp;</div>

                            <?php    }
                else {?>
                            <div class="cartbutton" style="font-size: 12px;"><?php 
             if($value['balance'] != "0" && $value['payment_method'] == "NewPayment"){ ?>
                                <a href="estateinfo.php?id=<?php echo $value['product_id'];?>&idtwo=<?php echo $value['newpay_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=newpayment&keyref=09123454954848kdksuuejwej&remprice=<?php echo $value['balance'];?>"
                                    style="color: #7e252b;">Pay Up</a>
                                <input type="hidden" id="date" value="<?php echo $value['sub_period'];?>" />
                                <input type="hidden" value="<?php echo $value['balance'];?>" id="check">
                                <input type="hidden" value="<?php echo $value['increase_date'];?>" id="increasedate">
                                <form id="priceform">
                                    <input type="hidden" value="<?php 
                          $increase = $value['increase_rate'] / 100 * $value['sub_price'];
                          $priceincrement = ($increase + $value['sub_price']) * $value['period_num'];
                        echo $priceincrement;
                        ?>" id="increase" name="increase">
                                    <input type="hidden" value="<?php 
                          $increase = $value['increase_rate'] / 100 * $value['sub_price'];
                          $newsubprice = $increase + $value['sub_price'];
                        echo $newsubprice;
                        ?>" id="increase2" name="newsubprice">
                                    <input type="hidden" name="customer" value="<?php echo $value['customer_id'];?>" />
                                    <input type="hidden" value="<?php echo $value['product_id'];?>" name="product">
                                    <input type="hidden" value="<?php echo $value['newpay_id'];?>" name="newpayid">
                                    <input type="hidden" value="<?php 
                                        $dt = strtotime($value['increase_date']); 
                                        echo date("M-d-Y", strtotime("+1 month", $dt))
                                        ?>" name="increasedate">
                                </form>
                                <?php 
                                // $user = new User;
                                // $increase = 2 / 100 * $value['sub_price'];
                                // $inc = ($increase + $value['sub_price']) * $value['period_num'];
                                // $increase = 2 / 100 * $value['sub_price'];
                                // $newsubprice = $increase + $value['sub_price'];
                                // $customer = $value['customer_id'];
                                // $product = $value['product_id'];
                                // $newpayid = $value['newpay_id'];
                                // $paymentdate = "Apr-29-2023";
                                // $balance = $value['balance'];
                                // $completionDate = $value['sub_period'];
                                // $firstDay = "Apr-29-2023";
                                // //$firstDay = date('M-d-Y', strtotime('+1 month'));
                                // $user = new User;
                                // if($paymentdate > $completionDate && $balance > "2" && $paymentdate == $firstDay){
                                // $increase = $user->updatePricePayment($customer,$product,$inc,$newpayid,$newsubprice);
                                ?>
                                <script>
                                let dateInput<?php echo $value['newpay_id'];?> = document.querySelector('#date')
                                    .value;
                                let checkBal<?php echo $value['newpay_id'];?> = document.querySelector('#check')
                                    .value;
                                let increaseDate<?php echo $value['newpay_id'];?> = document.querySelector(
                                        '#increasedate')
                                    .value;

                                var now<?php echo $value['newpay_id'];?> = new Date().getTime();



                                // var date = new Date();
                                // var firstDay = new Date(date.getFullYear(), date.getMonth() + 1, 1);
                                // let firstDate = `${firstDay.toLocaleString('default', {
                                //         month: 'short'
                                //     })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
                                // let firstDate = "Apr-8-2023";
                                //console.log(firstDate);
                                var date = new Date();
                                let day<?php echo $value['newpay_id'];?> = date.getDate();
                                let Monthname<?php echo $value['newpay_id'];?> = date.toLocaleString('default', {
                                    month: 'short'
                                });
                                let year<?php echo $value['newpay_id'];?> = date.getFullYear();
                                let shortdate<?php echo $value['newpay_id'];?> =
                                    `${Monthname<?php echo $value['newpay_id'];?>}-${day<?php echo $value['newpay_id'];?>}-${year<?php echo $value['newpay_id'];?>}`;
                                // let shortdate = "Apr-8-2023";
                                // console.log(shortdate);
                                //let month = date.getMonth();


                                // This arrangement can be altered based on how we want the date's format to appear.
                                let currentDate<?php echo $value['newpay_id'];?> =
                                    `${Monthname<?php echo $value['newpay_id'];?>}-${day<?php echo $value['newpay_id'];?>}-${year<?php echo $value['newpay_id'];?>}`;
                                let completionDate<?php echo $value['newpay_id'];?> =
                                    dateInput<?php echo $value['newpay_id'];?>;
                                let checkBalValue<?php echo $value['newpay_id'];?> =
                                    checkBal<?php echo $value['newpay_id'];?>;
                                //console.log(currentDate);


                                if (currentDate<?php echo $value['newpay_id'];?> >
                                    completionDate<?php echo $value['newpay_id'];?> &&
                                    checkBalValue<?php echo $value['newpay_id'];?> > 2 &&
                                    currentDate<?php echo $value['newpay_id'];?> >=
                                    increaseDate<?php echo $value['newpay_id'];?>) {
                                    let priceform<?php echo $value['newpay_id'];?> = document.querySelector(
                                        '#priceform');

                                    function increasePrice<?php echo $value['newpay_id'];?>() {
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
                                        let formData = new FormData(
                                            priceform<?php echo $value['newpay_id'];?>
                                        ); //creating new formData Object

                                        xhr.send(formData);
                                    }


                                    setTimeout(() => {
                                        increasePrice<?php echo $value['newpay_id'];?>();
                                    }, 3000);


                                }

                                //console.log(timeleft);
                                </script>
                                <?php    } else {
             ?>


                                <?php 
               echo "Payment Completed";
                            }?> &nbsp;
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="updated-details">
                        <div class="detail-four">
                            <p><span>Amount
                                    Paid:</span>&nbsp;&#8358;<span><?php 
                  $unitprice = $value['product_price'];
                  if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }  else {
                                 echo $unitprice;
                             }
                  ?></span></p>
                            <p><span>Balance:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $value['balance'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        }  else {
                                            if($unprice < "2"){
                                                echo "0";
                                            }else {
                                                echo number_format($unprice);
                                            }

                                        }

                         
                                        
                    ?></span></p>
                            <p><span>Start
                                    Date:</span>&nbsp;<span><?php echo $value['payment_day'];?></span>-<span><?php echo $value['payment_month'];?></span>-<span><?php echo $value['payment_year'];?></span>
                            </p>
                            <?php if($value['payment_method'] == "NewPayment" || $value['payment_status'] == "Payed"){  ?>
                            <p><span>Expected End
                                    Date:</span>&nbsp;<span><?php echo $value['sub_period'];?></span></p>
                            <?php }?>
                            <?php if($value['payment_method'] == "Subscription" || $value['payment_method'] == "NewPayment"){  ?>
                            <p><span>Chosen Plan:</span>&nbsp;<span style="text-transform: capitalize;"><?php 
                        echo $value['product_plan'];         
                    ?></span></p>
                            <?php }?>
                            <?php if($value['payment_method'] == "Subscription" && $value['failed_charges'] > "2"){  ?>
                            <p><span>Failed Charges:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $value['failed_charges'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        }  else {
                                            echo number_format($unprice);
                                        }
                                        
                    ?></span></p>
                            <?php }?>
                            <p><span>Unit:</span>&nbsp;<span style="text-transform: capitalize;"><?php 
                        echo $value['product_unit'];         
                    ?></span></p>
                            <p><span>Bought By:</span>&nbsp;<span style="text-transform: capitalize;"><?php 
                            if($value['payee'] == $newuser['first_name']." ".$newuser['last_name']){
                                echo "You";
                            } else {
                                echo $value['payee'];   
                            }
                             
                    ?></span></p>
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
        </div>
    </div>


    <script src="js/cart.js"></script>
    <script>
    if (window.innerWidth > 1200) {
        let dropdownnav = document.querySelector(".dropdown-links");
        let open = document.querySelector('#openicon');
        let closeicon = document.querySelector('#closeicon');
        open.onclick = () => {
            dropdownnav.style = `
        width: 14%;
        `;
            open.style.display = "none";
            closeicon.style.display = "block";
            document.querySelector(".profile-container").style = `
         padding-left: 7em;
        `;
            let allLinks = document.querySelectorAll(".dropdown-links .links .link");

            let allLink = document.querySelectorAll(".dropdown-links .links");
            allLink.forEach((element) => {
                element.style = `
        gap: 10px;
        `;

            });
            allLinks.forEach((element) => {
                element.style = `
         visibility: visible;
         display: block;
        `;
            });
        }

        closeicon.onclick = () => {
            dropdownnav.style = `
        width: 6%;
        `;
            open.style.display = "block";
            closeicon.style.display = "none";
            document.querySelector(".profile-container").style = `
         padding-left: 1em;
        `;

            let allLink = document.querySelectorAll(".dropdown-links .links");
            allLink.forEach((element) => {
                element.style = `
        justify-content: center
        `;
            });

            let allLinks = document.querySelectorAll(".dropdown-links .links .link");
            allLinks.forEach((element) => {
                element.style = `
         visibility: hidden;
         display:none;
        `;
            });
        }
    }
    if (window.innerWidth < 1300) {
        let dropdownnav = document.querySelector(".dropdown-links");
        let menu = document.querySelector(".menu");
        menu.onclick = () => {
            dropdownnav.style = `
            transform: translateX(0);
            `;
        };

        let close = document.querySelector(".close");
        close.onclick = () => {
            dropdownnav.style = `
            transform: translateX(100%);
            `;
        };
    }
    </script>
</body>

</html>