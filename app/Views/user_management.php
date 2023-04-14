<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikersbeheer</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<h1>Gebruikersbeheer</h1>
<a href="user-management/add" class="button">Gebruiker Toevoegen</a>
<table>
    <thead>
    <tr>
        <th>Nummer</th>
        <th>Naam</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acties</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (empty($gebruikers)): ?>
        <tr>
            <td colspan="5">Er zijn geen gebruikers gevonden.</td>
        </tr>
    <?php
    endif; ?>

    <form method="get">
        <label for="search">Zoeken:</label>
        <input type="text" id="search" name="search" value="<?= htmlentities($search) ?>">
        <button type="submit">Zoeken</button>
    </form>

    <?php
    foreach (
        $gebruikers

        as $user
    ): ?>
        <tr>
            <td><?= $user['GebruikerID'] ?></td>
            <td><?= $user['Naam'] . ' ' . $user['Achternaam'] ?></td>
            <td><?= $user['Email'] ?></td>
            <td><?= $user['Rol'] ?></td>
            <td>
                <a href="/user-management/edit/<?= $user['GebruikerID'] ?>" class="button">Wijzigen</a>
                <a href="/user-management/delete/<?= $user['GebruikerID'] ?>" class="button">Verwijderen</a>
            </td>
        </tr>
    <?php
    endforeach; ?>
</table>

<a href="/home" class="button">Terug</a>
</body>
</html>