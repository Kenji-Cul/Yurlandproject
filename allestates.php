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
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />
    <script src="bootstrap/js/jquery.min.js"></script>

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    .page-title3 {
        flex-direction: column;
    }

    body {
        overflow-x: hidden;
        background-image: none;
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


    .success {
        position: absolute;
        left: 50%;
        top: 30em;
        transform: translate(-50%, -50%);
        height: 10em;
    }

    .success img {
        width: 36em;
        height: 36em;
    }


    .search-icon {
        position: absolute;
        right: 4em;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        gap: 1.5em;
        align-items: center;
        justify-content: center;
    }





    .search-icon img {
        width: 20px;
        height: 20px;
    }

    .search-icon input {
        padding: 0.8em 4em;
        outline: none;
        background-color: #cac6c6;
        border: 1px solid #808080;
    }

    .search-icon input:focus {
        border: none;
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
        min-height: 620px;
        background: #FFFFFF;
        border-radius: 8px;
        filter: drop-shadow(0px 4px 16px rgba(128, 128, 128, 0.76));
        display: flex;
        flex-direction: column;

    }

    .updated-img {
        width: 350px;
        height: 341px;
        border-radius: 8px 8px 0px 0px;
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
        gap: 0.3em;
    }

    .detail-four p {
        color: #808080;
        font-size: 13px;
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



        @media only screen and (min-width: 1300px) {
            .page-title2 {
                justify-content: left;
                gap: 1em;
            }

            .page-title2 a {
                position: unset;
            }

            .page-title2 p {
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


    @media only screen and (max-width: 1300px) {

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
        .updated-img {
            height: 200px;
        }

        .updated-img img {
            width: 100%;
            height: 200px;
        }

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
        if(isset($_SESSION['unique_id'])){
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
                    <?php }}?>
                </div>
            </div>
        </div>
    </header>

    <?php if(isset($_SESSION['unique_id'])){?>
    <div class="flex-container">
        <ul class="dropdown-links">
            <div class="center">
                <li id="openicon" style="cursor: pointer;">
                    <img src="images/home.svg" style="width: 20px; height: 20px;" />
                </li>

                <li id="closeicon" style="display: none; cursor: pointer; font-size:14px;">
                    <img src="images/home.svg" style="width: 20px; height: 20px;" />
                </li>
            </div>
            <li class="close">
                <img src="images/close2.svg" style="width: 30px; height: 30px; position: absolute; right: 2em;" />
            </li>
            <li class="links">
                <a href="profile.php"><img src="images/home3.svg" /></a>
                <a href="profile.php" class="link">Home</a>
            </li>
            <li class="links select-link">
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
        <?php }?>


        <div class="profile-container">
            <div class="page-title2">
                <?php if(isset($_SESSION['unique_id'])){?>
                <a href="profile.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <div style="display: flex !important; flex-direction: column !important" class="estatetext">
                    <p>All Estates</p>
                </div>


                <div class="search-icon">
                    <img src="images/search.svg" alt="search image" id="searchimg">
                </div>
                <?php ?>

            </div>



            <div class="subscribed-lands">
                <?php 
             $land = new User;
             $landview = $land->selectLand();
             if(isset($_SESSION['unique_id'])){
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
            ?>
                <div class="updated-land">
                    <div class="updated-img">
                        <?php if($value['product_unit'] != 0){?>
                        <a
                            href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">
                            <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="<?php echo $value['product_name'];?>" />
                        </a>
                        <?php } else {?>
                        <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="<?php echo $value['product_name'];?>" />
                        <?php }?>
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
                                            href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">click
                                            here to view</a></p>
                                </div>
                            </div>
                        </div>


                        <div class="detail-four">
                            <?php if($value['product_unit'] != 0){?>
                            <?php if($value['outright_price'] != 0){
                     $outprice = $value['outright_price'];
                    $onemonthprice = $value['onemonth_price'];
                        ?>
                            <p><span>Outright Price:&nbsp;&nbsp;</span>&#8358;<?php if($outprice > 999 || $outprice > 9999 || $outprice > 99999 || $outprice > 999999 || $outprice > 9999999){
                          echo number_format($outprice);
                        }?></p>
                            <?php } else {?>
                            <p style="color: #ff6600;">Subscription Only</p>
                            <?php }?>
                            <?php if($value['onemonth_price'] != 0){
                       
                        $overallprice = $value['eighteen_percent'] / 100 * $value['onemonth_price'];
                        $totalprice = $overallprice + $value['onemonth_price'];
                        $onemonthprice = $totalprice / 540;
          
              

                        ?>
                            <p><span>Subscription Price(18 Months):&nbsp;&nbsp;</span>&#8358;<?php if($totalprice > 999 || $totalprice > 9999 || $totalprice > 99999 || $totalprice > 999999){
                          echo number_format($totalprice);
                        }?></p>
                            <p><span>Daily Price:&nbsp;&nbsp;</span>&#8358;<?php if($onemonthprice > 999 || $onemonthprice > 9999 || $onemonthprice > 99999 || $onemonthprice > 999999){
                          echo number_format($onemonthprice);
                        } else {
                            echo round($onemonthprice);
                        }?></p>

                            <?php } else {?>
                            <p style="color: #ff6600;">Outright Only</p>
                            <?php }} else {?>
                            <p>Sold Out</p>
                            <?php }?>
                        </div>

                        <div class="detail-four">
                            <p>Features</p>
                            <div class="detail">
                                <img src="images/ellipse.svg" alt="">
                                <p><?php echo $value['product_description'];?></p>
                            </div>
                        </div>


                        <?php if($value['product_unit'] != 0){?>
                        <div class="detail-five">
                            <div class="uni<?php echo $value['unique_id'];?>" style="visibility:hidden;">

                                <?php echo $value['unique_id'];?>
                            </div>
                            <form action="" id="cartform<?php echo $value['unique_id'];?>">
                                <?php 
                    $cart = $land->checkCartId($_SESSION['unique_id'],$value['unique_id']);
                    if(empty($cart)){
                    ?>
                                <div class="cartbutton" id="cart-btn<?php echo $value['unique_id'];?>">
                                    <img src="images/cart.svg" alt="">
                                    <p>Add To Cart</p>
                                </div>

                                <div id="otherbtn<?php echo $value['unique_id'];?>" class="cartbutton"
                                    style="visibility:hidden;"> <a
                                        href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej"
                                        style="color: #7e252b;">View In Cart </a>
                                </div>
                                <?php } else {?>
                                <div class="cartbutton" id="cart-btn<?php echo $value['unique_id'];?>"
                                    style="visibility:hidden;">
                                    <img src="images/cart.svg" alt="">
                                    <p>Add To Cart</p>
                                </div>
                                <div id="otherbtn<?php echo $value['unique_id'];?>" class="cartbutton"> <a
                                        href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej"
                                        style="color: #7e252b;">View In Cart </a>
                                </div>
                                <?php }?>


                                <input type="hidden" name="productid" value="<?php echo $value['unique_id']?>">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="user" value="<?php echo $_SESSION['unique_id'];?>">
                            </form>

                        </div>
                        <?php } else {?>
                        <div class="detail-five">
                            <div class="cartbutton" id="cart-btn<?php echo $value['unique_id'];?>"
                                style="visibility:hidden;">
                            </div>
                            <div class="cartbutton">
                                <p>Sold Out</p>
                            </div>
                        </div>
                        <?php }?>
                    </div>

                </div>



                <script>
                let unique<?php echo $value['unique_id']?> = document.querySelector(
                    `.uni<?php echo $value['unique_id'];?>`);

                const intervalform<?php echo $value['unique_id'];?> = document.querySelector(
                    `#cartform<?php echo $value['unique_id'];?>`);
                const paybtn<?php echo $value['unique_id'];?> = document.querySelector(
                    `#cart-btn<?php echo $value['unique_id'];?>`);


                intervalform<?php echo $value['unique_id'];?>.onsubmit = (e) => {
                    e.preventDefault();
                }





                function addToCart<?php echo $value['unique_id'];?>() {
                    let xhr = new XMLHttpRequest(); //creating XML Object
                    xhr.open("POST", "inserters/checkproduct.php", true);
                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                if (data) {
                                    document.querySelector(`#cart-btn<?php echo $value['unique_id'];?>`).style
                                        .display =
                                        "none";
                                    document.querySelector(`#otherbtn<?php echo $value['unique_id'];?>`).style
                                        .visibility =
                                        "visible";
                                } else {
                                    //console.log(data);
                                }

                            }
                        }
                    }
                    // we have to send the information through ajax to php
                    let formData = new FormData(
                        intervalform<?php echo $value['unique_id'];?>); //creating new formData Object

                    xhr.send(formData); //sending the form data to php
                }

                paybtn<?php echo $value['unique_id'];?>.onclick = () => {
                    addToCart<?php echo $value['unique_id'];?>();
                }
                </script>


                <?php }}?>
            </div>

            <?php if(isset($_SESSION['unique_id'])){?>
            <div class="price-container">
                <a href="cartreview.php">
                    <div class="price">Continue</div>
                </a>
            </div>
            <?php }?>

            <?php }}else {?>

            <div class="success">
                <img src="images/asset_success.svg" alt="" />
                <p>
                <div class="estate_page_button action" onClick="load()" style="width: 200px; height: 30px;">Sign Up
                </div>
                </p>
            </div>
            <?php }?>

            <?php if(isset($_SESSION['unique_id'])){?>
            <footer class="footerdiv">
                <p>YurLAND &#169; 2022 | All Right Reserved</p>
                <p>A product of Ilu-oba International Limited and Arklips Limited</p>
                <p>Connect with us Facebook, Twitter, Instagram</p>
                <p style="font-size: 30px;">
                    <a href="https://instagram.com/yurlandng?igshid=NTdlMDg3MTY="><i
                            class="ri-instagram-line"></a></i><a
                        href="https://www.facebook.com/profile.php?id=100088254710492&mibextid=ZbWKwL"><i
                            class="ri-facebook-fill"></i></a><i class="ri-twitter-line"></i>
                </p>
            </footer>
            <?php }?>
        </div>
    </div>

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
    let searchIcon = document.querySelector('.search-icon');
    searchIcon.onclick = () => {
        location.href = "searchresult.php";
    }

    function load() {
        location.href = "signup.html";
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