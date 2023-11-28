<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Shop.php";
require "../classes/Auth.php";


session_start();

if (!Auth::isLoggedIn()) {
    die("Nepovolený přístup");
}

$user_id = $_SESSION["logged_in_user_id"];


if($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['shop_name'] == "") {
        echo "Nezadán název obchodu";
    } else {

        $database = new Database();
        $connection = $database->connectionDB();
        
        $shop_name = $_POST["shop_name"];
        

        
        Shop::createShop($connection, $user_id, $shop_name);
    
        
         Url::redirectUrl ("/kupchleba/admin/user-list.php");
        } 
           
        }
    
            
    