<?php

	if($filename_get == '-' AND isset($_COOKIE['vjn_startpage'])) {
		header("Location: ".url($_COOKIE['vjn_startpage']));
		exit;
	}

?>







<!DOCTYPE html>

<!-- <html manifest="<?php echo url('offline-use.appcache'); ?>"> -->
<html>
<head>


<!--  TITEL  -->
<title><?php echo $sitename; ?></title>

<!--  FAVICON  -->
<link rel="shortcut icon" href="<?php echo url($folder_images.'/favicon.ico'); ?>">

<!-- STILMALL -->
<link href="<?php echo url($folder_stylesheets.'/desktop.css'); ?>" type="text/css" rel="stylesheet">
<link href="<?php echo url($folder_stylesheets.'/tablets.css'); ?>" type="text/css" rel="stylesheet">
<link href="<?php echo url($folder_stylesheets.'/cellphones.css'); ?>" type="text/css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Cuprum" type="text/css" rel="stylesheet">

<!-- JAVASCRIPT -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather,elevation" type="text/javascript"></script>
<script src="<?php echo url($folder_javascripts.'/main.js'); ?>" type="text/javascript"></script>
<script src="<?php echo url($folder_javascripts.'/canvasjs.min.js'); ?>" type="text/javascript"></script>

<!-- META -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $sitename; ?>">
<meta property="og:description" content="Ta reda på väderleksrapporten vart du än är i världen">
<meta property="og:image" content="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'images/share-image.png'; ?>">
<meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
<meta property="og:site_name" content="<?php echo $sitename; ?>">
<meta property="og:see_also" content="https://www.facebook.com/vadret.just.nu">
<meta property="fb:admins" content="811990138">
<meta property="og:app_id" content="132269043633579">
<meta property="og:locale" content="sv_SE">

<meta itemprop="name" content="<?php echo $sitename; ?>">
<meta itemprop="description" content="Ta reda på väderleksrapporten vart du än är i världen">
<meta itemprop="image" content="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'images/share-image.png'; ?>">

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="nhagyavi">
<meta name="twitter:title" content="<?php echo $sitename; ?>">
<meta name="twitter:description" content="Ta reda på väderleksrapporten vart du än är i världen">
<meta name="twitter:creator" content="nhagyavi">
<meta name="twitter:image:src" content="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'images/share-image.png'; ?>">
<meta name="twitter:domain" content="vadret-just.nu">

<meta property="business:contact_data:country_name" content="Sweden">
<meta property="business:contact_data:email" content="nhagyavi@gmail.com">
<meta property="business:contact_data:website" content="http://erik-edgren.nu/about-me/section:contact">

<meta name="viewport" content="initial-scale=1.0, user-scalable=no">


</head>
<body>









<?php

	# INGET JAVASCRIPT
	echo '<noscript><div class="no-script color-red">';
		echo 'Webbläsaren stödjer inte JavaScript';
	echo '</div></noscript>';

	# POPUP
	echo '<div class="overlay"></div>';
	echo '<div class="overlay-view">';
		echo '<div class="overlay-close"></div>';
		echo '<div class="overlay-content"></div>';
	echo '</div>';



	/** ** ** ** ** ** **/



	# HUVUDMENY
	echo '<div class="menu">';
		require $folder_required.'/menu.php';
	echo '</div>';


	# INNEHÅLL
	echo '<div class="content">';

?>