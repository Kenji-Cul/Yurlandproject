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
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    .body {
        height: 320vh;
        overflow-x: hidden;
    }

    @media only screen and (max-width: 1000px) {
        .body {
            height: 340vh;
        }
    }

    .successmodal {
        /* display: flex; */
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 110em;
    }

    @media only screen and (min-width: 1300px) {
        .menu {
            display: none;
        }



        .center {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .page-title2 {
            justify-content: left;
            gap: 1em;
        }

        .page-title2 a {
            position: unset;
        }

        .page-title2 p {
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            color: #1A0709;
        }

        .dropdown-links {
            width: 6%;
            height: 90vh;
            border-radius: 0px !important;
            padding: 1em 0;
            display: flex;
            flex-direction: column;
            justify-content: top;
            align-items: top;
            gap: 1.3em;
            background: #7e252b;
            filter: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999999 !important;
            transition: all 0.7s;
        }

        .dropdown-links li {
            height: 1em;
            width: 95%;
            text-transform: capitalize;
            font-size: 14px;
        }

        .dropdown-links .select-link {
            background-color: #1a0709;
        }

        .dropdown-links .links {
            width: 100%;
        }

        .dropdown-links .links img {
            width: 20px;
            height: 20px;
            margin-right: 6px;
            cursor: pointer;
        }

        .dropdown-links .links {
            width: 100%;
            display: flex !important;
            align-items: center;
            justify-content: center;
            padding: 1em 0;
            transition: 1s;
        }

        .dropdown-links .links:hover {
            background-color: #1a0709;
        }

        .dropdown-links .links .link {
            visibility: hidden;
            display: none;
        }


        .dropdown-links li a {
            color: #fff;

        }

        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
        }

        .estates {
            padding-top: 6em;
            position: absolute;
            right: 0;
            width: 20%;
            background: #fee1e3;
            min-height: 150vh;
        }

        .profile-container {
            position: absolute;
            left: 5em;
            padding: 0;
            width: 93%;
            transition: all 0.5s;
        }

        .close {
            display: none;
        }

        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
        }


        .land_estate_container {
            display: flex;
            flex-direction: column;
            gap: 1em;
        }
    }

    @media only screen and (max-width: 1300px) {
        .details .pname {
            font-size: 13px;
        }




        .profile-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }



        .detail3 {
            display: none;
        }


        .user,
        #openicon {
            display: none;
        }

        .links img {
            display: none;
        }

        .dropdown-links {
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
            background: #7e252b;
            transform: translateX(100%);
            transition: all 1s;
            width: 40%;
            position: fixed;
            bottom: 0;
            border-radius: 8px 0px 0px 8px;
        }

        .dropdown-links li {
            height: 1em;
            grid-gap: 0;
        }


    }



    section .error {
        width: 60%;
    }

    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
        width: 80%;
    }
    </style>
</head>

<body class="body">
    <!-- Header -->
    <header class="signup">
        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>

        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
            <a href="subadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>

        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />
        </div>

    </header>

    <?php 
             $user = new User;
             $newuser = $user->selectUser($_GET['unique']);
            ?>

    <div class="flex-container">
        <ul class="dropdown-links">
            <div class="center">
                <li id="openicon" style="cursor: pointer;">
                    <img src="images/home.svg" style="width: 20px; height: 20px;" />
                </li>

                <li id="closeicon" style="display: none; cursor: pointer; font-size:14px;">
                    <img src="images/home.svg" style="width: 20px; height: 20px;" />
                </li>
            </div>
            <li class="close">
                <img src="images/close2.svg" style="width: 30px; height: 30px; position: absolute; right: 2em;" />
            </li>
            <li class="links select-link">
                <a href="subadmin.php"><img src="images/home3.svg" /></a>
                <a href="subadmin.php" class="link">Home</a>
            </li>
            <li class="links">
                <a href="allcustomers.php"><img src="images/referral.svg" /></a>
                <a href="allcustomers.php" class="link">All Customers</a>
            </li>
            <li class="links">
                <a href="createagent.php"><img src="images/referral.svg" /> </a>
                <a href="createagent.php" class="link">Create Agent</a>
            </li>

            <li class="links">
                <a href="subadmininfo.php"><img src="images/settings.svg" /></a>
                <a href="subadmininfo.php" class="link">Profile</a>
            </li>
            <li class="links">
                <a href="logout.php"><img src="images/exit.svg" /></a>
                <a href="logout.php" class="link">Logout</a>
            </li>
        </ul>

        <div class="profile-container">
            <!-- Landing Page Text -->
            <div class="page-title2">
                <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
                <a href="superadmin.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <?php }?>
                <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
                <a href="customerinfo.php?unique=<?php echo $_GET['unique'];?>&real=91838JDFOJOEI939">
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


                    <div class="input-div nin">
                        <label for="nin">NIN</label>
                        <input type="number" id="nin" placeholder="Edit NIN" name="nin"
                            value="<?php if(isset($newuser['nin'])){echo $newuser['nin'];}?>" />
                    </div>


                    <div class="input-div dob">
                        <label for="dob">Date Of Birth</label>
                        <input type="date" id="dob" style="font-size: 18px; cursor: pointer;" name="dob" value="<?php if(isset($newuser['dateofbirth'])){
                    echo $newuser['dateofbirth'];
                }?>" />
                    </div>

                    <div class="input-div address">
                        <label for="address">House Address</label>
                        <input type="text" id="address" placeholder="Edit home address" name="address"
                            value="<?php if(isset($newuser['home_address'])){echo $newuser['home_address'];}?>" />
                    </div>


                    <div class="input-div nextofkinfirstname">
                        <label for="nextofkinfirstname">Next Of Kin Firstname</label>
                        <input type="text" id="nextofkinfirstname" placeholder="Edit Next OF Kin Firstname"
                            name="nextofkinfirstname"
                            value="<?php if(isset($newuser['nextofkin_firstname'])){echo $newuser['nextofkin_firstname'];}?>" />
                    </div>


                    <div class="input-div nextofkinlastname">
                        <label for="nextofkinlastname">Next Of Kin Lastname</label>
                        <input type="text" id="nextofkinlastname" placeholder="Edit Next OF Kin Lastname"
                            name="nextofkinlastname"
                            value="<?php if(isset($newuser['nextofkin_lastname'])){echo $newuser['nextofkin_lastname'];}?>" />
                    </div>


                    <div class="input-div nextofkinemail">
                        <label for="nextofkinemail">Next Of Kin Email</label>
                        <input type="email" id="nextofkinemail" placeholder="Edit Next OF Kin Email"
                            name="nextofkinemail"
                            value="<?php if(isset($newuser['nextofkin_email'])){echo $newuser['nextofkin_email'];}?>" />
                    </div>

                    <div class="input-div nextofkinaddress">
                        <label for="nextofkinaddress">Next Of Kin Address</label>
                        <input type="text" id="nextofkinaddress" placeholder="Edit Next OF Kin Address"
                            name="nextofkinaddress"
                            value="<?php if(isset($newuser['nextofkin_address'])){echo $newuser['nextofkin_address'];}?>" />
                    </div>

                    <div class="input-div nextofkinphone">
                        <label for="nextofkinphone">Next Of Kin Phone Number</label>
                        <input type="number" id="nextofkinphone" placeholder="Edit Next OF Kin Phone Num"
                            name="nextofkinphone"
                            value="<?php if(isset($newuser['nextofkin_phone'])){echo $newuser['nextofkin_phone'];}?>" />
                    </div>

                    <p class="label">Next Of Kin Relation</p>
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


                    <div class="input-div number">
                        <label for="earning">Earning Percentage</label>
                        <input type="number" id="earning" placeholder="Enter earning percentage" name="earning"
                            value="<?php if(isset($newuser['earning_percentage'])){echo $newuser['earning_percentage'];}?>" />
                    </div>

                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="male" name="gender" value="Male" />
                                <label for="male">Male</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="female" name="gender" value="Female" />
                                <label for="female">Female</label>
                            </div>
                        </div>
                        <div class="selected">Select Gender</div>
                    </div>

                    <div class="valuediv" style="display: none;"></div>

                    <div class="input-div email">
                        <label>Profile Image</label>
                        <input type="text" name="text" placeholder="Upload user profile image" disabled />
                        <input type="file" id="passport" placeholder="Upload user profile image" name="image"
                            hidden="hidden" accept="image/*" />
                        <div id="createid">Upload</div>
                    </div>

                    <div class="file-container">
                        <div class="browse-filediv">
                            <div class="centrediv">
                                <p>Drop files here to upload</p>
                                <label>Browse files</label>
                            </div>
                            <div class="uploading-div"></div>
                            <div class="uploading-div2"></div>
                        </div>
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
        </div>
    </div>

    <div class="successmodal">
        <div class="modalcon">
            <div class="modaldiv">
                <div>
                    <img src="images/asset_success.svg" alt="" />
                    <p>Customer Details!</p>
                    <p>Updated Successfully</p>
                    <a href="customerinfo.php?unique=<?php echo $_GET['unique'];?>&real=91838JDFOJOEI939"><button
                            class="landing_page_button2">Back to Dashboard</button></a>
                    <a href="updatedocument.php?unique=<?php echo $_GET['unique'];?>&real=91838JDFOJOEI939"><button
                            class="landing_page_button2">Update User Document</button></a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script>
    const form = document.querySelector("#signup-form"),
        fileInput = form.querySelector("#passport"),
        progressArea = document.querySelector(".uploading-div"),
        uploadArea = document.querySelector(".uploading-div2"),
        startbtn = document.querySelector(".centrediv label");
    let uploadbtn = document.querySelector("#createid");
    let uploaddiv = document.querySelector(".file-container");
    let submitbtn = document.querySelector("#signup-form .btn");
    const error = document.querySelector(".error");
    uploadbtn.addEventListener("click", () => {
        uploaddiv.style.display = "block";
        if (window.innerWidth < 1300) {
            document.querySelector('.body').style.height = "390vh";
        }
        if (window.innerWidth > 1300) {
            document.querySelector('.body').style.height = "370vh";
        }

    });

    form.onsubmit = (e) => {
        e.preventDefault();
    };

    let valuediv = document.querySelector('.valuediv');

    let purpose = document.getElementsByName("gender");
    purpose.forEach((element) => {
        element.onclick = () => {
            valuediv.innerHTML = element.value;
        };
    });

    startbtn.addEventListener("click", () => {
        fileInput.click();
    });

    fileInput.onchange = ({
        target
    }) => {
        let file = target.files[0];
        if (file) {
            let fileName = file.name;
            if (fileName.length >= 12) {
                let splitName = fileName.split(".");
                fileName = splitName[0].substring(0, 12) + "..." + splitName[1];
            }
            uploadFile(fileName);
        }
    };

    function uploadFile(name) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "inserters/edituser.php", true);
        xhr.upload.addEventListener("progress", ({
            loaded,
            total
        }) => {
            let fileLoaded = Math.floor((loaded / total) * 100);
            let fileTotal = Math.floor(total / 1000);
            let fileSize;
            fileTotal < 1024 ?
                (fileSize = fileTotal + " KB") :
                (fileSize = (loaded / (1024 * 1024)).toFixed(2) + " MB");
            let progressHTML = `
                <div class="progress-bar">
                            <div class="progress-element" style="width: ${fileLoaded}%"></div>
                        </div>
                        <p class="percent"><span class="percent">${fileLoaded}</span>% Complete</p>
                        <div class="upload-state">
                            <p class="file-name">${name}</p>
                        </div>
                `;

            uploadArea.innerHTML = "";
            progressArea.innerHTML = progressHTML;

            if (loaded == total) {
                progressArea.innerHTML = "";
                let uploadedHTML = `
                    <div class="progress-bar">
                            <div class="progress-element" style="width: ${fileLoaded}%"></div>
                        </div>
                        <p class="percent"><span class="percent">Uploaded</p>
                        <div class="upload-state">
                            <p class="file-name">${name}</p>
                            <p class="file-size">${fileSize}</p>
                        </div>
                `;
                uploadArea.innerHTML = uploadedHTML;
                error.style.visibility = "hidden";
            }

            if (total > 2097152) {
                progressArea.innerHTML = "";
                let uploadedHTML = `
                    <div class="progress-bar">
                            <div class="progress-element" style="width: 50%!important; background: #808080!important;"></div>
                        </div>
                        <p class="percent"><span class="percent">Upload Failed</p>
                `;
                uploadArea.innerHTML = uploadedHTML;
                error.textContent = "File Should be 2mb or less";
                error.style.visibility = "visible";
                setTimeout(() => {
                    error.style.visibility = "hidden";
                }, 20000);
                loaded = 0;
            }
        });

        let formData = new FormData(form);
        xhr.send(formData);
    }

    function insertDetails() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", `inserters/edituser.php?gender=${valuediv.innerHTML}`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "success") {
                        //console.log("uploaded");
                        submitbtn.onclick = () => {
                            document.querySelector('.successmodal').style.display = "flex";
                            document.querySelector('.modalcon').classList.add('animation');
                        };
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
        let formData = new FormData(form)
        xhr.send(formData);
    }

    submitbtn.onclick = () => {
        insertDetails();
    };

    if (window.innerWidth > 1200) {
        let dropdownnav = document.querySelector(".dropdown-links");
        let open = document.querySelector('#openicon');
        let closeicon = document.querySelector('#closeicon');
        open.onclick = () => {
            dropdownnav.style = `
        width: 14%;
        `;
            open.style.display = "none";
            closeicon.style.display = "block";
            document.querySelector(".profile-container").style = `
         padding-left: 7em;
        `;
            let allLinks = document.querySelectorAll(".dropdown-links .links .link");

            let allLink = document.querySelectorAll(".dropdown-links .links");
            allLink.forEach((element) => {
                element.style = `
        gap: 10px;
        `;

            });
            allLinks.forEach((element) => {
                element.style = `
         visibility: visible;
         display: block;
        `;
            });
        }

        closeicon.onclick = () => {
            dropdownnav.style = `
        width: 6%;
        `;
            open.style.display = "block";
            closeicon.style.display = "none";
            document.querySelector(".profile-container").style = `
         padding-left: 1em;
        `;

            let allLink = document.querySelectorAll(".dropdown-links .links");
            allLink.forEach((element) => {
                element.style = `
        justify-content: center
        `;
            });

            let allLinks = document.querySelectorAll(".dropdown-links .links .link");
            allLinks.forEach((element) => {
                element.style = `
         visibility: hidden;
         display:none;
        `;
            });
        }
    }
    if (window.innerWidth < 1300) {
        let dropdownnav = document.querySelector(".dropdown-links");
        let menu = document.querySelector(".menu");
        menu.onclick = () => {
            dropdownnav.style = `
            transform: translateX(0);
            `;
        };

        let close = document.querySelector(".close");
        close.onclick = () => {
            dropdownnav.style = `
            transform: translateX(100%);
            `;
        };
    }
    // $(document).ready(function() {
    //     $("#signup-form").submit(function(e) {
    //         e.preventDefault();
    //         var loadingImg = $(".loading-img");
    //         $(".btn").html(loadingImg);
    //     });



    //     $("#signup-form .btn").click(function() {
    //         $.ajax({
    //             type: "POST",
    //             url: "inserters/edituser.php",
    //             data: $("#signup-form input"),
    //             success: function(response) {
    //                 if (response === "success") {
    //                     location.href = "successpage/editsuccess.php";
    //                 } else {
    //                     $("section .error").html(response);
    //                     $("section .error").css({
    //                         visibility: "visible",
    //                     });
    //                     $(".btn").html("Edit Customer");
    //                     // console.log(response);
    //                 }
    //             },
    //         });
    //     });
    // });
    </script>
</body>

</html>