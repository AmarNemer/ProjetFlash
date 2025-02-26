<?php
session_start(); // Assure que la session est toujours démarrée

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Five Star</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo_5star.png" alt="Logo Five Star">
        </div>
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
    </header>
