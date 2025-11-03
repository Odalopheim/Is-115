<?php
$mappe = "filer/";
$filnavn = "meldinger.json";
$fullFil = $mappe . $filnavn;

// Opprett mappe hvis den ikke finnes
if (!file_exists($mappe)) {
    mkdir($mappe, 0777, true);
}

// Les eksisterende meldinger (eller lag tom array)
if (file_exists($fullFil)) {
    $json = file_get_contents($fullFil);
    $meldinger = json_decode($json, true);
} else {
    $meldinger = [];
}

// --- Legg til en ny melding (bare som eksempel) ---
$ny_melding = [
    "navn" => "Ola Nordmann",
    "melding" => "Hei verden!",
    "tidspunkt" => date("d.m.Y H:i:s")
];

$meldinger[] = $ny_melding;

// --- Lagre tilbake til JSON-fil ---
file_put_contents($fullFil, json_encode($meldinger, JSON_PRETTY_PRINT));

// --- Vis meldingene ---
echo "<h3>Meldinger:</h3>";
foreach ($meldinger as $m) {
    echo "<p><strong>{$m['navn']}:</strong> {$m['melding']} <em>({$m['tidspunkt']})</em></p>";
}
?>
