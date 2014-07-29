<?php

	# INKLUDERA
	require '../configurations/properties.php';



	echo '<div class="weather">';

		# GOOGLE MAPS
		echo '<div class="google-maps-loader"></div>';

		# KARTA
		echo '<div id="google-maps"></div>';


		# VÄDERLEKSRAPPORTEN
		echo '<div id="weather-content"></div>';

	echo '</div>';

?>









<?php
	if(isset($_GET['t']) AND $_GET['t'] == 'coordinates') {
?>

<script type="text/javascript">

// LOKALA VARIABLAR
var place = { 'latitude': '<?php echo $_GET["lat"]; ?>', 'longitude': '<?php echo $_GET["lng"]; ?>' };
var map;
var map_coordinates = new google.maps.LatLng(place['latitude'], place['longitude']);
var map_options;
var marker;





// REDO
$(document).ready(function() {


	// GOOGLE MAPS
	google_maps();

	// MARKÖR: Placera markören
	marker_solid(map_coordinates);



	// HÄMTA
	$.ajax({
		url: folder_name + '/get/weather/coordinates/' + place['latitude'] + ',' + place['longitude'] + '<?php echo isset($_GET["nolog"]) ? "/no-log" : ""; ?>',
		type: ajax_type_get,
		cache: true,
		beforeSend: function() {
			loading = setTimeout(function() {
				$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">Uppdaterar väderleksrapporten - var god vänta</div>');
			}, 1000);
		},



		success: function(s) {

			// TOOLTIP
			$.getScript(folder_name + '/configurations/required/javascripts/javascript-tooltip.js');

			// RENSA
			clearInterval(loading);

			// KONTROLL
			if(s == 'no-coordinates') {
				$('#weather-content').html('<div class="message color-red">Koordinaterna kunde inte hittas. Var god försök igen</div>');

			// KONTROLL
			} else {
				$('#weather-content').html(s);
			}

		},



		error: function(e) {
			$('#weather-content').html('<div class="message color-red">Något gick fel. Var god försök igen</div>');
		}
	});


});









// FUNKTION: Markör
function marker_solid(coordinates) {
	marker = new google.maps.Marker({
		position: coordinates,
		map: map,
		draggable: false
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
		zoom: 7,
		minZoom: 2,
		maxZoom: 19,
		streetViewControl: false
	};

	map = new google.maps.Map(document.getElementById('google-maps'), map_options);


	// KARTA: Vänta tills kartan har laddats klart
	google.maps.event.addListener(map, 'tilesloaded', function() {

		// GLOBAL VARIABEL: Kartan är laddad
		map_loaded = true;

		// KONTROLL: Göm överlappningen, när kartan har laddats klart
		if(map_loaded == true) {
			$('.google-maps-loader').fadeOut('slow');
		}

	});
}

</script>





<?php
	} else {
?>

<script type="text/javascript">

// LOKALA VARIABLAR
var map;
var map_coordinates;
var map_options;
var marker;
var place;
var settings_timeout = 30000;
var geolocator_options = { enableHighAccuracy: false, timeout: settings_timeout, maximumAge: 10000 };
var start = true;
var start_position;
var latitude_start;
var longitude_start;
var tracker=(function(){var f;var c;var h=[];var a=0;function e(n,o){var k=6371;var q=function(r){return r*Math.PI/180};var p=q(o.latitude-n.latitude);var m=q(o.longitude-n.longitude);var l=Math.sin(p/2)*Math.sin(p/2)+Math.cos(q(n.latitude))*Math.cos(q(o.latitude))*Math.sin(m/2)*Math.sin(m/2);return k*(2*Math.atan2(Math.sqrt(l),Math.sqrt(1-l)))}function d(k){}function j(k){var l=h[h.length-1];if(l){a+=e(l,k.coords)}h.push(k.coords);if(c){c(k,a,f)}}function b(m,k){if("geolocation" in navigator){c=m;f=navigator.geolocation.watchPosition(j,d,k);var l=function(n){j(n)}}else{alert("Geolocation is not supported!")}}function g(k){navigator.geolocation.getCurrentPosition(j,d,k)}function i(){navigator.geolocation.clearWatch(f)}return{start:b,stop:i,update:g}})();tracker.start(function(a,b){distance=b});

if(navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(function(p) {
		latitude_start = p.coords.latitude.toFixed(6);
		longitude_start = p.coords.longitude.toFixed(6);
	});
}





// REDO
$(document).ready(function() {


	// GPS: Lokalisera den nuvarande positionen
	geolocator.locate(geolocator_success, geolocator_error, null, geolocator_options, 'google-maps');

	// GOOGLE MAPS
	google_maps();

	// MARKÖR: Placera markören
	marker_solid(map_coordinates);



	// FUNKTION: Lyckades fånga GPS-positioneringen
	function geolocator_success(location) {

		// GLOBALA VARIABLAR
		place = { 'latitude': parseFloat(location.coords.latitude.toFixed(6)), 'longitude': parseFloat(location.coords.longitude.toFixed(6)) };
		map_coordinates = new google.maps.LatLng(place['latitude'], place['longitude']);
		timestamp = location.timestamp;

		// LOKALA VARIABLAR
		var accuracy = location.coords.accuracy;
		var heading = location.coords.heading;
		var speed = location.coords.speed;
		var address = location.formattedAddress;
		var street = location.address.street + (location.address.streetNumber == '' ? '' : ' ' + location.address.streetNumber);
		var postal_code = (location.address.postalCode == '' ? 'undefined' : location.address.postalCode);
		var postal_town = (location.address.town == '' ? 'undefined' : location.address.town);
		var neighborhood = (location.address.neighborhood == '' ? 'undefined' : location.address.neighborhood);
		var city = (location.address.city == '' ? 'undefined' : location.address.city);
		var county = (location.address.region == '' ? 'undefined' : location.address.region);
		var country = (location.address.country == '' ? 'undefined' : location.address.country);



		if(speed > 10 && speed < 30) {
			var distance_km = 5.0;

		} else if(speed > 30 && speed < 50) {
			var distance_km = 6.0;

		} else if(speed > 50 && speed < 70) {
			var distance_km = 7.0;

		} else if(speed > 70 && speed < 90) {
			var distance_km = 9.0;

		} else if(speed > 90 && speed < 110) {
			var distance_km = 11.0;

		} else if(speed > 110 && speed < 130) {
			var distance_km = 13.0;

		} else if(speed > 130 && speed < 150) {
			var distance_km = 15.0;

		} else if(speed > 150 && speed < 170) {
			var distance_km = 17.0;

		} else if(speed > 170 && speed < 190) {
			var distance_km = 19.0;

		} else if(speed > 190) {
			var distance_km = 25.0;

		} else {
			var distance_km = 3.0;
		}



		// HÄMTA
		$.ajax({
			url: folder_name + '/get/address/' + place['latitude'] + ',' + place['longitude'] + '/' + street + '/' + postal_code + '/' + postal_town + '/' + neighborhood + '/' + city + '/' + county + '/' + country,
			type: ajax_type_get,
			beforeSend: function() {
				
			},

			success: function(s) {
				
			},

			error: function(e) {
				
			}
		});



		// $('#weather-content').html('<div class="message color-blue">Var god vänta - hämtar väderleksrapporten från yr.no</div>');



		// KONTROLL
		if((calculate_distance(latitude_start, longitude_start, place['latitude'], place['longitude']).toFixed(1) >= distance_km) || start) {

			// GLOBALA VARIABLAR
			start = false;
			latitude_start = location.coords.latitude.toFixed(6);
			longitude_start = location.coords.longitude.toFixed(6);


			// HÄMTA
			$.ajax({
				url: folder_name + '/get/weather/gps/' + place['latitude'] + ',' + place['longitude'] + '/' + accuracy + '/' + heading + '/' + speed + '/' + distance + '/' + timestamp,
				type: ajax_type_get,
				cache: true,
				beforeSend: function() {
					loading = setTimeout(function() {
						$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">Uppdaterar väderleksrapporten - var god vänta</div>');
					}, 1000);
				},



				success: function(s) {

					// TOOLTIP
					$.getScript(folder_name + '/configurations/required/javascripts/javascript-tooltip.js');

					// RENSA
					clearInterval(loading);

					// KONTROLL
					if(s == 'no-coordinates') {
						$('#weather-content').html('<div class="message color-red">Koordinaterna kunde inte hittas. Var god försök igen</div>');

					// KONTROLL
					} else {
						$('#weather-content').html(s);
					}

				},



				error: function(e) {
					$('#weather-content').html('<div class="message color-red">Något gick fel. Var god försök igen</div>');
				}
			});





		// KONTROLL
		} else {

			// HÄMTA
			$.ajax({
				url: folder_name + '/get/weather/gps-traveler/' + accuracy + '/' + heading + '/' + speed + '/' + distance + '/' + timestamp,
				type: ajax_type_get,
				cache: true,
				beforeSend: function() {
					$('.weather-status-content').html('<div class="weather-status-content-left">' + current_datetime() + '</div><div class="weather-status-content-right">Väntar tills du har färdats 3 kilometer till</div>');
				},



				success: function(s) {

					// VARIABLAR
					var array = s.split('|');
					var accuracy_string = array[0].split('!');
					var direction_string = array[1].split('!');
					var speed_string = array[2].split('!');
					var distance_string = array[3].split('!');
					var address_string = array[4].split('!');
					var timestamp_string = array[5].split('!');


					// HTML
					$('#accuracy').html(accuracy_string[1]);
					$('#direction').html(direction_string[1]);
					$('#speed').html(speed_string[1]);
					$('#distance').html(distance_string[1]);
					$('#address').html(address_string[1]);
					$('#timestamp').html(timestamp_string[1]);

				},



				error: function(e) {
					$('#weather-content').html('<div class="message color-red">Något gick fel. Var god försök igen</div>');
				}
			});

		}



		// MARKÖR: Flytta markören till den nya positionen
		marker_move(map_coordinates);

	}


	// FUNKTION: Fel vid GPS-positionering
	function geolocator_error(message) {

		// LOKALA VARIABLAR
		var reason_1 = 'Din enhet är inte utomhus. Satelliterna kan inte se dig lika lätt, om du är inomhus';
		var reason_2 = 'Enhetens GPS är inte påslagen. Gå till inställningarna och aktivera GPS-funktionen och försök igen';
		var reason_3 = 'Enhet saknar GPS-mottagare. Enheter som stationära datorer, saknar oftast en GPS-mottagare';

		// LOKAL VARIABEL
		var error = {
			'User denied Geolocation': '<div class="content-paddingsides"><div class="headline">Du har nekat GPS-positioneringen</div>Du har valt att neka lokaliseringen av din nuvarande position. Om du ångrar ditt val, kan du ta bort ditt val i webbläsarens inställningar. Om du inte ångrar valet, kan du alltid gå till "Bestäm en plats" i huvudmenyn och välja en förbestämd plats, som du alltid kommer till vid ett återbesök, eller när du klickar på "' + sitename + '" i huvudmenyn.</div>',
			'PositionUnavailable': '<div class="content-paddingsides"><div class="headline">Positionen är för tillfället inte nåbar</div>' + sitename + ' kunde inte lokalisera din nuvarande position. Detta kan bero på följande:<ul><li>' + reason_3 + '</li><li>' + reason_2 + '</li></ul>Du kan testa att ladda om sidan. Om felet kvarstår, kan du se så att de möjliga anledningarna som listas ovan, är kollade. Om de är det och du fortfarande får felmeddelandet, så kan du <a href=' + folder_name + '/contact-us">skicka in en anmälan</a> om problemet. Under tiden kan du ange en bestämd plats, för att se väderleksrapporten för den önskade platsen. Detta gör du, genom att klicka på "Bestäm en plats" i huvudmenyn.</div>',
			'Timeout expired': '<div class="content-paddingsides"><div class="headline">Kunde inte lokalisera dig</div>' + sitename + ' försökte lokalisera din nuvarande plats, men det tog för lång tid. Detta kan bero på följande:<ul><li>' + reason_1 + '</li><li>' + reason_2 + '</li><li>' + reason_3 + '</li></ul>Om du känner att du får detta felmeddelandet väldigt ofta, hade det varit bra om du kunde <a href="' + folder_name + '/contact-us">skicka en felanmäla till oss</a>. Under tiden kan du ange en bestämd plats, för att se väderleksrapporten för den önskade platsen. Detta gör du, genom att klicka på "Bestäm en plats" i huvudmenyn.</div>',
			'Position acquisition timed out': '<div class="content-paddingsides"><div class="headline">Kunde inte lokalisera dig</div>' + sitename + ' försökte lokalisera din nuvarande plats, men det tog för lång tid. Detta kan bero på följande:<ul><li>' + reason_1 + '</li><li>' + reason_2 + '</li><li>' + reason_3 + '</li></ul>Om du känner att du får detta felmeddelandet väldigt ofta, hade det varit bra om du kunde <a href="' + folder_name + '/contact-us">skicka en felanmäla till oss</a>. Under tiden kan du ange en bestämd plats, för att se väderleksrapporten för den önskade platsen. Detta gör du, genom att klicka på "Bestäm en plats" i huvudmenyn.</div>'
		};


		// HTML
		$('.weather').html(error[message]);

	}


});









// FUNKTION: Markör
function marker_solid(coordinates) {
	marker = new google.maps.Marker({
		position: coordinates,
		map: map,
		draggable: false
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
		zoom: 7,
		minZoom: 2,
		maxZoom: 19,
		streetViewControl: false
	};

	map = new google.maps.Map(document.getElementById('google-maps'), map_options);


	// KARTA: Vänta tills kartan har laddats klart
	google.maps.event.addListener(map, 'tilesloaded', function() {

		// GLOBAL VARIABEL: Kartan är laddad
		map_loaded = true;

		// KONTROLL: Göm överlappningen, när kartan har laddats klart
		if(map_loaded == true) {
			$('.google-maps-loader').fadeOut('slow');
		}

	});
}

</script>

<?php
	}
?>