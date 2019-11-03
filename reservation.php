<?php 

	/* Detta program hanterar reservationer som görs från reservation.html. Det tar emot en post-request från ett formulär och sparar datat på en textfil samt ekar tillbaka informaiton om reservationen till användaren som bekräftelse. */

	//Denna metod registrerar en reservation i form av en sträng som den tar emot som argument. 
	function registerReservation($reservation){
		//Öppnar textfilen där reservationen ska appendas
		$reservations = fopen("reservations.txt", "a");
		//låser filen för att undvika krock
		if(flock($reservations, LOCK_EX)){
			fwrite($reservations, $reservation);
			fflush($reservations);
			flock($reservations, LOCK_UN);
		}

		fclose($reservations);
	}

	//Denna metod hämtar information från POST-requesten och skapar en formatterad sträng av den som den sedan returnerar
	function retrieveReservation(){
		//Sparar en array av variablerna från POST samt skapar en array av nycklarna till POST arrayen
		$data = $_POST;
		$keys = array_keys($data);

		$reservation = "";

		//M.h.a. nycklarna kan varje värde i arrayen hämtas med hjälp av varje nyckel i nyckelarrayen
		foreach ($keys as $key) {
			$str = "$key: $data[$key]\n";
			$reservation .= $str;
		}

		return $reservation;
	}

	//Denna metod ekar tillbaka information om reservationen till användaren. Reservation.html har i avvanliga fall ett formulär men när användaren fyllt i det används explode för att byta ut formuläret mot svaret som skapas i denna metod.
	function showSite(){
		header("Content-type: text/html");

		$name = $_POST["name"];
		$time = $_POST["time"];
		$date = $_POST["date"];

		$delimiter = "<!-- EXPLODE -->";
		$markup = "<p style='font-size:30px;color:white;line-height: 1.4em;'>REPLACE</p>";
		$response = "Thank you $name!<br>Your reservation has been made, see you $time the $date";

		$response = str_replace("REPLACE", $response, $markup);

		$html = file_get_contents("reservation.html");
		$explode = explode($delimiter, $html);

		$explode[1] = $response;

		foreach ($explode as $str) {
			echo $str;
		}
	}

	function handleReservation(){
		$vSpace = "\n\n\n";
		$res = retrieveReservation();
		$res .= $vSpace;
		registerReservation($res);
		showSite();
	}

	handleReservation();

 ?>