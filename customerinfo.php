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

    .details {
        width: 160px !important;
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
        height: 220px !important;
        border-radius: 8px 8px 0px 0px;
    }

    .updated-img img {
        height: 220px !important;
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

        .details .date {
            font-size: 9px !important;
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

        .transaction-details .date {
            font-size: 11px !important;
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




        <?php if(isset($_SESSION['uniqueagent_id'])) {
            ?>.close {
                padding-top: 5em;
            }

            <?php
        }

        ?><?php if(isset($_SESSION['uniquesubadmin_id'])) {
            ?>.close {
                padding-top: 26em;
            }

            <?php
        }

        ?><?php if(isset($_SESSION['uniquesupadmin_id'])) {
            ?>.close {
                padding-top: 6em;
            }

            <?php
        }

        ?>.updated-land {
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
             if(isset($_SESSION['uniquesubadmin_id'])){
             $newuser = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
             }

             if(isset($_SESSION['uniquesupadmin_id'])){
                $newuser = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
                }

                if(isset($_SESSION['uniqueagent_id'])){
                    $newuser = $user->selectAgent($_SESSION['uniqueagent_id']);
                }
           

            ?>

        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />

            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <div class="user">
                <p><?php if(isset($newuser['agent_name'])){  ?>
                    <span><?php echo $newuser['agent_name']; ?></span>&nbsp;
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['agent_img'])){?>
                    <a href="agentprofileinfo.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['agent_img'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['agent_img'])){?>
                    <a href="agentprofileinfo.php" style="color: #808080;">
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
                    <span><?php echo $newuser['subadmin_name']; ?></span>&nbsp;
                    <?php }?>
                </p>
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
            <?php }?>

            <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
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
            <?php }?>


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

        <?php }?>

        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
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
                <li class="links select-link">
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

                        <div class="option">
                            <li class="links">
                                <a href="editpercentage.php"><img src="images/referral.svg" /></a>
                                <a href="editpercentage.php" class="link">Customer Percentage</a>
                            </li>

                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="edityurland.php"><img src="images/referral.svg" /></a>
                                <a href="edityurland.php" class="link">Yurland Percentage</a>
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
                                <a href="yurlandreferrals.php"><img src="images/updown.svg" /> </a>
                                <a href="yurlandreferrals.php" class="link">Yurland Referrals</a>
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

                <li class="links">
                    <a href="documentation.php"><img src="images/land2.svg" /></a>
                    <a href="documentation.php" class="link">Documentation</a>
                </li>

                <li class="links">
                    <a href="totalearnings.php"><img src="images/updown.svg" /></a>
                    <a href="totalearnings.php" class="link">Pay Earnings</a>
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
            <div class="links-container">
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
            </div>
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

                    <?php if($value['delete_status'] == "Deleted"){?>
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
                    if($value['payment_method'] == "Outright"){
                        $insertupdate = $user->updateLandHistory($value['product_id'],$_GET['unique'],$value['payment_method'],$value['newpay_id']);

                        $updateearning = $user->updateEarningHistory($value['newpay_id']);
                        
                        $insertuser = $user->DeleteProductP($value['product_id'],$_GET['unique'],$value['payment_method'],$value['newpay_id']);
                    }

                    if($value['payment_method'] == "NewPayment" || $value['payment_method'] == "Subscription"){
                        $insertupdate = $user->updateLandHistory2($value['product_id'],$_GET['unique'],$value['payment_method'],$value['newpay_id']);

                        $updateearning = $user->updateEarningHistory($value['newpay_id']);
                        
                        $insertuser = $user->DeleteProductP2($value['product_id'],$_GET['unique'],$value['payment_method'],$value['payment_id'],$value['newpay_id']);
                    }
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
                    $insertuser = $user->updateProductStat($value['product_id'],$_GET['unique'],$value['payment_method'],$value['newpay_id']);
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
                                                href="estateinfo.php?id=<?php echo $value['unique_id'];?>&idtwo=<?php echo $value['newpay_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">click
                                                here to view</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="detail-four">

                            </div>
                            <?php if($value['payment_method'] == "Subscription"){?>
                            <?php if($value['failed_charges'] > "2"){?>
                            <div class="cartbutton">
                                <a href="estateinfo.php?id=<?php echo $value['product_id'];?>&idtwo=<?php echo $value['newpay_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=failedpayment&keyref=09123454954848kdksuuejwej&unique=<?php echo $_GET['unique'];?>&remprice=<?php echo $value['failed_charges'];?>"
                                    style="color: #7e252b;">Pay Up</a>
                            </div>
                            <?php } else {?>
                            <div class="cartbutton">&#8358;<?php 
                    $unitprice = $value['product_price'];
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } else {
                                 echo $unitprice;
                             }
                      ?> &nbsp;<span>daily</span></div>
                            <?php }?>
                            <?php } else if($value['balance'] < "2" && $value['payment_method'] == "Subscription" && $value['failed_charges'] < "2" && $value['allocation_status'] == "approved"){ ?>
                            <div class="cartbutton" style="font-size: 12px;"><?php 
                      echo "Payment Completed";
             ?> &nbsp;</div>
                            <?php } else if($value['allocation_status'] == "unapproved"){?>
                            <div class="cartbutton" style="font-size: 12px;"><?php 
                      echo "Pending Allocation";
             ?> &nbsp;</div>
                            <?php } else if($value['balance'] < "2" && $value['payment_method'] == "NewPayment" || $value['period_num'] == "0"){ ?>
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
                                <a href="estateinfo.php?id=<?php echo $value['product_id'];?>&idtwo=<?php echo $value['newpay_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=newpayment&keyref=09123454954848kdksuuejwej&unique=<?php echo $_GET['unique'];?>&remprice=<?php echo $value['balance'];?>"
                                    style="color: #7e252b;">Pay Up</a>
                                <input type="hidden" id="date" value="<?php echo $value['sub_period'];?>" />
                                <input type="hidden" value="<?php echo $value['balance'];?>" id="check">
                                <form id="priceform">
                                    <input type="hidden" value="<?php 
                          $increase = 2 / 100 * $value['sub_price'];
                          $priceincrement = ($increase + $value['sub_price']) * $value['period_num'];
                        echo $priceincrement;
                        ?>" id="increase" name="increase">
                                    <input type="hidden" value="<?php 
                          $increase = 2 / 100 * $value['sub_price'];
                          $newsubprice = $increase + $value['sub_price'];
                        echo $newsubprice;
                        ?>" id="increase2" name="newsubprice">
                                    <input type="hidden" name="customer" value="<?php echo $value['customer_id'];?>" />
                                    <input type="hidden" value="<?php echo $value['product_id'];?>" name="product">
                                    <input type="hidden" value="<?php echo $value['newpay_id'];?>" name="newpayid">
                                </form>

                                <script>
                                let dateInput<?php echo $value['newpay_id'];?> = document.querySelector('#date');
                                let checkBal<?php echo $value['newpay_id'];?> = document.querySelector('#check').value;
                                var countDownDate<?php echo $value['newpay_id'];?> = new Date(
                                    dateInput<?php echo $value['newpay_id'];?>.value);
                                var now<?php echo $value['newpay_id'];?> = new Date().getTime();
                                var timeleft<?php echo $value['newpay_id'];?> =
                                    countDownDate<?php echo $value['newpay_id'];?> -
                                    now<?php echo $value['newpay_id'];?>;
                                var date = new Date();

                                let day = date.getDate();
                                var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "June",
                                    "July",
                                    "Aug", "Sept", "Oct",
                                    "Nov", "Dec"
                                ];
                                let month = date.getMonth();
                                let year = date.getFullYear();

                                // This arrangement can be altered based on how we want the date's format to appear.
                                let currentDate = "Apr-29-2023";
                                let completionDate = "Apr-28-2023";
                                let checkBalValue = "2000";
                                var firstDay = new Date(date.getFullYear(), date.getMonth(), 8);

                                if (currentDate > completionDate &&
                                    checkBalValue > 2) {
                                    let priceform<?php echo $value['newpay_id'];?> = document.querySelector(
                                        '#priceform');

                                    function increasePrice<?php echo $value['newpay_id'];?>() {
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
                                        let formData = new FormData(
                                            priceform<?php echo $value['newpay_id'];?>); //creating new formData Object

                                        xhr.send(formData);
                                    }

                                    setTimeout(() => {
                                        increasePrice<?php echo $value['newpay_id'];?>();
                                    }, 1000);



                                }

                                //console.log(timeleft);
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
                                 echo round($unitprice);
                             }
             ?></span></p>
                                <p class="balance"><span>Balance:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $value['balance'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        } else {
                                            if($unprice < "2"){
                                                echo "0";
                                            }else {
                                            echo number_format($unprice);
                                            }
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
                                <?php if($value['balance'] > "2" && $value['payment_method'] == "Subscription"){?>
                                <?php if($value['failed_charges'] > "2"){?>
                                <div class="cartbutton">
                                    <a href="estateinfo.php?id=<?php echo $value['product_id'];?>&idtwo=<?php echo $value['newpay_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=failedpayment&keyref=09123454954848kdksuuejwej&unique=<?php echo $_GET['unique'];?>&remprice=<?php echo $value['failed_charges'];?>"
                                        style="color: #7e252b;">Pay Up</a>
                                </div>

                                <input type="hidden" value="<?php echo $value['failed_charges'];?>" id="check2">
                                <input type="hidden" value="<?php echo $value['increase_date'];?>" id="increasedate2">

                                <form id="priceform2">
                                    <input type="hidden" value="<?php 
                          $increasetwo = $value['increase_rate'] / 100 * $value['failed_charges'];
                          $priceincrementtwo = $increasetwo + $value['failed_charges'];
                        echo $priceincrementtwo;
                        ?>" id="increase3" name="increase">
                                    <input type="hidden" name="customer" value="<?php echo $value['customer_id'];?>" />
                                    <input type="hidden" value="<?php echo $value['product_id'];?>" name="product">
                                    <input type="hidden" value="<?php echo $value['newpay_id'];?>" name="newpayid">
                                    <input type="hidden" value="<?php 
                                        $dt = strtotime($value['increase_date']); 
                                        echo date("M-d-Y", strtotime("+1 month", $dt))
                                        ?>" name="increasedate">
                                </form>
                                <script>
                                let checkBaltwo<?php echo $value['newpay_id'];?> = document.querySelector('#check2')
                                    .value;
                                let increaseDatetwo<?php echo $value['newpay_id'];?> = document.querySelector(
                                        '#increasedate2')
                                    .value;

                                var now<?php echo $value['newpay_id'];?> = new Date().getTime();

                                // var date = new Date();
                                // var firstDay = new Date(date.getFullYear(), date.getMonth() + 1, 1);
                                // let firstDate = `${firstDay.toLocaleString('default', {
                                //         month: 'short'
                                //     })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
                                // let firstDate = "Apr-8-2023";
                                //console.log(firstDate);
                                var date = new Date();
                                let daytwo<?php echo $value['newpay_id'];?> = date.getDate();
                                let Monthnametwo<?php echo $value['newpay_id'];?> = date.toLocaleString('default', {
                                    month: 'short'
                                });
                                let yeartwo<?php echo $value['newpay_id'];?> = date.getFullYear();
                                let shortdatetwo<?php echo $value['newpay_id'];?> =
                                    `${Monthnametwo<?php echo $value['newpay_id'];?>}-${daytwo<?php echo $value['newpay_id'];?>}-${yeartwo<?php echo $value['newpay_id'];?>}`;
                                // let shortdate = "Apr-8-2023";
                                // console.log(shortdate);
                                //let month = date.getMonth();


                                // This arrangement can be altered based on how we want the date's format to appear.
                                let currentDatetwo<?php echo $value['newpay_id'];?> =
                                    `${Monthnametwo<?php echo $value['newpay_id'];?>}-${daytwo<?php echo $value['newpay_id'];?>}-${yeartwo<?php echo $value['newpay_id'];?>}`;
                                let checkBalValuetwo<?php echo $value['newpay_id'];?> =
                                    checkBaltwo<?php echo $value['newpay_id'];?>;
                                //console.log(currentDate);





                                if (checkBalValuetwo<?php echo $value['newpay_id'];?> > 2 &&
                                    currentDatetwo<?php echo $value['newpay_id'];?> >=
                                    increaseDatetwo<?php echo $value['newpay_id'];?>
                                ) {
                                    let priceformtwo<?php echo $value['newpay_id'];?> = document.querySelector(
                                        '#priceform2');

                                    function increasePricetwo<?php echo $value['newpay_id'];?>() {
                                        let xhr = new XMLHttpRequest(); //creating XML Object
                                        xhr.open("POST", "increase2.php", true);
                                        xhr.onload = () => {
                                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                                if (xhr.status === 200) {
                                                    let data = xhr.response;
                                                    console.log(data);
                                                }
                                            }
                                        }
                                        // we have to send the information through ajax to php
                                        let formData = new FormData(
                                            priceformtwo<?php echo $value['newpay_id'];?>
                                        ); //creating new formData Object

                                        xhr.send(formData);
                                    }


                                    setTimeout(() => {
                                        increasePricetwo<?php echo $value['newpay_id'];?>();
                                    }, 3000);


                                }

                                //console.log(timeleft);
                                </script>
                                <?php } else {?>
                                <div class="cartbutton">&#8358;<?php 
                    $unitprice = $value['sub_price'];
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } else {
                                 echo $unitprice;
                             }
                      ?> &nbsp;<span><?php echo $value['sub_period']?></span></div>
                                <?php }?>
                                <?php } else if($value['balance'] < "2" && $value['payment_method'] == "Subscription" && $value['allocation_status'] == "approved"){ ?>

                                <div class="cartbutton" style="font-size: 12px;"><?php 
                      echo "Payment Completed";
             ?> &nbsp;</div>
                                <?php } else if($value['allocation_status'] == "unapproved" && $value['balance'] < "2"){?>
                                <div class="cartbutton" style="font-size: 12px;"><?php 
                      echo "Pending Allocation";
             ?> &nbsp;</div>

                                <?php } else if($value['balance'] < "2" && $value['payment_method'] == "NewPayment" && $value['period_num'] == "0"){ ?>
                                <div class="cartbutton" style="font-size: 12px;"><?php 
                      echo "Payment Completed";
             ?> &nbsp;</div>

                                <?php    }
                else {?>
                                <div class="cartbutton" style="font-size: 12px;"><?php 
             if($value['balance'] != "0" && $value['payment_method'] == "NewPayment"){ ?>
                                    <a href="estateinfo.php?id=<?php echo $value['product_id'];?>&idtwo=<?php echo $value['newpay_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=newpayment&keyref=09123454954848kdksuuejwej&unique=<?php echo $_GET['unique'];?>&remprice=<?php echo $value['balance'];?>"
                                        style="color: #7e252b;">Pay Up</a>
                                    <input type="hidden" id="date" value="<?php echo $value['sub_period'];?>" />
                                    <input type="hidden" value="<?php echo $value['balance'];?>" id="check">
                                    <input type="hidden" value="<?php echo $value['increase_date'];?>"
                                        id="increasedate">
                                    <form id="priceform">
                                        <input type="hidden" value="<?php 
                          $increase = $value['increase_rate'] / 100 * $value['sub_price'];
                          $priceincrement = ($increase + $value['sub_price']) * $value['period_num'];
                        echo $priceincrement;
                        ?>" id="increase" name="increase">
                                        <input type="hidden" value="<?php 
                          $increase = $value['increase_rate'] / 100 * $value['sub_price'];
                          $newsubprice = $increase + $value['sub_price'];
                        echo $newsubprice;
                        ?>" id="increase2" name="newsubprice">
                                        <input type="hidden" name="customer"
                                            value="<?php echo $value['customer_id'];?>" />
                                        <input type="hidden" value="<?php echo $value['product_id'];?>" name="product">
                                        <input type="hidden" value="<?php echo $value['newpay_id'];?>" name="newpayid">
                                        <input type="hidden" value="<?php 
                                        $dt = strtotime($value['increase_date']); 
                                        echo date("M-d-Y", strtotime("+1 month", $dt))
                                        ?>" name="increasedate">
                                    </form>

                                    <script>
                                    let dateInput<?php echo $value['newpay_id'];?> = document.querySelector('#date')
                                        .value;
                                    let checkBal<?php echo $value['newpay_id'];?> = document.querySelector('#check')
                                        .value;
                                    let increaseDate<?php echo $value['newpay_id'];?> = document.querySelector(
                                            '#increasedate')
                                        .value;

                                    var now<?php echo $value['newpay_id'];?> = new Date().getTime();

                                    // var date = new Date();
                                    // var firstDay = new Date(date.getFullYear(), date.getMonth() + 1, 1);
                                    // let firstDate = `${firstDay.toLocaleString('default', {
                                    //         month: 'short'
                                    //     })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
                                    // let firstDate = "Apr-8-2023";
                                    //console.log(firstDate);
                                    var date = new Date();
                                    let day<?php echo $value['newpay_id'];?> = date.getDate();
                                    let Monthname<?php echo $value['newpay_id'];?> = date.toLocaleString('default', {
                                        month: 'short'
                                    });
                                    let year<?php echo $value['newpay_id'];?> = date.getFullYear();
                                    let shortdate<?php echo $value['newpay_id'];?> =
                                        `${Monthname<?php echo $value['newpay_id'];?>}-${day<?php echo $value['newpay_id'];?>}-${year<?php echo $value['newpay_id'];?>}`;
                                    // let shortdate = "Apr-8-2023";
                                    // console.log(shortdate);
                                    //let month = date.getMonth();


                                    // This arrangement can be altered based on how we want the date's format to appear.
                                    let currentDate<?php echo $value['newpay_id'];?> =
                                        `${Monthname<?php echo $value['newpay_id'];?>}-${day<?php echo $value['newpay_id'];?>}-${year<?php echo $value['newpay_id'];?>}`;
                                    let completionDate<?php echo $value['newpay_id'];?> =
                                        dateInput<?php echo $value['newpay_id'];?>;
                                    let checkBalValue<?php echo $value['newpay_id'];?> =
                                        checkBal<?php echo $value['newpay_id'];?>;
                                    //console.log(currentDate);





                                    if (currentDate<?php echo $value['newpay_id'];?> >
                                        completionDate<?php echo $value['newpay_id'];?> &&
                                        checkBalValue<?php echo $value['newpay_id'];?> > 2 &&
                                        currentDate<?php echo $value['newpay_id'];?> >=
                                        increaseDate<?php echo $value['newpay_id'];?>
                                    ) {
                                        let priceform<?php echo $value['newpay_id'];?> = document.querySelector(
                                            '#priceform');

                                        function increasePrice<?php echo $value['newpay_id'];?>() {
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
                                            let formData = new FormData(
                                                priceform<?php echo $value['newpay_id'];?>
                                            ); //creating new formData Object

                                            xhr.send(formData);
                                        }


                                        setTimeout(() => {
                                            increasePrice<?php echo $value['newpay_id'];?>();
                                        }, 3000);


                                    }

                                    //console.log(timeleft);
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

                            <?php if($value['allocation_status'] == "unapproved" && $value['balance'] < "2"){?>
                            <div class="detail-four">
                                <?php 
            $name = $value['product_id'].$value['payment_id'];
            if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){
            ?>
                                <form action="" class="approve-form" method="POST">
                                    <input class="price" type="submit" value="Approve" name="approve<?php echo $name?>"
                                        style="background-color: #7e252b; color: #fff;" />

                                </form>
                                <?php 
             
                
                if(isset($_POST["approve".$name])){
                    if(isset($_SESSION['uniquesupadmin_id'])){
                        $approverid = $_SESSION['uniquesupadmin_id'];
                        $supname = $user->selectSupadmin($approverid);
                        $approvername = $supname['super_adminname'];
                    }

                    if(isset($_SESSION['uniquesubadmin_id'])){
                        $approverid = $_SESSION['uniquesubadmin_id'];
                        $supname = $user->selectSubadmin($approverid);
                        $approvername = $supname['subadmin_name'];
                    }
                    $insertuser = $user->approveProduct($value['product_id'],$_GET['unique'],$value['payment_method'],$value['payment_id'],$approvername);
                    $deleted = "approved";
                        header("Location: successpage/deletesuccess.php?detect=".$deleted."");
                    
                }
            
            ?>
                                <?php }?>
                            </div>
                            <?php }?>

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
                                            if($unprice < "2"){
                                                echo "0";
                                            }else {
                                            echo number_format($unprice);
                                            }
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
                                <?php if($value['payment_method'] == "Subscription" && $value['failed_charges'] > "2"){  ?>
                                <p><span>Failed Charges:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $value['failed_charges'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        }  else {
                                            echo number_format($unprice);
                                        }
                                        
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

                        if(isset($_SESSION['uniquesupadmin_id'])){
                            $supadmin = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
                            if($value['payee'] == $supadmin['super_adminname']){
                                echo "You";
                            } else {
                                echo $value['payee'];   
                            }
                        } 
                             
                    ?></span></p>
                                <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
                                <p><span>Approved By:</span>&nbsp;<span style="text-transform: capitalize;">
                                        <?php 
                                   
                                    if(isset($_SESSION['uniquesupadmin_id'])){
                                        $supadmin = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
                                        if(!empty($value['allocator_id'])){
                                            if($value['allocator_id'] == $supadmin['super_adminname']){
                                                echo "You";
                                            } else {
                                                echo $value['allocator_id'];   
                                            }
                                        } else {
                                            echo "Nil";
                                        }
                                    } 
                                 ?>
                                    </span></p>
                                <?php }?>
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
                <div class="transaction-details" <?php if($value['sub_status'] == "Failed"){?>
                    style="border: 2px solid red;" <?php }?>>
                    <div class="radius">
                        <img src="landimage/<?php echo $value['product_image'];?>" alt="">
                    </div>
                    <div class="details">
                        <p class="pname"><?php echo $value['product_name'];?></p>
                        <div class="inner-detail">
                            <div class="date" style="font-size: 14px;">
                                <span><?php echo $value['payment_month'];?></span>&nbsp;<span><?php echo $value['payment_day'];?></span>,<span><?php echo $value['payment_year'];?></span>,<span><?php echo $value['payment_time'];?></span>
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

                    <?php  if($value['delete_status'] == "Deleted"){
                        if(isset($_SESSION['uniquesupadmin_id']) || isset($_SESSION['uniquesubadmin_id'])){
                            $name = $value['product_id'].$value['payment_id'];
                        ?>
                    <form action="" class="restore-form" method="POST">
                        <input class="price" type="submit" value="Restore" name="restorel<?php echo $name?>"
                            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
                    </form>
                    <?php 
                      if(isset($_POST["restorel".$name])){ 
                        $insertupdate = $user->updateLandHistory4($value['product_id'],$value['payment_id'],$value['payment_method'],$value['newpay_id']);
                       
                        $deletedp = "restorel";
                        header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
               }
                    ?>
                    <?php } ?>
                    <?php if(isset($_SESSION['unique_id']) || isset($_SESSION['uniqueagent_id'])){?>
                    <div class="detail-four">
                        <div class="detail"
                            style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <p style="font-size: 14px; color: #fff;">Deleted</p>
                        </div>
                    </div>
                    <?php }?>
                    <?php } else {?>

                    <div class="price-detail" <?php if($value['sub_status'] == "Failed"){?> style="color: red;"
                        <?php }?>>&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format(round($unitprice));
                             } else {
                                echo round($unitprice);
                             }
            ?><?php if($value['sub_status'] == "Failed") { echo "<span style='font-size: 12px;'>(Failed)</span>";}?>
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
                                } 

                            if(isset($_SESSION['uniquesupadmin_id'])){
                                    $supadmin = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
                                    if($value['payee'] == $supadmin['super_adminname']){
                                        echo "You";
                                    } else {
                                        echo $value['payee'];   
                                    }
                                } 
                                
                                ?>
                            </p>
                        </div>
                        <?php   
                        if(isset($_SESSION['uniquesupadmin_id']) || isset($_SESSION['uniquesubadmin_id'])){
                        $name = $value['product_id'].$value['payment_id'];?>

                        <form action="" class="deletep-form" method="POST">
                            <input class="price" type="submit" value="Delete" name="deletel<?php echo $name?>"
                                style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
                        </form>
                        <?php  if(isset($_POST["deletel".$name])){ 
                                 $insertupdate = $user->updateLandHistory3($value['product_id'],$value['payment_id'],$value['payment_method'],$value['newpay_id']);
                                
                                 $deletedp = "deletedl";
                                 header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
                        } }
                        ?>
                    </div>
                    <?php }?>
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
    <script src="js/main.js"></script>
    <script>
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

            <?php  if(isset($_SESSION['uniquesupadmin_id'])){?>
            document.querySelector('.s-box1 .selected').innerHTML = '<img src="images/referral.svg" />';
            document.querySelector('.s-box2 .selected').innerHTML = '<img src="images/referral.svg" />';
            document.querySelector('.s-box3 .selected').innerHTML = '<img src="images/referral.svg" />';
            document.querySelector('.s-box4 .selected').innerHTML = '<img src="images/referral.svg" />';
            <?php }?>
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