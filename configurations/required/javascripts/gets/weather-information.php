<?php

	# INKLUDERA
	require '../../../properties.php';

	# INSTÄLLNINGAR
	$latitude = $_GET['latitude'];
	$longitude = $_GET['longitude'];



	# KONTROLL: Koordinaterna existerar inte
	if(empty($latitude) AND empty($longitude)) {

		echo 'no-coordinates';



	# KONTROLL: Inga fel hittades
	} else {

		# KONTROLL: Solupp/nedgång och månupp/nedgång existerar
		if(@simplexml_load_file('http://api.yr.no/weatherapi/sunrise/1.0/?lat='.$latitude.';lon='.$longitude.';date='.date('Y-m-d'))) {

			# INSTÄLLNINGAR: Längden på vänstertabellen
			$table_left_width = 140;
			$table_right_width = 160;

			# XML: Hämta väderprognosen
			$weather_forecast = simplexml_load_file('http://api.yr.no/weatherapi/locationforecast/1.8/?lat='.$latitude.';lon='.$longitude);
			$weather_sun = simplexml_load_file('http://api.yr.no/weatherapi/sunrise/1.0/?lat='.$latitude.';lon='.$longitude.';date='.date('Y-m-d'));

			# KONFIGURATION: Hämta XML-data från Google TimeZone API
			$timezone = simplexml_load_file('https://maps.googleapis.com/maps/api/timezone/xml?location='.$latitude.','.$longitude.'&timestamp=1331161200&sensor=false');

			# VÄDERINFORMATION
			$wind_direction = $weather_forecast->product->time->location->windDirection['name'];
			$wind_direction_degrees = $weather_forecast->product->time->location->windDirection['deg'];
			$wind_speed = $weather_forecast->product->time->location->windSpeed['mps'];
			$cloudiness = $weather_forecast->product->time->location->cloudiness['percent'];
			$fog = $weather_forecast->product->time->location->fog['percent'];
			$precipitation = !empty($weather_forecast->product->time[3]->location->precipitation['value']) ? $weather_forecast->product->time[3]->location->precipitation['value'] : '';
			$precipitation_unit = !empty($weather_forecast->product->time[3]->location->precipitation['unit']) ? $weather_forecast->product->time[3]->location->precipitation['unit'] : '';
			$precipitation_from = gmdate('H:i', strtotime($weather_forecast->product->time[3]->attributes()->from));
			$precipitation_to = gmdate('H:i', strtotime($weather_forecast->product->time[3]->attributes()->to));
			$precipitation_max = (string)$weather_forecast->product->time[3]->location->precipitation['maxvalue'];
			$precipitation_min = (string)$weather_forecast->product->time[3]->location->precipitation['minvalue'];

			$cloudiness_array = explode('.', $cloudiness);
			$wind_direction_degrees_array = explode('.', $wind_direction_degrees);
			$wind_speed_array = explode('.', $wind_speed);
			$fog_array = explode('.', $fog);



			/** ** ** ** ** ** ** ** **/



			# INFORMATION
			echo '<div class="weather-information">';
				echo 'dsa';
			echo '</div>';

	}

?>