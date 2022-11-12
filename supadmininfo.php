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

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        height: 70vh !important;
    }

    section {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    section .error {
        color: #0b9025;
        border: 1px solid#0b9025;
        height: 1em;
        border-radius: 8px;
        margin-bottom: 1.5em;
        width: 80px;
    }

    .copy-div {
        cursor: pointer;
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
        <a href="superadmin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Account Details</p>
    </div>


    <?php 
             $user = new User;
             $newuser = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
            ?>
    <div class="account-detail">
        <?php if(!empty($newuser['admin_image'])){?>
        <img class="account-img" src="profileimage/<?php echo $newuser['admin_image'];?>" alt="" />
        <?php }  ?>
        <?php if(empty($newuser['admin_image'])){?>
        <div class="empty-img">
            <i class="ri-user-fill"></i>
        </div>
        <?php }?>

        <p><?php if(isset($newuser['super_adminname'])){  ?>
            <span><?php echo $newuser['super_adminname']; ?></span>&nbsp;
            <?php }?>
        </p>
    </div>

    <div class="details-container">

        <a href="supadminimg.php">
            <div class="account-detail2">
                <div>
                    <p><?php if(isset($newuser['super_adminname'])){  ?>
                        <?php echo $newuser['super_adminname']; ?><span>&nbsp;
                            <?php }?>
                    </p>

                    <span> <?php if(empty($newuser['admin_image'])){
    ?>
                        <span>Update Your Details</span>
                        <?php } else {?>
                        <span>Verified</span>
                        <?php }?>
                    </span>
                </div>
                <i class="ri-arrow-right-s-line"></i>
            </div>
        </a>





    </div>

</body>

</html>