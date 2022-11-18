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
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>
    </header>

    <!-- Landing Page Text -->
    <div class="page-title2">
        <a href="subadmin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <div style="display: flex !important; flex-direction: column !important" class="estatetext">
            <p>Edit Gideon Teibo</p>
        </div>
    </div>

    <section class="login-form-container">
        <form action="" class="login-form" id="signup-form">
            <div class="input-div name">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" placeholder="Edit first name" name="firstname" />
            </div>

            <div class="input-div name">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" placeholder="Edit last name" name="lastname" />
            </div>

            <div class="input-div email">
                <label for="email">Email</label>
                <input type="text" id="email" placeholder="Edit email address" name="email" />
            </div>

            <div class="input-div number">
                <label for="number">Phone number</label>
                <input type="number" id="number" placeholder="Edit phone number" name="number" />
            </div>



            <p class="error">Please input all fields</p>

            <button class="btn" type="submit">Edit Customer</button>
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
            $("#referral").val(random_string);
        }

        $("#signup-form .btn").click(function() {
            createRandomString(8);
            $.ajax({
                type: "POST",
                url: "inserters/insertuser.php",
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