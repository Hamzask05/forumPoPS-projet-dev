

function afficherImage(source) {
    // On cible l'image qui est dans la modale
    var imageZoom = document.getElementById('imageDansLeModal');
    
    // On remplace sa source par celle de la photo cliquée
    if (imageZoom) {
        imageZoom.src = source;
    } else {
        console.error("Erreur : L'image de la modale n'a pas été trouvée.");
    }
}