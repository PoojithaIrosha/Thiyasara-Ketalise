<?php

require "../MySQL.php";
session_start();

if(isset($_POST['result']) && isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $result = json_decode($_POST['result']);

    $d = new DateTime();
    $d->setTimezone(new DateTimeZone("Asia/Colombo"));
    $now = $d->format("Y-m-d H:i:s");

    MySQL::iud("INSERT INTO invoice(id, user_email, amount, date) VALUE (?, ?, ?, ?)", [$result->invoiceId, $user['email'], $result->total, $now], 'ssss');

    $cart_rs = MySQL::search_prepared("SELECT * FROM cart WHERE user_email = ?", [$user['email']], 's');
    while ($cart = $cart_rs->fetch_assoc()) {
        MySQL::iud("INSERT INTO invoice_item(qty, invoice_id, product_id) VALUE (?, ?, ?)", [$cart['qty'], $result->invoiceId, $cart['product_id']], 'sss');
    }
    MySQL::iud("INSERT INTO address(line1, line2, city_id, invoice_id) VALUE (?,?, ?, ?)", [$result->addressLine1, $result->addressLine2, $result->city, $result->invoiceId], 'ssss');

    MySQL::iud("DELETE FROM cart WHERE user_email = ?", [$user['email']], 's');
    echo "success";
}
