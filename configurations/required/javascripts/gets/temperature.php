<?php

	# INKLUDERA
	require '../../../properties.php';

	# INSTÄLLNINGAR
	$latitude = $_GET['lat'];
	$longitude = $_GET['lng'];



	# KONTROLL: Koordinaterna existerar inte
	if(empty($latitude) AND empty($longitude)) {

		echo 'no-coordinates';



	# KONTROLL: Inga fel hittades
	} else {

		# KONTROLL: Solupp/nedgång och månupp/nedgång existerar
		if(@simplexml_load_file('http://api.yr.no/weatherapi/locationforecast/1.9/?lat='.$latitude.';lon='.$longitude)) {

			# XML: Hämta väderprognosen
			$weather_forecast = simplexml_load_file('http://api.yr.no/weatherapi/locationforecast/1.9/?lat='.$latitude.';lon='.$longitude);

			# VÄDERINFORMATION
			$temperature = $weather_forecast->product->time->location->temperature['value'];
			$temperature_unit = $weather_forecast->product->time->location->temperature['unit'];



			/** ** ** ** ** ** ** ** **/



			echo temp($temperature, $temperature_unit);

		} else {

			echo 'Error';

		}

	}

?>









<script type="text/javascript">
$(document).ready(function() {


	// KAKA: Visa temperaturen i huvudmenyn
	$('body').on('click', '.icon-delete-temperature', function() {
		if(confirm('Du är påväg att ta bort temperaturen från huvudmenyn. Om du väljer att fortsätta, kommer sidan att laddas om.')) {

			$.removeCookie(cookie_tempmenu, { path: '/' });
			window.location = document.URL;

		}
	});


});
</script>