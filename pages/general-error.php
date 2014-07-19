<?php

	# INKLUDERA
	require '../configurations/properties.php';


	# VARIABLAR
	$error_code = $_GET['e'];



	/** ** ** ** ** **/



	# RUBRIK
	echo '<div class="headline">';
		echo 'Ett problem har uppstått ('.$error_code.')';
	echo '</div>';


	# KONTROLL: 404
	if($error_code == 404) {
		echo 'Den önskade filen som du försöker nå en sida som inte existerar. Var god kontrollera adressfältet och försök igen. Om du har kunnat kommit åt sidan tidigare, så hade vi varit tacksamma om du kunde <a href="'.url('contact-us').'">skickat in en felanmälan till oss</a>. På så sätt kan vi felsöka problemet och försöka åtgärda det.';
	}

?>









<script type="text/javascript">
$(document).ready(function() {


	


});
</script>