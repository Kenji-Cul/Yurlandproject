<?php 
session_start();
include "projectlog.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords"
        content="yurLAND,land estate website, Land in Nigeria,Land in Lagos,Nigerian Real estate,Own Your Land,Land,Real estate in Lagos, Buy land,Buy a land,Land for sale,own a land,Flexible payment land,Easy to own land,yurLAND,Real Estate,Proptech,Realtech,Properties in Alimosho,Real Estate in Alimosho,flexible land,Realtech in Lagos,Land in Alimosho">
    <meta name="description" content="yurLAND - Own ready to build lands in Nigeria, with as little as 650 naira only.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />
    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>

    <style>
    .body {
        height: 120vh;
    }

    .landing_form_container {
        height: 85vh;
        flex-direction: column;
        gap: 4em;
        position: relative;
    }

    .landing_form .landing_page_button {
        position: unset;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 10px 16px;
        width: 281px;
        height: 44px;
        background: var(--primary-main);
        border-radius: 45px;
        border: none;
        color: #ffffff;
        cursor: pointer;
    }

    .landing_form {
        width: 50%;
        height: 24em;
        margin-top: 2em;
        border-radius: 8px;
        background: linear-gradient(139.44deg, #fee1e3 -18.53%, rgba(254, 225, 227, 0) 99.11%);
        backdrop-filter: blur(37px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        gap: 0;
    }

    .landing_form .select-container {
        height: 60%;
    }

    .landing_form .form-flex {
        position: absolute;
        bottom: 1.5em;
    }

    @media only screen and (max-width: 300px) {
        .landing_form_container {
            width: 120%;
        }
    }


    @media only screen and (max-width: 1000px) {
        body {
            height: 200vh;
        }

        .landing_form {
            margin-top: 6em;
            height: 450px;
            width: 90%;
        }

        .landing_form_container {
            gap: 0;
        }

        .landing_form .form-flex {
            position: absolute;
            bottom: 2em;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .company {
            width: 80% !important;
        }

        .company-flex {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }


    }


    .company {
        width: 420px;
        height: 40px;
        background: rgba(174, 172, 172, 0.7);
        backdrop-filter: blur(2px);
        border-radius: 8px;
        padding: 10px;
        text-align: center;
        vertical-align: middle;
        position: unset;
    }

    .company span {
        color: var(--secondary-color);
    }

    body {
        background-image: url(images/landing_image.jpg);
        background-repeat: no-repeat;
        background-size: 100%;
        overflow-x: hidden;
    }

    .price {
        border: none;
        border-radius: 45px;
        padding: 8.45588px 13.5294px;
        width: 140px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background-color: var(--primary-main);
        cursor: pointer;
    }

    .price a {
        color: #fff;
    }
    </style>
</head>

<body class="body">

    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
        </div>

    </header>

    <!-- Landing Page Text -->

    <section class="landing_text_container">
        <p class="landing_text">
            Welcome, let's help you</p>
        <p class="landing_text">find <?php echo MY_APP_NAME;?></p>
    </section>

    <!-- Landing Form Container -->
    <?php 
    $user = new User;
    ?>
    <div class="value" style="visibility: hidden"></div>
    <div class="value2" style="visibility: hidden"></div>
    <div class="value3" style="visibility: hidden"></div>
    <section class="landing_form_container">
        <form action="" class="landing_form" id="landing-form">
            <div class="select-container">
                <div class="select-box">
                    <div class="options-container">
                        <div class="option">
                            <input type="radio" class="radio" id="budget1" name="budget" value="250,000 - 500,000" />
                            <label for="budget1">250,000 - 500,000</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="budget2" name="budget" value="500,000 - 1,500,000" />
                            <label for="budget2">500,000 - 1,500,000</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="budget3" name="budget"
                                value="1,500,000 - 3,000,000" />
                            <label for="budget3">1,500,000 - 3,000,000</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="budget4" name="budget"
                                value="3,000,000 - 5,000,000" />
                            <label for="budget4">3,000,000 - 5,000,000</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="budget5" name="budget" value="5,000,000 - Above" />
                            <label for="budget5">5,000,000 - Above</label>
                        </div>
                    </div>
                    <div class="selected">Budget</div>
                </div>

                <div class="select-box">
                    <div class="options-container">
                        <div class="option">
                            <input type="radio" class="radio" id="state" name="location" value="lagos" />
                            <label for="state">Lagos</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="state2" name="location" value="ogun" />
                            <label for="state2">Ogun</label>
                        </div>

                    </div>
                    <div class="selected">Estate Location</div>
                </div>

                <div class="select-box">
                    <div class="options-container">
                        <div class="option">
                            <input type="radio" class="radio" id="name" name="purpose" value="residential" />
                            <label for="name">Residential</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="use" name="purpose" value="commercial" />
                            <label for="use">Commercial</label>
                        </div>
                    </div>
                    <div class="selected">Purpose</div>
                </div>

            </div>

            <div class="form-flex">
                <button class="landing_page_button" type="submit">
                    Continue
                </button>

                <?php if(!isset($_SESSION['unique_id'])){?>
                <div class="login-link">Already have an account? <a href="login.php">Log&nbsp;in</a></div>
                <?php }?>
            </div>



        </form>


        <div class="company-flex">
            <div class="company">
                Developed by <span>Arklips Limited</span>
            </div>
        </div>
    </section>






</body>
<script src="js/main.js"></script>
<script>
let formbtn = document.querySelector('.landing_form .landing_page_button');
let form = document.querySelector('#landing-form');
let valuediv = document.querySelector(".value");
let valuediv2 = document.querySelector(".value2");
let valuediv3 = document.querySelector(".value3");

form.onsubmit = (e) => {
    e.preventDefault();
}


let price = document.getElementsByName("budget");
price.forEach((element) => {
    element.onclick = () => {
        valuediv.innerHTML = element.value;
    };
});

let locations = document.getElementsByName("location");
locations.forEach((element) => {
    element.onclick = () => {
        valuediv2.innerHTML = element.value;
    };
});

let purpose = document.getElementsByName("purpose");
purpose.forEach((element) => {
    element.onclick = () => {
        valuediv3.innerHTML = element.value;
    };
});


// function checkPriceMode() {
//     let xhr = new XMLHttpRequest(); //creating XML Object
//     xhr.onload = () => {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                  {;
//                 }

//             }
//         }
//     };
//     // we have to send the information through ajax to php
//     let formData = new FormData(form); //creating new formData Object

//     xhr.send(formData); //sending the form data to php
// }

formbtn.onclick = () => {
    if ((valuediv.innerHTML != "") || (valuediv2.innerHTML != "") || (valuediv3.innerHTML != "")) {
        <?php if(isset($_SESSION['unique_id'])){?>
        location.href =
            `preference.php?cost=${valuediv.innerHTML}&loc=${valuediv2.innerHTML}&pose=${valuediv3.innerHTML}&hver=0838784920182800201oajfnfkfakjaifihfaiyeyywwmcmhshsj&name=0202002028484`;
        <?php }else {?>
        location.href =
            `signup.php?cost=${valuediv.innerHTML}&loc=${valuediv2.innerHTML}&pose=${valuediv3.innerHTML}&hver=0838784920182800201oajfnfkfakjaifihfaiyeyywwmcmhshsj&name=0202002028484`;
        <?php }?>
    }
};
</script>

</html>