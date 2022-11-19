<?php 
session_start();
include "projectlog.php";
if(!isset($_GET['unique'])){
  header("Location: agentprofile.php");
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
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>
    </header>

    <?php 
             $user = new User;
             $newuser = $user->selectUser($_GET['unique']);
            ?>

    <!-- Landing Page Text -->
    <div class="page-title2">
        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <a href="superadmin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <a href="subadmin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <?php }?>
        <div style="display: flex !important; flex-direction: column !important" class="estatetext">
            <p>Edit
                <span><?php if(isset($newuser['first_name'])){echo $newuser['first_name'];}?></span>&nbsp;<span><?php if(isset($newuser['last_name'])){echo $newuser['last_name'];}?></span>
            </p>
        </div>
    </div>

    <section class="login-form-container">
        <form action="" class="login-form" id="signup-form">
            <div class="input-div name">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" placeholder="Edit first name" name="firstname"
                    value="<?php if(isset($newuser['first_name'])){echo $newuser['first_name'];}?>" />
            </div>

            <div class="input-div name">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" placeholder="Edit last name" name="lastname"
                    value="<?php if(isset($newuser['first_name'])){echo $newuser['last_name'];}?>" />
            </div>

            <div class="input-div email">
                <label for="email">Email</label>
                <input type="text" id="email" placeholder="Edit email address" name="email"
                    value="<?php if(isset($newuser['email'])){echo $newuser['email'];}?>" />
            </div>

            <div class="input-div number">
                <label for="number">Phone number</label>
                <input type="number" id="number" placeholder="Edit phone number" name="number"
                    value="<?php if(isset($newuser['phone_number'])){echo $newuser['phone_number'];}?>" />
            </div>


            <div class="input-div number">
                <label for="earning">Earning Percentage</label>
                <input type="number" id="earning" placeholder="Enter earning percentage" name="earning"
                    value="<?php if(isset($newuser['earning_percentage'])){echo $newuser['earning_percentage'];}?>" />
            </div>


            <div class="input-div email">
                <input type="hidden" name="uniqueuser" value="<?php if(isset($_GET['unique'])){
                    echo $_GET['unique'];
                }?>">
            </div>





            <p class="error">Please input all fields</p>

            <button class="btn" type="submit">Edit Customer</button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>


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
                url: "inserters/edituser.php",
                data: $("#signup-form input"),
                success: function(response) {
                    if (response === "success") {
                        location.href = "successpage/editsuccess.php";
                    } else {
                        $("section .error").html(response);
                        $("section .error").css({
                            visibility: "visible",
                        });
                        $(".btn").html("Edit Customer");
                        // console.log(response);
                    }
                },
            });
        });
    });
    </script>
</body>

</html>