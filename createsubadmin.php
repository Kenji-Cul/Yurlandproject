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
            height: 160vh;
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
        <p class="landing_text">Sub Admin</p>
    </section>

    <section class="login-form-container">
        <form action="" class="login-form" id="subadmin-form">
            <div class="input-div name">
                <label for="name">Name</label>
                <input type="text" id="name" name="subadminname" placeholder="Input your full name" />
            </div>

            <div class="input-div name">
                <label for="email">Email</label>
                <input type="text" id="email" name="subadminemail" placeholder="Input your full email" />
            </div>

            <div class="input-div name">
                <label for="num">Phone Number</label>
                <input type="text" id="num" name="subadmin_number" placeholder="Input your phone number" />
            </div>

            <div class="input-div password">
                <label for="password">Password</label>
                <input type="password" placeholder="Input your password" name="password" id="password" />
                <i class="ri-eye-off-line"></i>
            </div>

            <p class="error">Please input all fields</p>
            <button class="btn" type="submit">Create SubAdmin</button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

    <script src="js/login.js"></script>
    <script>
        $(document).ready(function() {
            $("#subadmin-form").submit(function(e) {
                e.preventDefault();
                var loadingImg = $(".loading-img");
                $(".btn").html(loadingImg);
            });

            $("#subadmin-form .btn").click(function() {
                $.ajax({
                    type: "POST",
                    url: "inserters/insertsubadmin.php",
                    data: $("#subadmin-form input"),
                    success: function(response) {
                        if (response === "success") {
                            location.href = "successpage/subadminsuccess.html";
                        } else {
                            $("section .error").html(response);
                            $("section .error").css({
                                visibility: "visible",
                            });
                            $(".btn").html("Create SuperAdmin");
                            // console.log(response);
                        }
                    },
                });
            });
        });
    </script>
</body>

</html>