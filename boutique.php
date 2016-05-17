<?php

$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
	<body>
	';

include 'inc/titre.php';
include 'inc/border.php';
include 'inc/fonction2.php';

echo'
	<div class = "content">
	<div class="retourCarte">
		<a href="boutiquesmap.php"><button class="retourCarte"><span>Retour à la carte</span></button></a>
	</div>
';

boutique($_GET['boutique'], $base, $hote, $utilisateur, $mdp);  //Affiche les caractéristiques de la boutique sélectionnée.

include 'inc/basPage.php';

echo '
	</div>
	</body>
';