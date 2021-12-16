<?php
if(isset($_GET['confirm']))
{
    if($_GET['confirm'] == 1)
    {
        session_start();
        $_SESSION["id_utilisateur"] = null;
        header('Location: ..\boutique.php');
    }
}
?>