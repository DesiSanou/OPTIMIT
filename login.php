<?php 
session_start();
@$_SESSION["autoriser"]="non";
@$emaillogin=htmlspecialchars($_POST["emaillogin"]);
@$mdplogin=htmlspecialchars($_POST["mdplogin"]);
@$valider=htmlspecialchars($_POST["valider"]);
@$erreur="";
if(isset($valider)){
 if(!filter_var($emaillogin,FILTER_VALIDATE_EMAIL)) $erreur="Veuillez renseigner un mail valide<br/>";
 elseif(empty(@$mdplogin))  $erreur="Veuillez entrer le mot de passe<br/>";
 else {
    $fp=fopen("./membres/listemembres.txt","r+");
  while(!feof($fp)) {
  @$membre=fgets($fp);
  @$tab=explode(":",$membre);
  if($emaillogin==@$tab[3] && md5($mdplogin)== substr(@$tab[4], 0,32)) {
    @$_SESSION["autoriser"]="OK";
    $_SESSION["ident"]=@$tab[0];
    @$_SESSION["nomprenom"]=strtoupper($tab[1]." ".$tab[2]);
  	header("location:grapheconso.php");
  	fclose($fp);
                 }
         }
 $erreur="Veuillez vérifier que les informations inscrites sont bien correctes";
}
}
?>

<?php 
?>
  <h1>Me connecter<hr/></h1>
 	 <form method="POST" action="login.php">
 	    <p id="inscription"> 
                 <label for="email">Email<strong style="color:red">*&nbsp;</strong></label><br/><input type="email" name="emaillogin" id="email" value="<?php echo @$emaillogin ?>" required="required" placeholder="tamini.yves@gmail.com"  maxlength="100"/> <Br /><Br />
                 <label for="MotDePasse">Mot de passe<strong style="color:red">*&nbsp;</strong></label><br/><input type="password"  required="required" name="mdplogin" id="pwd" value="<?php echo @$mdplogin ?>" placeholder="Votre Mot de passe"  maxlength="20"/> <Br /><Br />
                 <em style="margin-left:12%;"><button type = "submit" style=" border: solid 1.5pt blue;border-radius:3pt" name="valider" value="<?php echo @$valider?>" ><strong>M'authentifier</strong></button></em>
       </p> 
       
       </form>

 </body>
 <?php echo $erreur; ?>
       