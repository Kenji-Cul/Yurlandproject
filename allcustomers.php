<?php 
session_start();
include_once "projectlog.php";
if(!isset($_SESSION['uniquesubadmin_id'])){
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
    <link rel="icon" type="image/x-icon" href="images/yurland_logo.jpg" />

    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
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
        <a href="subadmin.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <p>All Customers</p>
    </div>


    <div class="details-container">


        <?php 
    $user = new User;
   
    $customer = $user ->selectAllUsers();
    if(!empty($customer)){
        foreach($customer as $key => $value){
    ?>
        <div class="account-detail2">
            <div class="radius">
                <?php if(!empty($value['photo'])){?>
                <img src="profileimage/<?php echo $value['photo'];?>" alt="profile image" />
                <?php }?>
                <?php if(empty($value['photo'])){?>
                <div class="empty-img">
                    <i class="ri-user-fill"></i>
                </div>
                <?php }?>
            </div>
            <div class="flex">
                <p style="text-transform: capitalize;">
                    <span><?php echo $value['first_name'];?></span>&nbsp;<span><?php echo $value['last_name'];?></span>
                </p>
                <span><?php echo $value['email'];?></span>
            </div>
            <a href="customerinfo.php?unique=<?php echo $value['unique_id'];?>&real=91838JDFOJOEI939"
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