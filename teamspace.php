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
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    .remember-div {
        display: flex !important;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .footerdiv {
        margin-top: 9em;
    }

    @media only screen and (max-width: 1300px) {
        .footerdiv {
            display: none;
        }
    }


    section .error {
        width: 60%;
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
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
        </div>
    </header>

    <!-- Landing Page Text -->
    <section class="landing_text_container">
        <p class="landing_text">Welcome To Login Portal</p>
    </section>

    <section class="login-form-container">
        <form action="" class="login-form" id="login-form">
            <div class="select-box">
                <div class="options-container">
                    <div class="option">
                        <input type="radio" class="radio" id="subadmin" name="userdata" value="subadmin" />
                        <label for="subadmin">Subadmin</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="superadmin" name="userdata" value="superadmin" />
                        <label for="superadmin">Superadmin</label>
                    </div>
                </div>
                <div class="selected">Choose User</div>
            </div>
            <div class="input-div name">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Input your email" value="" />
            </div>

            <div class="input-div password">
                <label for="password">Password</label>
                <input type="password" placeholder="Input your password" id="password" name="password" value="" />
                <i class="ri-eye-off-line"></i>
            </div>


            <button class="btn" type="submit">Login</button>
            <p class="error">Please input all fields</p>
            <div class="value" style="display: none;"></div>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

    <footer class="footerdiv">
        <p>YurLAND &#169; 2022 | All Right Reserved</p>
        <p>A product of Ilu-oba International Limited and Arklips Limited</p>
        <p>Connect with us Facebook, Twitter, Instagram</p>
        <p style="font-size: 30px;">
            <a href="https://instagram.com/yurlandng?igshid=NTdlMDg3MTY="><i class="ri-instagram-line"></a></i><a
                href="https://www.facebook.com/profile.php?id=100088254710492&mibextid=ZbWKwL"><i
                    class="ri-facebook-fill"></i></a><i class="ri-twitter-line"></i>
        </p>
    </footer>


    <script src="js/main.js"></script>
    <script>
    var passwordInput = document.querySelector("#password");
    var toggleBtn = document.querySelector(".password i");
    toggleBtn.onclick = () => {
        if (passwordInput.type == "password") {
            passwordInput.type = "text";
            toggleBtn.classList = "ri-eye-line";
        } else {
            passwordInput.type = "password";
            toggleBtn.classList = "ri-eye-off-line";
        }
    };
    let portalform = document.querySelector('.login-form');
    let portalbtn = document.querySelector('.login-form .btn');
    let valuediv = document.querySelector('.value');
    let error = document.querySelector(".error");
    portalform.onsubmit = (e) => {
        e.preventDefault();
    }

    let userdata = document.getElementsByName("userdata");
    userdata.forEach((element) => {
        element.onclick = () => {
            valuediv.innerHTML = element.value;
        };
    });

    function portalLogin() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", `inserters/checkportal.php?userdata=${valuediv.innerHTML}`);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "subadminsuccess") {
                        location.href = "subadmin.php";
                    } else if (data === "superadminsuccess") {
                        location.href = "superadmin.php";
                    } else {
                        error.textContent = data;
                        error.style.visibility = "visible";
                        //uploaddiv.style.display = "none";
                        setTimeout(() => {
                            error.style.visibility = "hidden";
                        }, 20000);
                    }
                }
            }
        };
        let formData = new FormData(portalform);
        xhr.send(formData);

    }

    portalbtn.onclick = () => {
        portalLogin();
    }
    </script>
</body>

</html>