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
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    .profile-body {
        height: 100vh;
        position: relative;
    }

    .email-span {
        text-overflow: ellipsis !important;
        overflow: hidden;
        white-space: nowrap;
        display: inline-block;
        width: 170px;
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

    .search-input {
        display: none;
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




    .price-button {
        width: 300px;
        font-size: 15px;
    }


    .footerdiv {
        position: absolute;
        bottom: 0;
    }

    body {
        overflow-x: hidden;
    }

    .success img {
        width: 15em;
        height: 15em;
    }

    .dropdown-links {
        display: none;
    }

    .radius {
        position: relative;
    }

    .success {
        position: absolute;
        left: 50%;
        top: 45em;
        transform: translate(-50%, -50%);
        height: 10em;
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
        .profile-body {
            height: 40vh;
        }

        .code-container .flex0 {
            display: flex;
            flex-direction: column;
        }

        .price-button {
            width: 200px;
            font-size: 12px;
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
                        <div class="empty-img" style="border-radius: 50%;">
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
            <li class="links select-link">
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
        </ul>


        <div class="profile-container">
            <div class="page-title2">
                <a href="agentprofile.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>My Customers</p>

                <div class="search-icon">
                    <img src="images/search.svg" alt="search image" id="searchimg">

                    <div class="search-input">
                        <form action="" class="search-form">
                            <input type="text" class="search" type="search" name="searchproduct"
                                placeholder="Search For Customer">
                        </form>
                    </div>
                </div>



            </div>


            <div class="details-container">

                <?php 
    $user = new User;
    $agent = $user->selectAgent($_SESSION['uniqueagent_id']);
    $customer = $user ->selectAgentCustomer($agent['referral_id']);
    if(!empty($customer)){
        foreach($customer as $key => $value){
    ?>
                <div class="account-detail2">
                    <div class="radius">
                        <?php if(!empty($value['photo'])){?>
                        <img src="profileimage/<?php echo $value['photo'];?>" alt="profile image" />
                        <?php }?>
                        <?php if(empty($value['photo'])){?>
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                        <?php }?>
                    </div>
                    <div class="flex">
                        <p style="text-transform: capitalize;">
                            <span><?php echo $value['first_name'];?></span>&nbsp;<span><?php echo $value['last_name'];?></span>
                        </p>
                        <span class="email-span"><?php echo $value['email'];?></span>
                    </div>
                    <a href="customerinfo.php?unique=<?php echo $value['unique_id'];?>&real=91838JDFOJOEI939"
                        style="color: #808080;"><i class="ri-arrow-right-s-line"></i></a>
                </div>

                <?php }}?>

                <section>
                    <p class="error">Copied</p>
                </section>
                <div class="code-container">
                    <span>Referral code</span>
                    <div class="flex0">
                        <div class="colored-div">
                            <p><?php if(isset($newuser['referral_id'])){
                echo $newuser['referral_id'];
            }?> </p>
                            <input type="text" name="" class="copy-text" value="<?php if(isset($newuser['referral_id'])){
                echo $newuser['referral_id'];
             }?>" style="display: none;">
                            <img src="images/copy.svg" alt="" />
                        </div>
                        <div class="price-button copy-div">Share For Created Customer</div>
                    </div>
                </div>

                <?php if(empty($customer)){?>
                <div class="success">
                    <img src="images/asset_success.svg" alt="" />
                    <p>You have no customers yet!</p>
                </div>
                <?php }?>

                <div class="account-detail3">
                    <a href="agentlogout.php">
                        <p>Sign Out</p>
                    </a>
                </div>
            </div>
        </div>


    </div>




    <script src="js/main.js"></script>
    <script>
    let searchIcon = document.querySelector('.search-icon');
    searchIcon.onclick = () => {
        let searchinput = document.querySelector('.search-input');
        let searchinput2 = document.querySelector('.search');
        searchinput.style.display = "flex";
        document.querySelector('#searchimg').style.display = "none";

        let searchform = document.querySelector('.search-form');
        searchform.onsubmit = (e) => {
            e.preventDefault();
        }

        searchinput2.onkeyup = () => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchforcustomer.php?ref=<?php echo $agent['referral_id'];?>`);

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

        // $(document).ready(function() {
        //     $(".search-form").submit(function(e) {
        //         e.preventDefault();
        //     })


        //     $(".search-form input").keyup(function() {
        //         // console.log(("#searchform input").val())
        //         $.ajax({
        //             type: "POST",
        //             url: "searchforcustomer.php?ref=<?php echo $agent['referral_id'];?>",
        //             data: $(".search-form input"),
        //             success: function(response) {
        //                 console.log(response);
        //                 //$(".details-container").html(response);
        //                 console.log(response);
        //             }
        //         });
        //     })

        // });

    }


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
            `http://localhost/Yurland/referralsignup.php?ref=${copyText.value}&key=a&refkey=785e7&rex=l73`;
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