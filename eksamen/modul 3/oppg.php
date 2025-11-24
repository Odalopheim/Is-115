<?php 
//Oppgave 1 lag en for løkke som skriver ut tallene 1 til 10 men komma etter alle tallenen utenom det siste
for ($i = 0; $i < 10; $i++)
{
    echo $i + 1;
    if ($i < 9 ) {
        echo ", ";
    }
}


//Oppgave 2: Lag et sript som sjekker klokken også skriver ut en hilsen basert på tidspunktet på dagen
$time = date("H");
if ($time < 12){
    echo "god morgen!";
} elseif ($time < 18){
    echo "god ettermiddag!";
} else {
    echo "god kveld!";
}