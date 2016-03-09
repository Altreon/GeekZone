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

for ($i=0; $i < count($produitName); $i++){	
	if($_GET['nomProduit']==$produitName[$i]) {
		echo'
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
							
			
			';
	}
}

echo '
	</div>
	';
include 'inc/basPage.php';
echo'
	</body>';