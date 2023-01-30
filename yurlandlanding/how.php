<?php 
include_once "../projectlog.php";
?>
<!DOCTYPE html>
<!--
	Solution by GetTemplates.co
	URL: https://gettemplates.co
-->
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- awesone fonts css-->
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../images/logo.svg" />
    <!-- owl carousel css-->
    <link rel="stylesheet" href="owl-carousel/assets/owl.carousel.min.css" type="text/css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- custom CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <title><?php echo MY_APP_NAME;?> - How It works</title>
    <style></style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent" id="gtco-main-nav">
        <div class="container">
            <a href="../index.php"><img src="images/yurland.png" height="50" alt="" />
                <a class="navbar-brand"></a>
            </a>
            <button class="navbar-toggler" data-target="#my-nav" onclick="myFunction(this)" data-toggle="collapse">
                <span class="bar1"></span> <span class="bar2"></span>
                <span class="bar3"></span>
            </button>
            <div id="my-nav" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="story.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="how.php">How it works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="story.php">Story</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://medium.com/@yurland.ng" target="_blank">Learn</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <a href="../login.php" class="btn btn-outline-dark my-2 my-sm-0 mr-3 text-uppercase">login</a>
                    <a href="../getstarted.php" class="btn btn-outline-dark my-2 my-sm-0 mr-3 text-uppercase">sign
                        up</a>
                </form>
            </div>
        </div>
    </nav>
    <br /><br /><br /><br /><br /><br /><br />
    <div class="container-fluid gtco-features" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <br /><br /><br />
                    <h1>
                        Made easy and sufficiently <br />
                        <span style="color: #7e252b">designed for you.</span>
                    </h1>
                </div>
                <div class="col-lg-8">
                    <svg id="bg-services" width="100%" viewBox="0 0 1000 800">
                        <defs>
                            <linearGradient id="PSgrad_02" x1="64.279%" x2="0%" y1="76.604%" y2="0%">
                                <stop offset="0%" stop-color="rgb(1,230,248)" stop-opacity="1" />
                                <stop offset="100%" stop-color="rgb(29,62,222)" stop-opacity="1" />
                            </linearGradient>
                        </defs>
                        <path fill-rule="evenodd" opacity="0.102" fill="ff6600"
                            d="M801.878,3.146 L116.381,128.537 C26.052,145.060 -21.235,229.535 9.856,312.073 L159.806,710.157 C184.515,775.753 264.901,810.334 338.020,792.380 L907.021,652.668 C972.912,636.489 1019.383,573.766 1011.301,510.470 L962.013,124.412 C951.950,45.594 881.254,-11.373 801.878,3.146 Z" />
                    </svg>
                    <div class="row">
                        <div class="col">
                            <div class="card text-center">
                                <div class="oval">
                                    <span class="fa-stack">
                                        <!-- The icon that will wrap the number -->
                                        <span class="fa fa-square-o fa-stack-2x"></span>
                                        <!-- a strong element with the custom content, in this case a number -->
                                        <strong class="fa-stack-1x"> 1 </strong>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Open An Account</h3>
                                    Sign up and complete verification using any of your ID and
                                    or BVN to start enjoying our flexible and affordable
                                    estates.
                                </div>
                            </div>
                            <div class="card text-center">
                                <div class="oval">
                                    <span class="fa-stack">
                                        <!-- The icon that will wrap the number -->
                                        <span class="fa fa-square-o fa-stack-2x"></span>
                                        <!-- a strong element with the custom content, in this case a number -->
                                        <strong class="fa-stack-1x"> 2 </strong>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Find An Estate</h3>
                                    Explore all our Estates, find what best works and meets your
                                    desired budget and location. Make your choice.
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-center">
                                <div class="oval">
                                    <span class="fa-stack">
                                        <!-- The icon that will wrap the number -->
                                        <span class="fa fa-square-o fa-stack-2x"></span>
                                        <!-- a strong element with the custom content, in this case a number -->
                                        <strong class="fa-stack-1x"> 3 </strong>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Choose Your Payment Plan</h3>
                                    Depending on your earning, financial status and budget,
                                    choose a payment plan that works, start payment and get your
                                    offer letter.
                                </div>
                            </div>
                            <div class="card text-center">
                                <div class="oval">
                                    <span class="fa-stack">
                                        <!-- The icon that will wrap the number -->
                                        <span class="fa fa-square-o fa-stack-2x"></span>
                                        <!-- a strong element with the custom content, in this case a number -->
                                        <strong class="fa-stack-1x"> 4 </strong>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Allocation</h3>
                                    Complete your payment, download your allocation invite from
                                    your dashboard, pay your allocation fee and get your land
                                    allocated.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br /><br /><br />

    <br />

    <footer class="container-fluid" id="gtco-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-7" id="contact">
                    <section class="faq-section">
                        <div class="container">
                            <div class="row">
                                <!-- ***** FAQ Start ***** -->
                            </div>
                        </div>
                    </section>
                    <br /><br /><br />
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <h4>Company</h4>
                            <ul class="nav flex-column company-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="story.php">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="how.php">How It Works</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="story.php">Story</a>
                                </li>
                            </ul>
                            <h4 class="mt-6">Follow Us</h4>
                            <ul class="nav follow-us-nav">
                                <li class="nav-item">
                                    <a class="nav-link pl-0" href="https://medium.com/@yurland.ng"><i
                                            class="fa fa-medium" aria-hidden="true"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://twitter.com/yurlandng"><i class="fa fa-twitter"
                                            aria-hidden="true"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://instagram.com/yurlandng"><i
                                            class="fa fa-instagram" aria-hidden="true"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://youtube.com/@yurland"><i class="fa fa-youtube"
                                            aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h4>Info</h4>
                            <ul class="nav flex-column services-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="https://medium.com/@yurland.ng" target="_blank">Learn</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="terms.php">T&C</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                        <br /><br /><br />
                        <div class="col-3"></div>
                        <div class="col-6">
                            <br /><br /><br />
                            <p>
                                A member of <br /><img src="images/ilu2.png" width="100" />
                            </p>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-12">
                            <p>
                                &copy; 2023. All Rights Reserved. Developed by
                                <a href="" target="_blank">Arklips</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- owl carousel js-->
    <script src="owl-carousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>