<?php
session_start();

if (isset($_SESSION["user"])){
    $_SESSION["user"]=null;
}

session_destroy();

header("Location: ../user_login.php");
