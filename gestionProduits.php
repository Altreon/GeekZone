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
	<form class="produitFT"; action="gestionProduits.php" method="get">
	
		<div class="produitTri">
			Trier les produits : <SELECT class="produitFilter" name="tri" size="">
				<OPTION ';if(isset($_GET['tri']) && $_GET['tri'] == "numero"){echo("selected");}echo'>numero
				<OPTION ';if(isset($_GET['tri']) && $_GET['tri'] == "nom"){echo("selected");}echo'>nom
				<OPTION ';if(isset($_GET['tri']) && $_GET['tri'] == "prenom"){echo("selected");}echo'>prix
				<OPTION ';if(isset($_GET['tri']) && $_GET['tri'] == "mail"){echo("selected");}echo'>categorie
			</SELECT>
		</div>
		<br>
		<div class="produitTri">
			Ordre de tri : <SELECT class="produitFilter" name="ordre" size="">
				<OPTION ';if(isset($_GET['ordre']) && $_GET['ordre'] == "croissant"){echo("selected");}echo'>croissant
				<OPTION ';if(isset($_GET['ordre']) && $_GET['ordre'] == "decroissant"){echo("selected");}echo'>decroissant
			</SELECT>
		</div>		
				
		<input class="produitFilter form" type="submit" name="send"></input>
		
	</form>	
';

echo'
	<div class="strip">
	</div>
	<br>
	<div class="produitList">
';

if (!isset($_SESSION['logCompte']) || $_SESSION['statCompte'] != "G") {  // Vérification des droits pour gérer les utilisateurs
	echo'<p class="blocAcces">Vous ne possédez pas les autorisations nécessaires pour visionner le contenu de cette page!</p>';
} else {

	if(isset($_POST['envoyerAjout']) && !empty($_POST['envoyerAjout']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['description']) && !empty($_POST['description']) &&isset($_POST['detail']) && !empty($_POST['detail']) &&isset($_POST['prix']) && !empty($_POST['prix']) && isset($_POST['image']) && !empty($_POST['image']) &&isset($_POST['categorie']) && !empty($_POST['categorie'])){
		insertTableauProduit($base, $hote, $utilisateur, $mdp, $_POST['nom'], $_POST['description'], $_POST['detail'], $_POST['prix'], $_POST['image'], $_POST['categorie']);
	}
	
	if(isset($_POST['envoyerModif']) && !empty($_POST['envoyerModif']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['description']) && !empty($_POST['description']) &&isset($_POST['detail']) && !empty($_POST['detail']) &&isset($_POST['prix']) && !empty($_POST['prix']) && isset($_POST['image']) && !empty($_POST['image']) &&isset($_POST['categorie']) && !empty($_POST['categorie']) && isset($_POST['hdIdProduit']) && !empty($_POST['hdIdProduit'])){
		updateTableauProduit($base, $hote, $utilisateur, $mdp, $_POST['nom'], $_POST['description'], $_POST['detail'], $_POST['prix'], $_POST['image'], $_POST['categorie'], $_POST['hdIdProduit']);
	}
	
	if(isset($_GET['suppProduit']) && !empty($_GET['suppProduit'])){
		suppTableauProduit($_GET['suppProduit'], $base, $hote, $utilisateur, $mdp);
	}
	
	if (isset($_GET['tri'])) $tri = $_GET['tri'];
	if (isset($_GET['ordre'])) $ordre = $_GET['ordre'];
	if (!isset($_GET['tri'])) $tri = "produit_id";
	if (!isset($_GET['ordre'])) $ordre = "asc";
	
	creaTableauProduit($tri, $ordre, $base, $hote, $utilisateur, $mdp);
	
	if ( isset($_GET['editProduit']) && !empty($_GET['editProduit']) ) {
		editTableauProduit($_GET['editProduit'], $base, $hote, $utilisateur, $mdp); //Affiche le formulaire d'édition d'un produit
	}else{
	
	//Affiche le formulaire d'ajout de produit
	echo '<h2>Ajouter un produit</h2>';
	echo '
		<form class="gestion" method="post" action="gestionProduits.php">
			<fieldset>
				<label>Nom :</label><input class="formGestion" type="text" id="nom" name = "nom" /><br/><br/>
				<label>Description :</label><textarea id="description"  name="description"></textarea><br/><br/>
				<label>Détail :</label><textarea id="detail" name="detail"></textarea><br/><br/>
				<label>Prix :</label><input class="formGestion" type="text" id="prix" name = "prix" />  €<br/><br/>
				<label>Nom du fichier image :</label><input class="formGestion" type="text" id="image" name = "image" /><br/><br/>
				<label>Catégorie :</label>
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
}
	
echo'
	</div>
';
echo'</body>';

include 'inc/basPage.php';