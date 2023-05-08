<?php
session_start();
require "MySQL.php";

if (!isset($_SESSION["user"]) && !isset($_GET["inv"])) {
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
    <title>Thiyasara Katalise | Invoice</title>

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
                            <h1 class="title">Invoice</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.php">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Invoice</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title end-->


    <!--site-main start-->
    <div class="site-main" >
        <div class="col-12">
            <hr/>
        </div>

        <div class="col-12 btn btn-toolbar justify-content-end">
            <button class="btn btn-dark m-2" onclick="printInvoice()"><i class="ti ti-printer"></i> Print</button>
        </div>

        <div class="col-12">
            <hr/>
        </div>

        <div class="col-12" id="page">
            <div class="row">

                <div class="col-6">
                    <div class="ms-5">
                        <div class="site-branding justify-content-center">
                            <img id="logo-img" class="img-center" src="assets/images/logo.png" style="width: 100px;"
                                 alt="logo-img">
                        </div>
                    </div>
                </div>

                <div class="col-6 text-lg-right">
                    <div class="row">

                        <div class="col-12">
                            <h3 class="fw-bold">Thiyasara Ketalise</h3>
                        </div>

                        <div class="col-12 fw-bold">
                            <span>No. 141 A</span><br/>
                            <span>Kothalawala</span><br/>
                            <span>Kaduwela</span><br/>
                            <span>Sri Lanka</span>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <hr class="border border-0 border-primary"/>
                </div>

                <?php
                $user_address_rs = MySQL::search_prepared("SELECT *, c.name as city FROM address JOIN city c on address.city_id = c.id WHERE invoice_id = ?", [$_GET['inv']], 's');
                $user_address = $user_address_rs->fetch_assoc();
                ?>

                <div class="col-12 mb-4">
                    <div class="row">

                        <div class="col-7">
                            <h2 class="text-info fw-bold">Invoice <?= $_GET['inv'] ?></h2>
                        </div>

                        <div class="col-5">
                            <h5><?= $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"] ?></h5>
                            <span><?= $user_address["line1"] ?>,</span><br/>
                            <span><?= $user_address["line2"] ?>,</span><br/>
                            <span><?= $user_address["city"] ?>.</span>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="row">

                        <?php

                        $invoice_rs = MySQL::search_prepared("SELECT * FROM invoice WHERE id = ?", [$_GET['inv']], 's');
                        $invoice_data = $invoice_rs->fetch_assoc();

                        ?>

                        <div class="col-4">
                            <span class="text-primary fw-bold">Invoice Date</span><br/>
                            <span><?= $invoice_data['date'] ?></span>
                        </div>

                        <div class="col-4">
                            <span class="text-primary fw-bold">Due Date</span><br/>
                            <span><?= $invoice_data['date'] ?></span>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <table class="table">
                        <thead>
                        <tr class="border border-1 border-dark">
                            <th>No</th>
                            <th>Description</th>
                            <th class="text-end">Quantity</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Amount (LKR)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $invoice_items_rs = MySQL::search_prepared("SELECT *, invoice_item.qty as qty FROM invoice_item JOIN product p on p.id = invoice_item.product_id WHERE invoice_id = ?", [$_GET['inv']], 's');
                        $sub_total = 0;
                        $x = 1;
                        while ($inv_item = $invoice_items_rs->fetch_assoc()) {
                            $sub_total += ($inv_item['price'] * $inv_item['qty']);
                            ?>
                            <tr class="border border-1 border-dark">
                                <td class=" fs-3"><?= $x ?></td>
                                <td class="fw-bold fs-4"><?php echo $inv_item["title"]; ?></td>
                                <td class="fw-bold fs-5 text-end pt-3"><?php echo $inv_item["qty"]; ?> Units</td>
                                <td class="fw-bold fs-5 text-end pt-3">Rs.<?php echo $inv_item["price"]; ?>.00</td>
                                <td class="fw-bold fs-5 text-end pt-3"><?php echo $inv_item['price'] * $inv_item['qty'] ?>
                                    .00
                                </td>
                            </tr>

                            <?php
                            $x++;
                        }

                        ?>


                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" class="border-0"></td>
                            <td class="fs-5 bg-dark text-white fw-bold">SUB TOTAL</td>
                            <td class="text-end bg-dark text-white fw-bold">Rs.<?php echo $sub_total; ?>.00
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="border-0"></td>
                            <td class="fs-5 border-primary">Delivery Fee</td>
                            <?php
                            $city_rs = MySQL::search_prepared("SELECT * FROM address JOIN city c on c.id = address.city_id WHERE invoice_id = ?", [$_GET['inv']], 's');
                            $city = $city_rs->fetch_assoc();
                            ?>
                            <td class="text-end border-primary">Rs.<?php echo $city["delivery_fee"]; ?>.00</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="border-0"></td>
                            <td class="fs-5 bg-primary text-white fw-bold">GRAND TOTAL</td>
                            <td class="text-end bg-primary text-white fw-bold">Rs.<?php echo $invoice_data["amount"]; ?>.00
                            </td>
                        </tr>
                        </tfoot>


                    </table>
                </div>

                <div class="col-4 text-center" style="margin-top: -100px;">
                    <h4 class="fs-1 fw-bold text-success">Thank You!</h4>
                </div>

                <div class="col-12 mt-3 mb-3 border-0 border-start border-5 border-warning rounded"
                     style="background-color: #E7FABE;">
                    <div class="row">
                        <div class="col-12 mt-3 mb-3">
                            <label class="form-label fw-bold fs-5">NOTICE :</label>
                            <label class="form-label fs-6">Purchased items can return before 7 days of Delivery.</label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr class="border border-1 border-primary"/>
                </div>

                <div class="col-12 text-center mb-3">
                    <label class="form-label fs-5 text-black-50 fw-bold">
                        Invoice was created on a computer is valid without a Signature and Seal.
                    </label>
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