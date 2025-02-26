<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Connexion Admin</title>
</head>
<body>
    <h2>Connexion Admin</h2>
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] === 'password') {
            echo "<p style='color: red;'>Mot de passe incorrect.</p>";
        } elseif ($_GET['error'] === 'email') {
            echo "<p style='color: red;'>Aucun administrateur trouvé avec cet email.</p>";
        }
    }
    ?>
    <form class="modal-content" method="POST" action="traitement_login.php">
        <!-- Champ Email -->
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <!-- Champ Mot de passe -->
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

        <!-- Bouton de soumission -->
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>