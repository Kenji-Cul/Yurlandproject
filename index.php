<?php 
include "projectlog.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />
    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>

    <style>
    .body {
        background-image: url(images/landing_image.jpg);
        background-repeat: no-repeat;
        background-size: 100%;
        overflow-x: hidden;
        height: 120vh;
    }
    </style>
</head>

<body class="body">

    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>
    </header>

    <!-- Landing Page Text -->

    <section class="landing_text_container">
        <p class="landing_text">
            Welcome, let's help you</p>
        <p class="landing_text">find yurland</p>
    </section>

    <!-- Landing Form Container -->
    <?php 
    $user = new User;
    $lowest = $user->selectLowestPrice(); 
    $highest = $user->selectHighestPrice(); 
    $random = $user->selectMinOneMonthPrice(); 
    $random2 = $user->selectSixMonthPrice(); 
    $random3 = $user->selectOneMonthPrice(); 
    $random4 = $user->selectMinPrice(); ?>
    <div class="value" style="visibility: hidden"></div>
    <div class="value2" style="visibility: hidden"></div>
    <div class="value3" style="visibility: hidden"></div>
    <section class="landing_form_container">
        <form action="" class="landing_form" id="landing-form">
            <div class="select-container">
                <div class="select-box">
                    <div class="options-container">
                        <div class="option">
                            <input type="radio" class="radio" id="priceone" name="price" value="<?php 
                              if(!empty($lowest)){
                                foreach ($lowest as $key => $value) {
                                        echo $value;
                                   };
                              }
                            ?>" />
                            <label for="priceone">&#8358;<?php 
                              if(!empty($lowest)){
                                foreach ($lowest as $key => $value) {
                                     if($value > 999 || $value > 9999 || $value > 99999 || $value > 999999){
                                        echo number_format($value);
                                      }
                                   };
                              }
                            ?></label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="pricetwo" name="price" value="<?php 
                              if(!empty($random)){
                                foreach ($random as  $value) {
                                     if($value > 999 || $value > 9999 || $value > 99999 || $value > 999999){
                                        echo $value;
                                      }
                                   };
                              }
                            ?>" />
                            <label for="pricetwo">&#8358;<?php 
                              if(!empty($random)){
                                foreach ($random as  $value) {
                                     if($value > 999 || $value > 9999 || $value > 99999 || $value > 999999){
                                        echo number_format($value);
                                      }
                                   };
                              }
                            ?></label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="pricethree" name="price" value="<?php 
                              if(!empty($random2)){
                                foreach ($random2 as $key => $value) {
                                     if($value > 999 || $value > 9999 || $value > 99999 || $value > 999999){
                                        echo $value;
                                      }
                                   };
                              }
                            ?>" />
                            <label for="pricethree">&#8358;<?php 
                              if(!empty($random2)){
                                foreach ($random2 as $key => $value) {
                                     if($value > 999 || $value > 9999 || $value > 99999 || $value > 999999){
                                        echo number_format($value);
                                      }
                                   };
                              }
                            ?></label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="art" name="price" value="<?php 
                              if(!empty($random3)){
                                foreach ($random3 as $key => $value) {
                                     if($value > 999 || $value > 9999 || $value > 99999 || $value > 999999){
                                        echo $value;
                                      }
                                   };
                              }
                            ?>" />
                            <label for="pricefour">&#8358;<?php 
                              if(!empty($random3)){
                                foreach ($random3 as $key => $value) {
                                     if($value > 999 || $value > 9999 || $value > 99999 || $value > 999999){
                                        echo number_format($value);
                                      }
                                   };
                              }
                            ?></label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="art" name="price" value="<?php 
                              if(!empty($random4)){
                                foreach ($random4 as $key => $value) {
                                     if($value > 999 || $value > 9999 || $value > 99999 || $value > 999999){
                                        echo $value;
                                      }
                                   };
                              }
                            ?>" />
                            <label for="pricefour">&#8358;<?php 
                              if(!empty($random4)){
                                foreach ($random4 as $key => $value) {
                                     if($value > 999 || $value > 9999 || $value > 99999 || $value > 999999){
                                        echo number_format($value);
                                      }
                                   };
                              }
                            ?></label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="pricefive" name="price" value="<?php 
                              if(!empty($highest)){
                                foreach ($highest as $key => $value) {
                                        echo $value;
                                   };
                              }
                            ?>" />
                            <label for="pricefive">&#8358;<?php 
                              if(!empty($highest)){
                                foreach ($highest as $key => $value) {
                                     if($value > 999 || $value > 9999 || $value > 99999 || $value > 999999){
                                        echo number_format($value);
                                      }
                                   };
                              }
                            ?></label>
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

                <button class="landing_page_button" type="submit">
                    Continue
                </button>


                <div class="login-link">Already have an account? <a href="login.html">Log&nbsp;in</a></div>
            </div>

            <div class="company">
                A Product of <span>Ilu-Oba Int.Ltd</span> in partnership with <span>Arklips</span>
            </div>
        </form>

    </section>

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


    let price = document.getElementsByName("price");
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
            location.href =
                `preference.php?cost=${valuediv.innerHTML}&loc=${valuediv2.innerHTML}&pose=${valuediv3.innerHTML}&hver=0838784920182800201oajfnfkfakjaifihfaiyeyywwmcmhshsj&name=0202002028484`;
        }
    };
    </script>
</body>

</html>