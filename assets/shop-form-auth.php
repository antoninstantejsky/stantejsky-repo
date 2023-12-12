
 <section class="shop-list-form">
    <form action="../assets/add-shop-auth.php" method="POST">
        <input type="text" name="shop_name" id="shop_name" placeholder="přidat obchod"><br>
        <input type="submit" value="Přidat" name="add_shop"><br><br>
    </form>

    <form action="../assets/add-sort-auth.php" method="POST">
        <label for="shop" id="shop">Obchod</label><br>
            <?php if(!empty($allshop)) { ?>
                <select name="shop" >
                 <?php foreach ($allshop as $one_shop): ?>
                    <option value="<?php echo $one_shop['shop_name'];?>"><?php echo $one_shop['shop_name'];?></option>
            <?php endforeach; ?>
        </select> <?php } ?><br>
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
        <input type="text" name="quantity">

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
            <option value="">Prázdný</option>
            <option value="cena">Cena</option>
            <option value="max. cena">Cena max</option>
        </select>
        <input type="text" name="value">Kč<br>
        <textarea name="comment" placeholder="Poznámka"></textarea><br>
        <input type="submit" value="Přidat na seznam" name="add_sort">
    </form>
 </section>