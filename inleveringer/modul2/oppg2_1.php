<?php
$fultnavn = "olA NorMan lEvanger";

// kun store bokstaver i forbokstavene på navnet
$standardisertNavn = ucwords(strtolower($fultnavn));

// Teller navn basert på mellomrom 
$antallNavn = str_word_count($standardisertNavn);


// teller alle tegnene, uten mellomrom
$utenMellomrom = str_replace(" ", "", $standardisertNavn);
$antallBokstaver = strlen($utenMellomrom);

echo "Fullt navn: $standardisertNavn<br>";
echo "Antall navn: $antallNavn<br>";
echo "Antall bokstaver: $antallBokstaver";
?>

   