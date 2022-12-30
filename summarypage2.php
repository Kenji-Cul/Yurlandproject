<?php 
if(!isset($_GET['uniqueid']) || !isset($_GET['tot']) || !isset($_GET['unit'])){
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
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    .success {
        position: absolute;
        left: 50%;
        top: 40%;
        transform: translate(-50%, -50%);
        height: 10em;
    }

    .success img {
        width: 25em;
        height: 25em;
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

    <?php 
    $land = new User;
    $landview = $land->selectLandImage($_GET['uniqueid']);
    if(!empty($landview)){
        foreach($landview as $key => $value){ 
    ?>

    <?php if($_GET['unit'] > $value['product_unit']){ ?>
    <div class="success">
        <img src="images/asset_success.svg" alt="" />
        <p>We are sorry this land</p>
        <p>is not up to that unit!</p>
    </div>

    <?php } else {?>
    <div class="page-title4">
        <div>
            <img src="images/orange-cart-icon.svg" alt="" />
        </div>
        <p>Summary</p>
    </div>




    <div class="image-desc">
        <img src="landimage/<?php echo $value['product_image'];?>" alt="" />
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

        <div class="cost">
            <p>Total Cost:&nbsp;&nbsp;&nbsp;<span>&#8358;<?php 
             $unitprice = $_GET['tot'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }
            ?></span></p>
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
    </div>


    <div class="btn-container">
        <button class="estate_page_button" type="submit">Continue</button>
    </div>

    </form>
    <?php }}}?>





    <script src="js/main.js"></script>
    <script>
    const planform = document.querySelector('#paymentplanform');
    const paybtn = document.querySelector('.estate_page_button');
    planform.onsubmit = (e) => {
        e.preventDefault();
    }

    const params = new URLSearchParams(window.location.search)
    const unique = params.get('uniqueid')
    const unit = params.get('unit')
    const total = params.get('tot')

    function checkPaymentMode() {
        let xhr = new XMLHttpRequest(); //creating XML Object
        xhr.open("POST", "getplan.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == "outright payment") {
                        location.href =
                            `outrightpayment2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${total}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unit}&con=9298383737`;
                    }
                    if (data == "subscription payment") {
                        location.href =
                            `subpayment2.php?uniqueid=${unique}&tech=91938udjd992992929&tot=${total}&pice=029283837iiagjfauhuiyipalaknlnf&unit=${unit}&con=judu8272626`;
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