<?php
require_once "../MySQL.php";

$email = $_POST["email"];
$password = $_POST["password"];
$remember = $_POST["remember"];

if (empty($email)) {
    echo "Please enter your email address";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Please enter a valid email address";
} else if (empty($password)) {
    echo "Please enter your password";
} else if (strlen($password) < 5) {
    echo "Password must be more than 5 characters";
} else {

    $user_rs = MySQL::search_prepared("SELECT * FROM user WHERE email = ? AND password = ?", [$email, $password], 'ss');

    $num_rows = $user_rs->num_rows;
    if ($num_rows == 1) {
        $user_data = $user_rs->fetch_assoc();

        session_start();
        $_SESSION["user"] = $user_data;

        if ($remember == "true") {
            setcookie("email", $email, time() + (60 * 60 * 24 * 7), "/");
            setcookie("password", $password, time() + (60 * 60 * 24 * 7), "/");
        } else {
            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }
        echo "success";
    } else {
        echo "Please check your email and password !";
    }

}