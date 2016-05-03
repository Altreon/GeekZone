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
				onclick="location.href=\'test.php?editCompte='
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

//Permet de demander � l'utilisateur de confirmer la suppression de la personne de la base de donn�es.
echo '<script type=\'text/javascript\'>
function attention(idEffacer, prenom, nom) {
	if( confirm(\'Etes-vous certain de vouloir effacer le compte de \'+prenom+\' \'+nom+\' ? \') )
	{
		location.href=\'test.php?suppCompte=\'+idEffacer;
	}
}
</script>';

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
		$reponse = $bdd->query('SELECT * FROM boutique'); // Envoi de la requ�te
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

//Permet d'ajouter un compte dans la base de donn�es.
function insertTableau($base, $hote, $utilisateur, $mdp, $nom, $prenom, $mail, $telephone, $adresse, $cp, $ville, $boutiqueGeree, $statut, $login, $motdp) {
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

function suppTableau($suppCompte, $base, $hote, $utilisateur, $mdp) {
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
		autoInc($base, $hote, $utilisateur, $mdp);
		echo '<h4 class="goood">Le compte <i>num�ro '.$suppCompte.'</i> a �t� supprim�.</h4>'; //Informe l'utilisateur que la suppresion c'est bien d�roul�.
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

function autoInc ($base, $hote, $utilisateur, $mdp){
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE ] = PDO::ERRMODE_EXCEPTION ;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$reponse = $bdd->query('SELECT max(id)+1 AS maxID FROM compte');
		$donnees = $reponse->fetch();
		$autoInc = $bdd->query('ALTER TABLE compte AUTO_INCREMENT = '.$donnees['maxID'].'') ;
		$autoInc->closeCursor();
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

function editTableau($editCompte, $base, $hote, $utilisateur, $mdp) {
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
		<form class="ajoutCompte" method="post" action="test.php">
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

function updateTableau($base, $hote, $utilisateur, $mdp, $nom, $prenom, $mail, $telephone, $adresse, $cp, $ville, $boutiqueGeree, $statut, $login, $motdp, $id) {
	//S�curise en emp�chant les commandes JavaScript
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
	
	echo'<h4>'.$id.'</h4>';

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
		login = :loginCompte, mdp = :mdpCompte, WHERE id = :idCompte');
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
function creaTableauUser
($tri, $base, $hote, $utilisateur, $mdp) {
	try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
		$bdd->exec('SET NAMES utf16');
		$reponse = $bdd->query('SELECT * FROM compte ORDER BY '.$tri.''); // Envoi de la requ�te
		$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
		echo '<table>'; // D�claration d'un tableau et de sa ligne d'en-t�te
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
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$reponse->closeCursor();
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
		//On pr�pare la requ�te:
		$insertion = $bdd->prepare('INSERT INTO boutique (id, rue, cp, ville, image, telephone) VALUES (\'\', :rue, :cp, :ville, :image, :telephone)');
		//On envoie la requ�te avec les valeurs n�cessaires:
		$insertion->execute(array(
				'rue' => $rue,
				'cp' => $cp,
				'ville' => $ville,
				'image' => $image,
				'telephone' => $telephone
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
									VALUES (:lundi_matin_debut, :lundi_matin_fin, :lundi_apres_debut, :lundi_apres_fin,
											:mardi_matin_debut, :mardi_matin_fin, :mardi_apres_debut, :mardi_apres_fin,
											:mercredi_matin_debut, :mercredi_matin_fin, :mercredi_apres_debut, :mercredi_apres_fin,
											:jeudi_matin_debut, :jeudi_matin_fin, :jeudi_apres_debut, :jeudi_apres_fin,
											:vendredi_matin_debut, :vendredi_matin_fin, :vendredi_apres_debut, :vendredi_apres_fin,
											:samedi_matin_debut, :samedi_matin_fin, :samedi_apres_debut, :samedi_apres_fin,
											:dimanche_matin_debut, :dimanche_matin_fin, :dimanche_apres_debut, :dimanche_apres_fin)');
		//On envoie la requ�te avec les valeurs n�cessaires:
		/*$insertion->execute(array(
		 'lundi_matin_debut' => $lundi_matin_debut, 'lundi_matin_fin' => $lundi_matin_debut, 'lundi_apres_debut' => $lundi_apres_debut, 'lundi_apres_fin' => $lundi_apres_fin,
		 'mardi_matin_debut' => $mardi_matin_debut, 'mardi_matin_fin' => $mardi_matin_fin, 'mardi_apres_debut' => $mardi_apres_debut, 'mardi_apres_fin' => $mardi_apres_fin,
		 'mercredi_matin_debut' => $, 'mercredi_matin_fin' => $, 'mercredi_apres_debut' => $, 'mercredi_apres_fin' => $,
		 'jeudi_matin_debut' => $, 'jeudi_matin_fin' => $, 'jeudi_apres_debut' => $, 'jeudi_apres_fin' => $,
		 'vendredi_matin_debut' => $, 'vendredi_matin_fin' => $, 'vendredi_apres_debut' => $, 'vendredi_apres_fin' => $,
		 'samedi_matin_debut' => $, 'samedi_matin_fin' => $, 'samedi_apres_debut' => $, 'samedi_apres_fin' => $,
		 'dimanche_matin_debut' => $, 'dimanche_matin_fin' => $, 'dimanche_apres_debut' => $, 'dimanche_apres_fin' => $
		));*/
		$dernierId = $bdd->lastInsertId();
		// On lib�re la connexion du serveur pour d'autres requ�tes :
		$insertion->closeCursor();
		echo '<h4 class="goood">Le nouveau people '.$nom.' '.$prenom.' a bien �t�
		enregistr� avec l\'identifiant '.$dernierId.'</h4>'; //Informe l'utilisateur que l'insertion c'est bien d�roul�.
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
}



