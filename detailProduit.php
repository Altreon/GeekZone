<?php
echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
';

echo '
	<body>
	';
include 'inc/titre.php';
include 'inc/border.php';

echo '<div class = "content">';



	$produitRef = array(
				"img/produits/fridgebook-magnet-reseau-social-frigo.jpg",
				"img/produits/glacons-tetris.jpg",
				"img/produits/mug-pac-man-chaud-froid.jpg"
			);
	
	$produitName = array(
			"Magnets fridgebook",
			"Glaçon tétris",
			"Mug pac-man chaud froid",
	);
	
	$produitDesc = array(
			"Recréez l'environnement de votre réseau social préféré ... sur votre frigo ! grâce à nos magnets fridgebook. Mettez à jour votre statut et commentaires à l'aide du stylo feutre fourni.",
			"Plongez ces glaçons Tetris dans votre verre et ceux de vos amis pour recréer des parties interminables ! Un élément geek indispensable pour passer une bonne soirée à se remémorer les jeux de votre enfance ! Regardez les glaçons s'imbriquer les uns sur les autres tout en buvant votre breuvage bien frais.",
			"Fan de Pac-Man, ce mug est fait pour vous ! Froid, c'est une grille de jeu Pac-Man ... Chaud, Pac-Man, les fantômes et les Pac-Gommes apparaissent !",
	);
	
	$produitPrice = array(
			14.90,
			8.90,
			9.90
	);
	
	$produitDet = array(
		"Recréez votre réseau social préféré ... sur votre frigo ! grâce à nos magnets Fridgebook !<br/>
		<br/>
		Mettez à jour votre statut, postez des commentaires et faites de votre wall le défouloir de la maison !<br/>
		<br/>
		Ce kit pour reproduire un réseau social est livré avec un stylo feutre pour écrire facilement ainsi qu'une mini-brosse pour vite effacer les commentaires et en écrire de nouveaux.<br/>
		<br/>
		De nombreux magnets sont inclus dans le pack :<br/>
		<br/>
		* 1 x Statuts<br/>
		* 2 x Comment<br/>
		* 2 x Wall<br/>
		* 2 x Friends (à personnaliser avec des photos de vos amis)<br/>
		* 5 Logos (Photos, Events, Notes, Like, Dislike).",	
			
		"LICENCE OFFICIELLE TETRIS
		<br/>
		Recréez une partie de Tetris mais cette fois-ci dans votre verre avec ces glaçons Tetris !<br/>
		Sous licence officielle, ces glaçons emblématiques sont les véritables glaçons à forme de blocs Tetris : les Tetrimono !<br/>
		Plongez-les dans les verres de vos amis pour les ramener au bon vieux temps des jeux d'arcade !<br/>
		<br/>
		Caractéristiques :<br/>
		* Bac à glaçons en plastique mou, il reste souple même quand les glaçons sont gelés afin que votre glaçon en forme de tetrimono soit toujours facile à enlever.",
			
		"LICENCE OFFICIELLE PAC-MAN<br/>
	<br/>
	Fan de Pac-Man, ce mug est fait pour vous !<br/>
	<br/>
	Froid, c'est une grille de jeu Pac-Man ...<br/>
	<br/>
	Chaud, Pac-Man, les fantômes et les Pac-Gommes apparaissent !<br/>
	<br/>
	Attention : Ne pas laver au lave-vaisselle ni utiliser au micro-onde."
	);
		

for ($i=0; $i < count($produitName); $i++){	
	if($_GET['nomProduit']==$produitName[$i]) {
		echo'
				
			<div class="retourProds">
					<a href="categorieProduit.php"><button class="retourProds"><span>Retour aux produits</span></button></a>
			</div>	
				
			<div class="prods">
								
				<hr class="produit">
				
				
				<div class = "produit">
					<img class="produit" src="'.$produitRef[$i].'"></img>
				</div>
							
				<div class="details">
					<p class="detailproduit">'.$produitName[$i].'</p>		
						
					<hr>
					
					<p class="details">'.$produitDesc[$i].'</p>
				</div>			
			</div>	
			
			<div class="prix">
				<p class="detailproduitPrix">
					Disponible!<br>	
					'.$produitPrice[$i].'€
				</p>			
			</div>
							
			<div class="details2">
				<p class="detail2produit">'.$produitDet[$i].'</p>
			</div>				
					
			
			';
	}
}

echo '
	</div>
	';
include 'inc/basPage.php';
echo'