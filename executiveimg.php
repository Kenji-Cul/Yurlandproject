<?php
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['uniqueexec_id'])){
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

    @media only screen (max-width: 800px) {
        body {
            height: 260vh !important;
            background-image: none;
        }
    }

    @media only screen (max-width: 500px) {
        body {
            height: 260vh !important;
            background-image: none;
        }
    }

    section .error {
        width: 60%;
    }

    .btn {
        background-color: #808080;
    }

    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
        width: 80%;
    }

    .label {
        font-style: normal;
        font-weight: 600;
        font-size: 17px;
        line-height: 18px;
        padding-bottom: 10px;
        padding-left: 10px;
    }

    .select-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        align-items: center;
        justify-content: center;
        flex-direction: row;
        width: 100% !important;
        gap: 4em;
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
        <a href="executiveprofileinfo.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>Upload Details</p>
    </div>



    <section class="login-form-container">
        <form action="" class="login-form" id="upload-form">

            <div class="input-div email">
                <label>Profile Image</label>
                <input type="text" name="text" placeholder="Upload your profile Image" disabled />
                <input type="file" id="passport" placeholder="Upload your profile image" name="image" hidden="hidden"
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
        xhr.open("POST", "inserters/insertexecutiveimg.php", true);
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
        xhr.open("POST", "inserters/insertexecutiveimg.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data === "success") {
                        //console.log("uploaded");
                        submitbtn.onclick = () => {
                            location.href = "successpage/executivesucceed.html";
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
    </script>
</body>

</html>