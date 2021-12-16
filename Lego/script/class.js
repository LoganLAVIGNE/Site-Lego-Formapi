//Fonction d'affichage du formulaire de connexion
function afficherDivConnexion(){
    document.getElementById("arriere_plan_div_connexion").style.display = "block";
    document.getElementById("div_connexion").style.display = "grid";
}

//Fonction de fermeture du formulaire de connexion
function fermerDivConnexion(){
    document.getElementById("arriere_plan_div_connexion").style.display = "none";
    document.getElementById("div_connexion").style.display = "none";
}

//Fonction de confirmation de deconnexion
function confirm_suppr_session(){
    
    if(confirm("Voulez-vous vous déconnecter ?") == true)
    {
        document.location.href="actions/deconnexion_utilisateur.php?confirm=1";
    }
}

//Fonction de confirmation d'ajout d'un article au panier
function ajoutPanier(id){
    if(confirm("Voulez-vous ajouter cet article à votre panier ?") == true)
    {
        document.location.href="actions/ajouter_panier.php?id_article="+id;
    }
}

//Fonction d'affichage de la liste d'envies
function afficherWishlist(){
    divInfo = document.getElementById('wishlist');

    if (divInfo.style.display == 'none')
    divInfo.style.display = 'grid';
    else
    divInfo.style.display = 'none';
}

//Fonction d'affichage du panier
function afficherPanier(){
    divInfo = document.getElementById('panier');

    if (divInfo.style.display == 'none')
    divInfo.style.display = 'grid';
    else
    divInfo.style.display = 'none';
}

//Fonction d'impression de la page active
function imprimer(){
    window.print();
}