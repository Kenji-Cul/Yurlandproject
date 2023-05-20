<?php 
session_start();
include_once "projectlog.php";
if(!isset($_GET['unique'])){
    header("Location: agentinfo.php");
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

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/read-excel-file@4.x/bundle/read-excel-file.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        min-height: 100vh;
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

    .successmodal {
        /* display: flex; */
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 2em;
    }

    .successmodal .closemodal {
        width: 30px;
        height: 30px;
    }


    .flexdiv-1 {
        width: 100%;
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
        top: 50em;
        transform: translate(-50%, -50%);
        height: 10em;
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



        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
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

        .estatetext {
            gap: 0.5em;
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

        .email-span {
            text-overflow: ellipsis !important;
            overflow: hidden;
            white-space: nowrap;
            display: inline-block;
            width: 140px;
        }

        .success {
            position: absolute;
            top: 50em;
        }



        .payee {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0 !important;
            width: 280px;
            position: relative;
        }

        .page-title2 {
            display: flex;
            gap: 2em;
            width: 80%;
        }

        .payee .payee-tag {
            width: 35%;
            font-size: 11px;
        }

        .payee .payee-name {
            width: 65%;
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

        ?>.update-data {
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


        <?php 
    $user = new User;
    $agent = $user->selectExecutive($_GET['unique']);
    
   
    ?>

        <div class="profile-container">

            <div class="page-title2">
                <a href="execinfo.php?unique=<?php echo $agent['unique_id'];?>&real=91838JDFOJOEI939">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <div style="display: flex !important; flex-direction: row; !important" class="estatetext">
                    <p class="email-span"><?php echo $agent['full_name']?></p>
                    <p>Earnings</p>
                </div>

            </div>
            <div class="profile-image" style="margin-left: 3em;">
                <?php if(!empty($agent['executive_img'])){?>
                <img src="profileimage/<?php echo $agent['executive_img'];?>" alt="profile image" />
                <?php }?>
                <?php if(empty($agent['executive_img'])){?>
                <div class="empty-img" style="border-radius: 50%;">
                    <i class="ri-user-fill"></i>
                </div>
                <?php }?>
            </div>

            <form action="" class="download-form">
                <button class="btn land-btn" style="width: 170px; margin-left: 2em;"><span
                        style="font-size: 14px;">Download Earnings</span></button>
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

                <button class="btn land-btn" style="width: 170px; margin-left: 2em;" type="submit"
                    name="importSubmit"><span style="font-size: 14px;">Upload Earnings</span></button>
            </form>

            <table id="user-data" style="display: none;">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Earner ID(Do Not Edit)</th>
                        <th>Role</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Amount Earned</th>
                        <th>Amount Paid</th>
                        <th>Balance Earning</th>
                    </tr>
                </thead>
                <tbody class="table-data">

                    <?php 
    $user = new User;
   
    $earn = $user->selectAgentHistory($_GET['unique']);
    if(!empty($earn)){
        $earnerid = [];
        foreach($earn as $key => $value){
            array_push($earnerid,$value['earner_id']);

        }
        $earnerid2 = array_unique($earnerid);
        foreach ($earnerid2 as $key => $value) {
            $newuser = $user->selectExecutive($value);
        
    ?>
                    <tr>
                        <td><span><?php echo $newuser['executive_id']; ?></span>
                        <td><span><?php echo $newuser['full_name']; ?></span>
                        </td>
                        <td><span><?php echo $value; ?></span></td>
                        <td>Executive</td>
                        <td><?php echo $newuser['bank_name'];?></td>
                        <td><?php echo $newuser['account_number'];?></td>
                        <td><?php
                          $unitprice2 = $user->selectAgentTotalEarnings($value);
                          echo round($unitprice2);
                
                    ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php }}?>
                </tbody>
            </table>


            <div class="search-container">
                <div class="select-box">
                    <div class="options-container">
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode1" name="searchmode" value="Pending" />
                            <label for="searchmode1">Pending</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode2" name="searchmode" value="Paid" />
                            <label for="searchmode2">Paid</label>
                        </div>
                    </div>

                    <div class="selected">Choose Search Mode</div>

                </div>


                <div class="search-input2">
                    <form action="" class="dropdown-form">
                        <div class="valuediv2" style="display: none;"></div>
                    </form>
                </div>
            </div>


            <div class="details-container">




                <?php   $earning = $user->selectAgentHistory($_GET['unique']);
            if(!empty($earning)){
                foreach($earning as $key => $value){
    ?>

                <div class="account-detail2"
                    style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
                    <div class="flex">
                        <p style="text-transform: uppercase;">
                            <span style="color: #000000!important; font-size: 16px;"><?php echo $value['earnee'];?>
                                has
                                earned &#8358;<?php $percent = $agent['earning'];
                    $earnedprice = $value['earned_amount'];
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
                                    echo "Customer Paid:"; 
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
                        if($value['earning_status'] == "unpaid"){?>
                        <div class="detail-four">
                            <div class="detail"
                                style="width: 100px; height: 20px; background-color: blue; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <p style="font-size: 14px; color: #fff; text-transform:capitalize;">Pending</p>
                            </div>
                        </div>
                        <?php }?>

                        <?php if($value['balance_earning'] == 0 && $value['earning_status'] == "paid"){?>
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




                <?php if(empty($earning)){?>
                <div class="success">
                    <img src="images/asset_success.svg" alt="" />
                    <p><?php echo $agent['full_name'];?> has no earnings yet!</p>
                </div>
                <?php }?>

                <div class="account-detail3">
                    <a href="logout.php">
                        <p>Sign Out</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="successmodal">
        <div class="modalcon">
            <div class="modaldiv">
                <img src="images/close2.svg" alt="" class="closemodal">
                <div>
                    <img src="images/asset_success.svg" alt="" />
                    <?php if($agent['agent_status'] == "Disabled"){?>
                    <p>Agent Enabled</p>
                    <p>Successfully</p>
                    <?php } else {?>
                    <p>Agent Disabled</p>
                    <p>Successfully</p>

                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script>
    let searchinput2 = document.querySelector('.search');

    //searchinput.style.display = "flex";
    //document.querySelector('#searchimg').style.display = "none";
    let valuediv2 = document.querySelector('.valuediv2');
    let searchform = document.querySelector('.search-form');
    let searchform4 = document.querySelector('.dropdown-form');
    let purpose1 = document.querySelector("#searchmode1");
    let purpose3 = document.querySelector("#searchmode2");
    let purposearray = [purpose1, purpose3];
    document.querySelector('.dropdown-form').style.display = "block";
    purposearray.forEach((element) => {
        element.onclick = () => {
            valuediv2.innerHTML = element.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchstatus.php?data=${valuediv2.innerHTML}&user=executive&execuser=<?php echo $_GET['unique'];?>`
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

                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadpending&user=executive&execuser=<?php echo $_GET['unique'];?>`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel2('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform4);
                    xhr.send(formData);

                }
            }

            if (element.value == "Paid") {
                let downloadbtn = document.querySelector('.download-form .land-btn');


                downloadbtn.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST",
                        `downloadbyland.php?mode=downloadpaid&user=executive&execuser=<?php echo $_GET['unique'];?>`
                    );

                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                let data = xhr.response;
                                //console.log(data);
                                document.querySelector('.table-data').innerHTML = data;
                                htmlTableToExcel2('xlsx');
                            }
                        }
                    };
                    let formData = new FormData(searchform4);
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

    let downloadbtn = document.querySelector('.download-form .land-btn');
    let downloadform = document.querySelector('.download-form');
    downloadform.onsubmit = (e) => {
        e.preventDefault();
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
            if (fileName.includes("Executive")) {
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

        XLSX.writeFile(file, 'Executiveearningdata.' + type);
    }

    function htmlTableToExcel2(type) {
        var userdata = document.getElementById('user-data');
        var file = XLSX.utils.table_to_book(userdata, {
            sheet: "sheet1"
        });
        XLSX.write(file, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        });

        XLSX.writeFile(file, 'Earningsdata.' + type);
    }

    downloadbtn.onclick = () => {
        htmlTableToExcel('xlsx');

    }
    </script>
</body>

</html>