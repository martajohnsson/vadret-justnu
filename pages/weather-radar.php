<?php

	# INKLUDERA
	require '../configurations/properties.php';

	# VARIABLAR
	$latitude = $_GET['lat'];
	$longitude = $_GET['lng'];

?>



<!DOCTYPE html>

<html>
<head>


<!--  TITEL  -->
<title><?php echo $sitename.': Radar'; ?></title>

<!--  FAVICON  -->
<link rel="shortcut icon" href="<?php echo url($folder_images.'/favicon.ico'); ?>">

<!-- STILMALL -->
<link href="<?php echo url($folder_stylesheets.'/geosatellite.css'); ?>" type="text/css" rel="stylesheet">

<!-- JAVASCRIPT -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather,elevation" type="text/javascript"></script>
<script src="<?php echo url($folder_javascripts.'/main.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">

// LOKALA VARIABLAR
var place = { 'latitude': '59.326812', 'longitude': '18.071673' };
var map;
var map_coordinates = new google.maps.LatLng(place['latitude'], place['longitude']);
var map_options;
var marker;
var geolocator_options = { enableHighAccuracy: false, timeout: settings_timeout, maximumAge: 10000 };
var settings_timeout = 30000;





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

		// LOKALA VARIABLAR
		var accuracy = number_format(location.coords.accuracy, 0);
		var speed = (location.coords.speed == null ? 0 : location.coords.speed);
		var address = location.formattedAddress;



		// GÖM
		$('#error-gps').hide();

		// VISA
		$('#google-maps-radar').show();

		// VISA & HTML
		$('.google-maps-information').show().html(address + '<div class="space space-medium">|</div>' + accuracy + ' meters noggrannhet<div class="space space-medium">|</div>' + speed + ' km/h');

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
			'PositionUnavailable': '<div class="content-paddingsides"><div class="headline">Positionen är för tillfället inte nåbar</div>' + sitename + ' kunde inte lokalisera din nuvarande position. Detta kan bero på följande:<ul><li>' + reason_3 + '</li><li>' + reason_2 + '</li></ul>Du kan testa att ladda om sidan. Om felet kvarstår, kan du se så att de möjliga anledningarna som listas ovan, är kollade. Om de är det och du fortfarande får felmeddelandet, så kan du <a href="' + folder_name + '/contact-us" target="_blank">skicka in en anmälan</a> om problemet. Under tiden kan du ange en bestämd plats, för att se väderleksrapporten för den önskade platsen. Detta gör du, genom att klicka på "Bestäm en plats" i huvudmenyn.</div>',
			'Timeout expired': '<div class="content-paddingsides"><div class="headline">Kunde inte lokalisera dig</div>' + sitename + ' försökte lokalisera din nuvarande plats, men det tog för lång tid. Detta kan bero på följande:<ul><li>' + reason_1 + '</li><li>' + reason_2 + '</li><li>' + reason_3 + '</li></ul>Om du känner att du får detta felmeddelandet väldigt ofta, hade det varit bra om du kunde <a href="' + folder_name + '/contact-us" target="_blank">skicka en felanmäla till oss</a>. Under tiden kan du ange en bestämd plats, för att se väderleksrapporten för den önskade platsen. Detta gör du, genom att klicka på "Bestäm en plats" i huvudmenyn.</div>',
			'Position acquisition timed out': '<div class="content-paddingsides"><div class="headline">Kunde inte lokalisera dig</div>' + sitename + ' försökte lokalisera din nuvarande plats, men det tog för lång tid. Detta kan bero på följande:<ul><li>' + reason_1 + '</li><li>' + reason_2 + '</li><li>' + reason_3 + '</li></ul>Om du känner att du får detta felmeddelandet väldigt ofta, hade det varit bra om du kunde <a href="' + folder_name + '/contact-us" target="_blank">skicka en felanmäla till oss</a>. Under tiden kan du ange en bestämd plats, för att se väderleksrapporten för den önskade platsen. Detta gör du, genom att klicka på "Bestäm en plats" i huvudmenyn.</div>'
		};


		// VISA & HTML
		$('#error-gps').show().html(error[message]);

		// GÖM
		$('.google-maps-information').hide();
		$('#google-maps-radar').hide();

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
		zoom: 3,
		minZoom: 2,
		maxZoom: 5,
		panControl: false,
		streetViewControl: false,
		mapTypeControl: false,
		mapTypeId: google.maps.MapTypeId.SATELLITE
	};

	map = new google.maps.Map(document.getElementById('google-maps-radar'), map_options);


	// LOKALA VARIABLAR
	var clouds = new google.maps.weather.CloudLayer();

	// MOLNDATA: Visa molndata på kartan
	clouds.setMap(map);
}

</script>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no">


</head>
<body>









<?php

	# INGET JAVASCRIPT
	echo '<noscript><div class="no-script color-red">';
		echo 'Webbläsaren stödjer inte JavaScript';
	echo '</div></noscript>';



	# MEDDELANDE
	echo '<div id="error-gps"></div>';

	# INFORMATION
	echo '<div class="google-maps-information"></div>';

	# KARTA
	echo '<div id="google-maps-radar"></div>';

?>









</body>
</html>