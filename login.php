<?php

require_once "MySQL.php";
session_start();

if(isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

$email = "";
if(isset($_COOKIE["email"])) {
    $email = $_COOKIE["email"];
}

$password = "";
if(isset($_COOKIE["password"])) {
    $password = $_COOKIE["password"];
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
    <title>Thiyasara Katalise | LogIn Page</title>

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

    <?= require "header.php" ?>

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Login</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Login</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->

    <!--site-main start-->
    <div class="site-main">

        <!--login-section-->
        <section class="login-section bg-img2 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 ml-auto mr-auto">
                        <div class="wrap-login">
                            <div id="loginForm">
                                <div id="login_err_msg" class="alert alert-danger p-3 d-none"></div>
                                <div class="form-group">
                                    <i class="fa fa-envelope-o"></i>
                                    <input type="email" id='email' placeholder="Email" value="<?php echo $email; ?>"/>
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" id='password' placeholder="password" value="<?php echo $password; ?>"/>
                                </div>
                                <div class="form-group">
                                    <button id="login-button" class="button action-button expand-center mb-15" onclick="user_login()">
                                        <span class="label">Login</span>
                                        <span class="spinner"></span>
                                    </button>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center justify-content-start">
                                        <input type="checkbox" id="remember_me" <?= (isset($_COOKIE["email"]) && isset($_COOKIE["password"])) ? "checked":"" ?>>
                                        <label for="remember_me" class="ttm-textcolor-darkgrey">Remember Me</label>
                                    </div>
                                    <div class="d-flex flex-row align-items-center justify-content-end">
                                        <a onclick="show_forget_password_modal()" id="forgot-password-link" class="forgot-password-link" style="cursor: pointer"><u>Forgot Password?</u></a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span>Don't have an account? <a href="register.php">Register here</a></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--login-section end-->

        <!--newsletter_popup_wrap start-->
        <div class="newsletter_popup_wrap newsletter" id="forgot_pwd">
            <div class="newsletter_content">
                <button type="button" class="close" data-dismiss="newsletter">&times;</button>
                <div class="d-flex flex-row align-items-center justify-content-start">
                    <div class="ns_image">
                        <img class="img-fluid" src="assets/images/ns-img.jpg" alt="" />
                    </div>
                    <div class="ns_text-content">
                        <div class="ttm-icon ttm-icon_element-border ttm-icon_element-color-skincolor ttm-icon_element-size-md ttm-icon_element-style-round">
                            <i class="fa fa-lock"></i>
                        </div>
                        <h4>FORGET PASSWORD ?</h4>
                        <p>We will send you an email to reset your password.</p>

                        <div id="err_msg2_div" class="alert alert-danger no-bg d-none">
                            <span id="err_msg2"></span>
                        </div>
                        <div id="email_sending_div" class="alert alert-primary d-none" role="alert">
                            <div class="ms-3">
                                <span>Email is being sending, Please wait...</span>
                            </div>
                        </div>
                        <div id="email_success_div" class="alert alert-primary d-none" role="alert">
                            <div>
                                <i class="la la-check-double fs-3"></i>
                            </div>
                            <div class="ms-1">
                                <span>Email sent successfully. Please check your inbox</span>
                            </div>
                        </div>

                        <div id="subscribe_form" class="subscribe_form" method="post" action="#" data-mailchimp="true">
                            <div class="newsletter_main" id="subscribe_content">
                                <div class="form-row">
                                    <input id="fp_email" type="email" name="email" placeholder="Your Email Address.." value="">
                                </div>
                                <div class="form-row">
                                    <input type="submit" value="Submit" onclick="user_forgot_password()" class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-skincolor">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--newsletter_popup_wrap end-->

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
<!-- Javascript end-->

</body>

</html>