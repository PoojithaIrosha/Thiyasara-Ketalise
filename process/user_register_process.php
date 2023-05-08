<?php

require "../MySQL.php";

$f_name = $_POST["fname"];
$l_name = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];

if (empty($f_name)) {
    echo "Please enter First Name";
} else if (empty($l_name)) {
    echo "Please enter Last Name";
} else if (empty($email)) {
    echo "Please enter Email";
} else if (empty($password)) {
    echo "Please enter Password";
} else if(strlen($password) < 5){
    echo "Password must have at least 5 characters";
}else if (empty($mobile)) {
    echo "Please enter Contact Number";
} else {

    $user_rs = MySQL::search_prepared("SELECT * FROM user WHERE email = ?", [$email], 's');
    if(!$user_rs->num_rows > 0) {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $now = $d->format("Y-m-d H:i:s");

        MySQL::iud("INSERT INTO user(`fname`,`lname`,`email`,`password`,`mobile`,`reg_date`) VALUES (?, ?, ? , ?, ?, ?)", [$f_name, $l_name, $email, $password, $mobile, $now], "ssssss");

        echo "success";
    }else {
        echo "User with this email address already exists";
    }


}