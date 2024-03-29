<?php 
session_start();
include "projectlog.php";
if(!isset($_SESSION['unique_id'])){
    header("Location: login.php");
}
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
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    .profile-body {
        height: 120vh;
        overflow-x: hidden;
    }

    .detail3 {
        width: 140px !important;
        position: relative;
    }

    .search-form,
    .search-form2,
    .search-form3,
    .dropdown-form {
        display: none;
    }

    .search-container {
        display: flex;
        justify-content: left;
        flex-direction: column;
        padding-left: 5%;
        padding-top: 2em;
        position: unset;
        gap: 2em;
    }

    .search-container .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
        width: 240px;
    }

    .search-input2 input {
        padding: 0.8em 4em;
        outline: none;
        background-color: #cac6c6;
        border: 1px solid #808080;
        border-radius: 8px;
        border: 2px solid #ff6600;
        margin-bottom: 1em;
    }




    .detail3 {
        width: 100px !important;
        text-overflow: ellipsis !important;
        overflow: hidden;
        white-space: nowrap;
    }

    .transaction-details2 {
        border-radius: 8px;
        /* border: 2px solid black; */
        padding: 1em 2em;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
        width: 90%;
    }

    header {
        background: #fee1e3;
    }

    .success {
        position: absolute;
        top: 28em;
        width: 90%;
    }

    .success img {
        width: 25em;
        height: 20em;
    }


    .no-lands {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: top;
        flex-direction: column;
    }

    .navigation-div .offer {
        background: #ffffff;
        box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.12);
        border-radius: 8px;
        text-align: center;
        color: var(--secondary-color);
        width: 150px;
        padding: 0.3em 0.3em;
    }

    a {
        text-decoration: none;
        color: #1a0709;
    }

    .radius {
        position: relative;
    }

    .radius img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .no-lands p {
        font-style: normal;
        font-weight: 600;
        font-size: 24px;
        color: #1a0709;
    }

    .no-lands img {
        margin-top: 8em;
        width: 30em;
        height: 30em;
    }

    @media only screen and (max-width: 1300px) {

        .transaction-details2 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
        }


        .transaction-details2 {
            border-radius: 8px;
            /* border: 2px solid black; */
            padding: 1em 2em;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            width: 80%;
        }

        .transaction-details2 .date {
            font-size: 11px !important;
        }

        .navigation-div .offer {
            background: #ffffff;
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.12);
            border-radius: 8px;
            text-align: center;
            color: var(--secondary-color);
            width: 100px;
            padding: 0.3em 0.3em;
        }

        .navig .offer,
        .navig .payment,
        .navig .allocation {
            font-size: 12px;
        }

        .details-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .success {
            position: absolute;
            top: 35em;
            height: 10em;
            width: 100%;
        }

        .success img {
            width: 20em;
            height: 20em;
        }

        .success p {
            text-align: center;
        }

        .user,
        #openicon {
            display: none;
        }

        .links img {
            display: none;
        }

        .detail3 {
            display: none;
        }

        .dropdown-links {
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
            transform: translateX(100%);
            transition: all 1s;
            width: 40%;
            position: fixed;
            bottom: 0;
            border-radius: 8px 0px 0px 8px;
        }

        .dropdown-links li {
            height: 1em;
            grid-gap: 0;
        }
    }

    @media only screen and (min-width: 1300px) {
        .page-title2 a {
            display: none;
        }

        .page-title2 {
            justify-content: left;
        }

        .page-title2 p {
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            color: #1A0709;
        }

        .center {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .menu {
            display: none;
        }

        .profile-image2 {
            display: none !important;
        }

        .user {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1em;
        }

        .user p {
            font-weight: 600;
            font-size: 20px;
            color: #1A0709;
        }

        .user .profile-image {
            width: 45px;
            height: 45px;
        }



        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
        }

        .details2 {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6em;
        }

        .details2 p {
            color: #808080;
        }

        .details2 p,
        .details2 h3 {
            font-size: 22px;
        }

        .land-btn-container {
            padding-left: 1em;
        }

        .land-btn-container .btn {
            width: 500px;
        }

        .menu {
            display: none;
        }

        .estate2 {
            display: block !important;
        }

        .land-estate {
            background: #FFFFFF;
            border-radius: 8px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            width: 290px;
            height: 270px;
            padding-top: 0;
            padding-bottom: 10px;
            display: flex;
            justify-content: top;
            align-items: center;
            gap: 1em;
            flex-direction: column;
            border-radius: 8px;
            margin-bottom: 1.6em;
        }

        .dropdown-links {
            width: 6%;
            height: 90vh;
            border-radius: 0px !important;
            padding: 1em 0;
            display: flex;
            flex-direction: column;
            justify-content: top;
            align-items: top;
            gap: 1.3em;
            background: #7e252b;
            filter: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999999 !important;
            transition: all 0.7s;
        }

        .dropdown-links li {
            height: 1em;
            width: 95%;
            text-transform: capitalize;
            font-size: 14px;
        }

        .dropdown-links .select-link {
            background-color: #1a0709;
        }

        .dropdown-links .links {
            width: 100%;
            display: flex !important;
            align-items: center;
            justify-content: center;
            padding: 1em 0;
            transition: 1s;
        }

        .dropdown-links .links:hover {
            background-color: #1a0709;
        }

        .dropdown-links .links img {
            width: 20px;
            height: 20px;
            margin-right: 6px;
            cursor: pointer;
        }

        .dropdown-links .links .link {
            visibility: hidden;
            display: none;
        }


        .dropdown-links li a {
            color: #fff;

        }

        .transaction-details {
            width: 80%;
            transition: all 1.5s;
        }


        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
        }

        .doc-container {
            width: 90%;
            padding-left: 5em;
        }


        .close {
            display: none;
        }


    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['unique_id'])){?>
            <a href="profile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php 
             $user = new User;
             $newuser = $user->selectUser($_SESSION['unique_id']);
            ?>
        <div class="nav">
            <a href="cartreview.php">
                <div class="cart">
                    <div class="cart-notify"></div>
                    <img src="images/cart.svg" alt="cart icon" />
                </div>
            </a>
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <div class="user">
                <p><?php if(isset($newuser['first_name'])){  ?>
                    <span><?php echo $newuser['first_name']; ?></span>&nbsp;<span><?php echo $newuser['last_name']; ?></span>
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['photo'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['photo'])){?>
                    <a href="updatedetails.php" style="color: #808080;">
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                    </a>
                    <?php }?>
                </div>
            </div>
        </div>
    </header>


    <div class="flex-container">
        <ul class="dropdown-links">
            <div class="center">
                <li id="openicon" style="cursor: pointer;">
                    <img src="images/openmenu.svg" />
                </li>

                <li id="closeicon" style="display: none; cursor: pointer; font-size:14px;">
                    <img src="images/openmenu.svg" />
                </li>
            </div>
            <li class="close">
                <img src="images/close2.svg" style="width: 30px; height: 30px; position: absolute; right: 2em;" />
            </li>
            <li class="links">
                <a href="profile.php"><img src="images/home3.svg" /></a>
                <a href="profile.php" class="link">Home</a>
            </li>
            <li class="links">
                <a href="allestates.php"><img src="images/land2.svg" /></a>
                <a href="allestates.php" class="link">New Land</a>
            </li>
            <li class="links">
                <a href="transactions.php"><img src="images/updown.svg" /> </a>
                <a href="transactions.php" class="link">Transaction History</a>
            </li>
            <li class="links">
                <a href="mylands.php"><img src="images/land2.svg" /></a>
                <a href="mylands.php" class="link">My Land</a>
            </li>
            <li class="links">
                <a href="mylands.php"><img src="images/chart2.svg" /> </a>
                <a href="mylands.php" class="link">New Payment</a>
            </li>
            <li class="links">
                <a href="userreferral.php"><img src="images/referral.svg" /></a>
                <a href="userreferral.php" class="link">Referral</a>
            </li>
            <li class="links select-link">
                <a href="documents.php"><img src="images/folder.svg" /></a>
                <a href="documents.php" class="link">Documentation</a>
            </li>
            <li class="links">
                <a href="settings.php"><img src="images/settings.svg" /></a>
                <div>
                    <a href="profiledetails.php" class="link">Profile&nbsp;<span style="color: #808080;">and</span></a>
                    <a href="settings.php" class="link">Settings</a>
                </div>
            </li>
            <li class="links">
                <a href="logout.php"><img src="images/exit.svg" /></a>
                <a href="logout.php" class="link">Logout</a>
            </li>
        </ul>


        <div class="doc-container">
            <div class="page-title2">
                <a href="profile.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Documents</p>
            </div>

            <!-- <div class="no-lands">
        <img src="images/asset_success.svg" alt="success image" />
        <p>You have not uploaded any document yet!!</p>
    </div> -->

            <div class="navigation-div">
                <div class="navig">
                    <div class="offer">Offer letter</div>
                    <a href="paymentreceipt.php">
                        <div class="payment">Payment Receipt</div>
                    </a>
                    <a href="allocation.php">
                        <div class="allocation">Allocation letter</div>
                    </a>
                </div>
            </div>

            <div class="search-container">

                <div class="select-box">
                    <div class="options-container">
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode1" name="searchmode" value="Land" />
                            <label for="searchmode1">By Land</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode2" name="searchmode" value="Date" />
                            <label for="searchmode2">By Date</label>
                        </div>

                    </div>

                    <div class="selected">Choose Search Mode</div>


                </div>


                <div class="search-input2">
                    <form action="" class="search-form3">
                        <input type="text" class="search2" type="search" name="searchproduct2"
                            placeholder="Search By Land">
                    </form>
                </div>


                <form action="" class="search-form2">
                    <div class="select-box">
                        <div class="options-container">
                            <?php 
$lastsevendays = date('M-d-Y', strtotime('today - 7 days'));
$today = date('M-d-Y', strtotime('today'));
$dates = [];
for ($i = 0; $i < 31; $i++) { 

?>
                            <div class="option">
                                <input type="radio" class="radio" id="date<?php echo $i;?>" name="searchproduct3"
                                    value="<?php echo date('M-d-Y', strtotime('today - '.$i.'days'));?>" />
                                <label
                                    for="date<?php echo $i;?>"><?php echo date('M-d-Y', strtotime('today - '.$i.'days'));?></label>
                            </div>
                            <?php }?>
                        </div>

                        <div class="selected">Choose Date</div>

                    </div>
                    <div class="valuediv" style="display: none;"></div>
                </form>




            </div>


            <div class="details-container">
                <?php 
             $land = new User;
             $landview = $land->selectOfferLetter($_SESSION['unique_id']);
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
            ?>
                <div class="transaction-details2">
                    <div class="radius">
                        <img src="landimage/<?php echo $value['product_image'];?>" alt="">
                    </div>
                    <div class="details">
                        <p class="pname"><?php echo $value['product_name'];?></p>
                        <div class="inner-detail">
                            <div class="date" style="font-size: 12px;">
                                <span><?php echo $value['payment_month'];?></span>&nbsp;<span><?php echo $value['payment_day'];?></span>,<span><?php echo $value['payment_year'];?></span>,<span><?php echo $value['payment_time'];?></span>
                            </div>
                        </div>
                    </div>
                    <div class="price-detail detail3"><?php 
            if($value['product_unit'] == "1"){
                echo $value['product_unit']." Unit";
            } else {
                echo $value['product_unit']." Units";
            }
        ?>
                    </div>
                    <div class="price-detail detail3"><?php 
            echo $value['offer_letter'];
            ?></div>
                    <div class="price-detail">

                        <a href="userdocuments/<?php echo $value['offer_letter'];?>">
                            <button class="btn land-btn" style="width: 70px; margin-top: 0;"><i class="ri-download-line"
                                    id="export"></i></button>
                        </a>

                        </p>
                    </div>
                </div>




                <?php }}?>

                <?php if(empty($landview)){?>
                <div class="success">
                    <img src="images/whoops.svg" alt="" />
                    <p>Whoops You don't have offer letters yet</p>
                </div>
                <?php }?>
            </div>

        </div>
    </div>

    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>
    <script>
    let purpose4 = document.getElementsByName("searchmode");

    purpose4.forEach((element) => {
        element.onclick = () => {
            if (element.value == "Land") {
                document.querySelector('.search-form3').style.display = "block";
                document.querySelector('.search-form2').style.display = "none";

            }
            if (element.value == "Date") {
                document.querySelector('.search-form2').style.display = "block";
                document.querySelector('.search-form3').style.display = "none";

            }

        }
    });
    //let searchIcon = document.querySelector('.search-icon');

    //let searchinput = document.querySelector('.search-input2');
    let searchinput3 = document.querySelector('.search2');

    //searchinput.style.display = "flex";
    //document.querySelector('#searchimg').style.display = "none";
    let searchform2 = document.querySelector('.search-form3');
    let searchform3 = document.querySelector('.search-form2');


    searchform2.onsubmit = (e) => {
        e.preventDefault();
    }

    searchform3.onsubmit = (e) => {
        e.preventDefault();
    }





    searchinput3.onkeyup = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST",
            `searchbyland.php?user=documentuser&unique=<?php echo $_SESSION['unique_id'];?>`);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    document.querySelector('.details-container').innerHTML = data;
                }
            }
        };
        let formData = new FormData(searchform2);
        xhr.send(formData);
    }


    let valuediv = document.querySelector('.valuediv');

    let purpose = document.getElementsByName("searchproduct3");
    purpose.forEach((element) => {
        element.onclick = () => {
            valuediv.innerHTML = element.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchbydate.php?data=${valuediv.innerHTML}&user=documentuser&unique=<?php echo $_SESSION['unique_id'];?>`
            );

            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        document.querySelector('.details-container').innerHTML = data;

                    }
                }
            };
            let formData = new FormData(searchform3);
            xhr.send(formData);
        }

    });
    if (window.innerWidth > 1200) {
        let dropdownnav = document.querySelector(".dropdown-links");
        let open = document.querySelector('#openicon');
        let closeicon = document.querySelector('#closeicon');
        open.onclick = () => {
            dropdownnav.style = `
        width: 14%;
        `;
            open.style.display = "none";
            closeicon.style.display = "block";
            document.querySelector(".doc-container").style = `
         padding-left: 13em;
        `;
            let allLinks = document.querySelectorAll(".dropdown-links .links .link");

            let allLink = document.querySelectorAll(".dropdown-links .links");
            allLink.forEach((element) => {
                element.style = `
        gap: 10px;
        `;

            });
            allLinks.forEach((element) => {
                element.style = `
         visibility: visible;
         display: block;
        `;
            });
        }

        closeicon.onclick = () => {
            dropdownnav.style = `
        width: 6%;
        `;
            open.style.display = "block";
            closeicon.style.display = "none";
            document.querySelector(".doc-container").style = `
         padding-left: 5em;
        `;

            let allLink = document.querySelectorAll(".dropdown-links .links");
            allLink.forEach((element) => {
                element.style = `
        justify-content: center
        `;
            });

            let allLinks = document.querySelectorAll(".dropdown-links .links .link");
            allLinks.forEach((element) => {
                element.style = `
         visibility: hidden;
         display:none;
        `;
            });
        }
    }

    if (window.innerWidth < 1300) {
        let dropdownnav = document.querySelector(".dropdown-links");
        let menu = document.querySelector(".menu");
        menu.onclick = () => {
            dropdownnav.style = `
            transform: translateX(0);
            `;
        };

        let close = document.querySelector(".close");
        close.onclick = () => {
            dropdownnav.style = `
            transform: translateX(100%);
            `;
        };
    }
    </script>
</body>

</html>