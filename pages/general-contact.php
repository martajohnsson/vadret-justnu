<?php

	# INKLUDERA
	require '../configurations/properties.php';


	# 
	



	/** ** ** ** ** **/



	echo '<div class="content-paddingsides">';

		# RUBRIK
		echo '<div class="headline">';
			echo 'Kontakta oss';
		echo '</div>';


		# INNEHÅLL
		echo 'Innan du fyller i formuläret nedan och skickar det du vill säga till oss, vill vi att du ska läsa vår <a href="'.url('faq').'">FAQ</a> först. Om du inte hittar något svar på det du är ute efter, så kan du använda formuläret nedan. Vi kommer att svara på ditt meddelande inom 48 timmar. Ibland kan det dock ta 72 timmar innan du får något svar från oss.';



		# ÖVRIGT: Avgränsare
		echo '<hr>';



		# MEDDELANDE
		echo '<div id="message"></div>';


		# FORMULÄR
		echo '<form action="javascript:void(0)" method="POST">';

			echo '<div class="form-left">';

				# FORMULÄR: Namn
				echo '<div class="form-body">';
					echo '<div class="form-label">';
						echo 'Namn';
					echo '</div>';

					echo '<div class="form-field">';
						echo '<input type="text" name="textfield-firstname" placeholder="Förnamn (valfritt)" tabindex="1" autofocus>';

						echo '<span class="paddingleft-5">';
							echo '<input type="text" name="textfield-familyname" placeholder="Efternamn (valfritt)" tabindex="2">';
						echo '</span>';
					echo '</div>';
				echo '</div>';

			echo '</div>';



			echo '<div class="form-right">';

				# FORMULÄR: E-postadress
				echo '<div class="form-body">';
					echo '<div class="form-label">';
						echo 'E-postadress';
					echo '</div>';

					echo '<div class="form-field">';
						echo '<input type="text" name="textfield-email" placeholder="Obligatorisk" tabindex="3">';
					echo '</div>';
				echo '</div>';

			echo '</div>';


			# FORMULÄR: Ärende
			echo '<div class="form-body">';
				echo '<div class="form-label">';
					echo 'Ärende';
				echo '</div>';

				echo '<div class="form-field">';
					echo '<input type="text" name="textfield-subject" placeholder="Obligatorisk" tabindex="4">';
				echo '</div>';
			echo '</div>';



			# FORMULÄR: Meddelande
			echo '<div class="form-body-message">';
				echo '<div class="form-label">';
					echo 'Meddelande';
				echo '</div>';

				echo '<div class="form-field">';
					echo '<textarea name="textarea-message" placeholder="Vad vill du skriva till oss?" tabindex="5"></textarea>';
				echo '</div>';
			echo '</div>';



			# FORMULÄR: Knapp
			echo '<div class="form-button">';
				echo '<input type="submit" name="button-send" value="Skicka" tabindex="6">';
			echo '</div>';

		echo '</form>';

	echo '</div>';

?>









<script type="text/javascript">
$(document).ready(function() {


	// TEXTFÄLT: Anpassa textfältet efter textens höjd
	$('textarea[name="textarea-message"]').autosize();



	// KLICK: Skicka meddelandet
	$('body').on('click', 'input[name="button-send"]', function() {

		// VARIABLAR
		var formData = new FormData($('form')[0]);


		// HÄMTA
		$.ajax({
			url: folder_name + '/form/send/email',
			type: ajax_type_post,
			beforeSend: function() {
				$('#message').html('<div class="message color-blue">Kontrollera textfältet - var god vänta</div>');
			},

			success: function(s) {
				if(s == 1) {
					$('#message').html('<div class="message color-red">Var god fyll i de obligatoriska fälten först</div>');

				} else if(s == 2) {
					$('#message').html('<div class="message color-red">Den angivna e-postadressen är inte giltig</div>');

				} else {
					$('#message').html(s);
					$('form').trigger('reset');
				}
			},

			error: function(e) {
				$('#message').html('<div class="message color-red">Något gick fel. Var god försök igen</div>');
			},


			data: formData,
			cache: false,
			contentType: false,
			processData: false
		});

	});


});
</script>