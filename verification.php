<?php 

    session_start();
   
    require_once "includes/db.php";

    require_once "view/head_view.php";

    require_once "_fonction/fontion.php";
    
   // require_once "view/conf_view.php";
    $email=$_SESSION['email'];
   
   if($email){
       header('location:../controller/login.php');
   }
    
    ?>
    
    <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Activation de votre compte</h3>
                        <p>Nous vous avons envoyer un code par mail. Veillez svp renseigner ce code </p>
                        <form method="POST">
                            <input class="form-control" type="number" name="code" placeholder="Code otp" required>
                            <?= display_errors($errors, 'name')?>
                            <div class="form-button full-width">
                                <button id="submit" type="submit" class="ibtn btn-forget">Validé le code</button>
                            </div>
                        </form>
                    </div>
                    <div class="form-sent">
                        <div class="tick-holder">
                            <div class="tick-icon"></div>
                        </div>
                        <h3>Password link sent</h3>
                        <p>Please check your inbox <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="056c6a637768456c6a63776871606875696471602b6c6a">[email&#160;protected]</a></p>
                        <div class="info-holder">
                            <span>Unsure if that email address was correct?</span> <a href="#">We can help</a>.
                        </div>
                    </div>
                </div>
            </div>