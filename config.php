<?php
$host = 'localhost'; // ou l'adresse IP du serveur de base de données
$dbname = 'five_star';
$username = 'root'; // Remplacez par votre nom d'utilisateur MySQL
$password = 'root'; // Remplacez par votre mot de passe MySQL

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur PDO à exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>