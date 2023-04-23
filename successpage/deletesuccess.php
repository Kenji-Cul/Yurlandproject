<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../images/logo.svg" />

    <link rel="stylesheet" href="../css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        height: 80vh !important;
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <div class="logo">
            <a href="../index.php"><img src="../images/logo.svg" alt="Logo" /></a>
        </div>
    </header>

    <div class="success">
        <img src="../images/asset_success.svg" alt="" />
        <?php if($_GET['detect'] == "deleted"){?>
        <p>Product Deleted Successfully!</p>
        <?php }?>
        <?php if($_GET['detect'] == "restored"){?>
        <p>Product Restored Successfully!</p>
        <?php }?>
        <?php if($_GET['detect'] == "restorel"){?>
        <p>History Restored!</p>
        <?php }?>
        <?php if($_GET['detect'] == "deletedp"){?>
        <p>Product Deleted Permanently!</p>
        <?php }?>
        <?php if($_GET['detect'] == "deletedl"){?>
        <p>History Deleted!</p>
        <?php }?>
        <?php if($_GET['detect'] == "closed"){?>
        <p>Product Closed Successfully!</p>
        <?php }?>
        <?php if($_GET['detect'] == "opened"){?>
        <p>Product Opened Successfully!</p>
        <?php }?>
        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <a href="../allestates3.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <a href="../allproducts.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
    </div>
</body>

</html>