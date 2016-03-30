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

}

echo'</body>';

include 'inc/basPage.php';