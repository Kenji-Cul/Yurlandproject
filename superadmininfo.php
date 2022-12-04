<?php 
ob_start();
session_start();
include "projectlog.php";
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
    .page-title3 {
        flex-direction: column;
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

    .heading {
        font-weight: 900;
        border-radius: 5px 0px 0px 5px;
        font-size: 18px;
        background: #fff;
        color: #7e252b;
        box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.12);
    }

    .value {
        color: #808080;
    }

    .flexboxs {
        display: flex;
        flex-direction: column;
        gap: 0.2em;
    }


    .subscribed-lands {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    .subscribed-land {
        width: 90%;
        min-height: 10em;
        position: absolute;
        top: 2em;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .subscribed-img {
        height: 15em;
    }

    .inputs {
        display: none;
    }

    .inputs i {
        font-size: 22px;
    }

    .estateinfo {
        padding: 0;
    }

    .subscribed-details {
        padding-top: 0;
    }

    .subscribed-details .sub-detail {
        display: grid;
        gap: 1em;
    }

    @media only screen and (min-width: 1000px) {
        .subscribed-land {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }
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
            <img src="images/menu.svg" alt="menu icon" />
        </div>
    </header>

    <div class="page-title2">
        <a href="allproducts.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <div style="display: flex !important; flex-direction: column !important" class="estatetext">
            <p>Estate Table</p>
        </div>
    </div>



    <div class="subscribed-lands">
        <?php 
             $land = new User;
             $landview = $land->selectLandImage($_GET['id']);
             if(!empty($landview)){
                foreach($landview as $key => $value){
                    
            ?>
        <div class="subscribed-land">
            <div class="flex-one flexboxs">
                <p class="heading">Action</p>
                <p class="value">
                    <?php 
                    $name = $value['unique_id'];
                    if($value['land_status'] == "Closed"){?>
                <form action="" class="open-form" method="POST">
                    <button class="price" type="submit" name="open<?php echo $name?>"
                        style="background-color: #7e252b; color: #fff;">Open</button>

                </form>
                <?php }else {?>
                <form action="" class="close-form" method="POST">
                    <button class="price" type="submit" name="close<?php echo $name?>"
                        style="background-color: #7e252b; color: #fff;">Close</button>

                </form>
                <?php }?>
                <?php 
            
                
                if(isset($_POST["close".$name])){
                    $insertuser = $land->closeProduct($name);
                    $restored = "closed";
                        header("Location: successpage/deletesuccess.php?detect=".$restored."");
                    
                
            }

            if(isset($_POST["open".$name])){
                $insertuser = $land->openProduct($name);
                $restored = "opened";
                    header("Location: successpage/deletesuccess.php?detect=".$restored."");
                
            
        }
            ?>

                </p>
                <p class="value"> <a
                        href="editinfo.php?id=<?php echo $value['unique_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej"><button
                            class="price" type="submit"
                            style="background-color: #7e252b; color: #fff;">Edit</button></a></p>
            </div>
            <div class="flex-one flexboxs">
                <p class="heading">Estate Name</p>
                <p class="value"><?php echo $value['product_name'];?></p>
            </div>
            <div class="flex-one flexboxs">
                <p class="heading">Location</p>
                <p class="value"><?php echo $value['product_location'];?></p>
            </div>
            <div class="flex-one flexboxs">
                <p class="heading">Outright Price</p>
                <p class="value">&#8358;<span>
                        <?php $unitprice =  $value['outright_price'];
                         if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                            echo number_format($unitprice);
                          }  else {
                              echo $unitprice;
                          }
       
      
                        ?>

                    </span></p>
            </div>
            <div class="flex-one flexboxs">
                <p class="heading">Available Units</p>
                <p class="value"><?php echo $value['product_unit'];?></p>
            </div>
            <div class="flex-one flexboxs">
                <p class="heading">Units Bought</p>
                <p class="value"><?php echo $value['bought_units'];?></p>
            </div>

            <div class="flex-one flexboxs">
                <p class="heading">Subscribers Count</p>
                <p class="value"><?php 
                 $num = $land->selectSubscribers($value['unique_id']);
                 $number = $land->selectSum($value['unique_id']);
                 $total = $land->selectTotalPayment($value['unique_id']);
                 if(!empty($num)){
                 foreach($num as $key => $value){
                    echo $value;
                 } } else {
                 echo "0";
                 }
                ?></p>
            </div>

            <div class="flex-one flexboxs">
                <p class="heading">Total Amount Bought</p>
                <p class="value">&#8358; <?php 
                   if(!empty($number)){
                    foreach($number as $key => $value){
                       $unitprice =  $value;
                         if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                            echo number_format($unitprice);
                          }  else {
                              echo $unitprice;
                          }
                    } } else {
                    echo "0";
                    }
                ?></p>
            </div>
            <div class="flex-one flexboxs">
                <p class="heading">Revenue</p>
                <p class="value">&#8358;<?php 
              
                foreach($total as $key => $value){
                     $unitprice = $value;
                     if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                        echo number_format($unitprice);
                      }  else {
                          echo $unitprice;
                      }
                }
                ?></p>
            </div>

        </div>
        <?php }}?>


    </div>



    <script src="js/main.js"></script>

</body>
<?php ob_end_flush();?>

</html>