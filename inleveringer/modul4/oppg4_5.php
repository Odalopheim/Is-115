<?php
$tall = [12, 5, 23, 8, 17, 4, 20, 15, 9];

// Summen
$sum = array_sum($tall);

// Gjennomsnitt
$gjennomsnitt = $sum / count($tall);

// Sorter for å finne median
sort($tall);
$midten = floor(count($tall) / 2);
$median = $tall[$midten];

// Minste og største
$min = min($tall);
$max = max($tall);

// Utskrift
echo "<strong>Matrisematematikk:</strong><br>";
echo "Tallene: " . implode(", ", $tall) . "<br>";
echo "Sum: $sum<br>";
echo "Gjennomsnitt: " . round($gjennomsnitt, 2) . "<br>";
echo "Median: $median<br>";
echo "Minste tall: $min<br>";
echo "Største tall: $max<br>";
?>