<?php
session_start();
require "../MySQL.php";

$fname = $_POST["fn"];
$lname = $_POST["ln"];
$mobile = $_POST["mo"];
$email = $_SESSION["user"]["email"];

if (empty($fname)) {
    echo "Please enter the first name";
} else if (empty($lname)) {
    echo "Please enter the last name";
} else if (empty($mobile)) {
    echo "Please enter the mobile number";
} else {
    MySQL::iud("UPDATE user SET fname = ?, lname = ?, mobile = ? WHERE email= ?", [$fname, $lname, $mobile, $email], 'ssss');
    echo "success";
}

