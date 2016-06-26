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
				
				
				<div class = "produitimg">
					<img class="detproduit" src="img/produits/'.$donnees['image'].'"></img>
				</div>			
					<br><br>
				<div class="produitdet">			
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
			$reponseHoraires = $bdd->query('SELECT * FROM horaires WHERE boutique_id = '.$donnees['id'].''); // Envoi de la requ�te
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
									if($donneesHoraires['lundi_matin_debut'] != "ferm�" && $donneesHoraires['lundi_matin_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['lundi_matin_debut'].' � '.$donneesHoraires['lundi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['mardi_matin_debut'] != "ferm�" && $donneesHoraires['mardi_matin_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['mardi_matin_debut'].' � '.$donneesHoraires['mardi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['mercredi_matin_debut'] != "ferm�" && $donneesHoraires['mercredi_matin_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['mercredi_matin_debut'].' � '.$donneesHoraires['mercredi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['jeudi_matin_debut'] != "ferm�" && $donneesHoraires['jeudi_matin_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['jeudi_matin_debut'].' � '.$donneesHoraires['jeudi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['vendredi_matin_debut'] != "ferm�" && $donneesHoraires['vendredi_matin_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['vendredi_matin_debut'].' � '.$donneesHoraires['vendredi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['samedi_matin_debut'] != "ferm�" && $donneesHoraires['samedi_matin_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['samedi_matin_debut'].' � '.$donneesHoraires['samedi_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['dimanche_matin_debut'] != "ferm�" && $donneesHoraires['dimanche_matin_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['dimanche_matin_debut'].' � '.$donneesHoraires['dimanche_matin_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
								echo'
								</tr>
								<tr>
									<th class="boutinfos" rowspan = "1">Apr�s-midi</th>';
									if($donneesHoraires['lundi_apres_debut'] != "ferm�" && $donneesHoraires['lundi_apres_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['lundi_apres_debut'].' � '.$donneesHoraires['lundi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['mardi_apres_debut'] != "ferm�" && $donneesHoraires['mardi_apres_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['mardi_apres_debut'].' � '.$donneesHoraires['mardi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['mercredi_apres_debut'] != "ferm�" && $donneesHoraires['mercredi_apres_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['mercredi_apres_debut'].' � '.$donneesHoraires['mercredi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['jeudi_apres_debut'] != "ferm�" && $donneesHoraires['jeudi_apres_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['jeudi_apres_debut'].' � '.$donneesHoraires['jeudi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['vendredi_apres_debut'] != "ferm�" && $donneesHoraires['vendredi_apres_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['vendredi_apres_debut'].' � '.$donneesHoraires['vendredi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['samedi_apres_debut'] != "ferm�" && $donneesHoraires['samedi_apres_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['samedi_apres_debut'].' � '.$donneesHoraires['samedi_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
									}
									if($donneesHoraires['dimanche_apres_debut'] != "ferm�" && $donneesHoraires['dimanche_apres_fin'] != "ferm�"){
										echo'<th class="boutinfos" rowspan = "1">de '.$donneesHoraires['dimanche_apres_debut'].' � '.$donneesHoraires['dimanche_apres_fin'].'</th>';
									}else{
										echo'<th class="boutinfos" rowspan = "1">Ferm�';
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
		// On lib�re la connexion du serveur pour d'autres requ�tes :
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
		$reponse = $bdd->query('SELECT * FROM boutique'); // Envoi de la requ�te
		while ( !$valide && $donnees = $reponse->fetch()) // D�coupage ligne � ligne de $reponse
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

//Permet d'afficher le tableau des comptes de la base de donn�es.
function creaTableau($tri, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM compte ORDER BY '.$tri.''); // Envoi de la requ�te
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
		echo '<table class="compte">'; // D�claration d'un tableau et de sa ligne d'en-t�te
		echo '<tr><th>NUMERO</th><th>NOM</th><th>PRENOM</th><th>MAIL</th><th>TELEPHONE</th>
		<th>ADRESSE</th><th>CP</th><th>VILLE</th><th>BOUTIQUE G�R�E</th><th>STATUT</th><th>LOGIN</th><th>MDP</th></tr>';
		while ( $donnees = $reponse->fetch() ) // D�coupage ligne � ligne de $reponse
		{
			echo '<tr>'; // Une ligne appelle les donn�es de $donnees['']
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
				
			//Si l'utilisateur est administrateur, le possibilit� de modifier ou de supprimer un compte lui est offerte.
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
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Perlet de lister les villes de la base de donn�es (!!! ancienne focntion !!!)
function listBoutique($base, $hote, $utilisateur, $mdp, $boutiqueGeree){
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf8');
		echo '<label>G�re la boutique de</label>';
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
		$reponse = $bdd->query('SELECT ville FROM boutique'); // Envoi de la requ�te
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
		
		echo '<br><hr><br><div class="boutList"><table>';
		
		while ( $donnees = $reponse->fetch() ) // D�coupage ligne � ligne de $reponse
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

function boutiqueListMap($base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM boutique'); // Envoi de la requ�te
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
	
		while ( $donnees = $reponse->fetch() ) // D�coupage ligne � ligne de $reponse
		{
			$x = $donnees['coordX']+50;
			$y = $donnees['coordY']+168+30;
			echo '<DIV STYLE="
 				position:absolute;
 		 		top:'.$y.';
 		 		left:'.$x.';
  			">
 		<a href="boutique.php?boutique='.$donnees['ville'].'"><img src="imgcedric/point.png" /></a>
			
 	</div>';
			
		}
	
	
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
		$reponse = $bdd->query('SELECT * FROM produit'); // Envoi de la requ�te
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es	
		
		
		if(isset($_GET['modifProd'])){
			echo '<form>
					<fieldset>
						<p class="details">Modification du produit n�'.$_GET['modifProd'].'<br/><br/>
								Nom: <input class="form" type="text" id="nom" name="nom" /><br/><br/>
								Description: <input class="form" type="text" id="desc" name="desc" /><br/><br/>
								Details: <input class="form" type="text" id="det" name="det" /><br/><br/>
								Prix: <input class="form" type="text" id="prix" name="prix" /><br/><br/>
								Image: <input class="form" type"text" id="img" name="img" /><br/><br/>
								N� Cat�gorie: <input class="form" type="text" id="cat" name="cat" /><br/><br/>
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
			$reponse = $bdd->query('SELECT * FROM boutique'); // Envoi de la requ�te
			$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
			
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
	$reponse = $bdd->query('SELECT * FROM produit'); // Envoi de la requ�te
	$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
	
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
	$reponse = $bdd->query('SELECT * FROM boutique'); // Envoi de la requ�te
	$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
	
	$bout=mt_rand(1,$nb);
	
	echo '<div class="produitaccalign">';
	while ( $donnees = $reponse->fetch() ) {
		if ($donnees['id'] == $bout) {
			echo '<h1 class="bvenue">Boutique de '.$donnees['ville'].'</h1>';
			echo '<div class="lienImage"><a href="boutique.php?boutique='.$donnees['ville'].'"><img class="boutique accueilBout" src="img/boutiques/'.$donnees['image'].'"></img></a></div>';
		}
	} echo '<br></div>';
}

//Permet d'afficher le tableau des comptes de la base de donn�es.
function creaTableauUser ($tri, $ordre, $base, $hote, $utilisateur, $mdp) {
	if ($tri == "numero") $tri="id";
	if ($tri == "code postal") $tri="cp";
	if ($tri == "boutique geree") $tri="boutiqueGeree";
	
	if ($ordre == "croissant") $ordre="asc";
	if ($ordre == "decroissant") $ordre="desc";
	
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM compte ORDER BY '.$tri.' '.$ordre.''); // Envoi de la requ�te
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
		echo '<table class="gestion">'; // D�claration d'un tableau et de sa ligne d'en-t�te
		echo '<tr><th>NUMERO</th><th>NOM</th><th>PRENOM</th><th>MAIL</th><th>TELEPHONE</th>
		<th>ADRESSE</th><th>CP</th><th>VILLE</th><th>BOUTIQUE G�R�E</th><th>STATUT</th><th>LOGIN</th><th>MDP</th></tr>';
		while ( $donnees = $reponse->fetch() ) // D�coupage ligne � ligne de $reponse
		{
			echo '<tr>'; // Une ligne appelle les donn�es de $donnees['']
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

			//Si l'utilisateur est administrateur, le possibilit� de modifier ou de supprimer un compte lui est offerte.
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
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Permet d'ajouter un compte dans la base de donn�es.
function insertTableauUser($base, $hote, $utilisateur, $mdp, $nom, $prenom, $mail, $telephone, $adresse, $cp, $ville, $boutiqueGeree, $statut, $login, $motdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$insertion = $bdd->prepare('INSERT INTO compte (id, nom, prenom, mail, telephone, adresse, cp, ville, boutiqueGeree, statut, login, mdp) VALUES (\'\', :nom, :prenom, :mail, :telephone, :adresse, :cp, :ville, :boutiqueGeree, :statut, :login, :mdp)');
		//On envoie la requ�te avec les valeurs n�cessaires:
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
		echo '<h4 class="goood">Le nouveau compte de '.$nom.' '.$prenom.' a bien �t�
		enregistr� avec l\'identifiant '.$dernierId.'</h4>'; //Informe l'utilisateur que l'insertion c'est bien d�roul�.
		// On lib�re la connexion du serveur pour d'autres requ�tes :
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
		//On pr�pare la requ�te:
		$modification = $bdd->prepare('DELETE FROM compte WHERE id=:idCompte');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$modification->execute(array(
				'idCompte' => $suppCompte
		));

		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$modification->closeCursor();
		// On modifie l'auto-incremente pour que l'id de la prochaine personne ajouter suives les autres :
		autoInc($base, $hote, $utilisateur, $mdp, "compte");
		echo '<h4 class="goood">Le compte <i>num�ro '.$suppCompte.'</i> a �t� supprim�.</h4>'; //Informe l'utilisateur que la suppresion c'est bien d�roul�.
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

//Permet de demander � l'utilisateur de confirmer la suppression de la personne de la base de donn�es.
echo '<script type=\'text/javascript\'>
function attentionUser(idEffacer, prenom, nom) {
	if( confirm(\'Etes-vous certain de vouloir effacer le compte de \'+prenom+\' \'+nom+\' ? \') )
	{
		location.href=\'gestionUtilisateur.php?suppCompte=\'+idEffacer;
	}
}
</script>';

function editTableauUser($editCompte, $base, $hote, $utilisateur, $mdp) {
	// Ici on �dite la fiche d'une personne
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$reponse = $bdd->prepare('SELECT * FROM compte WHERE id = ? ');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$reponse->execute( array($editCompte) );

		$donnees = $reponse->fetch(); // D�coupage ligne � ligne de $reponse (une seul ligne ici)
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();

		//Formulaire d'�dition d'une personne.
		?>
		<h2>Modification d'un compte</h2>
		<form class="gestion" method="post" action="gestionUtilisateur.php">
		<fieldset>
		<legend>Modification du compte num�ro <b><?php echo $donnees['id']; ?></b></legend>
			<label>Nom :</label><input type="text" id="nom" name = "nom" value="<?php echo $donnees['nom']; ?>"/><br/><br/>
			<label>Pr�nom :</label><input type="text" id="prenom" name = "prenom" value="<?php echo $donnees['prenom']; ?>"/><br/><br/>
			<label>Mail :</label><input type="text" id="mail" name = "mail" value="<?php echo $donnees['mail']; ?>"/><br/><br/>
			<label>T�l�phone :</label><input type="text" id="telephone" name = "telephone" value="<?php echo $donnees['telephone']; ?>"/><br/><br/>
			<label>Adresse :</label><input type="text" id="adresse" name = "adresse" value="<?php echo $donnees['adresse']; ?>"/><br/><br/>
			<label>CP :</label><input type="text" id="cp" name = "cp" value="<?php echo $donnees['cp']; ?>"/><br/><br/>
			<label>Ville :</label><input type="text" id="ville" name = "ville" value="<?php echo $donnees['ville']; ?>"/><br/><br/>
			<?php
			listBoutique($base, $hote, $utilisateur, $mdp, $donnees['boutiqueGeree']);
			?>
			<label>Statut :</label>
				<?php if($donnees['statut'] == "B"){ ?>
					<input type="radio" id="statut" name="statut" value="B" checked="checked"/>Administrateur de boutique
					<label>�</label><input type="radio" id="statut" name="statut" value="G"/>Administrateur g�n�ral
				<?php }else{ ?>
					<input type="radio" id="statut" name="statut" value="B"/>Administrateur de boutique
					<label>�</label><input type="radio" id="statut" name="statut" value="G" checked="checked"/>Administrateur g�n�ral
				<?php } ?>
			<br>
			<br>
			<label>Identifiant :</label><input type="text" id="login" name = "login" value="<?php echo $donnees['login']; ?>"/><br/><br/>
			<label>Mot de passe :</label><input type="text" id="mdp" name = "mdp" value="<?php echo $donnees['mdp']; ?>"/><br/><br/>
			
			<input type="hidden" name="hdIdCompte" id="hdIdCompte" 
			value=" <?php echo $donnees['id']; ?>" /> <!-- cette input "cach�" permetra de r�cup�rer plus tard dans $_POST l'id du compte -->
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
	//S�curise en emp�chant les commandes JavaScript
	$nom = htmlspecialchars($nom, ENT_COMPAT,'ISO-8859-1', true);
	$prenom = htmlspecialchars($prenom, ENT_COMPAT,'ISO-8859-1', true);
	$mail = htmlspecialchars($mail, ENT_COMPAT,'ISO-8859-1', true);
	$telephone = htmlspecialchars($telephone);
	$adresse = htmlspecialchars($adresse, ENT_COMPAT,'ISO-8859-1', true);
	$cp = htmlspecialchars($cp);
	$ville = htmlspecialchars($ville, ENT_COMPAT,'ISO-8859-1', true);
	$boutiqueGeree = htmlspecialchars($boutiqueGeree);
	$statut = htmlspecialchars($statut);
	$login = htmlspecialchars($login, ENT_COMPAT,'ISO-8859-1', true);
	$motdp = htmlspecialchars($motdp, ENT_COMPAT,'ISO-8859-1', true);
	$id = htmlspecialchars($id);

	// Ici on modifie un people
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$modification = $bdd->prepare('UPDATE compte SET nom = :nomCompte,
		prenom = :prenomCompte, mail = :mailCompte, telephone = :telephoneCompte,
		adresse = :adresseCompte, cp = :cpCompte, ville = :villeCompte,
		boutiqueGeree = :boutiqueGereeCompte, statut = :statutCompte,
		login = :loginCompte, mdp = :mdpCompte WHERE id = :idCompte');
		//On envoie la requ�te avec les valeurs n�cessaires:
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
		
		echo '<h4 class="goood">Les donn�es � propos du compte '.$nom.' '.$prenom.' ont bien �t� mises � jour</h4>'; //Informe l'utilisateur que la modification c'est bien d�roul�.
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$modification->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Permet d'afficher le tableau des boutiques de la base de donn�es.
function creaTableauBoutique ($tri, $ordre, $base, $hote, $utilisateur, $mdp) {
	if ($tri == "numero") $tri="id";
	if ($tri == "code postal") $tri="cp";
		
	if ($ordre == "croissant") $ordre="asc";
	if ($ordre == "decroissant") $ordre="desc";
	
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponseBoutique = $bdd->query('SELECT * FROM boutique ORDER BY '.$tri.' '.$ordre.''); // Envoi de la requ�te
		$nb = $reponseBoutique->rowCount(); // Compte du nombre de lignes retourn�es
		$reponseHoraire;
		while ( $donnees = $reponseBoutique->fetch() ) // D�coupage ligne � ligne de $reponse
		{
			$reponseHoraires = $bdd->query('SELECT * FROM horaires WHERE boutique_id = '.$donnees['id'].''); // Envoi de la requ�te
			$donneesHoraires = $reponseHoraires->fetch();
			echo '<table class="gestion">'; // D�claration d'un tableau et de sa ligne d'en-t�te
			echo '<tr><th class="noBorder"></th><th>NUMERO</th><th>RUE</th><th>CODE POSTAL</th><th>VILLE</th><th>FICHIER D\'IMAGE</th><th>TELEPHONE</th><th>COORDX</th><th>COORDY</th></tr>';
			echo '<tr>';
			echo '<td class="noBorder"></td>';
			echo '<td class="c1">'.$donnees['id'].'</td>';
			echo '<td class="c1">'.$donnees['rue'].'</td>';
			echo '<td class="c1">'.$donnees['cp'].'</td>';
			echo '<td class="c1">'.$donnees['ville'].'</td>';
			echo '<td class="c1">'.$donnees['image'].'</td>';
			echo '<td class="c1">'.$donnees['telephone'].'</td>';
			echo '<td class="c1">'.$donnees['coordX'].'</td>';
			echo '<td class="c1">'.$donnees['coordY'].'</td>';
			//Si l'utilisateur est administrateur, le possibilit� de modifier ou de supprimer un compte lui est offerte.
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
			echo'<td class="c1" colspan=8>
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
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['lundi_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['lundi_matin_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['mardi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['mardi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['mercredi_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['mercredi_matin_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['jeudi_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['jeudi_matin_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['vendredi_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['vendredi_matin_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['samedi_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['samedi_matin_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['dimanche_matin_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['dimanche_matin_fin'].'</p></th>
				</tr>
				<tr>
					<th class="boutinfos" rowspan = "1">Apr�s-midi</th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['lundi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['lundi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['mardi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['mardi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['mercredi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['mercredi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['jeudi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['jeudi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['vendredi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['vendredi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['samedi_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['samedi_apres_fin'].'</p></th>
					<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><p class = "horaire">'.$donneesHoraires['dimanche_apres_debut'].'</p>
														<label class="horaire">Fin:</label><p class = "horaire">'.$donneesHoraires['dimanche_apres_fin'].'</p></th>
												
			</tr>
			</table>
			</th>
			';
			echo '</table>'; // Fin du tableau
			echo '<br><br><br>';
			$reponseHoraires->closeCursor();

			//Si l'utilisateur est administrateur, le possibilit� de modifier ou de supprimer une boutique lui est offerte.
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
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponseBoutique->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function insertTableauBoutique($base, $hote, $utilisateur, $mdp, $rue, $cp, $ville, $image, $telephone, $coordX, $coordY,
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
		//On pr�pare la requ�te:
		$insertion = $bdd->prepare('INSERT INTO boutique (id, rue, cp, ville, image, telephone, coordX, coordY) VALUES (\'\', :rue, :cp, :ville, :image, :telephone, :coordX, :coordY)');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$insertion->execute(array(
				'rue' => $rue,
				'cp' => $cp,
				'ville' => $ville,
				'image' => $image,
				'telephone' => $telephone,
				'coordX' => $coordX,
				'coordY' => $coordY
		));
		$dernierId = $bdd->lastInsertId();
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$insertion->closeCursor();

		//On pr�pare la requ�te:
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
		//On envoie la requ�te avec les valeurs n�cessaires:
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
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$insertion->closeCursor();

		echo '<h4 class="goood">La nouvelle boutique situ�e � '.$ville.' a bien �t�
		enregistr� avec l\'identifiant '.$dernierId.'</h4>'; //Informe l'utilisateur que l'insertion c'est bien d�roul�.
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
		//On pr�pare la requ�te:
		$modification = $bdd->prepare('DELETE FROM boutique WHERE id=:idBoutique');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$modification->execute(array(
				'idBoutique' => $suppBoutique
		));

		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$modification->closeCursor();
		// On modifie l'auto-incremente pour que l'id de la prochaine boutiques ajouter suives les autres :
		autoInc($base, $hote, $utilisateur, $mdp, "boutique");
		echo '<h4 class="goood">La boutique <i>num�ro '.$suppBoutique.'</i> a �t� supprim�.</h4>'; //Informe l'utilisateur que la suppresion c'est bien d�roul�.
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

//Permet de demander � l'utilisateur de confirmer la suppression de la ville de la base de donn�es.
echo '<script type=\'text/javascript\'>
function attentionBoutique(idEffacer, ville) {
	if( confirm(\'Etes-vous certain de vouloir effacer la ville de \'+ville+\' ? \') )
	{
		location.href=\'gestionBoutiques.php?suppBoutique=\'+idEffacer;
	}
}
</script>';

function editTableauBoutique($editBoutique, $base, $hote, $utilisateur, $mdp){
	
	// Ici on �dite la fiche d'une boutique
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$reponse = $bdd->prepare('SELECT * FROM boutique WHERE id= ? ');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$reponse->execute( array($editBoutique) );

		$donnees = $reponse->fetch(); // D�coupage ligne � ligne de $reponse (une seul ligne ici)
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();
		
		$reponse = $bdd->prepare('SELECT * FROM horaires WHERE boutique_id= ? ');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$reponse->execute( array($editBoutique) );
		
		$donneesHoraires = $reponse->fetch(); // D�coupage ligne � ligne de $reponse (une seul ligne ici)
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();

		//Formulaire d'�dition d'une personne.
		?>
		<h2>Modification d'un boutique</h2>
		<form class="gestion boutique" method="post" action="gestionBoutiques.php">
		<fieldset>
		<legend>Modification du produit num�ro <b><?php echo $donnees['id']; ?></b></legend>
				<label>Rue :</label><input class="formGestion" type="text" id="rue" name = "rue" value="<?php echo $donnees['rue']; ?>"/><br/><br/>
				<label>CP :</label><input class="formGestion" type="text" id="cp" name = "cp" value="<?php echo $donnees['cp']; ?>"/><br/><br/>
				<label>Ville :</label><input class="formGestion" type="text" id="ville" name = "ville" value="<?php echo $donnees['ville']; ?>"/><br/><br/>
				<label>Nom du fichier image :</label><input class="formGestion" type="text" id="image" name = "image" value="<?php echo $donnees['image']; ?>"/><br/><br/>
				<label>T�l�phone :</label><input class="formGestion" type="text" id="telephone" name = "telephone" value="<?php echo $donnees['telephone']; ?>"/><br/><br/>
				<label>Coordonn�es sur la carte :</label><br/><br/>
			
				<div><?php
					include 'inc/franceEdit.inc.php';
					createCoord($donnees['coordX'], $donnees['coordY']);
				?></div>
			
				<label class="noFloat">Horaires :</label><br/><br/>
				
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
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="lundi_matin_debut" name = "lundi_matin_debut" value="<?php echo $donneesHoraires['lundi_matin_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="lundi_matin_fin" name = "lundi_matin_fin" value="<?php echo $donneesHoraires['lundi_matin_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="mardi_matin_debut" name = "mardi_matin_debut" value="<?php echo $donneesHoraires['mardi_matin_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="mardi_matin_fin" name = "mardi_matin_fin" value="<?php echo $donneesHoraires['mardi_matin_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="mercredi_matin_debut" name = "mercredi_matin_debut" value="<?php echo $donneesHoraires['mercredi_matin_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="mercredi_matin_fin" name = "mercredi_matin_fin" value="<?php echo $donneesHoraires['mercredi_matin_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="jeudi_matin_debut" name = "jeudi_matin_debut" value="<?php echo $donneesHoraires['jeudi_matin_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="jeudi_matin_fin" name = "jeudi_matin_fin" value="<?php echo $donneesHoraires['jeudi_matin_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="vendredi_matin_debut" name = "vendredi_matin_debut" value="<?php echo $donneesHoraires['vendredi_matin_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="vendredi_matin_fin" name = "vendredi_matin_fin" value="<?php echo $donneesHoraires['vendredi_matin_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="samedi_matin_debut" name = "samedi_matin_debut" value="<?php echo $donneesHoraires['samedi_matin_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="samedi_matin_fin" name = "samedi_matin_fin" value="<?php echo $donneesHoraires['samedi_matin_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="dimanche_matin_debut" name = "dimanche_matin_debut" value="<?php echo $donneesHoraires['dimanche_matin_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="dimanche_matin_fin" name = "dimanche_matin_fin" value="<?php echo $donneesHoraires['dimanche_matin_fin']; ?>"/></td>
					</tr>
					<tr>
						<th class="boutinfos" rowspan = "1">Apr�s-midi</th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="lundi_apres_debut" name = "lundi_apres_debut" value="<?php echo $donneesHoraires['lundi_apres_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="lundi_apres_fin" name = "lundi_apres_fin" value="<?php echo $donneesHoraires['lundi_apres_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="mardi_apres_debut" name = "mardi_apres_debut" value="<?php echo $donneesHoraires['mardi_apres_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="mardi_apres_fin" name = "mardi_apres_fin" value="<?php echo $donneesHoraires['mardi_apres_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="mercredi_apres_debut" name = "mercredi_apres_debut" value="<?php echo $donneesHoraires['mercredi_apres_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="mercredi_apres_fin" name = "mercredi_apres_fin" value="<?php echo $donneesHoraires['mercredi_apres_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="jeudi_apres_debut" name = "jeudi_apres_debut" value="<?php echo $donneesHoraires['jeudi_apres_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="jeudi_apres_fin" name = "jeudi_apres_fin" value="<?php echo $donneesHoraires['jeudi_apres_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="vendredi_apres_debut" name = "vendredi_apres_debut" value="<?php echo $donneesHoraires['vendredi_apres_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="vendredi_apres_fin" name = "vendredi_apres_fin" value="<?php echo $donneesHoraires['vendredi_apres_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="samedi_apres_debut" name = "samedi_apres_debut" value="<?php echo $donneesHoraires['samedi_apres_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="samedi_apres_fin" name = "samedi_apres_fin" value="<?php echo $donneesHoraires['samedi_apres_fin']; ?>"/></td>
						<td class="boutinfos" rowspan = "1"><label class="horaire">D�but:</label><input class="horaire" type="text" id="dimanche_apres_debut" name = "dimanche_apres_debut" value="<?php echo $donneesHoraires['dimanche_apres_debut']; ?>"/><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="dimanche_apres_fin" name = "dimanche_apres_fin" value="<?php echo $donneesHoraires['dimanche_apres_fin']; ?>"/></td>
					</tr>
				</table>
			<input type="hidden" name="hdIdBoutique" id="hdIdBoutique" 
			value=" <?php echo $donnees['id']; ?>" /> <!-- cette input "cach�" permetra de r�cup�rer plus tard dans $_POST l'id du produit -->
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

function updateTableauBoutique($base, $hote, $utilisateur, $mdp, $rue, $cp, $ville, $image, $telephone, $coordX, $coordY, $id,
		$lundi_matin_debut, $lundi_matin_fin, $lundi_apres_debut, $lundi_apres_fin,
		$mardi_matin_debut, $mardi_matin_fin, $mardi_apres_debut, $mardi_apres_fin,
		$mercredi_matin_debut, $mercredi_matin_fin, $mercredi_apres_debut, $mercredi_apres_fin,
		$jeudi_matin_debut, $jeudi_matin_fin, $jeudi_apres_debut, $jeudi_apres_fin,
		$vendredi_matin_debut, $vendredi_matin_fin, $vendredi_apres_debut, $vendredi_apres_fin,
		$samedi_matin_debut, $samedi_matin_fin, $samedi_apres_debut, $samedi_apres_fin,
		$dimanche_matin_debut, $dimanche_matin_fin, $dimanche_apres_debut, $dimanche_apres_fin){
		
	//S�curise en emp�chant les commandes JavaScript
	$rue = htmlspecialchars($rue, ENT_COMPAT,'ISO-8859-1', true);
	$cp = htmlspecialchars($cp);
	$ville = htmlspecialchars($ville , ENT_COMPAT,'ISO-8859-1', true);
	$image = htmlspecialchars($image);
	$telephone = htmlspecialchars($telephone);
	$coordX = htmlspecialchars($coordX);
	$coordY = htmlspecialchars($coordY);
	$id = $id;

	// Ici on modifie un produit
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$modification = $bdd->prepare('UPDATE boutique SET rue = :rueBoutique,
		cp = :cpBoutique, ville = :villeBoutique, image = :imageBoutique, telephone = :telephoneBoutique, 
		coordX = :coordXBoutique, coordY = :coordYBoutique WHERE id = :idBoutique');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$modification->execute(array(
				'rueBoutique' => $rue,
				'cpBoutique' => $cp,
				'villeBoutique' => $ville,
				'imageBoutique' => $image,
				'telephoneBoutique' => $telephone,
				'coordXBoutique' => $coordX,
				'coordYBoutique' => $coordY,
				'idBoutique' => $id
		));
		
		echo '<h4 class="goood">Les donn�es � propos de la boutique de '.$ville.' ont bien �t� mises � jour</h4>'; //Informe l'utilisateur que la modification c'est bien d�roul�.
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$modification->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Permet d'afficher le tableau des produits de la base de donn�es.
function creaTableauProduit ($tri, $ordre, $base, $hote, $utilisateur, $mdp) {
	if ($tri == "numero") $tri="produit_id";
	
	if ($ordre == "croissant") $ordre="asc";
	if ($ordre == "decroissant") $ordre="desc";
	
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM produit ORDER BY '.$tri.' '.$ordre.''); // Envoi de la requ�te
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
		echo '<table class="gestion">'; // D�claration d'un tableau et de sa ligne d'en-t�te
		echo '<tr><th>NUMERO</th><th>NOM</th><th>DESCRIPTION</th><th>DETAIL</th><th>PRIX</th>
		<th>FICHIER D\'IMAGE</th><th>CATEGORIE</th></tr>';
		while ( $donnees = $reponse->fetch() ) // D�coupage ligne � ligne de $reponse
		{
			echo '<tr>'; // Une ligne appelle les donn�es de $donnees['']
			echo '<td class="c1">'.$donnees['produit_id'].'</td>';
			echo '<td class="c1">'.$donnees['nom'].'</td>';
			echo '<td class="c1">'.$donnees['description'].'</td>';
			echo '<td class="c1">'.$donnees['detail'].'</td>';
			echo '<td class="c1">'.$donnees['prix'].'</td>';
			echo '<td class="c1">'.$donnees['image'].'</td>';
			echo '<td class="c1">'.$donnees['categorie'].'</td>';

			//Si l'utilisateur est administrateur, le possibilit� de modifier ou de supprimer un compte lui est offerte.
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
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Permet d'ajouter un produit dans la base de donn�es.
function insertTableauproduit($base, $hote, $utilisateur, $mdp, $nom, $description, $detail, $prix, $image, $categorie) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$insertion = $bdd->prepare('INSERT INTO produit (produit_id, nom, description, detail, prix, image, categorie) VALUES (\'\', :nom, :description, :detail, :prix, :image, :categorie)');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$insertion->execute(array(
				'nom' => $nom,
				'description' => $description,
				'detail' => $detail,
				'prix' => $prix,
				'image' => $image,
				'categorie' => $categorie
		));
		$dernierId = $bdd->lastInsertId();
		echo '<h4 class="goood">Le nouveau produit '.$nom.' a bien �t�
		enregistr� avec l\'identifiant '.$dernierId.'</h4>'; //Informe l'utilisateur que l'insertion c'est bien d�roul�.
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$insertion->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function suppTableauProduit($suppProduit, $base, $hote, $utilisateur, $mdp) {
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		//On pr�pare la requ�te:
		$modification = $bdd->prepare('DELETE FROM produit WHERE produit_id=:idProduit');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$modification->execute(array(
				'idProduit' => $suppProduit
		));

		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$modification->closeCursor();
		// On modifie l'auto-incremente pour que l'id de la prochaine personne ajouter suives les autres :
		autoInc($base, $hote, $utilisateur, $mdp, "produit");
		echo '<h4 class="goood">Le produit <i>num�ro '.$suppProduit.'</i> a �t� supprim�.</h4>'; //Informe l'utilisateur que la suppresion c'est bien d�roul�.
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

//Permet de demander � l'utilisateur de confirmer la suppression de la personne de la base de donn�es.
echo '<script type=\'text/javascript\'>
function attentionProduit(idEffacer, nom) {
	if( confirm(\'Etes-vous certain de vouloir effacer le produit "\'+nom+\'" ? \') )
	{
		location.href=\'gestionProduits.php?suppProduit=\'+idEffacer;
	}
}
</script>';

function editTableauProduit($editProduit, $base, $hote, $utilisateur, $mdp) {
	// Ici on �dite la fiche d'un produit
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$reponse = $bdd->prepare('SELECT * FROM produit WHERE produit_id= ? ');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$reponse->execute( array($editProduit) );

		$donnees = $reponse->fetch(); // D�coupage ligne � ligne de $reponse (une seul ligne ici)
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();

		//Formulaire d'�dition d'une personne.
		?>
		<h2>Modification d'un compte</h2>
		<form class="gestion" method="post" action="gestionProduits.php">
		<fieldset>
		<legend>Modification du produit num�ro <b><?php echo $donnees['produit_id']; ?></b></legend>
			<label>Nom :</label><input class="formGestion" type="text" id="nom" name = "nom" value="<?php echo $donnees['nom']; ?>"/><br/><br/>
			<label>Description :</label><textarea id="description"  name="description"><?php echo $donnees['description']; ?></textarea><br/><br/>
			<label>D�tail :</label><textarea id="detail" name="detail"><?php echo $donnees['detail']; ?></textarea><br/><br/>
			<label>Prix :</label><input class="formGestion" type="text" id="prix" name = "prix" value="<?php echo $donnees['prix']; ?>"/>  �<br/><br/>
			<label>Nom du fichier image :</label><input class="formGestion" type="text" id="image" name = "image" value="<?php echo $donnees['image']; ?>"/><br/><br/>
			<label>Cat�gorie :</label>
			<?php
			listCategorie($base, $hote, $utilisateur, $mdp, $donnees['categorie']);
			?>
			<input type="hidden" name="hdIdProduit" id="hdIdProduit" 
			value=" <?php echo $donnees['produit_id']; ?>" /> <!-- cette input "cach�" permetra de r�cup�rer plus tard dans $_POST l'id du produit -->
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

function updateTableauProduit($base, $hote, $utilisateur, $mdp, $nom, $description, $detail, $prix, $image, $categorie, $id) {
	//S�curise en emp�chant les commandes JavaScript
	$nom = htmlspecialchars($nom, ENT_COMPAT,'ISO-8859-1', true);
	$vdescription = htmlspecialchars($description, ENT_COMPAT,'ISO-8859-1', true);
	$detail = htmlspecialchars($detail, ENT_COMPAT,'ISO-8859-1', true);
	$prix = $prix;
	$image = htmlspecialchars($image);
	$categorie = $categorie;
	$id = $id;

	// Ici on modifie un produit
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$modification = $bdd->prepare('UPDATE produit SET nom = :nomProduit,
		description = :descriptionProduit, detail = :detailProduit, prix = :prixProduit,
		image = :imageProduit, categorie = :categorieProduit WHERE produit_id = :idProduit');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$modification->execute(array(
				'nomProduit' => $nom,
				'descriptionProduit' => $description,
				'detailProduit' => $detail,
				'prixProduit' => $prix,
				'imageProduit' => $image,
				'categorieProduit' => $categorie,
				'idProduit' => $id
		));
		
		echo '<h4 class="goood">Les donn�es � propos du produit '.$nom.' ont bien �t� mises � jour</h4>'; //Informe l'utilisateur que la modification c'est bien d�roul�.
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$modification->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Permet d'afficher le tableau des produits de la base de donn�es.
function creaTableauCategorie ($tri, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM produit ORDER BY '.$tri.''); // Envoi de la requ�te
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
		echo '<table class="gestion">'; // D�claration d'un tableau et de sa ligne d'en-t�te
		echo '<tr><th>NUMERO</th><th>NOM</th><th>DESCRIPTION</th><th>DETAIL</th><th>PRIX</th>
		<th>FICHIER D\'IMAGE</th><th>CATEGORIE</th></tr>';
		while ( $donnees = $reponse->fetch() ) // D�coupage ligne � ligne de $reponse
		{
			echo '<tr>'; // Une ligne appelle les donn�es de $donnees['']
			echo '<td class="c1">'.$donnees['produit_id'].'</td>';
			echo '<td class="c1">'.$donnees['nom'].'</td>';
			echo '<td class="c1">'.$donnees['description'].'</td>';
			echo '<td class="c1">'.$donnees['detail'].'</td>';
			echo '<td class="c1">'.$donnees['prix'].'</td>';
			echo '<td class="c1">'.$donnees['image'].'</td>';
			echo '<td class="c1">'.$donnees['categorie'].'</td>';

			//Si l'utilisateur est administrateur, le possibilit� de modifier ou de supprimer un compte lui est offerte.
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
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

//Permet d'ajouter un produit dans la base de donn�es.
function insertTableauCategorie($base, $hote, $utilisateur, $mdp, $libelle) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$insertion = $bdd->prepare('INSERT INTO categorie (categorie_id, libelle) VALUES (\'\', :libelle)');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$insertion->execute(array(
				'libelle' => $libelle,
		));
		$dernierId = $bdd->lastInsertId();
		echo '<h4 class="goood">La nouvelle cat�gorie de produit "'.$libelle.'" a bien �t�
		enregistr� avec l\'identifiant '.$dernierId.'</h4>'; //Informe l'utilisateur que l'insertion c'est bien d�roul�.
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$insertion->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

function suppTableauCategorie($suppCategorie, $base, $hote, $utilisateur, $mdp) {
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		//On pr�pare la requ�te:
		$modification = $bdd->prepare('DELETE FROM categorie WHERE categorie_id=:idCategorie');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$modification->execute(array(
				'idCategorie' => $suppCategorie
		));

		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$modification->closeCursor();
		// On modifie l'auto-incremente pour que l'id de la prochaine personne ajouter suives les autres :
		autoInc($base, $hote, $utilisateur, $mdp, "categorie");
		echo '<h4 class="goood">La cat�gorie <i>num�ro '.$suppCategorie.'</i> a �t� supprim�.</h4>'; //Informe l'utilisateur que la suppresion c'est bien d�roul�.
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

//Permet de demander � l'utilisateur de confirmer la suppression de la personne de la base de donn�es.
echo '<script type=\'text/javascript\'>
function attentionProduit(idEffacer, libelle) {
	if( confirm(\'Etes-vous certain de vouloir effacer la categorie "\'+libelle+\'" ? \') )
	{
		location.href=\'gestionProduits.php?suppCategorie=\'+idEffacer;
	}
}
</script>';

function editTableauCategorie($editProduit, $base, $hote, $utilisateur, $mdp) {
	// Ici on �dite la fiche d'un produit
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$reponse = $bdd->prepare('SELECT * FROM produit WHERE produit_id= ? ');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$reponse->execute( array($editProduit) );

		$donnees = $reponse->fetch(); // D�coupage ligne � ligne de $reponse (une seul ligne ici)
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();

		//Formulaire d'�dition d'une personne.
		?>
		<h2>Modification d'un compte</h2>
		<form class="gestion" method="post" action="gestionProduits.php">
		<fieldset>
		<legend>Modification du produit num�ro <b><?php echo $donnees['produit_id']; ?></b></legend>
			<label>Nom :</label><input class="formGestion" type="text" id="nom" name = "nom" value="<?php echo $donnees['nom']; ?>"/><br/><br/>
			<label>Description :</label><textarea id="description"  name="description"><?php echo $donnees['description']; ?></textarea><br/><br/>
			<label>D�tail :</label><textarea id="detail" name="detail"><?php echo $donnees['detail']; ?></textarea><br/><br/>
			<label>Prix :</label><input class="formGestion" type="text" id="prix" name = "prix" value="<?php echo $donnees['prix']; ?>"/>  �<br/><br/>
			<label>Nom du fichier image :</label><input class="formGestion" type="text" id="image" name = "image" value="<?php echo $donnees['image']; ?>"/><br/><br/>
			<label>Cat�gorie :</label>
			<?php
			listCategorie($base, $hote, $utilisateur, $mdp, $donnees['categorie']);
			?>
			<input type="hidden" name="hdIdProduit" id="hdIdProduit" 
			value=" <?php echo $donnees['produit_id']; ?>" /> <!-- cette input "cach�" permetra de r�cup�rer plus tard dans $_POST l'id du produit -->
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

function updateTableauCategorie($base, $hote, $utilisateur, $mdp, $nom, $description, $detail, $prix, $image, $categorie, $id) {
	//S�curise en emp�chant les commandes JavaScript
	$nom = htmlspecialchars($nom, ENT_COMPAT,'ISO-8859-1', true);
	$vdescription = htmlspecialchars($description, ENT_COMPAT,'ISO-8859-1', true);
	$detail = htmlspecialchars($detail, ENT_COMPAT,'ISO-8859-1', true);
	$prix = $prix;
	$image = htmlspecialchars($image);
	$categorie = $categorie;
	$id = $id;

	// Ici on modifie un produit
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		//On pr�pare la requ�te:
		$modification = $bdd->prepare('UPDATE produit SET nom = :nomProduit,
		description = :descriptionProduit, detail = :detailProduit, prix = :prixProduit,
		image = :imageProduit, categorie = :categorieProduit WHERE produit_id = :idProduit');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$modification->execute(array(
				'nomProduit' => $nom,
				'descriptionProduit' => $description,
				'detailProduit' => $detail,
				'prixProduit' => $prix,
				'imageProduit' => $image,
				'categorieProduit' => $categorie,
				'idProduit' => $id
		));
		
		echo '<h4 class="goood">Les donn�es � propos du produit '.$nom.' ont bien �t� mises � jour</h4>'; //Informe l'utilisateur que la modification c'est bien d�roul�.
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$modification->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}

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

function listCategorie ($base, $hote, $utilisateur, $mdp, $categorie){
try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM categorie'); // Envoi de la requ�te
		echo'<SELECT class="produitFilter" name="categorie" size="">';
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
		while ( $donnees = $reponse->fetch() ) // D�coupage ligne � ligne de $reponse
		{
			//A v�rifier
			if($categorie != null && $categorie == $donnees['categorie_id']) {
				echo'<OPTION value="';echo''.$donnees['categorie_id'].'" checked="checked">';echo''.$donnees['libelle'].'';
			}else{
				echo'<OPTION value="';echo''.$donnees['categorie_id'].'">';echo''.$donnees['libelle'].'';
			}
		}
		echo'</SELECT>';
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}