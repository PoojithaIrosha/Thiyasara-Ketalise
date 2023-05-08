<?php
require_once "../MySQL.php";

if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
    $cart_rs = MySQL::search_prepared("SELECT * FROM `cart` WHERE `id`=?", [$pid], 'i');
    if ($cart_rs->num_rows > 0) {
        MySQL::iud("DELETE FROM cart WHERE id=?", [$pid], 'i');
        echo "success";
    } else {
        echo "Something went wrong. Please try again later.";
    }
} else {
    echo "Please select a product.";
}