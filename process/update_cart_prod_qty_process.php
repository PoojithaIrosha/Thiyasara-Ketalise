<?php

require "../MySQL.php";
session_start();

$user = $_SESSION['user'];

$pid = $_POST["pid"];
$prodQty = $_POST['prod_qty'];

$cart_rs = MySQL::search("SELECT *, cart.id as cid FROM cart WHERE product_id='${pid}' AND user_email='${user['email']}'");
if ($cart_rs->num_rows > 0) {
    $cart_data = $cart_rs->fetch_assoc();
    $cid = $cart_data['cid'];

    MySQL::iud("UPDATE cart SET qty=? WHERE id=?", [$prodQty, $cid], 'ss');
}

