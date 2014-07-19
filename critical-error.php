<?php

	# INKLUDERA
	require 'configurations/properties.php';

?>



<!DOCTYPE html>

<html>
<head>


<!--  TITEL  -->
<title><?php echo SITENAME; ?></title>

<!--  FAVICON  -->
<link rel="shortcut icon" href="<?php echo url(FOLDER_IMAGES.'/favicon.ico'); ?>">

<!-- STILMALL -->
<link href="<?php echo url(FOLDER_STYLESHEETS.'/critical.css'); ?>" type="text/css" rel="stylesheet">

<!-- META -->
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">


</head>
<body>







<?php

	# RUBRIK
	echo '<div class="headline">';
		echo 'Kritiskt fel';
	echo '</div>';


	# KONTROLL: 153
	if($_GET['e'] == 'mod_rewrite') {
		echo utf8_encode('Den nödvändiga modulen <a href="http://httpd.apache.org/docs/current/mod/mod_rewrite.html" target="_blank">rewrite_module</a> existerar inte i Apaches konfigurationsfil.');

	} else {
		echo utf8_encode('Ett okänt och kritiskt fel har inträffat! Vi kommer att försöka lösa det så fort som möjligt.');
	}

?>







</body>
</html>