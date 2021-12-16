<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/class.css">
    <link rel="stylesheet" href="style/confirmation_commande.css">
    <link rel="shortcut icon" href="ico/logo.ico" type="image/x-icon">
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
        <form action="facture.php" method="POST">
            <label for="nom" id="nom">
                Nom
                <input type="text" name="nom" required autocomplete="off">
            </label>
            <label for="prenom" id="prenom">
                Prénom
                <input type="text" name="prenom" required autocomplete="off">
            </label>
            <label for="adresse" id="adresse">
                Adresse
                <input type="text" name="adresse" required autocomplete="off">
            </label>
            <label for="cp" id="cp">
                Code Postal
                <input type="text" name="cp" required autocomplete="off">
            </label>
            <label for="ville" id="ville">
                Ville
                <input type="text" name="ville" required autocomplete="off">
            </label>
            <label for="tel" id="tel">
                Numéro de téléphone
                <input type="text" name="tel" required autocomplete="off">
            </label>
            <label for="mail" id="mail">
                Mail
                <input type="text" name="mail" required autocomplete="off">
            </label>
            <input type="submit" value="Confirmer ma commande" id="confirmer" class="bouton">
        </form>
    </main>
    <footer>

    </footer>
</body>
</html>