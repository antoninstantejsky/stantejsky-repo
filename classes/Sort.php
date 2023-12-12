<?php

class Sort {
/**
* 
* Přidání položky do databáze
*
* @param object $connection - připojení do databáze
* 
* 
* @return void
*/
public static function createSort($connection, $user_id, $shop, $department,
 $sort, $quantity, $units, $price_selection, $value, $comment) {

    $sql = "INSERT INTO shoplist (favourite, user_id, shop, department, sort, quantity, units, price_selection, value, comment)
    VALUES (0, :user_id, :shop, :department, :sort, :quantity, :units, :price_selection, :value, :comment)";

    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        echo mysqli_error ($connection);
    } else {

        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":shop", $shop, PDO::PARAM_STR);
        $stmt->bindValue(":department", $department, PDO::PARAM_STR);
        $stmt->bindValue(":sort", $sort, PDO::PARAM_STR);
        $stmt->bindValue(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindValue(":units", $units, PDO::PARAM_STR);
        $stmt->bindValue(":price_selection", $price_selection, PDO::PARAM_STR);
        $stmt->bindValue(":value", $value, PDO::PARAM_INT);
        $stmt->bindValue(":comment", $comment, PDO::PARAM_STR);

        try{
            if ($stmt->execute()) {
                echo "přidána položka na seznam";
                } else {
                    throw new Exception("Přidání položky selhalo");
                }
        } catch (Exception $e) {
            error_log("chyba u funkce createSort\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
                }
        }
}

       
 /*** Vrátí všechny žáky z databáze
 * 
 * @param object $connection - připojení do databáze
 * 
 * @return array pole objektů, kde každý objekt je jeden údaj o položce
 * 
 */
public static function getUserSort($connection,$user_id, $columns = "*"){
    $sql = "SELECT $columns 
            FROM shoplist
            WHERE favourite IN ('0', '2')
            AND user_id = :user_id";
        
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    
    try{
        if ($stmt->execute()) {
            return $stmt->fetchAll (PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Získání dat o všech položkách selhalo");
            }
    } catch (Exception $e) {
        error_log("chyba u funkce getAllSort, získání dat selhalo\n", 3, "../errors/error.log");
        echo "Typ chyby: " . $e->getMessage();
            }
        }   
        /*** Vrátí všechny žáky z databáze
 * 
 * @param object $connection - připojení do databáze
 * 
 * @return array pole objektů, kde každý objekt je jeden údaj o položce
 * 
 */
public static function getFavouriteSort($connection,$user_id, $columns = "*"){
    $sql = "SELECT $columns 
            FROM shoplist
            WHERE user_id = :user_id
            AND favourite != 0";
       
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    
    try{
        if ($stmt->execute()) {
            return $stmt->fetchAll (PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Získání dat o všech položkách selhalo");
            }
    } catch (Exception $e) {
        error_log("chyba u funkce getAllSort, získání dat selhalo\n", 3, "../errors/error.log");
        echo "Typ chyby: " . $e->getMessage();
            }
        }   
    /*** Vrátí všechny žáky z databáze
 * 
 * @param object $connection - připojení do databáze
 * 
 * @return array pole objektů, kde každý objekt je jeden údaj o položce
 * 
 */
public static function updateFavouriteSort($connection, $id){
    $sql = "UPDATE shoplist
            SET favourite = 1 
            WHERE id = :id";
       
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    
    
    try{
        if ($stmt->execute()) {
            return $stmt->fetchAll (PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Získání dat o položce selhalo");
            }
    } catch (Exception $e) {
        error_log("chyba u funkce getFavouriteSort, získání dat selhalo\n", 3, "../errors/error.log");
        echo "Typ chyby: " . $e->getMessage();
            }
        }   
 /*** Vrátí všechny žáky z databáze
 * 
 * @param object $connection - připojení do databáze
 * 
 * @return array pole objektů, kde každý objekt je jeden údaj o položce
 * 
 */
public static function reupdateFavouriteSort($connection, $user_id){
    $sql = "UPDATE shoplist
            SET favourite = 1 
            WHERE user_id = :user_id
            AND favourite = 2";
       
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    
    
    try{
        if ($stmt->execute()) {
            return $stmt->fetchAll (PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Získání dat o položce selhalo");
            }
    } catch (Exception $e) {
        error_log("chyba u funkce getFavouriteSort, získání dat selhalo\n", 3, "../errors/error.log");
        echo "Typ chyby: " . $e->getMessage();
            }
        }   
          /*** Vrátí všechny žáky z databáze
 * 
 * @param object $connection - připojení do databáze
 * 
 * @return array pole objektů, kde každý objekt je jeden údaj o položce
 * 
 */
public static function updateFavShopSort($connection, $user_id, $shop){
    $sql = "UPDATE shoplist
            SET favourite = 2 
            WHERE shop= :shop
            AND user_id= :user_id";
       
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindValue(":shop", $shop, PDO::PARAM_STR);
    
    
    try{
        if ($stmt->execute()) {
            return $stmt->fetchAll (PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Získání dat o položce selhalo");
            }
    } catch (Exception $e) {
        error_log("chyba u funkce getFavouriteSort, získání dat selhalo\n", 3, "../errors/error.log");
        echo "Typ chyby: " . $e->getMessage();
            }
        }   
    /**
     * Získá jednoho žáka z databází
     * 
     * @param object $connection napojení na databázi
     
     * 
     * @return 
     * */
    public static function logoutDeleteSort($connection, $user_id) {
    
        $sql = "DELETE 
            FROM shoplist
            WHERE user_id=:user_id
            AND favourite = 0";
            
    
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        try{
            if ($stmt->execute()) {
                return $stmt->fetchAll (PDO::FETCH_ASSOC);
                } else {
                    throw new Exception("Smazání položky selhalo");
                }
        } catch (Exception $e) {
            error_log("chyba u funkce deleteSort, smazání dat selhalo\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
                }
}
/**
     * Získá jednoho žáka z databází
     * 
     * @param object $connection napojení na databázi
     
     * 
     * @return 
     * */
    public static function deleteSort($connection, $user_id, $id) {
    
        $sql = "DELETE 
            FROM shoplist
            WHERE user_id=:user_id
            AND id=:id";
            
    
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        try{
            if ($stmt->execute()) {
                return $stmt->fetchAll (PDO::FETCH_ASSOC);
                } else {
                    throw new Exception("Smazání položky selhalo");
                }
        } catch (Exception $e) {
            error_log("chyba u funkce deleteFavSort, smazání položky selhalo\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
                }
}
 
    }