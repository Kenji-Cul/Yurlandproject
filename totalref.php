<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['uniquesubadmin_id'])){
    header("Location: teamspace.php");
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
        position: relative;
        overflow-x: hidden;
    }

    .dropdown-links {
        overflow-y: auto;
    }

    ::-webkit-scrollbar {
        width: 0.5rem;
        background-color: #8d8989;
        border-radius: 1rem;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #ddd;
        border-radius: 1rem;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #aaa;
    }

    .profile-body {
        height: 100vh;
    }



    .account-detail2 {
        padding-bottom: 1em;
        padding-top: 1em;
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


    section {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    section .error {
        color: #ff6600;
        border: 1px solid #ff6600;
        height: 1em;
        border-radius: 8px;
        margin-bottom: 1.5em;
        width: 80px;
    }

    .footerdiv {
        position: absolute;
        bottom: 0;
    }



    .success img {
        width: 15em;
        height: 15em;
    }

    .price-button {
        width: 300px;
        font-size: 15px;
    }

    @media only screen and (min-width: 1300px) {
        .payment-image-div2 {
            gap: 0.5em;
        }

        .payment-image-div2 img {
            width: 16em;
            height: 16em;
        }

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
            height: 84vh;
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

    @media only screen and (max-width: 800px) {
        .payment-image-div2 img {
            width: 10em;
            height: 10em;
        }

        .payment-image-div2 .payment-desc {
            display: flex;
            flex-direction: column;
            gap: 2em;
            position: absolute;
            top: 10px;
            padding-left: 12px;
            padding-top: 5px;
        }

        .payment-image-div2 .payment-desc3 {
            display: flex;
            flex-direction: column;
            gap: 2em;
            position: absolute;
            top: 170px;
            padding-left: 12px;
            padding-top: 20px;
            width: 120px;
        }
    }

    @media only screen and (max-width: 1300px) {







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

        .code-container .flex0 {
            flex-direction: column;
        }

        .price-button {
            width: 200px;
            font-size: 12px;
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
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            gap: 2em;
            background: #7e252b;
            transform: translateX(100%);
            transition: all 1s;
            width: 50%;
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
            padding-top: 12em;
        }


        /* .close {
            position: absolute;
            top: 4em;
            right: 1em;
        } */


        .update-data {
            position: absolute;
            top: -3em;
        }
    }

    @media only screen and (max-width: 800px) {
        .success {
            position: absolute;
            left: 50%;
            top: 60em;
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
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
            <a href="subadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>

        <?php 
             $user = new User;
             $newuser = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
            ?>

        <div class="nav">
            <img src="images/menu.svg" alt="menu icon" class="menu" />
            <div class="user">
                <p><?php if(isset($newuser['subadmin_name'])){  ?>
                    <span><?php echo $newuser['subadmin_name']; ?></span>&nbsp;
                    <?php }?>
                </p>
                <div class="profile-image">
                    <?php if(!empty($newuser['subadmin_image'])){?>
                    <a href="agentprofileinfo.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['subadmin_image'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['subadmin_image'])){?>
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
                <a href="subadmin.php"><img src="images/home3.svg" /></a>
                <a href="subadmin.php" class="link">Home</a>
            </li>
            <li class="links">
                <a href="allcustomers.php"><img src="images/referral.svg" /></a>
                <a href="allcustomers.php" class="link">All Customers</a>
            </li>
            <li class="links">
                <a href="newuser.php"><img src="images/referral.svg" /></a>
                <a href="newuser.php" class="link">New Customer</a>
            </li>
            <li class="links">
                <a href="createagent.php"><img src="images/referral.svg" /> </a>
                <a href="createagent.php" class="link">Create Agent</a>
            </li>

            <li class="links">
                <a href="usertype.php"><img src="images/land2.svg" /></a>
                <a href="usertype.php" class="link">New Land</a>
            </li>


            <li class="links">
                <a href="defaultcustomers.php"><img src="images/referral.svg" /></a>
                <a href="defaultcustomers.php" class="link">Default Customers</a>
            </li>
            <li class="links">
                <a href="allocationcustomers.php"><img src="images/referral.svg" /></a>
                <a href="allocationcustomers.php" class="link">Due Allocation</a>
            </li>
            <li class="links">
                <a href="payingcustomers.php"><img src="images/referral.svg" /></a>
                <a href="payingcustomers.php" class="link">Paying Customers</a>
            </li>

            <li class="links">
                <a href="totaltransactions.php"><img src="images/updown.svg" /> </a>
                <a href="totaltransactions.php" class="link">View Transactions</a>
            </li>

            <li class="links select-link">
                <a href="totalref.php"><img src="images/referral.svg" /> </a>
                <a href="totalref.php" class="link">View Referrals</a>
            </li>

            <li class="links">
                <a href="allagents.php"><img src="images/referral.svg" /> </a>
                <a href="allagents.php" class="link">All Agents</a>
            </li>

            <li class="links">
                <a href="subadmininfo.php"><img src="images/settings.svg" /></a>
                <a href="subadmininfo.php" class="link">Profile</a>
            </li>
            <li class="links">
                <a href="logout.php?user=subadmin"><img src="images/exit.svg" /></a>
                <a href="logout.php?user=subadmin" class="link">Logout</a>
            </li>
        </ul>







        <div class="profile-container">
            <div class="page-title2">
                <a href="subadmin.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <p>Total Referrals</p>
            </div>

            <?php 
             $user = new User;
             $newuser = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
            ?>

            <div class="payment-image-div2">
                <div>
                    <img src="images/image1.svg" alt="payment image" />
                    <div class="payment-desc">
                        <p style="width: 80%;">Total Users Referred</p>
                        <div class="payment-count"> <span><?php 
                            $allrefusers = $user->selectAllRefUsers();
                            foreach ($allrefusers as $key => $value) {
                               echo $value;
                            }
                            
                        ?></span>
                        </div>
                    </div>
                </div>


                <div>
                    <img src="images/image2.svg" alt="payment image" />
                    <div class="payment-desc">
                        <p style="width: 100%;">Total Paid Referral</p>
                        <div class="payment-count"> <span class="landusercount"></span><?php 
                         $customer = $user ->selectAllRefs();
                        if(!empty($customer)){
                            $customers = [];
                           foreach($customer as $key => $value){
               array_push($customers,$value['unique_id']);
                           }

                           //var_dump($customers);

                        

                           for ($i = 0; $i <= count($customers) - 1; $i++) {
                            $total = $user->selectTotalCustomers($customers[$i]);
                            
                           if(!empty($total)){
                            $landusers = [];
                            foreach($total as $key => $value){
                                array_push($landusers,$value); 
                                 ?>
                            <span name="landuser" style="display: none;"><?php echo $value?></span>
                            <?php          }
                        }
                           } }?>
                        </div>
                    </div>
                </div>
                <div>
                    <img src="images/image2.svg" alt="payment image" />
                    <div class="payment-desc payment-desc3">
                        <p style="width: 100%;">Total Referral Earnings</p>
                        <div class="payment-count">&#8358;<span class="totalearn"></span>
                            <?php 
                               
                                $allusers = $user->selectAllUsers();
                                foreach ($allusers as $key => $value3) {
                                    $agentpercent = $value3['earning_percentage'];
                                 
                             $datearray = [];
                                $userhistory = $user->selectAgentHistory($value3['unique_id']);
                                foreach ($userhistory as $key => $value) {
                                    if(empty($value3['earning_percentage'])){
                                       $earnedprice = 0;
                                    } else {
                                        $earnedprice = $value3['earning_percentage'] / 100 * $value['product_price'];
                                    }
                                   
                        
                                     ?>
                            <span name="userdate" style="display:none;"><?php echo $earnedprice;?></span>
                            <?php    }
                                }
                               
                                ?>
                            <?php 
                               
                                $allagents = $user->selectAllAgents();
                                foreach ($allagents as $key => $value2) {
                                    $agentdate = $value2['agent_date'];
                                    $agentpercent = $value2['earning_percentage'];
                                 
                             $datearray = [];
                                $agenthistory = $user->selectAgentHistory($value2['uniqueagent_id']);
                                foreach ($agenthistory as $key => $value) {
                                    $earnedprice = $value2['earning_percentage'] / 100 * $value['product_price'];
                        
                                     ?>
                            <span name="paydate" style="display:none;"><?php echo $earnedprice;?></span>
                            <?php    }
                                }
                               
                                ?>
                        </div>
                    </div>
                </div>

                <div>
                    <img src="images/image1.svg" alt="payment image" />
                    <div class="payment-desc payment-desc3">
                        <p>Total Executive Earnings</p>
                        <div class="payment-count"> <span class="landusercount3"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contain">
                <div class="line">
                    <hr />
                </div>
            </div>


        </div>
    </div>
    </div>



    <script>
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

    let userdate = document.getElementsByName("userdate");

    let userdates = [];
    userdate.forEach(element => {
        userdates.push(parseInt(element.innerHTML));
    });

    //console.log(paydates);

    let sum2 = 0;

    for (let i = 0; i < userdates.length; i++) {
        sum2 += userdates[i];
    }
    //console.log(sum);



    let paydate = document.getElementsByName("paydate");

    let paydates = [];
    paydate.forEach(element => {
        paydates.push(parseInt(element.innerHTML));
    });

    //console.log(paydates);

    let sum = 0;

    for (let i = 0; i < paydates.length; i++) {
        sum += paydates[i];
    }
    //console.log(sum);
    document.querySelector('.totalearn').innerHTML = new Intl.NumberFormat().format(sum + sum2);

    let landuser = document.getElementsByName("landuser");

    let landvalues = [];
    landuser.forEach(element => {

        landvalues.push(parseInt(element.innerHTML));
    });
    document.querySelector('.landusercount').innerHTML = landvalues.length;
    </script>
</body>

</html>