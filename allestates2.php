<?php 
session_start();
include "projectlog.php";
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
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />
    <script src="bootstrap/js/jquery.min.js"></script>

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    .page-title3 {
        flex-direction: column;
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

    body {
        overflow-x: hidden;
        background-image: none;
    }

    header {
        background: #fee1e3;
    }

    .subscribed-lands {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-around;
        min-height: 30vh;
    }


    .success {
        position: absolute;
        left: 50%;
        top: 30em;
        transform: translate(-50%, -50%);
        height: 10em;
    }

    .success img {
        width: 36em;
        height: 36em;
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



    .updated-land {
        position: relative;
        width: 350px;
        min-height: 620px;
        background: #FFFFFF;
        border-radius: 8px;
        filter: drop-shadow(0px 4px 16px rgba(128, 128, 128, 0.76));
        display: flex;
        flex-direction: column;
    }

    .updated-img {
        width: 350px;
        height: 220px;
        border-radius: 8px 8px 0px 0px;
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
        gap: 0.3em;
    }

    .detail-four p {
        color: #808080;
        font-size: 13px;
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
        width: 200px;
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



        @media only screen and (min-width: 1300px) {
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


            .land_estate_container {
                display: flex;
                flex-direction: column;
                gap: 1em;
            }
        }



        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
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


    @media only screen and (max-width: 1300px) {

        .detail-btn p {
            font-size: 9px;
            text-transform: capitalize;
        }

        .detail-four p {
            color: #808080;
            font-size: 9px;
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





    @media only screen and (max-width: 800px) {
        .updated-img {
            height: 200px;
        }

        .updated-img img {
            width: 100%;
            height: 200px;
        }

        .success img {
            width: 20em;
            height: 20em;
        }

        .subscribed-land {
            height: 35em;
        }


        .subscribed-details {
            padding-top: 4em;
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
            <div class="page-title2">
                <?php if(isset($_GET['unique'])){?>
                <?php if(isset($_SESSION['uniqueagent_id'])){?>
                <a href="agentprofile.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <?php } else if(isset($_SESSION['uniquesubadmin_id'])){?>
                <a href="subadmin.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <?php } else if(isset($_SESSION['uniquesupadmin_id'])){?>
                <a href="superadmin.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <?php }?>
                <div style="display: flex !important; flex-direction: column !important" class="estatetext">
                    <p>All Estates</p>
                </div>


                <div class="search-icon">
                    <img src="images/search.svg" alt="search image" id="searchimg">
                </div>
                <?php ?>

            </div>



            <div class="subscribed-lands">
                <?php 
             $land = new User;
             $landview = $land->selectLand();
             if(isset($_GET['unique'])){
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
            ?>
                <div class="updated-land" <?php if($value['product_unit'] == 0){?>style="order: 1;" <?php }?> <?php 
                    if(isset($_SESSION['uniqueagent_id'])){
                    if($value['land_status'] == "Closed"){?>style="display: none;" <?php }?>
                    <?php if($value['land_status'] == "Opened"){?>style="display: flex;" <?php }}?>>
                    <div class="updated-img">
                        <?php if($value['product_unit'] != 0 & $value['land_status'] != "Closed"){?>
                        <a
                            href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej&unique=<?php echo $_GET['unique']?>">
                            <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="<?php echo $value['product_name'];?>" />
                        </a>
                        <?php } else {?>
                        <img src="landimage/<?php if(isset($value['product_image'])){
                        echo $value['product_image'];
                    }?>" alt="<?php echo $value['product_name'];?>" />
                        <?php }?>

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
                                    <?php if($value['land_status'] != "Closed"){?>
                                    <p><a
                                            href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej&unique=<?php echo $_GET['unique']?>">click
                                            here to view</a></p>
                                    <?php }?>
                                </div>
                            </div>
                        </div>

                        <div class="detail-four">
                            <p>Address</p>
                            <div class="detail">
                                <img src="images/ellipse.svg" alt="">
                                <p><?php echo $value['estate_address'];?></p>
                            </div>
                        </div>


                        <div class="detail-four">
                            <?php if($value['product_unit'] != 0){?>
                            <?php if($value['outright_price'] != 0){
                     $outprice = $value['outright_price'];
                    $onemonthprice = $value['onemonth_price'];
                    $allocationfee = $value['allocation_fee'];
                        ?>
                            <p><span>Outright Price:&nbsp;&nbsp;</span>&#8358;<?php if($outprice > 999 || $outprice > 9999 || $outprice > 99999 || $outprice > 999999 || $outprice > 9999999){
                          echo number_format($outprice);
                        }?></p>

                            <?php if($value['outright_price'] != 0 && $value['onemonth_price'] == 0){?>
                            <p><span>Allocation Fee:&nbsp;&nbsp;</span>&#8358;<?php if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999 || $allocationfee > 9999999){
                          echo number_format($allocationfee);
                        } else {
                           echo round($allocationfee);
                        }?></p>
                            <?php }?>
                            <?php } else {?>
                            <p style="color: #ff6600;">Subscription Only</p>
                            <?php }?>
                            <?php if($value['onemonth_price'] != 0){
                       
                        $overallprice = $value['eighteen_percent'] / 100 * $value['onemonth_price'];
                        $totalprice = $overallprice + $value['onemonth_price'];
                        $onemonthprice = $totalprice / 540;
                        $allocationfee = $value['allocation_fee'];
          
              

                        ?>
                            <p><span>Subscription Price(18 Months):&nbsp;&nbsp;</span>&#8358;<?php if($totalprice > 999 || $totalprice > 9999 || $totalprice > 99999 || $totalprice > 999999){
                          echo number_format($totalprice);
                        }?></p>
                            <p><span>Daily Price:&nbsp;&nbsp;</span>&#8358;<?php if($onemonthprice > 999 || $onemonthprice > 9999 || $onemonthprice > 99999 || $onemonthprice > 999999){
                          echo number_format($onemonthprice);
                        } else {
                            echo round($onemonthprice);
                        }?></p>
                            <p><span>Allocation Fee:&nbsp;&nbsp;</span>&#8358;<?php if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999 || $allocationfee > 9999999){
                          echo number_format($allocationfee);
                        } else {
                           echo round($allocationfee);
                        }?></p>

                            <?php } else {?>
                            <p style="color: #ff6600;">Outright Only</p>
                            <?php }} else {?>
                            <p>Sold Out</p>
                            <?php }?>
                        </div>

                        <div class="detail-four">
                            <p>Features</p>
                            <div class="detail">
                                <img src="images/ellipse.svg" alt="">
                                <p><?php echo $value['estate_feature'];?></p>
                            </div>
                        </div>


                        <div class="detail-four">
                            <p>Purpose</p>
                            <div class="detail">
                                <img src="images/ellipse.svg" alt="">
                                <p><?php echo $value['purpose'];?></p>
                            </div>
                        </div>

                        <?php if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){
                           ?>
                        <?php  if($value['land_status'] == "Closed"){ ?>
                        <div class="detail-four">
                            <div class="detail"
                                style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <p style="font-size: 14px; color: #fff;">Closed</p>
                            </div>
                        </div>
                        <?php }?>
                        <?php }?>

                        <?php if($value['land_status'] != "Closed"){?>
                        <?php if($value['product_unit'] != 0){?>
                        <div class="detail-five">
                            <div class="uni<?php echo $value['unique_id'];?>" style="visibility:hidden;">

                                <?php echo $value['unique_id'];?>
                            </div>
                            <form action="" id="cartform<?php echo $value['unique_id'];?>">
                                <?php 
                    $cart = $land->checkCartId($_GET['unique'],$value['unique_id']);
                    if(empty($cart)){
                    ?>
                                <div class="cartbutton" id="cart-btn<?php echo $value['unique_id'];?>">
                                    <img src="images/cart.svg" alt="">
                                    <p>Add To User's Cart</p>
                                </div>

                                <div id="otherbtn<?php echo $value['unique_id'];?>" class="cartbutton"
                                    style="visibility:hidden;"> <a
                                        href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej&unique=<?php echo $_GET['unique']?>"
                                        style="color: #7e252b;">View In Cart </a>
                                </div>
                                <?php } else {?>
                                <div class="cartbutton" id="cart-btn<?php echo $value['unique_id'];?>"
                                    style="visibility:hidden;">
                                    <img src="images/cart.svg" alt="">
                                    <p>Add To User's Cart</p>
                                </div>
                                <div id="otherbtn<?php echo $value['unique_id'];?>" class="cartbutton"> <a
                                        href="estateinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej&unique=<?php echo $_GET['unique']?>"
                                        style="color: #7e252b;">View In Cart </a>
                                </div>
                                <?php }?>


                                <input type="hidden" name="productid" value="<?php echo $value['unique_id']?>">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="user" value="<?php echo $_GET['unique'];?>">
                            </form>

                        </div>
                        <?php } else {?>
                        <div class="detail-five">
                            <div class="cartbutton" id="cart-btn<?php echo $value['unique_id'];?>"
                                style="visibility:hidden;">
                            </div>
                            <div class="cartbutton">
                                <p>Sold Out</p>
                            </div>
                        </div>
                        <?php }}?>
                    </div>
                </div>



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
                                    document.querySelector(`#cart-btn<?php echo $value['unique_id'];?>`).style
                                        .display =
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


                <?php }}?>
            </div>



            <?php }}else {?>

            <div class="success">
                <img src="images/asset_success.svg" alt="" />
                <p>
                <div class="estate_page_button action" onClick="load()" style="width: 200px; height: 30px;">Sign Up
                </div>
                </p>
            </div>
            <?php }?>

            <?php if(empty($landview)){?>
            <div class="success">
                <img src="images/asset_success.svg" alt="" />
                <p>
                <p style="text-align: center; font-size: 18px;">No Estates Available at the moment!</p>
                <?php if(isset($_SESSION['uniqueagent_id'])){?>
                <a href="agentprofile.php"><button class="landing_page_button2">Back to Dashboard</button></a>
                <?php }?>

                <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
                <a href="subadmin.php"><button class="landing_page_button2">Back to Dashboard</button></a>
                <?php }?>

                <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
                <a href="superadmin.php"><button class="landing_page_button2">Back to Dashboard</button></a>
                <?php }?>
                </p>
            </div>
            <?php }?>
        </div>
    </div>

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
    let searchIcon = document.querySelector('.search-icon');
    searchIcon.onclick = () => {
        location.href = "searchresult.php?unique=<?php echo $_GET['unique']?>";
    }

    function load() {
        location.href = "signup.php";
    }
    </script>


</body>

</html>