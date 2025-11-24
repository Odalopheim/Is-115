<?php

function password($lengde=8) {
    $storeBokstaver = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $småBokstaver = "abcdefghijklmnopqrstuvwxyz";
    $tall = "0123456789";

    $alleTegn = $storeBokstaver . $småBokstaver . $tall;
    $passord = $storeBokstaver[random_int(0, strlen($storeBokstaver)-1)];
    $passord .= $tall[random_int(0, strlen($tall)-1)];

    for ($i=2; $i < $lengde; $i++) {
        $passord .= $alleTegn[random_int(0, strlen($alleTegn)-1)];
    }
    return str_shuffle($passord);

}
echo "Genererrt passord: " . password();
