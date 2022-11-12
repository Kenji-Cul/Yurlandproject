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
        height: 70vh !important;
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
                <i class="ri-arrow-right-s-line"></i>
            </div>
        </a>





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