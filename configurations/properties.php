<?php

	# SESSION
	session_start();



	/** ** ** ** **    ** ** ** ** **/



	# INSTÄLLNINGAR
	ini_set('error_reporting', E_ALL & ~E_NOTICE);
	date_default_timezone_set('Europe/Stockholm');

	# KONFIGURATION: Ange root-katalogen
	define('ROOT_DIR', rtrim($_SERVER['DOCUMENT_ROOT'], '').'/');

	# DEFINIERING: Aktuellt filnamn
	$path = explode('/', $_SERVER['PHP_SELF']);
	$filename = $path[count($path) - 1];

	# DEFINIERING: Hämta innehållet i GET
	$query = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
	$filename_get = !empty($query) ? $query : '-';

	# KONFIGURATION: Webbsidans namn
	define('SITENAME', 'Vädret just nu');

	# DEFINIERING: Sessionens användaruppgifter
	define('SESSION_USERID', isset($_SESSION['userid']));

	# DEFINIERING: Databasuppgifter
	define('SQL_HOST', 'localhost');
	define('SQL_DATABASE', '');
	define('SQL_USERNAME', 'root');
	define('SQL_PASSWORD', '');



	/** ** ** ** **    ** ** ** ** **/



	# KATALOGER
	define('FOLDER_CONFIGURATIONS', ROOT_DIR.'configurations');
		define('FOLDER_REQUIRED', ROOT_DIR.'configurations/required');
			define('FOLDER_JAVASCRIPTS', ROOT_DIR.'configurations/required/javascripts');
				define('FOLDER_FORMS', ROOT_DIR.'configurations/required/javascripts/forms');
				define('FOLDER_GETS', ROOT_DIR.'configurations/required/javascripts/gets');

			define('FOLDER_STYLESHEETS', ROOT_DIR.'configurations/required/stylesheets');
			define('FOLDER_WIDEIMAGE', ROOT_DIR.'configurations/required/wideimage');


	define('FOLDER_FILES', ROOT_DIR.'files');
		define('FOLDER_FONTS', ROOT_DIR.'files/fonts');


	define('FOLDER_IMAGES', ROOT_DIR.'images');
		define('FOLDER_ANIMATIONS', ROOT_DIR.'images/animations');
		define('FOLDER_BACKGROUNDS', ROOT_DIR.'images/backgrounds');
			define('FOLDER_WEATHER', ROOT_DIR.'images/backgrounds/weather');

		define('FOLDER_ICONS', ROOT_DIR.'images/icons');
			define('FOLDER_COLOR_128', ROOT_DIR.'images/icons/color-128');
			define('FOLDER_COLOR_18', ROOT_DIR.'images/icons/color-18');

		define('FOLDER_SMILEYS', ROOT_DIR.'images/smileys');
		define('FOLDER_UPLOADED', ROOT_DIR.'images/uploaded');
			define('FOLDER_AVATARS', ROOT_DIR.'images/uploaded/avatars');
			define('FOLDER_BLOG', ROOT_DIR.'images/uploaded/blog');
			define('FOLDER_STEAM', ROOT_DIR.'images/uploaded/steam');



	/** ** ** ** **    ** ** ** ** **/



	# INKLUDERA
	require FOLDER_REQUIRED.'/functions.php';
	require FOLDER_REQUIRED.'/sql-connect.php';
	require FOLDER_REQUIRED.'/sql-databases.php';



	/** ** ** ** **    ** ** ** ** **/



	# FORMULÄR
	$textfield_subject = $_POST['textfield-subject'];
	$textfield_subject_shorten = $_POST['textfield-subject-shorten'];
	$textarea_content = $_POST['textfield-content'];

?>