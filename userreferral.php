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
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        min-height: 100vh;
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

    header {
        background: #fee1e3;
    }

    .success img {
        width: 15em;
        height: 15em;
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

        .ref-container {
            width: 90%;
            padding-left: 5em;
        }


        .close {
            display: none;
        }


    }



    @media only screen and (max-width: 700px) {
        .payment-image-div2 {
            display: grid;
            width: 100%;
            margin: 0 auto;
            align-items: center;
            justify-content: center;
        }

        .transaction-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
        }

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

        .detail3 {
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
            <li class="links select-link">
                <a href="userreferral.php"><img src="images/referral.svg" /></a>
                <a href="userreferral.php" class="link">Referral</a>
            </li>
            <li class="links">
                <a href="documents.php"><img src="images/folder.svg" /></a>
                <a href="documents.php" class="link">Documentation</a>
            </li>
            <li class="links">
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



        <div class="ref-container">
            <div class="page-title2">
                <a href="profile.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Referrals</p>
            </div>

            <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>

            <div class="payment-image-div2">
                <div>
                    <img src="images/image1.svg" alt="payment image" />
                    <div class="payment-desc">
                        <p>Users Referred</p>
                        <div class="price-div"><?php $newuser2 = $user->selectReferredCustomer($newuser['personal_ref']);
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
    $agent = $user->selectUser($_SESSION['unique_id']);
    $customer = $user ->selectAgentCustomer($agent['personal_ref']);
    if(!empty($customer)){
        foreach($customer as $key => $value){
         $total = $user->selectTotal($value['unique_id']);
         foreach($total as $key => $value){
            
            $percent = $agent['earning_percentage'];
             
            ?>

                <input type="text" name="price" style="display:none;" value="<?php 
                 if($percent != ""){
                    $earnedprice = $percent / 100 * $value;
                    $unitprice = $earnedprice;
        echo $unitprice;
    } else {
        echo "0";
    }
        ?>">
                <?php 
                       
         } 
        }} else {
            // echo "0";
        } 
            ?>
                <div>
                    <img src="images/image2.svg" alt="payment image" />
                    <div class="payment-desc2">
                        <p>Referral Earnings</p>
                        <div class="payment-count">&#8358; <span class="total"></span>
                        </div>
                    </div>
                </div>

                <div>
                    <img src="images/image1.svg" alt="payment image" />
                    <div class="payment-desc3">
                        <p style="font-size: 15px;">Referral Withdrawal</p>
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

            <section>
                <p class="error">Copied</p>
            </section>

            <div class="code-container">
                <span>Referral code</span>
                <div class="flex0">
                    <div class="colored-div">
                        <p><?php if(isset($newuser['personal_ref'])){
                echo $newuser['personal_ref'];
            }?> </p>
                        <input type="text" name="" class="copy-text" value="<?php if(isset($newuser['personal_ref'])){
                echo $newuser['personal_ref'];
             }?>" style="display: none;">
                        <img src="images/copy.svg" alt="" />
                    </div>
                    <div class="price-button copy-div">Share</div>
                </div>
            </div>

            <div class="details-container">


                <?php 
    $user = new User;
    $users = $user->selectUser($_SESSION['unique_id']);
    $customer = $user ->selectAgentCustomer($users['personal_ref']);
    if(!empty($customer)){
        foreach($customer as $key => $value){
            $earning = $user->selectPayment($value['unique_id']);
            if(!empty($earning)){
                foreach($earning as $key => $value){
                    
    ?>
                <?php 
                 if($users['user_date'] <= $value['payment_date']){
                if($users['earning_percentage'] != ""){?>
                <div class="account-detail2"
                    style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
                    <div class="flex">
                        <p style="text-transform: capitalize;"><span>Hello <?php echo $users['first_name'];?></span></p>
                        <p style="text-transform: uppercase;">
                            <span style="color: #000000!important; font-size: 16px;">You have earned &#8358;<?php $percent = $users['earning_percentage'];
                           
                    if($percent != ""){
                    $earnedprice = $percent / 100 * $value['product_price'];
                    $unitprice = $earnedprice;
            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                              echo number_format(round($unitprice));
                            } else {
                                echo round($unitprice);
                            } }else {
                                echo "0";
                            }
                        
                    ?>
                            </span>
                        </p>
                    </div>
                </div>

                <?php }}} }}}?>

                <?php if(empty($customer) || $users['earning_percentage'] == ""){?>
                <div class="success">
                    <img src="images/asset_success.svg" alt="" />
                    <p>You have no earnings yet!</p>
                </div>
            </div>
        </div>
        <?php }?>


        <script src="js/cart.js"></script>
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
                document.querySelector(".ref-container").style = `
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
                document.querySelector(".ref-container").style = `
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