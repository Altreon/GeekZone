<?php

$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
<script type="text/javascript" src="scripts/script.js" ></script>
';

echo '
	<body>
	';
include 'inc/titre.php';
include 'inc/border.php';
include 'inc/fonction.php';

echo '
	<div class = "content">
	<div class="retourProds">
		<a href="categorieProduit.php"><button class="retourProds"><span>Retour aux produits</span></button></a>
	</div>	
		
';

	if(isset($_GET['idProduit'])){  // Affiche les détails sur le produit sélectionné
		detailProduit($_GET['idProduit'], $base, $hote, $utilisateur, $mdp);
	}
		
echo'
	</div>
	';
include 'inc/basPage.php';
