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
			"Gla�on t�tris",
			"Mug pac-man chaud froid",
	);
	
	$produitDesc = array(
			"Recr�ez l'environnement de votre r�seau social pr�f�r� ... sur votre frigo ! gr�ce � nos magnets fridgebook. Mettez � jour votre statut et commentaires � l'aide du stylo feutre fourni.",
			"Plongez ces gla�ons Tetris dans votre verre et ceux de vos amis pour recr�er des parties interminables ! Un �l�ment geek indispensable pour passer une bonne soir�e � se rem�morer les jeux de votre enfance ! Regardez les gla�ons s'imbriquer les uns sur les autres tout en buvant votre breuvage bien frais.",
			"Fan de Pac-Man, ce mug est fait pour vous ! Froid, c'est une grille de jeu Pac-Man ... Chaud, Pac-Man, les fant�mes et les Pac-Gommes apparaissent !",
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
					'.$produitPrice[$i].'�
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