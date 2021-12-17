<?php

    session_start();
    $id_article = $_GET['id_article'];
    $id_utilisateur = $_SESSION['id_utilisateur'];

    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');

    $recup = $db->prepare('DELETE FROM panier WHERE id_utilisateur = ? AND id_article = ?');
    $recup->execute(array($id_utilisateur, $id_article));
    
    header('Location: ..\boutique.php');
?>