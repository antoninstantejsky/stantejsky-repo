<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Shop.php";



session_start();
$user_id=$_SESSION["user_id"];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['shop_name'] == "") {
        echo "Nezadán název obchodu";
    } else {

        $database = new Database();
        $connection = $database->connectionDB();
        
        $shop_name = $_POST["shop_name"];
        

        
        Shop::createShop($connection, $user_id, $shop_name);
    
        
         Url::redirectUrl ("/kupchleba/shop-list.php");
        } 
           
        }
    
            
    