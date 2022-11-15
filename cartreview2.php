<?php 
ob_start();
session_start();
include "projectlog.php";
if(!isset($_SESSION['uniqueagent_id'])){
    header("Location: index.php");
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
    body {
        min-height: 50vh;
    }

    .success {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        height: 10em;
    }

    .success img {
        width: 36em;
        height: 36em;
    }


    .page-title2 {
        gap: 1em;
    }

    .subscribed-lands {
        padding-top: 0;
    }

    .subscribed-land {
        height: 28em;
    }

    .no-lands {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: top;
        flex-direction: column;
    }

    .no-lands p {
        font-style: normal;
        font-weight: 600;
        font-size: 24px;
        color: #1a0709;
    }

    .no-lands img {
        margin-top: 8em;
        width: 30em;
        height: 30em;
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
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <!-- <div class="no-lands">
        <img src="images/asset_success.svg" alt="success image" />
        <p>You have not selected any estate yet!!</p>
    </div> -->

    <div class="page-title2">
        <a href="agentprofile.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <div>
            <?php if(!empty($cart)){?>
            <p>Yipee!! You selected the following Estates</p>
            <?php }?>
        </div>
    </div>


    <div class="subscribed-lands">
        <?php 
        $user = new User;
        $cart = $user->selectCartId2($_SESSION['uniqueagent_id']);
       
        foreach ($cart as $key => $value) {
            $land = $user->selectLandImage($value['product_id']);
           
            foreach ($land as  $value){

        ?>
        <div class="subscribed-land">
            <div class="subscribed-img">
                <img src="landimage/<?php echo $value['product_image'];?>" alt="estate image" />
            </div>
            <div class="subscribed-details">
                <div>
                    <p class="land-name"><?php echo $value['product_name'];?></p>
                    <p class="land-location"><?php echo $value['product_location'];?></p>
                </div>
                <a
                    href="agentestateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">
                    <div class="price">Buy</div>
                </a>
            </div>
            <?php 
            $name = $value['unique_id'];
            ?>
            <form action="" class="delete-form" method="POST">
                <input class="price" type="submit" value="Remove From Cart" name="cartdelete<?php echo $name?>"
                    style="background-color: #7e252b; color: #fff;" />

            </form>
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                if(isset($_POST["cartdelete".$name])){
                    $insertuser = $user->DeleteCartId3($value['unique_id'],$_SESSION['uniqueagent_id']);
                        header("Location: cartreview2.php");
                    
                }

                if (isset($name) && is_numeric($name) && isset($name) && isset($_SESSION['cart'][$name])) {
                    // Remove the product from the shopping cart
                    unset($_SESSION['agentcart'][$name]);
                }
                }
              ?>
        </div>

        <?php  
            }} 
        ?>


        <?php if(empty($cart)){?>
        <div class="success">
            <img src="images/asset_success.svg" alt="" />
            <p>There are no items in your cart!</p>
        </div>

        <?php }?>

    </div>



</body>
<?php ob_end_flush();?>

</html>