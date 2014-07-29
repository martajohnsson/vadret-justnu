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
				echo 'Hur inaktiverar jag GPS-positioneringen på startsidan?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Om du inte vill att '.$sitename.' ska ta reda på din aktuella position, så kan du först och främst neka förfrågan om att dela din position. Om du redan har gjort det, så kan du stänga av GPS-funktionen på din enhet. Du kan även gå till "Bestäm en plats" och kryssa i "Ersätt startsidan med den angivna platsen". Då kommer en kaka att skapas och läggas på din enhet. Varför gång du går till startsidan, kommer du att anlända till den bestämda platsen automatiskt, och enhetens GPS kommer då inte att användas.';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		/*
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Varför visar inte '.$sitename.' rätt väder?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo '...';
			echo '</div>';
		echo '</div>';
		*/


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


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Hur nollställer jag den totala sträckan som jag har färdats?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Den här funktionen är påväg. Var god håll ut tills den lanseras :)';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Varför existerar ens '.$sitename.'? Det är ju enkelt att ta reda på temperaturen och vädret.';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Självklart kan du titta på en termometer för att kolla på vädret, luftfuktighet och mer, samt titta ut för att se hur vädret är. Men varför betala flera hundralappar, om inte tusenlappar, på något som du inte kan ta med dig när du reser runt? '.$sitename.' visar temperatur, luftfuktighet, vindhastighet, vindriktning, lufttryck och mycket mer, och tjänster kostar absolut ingenting! Visst. Sådana här vädertjänster är oftast inte lika pålitliga som vad en egen väderstation är, men vilket föredrar du: att köpa en komplett väderstation som endast gäller för just ditt hem, eller en besöka vädertjänst som är helt kostnadsfritt, och som ger dig samma funktionalitet, som din egna väderstation?';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo $sitename.' visar fel väder och/eller temperatur. Varför?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'Det är omöjligt för en vädertjänst, som går efter olika väderstationer, att veta hur till exempel den exakta temperaturen där du är just nu, är för tillfället. yr.no använder sig av <a href="http://www.hirlam.org/index.php/hirlam-programme-53">HIRLAM10</a>-modellen för att räkna ut vädret på över sju miljoner städer över hela världen. Du kan läsa mer om detta här: <a href="http://www.yr.no/informasjon/1.3687572">yr.no/informasjon/1.3687572</a>';
			echo '</div>';
		echo '</div>';


		# FRÅGA & SVAR
		echo '<div class="faq-body">';
			echo '<a href="javascript:void(0)" class="faq-link faq-question">';
				echo 'Hur ofta uppdateras väderleksrapporten?';
			echo '</a>';

			echo '<div class="faq-answer">';
				echo 'För att '.$sitename.' inte ska vara för tung mot <a href="http://yr.no/">yr.no</a> servrar, kommer inte väderleksrapporten (temperatur, vinddata, molnighet, dimmtäcke och mer) att uppdateras förrän efter en viss sträcka. Följande lista visar när väderleksrapporten uppdateras, baserat på färdhastigheten:<br><ul><li>Under 10 km/h: efter 3 kilometer</li><li>Mellan 10 km/h och 30 km/h: efter 5 kilometer</li><li>Mellan 30 km/h och 50 km/h: efter 6 kilometer</li><li>Mellan 50 km/h och 70 km/h: efter 7 kilometer</li><li>Mellan 70 km/h och 90 km/h: efter 9 kilometer</li><li>Mellan 90 km/h och 110 km/h: efter 11 kilometer</li><li>Mellan 110 km/h och 130 km/h: efter 13 kilometer</li><li>Mellan 130 km/h och 150 km/h: efter 15 kilometer</li><li>Mellan 150 km/h och 170 km/h: efter 17 kilometer</li><li>Mellan 170 km/h och 190 km/h: efter 19 kilometer</li><li>Över 190 km/h: efter 25 kilometer</li></ul>Du kommer att få se ett meddelande ovanför temperaturen, som berättar när väderleksrapporten kommer att uppdateras nästa gång. Det finns dock data som uppdateras allt eftersom du rör på dig, och dessa är "Hittade dig", "Noggrannhet", "Höjd över/under havsytan", "Färdriktning", "Färdhastighet" och "Total sträcka".';
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