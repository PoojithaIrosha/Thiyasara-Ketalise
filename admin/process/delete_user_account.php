<?php

require "../../MySQL.php";

$email = $_GET['e'];

$userRs = MySQL::search("SELECT * FROM user WHERE email = '" . $email . "'");
if ($userRs->num_rows > 0) {

    MySQL::iud("DELETE FROM user_has_address WHERE user_email = ?", [$email], 's');
    MySQL::iud("DELETE FROM profile_image WHERE user_email = ?", [$email], 's');
    MySQL::iud("DELETE FROM watchlist WHERE user_email = ?", [$email], 's');
    MySQL::iud("DELETE FROM cart WHERE user_email = ?", [$email], 's');
    MySQL::iud("DELETE FROM invoice WHERE user_email = ?", [$email], 's');
    MySQL::iud("DELETE FROM user WHERE email = ?", [$email], 's');
    echo "success";
} else {
    echo "User not found";
}
