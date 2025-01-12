    /* 
    Nom du fichier : modal-scripts-index.js
    Auteur : Lady Quintero
    Date de création : Septembre - Octobre 2023
    Description : Ce script gère l'affichage et la fermeture de la modal de contact dans l'en-tête.
    */
    // MODALE CONTACT - HEADER
    var headerModal = document.getElementById('myModal');
    var headerBtn = document.getElementById("open-modal-button-header");
    var headerSpan = document.getElementsByClassName("close")[0];

    // Afficher le modal header
    headerBtn.onclick = function() {
        headerModal.style.display = "block";
    }

    // Masquer le modal header
    headerSpan.onclick = function() {
        headerModal.style.display = "none";
    }

    // Fermer le modal header en cliquant en dehors
    window.onclick = function(event) {
        if (event.target == headerModal) {
            headerModal.style.display = "none";
        }
    }