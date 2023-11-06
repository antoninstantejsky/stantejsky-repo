<?php

require "classes/Database.php";
require "classes/Sort.php";
require "classes/Shop.php";


$database = new Database();
$connection = $database->connectionDB();

$allsort= Sort::getAllSort($connection, "shop, department, sort, quantity, units, price_selection, value, comment");
$allshop= Shop::getShop($connection, "shop_name");
 if(!empty($allshop)) {
    foreach($allshop as $one_shop);
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

    <section class="shop-list-form">
        <form action="admin/add-shop.php" method="POST">
            <input type="text" name="shop_name" id="shop_name" placeholder="přidat obchod"><br>
            <input type="text" name="user_id" id="" placeholder="user_id"><br>
            <input type="submit" value="Přidat" name="add_shop"><br><br>
        </form>

        <form action="admin/add-sort.php" method="POST">
        <input type="text" name="user_id" id="" placeholder="user_id"><br>
            <label for="shop" id="shop">Obchod</label><br>
            <input type="text" name="shop" id="" placeholder="Obchod"><br>
            <label for="oddělení">Oddělení</label><br>
            <select name="department">
                <option value="Ovoce a zelenina">Ovoce a zelenina</option>
                <option value="Konzervy">Konzervy</option>
                <option value="Maso a uzeniny">Maso a uzeniny</option>
                <option value="Pečivo">Pečivo</option>
                <option value="Těstoviny">Těstoviny</option>
                <option value="Luštěniny">Luštěniny</option>
                <option value="Lahůdky">Lahůdky</option> 
                <option value="Cereálie">Cereálie</option>
                <option value="Drogerie">Drogerie</option>
                <option value="Alkohol">Alkohol</option>
                <option value="Nealko nápoje">Nealko nápoje</option>
            </select><br>
            <label for="sort">Název položky</label><br>
            <input type="text" name="sort" placeholder="např. vejce, chléb..." ><br>
            <label for="quantity">Množství</label><br>
            <input type="number" name="quantity">

           <label for="units" id="units">Jednotky</label>
           <select name="units" id="units">
                <option value="ks">ks</option>
                <option value="kg">kg</option>
                <option value="gr">gr</option>
                <option value="ml">ml</option>
                <option value="litr">litr</option>
                <option value="bal">bal</option>
            </select><br>
            <select name="price_selection">
                <option value="null">Prázdný</option>
                <option value="cena">Cena</option>
                <option value="max. cena">Cena max</option>
            </select>
            <input type="number" name="value">Kč<br>
            <textarea name="comment" placeholder="Poznámka"></textarea><br>
            <input type="submit" value="Přidat na seznam" name="add_sort">
        </form>
           
        
    </section>

    

    <section class="shop-list">
    <?php if(empty($allsort)):?>
<p>nákupní seznam je prázdný</p>
<?php else: ?>
    <div class="all-sort-list">
        <?php foreach($allsort as $one_sort): ?>
            <div class = "one-sort">
                <p><?=htmlspecialchars($one_sort["department"])?></p>
               <p><?=htmlspecialchars($one_sort["sort"])." ".htmlspecialchars($one_sort["quantity"])
               ." ".htmlspecialchars($one_sort["units"])." ".htmlspecialchars($one_sort["price_selection"])." ".htmlspecialchars($one_sort["value"])
               ." ".htmlspecialchars($one_sort["comment"]) ?></p> 
        </div>
        <?php endforeach; ?>
        </div>
    <?php endif ?>
        </section>
   
</body>
</html>