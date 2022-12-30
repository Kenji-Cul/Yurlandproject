<?php 
session_start();
if(!isset($_SESSION['uniquesupadmin_id'])){
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
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        background-image: none;
    }

    .remember-div {
        display: flex !important;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .remember a {
        color: #ff6600;
        text-decoration: underline;
    }

    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
    }

    .radio p {
        font-size: 17px;
        font-weight: 400;
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
        <a href="superadmin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <div style="display: flex !important; flex-direction: column !important">
            <p>Select Features</p>
        </div>
    </div>

    <section class="login-form-container">
        <form action="" class="login-form" id="mode-form">
            <div class="select-box">
                <div class="options-container">
                    <div class="option">
                        <input type="radio" class="radio" id="outprice" name="mode" value="OutPrice" />
                        <label for="outprice">Outright Price</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="sub" name="mode" value="sub" />
                        <label for="sub">Subscription</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="outsub" name="mode" value="outsub" />
                        <label for="outsub">Outright Price and Subscription</label>
                    </div>
                </div>
                <div class="selected">Select Price Mode</div>
            </div>

            <div class="select-box">
                <div class="options-container">
                    <div class="option">
                        <input type="radio" class="radio" id="residential" name="purpose" value="residential" />
                        <label for="residential">Residential</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="commercial" name="purpose" value="commercial" />
                        <label for="commercial">Commercial</label>
                    </div>
                </div>
                <div class="selected">Select Purpose</div>
            </div>

            <div class="value" style="visibility: hidden"></div>

            <button class="btn" type="submit">Save Features</button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

    <script src="js/main.js"></script>
    <script>
    const modeform = document.querySelector("#mode-form");
    const checkbtn = document.querySelector("#mode-form .btn");
    let valuediv = document.querySelector(".value");
    modeform.onsubmit = (e) => {
        e.preventDefault();
    };

    let purpose = document.getElementsByName("purpose");
    purpose.forEach((element) => {
        element.onclick = () => {
            valuediv.innerHTML = element.value;
        };
    });

    function checkPriceMode() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "checkpricemode.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data && valuediv.innerHTML != "") {
                        location.href =
                            `createproduct.php?mode=${data}&pose=${valuediv.innerHTML}&key=iuyrauiryuigdiugd7125653425&mod=8272635352525hhf&mde=992928hfhfejj&price=ueuttr2654325343`;
                    }
                }
            }
        };
        // we have to send the information through ajax to php
        let formData = new FormData(modeform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    checkbtn.onclick = () => {
        checkPriceMode();
    };
    </script>
</body>

</html>