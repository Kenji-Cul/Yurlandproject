<?php 
session_start();
include_once "projectlog.php";
if(isset($_SESSION['unique_id'])){
    header("Location: profile.php");
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
    .login-body {
        display: grid;
        grid-template-rows: repeat(4, 1fr);
        height: 116vh;
    }

    .remember-div {
        display: flex !important;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .remember a {
        color: #ff6600;
        text-decoration: underline;
    }

    .radio p {
        font-size: 17px;
        font-weight: 400;
    }

    @media only screen and (max-width: 1300px) {
        .footerdiv {
            display: none;
        }
    }
    </style>
</head>

<body class="login-body">
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
        </div>
    </header>

    <div>
        <!-- Landing Page Text -->
        <section class="landing_text_container">
            <p class="landing_text">Welcome Back!</p>
            <p class="landing_text">Login to your account</p>
            <p class="error">Please input all fields</p>
        </section>

        <section class="login-form-container">
            <form action="" class="login-form" id="login-form">
                <div class="input-div email">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Input your email address" name="email" value="<?php 
                 if(isset($_COOKIE['user_login'])){
                    echo $_COOKIE['user_login'];
                 }
                ?>" />
                </div>

                <div class="input-div password">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Input your password" id="password" name="password" value="<?php 
                 if(isset($_COOKIE['user_password'])){
                    echo $_COOKIE['user_password'];
                 }
                ?>" />
                    <i class="ri-eye-off-line"></i>
                </div>

                <div class="input-div remember-div">
                    <label class="radio" for="check">
                        <input type="checkbox" id="check" name="remember" <?php if(isset($_COOKIE['user_login'])){?>
                            checked <?php }?> />
                        <span class="check"></span>
                        <p>Remember me</p>
                    </label>
                    <div class="remember">
                        <a href="forgotpassword.php">Forgot Password?</a>
                    </div>
                </div>

                <button class="btn" type="submit">Login</button>
                <div style="display: none">
                    <img src="images/loading.svg" alt="" class="loading-img" />
                </div>
                <div class="login-link">
                    Don't have an account? <a href="signup.php">Sign&nbsp;up</a>
                </div>
            </form>
        </section>
    </div>

    <footer class="footerdiv">
        <p>YurLAND &#169; 2022 | All Right Reserved</p>
        <p>A product of Arklips Limited</p>
        <p>Connect with us Facebook, Twitter, Instagram</p>
        <p style="font-size: 30px;">
            <a href="https://instagram.com/yurlandng?igshid=NTdlMDg3MTY="><i class="ri-instagram-line"></a></i><a
                href="https://www.facebook.com/profile.php?id=100088254710492&mibextid=ZbWKwL"><i
                    class="ri-facebook-fill"></i></a><i class="ri-twitter-line"></i>
        </p>
    </footer>

    <script src="js/login.js"></script>
    <script>
    $(document).ready(function() {
        $("#login-form").submit(function(e) {
            e.preventDefault();
            var loadingImg = $(".loading-img");
            $(".btn").html(loadingImg);
        });

        $("#login-form .btn").click(function() {
            $.ajax({
                type: "POST",
                url: "checkuser.php",
                data: $("#login-form input"),
                success: function(response) {
                    if (response === "success") {
                        <?php if(isset($_GET['cost']) || isset($_GET['loc']) || isset($_GET['pose'])){?>
                        location.href =
                            `preference.php?cost=<?php echo $_GET['cost'];?>&loc=<?php echo $_GET['loc'];?>&pose=<?php echo $_GET['pose'];?>&hver=0838784920182800201oajfnfkfakjaifihfaiyeyywwmcmhshsj&name=0202002028484`;
                        <?php }else {?>
                        location.href = "profile.php";
                        <?php }?>
                    } else {
                        $("section .error").html(response);
                        $("section .error").css({
                            visibility: "visible",
                        });
                        $(".btn").html("Login");
                        // console.log(response);
                    }
                },
            });
        });
    });
    </script>
</body>

</html>