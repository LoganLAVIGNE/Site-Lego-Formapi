<?php

    session_start();

    if($_SESSION['id_utilisateur'] == null)
    {
        $erreur = 1; //-> L'utilisateur n'est pas connecté
        header('Location: ..\boutique.php?erreur_ajout_panier='.$erreur);
    }
    else
    {
        $id_utilisateur = $_SESSION["id_utilisateur"];
        $id_article = $_GET['id_article'];

        $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        
        //On vérifie si l'article est déjà dans le panier
        $req = $db->prepare('SELECT quantite FROM panier WHERE id_utilisateur=:id_utilisateur AND id_article=:id_article');
        $req->execute(array(':id_utilisateur' => $id_utilisateur, ':id_article' => $id_article));
        $datas = $req->fetch();
        
        $compte = $req->rowCount();

        //L'article n'est pas dans le panier
        if($compte == 0)
        {
            $req = $db->prepare('INSERT INTO panier(id_utilisateur, id_article, quantite) VALUES (?, ?, ?)');
            $req->execute(array($id_utilisateur, $id_article, 1));
        }
        //L'article est déjà dans le panier
        else if($compte > 0)
        {
            $req = $db-> prepare('UPDATE panier SET quantite = quantite + 1  WHERE id_utilisateur= ? AND id_article = ?');
            $req->execute(array($id_utilisateur, $id_article));
        }
        header('Location: ..\boutique.php');
    }


?>