

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
				
				'; $cheminsImage=array('img/produits/'.pathinfo('img/produits/'.$donnees['image'], PATHINFO_FILENAME));
				//echo '<h4>';echo json_encode($cheminsImage);echo'</h4>';

					if (file_exists($cheminsImage[0].'-1'.'.jpg')) {
						array_push($cheminsImage, $cheminsImage[0].'-1');
						if (file_exists($cheminsImage[0].'-2'.'.jpg')) {
							array_push($cheminsImage, $cheminsImage[0].'-2');
						}
					}
					$nbImage=0;
					$Image=$cheminsImage[$nbImage].'.jpg';
					
				echo '<div class = "produitimg">
					<img id="imgp" class="detproduit" src="'.$Image.'"></img>
				</div>	
					<br>
				<div class = "produitminimg">
					';
				echo '</div>
					<br><br>
						
				<div class="produitdet">';	
				if (count($cheminsImage)!=1){									
					for ($i=0; $i<count($cheminsImage); $i++) {	
						echo '<img id="imgmin" class="imgmin" onClick="changeImage(\''.$cheminsImage[$i].'\')" src="'.$cheminsImage[$i].'.jpg">             ';
					}
				}	
				
				echo '<p class="detailproduitPrix">
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
function creaTableau($tri, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM compte ORDER BY '.$tri.''); // Envoi de la requête
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retournées
		echo '<table>'; // Déclaration d'un tableau et de sa ligne d'en-tête
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

function VerifId($log,$mdpSession,$base,$hote,$utilisateur,$mdp) {

	try {
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf8');

		$reponse = $bdd->query('SELECT * FROM compte');
		$nb = $reponse->rowCount();

		$isvalid=false;
		while (!$isvalid && $donnees = $reponse->fetch()) {
			if ($log == $donnees['login'] && $mdpSession == $donnees['mdp']) {
				$isvalid=true;
			}
		}
		return $isvalid;
	}

	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}

}

function session($log,$mdpSession,$base,$hote,$utilisateur,$mdp) {

	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf8');

		$reponse = $bdd->query('SELECT * FROM compte');
		$nb = $reponse->rowCount();


		session_start();


		$_SESSION['logCompte']=$log;

		while ($donnees = $reponse->fetch()) {
			if ($donnees['login'] == $log) {
				$_SESSION['statCompte']=$donnees['statut'];
			}
		}

	}

	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}

}?>