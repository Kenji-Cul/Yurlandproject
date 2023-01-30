<?php 

include_once "projectlog.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        min-height: 100vh;
    }


    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
    }

    .account-detail2 {
        position: relative;
    }

    .account-detail2 .flex {
        position: absolute;
        left: 90px;
    }

    .account-detail3 {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 3em;
    }

    .forgot-text {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .account-detail3 p {
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 22px;
        text-align: center;
        color: #eb5757;
    }

    .error {
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Space Grotesk";
        font-style: normal;
        font-weight: 600;
        font-size: 18px;
        line-height: 31px;
        text-align: center;
        color: #e11900;
        border: 1px solid #e11900;
        width: 60%;
        padding: 10px 10px;
        background-color: #e1dede;
    }

    .error2 {
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Space Grotesk";
        font-style: normal;
        font-weight: 600;
        font-size: 18px;
        line-height: 31px;
        text-align: center;
        color: #000;
        width: 30%;
        padding: 10px 10px;
        background-color: #e1dede;
    }

    /* .success {
        width: 60%;
    } */


    /* .error {
        width: 60%;
    } */
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
        </div>

        <!-- <div class="nav">
            <img src="images/cart.svg" alt="cart icon" />
            <img src="images/menu.svg" alt="menu icon" />
        </div> -->
    </header>

    <div class="page-title2">
        <a href="index.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Contact Us</p>

    </div>

    <div class="forgot-text">

        <?php 
          if($_GET['error'] != ""){
          ?>
        <p class="error2" style="color: red;">
            <?php echo $_GET['error'];?>
        </p>
        <?php }?>

        <?php 
          if($_GET['success'] != ""){
          ?>
        <p class="error2" style="color: green;">
            <?php echo $_GET['success'];?>
        </p>
        <?php }?>



    </div>


    <section class="login-form-container">
        <form action="contactform.php" class="login-form" id="login-form" method="POST">
            <div class="input-div email">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" placeholder="Input your full name" name="fullname" value="" />
            </div>

            <div class="input-div email">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Input your email address" name="email" />
            </div>

            <div class="input-div email">
                <label for="phonenum">Phone Number</label>
                <input type="number" id="phonenum" placeholder="Input your phone number" name="phonenum" />
            </div>

            <div class="input-div name">
                <label for="textinput">Text Input</label>
                <textarea name="textinput" id="textinput" cols="30" rows="10"></textarea>
            </div>

            <div class="select-box">
                <div class="options-container">
                    <div class="option">
                        <input type="radio" class="radio" id="urgent" name="priority" value="Urgent" />
                        <label for="urgent">Urgent</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="veryurgent" name="priority" value="Very Urgent" />
                        <label for="veryurgent">Very Urgent</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="someurgent" name="priority" value="Somewhat Urgent" />
                        <label for="someurgent">Somewhat Urgent</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="enquiry" name="priority" value="Basic Enquiry" />
                        <label for="enquiry">Basic Enquiry</label>
                    </div>
                </div>
                <div class="selected">Choose Priority</div>
            </div>

            <input type="text" name="prior" id="prior" value="" style="visibility: hidden;">



            <button class="btn" type="submit" name="fgtpass">Send</button>
        </form>


    </section>



    <script src="js/main.js"></script>
    <script>
    let priority = document.getElementsByName("priority");
    let valuediv = document.getElementById("prior");
    priority.forEach((element) => {
        element.onclick = () => {
            valuediv.value = element.value;
        };
    });
    </script>

</body>

</html>