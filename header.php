<?php require_once "MySQL.php"; ?>
<link rel="stylesheet" href="assets/css/style.css">
<!--header start-->
<header id="masthead" class="header ttm-header-style-01">
    <!-- top_bar -->
    <div class="top_bar">
        <div class="container">
            <div class="row">
                <div>
                    Welcome <span
                            class="text-warning"><?= (isset($_SESSION["user"])) ? $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"] : "to Thiyasara Katalise" ?></span>
                </div>
                <div class="col d-md-flex flex-row">
                    <div class="top_bar_content ml-auto">
                        <div class="top_bar_user">

                            <!--WatchList-->
                            <div>
                                <?php
                                if (isset($_SESSION["user"])) {
                                    $watchlist_rs = MySQL::search_prepared("SELECT * FROM watchlist WHERE user_email=?", [$_SESSION["user"]["email"]], 's');
                                    $watchlist_num = $watchlist_rs->num_rows;
                                    ?>
                                    <a href="wishlist.php">Wishlist (<?= $watchlist_num ?>)</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="wishlist.php">Wishlist (0)</a>
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="top_bar_menu">
                                <ul class="top_bar_dropdown">
                                    <li><a href="#" data-toggle="dropdown">$ Currency</a>
                                        <ul>
                                            <li><a href="#">SL Rs</a></li>
                                            <li><a href="#">USD $</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#" data-toggle="dropdown"><span class="mr-2"><img
                                                        src="assets/images/flag.jpg" alt="img"></span>Language</a>
                                        <ul>
                                            <li><a href="#"><span class="mr-2"><img src="assets/images/English-icon.jpg"
                                                                                    alt="img"></span>English</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top_bar end-->

    <!-- header_main -->
    <div class="header_main">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-3 col-sm-3 col-3 order-1">
                    <!-- site-branding -->
                    <div class="site-branding">
                        <a class="header-title" href="index.php">Thiyasara Katalise</a>
                    </div>
                    <!-- site-branding end -->
                </div>
                <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                    <div class="header_search"><!-- header_search -->
                        <div class="header_search_content">
                            <div id="search_block_top" class="search_block_top">
                                <form id="searchbox" method="get" action="shop.php">
                                    <input class="search_query form-control" type="text" id="search_query_top" name="search"
                                           placeholder="Search For Shopping....">
                                    <div class="categories-block">
                                        <select id="search_category" name="category" class="form-control">
                                            <option value="all">All Categories</option>
                                            <?php

                                            $category_rs = MySQL::search("SELECT * FROM `category`");
                                            $num = $category_rs->num_rows;

                                            for ($x = 0; $x < $num; $x++) {
                                                $cd = $category_rs->fetch_assoc();
                                                ?>
                                                <option value="<?php echo $cd["id"]; ?>"><?php echo $cd["name"]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-default button-search">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- header_search end -->
                </div>

                <div class="col-lg-3 col-9 order-lg-3 order-2 text-lg-left text-right">
                    <!-- header_extra -->
                    <div class="header_extra d-flex flex-row align-items-center justify-content-end">

                        <div class="account dropdown">
                            <div class="d-flex flex-row align-items-center justify-content-start">
                                <div class="account_icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="account_content">
                                    <?php

                                    if (isset($_SESSION["user"])) {
                                        ?>
                                        <a class="text-white"><?= $_SESSION['user']['fname'] . ' ', $_SESSION['user']['lname'] ?></a>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="account_text"><a href="login.php">Sign in</a></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="account_extra dropdown_link" data-toggle="dropdown">Account</div>
                            <?php
                            if (isset($_SESSION["user"])) {
                                ?>
                                <aside class="widget_account dropdown_content">
                                    <div class="widget_account_content">
                                        <ul>
                                            <li><i class="fa fa-user mr-2"></i><a href="user_profile.php">Profile</a>
                                            </li>
                                            <li><i class="fa fa-cart-arrow-down mr-2"></i><a href="cart.php">Cart</a>
                                            </li>
                                            <li><i class="fa fa-heart mr-2"></i><a href="wishlist.php">Wishlist</a></li>
                                            <!--TODO: order history-->
                                            <li><i class="fa fa-tasks mr-2"></i><a href="purchasehistory.php">Order History</a></li>
                                            <li><i class="fa fa-sign-out mr-2"></i><a
                                                        href="process/signout_process.php">Sign Out</a></li>
                                        </ul>
                                    </div>
                                </aside>
                                <?php
                            }
                            ?>

                        </div>

                        <?php

                        if (isset($_SESSION["user"])) {
                            $cart_rs = MySQL::search_prepared("SELECT *, cart.qty as qty FROM cart INNER JOIN product ON cart.product_id=product.id 
                            INNER JOIN product_img ON product.id=product_img.product_id WHERE cart.user_email = ?", [$_SESSION["user"]["email"]], 's');

                            ?>

                            <div class="cart dropdown">
                                <div class="dropdown_link d-flex flex-row align-items-center justify-content-end"
                                     data-toggle="dropdown">
                                    <div class="cart_icon">
                                        <i class="fa fa-shopping-cart"></i>
                                        <div class="cart_count" id="cart-count"><?= $cart_rs->num_rows ?></div>
                                    </div>
                                    <div class="cart_content" >
                                        <div class="cart_text"><a href="#">My Cart</a></div>
                                        <?php
                                        $total = 0;
                                        while ($cart = $cart_rs->fetch_assoc()) {
                                            $total += (int)$cart["price"];
                                        }
                                            ?>
                                        <div class="cart_price">Rs.<span id="cart-price"><?= $total ?></span>.00</div>
                                    </div>
                                </div>
                                <aside class="widget_shopping_cart dropdown_content">
                                    <ul class="cart-list">
                                        <?php
                                        mysqli_data_seek($cart_rs, 0);
                                        while ($cart = $cart_rs->fetch_assoc()) {
                                            ?>
                                            <li>
                                                <a href="#" class="photo"><img src="<?php echo $cart["path"] ?>"
                                                                               class="cart-thumb" alt=""/></a>
                                                <h6><a href="#"><?php echo $cart["title"] ?></a></h6>
                                                <p><?php echo $cart["qty"] ?>x - <span
                                                            class="price">Rs. <?php echo $cart["price"] ?></span></p>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <li class="total">
                                            <span class="pull-right"><strong>Total</strong>: Rs.<?= $total ?>.00</span>
                                            <a href="<?= (isset($_SESSION["user"])) ? 'cart.php' : '#' ?>"
                                               class="btn btn-default btn-cart">Cart</a>
                                        </li>
                                    </ul>
                                </aside>
                            </div>

                            <?php
                        }else {
                        ?>
                        <div class="cart dropdown">
                            <div class="dropdown_link d-flex flex-row align-items-center justify-content-end"
                                 data-toggle="dropdown">

                                <div class="cart_icon">
                                    <i class="fa fa-shopping-cart"></i>
                                    <div class="cart_count">0</div>
                                </div>
                                <div class="cart_content" >
                                    <div class="cart_text"><a href="#">My Cart</a></div>

                                    <div class="cart_price">Rs.0.00</div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- header_extra end -->
                    </div>
                </div>
            </div>
        </div><!-- haeder-main end -->

        <!-- site-header-menu -->
        <div id="site-header-menu" class="site-header-menu ttm-bgcolor-white clearfix">
            <div class="site-header-menu-inner stickable-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main_nav_content d-flex flex-row">
                                <div class="cat_menu_container">
                                    <a href="#" class="cat_menu d-flex flex-row align-items-center">
                                        <div class="cat_icon"><i class="fa fa-bars"></i></div>
                                        <div class="cat_text"><span>Shop by</span><h4>Categories</h4></div>
                                    </a>
                                    <ul class="cat_menu_list menu-vertical">
                                        <li><a href="#" class="close-side"><i class="fa fa-times"></i></a></li>

                                        <?php
                                        mysqli_data_seek($category_rs, 0);
                                        while ($ct = $category_rs->fetch_assoc()) {
                                            ?>
                                            <li><a href="#"><?= $ct["name"] ?></a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>

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
                                </div>
                                <!-- site-navigation end-->

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
</header>
<!--header end-->