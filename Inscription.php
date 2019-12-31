<?php 
session_start();
@$nom=htmlspecialchars($_POST["nom"]);
@$prenom=htmlspecialchars($_POST["prenom"]);
@$email=htmlspecialchars($_POST["email"]);
@$mdp=htmlspecialchars($_POST["mdp"]);
@$mdp2=htmlspecialchars($_POST["mdp2"]);
@$valider=htmlspecialchars($_POST["valider"]);
@$erreur="";
@$succes="";
if(isset($valider)){
	if(!preg_match("#^[a-zA-Z \-éàçè]+$#", $nom)) $erreur="Veuillez renseigner un nom valide<br/>";
 elseif(!preg_match("#^[a-zA-Z \-éàçè]+$#", $prenom)) $erreur="Veuillez renseigner un prenom valide<br/>";
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) $erreur="Veuillez renseigner un mail valide<br/>";
 elseif(empty($mdp))  $erreur="Veuillez entrer le mot de passe<br/>";
 elseif( $mdp!=$mdp2) $erreur="Erreur Confirmation de mot de passe<br/>";
 else{
  $fp=fopen("./membres/listemembres.txt","a+");

$nbf=fopen("CompteurInscrit.txt","r+");
$ident=fgets($nbf,8);
fputs($fp,$ident.":".$nom.":".$prenom.":".$email.":".md5($mdp)."\r\n");
$ident=$ident+1;
fseek($nbf,0);
fputs($nbf,$ident);
  //$succes="Bienvenue ".strtoupper($prenom." ".$nom)."\nVous vous etes inscrit avec succès!";
  fclose($nbf);
  fclose($fp);
   @$_SESSION["autoriser"]="OK";
  header("location:index.php");

 }
}


?>

<?php include("entete.php") ?>
<div style="display:flex;">
    <article style="width:60%;border-right: solid 3pt hidden;margin-right:5pt;">
 
  <h1>Présentation FloussTor-IT<hr/></h1>
  <section style="font-size:14pt;color:blue;width:70%;">Le projet FloussTor-IT est une solution électronique et informatique que nous mettons au point 
    afin de prévoir la consommation énergétique en vue de produire une quantité adéquate,
     de veiller à ce que cette consommation prévue soit respectée ; tout ceci facilitant la 
     tâche à l'usager et au poste de distribution. 
   </section>
      </article>


  <section style="width:40%;border-right: solid 3pt hidden;margin-left:2pt;">
  <h1>Inscription<hr/></h1>
 	 <form method="POST" action="Inscription.php">
 	    <p id="inscription"> 
                 <label for="nom">Nom<span><strong style="color:red;">*&nbsp;</strong></span></label><br/><input type="text" name="nom" id="nom" value="<?php echo @$nom ?>" required="required" placeholder="example TAMINI"  maxlength="50";/> <Br /><Br />
                 <label for="prenom">Prenom<strong style="color:red">*&nbsp;</strong></label><br/><input type="text" name="prenom"  id="" value="<?php echo @$prenom ?>" required="required" placeholder="example Yves" maxlength="50" /> <Br /><Br />
                 <label for="email">Email<strong style="color:red">*&nbsp;</strong></label><br/><input type="email" name="email" id="email" value="<?php echo @$email ?>" required="required" placeholder="tamini.yves@gmail.com"  maxlength="100"/> <Br /><Br />
                 <label for="MotDePasse">Mot de passe<strong style="color:red">*&nbsp;</strong></label><br/><input type="password"  required="required" name="mdp" id="pwd" value="<?php echo @$mdp ?>" placeholder="Mot de passe complexe"  maxlength="20"/> <Br /><Br />
                 <label for="MotDePasse">Confirmation du Mot de passe<strong style="color:red">*&nbsp;</strong></label><br/><input type="password"  required="required" name="mdp2" id="pwd" value="<?php echo @$mdp2 ?>" placeholder="Confirmer mot de passe"  maxlength="20"/> <Br /><Br />

                 <em style="margin-left:10%;"><button type = "submit" style=" border: solid 1.5pt blue;border-radius:3pt" name="valider" value="<?php echo @$valider?>" ><strong>Valider</strong></button></em>
       </p> 
</form>
   <span style="color:red; font-size:12pt;"><b> <?php echo $erreur;?></b> </span>
</section>
  </div>
   

 	</body>