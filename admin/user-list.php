<?php

require "../classes/Database.php";
require "../classes/Sort.php";
require "../classes/Shop.php";
require "../classes/Auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nepovolený přístup");
}

$user_id = $_SESSION["logged_in_user_id"];
var_dump ($user_id);

$database = new Database();
$connection = $database->connectionDB();

$allsort= Sort::getUserSort($connection, $user_id, "favourite, shop, department, id, sort, quantity, units, price_selection, value, comment");
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
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/user-list.css">
    <title>Document</title>
</head>
<body>
    <a href="log-out.php">Odhlásit</a>
    <a href="favourite-list.php">Oblíbené položky</a>
    <h1>Můj nákupní seznam</h1>

   <?php require "../assets/shop-form-auth.php"; ?>

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
                    ($one_sort["units"])." ";
                    if (!empty($one_sort["price_selection"]))
                    { echo
                        ($one_sort["price_selection"])." ".
                        ($one_sort["value"]) ."Kč";
                    }
                     echo
                    ($one_sort["comment"]);
                    ?>
                    <a href="add-favourite.php?id=<?=$one_sort['id'] ?>">oblíbené</a>
                    <a href="delete-sort.php?id=<?=$one_sort['id']?>&favourite=<?=$one_sort['favourite']?>">smazat</a>
                <?php endforeach;?>
            <?php endforeach;?>
            <?php endforeach;?>
            
           
            
        </div>   
    </div>
    <?php endif ?>   
</section>
   
</body>
</html>