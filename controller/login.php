<?php 
    
    session_start();
    
    require_once "../includes/db.php";

    require_once "../view/head_view.php";

    require_once "../_fonction/fontion.php";


    $errors=[];

    if(isset($_POST['connexion'])){
        
        $email = sanitaze($_POST['email']);
        $password = sanitaze($_POST['password']);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Email invalide";
        }

        if(empty($password)){
            $errors['password'] = "Champ obligatoire";
        }else if(mb_strlen($password)<6){
            $errors['password'] = "Doit avoir au moins 6 caractères";
        }
        if(empty($email)){
            $errors['email'] = "Champ obligatoire";
        }
        
        if(empty($errors)){
            $crypted=password_hash($password, PASSWORD_DEFAULT);
            $query_log = $db->query("SELECT * FROM l1 WHERE email='$email'");
            $query_log2 = $db->query("SELECT * FROM l2 WHERE email='$email'");
            $ligne=$query_log->fetch_assoc();
            $ligne2=$query_log2->fetch_assoc();
            $dpassword=$ligne['password'];
            $dpassword2=$ligne2['password'];

            if(password_verify($password, $dpassword)){
                $nom=$ligne['nom'];
                $_SESSION['email']=$email;
                $_SESSION['nom']=$nom;
                $_SESSION['niveau']='l1';
                header('location:home.php');
                $active=$ligne['active']; //recuperation de la variable de confirmation du compte
                
                if($ligne['active']=='0'){
                    
                    echo "<script type='text/javascript'>document.location.replace('../confirmation.php');</script>";
                }else{
                    echo "<script type='text/javascript'>document.location.replace('../profil.php');</script>";
                }
            }else if(password_verify($password, $dpassword2)){
                $nom=$ligne2['nom_p'];
                $_SESSION['email']=$email;
                $_SESSION['nom']=$nom;
                $_SESSION['niveau']='l2';
                if($ligne2['active']=='0'){
                    echo "<script type='text/javascript'>document.location.replace('../confirmation.php');</script>";
                }else{
                    echo "<script type='text/javascript'>document.location.replace('../profil.php');</script>";
                }
                
            }
            else{
                $errors['global']="Adresse email ou mot de passe invalide";
            }
        }
    }

    require_once "../view/login_view.php";
    
    require_once "../view/footer_top.php";

    ?>