<?php

function produitList($filter, $tri, $decroissant, $recherche, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse;
		if($recherche == null){
			if($filter == "Tous"){
				if(!$decroissant){
					$reponse = $bdd->query('SELECT * FROM produit ORDER BY '.$tri.'');
				}else{
					$reponse = $bdd->query('SELECT * FROM produit ORDER BY '.$tri.' DESC');
				}
			}else{
				if(!$decroissant){
					$reponse = $bdd->query('SELECT * FROM produit, categorie WHERE produit.categorie = categorie.categorie_id AND categorie.libelle = "'.$filter.'" ORDER BY '.$tri.'');
				}else{
					$reponse = $bdd->query('SELECT * FROM produit, categorie WHERE produit.categorie = categorie.categorie_id AND categorie.libelle = "'.$filter.'" ORDER BY '.$tri.' DESC');
				}
			}
		}else{
			$reponse = $bdd->query('SELECT * FROM produit WHERE nom LIKE \'%'.$recherche.'%\' OR description LIKE \'%'.$recherche.'%\' OR detail LIKE \'%'.$recherche.'%\' ORDER BY nom');
		}
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
		{
			echo'
			<a href="detailProduit.php?idProduit='.$donnees['produit_id'].'"><div class = "produit">	
				<hr class="produit">
				<div class="imgproduit">	
				<img class="produit" src="img/produits/'.$donnees['image'].'"></img>
				</div>		
				<hr>
				<p class="produit">'.$donnees['nom'].'</p>
				<p class="produitPrix">'.$donnees['prix'].'€</p>
			</div></a>
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

function detailProduit($id, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM produit WHERE produit.produit_id = '.$id.''); // Envoi de la requête
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
		{
			echo'	
			<div class="prods">
								
				<hr class="produit">
				
				
				<div class = "produitimg">
					<img class="detproduit" src="img/produits/'.$donnees['image'].'"></img>
				</div>			
					<br><br>
				<div class="produitdet">			
					<p class="detailproduitPrix">
					Disponible!<br>	
					'.$donnees['prix'].'€	
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
		// On libère la connexion du serveur pour d'autres requêtes :
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
		$reponse = $bdd->query('SELECT * FROM boutique WHERE ville = "'.$name.'"'); // Envoi de la requête
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
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
									<th class="boutinfos" rowspan = "1">de 08h30 à 12h30</th>
									<th class="boutinfos" rowspan = "1">de 08h30 à 12h30</th>
									<th class="boutinfos" rowspan = "1">de 08h30 à 12h30</th>
									<th class="boutinfos" rowspan = "1">de 08h30 à 12h30</th>
									<th class="boutinfos" rowspan = "1">de 08h30 à 12h30</th>
									<th class="boutinfos" rowspan = "1">de 08h30 à 12h30</th>
									<th class="boutinfos" rowspan = "1">Fermée</th>
								</tr>
								<tr>
									<th class="boutinfos" rowspan = "1">Après-midi</th>
									<th class="boutinfos" rowspan = "1">de 14h00 à 19h00</th>
									<th class="boutinfos" rowspan = "1">de 14h00 à 19h00</th>
									<th class="boutinfos" rowspan = "1">de 14h00 à 19h00</th>
									<th class="boutinfos" rowspan = "1">de 14h00 à 19h00</th>
									<th class="boutinfos" rowspan = "1">de 14h00 à 19h00</th>
									<th class="boutinfos" rowspan = "1">de 14h00 à 19h00</th>
									<th class="boutinfos" rowspan = "1">Fermée</th>
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
		// On libère la connexion du serveur pour d'autres requêtes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function boutiquelist($base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM boutique'); // Envoi de la requête
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		
		echo '<table>';
		
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
		{
			echo '
					<tr>
						<th class="boutinfos" rowspan = "1"><a href="boutique.php?boutique='.$donnees['ville'].'">'.$donnees['ville'].'</a></th>
					</tr>

						';
		}
		echo'</table>';
		
	
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}


function ModifProduitValues($base, $hote, $utilisateur, $mdp) {

	try 
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM produit'); // Envoi de la requête
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées	
		
		
		if(isset($_GET['modifProd'])){
			echo '<form>
					<fieldset>
						<p class="details">Modification du produit n°'.$_GET['modifProd'].'<br/><br/>
								Nom: <input type="text" id="nom" name="nom" /><br/><br/>
								Description: <input type="text" id="desc" name="desc" /><br/><br/>
								Details: <input type="text" id="det" name="det" /><br/><br/>
								Prix: <input type="text" id="prix" name="prix" /><br/><br/>
								Image: <input type"text" id="img" name="img" /><br/><br/>
								N° Catégorie: <input type="text" id="cat" name="cat" /><br/><br/>
								<input name="b2" type="submit" value="Valider" />								
					</fieldset>
				</form>';					
		}
		
		
		else if(isset($_GET['suppProd'])) {
			
		}
		
		else {
	
			echo '<div class="admin"><table class="tab">
			<tr><th>NOM</th><th>DESCRIPTION</th><th>DETAIL</th><th>PRIX</th><th>IMAGE</th>
	 		<th>CATEGORIE</th></tr>';
			
			while ($donnees = $reponse->fetch()) {
				echo '<tr>';
				echo '<td class="cellule">'.$donnees['nom'].'</td>';
				echo '<td class="cellule">'.$donnees['description'].'</td>';
				echo '<td class="cellule">'.$donnees['detail'].'</td>';
				echo '<td class="cellule">'.$donnees['prix'].'</td>';
				echo '<td class="cellule"><img class="produit2" src="img/produits/'.$donnees['image'].'"></td>';
				echo '<td class="cellule">'.$donnees['categorie'].'</td>';
				echo '<td class="edit"><input type="image" id="editProd" name="editProd" src="img/edit.png"
						   onclick="location.href=\'admin.php?modifProd='.$donnees['produit_id'].'\'"/></td>';	
				echo '<td><a href="admin.php?suppProd='.$donnees['produit_id'].'">
						  <img src="img/suppr.png" /></a></td>';			
			}
			
			echo '</table></div>';
				
	
			
		}
		
		}
		
		catch (Exception $erreur)
		{
			die('Erreur : ' . $erreur->getMessage());
		}
		
		
		try
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
			$bdd->exec('SET NAMES utf16');
			$reponse = $bdd->query('SELECT * FROM boutique'); // Envoi de la requête
			$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
			
			echo '<form>
					<fieldset>
						<p class="details">Modification des boutiques</p>
			
							<label for="bout">Boutiques: </label>
								<select name="bout" id="bout">';
									while ( $donnees = $reponse->fetch() ) {
										echo '<option value=" '.$donnees['ville'].' ">'.$donnees['ville'].'</option>';
									}
									
							echo '<input name="b2" type="submit" value="Valider" />';
									
			echo '</fieldset></form>';	
			
		
		}
		
		catch (Exception $erreur)
		{
			die('Erreur : ' . $erreur->getMessage());
		}
	
}

function imageRandom($base, $hote, $utilisateur, $mdp) {
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
	$bdd->exec('SET NAMES utf16');
	$reponse = $bdd->query('SELECT * FROM produit'); // Envoi de la requête
	$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
	
	$prod1=mt_rand(1,$nb);
	$prod2=$prod1;
	$prod3=$prod1;
	
	while ($prod2 == $prod1) {
		$prod2 = mt_rand(1,$nb);
	}
	
	while ($prod3 == $prod1 || $prod3 == $prod2) {
		$prod3 = mt_rand(1,$nb);
	}
	
	echo '<div class="produitaccalign">';
	while ( $donnees = $reponse->fetch() ) {
		if ($donnees['produit_id'] == $prod1 || $donnees['produit_id'] == $prod2 || $donnees['produit_id'] == $prod3) {
			echo '<div class="produitacc"><img class="produitacc" src="img/produits/'.$donnees['image'].'"></img></div>';
		}
		
	} echo '<br></div>';
}

	