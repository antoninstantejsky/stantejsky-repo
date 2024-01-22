<?php

require "classes/Database.php";
require "classes/Sort.php";
require "classes/Shop.php";
require "classes/User.php";

session_start();


$database = new Database();
$connection = $database->connectionDB();

$first_name = "";
$second_name = "";
$email = uniqid()."@".uniqid().".cz";
$password = "";

User::createUser($connection, $first_name, $second_name, $email, $password);
$user_id= User::getUserId($connection, $email);
echo $user_id;

$allsort= Sort::getUserSort($connection, $user_id, "shop, department, sort, quantity, units, price_selection, value, comment");
$allshop= Shop::getUserShop($connection, $user_id, "shop_name");

 
 $sorted_array=[]; 
 foreach ($allsort as $one_sort) {
    $sorted_array[$one_sort['shop']][$one_sort['department']][]=$one_sort;
 }
 


?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Můj nákupní seznam</h1>

    <?php require "assets/shop-form.php";?>

<section class="shop-list">
    <?php if(empty($sorted_array)):?>
        <p>nákupní seznam je prázdný</p>
<?php else: ?>
    <div class="all-sort-list">
        <div class="one-sort">
                <?php foreach($sorted_array as $key=>$obchody): ?>
                <h2><?php echo "$key"?></2>
                <?php foreach($obchody as $key=>$oddeleni): ?>
                <h3><?php echo "$key"?></h3>
                <?php foreach($oddeleni as $one_sort): ?>
                   <p><?php 
                    echo
                    ($one_sort["sort"])." ". 
                    ($one_sort["quantity"])." ". 
                    ($one_sort["units"])." ".
                    ($one_sort["price_selection"])." ".
                    ($one_sort["value"]) ."Kč". " ". 
                    ($one_sort["comment"]);
                    ?></p>
                <?php endforeach;?>
            <?php endforeach;?>
            <?php endforeach;?>
            
           
            
        </div>   
    </div>
    <?php endif ?>   
</section>
   
</body>
</html>