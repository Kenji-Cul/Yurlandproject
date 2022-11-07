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
        <p>Next Of Kin</p>
    </div>

    <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>
    <section class="login-form-container">
        <form action="" class="login-form" id="nextofkin-form">
            <div class="input-div name">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" placeholder="Input first name" name="firstname" value="<?php if(isset($newuser['nextofkin_firstname'])){
                    echo $newuser['nextofkin_firstname'];
                }?>" />
            </div>

            <div class="input-div name">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" placeholder="Input last name" name="lastname" value="<?php if(isset($newuser['nextofkin_lastname'])){
                    echo $newuser['nextofkin_lastname'];
                }?>" />
            </div>

            <div class="input-div email">
                <label for="email">Email Address</label>
                <input type="text" id="email" placeholder="Input email address" name="email" value="<?php if(isset($newuser['nextofkin_email'])){
                    echo $newuser['nextofkin_email'];
                }?>" />
            </div>

            <div class="input-div email">
                <label for="email">House Address</label>
                <input type="text" id="email" placeholder="Input house address" name="houseaddress" value="<?php if(isset($newuser['nextofkin_address'])){
                    echo $newuser['nextofkin_address'];
                }?>" />
            </div>

            <div class="input-div name">
                <label for="email">Phone Number</label>
                <input type="number" placeholder="Input phone number" id="password" name="phonenum" value="<?php if(isset($newuser['nextofkin_phone'])){
                    echo $newuser['nextofkin_phone'];
                }?>" />
            </div>

            <p class="label">Relationship</p>
            <div class="select-box">
                <div class="options-container">
                    <div class="option">
                        <input type="radio" class="radio" id="siblings" name="relation" value="Sibling" />
                        <label for="siblings">Sibling</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="mothers" name="relation" value="Mother" />
                        <label for="mothers">Mother</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="fathers" name="relation" value="Father" />
                        <label for="fathers">Father</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="aunts" name="relation" value="Aunt" />
                        <label for="aunts">Aunt</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="uncles" name="relation" value="Uncle" />
                        <label for="uncles">Uncle</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="spouses" name="relation" value="Spouse" />
                        <label for="spouses">Spouse</label>
                    </div>
                </div>
                <div class="selected">Choose Below</div>
            </div>

            <p class="error">Please input all fields</p>

            <button class="btn" type="submit">
                <p>Save Changes</p>
            </button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

    <script src="js/main.js"></script>
    <script>
    const nextofkinform = document.querySelector("#nextofkin-form");
    let btn = document.querySelector(".btn");
    nextofkinform.onsubmit = (e) => {
        e.preventDefault();
        var loadingImg = document.querySelector(".loading-img");
        btn.querySelector("p").style.display = "none";
        btn.appendChild(loadingImg);
    };

    function insertNextOfKin() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "insertnextofkin.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "success") {
                        location.href = "nextofkinsuccess.html";
                    } else {
                        document.querySelector("section .error").style.visibility =
                            "visible";
                        document.querySelector(".btn").textContent = "Save Changes";
                    }
                }
            }
        };
        // we have to send the information through ajax to php
        let formData = new FormData(nextofkinform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    btn.onclick = () => {
        insertNextOfKin();
    };
    </script>
</body>

</html>