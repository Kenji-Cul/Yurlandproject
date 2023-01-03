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
        <p>All Executives</p>
    </div>


    <div class="details-container">


        <?php 
    $user = new User;
   
    $customer = $user ->selectAllExecutives();
    if(!empty($customer)){
        foreach($customer as $key => $value){
    ?>
        <div class="account-detail2">
            <div class="radius">
                <?php if(!empty($value['executive_img'])){?>
                <img src="profileimage/<?php echo $value['executive_img'];?>" alt="profile image" />
                <?php }?>
                <?php if(empty($value['executive_img'])){?>
                <div class="empty-img">
                    <i class="ri-user-fill"></i>
                </div>
                <?php }?>
            </div>
            <div class="flex">
                <p style="text-transform: capitalize;">
                    <span><?php echo $value['full_name'];?></span>&nbsp;
                </p>
                <span><?php echo $value['executive_email'];?></span>
            </div>

            <a href="execinfo.php?unique=<?php echo $value['unique_id'];?>&real=91838JDFOJOEI939"
                style="color: #808080;"><i class="ri-arrow-right-s-line"></i></a>
        </div>

        <?php }}?>

        <div class="account-detail3">
            <a href="logout.php">
                <p>Sign Out</p>
            </a>
        </div>
    </div>

    <script src="js/main.js"></script>
</body>

</html>