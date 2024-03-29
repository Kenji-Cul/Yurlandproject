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
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        position: relative;
        height: 180vh;
        background-image: none;
    }

    header {
        background: #fee1e3;
    }

    .successmodal {
        /* display: flex; */
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 40%;
    }


    .footerdiv {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
    }

    .label {
        font-style: normal;
        font-weight: 600;
        font-size: 17px;
        line-height: 18px;
        padding-bottom: 10px;
        padding-left: 10px;
    }

    section .error {
        width: 60%;
    }

    .btn {
        background-color: #808080;
    }

    @media only screen and (min-width: 1300px) {
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


        .login-form-container {
            width: 90%;
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
            width: 85%;
            transition: all 0.5s;
            height: 50em;
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


    @media only screen and (max-width: 1300px) {

        .user,
        #openicon {
            display: none;
        }

        .links img {
            display: none;
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
    }
    </style>
</head>

<body>
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
                    <img src="images/openmenu.svg" />
                </li>

                <li id="closeicon" style="display: none; cursor: pointer; font-size:14px;">
                    <img src="images/openmenu.svg" />
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
                <a href="preference.php"><img src="images/land2.svg" /></a>
                <a href="preference.php" class="link">New Land</a>
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
                <a href="payment.php"><img src="images/chart2.svg" /> </a>
                <a href="payment.php" class="link">New Payment</a>
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
                <a href="profiledetails.php"><img src="images/settings.svg" /></a>
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


        <div class="profile-container">
            <!-- Landing Page Text -->
            <div class="page-title2">
                <a href="profiledetails.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Next Of Kin</p>
            </div>

            <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>
            <section class="login-form-container">
                <form action="" class="login-form" id="nextofkin-form">
                    <div class="input-div name">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" placeholder="Input first name" name="firstname" value="<?php if(isset($newuser['nextofkin_firstname'])){
                    echo $newuser['nextofkin_firstname'];
                }?>" />
                    </div>

                    <div class="input-div name">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" placeholder="Input last name" name="lastname" value="<?php if(isset($newuser['nextofkin_lastname'])){
                    echo $newuser['nextofkin_lastname'];
                }?>" />
                    </div>

                    <div class="input-div email">
                        <label for="email">Email Address</label>
                        <input type="text" id="email" placeholder="Input email address" name="email" value="<?php if(isset($newuser['nextofkin_email'])){
                    echo $newuser['nextofkin_email'];
                }?>" />
                    </div>

                    <div class="input-div email">
                        <label for="email">House Address</label>
                        <input type="text" id="email" placeholder="Input house address" name="houseaddress" value="<?php if(isset($newuser['nextofkin_address'])){
                    echo $newuser['nextofkin_address'];
                }?>" />
                    </div>

                    <div class="input-div name">
                        <label for="email">Phone Number</label>
                        <input type="number" placeholder="Input phone number" id="password" name="phonenum" value="<?php if(isset($newuser['nextofkin_phone'])){
                    echo $newuser['nextofkin_phone'];
                }?>" />
                    </div>

                    <p class="label">Relationship</p>
                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="siblings" name="relation" value="Sibling" />
                                <label for="siblings">Sibling</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="mothers" name="relation" value="Mother" />
                                <label for="mothers">Mother</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="fathers" name="relation" value="Father" />
                                <label for="fathers">Father</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="aunts" name="relation" value="Aunt" />
                                <label for="aunts">Aunt</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="uncles" name="relation" value="Uncle" />
                                <label for="uncles">Uncle</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="spouses" name="relation" value="Spouse" />
                                <label for="spouses">Spouse</label>
                            </div>
                        </div>
                        <div class="selected">Choose Below</div>
                    </div>

                    <div class="valuediv" style="display: none;"></div>


                    <p class="error">Please input all fields</p>

                    <button class="btn" type="submit">
                        <p>Save Changes</p>
                    </button>
                    <div style="display: none">
                        <img src="images/loading.svg" alt="" class="loading-img" />
                    </div>
                </form>
            </section>

        </div>
    </div>


    <div class="successmodal">
        <div class="modalcon">
            <div class="modaldiv">
                <div>
                    <img src="images/asset_success.svg" alt="" />
                    <p>Next Of Kin Details!</p>
                    <p>Updated Successfully</p>
                    <a href="profiledetails.php"><button class="landing_page_button2">Back to
                            Dashboard</button></a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footerdiv">
        <p>YurLAND &#169; 2022 | All Right Reserved</p>
        <p>A product of Ilu-oba International Limited and Arklips Limited</p>
        <p>Connect with us Facebook, Twitter, Instagram</p>
        <p style="font-size: 30px">
            <i class="ri-instagram-line"></i><i class="ri-facebook-fill"></i><i class="ri-twitter-line"></i>
        </p>
    </footer>

    <script src="js/main.js"></script>

    <script src="js/cart.js"></script>
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
    <script>
    const nextofkinform = document.querySelector("#nextofkin-form");
    let btn = document.querySelector(".btn");
    nextofkinform.onsubmit = (e) => {
        e.preventDefault();
        var loadingImg = document.querySelector(".loading-img");
        btn.querySelector("p").style.display = "none";
        btn.appendChild(loadingImg);
    };

    let valuediv = document.querySelector('.valuediv');

    let purpose = document.getElementsByName("relation");
    purpose.forEach((element) => {
        element.onclick = () => {
            valuediv.innerHTML = element.value;
        };
    });

    function insertNextOfKin() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", `insertnextofkin.php?relation=${valuediv.innerHTML}`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "success") {
                        document.querySelector('.successmodal').style.display = "flex";
                        document.querySelector('.modalcon').classList.add('animation');
                        document.querySelector(".btn").textContent = "Save Changes";
                    }

                    // else {
                    //     document.querySelector("section .error").style.visibility =
                    //         "visible";
                    //     document.querySelector("section .error").textContent = data;
                    //     document.querySelector(".btn").textContent = "Save Changes";
                    // }
                }
            }
        };
        // we have to send the information through ajax to php
        let formData = new FormData(nextofkinform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    btn.onclick = () => {
        insertNextOfKin();
    };
    </script>
</body>

</html>