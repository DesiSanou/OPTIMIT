<?php include("entete.php");?>

<?php
  
// Initialise les variables

$erreur = NULL;
$info = NULL;

if(!empty($_POST['email']) AND !empty($_POST['message'])){

  extract($_POST);
  
   if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)){
    
    $email = htmlentities(addslashes($email));
    $message = htmlentities(addslashes($message));
    $message = 'email: '.$email.''."\n".' Message : '.$message.'';
    $sujet = "Formulaire de contact";
    $destinataire = "desire.sanoupro@gmail.com";
    $entete ='From: '.$email.'';
    echo $entete;
     
   if(mail($destinataire,$sujet,$message,$entete)){
    
    $info ='Votre message à été envoyé';
    
    unset($_POST);
    unset($message);
    unset($email);
  }
  }
  else{
    $erreur = 'Votre adresse email est invalide';
  }


}
else {
  $erreur = 'Veuillez remplir tous les champs obligatoires *';
  
}
?>
<html>
 <head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="designindex.css" />
  <meta name="viewport" content="width-device-width" />
  <title>Contact FloussTor-IT</title>
 </head>
 <body>
    <footer class="sdfooter">

        	
   <form method="post" action="contact.php">
    
<fieldset>
<legend><h3>Formulaire de contact</h3></legend>
<label for="email"><strong>Email* :</strong></label><br/><input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" /><br/>
<label for="message"><strong>Message* :</strong></label><br/><textarea name="message" rows="10" cols="80"  maxlength="200" border-radius="20px"id="message"><?php if(isset($_POST['message'])) echo htmlspecialchars($_POST['message']); ?></textarea><br/>
<br/><input type="submit" value="Envoyer" /> <span style="color:white;"><br/><?php echo $erreur; ?></span><span style="color:green"><?php echo $info;?></span>
</fieldset>
  
</form>
        <p >&nbsp;tel: <a href="tel:+212626491326">+212 626491326</a> <br/> mail:<a href="mailto:desire.sanoupro@gmail.com" style="font-color:gray;">envoyer un mail</a></p>
        


         <?php
  ?> 
    </footer>
    </body>
    </html>