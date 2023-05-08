<?php
require "../../MySQL.php";

$pId = $_GET['pid'];

if (isset($pId)) {
    $prodRs = MySQL::search("SELECT * FROM product WHERE id = '" . $pId . "' ");
    $prod = $prodRs->fetch_assoc();

    if ($prod['status_id'] == 1) {
        MySQL::iud("UPDATE product SET status_id = ? WHERE id = ?", [2, $pId], 'ii');
        echo "Product deactivated";
    } else {
        MySQL::iud("UPDATE product SET status_id = ? WHERE id = ?", [1, $pId], 'ii');
        echo "Product activated";
    }
}