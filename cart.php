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
    <meta chaRs. . et="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="Ecommerce &raquo; HTML Template"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>Thiyasara Katalise | Cart</title>

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
                            <h1 class="title">Cart</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title end-->
    <!--site-main start-->
    <div class="site-main">
        <!-- cart-section -->
        <section class="cart-section clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- cart_table -->
                        <table class="table cart_table shop_table_responsive">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">&nbsp</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Amount</th>
                                <th class="product-remove">&nbsp;</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $cart_rs = MySQL::search("SELECT *, cart.id as id, cart.qty as qty FROM cart INNER JOIN product ON cart.product_id=product.id 
                                INNER JOIN product_img ON product.id=product_img.product_id WHERE user_email='" . $_SESSION['user']['email'] . "'");

                            $sub_total = 0;
                            if ($cart_rs->num_rows > 0) {
                                while ($cart = $cart_rs->fetch_assoc()) {
                                    $sub_total += ($cart["price"] * $cart["qty"]);
                                    ?>
                                    <tr class="cart_item">
                                        <td class="product-thumbnail">
                                            <a href="product_view.php">
                                                <img class="img-fluid" src="<?= $cart["path"] ?>" alt="product-img">
                                            </a>
                                        </td>
                                        <td class="product-name" data-title="Product">
                                            <a href="product_view.php"><?= $cart["title"] ?></a>
                                            <span><?= $cart["description"] ?></span>
                                        </td>
                                        <td class="product-price" data-title="Price">
                                            <span class="Price-amount">
                                                Rs.<span class="Price-currencySymbol"
                                                         id="cart-product-price<?= $cart['product_id'] ?>"><?= $cart["price"] ?></span>
                                            </span>
                                        </td>
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="mt-15 mb-25">
                                                <div class="quantity">
                                                    <label>Quantity: </label>
                                                    <input type="text" value="<?= $cart['qty'] ?>"
                                                           name="quantity-number"
                                                           class="qty"
                                                           id="prod_qty<?= $cart['product_id'] ?>"
                                                           onkeyup="change_prod_qty('<?= $cart["product_id"] ?>', true); update_cart_prod_qty('<?= $cart["product_id"] ?>')">
                                                    <span class="inc"
                                                          onclick="increment_prod_qty('<?= $cart["product_id"] ?>', true);update_cart_prod_qty('<?= $cart["product_id"] ?>')">+</span>
                                                    <span class="dec"
                                                          onclick="decrement_prod_qty('<?= $cart["product_id"] ?>', true);update_cart_prod_qty('<?= $cart["product_id"] ?>')">-</span>
                                                </div>
                                                <div class="mt-2">
                                                <span class="text-danger font-weight-bold" style="font-size: 13px"
                                                      id="qty_err_msg<?= $cart["product_id"] ?>"></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal" data-title="Total">
                                            <span class="Price-amount">
                                                Rs.<span class="Price-currencySymbol cart-product-amount"
                                                         id="cart-product-amount<?= $cart['product_id'] ?>"><?= ($cart["price"] * $cart["qty"]) ?></span>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="javascript:removeFromCart('<?= $cart["id"] ?>')"
                                                   class="remove">×</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>

                                <tr>
                                    <td class="text-center text-danger border" colspan="6">
                                        <span>No product added to the cart</span><br>
                                        <a class="mt-1 ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-left ttm-btn-color-skincolor"
                                           href="index.php"><i class="ti ti-arrow-left"></i>Back To Shop</a>
                                    </td>
                                </tr>

                                <?php
                            }
                            ?>
                            <tr>
                                <td colspan="6" class="actions">
                                    <div class="coupon">
                                        <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-left ttm-btn-color-skincolor"
                                           href="index.php"><i class="ti ti-arrow-left"></i>Back To Shop</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-12">
                        <!-- cart-collaterals -->
                        <div class="cart-collaterals">
                            <div class="row">
                                <!-- <div class="col-md-4">
                                     <div class="cart_shipping mt-30">
                                         <h5>Calculate Shipping<span class="ti ti-angle-down"></span></h5>
                                         <p class="text-input orderby">
                                             <select>
                                                 <option>Sri Lanka</option>
                                                 <option>Other</option>
                                             </select>
                                         </p>
                                         <p class="text-input"><input type="text" class="input-text zip-code"
                                                                      name="shipping_name"
                                                                      placeholder="Postal Code / Zip"></p>
                                         <div class="pt-20">
                                             <p class="text-input"><input type="button"
                                                                          class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                                          name="update_cart" value="update total"></p>
                                         </div>
                                     </div>
                                 </div>-->

                                <!--Coupon-->
                                <div class="col-md-6">
                                    <div class="cart_discount mt-30">
                                        <h5>Coupon Discount<span class="ti ti-angle-down"></span></h5>
                                        <p class="pt-10">Enter Your Coupon Code If You Have Done.</p>
                                        <p class="text-input"><input type="text" class="input-text zip-code"
                                                                     name="shipping_name" placeholder="Coupon Code"></p>
                                        <div class="pt-20">
                                            <p class="text-input"><input type="button"
                                                                         class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                                         name="update_cart" value="Apply Coupon"></p>
                                        </div>
                                    </div>
                                </div>
                                <!--Coupon-->

                                <!--Sub Total-->
                                <div class="col-md-6">
                                    <div class="cart_totals res-767-mt-30">
                                        <h5>Sub Total Rs.<span>Rs.<span id="sub-total"><?= $sub_total ?></span></span></h5>
                                        <?php
                                        $user_rs = MySQL::search_prepared("SELECT * FROM user JOIN user_has_address uha on user.email = uha.user_email JOIN city c on c.id = uha.city_id WHERE user.email=?", [$_SESSION['user']['email']], 's');
                                        $user_data = $user_rs->fetch_assoc();

                                        $colombo_rs = MySQL::search("SELECT * FROM city WHERE name='Colombo'");
                                        $colombo = $colombo_rs->fetch_assoc();
                                        ?>
                                        <h5>Delivery Fee
                                            <span>Rs.<span id="delivery-fee"><?= ($user_rs->num_rows > 0) ? $user_data['delivery_fee'] : $colombo['delivery_fee'] ?></span></span>
                                        </h5>
                                        <h5>Total
                                            <span>Rs.<span id="total"><?= ($user_rs->num_rows > 0) ? $user_data['delivery_fee'] + $sub_total : $colombo['delivery_fee'] + $sub_total ?></span></span>
                                        </h5>
                                    </div>
                                    <div class="proceed-to-checkout">
                                        <a href="<?= ($cart_rs->num_rows > 0) ? 'checkout.php' : 'javascript:alert("Please add products to the cart first")' ?>" class="checkout-button button">Proceed to checkout</a>
                                    </div>
                                </div>
                                <!--Sub Total-->

                            </div>
                        </div><!-- cart-collaterals end-->
                    </div>
                </div><!-- row end-->
            </div>
        </section><!-- cart-section end-->
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
<!-- Javascript end-->

</body>

</html>