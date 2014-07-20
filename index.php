<?php

	# INKLUDERA
	require 'configurations/properties.php';



	# KONTROLL
	if(isset($_GET['p'])) {
		$page = 'get/'.$_GET['p'];

	# KONTROLL
	} else {
		$page = 'get/start';
	}



	# INKLUDERA
	require $folder_configurations.'/header.php';



	/** ** ** ** ** **/



	echo '<div id="content"></div>';



	/** ** ** ** ** **/



	# INKLUDERA
	require $folder_configurations.'/footer.php';

?>












<script type="text/javascript">
$(document).ready(function() {


	// HÄMTA
	$.ajax({
		url: folder_name + '/<?php echo $page; ?>',
		type: ajax_type_get,
		beforeSend: function(b) {
			$('#content').html('<div class="message color-blue">Var god vänta medan den önskade sidan laddas</div>');
		},

		success: function(s) {
			$.getScript(folder_name + '/configurations/required/javascripts/javascript-tooltip.js');

			setTimeout(function() {
				$('#content').html(s);
			}, 400);
		},

		error: function(e) {
			$('#content').html(message_error_page);
		}
	});


});
</script>