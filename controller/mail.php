<?php
$mail->Body = "<h1>Confirmation</h1></br><p>Votre code de confirmation est $user_otp et le code verication $user_activation_code</p>";
        //Add recipient
            $mail->addAddress($email);
        //Finally send email
            if ( $mail->send() ) {
                $message='<div class="alert alert-success">Incription en cour vous allez recevoir un code de confirmation par email</div>';
              
            }else{
                $message= '<div class="alert alert-danger"> L\'email n\'a pas été envoyer $mail->ErrorInfo;</div>';
            }
           //Closing smtp connection
            $mail->smtpClose();
            
?>