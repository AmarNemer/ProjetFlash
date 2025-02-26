<?php
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure le fichier de configuration pour la connexion à la base de données
require 'config.php';

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'inscription.php'; // Inclure le fichier de traitement
}

// Récupérer le nombre de places disponibles depuis la table `evenement`
$sql = "SELECT places_disponibles FROM evenement WHERE id = 1"; // Suppose que l'ID 1 correspond à l'événement
try {
    $stmt = $conn->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $places_disponibles = $row['places_disponibles'];
} catch(PDOException $e) {
    $places_disponibles = 100; // Valeur par défaut en cas d'erreur
}
include 'header.php';
?>


    <main>
        <div class="bloc">
            <section id="event-description">
                <div class="titre">
                    <h2>Qu'est-ce que le Five Futsal ?</h2>
                </div>
                <div class="description">
                    <img src="images/five_one.jpg" alt="Image Futsal 1">
                    <p>
                        Le Five Futsal est une variante du football jouée sur un terrain synthétique plus petit, avec des équipes de cinq joueurs.
                        Ce sport dynamique et rapide met l'accent sur la technique, la précision et la stratégie.
                    </p>
                </div>
            </section>

            <section id="event-details">
                <h2>Pourquoi choisir le Five Futsal ?</h2>
                <div class="description">
                    <img src="images/five_two.webp" alt="Image Futsal 2">
                    <p>
                        Le Five Futsal est idéal pour améliorer vos compétences techniques, votre condition physique et votre esprit d'équipe.
                        Que vous soyez amateur ou professionnel, ce sport offre une expérience unique et passionnante.
                    </p>
                </div>
            </section>
        </div>

        <section id="call-to-action">
            <p><strong>Date :</strong> 15 Juin 2025</p>
            <p><strong>Lieu :</strong> Stade de Futsal Five Star, Paris</p>
            <p><strong>Places Disponibles :</strong> <span id="places-disponibles"><?php echo $places_disponibles; ?></span></p>
            <p><strong>Temps restant :</strong> <span id="countdown"></span></p>
            <h2>Ne manquez pas cette opportunité!</h2>
            <button class="btn" onclick="openModal()">Inscrivez-vous Maintenant</button>
        </section>
        
        <!-- Fenêtre pop-up pour l'inscription -->
        <div id="inscriptionModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Inscription</h2>
                <form id="inscription-form" action="inscription.php" method="POST" onsubmit="return validateForm()">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                    
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="telephone">Téléphone :</label>
                    <input type="tel" id="telephone" name="telephone" required>
                    
                    <button type="submit">S'inscrire</button>
                </form>
            </div>
        </div>
    </main>
        
        <footer>
        <p>&copy; 2025 Five Star. Tous droits réservés.</p>
    </footer>
</body>
</html>