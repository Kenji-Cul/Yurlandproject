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

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        min-height: 100vh;
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
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="page-title2">
        <a href="profile.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Account Details</p>
    </div>

    <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>
    <div class="account-detail">
        <?php if(!empty($newuser['photo'])){?>
        <img class="account-img" src="profileimage/<?php echo $newuser['photo'];?>" alt="" />
        <?php }  ?>
        <?php if(empty($newuser['photo'])){?>
        <div class="empty-img">
            <i class="ri-user-fill"></i>
        </div>
        <?php }?>

        <p><?php if(isset($newuser['first_name'])){  ?>
            <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
            <?php }?>
        </p>
        <div class="referral">
            <div><span>copy</span><img src="images/copy.svg" alt="" /></div>
            <div class="referral_code">jghyt7k</div>
        </div>
    </div>

    <div class="details-container">

        <a href="updatedetails.php">
            <div class="account-detail2">
                <div>
                    <p><?php if(isset($newuser['first_name'])){  ?>
                        <?php echo $newuser['first_name']; ?><span>&nbsp;</span><?php echo $newuser['last_name']; ?>
                        <?php }?>
                    </p>
                    <span>Account name</span>
                </div>
                <i class="ri-arrow-right-s-line"></i>
            </div>
        </a>

        <a href="address.php">
            <div class="account-detail2">
                <div>
                    <p><?php if(isset($newuser['home_address']) && !empty($newuser['home_address'])){  
                    echo $newuser['home_address'];
                } else {
                    echo "Home Address";
                 }?>
                    </p>
                    <span>Address</span>
                </div>
                <i class="ri-arrow-right-s-line"></i>
            </div>
        </a>

        <a href="updatenumber.php">
            <div class="account-detail2">
                <div>
                    <p><?php if(isset($newuser['phone_number']) && !empty($newuser['phone_number'])){  
                    echo $newuser['phone_number'];
                } else {
                    echo "Phone Number";
                 }?>
                    </p>
                    <span>Phone number</span>
                </div>
                <i class="ri-arrow-right-s-line"></i>
            </div>
        </a>

        <a href="insertdocument.php">
            <div class="account-detail2">
                <div>
                    <?php if(empty($newuser['driver_license']) || empty($newuser['passport']) || empty($newuser['nin'])){
    ?>
                    <p>Unverified</p>
                    <?php } else {?>
                    <p>Verified</p>
                    <?php }?>
                    <span>Identification</span>
                </div>
                <i class="ri-arrow-right-s-line"></i>
            </div>
        </a>

        <a href="nextofkin.php
        ">
            <div class="account-detail2">
                <div>
                    <p><?php if(isset($newuser['nextofkin_firstname'])  && !empty($newuser['nextofkin_firstname'])){  ?>
                        <?php echo $newuser['nextofkin_firstname']; ?><span>&nbsp;</span><?php echo $newuser['nextofkin_lastname']; ?>
                    </p>
                    <?php } else {?>
                    <p>Next Of Kin</p>
                    <?php }?>
                    <span>Next of Kin</span>
                </div>
                <i class="ri-arrow-right-s-line"></i>
            </div>
        </a>
    </div>
    <script src="js/main.js"></script>
</body>

</html>