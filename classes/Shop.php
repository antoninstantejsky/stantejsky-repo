<?php

class Shop {
/**
* 
* Přidání obchodu do databáze
*
* @param object $connection - připojení do databáze

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
     * Získá jednoho žáka z databází
     * 
     * @param object $connection napojení na databázi
     
     * 
     * @return 
     * */
    public static function getShop($connection, $id, $columns = "*") {
    
        $sql = "SELECT $columns 
            FROM addshop";
            
    
        $stmt = $connection->prepare($sql);
    
         try{
            if ($stmt->execute()) {
                return $stmt->fetchAll (PDO::FETCH_ASSOC);
                } else {
                    throw new Exception("Získání dat o jednom obchodu selhalo");
                }
        } catch (Exception $e) {
            error_log("chyba u funkce getShop, získání dat selhalo\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
                }
            }
}