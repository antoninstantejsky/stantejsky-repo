<?php

class Shop {
/**
* 
* Přidání obchodu do databáze
*
* @param object $connection - připojení do databáze
* @param object $user_id - uživatelské id
* @param object $shop_name - název obchodu
* 
* @return void
*/
public static function createShop($connection, $user_id, $shop_name) {

    $sql = "INSERT INTO addshop (user_id, shop_name)
            VALUES (:user_id, :shop_name)";

    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        echo mysqli_error ($connection);
    } else {
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":shop_name", $shop_name, PDO::PARAM_STR);
        

        try{
            if ($stmt->execute()) {
                echo "přidán obchod na seznam";
                } else {
                    throw new Exception("přidání nového obchodu selhalo");
                }
        } catch (Exception $e) {
            error_log("chyba u funkce createShop\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
                }
        }
    }
    
    /**
     * Získá všechny obchody přihlášeného uživatele
     * 
     * @param object $connection napojení na databázi
     * @param object $user_id - uživatelské id
     * 
     * @return array pole objektů, kde každý objekt je jeden obchod
     * */
    public static function getUserShop($connection, $user_id, $columns = "*") {
    
        $sql = "SELECT $columns
            FROM addshop
            WHERE user_id = :user_id";
            
    
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $shopname = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $shopname;
}

 /**
     * Smaže vybraný obchod uživatele
     * 
     * @param object $connection napojení na databázi
     
     * 
     * @return 
     * */
    public static function deleteShop($connection, $user_id) {
    
        $sql = "DELETE
            FROM addshop
            WHERE user_id = :user_id";
            
    
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();


        return true;
}
}