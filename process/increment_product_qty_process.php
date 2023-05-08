<?php

require_once "../MySQL.php";

$new_qty = $_GET["qty"];
$pid = $_GET["pid"];

if (isset($new_qty)) {
    $product_rs = MySQL::search("SELECT * FROM product WHERE id = ${pid}");

    if ($product_rs->num_rows > 0) {
        $product = $product_rs->fetch_assoc();
        $current_qty = $product["qty"];

        $result = array();

        if ($new_qty <= $current_qty) {
            $result["qty"] = $new_qty;
        } else {
            $result["qty"] = '-1';
            $result["message"] = "There are no enough quantity left";
        }
        echo json_encode($result);

    }

}
