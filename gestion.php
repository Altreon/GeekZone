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

<?php if (false) { ?>
	
<?php } else { ?>

<div class="gestionContent">
	<p class="produit">Bienvenue sur la page d'administration du site.<br><br>Accès aux pages de gestion ci-dessous :</p>
</div>

<br>

<map name="mapacc" id="mapacc">
      <area shape="rect" coords="0,0,270,122" href="gestionBoutiques.php"/>
		<area shape="rect" coords="910,0,1184,122" href="gestionProduits.php"/>
</map>
<img src="imgcedric/bouton/gz.png" usemap="mapacc" alt="image"/>

<a href="gestionUtilisateur.php"><img class="userBout" src="imgcedric/bouton/utilisateurs.png"/></a>

<?php } ?>

<br>
<br>
<br>
<div class="contact">
<a href="index.php"><button class="contact"><span>Accueil</span></button></a>

</div>