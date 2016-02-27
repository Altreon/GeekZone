<?php
echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
';

echo '
	<body>
	';
include 'inc/titre.php';
include 'inc/border.php';
echo'
<div class = "content">
	<div class="produitFilter">
	<form class="produitFilter"; action="categorieProduit.php" method="get">
	Filtrer les produits : <SELECT class="produitFilter" name="categorie" size="">
		<OPTION>Tous
		<OPTION>Cuisine
		<OPTION>Gadget
		<OPTION>Mode
		<OPTION>Portable
		<OPTION>USB
	</SELECT>
	<input class="produitFilter" type="submit" name="send"></input>
	</div>
';
	
echo'
	<div class="strip">
	</div>
	<br>
';
	
	$cuisineRef = array(
				"img/cuisine/fridgebook-magnet-reseau-social-frigo.jpg",
				"img/cuisine/glacons-tetris.jpg",
				"img/cuisine/mug-pac-man-chaud-froid.jpg"
			);
	
	$cuisineName = array(
			"Magnets fridgebook",
			"Gla�on t�tris",
			"Mug pac-man chaud froid",
	);
	
	$cuisineDesc = array(
			"Recr�ez l'environnement de votre r�seau social pr�f�r� ... sur votre frigo ! gr�ce � nos magnets fridgebook. Mettez � jour votre statut et commentaires � l'aide du stylo feutre fourni.",
			"Plongez ces gla�ons Tetris dans votre verre et ceux de vos amis pour recr�er des parties interminables ! Un �l�ment geek indispensable pour passer une bonne soir�e � se rem�morer les jeux de votre enfance ! Regardez les gla�ons s'imbriquer les uns sur les autres tout en buvant votre breuvage bien frais.",
			"Fan de Pac-Man, ce mug est fait pour vous ! Froid, c'est une grille de jeu Pac-Man ... Chaud, Pac-Man, les fant�mes et les Pac-Gommes apparaissent !",
	);
	
	$cuisinePrice = array(
			14.90,
			8.90,
			9.90
	);
	
	$tousRef = $cuisineRef; //+ gadget + mode...
	$tousName = $cuisineName; //+ gadget + mode...
	$tousDesc = $cuisineDesc; //+ gadget + mode.
	$tousPrice = $cuisinePrice; //+ gadget + mode...
	
	//echo'
		//<table>
		//<tr>
			//<th rowspan = "1"><p>Aper�u</p></th>
			//<th rowspan = "1"><p>Nom</p></th>
			//<th rowspan = "1"><p>Description courte</p></th>
			//<th rowspan = "1"><p>Prix</p></th>
		//</tr>
	//';
	if(!isset($_GET['categorie']) || $_GET['categorie'] == "Tous"){
		for($i = 0; $i<count($cuisineRef); $i++){
			echo'
			<div class = "produit">
				<hr class="produit">
				<img class="produit" src="'.$cuisineRef[$i].'"></img>
				<hr>
				<p class="produit">'.$cuisineName[$i].'</p>
				<p class="produitPrix">'.$cuisinePrice[$i].'�</p>
			</div>
			';
		}
	}else{
		if($_GET['categorie'] == "Cuisine"){
			for($i = 0; $i<count($cuisineRef); $i++){
				echo'
				<div class = "produit">
					<hr class="produit">
					<img class="produit" src="'.$cuisineRef[$i].'"></img>
					<hr>
					<p class="produit">'.$cuisineName[$i].'</p>
					<p class="produitPrix">'.$cuisinePrice[$i].'�</p>
				</div>
				';
			}
		}
	}
	echo '
	</div>
	';
	include 'inc/basPage.php';
	echo'
	</body>
	';
	