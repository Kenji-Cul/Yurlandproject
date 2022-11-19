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
    <link rel="icon" type="image/x-icon" href="../images/yurland_logo.jpg" />

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
            <a href="../index.php"><img src="../images/yurland_logo.jpg" alt="Logo" /></a>
        </div>
    </header>

    <div class="success">
        <img src="../images/asset_success.svg" alt="" />
        <p>User Edit Successful!</p>
        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <a href="../superadmin.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <a href="../subadmin.php"><button class="landing_page_button2">Back to Dashboard</button></a>
        <?php }?>
    </div>
</body>

</html>