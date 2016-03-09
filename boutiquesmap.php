<?php
echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
';

$villes = array("ALBERTVILLE","ANNECY","CHAMBERY","CLERMONT FERRAND","GRENOBLE","LYON","VALENCE");
$coordx = array(442+50,426+50,420+50,311+50,406+50,370+50,383+50);
$coordy = array(307+168+80,295+168+80,311+168+80,307+168+80,329+168+80,305+168+80,362+168+80);



include 'inc/titre.php';
echo '
	<body>
';
include 'inc/border.php';
echo '
	<div class = "content">
';

include 'inc/france.inc.php';

for($i=0; $i<count($villes); $i=$i+1) {
 	echo '<DIV STYLE="
 	 position:absolute;
 	 top:'.$coordy[$i].';
 	 left:'.$coordx[$i].';
  	">
 		<a href="boutique.php?boutique='.$villes[$i].'"><img src="imgcedric/point.png" /></a>

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
	</div>
	</body>
		';
	
include 'inc/basPage.php';