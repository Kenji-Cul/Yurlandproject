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
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />
    <script src="bootstrap/js/jquery.min.js"></script>

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
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
        height: 25em;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        gap: 0 !important;
    }

    .subscribed-img {
        height: 15em;
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
        padding-top: 0;
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
        <a href="superadmin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
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
            <?php 
            // $name = $value['unique_id'];
            // if(isset($_SESSION['uniquesupadmin_id'])){
            ?>
            <?php //if($value['land_status'] == "Closed"){?>
            <!-- <form action="" class="open-form" method="POST">
                <input class="price" type="submit" value="Open" name="open<?php echo $name?>"
                    style="background-color: #7e252b; color: #fff;" />

            </form> -->
            <?php //}else {?>
            <!-- <form action="" class="close-form" method="POST">
                <input class="price" type="submit" value="Close" name="close<?php echo $name?>"
                    style="background-color: #7e252b; color: #fff;" />

            </form> -->
            <?php// }?>
            <?php 
            
                
            //     if(isset($_POST["close".$name])){
            //         $insertuser = $land->closeProduct($name);
            //         $restored = "closed";
            //             header("Location: successpage/deletesuccess.php?detect=".$restored."");
                    
                
            // }

        //     if(isset($_POST["open".$name])){
        //         $insertuser = $land->closeProduct($name);
        //         $restored = "opened";
        //             header("Location: successpage/deletesuccess.php?detect=".$restored."");
                
            
        // }
            ?>
            <?php// }?>
            <div class="subscribed-img">
                <a
                    href="superadmininfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">
                    <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="estate image" />
                </a>



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
                <!-- <div class="sub-detail">
                    <p class="land-name">Total Units: <?php //echo $value['product_unit'];?></p>
                </div> -->
            </div>
            <!-- <div class="subscribed-details">
                <div class="sub-detail">
                    <p class="land-name" style="font-size: 15px;">Total Units Bought:
                        <?php //echo $value['bought_units'];?></p>
                </div>
                <div class="sub-detail">
                    <p class="land-name" style="font-size: 15px;">Number of Buyers: <?php// $user = new User;
                    //$num = $user->selectBuyers();
                    //if(!empty($num)){
                    //foreach($num as $key => $value){
                      //  echo $value;
                    //} } else {
                       // echo "0";
                    //}
                    ?></p>
                </div>
            </div>
            <div class="subscribed-details">
                <div class="sub-detail">
                    <p class="land-name">Total Revenue: </p>
                </div>
            </div> -->
        </div>
        <?php }}?>


    </div>



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