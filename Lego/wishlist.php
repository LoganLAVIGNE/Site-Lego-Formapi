<div id="wishlist" class="slideInRight">
<p id="entete_wishlist">Votre liste de souhaits</p>
    <section>
        <?php

        //On vérifie si l'utilisateur est connecté
        if(isset($_SESSION["id_utilisateur"]))
        {
            //S'il l'est, on récupère les données de sa liste d'envie
            $recup = $db->prepare('SELECT * FROM wishlist WHERE id_utilisateur=:id_utilisateur');
            $recup->execute(array(':id_utilisateur' => $_SESSION["id_utilisateur"]));

            //On vérifie si la liste d'envie de l'utilisateur est vide ou non
            $num_of_rows = $recup->rowCount();
            
            //Si la liste d'envie n'est pas vide
            if($num_of_rows > 0)
            {
                
                //Pour chaque article de sa liste d'envie
                while($datas = $recup->fetch())
                {
                    //On récupère les informations
                    $id_article = $datas['id_article']; 
                    $id_wishlist = $datas['id']; 
                    
                    //On récupère plus en détails les informations de l'article dans la table article
                    $recup_article = $db->prepare('SELECT * FROM mytable WHERE id=:id_article');
                    $recup_article->execute(array(':id_article' => $id_article));
                    
                    $donnees = $recup_article->fetch();

                    //On récupère les données reçues par la requête
                    $nom = $donnees['nom'];
                    $prix = $donnees['prix'];

                    //On affiche chaque article présent dans la liste d'envie
                    ?>
                    <div>
                    <img src="img/img_articles/<?php echo $id_article?>.jpeg" alt="Article <?php echo $id_article?>">
                    <p id="nom_wishlist"><span id="texte_nom_wishlist"><?php echo $nom?></span><br>
                    <?php echo $prix?> €
                    </p>
                    <a href="actions/retirer_wishlist.php?id_wishlist=<?php echo $id_wishlist?>" id="retirer_wishlist">Retirer de la wishlist</a>
                    <a href="actions/ajouter_panier.php?id_article=<?php echo $id_article?>"><button class="bouton">Ajouter au panier</button></a>
                    </div>
                    <?php
                }
            }
            //Si la liste d'envie est vide
            else if($num_of_rows == 0)
            {
                ?>
                <p style="text-align:center;">Aucun article ne figure dans votre liste d'envie.</p>
                <?php
            }
        }
        //Si l'utilisateur n'est pas connecté
        else
        {
            ?>
            <p style="text-align:center;">Veuillez vous connecter afin de consulter votre wishlist</p>
            <?php
        }
        ?>
    </section>
</div>