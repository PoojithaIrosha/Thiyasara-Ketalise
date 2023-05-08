<?php

require "../../MySQL.php";

$id = $_POST['id'];
$name = $_POST['name'];

if (empty($name)) {
    echo "Category name cannot be empty";
} else {
    MySQL::iud("UPDATE category SET name = ? WHERE id = ?", [$name, $id], 'ss');
    echo "success";
}
