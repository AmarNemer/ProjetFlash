<?php
require 'config.php';

// Récupérer le nombre de places disponibles
$sql = "SELECT places_disponibles FROM participants WHERE id = 1";
try {
    $stmt = $conn->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode(['places_disponibles' => $row['places_disponibles']]);
} catch(PDOException $e) {
    echo json_encode(['places_disponibles' => 100]); // Valeur par défaut en cas d'erreur
}
?>