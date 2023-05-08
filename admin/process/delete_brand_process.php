<?php

require "../../MySQL.php";

$id = $_GET["bid"];

$rs = MySQL::search("SELECT * FROM brand WHERE id='${id}'");
if ($rs->num_rows > 0) {
    MySQL::iud("DELETE FROM brand WHERE id = ?", [$id], 's');
    echo "success";
}
