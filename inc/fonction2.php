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
			$reponseHoraires = $bdd->query('SELECT * FROM horaires WHERE boutique_id = '.$donnees['id'].''); // Envoi de la requête
			$donneesHoraires = $reponseHoraires->fetch();
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
									<th class="boutinfos" rowspan = "1">Matin</th>';
									if($donneesHoraires['lundi_matin_debut'] != "fermé" && $donneesHoraires['lundi_matin_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['lundi_matin_debut'].' à '.$donneesHoraires['lundi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['mardi_matin_debut'] != "fermé" && $donneesHoraires['mardi_matin_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['mardi_matin_debut'].' à '.$donneesHoraires['mardi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['mercredi_matin_debut'] != "fermé" && $donneesHoraires['mercredi_matin_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['mercredi_matin_debut'].' à '.$donneesHoraires['mercredi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['jeudi_matin_debut'] != "fermé" && $donneesHoraires['jeudi_matin_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['jeudi_matin_debut'].' à '.$donneesHoraires['jeudi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['vendredi_matin_debut'] != "fermé" && $donneesHoraires['vendredi_matin_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['vendredi_matin_debut'].' à '.$donneesHoraires['vendredi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['samedi_matin_debut'] != "fermé" && $donneesHoraires['samedi_matin_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['samedi_matin_debut'].' à '.$donneesHoraires['samedi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['dimanche_matin_debut'] != "fermé" && $donneesHoraires['dimanche_matin_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['dimanche_matin_debut'].' à '.$donneesHoraires['dimanche_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
								echo'
								</tr>
								<tr>
									<th class="boutinfos" rowspan = "1">Après-midi</th>';
									if($donneesHoraires['lundi_apres_debut'] != "fermé" && $donneesHoraires['lundi_apres_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['lundi_apres_debut'].' à '.$donneesHoraires['lundi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['mardi_apres_debut'] != "fermé" && $donneesHoraires['mardi_apres_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['mardi_apres_debut'].' à '.$donneesHoraires['mardi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['mercredi_apres_debut'] != "fermé" && $donneesHoraires['mercredi_apres_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['mercredi_apres_debut'].' à '.$donneesHoraires['mercredi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['jeudi_apres_debut'] != "fermé" && $donneesHoraires['jeudi_apres_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['jeudi_apres_debut'].' à '.$donneesHoraires['jeudi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['vendredi_apres_debut'] != "fermé" && $donneesHoraires['vendredi_apres_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['vendredi_apres_debut'].' à '.$donneesHoraires['vendredi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['samedi_apres_debut'] != "fermé" && $donneesHoraires['samedi_apres_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['samedi_apres_debut'].' à '.$donneesHoraires['samedi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
									if($donneesHoraires['dimanche_apres_debut'] != "fermé" && $donneesHoraires['dimanche_apres_fin'] != "fermé"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['dimanche_apres_debut'].' à '.$donneesHoraires['dimanche_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Fermé';
									}
								echo'
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

function verifLogin ($login, $motdp, $base, $hote, $utilisateur, $mdp){
	$valide = false;
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf8');
		$reponse = $bdd->query('SELECT * FROM boutique'); // Envoi de la requête
		while ( !$valide && $donnees = $reponse->fetch()) // Découpage ligne à ligne de $reponse
		{
			if($donnees['loginPeople'] == $login && $donnees['mdpPeople'] == $motdp){
				$valide = true;
				session_start();
				$_SESSION['logPeople'] = $donnees['loginPeople'];
				$_SESSION['statPeople'] = $donnees['statutPeople'];
			}
		}
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
	return $valide;
}

//Permet d'afficher le tableau des comptes de la base de données.
function creaTableau($tri, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM compte ORDER BY '.$tri.''); // Envoi de la requête
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		echo '<table class="compte">'; // Déclaration d'un tableau et de sa ligne d'en-tête
		echo '<tr><th>NUMERO</th><th>NOM</th><th>PRENOM</th><th>MAIL</th><th>TELEPHONE</th>
		<th>ADRESSE</th><th>CP</th><th>VILLE</th><th>BOUTIQUE GÉRÉE</th><th>STATUT</th><th>LOGIN</th><th>MDP</th></tr>';
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
		{
			echo '<tr>'; // Une ligne appelle les données de $donnees['']
			echo '<td class="c1">'.$donnees['id'].'</td>';
			echo '<td class="c1">'.$donnees['nom'].'</td>';
			echo '<td class="c1">'.$donnees['prenom'].'</td>';
			echo '<td class="c1">'.$donnees['mail'].'</td>';
			echo '<td class="c1">'.$donnees['telephone'].'</td>';
			echo '<td class="c1">'.$donnees['adresse'].'</td>';
			echo '<td class="c1">'.$donnees['cp'].'</td>';
			echo '<td class="c1">'.$donnees['ville'].'</td>';
			echo '<td class="c1">'.$donnees['boutiqueGeree'].'</td>';
			echo '<td class="c1">'.$donnees['statut'].'</td>';
			echo '<td class="c1">'.$donnees['login'].'</td>';
			echo '<td class="c1">'.$donnees['mdp'].'</td>';
				
			//Si l'utilisateur est administrateur, le possibilité de modifier ou de supprimer un compte lui est offerte.
			//if($_SESSION['statPeople'] == "A"){
				//Modification
				echo '<td class="c1">
				<input type="image" id="editCompte" name="editCompte" src="img/edit.png"
				onclick="location.href=\'gestionUtilisateur.php?editCompte='
						.$donnees['id'].'\'"/></td>';

				//Suppresion
				echo '<td class="c1">
					<input type="image" id="suppCompte" name="suppCompte" src="img/icon_suppr.gif"
					onclick="attention('.$donnees['id'].', \''.$donnees['prenom'].'\',
					\''.$donnees['nom'].'\');"/></td>';
				echo '</tr>';
			//}
		}
		echo '</table>'; // Fin du tableau
		echo '<p>Il y a '.$nb.' comptes.</p>'; // Affichade du compte des lignes
		// On libère la connexion du serveur pour d'autres requêtes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Perlet de lister les villes de la base de données (!!! ancienne focntion !!!)
function listBoutique($base, $hote, $utilisateur, $mdp, $boutiqueGeree){
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf8');
		echo '<label>Gère la boutique de</label>';
		echo '<select id="boutiqueGeree" name="boutiqueGeree">';
		
		$reponse = $bdd->prepare('SELECT * FROM boutique');
		$reponse->execute( array() );
		while ( $donnees = $reponse->fetch() )
		{
			if($boutiqueGeree != null && $boutiqueGeree == $donnees['id']){
				echo '<option value="'.$donnees['id'].'" selected="selected">'
						.$donnees['ville'].'</option>';
			}else{
				echo '<option value="'.$donnees['id'].'" >'
						.$donnees['ville'].'</option>';
			}
		}
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
	echo '</select><br/><br/>';
}

function boutiquelist($base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM boutique'); // Envoi de la requête
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		
		echo '<br><hr><br><div class="boutList"><table>';
		
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
		{
			echo '	
					<tr>
						<th class="boutinfos" rowspan = "1"><a href="boutique.php?boutique='.$donnees['ville'].'">'.$donnees['ville'].'</a></th>
					</tr>		
						';
		}
		echo'</table></div>';
		
	
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
								Nom: <input class="form" type="text" id="nom" name="nom" /><br/><br/>
								Description: <input class="form" type="text" id="desc" name="desc" /><br/><br/>
								Details: <input class="form" type="text" id="det" name="det" /><br/><br/>
								Prix: <input class="form" type="text" id="prix" name="prix" /><br/><br/>
								Image: <input class="form" type"text" id="img" name="img" /><br/><br/>
								N° Catégorie: <input class="form" type="text" id="cat" name="cat" /><br/><br/>
								<input class="form" name="b2" type="submit" value="Valider" />								
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
				echo '<td class="edit"><input class="form" type="image" id="editProd" name="editProd" src="img/edit.png"
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
									
							echo '<input class="form" name="b2" type="submit" value="Valider" />';
									
			echo '</fieldset></form>';	
			
		
		}
		
		catch (Exception $erreur)
		{
			die('Erreur : ' . $erreur->getMessage());
		}
	
}

function imageRandomProduit($base, $hote, $utilisateur, $mdp) {
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
			echo '<div class="produitacc"><a href="detailProduit.php?idProduit='.$donnees['produit_id'].'"><img class="produitacc accueilBout" src="img/produits/'.$donnees['image'].'"></img></a></div>';
		}
		
	} echo '<br></div>';
}


function imageRandomBoutique($base, $hote, $utilisateur, $mdp) {
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
	$bdd->exec('SET NAMES utf16');
	$reponse = $bdd->query('SELECT * FROM boutique'); // Envoi de la requête
	$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
	
	$bout=mt_rand(1,$nb);
	
	echo '<div class="produitaccalign">';
	while ( $donnees = $reponse->fetch() ) {
		if ($donnees['id'] == $bout) {
			echo '<h1 class="bvenue">Boutique de '.$donnees['ville'].'</h1>';
			echo '<div class="lienImage"><a href="boutique.php?boutique='.$donnees['ville'].'"><img class="boutique accueilBout" src="img/boutiques/'.$donnees['image'].'"></img></a></div>';
		}
	} echo '<br></div>';
}

//Permet d'afficher le tableau des comptes de la base de données.
function creaTableauUser ($tri, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM compte ORDER BY '.$tri.''); // Envoi de la requête
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		echo '<table class="gestion">'; // Déclaration d'un tableau et de sa ligne d'en-tête
		echo '<tr><th>NUMERO</th><th>NOM</th><th>PRENOM</th><th>MAIL</th><th>TELEPHONE</th>
		<th>ADRESSE</th><th>CP</th><th>VILLE</th><th>BOUTIQUE GÉRÉE</th><th>STATUT</th><th>LOGIN</th><th>MDP</th></tr>';
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
		{
			echo '<tr>'; // Une ligne appelle les données de $donnees['']
			echo '<td class="c1">'.$donnees['id'].'</td>';
			echo '<td class="c1">'.$donnees['nom'].'</td>';
			echo '<td class="c1">'.$donnees['prenom'].'</td>';
			echo '<td class="c1">'.$donnees['mail'].'</td>';
			echo '<td class="c1">'.$donnees['telephone'].'</td>';
			echo '<td class="c1">'.$donnees['adresse'].'</td>';
			echo '<td class="c1">'.$donnees['cp'].'</td>';
			echo '<td class="c1">'.$donnees['ville'].'</td>';
			echo '<td class="c1">'.$donnees['boutiqueGeree'].'</td>';
			echo '<td class="c1">'.$donnees['statut'].'</td>';
			echo '<td class="c1">'.$donnees['login'].'</td>';
			echo '<td class="c1">'.$donnees['mdp'].'</td>';

			//Si l'utilisateur est administrateur, le possibilité de modifier ou de supprimer un compte lui est offerte.
			//if($_SESSION['statPeople'] == "A"){
			//Modification
			echo '<td class="c1">
				<input type="image" id="editCompte" name="editCompte" src="img/edit.png"
				onclick="location.href=\'gestionUtilisateur.php?editCompte='
					.$donnees['id'].'\'"/></td>';

			//Suppresion
			echo '<td class="c1">
					<input type="image" id="suppCompte" name="suppCompte" src="img/icon_suppr.gif"
					onclick="attentionUser('.$donnees['id'].', \''.$donnees['prenom'].'\',
					\''.$donnees['nom'].'\');"/></td>';
			echo '</tr>';
			//}
		}
		echo '</table>'; // Fin du tableau
		echo '<p>Il y a '.$nb.' comptes.</p>'; // Affichade du compte des lignes
		// On libère la connexion du serveur pour d'autres requêtes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Permet d'ajouter un compte dans la base de données.
function insertTableauUser($base, $hote, $utilisateur, $mdp, $nom, $prenom, $mail, $telephone, $adresse, $cp, $ville, $boutiqueGeree, $statut, $login, $motdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On prépare la requète:
		$insertion = $bdd->prepare('INSERT INTO compte (id, nom, prenom, mail, telephone, adresse, cp, ville, boutiqueGeree, statut, login, mdp) VALUES (\'\', :nom, :prenom, :mail, :telephone, :adresse, :cp, :ville, :boutiqueGeree, :statut, :login, :mdp)');
		//On envoie la requète avec les valeurs nécessaires:
		$insertion->execute(array(
				'nom' => $nom,
				'prenom' => $prenom,
				'mail' => $mail,
				'telephone' => $telephone,
				'adresse' => $adresse,
				'cp' => $cp,
				'ville' => $ville,
				'boutiqueGeree' => $boutiqueGeree,
				'statut' => $statut,
				'login' => $login,
				'mdp' => $motdp
		));
		$dernierId = $bdd->lastInsertId();
		echo '<h4 class="goood">Le nouveau compte de '.$nom.' '.$prenom.' a bien été
		enregistré avec l\'identifiant '.$dernierId.'</h4>'; //Informe l'utilisateur que l'insertion c'est bien déroulé.
		// On libère la connexion du serveur pour d'autres requêtes :
		$insertion->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function suppTableauUser($suppCompte, $base, $hote, $utilisateur, $mdp) {
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		//On prépare la requète:
		$modification = $bdd->prepare('DELETE FROM compte WHERE id=:idCompte');
		//On envoie la requète avec les valeurs nécessaires:
		$modification->execute(array(
				'idCompte' => $suppCompte
		));

		// On libère la connexion du serveur pour d'autres requêtes :
		$modification->closeCursor();
		// On modifie l'auto-incremente pour que l'id de la prochaine personne ajouter suives les autres :
		autoInc($base, $hote, $utilisateur, $mdp, "compte");
		echo '<h4 class="goood">Le compte <i>numéro '.$suppCompte.'</i> a été supprimé.</h4>'; //Informe l'utilisateur que la suppresion c'est bien déroulé.
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

//Permet de demander à l'utilisateur de confirmer la suppression de la personne de la base de données.
echo '<script type=\'text/javascript\'>
function attentionUser(idEffacer, prenom, nom) {
	if( confirm(\'Etes-vous certain de vouloir effacer le compte de \'+prenom+\' \'+nom+\' ? \') )
	{
		location.href=\'gestionUtilisateur.php?suppCompte=\'+idEffacer;
	}
}
</script>';

function editTableauUser($editCompte, $base, $hote, $utilisateur, $mdp) {
	// Ici on édite la fiche d'une personne
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On prépare la requète:
		$reponse = $bdd->prepare('SELECT * FROM compte WHERE id = ? ');
		//On envoie la requète avec les valeurs nécessaires:
		$reponse->execute( array($editCompte) );

		$donnees = $reponse->fetch(); // Découpage ligne à ligne de $reponse (une seul ligne ici)
		// On libère la connexion du serveur pour d'autres requêtes :
		$reponse->closeCursor();

		//Formulaire d'édition d'une personne.
		?>
		<h2>Modification d'un compte</h2>
		<form class="gestion" method="post" action="gestionUtilisateur.php">
		<fieldset>
		<legend>Modification du compte numéro <b><?php echo $donnees['id']; ?></b></legend>
			<label>Nom :</label><input type="text" id="nom" name = "nom" value="<?php echo $donnees['nom']; ?>"/><br/><br/>
			<label>Prénom :</label><input type="text" id="prenom" name = "prenom" value="<?php echo $donnees['prenom']; ?>"/><br/><br/>
			<label>Mail :</label><input type="text" id="mail" name = "mail" value="<?php echo $donnees['mail']; ?>"/><br/><br/>
			<label>Téléphone :</label><input type="text" id="telephone" name = "telephone" value="<?php echo $donnees['telephone']; ?>"/><br/><br/>
			<label>Adresse :</label><input type="text" id="adresse" name = "adresse" value="<?php echo $donnees['adresse']; ?>"/><br/><br/>
			<label>CP :</label><input type="text" id="cp" name = "cp" value="<?php echo $donnees['cp']; ?>"/><br/><br/>
			<label>Ville :</label><input type="text" id="ville" name = "ville" value="<?php echo $donnees['ville']; ?>"/><br/><br/>
			<?php
			listBoutique($base, $hote, $utilisateur, $mdp, $donnees['boutiqueGeree']);
			?>
			<label>Statut :</label>
				<?php if($donnees['statut'] == "B"){ ?>
					<input type="radio" id="statut" name="statut" value="B" checked="checked"/>Administrateur de boutique
					<label> </label><input type="radio" id="statut" name="statut" value="G"/>Administrateur général
				<?php }else{ ?>
					<input type="radio" id="statut" name="statut" value="B"/>Administrateur de boutique
					<label> </label><input type="radio" id="statut" name="statut" value="G" checked="checked"/>Administrateur général
				<?php } ?>
			<br>
			<br>
			<label>Identifiant :</label><input type="text" id="login" name = "login" value="<?php echo $donnees['login']; ?>"/><br/><br/>
			<label>Mot de passe :</label><input type="text" id="mdp" name = "mdp" value="<?php echo $donnees['mdp']; ?>"/><br/><br/>
			
			<input type="hidden" name="hdIdCompte" id="hdIdCompte" 
			value=" <?php echo $donnees['id']; ?>" /> <!-- cette input "caché" permetra de récupérer plus tard dans $_POST l'id du compte -->
			<input name="effacerModif" type="reset" value="Effacer" />
			<input name="envoyerModif" type="submit" value="Envoyer" />
		</fieldset>
		</form>
		<?php
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function updateTableauUser($base, $hote, $utilisateur, $mdp, $nom, $prenom, $mail, $telephone, $adresse, $cp, $ville, $boutiqueGeree, $statut, $login, $motdp, $id) {
	//Sécurise en empéchant les commandes JavaScript
	$nom = htmlspecialchars($nom);
	$prenom = htmlspecialchars($prenom);
	$mail = $mail;
	$telephone = htmlspecialchars($telephone);
	$adresse = $adresse;
	$cp = $cp;
	$ville = htmlspecialchars($ville);
	$boutiqueGeree = htmlspecialchars($boutiqueGeree);
	$statut = $statut;
	$login = htmlspecialchars($login);
	$motdp = htmlspecialchars($motdp);
	$id = htmlspecialchars($id);

	// Ici on modifie un people
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On prépare la requète:
		$modification = $bdd->prepare('UPDATE compte SET nom = :nomCompte,
		prenom = :prenomCompte, mail = :mailCompte, telephone = :telephoneCompte,
		adresse = :adresseCompte, cp = :cpCompte, ville = :villeCompte,
		boutiqueGeree = :boutiqueGereeCompte, statut = :statutCompte,
		login = :loginCompte, mdp = :mdpCompte WHERE id = :idCompte');
		//On envoie la requète avec les valeurs nécessaires:
		$modification->execute(array(
				'nomCompte' => $nom,
				'prenomCompte' => $prenom,
				'mailCompte' => $mail,
				'telephoneCompte' => $telephone,
				'adresseCompte' => $adresse,
				'cpCompte' => $cp,
				'villeCompte' => $ville,
				'boutiqueGereeCompte' => $boutiqueGeree,
				'statutCompte' => $statut,
				'loginCompte' => $login,
				'mdpCompte' => $motdp,
				'idCompte' => $id
		));
		
		echo '<h4 class="goood">Les données à propos du compte '.$nom.' '.$prenom.' ont bien été mises à jour</h4>'; //Informe l'utilisateur que la modification c'est bien déroulé.
		// On libère la connexion du serveur pour d'autres requêtes :
		$modification->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Permet d'afficher le tableau des boutiques de la base de données.
function creaTableauBoutique ($tri, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponseBoutique = $bdd->query('SELECT * FROM boutique ORDER BY '.$tri.''); // Envoi de la requête
		$nb = $reponseBoutique->rowCount(); // Compte du nombre de lignes retournées
		$reponseHoraire;
		while ( $donnees = $reponseBoutique->fetch() ) // Découpage ligne à ligne de $reponse
		{
			$reponseHoraires = $bdd->query('SELECT * FROM horaires WHERE boutique_id = '.$donnees['id'].''); // Envoi de la requête
			$donneesHoraires = $reponseHoraires->fetch();
			echo '<table class="gestion">'; // Déclaration d'un tableau et de sa ligne d'en-tête
			echo '<tr><th class="noBorder"></th><th>NUMERO</th><th>RUE</th><th>CODE POSTAL</th><th>VILLE</th><th>FICHIER D\'IMAGE</th><th>TELEPHONE</th></tr>';
			echo '<tr>';
			echo '<td class="noBorder"></td>';
			echo '<td class="c1">'.$donnees['id'].'</td>';
			echo '<td class="c1">'.$donnees['rue'].'</td>';
			echo '<td class="c1">'.$donnees['cp'].'</td>';
			echo '<td class="c1">'.$donnees['ville'].'</td>';
			echo '<td class="c1">'.$donnees['image'].'</td>';
			echo '<td class="c1">'.$donnees['telephone'].'</td>';
			//Si l'utilisateur est administrateur, le possibilité de modifier ou de supprimer un compte lui est offerte.
			//if($_SESSION['statPeople'] == "A"){
			//Modification
			echo '<td rowspan="2" class="c1">
				<input type="image" id="editBoutique" name="editBoutique" src="img/edit.png"
				onclick="location.href=\'gestionBoutiques.php?editBoutique='
					.$donnees['id'].'\'"/></td>';
				
			//Suppresion
			echo '<td rowspan="2" class="c1">
					<input type="image" id="suppBoutique" name="suppBoutique" src="img/icon_suppr.gif"
					onclick="attentionBoutique('.$donnees['id'].', \''.$donnees['ville'].'\');"/></td>';
			
			echo '</tr>';
				
			echo '<th>HORAIRES';
			echo'<td class="c1" colspan=6>
			<table class="horaire">
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
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['lundi_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['lundi_matin_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['mardi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['mardi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['mercredi_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['mercredi_matin_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['jeudi_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['jeudi_matin_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['vendredi_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['vendredi_matin_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['samedi_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['samedi_matin_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['dimanche_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['dimanche_matin_fin'].'</p></th>
				</tr>
				<tr>
					<th class="boutinfos" rowspan = "1">Après-midi</th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['lundi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['lundi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['mardi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['mardi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['mercredi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['mercredi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['jeudi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['jeudi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['vendredi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['vendredi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['samedi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['samedi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><p class = "horaire">'.$donneesHoraires['dimanche_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['dimanche_apres_fin'].'</p></th>
												
			</tr>
			</table>
			</th>
			';
			echo '</table>'; // Fin du tableau
			echo '<br><br><br>';
			$reponseHoraires->closeCursor();

			//Si l'utilisateur est administrateur, le possibilité de modifier ou de supprimer une boutique lui est offerte.
			//if($_SESSION['statPeople'] == "A"){
			//Modification
			/*
			echo '<td class="c1">
				<input class="form" type="image" id="editCompte" name="editCompte" src="img/edit.png"
				onclick="location.href=\'test.php?editCompte='
					.$donnees['id'].'\'"/></td>';

			//Suppresion
			echo '<td class="c1">
					<input class="form" type="image" id="suppCompte" name="suppCompte" src="img/icon_suppr.gif"
					onclick="attention('.$donnees['id'].', \''.$donnees['prenom'].'\',
					\''.$donnees['nom'].'\');"/></td>';
			echo '</tr>';
			//}
			*/
		}
		echo '<p>Il y a '.$nb.' boutiques.</p>'; // Affichade du compte des lignes
		// On libère la connexion du serveur pour d'autres requêtes :
		$reponseBoutique->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function insertTableauBoutique($base, $hote, $utilisateur, $mdp, $rue, $cp, $ville, $image, $telephone,
		$lundi_matin_debut, $lundi_matin_fin, $lundi_apres_debut, $lundi_apres_fin,
		$mardi_matin_debut, $mardi_matin_fin, $mardi_apres_debut, $mardi_apres_fin,
		$mercredi_matin_debut, $mercredi_matin_fin, $mercredi_apres_debut, $mercredi_apres_fin,
		$jeudi_matin_debut, $jeudi_matin_fin, $jeudi_apres_debut, $jeudi_apres_fin,
		$vendredi_matin_debut, $vendredi_matin_fin, $vendredi_apres_debut, $vendredi_apres_fin,
		$samedi_matin_debut, $samedi_matin_fin, $samedi_apres_debut, $samedi_apres_fin,
		$dimanche_matin_debut, $dimanche_matin_fin, $dimanche_apres_debut, $dimanche_apres_fin){
	try{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On prépare la requète:
		$insertion = $bdd->prepare('INSERT INTO boutique (id, rue, cp, ville, image, telephone) VALUES (\'\', :rue, :cp, :ville, :image, :telephone)');
		//On envoie la requète avec les valeurs nécessaires:
		$insertion->execute(array(
				'rue' => $rue,
				'cp' => $cp,
				'ville' => $ville,
				'image' => $image,
				'telephone' => $telephone
		));
		$dernierId = $bdd->lastInsertId();
		// On libère la connexion du serveur pour d'autres requêtes :
		$insertion->closeCursor();

		//On prépare la requète:
		$insertion = $bdd->prepare('INSERT INTO horaires (boutique_id, lundi_matin_debut, lundi_matin_fin, lundi_apres_debut, lundi_apres_fin,
										mardi_matin_debut, mardi_matin_fin, mardi_apres_debut, mardi_apres_fin,
										mercredi_matin_debut, mercredi_matin_fin, mercredi_apres_debut, mercredi_apres_fin,
										jeudi_matin_debut, jeudi_matin_fin, jeudi_apres_debut, jeudi_apres_fin,
										vendredi_matin_debut, vendredi_matin_fin, vendredi_apres_debut, vendredi_apres_fin,
										samedi_matin_debut, samedi_matin_fin, samedi_apres_debut, samedi_apres_fin,
										dimanche_matin_debut, dimanche_matin_fin, dimanche_apres_debut, dimanche_apres_fin)
									VALUES (:boutique_id, :lundi_matin_debut, :lundi_matin_fin, :lundi_apres_debut, :lundi_apres_fin,
											:mardi_matin_debut, :mardi_matin_fin, :mardi_apres_debut, :mardi_apres_fin,
											:mercredi_matin_debut, :mercredi_matin_fin, :mercredi_apres_debut, :mercredi_apres_fin,
											:jeudi_matin_debut, :jeudi_matin_fin, :jeudi_apres_debut, :jeudi_apres_fin,
											:vendredi_matin_debut, :vendredi_matin_fin, :vendredi_apres_debut, :vendredi_apres_fin,
											:samedi_matin_debut, :samedi_matin_fin, :samedi_apres_debut, :samedi_apres_fin,
											:dimanche_matin_debut, :dimanche_matin_fin, :dimanche_apres_debut, :dimanche_apres_fin)');
		//On envoie la requète avec les valeurs nécessaires:
		$insertion->execute(array(
		 'boutique_id' => $dernierId, 
		 'lundi_matin_debut' => $lundi_matin_debut, 'lundi_matin_fin' => $lundi_matin_debut, 'lundi_apres_debut' => $lundi_apres_debut, 'lundi_apres_fin' => $lundi_apres_fin,
		 'mardi_matin_debut' => $mardi_matin_debut, 'mardi_matin_fin' => $mardi_matin_fin, 'mardi_apres_debut' => $mardi_apres_debut, 'mardi_apres_fin' => $mardi_apres_fin,
		 'mercredi_matin_debut' => $mercredi_matin_debut, 'mercredi_matin_fin' => $mercredi_matin_fin, 'mercredi_apres_debut' => $mercredi_apres_debut, 'mercredi_apres_fin' => $mercredi_apres_fin,
		 'jeudi_matin_debut' => $jeudi_matin_debut, 'jeudi_matin_fin' => $jeudi_matin_fin, 'jeudi_apres_debut' => $jeudi_apres_debut, 'jeudi_apres_fin' => $jeudi_apres_fin,
		 'vendredi_matin_debut' => $vendredi_matin_debut, 'vendredi_matin_fin' => $vendredi_matin_fin, 'vendredi_apres_debut' => $vendredi_apres_debut, 'vendredi_apres_fin' => $vendredi_apres_fin,
		 'samedi_matin_debut' => $samedi_matin_debut, 'samedi_matin_fin' => $samedi_matin_fin, 'samedi_apres_debut' => $samedi_apres_debut, 'samedi_apres_fin' => $samedi_apres_fin,
		 'dimanche_matin_debut' => $dimanche_matin_debut, 'dimanche_matin_fin' => $dimanche_matin_fin, 'dimanche_apres_debut' => $dimanche_apres_debut, 'dimanche_apres_fin' => $dimanche_apres_fin
		));
		// On libère la connexion du serveur pour d'autres requêtes :
		$insertion->closeCursor();

		echo '<h4 class="goood">La nouvelle boutique située à '.$ville.' a bien été
		enregistré avec l\'identifiant '.$dernierId.'</h4>'; //Informe l'utilisateur que l'insertion c'est bien déroulé.
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function suppTableauBoutique($suppBoutique, $base, $hote, $utilisateur, $mdp) {
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		//On prépare la requète:
		$modification = $bdd->prepare('DELETE FROM compte WHERE id=:idBoutique');
		//On envoie la requète avec les valeurs nécessaires:
		$modification->execute(array(
				'idBoutique' => $suppBoutique
		));

		// On libère la connexion du serveur pour d'autres requêtes :
		$modification->closeCursor();
		// On modifie l'auto-incremente pour que l'id de la prochaine boutiques ajouter suives les autres :
		autoInc($base, $hote, $utilisateur, $mdp, "boutique");
		echo '<h4 class="goood">La boutique <i>numéro '.$suppBoutique.'</i> a été supprimé.</h4>'; //Informe l'utilisateur que la suppresion c'est bien déroulé.
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

//Permet de demander à l'utilisateur de confirmer la suppression de la ville de la base de données.
echo '<script type=\'text/javascript\'>
function attentionBoutique(idEffacer, ville) {
	if( confirm(\'Etes-vous certain de vouloir effacer la ville de \'+ville+\' ? \') )
	{
		location.href=\'gestionBoutiques.php?suppBoutique=\'+idEffacer;
	}
}
</script>';

//Permet d'afficher le tableau des produits de la base de données.
function creaTableauProduit ($tri, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM produit ORDER BY '.$tri.''); // Envoi de la requête
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		echo '<table class="gestion">'; // Déclaration d'un tableau et de sa ligne d'en-tête
		echo '<tr><th>NUMERO</th><th>NOM</th><th>DESCRIPTION</th><th>DETAIL</th><th>PRIX</th>
		<th>FICHIER D\'IMAGE</th><th>CATEGORIE</th></tr>';
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
		{
			echo '<tr>'; // Une ligne appelle les données de $donnees['']
			echo '<td class="c1">'.$donnees['produit_id'].'</td>';
			echo '<td class="c1">'.$donnees['nom'].'</td>';
			echo '<td class="c1">'.$donnees['description'].'</td>';
			echo '<td class="c1">'.$donnees['detail'].'</td>';
			echo '<td class="c1">'.$donnees['prix'].'</td>';
			echo '<td class="c1">'.$donnees['image'].'</td>';
			echo '<td class="c1">'.$donnees['categorie'].'</td>';

			//Si l'utilisateur est administrateur, le possibilité de modifier ou de supprimer un compte lui est offerte.
			//if($_SESSION['statPeople'] == "A"){
			//Modification
			echo '<td class="c1">
				<input type="image" id="editProduit" name="editProduit" src="img/edit.png"
				onclick="location.href=\'gestionProduits.php?editProduit='
					.$donnees['produit_id'].'\'"/></td>';

			//Suppresion
			echo '<td class="c1">
					<input type="image" id="suppProduit" name="suppProduit" src="img/icon_suppr.gif"
					onclick="attentionProduit('.$donnees['produit_id'].', \''.$donnees['nom'].'\');"/></td>';
			echo '</tr>';
			//}
		}
		echo '</table>'; // Fin du tableau
		echo '<p>Il y a '.$nb.' produits.</p>'; // Affichade du compte des lignes
		// On libère la connexion du serveur pour d'autres requêtes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Permet d'ajouter un produit dans la base de données.
function insertTableauproduit($base, $hote, $utilisateur, $mdp, $nom, $description, $detail, $prix, $image, $categorie) {
	
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$reponse = $bdd->query('SELECT categorie_id FROM categorie WHERE libelle = "'.$categorie.'"');
		$donnees = $reponse->fetch();
		$categorie = $donnees['categorie_id'];
		$reponse->closeCursor();
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	
	echo'
		<h4>'.$nom.'</h4>
		<h4>'.$description.'</h4>
		<h4>'.$detail.'</h4>
		<h4>'.$prix.'</h4>
		<h4>'.$categorie.'</h4>
	';
	
	
	try{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On prépare la requète:
		$insertion = $bdd->prepare('INSERT INTO produit (produit_id, nom, description, detail, prix, image, categorie) VALUES (\'\', :nom, :description, :detail, :prix, :image, :categorie)');
		//On envoie la requète avec les valeurs nécessaires:
		$insertion->execute(array(
				'nom' => $nom,
				'description' => $description,
				'detail' => $detail,
				'prix' => $prix,
				'image' => $image,
				'categorie' => $categorie
		));
		$dernierId = $bdd->lastInsertId();
		echo '<h4 class="goood">Le nouveau produit '.$nom.' a bien été
		enregistré avec l\'identifiant '.$dernierId.'</h4>'; //Informe l'utilisateur que l'insertion c'est bien déroulé.
		// On libère la connexion du serveur pour d'autres requêtes :
		$insertion->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function suppTableauProduit($suppProduit, $base, $hote, $utilisateur, $mdp) {
	echo'<h4>'.$suppProduit.'</h4>';
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		//On prépare la requète:
		$modification = $bdd->prepare('DELETE FROM produit WHERE produit_id=:idProduit');
		//On envoie la requète avec les valeurs nécessaires:
		$modification->execute(array(
				'idProduit' => $suppProduit
		));

		// On libère la connexion du serveur pour d'autres requêtes :
		$modification->closeCursor();
		// On modifie l'auto-incremente pour que l'id de la prochaine personne ajouter suives les autres :
		autoInc($base, $hote, $utilisateur, $mdp, "produit");
		echo '<h4 class="goood">Le produit <i>numéro '.$suppProduit.'</i> a été supprimé.</h4>'; //Informe l'utilisateur que la suppresion c'est bien déroulé.
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

//Permet de demander à l'utilisateur de confirmer la suppression de la personne de la base de données.
echo '<script type=\'text/javascript\'>
function attentionProduit(idEffacer, nom) {
	if( confirm(\'Etes-vous certain de vouloir effacer le produit "\'+nom+\'" ? \') )
	{
		location.href=\'gestionProduits.php?suppProduit=\'+idEffacer;
	}
}
</script>';

function autoInc ($base, $hote, $utilisateur, $mdp, $table){
	$idName = "id";
	if($table == "produit"){
		$idName = "produit_id";
	}
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$reponse = $bdd->query('SELECT max('.$idName.')+1 AS maxID FROM '.$table.'');
		$donnees = $reponse->fetch();
		$autoInc = $bdd->query('ALTER TABLE '.$table.' AUTO_INCREMENT = '.$donnees['maxID'].'') ;
		$autoInc->closeCursor();
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

function listCategorie ($base, $hote, $utilisateur, $mdp){
try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM categorie'); // Envoi de la requête
		echo'<SELECT class="produitFilter" name="categorie" size="">';
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		while ( $donnees = $reponse->fetch() ) // Découpage ligne à ligne de $reponse
		{
				echo'
				<OPTION>';echo''.$donnees['libelle'].'';
		}
		echo'</SELECT>';
		// On libère la connexion du serveur pour d'autres requêtes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}