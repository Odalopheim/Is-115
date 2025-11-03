<?php
$mappe = "filer/";
$filnavn = "besokslogg.txt";
$fullFilsti = $mappe . $filnavn;

// Opprett mappe hvis den ikke finnes
if (!file_exists($mappe)) {
    if (!mkdir($mappe, 0777, true)) {
        die("Kan ikke opprette mappe: " . $mappe);
    }
}

// Åpne fil i append-modus
$fp = fopen($fullFilsti, "a");

// Hent info om besøk
$tekst  = "Dato/tid: " . date('d.m.Y \k\l. H:i:s') . "\r\n";
$tekst .= "IP-adresse: " . $_SERVER['REMOTE_ADDR'] . "\r\n";
$tekst .= "Vertsnavn: " . gethostbyaddr($_SERVER['REMOTE_ADDR']) . "\r\n";
$tekst .= "------------------------------\r\n";

// Skriv til fil
if (fwrite($fp, $tekst)) {
    echo "Besøk registrert i " . $filnavn . ".";
} else {
    echo "En feil oppsto under skriving til fil.";
}

fclose($fp);
?>

