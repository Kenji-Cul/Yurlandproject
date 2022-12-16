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
    }

    .success img {
        width: 15em;
        height: 15em;
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
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
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
                                      echo number_format(floor($unitprice));
                                    } else {
                                        echo $unitprice;
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
                `http://localhost/Yurland/referralsignup.php?ref=${copyText.value}&key=a&refkey=785e7&rex=l73`;
            navigator.clipboard.writeText(referralLink);
        }
        </script>
</body>

</html>