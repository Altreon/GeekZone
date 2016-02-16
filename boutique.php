<?php
echo '
<link rel="stylesheet" type="text/css" media="screen" href="css/GeekZone.css"/>
	<body>
	';

include 'inc/titre.php';

$boutiqueImage = array(
		"img/boutiques/boutique_valence.jpg",
		"img/boutiques:boutique_grenoble.jpg",
);

$boutiqueAdresse = array(
		"84 rte Beauvallon",
		"2 Bis av St Roch",
);

$boutiqueCP = array(
		"26000",
		"38000",
);

$boutiqueVille = array(
		"VALENCE",
		"GRENOBLE",
);

$boutiqueTelephone = array(
		"04 75 56 27 77 ",
		"04 76 54 33 47 ",
);

$boutiqueHoraires = array(
		"Du lundi au samedi de 08h30 � 12h et de 14h � 19h.",
		"Du mardi au samedi de 8h30 � 19h30 (sans interruption) et le dimanche matin de 9h � 12h30",
);
	
echo '
	<table>
		<tr>
			<th rowspan = "4">
				<h2>Boutique de '.$_GET['boutique'].'</h2>
				';
				if($_GET['boutique'] == "Valence"){
					echo'
					<p class="center"><img class="boutique" src="'.$boutiqueImage[0].'"></img></p>
					';
				}
				echo '
			</th>
			<th rowspan = "1">
				<h3>Horaires :</h3>
					<table>
						<tr>
							<th rowspan = "1"></th>
							<th rowspan = "1">Lundi</th>
							<th rowspan = "1">Mardi</th>
							<th rowspan = "1">Mercredi</th>
							<th rowspan = "1">Jeudi</th>
							<th rowspan = "1">Vendredi</th>
							<th rowspan = "1">Samedi</th>
							<th rowspan = "1">Dimanche</th>
						</tr>';
						if($_GET['boutique'] == "Valence"){ echo'
							<tr>
								<th rowspan = "1">Matin</th>
								<th rowspan = "1">de 08h30 � 12h30</th>
								<th rowspan = "1">de 08h30 � 12h30</th>
								<th rowspan = "1">de 08h30 � 12h30</th>
								<th rowspan = "1">de 08h30 � 12h30</th>
								<th rowspan = "1">de 08h30 � 12h30</th>
								<th rowspan = "1">de 08h30 � 12h30</th>
								<th rowspan = "1">Ferm�e</th>
							</tr>
							<tr>
								<th rowspan = "1">Apr�s-midi</th>
								<th rowspan = "1">de 14h00 � 19h00</th>
								<th rowspan = "1">de 14h00 � 19h00</th>
								<th rowspan = "1">de 14h00 � 19h00</th>
								<th rowspan = "1">de 14h00 � 19h00</th>
								<th rowspan = "1">de 14h00 � 19h00</th>
								<th rowspan = "1">de 14h00 � 19h00</th>
								<th rowspan = "1">Ferm�e</th>
							</tr>
						';
						}
						echo '
					</table>
			</th>
		</tr>
		<tr>
			<th rowspan = "1">';
				if($_GET['boutique'] == "Valence"){ echo'
					<h5>Telephone : '.$boutiqueTelephone[0].'</h5>
				';
				}
				echo '
			</th>
		</tr>
		<tr>
			<th rowspan = "1">';
				if($_GET['boutique'] == "Valence"){ echo'
					<h5>Adresse : '.$boutiqueAdresse[0].'</h5>
				';
				}
				echo '
			</th>
		</tr>
		<tr>
			<th rowspan = "1">';
				if($_GET['boutique'] == "Valence"){ echo'
					<h5>Code Postale : '.$boutiqueCP[0].'</h5>
				';
				}
				echo '
			</th>
		</tr>
	</table>
		
	</body>
';

include 'inc/basPage.php';