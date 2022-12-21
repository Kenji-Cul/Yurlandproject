<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['uniqueagent_id'])){
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        min-height: 100vh;

        overflow-x: hidden;
    }



    .success img {
        width: 15em;
        height: 15em;
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

    @media only screen and (max-width: 800px) {
        .success {
            position: absolute;
            left: 50%;
            top: 60em;
            transform: translate(-50%, -50%);
            height: 10em;
        }

        .success p {
            text-align: center;
        }


        .success img {
            width: 15em;
            height: 15em;
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
                <a href="mycustomers.php"><img src="images/referral.svg" /></a>
                <a href="mycustomers.php" class="link">Customers</a>
            </li>
            <li class="links">
                <a href="newcustomer.php"><img src="images/referral.svg" /> </a>
                <a href="newcustomer.php" class="link">New Customer</a>
            </li>
            <li class="links select-link">
                <a href="referral.php"><img src="images/chart2.svg" /></a>
                <a href="referral.php" class="link">Referrals</a>
            </li>

            <li class="links">
                <a href="agentprofileinfo.php"><img src="images/settings.svg" /></a>
                <a href="agentprofileinfo.php" class="link">Profile</a>
            </li>
            <li class="links">
                <a href="logout.php"><img src="images/exit.svg" /></a>
                <a href="logout.php" class="link">Logout</a>
            </li>
        </ul>





        <div class="profile-container">
            <div class="page-title2">
                <a href="agentprofile.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Referrals</p>
            </div>

            <?php 
             $user = new User;
             $newuser = $user->selectAgent($_SESSION['uniqueagent_id']);
            ?>

            <div class="payment-image-div2">
                <div>
                    <img src="images/image1.svg" alt="payment image" />
                    <div class="payment-desc">
                        <p>Users Referred</p>
                        <div class="price-div"><?php $newuser2 = $user->selectReferredUsers($newuser['referral_id']);
               foreach ($newuser2 as $key => $value) {
                echo $value;
               };
                ?></div>
                    </div>
                </div>

                <div>
                    <img src="images/image2.svg" alt="payment image" />
                    <div class="payment-desc">
                        <p>Paid Referral</p>
                        <div class="payment-count">15</div>
                    </div>
                </div>
                <?php 
    $user = new User;
    $agent = $user->selectAgent($_SESSION['uniqueagent_id']);
    $customer = $user ->selectAgentCustomer($agent['referral_id']);
    if(!empty($customer)){
       
       
         $percent = $agent['earning_percentage'] / 100;
         foreach($customer as $key => $value){
              $total = $user->selectTotal($value['unique_id']);
         foreach($total as $key => $value){
            $earnedprice = $percent * $value;
            $unitprice = $earnedprice; ?>
                <input type="text" name="price" style="display:none;" value="<?php 
        echo $unitprice;
        ?>">
                <?php
            
         }
        }} else {
            //echo "0";
        }
            ?>
                <div>
                    <img src="images/image2.svg" alt="payment image" />
                    <div class="payment-desc2">
                        <p>Referral Earnings</p>
                        <div class="payment-count">&#8358;
                            <span class="total"></span>
                        </div>
                    </div>
                </div>

                <div>
                    <img src="images/image1.svg" alt="payment image" />
                    <div class="payment-desc3">
                        <p>Referral Withdrawal</p>
                        <div class="payment-count">
                            <img class="desc-img" src="images/roundleft.svg" alt="" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="contain">
                <div class="line">
                    <hr />
                </div>
            </div>

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
                    <div class="price-button copy-div">Share</div>
                </div>
            </div>

            <div class="details-container">


                <?php 
    $user = new User;
    $agent = $user->selectAgent($_SESSION['uniqueagent_id']);
    $customer = $user ->selectAgentCustomer($agent['referral_id']);
    if(!empty($customer)){
        foreach($customer as $key => $value){
            $earning = $user->selectPayment($value['unique_id']);
            if(!empty($earning)){
                foreach($earning as $key => $value){
    ?>
                <div class="account-detail2"
                    style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
                    <div class="flex">
                        <p style="text-transform: capitalize;"><span>Hello <?php echo $agent['agent_name'];?></span></p>
                        <p style="text-transform: uppercase;">
                            <span style="color: #000000!important; font-size: 16px;">You have earned &#8358;<?php $percent = $agent['earning_percentage'];
                    $earnedprice = $percent / 100 * $value['product_price'];
                    $unitprice = $earnedprice;
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                                      echo number_format(round($unitprice));
                                    } else {
                                        echo round($unitprice);
                                    }
                    ?>
                            </span>
                        </p>
                    </div>
                </div>

                <?php }} }}?>

                <?php if(empty($customer)){?>
                <div class="success">
                    <img src="images/asset_success.svg" alt="" />
                    <p>You have no earnings yet!</p>
                </div>
                <?php }?>
            </div>
        </div>


        <script>
        let total = document.getElementsByName("price");
        let values = [];
        total.forEach(element => {

            values.push(parseInt(element.value));
        });

        let sum = 0;

        for (let i = 0; i < values.length; i++) {
            sum += values[i];
        }
        document.querySelector('.total').innerHTML = new Intl.NumberFormat().format(sum);




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