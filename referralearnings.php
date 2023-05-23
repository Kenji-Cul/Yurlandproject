<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['unique_id'])){
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
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    .profile-body {
        height: 110vh;
        position: relative;
        overflow-x: hidden;
    }

    .search-input2 input {
        position: unset;
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
    }

    .account-detail2 {
        padding-bottom: 2em;
        padding-top: 2em;
    }

    .payee {
        width: 350px;
    }

    .payee {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
    }

    .payee-tag {
        text-transform: capitalize !important;
    }

    .footerdiv {
        position: absolute;
        bottom: 0;
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

    .empty-img {
        width: 100%;
        height: 100%;
        border-radius: 8px;
    }


    .success {
        position: absolute;
        left: 50%;
        top: 45em;
        transform: translate(-50%, -50%);
        height: 20%;
    }

    .success img {
        width: 15em;
        height: 15em;
    }


    .account-detail2 {
        position: relative;
    }

    .account-detail2 .flex {
        position: absolute;
        left: 90px;
    }

    .account-detail3 {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 3em;
    }

    .account-detail3 p {
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 22px;
        text-align: center;
        color: #eb5757;
    }

    @media only screen and (min-width: 1300px) {
        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
        }

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





        .center {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .menu {
            display: none;
        }

        .land-estate {
            border: 1px solid #d4d1d1;
            width: 320px;
            height: 290px;
            padding-top: 8px;
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
        }

        .dropdown-links .links img {
            width: 20px;
            height: 20px;
            margin-right: 6px;
            cursor: pointer;
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

        .dropdown-links .links .link {
            visibility: hidden;
            display: none;
        }


        .dropdown-links li a {
            color: #fff;

        }

        .transaction-details {
            width: 80%;
        }


        .flex-container {
            display: flex;
            flex-direction: row;
            position: relative;
            padding-top: 2em;
            height: 70vh;
        }

        .estates {
            padding-top: 6em;
            position: absolute;
            left: 3em;
            padding: 0;
            width: 93%;
            transition: all 0.5s;
            margin-top: 6em;
        }

        .profile-container {
            position: absolute;
            left: 5em;
            padding: 0;
            width: 93%;
            transition: all 0.5s;
        }

        .close {
            display: none;
        }



    }

    @media only screen and (max-width: 1300px) {

        .payment-image-div2 {
            display: grid;
            width: 100%;
            margin: 0 auto;
            align-items: center;
            justify-content: center;
        }

        .success {
            position: absolute;
            top: 40em;
        }

        .payee {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0 !important;
            width: 280px;
            position: relative;
        }

        .payee .payee-tag {
            width: 35%;
            font-size: 11px;
        }

        .payee .payee-name {
            width: 65%;
            font-size: 11px;
        }

        body {
            height: 90vh;
        }

        .account-detail2 .flex {
            position: absolute;
            left: 10px;
        }




        .user,
        #openicon {
            display: none;
        }

        .links img {
            display: none;
        }



        .land_estate_container {
            display: flex;
            flex-direction: row;
            gap: 1em;
        }


        .profile-div-container {
            margin: auto;
            width: 100%;
        }



        .dropdown-links {
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
            background: #7e252b;
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

        .land-estate {
            width: 290px;
        }



        .close {
            position: absolute;
            top: 4em;
            right: 1em;
        }


        .update-data {
            position: absolute;
            top: -3em;
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
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
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
            <li class="links select-link">
                <a href="userreferral.php"><img src="images/referral.svg" /></a>
                <a href="userreferral.php" class="link">Referral</a>
            </li>
            <li class="links">
                <a href="documents.php"><img src="images/folder.svg" /></a>
                <a href="documents.php" class="link">Documentation</a>
            </li>
            <li class="links">
                <a href="profiledetails.php"><img src="images/settings.svg" /></a>
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



        <div class="profile-container">
            <div class="page-title2">
                <a href="userreferral.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Referral Earnings</p>
            </div>

            <div style="display: flex; align-items: center; justify-content: left;">
                <div class="payment-image-div2">
                    <div>
                        <img src="images/image1.svg" alt="payment image" />
                        <div class="payment-desc">
                            <p style="width: 80%;">Total Paid Earnings</p>
                            <div class="payment-count">
                                &#8358;<span><?php 
                        $user = new User;
                        $unitprice2 = $user->selectAgentTotalPaidEarnings($newuser['unique_id']);
                        if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
                            echo number_format(round($unitprice2));
                          } else {
                              echo round($unitprice2);
                          }
                        
                       
                        ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="payment-image-div2">
                    <div>
                        <img src="images/image1.svg" alt="payment image" />
                        <div class="payment-desc">
                            <p style="width: 80%;">Total Pending Earnings</p>
                            <div class="payment-count">
                                &#8358;<span><?php 
                        $user = new User;
                        $unitprice2 = $user->selectAgentTotalPendingEarnings($newuser['unique_id']);
                        if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
                            echo number_format(round($unitprice2));
                          } else {
                              echo round($unitprice2);
                          }
                        
                       
                        ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="search-container">
                <div class="select-box">
                    <div class="options-container">

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode4" name="searchmode" value="Pending" />
                            <label for="searchmode4">Pending</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="searchmode5" name="searchmode" value="Paid" />
                            <label for="searchmode5">Paid</label>
                        </div>
                    </div>

                    <div class="selected">Choose Search Mode</div>

                </div>


                <div class="search-input2">
                    <form action="" class="dropdown-form">
                        <div class="valuediv2" style="display: none;"></div>
                    </form>
                </div>




            </div>




            <div class="details-container">


                <?php 
  
            $earning = $user->selectAgentHistory($newuser['unique_id']);
            if(!empty($earning)){
                foreach($earning as $key => $value){
    ?>

                <div class="account-detail2"
                    style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
                    <div class="flex">
                        <p style="text-transform: capitalize;"><span>Hello <?php echo $value['earnee'];?></span>
                        </p>
                        <p style="text-transform: uppercase;">
                            <span style="color: #000000!important; font-size: 16px;">You have earned &#8358;<?php 
                    $earnedprice = $value['earned_amount'];
                    $unitprice = $earnedprice;
                    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                                      echo number_format(round($unitprice));
                                    } else {
                                        echo round($unitprice);
                                    }
                    ?>
                            </span>
                        </p>
                        <div class="payee">
                            <p class="payee-tag" style="color: #808080;">
                                <?php if($value['payee'] == $value['earnee']){ 
                                echo "You Paid:"; 
                            } else {
                                    echo "Customer Paid:"; }
                                 ?></p>&nbsp;
                            <p class="payee-name"
                                style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                                &#8358;<?php $unitprice = $value['product_price']; 
                                  if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                                    echo number_format(round($unitprice));
                                  } else {
                                      echo round($unitprice);
                                  }
                                ?> for <?php echo $value['product_name'];?>
                            </p>
                        </div>
                        <div class="inner-detail">
                            <div class="date">
                                <span style="font-size: 13px;"><?php echo $value['payment_date'];?></span>
                            </div>
                        </div>
                        <?php 
                        if($value['balance_earning'] != ""){
                        if($value['earning_status'] == "unpaid"){?>
                        <div class="detail-four">
                            <div class="detail"
                                style="width: 100px; height: 20px; background-color: blue; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <p style="font-size: 14px; color: #fff; text-transform:capitalize;">Pending</p>
                            </div>
                        </div>
                        <?php }?>

                        <?php if($value['balance_earning'] == 0 && $value['earning_status'] == "paid"){?>
                        <div class="detail-four">
                            <div class="detail"
                                style="width: 100px; height: 20px; background-color: green; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <p style="font-size: 14px; color: #fff; text-transform:capitalize;">Paid</p>
                            </div>
                        </div>
                        <?php }}?>
                    </div>
                </div>
                <?php } }?>



                <?php if(empty($earning)){?>
                <div class="success">
                    <img src="images/asset_success.svg" alt="" />
                    <p>You have no earnings yet!</p>
                </div>
                <?php }?>

                <div class="account-detail3">
                    <a href="logout.php">
                        <p>Sign Out</p>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <script src="js/cart.js"></script>
    <script src="js/main.js"></script>
    <script>
    //searchinput.style.display = "flex";
    //document.querySelector('#searchimg').style.display = "none";
    let valuediv2 = document.querySelector('.valuediv2');

    let searchform4 = document.querySelector('.dropdown-form');
    let purpose1 = document.querySelector("#searchmode4");
    let purpose3 = document.querySelector("#searchmode5");
    let purposearray = [purpose1, purpose3];
    document.querySelector('.dropdown-form').style.display = "block";
    purposearray.forEach((element) => {
        element.onclick = () => {
            valuediv2.innerHTML = element.value;
            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchstatus.php?data=${valuediv2.innerHTML}&user=customeruser&customeruser=<?php echo $_SESSION['unique_id'];?>`
            );

            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        document.querySelector('.details-container').innerHTML = data;

                    }
                }
            };
            let formData = new FormData(searchform4);
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
            document.querySelector(".profile-container").style = `
         padding-left: 7em;
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
            document.querySelector(".profile-container").style = `
         padding-left: 1em;
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