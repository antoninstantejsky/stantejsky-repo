<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Sort.php";
require "../classes/User.php";




if($_SERVER["REQUEST_METHOD"] === "POST") {
   
        $database = new Database();
        $connection = $database->connectionDB();
        

        $user_id = $_POST["user_id"];
        $shop = $_POST["shop"];
        $department = $_POST["department"];
        $sort = $_POST["sort"];
        $quantity = $_POST["quantity"];
        $units = $_POST["units"];
        $price_selection = $_POST["price_selection"];
        $value = $_POST["value"];
        $comment = $_POST["comment"];

        
        $return = Sort::createSort($connection, $user_id, $shop, $department,
        $sort, $quantity, $units, $price_selection, $value, $comment);
    
        if(empty($return)) {
            
    
            Url::redirectUrl ("/kupchleba/shop-list.php");
        } else {
            echo "Položku se nepodařilo přidat";
        }
    
    }        
    