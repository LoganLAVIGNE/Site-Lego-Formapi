<?php
$server = "localhost";
$user = "root";
$mdp = "";
$bdd = "test";

$conn = new mysqli($server, $user, $mdp, $bdd);
if($conn->connect_error)
{
    die("ERREUR: " .$conn->connzct_error);
}

$IDuser = 5;
$PSEUDOuser = "pseudouser";
$NOMuser = "nomuser";
$PRENOMuser = "prenomuser";
$EMAILuser = "emailuser";
$ADRESSEuser = "adresseuser";
$CODEuser = "codeuser";
$VILLEuser = "villesuer";
$TELEPHONEuser = "telephoneuser";
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF8">
        <link rel="stylesheet" href="style/pagefincommande.css">
        <link rel="stylesheet" href="style/class.css">
        <title>Votre Panier</title>
    </head>
    <header>
        <img src="img/lego.png" alt="" class="pointer">
        <ul id="menu_header" class="pointer">
            <li>Boutique</li>
            <li>Découvrir</li>
            <li>Aide</li>
        </ul>

        <ul id="utilisateur" class="pointer">
            <li><i class="far fa-heart"></i></li>
            <li><i class="fas fa-shopping-bag"></i></li>
            <li><i class="far fa-user"></i></li>
        </ul>
    </header>
    <body>
<?php

$sqlpseudo = "SELECT * FROM utilisateur WHERE ID = '$IDuser'";
$reqpseudo = $conn->query($sqlpseudo);
while($paramuser = $reqpseudo->fetch_assoc())
{
    $PSEUDOuser = $paramuser['Pseudo'];
    $NOMuser = $paramuser['Nom'];
    $PRENOMuser = $paramuser['Prenom'];
    $EMAILuser = $paramuser['Email'];
    $ADRESSEuser = $paramuser['Adresse'];
    $CODEuser = $paramuser['Code'];
    $VILLEuser = $paramuser['Ville'];
    $TELEPHONEuser = $paramuser['Telephone'];
}
?>
        <!--affichage du formulaire des articles dans le panier et du total de ce dernier-->
        <h1>Finaliser votre commande <?php echo $PSEUDOuser ?></h1>

        <!--début du formulaire-->
        <form action="boncommande.php" method="post">

            <!--affichage de tous les articles dans le panier-->
            <p class="articles">Tous vos articles</p>
            <table class="tablecomm">
                <tr>
                    <td>Nom de l'article</td>
                    <td>Numero de l'article</td>
                    <td>Prix de l'article</td>
                </tr>
<?php
$sqlpanier = "SELECT ID_article FROM panier WHERE ID_utilisateur = '$IDuser'";

$reqpanier = $conn->query($sqlpanier);

while($element = $reqpanier->fetch_assoc())
{
    $IDArticle = $element['ID_article'];

    $sqlarticle = "SELECT Nom, Prix, Numero FROM article WHERE ID = '$IDArticle'";

    $reqarticle = $conn->query($sqlarticle);

    while($donnee = $reqarticle->fetch_assoc())
    {
        $NomArticle = $donnee['Nom'];
        $NumeroArticle = $donnee['Numero'];
        $PrixArticle = $donnee['Prix'];
?>
                <tr>
                    <td class="Nomarticle"><?php echo $NomArticle ?></td>
                    <td class="Numeroarticle"><?php echo $NumeroArticle ?></td>
                    <td class="Prixarticle"><?php echo $PrixArticle ?>€</td>
                </tr>
<?php
    }
}

$TotalPrix = 0;

$sql = "SELECT ID_article FROM panier WHERE ID_utilisateur = '$IDuser'";

$req = $conn->query($sql);

while($ID = $req->fetch_assoc())
{
    $IDARTICLE = $ID['ID_article'];
    $sqlv20 = "SELECT Prix FROM article WHERE ID = '$IDARTICLE'";
    $reqv20 = $conn->query($sqlv20);
    while($prix = $reqv20->fetch_assoc())
    {
        $PRIXart = $prix['Prix'];
        $TotalPrix += $PRIXart;
    }
}
?>
            <tr class="total">
                <td>TOTAL: </td>
                <td>  </td>
                <td class="Prixarticle"><?php echo $TotalPrix ?>€</td>
            </tr>
            </table>
            <!--début du formulaire a remplir-->
            <div class="FLEXDOUBLE">

                <!--affichage de Nom ainsi que de l'input Nom-->
                <div class="FLEXGAUCHE">
                    <p class="nom">Nom</p>
                    <input type="text" name="Nom" class="ContenuFLEXGAUCHE" value="<?php echo $NOMuser ?>"/>
                </div>

                <!--affichage de Prenom ainsi que de l'input Prenom-->
                <div class="FLEXDROITE">
                    <p class="prenom">Prenom</p>
                    <input type="text" name="Prenom" class="ContenuFLEXDROITE" value="<?php echo $PRENOMuser ?>"/>
                </div>
            </div>

            <!--affichage de Adresse de livraison ainsi que de l'input Adresse-->
            <div class="ADRESSE">
                <p class="adresse">Adresse de livraison</p>
                <input type="text" name="Adresse" class="ContenuADRESSE" value="<?php echo $ADRESSEuser ?>"/>
            </div>

            <div class="FLEXDOUBLE">

            <!--affichage de Code Postal ainsi que de l'input Code-->
                <div class="FLEXGAUCHE">
                    <p class="code">Code Postal</p>
                    <input type="number" name="Code" class="ContenuFLEXGAUCHE" value="<?php echo $CODEuser ?>"/>
                </div>
                <!--affichage de Ville ainsi que de l'input Ville-->
                <div class="FLEXDROITE">
                    <p class="ville">Ville</p>
                    <input type="text" name="Ville" class="ContenuFLEXDROITE" value="<?php echo $VILLEuser ?>"/>
                </div>
            </div>

            <div class="FLEXDOUBLE">

                <!--affichage de Numéro de Téléphone ainsi que de l'input Telephone-->
                <div class="FLEXGAUCHE">
                    <p classe="telephone">Numéro de téléphone</p>
                    <input type="number" name="Telephone" class="ContenuFLEXGAUCHE" value="<?php echo $TELEPHONEuser ?>"/>
                </div>

                <!--affichage de Adresse E-mail ainsi que de l'input Email-->
                <div class="FLEXDROITE">
                    <p class="email">Adresse E-Mail</p>
                    <input type="mail" name="Email" class="ContenuFLEXDROITE" value="<?php echo $EMAILuser ?>"/>
                </div>
            </div>

            <!--affichage du bouton de validation-->
            <input type="submit" value="Valider ma commande" class="validation"/>
        </form>
    </body>
    <footer>
        <img src="LEGO_logo.svg.png" width="65px" height="65px" class="logoLEGObas">
    </footer>
</html>