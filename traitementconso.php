
<?php 
session_start();

$minfacture=10;
$erfact="";
@$facture=($_POST["facture"]);
@$nfacture=($_POST["nfacture"]);
  @$conso=0;
  @$suivant1=$_POST['suivant1'];
  @$ap=$_POST['ap'];
  $valeur=0;
  if(isset($suivant1)){
  $conso=array_sum($ap);
}
else exit();
//}
  	 echo "Vous consommez environ $conso Watts<br/><br/><br/>";
    $conso=0;

 if(!is_numeric($facture) or $facture<$minfacture) {echo "Veuillez entrer une valeur valide"; exit();}
 if(!is_numeric($nfacture) or $nfacture<$minfacture or $nfacture<($facture/3)) {exit("OUPS! Il va falloir tout etteindre"); }
 else {
  $factp=fopen("fichierfacteur.txt", "a+");
   $mjour=$facture/30;
   

 }
//}

  ?>

 	

 </body>