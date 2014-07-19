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
		if(@simplexml_load_file('http://api.yr.no/weatherapi/locationforecast/1.8/?lat='.$latitude.';lon='.$longitude) AND
		   @simplexml_load_file('http://api.yr.no/weatherapi/sunrise/1.0/?lat='.$latitude.';lon='.$longitude.';date='.date('Y-m-d'))) {

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
			$wind_speed = format_number((string)$weather_forecast->product->time->location->windSpeed['mps'], 1).' mps';
			$cloudiness = format_number((string)$weather_forecast->product->time->location->cloudiness['percent'], 1).'%';
			$fog = format_number(str_replace('-', '', (string)$weather_forecast->product->time->location->fog['percent']), 1).'%';
			$precipitation = !empty($weather_forecast->product->time[3]->location->precipitation['value']) ? format_number((string)$weather_forecast->product->time[3]->location->precipitation['value'], 1) : '';
			$precipitation_unit = !empty($weather_forecast->product->time[3]->location->precipitation['unit']) ? ($weather_forecast->product->time[3]->location->precipitation['unit'] == 'mm' ? 'millimeter' : '') : '';
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

			$tmzone = ($timezone->raw_offset / 3600 -1);
			$local_time = date('H:i', strtotime($tmzone.' hours')) . ($tmzone == 0 ? '' : '<div class="space space-small">|</div>'.preg_replace('/[\-]/', '', $tmzone).' timmar '.(strpos($tmzone, '-') !== false ? 'bakåt' : 'framåt'));

			$accuracy = isset($_GET['accuracy']) ? format_number($_GET['accuracy']).' meter' : '';
			$accuracy_get = $_GET['accuracy'];
			$direction = isset($_GET['heading']) ? ($_GET['heading'] == 'null' ? '<span class="color-grey">0°</span>' : format_number($_GET['heading'], 1).'°') : '';
			$speed = isset($_GET['speed']) ? ($_GET['speed'] == 'null' ? '<span class="color-grey">0 km/h</span>' : format_number($_GET['speed'], 1).' km/h') : '';
			$distance = isset($_GET['distance']) ? format_number($_GET['distance'], 1).' kilometer' : '';
			$address = (isset($_GET['address']) AND !empty($_GET['address'])) ? str_replace('|', ' ', $_GET['address']) : '';
			$timestamp = domtimestamp_to_timestamp($_GET['timestamp']);

			# XML: Hämta höjden över eller under havsytan
			$elevation = simplexml_load_file('http://maps.googleapis.com/maps/api/elevation/xml?sensor=false&locations='.$latitude.','.$longitude);

			$cloudiness_array = explode('.', $cloudiness);
			$wind_direction_degrees_array = explode('.', $wind_direction_degrees);
			$wind_speed_array = explode('.', $wind_speed);
			$fog_array = explode('.', $fog);



			# VÄDERLEK
			$weather_type_array = Array('LIGHTCLOUD' => 'Lätt molnighet',
										'PARTLYCLOUD' => 'Delvis molnighet',
										'CLOUD' => 'Molnigt',
										'LIGHTRAINSUN' => 'Delvis klart med lätt regn',
										'LIGHTRAINTHUNDERSUN' => 'Delvis klart med lätt regn och åska',
										'SLEETSUN' => 'Delvis klart med snöblandat regn',
										'SNOWSUN' => 'Snö med sol',
										'LIGHTRAIN' => 'Lätt regn',
										'RAIN' => 'Regn',
										'RAINTHUNDER' => 'Åska',
										'SLEET' => 'Snöblandat',
										'SNOW' => 'Snö',
										'SNOWTHUNDER' => 'Snö med åska',
										'FOG' => 'Dimma',
										'SUN' => 'Klart',
										'SLEETSTUNTHUNDER' => 'Delvis klart med snöblandat regn och åska',
										'SNOWSUNTHUNDER' => 'Delvis klart med snö och åska',
										'LIGHTRAINTHUNDER' => 'Lätt regn med åska',
										'SLEETTHUNDER' => 'Snöblandat med regn och åska');



			/** ** ** ** ** **/



			# TEMPERATUR-LOOP
			$i = 1;
			$data = Array();

			foreach($weather_forecast->product->time AS $temploop) {
				$time = time();
				if((string)$temploop['from'] == (string)$temploop['to']) {
					$temp = $temploop->location->temperature['value'];
					$temp_unit = $temploop->location->temperature['unit'];

					$data[] = '{ label: "'.date('H', strtotime($temploop['from'])).':00", y: '.$temp.', meter: "'.(strpos($temp, '-') == '-' ? '' : '%2B').'", degrees: "'.($temp_unit == 'celcius' ? 'C' : 'F').'" }';
					if($i++ == 25) break;
				}
			}



			/** ** ** ** ** **/



			# LOOP
			foreach($weather_forecast->product->time AS $forecast) {

				# KONTROLL: 3 timmar
				if(date('d H', strtotime((string)$forecast['from'])) == date('d H', strtotime('+3 hours'))) {
					$weather_symbol_3h = $forecast->location->symbol['number'];
					$weather_symbol_name_3h = $forecast->location->symbol['id'];

					if(date('H', strtotime('+3 hours')) >= 22 OR date('H', strtotime('+3 hours')) <= 7) {
						$weather_symbol_isnight_3h = 1;
					} else {
						$weather_symbol_isnight_3h = 0;
					}
				}


				# KONTROLL: 6 timmar
				if(date('d H', strtotime((string)$forecast['from'])) == date('d H', strtotime('+6 hours'))) {
					$weather_symbol_6h = $forecast->location->symbol['number'];
					$weather_symbol_name_6h = $forecast->location->symbol['id'];

					if(date('H', strtotime('+6 hours')) >= 22 OR date('H', strtotime('+6 hours')) <= 7) {
						$weather_symbol_isnight_6h = 1;
					} else {
						$weather_symbol_isnight_6h = 0;
					}
				}


				# KONTROLL: 9 timmar
				if(date('d H', strtotime((string)$forecast['from'])) == date('d H', strtotime('+9 hours'))) {
					$weather_symbol_9h = $forecast->location->symbol['number'];
					$weather_symbol_name_9h = $forecast->location->symbol['id'];

					if(date('H', strtotime('+9 hours')) >= 22 OR date('H', strtotime('+9 hours')) <= 7) {
						$weather_symbol_isnight_9h = 1;
					} else {
						$weather_symbol_isnight_9h = 0;
					}
				}


				# KONTROLL: 12 timmar
				if(date('d H', strtotime((string)$forecast['from'])) == date('d H', strtotime('+12 hours'))) {
					$weather_symbol_12h = $forecast->location->symbol['number'];
					$weather_symbol_name_12h = $forecast->location->symbol['id'];

					if(date('H', strtotime('+12 hours')) >= 22 OR date('H', strtotime('+12 hours')) <= 7) {
						$weather_symbol_isnight_12h = 1;
					} else {
						$weather_symbol_isnight_12h = 0;
					}
				}


				# KONTROLL: 15 timmar
				if(date('d H', strtotime((string)$forecast['from'])) == date('d H', strtotime('+15 hours'))) {
					$weather_symbol_15h = $forecast->location->symbol['number'];
					$weather_symbol_name_15h = $forecast->location->symbol['id'];

					if(date('H', strtotime('+15 hours')) >= 22 OR date('H', strtotime('+15 hours')) <= 7) {
						$weather_symbol_isnight_15h = 1;
					} else {
						$weather_symbol_isnight_15h = 0;
					}
				}


				# KONTROLL: 18 timmar
				if(date('d H', strtotime((string)$forecast['from'])) == date('d H', strtotime('+18 hours'))) {
					$weather_symbol_18h = $forecast->location->symbol['number'];
					$weather_symbol_name_18h = $forecast->location->symbol['id'];

					if(date('H', strtotime('+18 hours')) >= 22 OR date('H', strtotime('+18 hours')) <= 7) {
						$weather_symbol_isnight_18h = 1;
					} else {
						$weather_symbol_isnight_18h = 0;
					}
				}


				# KONTROLL: 21 timmar
				if(date('d H', strtotime((string)$forecast['from'])) == date('d H', strtotime('+21 hours'))) {
					$weather_symbol_21h = $forecast->location->symbol['number'];
					$weather_symbol_name_21h = $forecast->location->symbol['id'];

					if(date('H', strtotime('+21 hours')) >= 22 OR date('H', strtotime('+21 hours')) <= 7) {
						$weather_symbol_isnight_21h = 1;
					} else {
						$weather_symbol_isnight_21h = 0;
					}
				}


				# KONTROLL: 24 timmar
				if(date('d H', strtotime((string)$forecast['from'])) == date('d H', strtotime('+24 hours'))) {
					$weather_symbol_24h = $forecast->location->symbol['number'];
					$weather_symbol_name_24h = $forecast->location->symbol['id'];

					if(date('H', strtotime('+24 hours')) >= 22 OR date('H', strtotime('+24 hours')) <= 7) {
						$weather_symbol_isnight_24h = 1;
					} else {
						$weather_symbol_isnight_24h = 0;
					}
				}

			}



			/** ** ** ** ** ** ** ** **/



			# VÄDERIKON
			# if($weather_symbol_name != '') {
				# echo '<div class="weather-icon-image-type" style="background-image: url(http://api.yr.no/weatherapi/weathericon/1.0/?symbol='.$weather_symbol.';is_night=0;content_type=image/png);" title="'.$weather_type_array["$weather_symbol_name"].'"></div>';
			# }

			# STATUS
			echo '<div class="weather-status">';
				echo '<div class="weather-status-content"></div>';
			echo '</div>';

			# TEMPERATUR
			echo '<div class="weather-temperature-background" style="background-image: url('.url(FOLDER_WEATHER.'/NORMAL.jpg').');"></div>';
			echo '<div class="weather-temperature" style="color: #'.temperature_color($temperature).';">';
				echo temp($temperature, $temperature_unit);
			echo '</div>';



			/** ** ** ** ** ** ** ** **/



			# INFORMATION
			echo '<div class="weather-information">';
				echo '<div class="weather-information-left">';

					# INFORMATION: Vind
					echo '<div class="weather-information-block" title="Vind">';
						echo '<i class="fa fa-leaf color-green"></i>';
						echo '<div class="weather-information-block-text">';
							echo $wind_speed.'<br>';
							echo wind_degress($wind_direction, 'text', '');
						echo '</div>';
					echo '</div>';



					# INFORMATION: Nederbörd
					echo '<div class="weather-information-block" title="'.($precipitation == '' ? 'Kunde inte hitta nederbördsdata' : 'Nederbörd').'">';
						echo '<i class="fa fa-umbrella'.($precipitation == '' ? ' color-grey-light' : '').'"></i>';
						echo '<div class="weather-information-block-text">';
							if($precipitation != '') {
								echo $precipitation.' '.$precipitation_unit.'<br>';
								echo $precipitation_from.' till '.$precipitation_to;
							}
						echo '</div>';
					echo '</div>';

				echo '</div>';



				echo '<div class="weather-information-right">';

					# INFORMATION: Molnighet
					echo '<div class="weather-information-block" title="Molnighet">';
						echo '<i class="fa fa-cloud color-grey-dark"></i>';
						echo '<div class="weather-information-block-text">';
							echo $cloudiness;
						echo '</div>';
					echo '</div>';



					# INFORMATION: Dimmtäcke
					echo '<div class="weather-information-block" title="Dimmtäcke">';
						echo '<i class="fa fa-bars"></i>';
						echo '<div class="weather-information-block-text">';
							echo $fog;
						echo '</div>';
					echo '</div>';

				echo '</div>';
			echo '</div>';



			/** ** ** ** ** ** ** ** **/



			# MENY
			echo '<div class="weather-menu">';
				echo '<div class="weather-menu-left">';

					# MENY: Historik
					echo '<label class="weather-menu-inactive" title="Kommer snart">';
						echo '<i class="fa fa-history paddingright-5"></i>';
						echo 'Historik';
					echo '</label>';

					# ÖVRIGT: Mellanrum
					echo '<div class="space space-small"></div>';

					# MENY: Bilder
					echo '<label class="weather-menu-inactive" title="Kommer snart">';
						echo '<i class="fa fa-image paddingright-5"></i>';
						echo 'Bilder';
					echo '</label>';

				echo '</div>';



				echo '<div class="weather-menu-right">';

					# MENY: Visa temperaturen i huvudmenyn
					if(isset($_COOKIE['vjn_tempmenu'])) {
						echo '<label class="weather-menu-inactive" title="Temperaturen för den här platsen, är redan tillagd">';
							echo '<i class="fa fa-level-up paddingright-5"></i>';
							echo 'Visa temperaturen i huvudmenyn';
						echo '</label>';

					} else {
						echo '<a href="javascript:void(0)" id="add-temperature" data="'.$latitude.','.$longitude.'" class="weather-menu-link">';
							echo '<i class="fa fa-level-up paddingright-5"></i>';
							echo 'Visa temperaturen i huvudmenyn';
						echo '</a>';
					}

				echo '</div>';
			echo '</div>';



			/** ** ** ** ** ** ** ** **/



			# VÄDERLEKSRAPPORT: Data
			echo '<div class="weather-data">';
				echo '<div class="weather-data-left">';

					# TABELL
					echo '<div class="table">';

						# TABELL: Känns som
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Känns som';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right color-grey">';
								echo 'Kommer snart';
							echo '</div>';
						echo '</div>';


						# TABELL: Lufttryck
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Lufttryck';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								echo $pressure.' <a href="http://sv.wikipedia.org/wiki/HPa" target="_blank" title="Öppnas i en ny flik">'.$pressure_unit.'</a>';
							echo '</div>';
						echo '</div>';


						# TABELL: Luftfuktighet
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Luftfuktighet';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								echo $humidity . ($humidity_unit == 'percent' ? '%' : $humidity_unit);
							echo '</div>';
						echo '</div>';


						# TABELL: Månfas
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Månfas';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								echo moonphase($moon_phase);
							echo '</div>';
						echo '</div>';


						# TABELL: Månens upp/nedgång
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Månens upp/nedgång';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								echo $moonrise;
								echo '<div class="space space-small">/</div>';
								echo $moonset;
							echo '</div>';
						echo '</div>';


						# TABELL: Solens upp/nedgång
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Solens upp/nedgång';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								echo $sunrise;
								echo '<div class="space space-small">/</div>';
								echo $sunset;
							echo '</div>';
						echo '</div>';


						# TABELL: Lokal tid
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Lokal tid';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								echo $local_time;
							echo '</div>';
						echo '</div>';

					echo '</div>';

				echo '</div>';





				echo '<div class="weather-data-right">';

					# TABELL
					echo '<div class="table">';

						# TABELL: Hittade dig
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Hittade dig';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								if(isset($_GET['t']) AND $_GET['t'] == 'gps' OR $_GET['t'] == 'gps-traveler') {
									echo domtimestamp_to_datetime($_GET['timestamp']);
								} else {
									echo '<span class="color-grey">Endast för GPS</span>';
								}
							echo '</div>';
						echo '</div>';


						# TABELL: Noggrannhet
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Noggrannhet';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								if(isset($_GET['t']) AND $_GET['t'] == 'gps' OR $_GET['t'] == 'gps-traveler') {
									if($accuracy_get >= 200) {
										echo '<div class="icon icon-warning" title="Noggrannheten är '.($accuracy_get >= 1000 ? 'väldigt' : '').' dålig"></div>'.$accuracy;
									} else {
										echo $accuracy;
									}
								} else {
									echo '<span class="color-grey">Endast för GPS</span>';
								}
							echo '</div>';
						echo '</div>';


						# TABELL: Höjd över/under havsytan
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Höjd '.(strpos((string)$elevation->result->elevation, '-') !== false ? 'under' : 'över').' havsytan';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								echo format_number(str_replace('-', '', (string)$elevation->result->elevation), 1).' meter';
							echo '</div>';
						echo '</div>';


						# TABELL: Färdriktning
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Färdriktning';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								if(isset($_GET['t']) AND $_GET['t'] == 'gps' OR $_GET['t'] == 'gps-traveler') {
									echo $direction;
								} else {
									echo '<span class="color-grey">Endast för GPS</span>';
								}
							echo '</div>';
						echo '</div>';


						# TABELL: Färdhastighet
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Färdhastighet';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								if(isset($_GET['t']) AND $_GET['t'] == 'gps' OR $_GET['t'] == 'gps-traveler') {
									echo $speed;
								} else {
									echo '<span class="color-grey">Endast för GPS</span>';
								}
							echo '</div>';
						echo '</div>';


						# TABELL: Total sträcka
						echo '<div class="table-row">';
							echo '<div class="table-cell-left weather-data-table-left">';
								echo 'Total sträcka';
							echo '</div>';

							echo '<div class="table-cell-right weather-data-table-right">';
								if(isset($_GET['t']) AND $_GET['t'] == 'gps' OR $_GET['t'] == 'gps-traveler') {
									echo $distance;
								} else {
									echo '<span class="color-grey">Endast för GPS</span>';
								}
							echo '</div>';
						echo '</div>';

					echo '</div>';

				echo '</div>';
			echo '</div>';




			echo '<hr>';




			echo '<div id="view-chart"></div>';



			/** ** ** ** **/



			# VÄDRET OM 6, 12, 18 OCH 24 TIMMAR
			echo '<div class="weather-future">';
				if($weather_type_array["$weather_symbol_name_3h"] == '' AND
				   $weather_type_array["$weather_symbol_name_6h"] == '' AND
				   $weather_type_array["$weather_symbol_name_9h"] == '' AND
				   $weather_type_array["$weather_symbol_name_12h"] == '' AND
				   $weather_type_array["$weather_symbol_name_15h"] == '' AND
				   $weather_type_array["$weather_symbol_name_18h"] == '' AND
				   $weather_type_array["$weather_symbol_name_21h"] == '' AND
				   $weather_type_array["$weather_symbol_name_24h"] == '') {

					echo '<div class="color-grey">';
						echo 'Framtida väderprognoser kunde inte hittas på yr.no';
					echo '</div>';

				} else {


					echo '<div class="weather-future-left">';

						# 3 TIMMAR
						echo '<div class="weather-future-symbol">';
							echo '<div class="weather-future-head">';
								echo date('H', strtotime('+3 hours')).':00';
							echo '</div>';

							echo '<div class="weather-future-container">';
								if($weather_type_array["$weather_symbol_name_3h"] != '') {
									echo '<div class="weather-icon-image" style="background-image: url(http://api.yr.no/weatherapi/weathericon/1.0/?symbol='.$weather_symbol_3h.';is_night='.$weather_symbol_isnight_3h.';content_type=image/png);" title="'.$weather_type_array["$weather_symbol_name_3h"].'"></div>';
								} else {
									echo '<span class="color-grey">';
										echo 'Data hittades inte';
									echo '</span>';
								}
							echo '</div>';
						echo '</div>';



						# 6 TIMMAR
						echo '<div class="weather-future-symbol">';
							echo '<div class="weather-future-head">';
								echo date('H', strtotime('+6 hours')).':00';
							echo '</div>';

							echo '<div class="weather-future-container">';
								if($weather_type_array["$weather_symbol_name_6h"] != '') {
									echo '<div class="weather-icon-image" style="background-image: url(http://api.yr.no/weatherapi/weathericon/1.0/?symbol='.$weather_symbol_6h.';is_night='.$weather_symbol_isnight_6h.';content_type=image/png);" title="'.$weather_type_array["$weather_symbol_name_6h"].'"></div>';
								}
							echo '</div>';
						echo '</div>';



						# 9 TIMMAR
						echo '<div class="weather-future-symbol">';
							echo '<div class="weather-future-head">';
								echo date('H', strtotime('+9 hours')).':00';
							echo '</div>';

							echo '<div class="weather-future-container">';
								if($weather_type_array["$weather_symbol_name_9h"] != '') {
									echo '<div class="weather-icon-image" style="background-image: url(http://api.yr.no/weatherapi/weathericon/1.0/?symbol='.$weather_symbol_9h.';is_night='.$weather_symbol_isnight_9h.';content_type=image/png);" title="'.$weather_type_array["$weather_symbol_name_9h"].'"></div>';
								}
							echo '</div>';
						echo '</div>';



						# 12 TIMMAR
						echo '<div class="weather-future-symbol">';
							echo '<div class="weather-future-head">';
								echo date('H', strtotime('+12 hours')).':00';
							echo '</div>';

							echo '<div class="weather-future-container">';
								if($weather_type_array["$weather_symbol_name_12h"] != '') {
									echo '<div class="weather-icon-image" style="background-image: url(http://api.yr.no/weatherapi/weathericon/1.0/?symbol='.$weather_symbol_12h.';is_night='.$weather_symbol_isnight_12h.';content_type=image/png);" title="'.$weather_type_array["$weather_symbol_name_12h"].'"></div>';
								}
							echo '</div>';
						echo '</div>';

					echo '</div>';





					echo '<div class="weather-future-right">';

						# 15 TIMMAR
						echo '<div class="weather-future-symbol">';
							echo '<div class="weather-future-head">';
								echo date('H', strtotime('+15 hours')).':00';
							echo '</div>';

							echo '<div class="weather-future-container">';
								if($weather_type_array["$weather_symbol_name_15h"] != '') {
									echo '<div class="weather-icon-image" style="background-image: url(http://api.yr.no/weatherapi/weathericon/1.0/?symbol='.$weather_symbol_15h.';is_night='.$weather_symbol_isnight_15h.';content_type=image/png);" title="'.$weather_type_array["$weather_symbol_name_15h"].'"></div>';
								}
							echo '</div>';
						echo '</div>';



						# 18 TIMMAR
						echo '<div class="weather-future-symbol">';
							echo '<div class="weather-future-head">';
								echo date('H', strtotime('+18 hours')).':00';
							echo '</div>';

							echo '<div class="weather-future-container">';
								if($weather_type_array["$weather_symbol_name_18h"] != '') {
									echo '<div class="weather-icon-image" style="background-image: url(http://api.yr.no/weatherapi/weathericon/1.0/?symbol='.$weather_symbol_18h.';is_night='.$weather_symbol_isnight_18h.';content_type=image/png);" title="'.$weather_type_array["$weather_symbol_name_18h"].'"></div>';
								}
							echo '</div>';
						echo '</div>';



						# 21 TIMMAR
						echo '<div class="weather-future-symbol">';
							echo '<div class="weather-future-head">';
								echo date('H', strtotime('+21 hours')).':00';
							echo '</div>';

							echo '<div class="weather-future-container">';
								if($weather_type_array["$weather_symbol_name_21h"] != '') {
									echo '<div class="weather-icon-image" style="background-image: url(http://api.yr.no/weatherapi/weathericon/1.0/?symbol='.$weather_symbol_21h.';is_night='.$weather_symbol_isnight_21h.';content_type=image/png);" title="'.$weather_type_array["$weather_symbol_name_21h"].'"></div>';
								}
							echo '</div>';
						echo '</div>';



						# 24 TIMMAR
						echo '<div class="weather-future-symbol">';
							echo '<div class="weather-future-head">';
								echo date('H', strtotime('+24 hours')).':00';
							echo '</div>';

							echo '<div class="weather-future-container">';
								if($weather_type_array["$weather_symbol_name_24h"] != '') {
									echo '<div class="weather-icon-image" style="background-image: url(http://api.yr.no/weatherapi/weathericon/1.0/?symbol='.$weather_symbol_24h.';is_night='.$weather_symbol_isnight_24h.';content_type=image/png);" title="'.$weather_type_array["$weather_symbol_name_24h"].'"></div>';
								}
							echo '</div>';
						echo '</div>';

					echo '</div>';


				}
			echo '</div>';








			# DELA
			echo '<div class="weather-share">';
				echo '<div class="weather-share-content">';

					# GOOGLE+
					echo '<div class="weather-share-icon weather-share-icon-googleplus" id="share" data="google-plus" title="Dela väderleksrapporten"></div>';

					# ÖVRIGT: Mellanrum
					echo '<div class="space space-small"></div>';

					# FACEBOOK
					echo '<div class="weather-share-icon weather-share-icon-facebook" id="share" data="facebook" title="Dela väderleksrapporten"></div>';

					# ÖVRIGT: Mellanrum
					echo '<div class="space space-small"></div>';

					# TWITTER
					echo '<div class="weather-share-icon weather-share-icon-twitter" id="share" data="twitter" title="Dela väderleksrapporten"></div>';

				echo '</div>';
			echo '</div>';

?>









<script type="text/javascript">
$(document).ready(function() {


	$('body').on('click', '#share', function() {
		var share = $(this).attr('data');
		var address = document.URL;
		var temperature = '<?php echo rawurlencode(temp($temperature, $temperature_unit, false)); ?>';

		if(share == 'google-plus') {
			new_tab('https://plus.google.com/share?url=' + address);

		} else if(share == 'facebook') {
			new_tab('https://www.facebook.com/sharer/sharer.php?u=' + address);

		} else if(share == 'twitter') {
			new_tab('http://twitter.com/share?text=Det är just nu ' + temperature + ' på följande plats:&url=' + address + '&hashtags=vadretjustnu,weather,yr');
		}
	});



	$('body').on('click', '#add-temperature', function() {
		var coordinates = $(this).attr('data');

		// HÄMTA
		$.ajax({
			url: folder_name + '/get/weather/temperature/' + coordinates,
			type: ajax_type_get,
			beforeSend: function(b) {
				
			},

			success: function(s) {
				$.getScript(folder_name + '/configurations/required/javascripts/javascript-tooltip.js');

				$('.menu-temperature').css({ 'color': '#666666', 'cursor': 'pointer' }).attr({ 'id': 'menu', 'data': 'temperature', 'title': 'Gå till den sparade platsen' });
				$('.icon-delete-temperature').show();
				$('#temperature').html(s);

				$('#add-temperature').replaceWith('<label class="weather-menu-inactive" title="Temperaturen för den här platsen, är redan tillagd"><i class="fa fa-level-up paddingright-5"></i>Visa temperaturen i huvudmenyn</label>');

				$.cookie('vjn_tempmenu', coordinates, { expires: 7, path: '/' });
			},

			error: function(e) {
				
			}
		});

	});


	// HÄMTA
	$.ajax({
		url: folder_name + '/get/weather/chart/24-hours',
		type: ajax_type_get,
		data: 'p=<?php echo implode(",", $data); ?>',

		beforeSend: function(b) {
			$('#view-chart').html(message_loading_chart);
		},

		success: function(s) {
			$('#view-chart').html(s);
		},

		error: function(e) {
			$('#view-chart').html(message_error_page);
		}
	});



	<?php if(isset($_GET['t']) AND $_GET['t'] == 'gps' OR
			 isset($_GET['t']) AND $_GET['t'] == 'coordinates') { ?>

	// HÄMTA
	$.ajax({
		url: folder_name + '/get/weather/database/insert/<?php echo $latitude.",".$longitude . (isset($_GET["nolog"]) ? "/no-log" : ""); ?>',
		type: ajax_type_get,
		beforeSend: function() {
			$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">Arbetar - var god vänta</div>');
		},

		success: function(s) {
			if(s == 'no-coordinates') {
				$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">Koordinaterna fattas - sparar inte väderleksrapporten</div>');

			} else if(s == 'weather-saved') {
				$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">Väderleksrapporten sparades utan några problem</div>');

			} else if(s == 'weather-no-log') {
				$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">Du har valt att inte spara väderleksrapporten</div>');

			} else if(s == 'weather-already-exists') {
				$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">Väderleksrapporten finns redan i databasen</div>');
			}
		},

		error: function(e) {
			$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">Kunde inte spara väderleksrapporten till databasen</div>');
		}
	});

	<?php } else if(isset($_GET['t']) AND $_GET['t'] == 'gps-traveler') { ?>

	$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">Väntar tills du har färdats 3 kilometer till</div>');

	<?php } else { ?>

	$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">...</div>');

	<?php } ?>


});
</script>









<?php

		} else {

			echo '<div class="message color-red">';
				echo 'Ett fel uppstod vid hämtningen av data från yr.nos API';
			echo '</div>';

		}

	}

?>