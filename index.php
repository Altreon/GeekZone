<?php
echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
	';
	
include 'inc/titre.php';	
	
echo '
	<body>
	';
include 'inc/border.php';

echo '
	<div class = "content">
		<p class = "acc">Bienvenue chez GeekZone!</p>	
	</div>
		
	<div class = "accboutiques">
		<p>
   			<map name="mapacc" id="mapacc">
      			<area shape="rect" coords="0,0,270,122" href="boutiquesmap.php"/>
				<area shape="rect" coords="910,0,1184,122" href="categorieProduit.php"/>
   			</map>
		
			<img src="imgcedric/bouton/gz.png" usemap="mapacc" alt="image"/>
		</p>
		
	</div>	
';

echo'</body>';

include 'inc/basPage.php';