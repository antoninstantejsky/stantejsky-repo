<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/User.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['login-email'] == "" or $_POST['login-password'] == "") {
        echo "některé z polí nebylo vyplnené";
    } else {
    // $connection = connectionDB();
    $database = new Database();
    $connection = $database->connectionDB();

    $log_email = $_POST["login-email"];
    $log_password = $_POST["login-password"];

    if(User::authentication($connection, $log_email, $log_password)) {
        //Úspěšné přihlášení
        //Získání ID uživatele
        $id = User::getUserId($connection, $log_email);

        //Zabraňuje provedení tzv. fixation attack. Více zde:
        https://owasp.org/www-comunity/attacks/session_fixation
        session_regenerate_id(true);

       //Nastavení, že je uživatel přihlášený
       $_SESSION["is_logged_in"]=true;
       //Nastavení ID uživatele
       $_SESSION["logged_in_user_id"] = $id;

       Url::redirectUrl ("/kupchleba/admin/user-list.php");
    } else {
        //Neúspěšné přihlášení
        $error = "chyba při přihlášení";
    
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(empty($error));?>
        <p><? $error ?></p>
        <a href="../index.php">Zpět na přihlášení</a>
        
</body>
</html>