<?php

require "../../MySQL.php";

$name = $_POST['name'];

if (empty($name)) {
    echo "Category name cannot be empty";
} else {
    $rs = MySQL::search("SELECT * FROM category WHERE name = '${name}'");
    if ($rs->num_rows > 0) {
        echo "Category already exists";
    } else {
        MySQL::iud("INSERT INTO category(name) VALUE (?)", [$name], 's');
        echo "success";
    }
}
