<?php

    require_once 'includes/db.php';
    session_start();
    $email=$_SESSION['email'];
     $nom=$_SESSION['nom'];
     $niveau=$_SESSION['niveau'];
    if(empty($email)){
        echo "<script type='text/javascript'>document.location.replace('controller/login.php');</script>";
    }else{
        $q=$db->query("SELECT * FROM $niveau WHERE email='$email'");
        
        $info=$q->fetch_assoc();
       
        $filiere=$info['filiere'];
        $parrain=$info['nom_parain'];
        $filleule=$info['filleule'];
        $image=$info['image'];
        
        
        
        // il y a un probléme a se niveau 
        // quant tu commente la page profils n'affiche  pas
        
        
        
        if($parrain==''){
          $verif=$db->query("SELECT * FROM l2 WHERE filleule=''");
                  $ligne=mysqli_num_rows($verif);
                 $list=$verif->fetch_assoc();
                $nom_p=$list['nom_p'];
                $id_p=$list['id'];
        if($ligne==TRUE){
            $maj = $db->query("UPDATE l1 SET nom_parain='$nom_p' WHERE email='$email'");
            $updatel2 = $db->query("UPDATE l2 SET filleule='$nom' WHERE id=$id_p");
        }
    }
        
    }
    //Vérification si le parain existe
    
    
         
    
    
    if(isset($_POST['submit'])){
        $photo= $_FILES['img']['name'];
        $upload="assets/images/".$photo;
        
        move_uploaded_file($_FILES['img']['tmp_name'], $upload);
        $q=$db->query("UPDATE $niveau SET image='$photo' WHERE email='$email'");
        if($q==TRUE){
            echo "<script type='text/javascript'>document.location.replace('profil.php');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Profil utilisateur</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/style-profil.css" rel="stylesheet">

</head>

<body>
  <header id="header" class="header bg-primary fixed-top d-flex align-items-center">
<div class="logo">
        <h3><a href="index.html"><font color='lime'>IAI</font>  <font color="yellow">CAMEROUN</font></a></h3>
      
           
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>
  </header>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Votre profil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
          <li class="breadcrumb-item">Utilisateur</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/images/<?=$image?>" alt="Profile" class="rounded-circle">
              <h2><?=$nom?></h2>
              <h3>Etudiant</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
              <a href="deconnexion.php" class="btn btn-danger">Deconnexion</a>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab"
                    data-bs-target="#profile-overview">Vos informations</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier votre Profil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"> Change le mot
                    de passe </button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Details du Profil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom complet</div>
                    <div class="col-lg-9 col-md-8"><?=$nom?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Niveau</div>
                    <div class="col-lg-9 col-md-8"><?=$niveau?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Filière</div>
                    <div class="col-lg-9 col-md-8"><?=$filiere?></div>
                  </div>
                
                <?php 
                
                if($niveau=='l1'){
                echo '
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Parain</div>
                    <div class="col-lg-9 col-md-8">';?><?php echo $parrain;?><?php echo '</div>
                </div>';}
                ?>
                <?php 
                
                if($niveau=='l2'){
                echo '
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Filleule</div>
                    <div class="col-lg-9 col-md-8">';?><?php echo $filleule;?><?php echo '</div>
                </div>';}
                ?>
                
                  



                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$email?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form enctype="multipart/form-data" method="POST">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Photo de profil</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/images/<?=$image?>" alt="Profile">
                        <div class="pt-2">
                          <input type="FILE" class="btn btn-primary btn-sm" name="img" title="Upload new profile image">
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                              class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom complet </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?=$nom?>">
                      </div>
                    </div>





                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Niveau</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="Country" value="<?=$niveau?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?=$email?>">
                      </div>
                    </div>


                    <div class="text-center">
                      <button type="submit" name="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mot de passe courant</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmer le mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>LITE CORP</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">JULIO GUIMATSA</a>
    </div>
  </footer><!-- End Footer -->


  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>