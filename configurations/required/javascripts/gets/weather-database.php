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
			$temperature = $weather_forecast->product->time->location->temperature['value'];
			$temperature_unit = $weather_forecast->product->time->location->temperature['unit'];
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
			$weather_symbol = $weather_forecast->product->time[3]->location->symbol['number'];
			$weather_symbol_name = !empty($weather_forecast->product->time[3]->location->symbol['id']) ? $weather_forecast->product->time[3]->location->symbol['id'] : '';

			$pressure = format_number((string)$weather_forecast->product->time->location->pressure['value'], 1);
			$pressure_db = $weather_forecast->product->time->location->pressure['value'];
			$pressure_unit = $weather_forecast->product->time->location->pressure['unit'];
			$humidity = format_number((string)$weather_forecast->product->time->location->humidity['value'], 1);
			$humidity_db = $weather_forecast->product->time->location->humidity['value'];
			$humidity_unit = $weather_forecast->product->time->location->humidity['unit'];
			$moon_phase = $weather_sun->time->location->moon['phase'];
			$moonrise = date('H:i', strtotime($weather_sun->time->location->moon['rise'].' +'.($timezone->raw_offset / 3600 -1).' hour'));
			$moonset = date('H:i', strtotime($weather_sun->time->location->moon['set'].' +'.($timezone->raw_offset / 3600 -1).' hour'));
			$sunrise = date('H:i', strtotime($weather_sun->time->location->sun['rise'].' +'.($timezone->raw_offset / 3600 -1).' hour'));
			$sunset = date('H:i', strtotime($weather_sun->time->location->sun['set'].' +'.($timezone->raw_offset / 3600 -1).' hour'));
			$local_time = date('H:i', strtotime(($timezone->raw_offset / 3600 -1).' hours'));

			$address = (isset($_GET['address']) AND !empty($_GET['address'])) ? str_replace('|', ' ', $_GET['address']) : '';
			$timestamp = domtimestamp_to_timestamp($_GET['timestamp']);



			/** ** ** ** ** ** ** ** **/



			# DATABAS (kontroll)
			$coordinates_exists = sql("SELECT COUNT(*)
									   FROM coordinates
									   WHERE data_coordinates = :coordinates
									   AND data_temperature = :temperature
									   AND data_pressure = :pressure
									   AND data_humidity = :humidity
									   AND data_weather = :weather
									   AND data_cloudiness = :cloudiness
									   AND data_fog = :fog
									   AND data_wind_speed = :wind_speed
									   AND data_wind_compass = :wind_compass
									   AND data_wind_degrees = :wind_degrees

									  ", Array('coordinates' => $latitude.','.$longitude,
											   'temperature' => $temperature,
											   'pressure' => $pressure_db,
											   'humidity' => $humidity_db,
											   'weather' => $weather_symbol_name,
											   'cloudiness' => $cloudiness,
											   'fog' => $fog,
											   'wind_speed' => $wind_speed,
											   'wind_compass' => $wind_direction,
											   'wind_degrees' => $wind_direction_degrees), 'count');



			# KONTROLL: Koordinaterna och väderprognosen existerar inte
			if(!isset($_GET['nolog']) AND $coordinates_exists == 0) {

				# VARIABEL: Status
				echo 'weather-saved';

				# DATABAS (lägg till)
				sql_il("INSERT INTO coordinates(id_user,
												id_symbol,
												data_coordinates,
												data_temperature,
												data_temperature_unit,
												data_accuracy,
												data_altitude,
												data_heading,
												data_speed,
												data_pressure,
												data_pressure_unit,
												data_humidity,
												data_humidity_unit,
												data_moonphase,
												data_moonrise,
												data_moonset,
												data_sunrise,
												data_sunset,
												data_localtime,
												data_weather,
												data_cloudiness,
												data_fog,
												data_wind_speed,
												data_wind_compass,
												data_wind_degrees,
												data_precipitation,
												data_precipitation_max,
												data_precipitation_min,
												data_precipitation_from,
												data_precipitation_to,
												data_precipitation_unit,
												timestamp_found)

						VALUES(:iduser,
							   :idsymbol,
							   :coordinates,
							   :temperature,
							   :temperature_unit,
							   :accuracy,
							   :altitude,
							   :heading,
							   :speed,
							   :pressure,
							   :pressure_unit,
							   :humidity,
							   :humidity_unit,
							   :moonphase,
							   :moonrise,
							   :moonset,
							   :sunrise,
							   :sunset,
							   :localtime,
							   :weather,
							   :cloudiness,
							   :fog,
							   :wind_speed,
							   :wind_compass,
							   :wind_degrees,
							   :precipitation,
							   :precipitation_max,
							   :precipitation_min,
							   :precipitation_from,
							   :precipitation_to,
							   :precipitation_unit,
							   :found)


					   ", Array('iduser' => '0',
								'idsymbol' => $weather_symbol,
								'coordinates' => $latitude.','.$longitude,
								'temperature' => $temperature,
								'temperature_unit' => $temperature_unit,
								'accuracy' => ((isset($_GET['t']) AND $_GET['t'] == 'coordinates') ? '' : $_GET['accuracy']),
								'altitude' => ((isset($_GET['t']) AND $_GET['t'] == 'coordinates') ? '' : $_GET['altitude']),
								'heading' => ((isset($_GET['t']) AND $_GET['t'] == 'coordinates') ? '' : ($_GET['heading'] == '' ? '0.0' : $_GET['heading'])),
								'speed' => ((isset($_GET['t']) AND $_GET['t'] == 'coordinates') ? '' : ($_GET['speed'] == '' ? '0.0' : $_GET['speed'])),
								'pressure' => $pressure_db,
								'pressure_unit' => $pressure_unit,
								'humidity' => $humidity_db,
								'humidity_unit' => $humidity_unit,
								'moonphase' => $moon_phase,
								'moonrise' => $moonrise,
								'moonset' => $moonset,
								'sunrise' => $sunrise,
								'sunset' => $sunset,
								'localtime' => $local_time,
								'weather' => $weather_symbol_name,
								'cloudiness' => $cloudiness,
								'fog' => $fog,
								'wind_speed' => $wind_speed,
								'wind_compass' => $wind_direction,
								'wind_degrees' => $wind_direction_degrees,
								'precipitation' => $precipitation,
								'precipitation_max' => $precipitation_max,
								'precipitation_min' => $precipitation_min,
								'precipitation_from' => $precipitation_from,
								'precipitation_to' => $precipitation_to,
								'precipitation_unit' => $precipitation_unit,
								'found' => ((isset($_GET['t']) AND $_GET['t'] == 'coordinates') ? time() : $timestamp)));



			} elseif(isset($_GET['nolog'])) {

				# VARIABEL: Status
				echo 'weather-no-log';


			} else {

				# VARIABEL: Status
				echo 'weather-already-exists';

			}

		}

	}

?>