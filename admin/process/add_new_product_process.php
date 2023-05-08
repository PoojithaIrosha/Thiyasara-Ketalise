<?php

require "../../MySQL.php";

$pname = $_POST['pname'];
$price = $_POST['price'];
$qty = $_POST['qty'];
$category = $_POST['category'];
$brand = $_POST['brand'];
$desc = $_POST['desc'];
$imageIds = json_decode($_POST['imageIds']);

if (empty($pname)) {
    echo "Product name cannot be empty";
} else if (empty($price)) {
    echo "Product price cannot be empty";
} else if (!is_numeric($price)) {
    echo "Invalid price";
} else if (empty($qty)) {
    echo "Product quantity cannot be empty";
} else if (!is_numeric($qty)) {
    echo "Invalid quantity";
} else if ($category == '0') {
    echo "Select a category";
} else if ($brand == '0') {
    echo "Select a brand";
} else if (empty($desc)) {
    echo "Description cannot be empty";
} else {

    $prodRs = MySQL::search("SELECT * FROM product WHERE title = '${pname}' AND category_id = '${category}'");
    if ($prodRs->num_rows > 0) {
        echo "Product already exists";
    } else {
        $d = new DateTime();
        $d->setTimezone(new DateTimeZone('Asia/Colombo'));
        $now = $d->format("Y-m-d H:i:s");

        MySQL::iud("INSERT INTO product(title, qty, price, description, datetime, category_id, brand_id) VALUE (?,?,?,?,?,?,?)", [$pname, $qty, $price, $desc, $now, $category, $brand], 'sssssss');
        $last_insert_id = MySQL::$connection->insert_id;

        for ($x = 0; $x < sizeof($imageIds); $x++) {
            $file = $_FILES[$imageIds[$x]];
            $filePath = "assets/images/product/" . uniqid() . $file['name'];
            move_uploaded_file($file['tmp_name'], "../../" . $filePath);

            MySQL::iud("INSERT INTO product_img(path, product_id) VALUE (?, ?)", [$filePath, $last_insert_id], 'ss');
        }

        echo "success";

    }

}



