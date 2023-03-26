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
    .remember-div {
        display: flex !important;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .backtologin {
        margin-top: 2em;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 16px 16px;
        width: 370px;
        height: 44px;
        background: var(--primary-main);
        border-radius: 45px;
        border: none;
        color: #ffffff;
        font-size: 16px;
        cursor: pointer;
    }

    .remember a {
        color: #ff6600;
        text-decoration: underline;
    }

    .radio p {
        font-size: 17px;
        font-weight: 400;
    }

    .password i {
        font-size: 30px;
        position: absolute;
        right: 15px;
        top: 15px;
        color: #b2b2b2;
        cursor: pointer;
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
        width: 60% !important;
        padding: 10px 10px;
        background-color: #e1dede;
        visibility: hidden;
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
        width: 60% !important;
        padding: 10px 10px;
        background-color: #e1dede;
        display: none;
    }

    .password2 i {
        font-size: 30px;
        position: absolute;
        right: 15px;
        top: 15px;
        color: #b2b2b2;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
        </div>
    </header>

    <!-- Landing Page Text -->
    <div class="page-title2">
        <a href="subadminlogin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Reset Password</p>
    </div>



    <section class="login-form-container">

        <form action="" class="login-form" id="login-form">
            <p class="error2">Your password has been updated</p>
            <div class="input-div password">
                <input type="password" placeholder="Input your new password" id="password" name="password" />
                <i class="ri-eye-off-line"></i>
            </div>

            <div class="input-div password2">
                <input type="password" placeholder="Confirm your new password" id="password2" name="password2" />
                <i class="ri-eye-off-line"></i>
            </div>
            <div class="input-div">
                <input type="hidden" name="select" value="<?php if(isset($_GET['select'])){echo $_GET['select'];}?>">
            </div>


            <p class="error"></p>
            <button class="btn" type="submit">Submit</button>
            <button class="backtologin" style="display: none;"><a href="subadminlogin.php"
                    style="color: #fff!important;">Back
                    to
                    Login</a></button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

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
                url: "checksubpassword.php",
                data: $("#login-form input"),
                success: function(response) {
                    if (response === "success") {
                        $("section .error2").css({
                            display: "block",
                        });
                        $("section .error").css({
                            visibility: "hidden",
                        });
                        $(".btn").html("Submit");
                        $(".btn").css({
                            display: "none",
                        });
                        $(".backtologin").css({
                            display: "block",
                        });
                    } else {
                        $("section .error").html(response);
                        $("section .error").css({
                            visibility: "visible",
                        });
                        $(".btn").html("Submit");
                        // console.log(response);
                    }
                },
            });
        });
    });
    </script>
</body>

</html>