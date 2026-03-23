// addBook.js
function validerFormulaire() {
    // Récupération des valeurs
    const titre = document.getElementById('title').value.trim();
    const auteur = document.getElementById('author').value.trim();
    const datePub = document.getElementById('publication_date').value;
    // Récupération de la langue sélectionnée (radio buttons)
    let langue = '';
    const radioLang = document.getElementsByName('language');
    for (let i = 0; i < radioLang.length; i++) {
        if (radioLang[i].checked) {
            langue = radioLang[i].value;
            break;
        }
    }
    const statut = document.getElementById('status').value;
    const copies = document.getElementById('number_of_copies').value;

    // Validation
    let erreurs = [];

    // Titre : au moins 3 caractères
    if (titre.length < 3) {
        erreurs.push('Le titre doit contenir au moins 3 caractères.');
    }

    // Auteur : uniquement lettres et espaces, min 3 caractères
    const regexAuteur = /^[A-Za-z\s]{3,}$/;
    if (!regexAuteur.test(auteur)) {
        erreurs.push('L\'auteur doit contenir uniquement des lettres et espaces (minimum 3 caractères).');
    }

    // Date de publication obligatoire
    if (datePub === '') {
        erreurs.push('La date de publication est obligatoire.');
    }

    // Langue : AN ou FR
    if (langue !== 'AN' && langue !== 'FR') {
        erreurs.push('La langue doit être AN (Anglais) ou FR (Français).');
    }

    // Statut : Disponible ou Indisponible
    if (statut !== 'Disponible' && statut !== 'Indisponible') {
        erreurs.push('Le statut doit être "Disponible" ou "Indisponible".');
    }

    // Nombre d'exemplaires : entier positif ≥ 1
    const nbCopies = parseInt(copies);
    if (isNaN(nbCopies) || nbCopies < 1) {
        erreurs.push('Le nombre d\'exemplaires doit être un entier positif (≥ 1).');
    }

    // Affichage des erreurs
    if (erreurs.length > 0) {
        alert(erreurs.join('\n'));
        return false; // Empêche l'envoi du formulaire
    }

    // Si tout est valide, on peut laisser le formulaire s'envoyer
    return true;
}