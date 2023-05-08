<?php
require_once "../MySQL.php";
define ('SITE_ROOT', realpath(dirname(__FILE__)));

$user_email = $_POST["email"];
$image = $_FILES["image"];

if(empty($user_email)) {
    echo "Couldn't find the user";
}else if(!isset($image)) {
    echo "Please select a profile image";
}else {

    $allowed_image_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    if(in_array($image["type"], $allowed_image_extensions)) {
        $new_path = "assets/images/profile_img/". uniqid() . $image["name"];
        move_uploaded_file($image["tmp_name"], "../".$new_path);

        $user_profile_rs = MySQL::search_prepared("SELECT * FROM profile_image WHERE user_email = ?", [$user_email], 's');

        if($user_profile_rs->num_rows > 0) {
            MySQL::iud("UPDATE profile_image SET path = ? WHERE user_email = ?", [$new_path, $user_email], 'ss');
        }else {
            MySQL::iud("INSERT INTO profile_image(`path`, `user_email`) VALUE (?, ?)", [$new_path, $user_email], 'ss');
        }
        echo "Profile image updated successfully";
    }

}

