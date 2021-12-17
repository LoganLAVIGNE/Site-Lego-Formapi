//Fonction pour afficher les articles selon les critères de recherche
function triagePrix(){
    var valeur = parseInt(document.getElementById('gamme_prix').value);

    //Si la valeur reçue n'est pas un séparateur mais bien une plage de nombres
    if(valeur != "-")
    {
        //On regarde de quelle plage il s'agit
        switch(valeur)
        {
            //0 - 20
            case 1:
                var prix1 = 0;
                var prix2 = 20;
                var innerhtml = "0€ - 20€";
                break;
            //20 - 50
            case 2:
                var prix1 = 20;
                var prix2 = 50;
                var innerhtml = "20€ - 50€";
                break;
            //50 - 100
            case 3:
                var prix1 = 50;
                var prix2 = 100;
                var innerhtml = "50€ - 100€";
                break;
            //100 - 200
            case 4:
                var prix1 = 100;
                var prix2 = 200;
                var innerhtml = "100€ - 200€";
                break;
            //200 + 
            case 5:
                var prix1 = 200;
                var prix2 = 20000; //histoire d'être sûr
                var innerhtml = "200€+";
                break;
        }
        document.location.href="boutique.php?prix1="+prix1+"&prix2="+prix2+"&valeur="+valeur+"$innerhtml="+innerhtml;    
    }    
}

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

//Fonction vérifiant les données du formulaire de confirmation de commande
function verification()
{
   //On récupère le nom
    var nom = document.getElementById('nominsert');

    //On initialise les caractères interdits
    var nombre =[1,2,3,4,5,6,7,8,9,0];

    //On vérifie si le nom contient des caractères interdits
    for(i=0;i<nom.value.length;i++)
    {
        for(j=0;j<nombre.length;j++)
        {
            //S'il en contient
            if(nom.value[i]==nombre[j])
            {
                //On avertit l'utilisateur
                alert("Nom invalide");
                //On met les focus sur le nom
                nom.focus();
                //On ne valide pas le formulaire
                return false;
            }
        }
    }

    //On récupère le prénom
    var prenom = document.getElementById('prenominsert');

    //On vérifie si le prénom contient des caractères interdits
    for(i=0;i<prenom.value.length;i++)
    {
        for(j=0;j<nombre.length;j++)
        {
            //S'il en contient
            if(prenom.value[i]==nombre[j])
            {
                //On avertit l'utilisateur 
                alert("Prenom invalide");
                //On met le focus sur le nom
                prenom.focus();
                //On ne valide pas le formulaire
                return false;
            }
        }
    }

    //On récupère le code postal
    var cp = document.getElementById('cpinsert');

    //Si le code postal est négatif ou égal à 0
    if(cp.value <= 0)
    {
        //On alerte l'utilisateur
        alert("Code Postal invalide");
        //On met le focus sur le code postal
        cp.focus();
        //On ne valide pas le formulaire
        return false;
    }
    //Si le code postal à plus de 5 chiffres
    else if(cp.value.length != 5)
    {
        alert("Code Postal invalide (différent de 5)");
        cp.focus();
        return false;
    }

    var ville = document.getElementById('villeinsert');

    //On vérifie si la ville contient des caractères interdits
    for(i=0;i<ville.value.length;i++)
    {
        for(j=0;j<nombre.length;j++)
        {
            if(ville.value[i]==nombre[j])
            {
                alert("Nom de Ville invalide");
                ville.focus();
                return false;
            }
        }
    }

    var tel = document.getElementById('telinsert');

    //On initialise les différents séparateurs possibles dans le numéro de téléphone
    var carac=['.', ' ', '_', '-'];

    //On vérifie si le numéro contient des séparateurs
    for(i=0;i<tel.value.length;i++)
    {
        for(j=0;j<carac.length;j++)
        {
            //S'il en contient
            if(tel.value[i] == carac[j])
            {
                //On formatte le numéro
                //On remplace le séparateur par un caractère vide, afin de supprimer le séparateur
                tel.value = tel.value.replace(carac[j], '');
            }
        }
    }

    //Si le numéro commence par un "+33"
    if(tel.value.includes('+33'))
    {
        //On le remplace par 0
        tel.value = tel.value.replace('+33', '0');
    }

    //Si le numéro ne fait pas 10 chiffre,
    //Longueur conventionnelle des numéros de téléphone français
    if(tel.value.length != 10)
    {
        alert("Numero de Telephone invalide (different de 10)");
        tel.focus();
        return false;
    }

    //Si aucune erreur n'est rencontrée, on valide le formulaire
    return true;
}