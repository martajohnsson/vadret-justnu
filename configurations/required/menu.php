<?php

	echo '<div class="menu-space">';
		echo '<div class="menu-image'.($filename_get == (isset($_COOKIE['vjn_startpage']) ? 'p=weather/manual/'.$_COOKIE['vjn_startpage'].'/start' : '-') ? ' menu-image-active' : '').'" id="menu" data="home'.(isset($_COOKIE['vjn_startpage']) ? '-coordinates' : '').'">';
			echo '<i class="fa fa-clock-o"></i>';
			echo '<div class="menu-image-text">';
				echo $sitename;
			echo '</div>';
		echo '</div>';
	echo '</div>';


	echo '<div class="menu-space">';
		# echo '<div class="menu-image'.($filename_get == 'p=history' ? ' menu-image-active' : '').'" id="menu" data="history">';
		echo '<div class="menu-image menu-inactive" title="Kommer snart">';
			echo '<i class="fa fa-history"></i>';
			echo '<div class="menu-image-text">';
				echo 'Historik';
			echo '</div>';
		echo '</div>';
	echo '</div>';


	echo '<div class="menu-space">';
		echo '<div class="menu-image'.(($filename_get == 'p=manual' OR $filename_get == 'p=weather/manual/'.str_replace('/vadret-justnu/dont-save:', '', $_SERVER['REQUEST_URI']).'/no-log') ? ' menu-image-active' : '').'" id="menu" data="manual">';
			echo '<i class="fa fa-cogs"></i>';
			echo '<div class="menu-image-text">';
				echo 'Bestäm en plats';
			echo '</div>';
		echo '</div>';
	echo '</div>';





	echo '<div class="menu-space-temperature">';
		echo '<div class="icon-18 icon-delete-temperature" title="Ta bort temperaturen från menyn"></div>';

		echo '<div class="menu-image menu-temperature">';
			echo '<div class="menu-image-temperature">';
				echo '<i class="fa fa-bookmark-o"></i>';
			echo '</div>';

			echo '<div class="menu-image-text-temperature" id="temperature">';
				echo 'Temperatur';
			echo '</div>';
		echo '</div>';
	echo '</div>';

?>