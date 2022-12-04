<?php 
include "projectlog.php";
session_start();

if(!isset($_GET['tot']) || !isset($_GET['uniqueid'])){
    header('Location: index.php');
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

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        height: 120vh !important;
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
            <img src="images/cart.svg" alt="cart icon" />
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="page-title4">
        <div>
            <img src="images/orange-cart-icon.svg" alt="" />
        </div>
        <p>Subscription Payment</p>
    </div>

    <?php 
    $land = new User;
    $landview = $land->selectLandImage($_GET['uniqueid']);
    if(!empty($landview)){
        foreach($landview as $key => $value){ 
    ?>


    <div class="image-desc">
        <img src="landimage/<?php echo $value['product_image']; ?>" alt="" />
    </div>

    <div class="price-desc">
        <div>
            <div class="land-name">
                <p><?php echo $value['product_name'];?></p>
            </div>
            <div class="land-location">
                <p><?php echo $value['product_location'];?></p>
            </div>
        </div>


        <?php }}?>

    </div>




    <script src="js/main.js"></script>
    <script>
    const intervalform = document.querySelector('#intervalform');
    const paybtn = document.querySelector('.estate_page_button');
    intervalform.onsubmit = (e) => {
        e.preventDefault();
    }
    // const selectedAll = document.querySelectorAll(".selected");

    // selectedAll.forEach((selected) => {
    //     const optionsContainer = selected.previousElementSibling;
    //     const searchBox = selected.nextElementSibling;

    //     const optionsList = optionsContainer.querySelectorAll(".option");

    //     selected.addEventListener("click", () => {
    //         if (optionsContainer.classList.contains("active")) {
    //             optionsContainer.classList.remove("active");
    //         } else {
    //             let currentActive = document.querySelector(".options-container.active");

    //             if (currentActive) {
    //                 currentActive.classList.remove("active");
    //             }

    //             optionsContainer.classList.add("active");
    //         }



    //     });

    //     optionsList.forEach((o) => {
    //         o.addEventListener("click", () => {
    //             selected.innerHTML = o.querySelector("label").innerHTML;
    //             optionsContainer.classList.remove("active");
    //         });
    //     });





    // });

    const params = new URLSearchParams(window.location.search)
    const unique = params.get('uniqueid')
    const unit = params.get('unit')
    const total = params.get('tot')

    function checkInterval() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getdata.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    console.log(data);
                    if (data) {
                        location.href =
                            `intervalnum.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${total}&pice=029283837iiagj098655454&unit=${unit}&con=9298383737`;
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(intervalform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    paybtn.onclick = () => {
        checkInterval();
    }
    </script>
</body>

</html>