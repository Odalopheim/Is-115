<?php 
$S0 = 5000;
$rente = 0.05;
$antall_aar = 10;

$saldo = $S0;
echo "Startsaldo: $S0 kr<br>Årlig rente: $rente %<br><br>";

for ($aar = 1; $aar <= $antall_aar; $aar++) {
    $saldo = $saldo * (1 + $rente);
    echo "År $aar: " . number_format($saldo, 2, ',', ' ') . " kr<br>";
}

echo "<br>Etter $antall_aar år er sluttbeløpet " .
     number_format($saldo, 2, ',', ' ') . " kr.";
?>
