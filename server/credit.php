<?php 

	/* Detta program använder en textfil med namn och länkar på fotografer och för in dem i en html-mall (så att jag slipper göra det själv). I filen skriver jag in länken till artisten + dess namn och sedan skiljer jag varje namn med radbrytning. */

	// Öppnar txt-filen med länk till fotografen+namn samt delar upp den i en array med varje fotograf.
	$file = file_get_contents("artists.txt");
	$artists = explode("\n", $file);

	//Html-koden med placeholders för länken och namnet
	$markup = "<a href='LINK' class='big-link artist'>ARTIST</a>";
	$content = "";

	//Går igenom arrayen med fotografer och för in dem i en temporär version av $markup. I slutet fylls en sträng på med länken, när loopen är färdig kommer den innehålla alla fotografer och länkar korrekt formatterat som html
	foreach ($artists as $a) {
		$a = explode("+", $a);
		$tmp = $markup;
		$tmp = str_replace("LINK", $a[0], $tmp);
		$tmp = str_replace("ARTIST", $a[1], $tmp);
		$content .= $tmp . "\n";
	}

	//Hämtar html-mallen och byter ut kommentaren mot den nya html-koden
	$html = file_get_contents("credit.html");
	$html = str_replace('<!-- $ARTISTS-HERE -->', $content, $html);

	//Sätter content type till html så att browsern tolkar och visar upp webbsidan när echo anropas
	header("Content-type: text/html");
	echo $html;

 ?>