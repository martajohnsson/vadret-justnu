<?php

	# INKLUDERA
	require '../configurations/properties.php';


	# DATABAS (hämta)
	$get_history = sql("SELECT *
						FROM coordinates AS c
						JOIN addresses AS a
						ON c.data_coordinates = a.data_coordinates
						GROUP BY a.data_street
						ORDER BY a.data_street ASC
					   ", Array());


	# DATABAS (räkna)
	$check_existens = sql("SELECT COUNT(*)
						   FROM addresses
						  ", Array(), 'count');



	/** ** ** ** ** **/



	# RUBRIK
	echo '<div class="headline">';
		echo 'Historik';
	echo '</div>';


	# KONTROLL
	if($check_existens == 0) {

		echo '<div class="message color-blue">';
			echo 'Här var det tomt! Klicka på "'.$sitename.'" eller "Bestäm en plats" i huvudmenyn, för att lägga till data';
		echo '</div>';



	} else {


		# SÖK
		echo '<div class="history-search">';
			echo '<div class="history-search-icon">';
				echo '<i class="fa fa-search"></i>';
			echo '</div>';

			echo '<div class="history-search-field">';
				echo '<input type="search" name="textfield-search" placeholder="Till exempel Stockholm">';
			echo '</div>';
		echo '</div>';


		echo '<div id="search-result">';

			# TABELL
			echo '<div class="table">';
				echo '<div class="table-row">';

					# TABELL: Plats
					echo '<div class="table-cell-head" style="width: 270px;">';
						echo 'Plats';
					echo '</div>';

					# TABELL: Händelser
					echo '<div class="table-cell-head" style="width: 100px;">';
						echo 'Händelser';
					echo '</div>';

					# TABELL: Varmast
					echo '<div class="table-cell-head" style="width: 110px;">';
						echo 'Varmast';
					echo '</div>';

					# TABELL: Kallast
					echo '<div class="table-cell-head" style="width: 110px;">';
						echo 'Kallast';
					echo '</div>';

					# TABELL: Blåsigast
					echo '<div class="table-cell-head">';
						echo 'Blåsigast';
					echo '</div>';

				echo '</div>';


				# LOOP
				foreach($get_history AS $history) {

					# DATABAS (räkna)
					$count_events = sql("SELECT COUNT(distinct a.data_coordinates)
										 FROM coordinates AS c
										 JOIN addresses AS a
										 ON c.data_coordinates = a.data_coordinates
										 WHERE a.data_coordinates = :coordinates
										", Array('coordinates' => $history['data_coordinates']), 'count');

					# DATABAS (hämta)
					$temp_warmest = sql("SELECT *
										 FROM coordinates
										 WHERE data_coordinates = :coordinates
										 ORDER BY data_temperature DESC
										", Array('coordinates' => $history['data_coordinates']), 'fetch');

					# DATABAS (hämta)
					$temp_coldest = sql("SELECT *
										 FROM coordinates
										 WHERE data_coordinates = :coordinates
										 ORDER BY data_temperature ASC
										", Array('coordinates' => $history['data_coordinates']), 'fetch');

					# DATABAS (hämta)
					$most_windy = sql("SELECT *
									   FROM coordinates
									   WHERE data_coordinates = :coordinates
									   ORDER BY data_wind_speed ASC
									  ", Array('coordinates' => $history['data_coordinates']), 'fetch');

					# DATABAS (hämta)
					$address = sql("SELECT *
									FROM addresses
									WHERE data_coordinates = :coordinates
									ORDER BY data_street ASC, data_postal_town ASC
								   ", Array('coordinates' => $history['data_coordinates']), 'fetch');

					$street = ($address['data_street'] == '' ? '' : $address['data_street']).', ';
					$postal_town = ($address['data_postal_town'] == '' ? $address['data_county'] : $address['data_postal_town']);



					echo '<div class="table-row">';

						# TABELL: Koordinater
						echo '<div class="table-cell">';
							echo '<a href="'.url('history/'.seofriendly_url($street . $postal_town)).'" title="Visa alla händelser för den här platsen">';
								echo $street . $postal_town;
							echo '</a>';
						echo '</div>';

						# TABELL: Händelser
						echo '<div class="table-cell">';
							echo format_number($count_events);
						echo '</div>';

						# TABELL: Varmast
						echo '<div class="table-cell">';
							echo temp($temp_warmest['data_temperature'], false);
						echo '</div>';

						# TABELL: Kallast
						echo '<div class="table-cell">';
							echo temp($temp_coldest['data_temperature'], false);
						echo '</div>';

						# TABELL: Blåsigast
						echo '<div class="table-cell">';
							echo format_number($most_windy['data_wind_speed'], 1).' mps';
						echo '</div>';

					echo '</div>';
				}
			echo '</div>';

		echo '</div>';


	}

?>









<script type="text/javascript">
$(document).ready(function() {


	$('body').on('keyup change paste search', 'input[type="search"]', function() {
		var value = $(this).val();
		if(value.length > 5) {

			$.ajax({
				url: folder_name + '/configurations/required/javascripts/gets/address-search.php?s=' + value,
				type: ajax_type_get,
				beforeSend: function() {
					$('#search-result').html('<div class="message color-blue">Söker igenom databasen - var god vänta</div>');
				},
				success: function(s) {
					$('#search-result').html(s);
				},
				error: function(e) {
					console.log(e);
				}
			});


		} else if(value.length == 0) {

			$.ajax({
				url: folder_name + '/configurations/required/javascripts/gets/address-search.php',
				type: ajax_type_get,
				success: function(s) {
					$('#search-result').html(s);
				},
				error: function(e) {
					console.log(e);
				}
			});

		}
	});


});
</script>