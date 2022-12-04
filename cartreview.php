<?php 
ob_start();
session_start();
include "projectlog.php";
if(!isset($_SESSION['unique_id'])){
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
        position: relative;
        height: 180vh;
    }

    .footerdiv {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .subscribed-lands {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-around;
        min-height: 30vh;
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

    .updated-land {
        position: relative;
        width: 350px;
        height: 620px;
        background: #FFFFFF;
        border-radius: 8px;
        filter: drop-shadow(0px 4px 16px rgba(128, 128, 128, 0.76));
        display: flex;
        flex-direction: column;
    }

    .updated-img {
        width: 350px;
        height: 341px;
        border-radius: 8px 8px 0px 0px;
    }

    .updated-details {
        display: flex;
        flex-direction: column;
        padding: 1em 1.5em;
    }

    .detail-one,
    .detail-two {
        display: flex;
        flex-direction: column;
    }

    .detail-three {
        display: flex;
        gap: 12px;
        padding-top: 2em;
    }

    .detail-three p {
        color: #808080;
        font-weight: 500;
    }

    .detail-four {
        display: flex;
        flex-direction: column;
        padding-top: 1.5em;
        gap: 0.3em;
    }

    .detail-four p {
        color: #808080;
        font-size: 15px;
    }

    .detail-five {
        display: flex;
        justify-content: right;
        padding-top: 1em;
    }

    .detail-five .cartbutton {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6em;
        width: 160px;
        height: 37.91px;
        color: #7E252B;
        border: 1px solid #7E252B;
        border-radius: 45px;
        cursor: pointer;
    }

    .detail-four .detail {
        display: flex;
        gap: 6px;
    }

    .unit-detail {
        display: flex;
        gap: 10px;
    }

    .unit-detail2 {
        display: flex;
        flex-direction: column;
        gap: 5px;
        padding-top: 1em;
    }

    .detail-name p {
        font-style: normal;
        font-weight: 600;
        font-size: 32px;
        color: #1A0709;
    }

    .detail-location {
        display: flex;
        gap: 15px;
    }

    .detail-location a {
        color: #ff6600;
        text-decoration: underline;
    }

    .detail-btn {
        width: 9em;
        height: 26px;
        background: #7E252B;
        border-radius: 8px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-btn p {
        font-size: 12px;
        text-transform: capitalize;
    }

    .updated-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px 8px 0px 0px;
    }


    @media only screen and (max-width: 500px) {

        .detail-btn p {
            font-size: 9px;
            text-transform: capitalize;
        }

        .updated-land {
            width: 80%;
        }

        .updated-img {
            width: 100%;
        }
    }




    @media only screen and (max-width: 800px) {


        .success {
            position: absolute;
            left: 50%;
            top: 60%;
            transform: translate(-50%, -50%);
            height: 10em;
        }

        .success p {
            text-align: center;
        }


        .success img {
            width: 15em;
            height: 15em;
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
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <!-- <div class="no-lands">
        <img src="images/asset_success.svg" alt="success image" />
        <p>You have not selected any estate yet!!</p>
    </div> -->

    <div class="page-title2">
        <a href="profile.php">
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
        $cart = $user->selectCartId($_SESSION['unique_id']);
       
        foreach ($cart as $key => $value) {
            $land = $user->selectLandImage($value['product_id']);
           
            foreach ($land as  $value){

        ?>

        <div class="updated-land">
            <div class="updated-img">
                <?php if($value['product_unit'] != 0){?>
                <a
                    href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">
                    <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="<?php echo $value['product_name'];?>" />
                </a>
                <?php } else {?>
                <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="<?php echo $value['product_name'];?>" />
                <?php }?>
            </div>
            <div class="updated-details">
                <div class="detail-one">
                    <div class="unit-detail">
                        <div class="detail-btn">
                            <p>Limited Units Available</p>
                        </div>
                        <div class="detail-btn" style="background: #9B51E0;">
                            <p>Half plot per Unit</p>
                        </div>
                    </div>
                </div>
                <div class="detail-two">
                    <div class="unit-detail2">
                        <div class="detail-name">
                            <p><?php echo $value['product_name'];?></p>
                        </div>
                        <div class="detail-location">
                            <p style="color: #808080;"><?php echo $value['product_location'];?></p>
                            <p><a
                                    href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">click
                                    here to view</a></p>
                        </div>
                    </div>
                </div>


                <div class="detail-four">
                    <?php if($value['product_unit'] != 0){?>
                    <?php if($value['outright_price'] != 0){
                     $outprice = $value['outright_price'];
                    $onemonthprice = $value['onemonth_price'];
                        ?>
                    <p><span>Outright Price:&nbsp;&nbsp;</span>&#8358;<?php if($outprice > 999 || $outprice > 9999 || $outprice > 99999 || $outprice > 999999 || $outprice > 9999999){
                          echo number_format($outprice);
                        }?></p>
                    <?php } else {?>
                    <p>No Outright Price</p>
                    <?php }?>
                    <?php if($value['onemonth_price'] != 0){
                        $onemonthprice = $value['onemonth_price'];

                        ?>
                    <p><span>Daily Price:&nbsp;&nbsp;</span>&#8358;<?php if($onemonthprice > 999 || $onemonthprice > 9999 || $onemonthprice > 99999 || $onemonthprice > 999999){
                          echo number_format($onemonthprice);
                        }?></p>

                    <?php } else {?>
                    <p>No Daily Price</p>
                    <?php }} else {?>
                    <p>Sold Out</p>
                    <?php }?>
                </div>



                <?php if($value['product_unit'] != 0){?>
                <div class="detail-five">
                    <div class="cartbutton">
                        <p><a href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej"
                                style="color: #7e252b;">Buy </a></p>
                    </div>
                </div>
                <?php }?>
                <div class="detail-five">

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
$insertuser = $user->DeleteCartId2($value['unique_id'],$_SESSION['unique_id']);
    header("Location: cartreview.php");

}

if (isset($name) && is_numeric($name) && isset($name) && isset($_SESSION['cart'][$name])) {
// Remove the product from the shopping cart
unset($_SESSION['cart'][$name]);
}
}
?>


                </div>
            </div>
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

    <footer class="footerdiv">
        <p>YurLAND &#169; 2022 | All Right Reserved</p>
        <p>A product of Ilu-oba International Limited and Arklips Limited</p>
        <p>Connect with us Facebook, Twitter, Instagram</p>
        <p style="font-size: 30px">
            <i class="ri-instagram-line"></i><i class="ri-facebook-fill"></i><i class="ri-twitter-line"></i>
        </p>
    </footer>



</body>
<?php ob_end_flush();?>

</html>