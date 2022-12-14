<?php 
include_once "projectlog.php";
$ref = $_GET['ref'];
if(!isset($ref) || ($ref < 8)){
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
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>
    </header>

    <!-- Landing Page Text -->
    <section class="landing_text_container">
        <p class="landing_text">Hello There,</p>
        <p class="landing_text">Let's setup your account.</p>
    </section>

    <section class="login-form-container">
        <form action="" class="login-form" id="signup-form">
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

            <div class="input-div password">
                <label for="email">Password</label>
                <input type="password" placeholder="Input your password" id="password" name="password" />
                <i class="ri-eye-off-line"></i>
            </div>

            <div class="input-div name">
                <label for="email">Email</label>
                <input type="email" id="email" name="useremail" placeholder="Input your email" />
            </div>

            <div class="input-div email">
                <!-- <label for="referralcustomer">Referral</label> -->
                <input type="hidden" id="referralcustomer" placeholder="Input referral id" val="" name="referral" />
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

    <script src="js/login.js"></script>
    <script>
    $(document).ready(function() {
        $("#signup-form").submit(function(e) {
            e.preventDefault();
            var loadingImg = $(".loading-img");
            $(".btn").html(loadingImg);
        });

        function createRandomString(string_length) {
            var random_string = "";
            var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789012345678910";
            for (var i, i = 0; i < string_length; i++) {
                random_string += characters.charAt(
                    Math.floor(Math.random() * characters.length)
                );
            }
            $("#referralcustomer").val(random_string);
        }


        $("#signup-form .btn").click(function() {
            createRandomString(8);
            $.ajax({
                type: "POST",
                url: "inserters/insertcustomerreferral.php",
                data: $("#signup-form input"),
                success: function(response) {
                    if (response === "success") {
                        location.href = "successpage/usersuccess.html";
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