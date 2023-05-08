<?php
    if(!isset($_GET["uid"])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Ecommerce &raquo; HTML Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Thiyasara Katalise | Password Reset</title>

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
    <!--    --><?php //require "header.php"?>
    <!--header end-->

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Reset Password</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Reset Password</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->

    <!--site-main start-->
    <div class="page-content bg-white">
        <!--reset-section-->
        <section class="login-section bg-img2 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 ml-auto mr-auto">
                        <div class="wrap-login">
                            <div id="loginForm">
                                <div id="fp_err_msg" class="alert alert-danger p-3 d-none"></div>
                                <div class="form-group">
                                    <i class="fa fa-lock"></i>
                                    <input id="new_pwd" required class="form-control" placeholder="New Password" type="password">

                                </div>
                                <div class="form-group">
                                    <i class="fa fa-lock"></i>
                                    <input id="confirm_pwd" required class="form-control " placeholder="Re Enter New Password" type="password">
                                </div>
                                <div class="form-group">
                                    <button id="login-button" class="button action-button expand-center mb-15" onclick="user_reset_password('<?= $_GET['uid'] ?>')">
                                    <span class="label">reset</span>
                                    <span class="spinner"></span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--reset-section end-->
    </div>
    <!--site-main end-->


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

<script src="assets/js/script.js"></script>
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