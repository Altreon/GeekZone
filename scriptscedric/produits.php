<?php
echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
	';

include 'inc/titre.php';

echo '<body>
		<p class="acc"><i>Voici ci-dessous les différentes catégories de produits disponibles :</i></p>
		<br>
		<br>
		<br>

		<div class = "cuisine color"><a class="lien" href="catprodgen/cuisine.php">Cuisines</a>
		<br /><img src="img/cuisine.png"></div>
			
		<div class = "mode color"><a class="lien" href="catprodgen/mode.php">Vestimentaire</a>
		<br /><img src="img/mode.png"></div>
		
		<div class = "portable color"><a class="lien" href="catprodgen/portable.php">Accessoires pour portables</a>
		<br /><img src="img/portable.png"></div>
		
		<div class = "img color"><a class="lien" href="catprodgen/portable.php">Tous</a>
		<br /><img src="img/imagegeek.png"></div>

		<div class = "usb color"><a class="lien" href="catprodgen/usb.php">Accessoires USB</a>
		<br /><img src="img/usb.png"></div>
		
		
		<div class = "gadget color"><a class="lien" href="catprodgen/gadget.php">Gadgets</a>
		<br /><img src="img/gadget.png"></div>
		
	</body>';