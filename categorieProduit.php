<?php

$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
';

echo '
	<body>
	';
include 'inc/titre.php';
include 'inc/border.php';
include 'inc/fonction.php';
echo'
<div class = "content">
	<form class="produitFilter"; action="categorieProduit.php" method="get">
	Filtrer les produits : <SELECT class="produitFilter" name="categorie" size="">
		<OPTION>Tous
		<OPTION>cuisine
		<OPTION>gadget
		<OPTION>mode
		<OPTION>portable
		<OPTION>USB
	</SELECT>
	<input class="produitFilter" type="submit" name="send"></input>
	</form>
';
	
echo'
	<div class="strip">
	</div>
	<br>
';
	
	if(isset($_GET['categorie'])){
		produitList($_GET['categorie'], $base, $hote, $utilisateur, $mdp);
	}else{
		produitList("Tous", $base, $hote, $utilisateur, $mdp);
	}
	
echo '
	</div>
	';
	include 'inc/basPage.php';
	echo'
	</body>
';
	