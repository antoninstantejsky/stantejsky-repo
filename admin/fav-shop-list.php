<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Sort.php";
require "../classes/Auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nepovolený přístup");
}
   
        $database = new Database();
        $connection = $database->connectionDB();
   
    if (isset($_GET['shop']) ){
        
        Sort::updateFavShopSort($connection, $_SESSION["logged_in_user_id"], $_GET['shop']);
    } 
   
    
            Url::redirectUrl ("/kupchleba/admin/user-list.php");
      
        