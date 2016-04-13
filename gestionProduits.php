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
 
echo '
	<div class = "content">
';

if(isset($_POST['envoyerAjoutProduit']) && !empty($_POST['envoyerAjout']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) &&isset($_POST['mail']) && !empty($_POST['mail']) &&isset($_POST['telephone']) && !empty($_POST['telephone']) && isset($_POST['adresse']) && !empty($_POST['adresse']) &&isset($_POST['cp']) && !empty($_POST['cp']) &&isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['boutiqueGeree']) && !empty($_POST['boutiqueGeree']) && isset($_POST['login']) && !empty($_POST['login']) &&isset($_POST['mdp']) && !empty($_POST['mdp'])){
	insertTableauUser($base, $hote, $utilisateur, $mdp, $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['telephone'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['boutiqueGeree'], $_POST['statut'], $_POST['login'], $_POST['mdp']);
}

if(isset($_POST['envoyerModifProduit']) && !empty($_POST['envoyerModif']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) &&isset($_POST['mail']) && !empty($_POST['mail']) &&isset($_POST['telephone']) && !empty($_POST['telephone']) && isset($_POST['adresse']) && !empty($_POST['adresse']) &&isset($_POST['cp']) && !empty($_POST['cp']) &&isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['boutiqueGeree']) && !empty($_POST['boutiqueGeree']) && isset($_POST['statut']) && !empty($_POST['statut']) && isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['hdIdCompte']) && !empty($_POST['hdIdCompte'])){
	updateTableauUser($base, $hote, $utilisateur, $mdp, $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['telephone'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['boutiqueGeree'], $_POST['statut'], $_POST['login'], $_POST['mdp'], $_POST['hdIdCompte']);
}

if(isset($_GET['suppCompteProduit']) && !empty($_GET['suppCompte'])){
	suppTableauUser($_GET['suppProduit'], $base, $hote, $utilisateur, $mdp);
}

//creaTableauProduit("id", $base, $hote, $utilisateur, $mdp);

if ( isset($_GET['editCompteProduit']) && !empty($_GET['editCompte']) ) {
	editTableauUser($_GET['editProduit'], $base, $hote, $utilisateur, $mdp); //Affiche le formulaire d'édition d'une personne
}else{

//Affiche le formulaire d'ajout de people
echo '<h2>Ajouter un compte</h2>';
echo '
	<form class="gestion" method="post" action="test.php">
		<fieldset>
			<label>Nom :</label><input class="formGestion" type="text" id="nom" name = "nom" /><br/><br/>
			<label>Description :</label><textarea id="description"  name="description"></textarea><br/><br/>
			<label>Détail :</label><textarea id="detail" name="detail"></textarea><br/><br/>
			<label>Prix :</label><input class="formGestion" type="text" id="prix" name = "prix" />€<br/><br/>
			<label>Nom du fichier image :</label><input class="formGestion" type="text" id="image" name = "image" /><br/><br/>
			';
			listCategorie($base, $hote, $utilisateur, $mdp, null);
			echo'
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