<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back-Office | My Cinema</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <header>
        <h1>Gestion du Cinéma</h1>
        <nav>
            <a href="index.php">Liste des films</a> | 
            <a href="index.php?action=api">Voir l'API</a>
        </nav>
    </header>

    <main>
        <h2>Films à l'affiche</h2>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movies as $movie): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($movie['title']) ?></strong></td>
                    <td><?= htmlspecialchars($movie['description']) ?></td>
                    <td>
                        <button>Modifier</button>
                        <button style="background-color: #ff4d4d;">Supprimer</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>