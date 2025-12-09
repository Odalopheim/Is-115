<?php
$ruter = 64;
$vektPerKorn = 0.035;
$totaltKorn = 0;

for ($rute = 0; $rute < $ruter; $rute++) {
    $korn = 2 ** $rute;
    echo "Rute " . ($rute + 1) . ": $korn korn<br>";
    $totaltKorn += $korn;
}

$totaltGram = $totaltKorn * $vektPerKorn;
$totaltKg = $totaltGram / 1000;
$totaltTonn = $totaltKg / 1000;

echo "<br><strong>Totalt antall korn:</strong> $totaltKorn<br>";
echo "Total vekt: " . number_format($totaltGram, 0, ',', ' ') . " gram<br>";
echo "≈ " . number_format($totaltTonn, 2, ',', ' ') . " tonn";
?>
