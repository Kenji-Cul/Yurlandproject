<?php 
session_start();
include_once "projectlog.php";


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

    .footerdiv {
        position: absolute;
        bottom: 0;
    }

    .flex-success {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1em;
    }

    .flex-success a {
        color: #fff;
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

    .empty-img {
        width: 100%;
        height: 100%;
        border-radius: 8px;
    }


    .success {
        position: absolute;
        left: 50%;
        top: 20em;
        transform: translate(-50%, -50%);
        height: 100%;

    }

    .success img {
        width: 15em;
        height: 15em;
    }


    .account-detail2 {
        position: relative;
    }

    .account-detail2 .flex {
        position: absolute;
        left: 90px;
    }

    .account-detail3 {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 3em;
        position: absolute;
        top: 30em;
    }

    .account-detail3 p {
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 22px;
        text-align: center;
        color: #eb5757;
    }

    @media only screen and (min-width: 1300px) {

        .select-box {
            width: 100%;
            border-radius: 0px !important;
            background: #7e252b;
        }

        .selected {
            border-radius: 0px !important;
            background: #7e252b;
            color: #fff;
        }

        .select-box .options-container {
            border-radius: 0px !important;
            background: #7e252b;
            z-index: 200;
        }

        .select-box .option:hover {
            background: var(--primary-black);
            color: #ffffff;
        }

        .select-box .options-container::-webkit-scrollbar {
            width: 6px;
            background: #0d141f;
            border-radius: 0;
        }

        .select-box .options-container::-webkit-scrollbar-thumb {
            background: #525861;
            border-radius: 0;
        }

        .option {
            padding: 1em 0;
        }

        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
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
            height: 290px;
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
        body {
            height: 90vh;
        }





        .user,
        #openicon {
            display: none;
        }

        .links img {
            display: none;
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


        .land-estate {
            width: 290px;
        }

        .select-box {
            width: 100%;
            border-radius: 0px !important;
            background: #7e252b;
            margin-left: -1em;
        }

        .selected {
            border-radius: 0px !important;
            background: #7e252b;
            color: #fff;
        }

        .select-box .options-container {
            border-radius: 0px !important;
            background: #7e252b;
            z-index: 200;
        }

        .select-box .option:hover {
            background: var(--primary-black);
            color: #ffffff;
        }

        .select-box .options-container::-webkit-scrollbar {
            width: 6px;
            background: #0d141f;
            border-radius: 0;
        }

        .select-box .options-container::-webkit-scrollbar-thumb {
            background: #525861;
            border-radius: 0;
        }

        .option {
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
        /* .close {
            position: absolute;
            top: 1em;
            right: 1em;
        } */


        .update-data {
            position: absolute;
            top: -3em;
        }
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <a href="agentprofile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else if(isset($_SESSION['uniquesubadmin_id'])){ ?>
            <a href="subadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }else if(isset($_SESSION['uniquesupadmin_id'])){ ?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else{?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>

        <?php 
             $user = new User;
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

        <?php if(isset($_SESSION['uniqueagent_id'])){?>
        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />
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
                        <div class="empty-img" style="border-radius: 50%;">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php }?>

        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />
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
                        <div class="empty-img" style="border-radius: 50%;">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php }?>

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
                        <div class="empty-img" style="border-radius: 50%;">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php }?>

    </header>


    <div class="flex-container">
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
                <li class="links">
                    <a href="agentprofile.php"><img src="images/home3.svg" /></a>
                    <a href="agentprofile.php" class="link">Home</a>
                </li>

                <li class="links select-link">
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

                <li class="links select-link">
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




        <div class="profile-container">






            <div class="success">

                <div class="flex-success">
                    <p>Customer Type</p>
                    <?php if(isset($_SESSION['uniqueagent_id'])){?>
                    <p>
                        <a href="mycustomers.php">
                            <div class="estate_page_button" style="width: 200px; height: 30px;">Existing
                                User
                            </div>
                        </a>
                    </p>
                    <?php } else {?>
                    <p>
                        <a href="allcustomers.php">
                            <div class="estate_page_button" style="width: 200px; height: 30px;">Existing
                                User
                            </div>
                        </a>
                    </p>
                    <?php }?>


                    <?php if(isset($_SESSION['uniqueagent_id'])){?>
                    <p>
                        <a href="newcustomer.php">
                            <div class="estate_page_button" style="width: 200px; height: 30px;">New
                                User
                            </div>
                        </a>
                    </p>
                    <?php } else {?>
                    <p>
                        <a href="newuser.php">
                            <div class="estate_page_button" style="width: 200px; height: 30px;">New
                                User
                            </div>
                        </a>
                    </p>
                    <?php }?>
                </div>
            </div>
            <div class="account-detail3">
                <?php if(isset($_SESSION['uniqueagent_id'])){?>
                <a href="agentlogout.php">
                    <p>Sign Out</p>
                </a>
                <?php }?>
                <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
                <a href="logout.php?user=subadmin">
                    <p>Sign Out</p>
                </a>
                <?php }?>
            </div>



        </div>
    </div>
    </div>

    <footer class="footerdiv">
        <p>YurLAND &#169; 2022 | All Right Reserved</p>
        <p>A product of Ilu-oba International Limited and Arklips Limited</p>
        <p>Connect with us Facebook, Twitter, Instagram</p>
        <p style="font-size: 30px;">
            <a href="https://instagram.com/yurlandng?igshid=NTdlMDg3MTY="><i class="ri-instagram-line"></a></i><a
                href="https://www.facebook.com/profile.php?id=100088254710492&mibextid=ZbWKwL"><i
                    class="ri-facebook-fill"></i></a><i class="ri-twitter-line"></i>
        </p>
    </footer>

    <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
    <script src="js/main.js"></script>
    <?php }?>
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