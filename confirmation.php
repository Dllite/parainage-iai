<?php 

    session_start();

    require_once "includes/db.php";

    require_once "view/head_view.php";

    require_once "_fonction/fontion.php";
    
   
    $errors=[];
    
    $email_s=$_SESSION['email'];
    $nom_s=$_SESSION['nom'];
    $niveau=$_SESSION['niveau'];
   
//   if(!$nom){
//       echo "<script type='text/javascript'>document.location.replace('../index.php');</script>";
//   }else{
//       echo "Traitement en cours...";
//   }

    
    if(isset($_POST['submit'])){
        
         $code=sanitaze($_POST['code']);
         
        if(empty($code)){
            $errors['code']="Champ obligatoire";
            
        }else if(mb_strlen($nom)<6){
            $errors['code']="Doit avoir au moins 6 caractères";
        }else if(mb_strlen($nom)>6){
            $errors['code']="Doit avoir au moins 6 caractères";
        }
        
        $search=$db->query("SELECT * FROM $niveau WHERE user_otp='$code'");
        $ligne=mysqli_num_rows($search);
        
        if($ligne==TRUE){
            $active=$db->query("UPDATE $niveau SET active='1' WHERE user_otp='$code' ");
            echo "<script type='text/javascript'>document.location.replace('../profil.php');</script>";
        }else{
            $errors['code']="Code invalide";
        }
        
    }
    
    
  
?>
<div class="form-body">
        <div class="website-logo">
            <a href="../index.php">
                <div class="logo">
                    <img class="logo-size" src="images/logo-light.svg" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="../assets/images/iailogo.png" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Activation de votre compte</h3>
                        <p>Nous vous avons envoyer un code par mail. Veillez svp renseigner ce code </p>
                        <form method="POST">
                            <input class="form-control" type="number" name="code" placeholder="Code otp">
                            <?= display_errors($errors, 'code')?>
                            <div class="form-button full-width">
                                <button id="submit" type="submit" name="submit" class="ibtn btn-forget">Validé le code</button>
                            </div>
                    
                             <a href="deconnexion.php" class="ibtn btn-danger">Deconnexion</a>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>