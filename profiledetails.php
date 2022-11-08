<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['unique_id'])){
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
        <a href="profile.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Account Details</p>
    </div>

    <section>
        <p class="error">Copied</p>
    </section>


    <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
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
        if($newuser['referral_id'] !== ""){ ?>
        <p class="referral colored-div">
            <?php   $seconduser = $user->selectReferralUser($newuser['referral_id']);
               $thirduser = $user->selectReferralAgent($newuser['referral_id']);
            
            ?>
            <span>Referral:</span>&nbsp;<span><?php if(isset($seconduser['first_name'])){
             echo $seconduser['first_name'];
            }?></span>&nbsp;<span><?php if(isset($seconduser['last_name'])){
                echo $seconduser['last_name'];
            }?></span>
            <span><?php if(isset($thirduser['agent_name'])){
             echo $thirduser['agent_name'];
            }?></span>
        </p>
        <?php }?>
        <div class="referral">
            <div class="copy-div"><span>copy</span><img src="images/copy.svg" alt="" /></div>
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
                <i class="ri-arrow-right-s-line"></i>
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
                <i class="ri-arrow-right-s-line"></i>
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
                <i class="ri-arrow-right-s-line"></i>
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
                <i class="ri-arrow-right-s-line"></i>
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
                <i class="ri-arrow-right-s-line"></i>
            </div>
        </a>

        <div class="account-detail2">
            <button class="btn">Request Change Of Ownership</button>
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
            `http://localhost/Yurland/customerreferral.php?ref=${copyText.value}&key=ajfhagfag16253553&refkey=785e7156hfagf&rex=l737727277272277`;
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
    </script>

</body>

</html>