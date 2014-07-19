<?php

	# INKLUDERA
	require '../configurations/properties.php';


	# INSTÄLLNINGAR
	$table_width = 120;


	# DATABAS (hämta)
	$get_history = sql("SELECT *
						FROM coordinates
						WHERE data_coordinates = :coordinates
					   ", Array('coordinates' => $_GET['lat'].','.$_GET['lng']));


	# DATABAS (hämta)
	$address = sql("SELECT a.data_street AS street,
						   a.data_postal_town AS postal_town,
						   a.data_county AS county

					FROM coordinates AS c
					JOIN addresses AS a
					ON c.data_coordinates = a.data_coordinates
					WHERE c.data_coordinates = :coordinates
					GROUP BY a.data_street
				   ", Array('coordinates' => $_GET['lat'].','.$_GET['lng']), 'fetch');

	$street = ($address['street'] == '' ? '' : $address['street']);
	$postal_town = ($address['postal_town'] == '' ? ', '.$address['county'] : ', '.$address['postal_town']);



	/** ** ** ** ** **/



	# RUBRIK
	echo '<div class="headline">';
		echo 'Historik';
		echo '<div class="space space-medium">-</div>';
		echo $street . $postal_town;
	echo '</div>';


	# STATISTIK
	echo '<div class="history-statistics">';

		# TABELL
		echo '<div class="table">';
			echo '<div class="table-row">';

				# TABELL: Varmast
				echo '<div class="table-cell-left" style="width: '.$table_width.'px;">';
					echo 'Varmast';
				echo '</div>';

				# TABELL: Temperatur
				echo '<div class="table-cell-right">';
					echo '+28 C (<a href="javscript:void(0)">2014-06-24, 15:37</a>)';
				echo '</div>';

			echo '</div>';
		echo '</div>';

	echo '</div>';


	# TABELL
	echo '<div class="table">';
		echo '<div class="table-row">';

			# TABELL: Händelsedatum
			echo '<div class="table-cell-head" style="width: 150px;">';
				echo 'Händelsedatum';
			echo '</div>';

			# TABELL: Temperatur
			echo '<div class="table-cell-head">';
				echo 'Temperatur';
			echo '</div>';

		echo '</div>';


		# LOOP
		foreach($get_history AS $history) {
			echo '<div class="table-row">';

				# TABELL: Händelsedatum
				echo '<div class="table-cell">';
					echo '<a href="'.url($history['data_coordinates'].'/history').'" title="Visa väderleksrapporten för den här händelsen">';
						echo date('Y-m-d, H:i:s', $history['timestamp_found']);
					echo '</a>';
				echo '</div>';

				# TABELL: Temperatur
				echo '<div class="table-cell">';
					echo temp($history['data_temperature']);
				echo '</div>';

			echo '</div>';
		}
	echo '</div>';

?>









<script type="text/javascript">
$(document).ready(function() {


	


});
</script>