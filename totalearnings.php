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

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/read-excel-file@4.x/bundle/read-excel-file.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    .error,
    .error2 {
        width: 50%;
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

    .account-detail2 {
        padding-bottom: 2em;
        padding-top: 2em;
    }

    .payee {
        width: 350px;
    }

    .payee {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
    }

    .payee-tag {
        text-transform: capitalize !important;
    }

    .search-form,
    .search-form2,
    .search-form3 {
        display: none;
    }



    .search-icon img {
        width: 20px;
        height: 20px;
    }

    .search-input2 input {
        position: unset;
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

    .select-box {
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

    .search-icon input:focus {
        border: none;
    }


    .footerdiv {
        position: absolute;
        bottom: 0;
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
        top: 60em;
        transform: translate(-50%, -50%);
        height: 20%;

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

        .error2,
        .error {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Space Grotesk";
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 31px;
            text-align: center;
            color: #e11900;
            border: 1px solid #e11900;
            width: 30%;
            padding: 10px 10px;
            background-color: #e1dede;
            visibility: hidden;
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

        .error2,
        .error {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Space Grotesk";
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 31px;
            text-align: center;
            color: #e11900;
            border: 1px solid #e11900;
            width: 70%;
            padding: 4px 4px;
            background-color: #e1dede;
            visibility: hidden;
        }

        .success {
            position: absolute;
            top: 59em;
            height: 20%;
        }

        .payee {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0 !important;
            width: 280px;
            position: relative;
        }

        .payee .payee-tag {
            width: 40%;
            font-size: 11px;
        }

        .payee .payee-name {
            width: 60%;
            font-size: 11px;
        }

        body {
            height: 90vh;
        }

        .account-detail2 .flex {
            position: absolute;
            left: 10px;
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

        <?php if(isset($_SESSION['uniquesubadmin_id'])) {
            ?>.close {
                padding-top: 26em;
            }

            <?php
        }

        ?><?php if(isset($_SESSION['uniquesupadmin_id'])) {
            ?>.close {
                padding-top: 38em;
            }

            <?php
        }

        ?>
        /* .close {
            position: absolute;
            top: 4em;
            right: 4em;
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
            ?>

        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <div class="user">
                <p><?php if(isset($newuser['subadmin_name'])){  ?>
                    <span><?php echo $newuser['subadmin_name']; ?></span>&nbsp;
                    <?php }?>

                    <?php if(isset($newuser['super_adminname'])){  ?>
                    <span><?php echo $newuser['super_adminname']; ?></span>&nbsp;
                    <?php }?>
                </p>
                <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
                <div class="profile-image">
                    <?php if(!empty($newuser['subadmin_image'])){?>
                    <a href="subadmininfo.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['subadmin_image'];?>" alt="profile image" /></a>
                    <?php } ?>

                    <?php if(empty($newuser['subadmin_image'])){?>
                    <a href="subadmininfo.php" style="color: #808080;">
                        <div class="empty-img" style="border-radius: 50%;">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
                <?php }?>

                <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
                <div class="profile-image">
                    <?php if(!empty($newuser['admin_image'])){?>
                    <a href="supadmininfo.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['admin_image'];?>" alt="profile image" /></a>
                    <?php } ?>

                    <?php if(empty($newuser['admin_image'])){?>
                    <a href="supadmininfo.php" style="color: #808080;">
                        <div class="empty-img" style="border-radius: 50%;">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
                <?php }?>
            </div>
        </div>
        </div>

    </header>


    <div class="flex-container">
        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
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
                    <a href="superadmin.php"><img src="images/home3.svg" /></a>
                    <a href="superadmin.php" class="link">Home</a>
                </li>

                <li class="links">
                    <a href="allcustomers.php"><img src="images/referral.svg" /></a>
                    <a href="allcustomers.php" class="link">All Customers</a>
                </li>

                <li class="links">
                    <a href="allagents.php"><img src="images/referral.svg" /> </a>
                    <a href="allagents.php" class="link">All Agents</a>
                </li>


                <li class="links">
                    <a href="newuser.php"><img src="images/referral.svg" /></a>
                    <a href="newuser.php" class="link">New Customer</a>
                </li>

                <li class="links">
                    <a href="usertype.php"><img src="images/land2.svg" /></a>
                    <a href="usertype.php" class="link">New Land</a>
                </li>

                <li class="links">
                    <a href="allagentearnings.php"><img src="images/referral.svg" /></a>
                    <a href="allagentearnings.php" class="link">View Earnings</a>
                </li>

                <li class="links">
                    <a href="createexecutive.php"><img src="images/referral.svg" /> </a>
                    <a href="createexecutive.php" class="link">Create Executive</a>
                </li>

                <li class="links">
                    <a href="creategroup.php"><img src="images/referral.svg" /> </a>
                    <a href="creategroup.php" class="link">Create Group</a>
                </li>

                <li class="links">
                    <a href="createagent.php"><img src="images/referral.svg" /> </a>
                    <a href="createagent.php" class="link">Create Agent</a>
                </li>

                <li class="links">
                    <a href="createsubadmin.php"><img src="images/referral.svg" /> </a>
                    <a href="createsubadmin.php" class="link">Create Subadmin</a>
                </li>

                <li class="links">
                    <a href="productperiod.php"><img src="images/land2.svg" /></a>
                    <a href="productperiod.php" class="link">Create Plan</a>
                </li>

                <li class="links">
                    <a href="selectprice.php"><img src="images/land2.svg" /></a>
                    <a href="selectprice.php" class="link">Create Product</a>
                </li>

                <li class="links ">
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

                <li class="links select-link">
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


        <div class="profile-container">
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
                <p>Total User Earnings</p>
            </div>

            <form action="" class="download-form">
                <button class="btn land-btn" style="width: 70px; margin-left: 2em;"><i class="ri-download-line"
                        id="export"></i></button>
            </form>

            <p class="error2" style="visibility:hidden;">Choose appropriate excel file</p>

            <form action="" class="upload-form" id="upload-form">
                <input type="file" id="passport" placeholder="Upload your profile image" name="image" hidden="hidden"
                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />

                <div class="file-container">
                    <div class="browse-filediv">
                        <div class="centrediv">
                            <p>Drop files here to upload</p>
                            <label>Browse files</label>
                        </div>
                        <div class="uploading-div"></div>
                        <div class="uploading-div2"></div>
                    </div>
                </div>

                <p class="error" style="visibility:hidden;">Please select field</p>

                <button class="btn land-btn" style="width: 70px; margin-left: 2em;" type="submit" name="importSubmit"><i
                        class="ri-upload-line" id="export"></i></i></button>
            </form>

            <table id="upload-data"></table>

            <table id="user-data" style="display: none;">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Customer ID(Do Not Edit)</th>
                        <th>Earner ID(Do Not Edit)</th>
                        <th>Role</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Amount Earned</th>
                        <th>Amount Paid</th>
                        <th>Balance Earning</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody class="table-data">

                    <?php 
    $user = new User;
   
    $allusers = $user->selectAllUsers();
    
        $agentid = [];
                 foreach ($allusers as $key => $value3) { 
                    array_push($agentid,$value3['unique_id']);
                 }
                 $agentid2 = array_unique($agentid);
                 $agentid3 = [];
                 foreach ($agentid2 as $key => $value2) { 
                        $agentearnings = $user->selectAgentHistory($value2);
                        foreach ($agentearnings as $key => $value) {
                            $newuser = $user->selectUser($value['earner_id']);
    ?>

                    <tr>
                        <td><span><?php echo $value['earning_id']; ?></span></td>
                        <td><span><?php echo $value['earnee']; ?></span></td>
                        <td><span><?php echo $value['customer_id']; ?></span></td>
                        <td><span><?php echo $value['earner_id']; ?></span></td>
                        <td>User</td>
                        <td><?php echo $newuser['bank_name'];?></td>
                        <td><?php echo $newuser['account_number'];?></td>
                        <td>
                            <?php
                    $earnedprice = $value['earned_amount'];
                    $unitprice2 = $earnedprice;
                    if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
                        echo number_format(round($unitprice2));
                      } else {
                          echo round($unitprice2);
                      }
                  
                                
                    ?>
                        </td>
                        <td><?php echo $value['amount_paid'];?></td>
                        <td><?php echo $value['balance_earning'];?></td>
                        <td><?php echo $value['payment_date'];?></td>
                    </tr>
                    <?php }}?>
                </tbody>
            </table>


            <div class="land-btn-container" style="display: flex; gap: 2em;">

                <?php if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                <a href="agentearnings.php">
                    <button class="btn land-btn">Agent Earnings</button>
                </a>
                <?php }?>
            </div>

            <div class="search-container">
                <div class="select-box">
                    <div class="options-container">
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode1" name="searchmode" value="Name" />
                            <label for="searchmode1">By Name</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode2" name="searchmode" value="Date" />
                            <label for="searchmode2">By Date</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode3" name="searchmode" value="Range" />
                            <label for="searchmode3">By Range</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode4" name="searchmode" value="Pending" />
                            <label for="searchmode4">Pending</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode5" name="searchmode" value="Paid" />
                            <label for="searchmode5">Paid</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode6" name="searchmode" value="Unpaid" />
                            <label for="searchmode6">Unpaid</label>
                        </div>
                    </div>

                    <div class="selected">Choose Search Mode</div>

                </div>

                <div class="search-input2">
                    <form action="" class="search-form">
                        <input type="text" class="search" type="search" name="searchproduct"
                            placeholder="Search For User By Name">
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
                                <input type="radio" class="radio" id="date<?php echo $i;?>" name="searchproduct2"
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

                <div class="search-input2">
                    <form action="" class="dropdown-form">
                        <div class="valuediv2" style="display: none;"></div>
                    </form>
                </div>

                <form action="" class="search-form3">
                    <div class="select-box">
                        <div class="options-container">
                            <?php 
                       
                         for ($i = 0; $i < 31; $i++) { 
                              
                       ?>
                            <div class="option">
                                <input type="radio" class="radio" id="range<?php echo $i;?>" name="searchproduct3"
                                    value="<?php echo $i;?>" />
                                <label for="range<?php echo $i;?>"><?php echo $i;?></label>
                            </div>
                            <?php }?>
                        </div>

                        <div class="selected">Choose Range</div>

                    </div>
                    <div class="valuediv2" style="display: none;"></div>
                </form>


            </div>


            <div class="details-container">


                <?php 
                 $allusers = $user->selectAllUsers();
                 $agentid = [];
                 foreach ($allusers as $key => $value3) { 
                    array_push($agentid,$value3['unique_id']);
                 }
                 $agentid2 = array_unique($agentid);
                 $agentid3 = [];
                 foreach ($agentid2 as $key => $value2) { 
                        $agentearnings = $user->selectAgentHistory($value2);
                        foreach ($agentearnings as $key => $value) {
                            $earnedprice = $value['earned_amount'];
                            array_push($agentid3,$value['earner_id']);
          
    ?>


                <div class="account-detail2"
                    style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
                    <div class="flex">
                        <p style="text-transform: uppercase;">
                            <span style="color: #000000!important; font-size: 16px;"><?php echo $value['earnee'];?>
                                earned &#8358;<?php
                    $unitprice = $earnedprice;
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                                      echo number_format(round($unitprice));
                                    } else {
                                        echo round($unitprice);
                                    }
                                
                    ?>
                            </span>
                        </p>
                        <div class="payee">
                            <p class="payee-tag" style="color: #808080;">
                                <?php 
                                
                                if($value['payee'] == $value['earnee']){ 
                                    echo $value['earnee']." Paid:"; 
                            }   
                            else {
                                    echo "Customer Paid:"; }
                                 ?></p>&nbsp;
                            <p class="payee-name"
                                style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                                &#8358;<?php $unitprice = $value['product_price']; 
                                  if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                                    echo number_format(round($unitprice));
                                  } else {
                                      echo round($unitprice);
                                  }
                                ?> for <?php echo $value['product_name'];?>
                            </p>
                        </div>
                        <div class="inner-detail">
                            <div class="date">
                                <span style="font-size: 13px;"><?php echo $value['payment_date'];?></span>
                            </div>
                        </div>
                        <?php 
                        if($value['balance_earning'] != ""){
                        if($value['balance_earning'] > 0){?>
                        <div class="detail-four">
                            <div class="detail"
                                style="width: 100px; height: 20px; background-color: blue; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <p style="font-size: 14px; color: #fff; text-transform:capitalize;">Pending</p>
                            </div>
                        </div>
                        <?php }?>

                        <?php if($value['balance_earning'] == 0){?>
                        <div class="detail-four">
                            <div class="detail"
                                style="width: 100px; height: 20px; background-color: green; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <p style="font-size: 14px; color: #fff; text-transform:capitalize;">Paid</p>
                            </div>
                        </div>
                        <?php }}?>
                    </div>
                </div>
                <?php } }?>



                <?php $agentid4 = array_unique($agentid3);
                if(empty($agentid4)){?>
                <div class="success">
                    <img src="images/asset_success.svg" alt="" />
                    <p>There are no earnings yet!</p>
                </div>
                <?php }?>

                <div class="account-detail3">
                    <a href="logout.php?user=subadmin">
                        <p>Sign Out</p>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <script src="js/main.js"></script>
    <script>
    let purpose4 = document.getElementsByName("searchmode");
    purpose4.forEach((element) => {
        element.onclick = () => {
            if (element.value == "Name") {
                document.querySelector('.search-form').style.display = "block";
                document.querySelector('.search-form2').style.display = "none";
                document.querySelector('.search-form3').style.display = "none";

                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadearnname&user=customer`
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
            if (element.value == "Date") {
                document.querySelector('.search-form2').style.display = "block";
                document.querySelector('.search-form3').style.display = "none";
                document.querySelector('.search-form').style.display = "none";

                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadearndate&data=${valuediv.innerHTML}&user=customer`
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
            if (element.value == "Range") {
                document.querySelector('.search-form3').style.display = "block";
                document.querySelector('.search-form').style.display = "none";
                document.querySelector('.search-form2').style.display = "none";


                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadearnrange&data=${valuediv2.innerHTML}&user=customer`
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
    //let searchIcon = document.querySelector('.search-icon');

    //let searchinput = document.querySelector('.search-input2');
    let searchinput2 = document.querySelector('.search');

    //searchinput.style.display = "flex";
    //document.querySelector('#searchimg').style.display = "none";

    let searchform = document.querySelector('.search-form');
    let searchform2 = document.querySelector('.search-form2');
    let searchform3 = document.querySelector('.search-form3');
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

    searchinput2.onkeyup = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST",
            `searchearningbyname.php?user=customer`);

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

    let valuediv = document.querySelector('.valuediv');

    let purpose = document.getElementsByName("searchproduct2");
    purpose.forEach((element) => {
        element.onclick = () => {
            valuediv.innerHTML = element.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchearningbydate.php?data=${valuediv.innerHTML}&user=customer`);

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


    });


    let valuediv2 = document.querySelector('.valuediv2');

    let purpose2 = document.getElementsByName("searchproduct3");
    purpose2.forEach((element) => {
        element.onclick = () => {
            valuediv2.innerHTML = element.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchearningbyrange.php?data=${valuediv2.innerHTML}&user=customer`);

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

    let purpose1 = document.querySelector("#searchmode4");
    let purpose3 = document.querySelector("#searchmode5");
    let purpose5 = document.querySelector("#searchmode6");
    let purposearray = [purpose1, purpose3, purpose5];
    document.querySelector('.dropdown-form').style.display = "block";
    purposearray.forEach((element) => {
        element.onclick = () => {
            document.querySelector('.search-form3').style.display = "none";
            document.querySelector('.search-form').style.display = "none";
            document.querySelector('.search-form2').style.display = "none";
            valuediv2.innerHTML = element.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchstatus.php?data=${valuediv2.innerHTML}&user=customer`
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


            if (element.value == "Pending") {
                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadpending&user=customer`
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

            if (element.value == "Paid") {
                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadpaid&user=customer`
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

            if (element.value == "Unpaid") {
                let downloadbtn = document.querySelector('.download-form .land-btn');
                let searchform2 = document.querySelector('.search-form3');

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadunpaid&user=customer`
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

    const form = document.querySelector("#upload-form"),
        fileInput = form.querySelector("#passport"),
        progressArea = document.querySelector(".uploading-div"),
        uploadArea = document.querySelector(".uploading-div2"),
        startbtn = document.querySelector(".centrediv label");
    let uploadbtn = document.querySelector("#upload-form .btn");
    let uploaddiv = document.querySelector(".file-container");
    let submitbtn = document.querySelector("#upload-form .btn");
    const error = document.querySelector(".error");
    const error2 = document.querySelector(".error2");

    uploadbtn.addEventListener("click", () => {
        uploaddiv.style.display = "block";
    });


    form.onsubmit = (e) => {
        e.preventDefault();
    };


    startbtn.addEventListener("click", () => {
        fileInput.click();
    });

    fileInput.onchange = ({
        target
    }) => {
        readXlsxFile(target.files[0]).then(function(data) {
            var i = 0;

            let earningID = [];
            let customerID = [];
            let earnerID = [];
            let paidEarnings = [];
            let balanceEarnings = [];
            data.map((row, index) => {
                // if (i == 0) {
                //     let table = document.getElementById('upload-data');
                //     generateTableHead(table, row);
                // }
                if (i > 0) {
                    earningID.push(row[0]);
                    customerID.push(row[2]);
                    earnerID.push(row[3]);
                    paidEarnings.push(row[8]);
                    balanceEarnings.push(row[9]);

                    // function uploadExcel() {
                    //     let xhr = new XMLHttpRequest();
                    //     xhr.open("POST",
                    //         `uploadexceldata.php?customerid=${row[1]}&earnerid=${row[2]}&paidearnings=${row[7]}&balanceearnings=${row[8]}&earningid=${row[0]}`,
                    //         true);

                    //     xhr.onload = () => {
                    //         if (xhr.readyState === XMLHttpRequest.DONE) {
                    //             if (xhr.status === 200) {
                    //                 let data = xhr.response;
                    //                 console.log(data);
                    //             }
                    //         }
                    //     };
                    //     let formData = new FormData(form)
                    //     xhr.send(formData);
                    // }

                    // uploadExcel();

                    // let table = document.getElementById('upload-data');
                    // generateTableRows(table, row);
                }

                i++;
            })



        })

        function generateTableHead(table, data) {
            let thead = table.createTHead();
            let row = thead.insertRow();
            for (let key of data) {
                let th = document.createElement('th');
                let text = document.createTextNode(key);
                th.appendChild(text);
                row.appendChild(th);
            }
        }

        function generateTableRows(table, data) {
            let newRow = table.insertRow(-1);
            data.map((row, index) => {
                let newCell = newRow.insertCell();
                let newText = document.createTextNode(row);
                newCell.appendChild(newText);
            })
        }

        let file = target.files[0];
        if (file) {
            let fileName = file.name;
            if (fileName.length >= 12) {
                let splitName = fileName.split(".");
                fileName = splitName[0].substring(0, 12) + "..." + splitName[1];
            }
            if (fileName.includes("User")) {
                uploadFile(fileName);
            } else {
                error2.style.visibility = "visible";
            }
        }
    };

    function uploadFile(name) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "uploadexceldata.php", true);
        xhr.upload.addEventListener("progress", ({
            loaded,
            total
        }) => {
            let fileLoaded = Math.floor((loaded / total) * 100);
            let fileTotal = Math.floor(total / 1000);
            let fileSize;
            fileTotal < 1024 ?



                (fileSize = fileTotal + " KB") :
                (fileSize = (loaded / (1024 * 1024)).toFixed(2) + " MB");
            let progressHTML = `
                <div class="progress-bar">
                            <div class="progress-element" style="width: ${fileLoaded}%"></div>
                        </div>
                        <p class="percent"><span class="percent">${fileLoaded}</span>% Complete</p>
                        <div class="upload-state">
                            <p class="file-name">${name}</p>
                        </div>
                `;

            uploadArea.innerHTML = "";
            progressArea.innerHTML = progressHTML;

            if (loaded == total) {
                progressArea.innerHTML = "";
                let uploadedHTML = `
                    <div class="progress-bar">
                            <div class="progress-element" style="width: ${fileLoaded}%"></div>
                        </div>
                        <p class="percent"><span class="percent">Uploaded</p>
                        <div class="upload-state">
                            <p class="file-name">${name}</p>
                            <p class="file-size">${fileSize}</p>
                        </div>
                `;
                uploadArea.innerHTML = uploadedHTML;
                error.style.visibility = "hidden";
            }

            if (total > 2097152) {
                progressArea.innerHTML = "";
                let uploadedHTML = `
                    <div class="progress-bar">
                            <div class="progress-element" style="width: 50%!important; background: #808080!important;"></div>
                        </div>
                        <p class="percent"><span class="percent">Upload Failed</p>
                `;
                uploadArea.innerHTML = uploadedHTML;
                error.textContent = "File Should be 2mb or less";
                error.style.visibility = "visible";
                setTimeout(() => {
                    error.style.visibility = "hidden";
                }, 20000);
                loaded = 0;
            }
        });

        let formData = new FormData(form);
        xhr.send(formData);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    //console.log(data);

                    if (data.includes("BadUpdate")) {
                        alert("Wrong Update Detected");
                        location.reload();
                    } else {
                        alert("Correct Update");
                        location.reload();
                    }

                }
            }
        }

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

        XLSX.writeFile(file, 'Userearningdata.' + type);
    }

    downloadbtn.onclick = () => {
        htmlTableToExcel('xlsx');

    }
    </script>
</body>

</html>