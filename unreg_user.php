<?php

require "classes/Database.php";
require "classes/Url.php";
require "classes/User.php";
require "classes/Tables.php";

session_start();

        $database = new Database();
        $connection = $database->connectionDB();
        Tables::createTableUser($connection);

        $first_name = "";
        $second_name = "";
        $email = uniqid()."@".uniqid().".cz";
        $password = "";
           
    
        $user_id = User::createUser ($connection, $first_name, $second_name, $email, $password);
    
        if(!empty($user_id)) {
            //Zabraňuje provedení tzv. fixation attack. Více zde:
            https://owasp.org/www-comunity/attacks/session_fixation
            session_regenerate_id(true);
    
            //Nastavení, že je uživatel přihlášený
            $_SESSION["is_logged_in"]=true;
            //Nastavení ID uživatele
            $_SESSION["user_id"] = $user_id;
    
            Url::redirectUrl ("/kupchleba/shop-list.php");
        } else {
            echo "Uživatele se nepodařilo přidat";
        }
     