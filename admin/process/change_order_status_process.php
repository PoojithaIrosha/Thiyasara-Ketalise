<?php

require "../../MySQL.php";

$invId = $_GET['invId'];

$invRs = MySQL::search("SELECT * FROM invoice WHERE id = '${invId}'");
if ($invRs->num_rows > 0) {
    $invData = $invRs->fetch_assoc();

    if ($invData['status'] == 0) {
        MySQL::iud("UPDATE invoice SET status = ? WHERE id=?", [1, $invId], 'is');
        echo "success";
    }


}
