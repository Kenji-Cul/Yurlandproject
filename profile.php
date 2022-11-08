<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['unique_id'])){
    header("Location:index.html");
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
            <a href="index.html"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
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



    <ul class="dropdown-links">
        <li><a href="newland.html">New Land</a></li>
        <li><a href="transactions.html">Transaction History</a></li>
        <li><a href="mylands.html">My Land</a></li>
        <li><a href="payment.html">New Payment</a></li>
        <li><a href="userreferral.php">Referral</a></li>
        <li><a href="documents.html">Documents</a></li>
        <li>
            <a href="profiledetails.php">Profile</a> and
            <a href="settings.html">Settings</a>
        </li>
        <li><a href="#">Card</a></li>
        <li><a href="logout.php">Logout</a></li>

        <div class="close">
            <i class="ri-close-fill"></i>
        </div>
    </ul>

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
        <a href="allestates.html">
            <button class="btn land-btn">Buy a new land</button>
        </a>
    </div>

    <div class="profile-div-container">
        <div class="profile-div">
            <img class="profile-icon" src="images/land.svg" alt="land-icon-image" />

            <a href="mylands.html">
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

        <a href="payment.html">
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

            <a href="transactions.html">
                <div class="navigate">
                    <p>Transactions</p>
                    <img src="images/right_arrow.svg" alt="" />
                </div>
            </a>
        </div>
    </div>

    <div class="swiper estates swiper-counter">
        <p class="available">Available Estates</p>
        <div class="land_estate_container swiper-wrapper">
            <div class="land-estate swiper-slide">
                <div class="land-image">
                    <a href="estateinfo.html">
                        <img src="images/estate1.jpg" alt="estate image" />
                    </a>
                </div>
                <div class="land-details">
                    <div class="land-name">
                        <p>Isinmi Eko</p>
                    </div>
                    <div class="land-location">
                        <p>Epe,Lagos</p>
                    </div>
                </div>
            </div>

            <div class="land-estate swiper-slide">
                <div class="land-image">
                    <a href="estateinfo.html">
                        <img src="images/estate2.jpg" alt="estate image" />
                    </a>
                </div>
                <div class="land-details">
                    <div class="land-name">
                        <p>Isinmi Eko</p>
                    </div>
                    <div class="land-location">
                        <p>Epe,Lagos</p>
                    </div>
                </div>
            </div>

            <div class="land-estate swiper-slide">
                <div class="land-image">
                    <a href="estateinfo.html">
                        <img src="images/estate3.jpg" alt="estate image" />
                    </a>
                </div>
                <div class="land-details">
                    <div class="land-name">
                        <p>Isinmi Eko</p>
                    </div>
                    <div class="land-location">
                        <p>Epe,Lagos</p>
                    </div>
                </div>
            </div>

            <div class="land-estate swiper-slide">
                <div class="land-image">
                    <a href="estateinfo.html">
                        <img src="images/estate4.jpg" alt="estate image" />
                    </a>
                </div>
                <div class="land-details">
                    <div class="land-name">
                        <p>Isinmi Eko</p>
                    </div>
                    <div class="land-location">
                        <p>Epe,Lagos</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <div class="foot">
        <div class="profile-div">
            <img class="profile-icon" src="images/paypal.svg" alt="land-icon-image" />

            <div class="navigate">
                <div>
                    <p>Make new</p>
                    <p>Payment</p>
                </div>
                <img src="images/right_arrow.svg" alt="" />
            </div>
        </div>
    </div>

    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/profile.js"></script>
    <!--========== SWIPER JS ============  -->
    <script>
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
    </script>
</body>

</html>