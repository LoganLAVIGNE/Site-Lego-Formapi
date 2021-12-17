<?php
    //On se connecte à la base de données
    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');

    //Si on souhaite trier selon un prix particulier
    if(isset($_GET['prix1']) && isset($_GET['prix2']))
    {
        $prix1 = $_GET['prix1'];
        $prix2 = $_GET['prix2'];

        $req = $db->prepare('SELECT * FROM mytable WHERE prix BETWEEN :prix1 AND :prix2 ORDER BY prix ASC');
        $req->execute(array(':prix1' => $prix1, ':prix2' => $prix2));


    }
    //Sinon
    else
    {
        //On récupère tous les articles de la BDD
        $req = $db->query('SELECT * FROM mytable');
    }

    //On démarre la session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/class.css">
    <link rel="stylesheet" href="style/boutique.css">
    <link rel="stylesheet" href="style/div_connexion.css">
    <link rel="stylesheet" href="style/wishlist.css">
    <link rel="stylesheet" href="style/panier.css">
    <script src="https://kit.fontawesome.com/497bdd6dde.js" crossorigin="anonymous"></script>
    <script src="script/class.js"></script>
    <link rel="shortcut icon" href="ico/logo.ico" type="image/x-icon">
    <title>Boutique</title>
</head>
<body>
    <!-- On inclut tous les fichiers php externes nécessaires -->
    <?php include("div_connexion.php");?>

    <?php include("wishlist.php");?>

    <?php include("panier.php");?>

    <header>
        <img src="img/lego.png" alt="" class="pointer">
        <ul id="menu_header" class="pointer">
            <a href="boutique.php"><li>Boutique</li></a>
            <a href="pdf/Guide_Lego.pdf" target="_blank"><li>Découvrir</li></a>
            <li>Aide</li>
        </ul>

        <ul id="utilisateur" class="pointer">
            <li onclick="afficherWishlist()"><i class="far fa-heart"></i></li>
            <li onclick="afficherPanier()"><i class="fas fa-shopping-bag"></i></li>
            <li>
            <?php
            //Si l'utilisateur est connecté
            if(isset($_SESSION["id_utilisateur"]))
            {
                //On récupère les données de l'utilisateur depuis la BDD
                $envoi = $db->prepare('SELECT * FROM utilisateur WHERE id_utilisateur=:id');
                $envoi->execute(array(':id' => $_SESSION["id_utilisateur"]));
                $donnees = $envoi->fetch();

                $id = $donnees['id_utilisateur'];
                $pseudo = $donnees['pseudo'];
                ?>
                <img src="img/img_user/<?php echo $id?>.jpg" alt="<?php echo $pseudo?>" title="<?php echo $pseudo?>" onclick="confirm_suppr_session()">
                <?php
            }
            //Si l'utilisateur n'est pas connecté
            else
            {
                ?>
                <i class="far fa-user" onclick="afficherDivConnexion()"></i>
                <?php
            }
            ?>
            </li>
        </ul>

    </header>
    <main>
        <div id="grille">
            <form action="">
                <input type="reset" value="Effacer les sélections">
                <p>Type de produit</p>
                <label for="ensembles"><input type="checkbox" id="ensembles">Ensembles</label>
                <label for="ensembles"><input type="checkbox" id="ensembles">Pore clés</label>
                <label for="ensembles"><input type="checkbox" id="ensembles">Décoration d'intérieur</label>
                <label for="ensembles"><input type="checkbox" id="ensembles">Casques</label>
                <label for="ensembles"><input type="checkbox" id="ensembles">Minifigures</label>
                <p>Âge</p>
                <label for=""><input type="checkbox">4+</label>
                <label for=""><input type="checkbox">6+</label>
                <label for=""><input type="checkbox">9+</label>
                <label for=""><input type="checkbox">13+</label>
                <label for=""><input type="checkbox">18+</label>
                <p>Prix<p>
                <select id="gamme_prix" oninput="triagePrix()">
                    <?php
                    //Si on reçoit une valeur depuis la fonction de tri
                    if(isset($_GET['valeur']))
                    {
                        $valeur = $_GET['valeur'];
                        $innerhtml = $_GET['innerhtml'];
                        //On créé une option supplémentaire au cas où si ou l'option séléctionné n'est pas la première
                        //On puisse la reséléctionner
                        ?>
                        <option value="<?php echo $valeur?>"><?php echo $innerhtml?></option>
                        <option value="-">-</option>
                        <?php
                    }
                    ?>
                    <option value="1">0€ - 20€</option>
                    <option value="2">20€ - 50€</option>
                    <option value="3">50€ - 100€</option>
                    <option value="4">100€ - 200€</option>
                    <option value="5">200€ +</option>
                </select>
            </form>
            <div id="entete_article">
                    <p>Afficher x articles</p>
                </div>
            <div id="articles">
                <?php
                //Pour chaque article de la table article
                while($donnees = $req->fetch())
                {
                    //On récupère les données
                    $id_article = $donnees['id'];
                    $nom = $donnees['nom'];
                    $notation = $donnees['notation'];
                    $prix = $donnees['prix'];
                    //On affiche les informations
                    ?>
                    <div>
                        <?php
                        //Si l'utilisateur est connecté
                        if(isset($_SESSION["id_utilisateur"]))
                        {
                            //On vérifie si l'article en question est présent dans la liste d'envie de l'utilisateur
                            $recup = $db->prepare('SELECT id FROM wishlist WHERE id_utilisateur=:id_utilisateur AND id_article=:id_article');
                            $recup->execute(array(':id_utilisateur'=>$_SESSION["id_utilisateur"], ':id_article'=>$id_article));
                            $datas = $recup->fetch();
        
                            //On regarde la présence
                            $compte = $recup->rowCount();

                            //Si l'article est présent
                            if($compte > 0)
                            {
                                ?>
                                <p class="souhait pointer"><a href="actions/retirer_wishlist.php?id_wishlist=<?php echo $id_wishlist?>"><i class="fas fa-heart"></i></a> Ce produit est ajouté à votre liste de cadeaux !</p>
                                <?php
                            }
                            //Si l'article n'est pas présent
                            else if($compte == 0)
                            {
                                ?>
                                <p class="souhait pointer"><a href="actions/ajouter_wishlist.php?id_article=<?php echo $id_article?>"><i class="far fa-heart"></i></a> Ajouter à la liste de cadeaux</p>
                                <?php
                            }
                        }
                        //Si l'utilisateur n'est pas connecté
                        else
                        {
                        ?>
                        <p class="souhait pointer"><i class="far fa-heart" onclick="afficherDivConnexion()"></i> Connectez-vous pour ajouter ce produit à votre liste d'envie !</p>
                        <?php
                        } 
                        ?>
                        
                        <img src="img/img_articles/<?php echo $id_article?>.jpeg" alt="Set <?php echo $id_article?>" class="pointer">
                
                        <p class="nom"><?php echo $nom?></p>
                        <p class="notation">
                        <?php
                        //On initalise la notation de l'article à 0
                        $temp = 0;
                        //On affiche autant d'étoiles pleines que la notation de l'article
                        for($i=0; $i<$notation; $i++)
                        {
                            ?>
                            <i class="fas fa-star"></i>
                            <?php
                            $temp++;
                        }
                        //On affiche autant d'étoiles vides que la notation de l'article
                        for($i=0; $i<5-$temp; $i++)
                        {
                            ?>
                            <i class="far fa-star"></i>
                            <?php
                        }
                        ?>
                        </p>
                        <p class="prix"><?php echo $prix?> €</p>
                        <button class="pointer bouton" onclick="ajoutPanier(<?php echo $id_article?>)">Ajouter au panier</button>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>

<?php 

//On récupère les différents messages d'erreur lors des redirections depuis les autres pages

//Si un nouveau compte vient d'être créé
if(isset($_GET['nv_compte']))
{
    if($_GET['nv_compte'] == true)
    {
        echo "<script>alert(\"Nouveau compte créé avec succès.\")</script>";
    }
}

//Si on a une erreur lors de la création d'un nouveau compte
if(isset($_GET['erreur_creation_compte']))
{
    $erreur = $_GET['erreur_creation_compte'];

    switch($erreur)
    {
        case "1":
            echo "<script>alert(\"Le mot de passe n'est pas vérifié.\")</script>";
            break;
        case "2":
            echo "<script>alert(\"Le nom d'utilisateur ou le mot de passe est déjà utilisé.\")</script>";
            break;
    }
}

//S'il y a une erreur lors de la tentative de connexion
if(isset($_GET['erreur_connexion']))
{
    $erreur = $_GET['erreur_connexion'];

    switch($erreur)
    {
        case "1":
            echo "<script>alert(\"Pseudo ou mot de passe incorrect.\")</script>";
            break;
    }
}

//S'il y a une erreur lors de l'ajout d'un article au panier
if(isset($_GET['erreur_ajout_panier']))
{
    $erreur = $_GET['erreur_ajout_panier'];

    switch($erreur)
    {
        case "1":
            echo "<script>alert(\"Veuillez vous connecter afin de pouvoir commander des articles.\")</script>";
            break;
    }
}

//S'il y a une erreur lors de la finialisation de la commande
if(isset($_GET['erreur_facture']))
{
    $erreur = $_GET['erreur_facture'];

    switch($erreur)
    {
        case "1":
            echo "<script>alert(\"Veuillez vous connecter afin de pouvoir finaliser votre commande.\")</script>";
            break;
    }
}
?>