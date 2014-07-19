<?php

	# INKLUDERA
	require '../../../properties.php';


	# 
	



	/** ** ** ** ** **/



	# KONTROLL: Obligatoriska textfält fattas
	if(empty($_POST['textfield-email']) OR
	   empty($_POST['textfield-subject']) OR
	   empty($_POST['textarea-message'])) {

		# FELKOD
		echo '1';



	# KONTROLL: E-postadressen är inte giltig
	} elseif(!filter_var($_POST['textfield-email'], FILTER_VALIDATE_EMAIL)) {

		# FELKOD
		echo '2';



	# KONTROLL: Kunde inte hitta några fel
	} else {

		# MEDDELANDE
		echo '<div class="message color-green">';
			echo 'Tack för ditt meddelande!';
		echo '</div>';


		$headers = 'MIME-Version: 1.0' . "\r\n" .
				   'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
				   'To: Erik Edgren <nhagyavi@gmail.com>' . "\r\n" .
				   'From: '.SITENAME.' <no-reply@erik-edgren.nu>' . "\r\n" .
				   'X-Mailer: PHP/'.phpversion();

		mail('nhagyavi@gmail.com', $_POST['textfield-subject'], $_POST['textarea-message'], $headers);

	}

?>