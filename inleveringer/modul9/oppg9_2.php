<?php

/*Lag en liten loggfunksjon som skriver hendelser til slutten av en fil. */
$file = fopen('filer/logg.txt', 'a') or exit('ERROR: cannot open file');
$text = "Filene ble åpnet den " . date('Y-m-d H:i:s') . "\n";
fwrite($file, $text);
fclose($file);

// Funksjon for å hente de siste X logglinjene
function get_last_loggentries($num_entries) {
    $lines = file('filer/logg.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return [];
    }
    return array_slice($lines, -$num_entries);
}
// Hent og vis de siste 10 logglinjene
$entries = get_last_loggentries(10);
if (empty($entries)) {
    echo 'Ingen logglinjer.';
} else {
    foreach ($entries as $line) {
        echo htmlspecialchars($line) . "<br>\n";
    }
};
?>


