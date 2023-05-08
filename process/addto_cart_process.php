<?php
session_start();

require "../MySQL.php";

if(isset($_SESSION["user"])){
    if(isset($_GET["id"])){

        $pid = $_GET["id"];
        $uemail = $_SESSION["user"]["email"];

        $cartProduct_rs = MySQL::search_prepared("SELECT * FROM `cart` WHERE user_email=? AND product_id=?", [$uemail, $pid],'si');

        $cart_product_num = $cartProduct_rs->num_rows;

        $product_qty_rs = MySQL::search_prepared("SELECT `qty` FROM `product` WHERE id=?", [$pid],'i');
        $product_qty_data = $product_qty_rs->fetch_assoc();

        $product_qty = $product_qty_data["qty"];

        if($cart_product_num == 1){
            $cartProductData = $cartProduct_rs->fetch_assoc();
            $currentQty = $cartProductData["qty"];
            $newQty = (int)$currentQty + 1;

            if($product_qty >= $newQty){
                MySQL::iud("UPDATE `cart` SET `qty`=? WHERE user_email=? AND product_id=?", [$newQty, $uemail, $pid], 'isi');

                echo "Product quantity Updated";
            }else{
                echo "Invalid Product Quantity";
            }
        }else{
            MySQL::iud("INSERT INTO `cart` (`product_id`,`user_email`,`qty`) VALUES (?,?,?)",[$pid, $uemail, 1], 'isi' );

            echo "New Product added to the cart";
        }

    }else{
        echo "Sorry For the Inconvenient";
    }
}else{
    echo "Please Log In on Sign Up";
}