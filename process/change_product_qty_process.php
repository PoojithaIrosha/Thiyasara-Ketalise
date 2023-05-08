<?php

require_once "../MySQL.php";

$pid = $_GET["pid"];
$qty = $_GET["qty"];

$result = array();

if (empty($qty)) {
    $result["message"] = "Please enter a quantity of 1 or more";
} else if (preg_match("/-[0-9]+/", $qty)) {
    $result["message"] = "negative";
} else if (!is_numeric($qty)) {
    $result["message"] = "Quantity should only contain numbers";
} else {
    $product_rs = MySQL::search_prepared("SELECT * FROM product WHERE id = ?", [$pid], 's');
    if ($product_rs->num_rows > 0) {
        $product = $product_rs->fetch_assoc();
        $current_qty = $product["qty"];

        if ((int)$qty > (int)$current_qty) {
            $result["message"] = "Product quantity exceeded. There are only ${current_qty} quantities";
        } else {
            $result["message"] = "";
        }

    }

}

echo json_encode($result);