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