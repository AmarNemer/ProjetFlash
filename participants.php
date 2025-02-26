<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
include 'config.php';

try {
    // 🔹 Récupérer tous les participants avec leur ID
    $stmt = $conn->query("SELECT id, nom, email, telephone, date_inscription FROM participants");
    $participants = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Participants</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
          <h1>Five Star</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><button onclick="openModal()">Inscription</button></li>
                <li><a href="participants.php">Liste des inscrits</a></li>
                <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) : ?>
                    
                <?php else : ?>
                    <li><a href="login.php">Connexion Admin</a></li>
                <?php endif; ?>
            </ul>
        </nav>

    <h2>Liste des Participants</h2>
    
    <form method="POST" action="supprimer_participants.php" onsubmit="return confirm('Voulez-vous vraiment supprimer les participants sélectionnés ?');">
        <table>
            <tr>
                <th>Sélection</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date d'Inscription</th>
            </tr>
            <?php if (!empty($participants)) : ?>
                <?php foreach ($participants as $participant) : ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="ids[]" value="<?= htmlspecialchars($participant['id']) ?>">
                        </td>
                        <td><?= htmlspecialchars($participant['nom']) ?></td>
                        <td><?= htmlspecialchars($participant['email']) ?></td>
                        <td><?= htmlspecialchars($participant['telephone']) ?></td>
                        <td><?= htmlspecialchars($participant['date_inscription']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Aucun participant inscrit</td>
                </tr>
            <?php endif; ?>
        </table>
        <br>
        <button type="submit">Supprimer les sélectionnés</button>
    </form>

    <br>
    <a href="logout.php">Se déconnecter</a>

</body>
</html>
