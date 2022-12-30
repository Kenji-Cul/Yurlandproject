<?php 
session_start();
if(!isset($_SESSION['uniquesupadmin_id'])){
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
    <title>Yurland</title>
    <style>
    body {
        height: 150vh;
    }

    .page-title2 {
        padding-bottom: 0;
    }

    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
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

    <div class="page-title2">
        <a href="superadmin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
    </div>

    <!-- Landing Page Text -->
    <section class="landing_text_container">
        <p class="landing_text">Create</p>
        <p class="landing_text">New Executive</p>
    </section>

    <section class="login-form-container">
        <form action="" class="login-form" id="login-form">
            <div class="input-div name">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Input executive's full name" />
            </div>

            <div class="input-div name">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Input executive's email" />
            </div>

            <div class="input-div password">
                <label for="password">Password</label>
                <input type="password" placeholder="Input executive's password" id="password" name="password" />
                <i class="ri-eye-off-line"></i>
            </div>

            <div class="select-box">
                <div class="options-container">
                    <div class="option">
                        <input type="radio" class="radio" id="volunteer" name="role" value="Volunteers" />
                        <label for="volunteer">Volunteers</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="investors" name="role" value="Investors" />
                        <label for="investors">Investors</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="arklips" name="role" value="Arklips" />
                        <label for="arklips">Arklips</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="partners" name="role" value="Partners" />
                        <label for="partners">Partners</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="team" name="role" value="Team" />
                        <label for="team">Team</label>
                    </div>
                </div>
                <div class="selected">Select Role</div>
            </div>

            <div class="input-div name">
                <input type="hidden" name="rolediv" value="" id="rolediv" />
            </div>

            <div class="input-div email">
                <label for="percent">Earning Percentage</label>
                <input type="number" id="percent" name="percent" placeholder="Input executive's earning percentage" />
            </div>

            <p class="error">Please input all fields</p>
            <button class="btn" type="submit">Create Executive</button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

    <script src="js/main.js"></script>
    <script src="js/login.js"></script>
    <script>
    $(document).ready(function() {

        let roleInput = document.getElementById('rolediv')
        let role = document.getElementsByName("role");
        role.forEach((element) => {
            element.onclick = () => {
                rolediv.value = element.value;
            };
        });


        $("#login-form .btn").click(function() {
            $.ajax({
                type: "POST",
                url: "inserters/insertexecutive.php",
                data: $("#login-form input"),
                success: function(response) {
                    if (response === "success") {
                        location.href = "successpage/execsuccess.html";
                    } else {
                        $("section .error").html(response);
                        $("section .error").css({
                            visibility: "visible",
                        });
                        $(".btn").html("Create Executive");
                    }
                },
            });
        });

        $("#login-form").submit(function(e) {
            e.preventDefault();
            var loadingImg = $(".loading-img");
            $(".btn").html(loadingImg);
        });
    });
    </script>
</body>

</html>