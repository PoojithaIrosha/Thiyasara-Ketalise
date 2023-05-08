<?php
session_start();
require "MySQL.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Thiyasara Katalise | Purchase History</title>

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
                            <h1 class="title">Purchase History</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Purchase History</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->

    <!--site-main start-->
    <div class="site-main">

        <!-- Purchase History-section -->
        <section class="cart-section clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Purchase History_table -->
                        <table class="table cart_table shop_table_responsive">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-subtotal">Date Time</th>
                            </tr>
                            </thead>

                            <?php
                            $invoice_items_rs = MySQL::search_prepared("SELECT *, ii.qty as qty FROM invoice JOIN invoice_item ii on invoice.id = ii.invoice_id JOIN product p on p.id = ii.product_id JOIN product_img pi on p.id = pi.product_id WHERE user_email = ? ORDER BY invoice.date DESC", [$_SESSION['user']['email']], 's');
                            while ($inv_data = $invoice_items_rs->fetch_assoc()){
                            ?>

                            <tbody>
                            <tr class="cart_item">
                                <td class="product-thumbnail">
                                    <a href="product_view.php">
                                        <img class="img-fluid" src="<?php echo $inv_data["path"] ?>" alt="product-img">
                                    </a>
                                </td>
                                <td class="product-name" data-title="Product">
                                    <a href="product_view.php"><?php echo $inv_data["title"] ?></a>
                                    <span><?php echo $inv_data["description"] ?></span>
                                </td>
                                <td class="product-price" data-title="Price">
                                        <span class="Price-amount">
                                            <span class="Price-currencySymbol">Rs. <?php echo $inv_data["price"] ?></span>
                                        </span>
                                </td>
                                <!--Qty-->
                                <td class="product-quantity" data-title="Quantity">
                                    <span class="Price-amount">
                                            <span class="Price-currencySymbol"><?php echo $inv_data["qty"] ?></span>
                                        </span>
                                </td>
                                <!--Qty-->
                                <!--Total-->
                                <td class="product-subtotal" data-title="Total">
                                        <span class="Price-amount">
                                            <span class="Price-currencySymbol">Rs. <?php echo $inv_data["price"] * $inv_data['qty'] ?></span>
                                        </span>
                                </td>
                                <!--Total-->
                                <!--datetime-->
                                <td class="product-subtotal" data-title="Total">
                                        <span class="Price-amount">
                                            <span class="Price-currencySymbol"><?php echo $inv_data['date'] ?></span>
                                        </span>
                                </td>
                                <!--datetime-->
                            </tr>

                            <?php
                            }
                            ?>

                            <tr>
                                <td colspan="6" class="actions">
                                    <div class="coupon">
                                        <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-left ttm-btn-color-skincolor" href="index.php"><i class="ti ti-arrow-left"></i>Back To Shop</a>
                                    </div>
                                    <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-left ttm-btn-color-skincolor" href="#"><i class="ti ti-close"></i>Clear All</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- Purchase History-collaterals end-->
        </div>
    </div>
</div>
</section><!-- Purchase History-section end-->

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
<!-- Javascript end-->

</body>

</html>