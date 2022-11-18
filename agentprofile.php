<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['uniqueagent_id'])){
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
    }

    .dropdown-links {
        height: 20em;
    }

    /* .land_estate_container {
        display: flex;
        gap: 2em;
    } */


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
            height: 70vh;
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





    @media only screen and (min-width: 800px) {
        body {
            height: 90vh;
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
            <a href="cartreview2.php">
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
             $newuser = $user->selectAgent($_SESSION['uniqueagent_id']);
            ?>

    <?php if(empty($newuser['home_address'])){
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
            <li><a href="mycustomers.php">Customers</a></li>
            <li><a href="newcustomer.php">New Customer</a></li>
            <li><a href="referral.php">Referrals</a></li>
            <li>
                <a href="agentprofileinfo.php">Profile</a>
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
                    <h3><?php if(isset($newuser['agent_name'])){  ?>
                        <span><?php echo $newuser['agent_name']; ?></span>&nbsp;
                        <?php }?>
                    </h3>
                </div>

                <div class="profile-image">
                    <?php if(!empty($newuser['agent_img'])){?>
                    <img src="profileimage/<?php echo $newuser['agent_img'];?>" alt="profile image" />
                    <?php }?>
                    <?php if(empty($newuser['agent_img'])){?>
                    <div class="empty-img">
                        <i class="ri-user-fill"></i>
                    </div>
                    <?php }?>
                </div>
            </div>


            <div class="profile-div-container">

                <a href="mycustomers.php">
                    <div class="profile-div">
                        <img class="profile-icon" src="images/Wallet.svg" alt="land-icon-image" />

                        <div class="navigate">
                            <p>Customer Count</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </div>
                </a>

                <a href="referral.php">
                    <div class="profile-div">
                        <img class="profile-icon" src="images/Chart.svg" alt="land-icon-image" />

                        <div class="navigate">
                            <p>Referral</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </div>
                </a>




                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="earnings.php">
                        <div class="navigate">
                            <p>Earnings</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>


                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="#">
                        <div class="navigate">
                            <p>Paid Earnings</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
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
    <script src="js/profile.js"></script>
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
        xls.open("GET", "getcart2.php", true);
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