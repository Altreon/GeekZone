<?php

$base='geekzone';
$hote='localhost';
$utilisateur='root';
$mdp='';

echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/csscedric.css"/>';

echo '
	<body>
	';
include 'inc/titre.php';
include 'inc/border.php';
include 'inc/fonction.php';

echo '	<div class="content">
		<p class = "acc">Page d\'administration</p>';

ModifProduitValues($base, $hote, $utilisateur, $mdp);
		

echo '</div>';