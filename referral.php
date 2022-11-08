<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['uniqueagent_id'])){
    header("Location:index.html");
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
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="index.html"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>

        <div class="nav">
            <img src="images/cart.svg" alt="cart icon" />
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

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

        <div>
            <img src="images/image2.svg" alt="payment image" />
            <div class="payment-desc2">
                <p>Referral Earnings</p>
                <div class="payment-count">&#8358;300,000</div>
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
            `http://localhost/Yurland/referralsignup.php?ref=${copyText.value}&key=ajfhagfag16253553&refkey=785e7156hfagf&rex=l737727277272277`;
        navigator.clipboard.writeText(referralLink);
    }
    </script>
</body>

</html>