<?php

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mdp = htmlspecialchars($_POST['mdp']);

    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');

    $envoi = $bdd->prepare('SELECT id_utilisateur FROM utilisateur WHERE pseudo=:pseudo AND mdp=:mdp');
    $envoi->execute(array(':pseudo' => $pseudo,':mdp' => $mdp));
    $donnees = $envoi->fetch();

    $id_utilisateur = $donnees['id_utilisateur'];

    //Si l'utilisateur est introuvable
    if($id_utilisateur == NULL)
    {
        $erreur = 1; //-> Utilisateur introuvable dans la BDD
        header('Location: ..\boutique.php?erreur_connexion='.$erreur);
    }
    else
    {
        session_start();
        $_SESSION['id_utilisateur'] = $id_utilisateur;
        header('Location: ..\boutique.php');
    }
?>