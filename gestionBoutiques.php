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

if(isset($_POST['envoyerAjout']) && isset($_POST['rue']) && !empty($_POST['rue']) && isset($_POST['cp']) && !empty($_POST['cp']) &&isset($_POST['ville']) && !empty($_POST['ville']) &&isset($_POST['image']) && !empty($_POST['image']) && isset($_POST['telephone']) && !empty($_POST['telephone'])){
	insertTableauBoutique($base, $hote, $utilisateur, $mdp, $_POST['rue'], $_POST['cp'], $_POST['ville'], $_POST['image'], $_POST['telephone'],
							$_POST['lundi_matin_debut'], $_POST['lundi_matin_fin'], $_POST['lundi_apres_debut'], $_POST['lundi_apres_fin'],
							$_POST['mardi_matin_debut'],$_POST['mardi_matin_fin'], $_POST['mardi_apres_debut'], $_POST['mardi_apres_fin'],
							$_POST['mercredi_matin_debut'],$_POST['mercredi_matin_fin'], $_POST['mercredi_apres_debut'], $_POST['mercredi_apres_fin'],
							$_POST['jeudi_matin_debut'],$_POST['jeudi_matin_fin'], $_POST['jeudi_apres_debut'], $_POST['jeudi_apres_fin'],
							$_POST['vendredi_matin_debut'],$_POST['vendredi_matin_fin'], $_POST['vendredi_apres_debut'], $_POST['vendredi_apres_fin'],
							$_POST['samedi_matin_debut'],$_POST['samedi_matin_fin'], $_POST['samedi_apres_debut'], $_POST['samedi_apres_fin'],
							$_POST['dimanche_matin_debut'],$_POST['dimanche_matin_fin'], $_POST['dimanche_apres_debut'], $_POST['dimanche_apres_fin']);
}

if(isset($_POST['envoyerModifBoutique']) && !empty($_POST['envoyerModif']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) &&isset($_POST['mail']) && !empty($_POST['mail']) &&isset($_POST['telephone']) && !empty($_POST['telephone']) && isset($_POST['adresse']) && !empty($_POST['adresse']) &&isset($_POST['cp']) && !empty($_POST['cp']) &&isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['boutiqueGeree']) && !empty($_POST['boutiqueGeree']) && isset($_POST['statut']) && !empty($_POST['statut']) && isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['hdIdCompte']) && !empty($_POST['hdIdCompte'])){
	updateTableauBoutique($base, $hote, $utilisateur, $mdp, $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['telephone'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['boutiqueGeree'], $_POST['statut'], $_POST['login'], $_POST['mdp'], $_POST['hdIdCompte']);
}

if(isset($_GET['suppCompteBoutique']) && !empty($_GET['suppCompte'])){
	suppTableauBoutique($_GET['suppBoutique'], $base, $hote, $utilisateur, $mdp);
}

creaTableauBoutique("id", $base, $hote, $utilisateur, $mdp);

if ( isset($_GET['editCompteBoutique']) && !empty($_GET['editCompte']) ) {
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
		
			';include 'inc/franceEdit.inc.php';echo'
		
			<label>Horaires :</label><br/><br/>
			
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
echo'
	</div>
';
echo'</body>';

include 'inc/basPage.php';