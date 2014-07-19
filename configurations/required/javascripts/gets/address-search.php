<?php

	# INKLUDERA
	require '../../../properties.php';


	# DATABAS (hämta)
	$get_history = sql("SELECT *
						FROM coordinates AS c
						JOIN addresses AS a
						ON c.data_coordinates = a.data_coordinates
						WHERE a.data_street LIKE :search
						OR a.data_postal_code LIKE :search
						OR a.data_postal_town LIKE :search
						OR a.data_city LIKE :search
						OR a.data_county LIKE :search
						OR a.data_country LIKE :search
						GROUP BY a.data_street
						ORDER BY a.data_street ASC
					   ", Array('search' => '%'.$_GET['s'].'%'));


	# DATABAS (hämta)
	$check_existens = sql("SELECT COUNT(*)
						   FROM addresses
						   WHERE data_street LIKE :search
						   OR data_postal_code LIKE :search
						   OR data_postal_town LIKE :search
						   OR data_city LIKE :search
						   OR data_county LIKE :search
						   OR data_country LIKE :search
						  ", Array('search' => '%'.$_GET['s'].'%'), 'count');



	/** ** ** ** ** **/



	if(isset($_GET['s']) AND $check_existens == 0) {

		echo '<div class="message color-blue">';
			echo 'Kunde inte hitta något med den sökfrasen';
		echo '</div>';



	} else {

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
				$count_events = sql("SELECT COUNT(*)
									 FROM coordinates AS c
									 JOIN addresses AS a
									 ON c.data_coordinates = a.data_coordinates
									 WHERE a.data_coordinates = :coordinates
									 GROUP BY a.data_street
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

				$street = ($address['data_street'] == '' ? '' : $address['data_street']);
				$postal_town = ($address['data_postal_town'] == '' ? ', '.$address['data_county'] : ', '.$address['data_postal_town']);



				echo '<div class="table-row">';

					# TABELL: Koordinater
					echo '<div class="table-cell">';
						echo '<a href="'.url('history/'.$history['data_coordinates']).'" title="Visa alla händelser för den här platsen">';
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

	}

?>









<script type="text/javascript">
$(document).ready(function() {


	


});
</script>