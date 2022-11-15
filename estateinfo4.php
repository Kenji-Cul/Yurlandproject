<?php 
session_start();
if(!isset($_GET['id'])){
    header("Location: index.php");
}
include "projectlog.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        min-height: 100vh;
    }

    .error {
        width: 60%;
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
        visibility: hidden;
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>

        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <?php 
    $land = new User;
    $landview = $land->selectLandImage($_GET['id']);
    if(!empty($landview)){
        $_SESSION['user'] = $_GET['keyunique'];
        foreach($landview as $key => $value){ 
    ?>

    <div class="red-div">
        <div class="img-info">
            <img class="main-img" src="landimage/<?php if(isset($value['product_image'])){
                echo $value['product_image'];
            }?>" alt="" />

            <div class="info-details">
                <div class="info1">
                    <img src="landimage/<?php if(isset($value['product_image'])){
                echo $value['image_one'];
            }?>" alt="" />
                </div>
                <div class="info2">
                    <img src="landimage/<?php if(isset($value['product_image'])){
                echo $value['product_image'];
            }?>" alt="" />
                </div>
            </div>
        </div>
    </div>

    <div class="land-info">
        <div>
            <p class="location"><?php echo $value['product_name'];?></p>
            <p><?php echo $value['product_location'];?></p>
        </div>
        <div class="unit-price">&#8358;<?php
        $unitprice = $value['unit_price'];
        if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                          echo number_format($unitprice);
                        }?> per unit</div>
    </div>

    <div class="land-desc">
        <?php echo $value['product_description'];?>
    </div>

    <?php }}?>

    <div class="units">
        <p class="h1">How many units are you buying?</p>
        <div class="measure">
            <p>1 unit</p>
            <p class="line"></p>
            <p>half plot</p>
        </div>
    </div>

    <form action="" id="unit-form">
        <div class="estateinfo">
            <div class="input-div">
                <input type="number" placeholder="Input number of units" id="unit" name="unit" />
            </div>
        </div>

        <p class="error">Please fill </p>

        <div class="btn-container">
            <button class="estate_page_button" type="submit">Continue</button>
        </div>
        <div style="display: none">
            <img src="images/loading.svg" alt="" class="loading-img" />
        </div>
    </form>

    <script src="js/main.js"></script>
    <script>
    var targetImg = document.querySelector(".main-img");
    let form = document.querySelector("#unit-form");
    let error = document.querySelector(".error");
    let formbtn = document.querySelector("#unit-form .estate_page_button");
    let unitInput = document.querySelector("#unit")



    var clickedImg = document.querySelectorAll(".info-details img");
    clickedImg.forEach((element) => {
        element.onclick = () => {
            var src = element.src;
            var targetsrc = src.substr(25, src.length);
            targetImg.src = targetsrc;
            clickedImg[0].style.border = "1px solid white";
            clickedImg[1].style.border = "1px solid white";
            element.style.border = "none";
        };
    });


    form.onsubmit = (e) => {
        e.preventDefault();
    };



    const params = new URLSearchParams(window.location.search)
    const unique = params.get('id')


    function submitUnits() {

        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", `inserters/calcunit.php?uniqueid=${unique}`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    let string = "success";
                    let realprice = data.replace('success', '')
                    if (data.includes(string)) {
                        let price = unitInput.value * realprice;
                        location.href =
                            `summarypage2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${price}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9938484747`;
                    } else {
                        error.textContent = data;
                        error.style.visibility = "visible";
                        formbtn.textContent = "Continue";
                    }
                    // if (data) {
                    //     console.log(data);

                    // } else {
                    //     
                    // }
                }
            }
        };
        // we have to send the information through ajax to php
        let formData = new FormData(form); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    formbtn.onclick = () => {
        submitUnits();
    };
    </script>
</body>

</html>