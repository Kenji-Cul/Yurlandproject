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
    }



    header {
        background: #fee1e3;
    }

    .colored-div {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 25%;
        border-radius: 8px;
        gap: 0;
        height: 50px;
        background-color: #fee1e3;
    }

    .detail-3 {
        box-shadow: none !important;
    }

    .colored-div span {
        font-size: 16px;
        text-transform: capitalize;
    }

    section {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .navig {
        width: 20em;
        display: flex;
        justify-content: space-between;
        padding: 0 0.8em;
    }

    .navigation-div .profile {
        background: #ffffff;
        box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.12);
        border-radius: 8px;
        text-align: center;
        color: var(--secondary-color);
        width: 150px;
        padding: 0.8em 0.3em;
    }


    section .error {
        color: #ff6600;
        border: 1px solid #ff6600;
        height: 1em;
        border-radius: 8px;
        margin-bottom: 1.5em;
        width: 80px;
    }

    .copy-div {
        cursor: pointer;
    }

    @media only screen and (max-width: 1300px) {

        .colored-div {
            min-width: 80%;
        }

        .colored-div span {
            font-size: 14px;
            text-transform: capitalize;
        }

        .details-container .land-btn {
            width: 80%;
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

        .dropdown-links li {
            height: 1em;
            grid-gap: 0;
        }

        .flexbtn-container .btn {
            width: 18em;
            font-size: 14px;
        }

        .flexbtn-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1em;
            position: relative;
        }


    }

    @media only screen and (min-width: 1300px) {
        .flexbtn-container {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3em;

        }

        .flexbtn-container .btn {
            width: 100%;
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
            height: 90vh;
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

        .dropdown-links li {
            height: 1em;
            width: 95%;
            text-transform: capitalize;
            font-size: 14px;
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
            width: 80%;
            transition: all 1.5s;
        }


        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
        }

        .prof-container {
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
            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
            <a href="subadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else if(isset($_SESSION['uniquesupadmin_id'])){ ?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
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
            <?php }?>

            <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
            <div class="nav">
                <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
                <img src="images/menu.svg" alt="menu icon" class="menu" />
                <div class="user">
                    <p><?php if(isset($newuser['sup_adminname'])){  ?>
                        <span><?php echo $newuser['sup_adminname']; ?></span>&nbsp;
                        <?php }?>
                    </p>
                    <div class="profile-image">
                        <?php if(!empty($newuser['admin_image'])){?>
                        <a href="superadmininfo.php" style="color: #808080;"><img
                                src="profileimage/<?php echo $newuser['admin_image'];?>" alt="profile image" /></a>
                        <?php }?>
                        <?php if(empty($newuser['admin_image'])){?>
                        <a href="superadmininfo.php" style="color: #808080;">
                            <div class="empty-img" style="border-radius: 50%;">
                                <i class="ri-user-fill"></i>
                            </div>
                        </a>
                        <?php }?>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php }?>


    </header>


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
            <li class="links select-link">
                <a href="subadmin.php"><img src="images/home3.svg" /></a>
                <a href="subadmin.php" class="link">Home</a>
            </li>
            <li class="links">
                <a href="allcustomers.php"><img src="images/referral.svg" /></a>
                <a href="allcustomers.php" class="link">All Customers</a>
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
                <a href="totaltransactions.php"><img src="images/updown.svg" /> </a>
                <a href="totaltransactions.php" class="link">View Transactions</a>
            </li>

            <li class="links">
                <a href="totalref.php"><img src="images/referral.svg" /> </a>
                <a href="totalref.php" class="link">View Referrals</a>
            </li>

            <li class="links">
                <a href="allagents.php"><img src="images/referral.svg" /> </a>
                <a href="allagents.php" class="link">All Agents</a>
            </li>

            <li class="links">
                <a href="subadmininfo.php"><img src="images/settings.svg" /></a>
                <a href="subadmininfo.php" class="link">Profile</a>
            </li>
            <li class="links">
                <a href="logout.php?user=subadmin"><img src="images/exit.svg" /></a>
                <a href="logout.php?user=subadmin" class="link">Logout</a>
            </li>
        </ul>



        <div class="prof-container">
            <div class="page-title2">
                <a href="allcustomers.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>User Profile</p>
            </div>


            <?php 
             $user = new User;
             $newuser = $user->selectUser($_GET['unique']);
            ?>
            <div class="account-detail">

                <?php if(!empty($newuser['photo'])){?>
                <img class="account-img" src="profileimage/<?php echo $newuser['photo'];?>" alt="" />
                <?php }  ?>
                <?php if(empty($newuser['photo'])){?>
                <div class="empty-img">
                    <i class="ri-user-fill"></i>
                </div>
                <?php }?>



                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                    <?php }?>
                </p>
                <?php 
        if($newuser['referral_id'] !== "Yurland"){ ?>
                <p class="referral colored-div">
                    <?php   $seconduser = $user->selectReferralUser($newuser['referral_id']);
               $thirduser = $user->selectReferralAgent($newuser['referral_id']);
            
            ?>
                    <?php if(isset($seconduser['first_name'])){?>
                    <a href="referraldetails.php?ref=<?php if(isset($seconduser['unique_id'])){
                echo $seconduser['unique_id'];
            }?>">

                        <span>Referral:</span>&nbsp;<span><?php if(isset($seconduser['first_name'])){
             echo $seconduser['first_name'];
            }?></span>&nbsp;<span><?php if(isset($seconduser['last_name'])){
                echo $seconduser['last_name'];
            }?></span>

                    </a>
                    <?php }?>
                    <?php if(isset($thirduser['agent_name'])){?>
                    <a href="agentdetails.php?ref=<?php if(isset($thirduser['uniqueagent_id'])){
                echo $thirduser['uniqueagent_id'];
            }?>">
                        <span>Referral:</span>&nbsp;<span><?php if(isset($thirduser['agent_name'])){
             echo $thirduser['agent_name'];
            }?></span>
                    </a>
                    <?php }?>
                </p>
                <?php } else { ?>
                <p class="referral colored-div">
                    <span>Referral:</span>&nbsp;<span><?php echo "Yurland Support";?></span>
                </p>
                <?php }?>
                <div class="referral">

                    <div class="copy-div" style="font-weight: 800;"><span>REFERRAL CODE:</span></div>
                    <div class="referral_code"><?php if(isset($newuser['personal_ref'])){
                echo $newuser['personal_ref'];
            }?> <input type="text" name="" class="copy-text" value="<?php if(isset($newuser['personal_ref'])){
                echo $newuser['personal_ref'];
            }?>" style="display: none;"></div>
                </div>
            </div>

            <div class="details-container">




                <div class="account-detail2">
                    <div>
                        <p><?php if(isset($newuser['first_name'])){  ?>
                            <?php echo $newuser['first_name']; ?><span>&nbsp;</span><?php echo $newuser['last_name']; ?>
                            <?php }?>
                        </p>
                        <span>Account name</span>
                    </div>
                </div>



                <div class="account-detail2">
                    <div>
                        <p><?php if(isset($newuser['home_address']) && !empty($newuser['home_address'])){  
                    echo $newuser['home_address'];
                } else {
                    echo "Home Address";
                 }?>
                        </p>
                        <span>Address</span>
                    </div>
                </div>



                <div class="account-detail2">
                    <div>
                        <p><?php if(isset($newuser['phone_number']) && !empty($newuser['phone_number'])){  
                    echo $newuser['phone_number'];
                } else {
                    echo "Phone Number";
                 }?>
                        </p>
                        <span>Phone number</span>
                    </div>
                </div>



                <div class="account-detail2">
                    <div>
                        <?php if(empty($newuser['home_address']) || empty($newuser['phone_number'])){
    ?>
                        <p>Unverified</p>
                        <?php } else {?>
                        <p>Verified</p>
                        <?php }?>
                        <span>Identification</span>
                    </div>
                </div>


                <div class="account-detail2">
                    <div>
                        <p><?php if(isset($newuser['nextofkin_firstname'])  && !empty($newuser['nextofkin_firstname'])){  ?>
                            <?php echo $newuser['nextofkin_firstname']; ?><span>&nbsp;</span><?php echo $newuser['nextofkin_lastname']; ?>
                        </p>
                        <?php } else {?>
                        <p>Next Of Kin</p>
                        <?php }?>
                        <span>Next of Kin</span>
                    </div>
                </div>

                <div class="flexbtn-container">
                    <a href="customerinfo.php?unique=<?php echo $newuser['unique_id'];?>">
                        <button class="btn land-btn">Customer's Land</button>
                    </a>

                    <?php if(isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
                    <a href="editcustomer.php?unique=<?php echo $newuser['unique_id'];?>">
                        <button class="btn land-btn">Edit Customer</button>
                    </a>
                    <?php }?>
                </div>

            </div>
        </div>
    </div>

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
            document.querySelector(".prof-container").style = `
         padding-left: 13em;
        `;
            let allLinks = document.querySelectorAll(".dropdown-links .links .link");

            let allLink = document.querySelectorAll(".dropdown-links .links");
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
            document.querySelector(".prof-container").style = `
         padding-left: 5em;
        `;

            let allLink = document.querySelectorAll(".dropdown-links .links");
            allLink.forEach((element) => {
                element.style = `
        justify-content: center
        `;
            });

            let allLinks = document.querySelectorAll(".dropdown-links .links .link");
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
    </script>

</body>

</html>