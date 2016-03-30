<?php

$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
	';
	
$page = "Acceuil";
include 'inc/titre.php';
include 'inc/fonction2.php';
	
echo '
	<body>
	';
include 'inc/border.php';

if(!isset($_SESSION['login'])){

if(isset($_POST['identifiant']) && !empty($_POST['identifiant']) && isset($_POST['mdp']) && !empty($_POST['mdp'])){
	if(verifLogin($_POST['identifiant'], $_POST['mdp'], $base, $hote, $utilisateur, $mdp)){
		echo'<meta http-equiv="refresh" content="0; URL=test.php">';
		exit;
	}
}

if(false){

echo '
	<div class = "content">
		
		<form class="connexion"; action="test.php" method="post">
			<fieldset class="connexion">
				<legend>Identifiez-vous</legend>
				<br>
				Identifiant : <input id="identifiant" class="input" name="identifiant" type="text" value="" size="50" />
				<br>
				<br>
				Mot de passe : <input id="mdp" class="input" name="mdp" type="text" value="" size="50" />
				<br>
				<br>
				<input class="produitFilter" type="submit" name="send"></input>
			</fieldset>
		</form>
		
	</div>	
';

}
echo '
	<div class = "content">
';
	creaTableau("id", $base, $hote, $utilisateur, $mdp);
echo'
	</div>
';

//Affiche le formulaire d'ajout de people
echo '<h2>Ajouter un compte</h2>';
echo '
	<form class="ajoutCompte" method="post" action="test.php">
		<fieldset>
			<label>Nom :</label><input type="text" id="nom" name = "nom" /><br/><br/>
			<label>Prénom :</label><input type="text" id="prenom" name = "prenom" /><br/><br/>
			<label>Mail :</label><input type="text" id="mail" name = "mail" /><br/><br/>
			<label>Téléphone :</label><input type="text" id="telephone" name = "telephone" /><br/><br/>
			<label>Adresse :</label><input type="text" id="adresse" name = "adresse" /><br/><br/>
			<label>CP :</label><input type="text" id="cp" name = "cp" /><br/><br/>
			<label>Ville :</label><input type="text" id="ville" name = "ville" /><br/><br/>
			<label>Gère la boutique n°</label><input type="text" id="boutiqueGeree" name = "boutiqueGeree" /><br/><br/>
			<label>Statut :</label>
					<input type="radio" id="statut" name="statut" value="U" checked="checked"/>Administrateur de boutique
					<input type="radio" id="statut" name="statut" value="A"/>Administrateur général
			<br>
			<br>
			<label>Identifiant :</label><input type="text" id="login" name = "login" /><br/><br/>
			<label>Mot de passe :</label><input type="text" id="mdp" name = "mdp" /><br/><br/>
			<input name="effacer" type="reset" value="Effacer" />
			<input name="envoyer" type="submit" value="Envoyer" />
		</fieldset>
	</form>
';

}

echo'</body>';

include 'inc/basPage.php';