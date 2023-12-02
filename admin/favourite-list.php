<?php

require "../classes/Database.php";
require "../classes/Sort.php";
require "../classes/Auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nepovolený přístup");
}

$user_id = $_SESSION["logged_in_user_id"];
var_dump ($user_id);

$database = new Database();
$connection = $database->connectionDB();

$fav_sort=Sort::getFavouriteSort($connection,$user_id, "shop, department, id, sort, quantity, units, price_selection, value, comment");

$sorted_array=[]; 
 foreach ($fav_sort as $one_sort) {
    $sorted_array[$one_sort['shop']][]=$one_sort;
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
    <a href="user-list.php">tvorba seznamu</a>
    <h1>Oblíbené položky</h1>

<section class="fav-list">
    <?php if(empty($sorted_array)):?>
        <p>Žádné oblíbené položky</p>
<?php else: ?>
    <div class="all-fav-list">
        <div class="one-sort">
                <?php foreach($sorted_array as $key=>$obchody): ?>
                <h2><?php echo "$key"?></h2>
                <?php foreach($obchody as $one_sort): ?>
                   <p><?php 
                    echo
                    ($one_sort["sort"])." ". 
                    ($one_sort["quantity"])." ". 
                    ($one_sort["units"]);
                    ?>
                <?php endforeach;?>
            <?php endforeach;?>
            
            
           
            
        </div>   
    </div>
    <?php endif ?>   
</section>
   
</body>
</html>