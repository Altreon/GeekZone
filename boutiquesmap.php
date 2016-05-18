<?php
echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
';

$villes = array("ALBERTVILLE","ANNECY","CHAMBERY","CLERMONT FERRAND","GRENOBLE","LYON","VALENCE");

// Tableau de coordonnées des points sur la carte de chaque ville
$coordx = array(442+50,426+50,420+50,311+50,406+50,370+50,383+50);
$coordy = array(307+168+30,295+168+30,311+168+30,307+168+30,329+168+30,305+168+30,362+168+30);

$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';


include 'inc/fonction2.php';
include 'inc/titre.php';
echo '
	<body>
';
include 'inc/border.php';
echo '
	<div class = "content">
';

include 'inc/france.inc.php';  // Carte de la France

boutiqueListMap($base, $hote, $utilisateur, $mdp);

echo '
	<div class="shop">Cliquez sur les points de la carte, ou sur une ville ci-dessous, pour accéder aux détails d\'une de nos boutiques.';

boutiquelist($base, $hote, $utilisateur, $mdp);  // Affiche la liste des boutiques
				
echo '	</div>
	</div>
	</body>
		';
	
include 'inc/basPage.php';