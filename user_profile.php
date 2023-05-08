<?php
session_start();
require_once "MySQL.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="Ecommerce &raquo; HTML Template"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>Thiyasara Katalise | User Profile</title>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="assets/images/logo.png"/>

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

<body style="background-color: #F1F2FF">

<!--page start-->
<div class="page">

    <?php require "alert.php" ?>
    <!--header start-->
    <!-- site-header-menu -->
    <div id="site-header-menu" class="site-header-menu ttm-bgcolor-white clearfix">
        <div class="site-header-menu-inner stickable-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main_nav_content d-flex flex-row">
                            <!--site-navigation -->
                            <div id="site-navigation" class="site-navigation">
                                <div class="btn-show-menu-mobile menubar menubar--squeeze">
                                    <span class="menubar-box">
                                        <span class="menubar-inner"></span>
                                    </span>
                                </div>
                                <!-- menu -->
                                <nav class="menu menu-mobile" id="menu">
                                    <ul class="nav">
                                        <li class="mega-menu-item active">
                                            <a href="index.php">Home</a>
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="about-us.php">About Us</a>
                                        </li>
                                        <li>
                                            <a href="contact.php">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div><!-- site-navigation end-->
                            <div class="user_zone_block d-flex flex-row align-items-center justify-content-end ml-auto">
                                <div class="icon"><i class="fa fa-gift"></i></div>
                                <h6 class="text">New User Zone</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- site-header-menu end -->
    <!--header end-->

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">User Profile</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">User Profile</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title end-->

    <?php
    $user_rs = MySQL::search_prepared("SELECT * FROM user WHERE user.email = ?", [$_SESSION["user"]["email"]], 's');
    $user = $user_rs->fetch_assoc();
    ?>

    <!--site-main start-->
    <div class="site-main">
        <div class="col-12 ">
            <div class="row">
                <div class="col-3 border m-3 bg-white">
                    <div class="d-flex flex-column align-items-center text-center p-3">

                        <?php
                        $profile_img_rs = MySQL::search_prepared("SELECT * FROM profile_image WHERE user_email = ?", [$user["email"]], 's');
                        if ($profile_img_rs->num_rows == 1) {
                            $profile_images = $profile_img_rs->fetch_assoc();
                            if ($profile_images["path"] == null) {
                                ?>

                                <img id="viewimg" src="assets/images/profile_img/newuser.svg" class="rounded mt-5"
                                     style="width: 150px;"/>

                                <?php
                            } else {
                                ?>

                                <img id="viewimg" src="<?= $profile_images['path'] ?>" class="rounded mt-5"
                                     style="width: 150px;"/>

                                <?php
                            }
                        } else {
                            ?>
                            <img id="viewimg" src="assets/images/profile_img/newuser.svg" class="rounded mt-5"
                                 style="width: 150px;"/>
                            <?php
                        }
                        ?>

                        <span class="fw-bold">
                           <?php echo $user["fname"]; ?><?php echo $user["lname"]; ?>
                       </span>
                        <span class="text-black-50">
                           <?php echo $user["email"]; ?>
                       </span>

                        <input class="d-none" type="file" accept="img/*" id="profileimg"/>
                        <label for="profileimg" class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                onclick="change_image('<?= $user['email'] ?>');">Update Profile Image
                        </label>

                    </div>
                </div>
                <div class="col-8 border m-3 bg-white">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold">USER DETAILS</h4>
                        </div>

                        <div class="row mt-3">

                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" id="fn" class="form-control" value="<?php echo $user["fname"]; ?>"/>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" id="ln" class="form-control" value="<?php echo $user["lname"]; ?>"/>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Mobile</label>
                                <input type="text" id="mo" class="form-control" value="<?php echo $user["mobile"]; ?>"/>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" aria-describedby="viewpassword"
                                           id="pwtxt" value="<?php echo $user["password"]; ?>" disabled>
                                    <button class="site-button m-r5 button-lg radius-no" id="viewpassword" onclick="#">
                                        <i class="bi bi-eye-fill"></i></button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input id="uemail" type="email" class="form-control" value="<?php echo $user["email"]; ?>"
                                       readonly/>
                            </div>

                            <div class="col-md-12 mt-1">
                                <label class="form-label">Registered Date</label>
                                <input type="text" class="form-control" value="<?php echo $user["reg_date"]; ?>"
                                       readonly/>
                            </div>




                            <div class="col-md-12 d-grid my-3">
                                <button class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                        onclick="user_update_profile();">Update My Profile
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--site-main end-->

    <!--footer start-->
    <?php require "footer.php" ?>
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
<script src="assets/js/script.js"></script>
<script src="assets/js/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<!-- Javascript end-->

</body>

</html>