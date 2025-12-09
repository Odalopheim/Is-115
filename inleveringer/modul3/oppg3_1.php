<?php
$dato = "2025-12-30";
$dagesnsdato = date("Y-m-d");
echo "Dagens dato er " . $dagesnsdato . "<br>";
echo "datoen henelsen skjer er " . $dato . "<br>";
if ($dato > $dagesnsdato) {
    echo "Henelsen har ikke skjedd enda";
} elseif ($dato == $dagesnsdato) {
    echo "Henelsen skjer i dag";
} else {
    echo "Henelsen har skjedd";
}
?> 