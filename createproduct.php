<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['uniquesupadmin_id'])){
    header("Location:index.php");
}

if(!isset($_GET['mode'])){
    header("Location: superadmin.php");
}

if(!isset($_GET['pose'])){
    header("Location: superadmin.php");
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
        height: 340vh;
        background-image: none;
    }

    section .error {
        width: 60%;
    }

    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
    }

    .dailyprice input {
        margin-bottom: 1.7em;
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
        <p>Create Product</p>
    </div>


    <section class="login-form-container">
        <form action="" class="login-form" id="upload-form">
            <div class="input-div name">
                <label for="name">Estate Name</label>
                <input type="text" id="name" placeholder="Input land name" name="landname" />
            </div>



            <div class="select-box">
                <div class="options-container">
                    <div class="option">
                        <input type="radio" class="radio" id="lagos" name="state" value="Lagos" />
                        <label for="lagos">Lagos</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="ogun" name="state" value="Ogun" />
                        <label for="ogun">Ogun</label>
                    </div>
                </div>
                <div class="selected">Select Location</div>
            </div>

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
                        <input type="radio" class="radio" id="budget3" name="budget" value="1,500,000 - 3,000,000" />
                        <label for="budget3">1,500,000 - 3,000,000</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="budget4" name="budget" value="3,000,000 - 5,000,000" />
                        <label for="budget4">3,000,000 - 5,000,000</label>
                    </div>

                    <div class="option">
                        <input type="radio" class="radio" id="budget5" name="budget" value="5,000,000 - Above" />
                        <label for="budget5">5,000,000 - Above</label>
                    </div>
                </div>
                <div class="selected">Select Budget</div>
            </div>

            <div class="input-div name">
                <label for="size">Estate Size</label>
                <input type="text" id="size" placeholder="Input land size" name="size" />
            </div>

            <div class="input-div name">
                <label for="units">Number of Units</label>
                <input type="number" id="units" placeholder="Input number of units" name="noofunit" />
            </div>

            <div class="input-div name">
                <label for="priceunit">Price per unit</label>
                <input type="number" id="priceunit" placeholder="Input price per unit" name="unitprice" />
            </div>

            <div class="input-div name">
                <input type="hidden" id="unique" value="" name="unique" />
            </div>





            <?php if($_GET['mode'] === "OutPrice"){?>
            <div class="input-div name">
                <label for="outrightprice">Outright Price</label>
                <input type="number" id="outrightprice" placeholder="Input outright price" name="outrightprice" />
            </div>
            <?php }?>

            <?php if($_GET['mode'] === "sub"){?>
            <div class="input-div name dailyprice">
                <label for="dailyprice">Subscription</label>
                <input type="number" id="eighteenmonthprice" placeholder="Price for 18 months plan"
                    name="eighteenmonth" />
            </div>
            <?php }?>

            <?php  if($_GET['mode'] ==="outsub"){?>
            <div class="input-div name">
                <label for="outrytprice">Outright Price</label>
                <input type="number" id="outrytprice" placeholder="Input outright price" name="outrightprice" />
            </div>

            <div class="input-div name dailyprice">
                <label for="dailyprice">Subscription</label>
                <input type="number" id="eighteenmonthprice" placeholder="Price for 18 months plan"
                    name="eighteenmonth" />
            </div>
            <?php }?>


            <div class="input-div name">
                <label for="estatefeature">Estate Feature</label>
                <input type="text" id="estatefeature" placeholder="Input estate feature" name="estatefeature" />
            </div>

            <div class="input-div name">
                <input type="hidden" id="purpose" name="purpose" placeholder="Input estate feature" value="<?php if(($_GET['pose'] === "residential") || $_GET['pose'] === "commercial"){
                    echo $_GET['pose'];
                } else {
                    header("Location: selectprice.html");
                }?>" />
            </div>

            <div class="input-div name">
                <label for="desc">Product Description</label>
                <textarea name="productdesc" id="desc" cols="30" rows="10"></textarea>
            </div>

            <div class="input-div email">
                <label>Product Image</label>
                <input type="text" name="text" placeholder="Upload product image" disabled />
                <input type="file" id="passport" placeholder="Upload product image" name="image" hidden="hidden"
                    accept="image/*" />
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


            <p class="error">Please input all fields</p>
            <button class="btn" type="submit">Create Land</button>
            <div class="value" style="visibility: hidden"></div>
            <div class="value2" style="visibility: hidden"></div>

            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>

    <script src="js/main.js"></script>
    <script>
    const form = document.querySelector("#upload-form"),
        fileInput = form.querySelector("#passport"),
        progressArea = document.querySelector(".uploading-div"),
        uploadArea = document.querySelector(".uploading-div2"),
        startbtn = document.querySelector(".centrediv label");
    let uploadbtn = document.querySelector("#createid");
    let uploaddiv = document.querySelector(".file-container");
    let submitbtn = document.querySelector("#upload-form .btn");
    const error = document.querySelector(".error");
    let radio = document.querySelector('.rad input');
    let valuediv = document.querySelector(".value");
    let valuediv2 = document.querySelector(".value2");
    uploadbtn.addEventListener("click", () => {
        uploaddiv.style.display = "block";
    });

    let locations = document.getElementsByName("state");
    locations.forEach((element) => {
        element.onclick = () => {
            valuediv.innerHTML = element.value;
        };
    });

    let budgets = document.getElementsByName("budget");
    budgets.forEach((element) => {
        element.onclick = () => {
            valuediv2.innerHTML = element.value;
        };
    });










    form.onsubmit = (e) => {
        e.preventDefault();
        submitbtn.innerHTML = "";
        submitbtn.appendChild(document.querySelector('.loading-img'))
    };

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
        xhr.open("POST", "inserters/uploadproductimage.php");
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

            if (total > 4194304) {
                progressArea.innerHTML = "";
                let uploadedHTML = `
                    <div class="progress-bar">
                            <div class="progress-element" style="width: 50%!important; background: #808080!important;"></div>
                        </div>
                        <p class="percent"><span class="percent">Upload Failed</p>
                        <div class="upload-state">
                            <p class="file-name">Try again</p>
                        </div>
                `;
                uploadArea.innerHTML = uploadedHTML;
                error.textContent = "File Should be 4mb or less";
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

    var unique = document.querySelector('#unique');

    function createRandomString(string_length) {
        var random_string = "";
        var characters = "0123456789012345678910";
        for (var i, i = 0; i < string_length; i++) {
            random_string += characters.charAt(
                Math.floor(Math.random() * characters.length)
            );
        }

        unique.value = random_string;
    }

    submitbtn.onclick = () => {
        createRandomString(10);
        let xhr = new XMLHttpRequest();
        if (document.body.contains(document.querySelector("#outrightprice"))) {
            xhr.open("POST",
                `inserters/uploadproduct2.php?state=${valuediv.innerHTML}&budget=${valuediv2.innerHTML}`);
        }

        if (document.body.contains(document.querySelector("#eighteenmonthprice"))) {
            xhr.open("POST",
                `inserters/uploadproduct3.php?state=${valuediv.innerHTML}&budget=${valuediv2.innerHTML}`);
        }

        if (document.body.contains(document.querySelector("#outrytprice")) && document.body.contains(document
                .querySelector("#eighteenmonthprice"))) {
            xhr.open("POST",
                `inserters/uploadproduct.php?state=${valuediv.innerHTML}&budget=${valuediv2.innerHTML}`);
        }



        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "success") {
                        //console.log("uploaded");
                        location.href =
                            `createotherfiles.php?unique=${unique.value}&key=8478748468bbkjgfakha&ref=8487248724764767647fnabfkjbfafj838373736262550002726151525535`;
                    } else {
                        if (error.textContent = data) {
                            error.style.visibility = "visible";
                            submitbtn.innerHTML = "Create Land";
                            //uploaddiv.style.display = "none";
                            setTimeout(() => {
                                error.style.visibility = "hidden";
                            }, 20000);
                        }
                    }
                }
            }
        };
        let formData = new FormData(form);
        xhr.send(formData);
    };
    </script>
</body>

</html>