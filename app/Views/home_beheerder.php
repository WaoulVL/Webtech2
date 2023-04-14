<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Studenten Cijfer Applicatie - Home</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php
if (isset($gebruiker)): ?>
    <h1>Welkom <?= $gebruiker['Naam'] ?></h1>
    <a href="/user-management" class="button">Gebruikersbeheer</a>
    <a href="/logout" class="button">Uitloggen</a>
<?php endif; ?>
</body>
</html>
