<?php
session_start();
require "MySQL.php";

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
    <title>Thiyasara Katalise | Wishlist</title>

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

<body>

<!--page start-->
<div class="page">

    <!--header start-->
    <?php require "header.php"; ?>
    <?php require "alert.php"; ?>
    <!--header end-->

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Wishlist</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->


    <!--site-main start-->
    <div class="site-main">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="row">

                        <?php
                        $user = $_SESSION["user"];
                        $watchlist_rs = MySQL::search_prepared("SELECT * FROM `watchlist` WHERE `user_email`= ?", [$user["email"]], 's');

                        if ($watchlist_rs->num_rows == 0) {
                            ?>

                            <!-- no items -->
                            <div class="col-12 d-flex align-items-lg-center justify-content-center">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img src="assets/images/watchlistEmptyView.png" style="width: 200px;">
                                    </div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-1 fw-bold">
                                            You have no items in your Watchlist yet.
                                        </label>
                                    </div>
                                    <div class="col-12 d-grid mb-3 text-center">
                                        <a href="index.php" class="btn btn-warning fs-3 fw-bold">
                                            Start Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- no items -->
                            <?php
                        } else {
                            ?>
                            <!-- have products -->
                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <?php
                                    while ($watchlist_data = $watchlist_rs->fetch_assoc()) {
                                        $product_id = $watchlist_data["product_id"];

                                        $product_rs = MySQL::search_prepared("SELECT * FROM `product` INNER JOIN product_img ON product.id=product_img.product_id WHERE product.`id`=?", [$product_id], 'i');
                                        $product_data = $product_rs->fetch_assoc();
                                        ?>
                                        <div class="offset-lg-3 col-12 col-lg-9 ttm-single-product-info clearfix mt-4">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-6 col-sm-12 ml-auto mr-auto">
                                                    <div class="product-gallery easyzoom-product-gallery">
                                                        <div class="product-look-preview-plus right">
                                                            <div class="pl-35 res-35-pl-15">
                                                                <div class="">
                                                                    <a href="<?= $product_data ["path"] ?>">
                                                                        <img class="img-fluid"
                                                                             src="<?= $product_data ["path"] ?>"
                                                                             style="400px;" alt=""/>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7 mt-auto mb-auto">
                                                    <div class="summary entry-summary pl-30 res-991-pl-0 res-991-pt-40 ">
                                                        <h4 class="product_title entry-title"><?= $product_data ["title"] ?></h4>

                                                        <div class="comments-notes clearfix">
                                                            <div class="product-rating clearfix">
                                                                <ul class="star-rating clearfix">
                                                                    <li><i class="fa fa-star"></i></li>
                                                                    <li><i class="fa fa-star"></i></li>
                                                                    <li><i class="fa fa-star"></i></li>
                                                                    <li><i class="fa fa-star-half-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="product_in-stock">
                                                            <?php

                                                            $in_stock = false;
                                                            if ($product_data["qty"] > 0) {
                                                                $in_stock = true;
                                                                ?>
                                                                <i class="fa fa-check-circle"></i>
                                                                <span> In Stock Only <?= $product_data["qty"] ?> left</span>

                                                                <?php
                                                            } else {
                                                                ?>
                                                                <i class="fa fa-exclamation-circle text-danger"></i>
                                                                <span class="text-danger">Out of Stock</span>
                                                                <?php
                                                            }

                                                            ?>
                                                        </div>

                                                        <div>
                                                            <span class="price">
                                                                <ins><span class="product-Price-amount">
                                                                        <span class="product-Price-currencySymbol">Rs.</span><?= $product_data["price"] ?>.00
                                                                    </span>
                                                                </ins>
                                                                <del><span class="product-Price-amount">
                                                                        <span class="product-Price-currencySymbol">Rs</span><?= (($product_data["price"] / 100) * 35) + $product_data["price"] ?>.00
                                                                    </span>
                                                                </del>
                                                            </span>
                                                        </div>

                                                        <div class="actions col-12 d-flex mt-4">
                                                            <div class="col-6 add-to-cart">
                                                                <a <?= ($in_stock) ? "href='product_view.php?product=${product_data['id']}'": "" ?>
                                                                   class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                                   style="color: white; cursor:pointer;">Buy Now</a>
                                                            </div>
                                                            <div class="col-6 add-to-cart">
                                                                <button onclick="removeFromWatchlist('<?= $watchlist_data["id"] ?>');" class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill bg-danger"
                                                                   style="color: white;">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- have products -->

                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div><!--site-main end-->


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