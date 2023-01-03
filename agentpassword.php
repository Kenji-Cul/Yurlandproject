<?php 

include_once "projectlog.php";
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
    body {
        min-height: 100vh;
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

    .forgot-text {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .account-detail3 p {
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 22px;
        text-align: center;
        color: #eb5757;
    }

    .error {
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Space Grotesk";
        font-style: normal;
        font-weight: 600;
        font-size: 18px;
        line-height: 31px;
        text-align: center;
        color: #e11900;
        border: 1px solid #e11900;
        width: 30%;
        padding: 10px 10px;
        background-color: #e1dede;
    }

    .error2 {
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Space Grotesk";
        font-style: normal;
        font-weight: 600;
        font-size: 18px;
        line-height: 31px;
        text-align: center;
        color: #000;
        width: 30%;
        padding: 10px 10px;
        background-color: #e1dede;
    }

    /* .success {
        width: 60%;
    } */


    /* .error {
        width: 60%;
    } */
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
        </div>

        <!-- <div class="nav">
            <img src="images/cart.svg" alt="cart icon" />
            <img src="images/menu.svg" alt="menu icon" />
        </div> -->
    </header>

    <div class="page-title2">
        <a href="portallogin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Forgot Password</p>
    </div>

    <div class="forgot-text">
        <p>Enter your account email address to receive</p>
        <p>your reset code</p>
        <?php if(isset($_GET['user'])){ ?><p class="error"><?php echo $_GET['user'];?></p><?php }?>
        <?php 
          if(isset($_GET['reset'])){
          ?>
        <p class="error2">
            Your Email has been sent
        </p>
        <?php }?>

    </div>


    <section class="login-form-container">
        <form action="resetagent.php" class="login-form" id="login-form" method="POST">
            <div class="input-div email">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Input your email address" name="email" />
            </div>

            <button class="btn" type="submit" name="fgtpass">Send Email</button>
        </form>


    </section>





</body>

</html>