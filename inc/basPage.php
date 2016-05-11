<?php

echo '
		<br>
		<br>
		<br><br><br><br><br>
		<div class="contact">
		<a href="contact.php"><button class="contact"><span>Contact</span></button></a>';
		if (!isset($_SESSION['logCompte'])) {
			echo '<a href="gestion.php"><button class="contact"><span>Connexion</span></button></a>';
		} else {
			if (!isset($page) || $page!="gestion") {
				echo '<a href="gestion.php"><button class="contact"><span>Gestion</span></button></a>';
			}
			echo '<a href="deconnexion.php"><button class="contact"><span>Déconnexion</span></button></a>';
		}
		
		
echo '	</div>
';