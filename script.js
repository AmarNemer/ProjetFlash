// Fonctions pour gérer la fenêtre pop-up
function openModal() {
  document.getElementById("inscriptionModal").style.display = "block";
}

function closeModal() {
  document.getElementById("inscriptionModal").style.display = "none";
}

// Fermer la fenêtre pop-up si l'utilisateur clique en dehors
window.onclick = function (event) {
  const modal = document.getElementById("inscriptionModal");
  if (event.target === modal) {
    modal.style.display = "none";
  }
};

// Validation du formulaire d'inscription
function validateForm() {
  const nom = document.getElementById("nom").value.trim();
  const email = document.getElementById("email").value.trim();
  const telephone = document.getElementById("telephone").value.trim();
  const mot_de_passe = document.getElementById("mot_de_passe").value.trim();
  const confirmation_mot_de_passe = document
    .getElementById("confirmation_mot_de_passe")
    .value.trim();

  if (
    nom === "" ||
    email === "" ||
    telephone === "" ||
    mot_de_passe === "" ||
    confirmation_mot_de_passe === ""
  ) {
    alert("Tous les champs sont obligatoires.");
    return false;
  }

  if (mot_de_passe !== confirmation_mot_de_passe) {
    alert("Les mots de passe ne correspondent pas.");
    return false;
  }

  return true;
}

// Affichage dynamique du nombre de places restantes
function updatePlacesDisponibles() {
  const placesDisponiblesElement =
    document.getElementById("places-disponibles");
  let placesDisponibles = parseInt(placesDisponiblesElement.textContent, 10);

  // Simuler une réduction des places disponibles pour démonstration
  if (placesDisponibles > 0) {
    placesDisponibles -= 1;
    placesDisponiblesElement.textContent = placesDisponibles;
  }
}

    // Date de l'événement (15 juin 2023)
    const eventDate = new Date("2025-06-15T00:00:00").getTime();

    // Mettre à jour le compte à rebours toutes les secondes
    const countdown = setInterval(() => {
        const now = new Date().getTime(); // Date et heure actuelles
        const distance = eventDate - now; // Temps restant en millisecondes

        // Calcul des jours, heures, minutes et secondes
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Affichage du compte à rebours
        document.getElementById("countdown").innerHTML = `
            ${days}j ${hours}h ${minutes}m ${seconds}s
        `;

        // Si le compte à rebours est terminé
        if (distance < 0) {
            clearInterval(countdown);
            document.getElementById("countdown").innerHTML = "L'événement a commencé !";
        }
    }, 1000); // Mise à jour toutes les secondes

document
  .getElementById("inscription-form")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Empêcher la soumission normale du formulaire

    // Récupérer les données du formulaire
    const formData = new FormData(this);

    // Envoyer les données via AJAX
    fetch("inscription.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        alert("Inscription réussie!"); // Afficher un message de succès
        closeModal(); // Fermer le modal
      })
      .catch((error) => {
        console.error("Erreur :", error);
      });
  });
