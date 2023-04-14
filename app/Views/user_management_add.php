<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikersbeheer - Gebruiker Toevoegen</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<h1>Gebruiker Toevoegen</h1>
<div>
    <?php
    if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php
    endif; ?>
</div>
<form method="post">
    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam">
    <label for="achternaam">Achternaam:</label>
    <input type="text" id="achternaam" name="achternaam">
    <label for="geboortedatum">Geboortedatum:</label>
    <input type="date" id="geboortedatum" name="geboortedatum">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">
    <label for="telefoonnummer">Telefoonnummer:</label>
    <input type="tel" id="telefoonnummer" name="telefoonnummer" pattern="[+][0-9]{2-3} [0-9]{5-15}">
    <br>
    <div>formaat: +31 0612345678</div>
    <br>
    <label for="wachtwoord">Wachtwoord:</label>
    <input type="password" id="wachtwoord" name="wachtwoord">
    <label for="rol">Rol:</label>
    <select name="rol" id="rol">
        <option value="student">Student</option>
        <option value="docent">Docent</option>
        <option value="beheerder">Beheerder</option>
    </select>
    <button type="submit">Toevoegen</button>
</form>
<br>
<a href="/user-management" class="button">Terug</a>
</body>
</html>