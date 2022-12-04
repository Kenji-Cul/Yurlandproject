<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['uniquesupadmin_id'])){
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
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        overflow-x: hidden;
        height: 180vh;
    }

    .dropdown-links {
        height: 24em;
        overflow-y: auto!important;
    }


    @media only screen and (min-width: 1300px) {

        .land-estate {
            border: 1px solid #d4d1d1;
            width: 320px;
            height: 290px;
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
            height: 100vh;
            border-radius: 0 8px 8px 0;
            padding: 1em;
            display: flex;
            flex-direction: column;
            justify-content: top;
            align-items: top;
            gap: 2em;
            background: rgba(255, 255, 255, 0.9);
            filter: drop-shadow(0px 4px 16px rgba(128, 128, 128, 0.76));
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999999 !important;
        }

        .dropdown-links li {
            height: 0.3em;
            width: 95%;
            text-transform: capitalize;
            font-size: 17px;
        }

        .dropdown-links li a{
            color: #ff6600;
        }

        .transaction-details {
            width: 80%;
        }


        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
            height: 140vh;
        }

        .estates {
            padding-top: 6em;
            position: absolute;
            right: 0;

        }

        .profile-container {
            position: absolute;
            left: 10em;
            padding: 0;
            width: 88%;
        }

        .close {
            display: none;
        }



    }









    @media only screen and (max-width: 800px) {
        body {
            height: 90vh;
        }

        .dropdown-links {
            margin-top: 4.7em !important;
            height: 90vh;
            display: flex;
            flex-direction: column;
            gap: 2em;
            transform: translateX(100%);
            transition: all 1s;
            width: 200px;
        }

        .dropdown-links li {
            height: 1em;
            grid-gap: 0;
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
            <div class="menu">
                <img src="images/menu.svg" alt="menu icon" />
            </div>
        </div>
    </header>
    <?php 
             $user = new User;
             $newuser = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
            ?>




    <div class="flex-container">

        <ul class="dropdown-links">
            <li><a href="allestates2.php">Estates</a></li>
            <li><a href="allcustomers.php">All Customers</a></li>
            <li><a href="allagents.php">Agents</a></li>
            <li><a href="allproducts.php">All Products</a></li>
            <li><a href="allexecutives.php">Executives</a></li>
            <li><a href="createexecutive.php">Create Executive</a></li>
            <li><a href="createagent.php">Create Agent</a></li>
            <li><a href="createsubadmin.php">Create Subadmin</a></li>
            <li><a href="selectprice.php">Create Product</a></li>
            <li><a href="#">Pay Earnings</a></li>
            <li><a href="supadmininfo.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>

            <div class="close">
                <i class="ri-close-fill"></i>
            </div>
        </ul>


        <div class="profile-container">
            <div class="profile-info">
                <div class="details">
                    <p>Welcome Back!</p>
                    <h3><?php if(isset($newuser['super_adminname'])){  ?>
                        <span><?php echo $newuser['super_adminname']; ?></span>&nbsp;
                        <?php }?>
                    </h3>
                </div>

                <div class="profile-image">
                    <?php if(!empty($newuser['admin_image'])){?>
                    <img src="profileimage/<?php echo $newuser['admin_image'];?>" alt="profile image" />
                    <?php }?>
                    <?php if(empty($newuser['admin_image'])){?>
                    <div class="empty-img">
                        <i class="ri-user-fill"></i>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="land-btn-container">
                <!-- <a href="allestates.html">
                    <button class="btn land-btn">Buy a new land</button>
                </a> -->
            </div>

            <div class="profile-div-container">
                <div class="profile-div">
                    <img class="profile-icon" src="images/land.svg" alt="land-icon-image" />

                    <a href="allcustomers.php">
                        <div class="navigate">
                            <p>Total Customer Count</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/Wallet.svg" alt="land-icon-image" />

                    <a href="allestates2.php">
                        <div class="navigate">
                            <p>Land</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <a href="#">
                    <div class="profile-div">
                        <img class="profile-icon" src="images/Chart.svg" alt="land-icon-image" />

                        <div class="navigate">
                            <p>Total Payment</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </div>
                </a>

                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="#">
                        <div class="navigate">
                            <p>Payment Count</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="#">
                        <div class="navigate">
                            <p>Total Earning Agents</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="#">
                        <div class="navigate">
                            <p>Total Paid Earning Agents</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="#">
                        <div class="navigate">
                            <p>Total Pending Earning Agents</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="#">
                        <div class="navigate">
                            <p>Total Earning Executives</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="#">
                        <div class="navigate">
                            <p>Total Paid Earning Executives</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="#">
                        <div class="navigate">
                            <p>Total Pending Earning Executives</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="#">
                        <div class="navigate">
                            <p>Transactions</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/paystack.svg" alt="land-icon-image" />

                    <div class="navigate">
                        <div>
                            <p>Make new</p>
                            <p>Payment</p>
                        </div>
                        <img src="images/right_arrow.svg" alt="" />
                    </div>
                </div>
            </div>
        </div>
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


    <script src="js/swiper-bundle.min.js"></script>

    <!--========== SWIPER JS ============  -->
    <script>
    let swiperVerse = new Swiper(".swiper-counter", {
        loop: true,
        spaceBetween: 24,
        slidesPerView: "auto",
        grabCursor: true,
        autoplay: true,
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
            autoplay: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 3,
            },
            1024: {
                spaceBetween: 48,
            },
        },
    });
    if (window.innerWidth < 1300) {
        let dropdownnav = document.querySelector(".dropdown-links");
        // dropdownnav.style.display = "none";


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