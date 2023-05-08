<?php

require "../../MySQL.php";

$id = $_POST['id'];
$name = $_POST['name'];

if (empty($name)) {
    echo "Brand name cannot be empty";
} else {
    MySQL::iud("UPDATE brand SET b_name = ? WHERE id = ?", [$name, $id], 'ss');
    echo "success";
}
