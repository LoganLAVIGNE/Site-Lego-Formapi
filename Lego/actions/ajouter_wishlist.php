<?php 
    session_start();
    $id_article = $_GET['id_article'];
    $id_utilisateur = $_SESSION["id_utilisateur"];

    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        
    $recup = $db->prepare('INSERT INTO wishlist(id_article, id_utilisateur) VALUES (:id_article, :id_utilisateur)');
    $recup->execute(array(':id_article' => $id_article, ':id_utilisateur' => $id_utilisateur));

    header('Location: ..\boutique.php');

?>