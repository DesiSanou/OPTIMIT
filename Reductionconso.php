 	
  <?php 
include("entete.php"); 
 /*if($_SESSION["autoriser"]!="OK"){
header("location:index.php"); }*/
?>
<!DOCTYPEE html>
<html>
<head>
   <meta charset="utf-8" http-equiv="refresh" content="20"/>
   <link rel="stylesheet" href="design.css" />
   <meta name="viewport" content="width-device-width" />
    <title>FloussTor-IT</title>
 </head>
 <body>
 	<h2 style="background-color:rgba(100,100,255,0.6);">Vous désirez réduire votre facture d'électricité?<hr/></h2><br/>
             <h3>Pour ce faire, veuillez-nous fournir une liste exhaustive des appareils électriques 
              dont vous disposez,pour une meilleure gestion de votre consommation.
              </h3>
<section class="taille">
<div>
 	<form method="post" action:"traitementconso.php">
                <label style="color:blue;font-size:16pt;">Utilisez vous régulièrement ces appareils?</label><br/>
                <section class="appareils" style="font-size:14pt;">  
                 <input type="checkbox" name="ap[]" value="1" />TV&nbsp;&nbsp;
                 <input type="checkbox" name="ap[]" value="2"  />réfrigerateur &nbsp;&nbsp;
                 <input type="checkbox" name="ap[]" value="3"  />four&nbsp;&nbsp;
                 <input type="checkbox" name="ap[]"  value="4"  />Machine à laver&nbsp;&nbsp;
                 <input type="checkbox" name="ap[]"  value="5"  />Micro onde&nbsp;&nbsp;
                 <input type="checkbox" name="ap[]"  value="6"  />Climatiseur&nbsp;&nbsp;
                 <input type="checkbox" name="ap[]"  value="7"  />Chauffe-eau électrique&nbsp;&nbsp;<br/><br/>
                  <strong style="font-size:18pt;">Combien avez-vous dépensé en facture d'électricité ce dernier mois?</strong>
               <input type="" name="facture" ></br></br>
               <strong style="font-size:18pt; color:rgb(100,96,250);">Combien souhaitez-vous dépenser désormais?</strong>
               <input type="" name="nfacture" ></br></br>
                   <em style="margin-left:25%;"><button type="submit" style=" border: solid 1.5pt blue;border-radius:3pt" name="suivant1"/><strong>Valider</strong></button></em>  
                      </section>
                  </form>
<?php include("traitementconso.php"); ?>
</div>
<div>
</div>
</section>

 </body>
