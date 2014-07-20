<?php

	# SESSION
	session_start();



	/** ** ** ** **    ** ** ** ** **/



	# INSTÄLLNINGAR
	ini_set('error_reporting', E_ALL & ~E_NOTICE);
	date_default_timezone_set('Europe/Stockholm');

	# VARIABEL: Ange root-katalogen
	$root = rtrim($_SERVER['DOCUMENT_ROOT'], '').'/vadret-justnu/';

	# VARIABLAR: Aktuellt filnamn
	$path = explode('/', $_SERVER['PHP_SELF']);
	$filename = $path[count($path) - 1];

	# VARIABLAR: Hämta innehållet i GET
	$query = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
	$filename_get = !empty($query) ? $query : '-';

	# VARIABEL: Webbsidans namn
	$sitename = 'Vädret just nu';

	# VARIABLAR: Databashantering
	$use_database = 0;
	$sql_host = 'localhost';
	$sql_database = '';
	$sql_username = 'root';
	$sql_password = '';



	/** ** ** ** **    ** ** ** ** **/



	# VARIABLAR: Kataloger
	$folder_configurations = $root.'configurations';
		$folder_required = $root.'configurations/required';
			$folder_javascripts = $root.'configurations/required/javascripts';
				$folder_forms = $root.'configurations/required/javascripts/forms';
				$folder_gets = $root.'configurations/required/javascripts/gets';
				$folder_source = $root.'configurations/required/javascripts/source';

			$folder_stylesheets = $root.'configurations/required/stylesheets';


	$folder_files = $root.'files';
		$folder_fonts = $root.'files/fonts';


	$folder_images = $root.'images';
		$folder_animations = $root.'images/animations';
		$folder_backgrounds = $root.'images/backgrounds';
			$folder_weather = $root.'images/backgrounds/weather';

		$folder_icons = $root.'images/icons';
			$folder_color_128 = $root.'images/icons/color-128';
			$folder_color_18 = $root.'images/icons/color-18';
			$folder_share = $root.'images/icons/share';



	/** ** ** ** **    ** ** ** ** **/



	# INKLUDERA
	require $folder_required.'/functions.php';

	# KONTROLL: Använd databasen
	if($use_database == 1) {
		require $folder_required.'/sql-connect.php';
	}

?>