<?php 
session_start();
include "projectlog.php";
if(!isset($_SESSION['uniquesupadmin_id'])){
    header("Location: index.php");
}

if(!isset($_GET['unique'])){
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
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        height: 210vh;
        padding-bottom: 5em;
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
        <a href="createotherfiles.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <div style="display: flex !important; flex-direction: column !important">
            <p>Choose Plan Details</p>
        </div>
    </div>

    <?php 
$user = new User;
$rest = $user->selectPeriod();
?>
    <section class="login-form-container">
        <form action="" class="login-form" id="signup-form">
            <div class="input-div name">
                <input type="hidden" id="unique" value="<?php if(isset($_GET['unique'])){
                    echo $_GET['unique'];
                }?>" name="unique" />
            </div>

            <div class="input-div name">
                <label for="eighteen">Period For 18 months plan</label>
                <input type="text" id="eighteen" placeholder="Input number of days" name="eighteen"
                    value="<?php if(!empty($rest)) {echo $rest['eighteen_period'] ;}?>" />
                <label for="eighteenpercent">Percentage increase</label>
                <input type="text" id="eighteenpercent" placeholder="Input percentage number for eighteen months plan"
                    name="eighteenpercent" value="" />
            </div>

            <div class="input-div name">
                <label for="twelve">Period For 12 months plan</label>
                <input type="text" id="twelve" placeholder="Input number of days" name="twelve"
                    value="<?php if(!empty($rest)) {echo $rest['twelvemonth_period'] ;}?>" />
                <label for="twelvepercent">Percentage increase</label>
                <input type="text" id="twelvepercent" placeholder="Input percentage number for twelve months plan"
                    name="twelvepercent" value="" />
            </div>

            <div class="input-div name">
                <label for="six">Period For 6 months plan</label>
                <input type="text" id="six" placeholder="Input number of days" name="six"
                    value="<?php if(!empty($rest)) {echo $rest['sixmonth_period'] ;}?>" />
                <label for="sixpercent">Percentage increase</label>
                <input type="text" id="sixpercent" placeholder="Input percentage number for six months plan"
                    name="sixpercent" value="" />
            </div>

            <div class="input-div name">
                <label for="three">Period For 3 months plan</label>
                <input type="text" id="three" placeholder="Input number of days" name="three"
                    value="<?php if(!empty($rest)) {echo $rest['threemonth_period'] ;}?>" />
                <label for="threepercent">Percentage increase</label>
                <input type="text" id="threepercent" placeholder="Input percentage number for three months plan"
                    name="threepercent" value="" />
            </div>

            <div class="input-div name">
                <label for="one">Period For 1 month plan</label>
                <input type="text" id="one" placeholder="Input number of days" name="one"
                    value="<?php if(!empty($rest)) {echo $rest['onemonth_period'] ;}?>" />
                <label for="onepercent">Percentage increase</label>
                <input type="text" id="onepercent" placeholder="Input percentage number for one month plan"
                    name="onepercent" value="" />
            </div>




            <p class="error">Please input all fields</p>

            <button class="btn" type="submit">Update Plan</button>
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
                url: "inserters/insertperiod.php",
                data: $("#signup-form input"),
                success: function(response) {
                    if (response == "success") {
                        console.log("success")
                        location.href = "successpage/landsuccess.html";
                    } else {
                        $("section .error").html(response);
                        $("section .error").css({
                            visibility: "visible",
                        });
                        $(".btn").html("Update Period");
                        // console.log(response);
                    }
                },
            });
        });
    });
    </script>
</body>

</html>