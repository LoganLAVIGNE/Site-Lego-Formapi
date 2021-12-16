function afficherDivConnexion(){
    document.getElementById("arriere_plan_div_connexion").style.display = "block";
    document.getElementById("div_connexion").style.display = "grid";
}

function fermerDivConnexion(){
    document.getElementById("arriere_plan_div_connexion").style.display = "none";
    document.getElementById("div_connexion").style.display = "none";
}

function confirm_suppr_session(){
    
    if(confirm("Voulez-vous vous déconnecter ?") == true)
    {
        document.location.href="actions/deconnexion_utilisateur.php?confirm=1";
    }
}

function ajoutPanier(id){
    if(confirm("Voulez-vous ajouter cet article à votre panier ?") == true)
    {
        document.location.href="actions/ajouter_panier.php?id_article="+id;
    }
}

function afficherWishlist(){
    divInfo = document.getElementById('wishlist');

    if (divInfo.style.display == 'none')
    divInfo.style.display = 'grid';
    else
    divInfo.style.display = 'none';
}

function afficherPanier(){
    divInfo = document.getElementById('panier');

    if (divInfo.style.display == 'none')
    divInfo.style.display = 'grid';
    else
    divInfo.style.display = 'none';
}

function imprimer(){
    window.print();
}