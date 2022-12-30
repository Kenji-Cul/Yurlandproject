<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['uniqueagent_id'])){
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

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        min-height: 70vh !important;
        overflow-x: hidden;
        position: relative;
    }

    .footerdiv {
        position: absolute;
        bottom: 0;
    }

    section {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    section .error {
        color: #ff6600;
        border: 1px solid #ff6600;
        height: 1em;
        border-radius: 8px;
        margin-bottom: 1.5em;
        width: 80px;
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
            height: 90vh;
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

        .dropdown-links li {
            height: 1em;
            grid-gap: 0;
        }

        .land-estate {
            width: 290px;
        }



        .close {
            position: absolute;
            top: 1em;
            right: 1em;
        }


        .update-data {
            position: absolute;
            top: -3em;
        }
    }


    .copy-div {
        cursor: pointer;
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <a href="agentprofile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>

        <?php 
             $user = new User;
             $newuser = $user->selectAgent($_SESSION['uniqueagent_id']);
            ?>

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

            <li class="links select-link">
                <a href="agentprofileinfo.php"><img src="images/settings.svg" /></a>
                <a href="agentprofileinfo.php" class="link">Profile</a>
            </li>
            <li class="links">
                <a href="agentlogout.php"><img src="images/exit.svg" /></a>
                <a href="agentlogout.php" class="link">Logout</a>
            </li>
        </ul>



        <div class="profile-container">
            <div class="page-title2">
                <a href="agentprofile.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Account Details</p>
            </div>

            <section>
                <p class="error">Copied</p>
            </section>
            <?php 
             $user = new User;
             $newuser = $user->selectAgent($_SESSION['uniqueagent_id']);
            ?>
            <div class="account-detail">
                <?php if(!empty($newuser['agent_img'])){?>
                <img class="account-img" src="profileimage/<?php echo $newuser['agent_img'];?>" alt="" />
                <?php }  ?>
                <?php if(empty($newuser['agent_img'])){?>
                <div class="empty-img">
                    <i class="ri-user-fill"></i>
                </div>
                <?php }?>

                <p><?php if(isset($newuser['agent_name'])){  ?>
                    <span><?php echo $newuser['agent_name']; ?></span>&nbsp;
                    <?php }?>
                </p>
                <div class="referral">
                    <div class="copy-div"><span>copy</span><img src="images/copy.svg" alt="" /></div>
                    <div class="referral_code"><?php if(isset($newuser['referral_id'])){
                echo $newuser['referral_id'];
            }?> <input type="text" name="" class="copy-text" value="<?php if(isset($newuser['referral_id'])){
                echo $newuser['referral_id'];
            }?>" style="display: none;"></div>
                </div>
            </div>

            <div class="details-container">

                <a href="agentimg.php">
                    <div class="account-detail2">
                        <div>
                            <p><?php if(isset($newuser['agent_name'])){  ?>
                                <?php echo $newuser['agent_name']; ?><span>&nbsp;
                                    <?php }?>
                            </p>

                            <span> <?php if(empty($newuser['home_address']) || empty($newuser['agent_img']) || empty($newuser['agent_num'])){
    ?>
                                <span>Update Your Details</span>
                                <?php } else {?>
                                <span>Verified</span>
                                <?php }?>
                            </span>
                        </div>
                        <i class="ri-arrow-right-s-line" style="color: #808080;"></i>
                    </div>
                </a>

                <div class="account-detail2">
                    <div>
                        <p style="text-transform: capitalize;">
                            Phone Number
                        </p>
                        <span><?php if(isset($newuser['agent_num'])){  ?>
                            <?php echo $newuser['agent_num']; ?><span>&nbsp;
                                <?php }?></span>
                    </div>
                </div>

                <div class="account-detail2">
                    <div>
                        <p style="text-transform: capitalize;">
                            Email
                        </p>
                        <span><?php if(isset($newuser['agent_email'])){  ?>
                            <?php echo $newuser['agent_email']; ?><span>&nbsp;
                                <?php }?></span>
                        </span>
                    </div>
                </div>

                <div class="account-detail2">
                    <div style="display: flex; flex-direction: column; gap: 0.4em;">
                        <p style="text-transform: capitalize;">
                            Percentage Commission
                        </p>
                        <span><?php if(isset($newuser['earning_percentage'])){ ?>
                            <?php echo $newuser['earning_percentage']; ?><span>%
                                <?php }?></span>
                            </p>
                        </span>
                        <p>
                            <a href="https://chat.whatsapp.com/KC9NaLdq9otGNcD7zkjeIL" style="color: #fff;">
                                <div class="estate_page_button"
                                    style="width: 120px; height: 10px; font-size: 14px; background-color: green;">
                                    Join
                                    Info Room
                                </div>
                            </a>
                        </p>
                        <p>
                            <a href="https://wa.link/ma3v20" style="color: #fff;">
                                <div class="estate_page_button"
                                    style="width: 120px; height: 10px; font-size: 14px; background-color: #808080;">
                                    Get Help
                                </div>
                            </a>
                        </p>
                    </div>
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
            document.querySelector(".profile-container").style = `
         padding-left: 7em;
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
            document.querySelector(".profile-container").style = `
         padding-left: 1em;
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