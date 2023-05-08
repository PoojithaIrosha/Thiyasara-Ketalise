<?php

require "../MySQL.php";

$minPrice = $_POST['minp'];
$maxPrice = $_POST['maxp'];
$brandId = $_POST['brand'];

if (isset($_POST["page"]) && $_POST["page"] != 0) {
    $page_no = $_POST["page"];
} else {
    $page_no = 1;
}


$query = "SELECT *, product.id as pid FROM product WHERE price BETWEEN '" . $minPrice . "' AND '" . $maxPrice . "'";

if ($brandId != '0') {
    $query .= " AND brand_id = '" . $brandId . "' ";
}

$product_rs = MySQL::search($query);

$no_of_pages = 0;
if ($product_rs->num_rows > 0) {
    $results_per_page = 10;
    $no_of_pages = ceil($product_rs->num_rows / $results_per_page);
    $viewed_count = ((int)$page_no - 1) * $results_per_page;

    $newQuery = $query . " ORDER BY price DESC LIMIT " . $results_per_page . " OFFSET " . $viewed_count . " ";
    $prs = MySQL::search($query);
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
                    <a class="product-title" href="product-layout1.html">
                        <h2><?= $product['title'] ?></h2>
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
