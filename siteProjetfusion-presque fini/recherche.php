<?php
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) 
{
    print('<script>alert("Vous n\'êtes pas connecté. Vous devez être connecté pour accéder à cette page.");</script>');
    print('<meta http-equiv="refresh" content="0;url=index.php?lastpage=contact.php" />');
}
else
{
    $mail = $_SESSION['email'];
    $categorie = $_SESSION['categorie'];
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    
    if($categorie == "intervenant")
    {
        header('Location: rech-a.php');
    }
    else
    {
        header('Location: rech-i.php');
    }
}
?>