<?php

	# INKLUDERA
	require '../configurations/properties.php';


	# 
	



	/** ** ** ** ** **/



	echo '<div class="content-paddingsides">';

		# RUBRIK
		echo '<div class="headline">';
			echo 'Om';
		echo '</div>';


		# INNEHÅLL
		echo SITENAME.' är en vädertjänst, som låter dig snabbt kolla väderleksrapporten där du befinner dig just nu. Väderleksrapporten tillsammans med koordinaterna, sparas i databasen som standard, men du kan kringgå detta, genom att välja en bestämd plats. Därifrån kan du även lägga till den aktuella temperaturen för den specifika platsen, till huvudmenyn, och även kunna ersätta startsidan med den förbestämda platsen.';

		# ÖVRIGT: Nya rader
		echo '<br><br>';


		# INNEHÅLL
		echo SITENAME.' hämtar data från <a href="">yr.no</a>s API och erbjuder därför pricksäker väderleksrapport i världsklass. Vädertjänsten är i ständig utveckling, och om du är kunnig inom HTML, CSS, JavaScript, jQuery, PDO och SQL, så kan du vara med att göra '.SITENAME.' bättre, stabilare och säkrare. Projektet ligger uppe på GitHub och alla förslag är alltid välkomna.';

		# ÖVRIGT: Nya rader
		echo '<br><br><br>';



		# RUBRIK
		echo '<div class="headline">';
			echo 'Sociala nätverk';
		echo '</div>';


		# INNEHÅLL
		echo 'Du kan hitta oss på både <a href="https://www.facebook.com/vadret.just.nu">Facebook</a> och <a href="https://plus.google.com/u/0/communities/110106112637927502764">Google+</a>, och du kan även välja att dela väderleksrapporten till Facebook, Google+ och Twitter.';

	echo '</div>';

?>









<script type="text/javascript">
$(document).ready(function() {


	// 
	


});
</script>