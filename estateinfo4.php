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
    <title><?php echo MY_APP_NAME;?></title>
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

    <input type="hidden" name="" id="unitnum" value=<?php echo $value['product_unit'];?>>
    <?php }}?>

    <div class="first-section">
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
    </div>

    <div class="success" style="display:none; padding-left: 4em;">
        <p>We are sorry this land</p>
        <p>is not up to that unit!</p>
        <a href="cartreview.php"><button class="estate_page_button" type="submit">Go Back</button></a>
    </div>


    <div class="second-section" style="display:none; padding-left: 4em;">
        <div class="cost" style="margin-bottom: 2em;">
            <input type="hidden" name="tot" value="" id="tot">
            <p>Total Cost:&nbsp;&nbsp;&nbsp;&#8358;<span id="numformat"></span></p>
        </div>

        <form action="" id="paymentplanform">
            <div class="payment-plan">
                <p>Choose payment plan</p>
                <label class="radio" for="outright">
                    <input type="radio" name="payment" id="outright" value="outright payment" />
                    <span></span>
                    <p>Outright payment</p>
                </label>
                <label class="radio" fo="sub">
                    <input type="radio" name="payment" id="sub" value="subscription payment" />
                    <span></span>
                    <p>Payflex</p>
                </label>
            </div>



            <div class="btn-container">
                <button class="estate_page_button" type="submit">Continue</button>
            </div>

        </form>

    </div>


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

    let form1 = document.querySelector('.first-section');
    let form2 = document.querySelector('.second-section');
    let totalInput = document.querySelector('#tot');
    let unitNum = document.querySelector("#unitnum")
    let Successdiv = document.querySelector(".success")
    let formatnum = document.querySelector('#numformat')



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
                        form1.style.display = "none";
                        form2.style.display = "block";
                        let first = parseInt(unitInput.value);
                        let second = parseInt(unitNum.value);
                        if (first > second) {
                            Successdiv.style.display = "block";
                            form2.innerHTML = Successdiv;
                        }
                        totalInput.value = price;
                        formatnum.innerHTML = new Intl.NumberFormat().format(price);
                        // location.href =
                        //     `summarypage.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${price}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9938484747`;
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


    const planform = document.querySelector('#paymentplanform');
    const paybtn = document.querySelector('#paymentplanform .estate_page_button');
    planform.onsubmit = (e) => {
        e.preventDefault();
    }


    function checkPaymentMode() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getplan.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "outright payment") {
                        location.href =
                            `outrightpayment2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9298383737`;
                    }
                    if (data == "subscription payment") {
                        location.href =
                            `subpayment2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=judu8272626`;
                    }
                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(planform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    paybtn.onclick = () => {
        checkPaymentMode();
    }
    </script>
</body>

</html>