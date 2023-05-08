<?php
session_start();
require "MySQL.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Ecommerce &raquo; HTML Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Thiyasara Katalise | Contact Us</title>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="assets/images/logo.png" />

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>

    <!-- animate -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css"/>

    <!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css"/>

    <!-- themify -->
    <link rel="stylesheet" type="text/css" href="assets/css/themify-icons.css"/>

    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">

    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">

    <!-- megamenu -->
    <link rel="stylesheet" type="text/css" href="assets/css/megamenu.css">

    <!-- shortcodes -->
    <link rel="stylesheet" type="text/css" href="assets/css/shortcodes.css"/>

    <!-- main -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"/>

    <!-- responsive -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css"/>

</head>

<body>

<!--page start-->
<div class="page">

    <!--header start-->
    <?php require "header.php"?>
    <!--header end-->

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Contact Us</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->


    <!--site-main start-->
    <div class="site-main">

        <!--google_map-->
        <div id="google_map" class="google_map">
            <div class="map_container">
                <div id="map"></div>
            </div>
        </div>
        <!-- google_map end -->
        <section class="contact-section bg-layer bg-layer-equal-height clearfix">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-8 col-md-7">
                        <div class="ttm-col-bgcolor-yes ttm-bg ttm-bgcolor-grey spacing-2">
                            <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                            <div class="layer-content">
                                <!-- section title -->
                                <div class="section-title style2">
                                    <div class="title-header">
                                        <h5>GET IN TOUCH</h5>
                                        <h2 class="title">Contact Form</h2>
                                    </div>
                                </div><!-- section title end -->
                                <form id="ttm-contactform" class="ttm-contactform wrap-form clearfix" method="post" action="#">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>
                                                <span class="text-input"><i class="ttm-textcolor-darkgrey ti-user"></i><input name="your-name" type="text" value="" placeholder="Your Name" required="required"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>
                                                <span class="text-input"><i class="ttm-textcolor-darkgrey ti-mobile"></i><input name="your-phone" type="text" value="" placeholder="Contact No" required="required"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>
                                                <span class="text-input"><i class="ttm-textcolor-darkgrey ti-email"></i><input name="email" type="email" value="" placeholder="Email" required="required"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                        </div>
                                    </div>
                                    <label>
                                        <span class="text-input"><i class="ttm-textcolor-darkgrey ti-comment"></i><textarea name="message" rows="3" cols="40" placeholder="Message" required="required"></textarea></span>
                                    </label>
                                    <input name="submit" type="submit" id="submit" class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor" value="Send Message">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="ttm-col-bgcolor-yes ttm-bg ttm-bgcolor-skincolor spacing-3">
                            <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                            <div class="layer-content">
                                <div class="box-header">
                                    <div class="box-icon">
                                        <i class="fa fa-paper-plane"></i>
                                    </div>
                                </div>
                                <h4>Contact Information</h4>
                                <ul class="ttm_contact_widget_wrapper">
                                    <li><i class="ttm-textcolor-highlight ti ti-location-pin"></i>141 A, Kothalawala, Kaduwela, Sri Lanka</li>
                                    <li>
                                        <i class="ttm-textcolor-highlight fa fa-phone"></i>Hardware Items :   +94 77 252 6464
                                    </li>
                                    <li><i class="ttm-textcolor-highlight fa fa-phone"></i>Spices :   +94 70 130 9231</li>
                                    <li><i class="ttm-textcolor-highlight fa fa-phone"></i>Woodcraft :   +94 71 139 8074</li>
                                    <li><i class="ttm-textcolor-highlight ti ti-email"></i><a href="#">ketalise@outlook.com</a></li>
                                </ul>
                                <div class="social-icons circle social-hover">
                                    <ul class="list-inline">
                                        <li class="social-facebook"><a class="tooltip-top ttm-textcolor-skincolor" href="#" data-tooltip="Facebook"><i class="ti ti-facebook" aria-hidden="true"></i></a></li>
                                        <li class="social-linkedin"><a class="tooltip-top ttm-textcolor-skincolor" href="#" data-tooltip="LinkedIn"><i class="ti ti-linkedin" aria-hidden="true"></i></a></li>
                                        <li class="social-gplus"><a class="tooltip-top ttm-textcolor-skincolor" href="#" data-tooltip="Google+"><i class="ti ti-google" aria-hidden="true"></i></a></li>
                                        <li class="social-twitter"><a class="tooltip-top ttm-textcolor-skincolor" href="#" data-tooltip="Twitter"><i class="ti ti-twitter-alt" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row end -->
            </div>
        </section>


    </div><!--site-main end-->


    <!--footer start-->
    <?php require "footer.php"?>
    <!--footer end-->

    <!--back-to-top start-->
    <a id="totop" href="#top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!--back-to-top end-->

</div><!-- page end -->


<!-- Javascript -->

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/tether.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.easing.js"></script>
<script src="assets/js/jquery-waypoints.js"></script>
<script src="assets/js/jquery-validate.js"></script>
<script src="assets/js/numinate.min.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/price_range_script.js"></script>
<script src="assets/js/easyzoom.js"></script>
<script src="assets/js/main.js"></script>

<script src="assets/js/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<!-- Javascript end-->

</body>

</html>