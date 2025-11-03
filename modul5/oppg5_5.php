<?php

 // Funksjon som sjekker om to ord er anagram av hverandre.
function erAnagram($a, $b) {
    // Gjør begge ord små og fjern eventuelle mellomrom
    $a = str_split(str_replace(' ', '', strtolower($a)));
    $b = str_split(str_replace(' ', '', strtolower($b)));

    // Sorter bokstavene i alfabetisk rekkefølge
    sort($a);
    sort($b);

    // Sammenlign de sorterte listene med bokstaver
    return $a === $b;
}

// Eksempelbruk:
$ord1 = "ord";
$ord2 = "dro";

// Skriv ut resultatet på en pen måte
if (erAnagram($ord1, $ord2)) {
    echo "'$ord1' er et anagram av '$ord2'.";
} else {
    echo "'$ord1' er ikke et anagram av '$ord2'.";
}
?>
