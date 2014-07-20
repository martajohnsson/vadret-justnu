<?php

	# ANSLUT
	try {
		$sql = new PDO('mysql:host='.$sql_host.';dbname='.$sql_database, $sql_username, $sql_password);
		$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}


	catch(PDOException $e) {
		if(strstr($e->getMessage(), 'SQLSTATE[')) {
			preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches);
			$code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
			$error = $matches[3];
		}

		die('<body style="font-family: Arial; font-size: 12px; padding: 20px;">Filen <b>'.basename($e->getFile()).'</b> på <b>rad '.$e->getLine().'</b>, säger: ['.$code.'] '.$error.'</body>');
	}

?>