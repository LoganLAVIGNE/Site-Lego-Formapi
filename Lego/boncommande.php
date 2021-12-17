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

$sql = "SELECT * FROM panier";

$req = $conn->query($sql);

$Nom = $_POST['Nom'];
$Prenom = $_POST['Prenom'];
$Adresse = $_POST['Adresse'];
$Telephone = $_POST['Telephone'];
$Email = $_POST['Email'];
$Code = $_POST['Code'];
$Ville = $_POST['Ville'];

$IDuser = 5;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF8">
        <link rel="stylesheet" href="pagefincommande.css">
        <title>Votre Bon De Commande</title>
    </head>
    <body>
    <img src="LEGO_logo.svg.png" width="5%" height="5%">
        <p><?php echo "Merci " . $Nom . " " . $Prenom ?></p>
        <p><?php echo "Votre commande sera livré au " . $Adresse . " " . $Code . " " . $Ville . "."?></p>
        <p><?php echo "Un e-mail vous sera envoyé à l'adresse E-Mail suivante : " . $Email . "<br>Une fois que nos équipes auront traité votre commande." ?></p>
        <p>Vos Articles: </p>
        <table class="tablebon">
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
            <tr class="totalbon">
                <td>TOTAL: </td>
                <td>  </td>
                <td class="Prixarticle"><?php echo $TotalPrix ?>€</td>
            </tr>
            </table>



<a href="pageLOGAN.php">Retour à la boutique</a>
    </body>
    <footer></footer>
</html>