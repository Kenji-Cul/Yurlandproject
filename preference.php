<?php 
if(!isset($_GET['cost']) || !isset($_GET['loc']) || !isset($_GET['pose'])){
    header("Location: index.php");
}





include "projectlog.php";
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
    .page-title3 {
        flex-direction: column;
    }

    .page-title2 img {
        cursor: pointer;
    }

    body {
        position: relative;
        overflow-x: hidden;
        background-image: none;
    }

    .success {
        position: absolute;
        left: 50%;
        top: 40%;
        transform: translate(-50%, -50%);
        height: 10em;
    }

    .success img {
        width: 36em;
        height: 36em;
    }

    .subscribed-land {
        height: 30em;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }

    .estateinfo {
        padding: 0;
    }

    .subscribed-details {
        padding-top: 1em;
    }

    .subscribed-details .sub-detail {
        display: grid;
        gap: 1em;
    }

    .updated-land {
        position: relative;
        width: 400px;
        height: 750px;
        background: #FFFFFF;
        border-radius: 8px;
        filter: drop-shadow(0px 4px 16px rgba(128, 128, 128, 0.76));
        display: flex;
        flex-direction: column;
    }

    .updated-img {
        width: 400px;
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
        .success img {
            width: 20em;
            height: 20em;
        }

        .pref-heading p {
            font-size: 18px;
        }

        .success p {
            text-align: center;
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
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>


    <div class="page-title2">
        <a href="profile.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <?php 
         $user = new User;
         $price = $_GET['cost'];
         $location = $_GET['loc'];
         $purpose = $_GET['pose'];
         $searchland = $user->searchForLand($price,$location,$purpose);
         if(!empty($searchland)){
        ?>
        <div style="display: flex !important; flex-direction: column !important; 
        " class="pref-heading">
            <p>Based on your preferences,</p>
            <p>here are available estates.</p>
        </div>
        <?php }?>
    </div>

    <div class="subscribed-lands">
        <?php 
        $user = new User;
        $price = $_GET['cost'];
        $location = $_GET['loc'];
        $purpose = $_GET['pose'];
        $searchland = $user->searchForLand($price,$location,$purpose);
        if(!empty($searchland)){
            foreach($searchland as $key => $value){
            ?>
        <div class="updated-land">
            <div class="updated-img">
                <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="<?php echo $value['product_name'];?>">
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
                            <?php if(isset($_SESSION['unique_id'])){?>
                            <p><a
                                    href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">click
                                    here to view</a></p>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="detail-three">
                    <img src="images/tag.svg" alt="">
                    <p>&#8358;<?php $unitprice = $value['unit_price'];
                    if( $unitprice > 999 ||  $unitprice > 9999 ||  $unitprice > 99999 ||  $unitprice > 999999 ||  $unitprice > 9999999){
                        echo number_format( $unitprice);
                      }
                    ?> <span>per unit</span></p>
                </div>

                <div class="detail-four">
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
                    <p><span>Daily Price:</span>&#8358;<?php if($onemonthprice > 999 || $onemonthprice > 9999 || $onemonthprice > 99999 || $onemonthprice > 999999){
                          echo number_format($onemonthprice);
                        }?></p>
                    <?php } else {?>
                    <p>No Daily Price</p>
                    <?php }?>
                </div>

                <div class="detail-four">
                    <p>Features</p>
                    <div class="detail">
                        <img src="images/ellipse.svg" alt="">
                        <p><?php echo $value['product_description'];?></p>
                    </div>
                </div>

                <!-- <div class="detail-five">
                    <div class="cartbutton">
                        <img src="images/cart.svg" alt="">
                        <p>Add To Cart</p>
                    </div>
                </div> -->
            </div>
        </div>

        <?php }} else {?>
        <div class="success">
            <img src="images/asset_success.svg" alt="" />
            <p>We are sorry but your preferences</p>
            <p>are unavailable at the moment!</p>
            <div class="price-container">
                <a href="allestates.php">
                    <div class="price">Show me more</div>
                </a>
            </div>
        </div>
        <?php }?>



        <?php if(!empty($searchland)){?>
        <div class="price-container">
            <a href="allestates.php">
                <div class="price">Show me more</div>
            </a>
        </div>
        <?php }?>

        <script src="js/main.js"></script>
        <script>
        // $(document).ready(function() {
        //     $("#cart-form").submit(function(e) {
        //         e.preventDefault();
        //     });


        //     var lands = $(".subscribed-lands");



        //     $("#cart-form .cartbtn").click(function() {
        //         $.ajax({
        //             type: "POST",
        //             url: `inserters/checkproduct.php`,
        //             data: $("#cart-form input"),
        //             success: function(response) {
        //                 if (response) {
        //                     console.log(response);
        //                     // document.location.reload();
        //                 } else {
        //                     console.log(response);
        //                 }
        //             },
        //         });
        //     });
        // });
        </script>
</body>

</html>