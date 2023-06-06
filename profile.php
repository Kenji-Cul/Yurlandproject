<?php 
session_start();
include_once "projectlog.php";
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

    <!-- ========= SWIPER CSS ======== -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>

    <style>
    body {
        overflow-x: hidden;
    }




    .payee {
        width: 130px;
        display: flex;
        flex-direction: row;
        gap: 0 !important;
        position: relative;
        height: 20px;
    }


    .details {
        width: 160px !important;
        position: relative;
    }

    .details .pname {
        width: 100px !important;
        text-overflow: ellipsis !important;
        overflow: hidden;
        white-space: nowrap;
    }

    .payee .payee-name {
        text-overflow: ellipsis !important;
        overflow: hidden;
        white-space: nowrap;
        font-size: 13px;
        color: #808080;
        width: 59%;
    }

    .payee .payee-tag {
        width: 41%;
        font-size: 13px;
    }




    ::-webkit-scrollbar {
        width: 0.7rem;
        background-color: #8d8989;
        border-radius: 1rem;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #ddd;
        border-radius: 1rem;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #aaa;
    }


    header {
        background: #fee1e3;
    }


    .land-image {
        width: 100%;
        border-radius: 8px 8px 0px 0px !important;
    }



    .land-estate {
        padding-top: 0;
    }

    .land-image img {
        border-radius: 8px 8px 0px 0px !important;
    }

    .price {
        height: 25px;
    }





    .update-data {
        position: fixed;
        top: -2em;
        z-index: 1000;
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

    .foot {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .foot .profile-div {
        width: 156px;
        height: 60px;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        position: relative;
        gap: 4em !important;
    }



    .foot .navigate {
        width: 100% !important;
        height: 80%;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .navigate div {
        margin-left: 3.5em;
    }

    .transaction-details {
        border-radius: 8px;
        /* border: 2px solid black; */
        padding: 1em 2em;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
        width: 90%;
    }

    .unverified {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5px;
        padding: 1px 6px;
        border-radius: 15px;
        background-color: #808080;
        color: #fff;
    }

    .unverified .unspan {
        font-size: 14px;
    }

    .land_estate_container {
        display: flex;
        gap: 2em;
    }

    @media only screen and (max-width: 1300px) {
        .land-estate .land-details {
            display: none;
        }


        .details .date {
            font-size: 9px !important;
        }

        .unverified {
            width: 100px;
            position: absolute;
            right: 20px;
            margin-top: 0.4em;
        }

        .profile-image {
            position: relative;
        }

        #check {
            position: absolute;
            bottom: -7px;
            right: -5px;
        }









        .transaction-details .radius img {
            width: 50px !important;
        }


        .payee {
            width: 100px;
            display: flex;
            flex-direction: row;
            gap: 0 !important;
            position: relative;
            height: 20px;
        }

        .payee .payee-name {
            text-overflow: ellipsis !important;
            overflow: hidden;
            white-space: nowrap;
            font-size: 12px;
            color: #808080;
            width: 50%;
        }

        .payee .payee-tag {
            width: 50%;
            font-size: 12px;
        }


        .details .pname {
            font-size: 13px;
        }

        .land_estate_container .land-estate {
            filter: drop-shadow(0px 4px 16px rgba(128, 128, 128, 0.90));
            min-height: 250px !important;
            gap: 0;
            border-radius: 8px;
        }



        .land-estate .land-image {
            border-radius: 8px !important;
            height: 250px !important;
        }

        .land-image img {
            border-radius: 8px !important;
            height: 250px !important;
        }

        .user,
        #openicon {
            display: none;
        }

        .links img {
            display: none;
        }

        .transaction-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
        }

        .transaction-details {
            border-radius: 8px;
            /* border: 2px solid black; */
            padding: 1em 2em;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            width: 85%;
        }

        .transaction-details .date {
            font-size: 11px !important;
        }

        .detail3 {
            display: none;
        }

        .update-data {
            position: absolute;
            top: -3em;
        }

        .land_estate_container {
            display: flex;
            flex-direction: row;
            gap: 1em;
        }

        .estate1 {
            display: block !important;
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

        .land-estate {
            width: 290px;
        }


        .profile-div-container {
            margin: auto;
            width: 100%;
        }

        .close {
            position: absolute;
            top: 4em;
            right: 1em;
        }

    }

    @media only screen and (max-width: 500px) {


        .links img {
            display: none;
        }

        .user,
        #openicon {
            display: none;
        }

        .land_estate_container {
            display: flex;
            flex-direction: row;
            gap: 2em;
        }

        .land-estate {
            width: 290px;
            position: relative;
        }


        .land-details {
            position: absolute;
            bottom: 1em;
        }

        .profile-div-container {
            margin: auto;
            width: 100%;
        }

    }

    @media only screen and (min-width: 1300px) {
        .land-estate {
            height: 500px !important;
        }

        .land-estate .land-image {
            height: 230px !important;
        }

        .land-image img {
            height: 230px !important;
        }

        .estates {
            overflow-y: auto;
            direction: rtl;
        }

        .dropdown-links {
            overflow-y: auto;
        }

        .estates div {
            direction: ltr;
        }

        /* .dropdown-links {
            overflow-y: auto;
        } */

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

        .user .profile-name {
            font-weight: 600;
            font-size: 20px;
            color: #1A0709;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5px;
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

        .details2 {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6em;
        }

        .details2 p {
            color: #808080;
        }

        .details2 p,
        .details2 h3 {
            font-size: 22px;
        }

        .land-btn-container {
            padding-left: 1em;
        }

        .land-btn-container .btn {
            width: 500px;
        }

        .menu {
            display: none;
        }

        .estate2 {
            display: block !important;
        }

        .land-estate {
            background: #FFFFFF;
            border-radius: 8px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            width: 290px;
            height: 270px;
            padding-top: 0;
            padding-bottom: 10px;
            display: flex;
            justify-content: top;
            align-items: center;
            gap: 1em;
            flex-direction: column;
            border-radius: 8px;
            margin-bottom: 1.6em;
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

        .transaction-details {
            width: 80%;
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
            height: 150vh !important;
        }

        .profile-container {
            position: absolute;
            left: 5em;
            padding: 0;
            width: 60%;
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

    .transaction-details {
        gap: 2em;
    }

    /* @media only screen and (max-width: 500px) {
        body {
            height: 100% !important;
        }

        .estates {
            position: unset;
            position: absolute;
            top: 106em;
            left: 0;
            border: 1px solid black;

        }
    } */

    /* 
    @media only screen and (max-width: 1000px) {
        body {
            height: 100% !important;
        }

        .flex-container {
            display: flex;
            flex-direction: column;
            position: relative;
            padding-top: 2em;
        }

        .profile-container {
            position: absolute;
            left: 0;
            width: 94%;
        }

        .estates {
            position: unset;
            position: absolute;
            top: 93em;
            left: 0;
        }

        .land_estate_container {
            display: flex;
            flex-direction: row !important;
            gap: 2em;
        }

        .dropdown-links {
            display: none;
        }

        .land-estate {
            width: 90%;
            height: 19em;
            border: 1px solid black;
        }

        .transaction-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1.5em;
            padding-left: 1em;
        }
    } */
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['unique_id'])){?>
            <a href="profile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
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

                <div class="profile-name">
                    <?php if(empty($newuser['photo'])){
    ?>
                    <div class="unverified">
                        <span style="text-transform: capitalize;" class="unspan">unverified</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z"
                                fill="rgba(249,19,19,1)" />
                        </svg>
                    </div>
                    <?php } else {?>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-.997-6l7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414 1.414L11.003 16z"
                            fill="rgba(50,179,40,1)" />
                    </svg>
                    <?php }?>
                    <?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                    <?php }?>
                </div>
                <div class="profile-image">
                    <?php if(!empty($newuser['photo'])){?>
                    <a href="profiledetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['photo'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['photo'])){?>
                    <a href="profiledetails.php" style="color: #808080;">
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
            <li class="links select-link">
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
            <li class="links">
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
            <div class="profile-info">
                <div class="details2">
                    <p>Welcome Back!</p>
                    <h3><?php if(isset($newuser['first_name'])){  ?>
                        <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                        <?php }?>
                    </h3>

                </div>

                <div class="profile-image profile-image2">
                    <?php if(!empty($newuser['photo'])){?>
                    <a href="profiledetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['photo'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['photo'])){?>
                    <a href="profiledetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                    <?php if(empty($newuser['photo'])){
    ?>
                    <div class="unverified">
                        <span style="text-transform: capitalize;" class="unspan">unverified</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z"
                                fill="rgba(249,19,19,1)" />
                        </svg>
                    </div>
                    <?php } else {?>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" id="check">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-.997-6l7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414 1.414L11.003 16z"
                            fill="rgba(50,179,40,1)" />
                    </svg>
                    <?php }?>
                </div>
            </div>
            <div class="land-btn-container">
                <a href="allestates.php">
                    <button class="btn land-btn">Buy a new land</button>
                </a>

            </div>

            <div class="profile-div-container">
                <div class="profile-div">
                    <img class="profile-icon" src="images/land.svg" alt="land-icon-image" />

                    <a href="mylands.php">
                        <div class="navigate">
                            <p>My land</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <a href="userwallet.php">
                    <div class="profile-div">
                        <img class="profile-icon" src="images/Wallet.svg" alt="land-icon-image" />

                        <div class="navigate">
                            <p>Wallet</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </div>
                </a>

                <a href="payment.php">
                    <div class="profile-div">
                        <img class="profile-icon" src="images/Chart.svg" alt="land-icon-image" />

                        <div class="navigate">
                            <p>Payment Count</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </div>
                </a>

                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="transactions.php">
                        <div class="navigate">
                            <p>Transactions</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>
            </div>

            <div class="foot">
                <a href="mylands.php">
                    <div class="profile-div">
                        <img class="profile-icon" src="images/paystack.svg" alt="land-icon-image" />



                        <div class="navigate">
                            <div>
                                <p>Make new</p>
                                <p>Payment</p>
                            </div>
                        </div>

                    </div>
                </a>
            </div>



            <div class="transactions">
                <p>Current Transactions</p>
                <a href="transactions.php">
                    <p class="more">See more</p>
                </a>
            </div>

            <?php 
             $land = new User;
             $landview = $land->selectCurrentPayHistory($_SESSION['unique_id']);
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
            ?>
            <div class="transaction-details" <?php if($value['sub_status'] == "Failed"){?>
                style="border: 2px solid red;" <?php }?>>
                <div class="radius">
                    <img src="landimage/<?php echo $value['product_image'];?>" alt="">
                </div>
                <div class="details">
                    <p class="pname"><?php echo $value['product_name'];?></p>
                    <div class="inner-detail">
                        <div class="date" style="font-size: 14px;">
                            <span><?php echo $value['payment_month'];?></span>&nbsp;<span><?php echo $value['payment_day'];?></span>,<span><?php echo $value['payment_year'];?></span>,<span><?php echo $value['payment_time'];?></span>
                        </div>
                    </div>
                    <?php if($value['payment_mode'] == "Offline"){?>
                    <p
                        style="color: #7e252b; font-size: 12px; display:flex; align-items:center; justify-content:center; border-radius: 25px; border: 2px solid #7e252b; padding: 0 5px;">
                        Offline: <?php if($value['payment_mode'] == "Offline" && $value['offline_status'] == ""){
                            echo "Approved";
                        } else {
                            echo $value['offline_status'];
                        }?></p>
                    <?php }?>
                </div>
                <div class="price-detail detail3"><?php 
                if($value['product_unit'] == "1"){
                    echo $value['product_unit']." Unit";
                } else {
                    echo $value['product_unit']." Units";
                }
            ?></div>
                <div class="price-detail detail3"><?php 
            echo $value['payment_method'];
            ?></div>

                <?php  if($value['delete_status'] == "Deleted"){ ?>
                <div class="detail-four">
                    <div class="detail"
                        style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <p style="font-size: 14px; color: #fff;">Deleted</p>
                    </div>
                </div>
                <?php } else {?>
                <div class="price-detail" <?php if($value['sub_status'] == "Failed"){?> style="color: red;" <?php }?>>&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format(round($unitprice));
                             } else {
                                echo round($unitprice);
                             }
            ?><?php if($value['sub_status'] == "Failed") { echo "<span style='font-size: 12px;'>(Failed)</span>";}?>
                    <div class="payee">
                        <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
                        <p class="payee-name"
                            style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">

                            <?php 
                            if($value['payee'] == $newuser['first_name']." ".$newuser['last_name']){
                                echo "You";
                            } else {
                                echo $value['payee'];   
                            }
                             
                    ?>
                        </p>
                    </div>
                </div>
                <?php }?>
            </div>
            <?php }} else {?>
            <div class="transaction-details" style="display: flex; align-items: center; justify-content: center;">
                <p>You have not done any transactions yet</p>
            </div>
            <?php }?>

        </div>


        <div class="swiper estates swiper-counter estate1" style="display:none;">
            <p class="available">Available Estates</p>
            <div class="land_estate_container swiper-wrapper">
                <?php 
             $land = new User;
             $landview = $land->selectLandPrime();
             if(!empty($landview)){
                foreach($landview as $key => $value){
            ?>
                <?php if($value['land_status'] == "Closed"){?>
                <div class="nodisplay" style="display: none;">
                    <div class="land-estate swiper-slide">
                        <div class="land-image">

                            <img src="landimage/<?php if(isset($value['product_image'])){
                            echo $value['product_image'];
                        }?>" alt="estate image" />

                        </div>
                        <div class="land-details">
                            <div class="land-name">
                                <p><?php echo $value['product_name'];?></p>
                            </div>
                            <div class="land-location">
                                <p><?php echo $value['product_location'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } else {?>
                <div class="land-estate swiper-slide">
                    <div class="land-image">

                        <img src="landimage/<?php if(isset($value['product_image'])){
                            echo $value['product_image'];
                        }?>" alt="estate image" />
                    </div>
                    <div class="land-details">
                        <div class="land-name">
                            <p><?php echo $value['product_name'];?></p>
                        </div>
                        <div class="land-location">
                            <p><?php echo $value['product_location'];?></p>
                        </div>
                    </div>

                </div>
                <?php }?>

                <?php   }
             } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>


        <div class="estates estate2" style="display:none;">
            <p class="available">Available Estates</p>
            <div class="land_estate_container">
                <?php 
             $land = new User;
             $landview = $land->selectLandPrime();
             if(!empty($landview)){
                foreach($landview as $key => $value){
            ?>
                <?php if($value['land_status'] == "Closed"){?>
                <div class="nodisplay" style="display: none;">
                    <div class="land-estate">
                        <div class="land-image">

                            <img src="landimage/<?php if(isset($value['product_image'])){
                            echo $value['product_image'];
                        }?>" alt="estate image" />

                        </div>
                        <div class="land-details">
                            <div class="land-name">
                                <p><?php echo $value['product_name'];?></p>
                            </div>
                            <div class="land-location">
                                <p><?php echo $value['product_location'];?></p>
                            </div>
                        </div>

                    </div>
                </div>
                <?php } else {?>
                <div class="land-estate">
                    <div class="land-image">

                        <img src="landimage/<?php if(isset($value['product_image'])){
                            echo $value['product_image'];
                        }?>" alt="estate image" />
                    </div>
                    <div class="land-details">
                        <div class="land-name">
                            <p style="font-size: 17px;"><?php echo $value['product_name'];?></p>
                        </div>
                        <div class="land-location">
                            <p><?php echo $value['product_location'];?></p>
                        </div>
                    </div>

                    <div class="subscribed-details" style="flex-direction: column;  gap: 1em; margin-top: 15px;">
                        <div class="price"> <a
                                href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej"
                                style="color: #7e252b;">View Details </a>
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
                            <p class="land-name">Subscription Only</p>
                            <?php }?>


                            <?php if($value['onemonth_price'] != 0){
                        $overallprice = $value['eighteen_percent'] / 100 * $value['onemonth_price'];
                        $totalprice = $overallprice + $value['onemonth_price'];
                        $onemonthprice = $totalprice / 540;
          
                        ?>
                            <div>
                                <p class="land-name" style="font-size: 13px;">Subscription Price(18 Months):</p>
                                <p class="land-location">&#8358;<?php if($totalprice > 999 || $totalprice > 9999 || $totalprice > 99999 || $totalprice > 999999){
                          echo number_format($totalprice);
                        }?></p>

                                <p class="land-name">Daily Price:</p>
                                <p class="land-location">&#8358;<?php if($onemonthprice > 999 || $onemonthprice > 9999 || $onemonthprice > 99999 || $onemonthprice > 999999){
                          echo number_format($onemonthprice);
                        } else {
                            echo round($onemonthprice);
                        }?></p>
                            </div>
                            <?php } else {?>
                            <div>
                                <p class="land-name">Outright Only</p>
                            </div>
                            <?php } } else {?>
                            <p class="land-name">Sold Out</p>
                            <?php }?>


                        </div>
                    </div>
                </div>


                <?php }?>

                <?php   }
             } ?>
            </div>
        </div>


    </div>





    <script src="js/profile.js" defer></script>
    <script src="js/cart.js" defer></script>
    <!--========== SWIPER JS ============  -->
    <script src="js/swiper-bundle.min.js"></script>
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