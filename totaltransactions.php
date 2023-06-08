<?php 
session_start();
ob_start();
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

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        min-height: 100vh;
        position: relative;
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

    header {
        background: #fee1e3;
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
        width: 55%;

    }

    .payee .payee-tag {
        width: 45%;
        font-size: 13px;
    }

    .search-form,
    .search-form2,
    .search-form3,
    .search-form4,
    .dropdown-form {
        display: none;
    }

    .search-container {
        display: flex;
        justify-content: left;
        flex-direction: column;
        padding-left: 5%;
        padding-top: 2em;
        position: unset;
        gap: 2em;
    }

    .search-container .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
        width: 240px;
    }

    .search-input2 input {
        padding: 0.8em 4em;
        outline: none;
        background-color: #cac6c6;
        border: 1px solid #808080;
        border-radius: 8px;
        border: 2px solid #ff6600;
    }

    .no-lands {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: top;
        flex-direction: column;
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

    .success {
        position: absolute;
        left: 50%;
        top: 48em;
        transform: translate(-50%, -50%);
        height: 10em;
        width: 90%;
    }

    .success img {
        width: 36em;
        height: 36em;
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
        width: 95%;
    }

    @media only screen and (max-width: 1300px) {

        .details .date {
            font-size: 9px !important;
        }

        .success {
            position: absolute;
            top: 48em;
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

        .profile-body {
            height: 40vh;
        }

        .transaction-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
        }

        .details .pname {
            font-size: 13px;
        }

        .transaction-details {
            border-radius: 8px;
            /* border: 2px solid black; */
            padding: 1em 1em;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            width: 95%;
            gap: 1em;
        }

        .transaction-details .date {
            font-size: 11px !important;
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
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
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

        .close {
            padding-top: 12em;
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
            width: 90%;
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

    @media only screen and (max-width: 1300px) {
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




        <?php if(isset($_SESSION['uniquesubadmin_id'])) {
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

        ?>
    }


    @media only screen and (max-width: 700px) {
        .transaction-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
        }

        .success {
            position: absolute;
            left: 50%;
            top: 48em;
            transform: translate(-50%, -50%);
            height: 10em;
        }

        .success p {
            text-align: center;
        }


        .success img {
            width: 15em;
            height: 15em;
        }

        .detail3 {
            display: none;
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
            <?php }  else if(isset($_SESSION['uniquesupadmin_id'])){?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }  else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>

        <?php 
             $user = new User;
             if(isset($_SESSION['uniquesubadmin_id'])){
             $newuser = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
             }

             if(isset($_SESSION['uniquesupadmin_id'])){
                $newuser = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
                }
            ?>

        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />
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
                <li class="links">
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

                <li class="links select-link">
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
                                <a href="offlinehistory.php"><img src="images/referral.svg" /></a>
                                <a href="offlinehistory.php" class="link">Offline Transactions</a>
                            </li>
                        </div>
                        <div class="option">
                            <li class="links">
                                <a href="rejectedpayments.php"><img src="images/referral.svg" /></a>
                                <a href="rejectedpayments.php" class="link">Rejected Offline Transactions</a>
                            </li>
                        </div>

                        <div class="option">
                            <li class="links">
                                <a href="approvedpayments.php"><img src="images/referral.svg" /></a>
                                <a href="approvedpayments.php" class="link">Approved Offline Transactions</a>
                            </li>
                        </div>
                        <div class="option">
                            <li class="links">
                                <a href="totalearnings.php"><img src="images/referral.svg" /></a>
                                <a href="totalearnings.php" class="link">Earnings History</a>
                            </li>
                        </div>
                        <div class="option">
                            <li class="links">
                                <a href="alluserearnings.php"><img src="images/referral.svg" /></a>
                                <a href="alluserearnings.php" class="link">User Earnings</a>
                            </li>
                        </div>
                        <div class="option">
                            <li class="links">
                                <a href="allagentearnings.php"><img src="images/referral.svg" /></a>
                                <a href="allagentearnings.php" class="link">Agent Earnings</a>
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
                    <a href="alluserearnings.php"><img src="images/updown.svg" /></a>
                    <a href="alluserearnings.php" class="link">Pay Earnings</a>
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







        <div class="trans-container">
            <div class="page-title2">
                <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
                <a href="subadmin.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <?php }?>
                <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
                <a href="superadmin.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <?php }?>
                <p>All Transactions</p>
            </div>

            <form action="" class="download-form">
                <button class="btn land-btn" style="width: 70px; margin-left: 2em;"><i class="ri-download-line"
                        id="export"></i></button>
            </form>

            <table id="user-data" style="display: none;">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Customer's Name</th>
                        <th>Amount Paid</th>
                        <th>Location Paid For</th>
                        <th>Paid By</th>
                        <th>Date</th>
                        <th>Time of Payment</th>
                        <th>Payment Status</th>
                        <th>Payment Type</th>
                        <th>Payment Delete Status</th>
                    </tr>
                </thead>
                <tbody class="table-data">

                    <?php 
    $user = new User;
   
    $customer = $user ->downloadAllHistory();
    if(!empty($customer)){
        foreach($customer as $key => $value){
            $newuser = $user->selectUser($value['customer_id']);
    ?>
                    <tr>
                        <td><?php echo $value['payment_id'];?></td>
                        <td> <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                        </td>
                        <td>&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } else {
                                echo round($unitprice);
                             }
            ?></td>
                        <td><?php echo $value['product_name'];?></td>
                        <td><?php echo $value['payee'];?></td>
                        <td><?php echo $value['payment_date'];?></td>
                        <td><?php echo $value['payment_time'];?></td>
                        <td><?php if($value['sub_status'] != "Failed"){
                            echo "Successful";
                        } else {
                            echo "Failed";
                        }
                        ?></td>
                        <td><?php if($value['offline_status'] == ""){
                            echo "Online";
                        } else {
                             echo "Offline";
                        }
                        ?></td>
                        <td><?php if($value['delete_status'] == ""){
                            echo "Undeleted";
                        } else {
                             echo $value['delete_status'];
                        }
                        ?></td>
                    </tr>
                    <?php }}?>
                </tbody>
            </table>

            <div class="search-container">

                <div class="select-box">
                    <div class="options-container">
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode1" name="searchmode" value="Land" />
                            <label for="searchmode1">By Land</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode2" name="searchmode" value="Date" />
                            <label for="searchmode2">By Date</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode3" name="searchmode" value="Payer" />
                            <label for="searchmode3">By Payer</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode7" name="searchmode" value="Number" />
                            <label for="searchmode7">By Number</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode4" name="searchmode" value="Failed" />
                            <label for="searchmode4">Failed Transactions</label>

                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode5" name="searchmode" value="Success" />
                            <label for="searchmode5">Successful Transactions</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode6" name="searchmode" value="Deleted" />
                            <label for="searchmode6">Deleted Transactions</label>
                        </div>
                    </div>

                    <div class="selected">Choose Search Mode</div>


                </div>

                <div class="search-input2">
                    <form action="" class="search-form">
                        <input type="text" class="search" type="search" name="searchproduct"
                            placeholder="Search By Payer">
                    </form>
                </div>

                <div class="search-input2">
                    <form action="" class="search-form4">
                        <input type="number" class="search3" type="search" name="searchproduct3"
                            placeholder="Search By Number" pattern="[0-9]"
                            onkeydown="if(event.key==='.'){event.preventDefault();}"
                            onpaste="let pasteData = event.clipboardData.getData('text'); if(pasteData){pasteData.replace(/[^0-9]*/g,'');} "
                            oninput="this.value=(parseInt(this.value)||'')">

                    </form>
                </div>

                <div class="search-input2">
                    <form action="" class="dropdown-form">
                        <div class="valuediv2" style="display: none;"></div>
                    </form>
                </div>

                <div class="search-input2">
                    <form action="" class="search-form3">
                        <input type="text" class="search2" type="search" name="searchproduct2"
                            placeholder="Search By Land">
                    </form>
                </div>


                <form action="" class="search-form2">
                    <div class="select-box">
                        <div class="options-container">
                            <?php 
                         $lastsevendays = date('M-d-Y', strtotime('today - 7 days'));
                         $today = date('M-d-Y', strtotime('today'));
                          $dates = [];
                         for ($i = 0; $i < 31; $i++) { 
                              
                       ?>
                            <div class="option">
                                <input type="radio" class="radio" id="date<?php echo $i;?>" name="searchproduct3"
                                    value="<?php echo date('M-d-Y', strtotime('today - '.$i.'days'));?>" />
                                <label
                                    for="date<?php echo $i;?>"><?php echo date('M-d-Y', strtotime('today - '.$i.'days'));?></label>
                            </div>
                            <?php }?>
                        </div>

                        <div class="selected">Choose Date</div>

                    </div>
                    <div class="valuediv" style="display: none;"></div>
                </form>




            </div>


            <div class="details-container">
                <?php 
            
             $landview = $user->selectAllHistory();
             if(!empty($landview)){
                foreach($landview as $key => $value){
                
            ?>
                <div class="transaction-details" <?php if($value['sub_status'] == "Failed"){?>
                    style="border: 2px solid red;" <?php }?>>
                    <div class="radius" style="width: 50px!important; height: 50px!important;">
                        <img src="landimage/<?php echo $value['product_image'];?>" alt="">
                    </div>
                    <div class="details">
                        <p class="pname"><?php echo $value['product_name'];?></p>
                        <div class="inner-detail">
                            <div class="date" style="font-size: 14px;">
                                <span><?php echo $value['payment_month'];?></span>&nbsp;<span><?php echo $value['payment_day'];?></span>,<span><?php echo $value['payment_year'];?></span>,<span><?php echo $value['payment_time'];?></span>
                            </div>
                        </div>
                        <?php if($value['payment_mode'] == "Offline"){?>
                        <p
                            style="color: #7e252b; font-size: 12px; display:flex; align-items:center; justify-content:center; border-radius: 25px; border: 2px solid #7e252b; padding: 0 5px;">
                            Offline: <?php if($value['payment_mode'] == "Offline" && $value['offline_status'] == ""){
                            echo "Approved";
                        } else {
                            echo $value['offline_status'];
                        }?></p>
                        <?php }?>
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
                    <?php  } else {?>
                    <div class="price-detail" <?php if($value['sub_status'] == "Failed"){?> style="color: red;"
                        <?php }?>>&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } else {
                                echo round($unitprice);
                             }
            ?><?php if($value['sub_status'] == "Failed") { echo "<span style='font-size: 12px;'>(Failed)</span>";}?>

                        <div class="payee">
                            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
                            <p class="payee-name"
                                style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">

                                <?php 
                            
                            if(isset($_SESSION['uniquesubadmin_id'])){
                                $newuser = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
                                if($value['payee'] == $newuser['subadmin_name']){
                                    echo "You";
                                } else {
                                    echo $value['payee'];   
                                }
                            } 

                            if(isset($_SESSION['uniquesupadmin_id'])){
                                $newuser = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
                                if($value['payee'] == $newuser['super_adminname']){
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

                <?php }}?>

                <?php if(empty($landview)){?>
                <div class="success">
                    <img src="images/whoops.svg" alt="" />
                    <p>Whoops, There are no payment records yet</p>
                </div>
            </div>
        </div>
    </div>

    <?php }?>



    <!-- <div class="directions">
        <img src="images/leftpage.svg" alt="" />
        <p>Page 1 of 4</p>
        <img src="images/rightPage.svg" alt="" />
    </div> -->

    <script src="js/main.js"></script>

    <script>
    let purpose4 = document.getElementsByName("searchmode");

    purpose4.forEach((element) => {
        element.onclick = () => {
            if (element.value == "Land") {
                document.querySelector('.search-form3').style.display = "block";
                document.querySelector('.search-form').style.display = "none";
                document.querySelector('.search-form2').style.display = "none";
                document.querySelector('.search-form4').style.display = "none";

                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadland`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform2);
                    xhr.send(formData);

                }
            }
            if (element.value == "Date") {
                document.querySelector('.search-form2').style.display = "block";
                document.querySelector('.search-form3').style.display = "none";
                document.querySelector('.search-form').style.display = "none";
                document.querySelector('.search-form4').style.display = "none";


                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloaddate&data=${valuediv.innerHTML}`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform3);
                    xhr.send(formData);

                }
            }
            if (element.value == "Payer") {
                document.querySelector('.search-form').style.display = "block";
                document.querySelector('.search-form3').style.display = "none";
                document.querySelector('.search-form2').style.display = "none";
                document.querySelector('.search-form4').style.display = "none";

                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadpayer`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform);
                    xhr.send(formData);

                }
            }

            if (element.value == "Number") {
                document.querySelector('.search-form4').style.display = "block";
                document.querySelector('.search-form').style.display = "none";
                document.querySelector('.search-form3').style.display = "none";
                document.querySelector('.search-form2').style.display = "none";

                // let downloadbtn = document.querySelector('.download-form .land-btn');
                // let searchform2 = document.querySelector('.search-form3');

                // downloadbtn.onclick = () => {
                //     let xhr = new XMLHttpRequest();
                //     xhr.open("POST",
                //         `downloadbyland.php?mode=downloadpayer`
                //     );

                //     xhr.onload = () => {
                //         if (xhr.readyState === XMLHttpRequest.DONE) {
                //             if (xhr.status === 200) {
                //                 let data = xhr.response;
                //                 //console.log(data);
                //                 document.querySelector('.table-data').innerHTML = data;
                //                 htmlTableToExcel('xlsx');
                //             }
                //         }
                //     };
                //     let formData = new FormData(searchform);
                //     xhr.send(formData);

                // }
            }



        }
    });
    //let searchIcon = document.querySelector('.search-icon');

    //let searchinput = document.querySelector('.search-input2');
    let searchinput2 = document.querySelector('.search');
    let searchinput3 = document.querySelector('.search2');
    let searchinput4 = document.querySelector('.search3');

    //searchinput.style.display = "flex";
    //document.querySelector('#searchimg').style.display = "none";
    let searchform = document.querySelector('.search-form');
    let searchform2 = document.querySelector('.search-form3');
    let searchform5 = document.querySelector('.search-form4');
    let searchform3 = document.querySelector('.search-form2');
    let searchform4 = document.querySelector('.dropdown-form');


    searchform.onsubmit = (e) => {
        e.preventDefault();
    }

    searchform2.onsubmit = (e) => {
        e.preventDefault();
    }

    searchform3.onsubmit = (e) => {
        e.preventDefault();
    }

    searchform4.onsubmit = (e) => {
        e.preventDefault();
    }

    searchform5.onsubmit = (e) => {
        e.preventDefault();
    }



    <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
    searchinput2.onkeyup = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST",
            `searchbypayer.php?user=superadmin&unique=<?php echo $_SESSION['uniquesupadmin_id'];?>`);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    document.querySelector('.details-container').innerHTML = data;
                }
            }
        };
        let formData = new FormData(searchform);
        xhr.send(formData);
    }

    <?php }?>

    <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
    searchinput4.onkeyup = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST",
            `searchbynumber.php?user=superadmin&unique=<?php echo $_SESSION['uniquesupadmin_id'];?>`);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    document.querySelector('.details-container').innerHTML = data;
                }
            }
        };
        let formData = new FormData(searchform5);
        xhr.send(formData);
    }

    <?php }?>

    <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
    searchinput4.onkeyup = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST",
            `searchbynumber.php?user=subadmin&unique=<?php echo $_SESSION['uniquesubadmin_id'];?>`);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    document.querySelector('.details-container').innerHTML = data;
                }
            }
        };
        let formData = new FormData(searchform5);
        xhr.send(formData);
    }

    <?php }?>



    <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
    searchinput2.onkeyup = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST",
            `searchbypayer.php?user=subadmin&unique=<?php echo $_SESSION['uniquesubadmin_id'];?>`);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    document.querySelector('.details-container').innerHTML = data;
                }
            }
        };
        let formData = new FormData(searchform);
        xhr.send(formData);
    }

    <?php }?>



    <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
    searchinput3.onkeyup = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST",
            `searchbyland.php?user=superadmin&unique=<?php echo $_SESSION['uniquesupadmin_id'];?>`);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    document.querySelector('.details-container').innerHTML = data;
                }
            }
        };
        let formData = new FormData(searchform2);
        xhr.send(formData);
    }




    <?php }?>

    <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
    searchinput3.onkeyup = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST",
            `searchbyland.php?user=subadmin&unique=<?php echo $_SESSION['uniquesubadmin_id'];?>`);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    document.querySelector('.details-container').innerHTML = data;
                }
            }
        };
        let formData = new FormData(searchform2);
        xhr.send(formData);
    }

    <?php }?>

    <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
    let valuediv2 = document.querySelector('.valuediv2');

    let purpose1 = document.querySelector("#searchmode4");
    let purpose2 = document.querySelector("#searchmode5");
    let purpose3 = document.querySelector("#searchmode6");
    let purposearray = [purpose1, purpose2, purpose3];
    document.querySelector('.dropdown-form').style.display = "block";
    purposearray.forEach((element) => {
        element.onclick = () => {
            document.querySelector('.search-form3').style.display = "none";
            document.querySelector('.search-form').style.display = "none";
            document.querySelector('.search-form2').style.display = "none";
            document.querySelector('.search-form4').style.display = "none";
            valuediv2.innerHTML = element.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchstatus.php?data=${valuediv2.innerHTML}&user=superadmin&unique=<?php echo $_SESSION['uniquesupadmin_id'];?>`
            );

            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        document.querySelector('.details-container').innerHTML = data;

                    }
                }
            };
            let formData = new FormData(searchform4);
            xhr.send(formData);


            if (element.value == "Failed") {
                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadfailed`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform);
                    xhr.send(formData);

                }
            }

            if (element.value == "Success") {
                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadsuccess`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform);
                    xhr.send(formData);

                }
            }

            if (element.value == "Deleted") {
                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloaddeleted`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform);
                    xhr.send(formData);

                }
            }
        }

    });

    <?php }?>


    <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
    let valuediv2 = document.querySelector('.valuediv2');

    let purpose1 = document.querySelector("#searchmode4");
    let purpose2 = document.querySelector("#searchmode5");
    let purpose3 = document.querySelector("#searchmode6");
    let purposearray = [purpose1, purpose2, purpose3];
    purposearray.forEach((element) => {
        element.onclick = () => {
            document.querySelector('.search-form3').style.display = "none";
            document.querySelector('.search-form').style.display = "none";
            document.querySelector('.search-form2').style.display = "none";
            valuediv2.innerHTML = element.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchstatus.php?data=${valuediv2.innerHTML}&user=subadmin&unique=<?php echo $_SESSION['uniquesubadmin_id'];?>`
            );

            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        document.querySelector('.details-container').innerHTML = data;

                    }
                }
            };
            let formData = new FormData(searchform4);
            xhr.send(formData);

            if (element.value == "Failed") {
                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadfailed`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform);
                    xhr.send(formData);

                }
            }

            if (element.value == "Success") {
                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadsuccess`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform);
                    xhr.send(formData);

                }
            }

            if (element.value == "Deleted") {
                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloaddeleted`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform);
                    xhr.send(formData);

                }
            }
        }

    });

    <?php }?>



    <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
    let valuediv = document.querySelector('.valuediv');

    let purpose = document.getElementsByName("searchproduct3");
    purpose.forEach((element) => {
        element.onclick = () => {
            valuediv.innerHTML = element.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchbydate.php?data=${valuediv.innerHTML}&user=superadmin&unique=<?php echo $_SESSION['uniquesupadmin_id'];?>`
            );

            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        document.querySelector('.details-container').innerHTML = data;

                    }
                }
            };
            let formData = new FormData(searchform3);
            xhr.send(formData);
        }

    });

    <?php }?>



    <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
    let valuediv = document.querySelector('.valuediv');

    let purpose = document.getElementsByName("searchproduct3");
    purpose.forEach((element) => {
        element.onclick = () => {
            valuediv.innerHTML = element.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchbydate.php?data=${valuediv.innerHTML}&user=subadmin&unique=<?php echo $_SESSION['uniquesubadmin_id'];?>`
            );

            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        document.querySelector('.details-container').innerHTML = data;
                    }
                }
            };
            let formData = new FormData(searchform3);
            xhr.send(formData);
        }

    });

    <?php }?>

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
            document.querySelector(".trans-container").style = `
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
            document.querySelector(".trans-container").style = `
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

    let downloadbtn = document.querySelector('.download-form .land-btn');
    let downloadform = document.querySelector('.download-form');
    downloadform.onsubmit = (e) => {
        e.preventDefault();
    }

    function htmlTableToExcel(type) {
        var userdata = document.getElementById('user-data');
        var file = XLSX.utils.table_to_book(userdata, {
            sheet: "sheet1"
        });
        XLSX.write(file, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        });

        XLSX.writeFile(file, 'Transactiondata.' + type);
    }

    downloadbtn.onclick = () => {
        htmlTableToExcel('xlsx');

    }
    </script>
</body>

</html>
<?php ob_end_flush();?>