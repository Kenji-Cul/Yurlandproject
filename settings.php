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

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        min-height: 100vh;
    }

    .account-detail2 {
        position: relative;
    }

    .account-detail2 .flex {
        position: absolute;
        left: 90px;
    }

    .account-detail3 {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 3em;
    }

    .account-detail3 p {
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 22px;
        text-align: center;
        color: #eb5757;
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
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="page-title2">
        <a href="profile.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Settings</p>
    </div>

    <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>

    <div class="details-container">

        <a href="accountdetails.php">
            <div class="account-detail2">
                <div class="radius"></div>
                <div class="flex">
                    <p style="text-transform: capitalize;"><?php if(isset($newuser['first_name'])){  ?>
                        <?php echo $newuser['first_name']; ?>&nbsp;<?php echo $newuser['last_name']; ?>
                        <?php }?>
                    </p>
                    <span>Account Details</span>
                </div>
                <i class="ri-arrow-right-s-line"></i>
            </div>
        </a>

        <div class="account-detail2">
            <div class="radius"></div>
            <div class="flex">
                <p style="text-transform: capitalize">Statements & Reports</p>
                <span>Download monthly statements</span>
            </div>
            <i class="ri-arrow-right-s-line"></i>
        </div>

        <div class="account-detail2">
            <div class="radius"></div>
            <div class="flex">
                <p style="text-transform: capitalize">Get help</p>
                <span>Get support or send feedback</span>
            </div>
            <i class="ri-arrow-right-s-line"></i>
        </div>

        <div class="account-detail2">
            <div class="radius"></div>
            <div class="flex">
                <p style="text-transform: capitalize">Security</p>
                <span>Protect your account</span>
            </div>
            <i class="ri-arrow-right-s-line"></i>
        </div>

        <div class="account-detail3">
            <a href="logout.php">
                <p>Sign Out</p>
            </a>
        </div>
    </div>

    <script src="js/main.js"></script>
</body>

</html>