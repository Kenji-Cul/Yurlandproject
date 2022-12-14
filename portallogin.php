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


    .successmodal {
        /* display: flex; */
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 2em;
    }

    .remember a {
        color: #ff6600;
        text-decoration: underline;
    }

    .radio p {
        font-size: 17px;
        font-weight: 400;
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
    <section class="landing_text_container">
        <p class="landing_text">Welcome To Login Portal</p>
        <p class="error">Please input all fields</p>
    </section>

    <section class="login-form-container">
        <form action="" class="login-form" id="login-form">
            <div class="input-div name">
                <label for="email">Email</label>
                <input type="text" id="email" name="agentemail" placeholder="Input your email" value="<?php 
                 if(isset($_COOKIE['agent_login'])){
                    echo $_COOKIE['agent_login'];
                 }
                ?>" />
            </div>

            <div class="input-div password">
                <label for="password">Password</label>
                <input type="password" placeholder="Input your password" id="password" name="password" value="<?php 
                 if(isset($_COOKIE['agent_password'])){
                    echo $_COOKIE['agent_password'];
                 }
                ?>" />
                <i class="ri-eye-off-line"></i>
            </div>

            <div class="input-div remember-div">
                <label class="radio" for="check">
                    <input type="checkbox" id="check" name="remember" <?php if(isset($_COOKIE['agent_login'])){?>
                        checked <?php }?> />
                    <span class="check"></span>
                    <p>Remember me</p>
                </label>
                <div class="remember">
                    <a href="agentpassword.php">Forgot Password?</a>
                </div>
            </div>

            <button class="btn" type="submit">Login</button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

    <div class="successmodal">
        <div class="modalcon">
            <div class="modaldiv">
                <div>
                    <img src="images/asset_success.svg" alt="" />
                    <p>This Account</p>
                    <p>Has Been Disabled</p>
                </div>
            </div>
        </div>
    </div>

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
                url: "checkagent.php",
                data: $("#login-form input"),
                success: function(response) {
                    if (response === "success") {
                        location.href = "agentprofile.php";
                    } else if (response === "disabled") {
                        document.querySelector('.successmodal').style.display = "flex";
                        document.querySelector('.modalcon').classList.add('animation');
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