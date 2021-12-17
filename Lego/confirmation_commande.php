<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/class.css">
    <link rel="stylesheet" href="style/confirmation_commande.css">
    <link rel="shortcut icon" href="ico/logo.ico" type="image/x-icon">
    <script src="script/class.js"></script>
    <title>Confirmation commande</title>
</head>
<body>
<header>
        <img src="img/lego.png" alt="" class="pointer">
        <ul id="menu_header" class="pointer">
            <a href="boutique.php"><li>Boutique</li></a>
            <li>Découvrir</li>
            <li>Aide</li>
        </ul>

    </header>
    <main>
        <p>Votre commande est presque terminée ! Veuillez compléter les informations ci dessous afin que nous puissions faire parvenir vos articles jusqu'à vous :</p>
        <form action="facture.php" method="POST" onsubmit="return verification()">
            <label for="nom" id="nom">
                Nom
                <input type="text" name="nom" required autocomplete="off" id="nominsert">
            </label>
            <label for="prenom" id="prenom">
                Prénom
                <input type="text" name="prenom" required autocomplete="off" id="prenominsert">
            </label>
            <label for="adresse" id="adresse">
                Adresse
                <input type="text" name="adresse" required autocomplete="off" id="adresseinsert">
            </label>
            <label for="cp" id="cp">
                Code Postal
                <input type="number" name="cp" min="0" maxlength="5" required autocomplete="off" id="cpinsert">
            </label>
            <label for="ville" id="ville">
                Ville
                <input type="text" name="ville" required autocomplete="off" id="villeinsert">
            </label>
            <label for="tel" id="tel">
                Numéro de téléphone
                <input type="text" name="tel" required autocomplete="off" id="telinsert">
            </label>
            <label for="mail" id="mail">
                Mail
                <input type="email" name="mail" required autocomplete="off" id="mailinsert">
            </label>
            <input type="submit" value="Confirmer ma commande" id="confirmer" class="bouton">
        </form>
    </main>
    <footer>

    </footer>
</body>
</html>