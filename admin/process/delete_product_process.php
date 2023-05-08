<?php

require "../../MySQL.php";

$pid = $_GET['pid'];

$productRs = MySQL::search("SELECT * FROM product WHERE id = '${pid}'");
if ($productRs->num_rows > 0) {

    $invItemsRs = MySQL::search_prepared("SELECT * FROM invoice_item WHERE product_id = ?", [$pid], 's');
    if($invItemsRs->num_rows > 0) {
        echo "Product cannot be deleted";
    }else {
        MySQL::iud("DELETE FROM product_img WHERE product_id = ?", [$pid], 's');
        MySQL::iud("DELETE FROM product WHERE id = ?", [$pid], 's');
        echo "success";
    }
}
