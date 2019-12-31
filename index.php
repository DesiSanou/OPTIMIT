

<?php 
  session_start();

include("entete.php");
?>
 <!-- <h3 style="color:blue;font-family:arial sans-serif; font-size:14pt;background-color:rgba(200,100,255,0.6);width:30%;margin-right:10pt;">Bienvenue <?php // echo strtoupper(@$_SESSION["nomprenom"])."\n!";?> </h3> -->
 
  <h1>Présentation FloussTor-IT<hr/></h1>
  <section style="font-size:14pt;color:blue;width:70%;">Le projet FloussTor-IT est une solution électronique et informatique que nous mettons au point 
    afin de prévoir la consommation énergétique en vue de produire une quantité adéquate,
     de veiller à ce que cette consommation prévue soit respectée ; tout ceci facilitant la 
     tâche à l'usager et au poste de distribution. 
   </section>
 	 <section>
    <?php
   
    if(@$_SESSION["autoriser"]!="OK"){
header("location:login.php"); } ?>
   </section>

 	</body>