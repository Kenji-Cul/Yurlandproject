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
         if(!empty($searchLand)){
        ?>
        <div style="display: flex !important; flex-direction: column !important">
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
        <div class="subscribed-land">
            <div class="subscribed-img">
                <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="estate image" />
            </div>

            <div class="subscribed-details">
                <div class="sub-detail">
                    <div>
                        <p class="land-name"><?php echo $value['product_name'];?></p>
                        <p class="land-location"><?php echo $value['product_location'];?></p>
                    </div>
                </div>
                <div class="sub-detail">
                    <?php if($value['outright_price'] != 0){
                      $outprice = $value['outright_price'];
                      $onemonthprice = $value['onemonth_price'];
                        ?>
                    <div class="price-flex">
                        <p class="land-name">Outright Price:</p>
                        <p class="land-location">&#8358;<?php if($outprice > 999 || $outprice > 9999 || $outprice > 99999 || $outprice > 999999 || $outprice > 9999999){
                          echo number_format($outprice);
                        }?></p>
                    </div>
                    <?php } else {?>
                    <p class="land-name">No Outright Price</p>
                    <?php }?>




                </div>
            </div>
        </div>
        <?php }} else {?>
        <div class="success">
            <img src="images/asset_success.svg" alt="" />
            <p>We are sorry but your preferences!</p>
            <p>are unavailable at the moment!</p>
        </div>
        <?php }?>


        <?php if(!empty($searchland)){?>
        <div class="price-container">
            <a href="cartreview.html">
                <div class="price">Continue</div>
            </a>
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