<?php

	# INKLUDERA
	require '../configurations/properties.php';


	# 
	



	/** ** ** ** ** **/



	echo '<div class="content-paddingsides">';

		# RUBRIK
		echo '<div class="headline">';
			echo 'Svar på de vanligaste frågorna';
		echo '</div>';



		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Hur får jag en bättre noggrannhet?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Du kan få en bättre noggrannhet, genom att vara utomhus. Om du är inomhus, kommer inte satelliterna som lokaliserar din position, att kunna se dig lika lätt. Det tar därför oftast väldigt lång tid, innan din aktuella position kan hittas.';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Varför får jag extrema noggrannhetsvärden, som till exempel 100 000 meter?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Detta kan mycket väl bero på att du sitter vid en stationär dator, som inte har någon GPS-mottagare installerad. Bärbara datorer, surfplattor och smarta telefoner, brukar väldigt ofta ha en GPS-mottagare. Om du vet att din enhet har en GPS-mottagare, hade det varit bra att du <a href="'.url('contact-us').'">kontaktar oss</a>, så att vi kan felsöka problemet.';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Jag vill ta bort temperaturen från huvudmenyn. Hur gör jag?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Du kan ta bort temperaturen från huvudmenyn, genom att klicka på den runda, röda cirkeln på vimpelns högra översta sida. Klicka sedan på <b>OK</b> för att bekräfta borttagningen.';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Varför är '.SITENAME.' öppen källkod?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Det finns många fördelar med att ha ett projekt stämpeln "<a href="http://opensource.org/">Open Source</a>" (öppen källkod). Vem som helst kan då vara med att göra projektet bättre, säkrare, stabilare och mer optimerad för olika platformar.';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Vad för kakor använder '.SITENAME.', och varför?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'De kakor (originellt kallat för cookies) som '.SITENAME.' använder sig av, är <b>vjn_startpage</b> och <b>vjn_tempmenu</b>. Den förstnämnda kakan ersätter startsidan med den förbestämda platsen. Den andra kakan visar temperaturen för den angivna platsen, i huvudmenyn.';
			echo '</div>';
		echo '</div>';

	echo '</div>';

?>









<script type="text/javascript">
$(document).ready(function() {


	// KLICK: Läs svaret på frågan
	$('body').on('click', '.faq-question', function() {

		// LOKAL VARIABEL
		var tabBody = $(this).next();

		tabBody.slideToggle();
		$('.faq-answer').not(tabBody).slideUp();
		$('.faq-question').removeClass('active');
		$(this).addClass('active');

	});


});
</script>