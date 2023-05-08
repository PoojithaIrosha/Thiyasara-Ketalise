<?php
require_once "./MySQL.php";
session_start();

$product_rs = MySQL::search_prepared("SELECT * FROM product WHERE id=?", [$_GET["product"]], 's');
$product = $product_rs->fetch_assoc();

if (empty($_GET["product"]) || $product_rs->num_rows == 0) {
    header("Location: index.php");
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
    <title>Thiyasara Katalise | Product View | <?= $product["title"] ?></title>

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
    <?php require "alert.php" ?>
    <!--header end-->

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Product View</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="home.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Product View</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->

    <!--site-main start-->
    <div class="site-main">

        <!-- single-product-section -->
        <section class="single-product-section layout-1 clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ttm-single-product-details">

                            <div class="ttm-single-product-info clearfix">
                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-12 ml-auto mr-auto">
                                        <div class="product-gallery easyzoom-product-gallery">
                                            <div class="product-look-preview-plus right">
                                                <div class="pl-35 res-767-pl-15">
                                                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                                        <?php
                                                        $product_img_rs = MySQL::search_prepared("SELECT * FROM product_img WHERE product_id=?", [$product["id"]], 'i');
                                                        $product_img = $product_img_rs->fetch_assoc();
                                                        ?>
                                                        <a href="<?= $product_img['path'] ?>"style="height: 450px; width: 400px;">
                                                            <img class="img-fluid" src="<?= $product_img['path'] ?>" style="height: 450px; width: 400px;" alt=""/>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="summary entry-summary pl-30 res-991-pl-0 res-991-pt-40">
                                            <h2 class="product_title entry-title"><?= $product["title"] ?></h2>

                                            <div class="comments-notes clearfix">
                                                <div class="product-rating clearfix">
                                                    <ul class="star-rating clearfix">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-half-full"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="product_in-stock">
                                                <?php
                                                $in_stock = false;
                                                if ($product["qty"] > 0) {
                                                    $in_stock = true;
                                                    ?>
                                                    <i class="fa fa-check-circle"></i>
                                                    <span> In Stock Only <?= $product["qty"] ?> left</span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <i class="fa fa-exclamation-circle text-danger"></i>
                                                    <span class="text-danger">Out of Stock</span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <span class="price">
                                                <ins><span class="product-Price-amount">
                                                        <span class="product-Price-currencySymbol">Rs.</span><?= $product["price"] ?>.00
                                                    </span>
                                                </ins>
                                                <del><span class="product-Price-amount">
                                                        <span class="product-Price-currencySymbol">Rs</span><?= (($product["price"] / 100) * 35) + $product["price"] ?>.00
                                                    </span>
                                                </del>
                                            </span>
                                            <div class="product-details__short-description"><?= $product['description'] ?></div>
                                            <div class="mt-15 mb-25">
                                                <div class="quantity">
                                                    <label>Quantity: </label>
                                                    <input type="text" value="1" name="quantity-number" class="qty"
                                                           id="prod_qty<?= $_GET['product'] ?>"
                                                           onkeyup="change_prod_qty('<?= $_GET["product"] ?>', false)">
                                                    <span class="inc"
                                                          onclick="increment_prod_qty('<?= $_GET["product"] ?>', false)">+</span>
                                                    <span class="dec" onclick="decrement_prod_qty('<?= $_GET["product"] ?>', false)">-</span>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="text-danger font-weight-bold" id="qty_err_msg<?= $_GET['product'] ?>"></span>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <div class="add-to-cart">
                                                    <button <?= ($in_stock) ? "" : "disabled" ?>  class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor" onclick="add_cart('<?php echo $product["id"] ?>')">Add to cart</button>
                                                </div>
                                            </div>
                                            <div class="buttons" onclick="add_wishlist('<?= $product["id"] ?>')">
                                                <a rel="nofollow" class="add_to_wishlist" style="cursor:pointer;">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                    <span class="wishlist-text">Add to Wish List</span>
                                                </a>
                                            </div>
                                            <div id="block-reassurance-1" class="block-reassurance">
                                                <ul>
                                                    <li>
                                                        <div class="block-reassurance-item">
                                                            <i class="fa fa-lock"></i>
                                                            <span>Security policy (edit with Customer reassurance module)</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="block-reassurance-item">
                                                            <i class="fa fa-truck"></i>
                                                            <span>Delivery policy (edit with Customer reassurance module)</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="block-reassurance-item">
                                                            <i class="fa fa-arrows-h"></i>
                                                            <span>Return policy (edit with Customer reassurance module)</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="pt-30 pb-60 res-991-pt-0 res-991-pb-30">
                                <div class="row no-gutters ttm-bgcolor-grey border">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <!-- featured-icon-box -->
                                        <div class="featured-icon-box style3 text-center">
                                            <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                <i class="themifyicon ti-truck"></i>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h5>Fast & Free Shopping</h5>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>All Order Over $10</p>
                                                </div>
                                            </div>
                                        </div><!-- featured-icon-box end-->
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <!-- featured-icon-box -->
                                        <div class="featured-icon-box style3 text-center">
                                            <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                <i class="themifyicon ti-reload"></i>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h5>100% Money Back Guaranty</h5>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>30 Days Money Return</p>
                                                </div>
                                            </div>
                                        </div><!-- featured-icon-box end-->
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <!-- featured-icon-box -->
                                        <div class="featured-icon-box style3 text-center">
                                            <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                <i class="themifyicon ti-comments"></i>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h5>Support 24/7 Days</h5>
                                                </div>
                                                <div class="featured-desc">
                                                    <!-- TODO: Change the no-->
                                                    <p>Hot Line: 077 252 6464</p>
                                                </div>
                                            </div>
                                        </div><!-- featured-icon-box end-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-35 related products">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="content-sec-head-style">
                                        <div class="content-area-sec-title">
                                            <h5>Our Selling Products</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <!-- slick_slider -->
                                    <div class="slick_slider"
                                         data-slick='{"slidesToShow": 4, "slidesToScroll": 4, "arrows":true, "autoplay":true, "infinite":false}'>
                                        <?php
                                        $similar_products_rs = MySQL::search_prepared("SELECT * FROM product WHERE id <> ? AND category_id = ?", [$product["id"], $product["category_id"]], 'ii');
                                        while ($similar_product = $similar_products_rs->fetch_assoc()) {
                                        ?>
                                            <!-- product -->
                                            <div class="product">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <?php
                                                            $similar_products_img_rs = MySQL::search_prepared("SELECT * FROM product_img WHERE product_id = ?", [$similar_product["id"]], 'i');
                                                            $spi = $similar_products_img_rs->fetch_assoc();
                                                            ?>
                                                            <img class="img-fluid pro-image-front"
                                                                 src="<?= $spi['path'] ?>" style="height: 200px;" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                 src="<?= $spi['path'] ?>" style="height: 200px;" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn">
                                                                <a onclick="add_cart('<?php echo $similar_product["id"] ?>')" class="add-to-cart-btn tooltip-top" data-tooltip="Add To Cart">
                                                                    <i class="ti ti-shopping-cart"></i>
                                                                </a>
                                                            </div>
                                                            <div class="product-btn" onclick="add_wishlist('<?= $similar_product["id"] ?>')"><a
                                                                                        class="wishlist-btn tooltip-top"
                                                                                        data-tooltip="Add To Wishlist"><i
                                                                            class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title"
                                                           href="product_view.php?product=<?= $similar_product['id'] ?>">
                                                            <h2><?= $similar_product["title"] ?></h2>
                                                        </a>
                                                        <div class="star-ratings">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-half-full"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                        <span class="price">
                                                            <span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">Rs.</span><?= $similar_product["price"] ?>.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                        <?php
                                        }
                                        ?>
                                    </div><!-- slick_slider end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row end -->
            </div>
        </section>
        <!-- single-product-section end -->

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