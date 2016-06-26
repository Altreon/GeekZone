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
		
	<form class="produitFT"; action="gestionBoutiques.php" method="get">
	
		<div class="produitTri">
			Trier les boutiques : <SELECT class="produitFilter" name="tri" size="">
				<OPTION ';if(isset($_GET['tri']) && $_GET['tri'] == "numero"){echo("selected");}echo'>numero
				<OPTION ';if(isset($_GET['tri']) && $_GET['tri'] == "ville"){echo("selected");}echo'>ville
				<OPTION ';if(isset($_GET['tri']) && $_GET['tri'] == "code postal"){echo("selected");}echo'>code postal
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

if (!isset($_SESSION['logCompte'])) {  // Vérifie si l'utilisateur est connecté pour le laisser gérer les boutiques
	echo'<p class="blocAcces">Vous ne possédez pas les autorisations nécessaires pour visionner le contenu de cette page!</p>';
} else {

	if(isset($_POST['envoyerAjout']) && isset($_POST['rue']) && !empty($_POST['rue']) && isset($_POST['cp']) && !empty($_POST['cp']) &&isset($_POST['ville']) && !empty($_POST['ville']) &&isset($_POST['image']) && !empty($_POST['image']) && isset($_POST['telephone']) && !empty($_POST['telephone']) && isset($_POST['coordX']) && !empty($_POST['coordX']) && isset($_POST['coordY']) && !empty($_POST['coordY'])){
		insertTableauBoutique($base, $hote, $utilisateur, $mdp, $_POST['rue'], $_POST['cp'], $_POST['ville'], $_POST['image'], $_POST['telephone'], $_POST['coordX'], $_POST['coordY'],
								$_POST['lundi_matin_debut'], $_POST['lundi_matin_fin'], $_POST['lundi_apres_debut'], $_POST['lundi_apres_fin'],
								$_POST['mardi_matin_debut'],$_POST['mardi_matin_fin'], $_POST['mardi_apres_debut'], $_POST['mardi_apres_fin'],
								$_POST['mercredi_matin_debut'],$_POST['mercredi_matin_fin'], $_POST['mercredi_apres_debut'], $_POST['mercredi_apres_fin'],
								$_POST['jeudi_matin_debut'],$_POST['jeudi_matin_fin'], $_POST['jeudi_apres_debut'], $_POST['jeudi_apres_fin'],
								$_POST['vendredi_matin_debut'],$_POST['vendredi_matin_fin'], $_POST['vendredi_apres_debut'], $_POST['vendredi_apres_fin'],
								$_POST['samedi_matin_debut'],$_POST['samedi_matin_fin'], $_POST['samedi_apres_debut'], $_POST['samedi_apres_fin'],
								$_POST['dimanche_matin_debut'],$_POST['dimanche_matin_fin'], $_POST['dimanche_apres_debut'], $_POST['dimanche_apres_fin']);
	}
	
	if ($_SESSION['statCompte'] == "G" || $_POST['boutiqueGeree'] == $_SESSION['boutiqueGeree']) {  // Vérification des droits
		if(isset($_POST['envoyerModif']) && !empty($_POST['envoyerModif']) && isset($_POST['rue']) && !empty($_POST['rue']) && isset($_POST['cp']) && !empty($_POST['cp']) &&isset($_POST['ville']) && !empty($_POST['ville']) &&isset($_POST['image']) && !empty($_POST['image']) && isset($_POST['telephone']) && !empty($_POST['telephone']) && isset($_POST['coordX']) && !empty($_POST['coordX']) && isset($_POST['coordY']) && !empty($_POST['coordY']) && isset($_POST['hdIdBoutique']) && !empty($_POST['hdIdBoutique'])){
			updateTableauBoutique($base, $hote, $utilisateur, $mdp, $_POST['rue'], $_POST['cp'], $_POST['ville'], $_POST['image'], $_POST['telephone'], $_POST['coordX'], $_POST['coordY'], $_POST['hdIdBoutique'],
								$_POST['lundi_matin_debut'], $_POST['lundi_matin_fin'], $_POST['lundi_apres_debut'], $_POST['lundi_apres_fin'],
								$_POST['mardi_matin_debut'],$_POST['mardi_matin_fin'], $_POST['mardi_apres_debut'], $_POST['mardi_apres_fin'],
								$_POST['mercredi_matin_debut'],$_POST['mercredi_matin_fin'], $_POST['mercredi_apres_debut'], $_POST['mercredi_apres_fin'],
								$_POST['jeudi_matin_debut'],$_POST['jeudi_matin_fin'], $_POST['jeudi_apres_debut'], $_POST['jeudi_apres_fin'],
								$_POST['vendredi_matin_debut'],$_POST['vendredi_matin_fin'], $_POST['vendredi_apres_debut'], $_POST['vendredi_apres_fin'],
								$_POST['samedi_matin_debut'],$_POST['samedi_matin_fin'], $_POST['samedi_apres_debut'], $_POST['samedi_apres_fin'],
								$_POST['dimanche_matin_debut'],$_POST['dimanche_matin_fin'], $_POST['dimanche_apres_debut'], $_POST['dimanche_apres_fin']);
		}
	}
	
	
	if ($_SESSION['statCompte'] == "G") { // Vérification des droits
		if(isset($_GET['suppBoutique']) && !empty($_GET['suppBoutique'])){
			suppTableauBoutique($_GET['suppBoutique'], $base, $hote, $utilisateur, $mdp);
		}
	}
	
	if (isset($_GET['tri'])) $tri = $_GET['tri'];
	if (isset($_GET['ordre'])) $ordre = $_GET['ordre'];
	if (!isset($_GET['tri'])) $tri = "id";
	if (!isset($_GET['ordre'])) $ordre = "asc";
	
	creaTableauBoutique($tri, $ordre, $base, $hote, $utilisateur, $mdp);
	
	
	if ( isset($_GET['editBoutique']) && !empty($_GET['editBoutique']) ) {
		editTableauBoutique($_GET['editBoutique'], $base, $hote, $utilisateur, $mdp); //Affiche le formulaire d'édition d'une personne
	}else{
	
	//Affiche le formulaire d'ajout de people
	echo '<h2>Ajouter une boutique</h2>';
	echo '
		<form class="gestion boutique" method="post" action="gestionBoutiques.php">
			<fieldset>
				<label>Rue :</label><input class="formGestion" type="text" id="rue" name = "rue" /><br/><br/>
				<label>CP :</label><input class="formGestion" type="text" id="cp" name = "cp" /><br/><br/>
				<label>Ville :</label><input class="formGestion" type="text" id="ville" name = "ville" /><br/><br/>
				<label>Nom du fichier image :</label><input class="formGestion" type="text" id="image" name = "image" /><br/><br/>
				<label>Téléphone :</label><input class="formGestion" type="text" id="telephone" name = "telephone" /><br/><br/>
				<label>Coordonnées sur la carte :</label><br/><br/>
			
				<div>
					';include 'inc/franceEdit.inc.php';
					  createCoord(0, 0);
					echo'
				</div>
			
				<label clas="noFloat">Horaires :</label><br/><br/>
				
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
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="lundi_matin_debut" name = "lundi_matin_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="lundi_matin_fin" name = "lundi_matin_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="mardi_matin_debut" name = "mardi_matin_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="mardi_matin_fin" name = "mardi_matin_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="mercredi_matin_debut" name = "mercredi_matin_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="mercredi_matin_fin" name = "mercredi_matin_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="jeudi_matin_debut" name = "jeudi_matin_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="jeudi_matin_fin" name = "jeudi_matin_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="vendredi_matin_debut" name = "vendredi_matin_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="vendredi_matin_fin" name = "vendredi_matin_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="samedi_matin_debut" name = "samedi_matin_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="samedi_matin_fin" name = "samedi_matin_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="dimanche_matin_debut" name = "dimanche_matin_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="dimanche_matin_fin" name = "dimanche_matin_fin" /></th>
					</tr>
					<tr>
						<th class="boutinfos" rowspan = "1">Après-midi</th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="lundi_apres_debut" name = "lundi_apres_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="lundi_apres_fin" name = "lundi_apres_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="mardi_apres_debut" name = "mardi_apres_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="mardi_apres_fin" name = "mardi_apres_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="mercredi_apres_debut" name = "mercredi_apres_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="mercredi_apres_fin" name = "mercredi_apres_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="jeudi_apres_debut" name = "jeudi_apres_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="jeudi_apres_fin" name = "jeudi_apres_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="vendredi_apres_debut" name = "vendredi_apres_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="vendredi_apres_fin" name = "vendredi_apres_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="samedi_apres_debut" name = "samedi_apres_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="samedi_apres_fin" name = "samedi_apres_fin" /></th>
						<td class="boutinfos" rowspan = "1"><label class="horaire">Début:</label><input class="horaire" type="text" id="dimanche_apres_debut" name = "dimanche_apres_debut" /><br/><br/>
															<label class="horaire">Fin:</label><input class="horaire" type="text" id="dimanche_apres_fin" name = "dimanche_apres_fin" /></th>
					</tr>
				</table>
				
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