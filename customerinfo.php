<?php 
ob_start();
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

    .deleted-div {
        position: absolute;
        top: 0;
        height: 100%;
        width: 100%;
        border-radius: 8px;
        background-color: #808080;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 1.5em;
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

    .subscribed-land {
        height: 25em;
        position: relative;
    }

    .balance span {
        font-size: 15px;
    }

    .subscribed-land {
        min-height: 30em;
    }


    @media only screen and (max-width: 800px) {
        body {
            height: 90vh;
        }

        .land-btn-container {
            display: flex;
            flex-direction: column;
            gap: 1em;
        }

        .success {
            position: absolute;
            top: 50em;
        }

        .success img {
            width: 24em;
            height: 24em;
        }

        .success p {
            text-align: center;
        }

        .subscribed-land {
            min-height: 30em;
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
            <p> <?php $newuser2 = $user->selectReferredCustomer($newuser['personal_ref']);
               foreach ($newuser2 as $key => $value) {
                if($value > 0){
                    echo "Referral Customer Details";
                } else {
                    echo "Customer Details";
                }
               }; ?></p>
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
    <div class="land-btn-container" style="display: flex; gap: 2em;">
        <a href="allestates2.php?unique=<?php echo $newuser['unique_id'];?>">
            <button class="btn land-btn">Buy Land For Customer</button>
        </a>

        <?php if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
        <a href="editcustomer.php?unique=<?php echo $newuser['unique_id'];?>">
            <button class="btn land-btn">Edit Customer</button>
        </a>
        <?php }?>
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
            <?php if($value['payment_status'] == "Deleted"){?>
            <div class="deleted-div">
                <?php 
            $name = $value['product_id'].$value['payment_id'];
            if(isset($_SESSION['uniquesubadmin_id'])){
            ?>
                <form action="" class="deletep-form" method="POST">
                    <input class="price" type="submit" value="Delete Product" name="deletep<?php echo $name?>"
                        style="background-color: #7e252b; color: #fff;" />

                </form>
                <?php 
            
                
                if(isset($_POST["deletep".$name])){
                    $insertuser = $user->DeleteProductP($value['product_id'],$_GET['unique'],$value['payment_method'],$value['payment_id']);
                    $deletedp = "deletedp";
                        header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
                    
                
            }
            ?>
                <?php }?>
                <?php 
            $name = $value['product_id'].$value['payment_id'];
            if(isset($_SESSION['uniquesubadmin_id'])){
            ?>
                <form action="" class="restore-form" method="POST">
                    <input class="price" type="submit" value="Restore" name="restore<?php echo $name?>"
                        style="background-color: #7e252b; color: #fff;" />

                </form>
                <?php 
            
                
                if(isset($_POST["restore".$name])){
                    $insertuser = $user->updateProductStat($value['product_id'],$_GET['unique'],$value['payment_method'],$value['payment_id']);
                    $restored = "restored";
                        header("Location: successpage/deletesuccess.php?detect=".$restored."");
                    
                
            }
            ?>
                <?php }?>
                <div class="price">Deleted</div>
            </div>
            <?php }?>
            <div class="subscribed-img">
                <a href="">
                    <img src="landimage/<?php echo $value['product_image'];?>" alt="estate image" />
                </a>
            </div>
            <div class="subscribed-details">
                <div>
                    <p class="land-name"><?php echo $value['product_name'];?></p>
                    <p class="land-location"><?php echo $value['product_location'];?></p>
                </div>
                <?php if($value['payment_method'] == "Subscription"){?>
                <div class="price">&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?> &nbsp;<span>daily</span></div>

                <?php } else if($value['balance'] == "0" && $value['payment_method'] == "NewPayment" || $value['period_num'] == "0"){ ?>
                <div class="price">&#8358;<?php 
             $unitprice = $value['sub_payment'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?> &nbsp;<span>daily</span></div>

                <?php    }
                else {?>
                <div class="price"><?php 
            if($value['balance'] != "0" && $value['payment_method'] == "NewPayment"){ ?>
                    <a href="estateinfo.php?id=<?php echo $value['product_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=newpayment&keyref=09123454954848kdksuuejwej&unique=<?php echo $_GET['unique'];?>&remprice=<?php echo $value['balance'];?>"
                        style="color: #7e252b;">Pay Up</a>
                    <input type="hidden" id="date" value="<?php echo $value['sub_period'];?>" />
                    <input type="hidden" value="<?php echo $value['balance'];?>" id="check">
                    <form id="priceform">
                        <input type="hidden" value="<?php 
                        $increase = 2 / 100 * $value['sub_payment'];
                        $priceincrement = $increase + $value['sub_payment'];
                        echo $priceincrement;
                        ?>" id="increase" name="increase">
                        <input type="hidden" name="customer" value="<?php echo $value['customer_id'];?>" />
                        <input type="hidden" value="<?php echo $value['product_id'];?>" name="product">
                    </form>
                    <script>
                    let dateInput = document.querySelector('#date');
                    let checkBal = document.querySelector('#check');
                    var countDownDate = new Date(dateInput.value).getTime();
                    var now = new Date().getTime();
                    var timeleft = countDownDate - now;

                    var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
                    //console.log(timeleft);
                    if (timeleft < 0 && checkBal.value != 0) {
                        let priceform = document.querySelector('#priceform');


                        function increasePrice() {
                            let xhr = new XMLHttpRequest(); //creating XML Object
                            xhr.open("POST", "increase.php", true);
                            xhr.onload = () => {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        let data = xhr.response;
                                        console.log(data);
                                    }
                                }
                            }
                            // we have to send the information through ajax to php
                            let formData = new FormData(priceform); //creating new formData Object

                            xhr.send(formData);
                        }
                        // 2592000

                        setInterval(() => {
                            increasePrice();
                        }, 2592000000);
                    }
                    </script>
                    <?php    } else {
            ?>


                    &#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
                            }?> &nbsp;
                </div>
                <?php }?>

            </div>
            <div class="subscribed-details"
                style="flex-direction: column; align-items: center; justify-content: center; gap: 1em;">
                <div class="balance" style="display: flex;
                align-items: center; justify-content center; gap: 3em; text-align: center; width: 100%; ">
                    <p class="amountpaid"><span>Amount
                            Paid:</span>&nbsp;&#8358;<span><?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?></span></p>
                    <p class="balance"><span>Balance:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $value['balance'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        } 
                                        if($unprice == "0"){
                                            echo "0";
                                        }
                    ?></span></p>
                </div>
                <div class="balance" style="display: flex;
                align-items: center; justify-content center; gap: 3em; text-align: center; width: 100%;">
                    <p class="amountpaid"><span>Start
                            Date:</span>&nbsp;<span><?php echo $value['payment_day'];?></span>-<span><?php echo $value['payment_month'];?></span>-<span><?php echo $value['payment_year'];?></span>
                    </p>
                    <?php if($value['payment_method'] == "Subscription" || $value['payment_status'] == "Payed"){  ?>
                    <p class="balance"><span>Expected End
                            Date:</span>&nbsp;<span><?php echo $value['sub_period'];?></span></p>
                    <?php }?>
                </div>
            </div>
            <?php 
           
            $name = $value['product_id'].$value['payment_id'];
            if(isset($_SESSION['uniquesubadmin_id'])){
            ?>
            <form action="" class="delete-form" method="POST">
                <input class="price" type="submit" value="Delete" name="delete<?php echo $name?>"
                    style="background-color: #7e252b; color: #fff;" />

            </form>
            <?php 
             
                
                if(isset($_POST["delete".$name])){
                    $insertuser = $user->DeleteProduct($value['product_id'],$_GET['unique'],$value['payment_method'],$value['payment_id']);
                    $deleted = "deleted";
                        header("Location: successpage/deletesuccess.php?detect=".$deleted."");
                    
                }
            
            ?>
            <?php }?>
        </div>

        <?php }}?>


    </div>


    <?php if(empty($landview)){?>
    <div class="success">
        <img src="images/asset_success.svg" alt="" />
        <p>This user does not have any land yet!</p>
    </div>

    <?php }?>





    <?php ob_end_flush();?>
</body>

</html>