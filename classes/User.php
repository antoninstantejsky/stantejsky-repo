<?php

class User {
/**
* 
* Přidání uživatele do databáze
*
* @param object $connection - připojení do databáze
* @param string $first_name - křestní jméno uživatele
* @param string $second_name - přijmení uživatele
* @param string $email - email uživatele
* @param string $password - heslo uživatele
* 
* @return integer $id - id uživatele
*/
public static function createUser($connection, $first_name, $second_name, $email, $password) {

    $sql = "INSERT INTO user (first_name, second_name, email, password)
    VALUES (:first_name, :second_name, :email, :password)";

    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        echo mysqli_error ($connection);
    } else {
        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);

        try{
            if ($stmt->execute()) {
                $id = $connection->lastInsertId();
                return $id;
                } else {
                    throw new Exception("Vytvoření uživatele selhalo");
                }
        } catch (Exception $e) {
            error_log("chyba u funkce createUser\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
                }
        }
}

/**
 * Ověření uživatele pomocí emailu a hesla
 * 
 * @param object $connection - připojení od odatabáze
 * @param string $log_email - email z formuláře pro přihlášení
 * @param string $log_password - heslo z formuláře pro přihlášení
 * 
 * @return boolean true - pokud je přihlášení úspěšné, false - pokud je neúspěšné
 */
public static function authentication($connection, $log_email, $log_password) {
    $sql = "SELECT password
            FROM user
            WHERE email = :email";

    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":email", $log_email, PDO::PARAM_STR);
        
    try {
        if ($stmt->execute()) {
            if ($user = $stmt->fetch()) 
                return password_verify($log_password, $user[0]);
            } else {
                throw new Exception("Autentikace se nezdařila");
            }
        } catch (Exception $e) {
        error_log("chyba u funkce Authentication\n", 3, "../errors/error.log");
        echo "Typ chyby: " . $e->getMessage();
        }
    }

/**
 * 
 * Získání id uživatele
 * 
 * @param object $connection - připojení do databáze
 * @param string $email - email uživatele
 * 
 * @return int id uživatele
 */
public static function getUserId($connection, $email) {
    $sql = "SELECT id FROM user
            WHERE email = :email";

    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":email", $email, PDO::PARAM_STR); 

    try{
     if($stmt->execute()) {
            $result = $stmt->fetch();
            $user_id = $result[0];
            return $user_id;
     }else {
        throw new Exception("Získání id uživatele selhalo");
     }
    } catch (Exception $e) {
        error_log("chyba u funkce getUserId\n", 3, "../errors/error.log");
        echo "Typ chyby: " . $e->getMessage();
        }
    }
}