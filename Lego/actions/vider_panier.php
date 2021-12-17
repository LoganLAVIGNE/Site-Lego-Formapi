<?php
    //On récupère l'id de l'utilisateur
    $id_utilisateur = $_GET['id_utilisateur'];

    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    
    //On supprime son panier
    $req = $db->prepare('DELETE FROM panier WHERE id_utilisateur=:id_utilisateur');
    $req->execute(array(':id_utilisateur' => $id_utilisateur));
    
    //On retourne au menu
    header('Location: ..\boutique.php');

?>