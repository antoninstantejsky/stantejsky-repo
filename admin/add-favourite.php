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
   
   
        
      Sort::updateFavouriteSort($connection,$_SESSION["logged_in_user_id"], $_GET['id']); 
   
    
            Url::redirectUrl ("/kupchleba/admin/user-list.php");
      
        