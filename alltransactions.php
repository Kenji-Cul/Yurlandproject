<?php 
session_start();
include "projectlog.php";
if(!isset($_SESSION['uniqueagent_id'])){
    header("Location: portallogin.php");
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
    body {
        min-height: 100vh;
        position: relative;
    }


    header {
        background: #fee1e3;
    }

    .details {
        width: 160px !important;
        position: relative;
    }

    .details .pname {
        width: 100px !important;
        text-overflow: ellipsis !important;
        overflow: hidden;
        white-space: nowrap;
    }

    .payee {
        width: 130px;
        display: flex;
        flex-direction: row;
        gap: 0 !important;
        position: relative;
        height: 20px;
    }

    .payee .payee-name {
        text-overflow: ellipsis !important;
        overflow: hidden;
        white-space: nowrap;
        font-size: 13px;
        color: #808080;
        width: 59%;
    }

    .payee .payee-tag {
        width: 41%;
        font-size: 13px;
    }

    .no-lands {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: top;
        flex-direction: column;
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

    .success {
        position: absolute;
        left: 50%;
        top: 40em;
        transform: translate(-50%, -50%);
        height: 10em;
        width: 90%;
    }

    .success img {
        width: 36em;
        height: 36em;
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

    .transaction-details {
        border-radius: 8px;
        /* border: 2px solid black; */
        padding: 1em 2em;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
        width: 90%;
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
    }



    @media only screen and (max-width: 1300px) {

        .details .date {
            font-size: 9px !important;
        }

        .success {
            position: absolute;
            top: 40em;
        }

        .payee {
            width: 100px;
            display: flex;
            flex-direction: row;
            gap: 0 !important;
            position: relative;
            height: 20px;
        }

        .payee .payee-name {
            text-overflow: ellipsis !important;
            overflow: hidden;
            white-space: nowrap;
            font-size: 12px;
            color: #808080;
            width: 50%;
        }

        .payee .payee-tag {
            width: 50%;
            font-size: 12px;
        }

        .profile-body {
            height: 40vh;
        }

        .transaction-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
        }

        .details .pname {
            font-size: 13px;
        }

        .transaction-details {
            border-radius: 8px;
            /* border: 2px solid black; */
            padding: 1em 2em;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            width: 85%;
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
            height: 100vh;
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

        .close {
            position: absolute;
            top: 6em;
            right: 1em;
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

        .trans-container {
            width: 90%;
            padding-left: 5em;
        }


        .close {
            display: none;
        }


    }



    @media only screen and (max-width: 700px) {
        .transaction-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
        }

        .success {
            position: absolute;
            left: 50%;
            top: 40em;
            transform: translate(-50%, -50%);
            height: 10em;
        }

        .success p {
            text-align: center;
        }


        .success img {
            width: 15em;
            height: 15em;
        }

        .detail3 {
            display: none;
        }
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <a href="agentprofile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>

        <?php 
             $user = new User;
             $newuser = $user->selectAgent($_SESSION['uniqueagent_id']);
            ?>

        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <div class="user">
                <p><?php if(isset($newuser['agent_name'])){  ?>
                    <span><?php echo $newuser['agent_name']; ?></span>&nbsp;
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['agent_img'])){?>
                    <a href="agentprofileinfo.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['agent_img'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['agent_img'])){?>
                    <a href="agentprofileinfo.php" style="color: #808080;">
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
                <a href="agentprofile.php"><img src="images/home3.svg" /></a>
                <a href="agentprofile.php" class="link">Home</a>
            </li>

            <li class="links">
                <a href="usertype.php"><img src="images/land2.svg" /></a>
                <a href="usertype.php" class="link">New Land</a>
            </li>

            <li class="links">
                <a href="allestates3.php"><img src="images/land2.svg" /></a>
                <a href="allestates3.php" class="link">All Estates</a>
            </li>
            <li class="links">
                <a href="mycustomers.php"><img src="images/referral.svg" /></a>
                <a href="mycustomers.php" class="link">Customers</a>
            </li>
            <li class="links">
                <a href="newcustomer.php"><img src="images/referral.svg" /> </a>
                <a href="newcustomer.php" class="link">New Customer</a>
            </li>
            <li class="links">
                <a href="referral.php"><img src="images/chart2.svg" /></a>
                <a href="referral.php" class="link">Referrals</a>
            </li>

            <li class="links select-link">
                <a href="alltransactions.php"><img src="images/updown.svg" /></a>
                <a href="alltransactions.php" class="link">View Transactions</a>
            </li>

            <li class="links">
                <a href="agentprofileinfo.php"><img src="images/settings.svg" /></a>
                <a href="agentprofileinfo.php" class="link">Profile</a>
            </li>
            <li class="links">
                <a href="agentlogout.php"><img src="images/exit.svg" /></a>
                <a href="agentlogout.php" class="link">Logout</a>
            </li>
        </ul>





        <div class="trans-container">
            <div class="page-title2">
                <a href="agentprofile.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Transactions</p>
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

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode3" name="searchmode" value="Payer" />
                            <label for="searchmode3">By Payer</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode4" name="searchmode" value="Failed" />
                            <label for="searchmode4">Failed Transactions</label>

                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode5" name="searchmode" value="Success" />
                            <label for="searchmode5">Successful Transactions</label>
                        </div>

                        <div class="option">
                            <input type="radio" class="radio" id="searchmode6" name="searchmode" value="Deleted" />
                            <label for="searchmode6">Deleted Transactions</label>
                        </div>
                    </div>

                    <div class="selected">Choose Search Mode</div>


                </div>

                <div class="search-input2">
                    <form action="" class="search-form">
                        <input type="email" class="search" type="search" name="searchproduct"
                            placeholder="Search By Payer">
                    </form>
                </div>

                <div class="search-input2">
                    <form action="" class="dropdown-form">
                        <div class="valuediv2" style="display: none;"></div>
                    </form>
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


            <!-- <div class="no-lands">
        <img src="images/asset_success.svg" alt="success image" />
        <p>You have not done any transaction yet!!</p>
      </div> -->
            <div class="details-container">
                <?php 
           
             $landview = $user->selectAgentHistorySum($newuser['uniqueagent_id']);
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
              
            ?>
                <div class="transaction-details" <?php if($value['sub_status'] == "Failed"){?>
                    style="border: 2px solid red;" <?php }?>>
                    <div class="radius">
                        <img src="landimage/<?php echo $value['product_image'];?>" alt="">
                    </div>
                    <div class="details">
                        <p class="pname"><?php echo $value['product_name'];?></p>
                        <div class="inner-detail">
                            <div class="date" style="font-size: 14px;">
                                <span><?php echo $value['payment_month'];?></span>&nbsp;<span><?php echo $value['payment_day'];?></span>,<span><?php echo $value['payment_year'];?></span>,<span><?php echo $value['payment_time'];?></span>
                            </div>
                        </div>
                        <?php if($value['payment_mode'] == "Offline"){?>
                        <p
                            style="color: #7e252b; font-size: 12px; display:flex; align-items:center; justify-content:center; border-radius: 25px; border: 2px solid #7e252b; padding: 0 5px;">
                            Offline: <?php if($value['payment_mode'] == "Offline" && $value['offline_status'] == ""){
                            echo "Approved";
                        } else {
                            echo $value['offline_status'];
                        }?></p>
                        <?php }?>
                    </div>
                    <div class="price-detail detail3"><?php 
            if($value['product_unit'] == "1"){
                echo $value['product_unit']." Unit";
            } else {
                echo $value['product_unit']." Units";
            }
            ?></div>
                    <div class="price-detail detail3"><?php 
            echo $value['payment_method'];
            ?></div>
                    <?php  if($value['delete_status'] == "Deleted"){ ?>
                    <div class="detail-four">
                        <div class="detail"
                            style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <p style="font-size: 14px; color: #fff;">Deleted</p>
                        </div>
                    </div>
                    <?php } else {?>
                    <div class="price-detail" <?php if($value['sub_status'] == "Failed"){?> style="color: red;"
                        <?php }?>>&#8358;<?php 
             $unitprice = $value['product_price'];
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } else {
                                echo round($unitprice);
                             }
            ?><?php if($value['sub_status'] == "Failed") { echo "<span style='font-size: 12px;'>(Failed)</span>";}?>

                        <div class="payee">
                            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
                            <p class="payee-name"
                                style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">

                                <?php 
                            if($value['payee'] == $newuser['agent_name']){
                                echo "You";
                            } else {
                                echo $value['payee'];   
                            }
                             
                    ?>
                            </p>
                        </div>
                    </div>
                    <?php }?>
                </div>




                <?php }}?>

                <?php if(empty($landview)){?>
                <div class="success">
                    <img src="images/whoops.svg" alt="" />
                    <p>Whoops, you have no payment records</p>
                </div>
            </div>
        </div>

        <?php }?>



        <!-- <div class="directions">
        <img src="images/leftpage.svg" alt="" />
        <p>Page 1 of 4</p>
        <img src="images/rightPage.svg" alt="" />
    </div> -->
        <script src="js/main.js"></script>

        <script>
        let purpose4 = document.getElementsByName("searchmode");

        purpose4.forEach((element) => {
            element.onclick = () => {
                if (element.value == "Land") {
                    document.querySelector('.search-form3').style.display = "block";
                    document.querySelector('.search-form').style.display = "none";
                    document.querySelector('.search-form2').style.display = "none";

                }
                if (element.value == "Date") {
                    document.querySelector('.search-form2').style.display = "block";
                    document.querySelector('.search-form3').style.display = "none";
                    document.querySelector('.search-form').style.display = "none";

                }
                if (element.value == "Payer") {
                    document.querySelector('.search-form').style.display = "block";
                    document.querySelector('.search-form3').style.display = "none";
                    document.querySelector('.search-form2').style.display = "none";
                }


            }
        });
        //let searchIcon = document.querySelector('.search-icon');

        //let searchinput = document.querySelector('.search-input2');
        let searchinput2 = document.querySelector('.search');
        let searchinput3 = document.querySelector('.search2');

        //searchinput.style.display = "flex";
        //document.querySelector('#searchimg').style.display = "none";
        let searchform = document.querySelector('.search-form');
        let searchform2 = document.querySelector('.search-form3');
        let searchform3 = document.querySelector('.search-form2');
        let searchform4 = document.querySelector('.dropdown-form');


        searchform.onsubmit = (e) => {
            e.preventDefault();
        }

        searchform2.onsubmit = (e) => {
            e.preventDefault();
        }

        searchform3.onsubmit = (e) => {
            e.preventDefault();
        }

        searchform4.onsubmit = (e) => {
            e.preventDefault();
        }


        searchinput2.onkeyup = () => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchbypayer.php?user=agent&unique=<?php echo $_SESSION['uniqueagent_id'];?>`);

            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        document.querySelector('.details-container').innerHTML = data;
                    }
                }
            };
            let formData = new FormData(searchform);
            xhr.send(formData);
        }


        searchinput3.onkeyup = () => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST",
                `searchbyland.php?user=agent&unique=<?php echo $_SESSION['uniqueagent_id'];?>`);

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


        let valuediv2 = document.querySelector('.valuediv2');

        let purpose1 = document.querySelector("#searchmode4");
        let purpose2 = document.querySelector("#searchmode5");
        let purpose3 = document.querySelector("#searchmode6");
        let purposearray = [purpose1, purpose2, purpose3];
        document.querySelector('.dropdown-form').style.display = "block";
        purposearray.forEach((element) => {
            element.onclick = () => {
                document.querySelector('.search-form3').style.display = "none";
                document.querySelector('.search-form').style.display = "none";
                document.querySelector('.search-form2').style.display = "none";
                valuediv2.innerHTML = element.value;

                let xhr = new XMLHttpRequest();
                xhr.open("POST",
                    `searchstatus.php?data=${valuediv2.innerHTML}&user=agent&unique=<?php echo $_SESSION['uniqueagent_id'];?>`
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



        let valuediv = document.querySelector('.valuediv');

        let purpose = document.getElementsByName("searchproduct3");
        purpose.forEach((element) => {
            element.onclick = () => {
                valuediv.innerHTML = element.value;

                let xhr = new XMLHttpRequest();
                xhr.open("POST",
                    `searchbydate.php?data=${valuediv.innerHTML}&user=agent&unique=<?php echo $_SESSION['uniqueagent_id'];?>`
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
                document.querySelector(".trans-container").style = `
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
                document.querySelector(".trans-container").style = `
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