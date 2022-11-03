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
            <a href="index.html"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
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

    <div class="image-desc">
        <img src="images/estate3.jpg" alt="" />
    </div>

    <div class="price-desc">
        <div>
            <div class="land-name">
                <p>Isinmi Eko</p>
            </div>
            <div class="land-location">
                <p>Epe,Lagos</p>
            </div>
        </div>

        <?php if($_GET['data'] == "daily"){?>
        <div class="input-div">
            <label for="day">Daily</label>
            <input type="number" id="day" placeholder="Input number of days" />
        </div>
        <?php }?>


        <?php if($_GET['data'] == "weekly"){?>
        <div class="input-div">
            <label for="week">Weekly</label>
            <input type="number" id="week" placeholder="Input number of weeks" />
        </div>
        <?php }?>

        <?php if($_GET['data'] == "monthly"){?>
        <div class="input-div">
            <label for="month">Monthly</label>
            <input type="number" id="month" placeholder="Input number of months" />
        </div>
        <?php }?>

        <?php if($_GET['data'] == "annually"){?>
        <div class="input-div">
            <label for="annual">Annually</label>
            <input type="number" id="annual" placeholder="Input number of years" />
        </div>
        <?php }?>


        <div class="btn-container">
            <a href=""><button class="estate_page_button">Pay</button></a>
        </div>

        <script src="js/main.js"></script>
</body>

</html>