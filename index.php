
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
	
<?php	
$page="accueil";	
$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

include 'inc/titre.php';	
include 'inc/fonction.php';
?>

<body>
	
<?php include 'inc/border.php'; ?>


	<div class = "content">
		<p class = "acc">Bienvenue chez GeekZone!</p>
		<div class="acc">
			<h1 class="bvenue">Ceci est le site officiel de GeekZone, il répertorie les informations dont VOUS avez besoin!
			<br>
			Voici certains de nos produits qui pourraient vous intéresser:
			<br>		
			</h1>
			
<?php
imageRandomProduit($base, $hote, $utilisateur, $mdp);	?>	
		
	<br></div>
	
		
	<div class = "accboutiques">
		<p>
   			<map name="mapacc" id="mapacc">
      			<area shape="rect" coords="0,0,270,122" href="boutiquesmap.php"/>
				<area shape="rect" coords="910,0,1184,122" href="categorieProduit.php"/>
   			</map></p>
			<hr class="produit">
			<img src="imgcedric/bouton/gz.png" usemap="mapacc" alt="image"/>
			<br>
			<hr class="produit">
		
		
	</div>	


<div class="acc">
	<h1 class="bvenue">Une de nos boutiques:</h1>
	<br>
		
<?php 		
imageRandomBoutique($base, $hote, $utilisateur, $mdp);	?>

<br></div></div></body>

<?php 
include 'inc/basPage.php'; ?>