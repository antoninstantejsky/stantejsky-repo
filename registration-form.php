<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<main>
        <section class="registration-form">
            <h1>Registrace</h1>
            <form action="admin/after-registration.php" method="POST">
                <input class="reg-input" type="text" name="first_name" placeholder="Křestní jméno" ><br>
                <input class="reg-input" type="text" name="second_name" placeholder="Přijmení" ><br>
                <input class="reg-input" type="email" name="email" placeholder="Email" ><br>

                <input class="reg-input password-first" type="password" name="password" placeholder="Heslo" ><br>
                <input class="reg-input password-second" type="password" name="password-again" placeholder="Heslo znovu" ><br>
                <p class="result-text"></p>
                <input class="btn" type="submit" value="Zaregistrovat">
            </form>
        </section>
    </main>
</body>
</html>