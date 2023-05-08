<?php

require "../../MySQL.php";

$pid = $_POST['pid'];
$pname = $_POST['name'];
$price = $_POST['price'];
$qty = $_POST['qty'];
$category = $_POST['cat'];
$brand = $_POST['brand'];
$desc = $_POST['desc'];

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

    $prodRs = MySQL::search("SELECT * FROM product WHERE id = '${pid}'");
    if ($prodRs->num_rows > 0) {
        MySQL::iud("UPDATE product SET title = ?, price =?, qty =?, category_id=?, brand_id = ?, description = ? WHERE id=?", [$pname, $price, $qty, $category, $brand, $desc, $pid], 'sssssss');

        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $file = $_FILES['image'];
            $filePath = "assets/images/product/" . uniqid() . $file['name'];
            move_uploaded_file($file['tmp_name'], "../../" . $filePath);

            MySQL::iud("DELETE FROM product_img WHERE product_id = ?", [$pid], 's');
            MySQL::iud("INSERT INTO product_img(path, product_id) VALUE (?, ?)", [$filePath, $pid], 'ss');

        }

        echo "success";
    }

}
