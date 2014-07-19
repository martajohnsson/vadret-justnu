<?php

	# INKLUDERA
	require '../configurations/properties.php';


	# DATABAS (hämta)
	$help = sql("SELECT *
				 FROM help
				 WHERE data_subject_shorten = :subject_shorten
				", Array('subject_shorten' => $_GET['i']), 'fetch');

	# DATABAS (kontrollera)
	$help_exists = sql("SELECT COUNT(*)
						FROM help
						WHERE data_subject_shorten = :subject_shorten
					   ", Array('subject_shorten' => $_GET['i']), 'count');



	/** ** ** ** ** **/



	if(!isset($_GET['a']) AND $help_exists == 0) {

		# RUBRIK
		echo '<div class="headline">';
			echo 'Den önskade artikeln kunde inte hittas';
		echo '</div>';


		# INNEHÅLL
		echo 'Det visar sig att artikeln du söker efter, inte kunde hittas i våran databas. Om du vet att sökvägen är rätt, men du får det här felmeddelandet ändå, vill vi att du <a href="'.url('contact').'">kontaktar oss</a>. På så sätt kan vi felsöka och eventuellt åtgärda problemet.';





	} elseif(isset($_GET['a'])) {

		# RUBRIK
		echo '<div class="headline">';
			echo 'Lägg till en ny artikel';
		echo '</div>';


		# MEDDELANDE
		echo '<div class="loading"></div>';

		# FORMULÄR
		echo '<form action="javascript:void(0)" method="POST">';

			# TABELL
			echo '<div class="table">';

				# TABELL: Rubrik
				echo '<div class="table-row">';
					echo '<div class="table-cell-left">';
						echo 'Rubrik';
					echo '</div>';

					echo '<div class="table-cell-right">';
						echo '<input type="text" name="textfield-subject" placeholder="Obligatorisk" tabindex="1">';
					echo '</div>';
				echo '</div>';


				# TABELL: Länk
				echo '<div class="table-row">';
					echo '<div class="table-cell-left">';
						echo 'Länk';
					echo '</div>';

					echo '<div class="table-cell-right">';
						echo '<input type="text" name="textfield-subject-shorten" placeholder="Obligatorisk" tabindex="2">';
					echo '</div>';
				echo '</div>';


				# TABELL: Innehåll
				echo '<div class="table-row">';
					echo '<div class="table-cell-left table-cell-textarea">';
						echo 'Innehåll';
					echo '</div>';

					echo '<div class="table-cell-right">';
						echo '<textarea name="textarea-content" placeholder="Obligatorisk" tabindex="3"></textarea>';
					echo '</div>';
				echo '</div>';


				/** ** ** ** ** **/


				# TABELL: Knapp
				echo '<div class="table-row">';
					echo '<div class="table-cell-left"></div>';
					echo '<div class="table-cell-button">';
						echo '<input type="submit" name="button-publish" value="Publicera" tabindex="4">';
						echo '<div class="space space-small"></div>';
						echo 'eller <a href="'.url('help/add').'" onClick="return confirm(\'Textfälten kommer att tömmas efter omladdningen av sidan, om du väljer att fortsätta.\')">';
							echo 'avbryt';
						echo '</a>';
					echo '</div>';
				echo '</div>';

			echo '</div>';

		echo '</form>';





	} else {

		# KONTROLL: Redigera
		if(isset($_GET['e'])) {


			# RUBRIK
			echo '<div class="headline">';
				echo $help['data_subject'];
				echo '<div class="space space-medium">›</div>';
				echo 'Redigera';
			echo '</div>';


			# FORMULÄR
			echo '<form action="javascript:void(0)" method="POST">';

				# TABELL
				echo '<div class="table">';

					# TABELL: Rubrik
					echo '<div class="table-row">';
						echo '<div class="table-cell-left">';
							echo 'Rubrik';
						echo '</div>';

						echo '<div class="table-cell-right">';
							echo '<input type="text" name="textfield-subject" placeholder="Obligatorisk" value="'.$help['data_subject'].'" tabindex="1">';
						echo '</div>';
					echo '</div>';


					# TABELL: Länk
					echo '<div class="table-row">';
						echo '<div class="table-cell-left">';
							echo 'Länk';
						echo '</div>';

						echo '<div class="table-cell-right">';
							echo '<input type="text" name="textfield-subject-shorten" placeholder="Obligatorisk" value="'.$help['data_subject_shorten'].'" tabindex="2">';
						echo '</div>';
					echo '</div>';


					# TABELL: Innehåll
					echo '<div class="table-row">';
						echo '<div class="table-cell-left table-cell-textarea">';
							echo 'Innehåll';
						echo '</div>';

						echo '<div class="table-cell-right">';
							echo '<textarea name="textarea-content" tabindex="3">';
								echo $help['data_content'];
							echo '</textarea>';
						echo '</div>';
					echo '</div>';


					/** ** ** ** ** **/


					# TABELL: Knapp
					echo '<div class="table-row">';
						echo '<div class="table-cell-left"></div>';
						echo '<div class="table-cell-button">';
							echo '<input type="submit" name="button-save" value="Spara" tabindex="4">';
							echo '<div class="space space-small"></div>';
							echo 'eller <a href="'.url('help/'.$help['data_subject_shorten']).'" onClick="return confirm(\'Eventuella ändringar kommer att gå förlorade, om du väljer att fortsätta.\')">';
								echo 'avbryt';
							echo '</a>';
						echo '</div>';
					echo '</div>';

				echo '</div>';

			echo '</form>';







		# KONTROLL: Läs artikeln
		} else {


			# RUBRIK
			echo '<div class="headline">';
				echo $help['data_subject'];
			echo '</div>';

			# INNEHÅLL
			echo '<div class="help-content">';
				echo $help['data_content'];
			echo '</div>';


			# HANTERA
			echo '<div class="help-manage">';

				# HANTERA: Skapades {datum}
				echo '<span class="color-grey">';
					echo 'Skapades '.date('Y-m-d, H:i:s', strtotime($help['datetime_created']));
				echo '</span>';


				# KONTROLL: Artikeln har blivit redigerad
				if($help['datetime_edited'] != '0000-00-00 00:00:00') {

					# ÖVRIGT: Mellanrum
					echo '<div class="space space-medium">/</div>';

					# HANTERA: Redigerades {datum}
					echo '<span class="color-grey">';
						echo 'Redigerades '.date('Y-m-d, H:i:s', strtotime($help['datetime_edited']));
					echo '</span>';

				}


				# ÖVRIGT: Mellanrum
				echo '<div class="space space-medium">/</div>';


				# HANTERA: Redigera
				echo '<a href="'.url('help/'.$help['data_subject_shorten'].'/edit').'">';
					echo 'Redigera';
				echo '</a>';

				# ÖVRIGT: Mellanrum
				echo '<div class="space space-small"></div>';

				# HANTERA: Anmäl
				echo '<a href="'.url('help/'.$help['data_subject_shorten'].'/report').'">';
					echo 'Anmäl';
				echo '</a>';

			echo '</div>';


		}

	}

?>









<script type="text/javascript">
$(document).ready(function() {


	// TEXTFÄLT: Anpassa textfältet efter textens höjd
	$("textarea").autosize();

	$('.loading').hide();



	// KLICK: Publicera
	$('body').on('click', 'input[name="button-publish"]', function() {
		$.ajax({
			url: folder_name + '/form/help/add',
			type: ajax_type_post,
			success: function(s) {
				alert(s);

				/*
				if(s == 1) {
					$('.loading').show().html('<div class="loading loading-error">Var god fyll i alla obligatoriska textfält, innan du kan fortsätta</div>');

				} else {
					alert('success');
				}
				*/
			},
			error: function(e) {
				alert('Fel');
			}
		});
	});


});
</script>