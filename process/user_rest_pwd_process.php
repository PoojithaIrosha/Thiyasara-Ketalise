<?php
require "../MySQL.php";

$uid = $_POST["uid"];
$new_pwd = $_POST["new_pwd"];
$confirm_pwd = $_POST["confirm_pwd"];

if (empty($new_pwd)) {
    echo "Please enter new password";
} else if (strlen($new_pwd) < 5) {
    echo "Password should contain more than 5 characters";
} else if (empty($confirm_pwd)) {
    echo "Please confirm your new password";
} else if ($new_pwd != $confirm_pwd) {
    echo "Password doesn't match";
} else {
    try {
        $user_rs = MySQL::search_prepared("SELECT * FROM user WHERE verification_code = ?", [$uid], 's');
        if ($user_rs->num_rows > 0) {
            $user_data = $user_rs->fetch_assoc();

            MySQL::iud("UPDATE `user` SET `password` = ? WHERE `email` = ?", [$new_pwd, $user_data["email"]], 'ss');
            echo "success";
        } else {
            echo "Password reset failed! We couldn't recognize your account.";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}
