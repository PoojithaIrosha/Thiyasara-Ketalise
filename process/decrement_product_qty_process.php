<?php
require "../MySQL.php";

$new_qty = $_GET["qty"];
$pid = $_GET["pid"];

$result = array();

$product_rs = MySQL::search("SELECT * FROM product WHERE id = '" . $pid . "'");

if($product_rs->num_rows > 0) {
    $product = $product_rs->fetch_assoc();
    $current_qty = $product["qty"];

    if ($new_qty > 0 ) {
        if($new_qty <= $current_qty) {
            $result["qty"] = $new_qty;
            $result["message"] = "";
        }else {
            $result["message"] = "There are no enough quantity left";
        }
    }else {
        $result['qty'] = '-1';
        $result["message"] = "Please enter a quantity of 1 or more";
    }

    echo json_encode($result);
}

