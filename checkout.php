<?php
session_start();
require "MySQL.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$check_rs = MySQL::search("SELECT *, cart.qty as qty FROM cart INNER JOIN product ON cart.product_id=product.id WHERE user_email = '" . $_SESSION['user']['email'] . "'");

if($check_rs->num_rows == 0) {
    header("Location: cart.php");
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
    <meta name="author" content="https://www.themetechmount.com/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>Fixfellow &#8211; Tools Store Ecommerce Html Template</title>

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
    <?php require "header.php" ?>
    <!--header end-->

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Checkout</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->

    <!--site-main start-->
    <div class="site-main">

        <!-- checkout-section -->
        <section class="checkout-section clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ttm-form-tag">
                            <div class="checkout-top-form-tag"> Have a coupon? <a href="cart.php">Click here to enter
                                    your code</a></div>
                        </div>
                        <div class="ttm-form-tag">
                            <div class="checkout-top-form-tag"> Returning customer? <a href="#">Click here to login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 ">
                        <form id="checkout-form" class="checkout row" onsubmit="payment(event)">
                            <div class="col-lg-12">
                                <div class="billing-fields">
                                    <div class="content-sec-head-style">
                                        <div class="content-area-sec-title">
                                            <h5>Billing details</h5>
                                        </div>
                                    </div>
                                    <div class="billing-fields-wrapper pt-10">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-row">
                                                    <label>First name</label>
                                                    <input type="text" class="input-text" name="billing_first_name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-row">
                                                    <label>Last name</label>
                                                    <input type="text" class="input-text" name="billing_last_name">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <label>Email Address</label>
                                                    <input type="email" class="input-text " name="billing_email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <label>Mobile&nbsp;<span class="optional"></span></label>
                                                    <input type="tel" class="input-text " name="billing_phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <label>Address</label>
                                                    <input type="text" class="input-text" name="billing_address_1"
                                                           placeholder="Street Address Line 1">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <input type="text" class="input-text" name="billing_address_2"
                                                           placeholder="Street Address Line 2">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <select name="billing_city" id="billing_city" onchange="update_delivery_fee()">
                                                        <option value="0">Select City</option>
                                                        <?php
                                                        $city_rs = MySQL::search("SELECT * FROM city");
                                                        while ($city_data = $city_rs->fetch_assoc()) {
                                                            ?>
                                                            <option id="city<?= $city_data['id'] ?>" value="<?= $city_data['id'] ?>"><?= $city_data['name'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="pt-30 res-991-pt-15">
                                    <div class="content-sec-head-style">
                                        <div class="content-area-sec-title">
                                            <h5>Your Orders</h5>
                                        </div>
                                    </div>
                                    <div id="order_review" class="checkout-review-order">
                                        <table class="cart_table checkout-review-order-table">
                                            <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Price</th>
                                            </tr>
                                            </thead>

                                            <?php

                                            $sub_total = 0;
                                            while ($check = $check_rs->fetch_assoc()) {
                                                $sub_total += ($check["price"] * $check["qty"]);
                                                ?>
                                                <tbody>
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <?php echo $check["title"] ?>
                                                        <strong class="product-quantity">× <?php echo $check["qty"] ?></strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="Price-amount">
                                                            <span class="Price-currencySymbol">Rs. <?= $check["price"] * $check["qty"] ?>.00</span>
                                                        </span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <?php
                                            }
                                            ?>
                                            <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Sub Total</th>
                                                <td>
                                                        <span class="Price-amount amount">
                                                            Rs.<span class="Price-currencySymbol" id="billing_sub_total"><?= $sub_total ?></span>.00
                                                       </span>
                                                </td>
                                            </tr>
                                            <tr class="cart-shipping">
                                                <th>Delivery Fee</th>
                                                <td>
                                                    <?php
                                                    $colombo_rs = MySQL::search("SELECT * FROM city WHERE name='Colombo'");
                                                    $colombo = $colombo_rs->fetch_assoc();
                                                    ?>
                                                        <span class="Price-amount amount" >
                                                           RS.<span id="billing_delivery_fee"><?= $colombo['delivery_fee'] ?></span>.00
                                                        </span>
                                                </td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td><strong>
                                                        <span class="woocommerce-Price-currencySymbol">RS. <span id="billing_total" name="billing_total"><?= $sub_total + $colombo['delivery_fee'] ?></span>.00</span>
                                                        <span class="woocommerce-Price-amount amount">
                                                        </span>
                                                    </strong>
                                                </td>
                                            </tr>
                                            </tfoot>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="pt-80 res-991-pt-50">
                                    <div class="checkout-payment-method">
                                        <!-- payment-method -->
                                        <div class="payment-method">

                                            <div class="paymentBox mb-15">
                                                <label><input type="radio" name="payment-method" value="paypal"
                                                              checked="checked"> PayHere
                                                    <span class="mt-10 mb-10 ml-25">
                                                        <img src="assets/images/payment-paypal.png" alt=""> <span
                                                                class="mt-5"></span>
                                                    </span>
                                                </label>
                                                <div class="payment-detail"><p>Please send a Check to Store name with
                                                        Store Street, Store Town, Store State, Store Postcode, Store
                                                        Country.</p></div>
                                            </div>
                                            <div class="paymentBox mb-15">
                                                <label><input type="checkbox" id="accept_terms">I’ve read and accept the
                                                    terms &amp; conditions</label>
                                            </div>
                                        </div>
                                        <!-- payment-method end  -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9"></div>
                            <div class="col-lg-3">
                                <div class="text-right place-order mt-30">
                                    <div class="">
                                        <button type="submit"
                                           class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-left ttm-btn-color-skincolor">Place
                                            Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- checkout-section end -->

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
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
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
<script src="assets/js/payment.js"></script>

<!-- Javascript end-->

</body>


</html>

