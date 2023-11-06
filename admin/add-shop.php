<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Shop.php";
require "../classes/User.php";




if($_SERVER["REQUEST_METHOD"] === "POST") {
   
        $database = new Database();
        $connection = $database->connectionDB();
        

        $user_id = $_POST["user_id"];
        $shop_name = $_POST["shop_name"];
        

        
        $id = Shop::createShop($connection, $user_id, $shop_name);
    
        if(empty($id)) {
            
    
            Url::redirectUrl ("/kupchleba/shop-list.php");
        } else {
            echo "Obchod se nepodařilo přidat";
        }
    
    }        
    