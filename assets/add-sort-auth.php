<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Sort.php";
require "../classes/Auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nepovolený přístup");
}

$user_id = $_SESSION["logged_in_user_id"];

if($_SERVER["REQUEST_METHOD"] === "POST") {
   
        $database = new Database();
        $connection = $database->connectionDB();
        

        
        $shop = $_POST["shop"];
        $department = $_POST["department"];
        $sort = $_POST["sort"];
        $quantity = $_POST["quantity"];
        $units = $_POST["units"];
        $price_selection = $_POST["price_selection"];
        $value = $_POST["value"];
        $comment = $_POST["comment"];

        
        Sort::createSort($connection, $user_id, $shop, $department,
        $sort, $quantity, $units, $price_selection, $value, $comment);
    
            Url::redirectUrl ("/kupchleba/admin/user-list.php");
        } else {
            echo "Položku se nepodařilo přidat";
        }
    
          
    