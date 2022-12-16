<?php 
session_start();
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
        height: 80vh !important;
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
        </div>

        <div class="nav">
            <img src="images/cart.svg" alt="cart icon" />
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="success">
        <img src="images/asset_success.svg" alt="" />
        <?php if(isset($_GET['error'])){?>
        <p><?php echo $_GET['error'];?></p>
        <?php }?>
        <?php if(isset($_GET['message'])){?>
        <p>Please complete your land payment</p>
        <?php }?>
        <?php if(isset($_SESSION['unique_id'])){
            if(isset($_GET['message'])){
            ?>
        <a href="mylands.php"><button class="landing_page_button2">Make Payment</button></a>
        <?php } else { ?>

        <a href="profile.php"><button class="landing_page_button2">Back to Dashboard</button></a>

        <?php   }}?>
        <?php if(isset($_SESSION['uniqueagent_id'])){?>
        <a href="agentprofile.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <a href="subadmin.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
    </div>

    <script src="js/main.js"></script>
</body>

</html>