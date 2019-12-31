
<?php 
session_start(); 
include("entete.php"); 
 if($_SESSION["autoriser"]!="OK"){
header("location:index.php"); }
?>
<h1>Suivre la tendance de votre consommation</h1>

<?php 
 $taille1=30;
 $Echelley=0;
//===========Script pour receuillir les valeurs mesurees par le capteur============

 //=========================Reception et ajout de donnees=========================
  /* $Vrecues=array();
   $val = $_GET['recvals'];
    $Vrecues= array_push($Vrecues, $val);
    if(sizeof($Vrecues)==$taille1){ 
      $fi="consommation.txt"; // le fichier
     $file = file($fi);

     /*$file($_SESSION["ident"])=array($_SESSION["ident"]);                          //lit le fichier et met chaque ligne de celui ci dans un tableau
      foreach ($Vrecues as $value) {
        $file($_SESSION["ident"])=" ".$value; 
       } */
                   // supprime la première ligne du tableau (qui correspond à la première ligne de ton fichier)
       // file_put_contents($fi, $file);    // réinsère les lignes dans le fichier, ça écrase l'ancien fichier. 
        //}             


//valeur moyenne calculee la veille
if($_SESSION["autoriser"]=="OK"){
    $fpv=fopen("consommationveille.txt","r+");
  while(!feof($fpv)) {
  @$lignev=fgets($fpv);
  @$ctabv=explode(" ",$lignev);
  if(@$_SESSION["ident"]==@$ctabv[0]){
    $consov=array_slice($ctabv,1);
    $Echelley1=3*max($consov);//echelle1
   break;
                 }
         }
   if(empty($consov)) {  exit("Veuillez renseigner vos données de consommation dans Reduire ma facture");}

// $erreur="Données non recues!";
}


//valeurs actuelles
if($_SESSION["autoriser"]=="OK"){
    $fp=fopen("consommation.txt","r+");
  while(!feof($fp)) {
  @$ligne=fgets($fp);
  @$ctab=explode(" ",$ligne);
  if($_SESSION["ident"]==@$ctab[0]){
    @$conso=array_slice($ctab,1);
    $Echelley2=3*max($conso);//echelle2
       break;
                 }
         }
      if(empty($conso)) { exit("Données de consommation introuvables");}
 
}
$Echelley=max($Echelley1,$Echelley2);


//========valeur moyenne a calculer actuellement================
if(empty(@$erreur)){
  $ctaba= $_SESSION["ident"]." ";
   for ($i=0; $i <min(count($conso),count($consov)); $i++) { 
      $ctaba.=0.5*($conso[$i]+$consov[$i])." ";
   }
   
   file_put_contents("./consommations/consomoy{$_SESSION["ident"]}.txt",$ctaba);
}
/*
$date=date("H:i:s");
$heures=array_push($heures,$date);
  echo $date;
  echo $heures[1];*/
  $heures=range(0,$taille1-1);
 
// Script pour la représentation graphique
   @$type=$_POST["type"]; 
   if(empty($type)) $type="Courbe"; 
   $x=600; 
   $y=400; 
   $marge=50; 
   $intX=($x-(2*$marge))/$taille1; 
   $intY=($y-(2*$marge))/10;

   $img=imagecreatetruecolor($x,$y); 
   $noir=imagecolorallocate($img,0,0,0); 
   $blanc=imagecolorallocate($img,255,255,255); 
   $bleu=imagecolorallocate($img,75,75,200); 
   $rouge=imagecolorallocate($img,250, 0, 0);
   $gris=imagecolorallocate($img,220,220,220); 
   imagefill($img,0,0,$blanc); 
   imageline($img,$marge,$y-$marge,$x-$marge,$y-$marge,$noir); 
   imageline($img,$marge,$y-$marge,$marge,$marge,$noir);

 

   imagettftext($img,14,0,$x-$marge-10,$y-$marge+30,$rouge,"TIMESS.ttf","minutes"); 
   imagettftext($img,14,0,$marge-45,$marge-25,$rouge,"TIMESS.ttf","consommation"); 

   for($i=0;$i<=10;$i++){ 
      imageline($img,$marge-2,$y-$marge-($i*$intY),$marge+2,$y-$marge-($i*$intY),$noir); 
      imagettftext($img,10,0,$marge-45,$y-$marge-($i*$intY),$noir,"TIMESS.ttf",$i*ceil($Echelley/10)); 

      if($i>0) 
         imageline($img,$marge+2,$y-$marge-($i*$intY),$x-$marge,$y-$marge-($i*$intY),$gris);
   } 
   for($i=0;$i<$taille1;$i++){ 
      imageline($img,$marge+$i*$intX,$y-$marge-2,$marge+$i*$intX,$y-$marge+2,$noir); 
      imagettftext($img,8,-90,$marge+$i*$intX,$y-$marge+20,$noir,"TIMESS.ttf",$heures[$i]); 
      if($type=="Histo"){ 
         imagefilledrectangle($img,$marge+$i*$intX+1,$y-$marge-($conso[$i]*($y-2*$marge)/$Echelley),$marge+$i*$intX+40,$y-$marge-1,$bleu); 

        // imagefilledrectangle($img,$marge+$i*$intX+1,$y-$marge-($consov[$i]*($y-2*$marge)/$Echelley),$marge+$i*$intX+40,$y-$marge-($consov[$i]*($y-2*$marge)/1000)+5,$rouge); 

      } 
      elseif($type=="Courbe"){ 
         imagesetthickness($img,1); 
         if($i<($taille1-1)){ 
            imageline($img,$marge+$i*$intX+1,$y-$marge-($conso[$i]*($y-2*$marge)/$Echelley),$marge+($i+1)*$intX+1,$y-$marge-($conso[$i+1]*($y-2*$marge)/$Echelley),$bleu);
          imageline($img,$marge+$i*$intX+1,$y-$marge-($consov[$i]*($y-2*$marge)/$Echelley),$marge+($i+1)*$intX+1,$y-$marge-($consov[$i+1]*($y-2*$marge)/$Echelley),$rouge);

         } 
        // imagefilledellipse($img,$marge+$i*$intX+1,$y-$marge-($conso[$i]*($y-2*$marge)/$Echelley),10,10,$noir); 

      } 
    //  imagettftext($img,8,0,$marge+$i*$intX+8,$y-$marge-($conso[$i]*($y-2*$marge)/$Echelley)-10,$bleu,"TIMESS.ttf",$conso[$i]); 

   } 
   imagepng($img,"histo.png"); 
?> 
<html> 
   <head> 
      <style> 
         select{ 
            border:solid 1px #AAAAAA; 
            padding:10px; 
            margin:10px; 
            font:14pt "Century Gothic"; 
            color:#DD7700; 
            border-radius:10px; 
         } 
      </style> 
   </head> 
   <body> 
      <center> 
         <form name="fo" method="post" action=""> 
            <select name="type" onChange="this.form.submit()"> 
               <option <?php if($type=="Histo") echo "selected";?>>Histo</option> 
               <option <?php if($type=="Courbe") echo "selected";?>>Courbe</option> 
            </select>       
         </form> 
         <img src="histo.png"> 
      </center> 
   </body> 
</html> 