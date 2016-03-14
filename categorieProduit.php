<?php

$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

$filter = "Tous";
$tri = "nom A>Z";

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
	<form class="produitFilter"; action="categorieProduit.php" method="get">
	Filtrer les produits : <SELECT class="produitFilter" name="categorie" size="">
		<OPTION ';if($filter == "Tous"){echo("selected");}echo'>Tous
		<OPTION ';if($filter == "cuisine"){echo("selected");}echo'>cuisine
		<OPTION ';if($filter == "gadget"){echo("selected");}echo'>gadget
		<OPTION ';if($filter == "mode"){echo("selected");}echo'>mode
		<OPTION ';if($filter == "portable"){echo("selected");}echo'>portable
		<OPTION ';if($filter == "USB"){echo("selected");}echo'>USB
	</SELECT>
	<input type="hidden" name="tri" value="'.$tri.'">
	<input class="produitFilter" type="submit" name="send"></input>
	</form>
		
	<form class="produitFilter"; action="categorieProduit.php" method="get">
	<input type="hidden" name="categorie" value="'.$filter.'">
	Trier les produits : <SELECT class="produitFilter" name="tri" size="">
		<OPTION ';if($tri == "nom A>Z"){echo("selected");}echo'>nom A>Z
		<OPTION ';if($tri == "nom Z>A"){echo("selected");}echo'>nom Z>A
		<OPTION ';if($tri == "prix croissant"){echo("selected");}echo'>prix croissant
		<OPTION ';if($tri == "prix decroissant"){echo("selected");}echo'>prix decroissant
	</SELECT>
	<input class="produitFilter" type="submit" name="send"></input>
	</form>
		
	<form class="produitFilter"; action="categorieProduit.php" method="get">
	Rechercher des produits : <input id="recherche" class="input" name="recherche" type="text" value="" size="30" /><br />
	<input class="produitFilter" type="submit" name="send"></input>
	</form>
';


	
echo'
	<div class="strip">
	</div>
	<br>
';

	if(isset($_GET['recherche'])){
		produitList("Tous", "nom", null, $_GET['recherche'], $base, $hote, $utilisateur, $mdp);
	}else{
		if($tri == "nom A>Z"){
			produitList($filter, "nom", false, null, $base, $hote, $utilisateur, $mdp);
		}else if($tri == "nom Z>A"){
			produitList($filter, "nom", true, null, $base, $hote, $utilisateur, $mdp);
		}else if($tri == "prix croissant"){
			produitList($filter, "prix", false, null, $base, $hote, $utilisateur, $mdp);
		}else if($tri == "prix decroissant"){
			produitList($filter, "prix", true, null, $base, $hote, $utilisateur, $mdp);
		}
	}

	
echo '
	</div>
	';
	include 'inc/basPage.php';
	echo'
	</body>
';
	