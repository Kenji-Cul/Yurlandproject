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
    .profile-body {
        width: 100%;
        height: 280vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .body-container {
        width: 95%;
        height: 250vh;
        display: flex;
        flex-direction: column;
        gap: 2em;
        align-items: center;
        justify-content: center;
        position: relative;
        padding-top: 20em !important;

    }

    .body-container .header {
        border: 2px solid black;
        width: 55%;
        height: 6em;
        border-radius: 20px;
        display: flex;
        align-items: center !important;
        justify-content: center !important;
        gap: 10em;
        position: relative;
        margin-top: -15em;
    }



    .body-container .header .btn {
        width: 180px;
        border-radius: 5px;
        text-transform: uppercase;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 2em;
    }

    .firstsec,
    .secondsec,
    .thirdsec,
    .fourthsec {
        display: flex;
        align-items: center !important;
        justify-content: center !important;
        flex-direction: column;
    }

    .secondsec p {
        font-size: 2em;
    }

    .thirdsec p {
        font-size: 1em;
    }

    .fourthsec img {
        width: 40em;
        height: 40em;
        object-fit: cover;
    }

    .firstsec p {
        font-size: 3em;
        color: #dd1320;
        text-transform: uppercase;
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
        width: 30%;
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

    @media only screen and (max-width: 1300px) {
        .body-container {
            padding-top: 10em !important;
            height: 220vh;
        }

        .body-container .header {
            width: 80%;
            gap: 4em;
            padding: 0 1em;
        }

        .body-container .header .btn {
            width: 250px;
            border-radius: 5px;
            text-transform: uppercase;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 2em;
            font-size: 15px;
        }

        .firstsec p {
            font-size: 2em;
            color: #dd1320;
            text-transform: uppercase;
        }

        .secondsec p {
            font-size: 1em;
        }

        .fourthsec img {
            width: 20em;
            height: 20em;
            object-fit: cover;
        }
    }

    @media only screen and (max-width: 700px) {


        .profile-body {
            padding-top: 5em !important;
            height: 200vh !important;
        }
    }
    </style>
</head>

<body class="profile-body">


    <div class="body-container">
        <div class="header">
            <img src="images/logo.svg" alt="">
            <button class="btn" type="submit" name="fgtpass">Join Our Waitlist</button>
        </div>

        <section class="firstsec">
            <p>It's your Land,</p>
            <p>Own It</p>
        </section>

        <section class="secondsec">
            <p>We are building yurLAND to help you own </p>
            <p>land at a very flexible and affordable rate.</p>
        </section>

        <section class="thirdsec">
            <p>Are you ready?</p>
            <p style="display: flex; align-items: center; justify-content: center;">Get early access now<i
                    class="ri-arrow-down-fill" style="font-size: 20px;"></i></p>
        </section>

        <section class="forgot-text">

            <?php 
  if(isset($_GET['error'])){
  ?>
            <p class="error2" style="color: red;">
                <?php echo $_GET['error'];?>
            </p>
            <?php }?>

            <?php 
  if(isset($_GET['success'])){
  ?>
            <p class="error2" style="color: green;">
                <?php echo $_GET['success'];?>
            </p>
            <?php }?>



        </section>


        <section class="login-form-container">
            <form action="waitlistform.php" class="login-form" id="login-form" method="POST">
                <div class="input-div email">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" placeholder="Input your full name" name="fullname" value="" />
                </div>

                <div class="input-div email">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Input your email address" name="email" />
                </div>

                <div class="input-div email">
                    <label for="phonenum">Referral Code - Optional</label>
                    <input type="text" id="phonenum" placeholder="Input your referral code" name="refcode" />
                </div>

                <button class="btn" type="submit" name="fgtpass">Join 100+ yurLANDERS on our waitlist</button>
            </form>


        </section>

        <section class="secondsec" style="margin-top: 7em;">
            <p>Have you been finding it hard to own land in </p>
            <p>Nigeria? A solution is coming!</p>
            <p>We want to take Land ownership in Nigeria to</p>
            <p>the easiest and most affordable it can get.</p>
        </section>

        <section class="fourthsec" style="margin-top: 7em;">
            <img src="waitlist.jpg" alt="">
            <p style="font-size: 30px; padding-top: 1em;">
                <a style="color: #000;" href="https://instagram.com/yurlandng?igshid=NTdlMDg3MTY="><i
                        class="ri-instagram-line"></i></a>
                <a style="color: #000;"
                    href="https://www.facebook.com/profile.php?id=100088254710492&mibextid=ZbWKwL"><i
                        class="ri-facebook-fill"></i></a>
                <a style="color: #000;" href="https://twitter.com/yurLANDng"><i class="ri-twitter-line"></i></a>
            </p>
        </section>

    </div>


</body>

</html>