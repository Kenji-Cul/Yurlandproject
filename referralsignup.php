<?php 
include_once "projectlog.php";
$ref = $_GET['ref'];
if(!isset($ref)){
  header("Location: index.php");
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
    body {
        height: 150vh;
    }

    section .error {
        width: 60%;
    }

    .successmodal {
        /* display: flex; */
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 20%;
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
        <p class="landing_text">Hello There,</p>
        <p class="landing_text">Let's setup your account.</p>
    </section>

    <section class="login-form-container">
        <form action="" class="login-form" id="signup-form">

            <div class="input-div password">
                <label for="email">Password</label>
                <input type="password" placeholder="Input your password" id="password" name="password" />
                <i class="ri-eye-off-line"></i>
            </div>

            <div class="input-div name">
                <label for="email">Email</label>
                <input type="email" id="email" name="useremail" placeholder="Input your email" />
            </div>



            <div class="input-div password">
                <label for="referral">Referral ID</label>
                <input type="text" placeholder="Input your referral ID" id="referral" name="referralID" value="<?php if(isset($ref)){
                    echo $ref;
                }?>" />
            </div>

            <p class="error">Please input all fields</p>

            <button class="btn" type="submit">Sign Up</button>
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
                    <p>Success!</p>
                    <p>You're all set!</p>
                    <a href="profile.php"><button class="landing_page_button2">Back to Dashboard</button></a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/login.js"></script>
    <script>
    $(document).ready(function() {
        $("#signup-form").submit(function(e) {
            e.preventDefault();
            var loadingImg = $(".loading-img");
            $(".btn").html(loadingImg);
        });



        $("#signup-form .btn").click(function() {

            $.ajax({
                type: "POST",
                url: `inserters/insertreferraluser.php?refuser=<?php if(isset($_GET['ref'])){
                    echo $_GET['ref'];
                }?>`,
                data: $("#signup-form input"),
                success: function(response) {
                    if (response === "success") {
                        document.querySelector('.successmodal').style.display =
                            "flex";
                        document.querySelector('.modalcon').classList.add('animation');
                        $(".btn").html("Sign Up");
                    } else {
                        $("section .error").html(response);
                        $("section .error").css({
                            visibility: "visible",
                        });
                        $(".btn").html("Sign Up");
                        // console.log(response);
                    }
                },
            });
        });
    });
    </script>
</body>

</html>