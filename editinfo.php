<?php 
session_start();
include "projectlog.php";
if(!isset($_GET['id'])){
  header("Location: superadmin.php");
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
    body {
        background-image: none;
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

    .successmodal {
        /* display: flex; */
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 140vh;
    }

    .body {
        height: 300vh;
    }

    @media only screen (max-width: 800px) {
        body {

            background-image: none;
        }
    }

    @media only screen (max-width: 500px) {
        body {
            background-image: none;
        }
    }

    section .error {
        width: 60%;
    }

    .btn {
        background-color: #808080;
    }

    .login-form .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
        width: 80%;
    }

    .label {
        font-style: normal;
        font-weight: 600;
        font-size: 17px;
        line-height: 18px;
        padding-bottom: 10px;
        padding-left: 10px;
    }

    .select-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        align-items: center;
        justify-content: center;
        flex-direction: row;
        width: 100% !important;
        gap: 4em;
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

        .account-detail {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding-left: 2em;
            gap: 0.5em;
        }

        .account-detail .account-img {
            width: 90px;
            height: 90px;
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





        .close {
            padding-top: 6em;
        }

        /* .close {
            position: absolute;
            top: 4em;
            right: 1em;
        } */

    }

    section .error {
        width: 60%;
    }
    </style>
</head>

<body class="body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>

        <?php 
             $user = new User;
             $newuser = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
            ?>

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
    </header>



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
        <div class="profile-container">
            <!-- Landing Page Text -->
            <div class="page-title2">
                <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
                <a href="allproducts.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <?php }?>
                <div style="display: flex !important; flex-direction: column !important" class="estatetext">
                    <p>Edit Land
                    </p>
                </div>
            </div>

            <section class="login-form-container">
                <?php 
                 
                 $land = new User;
                   $landview = $land->selectLandImage($_GET['id']);
                   if(!empty($landview)){
                       foreach($landview as $key => $value){  ?>
                <form action="" class="login-form" id="signup-form">
                    <div class="input-div name">
                        <label for="landname">Product Name</label>
                        <input type="text" id="landname" placeholder="Edit land name" name="landname"
                            value="<?php if(isset($value['product_name'])){echo $value['product_name'];}?>" />
                    </div>

                    <div class="input-div name">
                        <label for="" pstate">Present State</label>
                        <input type="text" id="" pstate" name="pstate"
                            value="<?php if(isset($value['product_location'])){echo $value['product_location'];}?>"
                            disabled />
                    </div>

                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="lagos" name="state" value="Lagos" />
                                <label for="lagos">Lagos</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="ogun" name="state" value="Ogun" />
                                <label for="ogun">Ogun</label>
                            </div>
                        </div>
                        <div class="selected">Edit Location</div>
                    </div>


                    <div class="input-div name">
                        <label for="description">Product Description</label>
                        <input type="text" id="description" placeholder="Edit land description" name="description"
                            value="<?php if(isset($value['product_description'])){echo $value['product_description'];}?>" />
                    </div>

                    <div class="input-div name">
                        <label for="budget">Present Budget</label>
                        <input type="text" id="budget" name="pbudget"
                            value="<?php if(isset($value['product_budget'])){echo $value['product_budget'];}?>"
                            disabled />
                    </div>

                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="budget1" name="budget"
                                    value="250,000 - 500,000" />
                                <label for="budget1">250,000 - 500,000</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="budget2" name="budget"
                                    value="500,000 - 1,500,000" />
                                <label for="budget2">500,000 - 1,500,000</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="budget3" name="budget"
                                    value="1,500,000 - 3,000,000" />
                                <label for="budget3">1,500,000 - 3,000,000</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="budget4" name="budget"
                                    value="3,000,000 - 5,000,000" />
                                <label for="budget4">3,000,000 - 5,000,000</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="budget5" name="budget"
                                    value="5,000,000 - Above" />
                                <label for="budget5">5,000,000 - Above</label>
                            </div>
                        </div>
                        <div class="selected">Edit Budget</div>
                    </div>


                    <div class="input-div email">
                        <label for="purpose">Purpose</label>
                        <input type="text" id="purpose" placeholder="Edit land purpose" name="purpose"
                            value="<?php if(isset($value['purpose'])){echo $value['purpose'];}?>" disabled />
                    </div>

                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="residential" name="purpose" value="Residential" />
                                <label for="residential">Residential</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="commercial" name="purpose" value="Commercial" />
                                <label for="commercial">Commercial</label>
                            </div>
                        </div>
                        <div class="selected">Edit Purpose</div>
                    </div>


                    <div class="input-div email">
                        <label for="size">Product Size</label>
                        <input type="text" id="size" placeholder="Edit land size" name="size"
                            value="<?php if(isset($value['product_size'])){echo $value['product_size'];}?>" />
                    </div>

                    <div class="input-div email">
                        <label for="feature">Estate Feature</label>
                        <input type="text" id="feature" placeholder="Edit land feature" name="feature"
                            value="<?php if(isset($value['estate_feature'])){echo $value['estate_feature'];}?>" />
                    </div>

                    <div class="input-div email">
                        <label for="allocationfee">Allocation Fee</label>
                        <input type="number" id="allocationfee" placeholder="Edit allocation fee" name="allocationfee"
                            value="<?php if(isset($value['allocation_fee'])){echo $value['allocation_fee'];}?>" />
                    </div>

                    <div class="input-div number">
                        <label for="unitnum">Product Unit</label>
                        <input type="number" id="unitnum" placeholder="Edit product unit" name="unitnum"
                            value="<?php if(isset($value['product_unit'])){echo $value['product_unit'];}?>" />
                    </div>

                    <?php if($value['outright_price'] == "0"){?>
                    <div class="input-div name dailyprice">
                        <label for="dailyprice">Subscription Price Per Unit</label>
                        <input type="number" id="eighteenmonthprice" placeholder="Edit subcription price per unit"
                            name="eighteenmonth"
                            value="<?php if(isset($value['onemonth_price'])){echo $value['onemonth_price'];}?>" />
                    </div>
                    <?php } else if($value['onemonth_price'] == "0"){?>
                    <div class="input-div name">
                        <label for="outrightprice">Outright Price</label>
                        <input type="number" id="outrightprice" placeholder="Edit outright price" name="outrightprice"
                            value="<?php if(isset($value['outright_price'])){echo $value['outright_price'];}?>" />
                    </div>
                    <?php } else if($value['outright_price'] != "0" && $value['onemonth_price'] != "0"){?>
                    <div class="input-div name dailyprice">
                        <label for="dailyprice">Subscription Price Per Unit</label>
                        <input type="number" id="eighteenmonthprice" placeholder="Edit subcription price per unit"
                            name="eighteenmonth"
                            value="<?php if(isset($value['onemonth_price'])){echo $value['onemonth_price'];}?>" />
                    </div>

                    <div class="input-div name">
                        <label for="outrightprice">Outright Price</label>
                        <input type="number" id="outrightprice" placeholder="Edit outright price" name="outrightprice"
                            value="<?php if(isset($value['outright_price'])){echo $value['outright_price'];}?>" />
                    </div>
                    <?php }?>
                    <div class="input-div email">
                        <input type="hidden" name="uniqueland" value="<?php
                        echo $value['unique_id'];?>">
                    </div>

                    <div class="input-div email">
                        <label>Product Image</label>
                        <input type="text" name="text" placeholder="Edit product image" disabled />
                        <input type="file" id="passport" placeholder="Edit product image" name="image" hidden="hidden"
                            accept="image/*" />
                        <div id="createid">Upload</div>
                    </div>

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

                    <p class="error">Please input all fields</p>
                    <div class="value" style="visibility: hidden">
                        <?php if(isset($value['product_location'])){echo $value['product_location'];}?></div>
                    <div class="value2" style="visibility: hidden">
                        <?php if(isset($value['product_budget'])){echo $value['product_budget'];}?></div>
                    <div class="value3" style="visibility: hidden">
                        <?php if(isset($value['purpose'])){echo $value['purpose'];}?></div>


                    <button class="btn" type="submit">Edit Product</button>
                    <div style="display: none">
                        <img src="images/loading.svg" alt="" class="loading-img" />
                    </div>
                </form>
                <?php }}?>
            </section>
        </div>
    </div>

    <div class="successmodal">
        <div class="modalcon">
            <div class="modaldiv">
                <div>
                    <img src="images/asset_success.svg" alt="" />
                    <p>Land</p>
                    <p>Edit Successful</p>
                    <a href="allproducts.php"><button class="landing_page_button2">Back to Products</button></a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script>
    const form = document.querySelector("#signup-form"),
        fileInput = form.querySelector("#passport"),
        progressArea = document.querySelector(".uploading-div"),
        uploadArea = document.querySelector(".uploading-div2"),
        startbtn = document.querySelector(".centrediv label");
    let uploadbtn = document.querySelector("#createid");
    let uploaddiv = document.querySelector(".file-container");
    let valuediv = document.querySelector(".value");
    let valuediv2 = document.querySelector(".value2");
    let valuediv3 = document.querySelector(".value3");
    let budgets = document.getElementsByName("budget");
    const error = document.querySelector(".error");
    const submitbtn = document.querySelector("#signup-form .btn");
    uploadbtn.addEventListener("click", () => {
        uploaddiv.style.display = "block";
    });

    let locations = document.getElementsByName("state");
    locations.forEach((element) => {
        element.onclick = () => {
            valuediv.innerHTML = element.value;
        };
    });
    form.onsubmit = (e) => {
        e.preventDefault();
        submitbtn.innerHTML = "";
        submitbtn.appendChild(document.querySelector('.loading-img'))
    };

    budgets.forEach((element) => {
        element.onclick = () => {
            valuediv2.innerHTML = element.value;
        };
    });

    let purpose = document.getElementsByName("purpose");
    purpose.forEach((element) => {
        element.onclick = () => {
            valuediv3.innerHTML = element.value;
        };
    });

    startbtn.addEventListener("click", () => {
        fileInput.click();
    });

    fileInput.onchange = ({
        target
    }) => {
        let file = target.files[0];
        if (file) {
            let fileName = file.name;
            if (fileName.length >= 12) {
                let splitName = fileName.split(".");
                fileName = splitName[0].substring(0, 12) + "..." + splitName[1];
            }
            uploadFile(fileName);
        }
    };

    function uploadFile(name) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "inserters/uploadproductimage.php");
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

            if (total > 4194304) {
                progressArea.innerHTML = "";
                let uploadedHTML = `
                    <div class="progress-bar">
                            <div class="progress-element" style="width: 50%!important; background: #808080!important;"></div>
                        </div>
                        <p class="percent"><span class="percent">Upload Failed</p>
                        <div class="upload-state">
                            <p class="file-name">Try again</p>
                        </div>
                `;
                uploadArea.innerHTML = uploadedHTML;
                error.textContent = "File Should be 4mb or less";
                error.style.visibility = "visible";
                setTimeout(() => {
                    error.style.visibility = "hidden";
                }, 20000);
                loaded = 0;
            }
        });
        let formData = new FormData(form);
        xhr.send(formData);
    }

    document.querySelector('#signup-form .btn').onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST",
            `inserters/editproduct.php?state=${valuediv.innerHTML}&budget=${valuediv2.innerHTML}&purpose=${valuediv3.innerHTML}`
        );
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    console.log(data);
                    if (data === "success") {
                        submitbtn.innerHTML = "Edit Land";
                        document.querySelector('.successmodal').style.display =
                            "flex";
                        document.querySelector('.modalcon').classList.add('animation');
                    } else {
                        if (error.textContent = data) {
                            error.style.visibility = "visible";
                            submitbtn.innerHTML = "Edit Land";
                            //uploaddiv.style.display = "none";
                            setTimeout(() => {
                                error.style.visibility = "hidden";
                            }, 20000);
                        }
                    }
                }
            }
        };
        let formData = new FormData(form);
        xhr.send(formData);
    }
    </script>
    <script>
    //  $(document).ready(function() {
    //             $("#signup-form").submit(function(e) {
    //                 e.preventDefault();
    //                 var loadingImg = $(".loading-img");
    //                 $(".btn").html(loadingImg);
    //             });



    //     $("#signup-form .btn").click(function() {
    //         $.ajax({
    //             type: "POST",
    //             url: `inserters/editproduct.php?state=${valuediv.innerHTML}&budget=${valuediv2.innerHTML}`,
    //             data: $("#signup-form input"),
    //             success: function(response) {
    //                 console.log(response);
    //                 if (response === "success") {
    //                     document.querySelector('.successmodal').style.display =
    //                         "flex";
    //                     document.querySelector('.modalcon').classList.add('animation');
    //                     $(".btn").html("Edit Product");
    //                 } else {
    //                     $("section .error").html(response);
    //                     $("section .error").css({
    //                         visibility: "visible",
    //                     });
    //                     $(".btn").html("Edit Product");
    //                     // console.log(response);
    //                 }
    //             },
    //         });
    //     });
    // });

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