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
   
    if (isset($_GET['id']) ){
        
      Sort::updateFavouriteSort($connection, $_GET['id']); 
    } 
   
    
            Url::redirectUrl ("/kupchleba/admin/user-list.php");
      
        