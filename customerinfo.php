<?php 
session_start();
include_once "projectlog.php";


if(!isset($_GET['unique'])){
    header("Location: agentprofile.php");
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

    .center {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2em 0;
    }

    .success {
        position: absolute;
        left: 50%;
        top: 90%;
        transform: translate(-50%, -50%);
        height: 10em;
    }

    .success img {
        width: 36em;
        height: 36em;
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
            <div class="menu">
                <img src="images/menu.svg" alt="menu icon" />
            </div>
        </div>
    </header>

    <?php 
             $user = new User;
             $newuser = $user->selectUser($_GET['unique']);
            ?>

    <div class="profile-info">
        <div class="details">
            <p>Customer Details!</p>
            <h3 style="color: black;"><?php if(isset($newuser['first_name'])){  ?>
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
        <a href="allestates2.php?unique=<?php echo $newuser['unique_id'];?>">
            <button class="btn land-btn">Buy Land For Customer</button>
        </a>
    </div>


    <div class="center">
        <h3 style="text-transform: capitalize;">Customer's Land</h3>
    </div>
    <div class="subscribed-lands">

        <?php 
             $land = new User;
             $landview = $land->selectPayment($_GET['unique']);
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
              
            ?>
        <div class="subscribed-land">
            <div class="subscribed-img">
                <a href="estateinfo.html">
                    <img src="landimage/<?php echo $value['product_image'];?>" alt="estate image" />
                </a>
            </div>
            <div class="subscribed-details">
                <div>
                    <p class="land-name"><?php echo $value['product_name'];?></p>
                    <p class="land-location"><?php echo $value['product_location'];?></p>
                </div>
            </div>
        </div>

        <?php }}?>


    </div>


    <?php if(empty($landview)){?>
    <div class="success">
        <img src="images/asset_success.svg" alt="" />
        <p>This user does not have any land yet!</p>
    </div>

    <?php }?>






</body>

</html>