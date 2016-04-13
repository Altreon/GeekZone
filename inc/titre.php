<?php

session_start();

echo '
	<div class="titre">
		<a href="index.php"><img class="titre" src="img/geekzone.png"></img></a>
		';
		if(!isset($page)){
			echo'
			<a href="boutiquesmap.php"><button class="boutiques"><span>Boutiques</span></button></a>
			<a href="categorieProduit.php"><button class="produits"><span>Produit</span></button></a>
		';}echo'
	</div>
';