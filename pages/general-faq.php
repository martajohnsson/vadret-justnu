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
				echo 'Du kan få en bättre noggrannhet, genom att vara utomhus. Om du är inomhus, kommer inte satelliterna som lokaliserar din position, kunna se dig lika lätt. Det tar därför oftast väldigt lång tid, innan din aktuella position kan hittas. Noggrannheten kan då bli över 1 000 meter. Om du går ut istället, så kan noggrannheten bli mindre än 10 meter.';
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
				echo 'GPSn går inte igång när jag är på startsidan. Varför?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Detta kan bero på att du har tillåtit telefonen att hämta plats genom ett trådlöst nätverk, så som WiFi och mobila nätverk. Så fort du stänger av den här funktionen i enhetens systeminställningar, kommer enhetens GPS att kicka igång, när du besöker startsidan.';
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
				echo 'Varför är '.$sitename.' öppen källkod?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Det finns många fördelar med att ha ett projekt stämpeln "<a href="http://opensource.org/">Open Source</a>" (öppen källkod). Vem som helst kan då vara med att göra projektet bättre, säkrare, stabilare och mer optimerad för olika platformar.';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Vad för kakor använder '.$sitename.', och varför?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'De kakor (originellt kallat för cookies) som '.$sitename.' använder sig av, är <b>vjn_startpage</b> och <b>vjn_tempmenu</b>. Den förstnämnda kakan ersätter startsidan med den förbestämda platsen. Den andra kakan visar temperaturen för den angivna platsen, i huvudmenyn.';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Varför visar inte '.$sitename.' rätt väder?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo '...';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Vad för tjänst använder '.$sitename.' sig av?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo $sitename.' hämtar väderleksrapporten och framtida rapporter, från <a href="http://yr.no/">yr.no</a>.';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Jag vill behålla min totala sträcka efter att sidan har laddats om. Går detta?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Nej. Den totala sträckan gäller endast när '.$sitename.' har en aktiv anslutning till din nuvarande position. Så fort du laddar om sidan eller går till en annan sida, kommer den totala sträckan att nollställas.';
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