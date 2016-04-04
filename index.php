<?php
echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
	';
	
$page="accueil";	
$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

include 'inc/titre.php';	
include 'inc/fonction.php';
	
echo '
	<body>
	';
include 'inc/border.php';

echo '
	<div class = "content">
		<p class = "acc">Bienvenue chez GeekZone!</p>
		<div class="acc">
			<h1 class="bvenue">Ceci est le site officiel de GeekZone, il répertorie les informations dont VOUS avez besoin!
			<br>
			Voici certains de nos produits qui pourraient vous intéresser:
			<br>		
			</h1>';
			
imageRandomProduit($base, $hote, $utilisateur, $mdp);		
		
		echo '<br></div>
	</div>
		
	<div class = "accboutiques">
		<p>
   			<map name="mapacc" id="mapacc">
      			<area shape="rect" coords="0,0,270,122" href="boutiquesmap.php"/>
				<area shape="rect" coords="910,0,1184,122" href="categorieProduit.php"/>
   			</map>
			<hr class="produit">
			<img src="imgcedric/bouton/gz.png" usemap="mapacc" alt="image"/>
			<br>
			<hr class="produit">
		</p>
		
	</div>	
';
		
echo '<div class="acc">
		<h1 class="bvenue">Une de nos boutiques:</h1>
		<br>
		';
		
imageRandomBoutique($base, $hote, $utilisateur, $mdp);	

echo'<br></div></body>';

include 'inc/basPage.php';