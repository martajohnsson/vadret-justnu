<?php

	# INKLUDERA
	require '../../../properties.php';



	# DATABAS (kontrollera)
	$check_existens = sql("SELECT COUNT(*)
						   FROM addresses
						   WHERE data_coordinates = :coordinates
						  ", Array('coordinates' => $_GET['lat'].','.$_GET['lng']), 'count');



	# KONTROLL
	if($check_existens == 0) {

		# DATABAS (uppdatera)
		sql("INSERT INTO addresses(data_coordinates,
								   data_street,
								   data_postal_code,
								   data_postal_town,
								   data_neighborhood,
								   data_city,
								   data_county,
								   data_country)

			 VALUES(:coordinates,
					:street,
					:postal_code,
					:postal_town,
					:neighborhood,
					:city,
					:county,
					:country)

			", Array('coordinates' => $_GET['lat'].','.$_GET['lng'],
					 'street' => $_GET['ssn'],
					 'postal_code' => ($_GET['pc'] == 'undefined' ? '' : $_GET['pc']),
					 'postal_town' => ($_GET['pt'] == 'undefined' ? '' : $_GET['pt']),
					 'neighborhood' => ($_GET['n'] == 'undefined' ? '' : $_GET['n']),
					 'city' => ($_GET['ci'] == 'undefined' ? '' : $_GET['ci']),
					 'county' => ($_GET['cy'] == 'undefined' ? '' : $_GET['cy']),
					 'country' => ($_GET['cry'] == 'undefined' ? '' : $_GET['cry'])));

	}

?>