<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['uniquesubadmin_id'])){
    header("Location: teamspace.php");
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

    .unverified {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5px;
        padding: 1px 6px;
        border-radius: 15px;
        background-color: #808080;
        color: #fff;
    }

    .unverified .unspan {
        font-size: 14px;
    }

    .amountdiv {
        width: 150px;
        font-size: 18px;
        font-weight: 500;
        color: #ff6600 !important;
    }

    .dropdown-links {
        height: 18em;
    }

    .land-estate .land-details {
        display: none;
    }

    .land_estate_container .land-estate {
        filter: drop-shadow(0px 4px 8px rgba(128, 128, 128, 0.90));
        min-height: 0px !important;
        padding-top: 0;
        gap: 0;
        border-radius: 8px;
        position: relative;
    }



    .land-estate .land-image {
        border-radius: 8px !important;
        height: 250px !important;
        width: 100%;
    }

    .land-image img {
        border-radius: 8px !important;
        height: 250px !important;
    }


    @media only screen and (min-width: 1300px) {

        .details2 {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6em;
            flex-direction: row;
        }

        .details2 p {
            color: #808080;
        }

        .details2 p,
        .details2 h3 {
            font-size: 22px;
        }

        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
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

        .user .profile-name {
            font-weight: 600;
            font-size: 20px;
            color: #1A0709;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5px;
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




        .details {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6em;
        }

        .details p {
            color: #808080;
        }

        .details p,
        .details h3 {
            font-size: 22px;
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

        .land-estate {
            border: 1px solid #d4d1d1;
            width: 320px;
            /* height: 290px; */
            padding-top: 8px;
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

        .transaction-details {
            width: 80%;
        }


        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
            height: 70vh;
        }

        .estates {
            padding-top: 6em;
            position: absolute;
            left: 3em;
            padding: 0;
            width: 93%;
            transition: all 0.5s;
            margin-top: 6em;
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



    }

    @media only screen and (max-width: 1300px) {
        .amountdiv {
            font-size: 14px;
        }

        .user,
        #openicon {
            display: none;
        }

        .links img {
            display: none;
        }

        .profile-image {
            position: relative;
        }

        #check {
            position: absolute;
            bottom: -7px;
            right: -5px;
        }


        .unverified {
            width: 100px;
            position: absolute;
            right: 20px;
            margin-top: 0.4em;
        }



        .land_estate_container {
            display: flex;
            flex-direction: row;
            gap: 1em;
        }


        .profile-div-container {
            margin: auto;
            width: 100%;
        }



        .dropdown-links {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
            background: #7e252b;
            transform: translateX(100%);
            transition: all 1s;
            width: 50%;
            position: fixed;
            bottom: 0;
            border-radius: 8px 0px 0px 8px;
        }

        .dropdown-links li {
            height: 1em;
            grid-gap: 0;
        }

        .land-estate {
            width: 290px;
        }


        .close {
            padding-top: 26em;
        }

        /* .close {
            position: absolute;
            top: 4em;
            right: 1em;
        } */

    }



    @media only screen and (max-width: 800px) {
        body {
            height: 90vh;
        }

        .dropdown-links {
            height: 100vh;
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

    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
            <a href="subadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>

        <?php 
             $user = new User;
             $newuser = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
            ?>

        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <div class="user">
                <div class="profile-name">
                    <?php if(empty($newuser['subadmin_image'])){
    ?>
                    <div class="unverified">
                        <span style="text-transform: capitalize;" class="unspan">unverified</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z"
                                fill="rgba(249,19,19,1)" />
                        </svg>
                    </div>
                    <?php } else {?>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-.997-6l7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414 1.414L11.003 16z"
                            fill="rgba(50,179,40,1)" />
                    </svg>
                    <?php }?>
                    <p><?php if(isset($newuser['subadmin_name'])){  ?>
                        <span><?php echo $newuser['subadmin_name']; ?></span>&nbsp;
                        <?php }?>
                    </p>
                </div>

                <div class="profile-image">
                    <?php if(!empty($newuser['subadmin_image'])){?>
                    <a href="subadmininfo.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['subadmin_image'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['subadmin_image'])){?>
                    <a href="subadmininfo.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
        </div>

    </header>
    <?php 
             $user = new User;
             $newuser = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
            ?>




    <div class="flex-container">

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
            <div class="links-container">
                <li class="links select-link">
                    <a href="subadmin.php"><img src="images/home3.svg" /></a>
                    <a href="subadmin.php" class="link">Home</a>
                </li>
                <li class="links">
                    <a href="allcustomers.php"><img src="images/referral.svg" /></a>
                    <a href="allcustomers.php" class="link">All Customers</a>
                </li>
                <li class="links">
                    <a href="allagents.php"><img src="images/referral.svg" /></a>
                    <a href="allagents.php" class="link">All Agents</a>
                </li>

                <li class="links">
                    <a href="allgroups.php"><img src="images/referral.svg" /></a>
                    <a href="allgroups.php" class="link">All Groups</a>
                </li>
                <li class="links">
                    <a href="allagentearnings.php"><img src="images/referral.svg" /></a>
                    <a href="allagentearnings.php" class="link">View Earnings</a>
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
                    <a href="creategroup.php"><img src="images/referral.svg" /> </a>
                    <a href="creategroup.php" class="link">Create Group</a>
                </li>

                <li class="links">
                    <a href="usertype.php"><img src="images/land2.svg" /></a>
                    <a href="usertype.php" class="link">New Land</a>
                </li>


                <li class="links">
                    <a href="defaultcustomers.php"><img src="images/referral.svg" /></a>
                    <a href="defaultcustomers.php" class="link">Default Customers</a>
                </li>
                <li class="links">
                    <a href="allocationcustomers.php"><img src="images/referral.svg" /></a>
                    <a href="allocationcustomers.php" class="link">Due Allocation</a>
                </li>
                <li class="links">
                    <a href="payingcustomers.php"><img src="images/referral.svg" /></a>
                    <a href="payingcustomers.php" class="link">Paying Customers</a>
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
                    <a href="subadmininfo.php"><img src="images/settings.svg" /></a>
                    <a href="subadmininfo.php" class="link">Profile</a>
                </li>
                <li class="links">
                    <a href="logout.php?user=subadmin"><img src="images/exit.svg" /></a>
                    <a href="logout.php?user=subadmin" class="link">Logout</a>
                </li>

            </div>
        </ul>


        <div class="profile-container">
            <div class="profile-info">
                <div class="details2">
                    <p>Welcome Back!</p>
                    <h3><?php if(isset($newuser['subadmin_name'])){  ?>
                        <span><?php echo $newuser['subadmin_name']; ?></span>&nbsp;
                        <?php }?>
                    </h3>
                </div>

                <div class="profile-image profile-image2">
                    <?php if(!empty($newuser['subadmin_image'])){?>
                    <a href="subadmininfo.php" style="color: #808080;">
                        <img src="profileimage/<?php echo $newuser['subadmin_image'];?>" alt="profile image" />
                    </a>
                    <?php }?>
                    <?php if(empty($newuser['subadmin_image'])){?>
                    <a href="subadmininfo.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                    <?php if(empty($newuser['subadmin_image'])){
              ?>
                    <div class="unverified">
                        <span style="text-transform: capitalize;" class="unspan">unverified</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z"
                                fill="rgba(249,19,19,1)" />
                        </svg>
                    </div>
                    <?php } else {?>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" id="check">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-.997-6l7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414 1.414L11.003 16z"
                            fill="rgba(50,179,40,1)" />
                    </svg>
                    <?php }?>
                </div>
            </div>


            <div class="profile-div-container">
                <div class="profile-div">
                    <img class="profile-icon" src="images/land.svg" alt="land-icon-image" />

                    <a href="customercount.php">
                        <div class="navigate">
                            <p>Total Customer Count</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/Wallet.svg" alt="land-icon-image" />

                    <a href="allestates3.php">
                        <div class="navigate">
                            <p>Land</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <a href="#">
                    <div class="profile-div">

                        <div class="navigate"
                            style="display: flex; position: absolute; top: 0.4em; flex-direction:column; padding-left: 0.8em;">
                            <p>Total Payment</p>
                            <p class="amountdiv">
                                &#8358;
                                <?php 
                               
                                $totalpayment = $user->selectTotalUsersPayment();
             if($totalpayment > 999 || $totalpayment > 9999 || $totalpayment > 99999 || $totalpayment > 999999){
                               echo number_format($totalpayment);
                               
                             } else {
                                echo round($totalpayment);
                             }
                               
                                ?></p>
                        </div>
                    </div>
                </a>

                <div class="profile-div">
                    <div class="navigate"
                        style="display: flex; position: absolute; top: 0.4em; flex-direction:column; padding-left: 0.8em;">
                        <p>Total Earnings</p>
                        <p class="amountdiv">&#8358;
                            <?php 
                               
                               $totalearnings = $user->selectTotalEarnings();
                                if($totalearnings > 999 || $totalearnings > 9999 || $totalearnings > 99999 || $totalearnings > 999999){
                                    echo number_format($totalearnings);
                                    
                                  } else {
                                     echo round($totalearnings);
                                  }
                           
                                ?>
                        </p>
                    </div>
                </div>



                <div class="profile-div">
                    <div class="navigate"
                        style="display: flex; position: absolute; top: 0.4em; flex-direction:column; padding-left: 0.8em;">
                        <p style="font-size: 14px;">Yurland Referrals</p>
                        <p class="amountdiv">

                            <?php 
                               
                                $allrefusers = $user->selectAllYurlandUsers();
                                foreach ($allrefusers as $key => $value) {
                                   echo $value;
                                }
                                
                                ?>
                        </p>
                    </div>
                </div>

                <div class="profile-div">
                    <div class="navigate"
                        style="display: flex; position: absolute; top: 0.4em; flex-direction:column; padding-left: 0.8em;">
                        <p style="font-size: 14px;">Sold Out Lands</p>
                        <p class="amountdiv">
                            <?php 
                                $alllands = $user->selectPurchasedLands();
                                foreach ($alllands as $key => $value) {
                                   echo $value;
                                }
                                
                                ?>
                        </p>
                    </div>
                </div>


                <div class="profile-div">
                    <div class="navigate"
                        style="display: flex; position: absolute; top: 0.4em; flex-direction:column; padding-left: 0.8em;">
                        <p style="font-size: 14px;">Total Paid Earnings</p>
                        <p class="amountdiv">&#8358;

                            <?php 
                               
                               $paidearnings = $user->selectAllPaidEarnings();
                                if($paidearnings > 999 ||   $paidearnings > 9999 ||   $paidearnings > 99999 ||   $paidearnings > 999999){
                                    echo number_format($paidearnings);
                                    
                                  } else {
                                     echo round($paidearnings);
                                  }
                           
                                ?>
                        </p>
                    </div>
                </div>

                <div class="profile-div">
                    <div class="navigate"
                        style="display: flex; position: absolute; top: 0.4em; flex-direction:column; padding-left: 0.8em;">
                        <p style="font-size: 14px;">Total Pending Earnings</p>
                        <p class="amountdiv">&#8358;

                            <?php 
                               
                               $pendingearnings = $user->selectAllPendingEarnings();
                                if($pendingearnings > 999 ||  $pendingearnings > 9999 ||  $pendingearnings > 99999 ||  $pendingearnings > 999999){
                                    echo number_format($pendingearnings);
                                    
                                  } else {
                                     echo round($pendingearnings);
                                  }
                           
                                ?>
                        </p>
                    </div>
                </div>


                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="totaltransactions.php">
                        <div class="navigate">
                            <p>Transactions</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/union.svg" alt="land-icon-image" />

                    <a href="totalearnings.php">
                        <div class="navigate">
                            <p>Earnings</p>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>

                <div class="profile-div">
                    <img class="profile-icon" src="images/paystack.svg" alt="land-icon-image" />

                    <a href="allcustomers.php">
                        <div class="navigate">
                            <div>
                                <p>Make new</p>
                                <p>Payment</p>
                            </div>
                            <img src="images/right_arrow.svg" alt="" />
                        </div>
                    </a>
                </div>
            </div>


            <div class="swiper estates swiper-counter">
                <p class="available">Available Estates</p>
                <div class="land_estate_container swiper-wrapper">
                    <?php 
             $land = new User;
             $landview = $land->selectLandPrime();
             if(!empty($landview)){
                foreach($landview as $key => $value){
            ?>
                    <div class="land-estate swiper-slide" style="height: 250px;">
                        <div class="land-image">

                            <img src="landimage/<?php if(isset($value['product_image'])){
                            echo $value['product_image'];
                        }?>" alt="estate image" />

                        </div>
                        <div class="land-details">
                            <div class="land-name">
                                <p><?php echo $value['product_name'];?></p>
                            </div>
                            <div class="land-location">
                                <p><?php echo $value['product_location'];?></p>
                            </div>
                        </div>
                    </div>

                    <?php   }
             } ?>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>


    <script src="js/swiper-bundle.min.js"></script>
    <!--========== SWIPER JS ============  -->
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
            open.style.display = "block";
            closeicon.style.display = "none";
            document.querySelector(".profile-container").style = `
         padding-left: 1em;
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

    let swiperVerse = new Swiper(".swiper-counter", {
        loop: true,
        spaceBetween: 20,
        slidesPerView: "auto",
        grabCursor: true,
        autoplay: true,
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
            autoplay: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 3,
            },
            1024: {
                spaceBetween: 20,
            },
        },
    });

    // let userdate = document.getElementsByName("userdate");

    // let userdates = [];
    // userdate.forEach(element => {
    //     userdates.push(parseInt(element.innerHTML));
    // });

    // //console.log(paydates);

    // let sum2 = 0;

    // for (let i = 0; i < userdates.length; i++) {
    //     sum2 += userdates[i];
    // }
    // //console.log(sum);



    // let paydate = document.getElementsByName("paydate");

    // let paydates = [];
    // paydate.forEach(element => {
    //     paydates.push(parseInt(element.innerHTML));
    // });

    // //console.log(paydates);

    // let sum = 0;

    // for (let i = 0; i < paydates.length; i++) {
    //     sum += paydates[i];
    // }
    //console.log(sum);




    //document.querySelector('.totalearn').innerHTML = paydates.length;
    </script>
</body>

</html>