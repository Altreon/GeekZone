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
		
		<br>
		
		<form class="contact" action="contact.php" method="POST" enctype="multipart/form-data">
			<div class="row">
				<label>Votre nom:</label><br/>
				<input id="name" class="input" name="name" type="text" value="" size="30" /><br />
			</div>
			<div class="row">
				<label>Votre email:</label><br />
				<input id="email" class="input" name="email" type="text" value="" size="30" /><br />
			</div>
			<div class="row">
				<label for="message">Votre message:</label><br />
				<textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br />
			</div>
			<input id="submit" type="submit" value="Envoyer email" />
		</form>
		
		';
			if(isset($_POST['name'])) {
				echo'<h2>Votre message � bien �t� envoy�</h2>';
			}
		echo'
					
	</div>
';

echo'</body>';

include 'inc/basPage.php';
