<?php

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $confirm_mdp = htmlspecialchars($_POST['confirmation_mdp']);

    if($mdp != $confirm_mdp)
    {
        $erreur = 1; //-> les mots de passe ne correspondent pas
        header('Location: ..\boutique.php?erreur_creation_compte='.$erreur);
    }
    else
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');

        $envoi = $bdd->prepare('SELECT id_utilisateur FROM utilisateur WHERE pseudo=:pseudo OR mdp=:mdp');
        $envoi->execute(array(':pseudo' => $pseudo,':mdp' => $mdp));
        $donnees = $envoi->fetch();

        $id_utilisateur = $donnees['id_utilisateur'];

        if($id_utilisateur != NULL)
        {
            $erreur = 2; //-> Le nom d'utilisateur ou le mdp sont déjà pris
            header('Location: ..\boutique.php?erreur_creation_compte='.$erreur);
        }
        else
        {
            $req = $bdd->prepare('INSERT INTO utilisateur (pseudo, mdp) VALUES(?, ?)');
            $req->execute(array($pseudo, $mdp));
            
            $nv_compte = true;
            header('Location: ..\boutique.php?nv_compte='.$nv_compte);
        }
    }
?>