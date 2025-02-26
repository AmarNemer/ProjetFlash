<?php
session_start();
include 'config.php'; // Utilisation de la connexion définie dans config.php

try {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifier si l'admin existe
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // Vérification du mot de passe
        if (password_verify($mot_de_passe, $admin['mot_de_passe'])) {
            // Connexion réussie, on stocke l'admin dans la session
            $_SESSION['admin_logged_in'] = true;
            header("Location: participants.php");
            exit();
        } else {
            header("Location: login.php?error=password");
            exit();
        }
    } else {
        header("Location: login.php?error=email");
        exit();
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
