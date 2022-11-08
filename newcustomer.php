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
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        height: 150vh;
    }

    section .error {
        width: 60%;
    }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.html"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>
    </header>

    <!-- Landing Page Text -->
    <section class="landing_text_container">
        <p class="landing_text">Hello There,</p>
        <p class="landing_text">Let's setup your customer's account.</p>
    </section>

    <?php 
             $user = new User;
             $newuser = $user->selectAgent($_SESSION['uniqueagent_id']);
            ?>
    <section class="login-form-container">
        <form action="" class="login-form" id="signup-form">
            <div class="input-div name">
                <label for="referral">Customer's Referral Id</label>
                <input type="text" id="referral" placeholder="Input referral id" name="referral" value="<?php if(isset($newuser['referral_id'])){
                    echo $newuser['referral_id'];
                }?>" />
            </div>

            <div class="input-div name">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" placeholder="Input your first name" name="firstname" />
            </div>

            <div class="input-div name">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" placeholder="Input your last name" name="lastname" />
            </div>

            <div class="input-div number">
                <label for="number">Phone number</label>
                <input type="number" id="number" placeholder="Input your phone number" name="number" />
            </div>

            <div class="input-div email">
                <label for="email">Email</label>
                <input type="text" id="email" placeholder="Input customer's email address" name="email" />
            </div>


            <p class="error">Please input all fields</p>

            <button class="btn" type="submit">Create Customer</button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

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
                url: "inserters/insertreferral.php",
                data: $("#signup-form input"),
                success: function(response) {
                    if (response === "success") {
                        location.href = "successpage/referralsuccess.html";
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