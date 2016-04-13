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

if(isset($_POST['envoyerAjoutUser']) && !empty($_POST['envoyerAjout']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) &&isset($_POST['mail']) && !empty($_POST['mail']) &&isset($_POST['telephone']) && !empty($_POST['telephone']) && isset($_POST['adresse']) && !empty($_POST['adresse']) &&isset($_POST['cp']) && !empty($_POST['cp']) &&isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['boutiqueGeree']) && !empty($_POST['boutiqueGeree']) && isset($_POST['login']) && !empty($_POST['login']) &&isset($_POST['mdp']) && !empty($_POST['mdp'])){
	insertTableauUser($base, $hote, $utilisateur, $mdp, $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['telephone'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['boutiqueGeree'], $_POST['statut'], $_POST['login'], $_POST['mdp']);
}

if(isset($_POST['envoyerModifUser']) && !empty($_POST['envoyerModif']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) &&isset($_POST['mail']) && !empty($_POST['mail']) &&isset($_POST['telephone']) && !empty($_POST['telephone']) && isset($_POST['adresse']) && !empty($_POST['adresse']) &&isset($_POST['cp']) && !empty($_POST['cp']) &&isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['boutiqueGeree']) && !empty($_POST['boutiqueGeree']) && isset($_POST['statut']) && !empty($_POST['statut']) && isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['hdIdCompte']) && !empty($_POST['hdIdCompte'])){
	updateTableauUser($base, $hote, $utilisateur, $mdp, $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['telephone'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['boutiqueGeree'], $_POST['statut'], $_POST['login'], $_POST['mdp'], $_POST['hdIdCompte']);
}

if(isset($_GET['suppCompteUser']) && !empty($_GET['suppCompte'])){
	suppTableauUser($_GET['suppCompte'], $base, $hote, $utilisateur, $mdp);
}

creaTableauUser("id", $base, $hote, $utilisateur, $mdp);

if ( isset($_GET['editCompteUser']) && !empty($_GET['editCompte']) ) {
	editTableauUser($_GET['editCompte'], $base, $hote, $utilisateur, $mdp); //Affiche le formulaire d'édition d'une personne
}else{

//Affiche le formulaire d'ajout de people
echo '<h2>Ajouter un compte</h2>';
echo '
	<form class="gestion" method="post" action="test.php">
		<fieldset>
			<label>Nom :</label><input class="formGestion" type="text" id="nom" name = "nom" /><br/><br/>
			<label>Prénom :</label><input class="formGestion" type="text" id="prenom" name = "prenom" /><br/><br/>
			<label>Mail :</label><input class="formGestion" type="text" id="mail" name = "mail" /><br/><br/>
			<label>Téléphone :</label><input class="formGestion" type="text" id="telephone" name = "telephone" /><br/><br/>
			<label>Adresse :</label><input class="formGestion" type="text" id="adresse" name = "adresse" /><br/><br/>
			<label>CP :</label><input class="formGestion" type="text" id="cp" name = "cp" /><br/><br/>
			<label>Ville :</label><input class="formGestion" type="text" id="ville" name = "ville" /><br/><br/>
			';
			listBoutique($base, $hote, $utilisateur, $mdp, null);
			echo'
			<label>Statut :</label>
				<input type="radio" id="statut" name="statut" value="B" checked="checked"/>Administrateur de boutique
				<label> </label><input type="radio" id="statut" name="statut" value="G"/>Administrateur général
			<br>
			<br>
			<label>Identifiant :</label><input class="formGestion" type="text" id="login" name = "login" /><br/><br/>
			<label>Mot de passe :</label><input class="formGestion" type="text" id="mdp" name = "mdp" /><br/><br/>
			<input name="effacerAjout" type="reset" value="Effacer" />
			<input name="envoyerAjout" type="submit" value="Envoyer" />
		</fieldset>
	</form>
';

}
}
echo'
	</div>
';
echo'</body>';

include 'inc/basPage.php';