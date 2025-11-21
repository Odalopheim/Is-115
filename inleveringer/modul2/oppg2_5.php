<?php
function genererPassord($lengde = 8){
    $storBokstaver = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $småBokstaver = "abcdefghijklmnopqrstuvwxyz";
    $tall = "0123456789";

    $alleTegn = $storBokstaver . $småBokstaver . $tall;

    $passord = $storBokstaver[random_int(0, strlen($storBokstaver)-1)];
    $passord .= $tall[random_int(0, strlen($tall)-1)];


    for ($i = 2; $i < $lengde; $i++){
        $passord .= $alleTegn[random_int(0, strlen($alleTegn)-1)];
    }

    return str_shuffle($passord);
}

echo "Generert passord: " . genererPassord();
?>
