<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['unique_id'])){
    header("Location:index.php");
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

    <!-- ========= SWIPER CSS ======== -->

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>

    <style>
    body {
        overflow-x: hidden;
    }

    .profile-container {
        padding: 2em;
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

    .transaction-details {
        border-radius: 8px;
        /* border: 2px solid black; */
        padding: 1em 2em;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    }

    .land_estate_container {
        display: flex;
        gap: 2em;
    }

    @media only screen and (max-width: 800px) {
        .transaction-details {
            flex-direction: column;
        }


    }

    @media only screen and (max-width: 500px) {
        .land_estate_container {
            display: flex;
            flex-direction: column;
            gap: 2em;
        }

        .land-estate {
            width: 100%;
            height: 18em;
            position: relative;
        }

        .land-estate img {
            height: 13em;
        }

        .land-details {
            position: absolute;
            bottom: 1em;
        }
    }

    @media only screen and (min-width: 1300px) {
        .land-estate {
            border: 1px solid #d4d1d1;
            width: 280px;
            height: 270px;
            padding-top: 8px;
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
            width: 10%;
            height: 90vh;
            border-radius: 0 8px 8px 0;
            padding: 1em;
            display: flex;
            flex-direction: column;
            justify-content: top;
            align-items: top;
            gap: 3em;
            background: rgba(255, 255, 255, 0.9);
            filter: drop-shadow(0px 4px 16px rgba(128, 128, 128, 0.76));
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999999 !important;
        }

        .dropdown-links li {
            height: 1em;
            width: 95%;
            text-transform: capitalize;
            font-size: 17px;
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
        }

        .profile-container {
            position: absolute;
            left: 10em;
            padding: 0;
            width: 60%;
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
    <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>

    <?php if(empty($newuser['driver_license']) || empty($newuser['passport']) || empty($newuser['nin'])){
    ?>
    <div class="update-data">
        <div class="notice-div">
            <p>Please Update Your Data For Verification</p>
        </div>
    </div>

    <?php }?>


    <div class="flex-container">

        <ul class="dropdown-links">
            <li><a href="preference.php">New Land</a></li>
            <li><a href="transactions.php">Transaction History</a></li>
            <li><a href="mylands.php">My Land</a></li>
            <li><a href="payment.php">New Payment</a></li>
            <li><a href="userreferral.php">Referral</a></li>
            <li><a href="documents.html">Documents</a></li>
            <li>
                <a href="profiledetails.php">Profile</a> and
                <a href="settings.php">Settings</a>
            </li>
            <li><a href="logout.php">Logout</a></li>
            <div class="close">
                <i class="ri-close-fill"></i>
            </div>
        </ul>



        <div class="profile-container">
            <div class="profile-info">
                <div class="details">
                    <p>Welcome Back!</p>
                    <h3><?php if(isset($newuser['first_name'])){  ?>
                        <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                        <?php }?>
                    </h3>
                </div>

                <div class="profile-image">
                    <?php if(!empty($newuser['photo'])){?>
                    <img src="profileimage/<?php echo $newuser['photo'];?>" alt="profile image" />
                    <?php }?>
                    <?php if(empty($newuser['photo'])){?>
                    <div class="empty-img">
                        <i class="ri-user-fill"></i>
                    </div>
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

                <div class="profile-div">
                    <img class="profile-icon" src="images/Wallet.svg" alt="land-icon-image" />

                    <div class="navigate">
                        <p>Wallet</p>
                        <img src="images/right_arrow.svg" alt="" />
                    </div>
                </div>

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
                <div class="profile-div">
                    <img class="profile-icon" src="images/paystack.svg" alt="land-icon-image" />

                    <div class="navigate">
                        <div>
                            <p>Make new</p>
                            <p>Payment</p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="transactions">
                <p>Current Transactions</p>
                <a href="transactions.php">
                    <p class="more">See more</p>
                </a>
            </div>

            <?php 
             $land = new User;
             $landview = $land->selectCurrentPayment($_SESSION['unique_id']);
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

        </div>


        <div class="swiper estates swiper-counter">
            <p class="available">Available Estates</p>
            <div class="land_estate_container swiper-wrapper">
                <?php 
             $land = new User;
             $landview = $land->selectLandPrime();
             if(!empty($landview)){
                foreach($landview as $key => $value){
            ?>
                <div class="land-estate swiper-slide">
                    <div class="land-image">
                        <a
                            href="estateinfo2.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">
                            <img src="landimage/<?php if(isset($value['product_image'])){
                            echo $value['product_image'];
                        }?>" alt="estate image" />
                        </a>
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

                <?php   }
             } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>


    </div>





    <script src="js/profile.js" defer></script>
    <script src="js/cart.js" defer></script>
    <!--========== SWIPER JS ============  -->
    <script>
    if (window.innerWidth < 1300) {
        let dropdownnav = document.querySelector(".dropdown-links");
        dropdownnav.style.display = "none";

        let menu = document.querySelector(".menu");
        menu.onclick = () => {
            dropdownnav.style.display = "block";
        };

        let close = document.querySelector(".close");
        close.onclick = () => {
            dropdownnav.style.display = "none";
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