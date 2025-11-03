<?php
// Eksempelmatrise
$numbers = [5, 3, 0, 3, 0, 5, 7, 7, 9];

// Tell hvor mange ganger hvert tall forekommer
$counts = array_count_values($numbers);

// Finn verdien som bare finnes én gang
$uniqueValue = null;
foreach ($counts as $value => $count) {
    if ($count === 1) {
        $uniqueValue = $value;
        break;
    }
}

// Finn nøkkelen (indeksen) til denne verdien i matrisen
$key = array_search($uniqueValue, $numbers);

echo "Element nr. $key har en verdi ($uniqueValue) som kun forekommer én gang i matrisen.";
?>
