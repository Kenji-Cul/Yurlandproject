<?php 
session_start();
include "projectlog.php";
if(!isset($_GET['id'])){
  header("Location: superadmin.php");
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
    <script src="bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css" />
    <title>Yurland</title>
    <style>
    body {
        height: 150vh;
    }

    section .error {
        width: 60%;
    }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="images/yurland_logo.jpg" alt="Logo" /></a>
        </div>
    </header>



    <!-- Landing Page Text -->
    <div class="page-title2">
        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <a href="allproducts.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <?php }?>
        <div style="display: flex !important; flex-direction: column !important" class="estatetext">
            <p>Edit Land
            </p>
        </div>
    </div>

    <section class="login-form-container">
        <?php 
                 
                 $land = new User;
                   $landview = $land->selectLandImage($_GET['id']);
                   if(!empty($landview)){
                       foreach($landview as $key => $value){  ?>
        <form action="" class="login-form" id="signup-form">
            <div class="input-div name">
                <label for="landname">Product Name</label>
                <input type="text" id="landname" placeholder="Edit land name" name="landname"
                    value="<?php if(isset($value['product_name'])){echo $value['product_name'];}?>" />
            </div>

            <div class="input-div name">
                <label for="location">Product Location</label>
                <input type="text" id="location" placeholder="Edit land location" name="location"
                    value="<?php if(isset($value['product_location'])){echo $value['product_location'];}?>" />
            </div>

            <div class="input-div email">
                <label for="purpose">Purpose</label>
                <input type="text" id="purpose" placeholder="Edit land purpose" name="purpose"
                    value="<?php if(isset($value['purpose'])){echo $value['purpose'];}?>" />
            </div>

            <div class="input-div number">
                <label for="unitprice">Unit Price</label>
                <input type="number" id="unitprice" placeholder="Edit unit price" name="unitprice"
                    value="<?php if(isset($value['unit_price'])){echo $value['unit_price'];}?>" />
            </div>

            <div class="input-div number">
                <label for="unitnum">Product Unit</label>
                <input type="number" id="unitnum" placeholder="Edit product unit" name="unitnum"
                    value="<?php if(isset($value['product_unit'])){echo $value['product_unit'];}?>" />
            </div>



            <div class="input-div email">
                <input type="hidden" name="uniqueland" value="<?php
                        echo $value['unique_id'];
                       
                
                ?>">
            </div>


            <p class="error">Please input all fields</p>

            <button class="btn" type="submit">Edit Product</button>
            <div style="display: none">
                <img src="images/loading.svg" alt="" class="loading-img" />
            </div>
        </form>
        <?php }}?>
    </section>


    <script>
    $(document).ready(function() {
        $("#signup-form").submit(function(e) {
            e.preventDefault();
            var loadingImg = $(".loading-img");
            $(".btn").html(loadingImg);
        });



        $("#signup-form .btn").click(function() {
            $.ajax({
                type: "POST",
                url: "inserters/editproduct.php",
                data: $("#signup-form input"),
                success: function(response) {
                    if (response === "success") {
                        location.href = "successpage/landedit.html";
                    } else {
                        $("section .error").html(response);
                        $("section .error").css({
                            visibility: "visible",
                        });
                        $(".btn").html("Edit Product");
                        // console.log(response);
                    }
                },
            });
        });
    });
    </script>
</body>

</html>