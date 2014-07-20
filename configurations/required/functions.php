<?php

	# FUNKTION: Difinera den absoluta sökvägen
	function url($string) {
		if(strpos($string, $root) === false) {
			$string = $root . $string;
		}

		return str_replace($_SERVER['DOCUMENT_ROOT'], '', $string);
	}





















	/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **/





















	# FUNKTION: Hämta året, månaden, dagen och klockslaget
	function date_detailed($string) {

		# ARRAY
		$months = array('Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni',
						'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December');


		/** ** ** ** ** **/


		$year = date('Y', strtotime($string));
		$month = $months[date('m', strtotime($string)) -1];
		$day = date('j', strtotime($string));
		$time = date('H:i', strtotime($string));


		/** ** ** ** ** **/


		# SKRIV UT
		return $day.' '.strtolower($month).', '.$year.', kl. '.$time;
	}


	# FUNKTION: Hämta året och månaden
	function date_yearmonth($string) {

		# ARRAY
		$months = array('Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni',
						'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December');

		$year = date('Y', strtotime($string));
		$month = $months[date('m', strtotime($string)) -1];

		# SKRIV UT
		return strtolower($month).', '.$year;

	}


	# FUNKTION: Hämta året, månaden och dagen
	function date_yearmonthday($string) {

		# ARRAY
		$months = array('Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni',
						'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December');

		$year = date('Y', strtotime($string));
		$month = $months[date('m', strtotime($string)) -1];
		$day = date('j', strtotime($string));

		# SKRIV UT
		return $day.' '.strtolower($month).', '.$year;

	}





















	/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **/





















	# FUNKTION: Generera fram ett lösenord
	function generate_password($length) {
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$&*-+!?';
		return substr(str_shuffle($chars), 0, $length);
	}

	# FUNKTION: Generera fram ett lösenord
	function generate_password_temp($length) {
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		return substr(str_shuffle($chars), 0, $length);
	}

	# FUNKTION: Kalkulerar åldern enligt ett datum (ÅÅÅÅ-MM-DD)
	function calculate_age($p_strDate) {
		list($Y, $m, $d) = explode('-',$p_strDate);
		return(date('md') < $m . $d ? date('Y') - $Y - 1 : date('Y') - $Y);
	}

	# FUNKTION
	function format_number($number, $zeros = 0) {
		$explode = explode('.', $number);

		if($explode[1] == 0) {
			return number_format($explode[0], 0, ',', ' ');
		} else {
			return number_format($number, $zeros, ',', ' ');
		}
	}

	# FUNKTION: Konvertera DOMTimeStamp till DATETIME
	function domtimestamp_to_datetime($domtimestamp) {
		$datetime = new DateTime('@'.floor($domtimestamp / 1000));
		$datetime->modify('+1 hours');

		return $datetime->format('Y-m-d, H:i:s');
	}

	# FUNKTION: Konvertera DOMTimeStamp till DATETIME
	function domtimestamp_to_timestamp($domtimestamp) {
		$datetime = new DateTime('@'.floor($domtimestamp / 1000));
		return $datetime->format('U');
	}



	/** ** ** ** ** **/



	# FUNKTION: Hämta besökarens riktiga IP-adress
	function ipaddress() {
		foreach(array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
			if(array_key_exists($key, $_SERVER) === true) {
				foreach(explode(',', $_SERVER[$key]) AS $ip) {
					if(filter_var($ip, FILTER_VALIDATE_IP) !== false) { return $ip; }
				}
			}
		}
	}


	# FUNKTION: E-post
	function email($to, $to_name, $subject, $message) {
		$headers = 'MIME-Version: 1.0' . "\r\n" .
				   'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
				   'To: '.$to_name.' <'.$to.'>' . "\r\n" .
				   'From: '.SITENAME.' <no-reply@erik-edgren.nu>' . "\r\n" .
				   'X-Mailer: PHP/'.phpversion();

		mail($to, $subject, $message, $headers);
	}


	# FUNKTION: bbKod
	function bbcode($string) {

		# ARRAY: Sök efter
		$array_search = Array(
							  '/\[b\](.+?)\[\/b\]/',
							  '/\[i\](.+?)\[\/i\]/',
							  '/\[u\](.+?)\[\/u\]/',
							  '/\[s\](.+?)\[\/s\]/',
							  '/\[url=(.+?)\](.+?)\[\/url\]/',
							  '/\[image=(.+?)\]/'
							 );

		# ARRAY: Byt ut mot
		$array_replace = Array(
							   '<b>\1</b>',
							   '<i>\1</i>',
							   '<u>\1</u>',
							   '<s>\1</s>',
							   '<a href="\1" target="_blank" title="Öppnas i en ny flik">\2</a>',
							   '<div class="centered"><img src="'.url(FOLDER_UPLOADED.'/\1').'" alt=""></div>'
							  );


		# ERSÄTT MED
		$bbcode = preg_replace($array_search, $array_replace, $string);

		# SKRIV UT
		return stripslashes(nl2br($bbcode));

	}





















	/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **/





















	# FUNKTION
	function temperature_color($temperature) {

		# TEMPERATUR: Under 0 grader
		if($temperature < 0) {
			$string = '1dc0cf';

		# TEMPERATUR: Över 0 grader
		} elseif($temperature >= 0 AND $temperature < 10) {
			$string = '1fa9cf';

		# TEMPERATUR: Över 10 grader
		} elseif($temperature >= 10 AND $temperature < 20) {
			$string = 'cfa31f';

		# TEMPERATUR: Mellan 20 och 30 grader
		} elseif($temperature >= 20 AND $temperature < 30) {
			$string = 'cf6e1f';

		# TEMPERATUR: Över 30 grader
		} elseif($temperature >= 30) {
			$string = 'cf1f25';
		}


		return $string;

	}



	# FUNKTION: Formatera temperaturen
	function temp($temperature, $unit = '', $wiki = true) {
		$split = explode('.', $temperature);
		$temp = ($split[1] == 0 ? $split[0] : format_number($split[0].'.'.$split[1], 1));

		if($wiki == true) {
			# return (strpos($temp, '-') == '-' ? $temp : '+'.$temp).'<a href="http://sv.wikipedia.org/wiki/Gradtecken_(symbol)" target="_blank" title="Öppnas i en ny flik" class="temperature-link">°</a><label> </label>'.((empty($unit) OR $unit == '') ? '<a href="http://sv.wikipedia.org/wiki/Grad_Celsius" target="_blank" title="Öppnas i en ny flik" class="temperature-link">C</a>' : ($unit == 'celcius' ? '<a href="http://sv.wikipedia.org/wiki/Grad_Celsius" target="_blank" title="Öppnas i en ny flik" class="temperature-link">C</a>' : '<a href="http://sv.wikipedia.org/wiki/Farenheit" target="_blank" title="Öppnas i en ny flik" class="temperature-link">F</a>'));
			return (strpos($temp, '-') == '-' ? $temp : '+'.$temp).
				   '<span class="color-default">° '.((empty($unit) OR $unit == '') ? 'C' : ($unit == 'celcius' ? 'C' : 'F')).'</span>';

		} elseif($wiki == false) {
			return (strpos($temp, '-') == '-' ? $temp : '+'.$temp).'° '.((empty($unit) OR $unit == '') ? 'C' : ($unit == 'celcius' ? 'C' : 'F'));
		}
	}



	# FUNKTION: Översättning av månfaserna
	function moonphase($name) {
		$array = Array('New moon' => 'Nymåne',
					   'Waxing crescent' => 'Växande måne',
					   'First quarter' => 'Första kvartalet',
					   'Waning gibbous' => 'Avtagande halvmåne',
					   'Full moon' => 'Fullmåne',
					   'Waxing gibbous' => 'Växande halvmåne',
					   'Third quarter' => 'Tredje kvartalet',
					   'Waning crescent' => 'Avtagande måne');

		return $array["$name"];
	}



	# FUNKTION: Vindriktningar
	function wind_degress($degress, $type, $src) {

		# KONTROLL: Text
		if($type == 'text') {

			# RIKTNING: Nord
			if($degress == 'N') {
				$string = 'Nordlig';

			# RIKTNING: Nordnordostlig
			} elseif($degress == 'NNE') {
				$string = 'Nordnordostlig';

			# RIKTNING: Nordostlig
			} elseif($degress == 'NE') {
				$string = 'Nordostlig';

			# RIKTNING: Ostnordostlig
			} elseif($degress == 'ENE') {
				$string = 'Ostnordostlig';

			# RIKTNING: Ostlig
			} elseif($degress == 'E') {
				$string = 'Ostlig';

			# RIKTNING: Ostsydost
			} elseif($degress == 'ESE') {
				$string = 'Ostsydostlig';

			# RIKTNING: Sydost
			} elseif($degress == 'SE') {
				$string = 'Sydostlig';

			# RIKTNING: Sydsydost
			} elseif($degress == 'SSE') {
				$string = 'Sydsydostlig';

			# RIKTNING: Syd
			} elseif($degress == 'S') {
				$string = 'Sydlig';

			# RIKTNING: Sysydväst
			} elseif($degress == 'SSW') {
				$string = 'Sydsydvästlig';

			# RIKTNING: Sydväst
			} elseif($degress == 'SW') {
				$string = 'Sydvästlig';

			# RIKTNING: Västsydväst
			} elseif($degress == 'WSW') {
				$string = 'Västsydvästlig';

			# RIKTNING: Väst
			} elseif($degress == 'W') {
				$string = 'Västlig';

			# RIKTNING: Västnordväst
			} elseif($degress == 'WNW') {
				$string = 'Västnordvästlig';

			# RIKTNING: Nordväst
			} elseif($degress == 'NW') {
				$string = 'Nordvästlig';

			# RIKTNING: Nordnordväst
			} elseif($degress == 'NNW') {
				$string = 'Nordnordvästlig';
			}


			# SKRIV UT
			return $string.' vind';



		# KONTROLL: Ikon
		} elseif($type == 'icon') {

			# RIKTNING: Nord
			if($degress == 'N') {
				$string = 'north';

			# RIKTNING: Nordnordostlig
			} elseif($degress == 'NNE' OR $degress == 'NE' OR $degress == 'ENE') {
				$string = 'northeast';

			# RIKTNING: Ostnordostlig
			} elseif($degress == 'E') {
				$string = 'east';

			# RIKTNING: Ostsydost
			} elseif($degress == 'ESE' OR $degress == 'SE' OR $degress == 'SSE') {
				$string = 'southeast';

			# RIKTNING: Syd
			} elseif($degress == 'S') {
				$string = 'south';

			# RIKTNING: Sysydväst
			} elseif($degress == 'SSW' OR $degress == 'SW' OR $degress == 'WSW') {
				$string = 'southwest';

			# RIKTNING: Väst
			} elseif($degress == 'W') {
				$string = 'west';

			# RIKTNING: Västnordväst
			} elseif($degress == 'WNW' OR $degress == 'NW' OR $degress == 'NNW') {
				$string = 'northwest';
			}


			# SKRIV UT
			return $src.'/compass_'.$string.'.png';

		}

	}





















	/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **/





















	# FUNKTION: Skapa en kaka
	function cookie_create($name, $value) {

		# DEFINITION: Kakans utgångsdatum
		define('EXPIRE', time() + 604800 * 1);

		# KAKA
		setcookie($name, json_encode((object)array('name' => $name, 'value' => $value, 'expire' => EXPIRE)), EXPIRE, '/'.MAIN_FOLDER, $_SERVER['HTTP_HOST']);

	}

	# FUNKTION: Kontroll av kakans existens
	function cookie_exists($name) {

		# KONTROLL: Kakan existerar
		if(isset($_COOKIE[$name])) {
			return 1;

		# KONTROLL: Kakan existerar inte
		} else {
			return 0;
		}

	}

	# FUNKTION: Visa en kaka
	function cookie_view($name, $type = '') {
		$cookie = json_decode($_COOKIE[$name]);

		if($type == 'name') {
			return $cookie->name;

		} elseif($type == 'value') {
			return $cookie->value;

		} elseif($type == 'expire') {
			return $cookie->expire;
		}
	}

	# FUNKTION: Ta bort en kaka
	function cookie_delete($name) {
		setcookie($name, '', time() - 604800 * 1, '/'.MAIN_FOLDER, $_SERVER['HTTP_HOST']);
	}





















	/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **/





















	function sql($query, $array, $method = '') {

		global $sql;


		$prepare = $sql->prepare($query);
		$prepare->execute($array);

		if($method == 'count') {
			$data = $prepare->fetchColumn();
			return $data;

		} elseif($method == 'fetch') {
			$data = $prepare->fetch(PDO::FETCH_ASSOC);
			return $data;

		} else {
			return $prepare;
		}

	}



	function sql_il($query, $array) {

		global $sql;


		$prepare = $sql->prepare($query);

		foreach($array AS $data => $value) {
			$prepare->bindValue(':'.$data, $value);
		}

		$prepare->execute();


		return $value;

	}








	# FUNKTION: SEO-adress
	function seofriendly_url($fn) {
		$fn = strtolower($fn);
		$fn = str_replace(array('å', 'ä', 'ã', 'â', 'á', 'à'), 'a', $fn);
		$fn = str_replace(array('ö', 'õ', 'ô', 'ó', 'ò', 'ø'), 'o', $fn);
		$fn = str_replace(array('ü', 'û', 'ú', 'ù'), 'u', $fn);
		$fn = str_replace(array('é', 'è', 'ê', 'ë'), 'e', $fn);
		$fn = str_replace(array('í', 'ì', 'ï', 'î'), 'i', $fn);
		$fn = str_replace(array('ñ'), 'n', $fn);
		$fn = str_replace(array('ÿ'), 'y', $fn);
		$fn = str_replace(array('ß'), 'ss', $fn);
		$fn = str_replace(array('æ'), 'ae', $fn);

		$fn = preg_replace("/\s/", '-', $fn);
		$fn = preg_replace("/[^\w\d\.\-]/", '', $fn);
		$fn = preg_replace("/[\-]{2,}/", '-', $fn);


		/** ** ** ** ** **/


		# SKRIV UT
		return $fn;
	}

?>