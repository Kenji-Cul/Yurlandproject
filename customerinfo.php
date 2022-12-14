<?php 
ob_start();
session_start();
include_once "projectlog.php";


if(!isset($_GET['unique'])){
    header("Location: portallogin.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />

    <!-- ========= SWIPER CSS ======== -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        overflow-x: hidden;
        background-image: none;
    }

    .details {
        width: 140px !important;
        position: relative;
    }

    .details .pname {
        width: 100px !important;
        text-overflow: ellipsis !important;
        overflow: hidden;
        white-space: nowrap;
    }

    .profile-container {
        display: grid;
        grid-template-rows: repeat(3, 1fr);
        width: 100%;
        height: 100%;
        gap: 0;
    }

    .flexdiv-1,
    .flexdiv-2,
    .flexdiv-3 {
        width: 100%;
    }

    .transactions {
        width: 80%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dropdown-links {
        height: 20em;
    }

    .payee {
        width: 130px;
        display: flex;
        flex-direction: row;
        gap: 0 !important;
        position: relative;
        height: 20px;
    }

    .payee .payee-name {
        text-overflow: ellipsis !important;
        overflow: hidden;
        white-space: nowrap;
        font-size: 13px;
        color: #808080;
        width: 59%;
    }

    .payee .payee-tag {
        width: 41%;
        font-size: 13px;
    }


    .subscribed-lands {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-around;
        min-height: 30vh;
    }

    .deleted-div {
        height: 700px;
        width: 350px;
        border-radius: 8px;
        background-color: #808080;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 1.5em;
    }

    .radius {
        position: relative;
    }

    .radius img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .transaction-details {
        border-radius: 8px;
        /* border: 2px solid black; */
        padding: 1em 2em;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
        width: 90%;
    }

    .center2 {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2em 0;
    }

    .success {
        position: absolute;
        left: 50%;
        top: 30em;
        transform: translate(-50%, -50%);
        height: 10em;
    }

    .success img {
        width: 20em;
        height: 20em;
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


    .no-lands p {
        font-style: normal;
        font-weight: 600;
        font-size: 24px;
        color: #1a0709;
    }



    .subscribed-land {
        height: 26em;
        gap: 2em;
        position: relative;
    }

    .subscribed-img {
        height: 19em;
    }


    .subscribed-details {
        margin-top: 0;
    }

    .no-lands img {
        margin-top: 8em;
        width: 30em;
        height: 30em;
    }

    .balance span {
        font-size: 15px;
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



    .updated-land {
        position: relative;
        width: 350px;
        min-height: 750px !important;
        background: #FFFFFF;
        border-radius: 8px;
        filter: drop-shadow(0px 4px 16px rgba(128, 128, 128, 0.76));
        display: flex;
        flex-direction: column;

    }

    .updated-img {
        width: 350px;
        height: 241px !important;
        border-radius: 8px 8px 0px 0px;
    }

    .updated-img img {
        height: 241px !important;
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
        gap: 1em;
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



    @media only screen and (max-width: 800px) {
        body {
            height: 90vh;
        }

        .land-btn-container {
            display: flex;
            flex-direction: column;
            gap: 1em;
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

    @media only screen and (min-width: 1300px) {
        .menu {
            display: none;
        }



        .center {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .page-title2 {
            justify-content: left;
            gap: 1em;
        }

        .page-title2 a {
            position: unset;
        }

        .page-title2 p {
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            color: #1A0709;
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
        }

        .dropdown-links .links img {
            width: 20px;
            height: 20px;
            margin-right: 6px;
            cursor: pointer;
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

        .dropdown-links .links .link {
            visibility: hidden;
            display: none;
        }


        .dropdown-links li a {
            color: #fff;

        }

        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
        }

        .estates {
            padding-top: 6em;
            position: absolute;
            right: 0;
            width: 20%;
            background: #fee1e3;
            min-height: 150vh;
        }

        .profile-container {
            position: absolute;
            left: 5em;
            padding: 0;
            width: 93%;
            transition: all 0.5s;
        }

        .close {
            display: none;
        }

        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
        }


        .land_estate_container {
            display: flex;
            flex-direction: column;
            gap: 1em;
        }
    }














    @media only screen and (max-width: 1300px) {
        .details .pname {
            font-size: 13px;
        }

        .deleted-div {
            width: 300px;
        }


        .success {
            position: absolute;
            top: 28em;
            padding-top: 0;
        }

        .success img {
            width: 5em;
            height: 5em;
        }

        .profile-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .payee {
            width: 100px;
            display: flex;
            flex-direction: row;
            gap: 0 !important;
            position: relative;
            height: 20px;
        }

        .payee .payee-name {
            text-overflow: ellipsis !important;
            overflow: hidden;
            white-space: nowrap;
            font-size: 12px;
            color: #808080;
            width: 50%;
        }

        .payee .payee-tag {
            width: 50%;
            font-size: 12px;
        }

        .transaction-details {
            width: 80%;
        }

        .transaction-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
        }

        .detail3 {
            display: none;
        }


        .user,
        #openicon {
            display: none;
        }

        .links img {
            display: none;
        }

        .dropdown-links {
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
            background: #7e252b;
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

        .updated-land {
            min-height: 750px !important;

        }

        .detail-name p {
            font-style: normal;
            font-weight: 600;
            font-size: 25px;
            color: #1A0709;
        }

        .updated-img {
            height: 241px !important;
            border-radius: 8px 8px 0px 0px;
        }

        .updated-img img {
            height: 241px !important;
        }
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
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
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

        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />
        </div>

    </header>

    <?php 
             $user = new User;
             $newuser = $user->selectUser($_GET['unique']);
            ?>

    <div class="flex-container">
        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <ul class="dropdown-links">
            <div class="center">
                <li id="openicon" style="cursor: pointer;">
                    <img src="images/openmenu.svg" />
                </li>

                <li id="closeicon" style="display: none; cursor: pointer; font-size:14px;">
                    <img src="images/openmenu.svg" />
                </li>
            </div>
            <li class="close">
                <img src="images/close2.svg" style="width: 30px; height: 30px; position: absolute; right: 2em;" />
            </li>
            <li class="links select-link">
                <a href="subadmin.php"><img src="images/home3.svg" /></a>
                <a href="subadmin.php" class="link">Home</a>
            </li>
            <li class="links">
                <a href="allcustomers.php"><img src="images/referral.svg" /></a>
                <a href="allcustomers.php" class="link">All Customers</a>
            </li>
            <li class="links">
                <a href="newuser.php"><img src="images/referral.svg" /></a>
                <a href="newuser.php" class="link">New Customer</a>
            </li>
            <li class="links">
                <a href="createagent.php"><img src="images/referral.svg" /> </a>
                <a href="createagent.php" class="link">Create Agent</a>
            </li>

            <li class="links">
                <a href="totaltransactions.php"><img src="images/updown.svg" /> </a>
                <a href="totaltransactions.php" class="link">View Transactions</a>
            </li>

            <li class="links">
                <a href="totalref.php"><img src="images/referral.svg" /> </a>
                <a href="totalref.php" class="link">View Referrals</a>
            </li>

            <li class="links">
                <a href="allagents.php"><img src="images/referral.svg" /> </a>
                <a href="allagents.php" class="link">All Agents</a>
            </li>

            <li class="links">
                <a href="subadmininfo.php"><img src="images/settings.svg" /></a>
                <a href="subadmininfo.php" class="link">Profile</a>
            </li>
            <li class="links">
                <a href="logout.php?user=subadmin"><img src="images/exit.svg" /></a>
                <a href="logout.php?user=subadmin" class="link">Logout</a>
            </li>
        </ul>

        <?php }?>

        <?php if(isset($_SESSION['uniqueagent_id'])){?>

        <ul class="dropdown-links">
            <div class="center">
                <li id="openicon" style="cursor: pointer;">
                    <img src="images/openmenu.svg" />
                </li>

                <li id="closeicon" style="display: none; cursor: pointer; font-size:14px;">
                    <img src="images/openmenu.svg" />
                </li>
            </div>
            <li class="close">
                <img src="images/close2.svg" style="width: 30px; height: 30px; position: absolute; right: 2em;" />
            </li>
            <li class="links select-link">
                <a href="agentprofile.php"><img src="images/home3.svg" /></a>
                <a href="agentprofile.php" class="link">Home</a>
            </li>

            <li class="links">
                <a href="usertype.php"><img src="images/land2.svg" /></a>
                <a href="usertype.php" class="link">New Land</a>
            </li>


            <li class="links">
                <a href="allestates3.php"><img src="images/land2.svg" /></a>
                <a href="allestates3.php" class="link">All Estates</a>
            </li>

            <li class="links">
                <a href="mycustomers.php"><img src="images/referral.svg" /></a>
                <a href="mycustomers.php" class="link">Customers</a>
            </li>
            <li class="links">
                <a href="newcustomer.php"><img src="images/referral.svg" /> </a>
                <a href="newcustomer.php" class="link">New Customer</a>
            </li>
            <li class="links">
                <a href="referral.php"><img src="images/chart2.svg" /></a>
                <a href="referral.php" class="link">Referrals</a>
            </li>

            <li class="links">
                <a href="alltransactions.php"><img src="images/updown.svg" /></a>
                <a href="alltransactions.php" class="link">View Transactions</a>
            </li>


            <li class="links">
                <a href="agentprofileinfo.php"><img src="images/settings.svg" /></a>
                <a href="agentprofileinfo.php" class="link">Profile</a>
            </li>
            <li class="links">
                <a href="agentlogout.php"><img src="images/exit.svg" /></a>
                <a href="agentlogout.php" class="link">Logout</a>
            </li>
        </ul>

        <?php }?>

        <div class="profile-container">
            <div class="flexdiv-1">
                <div class="profile-info">
                    <div class="details2">
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
                </div>
            </div>


            <div class="flexdiv-2">
                <div class="center2">
                    <h3 style="text-transform: capitalize;">Customer's Land</h3>
                </div>
                <div class="subscribed-lands">

                    <?php 
              $land = new User;
             $landview = $land->selectPayment($_GET['unique']);
             if(!empty($landview)){
                foreach($landview as $key => $value){
                  
                   
             ?>

                    <?php if($value['payment_status'] == "Deleted"){?>
                    <div class="deleted-div">
                        <?php 
            $name = $value['product_id'].$value['payment_id'];
            if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){
            ?>
                        <form action="" class="deletep-form" method="POST">
                            <input class="price" type="submit" value="Delete Product" name="deletep<?php echo $name?>"
                                style="background-color: #7e252b; color: #fff;" />

                        </form>
                        <?php 
            
                
                if(isset($_POST["deletep".$name])){
                    $insertuser = $user->DeleteProductP($value['product_id'],$_GET['unique'],$value['payment_method'],$value['payment_id']);
                    $checkland = $user->selectLandImage($value['product_id']);
                    foreach ($checkland as $key => $value2) {
                        $soldunit = $value2['product_unit'] + $value['product_unit'];
                        $boughtunits = $value2['bought_units'] - $value['product_unit'];
                        $updateland = $user->updateLandUnit($value['product_id'],$soldunit,$boughtunits);
                    }
                    $deletedp = "deletedp";
                        header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
                    
                
            }
            ?>
                        <?php }?>
                        <?php 
            $name = $value['product_id'].$value['payment_id'];
            if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){
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


                    <div class="updated-land" style="display:none;">

                        <div class="updated-img">
                            <img src="landimage/<?php echo $value['product_image'];?>" alt="estate image" />
                            <div class="ellipse">
                                <i class="ri-heart-fill"></i>
                            </div>
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

                            </div>
                            <?php if($value['payment_method'] == "Subscription"){?>
                            <div class="cartbutton">&#8358;<?php 
                    $unitprice = $value['product_price'];
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } else {
                                 echo $unitprice;
                             }
                      ?> &nbsp;<span>daily</span></div>

                            <?php } else if($value['balance'] == "0" && $value['payment_method'] == "NewPayment" || $value['period_num'] == "0"){ ?>
                            <div class="cartbutton">&#8358;<?php 
                   $unitprice = $value['sub_payment'];
                   if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }  else {
                                 echo $unitprice;
                             }
                    ?> &nbsp;<span>daily</span></div>

                            <?php    }
                  else {?>
                            <div class="cartbutton"><?php 
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
                             }  else {
                                 echo $unitprice;
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
                             } else {
                                 echo $unitprice;
                             }
             ?></span></p>
                                <p class="balance"><span>Balance:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $value['balance'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        } else {
                                            echo number_format($unprice);
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
                    </div>
                    <?php } else {?>

                    <div class="updated-land">

                        <div class="updated-img" style="height: 241px;">
                            <img src="landimage/<?php echo $value['product_image'];?>" alt="estate image" />
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
                                    </div>
                                </div>
                            </div>
                            <div class="detail-five">
                                <?php if($value['payment_method'] == "Subscription"){?>
                                <div class="cartbutton">&#8358;<?php 
             $unitprice = $value['sub_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } else {
                                 echo round($unitprice);
                             }
             ?> &nbsp;<span><?php echo $value['sub_period'];?></span></div>

                                <?php } else if($value['balance'] < "1" && $value['payment_method'] == "NewPayment" && $value['period_num'] == "0"){ ?>
                                <div class="cartbutton" style="font-size: 12px;"><?php 
                      echo "Payment Completed";
             ?> &nbsp;</div>

                                <?php    }
                else {?>
                                <div class="cartbutton" style="font-size: 12px;"><?php 
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
                                        <input type="hidden" name="customer"
                                            value="<?php echo $value['customer_id'];?>" />
                                        <input type="hidden" value="<?php echo $value['product_id'];?>" name="product">
                                    </form>
                                    <script>
                                    let dateInput<?php echo $value['product_id'];?> = document.querySelector('#date');
                                    let checkBal<?php echo $value['product_id'];?> = document.querySelector('#check');
                                    var countDownDate<?php echo $value['product_id'];?> = new Date(
                                        dateInput<?php echo $value['product_id'];?>.value).getTime();
                                    var now<?php echo $value['product_id'];?> = new Date().getTime();
                                    var timeleft<?php echo $value['product_id'];?> =
                                        countDownDate<?php echo $value['product_id'];?> -
                                        now<?php echo $value['product_id'];?>;

                                    var days<?php echo $value['product_id'];?> = Math.floor(
                                        timeleft<?php echo $value['product_id'];?> /
                                        (1000 * 60 * 60 * 24));
                                    //console.log(timeleft);
                                    if (timeleft<?php echo $value['product_id'];?> < 0 &&
                                        checkBal<?php echo $value['product_id'];?>
                                        .value != 0) {
                                        let priceform = document.querySelector('#priceform');


                                        function increasePrice<?php echo $value['product_id'];?>() {
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
                                            increasePrice<?php echo $value['product_id'];?>();
                                        }, 2592000000);
                                    }
                                    </script>
                                    <?php    } else {
             ?>


                                    <?php 
               echo "Payment Completed";
                            }?> &nbsp;
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="updated-details">
                            <div class="detail-four">
                                <?php 
            $name = $value['product_id'].$value['payment_id'];
            if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){
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
                            <div class="detail-four">
                                <p><span>Amount
                                        Paid:</span>&nbsp;&#8358;<span><?php 
                  $unitprice = $value['product_price'];
                  if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }  else {
                                 echo $unitprice;
                             }
                  ?></span></p>
                                <p><span>Balance:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $value['balance'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        }  else {
                                            echo number_format($unprice);
                                        }
                                        
                    ?></span></p>
                                <p><span>Start
                                        Date:</span>&nbsp;<span><?php echo $value['payment_day'];?></span>-<span><?php echo $value['payment_month'];?></span>-<span><?php echo $value['payment_year'];?></span>
                                </p>
                                <?php if($value['payment_method'] == "NewPayment" || $value['payment_status'] == "Payed"){  ?>
                                <p><span>Expected End
                                        Date:</span>&nbsp;<span><?php echo $value['sub_period'];?></span></p>
                                <?php }?>
                                <?php if($value['payment_method'] == "Subscription" || $value['payment_method'] == "NewPayment"){  ?>
                                <p><span>Chosen Plan:</span>&nbsp;<span style="text-transform: capitalize;"><?php 
                        echo $value['product_plan'];         
                    ?></span></p>
                                <?php }?>
                                <p><span>Unit:</span>&nbsp;<span style="text-transform: capitalize;"><?php 
                        echo $value['product_unit'];         
                    ?></span></p>
                                <p><span>Bought By:</span>&nbsp;<span style="text-transform: capitalize;"><?php 
                            if(isset($_SESSION['uniqueagent_id'])){
                            $newagent = $user->selectAgent($_SESSION['uniqueagent_id']);
                            if($value['payee'] == $newagent['agent_name']){
                                echo "You";
                            } else {
                                echo $value['payee'];   
                            }
                        }

                        if(isset($_SESSION['uniquesubadmin_id'])){
                            $subadmin = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
                            if($value['payee'] == $subadmin['subadmin_name']){
                                echo "You";
                            } else {
                                echo $value['payee'];   
                            }
                        }
                             
                    ?></span></p>
                            </div>
                        </div>

                    </div>
                    <?php }?>
                    <?php  } ?>
                    <?php }?>
                </div>
                <?php if(empty($landview)){?>
                <div class="success">
                    <img src="images/asset_success.svg" alt="" />
                    <p>This user does not have any land yet!</p>
                </div>
                <?php }?>


            </div>



            <div class="flexdiv-3">
                <div class="center2">
                    <h3 style="text-transform: capitalize;">Customer's History</h3>
                </div>


                <div class="transactions">
                    <p>Current Transactions</p>
                    <a href="userhistory.php?unique=<?php echo $_GET['unique'];?>">
                        <p class="more">See more</p>
                    </a>
                </div>

                <?php 
             $land = new User;
             $landview = $land->selectCurrentPayHistory($_GET['unique']);
             if(!empty($landview)){
                foreach($landview as $key => $value){
            
            ?>
                <div class="transaction-details">
                    <div class="radius">
                        <img src="landimage/<?php echo $value['product_image'];?>" alt="">
                    </div>
                    <div class="details">
                        <p class="pname"><?php echo $value['product_name'];?></p>
                        <div class="inner-detail">
                            <div class="date">
                                <span><?php echo $value['payment_month'];?></span>&nbsp;<span><?php echo $value['payment_day'];?></span>,<span><?php echo $value['payment_year'];?>
                            </div>
                        </div>
                    </div>
                    <div class="price-detail detail3"><?php 
             if($value['product_unit'] == "1"){
                echo $value['product_unit']." Unit";
            } else {
                echo $value['product_unit']." Units";
            }
            ?></div>
                    <div class="price-detail detail3"><?php 
            echo $value['payment_method'];
            ?></div>
                    <div class="price-detail">&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format(round($unitprice));
                             } else {
                                echo round($unitprice);
                             }
            ?>
                        <div class="payee">
                            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
                            <p class="payee-name"
                                style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">

                                <?php
                                if(isset($_SESSION['uniqueagent_id'])){
                                $newagent = $user->selectAgent($_SESSION['uniqueagent_id']);
                                if($value['payee'] == $newagent['agent_name']){
                                echo "You";
                                } else {
                                echo $value['payee'];
                                }
                                }

                                if(isset($_SESSION['uniquesubadmin_id'])){
                                $subadmin = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
                                if($value['payee'] == $subadmin['subadmin_name']){
                                echo "You";
                                } else {
                                echo $value['payee'];
                                }
                                } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php }} else {?>
                <div class="transaction-details" style="display: flex; align-items: center; justify-content: center;">
                    <p><?php echo $newuser['first_name'];?> has not done any transactions yet</p>
                </div>
                <?php }?>
            </div>







        </div>
    </div>




    <?php ob_end_flush();?>
    <script>
    if (window.innerWidth > 1200) {
        let dropdownnav = document.querySelector(".dropdown-links");
        let open = document.querySelector('#openicon');
        let closeicon = document.querySelector('#closeicon');
        open.onclick = () => {
            dropdownnav.style = `
        width: 14%;
        `;
            open.style.display = "none";
            closeicon.style.display = "block";
            document.querySelector(".profile-container").style = `
         padding-left: 7em;
        `;
            let allLinks = document.querySelectorAll(".dropdown-links .links .link");

            let allLink = document.querySelectorAll(".dropdown-links .links");
            allLink.forEach((element) => {
                element.style = `
        gap: 10px;
        `;

            });
            allLinks.forEach((element) => {
                element.style = `
         visibility: visible;
         display: block;
        `;
            });
        }

        closeicon.onclick = () => {
            dropdownnav.style = `
        width: 6%;
        `;
            open.style.display = "block";
            closeicon.style.display = "none";
            document.querySelector(".profile-container").style = `
         padding-left: 1em;
        `;

            let allLink = document.querySelectorAll(".dropdown-links .links");
            allLink.forEach((element) => {
                element.style = `
        justify-content: center
        `;
            });

            let allLinks = document.querySelectorAll(".dropdown-links .links .link");
            allLinks.forEach((element) => {
                element.style = `
         visibility: hidden;
         display:none;
        `;
            });
        }
    }
    if (window.innerWidth < 1300) {
        let dropdownnav = document.querySelector(".dropdown-links");
        let menu = document.querySelector(".menu");
        menu.onclick = () => {
            dropdownnav.style = `
            transform: translateX(0);
            `;
        };

        let close = document.querySelector(".close");
        close.onclick = () => {
            dropdownnav.style = `
            transform: translateX(100%);
            `;
        };
    }
    </script>
</body>

</html>