<?php
// Oppgave 1: Skriv en tekst  og skriv ut lengden på teksten og selve teksten.
$teks = "Hei på deg!";

echo $teks. "<br>";
$utenmellomrom = str_replace(" ", "", $teks);
echo strlen($utenmellomrom). "<br>";

// Oppgave 2: Skriv en funksjon som gjør alle små bokstaver til store bokstaver.
echo strtoupper("hei på deg din gammle sei!"). "<br>";

// Oppgave 3: Han skal finne hvor mange ganger "is" forekommer i teksten "Thereses familie skulle ha ris til middag. Hun ville heller ha en is å spise".

$tekst3= "Thereses familie skulle ha ris til middag. Hun ville heller ha en is å spise";
$antalll = substr_count($tekst3, "is");
echo $antalll. "<br>";

// Oppgave 4: Skriv ut dagens dato i formatet dag.måned.år (f.eks. 24.Jun.2024)
echo date("d.M.Y"). "<br>";

//Oppgave 5: find the day of the week you were born.
$birthday = "24.Jan.2003";
$time = strtotime($birthday);
echo date("l d M Y", $time). "<br>";

// Oppgave 6: Finn ut hvor mange sekunder det er siden 2025-01-01.
$origin = strtotime('2025-01-01');
$target = strtotime(date("Y-m-d"));
$diffSec = ($target - $origin); // sekunder per dag
echo $diffSec . " seconds <br>";

// Oppgave 7: Hva er klokken nå i Beones aires
date_default_timezone_set("America/Argentina/Buenos_Aires");
echo date("H:i:s"). "<br>";

//Oppgave 8: får tilbake betalt hel krone 
$tilbake = 2348.78;
echo number_format($tilbake,0). "<br>";

//Oppgave 9: 
$lodd = rand(1,50);
echo "dagen lod er: " . $lodd . "<br>";

//Oppgave 10;
$tall = 47;
echo settype($tall, "bool"). "<br>";
?>
