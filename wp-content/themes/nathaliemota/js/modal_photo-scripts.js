// Ouverture et fermeture de la modal de contact pour une photo unique

if( jQuery('#myBtn-photo').length ){
    // MODAL CONTACT - SINGLE-PHOTO
    var photoModal = document.getElementById('myModal-photo');
    var photoBtn = document.getElementById("myBtn-photo");
    var photoSpan = document.getElementsByClassName("close-photo")[0];

    // Afficher le modal single-photo
    photoBtn.onclick = function() {
        photoModal.style.display = "block";
    }

    // Masquer le modal single-photo
    photoSpan.onclick = function() {
        photoModal.style.display = "none";
    }

    // Fermer le modal single-photo en cliquant en dehors
    window.onclick = function(event) {
        if (event.target == photoModal) {
            photoModal.style.display = "none";
        }
    }

    // MISE À JOUR DU CHAMP #REF-PHOTO DANS LE FORMULAIRE DE CONTACT 7
    jQuery(document).ready(function($) {
        $("#myBtn-photo").on('click', function() {
            // Définissez la valeur de #ref-photo lorsque le bouton est cliqué.
            $("#ref-photo").val(acfReferencePhoto);
        });
    });
    
}