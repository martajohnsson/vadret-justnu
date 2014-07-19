<?php

	# ANSLUT
	try {
		$sql = new PDO('mysql:host='.SQL_HOST.';dbname='.SQL_DATABASE, SQL_USERNAME, SQL_PASSWORD);
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