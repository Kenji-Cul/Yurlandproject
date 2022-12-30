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
    <title>Yurland</title>
    <style>
    section .error {
        width: 60%;
    }

    .successmodal {
        /* display: flex; */
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 40%;
    }


    body {
        position: relative;
        height: 180vh;
    }

    .footerdiv {
        position: absolute;
        bottom: 0;
        width: 100%;
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
        <p class="landing_text">We have what you want,</p>
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

            <div class="input-div email">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Input your email address" name="email" />
            </div>

            <div class="input-div number">
                <label for="number">Phone number</label>
                <input type="number" id="number" placeholder="Input your phone number" name="number" />
            </div>

            <div class="input-div name">
                <label for="inforeferral">Referral - Optional</label>
                <input type="text" id="inforeferral" placeholder="Input referral code" name="inforeferral" value="<?php if(isset($_GET['ref'])){
                    echo $_GET['ref'];
                }
                ?>" />
            </div>

            <div class="input-div email">
                <!-- <label for="referral">Referral</label> -->
                <input type="hidden" id="referral" placeholder="Input referral id" val="" name="referral" />
            </div>

            <div class="input-div password">
                <label for="email">Password</label>
                <input type="password" placeholder="Input your password" id="password" name="password" />
                <i class="ri-eye-off-line"></i>
            </div>

            <p class="error">Please input all fields</p>

            <button class="btn" type="submit">Sign Up</button>
            <div class="login-link">
                <?php if(isset($_GET['cost']) || isset($_GET['loc']) || isset($_GET['pose'])){?>
                Already have an account? <a
                    href="login.php?cost=<?php echo $_GET['cost'];?>&loc=<?php echo $_GET['loc'];?>&pose=<?php echo $_GET['pose'];?>&hver=0838784920182800201oajfnfkfakjaifihfaiyeyywwmcmhshsj&name=0202002028484">Log&nbsp;in</a>
                <?php } else {?>
                Already have an account? <a href="login.php">Log&nbsp;in</a>
                <?php }?>
            </div>
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

        function createRandomString(string_length) {
            var random_string = "";
            var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789012345678910";
            for (var i, i = 0; i < string_length; i++) {
                random_string += characters.charAt(
                    Math.floor(Math.random() * characters.length)
                );
            }
            $("#referral").val(random_string);
        }




        $("#signup-form .btn").click(function() {
            createRandomString(8);
            $.ajax({
                type: "POST",
                url: `inserters/insertuser.php?refuser=<?php if(isset($_GET['ref'])){
                    echo $_GET['ref'];
                }?>`,
                data: $("#signup-form input"),
                success: function(response) {
                    if (response === "success") {
                        <?php if(isset($_GET['cost']) || isset($_GET['loc']) || isset($_GET['pose'])){?>
                        location.href =
                            `preference.php?cost=<?php echo $_GET['cost'];?>&loc=<?php echo $_GET['loc'];?>&pose=<?php echo $_GET['pose'];?>&hver=0838784920182800201oajfnfkfakjaifihfaiyeyywwmcmhshsj&name=0202002028484`;
                        <?php }else {?>
                        document.querySelector('.successmodal').style.display =
                            "flex";
                        document.querySelector('.modalcon').classList.add('animation');
                        $(".btn").html("Sign Up");
                        <?php }?>
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