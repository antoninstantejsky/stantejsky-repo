<?php

class Tables {

    public static function createTableUser($connection) {
        $sql = "CREATE TABLE IF NOT EXISTS user (
            id INT(10) NOT NULL AUTO_INCREMENT,
            first_name VARCHAR(50) NOT NULL, 
            second_name VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL, 
            password VARCHAR(255) NOT NULL,
            PRIMARY KEY (id))";
    
    $stmt = $connection->prepare($sql);
    }

    public static function createTableSort($connection) {
        $sql = "CREATE TABLE IF NOT EXISTS shoplist (
            id INT(10) NOT NULL AUTO_INCREMENT,
            favourite TINYINT(11) NOT NULL,
            user_id VARCHAR(50) NOT NULL,
            shop VARCHAR(50) NOT NULL,
            department VARCHAR(50) NOT NULL,
            sort VARCHAR(50) NOT NULL,
            quantity INT(10) NOT NULL,
            units VARCHAR(10) NOT NULL,
            price_selection VARCHAR(10) NOT NULL,
            value INT(10) NOT NULL,
            comment VARCHAR(250) NOT NULL,
            PRIMARY KEY(id))";
            
    
    $stmt = $connection->prepare($sql);
    } 

    public static function createTableAddshop($connection) {
        $sql = "CREATE TABLE IF NOT EXISTS addshop (
            id INT(10) NOT NULL AUTO_INCREMENT,
            user_id VARCHAR(50) NOT NULL,
            shop_name VARCHAR(50) NOT NULL, 
            PRIMARY KEY(id))";
            
    
    $stmt = $connection->prepare($sql);
    } 
}