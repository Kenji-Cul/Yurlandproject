<?php 
if(!isset($_GET['id'])){
    header("Location: index.php");
}
session_start();
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

    .cart-info {
        display: flex;
        align-items: center;
        justify-content: left;
        width: 90%;
        padding-left: 1.5em;
    }

    .cartbutton {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6em;
        width: 160px;
        height: 37.91px;
        color: #7E252B;
        border: 1px solid #7E252B;
        border-radius: 45px;
        cursor: pointer;
    }

    #manualform {
        display: flex;
        justify-content: left;
        flex-direction: column;
        position: absolute;
        left: 2em;
        width: 80%;
    }

    .success {
        height: 18em;
        width: 70%;
    }


    .second-section {
        padding-left: 4em;
    }


    #intervalform2 {
        width: 50%
    }

    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
        margin-bottom: 3em;
    }


    .error,
    .error2 {
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

    @media only screen and (max-width: 800px) {
        .second-section {
            padding-left: 1em;
        }

        .error,
        .error2 {
            width: 80%;
            height: 1.4em;
            margin-bottom: 1em;
        }

        #unit,
        #newpay {
            width: 18em;

        }

        .estate_page_button {
            margin-top: 2em;
        }

        #manualform input {
            width: 18em;
            position: absolute;
            left: -3em;
        }

        #manualform .error2 {
            margin-top: 4em;
        }

        .land-info {
            flex-direction: column;
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
    </div>


    <?php 
   
    if(!isset($_GET['remprice'])){
        if($value['product_unit'] != 0){
        ?>
    <div class="cart-info">
        <form action="" id="cartform<?php echo $value['unique_id'];?>">
            <?php 
            if(isset($_SESSION['unique_id'])){
                $cart = $land->checkCartId($_SESSION['unique_id'],$value['unique_id']);
            }
            if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){
                $cart = $land->checkCartId($_GET['unique'],$value['unique_id']);
            }
                   
                    if(empty($cart)){
                    ?>
            <div class="cartbutton" id="cart-btn<?php echo $value['unique_id'];?>">
                <img src="images/cart.svg" alt="">
                <p>Add To Cart</p>
            </div>

            <div id="otherbtn<?php echo $value['unique_id'];?>" class="cartbutton" style="visibility:hidden;"> <a
                    href="cartreview.php" style="color: #7e252b;">View In Cart </a>
            </div>
            <?php } else {?>
            <div class="cartbutton" id="cart-btn<?php echo $value['unique_id'];?>" style="visibility:hidden;">
                <img src="images/cart.svg" alt="">
                <p>Add To Cart</p>
            </div>
            <div id="otherbtn<?php echo $value['unique_id'];?>" class="cartbutton"> <a href="cartreview.php"
                    style="color: #7e252b;">View In Cart </a>
            </div>
            <?php }?>


            <input type="hidden" name="productid" value="<?php echo $value['unique_id']?>">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="user" value="<?php 
            if(isset($_SESSION['unique_id'])){ echo $_SESSION['unique_id'];}
            if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){ echo $_GET['unique'];}
            ?>">
        </form>

        <script>
        let unique<?php echo $value['unique_id']?> = document.querySelector(
            `.uni<?php echo $value['unique_id'];?>`);

        const intervalform<?php echo $value['unique_id'];?> = document.querySelector(
            `#cartform<?php echo $value['unique_id'];?>`);
        const paybtn<?php echo $value['unique_id'];?> = document.querySelector(
            `#cart-btn<?php echo $value['unique_id'];?>`);


        intervalform<?php echo $value['unique_id'];?>.onsubmit = (e) => {
            e.preventDefault();
        }





        function addToCart<?php echo $value['unique_id'];?>() {
            let xhr = new XMLHttpRequest(); //creating XML Object
            xhr.open("POST", "inserters/checkproduct.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if (data) {
                            document.querySelector(`#cart-btn<?php echo $value['unique_id'];?>`).style.display =
                                "none";
                            document.querySelector(`#otherbtn<?php echo $value['unique_id'];?>`).style.visibility =
                                "visible";
                        } else {
                            //console.log(data);
                        }

                    }
                }
            }
            // we have to send the information through ajax to php
            let formData = new FormData(intervalform<?php echo $value['unique_id'];?>); //creating new formData Object

            xhr.send(formData); //sending the form data to php
        }

        paybtn<?php echo $value['unique_id'];?>.onclick = () => {
            addToCart<?php echo $value['unique_id'];?>();
        }
        </script>
    </div>
    <?php } else {?>
    <div class="cart-info">
        <div class="cartbutton">Sold Out</div>
    </div>
    <?php }}?>

    <div class="land-desc">
        <?php echo $value['product_description'];?>
    </div>

    <input type="hidden" name="" id="unitnum" value=<?php echo $value['product_unit'];?>>
    <?php 
    if(isset($_GET['remprice'])){
        if(isset($_SESSION['unique_id'])){
        $landuse = $land->selectProductPayment($value['unique_id'],$_SESSION['unique_id']);
        }

        if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){
            $landuse = $land->selectProductPayment($value['unique_id'],$_GET['unique']);
            }
        if(!empty($landuse)){
            foreach($landuse as $key => $value){ ?>

    <input type="hidden" name="" id="remunit" value=<?php echo $value['product_unit'];?>>
    <input type="hidden" name="" id="periodunit" value=<?php echo $value['period_num'];?>>


    <input type="hidden" placeholder="Input the price you want to pay" id="newpay" name="newpay" value="<?php 
 echo $value['product_price']
 ?>" />
    <?php
            }
    }}
    
    ?>



    <?php }}?>



    <?php if($value['product_unit'] != 0){?>
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

            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
    </div>
    <?php }?>

    <div class="thirdsection" style="display: none;">

        <div class="cost" style="margin-bottom: 2em; margin-left: 2em;">
            <input type="hidden" name="tot" value="<?php if(isset($_GET['remprice'])){
                echo $_GET['remprice'];
            }?>" id="tot">
            <?php if(isset($_GET['remprice'])){?>
            <p>Remaining Price:&nbsp;&nbsp;&nbsp;&#8358;<span id="numformat"></span></p>
            <?php }else {?>
            <p>Total Cost:&nbsp;&nbsp;&nbsp;&#8358;<span id="numformat"></span></p>
            <?php }?>
        </div>
        <form action="" id="newpaymentform">
            <div class="estateinfo">
                <div class="input-div">

                    <?php
           if(isset($_SESSION['unique_id'])){
             $landuse = $land->selectProductNewPayment($_GET['id'],$_SESSION['unique_id']);
           }

           if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){
            $landuse = $land->selectProductNewPayment($_GET['id'],$_GET['unique']);
          }

           
             if(!empty($landuse)){
                 foreach($landuse as $key => $value){ ?>
                    <input type="hidden" name="" id="realprice" value=<?php echo $value['sub_payment'];?>>
                    <input type="hidden" name="" id="realperiod" value=<?php echo $value['period_num'];?>>
                    <input type="hidden" name="" id="realdate" value=<?php echo $value['sub_period'];?>>
                    <p style="color: #808080; font-weight: bold;">End Date:&nbsp;&nbsp;&nbsp;<span
                            id="subformat"><?php echo $value['sub_period'];?></span></p>
                    <?php }}?>

                    <input type="number" style="margin-top: 2em;" placeholder="Input number of days" id="period"
                        name="period" />

                </div>
            </div>

            <p class="error2">Please fill </p>
            <div class="btn-container">
                <button class="estate_page_button" type="submit">Continue</p></button>
            </div>

            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
                <span class="span">Continue</span>
            </div>
        </form>
    </div>



    <div class="success" style="display:none; padding-left: 4em;">
        <p>We are sorry this land</p>
        <p>is not up to that unit!</p>
        <a href="cartreview.php"><button class="estate_page_button" type="submit">Go Back</button></a>
    </div>




    <div class="second-section" style="display:none;">


        <div class="cost" style="margin-bottom: 2em;">
            <input type="hidden" name="tot" value="" id="tot">
            <p>Total Cost:&nbsp;&nbsp;&nbsp;&#8358;<span id="numformat"></span></p>
        </div>

        <?php 
        foreach($landview as $key => $value){
           
        ?>
        <?php if(($value['outright_price'] != 0) && $value['onemonth_price'] == 0 ){?>
        <form action="" id="outrightform">
            <div class="btn-container">
                <button class="estate_page_button" type="submit">Continue</button>
            </div>
        </form>
        <?php } else if(($value['onemonth_price'] != 0) && $value['outright_price'] == 0){?>



        <div class="fourthsection">
            <form action="" id="submethod-form">

                <div class="payment-plan">
                    <p>Choose Susbcription Plan</p>
                    <label class="radio" for="autodebit">
                        <input type="radio" name="submethod" id="autodebit" value="autodebit" />
                        <span></span>
                        <p>Auto debit</p>
                    </label>
                    <label class="radio" fo="manually">
                        <input type="radio" name="submethod" id="manually" value="manually" />
                        <span></span>
                        <p>Manually</p>
                    </label>
                </div>


                <div class="btn-container">
                    <button class="estate_page_button" type="submit">Continue</button>
                </div>
            </form>

            <div class="manual-mode" style="display:none;">
                <form id="manualform">

                    <p class="error2">Please fill</p>

                    <div style="display: none">
                        <img src="images/loading.svg" alt="" class="loading-img" />
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button" type="submit">Continue</button>
                    </div>
                </form>
            </div>



            <div class="payment-mode" style="display:none; margin-top: 3em;">
                <form action="" id="intervalform">
                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="onemonth" name="mode" value="onemonth" />
                                <label for="onemonth">One Month</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="threemonth" name="mode" value="threemonths" />
                                <label for="threemonth">Three Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="sixmonth" name="mode" value="sixmonths" />
                                <label for="sixmonth">Six Months</label>
                            </div>


                            <div class="option">
                                <input type="radio" class="radio" id="twelvemonth" name="mode" value="twelvemonths" />
                                <label for="twelvemonth">Twelve Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="eighteenmonth" name="mode"
                                    value="eighteenmonths" />
                                <label for="eighteenmonth">Eighteen Months</label>
                            </div>
                        </div>
                        <div class="selected">Payment Plan</div>
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button subbutton" type="submit">Subscribe</button>
                    </div>

                </form>
            </div>


            <div class="payment-mode2" style="display:none; margin-top: 3em;">
                <form action="" id="intervalform2">
                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="onemonth" name="mode" value="onemonth" />
                                <label for="onemonth">One Month</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="threemonth" name="mode" value="threemonths" />
                                <label for="threemonth">Three Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="sixmonth" name="mode" value="sixmonths" />
                                <label for="sixmonth">Six Months</label>
                            </div>


                            <div class="option">
                                <input type="radio" class="radio" id="twelvemonth" name="mode" value="twelvemonths" />
                                <label for="twelvemonth">Twelve Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="eighteenmonth" name="mode"
                                    value="eighteenmonths" />
                                <label for="eighteenmonth">Eighteen Months</label>
                            </div>
                        </div>
                        <div class="selected">Payment Plan</div>
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button subbutton2" type="submit">Subscribe</button>
                    </div>

                </form>
            </div>
        </div>

        <?php }?>



        <?php if($value['onemonth_price'] != 0 && $value['outright_price'] != 0){?>
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




        <div class="fourthsection" style="display: none;">
            <form action="" id="submethod-form">

                <div class="payment-plan">
                    <p>Choose Susbcription Plan</p>
                    <label class="radio" for="autodebit">
                        <input type="radio" name="submethod" id="autodebit" value="autodebit" />
                        <span></span>
                        <p>Auto debit</p>
                    </label>
                    <label class="radio" fo="manually">
                        <input type="radio" name="submethod" id="manually" value="manually" />
                        <span></span>
                        <p>Manually</p>
                    </label>
                </div>


                <div class="btn-container">
                    <button class="estate_page_button" type="submit">Continue</button>
                </div>
            </form>

            <div class="manual-mode" style="display:none;">
                <form id="manualform">

                    <p class="error2">Please fill</p>

                    <div style="display: none">
                        <img src="images/loading.svg" alt="" class="loading-img" />
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button" type="submit">Continue</button>
                    </div>
                </form>
            </div>



            <div class="payment-mode" style="display:none; margin-top: 3em;">
                <form action="" id="intervalform">
                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="onemonth" name="mode" value="onemonth" />
                                <label for="onemonth">One Month</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="threemonth" name="mode" value="threemonths" />
                                <label for="threemonth">Three Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="sixmonth" name="mode" value="sixmonths" />
                                <label for="sixmonth">Six Months</label>
                            </div>


                            <div class="option">
                                <input type="radio" class="radio" id="twelvemonth" name="mode" value="twelvemonths" />
                                <label for="twelvemonth">Twelve Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="eighteenmonth" name="mode"
                                    value="eighteenmonths" />
                                <label for="eighteenmonth">Eighteen Months</label>
                            </div>
                        </div>
                        <div class="selected">Payment Plan</div>
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button subbutton" type="submit">Subscribe</button>
                    </div>

                </form>
            </div>


            <div class="payment-mode2" style="display:none; margin-top: 3em;">
                <form action="" id="intervalform2">
                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="onemonth" name="mode" value="onemonth" />
                                <label for="onemonth">One Month</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="threemonth" name="mode" value="threemonths" />
                                <label for="threemonth">Three Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="sixmonth" name="mode" value="sixmonths" />
                                <label for="sixmonth">Six Months</label>
                            </div>


                            <div class="option">
                                <input type="radio" class="radio" id="twelvemonth" name="mode" value="twelvemonths" />
                                <label for="twelvemonth">Twelve Months</label>
                            </div>

                            <div class="option">
                                <input type="radio" class="radio" id="eighteenmonth" name="mode"
                                    value="eighteenmonths" />
                                <label for="eighteenmonth">Eighteen Months</label>
                            </div>
                        </div>
                        <div class="selected">Payment Plan</div>
                    </div>

                    <div class="btn-container">
                        <button class="estate_page_button subbutton2" type="submit">Subscribe</button>
                    </div>

                </form>
            </div>


        </div>
        <?php }?>
        <?php }?>

    </div>
    <footer class="footerdiv">
        <p>YurLAND &#169; 2022 | All Right Reserved</p>
        <p>A product of Ilu-oba International Limited and Arklips Limited</p>
        <p>Connect with us Facebook, Twitter, Instagram</p>
        <p style="font-size: 30px">
            <i class="ri-instagram-line"></i><i class="ri-facebook-fill"></i><i class="ri-twitter-line"></i>
        </p>
    </footer>
    <script src="js/main.js"></script>
    <script>
    var targetImg = document.querySelector(".main-img");
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
    </script>
    <script>
    let form = document.querySelector("#unit-form");
    let error = document.querySelector(".error");

    let unitInput = document.querySelector("#unit")









    form.onsubmit = (e) => {
        e.preventDefault();
    };



    const params = new URLSearchParams(window.location.search)
    const unique = params.get('id')




    let form1 = document.querySelector('.first-section');
    let form2 = document.querySelector('.second-section');
    let form3 = document.querySelector('.thirdsection');
    let form4 = document.querySelector('.fourthsection');
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
                        if (params.get('payment')) {
                            form1.style.display = "none";
                            form3.style.display = "block";
                        } else {
                            form1.style.display = "none";
                            form2.style.display = "block";
                        }
                        let first = parseInt(unitInput.value);
                        let second = parseInt(unitNum.value);
                        if (first > second) {
                            Successdiv.style.display = "block";
                            form2.innerHTML = Successdiv;
                            if (params.get('payment')) {
                                form3.innerHTML = Successdiv;
                            }
                        }
                        totalInput.value = price;
                        if (params.get('payment')) {
                            let formatnum = document.querySelector('.thirdsection #numformat')
                            formatnum.innerHTML = new Intl.NumberFormat().format(price);
                        } else {
                            let formatnum = document.querySelector('.second-section #numformat')
                            formatnum.innerHTML = new Intl.NumberFormat().format(price);
                        }

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

    unitInput.onblur = () => {
        submitUnits();
    };



    if (params.get('remprice')) {
        form1.style.display = "none";
        form3.style.display = "block";
        formatnum.innerHTML = new Intl.NumberFormat().format(params.get('remprice'));
    }

    if (params.get('payment') && params.get('remprice')) {
        // document.querySelector('.manual-mode').style.display = "block";
        // const manualform = document.querySelector('#manualform');
        // const manualbtn = document.querySelector('#manualform .estate_page_button');
        // manualform.onsubmit = (e) => {
        //     e.preventDefault();
        // }

        // function checkNoOfDays() {
        //     let manualInput = document.querySelector('#period');
        //     let manualNum = parseInt(manualInput.value);
        //     if (manualNum > 540) {
        //         let manualerror = document.querySelector('#manualform .error2');
        //         manualerror.textContent = "Limit Reached";
        //         manualerror.style.visibility = "visible";

        //     } else {
        //         let pricevalue = totalInput.value / manualInput.value;
        //         var periodtime = manualInput.value * 86400000;
        //         var date = new Date().getTime() + periodtime;
        //         let endDate = new Date(date).toDateString();
        //         location.href =
        //             `newpayment.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&newpay=${pricevalue}&period=${endDate}&subperiod=${manualInput.value}`;
        //     }
        // }

        // manualbtn.onclick = () => {
        //     checkNoOfDays();
        // }

        let payInput = document.querySelector("#newpay")
        let remInput = document.querySelector("#remunit")
        const newpayform = document.querySelector('#newpaymentform');
        const newpaybtn = document.querySelector('#newpaymentform .estate_page_button');

        newpayform.onsubmit = (e) => {
            e.preventDefault();
        }

        function checkNewPayment() {
            let error2 = document.querySelector(".error2");

            let periodInput = document.querySelector('#periodunit');
            let manualInput = document.querySelector('#newpaymentform #period');
            let manualNum = parseInt(manualInput.value);
            <?php 
                
                ?>
            let periodNum = document.querySelector('#realperiod');
            let amountNum = document.querySelector('#realprice');
            let dateNum = document.querySelector('#realdate');
            let periodValue = parseInt(periodNum.value);

            let manualerror = document.querySelector('#newpaymentform .error2');
            let pricevalue = amountNum.value * manualInput.value;

            let endDate = dateNum.value;
            if (manualNum > periodValue) {
                manualerror.textContent = "Limit Reached";
                manualerror.style.visibility = "visible";
            } else if (manualInput.value === "") {
                manualerror.textContent = "Please fill in your data";
                manualerror.style.visibility = "visible";
            } else {
                <?php if(isset($_SESSION['unique_id'])){?>
                location.href =
                    `newpayment.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&remunit=${remInput.value}&unit=${remInput.value}&con=9298383737&remprice=payment&period=${endDate}&newpay=${pricevalue}&subperiod=${manualInput.value}`;
                <?php }?>

                <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){?>
                location.href =
                    `newpayment2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&remunit=${remInput.value}&unit=${remInput.value}&con=9298383737&remprice=payment&period=${endDate}&newpay=${pricevalue}&subperiod=${manualInput.value}&user=<?php echo $_GET['unique'];?>`;
                <?php }?>


            }





            //sending the form data to php



        }

        newpaybtn.onclick = () => {
            checkNewPayment();
        }
    }


    const planform = document.querySelector('#paymentplanform');
    const paybtn = document.querySelector('#paymentplanform .estate_page_button');
    planform.onsubmit = (e) => {
        e.preventDefault();
    }



    function checkOutrMode() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;


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



    <?php if($value['onemonth_price'] != 0 && $value['outright_price'] != 0){?>
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
                        <?php if(isset($_SESSION['unique_id'])){?>
                        let startDate = new Date().toDateString();
                        location.href =
                            `outrightpayment.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9298383737&startdate=${startDate}`;
                        <?php }?>
                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){?>
                        location.href =
                            `outrightpayment2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique'];?>`;
                        <?php }?>
                    }
                    if (data == "subscription payment") {
                        paybtn.style.display = "none";
                        document.querySelector('#paymentplanform').style.display = "none";
                        form4.style.display = "block";
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


    const submethodform = document.querySelector('#submethod-form');
    const submethodbtn = document.querySelector('#submethod-form .estate_page_button');
    submethodform.onsubmit = (e) => {
        e.preventDefault();
    }



    function checkSubMethod() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getsubplan.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "autodebit") {
                        submethodform.style.display = "none";
                        document.querySelector('.payment-mode').style.display = "block";
                    }
                    if (data == "manually") {
                        submethodform.style.display = "none";
                        document.querySelector('.payment-mode2').style.display = "block";
                        //                     location.href =
                        // `newpayment.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&newpay=${payInput.value}&con=9298383737`;+
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(submethodform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    submethodbtn.onclick = () => {
        checkSubMethod();
    }



    const intervalform = document.querySelector('#intervalform');
    const payedbtn = document.querySelector('.subbutton');
    intervalform.onsubmit = (e) => {
        e.preventDefault();
    }

    function checkInterval() {
        let payInput = document.querySelector("#newpay")
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getdata.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    //console.log(data);
                    if (data) {
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `intervalnum.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){?>
                        location.href =
                            `intervalnum2.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique'];?>`;
                        <?php }?>
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(intervalform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    payedbtn.onclick = () => {
        checkInterval();
    }


    const intervalform2 = document.querySelector('#intervalform2');
    const payedbtn2 = document.querySelector('.subbutton2');
    intervalform2.onsubmit = (e) => {
        e.preventDefault();
    }

    function checkInterval2() {
        // let payInput2 = document.querySelector("#newpay")
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getdata.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    //console.log(data);
                    if (data) {
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `newpayment.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){?>
                        location.href =
                            `newpayment2.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique']?>`;
                        <?php }?>
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(intervalform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    payedbtn2.onclick = () => {
        checkInterval2();
    }



    <?php }?>


    <?php if(($value['onemonth_price'] != 0) && $value['outright_price'] == 0){?>
    const submethodform = document.querySelector('#submethod-form');
    const submethodbtn = document.querySelector('#submethod-form .estate_page_button');
    submethodform.onsubmit = (e) => {
        e.preventDefault();
    }



    function checkSubMethod() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getsubplan.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "autodebit") {
                        submethodform.style.display = "none";
                        document.querySelector('.payment-mode').style.display = "block";
                    }
                    if (data == "manually") {
                        submethodform.style.display = "none";
                        document.querySelector('.payment-mode2').style.display = "block";
                        //                     location.href =
                        // `newpayment.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unitInput.value}&newpay=${payInput.value}&con=9298383737`;+
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(submethodform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    submethodbtn.onclick = () => {
        checkSubMethod();
    }

    const intervalform = document.querySelector('#intervalform');
    const payedbtn = document.querySelector('.subbutton');
    intervalform.onsubmit = (e) => {
        e.preventDefault();
    }

    function checkInterval() {
        let payInput = document.querySelector("#newpay")
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getdata.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    //console.log(data);
                    if (data) {
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `intervalnum.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){?>
                        location.href =
                            `intervalnum2.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique'];?>`;
                        <?php }?>
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(intervalform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    payedbtn.onclick = () => {
        checkInterval();
    }


    const intervalform2 = document.querySelector('#intervalform2');
    const payedbtn2 = document.querySelector('.subbutton2');
    intervalform2.onsubmit = (e) => {
        e.preventDefault();
    }

    function checkInterval2() {
        // let payInput2 = document.querySelector("#newpay")
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getdata.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    //console.log(data);
                    if (data) {
                        <?php if(isset($_SESSION['unique_id'])){?>
                        location.href =
                            `newpayment.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737`;
                        <?php }?>

                        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id'])){?>
                        location.href =
                            `newpayment2.php?data=${data}&uniqueid=${unique}&tech=91938udjd992992929&tot=${totalInput.value}&pice=029283837iiagj098655454&unit=${unitInput.value}&con=9298383737&user=<?php echo $_GET['unique']?>`;
                        <?php }?>
                    }

                }
            }
        }
        // we have to send the information through ajax to php
        let formData = new FormData(intervalform); //creating new formData Object

        xhr.send(formData); //sending the form data to php
    }

    payedbtn2.onclick = () => {
        checkInterval2();
    }



    <?php }?>








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