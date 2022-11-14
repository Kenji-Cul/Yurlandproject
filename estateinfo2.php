<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("Location: login.php");
}
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



    @media only screen and (max-width: 500px) {
        .land-info {
            display: flex;
            flex-direction: column !important;
            gap: 2em;
        }
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
            <a href="cartreview.php">
                <div class="cart">
                    <div class="cart-notify"></div>
                    <img src="images/cart.svg" alt="cart icon" />
                </div>
            </a>
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <?php 
    $land = new User;
    $landview = $land->selectLandImage($_GET['id']);
    if(!empty($landview)){
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
        <form action="" id="cartform">
            <div class="price" id="cart-btn">Add to Cart</div>
            <input type="hidden" name="productid" value="<?php echo $value['unique_id']?>">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="user" value="<?php echo $_SESSION['unique_id'];?>">
        </form>
    </div>

    <div class="land-desc">
        <?php echo $value['product_description'];?>
    </div>

    <?php }}?>





    <script src="js/main.js"></script>
    <script>
    var targetImg = document.querySelector(".main-img");
    const intervalform = document.querySelector('#cartform');
    const paybtn = document.querySelector('#cart-btn');
    intervalform.onsubmit = (e) => {
        e.preventDefault();
    }


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




    function addToCart() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "inserters/checkproduct.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data) {
                        document.location.reload();
                    } else {
                        //console.log(data);
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(intervalform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    paybtn.onclick = () => {
        addToCart();
    }

    setInterval(() => {
        let xls = new XMLHttpRequest();
        xls.open("GET", "getcart.php", true);
        xls.onload = () => {
            if (xls.readyState === XMLHttpRequest.DONE) {
                if (xls.status === 200) {
                    let data = xls.response;
                    let notify = document.querySelector('.cart-notify');
                    if (data == 0) {
                        notify.style.display = "none";
                    }

                    notify.innerHTML = data;
                    //console.log(data);
                }
            }
        }
        xls.send();
    }, 100);
    </script>
</body>

</html>