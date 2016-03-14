<?php

$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

$filter = "Tous";
$tri = "nom";

if(isset($_GET['categorie'])){
	$filter = $_GET['categorie'];
}
if(isset($_GET['tri'])){
	$tri = $_GET['tri'];
}

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
	<form class="produitFilter"; action="categorieProduit.php?categorie='.$filter.'&tri='.$tri.'" method="get">
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
		
	<form class="produitFilter"; action="categorieProduit.php?categorie='.$filter.'&tri='.$tri.'" method="get">
	Trier les produits : <SELECT class="produitFilter" name="tri" size="">
		<OPTION>nom
		<OPTION>prix
	</SELECT>
	<input class="produitFilter" type="submit" name="send"></input>
	</form>
		
	<form class="produitFilter"; action="categorieProduit.php?categorie='.$filter.'&tri='.$tri.'" method="get">
	Rechercher des produits : <input id="name" class="input" name="name" type="text" value="" size="30" /><br />
	<input class="produitFilter" type="submit" name="send"></input>
	</form>
';


	
echo'
	<div class="strip">
	</div>
	<br>
';
	
	produitList($filter, $tri, $base, $hote, $utilisateur, $mdp);

	
echo '
	</div>
	';
	include 'inc/basPage.php';
	echo'
	</body>
';
	