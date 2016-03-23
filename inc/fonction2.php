<?php

function produitList($filter, $tri, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse;
		if($filter == "Tous"){
			$reponse = $bdd->query('SELECT * FROM produit ORDER BY '.$tri.''); // Envoi de la requ�te
		}else{
			$reponse = $bdd->query('SELECT * FROM produit, categorie WHERE produit.categorie = categorie.categorie_id AND categorie.libelle = "'.$filter.'" ORDER BY '.$tri.''); // Envoi de la requ�te
		}
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
		while ( $donnees = $reponse->fetch() ) // D�coupage ligne � ligne de $reponse
		{
			echo'
			<a href="detailProduit.php?idProduit='.$donnees['produit_id'].'"><div class = "produit">	
				<hr class="produit">
				<div class="imgproduit">	
				<img class="produit" src="img/produits/'.$donnees['image'].'"></img>
				</div>		
				<hr>
				<p class="produit">'.$donnees['nom'].'</p>
				<p class="produitPrix">'.$donnees['prix'].'�</p>
			</div></a>
			';
		}
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function detailProduit($id, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM produit WHERE produit.produit_id = '.$id.''); // Envoi de la requ�te
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
		while ( $donnees = $reponse->fetch() ) // D�coupage ligne � ligne de $reponse
		{
			echo'	
			<div class="prods">
								
				<hr class="produit">
				
				
				<div class = "produitdet">
					<img class="detproduit" src="img/produits/'.$donnees['image'].'"></img>
					<br>
					<p class="detailproduitPrix">
					Disponible!<br>	
					'.$donnees['prix'].'�	
				</div>
							
				<div class="details">
					<p class="detailproduit">'.$donnees['nom'].'</p>		
						
					<hr>
					
					<p class="details">'.$donnees['description'].'</p>
				</div>			
			</div>	

							
			<div class="details2">
				<p class="detail2produit">'.$donnees['detail'].'</p>
			</div>				
					
			
			';
		}
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function boutique($name, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM boutique WHERE ville = "'.$name.'"'); // Envoi de la requ�te
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
		while ( $donnees = $reponse->fetch() ) // D�coupage ligne � ligne de $reponse
		{
			echo '
				<table>
					<tr>
						<th class="boutinfos" rowspan = "4">
							<h2>Boutique de '.$donnees['ville'].'</h2>
							<p class="center"><img class="boutique" src="img/boutiques/'.$donnees['image'].'"></img></p>
						</th>
						<th class="boutinfos" rowspan = "1">
							<h3>Horaires :</h3>
							<table>
								<tr>
									<th class="boutinfos" rowspan = "1"></th>
									<th class="boutinfos" rowspan = "1">Lundi</th>
									<th class="boutinfos" rowspan = "1">Mardi</th>
									<th class="boutinfos" rowspan = "1">Mercredi</th>
									<th class="boutinfos" rowspan = "1">Jeudi</th>
									<th class="boutinfos" rowspan = "1">Vendredi</th>
									<th class="boutinfos" rowspan = "1">Samedi</th>
									<th class="boutinfos" rowspan = "1">Dimanche</th>
								</tr>
								<tr>
									<th class="boutinfos" rowspan = "1">Matin</th>
									<th class="boutinfos" rowspan = "1">de 08h30 � 12h30</th>
									<th class="boutinfos" rowspan = "1">de 08h30 � 12h30</th>
									<th class="boutinfos" rowspan = "1">de 08h30 � 12h30</th>
									<th class="boutinfos" rowspan = "1">de 08h30 � 12h30</th>
									<th class="boutinfos" rowspan = "1">de 08h30 � 12h30</th>
									<th class="boutinfos" rowspan = "1">de 08h30 � 12h30</th>
									<th class="boutinfos" rowspan = "1">Ferm�e</th>
								</tr>
								<tr>
									<th class="boutinfos" rowspan = "1">Apr�s-midi</th>
									<th class="boutinfos" rowspan = "1">de 14h00 � 19h00</th>
									<th class="boutinfos" rowspan = "1">de 14h00 � 19h00</th>
									<th class="boutinfos" rowspan = "1">de 14h00 � 19h00</th>
									<th class="boutinfos" rowspan = "1">de 14h00 � 19h00</th>
									<th class="boutinfos" rowspan = "1">de 14h00 � 19h00</th>
									<th class="boutinfos" rowspan = "1">de 14h00 � 19h00</th>
									<th class="boutinfos" rowspan = "1">Ferm�e</th>
								</tr>
							</table>
						</th>
					</tr>
					<tr>
						<th class="boutinfos" rowspan = "1">
							<h5>Telephone : '.$donnees['telephone'].'</h5>
						</th>
					</tr>
					<tr>
						<th class="boutinfos" rowspan = "1">
							<h5>Adresse : '.$donnees['rue'].'</h5>
						</th>
					</tr>
					<tr>
						<th class="boutinfos" rowspan = "1">
							<h5>Code Postale : '.$donnees['cp'].'</h5>
						</th>
					</tr>
				</table>
			';
		}
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}