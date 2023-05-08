<?php

require "../../MySQL.php";

$id = $_GET["cid"];

$rs = MySQL::search("SELECT * FROM category WHERE id='${id}'");
if ($rs->num_rows > 0) {
    MySQL::iud("DELETE FROM category WHERE id = ?", [$id], 's');
    echo "success";
}
