<?php 
    $id_wishlist = $_GET['id_wishlist'];

    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        
    $recup = $db->prepare('DELETE FROM wishlist WHERE id=:id_wishlist');
    $recup->execute(array(':id_wishlist' => $id_wishlist));

    header('Location: ..\boutique.php')

?>