<?php
require "../MySQL.php";

if ($_GET['city'] != 0) {
    $city_rs = MySQL::search("SELECT * FROM city WHERE id = '" . $_GET['city'] . "'");
    if($city_rs->num_rows > 0) {
        $city_data = $city_rs->fetch_assoc();

        echo $city_data['delivery_fee'];
    }
}