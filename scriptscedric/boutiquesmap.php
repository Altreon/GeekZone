<?php

$villes = array("Albertville","Annecy","Chambery","Clermont-Ferrand","Grenoble","Lyon","Valence");
$coordx = array(442,426,420,311,406,370,383);
$coordy = array(307+167,295+167,311+167,307+167,329+167,305+167,362+167);



include 'inc/titre.php';
include 'inc/france.inc.php';

for($i=0; $i<count($villes); $i=$i+1) {
 	echo '<DIV STYLE="
 	 position:absolute;
 	 top:'.$coordy[$i].';
 	 left:'.$coordx[$i].';
  	">
 		<a href="boutique.php?boutique='.$villes[$i].'"><img src="img/point.png" /></a>

 	</div>';
}

echo '
	<div class="shop">Cliquez sur les points de la carte, ou sur une ville ci-dessous, pour accéder aux détails d\'une de nos boutiques.
	<ul> ';
		
for($i=0; $i<count($villes); $i=$i+1) {		
			echo ' <li><a class="lien" href="boutique.php?boutique='.$villes[$i].'">'.$villes[$i].'</a></li>';
}
	echo '</ul>
				
	</div>
		';