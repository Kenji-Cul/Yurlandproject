<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['unique_id'])){
    header("Location: login.php");
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

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
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
        min-width: 230px;
        border-radius: 8px;
        gap: 0;
        height: 50px;
        background-color: #fee1e3;
    }

    .detail-3 {
        box-shadow: none !important;
    }

    .colored-div span {
        font-size: 18px;
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


    }

    @media only screen and (min-width: 1300px) {
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
            <?php if(isset($_SESSION['unique_id'])){?>
            <a href="profile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>
        <div class="nav">
            <a href="cartreview.php">
                <div class="cart">
                    <div class="cart-notify"></div>
                    <img src="images/cart.svg" alt="cart icon" />
                </div>
            </a>
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <div class="user">
                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['photo'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
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
                    <img src="images/home.svg" style="width: 20px; height: 20px;" />
                </li>

                <li id="closeicon" style="display: none; cursor: pointer; font-size:14px;">
                    <img src="images/home.svg" style="width: 20px; height: 20px;" />
                </li>
            </div>
            <li class="close">
                <img src="images/close2.svg" style="width: 30px; height: 30px; position: absolute; right: 2em;" />
            </li>
            <li class="links">
                <a href="profile.php"><img src="images/home3.svg" /></a>
                <a href="profile.php" class="link">Home</a>
            </li>
            <li class="links">
                <a href="allestates.php"><img src="images/land2.svg" /></a>
                <a href="allestates.php" class="link">New Land</a>
            </li>
            <li class="links">
                <a href="transactions.php"><img src="images/updown.svg" /> </a>
                <a href="transactions.php" class="link">Transaction History</a>
            </li>
            <li class="links">
                <a href="mylands.php"><img src="images/land2.svg" /></a>
                <a href="mylands.php" class="link">My Land</a>
            </li>
            <li class="links">
                <a href="mylands.php"><img src="images/chart2.svg" /> </a>
                <a href="mylands.php" class="link">New Payment</a>
            </li>
            <li class="links">
                <a href="userreferral.php"><img src="images/referral.svg" /></a>
                <a href="userreferral.php" class="link">Referral</a>
            </li>
            <li class="links">
                <a href="documents.php"><img src="images/folder.svg" /></a>
                <a href="documents.php" class="link">Documentation</a>
            </li>
            <li class="links select-link">
                <a href="settings.php"><img src="images/settings.svg" /></a>
                <div>
                    <a href="profiledetails.php" class="link">Profile&nbsp;<span style="color: #808080;">and</span></a>
                    <a href="settings.php" class="link">Settings</a>
                </div>
            </li>
            <li class="links">
                <a href="logout.php"><img src="images/exit.svg" /></a>
                <a href="logout.php" class="link">Logout</a>
            </li>
        </ul>


        <div class="prof-container">
            <div class="page-title2">
                <a href="profile.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Profile</p>
            </div>

            <section>
                <p class="error">Copied</p>
            </section>




            <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>
            <div class="account-detail">
                <div class="navigation-div">
                    <div class="navig">
                        <a href="profiledetails.php">
                            <div class="profile">Profile</div>
                        </a>
                        <a href="settings.php" style="color: #ff6600;">
                            <div class="settings">Settings</div>
                        </a>
                    </div>
                </div>
                <?php if(!empty($newuser['photo'])){?>
                <img class="account-img" src="profileimage/<?php echo $newuser['photo'];?>" alt="" />
                <?php }  ?>
                <?php if(empty($newuser['photo'])){?>
                <div class="empty-img">
                    <i class="ri-user-fill"></i>
                </div>
                <?php }?>

                <a href="updatedetails.php" style="color: #808080;">
                    <p style="font-size: 15px; color: #808080; text-transform: capitalize;"><i
                            class="ri-upload-2-line"></i><span>Upload Profile Picture</span></p>
                </a>

                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                    <?php }?>
                </p>
                <?php 
        if($newuser['referral_id'] !== ""){ ?>
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
                    <?php if($newuser['personal_ref'] !== ""){?>
                    <div class="copy-div"><span>copy</span><img src="images/copy.svg" alt="" /></div>
                    <?php }?>
                    <div class="referral_code"><?php if(isset($newuser['personal_ref'])){
                echo $newuser['personal_ref'];
            }?> <input type="text" name="" class="copy-text" value="<?php if(isset($newuser['personal_ref'])){
                echo $newuser['personal_ref'];
            }?>" style="display: none;"></div>
                </div>
            </div>

            <div class="details-container">

                <a href="updatedetails.php">
                    <div class="account-detail2">
                        <div>
                            <p><?php if(isset($newuser['first_name'])){  ?>
                                <?php echo $newuser['first_name']; ?><span>&nbsp;</span><?php echo $newuser['last_name']; ?>
                                <?php }?>
                            </p>
                            <span>Account name</span>
                        </div>
                        <i class="ri-arrow-right-s-line" style="color: #808080;"></i>
                    </div>
                </a>

                <a href="address.php">
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
                        <i class="ri-arrow-right-s-line" style="color: #808080;"></i>
                    </div>
                </a>

                <a href="updatenumber.php">
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
                        <i class="ri-arrow-right-s-line" style="color: #808080;"></i>
                    </div>
                </a>

                <a href="insertdocument.php">
                    <div class="account-detail2">
                        <div>
                            <?php if(empty($newuser['driver_license']) || empty($newuser['passport']) || empty($newuser['nin'])){
    ?>
                            <p>Unverified</p>
                            <?php } else {?>
                            <p>Verified</p>
                            <?php }?>
                            <span>Identification</span>
                        </div>
                        <i class="ri-arrow-right-s-line" style="color: #808080;"></i>
                    </div>
                </a>

                <a href="nextofkin.php
        ">
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
                        <i class="ri-arrow-right-s-line" style="color: #808080;"></i>
                    </div>
                </a>

                <div class="account-detail2 detail-3">
                    <button class="btn"><a
                            href="mailto:help@yurland.com?subject=RequestChangeOfOwnership&body=Hi,i would like to transfer my land to a new user Below are my details and that of the new user"
                            style="color: #fff;">Request
                            Change Of Ownership</a></button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/cart.js"></script>
    <script>
    let copybtn = document.querySelector('.copy-div');

    copybtn.onclick = () => {
        copyFunction();
    }

    function copyFunction() {
        // Get the text field
        var copyText = document.querySelector('.copy-text');

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        let referralLink =
            `http://localhost/Yurland/signup.php?ref=${copyText.value}&key=a&refkey=785e7&rex=l73`;
        navigator.clipboard.writeText(referralLink);
        if (navigator.clipboard.writeText(referralLink)) {
            setTimeout(() => {
                document.querySelector("section .error").style.visibility = "visible";
            }, 400);
            setTimeout(() => {
                document.querySelector("section .error").style.visibility = "hidden";
            }, 4000);


        }


    }


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