<?php

$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

function produitList($tri) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf8');
		$reponse = $bdd->query('SELECT * FROM produit ORDER BY '.$tri.''); // Envoi de la requête
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
		{
			echo'
			<div class = "produit">
				<hr class="produit">
				<img class="produit" src="img/'.$cuisineRef[$i].'"></img>
				<hr>
				<p class="produit">'.$cuisineName[$i].'</p>
				<p class="produitPrix">'.$cuisinePrice[$i].'€</p>
			</div>
			';
		}
		// On libère la connexion du serveur pour d'autres requêtes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}