<?php
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure le fichier de configuration pour la connexion à la base de données
require 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);

    // Commencer une transaction pour s'assurer que les deux opérations réussissent
    $conn->beginTransaction();

    try {
        // Insérer les données du participant
        $sql = "INSERT INTO participants (nom, email, telephone, role) VALUES (:nom, :email, :telephone, 'participant')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->execute();

        // Décrémenter le nombre de places disponibles dans la table `evenement`
        $sqlUpdatePlaces = "UPDATE evenement SET places_disponibles = places_disponibles - 1 WHERE id = 1"; // Suppose que l'ID 1 correspond à l'événement
        $stmtUpdate = $conn->prepare($sqlUpdatePlaces);
        $stmtUpdate->execute();

        // Valider la transaction
        $conn->commit();

        // Rediriger vers une page de confirmation
        header("Location: confirmation_inscription.html");
        exit();
    } catch(PDOException $e) {
        // Annuler la transaction en cas d'erreur
        $conn->rollBack();
        echo "Erreur lors de l'inscription : " . $e->getMessage();
        exit();
    }
} else {
    // Rediriger vers la page d'inscription si le formulaire n'a pas été soumis
    header("Location: index.html");
    exit();
}
header("Location: index.php");
exit();
?>