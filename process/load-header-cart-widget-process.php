<?php
require "../MySQL.php";
session_start();
$cart_rs = MySQL::search_prepared("SELECT * FROM cart INNER JOIN product ON cart.product_id=product.id INNER JOIN product_img ON product.id=product_img.product_id WHERE cart.user_email = ?", [$_SESSION["user"]["email"]], 's');

$result = [];

$total = 0;
while ($cart = $cart_rs->fetch_assoc()) {
    $total += (int)$cart["price"];
}

$result['no'] = $cart_rs->num_rows;
$result['total'] = $total;

echo json_encode($result);
