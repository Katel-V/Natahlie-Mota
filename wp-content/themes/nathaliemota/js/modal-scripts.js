// MODALE CONTACT

var headerModal = document.getElementById('myModal');
var headerBtn = document.getElementById("open-modal-button-header");
var headerSpan = document.getElementsByClassName("close")[0];

// Affiche la modale dans le header
headerBtn.onclick = function() {
    headerModal.style.display = "block";
}

// Masque la modale header
headerSpan.onclick = function() {
    headerModal.style.display = "none";
}

// Ferme la modale header en cliquant en dehors
window.onclick = function(event) {
    if (event.target == headerModal) {
        headerModal.style.display = "none";
    }
}