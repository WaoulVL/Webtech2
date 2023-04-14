<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikersbeheer - Gebruiker Verwijderen</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<h1>Gebruiker Verwijderen</h1>
<div>
    <?php
    if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php
    endif; ?>
</div>
<form method="post">
    weet je zeker dat je <?= $gebruiker['Naam'] ?> wilt verwijderen?
    <button type="submit">Verwijderen</button>
</form>
</body>
</html>
