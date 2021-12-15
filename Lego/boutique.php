<?php
    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');

    $req = $db->query('SELECT * FROM mytable');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/class.css">
    <link rel="stylesheet" href="style/boutique.css">
    <script src="https://kit.fontawesome.com/497bdd6dde.js" crossorigin="anonymous"></script>
    <title>Boutique</title>
</head>
<body>
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
                <label for=""><input type="checkbox">0€ - 20€</label>
                <label for=""><input type="checkbox">20€ - 50€</label>
                <label for=""><input type="checkbox">50€ - 100€</label>
                <label for=""><input type="checkbox">100€ - 200€</label>
                <label for=""><input type="checkbox">+200€</label>
            </form>
            <div id="entete_article">
                    <p>Afficher x articles</p>
                </div>
            <div id="articles">
                <?php
                while($donnees = $req->fetch())
                {
                    $id = $donnees['id'];
                    $nom = $donnees['nom'];
                    $notation = $donnees['notation'];
                    $prix = $donnees['prix'];
                    $souhait = $donnees['souhait'];
                    ?>
                    <div>
                        <?php
                        if($souhait == 0)
                        {
                            ?>
                            <p class="souhait pointer"><i class="far fa-heart"></i> Ajouter à la liste de cadeaux</p>
                            <?php
                        }
                        else if($souhait == 1)
                        {
                            ?>
                            <p class="souhait pointer"><i class="fas fa-heart"></i> Ce produit est ajouté à votre liste de cadeaux !</p>
                            <?php
                        }
                        ?>
                        
                        <img src="img/img_articles/<?php echo $id?>.jpeg" alt="Set <?php echo $id?>" class="pointer">
                
                        <p class="nom"><?php echo $nom?></p>
                        <p class="notation">
                        <?php
                        $temp = 0;
                        for($i=0; $i<$notation; $i++)
                        {
                            ?>
                            <i class="fas fa-star"></i>
                            <?php
                            $temp++;
                        }
                        for($i=0; $i<5-$temp; $i++)
                        {
                            ?>
                            <i class="far fa-star"></i>
                            <?php
                        }
                        ?>
                        </p>
                        <p class="prix"><?php echo $prix?> €</p>
                        <button class="pointer">Ajouter au panier</button>
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