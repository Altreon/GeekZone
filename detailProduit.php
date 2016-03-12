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
	
	$produitDet = array(
		"Recr�ez votre r�seau social pr�f�r� ... sur votre frigo ! gr�ce � nos magnets Fridgebook !<br/>
		<br/>
		Mettez � jour votre statut, postez des commentaires et faites de votre wall le d�fouloir de la maison !<br/>
		<br/>
		Ce kit pour reproduire un r�seau social est livr� avec un stylo feutre pour �crire facilement ainsi qu'une mini-brosse pour vite effacer les commentaires et en �crire de nouveaux.<br/>
		<br/>
		De nombreux magnets sont inclus dans le pack :<br/>
		<br/>
		* 1 x Statuts<br/>
		* 2 x Comment<br/>
		* 2 x Wall<br/>
		* 2 x Friends (� personnaliser avec des photos de vos amis)<br/>
		* 5 Logos (Photos, Events, Notes, Like, Dislike).",	
			
		"LICENCE OFFICIELLE TETRIS
		<br/>
		Recr�ez une partie de Tetris mais cette fois-ci dans votre verre avec ces gla�ons Tetris !<br/>
		Sous licence officielle, ces gla�ons embl�matiques sont les v�ritables gla�ons � forme de blocs Tetris : les Tetrimono !<br/>
		Plongez-les dans les verres de vos amis pour les ramener au bon vieux temps des jeux d'arcade !<br/>
		<br/>
		Caract�ristiques :<br/>
		* Bac � gla�ons en plastique mou, il reste souple m�me quand les gla�ons sont gel�s afin que votre gla�on en forme de tetrimono soit toujours facile � enlever.",
			
		"LICENCE OFFICIELLE PAC-MAN<br/>
	<br/>
	Fan de Pac-Man, ce mug est fait pour vous !<br/>
	<br/>
	Froid, c'est une grille de jeu Pac-Man ...<br/>
	<br/>
	Chaud, Pac-Man, les fant�mes et les Pac-Gommes apparaissent !<br/>
	<br/>
	Attention : Ne pas laver au lave-vaisselle ni utiliser au micro-onde."
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
	</body>';