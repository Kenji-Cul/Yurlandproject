<?php 
if(!isset($_GET['id'])){
    header("Location: index.php");
}
session_start();
include "projectlog.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        min-height: 100vh;
        position: relative;
    }


    header {
        background: #fee1e3;
    }

    @media only screen and (max-width: 1300px) {

        .success p {
            font-size: 15px;
        }

        .success .estate_page_button {
            width: 200px;
        }

        .user,
        #openicon {
            display: none;
        }

        .menu {
            display: none;
        }

        .links img {
            display: none;
        }

        .detail3 {
            display: none;
        }

        .dropdown-links {
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
            transform: translateX(100%);
            transition: all 1s;
            width: 40%;
            position: fixed;
            bottom: 0;
            border-radius: 8px 0px 0px 8px;
        }

        .dropdown-links li {
            height: 1em;
            grid-gap: 0;
        }
    }

    @media only screen and (min-width: 1300px) {
        .page-title2 a {
            display: none;
        }

        .page-title2 {
            justify-content: left;
        }

        .page-title2 p {
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            color: #1A0709;
        }

        .center {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .menu {
            display: none;
        }

        .profile-image2 {
            display: none !important;
        }

        .user {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1em;
        }

        .user p {
            font-weight: 600;
            font-size: 20px;
            color: #1A0709;
        }

        .user .profile-image {
            width: 45px;
            height: 45px;
        }



        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
        }

        .details2 {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6em;
        }

        .details2 p {
            color: #808080;
        }

        .details2 p,
        .details2 h3 {
            font-size: 22px;
        }

        .land-btn-container {
            padding-left: 1em;
        }

        .land-btn-container .btn {
            width: 500px;
        }

        .menu {
            display: none;
        }

        .estate2 {
            display: block !important;
        }

        .land-estate {
            background: #FFFFFF;
            border-radius: 8px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            width: 290px;
            height: 270px;
            padding-top: 0;
            padding-bottom: 10px;
            display: flex;
            justify-content: top;
            align-items: center;
            gap: 1em;
            flex-direction: column;
            border-radius: 8px;
            margin-bottom: 1.6em;
        }

        .dropdown-links {
            width: 6%;
            height: 90vh;
            border-radius: 0px !important;
            padding: 1em 0;
            display: flex;
            flex-direction: column;
            justify-content: top;
            align-items: top;
            gap: 1.3em;
            background: #7e252b;
            filter: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999999 !important;
            transition: all 0.7s;
        }

        .dropdown-links li {
            height: 1em;
            width: 95%;
            text-transform: capitalize;
            font-size: 14px;
        }

        .dropdown-links .select-link {
            background-color: #1a0709;
        }

        .dropdown-links .links {
            width: 100%;
            display: flex !important;
            align-items: center;
            justify-content: center;
            padding: 1em 0;
            transition: 1s;
        }

        .dropdown-links .links:hover {
            background-color: #1a0709;
        }

        .dropdown-links .links img {
            width: 20px;
            height: 20px;
            margin-right: 6px;
            cursor: pointer;
        }

        .dropdown-links .links .link {
            visibility: hidden;
            display: none;
        }


        .dropdown-links li a {
            color: #fff;

        }

        .transaction-details {
            width: 80%;
            transition: all 1.5s;
        }


        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
        }

        .trans-container {
            width: 90%;
            padding-left: 5em;
        }


        .close {
            display: none;
        }


    }



    .detail-four {
        display: flex;
        flex-direction: column;
        gap: 0.3em;
        margin-top: -2em;
        margin-bottom: 1em;
    }

    .detail {
        display: flex;
        flex-direction: row;
        gap: 0.8em;
    }

    .detail-four p {
        color: #1a0709;
        font-size: 17px;
    }

    .cart-info {
        display: flex;
        align-items: center;
        justify-content: left;
        width: 90%;
        padding-left: 1.5em;
    }

    .cartbutton {
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

    #manualform {
        display: flex;
        justify-content: left;
        flex-direction: column;
        position: absolute;
        left: 2em;
        width: 80%;
    }

    .success {
        height: 4em;
        width: 70%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }




    .second-section {
        padding-left: 4em;
    }


    #intervalform2 {
        width: 50%
    }

    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
        margin-bottom: 3em;
    }

    .land-info {
        justify-content: center;
        gap: 2em;
    }

    .cart-info {
        justify-content: center;
    }






    .error,
    .error2 {
        width: 60%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Space Grotesk";
        font-style: normal;
        font-weight: 600;
        font-size: 18px;
        line-height: 31px;
        text-align: center;
        color: #e11900;
        border: 1px solid #e11900;
        width: 30%;
        padding: 10px 10px;
        background-color: #e1dede;
        visibility: hidden;
    }

    @media only screen and (max-width: 800px) {
        .second-section {
            padding-left: 1em;
        }

        .error,
        .error2 {
            width: 80%;
            height: 1.4em;
            margin-bottom: 1em;
        }

        #unit,
        #newpay {
            width: 18em;

        }

        .estate_page_button {
            margin-top: 2em;
        }

        #manualform input {
            width: 18em;
            position: absolute;
            left: -3em;
        }

        #manualform .error2 {
            margin-top: 4em;
        }

        .land-info {
            flex-direction: column;
            gap: 2em;
        }

        #intervalform2 {
            width: 90%
        }

    }

    @media only screen and (max-width: 1300px) {
        .footerdiv {
            display: none;
        }
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <?php if(isset($_SESSION['unique_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['unique_id'])){?>
            <a href="profile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>

        <?php if(isset($_SESSION['uniqueagent_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <a href="agentprofile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>

        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
            <a href="subadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>

        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>

        <?php 
             $user = new User;
             if(isset($_SESSION['unique_id'])){
             $newuser = $user->selectUser($_SESSION['unique_id']);
             }
             if(isset($_SESSION['uniqueagent_id'])){
             $newuser = $user->selectAgent($_SESSION['uniqueagent_id']);
             }
             if(isset($_SESSION['uniquesubadmin_id'])){
                $newuser = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
                }

                if(isset($_SESSION['uniquesupadmin_id'])){
                    $newuser = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
                    }
            ?>
        <div class="nav">
            <?php if(!isset($_SESSION['uniqueagent_id']) || !isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
            <a href="cartreview.php">
                <div class="cart">
                    <div class="cart-notify"></div>
                    <img src="images/cart.svg" alt="cart icon" />
                </div>
            </a>
            <?php }?>
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <?php if(isset($_SESSION['unique_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['photo'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>
            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['agent_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['agent_img'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['agent_img'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['agent_img'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>
            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['subadmin_name'])){  ?>
                    <span><?php echo $newuser['subadmin_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['subadmin_image'])){?>
                    <a href="subadmininfo.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['subadmin_image'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['subadmin_image'])){?>
                    <a href="agentimg.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>

            <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['super_adminname'])){  ?>
                    <span><?php echo $newuser['super_adminname']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['admin_image'])){?>
                    <a href="supadmininfo.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['admin_image'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['admin_image'])){?>
                    <a href="supadmininfo.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>
        </div>
    </header>



    <?php 
    $land = new User;
    $landview = $land->selectLandImage($_GET['id']);
    if(!empty($landview)){
        foreach($landview as $key => $value){ 
    ?>

    <div class="red-div">
        <div class="img-info">
            <img class="main-img" src="landimage/<?php if(isset($value['product_image'])){
                echo $value['product_image'];
            }?>" alt="" />

            <div class="info-details">
                <div class="info1">
                    <img src="landimage/<?php if(isset($value['product_image'])){
                echo $value['image_one'];
            }?>" alt="" />
                </div>
                <div class="info2">
                    <img src="landimage/<?php if(isset($value['product_image'])){
                echo $value['product_image'];
            }?>" alt="" />
                </div>
            </div>
        </div>
    </div>

    <div class="land-info">
        <div>
            <p class="location"><?php echo $value['product_name'];?></p>
            <p><?php echo $value['product_location'];?></p>
        </div>
        <?php
        if($value['onemonth_price'] != 0  && $value['outright_price'] !=0){ ?>
        <div class="unit-price" style="display:flex; flex-direction: column; gap: 1em;"><span>
                Outright:&nbsp;&nbsp;&#8358;<?php
        $unitprice = $value['outright_price'];
        if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                          echo number_format($unitprice);
                        }?> per unit
            </span><span>
                Subscription:&nbsp;&nbsp;&#8358;<?php
       $overallprice = $value['eighteen_percent'] / 100 * $value['onemonth_price'];
            $unitprice = $overallprice + $value['onemonth_price'];
        if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                          echo number_format($unitprice);
                        }?> per unit for 18 months
            </span>
        </div>
        <?php } else {?>
        <div class="unit-price">&#8358;<?php
        if($value['onemonth_price'] != 0){
            $overallprice = $value['eighteen_percent'] / 100 * $value['onemonth_price'];
            $unitprice = $overallprice + $value['onemonth_price'];
            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                echo number_format($unitprice)." per unit for 18 months";
              }
        } else {
       $unitprice = $value['outright_price'];
        if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
            echo number_format($unitprice)." per unit";
          }
        }
        ?></div>

        <?php }?>
    </div>

    <?php 
   
    if(!isset($_GET['remprice'])){
        if($value['product_unit'] != 0){
        ?>
    <div class="cart-info">
        <form action="" id="cartform<?php echo $value['unique_id'];?>">
            <?php 
            if(isset($_SESSION['unique_id'])){
                $cart = $land->checkCartId($_SESSION['unique_id'],$value['unique_id']);
            }
            if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){
                $cart = $land->checkCartId($_GET['unique'],$value['unique_id']);
            }
                   
                    if(empty($cart)){
                    ?>
            <div class="cartbutton" id="cart-btn<?php echo $value['unique_id'];?>">
                <img src="images/cart.svg" alt="">
                <p>Add To Cart</p>
            </div>

            <div id="otherbtn<?php echo $value['unique_id'];?>" class="cartbutton" style="visibility:hidden;"> <a
                    href="cartreview.php" style="color: #7e252b;">View In Cart </a>
            </div>
            <?php } else {?>
            <div class="cartbutton" id="cart-btn<?php echo $value['unique_id'];?>" style="visibility:hidden;">
                <img src="images/cart.svg" alt="">
                <p>Add To Cart</p>
            </div>
            <div id="otherbtn<?php echo $value['unique_id'];?>" class="cartbutton"> <a href="cartreview.php"
                    style="color: #7e252b;">View In Cart </a>
            </div>
            <?php }?>


            <input type="hidden" name="productid" value="<?php echo $value['unique_id']?>">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="user" value="<?php 
            if(isset($_SESSION['unique_id'])){ echo $_SESSION['unique_id'];}
            if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){ echo $_GET['unique'];}
            ?>">
        </form>

        <script>
        let unique<?php echo $value['unique_id']?> = document.querySelector(
            `.uni<?php echo $value['unique_id'];?>`);

        const intervalform<?php echo $value['unique_id'];?> = document.querySelector(
            `#cartform<?php echo $value['unique_id'];?>`);
        const paybtn<?php echo $value['unique_id'];?> = document.querySelector(
            `#cart-btn<?php echo $value['unique_id'];?>`);


        intervalform<?php echo $value['unique_id'];?>.onsubmit = (e) => {
            e.preventDefault();
        }





        function addToCart<?php echo $value['unique_id'];?>() {
            let xhr = new XMLHttpRequest(); //creating XML Object
            xhr.open("POST", "inserters/checkproduct.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if (data) {
                            document.querySelector(`#cart-btn<?php echo $value['unique_id'];?>`).style.display =
                                "none";
                            document.querySelector(`#otherbtn<?php echo $value['unique_id'];?>`).style
                                .visibility =
                                "visible";
                        } else {
                            //console.log(data);
                        }

                    }
                }
            }
            // we have to send the information through ajax to php
            let formData = new FormData(
                intervalform<?php echo $value['unique_id'];?>); //creating new formData Object

            xhr.send(formData); //sending the form data to php
        }

        paybtn<?php echo $value['unique_id'];?>.onclick = () => {
            addToCart<?php echo $value['unique_id'];?>();
        }
        </script>
    </div>
    <?php } else {?>
    <div class="cart-info">
        <div class="cartbutton">Sold Out</div>
    </div>
    <?php }}?>

    <div class="land-desc">
        <?php echo $value['product_description'];?>
    </div>

    <input type="hidden" name="" id="unitnum" value=<?php echo $value['product_unit'];?>>
    <?php 
    if(isset($_GET['remprice'])){
        if(isset($_SESSION['unique_id'])){
        $landuse = $land->selectProductPayment($value['unique_id'],$_SESSION['unique_id']);
        }

        if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){
            $landuse = $land->selectProductPayment($value['unique_id'],$_GET['unique']);
            }
        if(!empty($landuse)){
            foreach($landuse as $key => $value){ ?>

    <input type="hidden" name="" id="remunit" value=<?php echo $value['product_unit'];?>>
    <input type="hidden" name="" id="periodunit" value=<?php echo $value['period_num'];?>>


    <input type="hidden" placeholder="Input the price you want to pay" id="newpay" name="newpay" value="<?php 
 echo $value['product_price']
 ?>" />
    <?php
            }
    }}
    
    ?>



    <?php }}?>



    <?php if($value['product_unit'] != 0){?>
    <div class="first-section">
        <div class="units">
            <p class="h1">How many units are you buying?</p>
            <div class="measure">
                <p>1 unit</p>
                <p class="line"></p>
                <p>half plot</p>
            </div>
        </div>


        <form action="" id="unit-form">
            <div class="estateinfo">
                <div class="input-div">
                    <input type="number" placeholder="Input number of units and click outside the box when done"
                        id="unit" name="unit" />
                </div>
            </div>
            <p class="error">Please fill </p>

            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </div>
    <?php }?>

    <div class="thirdsection" style="display: none;">

        <div class="cost" style="margin-bottom: 2em; margin-left: 2em;">
            <input type="hidden" name="tot" value="<?php if(isset($_GET['remprice'])){
                echo $_GET['remprice'];
            }?>" id="tot">
            <?php if(isset($_GET['remprice'])){?>
            <p>Remaining Price:&nbsp;&nbsp;&nbsp;&#8358;<span id="numformat"></span></p>

            <?php }else {?>

            <p>Total Cost:&nbsp;&nbsp;&nbsp;&#8358;<span id="numformat"></span></p>

            <?php }?>
        </div>
        <form action="" id="newpaymentform">
            <div class="estateinfo">
                <div class="input-div">

                    <?php
           if(isset($_SESSION['unique_id'])){
             $landuse = $land->selectProductNewPayment($_GET['id'],$_SESSION['unique_id']);
           }

           if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){
            $landuse = $land->selectProductNewPayment($_GET['id'],$_GET['unique']);
          }

           
             if(!empty($landuse)){
                 foreach($landuse as $key => $value){ ?>
                    <input type="hidden" name="" id="realprice" value=<?php echo $value['sub_price'];?>>
                    <input type="hidden" name="" id="realperiod" value=<?php echo $value['period_num'];?>>
                    <input type="hidden" name="" id="realbalance" value=<?php echo $value['balance'];?>>
                    <input type="hidden" name="" id="realdate" value=<?php echo $value['sub_period'];?>>
                    <p style="color: #808080; font-weight: bold; width: 20em;">End
                        Date:&nbsp;&nbsp;&nbsp;<span id="subformat"><?php echo $value['sub_period'];?></span></p>
                    <p style="color: #808080; font-weight: bold; width: 20em;">Remaining Days:&nbsp;&nbsp;&nbsp;<span
                            id="subformat"><?php echo $value['period_num'];?></span></p>
                    <?php }}?>

                    <input type="number" style="margin-top: 2em;" placeholder="Input number of days" id="period"
                        name="period" />

                </div>
            </div>

            <p class="error2">Please fill </p>
            <div class="btn-container">
                <button class="estate_page_button" type="submit">Continue</p></button>
            </div>

            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
                <span class="span">Continue</span>
            </div>
        </form>
    </div>



    <div class="success" style="display:none; padding-left: 4em;">
        <p>Available Units Exceeded</p>
        <p>Try a lower amount!</p>
        <button class="estate_page_button" type="submit" id="goback">Go Back</button>
    </div>


    <div class="fifthsection">
        <div class="payment-mode" style="display:none; margin-top: 3em; padding-left: 3em;">
            <form action="" id="intervalform">
                <div class="select-box">
                    <div class="options-container">
                        <div class="option">
                            <input type="radio" class="radio" id="onemonth" name="mode" value="onemonth" />
                            <label for="onemonth">One Month</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="threemonth" name="mode" value="threemonths" />
                            <label for="threemonth">Three Months</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="sixmonth" name="mode" value="sixmonths" />
                            <label for="sixmonth">Six Months</label>
                        </div>


                        <div class="option">
                            <input type="radio" class="radio" id="twelvemonth" name="mode" value="twelvemonths" />
                            <label for="twelvemonth">Twelve Months</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="eighteenmonth" name="mode" value="eighteenmonths" />
                            <label for="eighteenmonth">Eighteen Months</label>
                        </div>
                    </div>
                    <div class="selected">Payment Plan</div>
                </div>


                <div class="detail-four" style="visibility: hidden;">
                    <span id="data" style="visibility: hidden;"></span>
                    <span id="data2" style="display: none;"></span>
                    <div class="detail">
                        <img src="images/ellipse.svg" alt="">
                        <p>Total Price: &#8358;<span id="pricetot"></span></p>
                    </div>
                    <div class="detail">
                        <img src="images/ellipse.svg" alt="">
                        <p>Daily Price: &#8358;<span id="pricedaily"></span></p>
                    </div>
                </div>

                <div class="btn-container">
                    <button class="estate_page_button subbutton" type="submit">Continue</button>
                </div>

            </form>


        </div>
    </div>



    <div class="second-section" style="display:none;">

        <?php 
        foreach($landview as $key => $value){
           
        ?>
        <div class="cost" style="margin-bottom: 2em;">
            <input type="hidden" name="tot" value="" id="tot">
            <?php if($value['onemonth_price'] !=0 && $value['outright_price'] != 0){?>
            <p></p>
            <?php } else {?>
            <p>Total Cost:&nbsp;&nbsp;&nbsp;&#8358;<span id="numformat"></span></p>
            <?php }?>
        </div>


        <?php if(($value['outright_price'] != 0) && $value['onemonth_price'] == 0 ){?>
        <div action="" id="outrightform">
            <div class="btn-container">
                <button class="estate_page_button" type="submit">Continue</button>
            </div>
        </div>
        <?php } else if(($value['onemonth_price'] != 0) && $value['outright_price'] == 0){?>




        <div class="fourthsection">
            <form action="" id="submethod-form">
                <div class="payment-plan">
                    <p>Payment Type</p>
                    <label class="radio" for="autodebit">
                        <input type="radio" name="submethod" id="autodebit" value="autodebit" />
                        <span></span>
                        <p>Auto debit</p>
                    </label>
                    <label class="radio" fo="manually">
                        <input type="radio" name="submethod" id="manually" value="manually" />
                        <span></span>
                        <p>Manual</p>
                    </label>
                </div>


                <div class="btn-container">
                    <button class="estate_page_button" type="submit">Continue</button>
                </div>
            </form>

            <div class="manual-mode" style="display:none;">
                <form id="manualform">

                    <p class="error2">Please fill</p>

                    <div style="display: none">
                        <img src="images/loading.svg" alt="" class="loading-img" />
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button" type="submit">Continue</button>
                    </div>
                </form>
            </div>



            <div class="payment-mode" style="display:none; margin-top: 3em;">
                <form action="" id="intervalform">
                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="onemonth" name="mode" value="onemonth" />
                                <label for="onemonth">One Month</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="threemonth" name="mode" value="threemonths" />
                                <label for="threemonth">Three Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="sixmonth" name="mode" value="sixmonths" />
                                <label for="sixmonth">Six Months</label>
                            </div>


                            <div class="option">
                                <input type="radio" class="radio" id="twelvemonth" name="mode" value="twelvemonths" />
                                <label for="twelvemonth">Twelve Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="eighteenmonth" name="mode"
                                    value="eighteenmonths" />
                                <label for="eighteenmonth">Eighteen Months</label>
                            </div>
                        </div>
                        <div class="selected">Payment Plan</div>
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button subbutton" type="submit">Subscribe</button>
                    </div>

                </form>
            </div>


            <div class="payment-mode2" style="display:none; margin-top: 3em;">
                <form action="" id="intervalform2">
                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="onemonth" name="mode" value="onemonth" />
                                <label for="onemonth">One Month</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="threemonth" name="mode" value="threemonths" />
                                <label for="threemonth">Three Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="sixmonth" name="mode" value="sixmonths" />
                                <label for="sixmonth">Six Months</label>
                            </div>


                            <div class="option">
                                <input type="radio" class="radio" id="twelvemonth" name="mode" value="twelvemonths" />
                                <label for="twelvemonth">Twelve Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="eighteenmonth" name="mode"
                                    value="eighteenmonths" />
                                <label for="eighteenmonth">Eighteen Months</label>
                            </div>
                        </div>
                        <div class="selected">Payment Plan</div>
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button subbutton2" type="submit">Subscribe</button>
                    </div>

                </form>
            </div>
        </div>

        <?php }?>



        <?php if($value['onemonth_price'] != 0 && $value['outright_price'] != 0){?>
        <form action="" id="paymentplanform">
            <div class="payment-plan">
                <p>Choose payment plan</p>
                <label class="radio" for="outright">
                    <input type="radio" name="payment" id="outright" value="outright payment" />
                    <span></span>
                    <p>Outright payment</p>
                </label>

                <label class="radio" fo="sub">
                    <input type="radio" name="payment" id="sub" value="subscription payment" />
                    <span></span>
                    <p>Payflex</p>
                </label>
            </div>




            <div class="btn-container">
                <button class="estate_page_button" type="submit">Continue</button>
            </div>

        </form>





        <div class="fourthsection" style="display: none;">
            <form action="" id="submethod-form">
                <div class="payment-plan">
                    <p>Payment Type</p>
                    <label class="radio" for="autodebit">
                        <input type="radio" name="submethod" id="autodebit" value="autodebit" />
                        <span></span>
                        <p>Auto debit</p>
                    </label>
                    <label class="radio" fo="manually">
                        <input type="radio" name="submethod" id="manually" value="manually" />
                        <span></span>
                        <p>Manual</p>
                    </label>
                </div>


                <div class="btn-container">
                    <button class="estate_page_button" type="submit">Continue</button>
                </div>
            </form>

            <div class="manual-mode" style="display:none;">
                <form id="manualform">

                    <p class="error2">Please fill</p>

                    <div style="display: none">
                        <img src="images/loading.svg" alt="" class="loading-img" />
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button" type="submit">Continue</button>
                    </div>
                </form>
            </div>



            <div class="payment-mode" style="display:none; margin-top: 3em;">
                <form action="" id="intervalform">
                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="onemonth" name="mode" value="onemonth" />
                                <label for="onemonth">One Month</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="threemonth" name="mode" value="threemonths" />
                                <label for="threemonth">Three Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="sixmonth" name="mode" value="sixmonths" />
                                <label for="sixmonth">Six Months</label>
                            </div>


                            <div class="option">
                                <input type="radio" class="radio" id="twelvemonth" name="mode" value="twelvemonths" />
                                <label for="twelvemonth">Twelve Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="eighteenmonth" name="mode"
                                    value="eighteenmonths" />
                                <label for="eighteenmonth">Eighteen Months</label>
                            </div>
                        </div>
                        <div class="selected">Payment Plan</div>
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button subbutton" type="submit">Subscribe</button>
                    </div>

                </form>
            </div>


            <div class="payment-mode2" style="display:none; margin-top: 3em;">
                <form action="" id="intervalform2">
                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="onemonth" name="mode" value="onemonth" />
                                <label for="onemonth">One Month</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="threemonth" name="mode" value="threemonths" />
                                <label for="threemonth">Three Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="sixmonth" name="mode" value="sixmonths" />
                                <label for="sixmonth">Six Months</label>
                            </div>


                            <div class="option">
                                <input type="radio" class="radio" id="twelvemonth" name="mode" value="twelvemonths" />
                                <label for="twelvemonth">Twelve Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="eighteenmonth" name="mode"
                                    value="eighteenmonths" />
                                <label for="eighteenmonth">Eighteen Months</label>
                            </div>
                        </div>
                        <div class="selected">Payment Plan</div>
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button subbutton2" type="submit">Subscribe</button>
                    </div>

                </form>
            </div>


        </div>
        <?php }?>
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
    <script src="js/main.js"></script>
    <script>
    var targetImg = document.querySelector(".main-img");
    var clickedImg = document.querySelectorAll(".info-details img");
    clickedImg.forEach((element) => {
        element.onclick = () => {
            var src = element.src;
            var targetsrc = src.substr(25, src.length);
            targetImg.src = targetsrc;
            clickedImg[0].style.border = "1px solid white";
            clickedImg[1].style.border = "1px solid white";
            element.style.border = "none";
        };
    });
    </script>
    <script>
    let form = document.querySelector("#unit-form");
    let error = document.querySelector(".error");

    let unitInput = document.querySelector("#unit")









    form.onsubmit = (e) => {
        e.preventDefault();
    };



    const params = new URLSearchParams(window.location.search)
    const unique = params.get('id')




    let form1 = document.querySelector('.first-section');
    let form2 = document.querySelector('.second-section');
    let form3 = document.querySelector('.thirdsection');
    let form4 = document.querySelector('.fourthsection');
    let form5 = document.querySelector('.fifthsection');
    let totalInput = document.querySelector('#tot');
    let unitNum = document.querySelector("#unitnum")
    let Successdiv = document.querySelector(".success")
    let formatnum = document.querySelector('#numformat')
    let goback = document.querySelector('#goback');



    function submitUnits() {

        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", `inserters/calcunit.php?uniqueid=${unique}`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    let string = "success";
                    let realprice = data.replace('success', '')
                    if (data.includes(string)) {
                        let price = unitInput.value * realprice;
                        if (params.get('payment')) {
                            form1.style.display = "none";
                            form3.style.display = "block";
                        } else {
                            form1.style.display = "none";
                            form2.style.display = "block";
                        }
                        let first = parseInt(unitInput.value);
                        let second = parseInt(unitNum.value);
                        if (first > second) {
                            Successdiv.style.display = "flex";
                            form2.innerHTML = "";
                            if (params.get('payment')) {
                                form3.innerHTML = Successdiv;
                            }

                            goback.onclick = () => {
                                location.reload();
                            }

                        }
                        totalInput.value = price;
                        if (params.get('payment')) {
                            let formatnum = document.querySelector('.thirdsection #numformat')
                            formatnum.innerHTML = new Intl.NumberFormat().format(price);
                        } else {
                            <?php if($value['onemonth_price'] != 0 && $value['outright_price'] != 0){?>

                            <?php }else {?>
                            let formatnum = document.querySelector('.second-section #numformat')
                            formatnum.innerHTML = new Intl.NumberFormat().format(price);
                            <?php }?>
                        }

                        // location.href =
                        //     `summarypage.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${price}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9938484747`;
                    } else {
                        error.textContent = data;
                        error.style.visibility = "visible";
                        formbtn.textContent = "Continue";
                    }
                    // if (data) {
                    //     console.log(data);

                    // } else {
                    //     
                    // }
                }
            }
        };
        // we have to send the information through ajax to php
        let formData = new FormData(form); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    unitInput.onblur = () => {
        submitUnits();
    };



    if (params.get('remprice')) {
        form1.style.display = "none";
        form3.style.display = "block";
        formatnum.innerHTML = new Intl.NumberFormat().format(params.get('remprice'));
    }

    if (params.get('payment') && params.get('remprice')) {
        // document.querySelector('.manual-mode').style.display = "block";
        // const manualform = document.querySelector('#manualform');
        // const manualbtn = document.querySelector('#manualform .estate_page_button');
        // manualform.onsubmit = (e) => {
        //     e.preventDefault();
        // }

        // function checkNoOfDays() {
        //     let manualInput = document.querySelector('#period');
        //     let manualNum = parseInt(manualInput.value);
        //     if (manualNum > 540) {
        //         let manualerror = document.querySelector('#manualform .error2');
        //         manualerror.textContent = "Limit Reached";
        //         manualerror.style.visibility = "visible";

        //     } else {
        //         let pricevalue = totalInput.value / manualInput.value;
        //         var periodtime = manualInput.value * 86400000;
        //         var date = new Date().getTime() + periodtime;
        //         let endDate = new Date(date).toDateString();
        //         location.href =
        //             `newpayment.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&newpay=${pricevalue}&period=${endDate}&subperiod=${manualInput.value}`;
        //     }
        // }

        // manualbtn.onclick = () => {
        //     checkNoOfDays();
        // }

        let payInput = document.querySelector("#newpay")
        let remInput = document.querySelector("#remunit")
        const newpayform = document.querySelector('#newpaymentform');
        const newpaybtn = document.querySelector('#newpaymentform .estate_page_button');

        newpayform.onsubmit = (e) => {
            e.preventDefault();
        }




        function checkNewPayment() {
            let error2 = document.querySelector(".error2");

            let periodInput = document.querySelector('#periodunit');
            let manualInput = document.querySelector('#newpaymentform #period');
            let manualNum = parseInt(manualInput.value);
            <?php 
                
                ?>
            let periodNum = document.querySelector('#realperiod');
            let balanceNum = document.querySelector('#realbalance');
            let amountNum = document.querySelector('#realprice');
            let dateNum = document.querySelector('#realdate');
            let periodValue = parseInt(periodNum.value);
            let balanceValue = parseInt(balanceNum.value);

            let manualerror = document.querySelector('#newpaymentform .error2');
            let pricevalue = amountNum.value * manualInput.value;

            let endDate = dateNum.value;


            if (manualNum > periodValue) {
                manualerror.textContent = "Limit Reached";
                manualerror.style.visibility = "visible";
            } else if (manualInput.value === "") {
                manualerror.textContent = "Please fill in your data";
                manualerror.style.visibility = "visible";
            } else {
                <?php if(isset($_SESSION['unique_id'])){?>
                location.href =
                    `newpayment.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&remunit=${remInput.value}&unit=${remInput.value}&con=9298383737&remprice=payment&period=${endDate}&newpay=${pricevalue}&subperiod=${manualInput.value}`;
                <?php }?>

                <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                location.href =
                    `newpayment2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&remunit=${remInput.value}&unit=${remInput.value}&con=9298383737&remprice=payment&period=${endDate}&newpay=${pricevalue}&subperiod=${manualInput.value}&user=<?php echo $_GET['unique'];?>`;
                <?php }?>


            }

            if ((periodValue == 0) && (balanceValue != 0)) {
                manualerror.style.visibility = "hidden";
                <?php if(isset($_SESSION['unique_id'])){?>
                location.href =
                    `newpayment.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&remunit=${remInput.value}&unit=${remInput.value}&con=9298383737&remprice=payment&period=${endDate}&newpay=${balanceValue}&subperiod=0`;
                <?php }?>

                <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                location.href =
                    `newpayment2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&remunit=${remInput.value}&unit=${remInput.value}&con=9298383737&remprice=payment&period=${endDate}&newpay=${balanceValue}&subperiod=0&user=<?php echo $_GET['unique'];?>`;
                <?php }?>

            }





            //sending the form data to php



        }

        newpaybtn.onclick = () => {
            checkNewPayment();
        }
    }


    <?php if(($value['outright_price'] != 0) && $value['onemonth_price'] == 0 ){?>

    const paybtn = document.querySelector('#outrightform .estate_page_button');




    function checkOutrightMode() {

        <?php if(isset($_SESSION['unique_id'])){?>
        let startDate = new Date().toDateString();
        location.href =
            `outrightpayment.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9298383737&startdate=${startDate}`;
        <?php }?>
        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
        location.href =
            `outrightpayment2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique'];?>`;
        <?php }?>
    }



    paybtn.onclick = () => {
        checkOutrightMode();
    }

    <?php }?>



    <?php if($value['onemonth_price'] != 0 && $value['outright_price'] != 0){?>
    const planform = document.querySelector('#paymentplanform');
    const paybtn = document.querySelector('#paymentplanform .estate_page_button');
    planform.onsubmit = (e) => {
        e.preventDefault();
    }



    function checkPaymentMode() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getplan.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "outright payment") {
                        <?php if(isset($_SESSION['unique_id'])){?>
                        let startDate = new Date().toDateString();
                        let totprice = <?php foreach($landview as $key => $value){
                            echo $value['outright_price'];
                        }?>;
                        location.href =
                            `outrightpayment.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totprice *unitInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9298383737&startdate=${startDate}`;
                        <?php }?>
                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                        let totprice = <?php foreach($landview as $key => $value){
                            echo $value['outright_price'];
                        }?>;
                        location.href =
                            `outrightpayment2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totprice *unitInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique'];?>`;
                        <?php }?>
                    }
                    if (data == "subscription payment") {
                        paybtn.style.display = "none";
                        document.querySelector('#paymentplanform').style.display = "none";
                        document.querySelector('.fifthsection .payment-mode').style.display = "block";
                        form5.style.display = "block";
                        let purpose = document.getElementsByName("mode");
                        <?php 
                                        if(!empty($landview)){
                                            foreach($landview as $key => $value){  ?>
                        purpose.forEach((element) => {

                            element.onclick = () => {

                                if (element.value == "onemonth") {

                                    document.querySelector('#data').innerHTML = "onemonth";
                                    let percent = <?php echo $value['onemonth_percent'];?>;
                                    let viewperiod = <?php echo $value['onemonth_period'];?>;
                                    let viewprice = <?php echo $value['onemonth_price'];?>;

                                    let percentvalue = percent / 100 * viewprice;
                                    let totprice = parseInt(totalInput.value) + parseInt(percentvalue);
                                    console.log(totprice);
                                    document.querySelector('#data2').innerHTML = totprice;
                                    let realprice = new Intl.NumberFormat().format(Math.round(totprice /
                                        viewperiod));
                                    let totalprice = new Intl.NumberFormat().format(
                                        totprice);

                                    document.querySelector('.fifthsection .detail-four').style =
                                        "visibility: visible;";
                                    document.querySelector('#pricedaily').innerHTML = realprice;
                                    document.querySelector('#pricetot').innerHTML = totalprice;
                                    let formatnum = document.querySelector('.second-section #numformat')
                                    formatnum.innerHTML = totalprice;

                                }

                                if (element.value == "threemonths") {
                                    document.querySelector('#data').innerHTML = "threemonths";
                                    let percent = <?php echo $value['threemonth_percent'];?>;
                                    let viewperiod = <?php echo $value['threemonth_period'];?>;
                                    let viewprice = <?php echo $value['onemonth_price'];?>;

                                    let percentvalue = percent / 100 * viewprice;
                                    let totprice = parseInt(totalInput.value) + parseInt(percentvalue);
                                    document.querySelector('#data2').innerHTML = totprice
                                    let realprice = new Intl.NumberFormat().format(Math.round(totprice /
                                        viewperiod));
                                    let totalprice = new Intl.NumberFormat().format(
                                        totprice);


                                    document.querySelector('.fifthsection .detail-four').style =
                                        "visibility: visible;";
                                    document.querySelector('#pricedaily').innerHTML = realprice;
                                    document.querySelector('#pricetot').innerHTML = totalprice;
                                    formatnum.innerHTML = totalprice;
                                    let formatnum = document.querySelector('.second-section #numformat')
                                    formatnum.innerHTML = totalprice;

                                }

                                if (element.value == "sixmonths") {
                                    document.querySelector('#data').innerHTML = "sixmonths";
                                    let percent = <?php echo $value['sixmonth_percent'];?>;
                                    let viewperiod = <?php echo $value['sixmonth_period'];?>;
                                    let viewprice = <?php echo $value['onemonth_price'];?>;

                                    let percentvalue = percent / 100 * viewprice;
                                    let totprice = parseInt(totalInput.value) + parseInt(percentvalue);
                                    document.querySelector('#data2').innerHTML = totprice
                                    let realprice = new Intl.NumberFormat().format(Math.round(totprice /
                                        viewperiod));
                                    let totalprice = new Intl.NumberFormat().format(
                                        totprice);


                                    document.querySelector('.fifthsection .detail-four').style =
                                        "visibility: visible;";
                                    document.querySelector('#pricedaily').innerHTML = realprice;
                                    document.querySelector('#pricetot').innerHTML = totalprice;
                                    formatnum.innerHTML = totalprice;
                                    let formatnum = document.querySelector('.second-section #numformat')
                                    formatnum.innerHTML = totalprice;

                                }

                                if (element.value == "twelvemonths") {
                                    document.querySelector('#data').innerHTML = "twelvemonths";
                                    let percent = <?php echo $value['twelvemonth_percent'];?>;
                                    let viewperiod = <?php echo $value['twelvemonth_period'];?>;
                                    let viewprice = <?php echo $value['onemonth_price'];?>;

                                    let percentvalue = percent / 100 * viewprice;
                                    let totprice = parseInt(totalInput.value) + parseInt(percentvalue);
                                    document.querySelector('#data2').innerHTML = totprice
                                    let realprice = new Intl.NumberFormat().format(Math.round(totprice /
                                        viewperiod));
                                    let totalprice = new Intl.NumberFormat().format(
                                        totprice);


                                    document.querySelector('.fifthsection .detail-four').style =
                                        "visibility: visible;";
                                    document.querySelector('#pricedaily').innerHTML = realprice;
                                    document.querySelector('#pricetot').innerHTML = totalprice;
                                    formatnum.innerHTML = totalprice;
                                    let formatnum = document.querySelector('.second-section #numformat')
                                    formatnum.innerHTML = totalprice;

                                }

                                if (element.value == "eighteenmonths") {
                                    document.querySelector('#data').innerHTML = "eighteenmonths";
                                    let percent = <?php echo $value['eighteen_percent'];?>;
                                    let viewperiod = <?php echo $value['eighteen_period'];?>;
                                    let viewprice = <?php echo $value['onemonth_price'];?>;

                                    let percentvalue = percent / 100 * viewprice;
                                    let totprice = parseInt(totalInput.value) + parseInt(percentvalue);
                                    document.querySelector('#data2').innerHTML = totprice
                                    let realprice = new Intl.NumberFormat().format(Math.round(totprice /
                                        viewperiod));
                                    let totalprice = new Intl.NumberFormat().format(
                                        totprice);


                                    document.querySelector('.fifthsection .detail-four').style =
                                        "visibility: visible;";
                                    document.querySelector('#pricedaily').innerHTML = realprice;
                                    document.querySelector('#pricetot').innerHTML = totalprice;
                                    formatnum.innerHTML = totalprice;
                                    let formatnum = document.querySelector('.second-section #numformat')
                                    formatnum.innerHTML = totalprice;

                                }


                            };

                        });
                        <?php }} ?>
                        const modebtn = document.querySelector('.fifthsection .estate_page_button');

                        function GoToPaymentMode() {
                            form5.style.display = "none";
                            form4.style.display = "block";
                        }

                        modebtn.onclick = () => {
                            GoToPaymentMode();
                        }

                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(planform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    paybtn.onclick = () => {
        checkPaymentMode();
    }


    const submethodform = document.querySelector('#submethod-form');
    const submethodbtn = document.querySelector('#submethod-form .estate_page_button');
    submethodform.onsubmit = (e) => {
        e.preventDefault();
    }



    function checkSubMethod() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getsubplan.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "autodebit") {
                        let subprice = document.querySelector('#data2').innerHTML;
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `intervalnum.php?data=${document.querySelector('#data').innerHTML}&uniqueid=${unique}&tech=91938udjd992992929&tot=${subprice}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                        location.href =
                            `intervalnum2.php?data=${document.querySelector('#data').innerHTML}&uniqueid=${unique}&tech=91938udjd992992929&tot=${subprice}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique'];?>`;
                        <?php }?>
                    }
                    if (data == "manually") {
                        let totprice = document.querySelector('#data2').innerHTML;
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `newpayment.php?data=${document.querySelector('#data').innerHTML}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totprice}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                        location.href =
                            `newpayment2.php?data=${document.querySelector('#data').innerHTML}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totprice}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique']?>`;
                        <?php }?>
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(submethodform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    submethodbtn.onclick = () => {
        checkSubMethod();
    }



    const intervalform = document.querySelector('#intervalform');
    const payedbtn = document.querySelector('.subbutton');
    intervalform.onsubmit = (e) => {
        e.preventDefault();
    }

    function checkInterval() {
        let payInput = document.querySelector("#newpay")
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getdata.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    let subprice = <?php foreach($landview as $key => $value){
                            echo $value['onemonth_price'];
                        }?>;
                    //console.log(data);
                    if (data) {
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `intervalnum.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${subprice * unitInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                        location.href =
                            `intervalnum2.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${subprice * unitInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique'];?>`;
                        <?php }?>
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(intervalform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    payedbtn.onclick = () => {
        checkInterval();
    }


    const intervalform2 = document.querySelector('#intervalform2');
    const payedbtn2 = document.querySelector('.subbutton2');
    intervalform2.onsubmit = (e) => {
        e.preventDefault();
    }

    function checkInterval2() {
        // let payInput2 = document.querySelector("#newpay")
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getdata.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    let totprice = <?php foreach($landview as $key => $value){
                            echo $value['outright_price'];
                        }?>;
                    //console.log(data);
                    if (data) {
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `newpayment.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totprice * unitInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                        location.href =
                            `newpayment2.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totprice * unitInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique']?>`;
                        <?php }?>
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(intervalform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    payedbtn2.onclick = () => {
        checkInterval2();
    }



    <?php }?>


    <?php if(($value['onemonth_price'] != 0) && $value['outright_price'] == 0){?>

    function submitUnits() {

        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", `inserters/calcunit.php?uniqueid=${unique}`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    let string = "success";
                    let realprice = data.replace('success', '')
                    if (data.includes(string)) {
                        let price = unitInput.value * realprice;
                        if (params.get('payment')) {
                            form1.style.display = "none";
                            form3.style.display = "block";
                        } else {
                            form1.style.display = "none";
                            document.querySelector('.fifthsection .payment-mode').style.display = "block";
                            form5.style.display = "block";
                            let purpose = document.getElementsByName("mode");
                            <?php 
                                        if(!empty($landview)){
                                            foreach($landview as $key => $value){  ?>
                            purpose.forEach((element) => {

                                element.onclick = () => {

                                    if (element.value == "onemonth") {

                                        document.querySelector('#data').innerHTML = "onemonth";
                                        let percent = <?php echo $value['onemonth_percent'];?>;
                                        let viewperiod = <?php echo $value['onemonth_period'];?>;
                                        let viewprice = <?php echo $value['onemonth_price'];?>;

                                        let percentvalue = percent / 100 * viewprice;
                                        let totprice = parseInt(totalInput.value) + parseInt(
                                            percentvalue);
                                        console.log(totprice);
                                        document.querySelector('#data2').innerHTML = totprice;
                                        let realprice = new Intl.NumberFormat().format(Math.round(
                                            totprice /
                                            viewperiod));
                                        let totalprice = new Intl.NumberFormat().format(
                                            totprice);

                                        document.querySelector('.fifthsection .detail-four').style =
                                            "visibility: visible;";
                                        document.querySelector('#pricedaily').innerHTML = realprice;
                                        document.querySelector('#pricetot').innerHTML = totalprice;
                                        let formatnum = document.querySelector(
                                            '.second-section #numformat')
                                        formatnum.innerHTML = totalprice;

                                    }

                                    if (element.value == "threemonths") {
                                        document.querySelector('#data').innerHTML = "threemonths";
                                        let percent = <?php echo $value['threemonth_percent'];?>;
                                        let viewperiod = <?php echo $value['threemonth_period'];?>;
                                        let viewprice = <?php echo $value['onemonth_price'];?>;

                                        let percentvalue = percent / 100 * viewprice;
                                        let totprice = parseInt(totalInput.value) + parseInt(
                                            percentvalue);
                                        document.querySelector('#data2').innerHTML = totprice
                                        let realprice = new Intl.NumberFormat().format(Math.round(
                                            totprice /
                                            viewperiod));
                                        let totalprice = new Intl.NumberFormat().format(
                                            totprice);


                                        document.querySelector('.fifthsection .detail-four').style =
                                            "visibility: visible;";
                                        document.querySelector('#pricedaily').innerHTML = realprice;
                                        document.querySelector('#pricetot').innerHTML = totalprice;
                                        let formatnum = document.querySelector(
                                            '.second-section #numformat')
                                        formatnum.innerHTML = totalprice;
                                    }

                                    if (element.value == "sixmonths") {
                                        document.querySelector('#data').innerHTML = "sixmonths";
                                        let percent = <?php echo $value['sixmonth_percent'];?>;
                                        let viewperiod = <?php echo $value['sixmonth_period'];?>;
                                        let viewprice = <?php echo $value['onemonth_price'];?>;

                                        let percentvalue = percent / 100 * viewprice;
                                        let totprice = parseInt(totalInput.value) + parseInt(
                                            percentvalue);
                                        document.querySelector('#data2').innerHTML = totprice
                                        let realprice = new Intl.NumberFormat().format(Math.round(
                                            totprice /
                                            viewperiod));
                                        let totalprice = new Intl.NumberFormat().format(
                                            totprice);


                                        document.querySelector('.fifthsection .detail-four').style =
                                            "visibility: visible;";
                                        document.querySelector('#pricedaily').innerHTML = realprice;
                                        document.querySelector('#pricetot').innerHTML = totalprice;
                                        let formatnum = document.querySelector(
                                            '.second-section #numformat')
                                        formatnum.innerHTML = totalprice;
                                    }

                                    if (element.value == "twelvemonths") {
                                        document.querySelector('#data').innerHTML = "twelvemonths";
                                        let percent = <?php echo $value['twelvemonth_percent'];?>;
                                        let viewperiod = <?php echo $value['twelvemonth_period'];?>;
                                        let viewprice = <?php echo $value['onemonth_price'];?>;

                                        let percentvalue = percent / 100 * viewprice;
                                        let totprice = parseInt(totalInput.value) + parseInt(
                                            percentvalue);
                                        document.querySelector('#data2').innerHTML = totprice
                                        let realprice = new Intl.NumberFormat().format(Math.round(
                                            totprice /
                                            viewperiod));
                                        let totalprice = new Intl.NumberFormat().format(
                                            totprice);


                                        document.querySelector('.fifthsection .detail-four').style =
                                            "visibility: visible;";
                                        document.querySelector('#pricedaily').innerHTML = realprice;
                                        document.querySelector('#pricetot').innerHTML = totalprice;
                                        let formatnum = document.querySelector(
                                            '.second-section #numformat')
                                        formatnum.innerHTML = totalprice;
                                    }

                                    if (element.value == "eighteenmonths") {
                                        document.querySelector('#data').innerHTML = "eighteenmonths";
                                        let percent = <?php echo $value['eighteen_percent'];?>;
                                        let viewperiod = <?php echo $value['eighteen_period'];?>;
                                        let viewprice = <?php echo $value['onemonth_price'];?>;

                                        let percentvalue = percent / 100 * viewprice;
                                        let totprice = parseInt(totalInput.value) + parseInt(
                                            percentvalue);
                                        document.querySelector('#data2').innerHTML = totprice
                                        let realprice = new Intl.NumberFormat().format(Math.round(
                                            totprice /
                                            viewperiod));
                                        let totalprice = new Intl.NumberFormat().format(
                                            totprice);


                                        document.querySelector('.fifthsection .detail-four').style =
                                            "visibility: visible;";
                                        document.querySelector('#pricedaily').innerHTML = realprice;
                                        document.querySelector('#pricetot').innerHTML = totalprice;
                                        let formatnum = document.querySelector(
                                            '.second-section #numformat')
                                        formatnum.innerHTML = totalprice;
                                    }


                                };

                            });
                            <?php }} ?>
                            const modebtn = document.querySelector('.fifthsection .estate_page_button');

                            function GoToPaymentMode() {
                                form5.style.display = "none";
                                form2.style.display = "block";
                                form4.style.display = "block";
                            }

                            modebtn.onclick = () => {
                                GoToPaymentMode();
                            }
                        }
                        let first = parseInt(unitInput.value);
                        let second = parseInt(unitNum.value);
                        if (first > second) {
                            Successdiv.style.display = "flex";
                            form2.innerHTML = Successdiv;
                            if (params.get('payment')) {
                                form3.innerHTML = Successdiv;
                            }

                            goback.onclick = () => {
                                location.reload();
                            }
                            form5.style.display = "none";
                        }
                        totalInput.value = price;
                        if (params.get('payment')) {
                            let formatnum = document.querySelector('.thirdsection #numformat')
                            formatnum.innerHTML = new Intl.NumberFormat().format(price);
                        } else {
                            <?php if($value['onemonth_price'] != 0 && $value['outright_price'] != 0){?>

                            <?php }else {?>
                            let formatnum = document.querySelector('.second-section #numformat')
                            formatnum.innerHTML = new Intl.NumberFormat().format(price);
                            <?php }?>
                        }

                        // location.href =
                        //     `summarypage.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${price}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9938484747`;
                    } else {
                        error.textContent = data;
                        error.style.visibility = "visible";
                        formbtn.textContent = "Continue";
                    }
                    // if (data) {
                    //     console.log(data);

                    // } else {
                    //     
                    // }
                }
            }
        };
        // we have to send the information through ajax to php
        let formData = new FormData(form); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    unitInput.onblur = () => {
        submitUnits();
    };

    const submethodform = document.querySelector('#submethod-form');
    const submethodbtn = document.querySelector('#submethod-form .estate_page_button');
    submethodform.onsubmit = (e) => {
        e.preventDefault();
    }



    function checkSubMethod() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getsubplan.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "autodebit") {
                        let subprice = document.querySelector('#data2').innerHTML;
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `intervalnum.php?data=${document.querySelector('#data').innerHTML}&uniqueid=${unique}&tech=91938udjd992992929&tot=${subprice}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                        location.href =
                            `intervalnum2.php?data=${document.querySelector('#data').innerHTML}&uniqueid=${unique}&tech=91938udjd992992929&tot=${subprice}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique'];?>`;
                        <?php }?>
                    }
                    if (data == "manually") {
                        let totprice = document.querySelector('#data2').innerHTML;
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `newpayment.php?data=${document.querySelector('#data').innerHTML}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totprice}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                        location.href =
                            `newpayment2.php?data=${document.querySelector('#data').innerHTML}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totprice}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique']?>`;
                        <?php }?>
                    }


                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(submethodform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    submethodbtn.onclick = () => {
        checkSubMethod();
    }

    const intervalform = document.querySelector('#intervalform');
    const payedbtn = document.querySelector('.subbutton');
    intervalform.onsubmit = (e) => {
        e.preventDefault();
    }

    function checkInterval() {
        let payInput = document.querySelector("#newpay")
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getdata.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    //console.log(data);
                    if (data) {
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `intervalnum.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                        location.href =
                            `intervalnum2.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique'];?>`;
                        <?php }?>
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(intervalform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    payedbtn.onclick = () => {
        checkInterval();
    }


    const intervalform2 = document.querySelector('#intervalform2');
    const payedbtn2 = document.querySelector('.subbutton2');
    intervalform2.onsubmit = (e) => {
        e.preventDefault();
    }

    function checkInterval2() {
        // let payInput2 = document.querySelector("#newpay")
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getdata.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    //console.log(data);
                    if (data) {
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `newpayment.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                        location.href =
                            `newpayment2.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique']?>`;
                        <?php }?>
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(intervalform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    payedbtn2.onclick = () => {
        checkInterval2();
    }



    <?php }?>








    setInterval(() => {
        let xls = new XMLHttpRequest();
        xls.open("GET", "getcart.php", true);
        xls.onload = () => {
            if (xls.readyState === XMLHttpRequest.DONE) {
                if (xls.status === 200) {
                    let data = xls.response;
                    let notify = document.querySelector('.cart-notify');
                    if (data == 0) {
                        notify.style.display = "none";
                    }

                    notify.innerHTML = data;
                    //console.log(data);
                }
            }
        }
        xls.send();
    }, 100);
    </script>
</body>

</html>