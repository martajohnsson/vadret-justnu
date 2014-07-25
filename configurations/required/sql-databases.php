<?php

	# DATABAS (kontrollera)
	$check_ipexists = sql("SELECT COUNT(*)
						   FROM visitors
						   WHERE info_ipaddress = :ipaddress
						  ", Array('ipaddress' => ipaddress()), 'count');



	# KONTROLL
	if($check_ipexists == 0) {

		# DATABAS (lägg till)
		sql_il("INSERT INTO visitors(id_user, data_filename, data_filename_get, datetime_visited, info_ipaddress)
				VALUE(:iduser, :filename, :filename_get, :visited, :ipaddress)

			   ", Array('iduser' => '',
						'filename' => $filename,
						'filename_get' => $filename_get,
						'visited' => date('Y-m-d H:i:s'),
						'ipaddress' => ipaddress()));



	# KONTROLL
	/*
	} else {

		sql("UPDATE visitors SET
			 id_user = :iduser,
			 data_filename = :filename,
			 data_filename_get = :filename_get,
			 datetime_revisited = :revisited,
			 info_ipaddress = :ipaddress

			 WHERE info_ipaddress = :ipaddress
			", Array('iduser' => '',
					 'filename' => $filename,
					 'filename_get' => $filename_get,
					 'revisited' => date('Y-m-d H:i:s'),
					 'ipaddress' => ipaddress()));
		*/

	}

?>