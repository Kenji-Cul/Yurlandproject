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
        top: 50em;
        transform: translate(-50%, -50%);
        height: 20%;

    }

    .success p {
        text-align: center;
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

        .success {
            height: 20%;
            position: absolute;
            top: 44em;
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
                <a href="totalearnings.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Total Agent Earnings</p>

            </div>

            <form action="" class="download-form">
                <button class="btn land-btn" style="width: 70px; margin-left: 2em;"><i class="ri-download-line"
                        id="export"></i></button>
            </form>

            <table id="user-data" style="display: none;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>Amount Paid</th>
                        <th>Amount Earned</th>
                        <th>Balance Earning</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody class="table-data">

                    <?php 
    $user = new User;
   
    $allusers = $user->selectAllAgents();
        $agentid = [];
        foreach ($allusers as $key => $value3) { 
           array_push($agentid,$value3['uniqueagent_id']);
        }
        $agentid2 = array_unique($agentid);
        $agentid3 = [];
        foreach ($agentid2 as $key => $value2) { 
           $agentearnings = $user->selectAgentHistory($value2);
           foreach ($agentearnings as $key => $value) {
            $newuser = $user->selectAgent($value['earner_id']);
        
    ?>
                    <tr>
                        <td><span><?php echo $value['earnee']; ?></span>
                        </td>
                        <td>Agent</td>
                        <td><?php echo $newuser['bank_name'];?></td>
                        <td><?php echo $newuser['account_number'];?></td>
                        <td>&#8358;<?php 
                    $unitprice = $value['product_price'];
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                                      echo number_format(round($unitprice));
                                    } else {
                                        echo round($unitprice);
                                    }
                                
                    ?></td>
                        <td>&#8358;<?php
                    $earnedprice = $value['earned_amount'];
                    $unitprice2 = $earnedprice;
                    if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
                        echo number_format(round($unitprice2));
                      } else {
                          echo round($unitprice2);
                      }
                  
                                
                    ?></td>
                        <td>&#8358;<?php 
                 $earnedprice = $value['earned_amount'];
                    $unitprice = $value['product_price'] - $earnedprice;
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                                      echo number_format(round($unitprice));
                                    } else {
                                        echo round($unitprice); }   
                    ?></td>
                    </tr>
                    <?php }}?>
                </tbody>
            </table>


            <div class="land-btn-container" style="display: flex; gap: 2em;">

                <?php if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                <a href="totalearnings.php">
                    <button class="btn land-btn">User Earnings</button>
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
                    </div>

                    <div class="selected">Choose Search Mode</div>

                </div>

                <div class="search-input2">
                    <form action="" class="search-form">
                        <input type="text" class="search" type="search" name="searchproduct"
                            placeholder="Search For Agent By Name">
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
                 $allusers = $user->selectAllAgents();
                 $agentid = [];
                 foreach ($allusers as $key => $value3) { 
                    array_push($agentid,$value3['uniqueagent_id']);
                 }
                 $agentid2 = array_unique($agentid);
                 $agentid3 = [];
                 foreach ($agentid2 as $key => $value2) { 
                    $agentearnings = $user->selectAgentHistory($value2);
                    foreach ($agentearnings as $key => $value) {
                        array_push($agentid3,$value['earner_id']);
                        $earnedprice = $value['earned_amount'];
  
          
    ?>

                <a href="agenthistory.php?unique=<?php echo $value['earner_id'];?>">
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
                                    echo "Customer Paid:";   
                                }

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
                        </div>
                    </div>
                </a>
                <?php }}?>


                <?php 
                 $agentid4 = array_unique($agentid3);
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
                        `downloadbyland.php?mode=downloadearnname&user=agent`
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
                        `downloadbyland.php?mode=downloadearndate&data=${valuediv.innerHTML}&user=agent`
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
                        `downloadbyland.php?mode=downloadearnrange&data=${valuediv2.innerHTML}&user=agent`
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
            `searchearningbyname.php?user=agent`);

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
                `searchearningbydate.php?data=${valuediv.innerHTML}&user=agent`);

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
                `searchearningbyrange.php?data=${valuediv2.innerHTML}&user=agent`);

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

        XLSX.writeFile(file, 'Agentearningdata.' + type);
    }

    downloadbtn.onclick = () => {
        htmlTableToExcel('xlsx');

    }
    </script>
</body>

</html>