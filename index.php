<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Vítejte na KupChleba</h1>
    
    <main>
        <a href="registration-form.php">Registrace</a>
        <section class="form">
            <h1>Přihlášení</h1>
            <form action="admin/login.php" method="POST">
                <input class="email" type="email" name="login-email" placeholder="Email" ><br>
                <input class="password" type="password" name="login-password" placeholder="Heslo" ><br>
                <input class="btn" type="submit" value="Přihlásit se">
            </form>
        </section>
        <a href="shop-list.php">Chci jednorázově vytvořit nákupní seznam</a>
    </main>
</body>
</html>