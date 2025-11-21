<?php
function age($birthday) {
    // Hvis strengen inneholder klokkeslett (har bindestreker for timer/min/sek)
    if (substr_count($birthday, '-') > 2) {
        // Format med dato + tid
        $birthDate = DateTime::createFromFormat("Y-m-d-H-i-s", $birthday);
    } else {
        // Format med bare dato
        $birthDate = DateTime::createFromFormat("Y-m-d", $birthday);
    }

    // Nåværende tidspunkt
    $currentDate = new DateTime("now");

    // Differanse
    $age = $birthDate->diff($currentDate);

    return $age;
}

// Eksempel 1: bare dato
$diff1 = age("2003-04-15");
echo "Alder (uten tid): " . $diff1->y . " år, " . $diff1->m . " måneder, " . $diff1->d . " dager<br>";

// Eksempel 2: dato + tid
$diff2 = age("2003-04-15-12-00-00");
echo "Alder (med tid): " . $diff2->y . " år, " . $diff2->m . " måneder, " . $diff2->d . " dager, " .
     $diff2->h . " timer, " . $diff2->i . " minutter, " . $diff2->s . " sekunder<br>";
?>