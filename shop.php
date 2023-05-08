<?php
require "MySQL.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="Ecommerce &raquo; HTML Template"/>
    <meta name="author" content="https://www.themetechmount.com/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>Thiyasara Katalise | Shop</title>

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

    <!-- magnific-popup -->
    <link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css"/>

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
    <?php require "header.php" ?>
    <!--header end-->

    <!-- page-title -->
    <div class="ttm-page-title-row" id="page_title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Shop</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->

    <!--site-main start-->
    <div class="site-main">


        <!-- sidebar -->
        <section class="sidebar ttm-sidebar-left clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-3 widget-area sidebar-left">
                        <aside class="widget menu-content">
                            <h3 class="widget-title"><i class="fa fa-bars"></i>All Categories</h3>
                            <?php

                            $category_rs = MySQL::search("SELECT * FROM `category`");
                            $num = $category_rs->num_rows;

                            for ($x = 0; $x < $num; $x++) {
                                $cd = $category_rs->fetch_assoc();
                                ?>

                                <ul class="menu-vertical">
                                    <li><a href="shop.php?search=&category=<?= $cd['id'] ?>"><?= $cd["name"]; ?></a>
                                    </li>
                                </ul>
                                <?php
                            }
                            ?>

                        </aside>
                        <aside class="widget widget-price-filter">
                            <h3 class="widget-title"><i class="fa fa-bars"></i>Catalog</h3>
                            <div class="product_content">
                                <div class="price_slider_wrapper">
                                    <h5>Price :</h5>
                                    <div>
                                        <div id="slider-range" class="price-filter-range"></div>
                                        <!-- price_slider_amount -->
                                        <div class="price_slider_amount">
                                            <input type="text" id="min_price" name="min_price"
                                                   placeholder="Min price"/>
                                            <input type="text" id="max_price" name="max_price"
                                                   placeholder="Max price"/>
                                            <button type="submit" class="button" onclick="advanced_search(0)">Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="size_wrapper">
                                    <h5>Brand</h5>
                                    <div class="choose-option-point">
                                        <select id="brand">
                                            <option value="0">Choose Brand</option>
                                            <?php

                                            $category_rs = MySQL::search("SELECT * FROM `brand`");
                                            $num = $category_rs->num_rows;

                                            for ($x = 0; $x < $num; $x++) {

                                                $cd = $category_rs->fetch_assoc();

                                                ?>

                                                <!--<ul class="menu-vertical">-->
                                                <option value="<?php echo $cd["id"]; ?>"><?php echo $cd["b_name"]; ?></option>
                                                <!--</ul>-->
                                                <?php

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </aside>

                        <!--Sales-->
                        <aside class="widget widget_media_image banner-image">
                            <a href="#"><img class="img-fluid" src="assets/images/widget-banner-three.jpg"
                                             alt="widget-banner"></a>
                        </aside>

                    </div>


                    <div class="col-lg-9 ">
                        <!-- banner-image -->
                        <div class="banner-image mb-40">
                            <a href="#"><img class="img-fluid" src="assets/images/banner-eight.jpg" alt=""></a>
                        </div><!-- banner-image end -->
                        <div class="products products-fitter">
                            <div class="ttm-tabs">

                                <div class="content-sec-head-style">
                                    <div class="content-area-sec-title">
                                        <h5>Our Selling Products</h5>
                                    </div>
                                    <ul class="tabs text-right">
                                        <li class="tab active"><a href="#">New Product</a></li>
                                    </ul>
                                </div>

                                <div class="content-tab">
                                    <div class="content-inner">
                                        <div class="products row d-flex justify-content-center" id="load-products">
                                            <?php

                                            if (isset($_GET["page"]) && $_GET["page"] != 0) {
                                                $page_no = $_GET["page"];
                                            } else {
                                                $page_no = 1;
                                            }


                                            if ($_GET["category"] != 'all') {
                                                $cat = $_GET["category"];
                                            } else {
                                                $cat = "%";
                                            }

                                            $product_rs = MySQL::search_prepared("SELECT * FROM product WHERE title LIKE ? AND category_id LIKE ?", ['%' . $_GET["search"] . '%', $cat], 'ss');
                                            if ($product_rs->num_rows > 0) {
                                                $results_per_page = 8;
                                                $no_of_pages = ceil($product_rs->num_rows / $results_per_page);
                                                $viewed_count = ((int)$page_no - 1) * $results_per_page;

                                                $prs = MySQL::search_prepared("SELECT *, product.id as pid FROM product WHERE title LIKE ? AND category_id LIKE ? ORDER BY price ASC LIMIT ? OFFSET ?", ['%' . $_GET["search"] . '%', $cat, $results_per_page, $viewed_count], 'ssss');
                                                while ($product = $prs->fetch_assoc()) {
                                                    ?>

                                                    <!-- product -->
                                                    <div class="product col-md-3 col-sm-6 col-xs-12">
                                                        <div class="product-box">
                                                            <!-- product-box-inner -->
                                                            <div class="product-box-inner">
                                                                <div class="product-image-box">
                                                                    <?php
                                                                    $product_img_rs = MySQL::search_prepared("SELECT * FROM product_img WHERE product_id = ?", [$product["pid"]], 's');
                                                                    $product_img = $product_img_rs->fetch_assoc();
                                                                    ?>
                                                                    <img class="img-fluid pro-image-front"
                                                                         src="<?= $product_img['path'] ?>"
                                                                         style="height: 200px;" alt="">
                                                                    <img class="img-fluid pro-image-back"
                                                                         src="<?= $product_img['path'] ?>"
                                                                         style="height: 200px;" alt="">
                                                                </div>
                                                                <div class="product-btn-links-wrapper">
                                                                    <div class="product-btn"
                                                                         onclick="add_cart('<?php echo $product["id"] ?>')">
                                                                        <a class="add-to-cart-btn tooltip-top"
                                                                           data-tooltip="Add To Cart">
                                                                            <i class="ti ti-shopping-cart"></i>
                                                                        </a>
                                                                    </div>

                                                                    <div class="product-btn">
                                                                        <a onclick="add_wishlist('<?php echo $product["id"] ?>')"
                                                                           class="wishlist-btn tooltip-top"
                                                                           data-tooltip="Add To Wishlist">
                                                                            <i class="ti ti-heart"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div><!-- product-box-inner end -->
                                                            <div class="product-content-box">
                                                                <a class="product-title"
                                                                   href="product-layout1.html">
                                                                    <h2><?= $product['title'] ?></h2>
                                                                </a>
                                                                <div class="star-ratings">
                                                                    <ul class="rating">
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star-half-full"></i>
                                                                        </li>
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                    </ul>
                                                                </div>
                                                                <span class="price">
                                                            <span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">Rs.</span><?= $product['price'] ?>.00
                                                            </span>
                                                        </span>
                                                            </div>
                                                        </div>
                                                    </div><!-- product end -->

                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="alert alert-danger text-center w-100">
                                                    <span class="fw-bold">Page Not Found 404</span><br>
                                                    <span>No product found!</span>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 offset-3">
                        <div class="pagination-block">
                            <?php
                            for ($i = 1; $i <= $no_of_pages; $i++) {
                                if ($page_no == $i) {
                                    ?>
                                    <a class="page-numbers current"
                                       href="?search=<?= $_GET['search'] ?>&category=<?= $_GET['category'] ?>&page=<?= $i ?>#page_title"><?= $i ?></a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="page-numbers"
                                       href="?search=<?= $_GET['search'] ?>&category=<?= $_GET['category'] ?>&page=<?= $i ?>#page_title"><?= $i ?></a>
                                    <?php
                                }
                            }
                            ?>
                            <a class="next page-numbers"
                               href="<?= ($page_no >= $no_of_pages) ? '' : '?search=' . $_GET['search'] . '&category=' . $_GET['category'] . '&page=' . ($page_no + 1) . '#page_title' ?>"><i
                                        class="ti ti-arrow-right"></i></a>
                        </div>
                    </div>

                </div><!-- row end -->
            </div>
        </section>
        <!-- sidebar end -->

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
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/price_range_script.js"></script>
<script src="assets/js/easyzoom.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/script.js"></script>
<!-- Javascript end-->

</body>

</html>