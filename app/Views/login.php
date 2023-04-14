<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studenten Cijfer Applicatie - Inloggen</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<h1>Inloggen</h1>
<form action="/login" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <label for="password">Wachtwoord:</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Inloggen" class="submit-button">
    <?php
    if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php
    endif; ?>
</form>
</body>
</html>
