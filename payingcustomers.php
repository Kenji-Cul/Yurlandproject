<?php 
session_start();
include_once "projectlog.php";


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
        overflow-x: hidden;
    }

    .email-span {
        text-overflow: ellipsis !important;
        overflow: hidden;
        white-space: nowrap;
        display: inline-block;
        width: 170px;
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

    .search-icon {
        position: absolute;
        right: 4em;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        gap: 1.5em;
        align-items: center;
        justify-content: center;
    }

    .search-input {
        display: none;
    }

    .search-icon img {
        width: 20px;
        height: 20px;
    }

    .search-icon input {
        padding: 0.8em 4em;
        outline: none;
        background-color: #cac6c6;
        border: 1px solid #808080;
    }

    .search-icon input:focus {
        border: none;
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
        top: 20em;
        transform: translate(-50%, -50%);
        height: 40%;

    }

    .success p {
        text-align: center;
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

        .signup .nav {
            position: absolute;
            right: 40px;
            top: 30px;
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




        .details {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6em;
        }

        .details p {
            color: #808080;
        }

        .details p,
        .details h3 {
            font-size: 22px;
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

    @media only screen and (max-width: 1300px) {

        .success {
            position: absolute;
            top: 27em;
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
                    <a href="subadmininfo.php" style="color: #808080;"><img
                            src="profileimage/<?php echo $newuser['subadmin_image'];?>" alt="profile image" /></a>
                    <?php }?>
                    <?php if(empty($newuser['subadmin_image'])){?>
                    <a href="subadmininfo.php" style="color: #808080;">
                        <div class="empty-img" style="border-radius: 50%;">
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
            <li class="links select-link">
                <a href="payingcustomers.php"><img src="images/referral.svg" /></a>
                <a href="payingcustomers.php" class="link">Paying Customers</a>
            </li>

            <li class="links">
                <a href="totaltransactions.php"><img src="images/updown.svg" /> </a>
                <a href="totaltransactions.php" class="link">View Transactions</a>
            </li>

            <li class="links">
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
                <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
                <a href="superadmin.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <?php }?>
                <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
                <a href="subadmin.php">
                    <img src="images/arrowleft.svg" alt="" />
                </a>
                <?php }?>
                <p>Paying Customers</p>


            </div>


            <div class="details-container">


                <?php 
    $user = new User;
   
    $customer = $user ->selectAllUsers();
    
    if(!empty($customer)){
        $customers = [];
        foreach($customer as $key => $value){
array_push($customers,$value['unique_id']);
        }
        for ($i = 0; $i <= count($customers) - 1; $i++) {
            $total = $user->selectTotalCustomers($customers[$i]);
            
           if(!empty($total)){
            $landusers = [];
            foreach($total as $key => $value){
                array_push($landusers,$value); 
                $allocateduser = $user->selectUser($value);
                 ?>

                <div class="account-detail2">
                    <div class="radius">
                        <?php if(!empty( $allocateduser['photo'])){?>
                        <img src="profileimage/<?php echo  $allocateduser['photo'];?>" alt="profile image" />
                        <?php }?>
                        <?php if(empty( $allocateduser['photo'])){?>
                        <div class="empty-img">
                            <i class="ri-user-fill"></i>
                        </div>
                        <?php }?>
                    </div>
                    <div class="flex">
                        <p style="text-transform: capitalize;">
                            <span><?php echo  $allocateduser['first_name'];?></span>&nbsp;<span><?php echo  $allocateduser['last_name'];?></span>
                        </p>
                        <span class="email-span"><?php echo $allocateduser['email'];?></span>
                    </div>
                    <a href="customerprofileinfo.php?unique=<?php echo  $allocateduser['unique_id'];?>&real=91838JDFOJOEI939"
                        style="color: #808080;"><i class="ri-arrow-right-s-line"></i></a>
                </div>


                <?php          }
        } 
           }  }?>


                <?php if(empty($customer)){?>
                <div class="success">
                    <img src="images/asset_success.svg" alt="" />
                    <p>There are no paying customers yet!</p>
                </div>
                <?php }?>

                <div class="account-detail3">
                    <a href="logout.php?user=subadmin">
                        <p>Sign Out</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
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
    </script>
</body>

</html>