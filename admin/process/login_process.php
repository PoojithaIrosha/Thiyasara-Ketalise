<?php

require "../../MySQL.php";

$email = $_POST["email"];
$pwd = $_POST["password"];
$rmb_me = $_POST["rememberMe"];

if (empty($email)) {
    echo "Please enter your email";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
} else if (empty($pwd)) {
    echo "Please enter your password";
} else {

    $rs = MySQL::search_prepared("SELECT * FROM admin WHERE email=? AND password=?", [$email, $pwd], "ss");

    if ($rs->num_rows == 1) {
        $data = $rs->fetch_assoc();

        if ($data["status_id"] == 2) {
            echo "Sorry, Your account is deactivated";
        } else {
            session_start();
            $_SESSION["admin"] = $data;

            if ($rmb_me == "true") {
                setcookie("aemail", $email, time() + (60 * 60 * 24 * 7), "/");
                setcookie("apassword", $pwd, time() + (60 * 60 * 24 * 7), "/");
            } else {
                setcookie("aemail", "", -1);
                setcookie("apassword", "", -1);
            }
            echo "success";
        }
    } else {
        echo "Invalid email and password";
    }
}
