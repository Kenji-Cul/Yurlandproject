<?php 
session_start();
include_once "projectlog.php";
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
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        height: 200vh;
        background-image: none;
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
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>
    </header>

    <!-- Landing Page Text -->
    <div class="page-title2">
        <a href="superadmin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Upload Optional Image</p>
    </div>


    <section class="login-form-container">
        <form action="" class="login-form" id="upload-form">


            <div class="input-div name">
                <input type="hidden" id="unique" value="<?php if(isset($_GET['unique'])){
                    echo $_GET['unique'];
                }?>" name="unique" />
            </div>


            <div class="input-div email">
                <label>Optional Image</label>
                <input type="text" name="text" placeholder="Upload optional image" disabled />
                <input type="file" id="firstimage" placeholder="Upload optional image" name="firstimage" hidden="hidden"
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
            <button class="btn" type="submit">Save Changes</button>

            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </section>


    <script>
    const form = document.querySelector("#upload-form");
    let fileInput = document.querySelector("#firstimage");
    let progressArea = document.querySelector(".uploading-div");
    let uploadArea = document.querySelector(".uploading-div2");
    let startbtn = document.querySelector(".centrediv label");
    let uploadbtn = document.querySelector("#createid");
    let uploaddiv = document.querySelector(".file-container");
    let submitbtn = document.querySelector("#upload-form .btn");
    const error = document.querySelector(".error");
    uploadbtn.addEventListener("click", () => {
        uploaddiv.style.display = "block";
    });


    form.onsubmit = (e) => {
        e.preventDefault();
    };

    startbtn.addEventListener("click", () => {
        fileInput.click();
    });



    fileInput.onchange = ({
        target
    }) => {
        let file = target.files[0];
        console.log(file);
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
        xhr.open("POST", "inserters/uploadoptions.php");
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

    let uniqueInput = document.querySelector('#unique');


    submitbtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "inserters/uploadoptions.php");
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "success") {
                        //console.log("uploaded");
                        submitbtn.onclick = () => {
                            location.href = `successpage/landsuccess.html`;
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
        let formData = new FormData(form);
        xhr.send(formData);
    };
    </script>
</body>

</html>