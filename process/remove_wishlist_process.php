<?php

require_once "../MySQL.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $watch_rs = MySQL::search_prepared("SELECT * FROM `watchlist` WHERE `id`=?", [$pid], 'i');

    if ($watch_rs->num_rows == 0) {
        echo "Something went wrong. Please try again later.";
    } else {
        MySQL::iud("DELETE FROM `watchlist` WHERE `id`=?", [$pid], 'i');
        echo "success";
    }
} else {
    echo "Please select a product.";
}