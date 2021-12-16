<?php

    //On démarre la session
    session_start();
    //Si l'utilisateur N'EST PAS connecté
    if(empty($_SESSION["id_utilisateur"]))
    {
        $erreur = 1; //-> L'utilisateur n'est pas connecté
        header('Location: boutique.php?erreur_facture='.$erreur);
    }

    //On récupère les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $cp = $_POST['cp'];
    $ville = $_POST['ville'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];

    //On se connecte à la base de données
    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');

    //On récupère les informations de l'utilisateur
    $recup = $db->prepare('SELECT pseudo FROM utilisateur WHERE id_utilisateur=:id_utilisateur');
    $recup->execute(array(':id_utilisateur' => $_SESSION['id_utilisateur']));
    $datas = $recup->fetch();

    $pseudo = nl2br($datas['pseudo']);

    //On récupère les informations du panier de l'utilisateur
    $recup = $db->prepare('SELECT * FROM panier WHERE id_utilisateur=:id_utilisateur');
    $recup->execute(array(':id_utilisateur' => $_SESSION["id_utilisateur"]));

    //On intialise le coût total du panier
    $total = 0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/facture.css">
    <link rel="stylesheet" href="style/class.css">
    <script src="https://kit.fontawesome.com/497bdd6dde.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="ico/facture.ico" type="image/x-icon">
    <script src="script/class.js"></script>
    <title>Facture</title>
</head>
<body>
    <!-- Le CSS de #entourage assure l'affichage de la div UNIQUEMENT en cas de lancement d'impression -->
    <div id="entourage">
        <h1>Commande n°X</h1>
        <table>
            <tr>
                <td>Client :</td>
                <td><span class="bold"><?php echo $prenom?> <span class="uppercase"><?php echo $nom?></span></span></td>
            </tr>
            <tr>
                <td>Identifiant :</td>
                <td><?php echo $pseudo?></td>
            </tr>
            <tr>
                <td>Téléphone :</td>
                <td><a href="tel:<?php echo $tel?>"><?php echo $tel?></a></td>
            </tr>
            <tr>
                <td>Mail :</td>
                <td><a href="mailto:<?php echo $mail?>"><?php echo $mail?></a></td>
            </tr>
            <tr>
                <td>Adresse de livraison :</td>
                <td><?php echo $adresse?><br><?php echo $cp?><br><?php echo $ville?></td>
            </tr>
        </table>
        <hr>
        <p>Articles commandés :</p>
        <?php
        //Pour chaque article dans le panier
        while($datas = $recup->fetch())
        {
            $id_article = $datas['id_article'];
            $quantite = $datas['quantite'];

            //On récupère en détails les informations de l'article du panier depuis la table article
            $req = $db->prepare('SELECT * FROM mytable WHERE id=:id_article');
            $req->execute(array(':id_article' => $id_article));
            $donnees = $req->fetch();

            $nom = $donnees['nom'];
            $prix = $donnees['prix'];

            //On ajoute à la somme totale le coût de l'article en question
            $ss_total = $prix * $quantite;
            $total += $ss_total;
            //On affiche les informations
            ?>
            <div class="article">
                <img src="img/img_articles/<?php echo $id_article?>.jpeg" alt="Set <?php echo $id_article?>">
                <p><span class="bold"><?php echo $nom?></span><br>
                <?php echo $prix?> € / x <?php echo $quantite?><br>
                Sous-total : <?php echo $ss_total?> €
                </p>
            </div>
            <?php
        }
        ?>
        <hr>
        <h2>Total : <?php echo $total?> €</h2>
    </div>

    <!-- Le CSS de #confirmation assure l'affichage de la div UNIQUEMENT sur navigateur WEB -->
    <div id="confirmation">
        <header>
            <img src="img/lego.png" alt="" class="pointer">
            <ul id="menu_header" class="pointer">
                <a href="boutique.php"><li>Boutique</li></a>
                <li>Découvrir</li>
                <li>Aide</li>
            </ul>
        </header>
        <main>
            <div>
                <h1>Commande effectuée avec succès !</h1>
                <p>Nous ferons notre possible afin de garantir la livraison de votre commande dans les plus brefs délais.</p>
                <button class="bouton" onclick="imprimer()">Imprimer la facture <i class="fas fa-print"></i></button>
                <a href="boutique.php"><button class="bouton">Menu</button></a>
            </div>
        </main>
        <footer>

        </footer>
    </div>
</body>
</html>