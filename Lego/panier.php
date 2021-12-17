<div id="panier" class="slideInRight">
<p id="entete_panier">Votre panier</p>
<section>
        <?php
        //Si l'utilisateur est connecté
        if(isset($_SESSION["id_utilisateur"]))
        {
            //On récupère les données de son panier
            $recup = $db->prepare('SELECT * FROM panier WHERE id_utilisateur=:id_utilisateur');
            $recup->execute(array(':id_utilisateur' => $_SESSION["id_utilisateur"]));

            //On vérifie si le panier est vide ou non
            $num_of_rows = $recup->rowCount();
            //On initialise la somme de ses articles, nulle pour le moment
            $total = 0;
            
            //Si le panier n'est pas vide
            if($num_of_rows > 0)
            {
                //On récupère les données du panier
                while($datas = $recup->fetch())
                {
                    $id_article = $datas['id_article']; 
                    $quantite = $datas['quantite']; 
                    
                    //On récupère en détails les informations des articles dans le panier depuis la table article
                    $recup_article = $db->prepare('SELECT * FROM mytable WHERE id=:id_article');
                    $recup_article->execute(array(':id_article' => $id_article));
                    
                    $donnees = $recup_article->fetch();

                    $nom = $donnees['nom'];
                    $prix = $donnees['prix'];

                    //On ajoute à la somme totale le coup de l'article en question
                    $total = $total + $prix * $quantite;
                    //On affiche les informations
                    ?>
                    <div>
                    <img src="img/img_articles/<?php echo $id_article?>.jpeg" alt="Article <?php echo $id_article?>">
                    <p id="nom_panier"><span id="texte_nom_panier"><?php echo $nom?></span><br>
                    <?php echo $prix?> € / x <?php echo $quantite?>
                    </p>
                    <a href="actions/retirer_panier.php?id_article=<?php echo $id_article?>" id="retirer_panier">Retirer du panier</a>
                    </div>
                    <?php
                    }
            }
            //Si le panier est vide
            else if($num_of_rows == 0)
            {
                ?>
                <p style="text-align:center;">Aucun article ne figure dans votre panier.</p>
                <?php
            }
        }
        //Si l'utilisateur n'est pas connecté
        else
        {
            ?>
            <p style="text-align:center;">Veuillez vous connecter afin de consulter votre panier</p>
            <?php
        }
        ?>
    </section>
    <?php
    //Si l'utilisateur est connecté 
    if(isset($_SESSION['id_utilisateur']))
    {
        //Si le panier n'est pas vide
        if($num_of_rows > 0)
        {
        ?>
        <div id="div_total_panier">
        <p>Total : <span class="bleu"><?php echo $total?> €</span></p>
        <a href="confirmation_commande.php"><button class="bouton">Commander</button></a>
        </div>
        <?php
        }
    }
    ?>
</div>