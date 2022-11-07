<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['unique_id'])){
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
        height: 170vh;
        background-image: none;
    }

    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
    }

    .label {
        font-style: normal;
        font-weight: 600;
        font-size: 17px;
        line-height: 18px;
        padding-bottom: 10px;
        padding-left: 10px;
    }

    section .error {
        width: 60%;
    }

    .btn {
        background-color: #808080;
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
    <div class="page-title2">
        <a href="profiledetails.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Phone Number</p>
    </div>

    <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>
    <section class="login-form-container">
        <form action="" class="login-form" id="address-form">
            <div class="input-div number">
                <label for="number">Phone Number</label>
                <input type="number" id="number" placeholder="Input your phone number" name="number" value="<?php if(isset($newuser['phone_number'])){
                    echo $newuser['phone_number'];
                }?>" />
            </div>

            <p class="error">Please input all fields</p>

            <button class="btn" type="submit">Save Changes</button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

    <script>
    $(document).ready(function() {
        $("#address-form").submit(function(e) {
            e.preventDefault();
            var loadingImg = $(".loading-img");
            $(".btn").html(loadingImg);
        });

        $("#address-form .btn").click(function() {
            $.ajax({
                type: "POST",
                url: "inserters/updatenum.php",
                data: $("#address-form input"),
                success: function(response) {
                    if (response === "success") {
                        location.href = "successpage/numbersuccess.html";
                    } else {
                        $("section .error").html(response);
                        $("section .error").css({
                            visibility: "visible",
                        });
                        $(".btn").html("Save Changes");
                        // console.log(response);
                    }
                },
            });
        });
    });
    </script>
</body>

</html>