<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['ids'])) {
    $ids = $_POST['ids']; // Récupérer les ID cochés

    try {
        // 🔹 Supprimer les participants sélectionnés
        $stmt = $conn->prepare("DELETE FROM participants WHERE id IN (" . implode(",", array_fill(0, count($ids), "?")) . ")");
        $stmt->execute($ids);

        // 🔄 Redirection après suppression
        header("Location: participants.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
} else {
    // 🚫 Aucune sélection, retour à la liste
    header("Location: participants.php");
    exit();
}
?>