<?php

function produitList($tri, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse;
		if($tri == "Tous"){
			$reponse = $bdd->query('SELECT * FROM produit'); // Envoi de la requête
		}else{
			$reponse = $bdd->query('SELECT * FROM produit, categorie WHERE produit.categorie = categorie.categorie_id AND categorie.libelle = "'.$tri.'"'); // Envoi de la requête
		}
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
		{
			echo'
			<div class = "produit">
				<hr class="produit">
				<img class="produit" src="img/produits/'.$donnees['image'].'"></img>
				<hr>
				<p class="produit">'.$donnees['nom'].'</p>
				<p class="produitPrix">'.$donnees['prix'].'€</p>
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