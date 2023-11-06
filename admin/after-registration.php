<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/User.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['first_name'] == "" or $_POST['second_name'] == "" or $_POST['email'] == "" or $_POST['password'] == "") {
        echo "některé z polí nebylo vyplnené";
    } else {
        // $connection = connectionDB();
        $database = new Database();
        $connection = $database->connectionDB();

        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
           
    
        $id = User::createUser ($connection, $first_name, $second_name, $email, $password);
    
        if(!empty($id)) {
            //Zabraňuje provedení tzv. fixation attack. Více zde:
            https://owasp.org/www-comunity/attacks/session_fixation
            session_regenerate_id(true);
    
            //Nastavení, že je uživatel přihlášený
            $_SESSION["is_logged_in"]=true;
            //Nastavení ID uživatele
            $_SESSION["logged_in_user_id"] = $id;
    
            Url::redirectUrl ("/kupchleba/shop-list.php");
        } else {
            echo "Uživatele se nepodařilo přidat";
        }
    
    }        
    }