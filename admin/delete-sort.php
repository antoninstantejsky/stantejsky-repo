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
   
    
        if (isset($_GET['favourite'])){
            $favourite = $_GET['favourite']; 
           
        if ($favourite ==0) {
           
            Sort::deleteSort($connection, $_GET['id']);
            Url::redirectUrl ("/kupchleba/admin/user-list.php");
        } 
         elseif ($favourite == 1){
            Sort::deleteSortWhereFav($connection, $_SESSION["logged_in_user_id"],  $_GET['id']);
            Url::redirectUrl ("/kupchleba/admin/user-list.php");

        } elseif ($favourite==2){
            Sort::deleteSort($connection, $_GET['id']);
            Url::redirectUrl ("/kupchleba/admin/favourite-list.php");
        }
    } else {
         Sort::deleteSort($connection, $_GET['id']);
            Url::redirectUrl ("/kupchleba/shop-list.php");
    }
       
     
   
    
           
      
        