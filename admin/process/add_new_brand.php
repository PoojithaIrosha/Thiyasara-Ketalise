<?php

require "../../MySQL.php";

$name = $_POST['name'];

$rs = MySQL::search("SELECT * FROM brand WHERE b_name = '${name}'");
if ($rs->num_rows > 0) {
    echo "Brand already exists";
} else {
    MySQL::iud("INSERT INTO brand(b_name) VALUE (?)", [$name], 's');
    echo "success";
}
