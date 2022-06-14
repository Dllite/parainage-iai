<?php    
    session_start();

    $email=$_SESSION['email'];
    
    $nom=$_SESSION['nom'];
   
        echo "Bienvenue .$nom .$email vous venez de créer votre compte et il est en attente pour verification. Merci de patienter.";
    
?>