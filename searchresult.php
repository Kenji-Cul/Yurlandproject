<?php 
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

    .subscribed-lands {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-around;
        min-height: 30vh;
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

    .success {
        position: absolute;
        left: 50%;
        top: 70%;
        transform: translate(-50%, -50%);
        height: 10em;
    }



    .success img {
        width: 36em;
        height: 36em;
    }



    .success p {
        text-align: center;
    }

    .subscribed-land {
        height: 30em;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
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
        padding-top: 1em;
    }

    .subscribed-details .sub-detail {
        display: grid;
        gap: 1em;
    }

    .updated-land {
        position: relative;
        width: 350px;
        height: 600px;
        background: #FFFFFF;
        border-radius: 8px;
        filter: drop-shadow(0px 4px 16px rgba(128, 128, 128, 0.76));
        display: flex;
        flex-direction: column;
    }

    .updated-img {
        width: 350px;
        height: 341px;
        border-radius: 8px 8px 0px 0px;
    }

    .updated-details {
        display: flex;
        flex-direction: column;
        padding: 1em 1.5em;
    }

    .detail-one,
    .detail-two {
        display: flex;
        flex-direction: column;
    }

    .detail-three {
        display: flex;
        gap: 12px;
        padding-top: 2em;
    }

    .detail-three p {
        color: #808080;
        font-weight: 500;
    }

    .detail-four {
        display: flex;
        flex-direction: column;
        padding-top: 1.5em;
        gap: 0.3em;
    }

    .detail-four p {
        color: #808080;
        font-size: 15px;
    }

    .detail-five {
        display: flex;
        justify-content: right;
        padding-top: 1em;
    }

    .detail-five .cartbutton {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6em;
        width: 160px;
        height: 37.91px;
        color: #7E252B;
        border: 1px solid #7E252B;
        border-radius: 45px;
        cursor: pointer;
    }

    .detail-four .detail {
        display: flex;
        gap: 6px;
    }

    .unit-detail {
        display: flex;
        gap: 10px;
    }

    .unit-detail2 {
        display: flex;
        flex-direction: column;
        gap: 5px;
        padding-top: 1em;
    }

    .detail-name p {
        font-style: normal;
        font-weight: 600;
        font-size: 32px;
        color: #1A0709;
    }

    .detail-location {
        display: flex;
        gap: 15px;
    }

    .detail-location a {
        color: #ff6600;
        text-decoration: underline;
    }

    .detail-btn {
        width: 9em;
        height: 26px;
        background: #7E252B;
        border-radius: 8px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-btn p {
        font-size: 12px;
        text-transform: capitalize;
    }

    .updated-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px 8px 0px 0px;
    }


    @media only screen and (max-width: 500px) {

        .detail-btn p {
            font-size: 9px;
            text-transform: capitalize;
        }

        .updated-land {
            width: 80%;
        }

        .updated-img {
            width: 100%;
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
        <a href="allestates.php">
            <img src="images/arrowleft.svg" alt="" />
        </a>
        <div style="display: flex !important; flex-direction: column !important" class="estatetext">
            <p>All Estates</p>
        </div>
        <div class="search-icon">
            <div class="search-input">
                <form action="" class="search-form">
                    <input type="text" class="search" type="search" name="searchproduct">
                </form>
            </div>
        </div>
    </div>



    <div class="subscribed-lands">
        <div class='success'>
            <img src='images/asset_success.svg' alt='' style="width: 20em; height: 20em;" />
            <p>Hello we can help you find what you want</p>
        </div>
    </div>



    <script src="js/main.js"></script>
    <script>
    // console.log(input.value);

    $("#searchform").submit(function(e) {
        e.preventDefault();
    })

    $(".search-form input").keyup(function() {
        // console.log(("#searchform input").val())
        $.ajax({
            type: "POST",
            url: "searching.php",
            data: $(".search-form input"),
            success: function(response) {
                console.log(response);
                $(".subscribed-lands").html(response);
                //    console.log(response);
            }

        });
    })
    </script>
</body>

</html>