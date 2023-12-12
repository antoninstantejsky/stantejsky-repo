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
   
    if (isset($_GET['favourite']) and isset($_GET['id'])) {
        if ($_GET['favourite'] = 0){
            Sort::deleteSort($connection, $_SESSION["logged_in_user_id"], $_GET['id']);
            Url::redirectUrl ("/kupchleba/admin/user-list.php");

        } elseif ($_GET['favourite'] = 1){
            Sort::deleteSort($connection, $_SESSION["logged_in_user_id"], $_GET['id']);
            Url::redirectUrl ("/kupchleba/admin/favourite-list.php");

        } elseif ($_GET['favourite'] = 2)
        {
            Sort::updateFavouriteSort($connection, $_GET['id']);
            Url::redirectUrl ("/kupchleba/admin/user-list.php");
        }
           
    } 
   
    
           
      
        