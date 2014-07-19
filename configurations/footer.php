<?php

		# INNEHÅLL
		echo '</div>';

	# BEHÅLLARE
	echo '</div>';



	# FOOTER
	echo '<div class="footer">';

		# COPYRIGHT
		echo '<div class="footer-left">';
			echo '&copy; '.date('Y');
		echo '</div>';



		echo '<div class="footer-right">';

			# LÄNK: Om
			echo '<a href="'.url('about').'" class="footer-link">';
				echo 'Om';
			echo '</a>';

			# ÖVRIGT: Mellanrum
			echo '<div class="space space-small"></div>';

			# LÄNK: FAQ
			echo '<a href="'.url('faq').'" class="footer-link">';
				echo 'FAQ';
			echo '</a>';

			# ÖVRIGT: Mellanrum
			echo '<div class="space space-small"></div>';

			# LÄNK: Kontakta
			echo '<a href="'.url('contact-us').'" class="footer-link">';
				echo 'Kontakta';
			echo '</a>';

		echo '</div>';



		echo '<div class="footer-sourcecode">';

			# LÄNK: Visa källkod på GitHub
			echo '<a href="https://github.com/edgren/vadret-justnu" class="footer-link">';
				echo 'Visa källkod på GitHub';
			echo '</a>';

		echo '</div>';

	echo '</div>';

?>









</body>
</html>