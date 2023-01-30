<?php 
include_once "../projectlog.php";
?>

<!doctype html>
<!--
	Solution by GetTemplates.co
	URL: https://gettemplates.co
-->
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- awesone fonts css-->
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;600;700&display=swap"
        rel="stylesheet">
    <!-- owl carousel css-->
    <link rel="stylesheet" href="owl-carousel/assets/owl.carousel.min.css" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo MY_APP_NAME;?> - FAQ.</title>
    <style>

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent" id="gtco-main-nav">
        <div class="container">
            <a href="../index.php"><img src="images/yurland.png" height="50" alt="">
                <a class="navbar-brand"></a>
            </a>
            <button class="navbar-toggler" data-target="#my-nav" onclick="myFunction(this)" data-toggle="collapse"><span
                    class="bar1"></span> <span class="bar2"></span> <span class="bar3"></span></button>
            <div id="my-nav" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="story.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="how.php">Our Estates</a></li>
                    <li class="nav-item"><a class="nav-link" href="story.php">Story</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://medium.com/@yurland.ng"
                            target="_blank">Learn</a></li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <a href="../login.php" class="btn btn-outline-dark my-2 my-sm-0 mr-3 text-uppercase">login</a> <a
                        href="../getstarted.php" class="btn btn-outline-dark my-2 my-sm-0 mr-3 text-uppercase">sign
                        up</a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid gtco-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1><span>Frequently Asked Questions.</span></h1>
                    <p> Get familiar with some of our FAQ. Hopefully they provide answers to your questions too. </p>
                    <br /><br /><br />
                    <a href="../getstarted.php">Get Started <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                </div>
                <div class="col-md-6">
                    <div class="card"><img style="width:100%;" src="images/doorstep2.png" alt=" " /></div>
                </div>
            </div>
        </div>
    </div><br /><br /><br /><br />
    <div class="col-md-7 " id="contact ">
        <section class="faq-section ">
            <div class="container ">
                <div class="row ">
                    <div class="col-md-6 offset-md-3 ">

                        <div class="faq-title text-center pb-3 ">
                            <h2>FAQ</h2>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-3 ">
                        <div class="faq " id="accordion ">
                            <div class="card ">
                                <div class="card-header " id="faqHeading-1 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-1 "
                                            data-aria-expanded="true " data-aria-controls="faqCollapse-1 ">
                                            <span class="badge ">1</span>What is the maximum period I can spend paying
                                            for a land?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-1 " class="collapse " aria-labelledby="faqHeading-1 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>The maximum payment period is 18months. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-2 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-2 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-2 ">
                                            <span class="badge ">2</span> Do I have to be In Nigeria to get started?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-2 " class="collapse " aria-labelledby="faqHeading-2 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>No… Wherever you are In the world, you can set up your account and start
                                            owning your land.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-3 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-3 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-3 ">
                                            <span class="badge ">3</span>What happens if I cannot meet up the payment
                                            deadline?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-3 " class="collapse " aria-labelledby="faqHeading-3 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Case 1: For clients who inform us ahead as regards situations that might
                                            affect their signed contract, we are open to reach another agreement to
                                            allow a payment extension with no further grace period if this second
                                            agreement is bridged.

                                            <br /> Case 2: users who do not inform us but at their own will decides to
                                            default and hence missed the deadline, would at the time of their return
                                            continue their payment at a price increase determined automatically
                                            for each month spent after deadline. .
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-4 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-4 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-4 ">
                                            <span class="badge ">4</span>What are the documents attached to these
                                            estates?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-4 " class="collapse " aria-labelledby="faqHeading-4 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Documents varies depending on your choice of location, ranging from a
                                            Registered regular survey to a C of O. Meanwhile the following are assured
                                            documents you get; offer letter/acknowledgement letter, payment receipt
                                            etc.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-2 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-5 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-5 ">
                                            <span class="badge ">5</span> Can I change my location of choice?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-5 " class="collapse " aria-labelledby="faqHeading-5 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Change of location is allowed just once after subscription and can be done
                                            based on the cases below

                                            <br />Case 1 : Users who want to upgrade their location from a lower priced
                                            location to a higher priced location, can do this at no extra charges.

                                            <br />Case 2: Users who decide to downgrade their location from a higher
                                            priced location to a lower priced location are charged an extra 10% on the
                                            new location price.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-6 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-6 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-6 ">
                                            <span class="badge ">6</span> Can I buy more than one land?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-6 " class="collapse " aria-labelledby="faqHeading-6 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Yes you can buy as many lands that you can pay for. Please note that, you
                                            have to have paid up to 70% of your existing subscriptions before you can be
                                            allowed to subscribe to other locations and completed payment
                                            for a particular location before you can subscribe to same location again.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-7 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-7 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-7 ">
                                            <span class="badge ">7</span> Can I transfer my ownership?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-7 " class="collapse " aria-labelledby="faqHeading-7 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Yes you can but this can only be done after successful completion of payment
                                            and allocation of the land. And we advise that we be informed to allow us
                                            prepare a proper documentation for the buyer. Note that we do
                                            this by carrying out both users verification before treating this request.
                                            READ OUR TERMS AND CONDITIONS.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-8 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-8 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-8 ">
                                            <span class="badge ">8</span> When does my land get allocated to me?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-8 " class="collapse " aria-labelledby="faqHeading-8 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Prior to completion of payments, lands are allocated within 14 working days
                                            after completing payment.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-9 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-9 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-9 ">
                                            <span class="badge ">9</span> I don’t have an internet enabled phone, how do
                                            I benefit from this?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-9 " class="collapse " aria-labelledby="faqHeading-9 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>We have field agents readily available to assist with processing your
                                            payments and managing your account.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-10 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-10 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-10 ">
                                            <span class="badge ">10</span> Can I pay outright?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-10 " class="collapse " aria-labelledby="faqHeading-10 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Definitely. A user can decide to pay for his location of choice instantly.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-11 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-11 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-11 ">
                                            <span class="badge ">11</span> Is there a particular kind of structure to be
                                            built at the estate?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-11 " class="collapse " aria-labelledby="faqHeading-11 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>No. All owners are allowed to raise any structure of their choice.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-12 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-12 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-12 ">
                                            <span class="badge ">12</span> Are the lands on wet or dry lands?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-12 " class="collapse " aria-labelledby="faqHeading-12 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>All our estates are located on dry lands.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-13 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-13 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-13 ">
                                            <span class="badge ">13</span> Can I refer my friends?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-13 " class="collapse " aria-labelledby="faqHeading-13 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Yes you can and you earn massively for doing this.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-14 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-14 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-14 ">
                                            <span class="badge ">14</span> How do I become a sales agent with yurLAND?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-14 " class="collapse " aria-labelledby="faqHeading-14 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Send a direct message to our support line.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-15 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-15 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-15 ">
                                            <span class="badge ">15</span> What is the limit to the amount lands that I
                                            can buy?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-15 " class="collapse " aria-labelledby="faqHeading-15 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>There are no limit to the amount of lands you can own although you can only
                                            add one land to cart at a time.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-16 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-16 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-16 ">
                                            <span class="badge ">16</span> Can I add a land to my cart to save and start
                                            paying for it later?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-16 " class="collapse " aria-labelledby="faqHeading-16 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>No. Lands added to cart can be bought by another user if you do not complete
                                            your purchase by making at least a one-time payment</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-17 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-17 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-17 ">
                                            <span class="badge ">17</span> How many plots of land is a unit?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-17 " class="collapse " aria-labelledby="faqHeading-17 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>A unit is equal to half a plot ranging from 250sqm-300sqm depending on the
                                            location of choice.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-18 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-18 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-18 ">
                                            <span class="badge ">18</span>How do I qualify for the free 1 unit?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-18 " class="collapse " aria-labelledby="faqHeading-18 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>You need to buy up to 4 units outrightly, on any specific location to qualify
                                            for 1 free unit on that location.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-19 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-19 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-19 ">
                                            <span class="badge ">19</span> How can I make payment?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-19 " class="collapse " aria-labelledby="faqHeading-19 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Currently there are three payment options available on the platform; Outright
                                            payment feature, Auto-debit payment feature and manual payment feature.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-20 ">
                                    <div class="mb-0 ">
                                        <h5 class="faq-title " data-toggle="collapse " data-target="#faqCollapse-20 "
                                            data-aria-expanded="false " data-aria-controls="faqCollapse-20 ">
                                            <span class="badge ">20</span> Is there a receipt for every payment I make?
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-20 " class="collapse " aria-labelledby="faqHeading-20 "
                                    data-parent="#accordion ">
                                    <div class="card-body ">
                                        <p>Yes, our payment processor partners provide you with a mail alert of every
                                            payment made on your account.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header " id="faqHeading-21>
                        <div class=" mb-0 ">
                            <h5 class=" faq-title " data-toggle=" collapse " data-target="
                                    #faqCollapse-21 " data-aria-expanded=" false " data-aria-controls=" faqCollapse-21 ">
                                <span class=" badge ">21</span> What happens if a buyer dies and cannot continue payment?
                            </h5>
                        </div>
                    </div>
                    <div id=" faqCollapse-21 " class=" collapse " aria-labelledby=" faqHeading-21 " data-parent="
                                    #accordion ">
                        <div class=" card-body ">
                            <p>We engage the next of kin to take up the plan, if the user is unavailable or unreachable after multiple trials.</p>
                        </div>
                    </div>
                </div>
                <div class=" card ">
                    <div class=" card-header " id=" faqHeading-22 ">
                        <div class=" mb-0 ">
                            <h5 class=" faq-title " data-toggle=" collapse " data-target="
                                    #faqCollapse-22 " data-aria-expanded=" false " data-aria-controls=" faqCollapse-22 ">
                                <span class=" badge ">22</span> Can I resell my land?
                            </h5>
                        </div>
                    </div>
                    <div id=" faqCollapse-22 " class=" collapse " aria-labelledby=" faqHeading-22 " data-parent="
                                    #accordion ">
                        <div class=" card-body ">
                            <p>Prior to completion of payment and allocation of the land, owners are legible to resell. Although we advise that we be informed to allow us prepare a proper documentation for the new buyer.</p>
                        </div>
                    </div>
                </div><br/><br/>

            </div>
        </div>
    </div>


    </section>

    </div>
    <br/><br/><br/>
    <div class=" container-fluid gtco-feature " id=" services ">
        <div class=" container ">
            <div class=" row ">
                <div class=" col-md-7 ">
                    <div class=" cover ">
                        <div class=" card ">
                            <svg class=" back-bg " width=" 100% " viewBox=" 0 0 900 700 " style=" position:absolute;
                                    z-index: -1 ">
                            <defs>
                                <linearGradient id=" PSgrad_01 " x1=" 64.279% " x2=" 0% " y1=" 76.604% " y2=" 0% ">
                                    <stop offset=" 0% " stop-color=" rgb(1,230,248) " stop-opacity=" 1 "/>
                                    <stop offset=" 100% " stop-color=" rgb(29,62,222) " stop-opacity=" 1 "/>
                                </linearGradient>
                            </defs>
                            <path fill-rule=" evenodd " opacity=" 0.102 " fill=" #7e252b "
                                  d=" M616.656,2.494 L89.351,98.948 C19.867,111.658 -16.508,176.639 7.408,240.130
                                    L122.755,546.348 C141.761,596.806 203.597,623.407 259.843,609.597 L697.535,502.126
                                    C748.221,489.680 783.967,441.432 777.751,392.742 L739.837,95.775 C732.096,35.145
                                    677.715,-8.675 616.656,2.494 Z "/>
                        </svg>
                            <!-- *************-->

                            <svg width=" 100% " viewBox=" 0 0 700 500 ">
                            <clipPath id=" clip-path ">
                                <path d=" M89.479,0.180 L512.635,25.932 C568.395,29.326 603.115,76.927 590.357,129.078
                                    L528.827,380.603 C518.688,422.048 472.661,448.814 427.190,443.300 L73.350,400.391
                                    C32.374,395.422 -0.267,360.907 -0.002,322.064 L1.609,85.154 C1.938,36.786
                                    40.481,-2.801 89.479,0.180 Z "></path>
                            </clipPath>
                            <!-- xlink:href for modern browsers, src for IE8- -->
                            <image clip-path=" url(#clip-path) " xlink:href=" images/doorstep.png " width=" 95% "
                                   height=" 465 " class=" svg__image "></image>
                        </svg>
                        </div>
                    </div>
                </div>
                <div class=" col-md-5 "><br/><br/><br/><br/><br/>
                    <h2> Have Other Questions?</h2>
                    <p> Contact our support lines directly for any further assistance you may require. </p>
                    <p>
                        <small>
                    </small>
                    </p>
                    <a href=" # ">Contact Support now<i class=" fa fa-angle-right " aria-hidden=" true "></i></a></div>
            </div>
        </div>
    </div>

    <div class=" container-fluid gtco-feature " id=" services ">
        <div class=" container ">
            <div class=" row ">
                <div class=" col-md-7 ">
                    <div class=" cover ">
                        <div class=" card ">
                            <svg class=" back-bg " width=" 100% " viewBox=" 0 0 900 700 " style=" position:absolute;
                                    z-index: -1 ">
                            <defs>
                                <linearGradient id=" PSgrad_01 " x1=" 64.279% " x2=" 0% " y1=" 76.604% " y2=" 0% ">
                                    <stop offset=" 0% " stop-color=" rgb(1,230,248) " stop-opacity=" 1 "/>
                                    <stop offset=" 100% " stop-color=" rgb(29,62,222) " stop-opacity=" 1 "/>
                                </linearGradient>
                            </defs>
                            <path fill-rule=" evenodd " opacity=" 0.102 " fill=" #7e252b "
                                  d=" M616.656,2.494 L89.351,98.948 C19.867,111.658 -16.508,176.639 7.408,240.130
                                    L122.755,546.348 C141.761,596.806 203.597,623.407 259.843,609.597 L697.535,502.126
                                    C748.221,489.680 783.967,441.432 777.751,392.742 L739.837,95.775 C732.096,35.145
                                    677.715,-8.675 616.656,2.494 Z "/>
                        </svg>
                            <!-- *************-->

                            <svg width=" 100% " viewBox=" 0 0 700 500 ">
                            <clipPath id=" clip-path ">
                                <path d=" M89.479,0.180 L512.635,25.932 C568.395,29.326 603.115,76.927 590.357,129.078
                                    L528.827,380.603 C518.688,422.048 472.661,448.814 427.190,443.300 L73.350,400.391
                                    C32.374,395.422 -0.267,360.907 -0.002,322.064 L1.609,85.154 C1.938,36.786
                                    40.481,-2.801 89.479,0.180 Z "></path>
                            </clipPath>
                            <!-- xlink:href for modern browsers, src for IE8- -->
                            <image clip-path=" url(#clip-path) " xlink:href=" images/getstarted.png " width=" 100% "
                                   height=" 465 " class=" svg__image "></image>
                        </svg>
                        </div>
                    </div>
                </div>
                <div class=" col-md-5 "><br/>
                    <h2> Getting Started is Easy </h2>
                    <br/>
                    <p>
                        <ul>
                            <h3>
                                <li>Find An Estate</li>
                                <li>Choose your payment Plan</li>
                                <li>Start and complete your payment</li>
                                <li>Own your Land</li>
                            </h3>
                        </ul>

                    </p>
                    <p>

                    </p>
                    <br/><br/>
                    <a href=" ../getstarted.php">Start Here <i class=" fa fa-angle-right "
                                        aria-hidden=" true "></i></a></div>
                            </div>
                        </div>
                    </div>
                    <br.><br /><br />


                        <footer class=" container-fluid " id=" gtco-footer ">
                            <div class=" container ">
                                <div class=" row ">
                                    <div class=" col-md-7 " id=" contact ">
                                        <section class=" faq-section ">
                                            <div class=" container ">
                                                <div class=" row ">
                                                    <!-- ***** FAQ Start ***** -->

                                                </div>
                                            </div>
                                        </section><br /><br /><br />

                                    </div>
                                    <div class=" col-md-6 ">
                                        <div class=" row ">
                                            <div class=" col-6 ">
                                                <h4>Company</h4>
                                                <ul class=" nav flex-column company-nav ">

                                                    <li class=" nav-item "><a class=" nav-link "
                                                            href=" story.php ">About Us</a></li>
                                                    <li class=" nav-item "><a class=" nav-link " href=" how.php ">How It
                                                            Works</a></li>
                                                    <li class=" nav-item "><a class=" nav-link "
                                                            href=" story.php ">Story</a></li>

                                                </ul>
                                                <h4 class=" mt-6 ">Follow Us</h4>
                                                <ul class=" nav follow-us-nav ">
                                                    <li class=" nav-item "><a class=" nav-link pl-0 " href="
                                    https://medium.com/@yurland.ng "><i class=" fa fa-medium "
                                                                aria-hidden=" true "></i></a></li>
                                                    <li class=" nav-item "><a class=" nav-link " href="
                                    https://twitter.com/yurlandng "><i class=" fa fa-twitter "
                                                                aria-hidden=" true "></i></a></li>
                                                    <li class=" nav-item "><a class=" nav-link " href="
                                    https://instagram.com/yurlandng "><i class=" fa fa-instagram "
                                                                aria-hidden=" true "></i></a></li>
                                                    <li class=" nav-item "><a class=" nav-link " href="
                                    https://youtube.com/@yurland "><i class=" fa fa-youtube "
                                                                aria-hidden=" true "></i></a></li>
                                                </ul>
                                            </div>
                                            <div class=" col-6 ">
                                                <h4>Info</h4>
                                                <ul class=" nav flex-column services-nav ">
                                                    <li class=" nav-item "><a class=" nav-link " href="
                                    https://medium.com/@yurland.ng " target=" _blank ">Learn</a></li>
                                                    <li class=" nav-item "><a class=" nav-link "
                                                            href=" terms.php ">T&C</a></li>
                                                    <li class=" nav-item "><a class=" nav-link " href=" # ">Contact
                                                            Us</a></li>

                                                </ul>
                                            </div><br /><br /><br />
                                            <div class=" col-3 "></div>
                                            <div class=" col-6 ">
                                                <br /><br /><br />
                                                <p> A member of <br /><img src=" images/ilu2.png " width=" 100 " /> </p>
                                            </div>
                                            <div class=" col-3 "></div>
                                            <div class=" col-12 ">
                                                <p>&copy; 2023. All Rights Reserved. Developed by <a href=" "
                                                        target=" _blank ">Arklips</a>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </footer>

                        <!-- Optional JavaScript -->
                        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                        <script src=" js/jquery-3.3.1.slim.min.js "></script>
                        <script src=" js/popper.min.js "></script>
                        <script src=" js/bootstrap.min.js "></script>
                        <!-- owl carousel js-->
                        <script src=" owl-carousel/owl.carousel.min.js "></script>
                        <script src=" js/main.js "></script>
</body>

</html>