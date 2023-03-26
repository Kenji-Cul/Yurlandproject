<?php 
session_start();
include "projectlog.php";
if(!isset($_SESSION['uniquesupadmin_id'])){
    header("Location:index.php");
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

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    .profile-body {
        height: 120vh;
        overflow-x: hidden;
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

    .search-input {
        display: none;
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


    .dropdown-links {
        overflow-y: auto;
    }

    ::-webkit-scrollbar {
        width: 0.5rem;
        background-color: #8d8989;
        border-radius: 1rem;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #ddd;
        border-radius: 1rem;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #aaa;
    }


    .navig .payment {
        font-size: 14px;
    }

    .navigation-div {
        display: flex;
        align-items: center;
        justify-content: right;
    }

    .navig {
        width: 98%;
        gap: 2.2em;
    }

    header {
        background: #fee1e3;
    }

    .success {
        position: absolute;
        top: 20em;
        width: 90%;
    }

    .success img {
        width: 25em;
        height: 25em;
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

    .detail3 {
        width: 140px !important;
        position: relative;
    }

    .detail3 {
        width: 100px !important;
        text-overflow: ellipsis !important;
        overflow: hidden;
        white-space: nowrap;
    }

    .transaction-details2 {
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        gap: 2.4em;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
        width: 98%;
    }

    .details {
        width: 100px;
    }

    .no-lands {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: top;
        flex-direction: column;
    }

    .navigation-div .allocation {
        background: #ffffff;
        box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.12);
        border-radius: 8px;
        text-align: center;
        color: var(--secondary-color);
        width: 150px;
        padding: 0.3em 0.3em;
    }

    a {
        text-decoration: none;
        color: #1a0709;
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

    @media only screen and (max-width: 1300px) {

        .hide {
            display: none;
        }

        .navig {
            gap: 1em;
        }

        .transaction-details2 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
            gap: 1em;
            width: 85%;
        }

        .details p {
            font-size: 12px;
        }


        .transaction-details2 {
            border-radius: 8px;
            /* border: 2px solid black; */
            padding: 1em 2em;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            width: 80%;
        }

        .navigation-div .allocation {
            background: #ffffff;
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.12);
            border-radius: 8px;
            text-align: center;
            color: var(--secondary-color);
            width: 100px;
            padding: 0.3em 0.3em;
        }

        .navig .payment {
            font-size: 12px;
        }

        .success {
            position: absolute;
            top: 40%;
            height: 10em;
            width: 100%;
        }

        .success img {
            width: 20em;
            height: 20em;
        }

        .success p {
            text-align: center;
        }

        .user,
        #openicon {
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

        .links-container li {
            height: 2em;
            grid-gap: 0;
        }

        .links-container {
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 1em;
        }

        .dropdown-links .select-box {
            width: 100%;
            border-radius: 0px !important;
            background: #7e252b;
            margin-left: -1em;
        }

        .dropdown-links .selected {
            border-radius: 0px !important;
            background: #7e252b;
            color: #fff;
        }

        .dropdown-links .select-box .options-container {
            border-radius: 0px !important;
            background: #7e252b;
            z-index: 200;
        }

        .dropdown-links .select-box .option:hover {
            background: var(--primary-black);
            color: #ffffff;
        }

        .dropdown-links .select-box .options-container::-webkit-scrollbar {
            width: 6px;
            background: #0d141f;
            border-radius: 0;
        }

        .dropdown-links .select-box .options-container::-webkit-scrollbar-thumb {
            background: #525861;
            border-radius: 0;
        }

        .dropdown-links .option {
            padding: 0.6em 0;
        }



        .close {
            padding-top: 6em;
        }

    }

    @media only screen and (min-width: 1300px) {

        .dropdown-links .select-box {
            width: 100%;
            border-radius: 0px !important;
            background: #7e252b;
        }

        .dropdown-links .selected {
            border-radius: 0px !important;
            background: #7e252b;
            color: #fff;
        }

        .dropdown-links .select-box .options-container {
            border-radius: 0px !important;
            background: #7e252b;
            z-index: 200;
        }

        .dropdown-links .select-box .option:hover {
            background: var(--primary-black);
            color: #ffffff;
        }

        .dropdown-links .select-box .options-container::-webkit-scrollbar {
            width: 6px;
            background: #0d141f;
            border-radius: 0;
        }

        .dropdown-links .select-box .options-container::-webkit-scrollbar-thumb {
            background: #525861;
            border-radius: 0;
        }

        .dropdown-links .option {
            padding: 1em 0;
        }



        .page-title2 a {
            display: none;
        }

        .flexdetail {
            display: flex;
            flex-direction: column;
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
            height: 84vh;
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

        .links-container li {
            height: 1em;
            width: 95%;
            text-transform: capitalize;
            font-size: 14px;
        }

        .links-container {
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 1.5em;
            padding-top: 0;
        }

        /* .dropdown-links li {
            height: 1em;
            width: 95%;
            text-transform: capitalize;
            font-size: 14px;
        } */

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

        .doc-container {
            width: 90%;
            padding-left: 5em;
        }


        .close {
            display: none;
        }


    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['uniquesupadmin_id'])){ ?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>

        <?php 
             $user = new User;
        
                if(isset($_SESSION['uniquesupadmin_id'])){
                    $newuser = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
                    } 
            
            ?>

        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <div class="user">
                <p><?php if(isset($newuser['super_adminname'])){  ?>
                    <span><?php echo $newuser['super_adminname']; ?></span>&nbsp;
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
        </div>
        <?php }?>

    </header>

    <?php 
             $user = new User;
             $newuser = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
            ?>


    <div class="flex-container">
        <ul class="dropdown-links">
            <div class="center">
                <li id="openicon" style="cursor: pointer;">
                    <img src="images/openmenu.svg" style="width: 20px; height: 20px;" />
                </li>

                <li id="closeicon" style="display: none; cursor: pointer; font-size:14px;">
                    <img src="images/openmenu.svg" style="width: 20px; height: 20px;" />
                </li>
            </div>
            <li class="close">
                <img src="images/close2.svg" style="width: 30px; height: 30px; position: absolute; right: 2em;" />
            </li>
            <div class="links-container">
                <li class="links">
                    <a href="superadmin.php"><img src="images/home3.svg" /></a>
                    <a href="superadmin.php" class="link">Home</a>
                </li>

                <div class="select-box s-box1">
                    <div class="options-container">

                        <div class="option">
                            <li class="links">
                                <a href="newuser.php"><img src="images/referral.svg" /></a>
                                <a href="newuser.php" class="link">New Customer</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="usertype.php"><img src="images/land2.svg" /></a>
                                <a href="usertype.php" class="link">New Land</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links ">
                                <a href="defaultcustomers.php"><img src="images/referral.svg" /></a>
                                <a href="defaultcustomers.php" class="link">Default Customers</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="allocationcustomers.php"><img src="images/referral.svg" /></a>
                                <a href="allocationcustomers.php" class="link">Due Allocation</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="payingcustomers.php"><img src="images/referral.svg" /></a>
                                <a href="payingcustomers.php" class="link">Paying Customers</a>
                            </li>

                        </div>

                    </div>
                    <div class="selected"><span><img src="images/referral.svg" /></span>
                    </div>
                </div>


                <div class="select-box s-box2">
                    <div class="options-container">

                        <div class="option">
                            <li class="links">
                                <a href="allcustomers.php"><img src="images/referral.svg" /></a>
                                <a href="allcustomers.php" class="link">All Customers</a>
                            </li>
                        </div>
                        <div class="option">
                            <li class="links">
                                <a href="allagents.php"><img src="images/referral.svg" /> </a>
                                <a href="allagents.php" class="link">All Agents</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="allsubadmins.php"><img src="images/referral.svg" /> </a>
                                <a href="allsubadmins.php" class="link">All Subadmins</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="allexecutives.php"><img src="images/referral.svg" /> </a>
                                <a href="allexecutives.php" class="link">All Executives</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="allgroups.php"><img src="images/referral.svg" /> </a>
                                <a href="allgroups.php" class="link">All Groups</a>
                            </li>
                        </div>

                    </div>
                    <div class="selected"><span><img src="images/referral.svg" /></span>
                    </div>
                </div>


                <div class="select-box s-box3">
                    <div class="options-container">
                        <div class="option">
                            <li class="links">
                                <a href="allagentearnings.php"><img src="images/referral.svg" /></a>
                                <a href="allagentearnings.php" class="link">View Earnings</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="allexecutiveearnings.php"><img src="images/referral.svg" /></a>
                                <a href="allexecutiveearnings.php" class="link">Executive Earnings</a>
                            </li>
                        </div>


                        <div class="option">
                            <li class="links">
                                <a href="totaltransactions.php"><img src="images/updown.svg" /> </a>
                                <a href="totaltransactions.php" class="link">View Transactions</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="totalref.php"><img src="images/referral.svg" /> </a>
                                <a href="totalref.php" class="link">View Referrals</a>
                            </li>
                        </div>

                    </div>
                    <div class="selected"><span><img src="images/referral.svg" /></span>
                    </div>
                </div>

                <div class="select-box s-box4">
                    <div class="options-container">
                        <div class="option">
                            <li class="links">
                                <a href="createexecutive.php"><img src="images/referral.svg" /> </a>
                                <a href="createexecutive.php" class="link">Create Executive</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="creategroup.php"><img src="images/referral.svg" /> </a>
                                <a href="creategroup.php" class="link">Create Group</a>
                            </li>
                        </div>


                        <div class="option">
                            <li class="links">
                                <a href="createagent.php"><img src="images/referral.svg" /> </a>
                                <a href="createagent.php" class="link">Create Agent</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="createsubadmin.php"><img src="images/referral.svg" /> </a>
                                <a href="createsubadmin.php" class="link">Create Subadmin</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="productperiod.php"><img src="images/land2.svg" /></a>
                                <a href="productperiod.php" class="link">Create Plan</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="selectprice.php"><img src="images/land2.svg" /></a>
                                <a href="selectprice.php" class="link">Create Product</a>
                            </li>
                        </div>

                    </div>
                    <div class="selected"><span><img src="images/referral.svg" /></span>
                    </div>
                </div>

                <li class="links select-link">
                    <a href="documentation.php"><img src="images/land2.svg" /></a>
                    <a href="documentation.php" class="link">Documentation</a>
                </li>

                <li class="links">
                    <a href="#"><img src="images/updown.svg" /></a>
                    <a href="#" class="link">Pay Earnings</a>
                </li>

                <li class="links">
                    <a href="supadmininfo.php"><img src="images/settings.svg" /></a>
                    <a href="supadmininfo.php" class="link">Profile</a>
                </li>
                <li class="links">
                    <a href="logout.php?user=subadmin"><img src="images/exit.svg" /></a>
                    <a href="logout.php?user=subadmin" class="link">Logout</a>
                </li>
            </div>
        </ul>

        <div class="doc-container">
            <div class="page-title2">
                <a href="superadmin.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Available Estates</p>
                <div class="search-icon">
                    <img src="images/search.svg" alt="search image" id="searchimg">

                    <div class="search-input">
                        <form action="" class="search-form">
                            <input type="text" class="search" type="search" name="searchproduct"
                                placeholder="Search For Product">
                        </form>
                    </div>
                </div>
            </div>

            <!-- <div class="no-lands">
            <img src="images/asset_success.svg" alt="success image" />
           <p>You have not uploaded any document yet!!</p>
              </div> -->

            <div class="navigation-div">
                <div class="navig">
                    <div class="payment">Estate Name</div>
                    <div class="payment hide">Location</div>
                    <div class="payment hide">Outright Price</div>
                    <div class="payment">Available Units</div>
                    <div class="payment">Units Bought</div>
                    <div class="payment hide">Subscribers Count</div>
                    <div class="payment hide">Total Amount Bought</div>
                    <div class="payment">Revenue</div>
                </div>
            </div>


            <div class="land-container">
                <?php 
             $land = new User;
             $landview = $land->selectLand();
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
             ?>
                <a
                    href="superadmininfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">
                    <div class="transaction-details2">
                        <div class="details" style="text-transform: uppercase;">
                            <p class="pname"><?php echo $value['product_name'];?></p>
                        </div>

                        <div class="details hide flexdetail" style="text-transform: uppercase;">
                            <p class="pname"><?php echo $value['product_location'];?></p>
                            <p class="pname">Nigeria</p>
                        </div>

                        <div class="details hide" style="text-transform: uppercase;">
                            <p class="pname">&#8358;<?php  $unitprice =  $value['outright_price'];
                         if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                            echo number_format($unitprice);
                          }  else {
                              echo $unitprice;
                          }
                    ?></p>
                        </div>

                        <div class="details" style="text-transform: uppercase;">
                            <p class="pname"><?php echo $value['product_unit'];?></p>
                        </div>

                        <div class="details" style="text-transform: uppercase;">
                            <p class="pname"><?php echo $value['bought_units'];?></p>
                        </div>

                        <div class="details hide" style="text-transform: uppercase;">
                            <p class="pname"><?php 
                 $num = $land->selectSubscribers($value['unique_id']);
                 $number = $land->selectSum($value['unique_id']);
                 $total = $land->selectTotalPayment($value['unique_id']);
                 if(!empty($num)){
                 foreach($num as $key => $value){
                    echo $value;
                 } } else {
                 echo "0";
                 }
                ?></p>
                        </div>

                        <div class="details hide" style="text-transform: uppercase;">
                            <p class="pname">&#8358; <?php 
                   if(!empty($number)){
                    foreach($number as $key => $value){
                        if(is_null($value)){
                            echo "0";
                          } else{
                            $unitprice = $value;
                            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                                echo number_format($unitprice);
                              } else {
                                 echo $unitprice;
                              }
                          }
                    } }
                ?></p>
                        </div>

                        <div class="details" style="text-transform: uppercase;">
                            <p class="pname">&#8358;<?php 
              
              foreach($total as $key => $value){
                if(is_null($value)){
                    echo "0";
                  } else{
                    $unitprice = $value;
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                        echo number_format($unitprice);
                      } else {
                         echo $unitprice;
                      }
                  }
              }
              ?></p>
                        </div>



                    </div>
                </a>

                <?php }}?>

                <?php if(empty($landview)){?>
                <div class="success">
                    <img src="images/whoops.svg" alt="" />
                    <p>There are no estates available yet</p>
                </div>
                <?php }?>
            </div>
        </div>
    </div>





    <script src="js/main.js"></script>
    <script>
    let searchIcon = document.querySelector('.search-icon');
    searchIcon.onclick = () => {
        let searchinput = document.querySelector('.search-input');
        let searchinput2 = document.querySelector('.search');
        searchinput.style.display = "flex";
        document.querySelector('#searchimg').style.display = "none";

        let searchform = document.querySelector('.search-form');
        searchform.onsubmit = (e) => {
            e.preventDefault();
        }

        searchinput2.onkeyup = () => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchproductlist.php?user=supadmin`);

            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        document.querySelector('.land-container').innerHTML = data;
                    }
                }
            };
            let formData = new FormData(searchform);
            xhr.send(formData);
        }
    }

    if (window.innerWidth > 1200) {
        let dropdownnav = document.querySelector(".dropdown-links");
        let open = document.querySelector('#openicon');
        let closeicon = document.querySelector('#closeicon');
        open.onclick = () => {
            dropdownnav.style = `
        width: 14%;
        `;

            <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
            document.querySelector('.s-box1 .selected').innerHTML = '<span>Customers</span>';
            document.querySelector('.s-box2 .selected').innerHTML = '<span>List Pages</span>';
            document.querySelector('.s-box3 .selected').innerHTML = '<span>View</span>';
            document.querySelector('.s-box4 .selected').innerHTML = '<span>Create</span>';
            <?php }?>
            open.style.display = "none";
            closeicon.style.display = "block";
            document.querySelector(".doc-container").style = `
         padding-left: 13em;
        `;
            let allLinks = document.querySelectorAll(".links-container .links .link");

            let allLink = document.querySelectorAll(".links-container .links");
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

            <?php  if(isset($_SESSION['uniquesupadmin_id'])){?>
            document.querySelector('.s-box1 .selected').innerHTML = '<img src="images/referral.svg" />';
            document.querySelector('.s-box2 .selected').innerHTML = '<img src="images/referral.svg" />';
            document.querySelector('.s-box3 .selected').innerHTML = '<img src="images/referral.svg" />';
            document.querySelector('.s-box4 .selected').innerHTML = '<img src="images/referral.svg" />';
            <?php }?>
            open.style.display = "block";
            closeicon.style.display = "none";
            document.querySelector(".doc-container").style = `
         padding-left: 5em;
        `;

            let allLink = document.querySelectorAll(".links-container .links");
            allLink.forEach((element) => {
                element.style = `
        justify-content: center
        `;
            });

            let allLinks = document.querySelectorAll(".links-container .links .link");
            allLinks.forEach((element) => {
                element.style = `
         visibility: hidden;
         display:none;
        `;
            });
        }
    }

    if (window.innerWidth < 1300) {
        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        document.querySelector('.s-box1 .selected').innerHTML = '<span>Customers</span>';
        document.querySelector('.s-box2 .selected').innerHTML = '<span>List Pages</span>';
        document.querySelector('.s-box3 .selected').innerHTML = '<span>View</span>';
        document.querySelector('.s-box4 .selected').innerHTML = '<span>Create</span>';
        <?php }?>
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