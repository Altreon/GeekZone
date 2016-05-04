<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>

<?php
$page="accueil";
$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

include 'inc/titre.php';
include 'inc/fonction.php';
?>

<body>
	
<?php include 'inc/border.php'; ?>
<div class = "content">
<?php if (!isset($_SESSION['logCompte'])) { ?>
	
		<div class="gestionForm">
			<form class="connexion" action="gestion.php" method="post">
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
	
	
<?php if (isset($_POST['identifiant']) && !empty($_POST['identifiant']) &&
		isset($_POST['mdp']) && !empty($_POST['mdp'])) {
		$verif=VerifId($_POST['identifiant'],$_POST['mdp'],$base,$hote,$utilisateur,$mdp);
		
		if (!$verif) {
			echo '<p class="produitPrix">ERREUR! Mauvais login ou mot de passe!</p>';
		}
		
		else {
			session($_POST['identifiant'],$_POST['mdp'],$base,$hote,$utilisateur,$mdp);
			header('Location: gestion.php');
		} 
		
	
		
		
	 } ?>
	
	 <br>
	 <br>
	 <br>
	 <div class="contact">
	 <a href="gestion.php"><button class="contact"><span>Connexion</span></button></a>
	 
	 </div>
	
<?php } else { ?>
<div class="gestionZone">
	<div class="gestionContent">
		<p class="produit">Bienvenue sur la page d'administration du site.<br><br>Accès aux pages de gestion ci-dessous :</p>
	</div>
	
	<br>
	<br>
	
	<map name="mapacc" id="mapacc">
	      <area shape="rect" coords="0,0,270,122" href="gestionBoutiques.php"/>
			<area shape="rect" coords="910,0,1184,122" href="gestionProduits.php"/>
	</map>
	<img src="imgcedric/bouton/gz.png" usemap="mapacc" alt="image"/>
	
	<a href="gestionUtilisateur.php"><img class="userBout" src="imgcedric/bouton/utilisateurs.png"/></a><br/>
</div>

<br>
<br>
<br>
<div class="contact">
<a href="deconnexion.php"><button class="contact"><span>Déconnexion</span></button></a>

</div>

<?php } ?></div>