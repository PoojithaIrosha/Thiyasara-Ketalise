<?php

session_start();
require "../MySQL.php";

if (isset($_SESSION["user"])) {
    if (isset($_GET["id"])) {
        $pid = $_GET["id"];
        $uemail = $_SESSION["user"]["email"];

        $watchlist_rs = MySQL::search_prepared("SELECT * FROM `watchlist` WHERE `product_id`= ? AND `user_email`=?", [$pid, $uemail], 'is');

        if ($watchlist_rs->num_rows == 1) {
            $watchlist_data = $watchlist_rs->fetch_assoc();
            $list_id = $watchlist_data["id"];

            MySQL::iud("DELETE FROM `watchlist` WHERE `id`=?", [$list_id], 'i');
            echo "Product removed successfully !";

        } else {
            MySQL::iud("INSERT INTO `watchlist` (`product_id`,`user_email`) VALUES (?,?)", [$pid, $uemail], 'is');
            echo "New product added successfully !";
        }
    } else {
        echo "Something went wrong.";
    }
} else {
    echo "Please sign in or register first.";
}