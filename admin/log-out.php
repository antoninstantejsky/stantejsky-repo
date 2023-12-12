<?php

require "../classes/Url.php";
require "../classes/Database.php";
require "../classes/Sort.php";
session_start();
$database = new Database();
$connection = $database->connectionDB();

Sort::logoutDeleteSort($connection, $_SESSION["logged_in_user_id"]); 
Sort::reupdateFavouriteSort($connection, $_SESSION["logged_in_user_id"]);

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time()-42000,
    $params["path"], $params["domain"], 
    $params["secure"], $params["httponly"]);  
}

session_destroy();
Url::redirectUrl ("/kupchleba/index.php");
?>