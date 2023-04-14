<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikersbeheer - Gebruiker Wijzigen</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<h1>Gebruiker Wijzigen</h1>
<div>
    <?php
    if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php
    endif; ?>
</div>
<form action="post">
    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" value="<?= $gebruiker['Naam'] ?>">
    <label for="achternaam">Achternaam:</label>
    <input type="text" id="achternaam" name="achternaam" value="<?= $gebruiker['Achternaam'] ?>">
    <label for="geboortedatum">Geboortedatum:</label>
    <input type="date" id="geboortedatum" name="geboortedatum" value="<?= $gebruiker['Geboortedatum'] ?>">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= $gebruiker['Email'] ?>">
    <label for="telefoonnummer">Telefoonnummer:</label>
    <input type="tel" id="telefoonnummer" name="telefoonnummer" pattern="[+][0-9]{2-3} [0-9]{5-15}" value="<?= $gebruiker['Telefoonnummer'] ?>">
    <br>
    <div>formaat: +31 0612345678</div>
    <br>
    <label for="rol">Rol:</label>
    <?php
    $rol = $gebruiker['Rol'];
    if ($rol == 'student') {
        echo '<select name="rol" id="rol">
        <option value="student" selected>Student</option>
        <option value="docent">Docent</option>
        <option value="beheerder">Beheerder</option>
    </select>';
    } elseif ($rol == 'docent') {
        echo '<select name="rol" id="rol">
        <option value="student">Student</option>
        <option value="docent" selected>Docent</option>
        <option value="beheerder">Beheerder</option>
    </select>';
    } elseif ($rol == 'beheerder') {
        echo '<select name="rol" id="rol">
        <option value="student">Student</option>
        <option value="docent">Docent</option>
        <option value="beheerder" selected>Beheerder</option>
    </select>';
    }
    ?>
    <button type="submit">Wijzigen</button>
</form>
</body>
</html>