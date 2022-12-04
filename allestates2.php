<?php 
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
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />
    <script src="bootstrap/js/jquery.min.js"></script>

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    .page-title3 {
        flex-direction: column;
    }




    .search-icon {
        position: absolute;
        right: 4em;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        gap: 1.5em;
        align-items: center;
        justify-content: center;
    }




    .search-icon img {
        width: 20px;
        height: 20px;
    }

    .search-icon input {
        padding: 0.8em 4em;
        outline: none;
        background-color: #cac6c6;
        border: 1px solid #808080;
    }

    .search-icon input:focus {
        border: none;
    }





    .subscribed-land {
        height: 30em;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }

    .inputs {
        display: none;
    }

    .inputs i {
        font-size: 22px;
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
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="page-title2">
        <?php if(isset($_SESSION['uniqueagent_id'])){?>
        <a href="agentprofile.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <a href="superadmin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <?php }?>
        <div style="display: flex !important; flex-direction: column !important" class="estatetext">
            <p>All Estates</p>
        </div>
        <!-- <div class="search-icon">
            <img src="images/search.svg" alt="search image" id="searchimg">
            <div class="inputs">
                <form action="" id="searchform">
                    <input type="text" name="searchproduct" id="search">
                </form>
                <i class="ri-close-line" id="closeicon"></i>
            </div>
        </div> -->
    </div>



    <div class="subscribed-lands">
        <?php 
             $land = new User;
             $landview = $land->selectLand();
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
            ?>
        <div class="subscribed-land">
            <div class="subscribed-img">
                <?php  if(isset($_SESSION['uniqueagent_id'])){
                if($value['product_unit'] != 0){?>
                <a
                    href="estateinfo3.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyunique=<?php echo $_GET['unique'];?>">
                    <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="estate image" />
                </a>
                <?php } else {?>
                <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="estate image" />
                <?php }}?>

                <?php  if(isset($_SESSION['uniquesupadmin_id'])){
                if($value['product_unit'] != 0){?>

                <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="estate image" />
                <?php }}?>

                <?php  if(isset($_SESSION['uniquesubadmin_id'])){
                if($value['product_unit'] != 0){?>
                <a
                    href="estateinfo4.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyunique=<?php echo $_GET['unique'];?>">
                    <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="estate image" />
                </a>
                <?php } else {?>
                <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="estate image" />
                <?php }}?>

            </div>

            <div class="subscribed-details">
                <div class="sub-detail">
                    <div>
                        <p class="land-name"><?php echo $value['product_name'];?></p>
                        <p class="land-location"><?php echo $value['product_location'];?></p>
                    </div>
                </div>
                <div class="sub-detail">
                    <?php if($value['product_unit'] != 0){?>
                    <?php if($value['outright_price'] != 0){
                      $outprice = $value['outright_price'];
                      $onemonthprice = $value['onemonth_price'];
                        ?>
                    <div class="price-flex">
                        <p class="land-name">Outright Price:</p>
                        <p class="land-location">&#8358;<?php if($outprice > 999 || $outprice > 9999 || $outprice > 99999 || $outprice > 999999){
                          echo number_format($outprice);
                        }?></p>
                    </div>
                    <?php } else {?>
                    <p class="land-name">No Outright Price</p>
                    <?php }?>


                    <?php if($value['onemonth_price'] != 0){
                        $onemonthprice = $value['onemonth_price'];
                        ?>
                    <div>
                        <p class="land-name">Daily Price:</p>
                        <p class="land-location">&#8358;<?php if($onemonthprice > 999 || $onemonthprice > 9999 || $onemonthprice > 99999 || $onemonthprice > 999999){
                          echo number_format($onemonthprice);
                        }?></p>
                    </div>
                    <?php } else {?>
                    <div>
                        <p class="land-name">No Daily Price</p>
                    </div>
                    <?php } } else {?>
                    <p class="land-name">Sold Out</p>
                    <?php }?>


                </div>
            </div>
        </div>
        <?php }}?>


    </div>

    <?php if(!isset($_SESSION['uniquesupadmin_id'])){?>
    <div class="price-container">
        <a href="cartreview.php">
            <div class="price">Continue</div>
        </a>
    </div>
    <?php }?>

    <script src="js/main.js"></script>
    <script>
    var searchimg = document.querySelector("#searchimg");
    var close = document.querySelector("#closeicon");
    var searchcontainer = document.querySelector('.inputs');
    // var input = document.querySelector("#searchform input");
    searchimg.onclick = () => {
        searchcontainer.style.display = "block";
        document.querySelector('.estatetext').style.display = "none";
        document.querySelector('#searchimg').style.display = "none";
    }


    close.onclick = () => {
        searchcontainer.style.display = "none";
        document.querySelector('.estatetext').style.display = "block";
        document.querySelector('#searchimg').style.display = "block";
    }

    // console.log(input.value);

    // $("#searchform").submit(function(e) {
    //     e.preventDefault();
    // })

    // $("#searchform input").keyup(function() {
    //     // console.log(("#searchform input").val())
    //     $.ajax({
    //         type: "POST",
    //         url: "searching.php",
    //         data: $("#searchform input"),
    //         success: function(response) {
    //             console.log(response);
    //             $(".subscribed-lands").html(response);
    //             //    console.log(response);
    //         }

    //     });
    // })
    </script>
</body>

</html>