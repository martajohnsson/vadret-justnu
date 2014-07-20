<?php

	# INKLUDERA
	require '../configurations/properties.php';


	# 
	



	/** ** ** ** ** **/



	# STATUS
	echo '<div class="google-maps-status">';
		echo '<div class="google-maps-status-content"></div>';
	echo '</div>';

	# KNAPP: Använd GPS
	echo '<div class="google-maps-menu google-maps-menu-gps">';
		echo 'Använd GPS';
	echo '</div>';

	# KARTA
	echo '<div id="google-maps-manual"></div>';



	echo '<div class="manual-position">';
		echo '<div class="manual-position-options">';

			echo '<div class="manual-position-options-left">';

				# RUBRIK
				echo '<div class="headline-mini">';
					echo '<div class="icon-18 icon-location"></div>';
					echo 'Koordinater';
				echo '</div>';


				# TEXTFÄLT
				echo '<div class="manual-position-fields">';

					echo '<div class="manual-position-coordinates color-blue">';
						echo 'Var god ange <span id="characters-left">12</span> tecken till';
					echo '</div>';

					# TEXTFÄLT: Koordinater
					echo '<input type="text" name="textfield-coordinates" maxlength="22">';

				echo '</div>';



				/** ** ** ** ** **/



				echo '<div id="manual-position-information">';

					# RUBRIK
					echo '<div class="headline-mini">';
						echo '<div class="icon-18 icon-satellite"></div>';
						echo 'GPS-information';
					echo '</div>';


					# KRYSSRUTOR
					echo '<div class="manual-position-information">';
						echo '<div id="gps-accuracy">0 meter noggrannhet</div>';
					echo '</div>';

				echo '</div>';

			echo '</div>';



			/** ** ** ** ** **/



			echo '<div class="manual-position-options-right">';

				# RUBRIK
				echo '<div class="headline-mini">';
					echo '<div class="icon-18 icon-gear"></div>';
					echo 'Alternativ';
				echo '</div>';


				# KRYSSRUTOR
				echo '<div class="manual-position-checkboxes">';

					# KRYSSRUTA: Spara inte väderleksrapporten
					echo '<div class="paddingbottom-2">';
						echo '<input type="checkbox" name="checkbox-1" id="check-1">';
						echo '<label for="check-1" class="for-thecheckbox">';
							echo 'Spara inte platsens väderleksrapport';
						echo '</label>';
					echo '</div>';

					# KRYSSRUTA: Visa platsens temperatur i huvudmenyn
					echo '<div class="paddingbottom-2">';
						echo '<input type="checkbox" name="checkbox-2" id="check-2"'.(isset($_COOKIE['vjn_tempmenu']) ? ' checked' : '').'>';
						echo '<label for="check-2" class="for-thecheckbox">';
							echo 'Visa platsens aktuella temperatur i menyn';
						echo '</label>';
					echo '</div>';

					# KRYSSRUTA: Gå till den bestämda platsen vid varje nytt besök, istället för till startsidan
					echo '<input type="checkbox" name="checkbox-3" id="check-3"'.(isset($_COOKIE['vjn_startpage']) ? ' checked' : '').'>';
					echo '<label for="check-3" class="for-thecheckbox">';
						echo 'Ersätt startsidan med den angivna platsen';
					echo '</label>';

				echo '</div>';

			echo '</div>';
		echo '</div>';


		/** ** ** ** ** **/


		# TEXTFÄLT
		echo '<div class="manual-position-button">';

			# TEXTFÄLT: Knapp
			echo '<input type="button" value="Hämta väderleksrapporten">';

		echo '</div>';

	echo '</div>';

?>









<script type="text/javascript">

// LOKALA VARIABLAR
var place = { 'latitude': '59.326812', 'longitude': '18.071673' };
var map;
var map_coordinates = new google.maps.LatLng(place['latitude'], place['longitude']);
var map_options;
var marker;
var settings_timeout = 30000;





// REDO
$(document).ready(function() {


	// GOOGLE MAPS
	google_maps();

	// MARKÖR: Placera markören
	marker_solid(map_coordinates);

	// TEXTFÄLT: Latitud och longitud
	$('input[name="textfield-coordinates"]').attr({ 'placeholder': place['latitude'] + ',' + place['longitude'], 'value': place['latitude'] + ',' + place['longitude'] });



	/** ** ** **  ****  ** ** ** **/



	// KLICK: Hämta den nuvarande positionen, med hjälp av GPS-mottagaren
	$('body').on('click', '.google-maps-menu-gps', function() {

		// VISA
		$('.google-maps-status').show();
		$('.google-maps-status-content').text('Hämtar din nuvarande position - var god vänta');

		// GEOLOCATION: Hämta nuvarande position
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(
				display_coordinates, display_errors, { enableHighAccuracy: true, timeout: settings_timeout, maximumAge: 0 }
			);
		}



		// FUNKTION: Visa koordinaterna
		function display_coordinates(position) {

			// LOKAL VARIABEL
			var accuracy_meters = position.coords.accuracy;

			// GLOBALA VARIABLAR
			map_coordinates = new google.maps.LatLng(parseFloat(position.coords.latitude.toFixed(6)), parseFloat(position.coords.longitude.toFixed(6)));
			place = parseFloat(position.coords.latitude.toFixed(6)) + ',' + parseFloat(position.coords.longitude.toFixed(6));

			// MARKÖR: Flytta markören till den nya positionen
			marker_move(map_coordinates);

			// TEXTFÄLT: Latitud och longitud
			$('input[name="textfield-coordinates"]').attr({ 'placeholder': place, 'value': place });

			// GÖM
			$('.google-maps-status').fadeOut('fast');



			// KONTROLL: Dålig noggrannhet
			if(accuracy_meters >= '200') {

				// JAVASCRIPT: Tooltip
				$.getScript(folder_name + '/configurations/required/javascripts/javascript-tooltip.js');

				// LOKAL VARIABEL
				var accuracy_string = '<div class="icon icon-warning" title="Noggrannheten är ' + (accuracy_meters >= '1000' ? 'väldigt' : '') + ' dålig"></div>' + number_format(accuracy_meters, 0, '', ' ');


			// KONTROLL: Bra noggrannhet
			} else {

				// LOKAL VARIABEL
				var accuracy_string = number_format(accuracy_meters, 0, '', ' ');

			}



			// VISA
			$('#manual-position-information').show();

			// INFORMATION
			$('#gps-accuracy').html(accuracy_string + ' meters noggrannhet');

		}



		// FUNKTION: Visa felmeddelanden
		function display_errors(message) {

			// LOKAL VARIABEL
			var error = {
				1: 'Du har nekat GPS-positioneringen',
				2: sitename + ' kunde inte hitta din nuvarande position',
				3: 'Det tog för lång tid att hitta din position'
			};


			// VISA
			$('.google-maps-status').show();

			// TEXT
			$('.google-maps-status-content').text(error[message.code]);


			// TIDSGRÄNS
			setTimeout(function() {

				// GÖM
				$('.google-maps-status').fadeOut('fast');

			}, 3000);

		}

	});





	// TEXTFÄLT: Ändra standardkoordinaterna
	$('body').on('input', 'input[name="textfield-coordinates"]', function() {

		// LOKALA VARIABLAR
		var value = $('input[name="textfield-coordinates"]').val();
		var latitude_regex = /^(-?[1-8]?\d(?:\.\d{1,18})?|90(?:\.0{1,18})?)$/;
		var longitude_regex = /^(-?(?:1[0-7]|[1-9])?\d(?:\.\d{1,18})?|180(?:\.0{1,18})?)$/;
		var max = $('input[name="textfield-coordinates"]').attr('maxlength') - 7;
		var length = $('input[name="textfield-coordinates"]').val().length;

		// TEXT: Meddelande om antalet tecken kvar
		$('#characters-left').text(max - length);


		// KONTROLL: Göm meddelandet och flytta markören på kartan
		if(max - length <= 0) {

			// LOKAL VARIABEL
			var value_splitted = value.split(',');

			// GLOBAL VARIABEL
			map_coordinates = new google.maps.LatLng(value_splitted[0], value_splitted[1]);

			// MARKÖR: Flytta markören till den nya positionen
			marker_move(map_coordinates);

			// GÖM
			$('.manual-position-coordinates').hide();


		// KONTROLL: Visa meddelandet och uppdatera inte markören på kartan
		} else {

			// VISA
			$('.manual-position-coordinates').show();

		}
	});





	// KLICK: Visa väderleksrapporten om den angivna platsen
	$('body').on('click', 'input[type="button"]', function() {

		// LOKALA VARIABLAR
		var coordinates = $('input[name="textfield-coordinates"]').val();
		var string = coordinates.replace(/\s+/g, '');

		// DIRIGERA
		window.location = folder_name + '/' + ($('#check-1').is(':checked') ? 'dont-save:' : '') + string;


		/** ** ** ** ** **/


		// KONTROLL: Skapa en kaka (vjn_tempmenu)
		if($('#check-2').is(':checked')) {
			$.cookie('vjn_tempmenu', string, { expires: 7, path: '/' });

		// KONTROLL: Ta bort en kaka (vjn_tempmenu)
		} else {
			$.removeCookie('vjn_tempmenu', { path: '/' });
		}


		// KONTROLL: Skapa en kaka (vjn_startpage)
		if($('#check-3').is(':checked')) {
			$.cookie('vjn_startpage', string, { expires: 7, path: '/' });

		// KONTROLL: Ta bort en kaka (vjn_startpage)
		} else {
			$.removeCookie('vjn_startpage', { path: '/' });
		}

	});



	// KOORDINATER: Flytta kartans markör, genom att klicka någonstans på kartan
	google.maps.event.addListener(map, 'click', function(a) {

		// TEXTFÄLT: Koordinater
		$('input[name="textfield-coordinates"]').val(parseFloat(a.latLng.lat().toFixed(6)) + ',' + parseFloat(a.latLng.lng().toFixed(6)));

		// GÖM
		$('#manual-position-information').hide();

		// VISA PLATS: Flytta markören och centrera kartan efter den
		marker_move(a.latLng, map);
		map.panTo(a.latLng);

	});



	// KOORDINATER: Flytta kartans markör, genom att dra den till ett ställe
	google.maps.event.addListener(marker, 'dragend', function(a) {

		// TEXTFÄLT: Koordinater
		$('input[name="textfield-coordinates"]').val(parseFloat(a.latLng.lat().toFixed(6)) + ',' + parseFloat(a.latLng.lng().toFixed(6)));

		// GÖM
		$('#manual-position-information').hide();

		// VISA PLATS: Centrera kartan efter markören
		map.panTo(a.latLng);

	});


});



// FUNKTION: Markör
function marker_solid(coordinates) {
	marker = new google.maps.Marker({
		position: coordinates,
		map: map,
		draggable: true
	});
}

// FUNKTION: Flytta markör och fokusera
function marker_move(coordinates) {
	marker.setPosition(coordinates);
	map.panTo(coordinates);
}

// FUNKTION: Google Maps
function google_maps() {
	map_options = {
		center: map_coordinates,
		zoom: 4,
		minZoom: 2,
		maxZoom: 19,
		streetViewControl: false
	};

	map = new google.maps.Map(document.getElementById('google-maps-manual'), map_options);


	// LOKALA VARIABLAR
	var clouds = new google.maps.weather.CloudLayer();
	var bounds = new google.maps.LatLngBounds();

	// MOLNDATA: Visa molndata på kartan
	clouds.setMap(map);

	// NOGGRANNHET: Visa en cirkel runt markören
	bounds.extend(map_coordinates);


	/*
	// KARTA: Vänta tills kartan har laddats klart
	google.maps.event.addListener(map, 'tilesloaded', function() {

		// GLOBAL VARIABEL: Kartan är laddad
		maploaded = true;


		// KONTROLL: Göm överlappningen, när kartan har laddats klart
		if(maploaded == true) {
			$('#loading-map').show();
		}

	});
	*/
}

</script>