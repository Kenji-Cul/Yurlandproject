<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['unique_id'])){
    header("Location:index.php");
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
        position: relative;
        height: 100vh;
        background-image: none;
    }

    .footerdiv {
        position: absolute;
        bottom: 0;
        width: 100%;
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

    @media only screen and (max-width: 800px) {
        .footerdiv {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 80px;
        }
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
        <a href="profiledetails.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>House Address</p>
    </div>

    <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>
    <section class="login-form-container">
        <form action="" class="login-form" id="address-form">
            <div class="input-div email">
                <label for="address">House Address</label>
                <input type="text" id="address" placeholder="Input house address" name="houseaddress" value="<?php if(isset($newuser['home_address'])){
                    echo $newuser['home_address'];
                }?>" />
            </div>
            <p class="error">Please input all fields</p>

            <button class="btn" type="submit">Save Changes</button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

    <footer class="footerdiv">
        <p>YurLAND &#169; 2022 | All Right Reserved</p>
        <p>A product of Ilu-oba International Limited and Arklips Limited</p>
        <p>Connect with us Facebook, Twitter, Instagram</p>
        <p style="font-size: 30px">
            <i class="ri-instagram-line"></i><i class="ri-facebook-fill"></i><i class="ri-twitter-line"></i>
        </p>
    </footer>

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
                url: "inserters/insertaddress.php",
                data: $("#address-form input"),
                success: function(response) {
                    if (response === "success") {
                        location.href = "successpage/adsuccess.html";
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